<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Lista todos los permisos con paginación.
     */
    public function index()
    {
        $permissions = Permission::paginate(10);
        return view('roles_permisos.permission_list', compact('permissions'));
    }

    //Muestra el formulario para crear un nuevo permiso.

    public function create()
    {
        return view('roles_permisos.create_permission');
    }

    //Guarda un nuevo permiso en la base de datos.

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:permissions,name|string|max:255',
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permiso creado correctamente.');
    }

    
    // Muestra el formulario de edición de un permiso.

    public function edit(Permission $permission)
    {
        return view('roles_permisos.edit_permission', compact('permission'));
    }

    // Actualiza un permiso existente.
    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        $permission->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.permissions.index')->with('success', 'Permiso actualizado correctamente.');
    }

    
    //Elimina un permiso.
    public function destroy(Permission $permission)
    {
        $permission->delete();

        return redirect()->route('admin.permissions.index')->with('success', 'Permiso eliminado correctamente.');
    }
}
