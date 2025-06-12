@extends('base.base')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 col-lg-6">
            <form method="POST" action="{{ route('register') }}" novalidate class="needs-validation">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- DUI -->
                <div class="mb-3">
                    <label for="dui_persona" class="form-label">DUI</label>
                    <input type="text" class="form-control" id="dui_persona" name="dui_persona" required>
                    @error('dui_persona') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Nombre -->
                <div class="mb-3">
                    <label for="nombre_persona" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre_persona" name="nombre_persona" required>
                    @error('nombre_persona') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Apellido -->
                <div class="mb-3">
                    <label for="apellido_persona" class="form-label">Apellido</label>
                    <input type="text" class="form-control" id="apellido_persona" name="apellido_persona" required>
                    @error('apellido_persona') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Fecha de nacimiento -->
                <div class="mb-3">
                    <label for="nacimiento_persona" class="form-label">Fecha de nacimiento</label>
                    <input type="date" class="form-control" id="nacimiento_persona" name="nacimiento_persona" required>
                    @error('nacimiento_persona') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Teléfono -->
                <div class="mb-3">
                    <label for="telefono_persona" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="telefono_persona" name="telefono_persona" required>
                    @error('telefono_persona') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Carnet -->
                <div class="mb-3">
                    <label for="carnet" class="form-label">Carnet</label>
                    <input type="text" class="form-control" id="carnet" name="carnet" required>
                    @error('carnet') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Rol -->
                <div class="mb-3">
                    <label for="id_rol" class="form-label">Rol</label>
                    <select class="form-select" id="id_rol" name="id_rol" required>
                        <option value="" disabled selected>Seleccione un rol</option>
                        <option value="PROFESOR">PROFESOR</option>
                        <option value="ESTUDIANTE">ESTUDIANTE</option>
                    </select>
                    @error('id_rol') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Contraseña -->
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                    @error('password') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Confirmar contraseña -->
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation') <div class="text-danger mt-1">{{ $message }}</div> @enderror
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>

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
