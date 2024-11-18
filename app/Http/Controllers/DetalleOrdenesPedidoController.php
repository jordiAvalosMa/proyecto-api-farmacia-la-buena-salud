<?php

namespace App\Http\Controllers;

use App\Models\DetalleOrdenesPedido;
use App\Models\OrdenesPedido;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetalleOrdenesPedidoController extends Controller
{
    // Endpoint para obtener un listado de Detalle
    public function select()
    {
        try {
            // Query para consultar Detalle
            $detalles = DetalleOrdenesPedido::select(
                'detalle_ordenes_pedido.id',
                'detalle_ordenes_pedido.cantidad',
                'detalle_ordenes_pedido.producto_id',
                'detalle_ordenes_pedido.pedido_id'

            )->get();
            if ($detalles->count() > 0) {
                // Si hay Detalle se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $detalles
                ], 200);
            } else {
                // Si hay Detalle se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay Detalle'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un Detalle
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'cantidad' => 'required',
                'producto_id'=>  Productos::all(),
                'pedido_id'=>  OrdenesPedido::all(),
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el Detalle
                $detalles = DetalleOrdenesPedido::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Detalle insertada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un Detalle
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'cantidad' => 'required',
                'producto_id'=>  Productos::all(),
                'pedido_id'=>  OrdenesPedido::all(),
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el Detalle 
                $detalles = DetalleOrdenesPedido::find($id);
                if ($detalles) {
                    // Si el Detalle existe se actualiza
                    $detalles->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Detalle actualizada'
                    ], 200);
                } else {
                    // Si el Detalle no existe se devuelve un mensaje
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

    // Endpoint para eliminar un Detalle 
    public function delete($id)
    {
        try {
            // Se busca el Detalle 
            $detalles = DetalleOrdenesPedido::find($id);
            if ($detalles) {
                // Si el Detalle existe se elimina
                $detalles->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Detalle eliminada'
                ], 200);
            } else {
                // Si el Detalle no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Detalle no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un Detalle
    public function find($id)
    {
        try {
            // Se busca el Detalle 
            $detalles = DetalleOrdenesPedido::find($id);
            if ($detalles) {
                // Si el Detalle existe se retornan sus datos  
                $datos = DetalleOrdenesPedido::select(
                    'detalle_ordenes_pedido.id',
                    'detalle_ordenes_pedido.cantidad',
                    'detalle_ordenes_pedido.producto_id',
                    'detalle_ordenes_pedido.pedido_id'
                )
                    ->where('marcas.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el Detalle no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Detalle no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
