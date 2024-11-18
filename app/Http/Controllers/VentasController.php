<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Empleados;
use App\Models\Ventas;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    // Endpoint para obtener un listado de Venta
    public function select()
    {
        try {
            // Query para consultar Venta
            $detalles = Ventas::select(
                'ventas.id',
                'ventas.total_venta',
                'ventas.fecha',
                'ventas.cliente_id',
                'ventas.empleado_id',
                'ventas.tipo_pago',
                'ventas.tipo_venta',
            )->get();
            if ($detalles->count() > 0) {
                // Si hay Venta se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $detalles
                ], 200);
            } else {
                // Si hay Venta se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay Venta'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un Venta
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'total_venta' => 'required',
                'fecha' => 'required',
                'cliente_id' =>  Cliente::all(),
                'empleado_id' =>  Empleados::all(),
                'tipo_pago' => 'required',
                'tipo_venta' => 'required',
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el Venta
                $detalles = Ventas::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Venta insertada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un Venta
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'total_venta' => 'required',
                'fecha' => 'required',
                'cliente_id' =>  Cliente::all(),
                'empleado_id' =>  Empleados::all(),
                'tipo_pago' => 'required',
                'tipo_venta' => 'required',
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el Venta 
                $detalles = Ventas::find($id);
                if ($detalles) {
                    // Si el Venta existe se actualiza
                    $detalles->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Venta actualizada'
                    ], 200);
                } else {
                    // Si el Venta no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Venta no encontrada'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un Venta 
    public function delete($id)
    {
        try {
            // Se busca el Venta 
            $detalles = Ventas::find($id);
            if ($detalles) {
                // Si el Venta existe se elimina
                $detalles->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Envio eliminada'
                ], 200);
            } else {
                // Si el Venta no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Venta no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un Venta
    public function find($id)
    {
        try {
            // Se busca el Venta 
            $detalles = Ventas::find($id);
            if ($detalles) {
                // Si el Venta existe se retornan sus datos  
                $datos = Ventas::select(
                    'ventas.id',
                    'ventas.total_venta',
                    'ventas.fecha',
                    'ventas.cliente_id',
                    'ventas.empleado_id',
                    'ventas.tipo_pago',
                    'ventas.tipo_venta',
                )
                    ->where('marcas.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el Venta no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Venta no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
