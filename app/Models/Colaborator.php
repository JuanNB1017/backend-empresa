<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Colaborator extends Model
{
    use HasFactory;

    // Table
    protected $table = 'colaboradores';

    // Columns
    protected $fillable = [
        'id',
        'nombre_completo',
        'empresa',
        'area',
        'departamento',
        'puesto',
        'fotografia',
        'fecha_alta',
        'estatus',
    ];

    public $timestamps = false;
}
