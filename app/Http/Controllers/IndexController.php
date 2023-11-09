<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Group;

class IndexController extends Controller
{
    //
    // public function index()
    // {
    //     $members = Member::with('group')->paginate(10);
    //     dd($members);
    //     return view('members.index', compact('members'));
    // }

    // public function group()
    // {
    //     $groups = Group::with('member')->paginate(10);
    //     dd($groups);

    //     return view('groups.index', compact('groups'));
    // }
}
