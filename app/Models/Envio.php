<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Envio extends Model
{
    use HasFactory;

    protected $table = 'envio'; // Nombre de la tabla
    protected $fillable = ['id', 'venta_id','estado_envio','consto_envio','fecha_envio'];

    
    public function venta():HasOne {
        return $this->hasOne(Ventas::class,"id","venta_id");
    }
}
