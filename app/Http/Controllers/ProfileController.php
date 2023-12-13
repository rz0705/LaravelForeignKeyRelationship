<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,' . auth()->user()->id]            
        ], [
            'name.required' => 'Name is required.',
            'name.max' => 'Name must not exceed 255 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email must be a valid email address.',
            'email.unique' => 'Email already exist.',
        ]);

        auth()->user()->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);

        return redirect()->route('profile')->with('success', 'Details updated successfully!');
    }

    public function updatepassword(Request $request)
    {
        $request->validate([
            'oldpassword' => ['required', function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password)) {
                    $fail('Old password is incorrect.');
                }
            }],
            'password' => ['required', 'confirmed', 'different:oldpassword', 'min:8', ],
        ], [
            'oldpassword.required' => 'Old password is required.',
            'password.required' => 'New password is required.',
            'password.different' => 'New password and old password cannot be the same.',
            'password.min' => 'New password should contain at least 8 characters.',
            'password.confirmed' => 'New password and confirm password do not match.',
        ]
        );

        auth()->user()->update([
            'password' => Hash::make($request->input('newpassword')),
            'oldpassword' => Hash::make($request->input('newpassword')),
        ]);

        return redirect()->route('profile')->with('danger', 'Password updated successfully!');
    }
}
