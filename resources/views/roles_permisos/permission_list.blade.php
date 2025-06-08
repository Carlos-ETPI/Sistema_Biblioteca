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
                    <h4 class="card-title">Gestión de Permisos</h4>
                </div>

                <div class="card-body">
                    <div class="text-end mb-3">
                        <a href="{{ route('admin.permissions.create') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-plus"></i> Crear Permiso
                        </a>
                    </div>

                    <table class="table table-bordered dt-responsive nowrap w-100" id="permisos_table">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Guard</th>
                        <th>Acciones</th>
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
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que deseas eliminar este permiso?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($permissions->isEmpty())
                        <tr>
                            <td colspan="4" class="text-center">No hay permisos registrados.</td>
                        </tr>
                    @endif
                </tbody>
            </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#permisos_table').DataTable({
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
    }).buttons().container().appendTo("#permisos_table_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection



