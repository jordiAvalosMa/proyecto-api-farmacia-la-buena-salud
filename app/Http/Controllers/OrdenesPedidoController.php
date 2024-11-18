<?php

namespace App\Http\Controllers;

use App\Models\OrdenesPedido;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrdenesPedidoController extends Controller
{
    // Endpoint para obtener un listado de Orden
    public function select()
    {
        try {
            // Query para consultar Orden
            $detalles = OrdenesPedido::select(
                'ordenes_pedido.id',
                'ordenes_pedido.fecha',
                'ordenes_pedido.total_pedido',
                'ordenes_pedido.proveedor_id'
            )->get();
            if ($detalles->count() > 0) {
                // Si hay Orden se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $detalles
                ], 200);
            } else {
                // Si hay Orden se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay Orden'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un Orden
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'fecha' => 'required',
                'total_pedido' => 'required',
                'proveedor_id' =>  Proveedor::all()
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el Orden
                $detalles = OrdenesPedido::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Orden insertada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un Orden
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'fecha' => 'required',
                'total_pedido' => 'required',
                'proveedor_id' =>  Proveedor::all()
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el Orden 
                $detalles = OrdenesPedido::find($id);
                if ($detalles) {
                    // Si el Orden existe se actualiza
                    $detalles->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Detalle actualizada'
                    ], 200);
                } else {
                    // Si el Orden no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Detalle no encontrada'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un Orden 
    public function delete($id)
    {
        try {
            // Se busca el Orden 
            $detalles = OrdenesPedido::find($id);
            if ($detalles) {
                // Si el Orden existe se elimina
                $detalles->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Orden eliminada'
                ], 200);
            } else {
                // Si el Orden no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Orden no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un Orden
    public function find($id)
    {
        try {
            // Se busca el Orden 
            $detalles = OrdenesPedido::find($id);
            if ($detalles) {
                // Si el Orden existe se retornan sus datos  
                $datos = OrdenesPedido::select(
                    'ordenes_pedido.id',
                    'ordenes_pedido.fecha',
                    'ordenes_pedido.total_pedido',
                    'ordenes_pedido.proveedor_id'
                )
                    ->where('marcas.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el Orden no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Orden no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
