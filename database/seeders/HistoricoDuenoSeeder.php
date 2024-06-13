<?php

namespace Database\Seeders;

use App\Models\HistoricoDueno;
use App\Models\Usuario;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistoricoDuenoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Obtener todos los vehículos y usuarios para crear registros de historico_duenos
        $vehiculos = DB::table('vehiculos')->select('id')->get();
        $usuarios = DB::table('usuarios')->select('id')->get();

        // Crear 20 registros aleatorios en historico_duenos
        $historicoDuenos = [];

        for ($i = 0; $i < 20; $i++) {
            $vehiculo = $vehiculos->random();
            $usuario = $usuarios->random();

            $historicoDuenos[] = [
                'vehiculo_id' => $vehiculo->id,
                'usuario_id' => $usuario->id,
                'fecha_asignacion' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Insertar los registros en la tabla historico_duenos
        DB::table('historico_duenos')->insert($historicoDuenos);
        // $vehiculos = Vehiculo::all();

        // $vehiculos->each(function ($vehiculo) {
        //     $numHistoricos = rand(1, 5); // Entre 1 y 5 historiales por vehículo

        //     for ($i = 0; $i < $numHistoricos; $i++) {
        //         $nuevoDueno = Usuario::inRandomOrder()->first();

        //         HistoricoDueno::create([
        //             'vehiculo_id' => $vehiculo->id,
        //             'usuario_id' => $nuevoDueno->id,
        //             'fecha_asignacion' => Carbon::now()->subDays(rand(1, 365)) // Fecha aleatoria en el último año
        //         ]);
        //     }
        // });
        // DB::table('historico_duenos')->insert([
        //     [
        //         'vehiculo_id' => 1, // Asumiendo que el vehículo con ID 1 existe
        //         'usuario_id' => 1,  // Asumiendo que el usuario con ID 1 existe
        //         'fecha_asignacion' => now(),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'vehiculo_id' => 2, // Asumiendo que el vehículo con ID 2 existe
        //         'usuario_id' => 2,  // Asumiendo que el usuario con ID 2 existe
        //         'fecha_asignacion' => now(),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        //     [
        //         'vehiculo_id' => 3, // Asumiendo que el vehículo con ID 3 existe
        //         'usuario_id' => 3,  // Asumiendo que el usuario con ID 3 existe
        //         'fecha_asignacion' => now(),
        //         'created_at' => now(),
        //         'updated_at' => now()
        //     ],
        // ]);
    }
}
