<?php

use App\Http\Controllers\DashboardController;
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
    Route::get('/clients/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/clients/create', [UserController::class, 'store'])->name('users.store');
    Route::post('/clients/import', [UserController::class, 'import'])->name('users.import');
    Route::put('/clients/edit/{user}   ', [UserController::class, 'update'])->name('users.update');
    Route::delete('/clients/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::post('/roles/create', [RoleController::class, 'store'])->name('roles.store');
    Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

});
