<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmpleadosController extends Controller
{
    // Endpoint para obtener un listado de Empleado
    public function select()
    {
        try {
            // Query para consultar Empleado
            $empleados = Empleados::select(
                'empleados.id',
                'empleados.nombre',
                'empleados.usuario_id'
            )->get();
            if ($empleados->count() > 0) {
                // Si hay Empleado se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $empleados
                ], 200);
            } else {
                // Si hay Empleado se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay empleado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un Empleado
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'usuario_id'=>  User::all(),
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el Empleado
                $empleados = Empleados::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Empleado insertado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un Empleado
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'usuario_id'=>  User::all(),
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el Empleado 
                $empleados = Empleados::find($id);
                if ($empleados) {
                    // Si el cliente existe se actualiza
                    $empleados->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Empleado actualizado'
                    ], 200);
                } else {
                    // Si el Empleado no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Empleado no encontrado'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un Empleado
    public function delete($id)
    {
        try {
            // Se busca el Empleado 
            $empleados = Empleados::find($id);
            if ($empleados) {
                // Si el Empleado existe se elimina
                $empleados->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Empleado eliminado'
                ], 200);
            } else {
                // Si el Empleado no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Empleado no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un Empleado
    public function find($id)
    {
        try {
            // Se busca el Empleado 
            $empleados = Empleados::find($id);
            if ($empleados) {
                // Si el Empleado existe se retornan sus datos  
                $datos = Empleados::select(
                    'empleados.id',
                    'empleados.nombre',
                    'empleados.usuario_id'
                )
                    ->where('categoria.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el Empleado no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Empleado no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
