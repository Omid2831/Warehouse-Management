# Web Routes

## Magazijn Routes

```php
// Magazijn Overview
Route::get('magazijn/index', [MagazijnController::class, 'index'])->name('magazijn.index');

// Allergeen info
Route::get('/magazijn/{id}/allergeenInfo', [MagazijnController::class, 'allergeenInfo'])->name('magazijn.allergeenInfo');

// Leverancier info
Route::get('/magazijn/{id}/leverantieInfo', [MagazijnController::class, 'leverantieInfo'])->name('magazijn.leverantieInfo');
```

## Allergeen Routes

```php
// Allergeen Overview
Route::get('/allergeen', [AllergeenController::class, 'index'])->name('allergeen.index');

// Allergeen Create
Route::get('/allergeen/create', [AllergeenController::class, 'create'])->name('allergeen.create');
Route::post('/allergeen/store', [AllergeenController::class, 'store'])->name('allergeen.store');

// Allergeen Delete
Route::delete('/allergeen/{id}', [AllergeenController::class, 'destroy'])->name('allergeen.destroy');

// Allergeen Edit
Route::get('/allergeen/{id}/edit', [AllergeenController::class, 'edit'])->name('allergeen.edit');
Route::put('/allergeen/{id}', [AllergeenController::class, 'update'])->name('allergeen.update');
```

## Dashboard

```php
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
```

## Levering Routes

```php
Route::get('/leveringProduct/{id}', [LeveringController::class, 'show'])->name('levering.show');
Route::post('/leveringProduct/{id}', [LeveringController::class, 'store'])->name('levering.store');
```

## Leverancier Routes

```php
// Leverancier Overview
Route::get('/leverancier/index', [LeverancierController::class, 'index'])->name('leverancier.index');

// Leverancier Show
Route::get('/leverancier/{leverancier}', [LeverancierController::class, 'show'])->name('leverancier.show');
```
