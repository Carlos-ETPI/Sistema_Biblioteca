@extends('base.base')

@section('content')

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h4>Crear Nuevo Rol</h4>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

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

                <form method="POST" action="{{ route('admin.users.roles.store') }}" novalidate class="needs-validation">
                    @csrf
                    <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                    <div class="invalid-feedback">
                        Por favor, ingresa un nombre válido.
                    </div>
                </div>
                    <button type="submit" class="btn btn-primary">Crear Rol</button>
                </form>
            </div>
        </div>
    </div>

<script>
    window.addEventListener("load", function () {
        
        var t = document.getElementsByClassName("needs-validation");
        Array.prototype.filter.call(t, function (e) {
            e.addEventListener("submit", function (t) {
                !1 === e.checkValidity() && (t.preventDefault(), t.stopPropagation()), e.classList.add("was-validated");
            }, !1);
        });
    }, !1);
</script>
@endsection
