<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Persona;
use App\Models\Carnet;
use App\Models\Usuario;
use App\Models\Rol;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'dui_persona' => ['required', 'string', 'size:10', 'unique:PERSONA,DUI_PERSONA'],
        'nombre_persona' => ['required', 'string', 'max:50'],
        'apellido_persona' => ['required', 'string', 'max:50'],
        'nacimiento_persona' => ['required', 'date'],
        'telefono_persona' => ['required', 'string', 'max:10'],
        'carnet' => ['required', 'string', 'max:50','unique:CARNET,CARNET'],
        'id_rol' => ['required', 'string'],
        ], 
        [   'email.unique' => 'El email ingresado ya está registrado en el sistema.',
            'dui_persona.unique' => 'El DUI ingresado ya está registrado en el sistema.',
            'carnet.unique' => 'El carnet ingresado ya está registrado en el sistema.',
    ]);
    


        // 1. Validar rol
    $rol = Rol::where('DESC_ROL', $request->id_rol)->first();
    if (!$rol) {
        // Si no existe, lo creas (opcional)
        $rol = Rol::create(['DESC_ROL' => $request->id_rol]);
    }   

        // 2. Crear persona
    $persona = Persona::create([
        'NOMBRE_PERSONA' => $request->nombre_persona,
        'APELLIDO_PERSONA' => $request->apellido_persona,
        'NACIMIENTO_PERSONA' => $request->nacimiento_persona,
        'TELEFONO_PERSONA' => $request->telefono_persona,
        'DUI_PERSONA' => $request->dui_persona,
    ]);

    // 3. Crear carnet
    $carnet = Carnet::create([
        'CARNET' => $request->carnet,
        'EXPEDICION_CARNET' => now(),
        'VENCIMIENTO_CARNET' => now()->addYear(),
    ]);

    // 4. Crear usuario de sistema
    $usuario = Usuario::create([
        'ID_PERSONA' => $persona->ID_PERSONA,
        'DUI_PERSONA' => $persona->DUI_PERSONA,
        'ID_CARNET' => $carnet->ID_CARNET,
        'ID_ROL' => $rol->ID_ROL,
        'FECHAREGISTRO_USUARIO' => now(),
        'ESTADO_USUARIO' => 1,
    ]);

            $user = User::create([
            'name' => $request->carnet,
            'email' => $request->email,
            'ID_USUARIO' => $usuario->ID_USUARIO, // Assuming ID_USUARIO is the foreign key to USUARIO
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('usuario');
        //$user->assignRole('admin');
        event(new Registered($user));

        //Auth::login($user);

        return redirect()->route('dashboard');
    }
}
