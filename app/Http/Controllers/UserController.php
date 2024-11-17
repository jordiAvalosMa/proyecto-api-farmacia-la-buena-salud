<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;//para validaciones
use App\Models\User;//para tener acceso al modelo
use Illuminate\Support\Facades\Auth;//agregar para el inicio de sesion

class UserController extends Controller
{
    // Endpoint para crear un usuario
    public function register(Request $request){
        try {
            // Se validan los campos que se reciben
            $validacion = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            ]);
            if($validacion->fails()){
                // Si la validación no se cumple, se retornan los mensajes de error
                return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
                ], 400);
            } else {
                // Si la validación no falla, se crea el usuario y se retorna la respuesta
                $usuario = User::create($request->all());
                return response()->json([
                'code' => 200,
                // Se retornan los datos del usuario creado
                'data' => $usuario,
                // Se crea un token para el usuario creado
                'token' => $usuario->createToken('api-key')->plainTextToken
                ], 200);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    // Endpoint para validar login
    public function login(Request $request){
        try {
            // Se validan los campos que se reciben
            $validacion = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
            ]);
            if($validacion->fails()){
                // Si la validación no se cumple, se retornan los mensajes de error
                return response()->json([
                'code' => 400,
                'data' => $validacion->messages()
                ], 400);
            } else {
                // Se verifica que el email y password pertenezcan a un usuario
                if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
                    // Se extraen los datos del usuario que coincida
                    $usuario = User::where('email', $request->email)->first();
                    return response()->json([
                    'code' => 200,
                    // Se retornan los datos del usuario
                    'data' => $usuario,
                    // Se crea un token para el usuario
                    'token' => $usuario->createToken('api-key')->plainTextToken
                    ], 200);
                } else {
                    // Si el email y password no pertenecen a un usuario registrado,
                    // se retorna un mensaje con código 401
                    return response()->json([
                    'code' => 401,
                    'data' => 'Usuario no autorizado',
                    ], 401);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), 500);
        }
    }
    
}
