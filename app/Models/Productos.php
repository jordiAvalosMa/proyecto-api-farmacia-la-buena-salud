<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Productos extends Model
{
    use HasFactory;
    protected $table = 'productos'; // Nombre de la tabla
    protected $fillable = ['id', 'nombre_producto', 'precio', 'stock', 'fk_categoria'];

    public function categoria():HasOne {
        return $this->hasOne(Categorias::class,"id","fk_categoria");
    }
}
