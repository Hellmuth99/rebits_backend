<?php

namespace App\Imports;

use App\Models\HistoricoDueno;
use App\Models\Usuario;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Mail\ReporteMailable;
use App\Models\Vehiculo;

class UsersVehiclesImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        $errors = [];
        $insertedVehicles = [];

        foreach ($rows as $row) {
            try {
                // Validar y obtener usuario existente o crear uno nuevo
                $usuario = Usuario::where('correo', $row['correo'])->first();

                if (!$usuario) {
                    $usuario = Usuario::create([
                        'nombre' => $row['nombre'],
                        'apellidos' => $row['apellidos'],
                        'correo' => $row['correo'],
                    ]);
                }

                // Validar y guardar vehículo
                $vehiculoExistente = Vehiculo::where('patente', $row['patente'])->first();
                if ($vehiculoExistente) {
                    Log::warning("El vehículo con patente '{$row['patente']}' ya está registrado.");
                    $errors[] = "El vehículo con patente '{$row['patente']}' ya está registrado.";
                    continue; // Si el vehículo ya existe, pasamos al siguiente registro
                }

                $vehiculo = new Vehiculo([
                    'marca' => $row['marca'],
                    'modelo' => $row['modelo'],
                    'patente' => $row['patente'],
                    'anio' => $row['ano'],
                    'precio' => $row['precio'],
                    'dueno_id' => $usuario->id,
                ]);
                $vehiculo->save();

                // Guardar historial de dueños
                HistoricoDueno::create([
                    'vehiculo_id' => $vehiculo->id,
                    'usuario_id' => $usuario->id,
                ]);

                $insertedVehicles[] = "Vehículo patente '{$row['patente']}' insertado correctamente.";
            } catch (\Exception $e) {
                $errors[] = "Error al procesar fila: {$e->getMessage()}";
                Log::error("Error al procesar fila: {$e->getMessage()}");
            }
        }

        // Enviar notificación por correo
        $totalRows = $rows->count();
        $success = empty($errors); // Determina si la importación fue exitosa

        Mail::to('support@rebits.cl')->send(new ReporteMailable($totalRows, $success, $errors, $insertedVehicles));

        if (empty($errors)) {
            return response()->json(['message' => 'Importación completada correctamente.']);
        } else {
            return response()->json(['message' => 'Hubo errores durante la importación.', 'errors' => $errors], 500);
        }
    }
}
