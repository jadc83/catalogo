<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distribuidora extends Model
{

    public function desarrolladoras(){

        return $this->belongsToMany(Desarrolladora::class);
    }
    /** @use HasFactory<\Database\Factories\DistribuidoraFactory> */
    use HasFactory;
}
