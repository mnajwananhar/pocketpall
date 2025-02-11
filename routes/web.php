<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('auth/google', [SocialiteController::class, 'googleLogin'])->name('auth.google');
Route::get('auth/google-callback', [SocialiteController::class, 'googleAuthentication'])->name('auth.google-callback');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wallet Routes
    Route::resource('wallets', WalletController::class);

    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');

    // Menangani form submission (Tambah Saldo, Expense, Transfer)
    Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

    // Category Routes
    Route::resource('categories', CategoryController::class)->except(['create', 'edit', 'show']);
});

require __DIR__ . '/auth.php';