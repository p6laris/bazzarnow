<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        // Optional: prevent deleting yourself or other admins
        if ($user->is_admin) {
            return back()->with('status', 'Cannot delete admin users.');
        }

        $user->delete();

        return back()->with('status', 'User deleted.');
    }
}
