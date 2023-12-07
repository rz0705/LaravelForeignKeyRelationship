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
                    $fail('The old password is incorrect.');
                }
            }],
            'newpassword' => ['required', 'different:oldpassword', 'min:8', 'confirmed'],
            'newpassword_confirmation' => ['required', 'same:newpassword']
        ]);

        auth()->user()->update([
            'password' => Hash::make($request->input('newpassword')),
            'oldpassword' => Hash::make($request->input('newpassword')),
        ]);

        return redirect()->route('profile')->with('danger', 'Password updated successfully!');
    }
}
