<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Group;

class IndexController extends Controller
{
    //
    public function index()
    {
        // dd(route('data'));

        return Member::with('group')->get();
    }
    public function group()
    {
        return Group::with('member')->get();
    }
}
