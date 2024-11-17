<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetalleOrdenesPedido extends Model
{
    use HasFactory;

    protected $table = 'detalle_ordenes_pedido'; // Nombre de la tabla
    protected $fillable = ['id', 'cantidad','producto_id','pedido_id'];

    public function producto():HasOne {
        return $this->hasOne(Productos::class,"id","producto_id");
    }

    public function ordenesPedido():HasOne {
        return $this->hasOne(OrdenesPedido::class,"id","pedido_id");
    }
}
