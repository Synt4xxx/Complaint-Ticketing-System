<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
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
        $complaints = Complaint::with('user')->paginate(10);
        return view('admin.complaints', compact('complaints'));
    }

    public function showComplaint($id)
    {
        $complaint = Complaint::with('user')->findOrFail($id);
        return view('admin.complaint-show', compact('complaint'));
    }

    public function destroy($id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();

        return redirect()->route('admin.complaints')->with('success', 'Complaint deleted successfully.');
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
        // Prevent admin from changing their own role
        if (auth()->id() === $user->id && $request->role !== 'admin') {
            return redirect()->back()->with('error', 'You cannot change your own role.');
        }

        // Validate user input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required|in:active,inactive',
            'role' => 'required|in:admin,customer,support_staff',
            'password' => 'nullable|min:8|confirmed', // Password is optional but must be confirmed
        ]);

        // Update user details
        $user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'role' => $validated['role'],
        ]);

        // If password is provided, update it
        if (!empty($validated['password'])) {
            $user->update([
                'password' => Hash::make($validated['password']),
            ]);
        }

        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
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

    public function adminIndex()
    {
        $complaints = Complaint::orderBy('created_at', 'desc')->paginate(10);
        $supportStaff = User::where('role', 'support_staff')->get(); // Fetch support staff correctly
        return view('admin.complaints', compact('complaints', 'supportStaff'));
    }

    public function assign(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);

        // Validate the request
        $request->validate([
            'support_id' => 'required|exists:users,id'
        ]);

        // Ensure the assigned user is a support staff
        $supportUser = User::where('id', $request->support_id)
            ->where('role', 'support_staff')
            ->first();

        if (!$supportUser) {
            return redirect()->back()->with('error', 'Invalid support staff selection.');
        }

        // Assign complaint to support staff
        $complaint->support_id = $request->support_id;
        $complaint->save();

        return redirect()->back()->with('success', 'Complaint assigned successfully.');
    }

    public function assignSupport(Request $request, $id)
    {
        $complaint = Complaint::findOrFail($id);
        $complaint->support_id = $request->support_id;
        $complaint->save();

        return response()->json(['success' => true, 'message' => 'Complaint assigned successfully!']);
    }
}
