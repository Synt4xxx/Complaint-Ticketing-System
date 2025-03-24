<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        $totalComplaints = Complaint::count();
        $activeComplaints = Complaint::whereIn('status', ['New', 'In Progress'])->count();
        $resolvedComplaints = Complaint::where('status', 'Resolved')->count();
        $totalUsers = User::count();
        $recentComplaints = Complaint::latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalComplaints',
            'activeComplaints',
            'resolvedComplaints',
            'totalUsers',
            'recentComplaints'
        ));
    }

    public function customer()
    {
        if (!Auth::check()) {
            abort(403, 'Unauthorized access');
        }

        $user = Auth::user();
        
        // Fetch complaints from DB (not from Collection)
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
