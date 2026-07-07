<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permisos\Permisos;

class PermisoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permisos::create([
            'nombre_permiso' => 'Unidad Suprimidas',
            'descripcion_permiso' => 'Permiso para gestionar unidades suprimidas',
            'id_estado' => 1, // Asumiendo que 1 es el estado activo
        ]);

         Permisos::create([
            'nombre_permiso' => 'Unidad Activas',
            'descripcion_permiso' => 'Permiso para gestionar unidades activas',
            'id_estado' => 1, // Asumiendo que 1 es el estado activo
        ]);

        Permisos::create([
            'nombre_permiso' => 'Todos Los Permisos',
            'descripcion_permiso' => 'Permiso para gestionar todos los permisos',
            'id_estado' => 1, // Asumiendo que 1 es el estado activo
        ]);
    }
}
