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
                    <h4 class="card-title">Lista de Ejemplares Disponibles</h4>
                </div>
                <div class="card-body">
                    {{-- Tabla de ejemplares --}}
                    <table class="table table-bordered dt-responsive nowrap w-100" id="pestamo_table">
                        <thead class="table-dark">
                            <tr>
                                <th>ID Ejemplar</th>
                                <th>Título</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Autores</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ejemplares as $ejemplar)
                                <tr>
                                    <td>{{ $ejemplar->ID_EJEMPLAR }}</td>
                                    <td>{{ $ejemplar->NOMBRE_TITULO }}</td>
                                    <td>{{ $ejemplar->NOM_CATEGORIA }}</td>
                                    <td>{{ $ejemplar->DESCRIPCION_CATEGORIA }}</td>
                                    <td>{{ $ejemplar->AUTORES }}</td>
                                    <td>
                                        <form action="{{ route('registrar.prestamo') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="id_ejemplar" value="{{ $ejemplar->ID_EJEMPLAR }}">
                                            <input type="hidden" name="id_costo" value="1"> {{-- Ajusta según lógica real --}}
                                            <div class="input-group">
                                                <input type="number" name="dias_prestamo" class="form-control" placeholder="Días" min="1" max="30" required>
                                                <button type="submit" class="btn btn-primary">Prestar</button>
                                            </div>
                                        </form>
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
    }).buttons().container().appendTo("#pestamo_table_wrapper .col-md-6:eq(0)");
    });
</script>
@endsection
