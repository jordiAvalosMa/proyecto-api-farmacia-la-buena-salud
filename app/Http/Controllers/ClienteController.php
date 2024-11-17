<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    // Endpoint para obtener un listado de clientes
    public function select()
    {
        try {
            // Query para consultar clientes
            $clientes = Cliente::select(
                'cliente.id',
                'cliente.nombre',
                'cliente.telefono',
                'pais.nombre as fk_pais'
            )
                ->join('pais', 'cliente.fk_pais', '=', 'pais.id')->get();
            if ($clientes->count() > 0) {
                // Si hay clientes se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $clientes
                ], 200);
            } else {
                // Si hay clientes se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay clientes'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un cliente
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'telefono' => 'required',
                'fk_pais' => 'required'
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el cliente
                $cliente = Cliente::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Cliente insertado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un cliente
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'telefono' => 'required',
                'fk_pais' => 'required'
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el cliente 
                $cliente = Cliente::find($id);
                if ($cliente) {
                    // Si el cliente existe se actualiza
                    $cliente->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Cliente actualizado'
                    ], 200);
                } else {
                    // Si el cliente no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Cliente no encontrado'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un cliente
    public function delete($id)
    {
        try {
            // Se busca el cliente 
            $cliente = Cliente::find($id);
            if ($cliente) {
                // Si el cliente existe se elimina
                $cliente->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Cliente eliminado'
                ], 200);
            } else {
                // Si el cliente no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Cliente no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un cliente
    public function find($id)
    {
        try {
            // Se busca el cliente 
            $cliente = Cliente::find($id);
            if ($cliente) {
                // Si el cliente existe se retornan sus datos  
                $datos = Cliente::select(
                    'cliente.id',
                    'cliente.nombre',
                    'cliente.telefono',
                    'cliente.fk_pais',
                    'pais.nombre as pais'
                )
                    ->join('pais', 'pais.id', '=', 'cliente.fk_pais')
                    ->where('cliente.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el cliente no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Cliente no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
