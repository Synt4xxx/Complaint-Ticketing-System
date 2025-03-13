<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $userId = Auth::id();

        // Total complaints by the customer
        $totalComplaints = Complaint::where('user_id', $userId)->count();

        // Active complaints (status 'New' or 'In Progress')
        $activeComplaints = Complaint::where('user_id', $userId)
            ->whereIn('status', ['New', 'In Progress'])
            ->count();

        // Resolved complaints
        $resolvedComplaints = Complaint::where('user_id', $userId)
            ->where('status', 'Resolved')
            ->count();

        // Recent complaints (latest 5)
        $recentComplaints = Complaint::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Return the view with data
        return view('customer', compact(
            'totalComplaints',
            'activeComplaints',
            'resolvedComplaints',
            'recentComplaints'
        ));
    }
}
