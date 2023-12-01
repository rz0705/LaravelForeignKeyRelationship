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

    public function addmember()
    {
        $groups = Group::all();
        // dd($groups);
        return view('members.create', ['groups' => $groups]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'contact' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:10'],
        ]);

        $member = new Member;
        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->contact = $request->input('contact');
        $member->group_id = $request->input('group_id');
        $member->save();
        return redirect('members');
    }

    public function edit($id)
    {
        $groups = Group::all();
        $editid = Member::find($id);
        // dd($editid);
        // return view('members.edit');
        // $members = Member::with('group');
        return view('members.edit', ['editid' => $editid, 'groups' => $groups]);
        // return "Member Edit";
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'contact' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:10'],
        ]);

        $member = Member::find($id);
        // dd($member);
        if (!$member) {
            // Handle the case where the member with the given ID is not found
            return redirect('members')->with('error', 'Member not found');
        }

        $member->name = $request->input('name');
        $member->email = $request->input('email');
        $member->contact = $request->input('contact');
        $member->group_id = $request->input('group_id');
        $member->save();

        return redirect('members')->with('success', 'Member updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $member = Member::find($id);
        // dd($member);
        if (!$member) {
            // Handle the case where the member with the given ID is not found
            return redirect('members')->with('error', 'Member not found');
        }

        $member->delete();
        return redirect('members')->with('success', 'Member deleted successfully');
        // return view('members.confirm-delete', ['member' => $member]);
    }
}
