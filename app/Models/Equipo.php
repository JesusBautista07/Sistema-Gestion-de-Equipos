<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo',
        'nombre',   
        'categoria',
        'marca',
        'estado',
    ];

    public function Prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }
}