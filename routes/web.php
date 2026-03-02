<?php

use App\Http\Controllers\ProfileController;
use App\Models\Colocation;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
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

    Route::post('/colocations/{colocation}/invite', [InvitationController::class, 'store'])
     ->name('colocations.invite');


    Route::get('/invitations/accept/{token}', [InvitationController::class, 'accept'])
     ->name('invitations.accept');

     Route::post('/colocations/{colocation}/leave', [ColocationController::class, 'leaveColocation'])
    ->name('colocations.leave');
    Route::post('/colocations/{colocation}/expenses/{expense}/mark-as-paid', [ExpenseController::class, 'markAsPaid'])
        ->name('colocations.expenses.markAsPaid');
        Route::post('/colocations/{colocation}/payments', [PaymentController::class, 'store'])->name('payments.store');

});

require __DIR__.'/auth.php';
