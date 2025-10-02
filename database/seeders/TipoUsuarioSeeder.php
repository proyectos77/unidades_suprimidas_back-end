<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoUsuario\TipoUsuarioModell;

class TipoUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        TipoUsuarioModell::create([
            'nombre_tipo_usuario' => 'superUsuario',
            'id_estado' => 1 // O el ID del estado correcto en la base de datos
        ]);

         TipoUsuarioModell::create([
            'nombre_tipo_usuario' => 'User',
            'id_estado' => 1 // O el ID del estado correcto en la base de datos
        ]);

         TipoUsuarioModell::create([
            'nombre_tipo_usuario' => 'Supervisor',
            'id_estado' => 1 // O el ID del estado correcto en la base de datos
        ]);

        TipoUsuarioModell::create([
            'nombre_tipo_usuario' => 'UserUndActiva',
            'id_estado' => 1 // O el ID del estado correcto en la base de datos
        ]);
    }
}
