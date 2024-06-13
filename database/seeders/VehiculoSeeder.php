<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Vehiculo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // $usuarios = Usuario::all();

        // Vehiculo::factory()->count(20)->create()->each(function ($vehiculo) use ($usuarios) {
        //     $vehiculo->update(['dueno_id' => $usuarios->random()->id]);
        // });
        DB::table('vehiculos')->insert([
            [
                'marca' => 'Toyota',
                'modelo' => 'Corolla',
                'patente' => 'AB123CD',
                'anio' => 2020,
                'precio' => 25000,
                'dueno_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Honda',
                'modelo' => 'Civic',
                'patente' => 'EF456GH',
                'anio' => 2018,
                'precio' => 22000,
                'dueno_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Ford',
                'modelo' => 'Fiesta',
                'patente' => 'IJ789KL',
                'anio' => 2019,
                'precio' => 18000,
                'dueno_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Chevrolet',
                'modelo' => 'Spark',
                'patente' => 'MN012OP',
                'anio' => 2021,
                'precio' => 15000,
                'dueno_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Nissan',
                'modelo' => 'Sentra',
                'patente' => 'QR345ST',
                'anio' => 2017,
                'precio' => 20000,
                'dueno_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Volkswagen',
                'modelo' => 'Golf',
                'patente' => 'UV678WX',
                'anio' => 2022,
                'precio' => 28000,
                'dueno_id' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Hyundai',
                'modelo' => 'Accent',
                'patente' => 'YZ901AB',
                'anio' => 2016,
                'precio' => 17000,
                'dueno_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Kia',
                'modelo' => 'Rio',
                'patente' => 'CD234EF',
                'anio' => 2019,
                'precio' => 19000,
                'dueno_id' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Subaru',
                'modelo' => 'Impreza',
                'patente' => 'GH567IJ',
                'anio' => 2018,
                'precio' => 21000,
                'dueno_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Mazda',
                'modelo' => '3',
                'patente' => 'KL890MN',
                'anio' => 2020,
                'precio' => 23000,
                'dueno_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Audi',
                'modelo' => 'A3',
                'patente' => 'OP123QR',
                'anio' => 2021,
                'precio' => 32000,
                'dueno_id' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Mercedes-Benz',
                'modelo' => 'Clase C',
                'patente' => 'ST456UV',
                'anio' => 2019,
                'precio' => 35000,
                'dueno_id' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'BMW',
                'modelo' => 'Serie 1',
                'patente' => 'WX789YZ',
                'anio' => 2018,
                'precio' => 30000,
                'dueno_id' => 13,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Tesla',
                'modelo' => 'Model 3',
                'patente' => 'AB901CD',
                'anio' => 2022,
                'precio' => 45000,
                'dueno_id' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'marca' => 'Lexus',
                'modelo' => 'IS',
                'patente' => 'EF234GH',
                'anio' => 2020,
                'precio' => 38000,
                'dueno_id' => 15,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
