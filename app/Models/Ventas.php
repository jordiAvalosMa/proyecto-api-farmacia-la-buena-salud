<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ventas extends Model
{
    use HasFactory;

    protected $table = 'ventas';// Nombre de la tabla
    protected $fillable = ['id', 'total_venta', 'fecha', 'cliente_id', 'empleado_id', 'tipo_pago', 'estado_venta'];

    public function empleado():HasOne {
        return $this->hasOne(Empleados::class,"id","cliente_id");
    }

    public function cliente():HasOne {
        return $this->hasOne(Cliente::class,"id","cliente_id");
    }
}
