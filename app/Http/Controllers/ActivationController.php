<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActivationController extends Controller
{
    public function reactivate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return redirect('/login')->withErrors('Token de reactivación inválido.');
        }

        $user->active = true;
        $user->activation_token = null;
        $user->save();

        return redirect('/login')->with('status', 'Tu cuenta ha sido reactivada. Ya puedes iniciar sesión.');
    }
}
