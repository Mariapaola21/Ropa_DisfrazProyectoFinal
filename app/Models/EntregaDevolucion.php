<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de entrega y devolución.
 * Registra cuándo y en qué condiciones se entregó y devolvió un disfraz.
 */
class EntregaDevolucion extends Model
{
    use HasFactory;

    protected $table = 'entregas_devoluciones';

    protected $fillable = [
        'reserva_id',
        'fecha_entrega','entregado_por','condicion_entrega',
        'fecha_devolucion','devuelto_por','descripcion_devolucion','condicion_devolucion',
    ];

    protected $casts = [
        'fecha_entrega'    => 'date',
        'fecha_devolucion' => 'date',
    ];

    /**
     * Relación: pertenece a una reserva.
     */
    public function reserva()
    {
        return $this->belongsTo(Reserva::class, 'reserva_id');
    }

    /**
     * Relación: usuario que entregó el disfraz.
     */
    public function entregadoPor()
    {
        return $this->belongsTo(User::class, 'entregado_por');
    }

    /**
     * Relación: usuario que recibió la devolución.
     */
    public function devueltoPor()
    {
        return $this->belongsTo(User::class, 'devuelto_por');
    }
}
