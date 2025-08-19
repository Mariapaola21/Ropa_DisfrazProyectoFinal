<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabla usuarios
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('apellido');
            $table->string('documento')->unique();
            $table->string('correo')->unique();
            $table->string('password');
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->enum('tipo_usuario', ['admin', 'cliente'])->default('cliente');
            $table->timestamps();
        });

        // Tabla bloqueos de usuario
        Schema::create('bloqueos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('motivo');
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Tabla disfraces
        Schema::create('disfraces', function (Blueprint $table) {
            $table->id();
            $table->string('imagen')->nullable();
            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->decimal('precio', 10, 2);
            $table->text('talla');
            $table->integer('cantidad');
            $table->timestamps();
        });

        // Tabla reservas
    Schema::create('reservas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
    $table->foreignId('disfraz_id')->constrained('disfraces')->onDelete('cascade');
    $table->date('fecha_reserva')->index(); // 📌 índice para búsquedas por fecha
    $table->date('fecha_limite_devolucion')->index();
    $table->enum('estado', ['pendiente', 'entregado', 'devuelto', 'cancelado'])
          ->default('pendiente')->index(); // 📌 índice para búsquedas por estado
    $table->integer('cantidad');
    $table->timestamps();
});


        // Tabla entregas y devoluciones
        Schema::create('entregas_devoluciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reserva_id')->constrained()->onDelete('cascade');
            $table->date('fecha_entrega')->nullable();
            $table->foreignId('entregado_por')->nullable()->constrained('usuarios');
            $table->string('condicion_entrega')->nullable();
            $table->date('fecha_devolucion')->nullable();
            $table->foreignId('devuelto_por')->nullable()->constrained('usuarios');
            $table->text('descripcion_devolucion')->nullable();
            $table->string('condicion_devolucion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('entregas_devoluciones');
        Schema::dropIfExists('bloqueos');
        Schema::dropIfExists('reservas');
        Schema::dropIfExists('disfraces');
        Schema::dropIfExists('usuarios');

        Schema::enableForeignKeyConstraints();
    }
};
