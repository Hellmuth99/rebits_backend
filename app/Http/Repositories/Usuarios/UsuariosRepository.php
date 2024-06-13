<?php


namespace App\Http\Repositories\Usuarios;

use App\Models\Usuario;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;

use App\Traits\ApiResponse;

use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
//Se implementan las funciones que solicita la interfaz usuariosrepository
class UsuariosRepository implements UsuariosInterface
{
    use ApiResponse;


    public function getUsuarios($request)
    {
        try {

            $perPage = $request->get('limit', 10); // Limite de registros por página
            $page = $request->get('page', 1); // Página actual

            $usuarios = Usuario::select('*')
                ->orderBy('usuarios.id', 'desc')
                ->paginate($perPage, ['*'], 'page', $page);
            // ->get();


            return $this->successResponse($usuarios, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "Usuario- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al encontrar Usuario", Response::HTTP_CONFLICT);
        }
    }


    public function editarUsuario($request)
    {
        try {
            // Verificar si el correo ya existe en otro usuario
            $existingUser = Usuario::where('correo', $request['correo'])->where('id', '!=', $request['id'])->first();
            if ($existingUser) {
                return $this->errorResponse("El correo ya está registrado", Response::HTTP_CONFLICT);
                // return response()->json(['mensaje' => 'El correo ya está registrado'], Response::HTTP_CONFLICT);
            }

            // Encontrar el usuario por id y actualizar
            $usuario = Usuario::findOrFail($request['id']);
            $usuario->update([
                'nombre' => $request['nombre'],
                'apellidos' => $request['apellidos'],
                'correo' => $request['correo'],
            ]);


            // $usuarios = Usuario::findOrFail($request['id'])->update([

            //     'nombre' => $request['nombre'],
            //     'apellidos' => $request['apellidos'],
            //     'correo' => $request['correo'],

            // ]);

            return $this->successResponse($usuario, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "editarUsuario- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al encontrar editarUsuario", Response::HTTP_CONFLICT);
        }
    }



    public function crearUsuario($request)
    {
        try {
            // Verificar si el correo ya existe
            $usuarioExistente = Usuario::where('correo', $request['correo'])->first();

            if ($usuarioExistente) {
                return $this->errorResponse("El correo ya está registrado", Response::HTTP_CONFLICT);
                // return response()->json(['mensaje' => 'El correo ya está registrado'], Response::HTTP_CONFLICT);
            }

            // Crear el nuevo usuario
            $usuario = Usuario::create([
                'nombre' => $request['nombre'],
                'apellidos' => $request['apellidos'],
                'correo' => $request['correo'],
            ]);

            return $this->successResponse($usuario, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "crearUsuario- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al crear el usuario", Response::HTTP_CONFLICT);
        }
    }

    public function detalleUsuario($request)
    {
        try {
            // Buscar el usuario por ID
            $usuario = Usuario::find($request["id"]);

            if (!$usuario) {
                return $this->errorResponse("Usuario no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $this->successResponse($usuario, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "Usuario- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al encontrar Usuario", Response::HTTP_CONFLICT);
        }
    }

    public function listUsuarios($request)
    {
        try {

            $users = Usuario::select('id', 'nombre', 'apellidos')->get();
            return $this->successResponse($users, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "Usuario- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al encontrar Usuario", Response::HTTP_CONFLICT);
        }
    }

    public function eliminarUsuario($request)
    {



        try {

            $usuario = Usuario::where('id', $request['id'])->first();
            if (!$usuario) {
                return $this->errorResponse("Ha ocurrido un error al encontrar vehiculo", Response::HTTP_CONFLICT);
            }



            DB::beginTransaction();
            $usuario->delete();
            DB::commit();
            return $this->successResponse($usuario, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "vehiculos- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            DB::rollBack();
            return $this->errorResponse("Ha ocurrido un error al encontrar vehiculos", Response::HTTP_CONFLICT);
        }
    }
}
