<?php

use Livewire\Volt\Volt;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeveringController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\LeverancierController;

Route::get('/', function () {
    return view('welcome');
})->name('home');


// Magazijn Overview
Route::get('magazijn/index', [MagazijnController::class, 'index'])->name('magazijn.index');

// allergeen info
Route::get('/magazijn/{id}/allergeenInfo', [MagazijnController::class, 'allergeenInfo'])->name('magazijn.allergeenInfo');
// Leverancier info
Route::get('/magazijn/{id}/leverantieInfo', [MagazijnController::class, 'leverantieInfo'])->name('magazijn.leverantieInfo');


// Allergeen Overview
Route::get('/allergeen', [AllergeenController::class, 'index'])->name('allergeen.index');

// Allergeen Create
Route::get('/allergeen/create', [AllergeenController::class, 'create'])->name('allergeen.create');
Route::post('/allergeen/store', [AllergeenController::class, 'store'])->name('allergeen.store');

// Allergeen Delete
Route::delete('/allergeen/{id}', [AllergeenController::class, 'destroy'])->name('allergeen.destroy');

// Show edit form
Route::get('/allergeen/{id}/edit', [AllergeenController::class, 'edit'])->name('allergeen.edit');

// Handle update (form submission)
Route::put('/allergeen/{id}', [AllergeenController::class, 'update'])->name('allergeen.update');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::get('/leveringProduct/{id}', [LeveringController::class, 'show'])->name('levering.show');


// leverancier Overview
Route::get('/leverancier/index', [LeverancierController::class, 'index'])->name('leverancier.index');
// Leverancier Show (implicit model binding)
Route::get('/leverancier/{leverancier}', [LeverancierController::class, 'show'])->name('leverancier.show');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__ . '/auth.php';
