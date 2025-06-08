<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolPermissionController extends Controller
{

    public function index()
    {
        $permissions = Permission::paginate(10);
        $roles = Role::all();
        return view('roles_permisos.rol_permission_list', compact('permissions', 'roles'));
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();

        return view('roles_permisos.edit_role_permission', compact('role', 'permissions', 'rolePermissions'));
    }

    public function update(Request $request, Role $role)
{
    $request->validate([
        'permissions' => 'array',
        'permissions.*' => 'exists:permissions,id',
    ]);

    $permissions = Permission::whereIn('id', $request->permissions ?? [])->pluck('name');
    $role->syncPermissions($permissions);

    return redirect()->route('admin.rol.index')->with('success', 'Permisos del rol actualizados correctamente.');
}

}
