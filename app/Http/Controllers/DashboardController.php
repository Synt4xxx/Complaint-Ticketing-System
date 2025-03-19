<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User; // Make sure to include this
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function admin()
    {
        // Fetch total complaints
        $totalComplaints = Complaint::count();

        // Fetch active complaints (status 'New' or 'In Progress')
        $activeComplaints = Complaint::whereIn('status', ['New', 'In Progress'])->count();

        // Fetch resolved complaints
        $resolvedComplaints = Complaint::where('status', 'Resolved')->count();

        // Fetch total users
        $totalUsers = User::count();

        // Fetch recent complaints (latest 5)
        $recentComplaints = Complaint::latest()->take(5)->get();

        // Pass data to the view
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
        $user = Auth::user();
    
        // Fetch complaints belonging to the logged-in user
        $customerComplaints = Complaint::where('user_id', $user->id)->get();
    
        // Fetch complaint statistics
        $totalComplaints = $customerComplaints->count();
        $activeComplaints = $customerComplaints->whereIn('status', ['New', 'In Progress'])->count();
        $resolvedComplaints = $customerComplaints->where('status', 'Resolved')->count();
    
        // Fetch the latest 5 complaints
        $recentComplaints = $customerComplaints->sortByDesc('created_at')->take(5);
    
        return view('dashboard.customer', compact(
            'customerComplaints',
            'totalComplaints',
            'activeComplaints',
            'resolvedComplaints',
            'recentComplaints'
        ));
    }
    
}
