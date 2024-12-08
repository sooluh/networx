<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect(route('filament.studio.auth.login')))->name('entry');
Route::get('/login', fn () => redirect(route('filament.studio.auth.login')))->name('login');
