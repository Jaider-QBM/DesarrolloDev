<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'index']);

Route::get('/login/google', [UserController::class, 'redirectToGoogle'])->name('users.initGoogle');
Route::get('/login/google/callback', [UserController::class, 'handleGoogleCallback']);
Route::get('/form-register', [UserController::class, 'createGoogle'])->name('users.google');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard',  [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/clients', [UserController::class, 'index'])->name('users.index');
    Route::get('/clients/import', [UserController::class, 'importClient'])->name('users.importClient');
    Route::get('/clients/create', [UserController::class, 'create'])->name('users.create');
    Route::get('/clients/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/clients/create', [UserController::class, 'store'])->name('users.store');
    Route::post('/clients/import', [UserController::class, 'import'])->name('users.import');
    Route::put('/clients/edit', [UserController::class, 'update'])->name('clients.update');
    Route::resource('/roles', RoleController::class);
    Route::resource('/permissions', PermissionController::class);

});
