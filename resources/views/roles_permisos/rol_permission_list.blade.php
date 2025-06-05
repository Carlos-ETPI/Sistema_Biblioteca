@extends('base.base')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Gestión de Roles</h4>
                </div>

                <div class="card-body">
                    <div class="text-end mb-3">
                        <a href="{{ route('admin.users.roles.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Crear Rol
                        </a>
                    </div>

                    <table class="table table-bordered dt-responsive nowrap w-100" id="roles_table">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ route('admin.roles.edit-permissions', $role->id) }}" class="btn btn-sm btn-warning">
                                        Asignar Permisos
                                    </a>
                                    {{-- Puedes agregar botones para editar o eliminar roles si quieres --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#roles_table').DataTable({
            autoWidth: false,
        paging: true,
        ordering: true,
        "pagingType": "full_numbers",
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ],
        responsive: {
            details: {
                type: 'inline',
            }
        },
    }).buttons().container().appendTo("#roles_table_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection
