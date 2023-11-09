<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index()
    {
        $members = Member::with('group')->orderByRaw('member_id DESC')->paginate(10);
        return view('members', ['members' => $members]);
    }

    public function add()
    {
        $groups = Group::all();
        // dd($groups);
        return view('members.create', ['groups' => $groups]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email'],
            'contact' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:10','max:10'],
        ]);

        $member = new Member;
        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->contact = $request->input('contact');
        $member->group_id = $request->input('group_id');
        $member->save();
        return redirect('members');
    }
}
