<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function customer()
    {
        $user = Auth::user(); // Current authenticated customer

        // Fetch total complaints
        $totalComplaints = Complaint::where('user_id', $user->id)->count();

        // Fetch active complaints (assuming status is 'New' or 'In Progress')
        $activeComplaints = Complaint::where('user_id', $user->id)
                                     ->whereIn('status', ['New', 'In Progress'])
                                     ->count();

        // Fetch resolved complaints
        $resolvedComplaints = Complaint::where('user_id', $user->id)
                                       ->where('status', 'Resolved')
                                       ->count();

        // Fetch recent complaints (latest 5)
        $recentComplaints = Complaint::where('user_id', $user->id)
                                     ->latest()
                                     ->take(5)
                                     ->get();

        // Return the view with data
        return view('dashboard.customer', compact(
            'totalComplaints',
            'activeComplaints',
            'resolvedComplaints',
            'recentComplaints'
        ));
    }
}
