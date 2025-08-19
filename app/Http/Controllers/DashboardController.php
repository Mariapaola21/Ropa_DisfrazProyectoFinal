<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Traemos las reservas del usuario logueado
        $reservas = Reserva::with(['usuario', 'disfraz'])
            ->where('user_id', Auth::id())
            ->get();

        $hoy = Carbon::today();

        foreach ($reservas as $reserva) {
            $fechaLimite = Carbon::parse($reserva->fecha_limite_devolucion);

            // Reserva vencida
            if (!$reserva->entregado && $hoy->gt($fechaLimite)) {
                session()->flash('reserva_vencida', 
                    'No puedes reservar más hasta entregar el disfraz "' . $reserva->disfraz->nombre . '".');
            }

            // Reserva próxima a vencer (mañana)
            elseif (!$reserva->entregado && $hoy->lte($fechaLimite) && $fechaLimite->diffInDays($hoy) === 1) {
                session()->flash('reserva_vencida', 
                    'Debes entregar mañana el disfraz "' . $reserva->disfraz->nombre . '".');
            }
        }

        return view('dashboard', compact('reservas'));
    }
}