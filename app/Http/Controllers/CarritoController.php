<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disfraz; // importar tu modelo Disfraz
use App\Models\Bloqueo;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
// 0. Verificar si el usuario está bloqueado
$bloqueo = Bloqueo::where('user_id', Auth::id())
                   ->where('activo', true)
                   ->first();

if ($bloqueo) {
    // Verificar si ya no tiene reservas pendientes
    $pendientes = \App\Models\Reserva::where('user_id', Auth::id())
                                      ->where('entregado', false)
                                      ->exists();

    if (!$pendientes) {
        // Desactivar el bloqueo
        $bloqueo->activo = false;
        $bloqueo->fecha_fin = \Carbon\Carbon::today();
        $bloqueo->save();
    } else {
        // Si todavía hay pendientes, no deja agregar
        return redirect()->back()
                         ->with('bloqueado', 'No puedes agregar disfraces al carrito hasta entregar los anteriores.');
    }
}

        // 1. Validar los datos del formulario
        $request->validate([
            'disfraz_id' => 'required|exists:disfraces,id',
            'talla' => 'required|string',
            'cantidad' => 'required|integer|min:1',
        ]);

        // 2. Buscar el disfraz en la base de datos
        $disfraz = Disfraz::find($request->disfraz_id);

        // 3. Obtener el carrito de la sesión o inicializarlo si no existe
        $carrito = session()->get('carrito', []);

        // 4. Crear un identificador único para el producto (basado en el ID y la talla)
        $productoKey = $disfraz->id . '_' . $request->talla;

        // 5. Verificar si el producto ya está en el carrito
        if (isset($carrito[$productoKey])) {
            // Si el producto ya existe, actualizamos la cantidad
            $carrito[$productoKey]['cantidad'] += $request->cantidad;
        } else {
            // Si el producto es nuevo, lo agregamos al carrito
            $carrito[$productoKey] = [
                'id' => $disfraz->id,
                'nombre' => $disfraz->nombre,
                'precio' => $disfraz->precio,
                'talla' => $request->talla,
                'cantidad' => $request->cantidad,
                'imagen' => $disfraz->imagen,
            ];
        }

        // 6. Guardar el carrito actualizado en la sesión
        session()->put('carrito', $carrito);

        // 7. Redirigir al usuario con un mensaje de éxito
        return redirect()->back()->with('success', 'Disfraz agregado a tu reserva.');
    }
}
