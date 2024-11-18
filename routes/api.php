<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//para los controladores
use App\Http\Controllers\PaisController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriasController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProveedorController;
use App\Models\DetalleOrdenesPedido;
use App\Models\DetalleVenta;
use App\Models\Envio;
use App\Models\OrdenesPedido;
use App\Models\Ventas;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Rutas para gestionar la tabla Cliente
    Route::get('/cliente/select', [ClienteController::class, 'select']);
    Route::post('/cliente/store', [ClienteController::class, 'store']);
    Route::put('/cliente/update/{id}', [ClienteController::class, 'update']);
    Route::delete('/cliente/delete/{id}', [ClienteController::class, 'delete']);
    Route::get('/cliente/find/{id}', [ClienteController::class, 'find']);

    // Rutas para gestionar la tabla Categorias
    Route::get('/categorias/select', [CategoriasController::class, 'select']);
    Route::post('/categorias/store', [CategoriasController::class, 'store']);
    Route::put('/categorias/update/{id}', [CategoriasController::class, 'update']);
    Route::get('/categorias/find/{id}', [CategoriasController::class, 'find']);
    Route::delete('/categorias/delete/{id}', [CategoriasController::class, 'delete']);

    // Rutas para gestionar la tabla Productos
    Route::get('/productos/select', [ProductosController::class, 'select']);
    Route::post('/productos/store', [ProductosController::class, 'store']);
    Route::put('/productos/update/{id}', [ProductosController::class, 'update']);
    Route::get('/productos/find/{id}', [ProductosController::class, 'find']);
    Route::delete('/productos/delete/{id}', [ProductosController::class, 'delete']);

    // Rutas para gestionar la tabla Proveedores
    Route::get('/proveedor/select', [ProveedorController::class, 'select']);
    Route::post('/proveedor/store', [ProveedorController::class, 'store']);
    Route::put('/proveedor/update/{id}', [ProveedorController::class, 'update']);
    Route::get('/proveedor/find/{id}', [ProveedorController::class, 'find']);
    Route::delete('/proveedor/delete/{id}', [ProveedorController::class, 'delete']);

    // Rutas para gestionar la tabla Detalle_Ordenes_Pedido
    Route::get('/detalle_ordenes_pedido/select', [DetalleOrdenesPedido::class, 'select']);
    Route::post('/detalle_ordenes_pedido/store', [DetalleOrdenesPedido::class, 'store']);
    Route::put('/detalle_ordenes_pedido/update/{id}', [DetalleOrdenesPedido::class, 'update']);
    Route::get('/detalle_ordenes_pedido/find/{id}', [DetalleOrdenesPedido::class, 'find']);
    Route::delete('/detalle_ordenes_pedido/delete/{id}', [DetalleOrdenesPedido::class, 'delete']);

    // Rutas para gestionar la tabla Detalle_Venta
    Route::get('/detalle_venta/select', [DetalleVenta::class, 'select']);
    Route::post('/detalle_venta/store', [DetalleVenta::class, 'store']);
    Route::put('/detalle_venta/update/{id}', [DetalleVenta::class, 'update']);
    Route::get('/detalle_venta/find/{id}', [DetalleVenta::class, 'find']);
    Route::delete('/detalle_venta/delete/{id}', [DetalleVenta::class, 'delete']);

    // Rutas para gestionar la tabla Envio
    Route::get('/envio/select', [Envio::class, 'select']);
    Route::post('/envio/store', [Envio::class, 'store']);
    Route::put('/envio/update/{id}', [Envio::class, 'update']);
    Route::get('/envio/find/{id}', [Envio::class, 'find']);
    Route::delete('/envio/delete/{id}', [Envio::class, 'delete']);

    // Rutas para gestionar la tabla Orden
    Route::get('/ordenes_pedido/select', [OrdenesPedido::class, 'select']);
    Route::post('/ordenes_pedido/store', [OrdenesPedido::class, 'store']);
    Route::put('/ordenes_pedido/update/{id}', [OrdenesPedido::class, 'update']);
    Route::get('/ordenes_pedido/find/{id}', [OrdenesPedido::class, 'find']);
    Route::delete('/ordenes_pedido/delete/{id}', [OrdenesPedido::class, 'delete']);

        // Rutas para gestionar la tabla Orden
        Route::get('/ventas/select', [Ventas::class, 'select']);
        Route::post('/ventas/store', [Ventas::class, 'store']);
        Route::put('/ventas/update/{id}', [Ventas::class, 'update']);
        Route::get('/ventas/find/{id}', [Ventas::class, 'find']);
        Route::delete('/ventas/delete/{id}', [Ventas::class, 'delete']);

    // Rutas para gestionar la tabla Pais
    // Route::get('/pais/select', [PaisController::class, 'select' ]);
});

//Rutas para usuario
Route::post('/usuario/register', [UserController::class, 'register']);
Route::post('/usuario/login', [UserController::class, 'login']);
