<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Email (users) -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Correo electrónico')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- DUI_PERSONA (PERSONA) -->
        <div class="mt-4">
            <x-input-label for="dui_persona" :value="__('DUI')" />
            <x-text-input id="dui_persona" class="block mt-1 w-full" type="text" name="dui_persona" required />
            <x-input-error :messages="$errors->get('dui_persona')" class="mt-2" />
        </div>

        <!-- NOMBRE_PERSONA -->
        <div class="mt-4">
            <x-input-label for="nombre_persona" :value="__('Nombre')" />
            <x-text-input id="nombre_persona" class="block mt-1 w-full" type="text" name="nombre_persona" required />
            <x-input-error :messages="$errors->get('nombre_persona')" class="mt-2" />
        </div>

        <!-- APELLIDO_PERSONA -->
        <div class="mt-4">
            <x-input-label for="apellido_persona" :value="__('Apellido')" />
            <x-text-input id="apellido_persona" class="block mt-1 w-full" type="text" name="apellido_persona" required />
            <x-input-error :messages="$errors->get('apellido_persona')" class="mt-2" />
        </div>

        <!-- NACIMIENTO_PERSONA -->
        <div class="mt-4">
            <x-input-label for="nacimiento_persona" :value="__('Fecha de nacimiento')" />
            <x-text-input id="nacimiento_persona" class="block mt-1 w-full" type="date" name="nacimiento_persona" required />
            <x-input-error :messages="$errors->get('nacimiento_persona')" class="mt-2" />
        </div>

        <!-- TELEFONO_PERSONA -->
        <div class="mt-4">
            <x-input-label for="telefono_persona" :value="__('Teléfono')" />
            <x-text-input id="telefono_persona" class="block mt-1 w-full" type="text" name="telefono_persona" required />
            <x-input-error :messages="$errors->get('telefono_persona')" class="mt-2" />
        </div>

        <!-- CARNET -->
        <div class="mt-4">
            <x-input-label for="carnet" :value="__('Carnet')" />
            <x-text-input id="carnet" class="block mt-1 w-full" type="text" name="carnet" required />
            <x-input-error :messages="$errors->get('carnet')" class="mt-2" />
        </div>

        <!-- ROL -->
        <div class="mt-4">
            <x-input-label for="id_rol" :value="__('Rol')" />
            <select name="id_rol" id="id_rol" class="block mt-1 w-full" required>
                <option value="" disabled selected>Seleccione un rol</option>
                <!-- Aquí puedes poner los valores disponibles desde tu base de datos -->
                <option value="PROFESOR">PROFESOR</option>
                <option value="ESTUDIANTE">ESTUDIANTE</option>
                <!-- Agrega más si es necesario -->
            </select>
            <x-input-error :messages="$errors->get('id_rol')" class="mt-2" />
        </div>

        <!-- Password (users) -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

                <!-- Botón de Registro -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('¿Ya estás registrado?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
