<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre' => 'Juan',
                'apellidos' => 'Pérez',
                'correo' => 'juan@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'María',
                'apellidos' => 'González',
                'correo' => 'maria@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pedro',
                'apellidos' => 'Ramírez',
                'correo' => 'pedro@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Laura',
                'apellidos' => 'López',
                'correo' => 'laura@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carlos',
                'apellidos' => 'Martínez',
                'correo' => 'carlos@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ana',
                'apellidos' => 'Fernández',
                'correo' => 'ana@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Diego',
                'apellidos' => 'Sánchez',
                'correo' => 'diego@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sofía',
                'apellidos' => 'Hernández',
                'correo' => 'sofia@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Luis',
                'apellidos' => 'Díaz',
                'correo' => 'luis@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Elena',
                'apellidos' => 'Jiménez',
                'correo' => 'elena@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Javier',
                'apellidos' => 'Gutiérrez',
                'correo' => 'javier@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Carmen',
                'apellidos' => 'Ortega',
                'correo' => 'carmen@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Pablo',
                'apellidos' => 'Ruiz',
                'correo' => 'pablo@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Marina',
                'apellidos' => 'Navarro',
                'correo' => 'marina@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Gonzalo',
                'apellidos' => 'Castro',
                'correo' => 'gonzalo@example.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
