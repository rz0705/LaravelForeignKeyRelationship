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
Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('data', [IndexController::class, 'index']);
    Route::get('group', [IndexController::class, 'group']);
    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::get('member/add', [MemberController::class, 'add'])->name('add');
    Route::post('member/add', [MemberController::class, 'insert'])->name('insert');
    
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', function () {
        return view('profile');
    })->name("profile");
});

Route::get('/', function () {
    return view('welcome');
});


