@extends('base.base')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Crear Nuevo Permiso</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.permissions.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Permiso</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="ej. editar usuarios" required>
                </div>

                <button type="submit" class="btn btn-success">Guardar Permiso</button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection
