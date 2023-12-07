<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MemberController extends Controller
{
    public function member()
    {
        $group_id = isset($_GET['group']) ? $_GET['group'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';
        $selected_groups_id = explode(",", $group_id);

        $members = Member::with('group')
            ->orderByRaw('member_id DESC')
            ->when($group_id != '' || $search != '', function ($q) use ($selected_groups_id, $search, $group_id) {
                $q->when($group_id != '', function ($subQ) use ($selected_groups_id) {
                    return $subQ->whereIn('group_id', $selected_groups_id);
                })
                    ->when($search != '', function ($subQ) use ($search) {
                        return $subQ->where(function ($subSubQ) use ($search) {
                            // Adjust this based on how you want to perform the search
                            $subSubQ->where('name', 'LIKE', '%' . $search . '%')
                                ->orWhere('email', 'LIKE', '%' . $search . '%')
                                ->orWhere('contact', 'LIKE', '%' . $search . '%')
                                ->orWhere('member_id', 'LIKE', '%' . $search . '%');
                        });
                    });
            })
            ->paginate(10);

        $groups = Group::all();

        return view('members', ['members' => $members, 'groups' => $groups]);
    }

    public function addmember()
    {
        $groups = Group::all();
        return view('members.create', ['groups' => $groups]);
    }

    public function insert(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:members,email', 'email:rfc,dns'],
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
            'email' => ['required', 'email', Rule::unique('members', 'email')->ignore($id, 'member_id'), 'email:rfc,dns'],
            'contact' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:10', 'max:10'],
        ]);

        $member = Member::find($id);
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
        if (!$member) {
            // Handle the case where the member with the given ID is not found
            return redirect('members')->with('error', 'Member not found');
        }

        if($member->exists()){
            return redirect('members')->with('delete', 'Member deleted successfully');
        }

        $member->delete();
    }
}
