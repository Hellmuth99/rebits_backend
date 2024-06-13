<?php


namespace App\Http\Repositories\Vehiculos;

use App\Models\HistoricoDueno;
use App\Models\Usuario;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Exception;

use App\Traits\ApiResponse;

use App\Models\Vehiculo;
use Illuminate\Support\Facades\DB;
//Se implementan las funciones que solicita la interfaz usuariosrepository
class VehiculosRepository implements VehiculosInterface
{
    use ApiResponse;


    public function getVehiculos($request)
    {



        try {

            // Obtén los valores de 'page' y 'perpage' de la solicitud HTTP, con valores predeterminados si no están presentes.
            // $page = $request->get('page', 1);
            // $perpage = $request->get('limit', 10);
            $perPage = $request->get('limit', 10); // Limite de registros por página
            $page = $request->get('page', 1); // Página actual

            $vehiculos = Vehiculo::select(
                '*'
            )
                ->leftJoin("usuarios", "usuarios.id", "vehiculos.dueno_id")
                // ->get();
                // ->paginate($request["perpage"]);
                // ->paginate($perPage, ['*'], 'page', $page);
                // ->paginate($perpage);
                // ->paginate($page);
                // ->orderBy('vehiculos.id', 'desc')
                // ->orderBy('vehiculos.id', 'desc') 
                ->orderBy('vehiculos.id', 'desc') // Ordenar por created_at en orden descendente
                ->paginate($perPage, ['*'], 'page', $page);

            // ->paginate($perpage, ['*'], 'page', $page);


            return $this->successResponse($vehiculos, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "vehiculos- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al encontrar vehiculos", Response::HTTP_CONFLICT);
        }
    }


    public function editarVehiculo($request)
    {



        try {
            Log::info(["aaa" => $request]);

            // $usuario = Usuario::where('correo', $request['correo'])->first();

            // if (!$usuario) {
            //     return $this->errorResponse("Ha ocurrido un error al encontrar el usuario", Response::HTTP_CONFLICT);
            // }

            // Validar que el nuevo dueño (si se proporciona) exista
            if (!empty($request['dueno_id'])) {
                $nuevoDueno = Usuario::find($request['dueno_id']);

                if (!$nuevoDueno) {
                    return $this->errorResponse("El usuario especificado no existe", Response::HTTP_NOT_FOUND);
                }
            }



            $vehiculo = Vehiculo::where('patente', $request['patente'])->first();
            if (!$vehiculo) {
                return $this->errorResponse("Ha ocurrido un error al encontrar vehiculo", Response::HTTP_CONFLICT);
            }



            DB::beginTransaction();

            // Verificar si el dueño ha cambiado
            $duenoAnteriorId = $vehiculo->dueno_id;
            $nuevoDuenoId = $request['dueno_id'] ? $request['dueno_id'] : null;

            // Log::info(["duenoAnteriorId" => $duenoAnteriorId]);
            // Log::info(["nuevoDuenoId" => $nuevoDuenoId]);
            // Log::info(["vehiculo" => $vehiculo->id]);



            if ($duenoAnteriorId != $nuevoDuenoId) {
                // Registrar el cambio de dueño en el historial
                HistoricoDueno::create([
                    'vehiculo_id' => $vehiculo->id,
                    'usuario_id' => $nuevoDuenoId,
                ]);
            }
            $vehiculo->update([
                'marca' => $request['marca'],
                'modelo' => $request['modelo'],
                'patente' => $request['patente'],
                'anio' => $request['anio'],
                'precio' => $request['precio'],
                'dueno_id' => $nuevoDuenoId,

            ]);
            DB::commit();
            return $this->successResponse($vehiculo, Response::HTTP_OK);
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

    public function crearVehiculo($request)
    {
        try {
            // Verificar si la patente ya existe
            $vehiculoExistente = Vehiculo::where('patente', $request['patente'])->first();

            if ($vehiculoExistente) {
                return $this->errorResponse("La patente ya está registrada", Response::HTTP_CONFLICT);
            }

            // Validar que el usuario (dueño) existe si se proporciona
            if (!empty($request['dueno_id'])) {
                $usuario = Usuario::find($request['dueno_id']);

                if (!$usuario) {
                    return $this->errorResponse("El usuario especificado no existe", Response::HTTP_NOT_FOUND);
                }
            }

            // Crear el nuevo vehículo
            $vehiculo = Vehiculo::create([
                'marca' => $request['marca'],
                'modelo' => $request['modelo'],
                'patente' => $request['patente'],
                'anio' => $request['anio'],
                'precio' => $request['precio'],
                'dueno_id' => $request['dueno_id'] ?? null,
            ]);

            return $this->successResponse($vehiculo, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "crearVehiculo- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al crear el vehículo", Response::HTTP_CONFLICT);
        }
    }

    public function detalleVehiculo($request)
    {
        try {
            // Buscar el vehículo por ID
            $vehiculo = Vehiculo::select(
                'vehiculos.id',
                'vehiculos.marca',
                'vehiculos.modelo',
                'vehiculos.patente',
                'vehiculos.precio',
                'vehiculos.anio',
                'vehiculos.dueno_id',
                'usuarios.id as id_usuario',
                'usuarios.nombre',
                'usuarios.apellidos'
            )
                ->join("usuarios", 'usuarios.id', '=', 'vehiculos.dueno_id')
                ->where("vehiculos.id", $request["id"])
                ->first();

            if (!$vehiculo) {
                return $this->errorResponse("Vehículo no encontrado", Response::HTTP_NOT_FOUND);
            }

            return $this->successResponse($vehiculo, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error([
                "error ubicado en" => "vehiculos- Repository",
                "archivo" => $e->getFile(),
                "linea" => $e->getLine(),
                "mensaje" => $e->getMessage()
            ]);
            return $this->errorResponse("Ha ocurrido un error al encontrar vehiculos", Response::HTTP_CONFLICT);
        }
    }

    public function eliminarVehiculo($request)
    {



        try {

            $vehiculo = Vehiculo::where('patente', $request['patente'])->first();
            if (!$vehiculo) {
                return $this->errorResponse("Ha ocurrido un error al encontrar vehiculo", Response::HTTP_CONFLICT);
            }



            DB::beginTransaction();
            $vehiculo->delete();
            DB::commit();
            return $this->successResponse($vehiculo, Response::HTTP_OK);
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
