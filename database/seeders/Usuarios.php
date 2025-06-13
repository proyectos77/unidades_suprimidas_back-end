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
            'id_cargo' => 1
        ]);
    }
}
