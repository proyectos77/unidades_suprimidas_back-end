<?php

namespace Database\Seeders;

use App\Models\PermisosUsuario\PermisosUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermisosUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermisosUsuario::create([
            'id_permiso' => 3,
            'id_usuario' => 1,
        ]);

        PermisosUsuario::create([
            'id_permiso' => 3,
            'id_usuario' => 2,
        ]);
    }
}
