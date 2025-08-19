<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'user_id',              // FK hacia users
        'disfraz_id',              // FK hacia disfraces
        'fecha_reserva',
        'fecha_limite_devolucion',
        'estado',
        'cantidad',
        'entregado',

    ];

    protected $casts = [
    'fecha_reserva'           => 'datetime',
    'fecha_limite_devolucion' => 'datetime',
];

    // ===================== Relaciones =====================

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function disfraz()
    {
        return $this->belongsTo(Disfraz::class, 'disfraz_id');
    }

    public function entregaDevolucion()
    {
        return $this->hasOne(EntregaDevolucion::class, 'reserva_id');
    }

    // ===================== Scopes =====================

    public function scopePendientes(Builder $query): Builder
    {
        return $query->where('estado', 'pendiente');
    }

    public function scopeVencidas(Builder $query): Builder
    {
        return $query->pendientes()
            ->whereDate('fecha_limite_devolucion', '<', Carbon::today());
    }

    public function scopePorVencer(Builder $query, int $horas = 24): Builder
    {
        $hasta = Carbon::now()->addHours($horas);
        return $query->pendientes()
            ->whereDate('fecha_limite_devolucion', '>=', Carbon::today())
            ->where('fecha_limite_devolucion', '<=', $hasta);
    }

    // ===================== Accessors =====================

    public function getEstaVencidaAttribute(): bool
    {
        return $this->estado === 'pendiente'
            && Carbon::parse($this->fecha_limite_devolucion)->isPast();
    }
}
