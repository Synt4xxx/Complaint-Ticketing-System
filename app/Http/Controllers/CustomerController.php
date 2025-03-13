<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $totalComplaints = $user->complaints()->count();
        $activeComplaints = $user->complaints()->whereIn('status', ['New', 'In Progress'])->count();
        $resolvedComplaints = $user->complaints()->where('status', 'Resolved')->count();
        $recentComplaints = $user->complaints()
            ->with('user')
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