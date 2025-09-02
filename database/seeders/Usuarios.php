<?php

namespace Database\Seeders;

use App\Models\Usuarios\UsuariosModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class Usuarios extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UsuariosModel::create([
            'nombre_usuario' => 'Johan Montero',
            'identificacion_usuario' => '11111',
            'email_usuario' => 'prueba@gmail.com',
            'user_usuario' => 'admin',
            'password_usuario' => Hash::make('admin'),
            'id_tipo_usuario' => 1,
            'id_dependencia' => 1,
            'id_cargo' => 1
        ]);

        UsuariosModel::create([
            'nombre_usuario' => 'Geovanny Perez',
            'identificacion_usuario' => '12345',
            'email_usuario' => 'perez@gmail.com',
            'user_usuario' => 'perez',
            'password_usuario' => Hash::make('12345'),
            'id_tipo_usuario' => 1,
            'id_dependencia' => 1,
            'id_cargo' => 1
        ]);
    }
}
