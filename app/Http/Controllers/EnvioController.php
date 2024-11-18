<?php

namespace App\Http\Controllers;

use App\Models\Empleados;
use App\Models\Envio;
use App\Models\Ventas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    // Endpoint para obtener un listado de Envio
    public function select()
    {
        try {
            // Query para consultar Envio
            $detalles = Envio::select(
                'envio.id',
                'envio.venta_id',
                'envio.estado_envio',
                'envio.costo_envio',
                'envio.fecha_entrega',
                'envio.empleado_id'
            )->get();
            if ($detalles->count() > 0) {
                // Si hay Envio se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $detalles
                ], 200);
            } else {
                // Si hay Envio se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay Envio'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un Envio
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'venta_id' =>  Ventas::all(),
                'estado_envio' => 'required',
                'costo_envio' => 'required',
                'fecha_entrega' => 'required',
                'empleado_id' =>  Empleados::all(),
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el Envio
                $detalles = Envio::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Envio insertada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un Envio
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'venta_id' =>  Ventas::all(),
                'estado_envio' => 'required',
                'costo_envio' => 'required',
                'fecha_entrega' => 'required',
                'empleado_id' =>  Empleados::all(),
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el Envio 
                $detalles = Envio::find($id);
                if ($detalles) {
                    // Si el Envio existe se actualiza
                    $detalles->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Envio actualizada'
                    ], 200);
                } else {
                    // Si el Envio no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Envio no encontrada'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un Envio 
    public function delete($id)
    {
        try {
            // Se busca el Envio 
            $detalles = Envio::find($id);
            if ($detalles) {
                // Si el Envio existe se elimina
                $detalles->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Envio eliminada'
                ], 200);
            } else {
                // Si el Envio no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Envio no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un Envio
    public function find($id)
    {
        try {
            // Se busca el Envio 
            $detalles = Envio::find($id);
            if ($detalles) {
                // Si el Envio existe se retornan sus datos  
                $datos = Envio::select(
                    'envio.id',
                    'envio.venta_id',
                    'envio.estado_envio',
                    'envio.costo_envio',
                    'envio.fecha_entrega',
                    'envio.empleado_id'
                )
                    ->where('marcas.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el Envio no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Envio no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
