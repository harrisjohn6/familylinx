<?php

use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\InviteFamilyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FamilyTreeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/invite-family', [InviteFamilyController::class, 'create'])->name('invite-family');
    Route::patch('/invite/family', [InviteFamilyController::class, 'sendInvite'])->name('invite-family.send');
    Route::get('/family-tree', [FamilyTreeController::class,'buildFamilyTree']);
});

Route::patch('/profile/photo', [ProfilePhotoController::class, 'update'])->name('profile.photo');

require __DIR__ . '/auth.php';
