<?php

namespace App\Http\Controllers;

use App\Models\Categorias;
use App\Models\Marcas;
use Illuminate\Http\Request;
use App\Models\Productos;
use Illuminate\Support\Facades\Validator;

class ProductosController extends Controller
{
    // Endpoint para obtener un listado de clientes
    public function select()
    {
        try {
            // Query para consultar producto
            $productos = Productos::with('marca','categoria')->get();
            if ($productos->count() > 0) {
                // Si hay producto se retorna el listado en un json
                return response()->json([
                    'code' => 200,
                    'data' => $productos,
                    'marcas'=> Marcas::all(),
                    'categorias'=> Categorias::all()
                ], 200);
            } else {
                // Si hay producto se un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'No hay productos'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para insertar un producto
    public function store(Request $request)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'precio' => 'required',
                'fk_marca' => 'required',
                'fk_categoria' => 'required'
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se inserta el producto
                $productos = Productos::create($request->all());

                return response()->json([
                    'code' => 200,
                    'data' => 'Producto insertado'
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para modificar un producto
    public function update(Request $request, $id)
    {
        try {
            // Se valida que todos los campos sean requeridos
            $validacion = Validator::make($request->all(), [
                'nombre' => 'required',
                'precio' => 'required',
                'fk_marca' => 'required',
                'fk_categoria' => 'required'
            ]);

            if ($validacion->fails()) {
                // Si no se cumple la validación se devuelve el mensaje de error
                return response()->json([
                    'code' => 400,
                    'data' => $validacion->messages()
                ], 400);
            } else {
                // Si se cumple la validación se busca el producto 
                $productos = Productos::find($id);
                if ($productos) {
                    // Si el producto existe se actualiza
                    $productos->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data' => 'Producto actualizado'
                    ], 200);
                } else {
                    // Si el producto no existe se devuelve un mensaje
                    return response()->json([
                        'code' => 404,
                        'data' => 'Producto no encontrado'
                    ], 404);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para eliminar un producto
    public function delete($id)
    {
        try {
            // Se busca el producto 
            $productos = Productos::find($id);
            if ($productos) {
                // Si el producto existe se elimina
                $productos->delete($id);
                return response()->json([
                    'code' => 200,
                    'data' => 'Producto eliminado'
                ], 200);
            } else {
                // Si el producto no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Producto no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }

    // Endpoint para buscar un producto
    public function find($id)
    {
        try {
            // Se busca el producto 
            $productos = Productos::where('id',$id)->with('marca','categoria')->first();
            if ($productos) {
                return response()->json([
                    'code' => 200,
                    'data' => $productos
                ], 200);
            } else {
                // Si el producto no existe se devuelve un mensaje
                return response()->json([
                    'code' => 404,
                    'data' => 'Producto no encontrado'
                ], 404);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
}
