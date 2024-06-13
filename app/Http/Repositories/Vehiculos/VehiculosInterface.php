<?php

namespace App\Http\Repositories\Vehiculos;

interface VehiculosInterface
{
    public function getVehiculos($request);
    public function editarVehiculo($request);
    public function crearVehiculo($request);
    public function detalleVehiculo($request);
    public function eliminarVehiculo($request);
}
