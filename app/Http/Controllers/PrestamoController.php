<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\libro_devuelto_notification;
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
            DB::statement('CALL sp_prestar_ejemplar(?, ?, ?, ?)', [
                $request->input('id_ejemplar'),
                auth()->user()->usuario->ID_USUARIO,
                $request->input('dias_prestamo'),
                auth()->user()->id,
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
                ->with('error', "Error al registrar el préstamo: " . $errorMessage);
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
    ->join('PERSONA', 'PERSONA.ID_PERSONA', '=', 'users.ID_USUARIO')
    ->where('users.ID_USUARIO', $id_usuario) 
    ->select('users.id', 'PERSONA.NOMBRE_PERSONA', 'PERSONA.APELLIDO_PERSONA', 'PERSONA.DUI_PERSONA')
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
        \DB::statement('CALL sp_despachar_varios_ejemplares(?, ?)', [$idsString, auth()->user()->id]);
        // Redirige a la vista de detalle del usuario despachado
        return redirect()->route('usuarios.prestamos')
            ->with('success', 'Ejemplares despachados correctamente.');
    } catch (\Exception $e) {
        \Log::error('Error al despachar ejemplares: ' . $e->getMessage());
        return back()->with('error', 'No se pudieron despachar los ejemplares.');
    }
}

    // Gestionar prestamo 
    public function gestionar_prestamos(Request $request)
    {

        $coleccion = DB::select('CALL sp_prestamos_con_estado_ejemplar_3()');

        return view('prestamos_libros.gestionar_prestamos', compact('coleccion'));

    }

    public function devolver_prestamo($ID_PRESTA)
    { 
        try {
            DB::statement('CALL sp_devolver_prestamo(?, ?)', [$ID_PRESTA, auth()->user()->id]);
            
            // Enviar notificación por correo electrónico
            //obtener el correo del usuario asociado al préstamo
            $correoDestino = DB::table('PRESTA as p')
                ->join('USUARIO as usu', 'p.ID_USUARIO', '=', 'usu.ID_USUARIO')
                ->join('users as u', 'u.ID_USUARIO', '=', 'usu.ID_USUARIO')
                ->where('p.ID_PRESTA', $ID_PRESTA)
                ->value('u.email'); 
            //obtener la mora asociada al préstamo
            $mora = DB::table('PRESTA as p')
                ->join('COSTO_PRESTA as cp', 'p.ID_COSTO_PRESTA', '=', 'cp.ID_COSTO_PRESTA')
                ->where('p.ID_PRESTA', $ID_PRESTA)
                ->value('cp.MORA_PRESTA');
            $mensaje = 'EL LIBRO HA SIDO DEVUELTO, posees un monto de mora: ' . $mora . ' DOLARES, por favor consulta tu cuenta o hacer caso comiso.';
            //enviando el correo
            Mail::to($correoDestino)->send(new libro_devuelto_notification($mensaje));

            return redirect()->route('prestamo.gestionar_prestamos')
                ->with('success', 'Préstamo devuelto exitosamente.');



        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
            \Log::error('Error al devolver préstamo: ' . $errorMessage);
            return redirect()->route('prestamo.gestionar_prestamos')
                ->with('error',  $errorMessage);
        }
                

    }
}
