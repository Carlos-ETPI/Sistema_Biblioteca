@extends('base.base')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xl-12">
            {{-- Mostrar mensaje de éxito o error --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Usuarios con Prestamos</h4>
                </div>
                <div class="card-body">
                    {{-- Tabla de ejemplares --}}
                    <table class="table table-bordered dt-responsive nowrap w-100" id="pestamo_table">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Usuario</th>
                                <th>DUI</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Total Préstamos</th>
                                <th>Ejemplares Prestados</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($usuarios as $usuario)
                                <tr>
                                    <td>{{ $usuario->ID_USUARIO }}</td>
                                    <td>{{ $usuario->DUI_PERSONA }}</td>
                                    <td>{{ $usuario->NOMBRE_PERSONA }}</td>
                                    <td>{{ $usuario->APELLIDO_PERSONA }}</td>
                                    <td>{{ $usuario->total_prestamos }}</td>
                                    <td>{{ $usuario->ejemplares_prestados }}</td>
                                    <td>
                                        <a href="{{ url('/prestamo-detalle/'.$usuario->ID_USUARIO) }}" class="btn btn-primary btn-sm">
                                            Ver préstamos
                                        </a>
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
        $('#pestamo_table').DataTable({
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
