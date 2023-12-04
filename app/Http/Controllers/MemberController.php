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
        $group_id= isset($_GET['group']) ? $_GET['group'] : '';
        $selected_groups_id = explode(",", $group_id);

        // dd($group_id);
        $members = Member::with('group')->orderByRaw('member_id DESC')->when($group_id != '', function ($q) use($selected_groups_id){
            return $q->whereIn('group_id', $selected_groups_id);
        })->paginate(10);
        $groups = Group::all();

        return view('members', ['members' => $members], ['groups' => $groups]);
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
        return view('members.edit', ['editid' => $editid, 'groups' => $groups]);
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
