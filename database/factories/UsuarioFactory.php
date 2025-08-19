<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            'nombre' => $this->faker->firstName,
            'apellido' => $this->faker->lastName,
            'documento' => $this->faker->unique()->numerify('#########'),
            'correo' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('123456'), // Contraseña por defecto
            'telefono' => $this->faker->optional()->phoneNumber,
            'direccion' => $this->faker->optional()->address,
        ];
    }
}
