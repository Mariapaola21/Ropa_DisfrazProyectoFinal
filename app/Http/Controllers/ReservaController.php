<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Reserva; 
use Carbon\Carbon;
use App\Models\User;
use App\Models\Bloqueo; 

class ReservaController extends Controller
{
    // Carrito temporal
    public function index()
    {
        $carrito = session()->get('carrito', []);

        $total = collect($carrito)->sum(fn($item) =>
            ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0)
        );

        return view('Reserva.index', compact('carrito', 'total'));
    }

    // Vista de confirmación
   public function confirmar(Request $request)
{ 
   

    $carrito = session('carrito', []);

    $request->validate([
        'fecha_recogida' => 'required|date|after_or_equal:today',
    ]);

    $fechaRecogida = Carbon::parse($request->fecha_recogida);
    $fechaLimite   = $fechaRecogida->copy()->addDays(7);

    $total = collect($carrito)->sum(fn($item) =>
        ($item['precio'] ?? 0) * ($item['cantidad'] ?? 0)
    );

    return view('Reserva.confirmar', [
        'carrito'       => $carrito,
        'fechaRecogida' => $fechaRecogida->toDateString(),
        'fechaLimite'   => $fechaLimite->toDateString(),
        'total'         => $total,
    ]);
}


    // Guardar reserva en BD
    public function store(Request $request)
    {
        $request->validate([
            'fecha_recogida' => 'required|date|after_or_equal:today',
        ]);

        $fechaRecogida = Carbon::parse($request->fecha_recogida);
        $fechaLimite   = $fechaRecogida->copy()->addDays(7);

        // Carrito
        $carrito = session('carrito', []);

    // Validar bloqueo
$bloqueo = Bloqueo::where('user_id', Auth::id())->where('activo', true)->first();
if ($bloqueo) {
    return redirect()->route('disfraz.index')
                     ->with('error', 'No puedes reservar nuevos disfraces hasta entregar los anteriores.');
}

        // Guardar cada disfraz del carrito como una reserva
        foreach ($carrito as $item) {
            Reserva::create([
                'user_id'                 => Auth::id(),
                'disfraz_id'              => $item['id'],            // ID del disfraz
                'fecha_reserva'           => $fechaRecogida,
                'fecha_limite_devolucion' => $fechaLimite,
                'estado'                  => 'pendiente',
                'cantidad'                => $item['cantidad'] ?? 1,
            ]);
        }

        // Vaciar carrito de la sesión
        session()->forget('carrito');

        return redirect()->route('disfraz.index')
                         ->with('success', '¡Reserva confirmada con éxito!');
    }

    // Mostrar una reserva específica
    public function show($id)
    {
        $reserva = Reserva::findOrFail($id);
        return view('Reserva.show', compact('reserva'));
    }

    // Métodos editar/eliminar carrito si los usas
// Eliminar un item del carrito (sesión)
 public function eliminarDelCarrito($id)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('Reserva.index')->with('success', 'Disfraz eliminado del carrito.');
    }

public function marcarEntregado(Request $request, $id)
{
    $reserva = Reserva::findOrFail($id);

    // 1. Checkbox entregado
    $reserva->entregado = $request->has('entregado');

    // 2. Select estado
    if ($request->filled('estado')) {
        $reserva->estado = $request->estado;
    }

    $reserva->save();

    $hoy = \Carbon\Carbon::today();
    $fechaLimite = \Carbon\Carbon::parse($reserva->fecha_limite_devolucion);

    // Si NO está entregado y ya pasó la fecha límite → bloquear usuario
    if (!$reserva->entregado && $hoy->greaterThan($fechaLimite)) {
        \App\Models\Bloqueo::create([
            'user_id'      => $reserva->user_id,
            'activo'       => true,
            'fecha_inicio' => $hoy,
            'fecha_fin'    => null, 
            'motivo'       => 'Reserva del disfraz "' . $reserva->disfraz->nombre . '" vencida',
        ]);
    }

    // **Si se entregó, desactivar bloqueos existentes**
    if ($reserva->entregado) {
        \App\Models\Bloqueo::where('user_id', $reserva->user_id)
            ->where('activo', true)
            ->update([
                'activo'    => false,
                'fecha_fin' => $hoy,
            ]);
    }

    return back()->with('success', 'Reserva actualizada correctamente.');
}


  public function historial()
    {
        $reservas = Reserva::with(['usuario', 'disfraz'])
                           ->orderBy('fecha_reserva', 'desc')
                           ->get();

        $alertas = [];
        $hoy = Carbon::today();

        foreach ($reservas as $reserva) {
            $fechaLimite = Carbon::parse($reserva->fecha_limite_devolucion);

            // Alerta un día antes o el mismo día
            if (!$reserva->entregado && $hoy->diffInDays($fechaLimite, false) <= 1 && $hoy->lte($fechaLimite)) {
                $alertas[] = [
                    'usuario' => $reserva->usuario->nombre,
                    'disfraz' => $reserva->disfraz->nombre,
                    'tipo' => 'warning',
                    'mensaje' => "Debe entregar pronto el disfraz '{$reserva->disfraz->nombre}'."
                ];
            }

            // Si pasó la fecha límite sin entregar → bloquear usuario
            if (!$reserva->entregado && $hoy->gt($fechaLimite)) {
                $alertas[] = [
                    'usuario' => $reserva->usuario->nombre,
                    'disfraz' => $reserva->disfraz->nombre,
                    'tipo' => 'error',
                    'mensaje' => "La reserva del disfraz '{$reserva->disfraz->nombre}' ha vencido. Usuario bloqueado."
                ];

                // Crear bloqueo si no existe activo
                $bloqueoExistente = Bloqueo::where('user_id', $reserva->user_id)
                                           ->where('activo', true)
                                           ->first();
               if (!$bloqueoExistente) {
    Bloqueo::create([
        'user_id'      => $reserva->user_id,
        'activo'       => true,
        'fecha_inicio' => $hoy,
        'fecha_fin'    => null,
        'motivo'       => 'Reserva del disfraz "' . $reserva->disfraz->nombre . '" vencida',
    ]);
}

            }
        }

        return view('Reserva.historial', compact('reservas', 'alertas'));
    }

    public function editar(Request $request) {}
}
