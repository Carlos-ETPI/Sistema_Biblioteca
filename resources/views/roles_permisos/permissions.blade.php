
@extends('base.base')

@section('content')
<div class="row">
    <div class="col-12">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        @endif

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Lista de Permisos</h4>
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">Crear Permiso</a>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tabla_permisos">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Guard</th>
                            <th data-priority="1">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td>
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    {{-- Botón eliminar si lo deseas --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3">
                    {{ $permissions->links() }}
                </div>
            </div>
        </div>

        {{-- Sección de Roles --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-0">Lista de Roles</h4>
            <a href="{{ route('admin.users.roles.create') }}" class="btn btn-sm btn-primary">Crear Rol</a>
        </div>
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped" id="tabla_permisos">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Permisos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach($role->permissions as $perm)
                                        <span class="badge bg-info text-dark">{{ $perm->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <a href="{{ route('admin.roles.edit-permissions', $role->id) }}" class="btn btn-sm btn-warning">
                                        Editar
                                    </a>
                                    {{-- Botón eliminar si lo deseas --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<script>
    $(document).ready(function () {
        $('#tabla_permisos').DataTable({
            paging: false,
            searching: false,
            info: false,
            ordering: false
            responsive: {
                details: {
                    type: 'inline',
                }
            },
        });
        
    });
</script>
@endsection




