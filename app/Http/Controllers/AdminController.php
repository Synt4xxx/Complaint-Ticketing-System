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
        $totalComplaintsCount = Ticket::count();
        $activeUsersCount = User::where('status', 'active')->count();
        $totalUsersCount = User::count();

        return view('dashboard.admin', compact(
            'newComplaintsCount',
            'totalComplaintsCount',
            'activeUsersCount',
            'totalUsersCount'
        ));
    }

    public function complaints()
    {
        $complaints = Ticket::with('user')->paginate(10); // Paginate for better performance
        return view('admin.complaints', compact('complaints'));
    }
    
    

    public function users()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.users', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        // Check if admin is trying to change their own role
        if (auth()->id() === $user->id && $request->role !== 'admin') {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:admin,customer,support_staff',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users')
            ->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        // Prevent self-deletion
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        try {
            $user->delete();
            return back()->with('success', 'User deleted successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete user.');
        }
    }
}
