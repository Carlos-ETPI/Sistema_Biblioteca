
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

            <h3>Préstamos activos de: {{ $usuario->NOMBRE_PERSONA }} {{ $usuario->APELLIDO_PERSONA }}</h3>
    <div class="card mt-3">
        <div class="card-body">
            @if(count($prestamos) > 0)
                <ul class="list-group">
                    @foreach($prestamos as $prestamo)
                        <li class="list-group-item">
                            <strong>Título:</strong> {{ $prestamo->NOMBRE_TITULO }} <br>
                            <strong>ID Ejemplar:</strong> {{ $prestamo->ID_EJEMPLAR }} <br>
                            <strong>Fecha Préstamo:</strong> {{ $prestamo->FECHA_PRESTA }} <br>
                            <strong>Fecha Devolución:</strong> {{ $prestamo->FECHA_DEVO }}
                        </li>
                    @endforeach
                </ul>
            @else
                <p>Este usuario no tiene préstamos activos.</p>
            @endif
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ url('/usuarios-prestamos') }}" class="btn btn-secondary mt-3">Volver</a>
                <form method="POST" action="{{ route('despachar.varios') }}">
                    @csrf
                    @foreach($prestamos as $prestamo)
                        <input type="hidden" name="ids[]" value="{{ $prestamo->ID_EJEMPLAR }}">
                    @endforeach
                    <button type="submit" class="btn btn-success mt-3">Despachar todos</button>
                </form>
            </div>
        </div>
    </div>
        </div>
    </div>
</div>


@endsection
