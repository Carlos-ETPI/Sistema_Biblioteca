<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Admin\RolPermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\ActivationController;
use App\Http\Controllers\PrestamoController;

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
    Route::patch('{user}/toggle-active', [UserRoleController::class, 'toggleActive'])->name('toggle-active');
});


// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
//     Route::resource('permissions', RolPermissionController::class)->except(['show']);
    
// });
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('rol', RolPermissionController::class)->except(['show']);
    Route::resource('roles', RoleController::class)->except(['show']);
    Route::get('roles/{role}/edit-permissions', [\App\Http\Controllers\Admin\RolPermissionController::class, 'edit'])->name('roles.edit-permissions');
    Route::put('roles/{role}/update-permissions', [\App\Http\Controllers\Admin\RolPermissionController::class, 'update'])->name('roles.update-permissions');
});

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('permissions', PermissionController::class)->except(['show']);
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
});
Route::get('/reactivate/{token}', [ActivationController::class, 'reactivate'])->name('user.reactivate');

Route::middleware('auth')->group(function () {
    Route::get('/ejemplares-disponibles', [PrestamoController::class, 'ejemplaresDisponibles'])->name('ejemplares.disponibles');;
    Route::post('/registrar-prestamo', [PrestamoController::class, 'registrarPrestamo'])->name('registrar.prestamo');
    Route::get('/usuarios-prestamos', [PrestamoController::class, 'mostrarUsuariosConPrestamos'])->name('usuarios.prestamos');;
    Route::get('/prestamo-detalle/{id_usuario}', [PrestamoController::class, 'mostrarPrestamosPorUsuario'])->name('prestamo.detalle');
    Route::post('/despachar-varios', [PrestamoController::class, 'despacharVarios'])->name('despachar.varios');
});


require __DIR__.'/auth.php';
