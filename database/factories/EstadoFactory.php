<?php

namespace Database\Factories;

use App\Models\Estados\EstadosModell;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstadoFactory extends Factory
{
    protected $model = EstadosModell::class;

    public function definition(): array
    {
        return [
            'nombre_estado' => $this->faker->randomElement(['Activo', 'Inactivo']),
            'descripcion_estado' => $this->faker->randomElement(['Elemento activo', 'Elemento inactivo']),
            'estado' => '1',
            'fecha_creacion_estado' => now(),
            'fecha_actualizacion_estado' => now(),
        ];
    }
}
