<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

/**

 * Un registro de este modelo representa una restricción temporal que impide
 * a un usuario realizar nuevas reservas.
 */
class Bloqueo extends Model
{
    protected $table = 'bloqueos';

    // crea instancias del modelo con fines de prueba.
    use HasFactory;

    /**
     * Define el nombre de la tabla de la base de datos a la que está asociado este modelo.
     * Si no se especifica, Laravel asumirá que la tabla se llama 'bloqueos' (plural).
     *
     * @var string
     */

    /**
     * Los atributos que se pueden asignar masivamente.
     * Esto protege contra la asignación masiva de campos no deseados.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'motivo', 'fecha_inicio', 'fecha_fin', 'activo'];

    /**
     * Define los tipos de datos para los atributos del modelo.
     * Laravel los convertirá automáticamente a los tipos nativos de PHP.
     *
     * @var array
     */
    protected $casts = [
        'fecha_inicio' => 'date',   // Convierte el valor de 'fecha_inicio' a un objeto Carbon.
        'fecha_fin'    => 'date',   // Convierte el valor de 'fecha_fin' a un objeto Carbon.
        'activo'       => 'boolean',// Convierte el valor de 'activo' a un booleano (true/false).
    ];

    /**
     * Define la relación de este modelo.
     * Un Bloqueo pertenece a un solo Usuario (User).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function usuario()
    {
        // usando la clave foránea 'user_id'.
        return $this->belongsTo(User::class, 'user_id');
    }
}