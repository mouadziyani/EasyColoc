<?php

use App\Http\Controllers\ProfileController;
use App\Models\Colocation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $owned = $user->colocations;
    $member = $user->memberships->map->colocation;
    $colocations = $owned->merge($member);

    return view('dashboard', compact('colocations'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour les colocations
    Route::resource('colocations', ColocationController::class);

    // Routes pour les dépenses
    Route::resource('colocations.expenses', ExpenseController::class);
    // Routes pour category
    Route::resource('categories', CategoryController::class);

});

require __DIR__.'/auth.php';
