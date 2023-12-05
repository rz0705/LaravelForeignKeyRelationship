<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
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
Auth::routes();

Route::middleware(['auth'])->group(function () {
    // Route::get('data', [IndexController::class, 'index'])->name('data');
    Route::get('group', [IndexController::class, 'group'])->name('group');
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::get('member/add', [MemberController::class, 'addmember'])->name('addmember');
    Route::post('member/add', [MemberController::class, 'insert'])->name('insert');
    Route::get('member/edit/{id}', [MemberController::class, 'edit'])->name('edit');
    Route::post('member/edit/{id}', [MemberController::class, 'update'])->name('update');
    Route::get('member/delete/{id}', [MemberController::class, 'delete'])->name('delete');
    // Route::delete('member/{id}', [MemberController::class, 'destroy'])->name('members.destroy');

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', function () {
        return view('profile');
    })->name("profile");
    Route::get('updateprofile', [ProfileController::class, 'edit'])->name("updateprofile");
    Route::post('updateprofile', [ProfileController::class, 'update'])->name("updateprofile.post");
});

Route::get('/', function () {
    return redirect('/login');
});


