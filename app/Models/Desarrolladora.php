<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Desarrolladora extends Model
{
    public function videojuegos(){

        return $this->hasMany(Videojuego::class);
    }
    public function distribuidora(){
        return $this->belongsTo(Distribuidora::class); // Desarrolladora pertenece a una distribuidora
    }


    /** @use HasFactory<\Database\Factories\DesarrolladoraFactory> */
    use HasFactory;
}
