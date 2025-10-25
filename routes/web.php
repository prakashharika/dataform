<?php

use App\Http\Controllers\FormController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::resource('forms', FormController::class);
    Route::get('/form', [FormController::class, 'index'])->name('form.index');
    Route::get('/records', [FormController::class, 'record'])->name('form.record');
    Route::get('/charts', [FormController::class, 'charts'])->name('form.charts');
    Route::get('/records/{record}', [FormController::class, 'show'])->name('form.show');
    Route::delete('/records/{record}', [FormController::class, 'destroy'])->name('form.destroy');
    Route::post('/form/save', [FormController::class, 'store'])->name('form.store');

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
