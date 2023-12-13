<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddGroupRequest;
use App\Http\Requests\EditGroupRequest;
use App\Models\Group;

class GroupController extends Controller
{
    public function group(Request $request)
    {
        $search = $request->get('search');
        $query = Group::query();
        
        if ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%');
        }
        $groups = $query->paginate(10);

        return view('groups', ['groups' => $groups, 'search' => $search]);
    }

    public function addgroup(Request $request)
    {
        $sort = $request->input('sort', 'asc');
        $groups = Group::orderBy('group_id', $sort)->paginate(10);
        return view('groups.create', compact('groups'));
    }

    public function insert(AddGroupRequest $request)
    {
        $group = new Group;
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();
        return redirect('groups');
    }

    public function edit($id)
    {
        $editid = Group::find($id);
        return view('groups.edit', ['editid' => $editid]);
    }

    public function update(EditGroupRequest $request, $id)
    {
        $group = Group::find($id);
        if (!$group) {
            // Handle the case where the group with the given ID is not found
            return redirect('groups')->with('error', 'Group not found');
        }

        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->save();

        return redirect('groups')->with('success', 'Group updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $group = Group::find($id);
        if (!$group) {
            // Handle the case where the group with the given ID is not found
            return redirect('groups')->with('error', 'group not found');
        }

        // Check if the group has any members
        if($group->members()->exists()){
            return redirect('groups')->with('exist', 'Members exist in the group.');
        }

        $group->delete();
        return redirect('groups')->with('success', 'Group deleted successfully');
    }
}