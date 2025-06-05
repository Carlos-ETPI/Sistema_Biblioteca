<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    // Listar roles
    public function index()
    {
        $roles = Role::paginate(10);
        return view('admin.roles.index', compact('roles'));
    }

    // Mostrar formulario para asignar permisos a un rol
    public function editPermissions(Role $role)
    {
        $permissions = Permission::all();
        return view('admin.roles.edit-permissions', compact('role', 'permissions'));
    }

    // Actualizar permisos asignados a un rol
    public function updatePermissions(Request $request, Role $role)
    {
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name',
        ]);

        $role->syncPermissions($request->input('permissions', []));

        return redirect()->route('admin.roles.index')->with('success', 'Permisos actualizados correctamente.');
    }
}
