@extends('base.base')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Editar Permiso</h4>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>¡Error!</strong> Revisa los siguientes campos:<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.permissions.update', $permission->id) }}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Permiso</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $permission->name) }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Actualizar</button>
                <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection