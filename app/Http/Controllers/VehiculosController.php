<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Vehiculos\VehiculosInterface;
use Illuminate\Http\Request;

class VehiculosController extends Controller
{
    public $vehiculos;
    public function __construct(VehiculosInterface $vehiculosInterface)
    {
        $this->vehiculos = $vehiculosInterface;
    }


    public function getVehiculos(Request $request)
    {
        return $this->vehiculos->getVehiculos($request);
    }

    public function editarVehiculo(Request $request)
    {
        return $this->vehiculos->editarVehiculo($request);
    }

    public function crearVehiculo(Request $request)
    {
        return $this->vehiculos->crearVehiculo($request);
    }

    public function detalleVehiculo(Request $request)
    {
        return $this->vehiculos->detalleVehiculo($request);
    }

    public function eliminarVehiculo(Request $request)
    {
        return $this->vehiculos->eliminarVehiculo($request);
    }
}
