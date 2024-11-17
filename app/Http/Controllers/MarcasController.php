<?php

namespace App\Http\Controllers;

use App\Models\Marcas;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class MarcasController extends Controller
{
    // Endpoint para obtener un listado de marcas
    public function select()
    {
        try {
            // Query para consultar marcas
            $marcas = Marcas::select(
                'marcas.id',
                'marcas.nombre'
            )->get();
            if ($marcas->count() > 0) {
                // Si hay marcas se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $marcas
                ], 200);
            } else {
                // Si hay marcas se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay marcas'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un marcas
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required'
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el marcas
                $marcas = Marcas::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Marca insertada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un marcas
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required'
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el marcas 
                $marcas = Marcas::find($id);
                if ($marcas) {
                    // Si el marcas existe se actualiza
                    $marcas->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Marca actualizada'
                    ], 200);
                } else {
                    // Si el marcas no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Marca no encontrada'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un marcas
    public function delete($id)
    {
        try {
            // Se busca el cliente 
            $marcas = Marcas::find($id);
            if ($marcas) {
                // Si el marcas existe se elimina
                $marcas->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Marca eliminada'
                ], 200);
            } else {
                // Si el marcas no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Marcas no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un marcas
    public function find($id)
    {
        try {
            // Se busca el marcas 
            $marcas = Marcas::find($id);
            if ($marcas) {
                // Si el marcas existe se retornan sus datos  
                $datos = Marcas::select(
                    'marcas.id',
                    'marcas.nombre'
                )
                    ->where('marcas.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el marcas no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Marca no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
