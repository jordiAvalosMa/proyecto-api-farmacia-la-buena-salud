<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente'; // Nombre de la tabla
    protected $fillable = ['id', 'nombre', 'telefono', 'fk_pais']; // Campos de la tabla

}
