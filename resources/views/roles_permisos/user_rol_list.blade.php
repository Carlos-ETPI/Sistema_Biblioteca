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
                    <h4 class="card-title">Gestión de Usuarios</h4>
                </div>

                <div class="card-body">
                    <table class="table table-bordered dt-responsive nowrap w-100" style="width:100%" id="tabla_usuarios">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">ID</th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Roles</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            <span class="badge bg-primary">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.edit-roles', $user->id) }}" class="btn btn-sm btn-warning" >
                                            Asignar Roles
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="mt-3">
                        {{ $users->links() }} {{-- Paginación --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#tabla_usuarios').DataTable({
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
        // buttons: [
        //     {
        //         extend: 'copy',
        //         text: 'Copiar',
        //         exportOptions: {
        //             columns: [0, 1 ]
        //         },
        //     },
        //     {
        //         extend: 'excel',
        //         text: 'Excel',
        //         exportOptions: {
        //             columns: [0, 1]
        //         },
        //         title: '',
        //     },
            
        // ],
        
    }).buttons().container().appendTo("#tabla_usuarios_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection
