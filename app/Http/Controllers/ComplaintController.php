<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ComplaintController extends Controller
{
    /**
     * Protect controller routes with auth middleware.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the user's complaints.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $complaints = Complaint::where('user_id', Auth::id())->latest()->paginate(10);
        return view('complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new complaint.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('complaints.create');
    }

    /**
     * Store a newly created complaint in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'drugstore_name' => 'required|string|max:255',
            'complaint_type' => 'required|string|in:medication_quality,service_issue,pricing,prescription,safety,other',
            'incident_date' => 'required|date|before_or_equal:today',
            'priority' => 'required|string|in:low,medium,high,urgent',
            'description' => 'required|string|min:20',
            'attachments.*' => 'nullable|file|mimes:png,jpg,jpeg,pdf|max:10240'
        ]);

        $complaint = new Complaint([
            'drugstore_name' => $request->drugstore_name,
            'complaint_type' => $request->complaint_type,
            'incident_date' => $request->incident_date,
            'priority' => $request->priority,
            'description' => $request->description,
            'status' => Complaint::STATUS_NEW, // Using constant for status
            'user_id' => Auth::id()
        ]);

        $complaint->save();

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('complaint-attachments', 'public');
                $url = Storage::url($path); // Store URL for easier access

                $complaint->attachments()->create([
                    'file_path' => $url, // Storing URL instead of relative path
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('complaints.index')
            ->with('success', 'Your complaint has been submitted successfully. We will review it shortly.');
    }

    /**
     * Display the specified complaint.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id): View
    {
        $complaint = Complaint::where('user_id', Auth::id())->findOrFail($id);
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified complaint.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id): View
    {
        $complaint = Complaint::where('user_id', Auth::id())->findOrFail($id);
        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified complaint in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $request->validate([
            'drugstore_name' => 'required|string|max:255',
            'complaint_type' => 'required|string|in:medication_quality,service_issue,pricing,prescription,safety,other',
            'incident_date' => 'required|date|before_or_equal:today',
            'priority' => 'required|string|in:low,medium,high,urgent',
            'description' => 'required|string|min:20',
        ]);

        $complaint = Complaint::where('user_id', Auth::id())->findOrFail($id);

        $complaint->update([
            'drugstore_name' => $request->drugstore_name,
            'complaint_type' => $request->complaint_type,
            'incident_date' => $request->incident_date,
            'priority' => $request->priority,
            'description' => $request->description
        ]);

        return redirect()->route('complaints.index')
            ->with('success', 'Your complaint has been updated successfully.');
    }

    /**
     * Remove the specified complaint from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $complaint = Complaint::where('user_id', Auth::id())->findOrFail($id);
        $complaint->delete();

        return redirect()->route('complaints.index')
            ->with('success', 'Your complaint has been deleted successfully.');
    }
    public function user()
{
    $complaints = Complaint::with('user')->paginate(10); // Fetch complaints with user details and paginate results
    return view('admin.complaint-details', compact('complaints'));
}

}
