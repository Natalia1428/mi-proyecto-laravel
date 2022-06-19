<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regiones extends Model // extendemos de Model
{
    public $table = "regiones"; // creamos tabvla regiones
    public $timestamps = false; // quitamos campo de tiempo de creacion y actualizacion
    public $primaryKey = "idregion"; // establecemos primary key

    public function comunas(){
        return $this->hasMany(\App\Models\Comuna::class, "idcomuna");
    }
    
}