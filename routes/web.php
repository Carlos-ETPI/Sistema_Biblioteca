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

// Route::get('/crud', function () {
//     return view('crud');
// });


Route::prefix('admin/users')->middleware('auth')->name('admin.users.')->group(function () {
    Route::middleware('can:ver roles usuarios')->get('/', [UserRoleController::class, 'index'])->name('index');
    Route::middleware('can:crear rol')->get('/roles/create', [UserRoleController::class, 'create'])->name('roles.create');
    Route::middleware('can:crear rol')->post('/', [UserRoleController::class, 'store'])->name('roles.store');
    Route::middleware('can:asignar roles usuarios')->get('{user}/edit-roles', [UserRoleController::class, 'edit'])->name('edit-roles');
    Route::middleware('can:asignar roles usuarios')->put('{user}/update-roles', [UserRoleController::class, 'update'])->name('update-roles');
    Route::middleware('can:desactiva usuario')->patch('{user}/toggle-active', [UserRoleController::class, 'toggleActive'])->name('toggle-active');
});



// Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
//     Route::resource('permissions', RolPermissionController::class)->except(['show']);
    
// });
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::middleware('can:ver roles')->resource('rol', RolPermissionController::class)->except(['show']);
    Route::middleware('can:ver roles')->resource('roles', RoleController::class)->except(['show']);
    Route::middleware('can:editar permisos rol')->get('roles/{role}/edit-permissions', [\App\Http\Controllers\Admin\RolPermissionController::class, 'edit'])->name('roles.edit-permissions');
    Route::middleware('can:actualizar permisos rol')->put('roles/{role}/update-permissions', [\App\Http\Controllers\Admin\RolPermissionController::class, 'update'])->name('roles.update-permissions');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::middleware('can:ver permisos')->resource('permissions', PermissionController::class)->except(['show']);
    Route::middleware('can:crear permisos')->get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::middleware('can:guardar permisos')->post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::middleware('can:actualizar permisos')->get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
});
Route::get('/reactivate/{token}', [ActivationController::class, 'reactivate'])->name('user.reactivate');

Route::middleware('auth')->group(function () {
    Route::middleware('can:ver ejemplares disponibles')->get('/ejemplares-disponibles', [PrestamoController::class, 'ejemplaresDisponibles'])->name('ejemplares.disponibles');;
    Route::middleware('can:registrar prestamo')->post('/registrar-prestamo', [PrestamoController::class, 'registrarPrestamo'])->name('registrar.prestamo');
    Route::middleware('can:ver usuarios prestamo')->get('/usuarios-prestamos', [PrestamoController::class, 'mostrarUsuariosConPrestamos'])->name('usuarios.prestamos');;
    Route::middleware('can:ver detalle prestamo')->get('/prestamo-detalle/{id_usuario}', [PrestamoController::class, 'mostrarPrestamosPorUsuario'])->name('prestamo.detalle');
    Route::middleware('can:despachar ejemplares')->post('/despachar-varios', [PrestamoController::class, 'despacharVarios'])->name('despachar.varios');

    // Gestionar prestamos
    Route::get('/gestionar-prestamos', [PrestamoController::class, 'gestionar_prestamos'])->name('prestamo.gestionar_prestamos');
    // Devolver prestamos
    Route::get('/devolver-prestamo/{ID_PRESTA}', [PrestamoController::class, 'devolver_prestamo'])->name('prestamo.devolver_prestamo');

});


require __DIR__.'/auth.php';
