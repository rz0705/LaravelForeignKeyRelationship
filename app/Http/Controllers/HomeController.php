<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        DB::connection()->enableQueryLog();
        $search = 'M';

        // Find groups with names containing 'W'
        // $matching_groups = Group::where('name', 'LIKE', "%{$search}%")->pluck('group_id');

        // Find members whose group_id is in the matching group_ids
        $users = Member::whereHas('group', function ($query) use($search) {
            $query->where('name', 'like', '%'.$search.'%');
        })->with('group')->get();

        $html = '<ul>';
        foreach ($users as $key => $user) {
            $html .= "<li><b>NAME: </b> $user->name   |    ";
            $html .= "<b>GROUP: </b> " . $user->group->name . " </li>";
            $html .= "<b>DESCRIPTION: </b> " . $user->group->description . " </li>";
        }
        $html .= '</ul>';

        $queries = DB::getQueryLog();
        // dd($queries);

        return view('dashboard');
    }
}
