<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\RolPermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/crud', function () {
    return view('crud');
});


Route::prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [UserRoleController::class, 'index'])->name('index');
    Route::get('/roles/create', [UserRoleController::class, 'create'])->name('roles.create');
    Route::post('/', [UserRoleController::class, 'store'])->name('roles.store');
    Route::get('{user}/edit-roles', [UserRoleController::class, 'edit'])->name('edit-roles');
    Route::put('{user}/update-roles', [UserRoleController::class, 'update'])->name('update-roles');
});


// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
//     Route::resource('permissions', RolPermissionController::class)->except(['show']);
    
// });
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('rol', RolPermissionController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/{role}/edit-permissions', [\App\Http\Controllers\Admin\RolPermissionController::class, 'edit'])->name('roles.edit-permissions');
    Route::put('roles/{role}/update-permissions', [\App\Http\Controllers\Admin\RolPermissionController::class, 'update'])->name('roles.update-permissions');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
});

require __DIR__.'/auth.php';
