<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'nombre',   
        'documento',
        'correo',
        'tipo',
    ];
    public function Prestamo()
    {
        return $this->hasMany(Prestamo::class);
    }    
}
