<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class SupportController extends Controller
{
public function support()
{
    if (!Auth::check()) {
        abort(403, 'Unauthorized access');
    }

    $user = Auth::user();

    // Get complaints assigned to the logged-in support user
    $assignedComplaints = Complaint::where('assigned_to', $user->id)->count();
    $inProgressComplaints = Complaint::where('assigned_to', $user->id)
        ->where('status', 'In Progress')
        ->count();
    $resolvedComplaints = Complaint::where('assigned_to', $user->id)
        ->where('status', 'Resolved')
        ->count();
    $assignedComplaintsList = Complaint::where('assigned_to', $user->id)
        ->latest()
        ->get();

    return view('dashboard.support', compact(
        'assignedComplaints',
        'inProgressComplaints',
        'resolvedComplaints',
        'assignedComplaintsList'
    ));
}
public function assignedComplaints()
{
    $assignedComplaints = Complaint::where('status', 'Assigned')->get();
    return view('support.assigned_complaints', compact('assignedComplaints'));
}

public function inProgressComplaints()
{
    $inProgressComplaints = Complaint::where('status', 'In Progress')->get();
    return view('support.in_progress_complaints', compact('inProgressComplaints'));
}

public function resolvedComplaints()
{
    $resolvedComplaints = Complaint::where('status', 'Resolved')->get();
    return view('support.resolved_complaints', compact('resolvedComplaints'));
}


}