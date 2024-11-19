<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    // Endpoint para obtener un listado de proveedores
    public function select()
    {
        try {
            // Query para consultar proveedor
            $proveedores = Proveedor::select(
                'proveedor.id',
                'proveedor.nombre_proveedor',
                'proveedor.direccion',
                'proveedor.telefono'
            )->get();
            if ($proveedores->count() > 0) {
                // Si hay proveedor se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $proveedores
                ], 200);
            } else {
                // Si hay proveedor se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay proveedor'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un proveedor
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
                // Si se cumple la validación se inserta el proveedor
                $proveedores = Proveedor::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Proveedor insertado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un proveedor
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
                // Si se cumple la validación se busca el proveedor 
                $proveedores = Proveedor::find($id);
                if ($proveedores) {
                    // Si el cliente existe se actualiza
                    $proveedores->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Proveedor actualizado'
                    ], 200);
                } else {
                    // Si el proveedor no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Proveedor no encontrado'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un proveedor
    public function delete($id)
    {
        try {
            // Se busca el proveedor 
            $proveedores = Proveedor::find($id);
            if ($proveedores) {
                // Si el proveedor existe se elimina
                $proveedores->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Proveedor eliminado'
                ], 200);
            } else {
                // Si el proveedor no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Proveedor no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un proveedor
    public function find($id)
    {
        try {
            // Se busca el proveedor 
            $proveedores = Proveedor::find($id);
            if ($proveedores) {
                // Si el proveedor existe se retornan sus datos  
                $datos = Proveedor::select(
                    'proveedor.id',
                    'proveedor.nombre_proveedor',
                    'proveedor.direccion',
                    'proveedor.telefono'
                )
                    ->where('proveedor.id', '=', $id)
                    ->get();
                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                ], 200);
            } else {
                // Si el proveedor no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Proveedor no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
