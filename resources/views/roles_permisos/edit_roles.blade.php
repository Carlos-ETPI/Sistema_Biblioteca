@extends('base.base')

@section('content')
<h3>Editar Roles para {{ $user->name }}</h3>

<form action="{{ route('admin.users.update-roles', $user) }}" method="POST">
    @csrf
    @method('PUT')

    @foreach ($roles as $role)
        <div class="form-check">
            <input 
                type="checkbox" 
                name="roles[]" 
                value="{{ $role->name }}" 
                id="role_{{ $role->id }}" 
                class="form-check-input"
                {{ $user->hasRole($role->name) ? 'checked' : '' }}
            >
            <label class="form-check-label" for="role_{{ $role->id }}">{{ $role->name }}</label>
        </div>
    @endforeach

    <button type="submit" class="btn btn-primary mt-3">Guardar roles</button>
</form>
@endsection
