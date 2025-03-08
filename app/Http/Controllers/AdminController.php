<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Fetch statistics (you can adjust these queries based on your schema)
        $newComplaintsCount = Ticket::where('status', 'New')->count();
        $activeUsersCount = User::where('status', 'active')->count();

        return view('dashboard.admin', compact('newComplaintsCount', 'activeUsersCount'));
    }

    public function complaints()
    {
        // Fetch all complaints
        $complaints = Ticket::all(); // You can add conditions like 'where status = new' if necessary

        return view('admin.complaints', compact('complaints'));
    }

    public function users()
    {
        // Fetch all users (you can apply additional filters or pagination here if needed)
        $users = User::all(); // or User::paginate(10) for pagination

        return view('admin.users', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required|in:active,inactive',
            // Add other fields as needed
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully');
    }
}
