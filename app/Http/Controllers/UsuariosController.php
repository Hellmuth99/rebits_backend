<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Usuarios\UsuariosInterface;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public $usuarios;
    public function __construct(UsuariosInterface $usuariosInterface)
    {
        $this->usuarios = $usuariosInterface;
    }


    public function getUsuarios(Request $request)
    {
        return $this->usuarios->getUsuarios($request);
    }

    public function crearUsuario(Request $request)
    {
        return $this->usuarios->crearUsuario($request);
    }



    public function detalleUsuario(Request $request)
    {
        return $this->usuarios->detalleUsuario($request);
    }

    public function editarUsuario(Request $request)
    {
        return $this->usuarios->editarUsuario($request);
    }

    public function listUsuarios(Request $request)
    {
        return $this->usuarios->listUsuarios($request);
    }

    public function eliminarUsuario(Request $request)
    {
        return $this->usuarios->eliminarUsuario($request);
    }
}
