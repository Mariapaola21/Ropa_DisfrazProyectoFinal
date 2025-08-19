<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use App\Models\Bloqueo; 
/**
 * Modelo de usuario del sistema.
 * Representa a clientes y administradores (tabla "usuarios").
 * Contiene la información de inicio de sesión y sus relaciones con reservas y bloqueos.
 *
 * @property \Illuminate\Database\Eloquent\Collection|\App\Models\Bloqueo[] $bloqueos
 * @method \Illuminate\Database\Eloquent\Relations\HasMany bloqueos()
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Tabla asociada
    protected $table = 'usuarios';

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'nombre','apellido','documento','correo','password',
        'telefono','direccion','tipo_usuario',
    ];

    // Campos que se ocultan en arrays/JSON
    protected $hidden = ['password','remember_token'];

    /**
     * Mutador para hashear automáticamente el password
     * cada vez que se asigne un valor.
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::needsRehash($value) ? Hash::make($value) : $value;
    }

    /**
     * Relación: un usuario puede tener muchas reservas.
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'user_id');
    }

    /**
     * Relación: un usuario puede tener muchos bloqueos.
     */
    public function bloqueos()
    {
        return $this->hasMany(Bloqueo::class, 'user_id');
    }
}
