<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';// Nombre de la tabla
    protected $fillable = ['id', 'nombre_proveedor','direccion','telefono']; 
}
