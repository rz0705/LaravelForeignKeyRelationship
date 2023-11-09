<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Group;

class IndexController extends Controller
{
    //
    public function index(Request $request)
    {
        $sort = $request->input('sort', 'asc');
        $members = Member::with('group')->orderBy('member_id', $sort)->paginate(10);
        return view('members.index', compact('members'));
    }

    public function group()
    {
        $groups = Group::with('member')->paginate(10);
        return view('groups', compact('groups'));
    }
}
