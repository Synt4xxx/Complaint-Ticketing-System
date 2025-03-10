<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        
        $totalComplaints = Complaint::where('user_id', $user->id)->count();
        $activeComplaints = Complaint::where('user_id', $user->id)
            ->whereIn('status', ['New', 'In Progress'])
            ->count();
        $resolvedComplaints = Complaint::where('user_id', $user->id)
            ->where('status', 'Resolved')
            ->count();
        $recentComplaints = Complaint::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.customer', compact(
            'totalComplaints',
            'activeComplaints',
            'resolvedComplaints',
            'recentComplaints'
        ));
    }
} 