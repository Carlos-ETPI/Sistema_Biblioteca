<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserRoleController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return view('roles_permisos.user_rol_list', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('roles_permisos.edit_roles', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'roles' => 'array',
            'roles.*' => 'exists:roles,name',
        ]);

        $user->syncRoles($request->input('roles', []));

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Roles actualizados correctamente.');
    }
    public function create()
    {
        return view('roles_permisos.create_roles');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name|min:3',
        ]);

        Role::create(['name' => $request->name]);

        return redirect()->route('admin.users.roles.create')
            ->with('success', 'Rol creado correctamente.');
    }
}
