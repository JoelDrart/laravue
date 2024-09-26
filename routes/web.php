<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [HomeController::class, 'index'] )->name('home');
Route::get('dashboard', [HomeController::class, 'dashboard'] )->name('dashboard');


Route::get('about', [HomeController::class, 'about'] )->name('about');

Route::get('register',[RegisterController::class, 'index'])->name('register');

Route::post('register',[AuthController::class, 'register'])->name('register.register');

Route::get('login',[LoginController::class, 'index'])->name('login');

Route::post('login',[AuthController::class, 'login'])->name('login.login');

Route::post('logout',[AuthController::class, 'logout'])->name('logout');
