<?php

use App\Livewire\DiscoverContent;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Livewire\UserProfile;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('dashboard', DiscoverContent::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
    //  Route::view('discover', 'livewire.discover-content')->name('discover');
});
Route::get('/user/{user}', UserProfile::class)->name('profile.public');

require __DIR__.'/auth.php';
