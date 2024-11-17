<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class DetalleVenta extends Model
{
    use HasFactory;
    
    protected $table = 'detalle_venta'; // Nombre de la tabla
    protected $fillable = ['id', 'venta_id','producto_id','cantidad'];

    public function producto():HasOne {
        return $this->hasOne(Productos::class,"id","producto_id");
    }

    public function detalleVenta():HasOne {
        return $this->hasOne(DetalleVenta::class,"id","venta_id");
    }
}
