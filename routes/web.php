<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('/login');
});

Route::controller(VerificationController::class)->group(function() {
    Route::get('/email/verify', 'notice')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify');
    Route::post('/email/resend', 'resend')->name('verification.resend');
});

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [HomeController::class, 'index'])->name('home');

    Route::prefix('member')->group(function () {
        Route::get('add', [MemberController::class, 'addmember'])->name('addmember');
        Route::post('add', [MemberController::class, 'insert'])->name('insert');
        Route::get('edit/{id}', [MemberController::class, 'edit'])->name('edit');
        Route::post('edit/{id}', [MemberController::class, 'update'])->name('update');
        Route::get('delete/{id}', [MemberController::class, 'delete'])->name('delete');
    });
    Route::get('members', [MemberController::class, 'member'])->name('members');

    Route::prefix('group')->group(function () {
        Route::get('add', [GroupController::class, 'addgroup'])->name('addgroup');
        Route::post('add', [GroupController::class, 'insert'])->name('insertgroup');
        Route::get('edit/{id}', [GroupController::class, 'edit'])->name('editgroup');
        Route::post('edit/{id}', [GroupController::class, 'update'])->name('updategroup');
        Route::get('delete/{id}', [GroupController::class, 'delete'])->name('deletegroup');
    });
    Route::get('groups', [GroupController::class, 'group'])->name('groups');

    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::post('updateprofile', [ProfileController::class, 'update'])->name('updateprofile.post');
    Route::post('updatepassword', [ProfileController::class, 'updatepassword'])->name('updatepassword.post');
});
