<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Disfraz;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReservaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      return [
            'user_id' => User::inRandomOrder()->first()->id ?? UsuarioFactory::factory(),
            'disfraz_id' => Disfraz::inRandomOrder()->first()->id ?? DisfraceFactory::factory(),
            'fecha_reserva' => $this->faker->dateTimeBetween('now', '+1 month'),
            'fecha_limite_devolucion' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'estado' => $this->faker->randomElement(['pendiente', 'entregado','devuelto' , 'cancelado']),
            'cantidad' => $this->faker->numberBetween(1, 10),
          
        ];
    }
}
