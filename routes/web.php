<?php
// routes/web.php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

//Route::view('/login', 'login')->name('login');
Route::view('/register', 'register')->name('register');
Route::post('/register', [AuthController::class, 'register']);
