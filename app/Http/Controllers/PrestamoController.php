<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class PrestamoController extends Controller
{
    /**
     * Obtener ejemplares disponibles para préstamo
     */
    public function ejemplaresDisponibles()
    {
        try {
            $ejemplares = DB::select('CALL get_ejemplares_disponibles()');
            return view('prestamos_libros.list_libros_disponibles', [
                'ejemplares' => $ejemplares
            ]);
        } catch (Exception $e) {
            \Log::error('Error al obtener ejemplares: ' . $e->getMessage());
            return view('prestamos_libros.list_libros_disponibles', [
                'ejemplares' => [],
                'error' => 'Error al obtener ejemplares disponibles.'
            ]);
        }
    }

    /**
     * Registrar un préstamo
     */
    public function registrarPrestamo(Request $request)
    {
        $request->validate([
            'id_ejemplar' => 'required|integer',
            'dias_prestamo' => 'required|integer|min:1|max:30',
        ]);

        try {
            DB::statement('CALL sp_prestar_ejemplar(?, ?, ?)', [
                $request->input('id_ejemplar'),
                auth()->user()->usuario->ID_USUARIO,
                $request->input('dias_prestamo'),
            ]);
            \Log::info('ID de usuario autenticado: ' . auth()->id());
            // Redirige a la lista con mensaje de éxito
            return redirect()->route('ejemplares.disponibles')
                ->with('success', 'Préstamo registrado exitosamente.');
        } catch (Exception $e) {
            \Log::error('Error al registrar préstamo: ' . $e->getMessage());
            
            $errorMessage = $e->getMessage();
            if (str_contains($errorMessage, 'El ejemplar ya está prestado')) {
                return redirect()->route('ejemplares.disponibles')
                    ->with('error', 'Este ejemplar ya está prestado actualmente.');
            }

            return redirect()->route('ejemplares.disponibles')
                ->with('error', 'No se pudo registrar el préstamo.');
        }
    }

    public function mostrarUsuariosConPrestamos()
    {
        $usuarios = DB::select('CALL sp_usuarios_con_prestamos()');

        return view('prestamos_libros.list_usuarios_prestamo', compact('usuarios'));
    }

    public function mostrarPrestamosPorUsuario($id_usuario)
{
    // Ejecutar el SP con el parámetro usuario
    $prestamos = DB::select('CALL sp_libros_prestados_por_usuario(?)', [$id_usuario]);

    
    $usuario = DB::table('users')
    ->join('persona', 'persona.ID_PERSONA', '=', 'users.ID_USUARIO')
    ->where('users.ID_USUARIO', $id_usuario) 
    ->select('users.id', 'persona.NOMBRE_PERSONA', 'persona.APELLIDO_PERSONA', 'persona.DUI_PERSONA')
    ->first();


    return view('prestamos_libros.prestamo_detalle', compact('prestamos', 'usuario'));
}

public function despacharVarios(Request $request)
{
    $ids = $request->input('ids', []);
    $id_usuario = $request->input('id_usuario');

    if (empty($ids)) {
        return back()->with('error', 'No hay ejemplares para despachar.');
    }

    $idsString = implode(',', $ids);

    try {
        \DB::statement('CALL sp_despachar_varios_ejemplares(?)', [$idsString]);
        // Redirige a la vista de detalle del usuario despachado
        return redirect()->route('usuarios.prestamos')
            ->with('success', 'Ejemplares despachados correctamente.');
    } catch (\Exception $e) {
        \Log::error('Error al despachar ejemplares: ' . $e->getMessage());
        return back()->with('error', 'No se pudieron despachar los ejemplares.');
    }
}

}
