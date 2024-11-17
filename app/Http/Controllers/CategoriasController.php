<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CategoriasController extends Controller
{    
    // Endpoint para obtener un listado de categorias
    public function select()
    {
        try {
            // Query para consultar categorias
            $categorias = Categorias::select(
                'categoria.id',
                'categoria.nombre'
            )->get();
            if ($categorias->count() > 0) {
                // Si hay categorias se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $categorias
                ], 200);
            } else {
                // Si hay categorias se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay categorias'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un categorias
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
                // Si se cumple la validación se inserta el categorias
                $categorias = Categorias::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria insertada'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un categorias
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
                $categorias = Categorias::find($id);
                if ($categorias) {
                    // Si el cliente existe se actualiza
                    $categorias->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Categoria actualizada'
                    ], 200);
                } else {
                    // Si el categorias no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Categoria no encontrada'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un categorias
    public function delete($id)
    {
        try {
            // Se busca el cliente 
            $cliente = Categorias::find($id);
            if ($cliente) {
                // Si el categorias existe se elimina
                $cliente->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Categoria eliminada'
                ], 200);
            } else {
                // Si el categorias no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Categoria no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un categorias
    public function find($id)
    {
        try {
            // Se busca el categorias 
            $categorias = Categorias::find($id);
            if ($categorias) {
                // Si el categorias existe se retornan sus datos  
                $datos = Categorias::select(
                    'categoria.id',
                    'categoria.nombre'
                )
                    ->where('categoria.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el categorias no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Cliente no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
