<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FamilyTreeController;
use App\Http\Controllers\InviteFamilyController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

    Route::get('/invite-family', [InviteFamilyController::class, 'getInviteForm'])->name('invite-family');
    Route::patch('/invite/family', [InviteFamilyController::class, 'postSendInvite'])->name('invite-family.send');
    Route::get('/family-tree', [FamilyTreeController::class, 'getFamilyTree'])->name('family-tree');
    Route::post('/family-tree/add-member', [FamilyTreeController::class, 'postAddFamilyTreeMember']);
    Route::get('/go-family-tree', [FamilyTreeController::class, 'getGoJsFamilyTree'])->name('go-family-tree');
});

Route::patch('/profile/photo', [ProfilePhotoController::class, 'update'])->name('profile.photo');

Route::get('/birthdays', [Controller::class, 'getBirthdays'])->middleware('auth');

Route::get('/get-relationships', [FamilyTreeController::class, 'getRelationships']);




require __DIR__ . '/auth.php';
