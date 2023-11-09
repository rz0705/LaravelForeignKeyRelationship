<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //
    public function index()
    {
        $members = Member::with('group')->paginate(10);
        return view('members', ['members' => $members]);
    }
}
