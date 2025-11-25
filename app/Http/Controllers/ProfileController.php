<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Show the profile edit page.
     */
    public function edit(Request $request)
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information (name, email, avatar).
     */
    public function update(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:255'],
            'email'  => ['required', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'], // 2MB
        ]);

        $user->name  = $validated['name'];
        $user->email = $validated['email'];

        // handle avatar upload
        if ($request->hasFile('avatar')) {
            if ($user->profile_image_path) {
                Storage::disk('public')->delete($user->profile_image_path);
            }

            $path = $request->file('avatar')->store('avatars', 'public');
            $user->profile_image_path = $path;
        }

        $user->save();

        return back()->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'password' => ['required'],
        ]);

        if (! Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return back()->withErrors(['password' => 'Password is incorrect.']);
        }

        Auth::logout();

        if ($user->profile_image_path) {
            Storage::disk('public')->delete($user->profile_image_path);
        }

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('products.index');
    }
}
