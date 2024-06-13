<?php

namespace App\Http\Repositories\Usuarios;

interface UsuariosInterface
{
    public function getUsuarios($request);
    public function editarUsuario($request);
    public function crearUsuario($request);
    public function detalleUsuario($request);
    public function listUsuarios($request);
    public function eliminarUsuario($request);
}
