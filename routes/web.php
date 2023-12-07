<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
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
    Route::get('members', [MemberController::class, 'member'])->name('members');
    Route::get('member/add', [MemberController::class, 'addmember'])->name('addmember');
    Route::post('member/add', [MemberController::class, 'insert'])->name('insert');
    Route::get('member/edit/{id}', [MemberController::class, 'edit'])->name('edit');
    Route::post('member/edit/{id}', [MemberController::class, 'update'])->name('update');
    Route::get('member/delete/{id}', [MemberController::class, 'delete'])->name('delete');

    Route::get('groups', [GroupController::class, 'group'])->name('groups');
    Route::get('group/add', [GroupController::class, 'addgroup'])->name('addgroup');
    Route::post('group/add', [GroupController::class, 'insert'])->name('insertgroup');
    Route::get('group/edit/{id}', [GroupController::class, 'edit'])->name('editgroup');
    Route::post('group/edit/{id}', [GroupController::class, 'update'])->name('updategroup');
    Route::get('group/delete/{id}', [GroupController::class, 'delete'])->name('deletegroup');

    Route::get('dashboard', [HomeController::class, 'index'])->name('home');
    
    Route::get('profile', function () {
        return view('profile');
    })->name("profile");
    Route::get('updateprofile', [ProfileController::class, 'edit'])->name("updateprofile");
    Route::post('updateprofile', [ProfileController::class, 'update'])->name("updateprofile.post");
    Route::post('updatepassword', [ProfileController::class, 'updatepassword'])->name("updatepassword.post");
});

Route::get('/', function () {
    return redirect('/login');
});