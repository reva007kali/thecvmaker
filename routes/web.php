<?php

use App\Livewire\CvDataForm;
use App\Livewire\Public\LandingPage;
use Laravel\Fortify\Features;
use App\Livewire\Actions\Logout;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\App\CvBuilder\Form;
use App\Livewire\App\Dashboard\Home;
use App\Livewire\Settings\TwoFactor;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/', LandingPage::class)->name('public.landing.page');


Route::get('/create-cv', function () {
    return redirect()->route('login');
});

Route::post('/logout', Logout::class)->name('logout');

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/cv-form', Form::class)->name('cv.form');

    Route::get('/dashboard', Home::class)->name('dashboard');

    // Route::get('/checkout/{plan}', \App\Livewire\App\Payment\Checkout::class)->name('payment.checkout');

    // Route::get('/cv-form', function () {
    //     return view('cv-form');
    // });

});

Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('google.callback');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('profile.edit');
    Route::get('settings/password', Password::class)->name('user-password.edit');
    Route::get('settings/appearance', Appearance::class)->name('appearance.edit');

    Route::get('settings/two-factor', TwoFactor::class)
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
