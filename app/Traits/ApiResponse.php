<?php


namespace App\Traits;


trait ApiResponse
{

    // public function successResponse($data, $code = 200)
    // {
    //     return response()->json(['success' => [
    //         'codigoRespuesta' => 1,
    //         'descripcionRespuesta' =>  $data
    //     ], 'codigo' => $code], $code);
    // }

    public function successResponse($data, $code = 200)
    {
        return response()->json([
            'success' => $data, // Aquí se espera que $data sea directamente el arreglo de vehículos
            'codigo' => $code
        ], $code);
    }

    public function errorResponse($message, $code = 500)
    {

        return response()->json([
            'descripcionRespuesta' => 'Error',
            'detalleRespuesta' => $message, // Aquí se espera que $data sea directamente el arreglo de vehículos
            'codigo' => $code
        ], $code);
        // return response()->json(['error' => [
        //     'codigoRespuesta' => 0,
        //     'descripcionRespuesta' => 'Error',
        //     'detalleRespuesta' => $message
        // ], 'codigo' => $code], $code);
    }
}
