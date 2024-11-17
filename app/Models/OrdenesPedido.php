<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OrdenesPedido extends Model
{
    use HasFactory;
    
    protected $table = 'ordenes_pedido'; // Nombre de la tabla
    protected $fillable = ['id', 'fecha','total_pedido','proveedor_id'];

    
    public function proveedor():HasOne {
        return $this->hasOne(Proveedor::class,"id","proveedor_id");
    }
}
