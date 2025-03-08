<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch statistics (you can adjust these queries based on your schema)
        $newComplaintsCount = Ticket::where('status', 'New')->count();
        $activeUsersCount = User::where('status', 'active')->count();

        return view('dashboard.admin', compact('newComplaintsCount', 'activeUsersCount'));
    }
}
