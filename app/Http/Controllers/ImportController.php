<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\UsersVehiclesImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class ImportController extends Controller
{
    public function importExcel(Request $request)
    {

        // Log::info(["request" => $request]);

        // Excel::import(new UsersVehiclesImport(), $request->file('file'));
        // Excel::import(new UsersVehiclesImport, 'excel_prueba.xlsx', 'xlsx');

        $files =   Excel::import(new UsersVehiclesImport, request()->file('excel_prueba'));
        $extends = $result = array($request->file('excel_prueba')->getClientOriginalExtension());
        // Log::info(["files111" => $files]);
        // Log::info(["extends" => $extends]);

        return response()->json(['message' => 'Importación completada correctamente.']);

        // Validar y subir el archivo
        // $request->validate(['file' => 'required|file|mimes:xlsx']);
        // $file = $request->file('file');

        // $data = Excel::toArray(new UsersVehiclesImport, $file);

        // $errors = [];
        // foreach ($data[0] as $row) {
        //     try {
        //         // Validar y procesar cada fila
        //         $user = User::firstOrCreate(
        //             ['email' => $row['Correo (usuario)']],
        //             ['name' => $row['Nombre (usuario)'], 'surname' => $row['Apellidos (usuario)']]
        //         );

        //         $vehicleExists = Vehicle::where('patent', $row['Patente (Vehículo)'])->exists();
        //         if ($vehicleExists) {
        //             $errors[] = "El vehículo con patente {$row['Patente (Vehículo)']} ya existe.";
        //             continue;
        //         }

        //         $vehicle = new Vehicle([
        //             'brand' => $row['Marca'],
        //             'model' => $row['Modelo'],
        //             'patent' => $row['Patente'],
        //             'year' => $row['Año'],
        //             'price' => $row['Precio'],
        //             'owner_id' => $user->id
        //         ]);
        //         $vehicle->save();

        //     } catch (\Exception $e) {
        //         $errors[] = "Error en la fila con patente {$row['Patente (Vehículo)']}: " . $e->getMessage();
        //     }
        // }

        // // Enviar notificación por correo
        // \Mail::to('support@rebits.cl')->send(new ImportNotification(count($errors) === 0, $errors));

        // return back()->with('status', 'Importación completada');
    }
}
