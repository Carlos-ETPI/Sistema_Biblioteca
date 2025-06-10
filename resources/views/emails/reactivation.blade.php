@component('mail::message')
# Hola {{ $user->name }}

Tu cuenta está inactiva. Para reactivarla, haz clic en el siguiente botón:

@component('mail::button', ['url' => route('user.reactivate', ['token' => $user->activation_token])])
Reactivar Cuenta
@endcomponent

Gracias,<br>
Librarium
@endcomponent
