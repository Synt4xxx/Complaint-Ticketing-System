<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            'status' => 'New',
            'user_id' => Auth::id()
        ]);

        $complaint->save();

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('complaint-attachments', 'public');
                $complaint->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName()
                ]);
            }
        }

        return redirect()->route('dashboard')
            ->with('success', 'Your complaint has been submitted successfully. We will review it shortly.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
