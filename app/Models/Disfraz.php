<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo de disfraz.
 * Contiene la información de cada disfraz disponible para alquilar.
 */
class Disfraz extends Model
{
    use HasFactory;

    protected $table = 'disfraces';

    protected $fillable = ['imagen','nombre','descripcion','precio','talla','cantidad'];

    // Convierte el precio a decimal con 2 decimales
    protected $casts = ['precio' => 'decimal:2'];

    /**
     * Relación: un disfraz puede estar en muchas reservas.
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'disfraz_id');
    }
}
