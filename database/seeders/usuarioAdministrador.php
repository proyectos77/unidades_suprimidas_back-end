<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuarios\UsuariosModel;
class usuarioAdministrador extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsuariosModel::create([
            'nombre_usuario' => 'administrador',
            'user_usuario' => 'admin',
            'identificacion_usuario' => '1075278686',
            'email_usuario' => 'admin@gmail.com',
            'password_usuario' => 'admin',
            'id_tipo_usuario' => 1,
            'id_cargo' => 1,
            'fecha_creacion_usuario'=> now(),
            'fecha_actualizacion_usuario'=> now()
        ]);
    }
}
