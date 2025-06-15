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
                    <h4 class="card-title">GESTION DE PRESTAMOS</h4>
                </div>
                <div class="card-body">
                    {{-- Tabla de ejemplares --}}
                    <table class="table table-bordered dt-responsive nowrap w-100" id="prestamo_table">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Usuario</th>
                                <th>ID Persona</th>
                                <th>ID Préstamo</th>
                                <th>DUI</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>ID Ejemplar</th>
                                <th>Título</th>
                                <th>ACCION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coleccion as $usuario)
                                <tr>
                                    <td>{{ $usuario->ID_USUARIO }}</td>
                                    <td>{{ $usuario->ID_PERSONA }}</td>
                                    <td>{{ $usuario->ID_PRESTA }}</td>
                                    <td>{{ $usuario->DUI_PERSONA }}</td>
                                    <td>{{ $usuario->NOMBRE_PERSONA }}</td>
                                    <td>{{ $usuario->APELLIDO_PERSONA }}</td>
                                    <td>{{ $usuario->ID_EJEMPLAR }}</td>
                                    <td>{{ $usuario->NOMBRE_TITULO }}</td>
                                    <td>
                                        <a href="{{ url('/devolver-prestamo/'.$usuario->ID_PRESTA) }}" class="btn btn-sm btn-primary">
                                            DEVOLVER EJEMPLAR
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
        $('#prestamo_table').DataTable({
            autoWidth: false,
            paging: true,
            ordering: true,
            pagingType: "full_numbers",
            lengthMenu: [
                [25, 50, 100, -1],
                [25, 50, 100, "Todos"]
            ],
            responsive: {
                details: {
                    type: 'inline',
                }
            },
        });
    });
</script>
@endsection
