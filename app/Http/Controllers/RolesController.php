<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RolesController extends Controller
{    
    // Endpoint para obtener un listado de Rol
    public function select()
    {
        try {
            // Query para consultar Rol
            $categorias = Roles::select(
                'roles.id',
                'roles.nombre'
            )->get();
            if ($categorias->count() > 0) {
                // Si hay roles se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $categorias
                ], 200);
            } else {
                // Si hay roles se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay Rol'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un Rol
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
                $categorias = Roles::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Rol insertado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un Rol
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
                // Si se cumple la validación se busca el Rol 
                $categorias = Roles::find($id);
                if ($categorias) {
                    // Si el Rol existe se actualiza
                    $categorias->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Rol actualizado'
                    ], 200);
                } else {
                    // Si el Rol no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Rol no encontrado'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un Rol
    public function delete($id)
    {
        try {
            // Se busca el Rol 
            $cliente = Roles::find($id);
            if ($cliente) {
                // Si el Rol existe se elimina
                $cliente->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Rol eliminado'
                ], 200);
            } else {
                // Si el categorias no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Rol no encontrada'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un Roles
    public function find($id)
    {
        try {
            // Se busca el Roles 
            $categorias = Roles::find($id);
            if ($categorias) {
                // Si el Rol existe se retornan sus datos  
                $datos = Roles::select(
                    'roles.id',
                    'roles.nombre'
                )
                    ->where('roles.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el Rol no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Rol no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
