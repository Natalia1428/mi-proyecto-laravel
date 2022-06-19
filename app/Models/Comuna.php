<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comuna extends Model
{
    public $table = "comunas"; // creamos tabla comunas
    public $timestamps = false; // quitamos campo de tiempo de creacion y actualizacion
    public $primaryKey = "idcomuna"; // establecemos primary key

    public function region (){
        return $this->belongsTo(\App\Models\Regiones::class, "idregion"); //this se refiere a esta clase, en la que estamos trabajando
    }
    
}
