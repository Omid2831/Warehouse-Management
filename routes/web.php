<?php

use Livewire\Volt\Volt;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeveringController;
use App\Http\Controllers\MagazijnController;
use App\Http\Controllers\AllergeenController;
use App\Http\Controllers\LeverancierController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
});

// ADMIN ROUTES ONLY
Route::middleware(['auth', 'role:admin'])
    ->group(function () {

    /*
    |--------------------------------------------------
    | Magazijn
    |--------------------------------------------------
    */
        Route::prefix('magazijn')->as('magazijn.')->group(function () {
            Route::get('/', [MagazijnController::class, 'index'])->name('index');
            Route::get('{id}/allergeen-info', [MagazijnController::class, 'allergeenInfo'])->name('allergeenInfo');
            Route::get('{id}/leverantie-info', [MagazijnController::class, 'leverantieInfo'])->name('leverantieInfo');
        });

    /*
    |--------------------------------------------------
    | Allergeen (CRUD)
    |--------------------------------------------------
    */
        Route::prefix('allergeen')->as('allergeen.')->group(function () {
            Route::get('/', [AllergeenController::class, 'index'])->name('index');
            Route::get('create', [AllergeenController::class, 'create'])->name('create');
            Route::post('/', [AllergeenController::class, 'store'])->name('store');
            Route::get('{id}/edit', [AllergeenController::class, 'edit'])->name('edit');
            Route::put('{id}', [AllergeenController::class, 'update'])->name('update');
            Route::delete('{id}', [AllergeenController::class, 'destroy'])->name('destroy');
        });

    /*
    |--------------------------------------------------
    | Leverancier
    |--------------------------------------------------
    */
        Route::prefix('leverancier')->as('leverancier.')->group(function () {
            Route::get('/', [LeverancierController::class, 'index'])->name('index');
            Route::get('{leverancier}', [LeverancierController::class, 'show'])->name('show');
        });

    /*
    |--------------------------------------------------
    | Levering
    |--------------------------------------------------
    */
        Route::prefix('levering')->as('levering.')->group(function () {
            Route::get('{id}', [LeveringController::class, 'show'])->name('show');
            Route::post('{id}', [LeveringController::class, 'store'])->name('store');
        });
    });

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
