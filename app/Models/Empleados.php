<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Empleados extends Model
{
    use HasFactory;

    
    protected $table = 'empleados'; // Nombre de la tabla
    protected $fillable = ['id', 'nombre','usuario_id'];

    public function empleado():HasOne {
        return $this->hasOne(User::class,"id","usuario_id");
    }
}
