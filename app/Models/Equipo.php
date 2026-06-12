<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'Codigo',
        'Nombre',   
        'Categoria',
        'Marca',
        'Estado',
    ];

    public function Prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }
}