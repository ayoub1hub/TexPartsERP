<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::view('/dashboard', 'components.⚡dashboard')
    ->middleware('auth')
    ->name('dashboard');