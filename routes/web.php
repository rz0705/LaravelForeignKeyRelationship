<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MemberController;
use App\Models\Member;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guard', 'web'])->group(function () {
    //protected
    Route::get('/data', [IndexController::class, 'index']);
    Route::get('/group', [IndexController::class, 'group']);
});


Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return "Welcome To your Profile";
})->name("profile");

Route::get('/login', function () {
    session()->put('user_id', 1);
    return redirect('/');
})->name("login");

Route::get('/logout', function () {
    session()->forget('user_id');
    return redirect('/');
})->name("logout");

Route::get('/no-access', function () {
    echo "You are not allowed to access the page.";
    die;
});

Route::get('/members', [MemberController::class, 'index'])->name('member');


// function () {
//     $members = Member::with('group')->paginate(10);
//     return view('members', ['members' => $members]);
// });
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
