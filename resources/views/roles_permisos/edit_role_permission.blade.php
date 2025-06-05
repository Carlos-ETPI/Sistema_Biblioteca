@extends('base.base')

@section('content')
<div class="container">
    <h2>Editar permisos del rol: <strong>{{ $role->name }}</strong></h2>

    @if (session('success'))
        <div class="alert alert-success mt-2">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('admin.roles.update-permissions', $role->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="permissions" class="form-label">Selecciona los permisos:</label>
            <div class="row">
                @foreach ($permissions as $permission)
                    <div class="col-md-4">
                        <div class="form-check">
                            <input 
                                class="form-check-input" 
                                type="checkbox" 
                                name="permissions[]" 
                                value="{{ $permission->id }}" 
                                id="perm_{{ $permission->id }}"
                                {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                            <label class="form-check-label" for="perm_{{ $permission->id }}">
                                {{ $permission->name }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar cambios</button>
        <a href="{{ route('admin.permissions.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
