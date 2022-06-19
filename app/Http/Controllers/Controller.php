<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request; // usaremos request
use App\Models\Regiones; // usaremos moler Regiones
use App\Models\Comuna; // usaremos moler Regiones
use Illuminate\Support\Str;



class Controller extends BaseController
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    // 5 metodos para modificar registro

    public function listarRegiones(){ // funcion para mostrar regiones
        $regiones = Regiones::get(); 
        $totalRegiones = sizeof($regiones);
        if ($totalRegiones == "0"){
            return "No existen regiones que mostrar";
        }
        else{
            return $regiones;
        }
    }

    public function guardarRegion(Request $request){ // le damos por parametro un objeto de tipo Request 
        
        $nombre = Str::lower($request ->nombre );
        $variable = (Regiones::select("nombre")->where("nombre", $nombre))->first();
   
        if ($variable != null){
            if ($variable->nombre == $nombre) {
                return "Region ya existe en nuestros registros, no la puede guardar de nuevo Ja!";
            }
        }
        else{
            
            $descripcion = $request -> descripcion;//  recupera lo que esta en descripion y lo guarda en $descripcion (campode tabla)
    
            // para crear una nueva region, sera de tipo modelo Regiones
            $nuevaRegion = new Regiones(); // usamos un constructor tipo modelo de regiones, donde id es autoincrementable,
                                           // y los parametros nombre y descripcion le asignamos valor 
                                           // una vez creada la nueva region tenemos que pasarle para que rellene los campos, le entregamos valores a travez de las variables creadas
            $nuevaRegion -> nombre = $nombre;  // ***** por que en ese orden? 
            $nuevaRegion -> descripcion = $descripcion;
            $nuevaRegion -> save(); // metodo guardar
            return "Region añadida"; // retorna ok cuando agrego nuevo registro
            
            
        }
       
    }

    public function actualizarRegion(Request $request, $id){
        if ((Regiones::where("idregion", $id)->first()) == null ){
            return "La region que desea actualizar no es valida";

        }
        else {
            $regionActualizada = Regiones::where("idregion", $id)->first();


            $nombre = $request -> nombre; 
            $descripcion = $request -> descripcion;
    
    
            $regionActualizada -> nombre = $nombre;//??? podria poner $regionActualizada->nombre = $request->nombre; sin tener que declarar variablea arriba????
            $regionActualizada -> descripcion = $descripcion;
            $regionActualizada -> save();
    
            return "Región Actualizada ";
        }

      
    }

    public function consultarRegion($id){
       
        if (Regiones::where("idregion", $id)->first() == null) {
            return "region consultada no existe";
        }
        else {
            $regionConsulta = Regiones::where("idregion", $id)->first();

            return $regionConsulta;
            //return ("Mostrando region " + $id + ", codigo: 001, Region { " + $regionConsulta + " }");
             
            //{mensaje: "mostrando region 2",  codigo: 001 , region: { idregion:1 , region: "Atacama"}}
    
    
        }
        
    }

    public function eliminarRegion($id){

        if(Comuna::where('idregion', '=', $id)->first() != null){
            return "La región no puede ser eliminada";
        }
        else{

            if(Regiones::where("idregion", '=', $id)->first() == null){
                return "No existe la region que desea eliminar";

            }else 
            {
            
                $Region = Regiones::where("idregion", $id)->first();
            
                $Region->delete();
                return "Region eliminada correctamente"; 
            }
              }
    }

    public function guardarComuna(Request $request){ // le damos por parametro un objeto de tipo Request 
        
        // basicamente creamos dos variables y le asigamos el valor  de lo que vamos a buscar por el request 
        $nombre = $request -> nombre; // $nombre es esta variable, igual al campo de tabla. $request -> nombre; es el que le damos cuando agregamos registro nuevo
        $descripcion = $request -> descripcion;//  recupera lo que esta en descripion y lo guarda en $descripcion (campode tabla)
        $idregion = $request -> idregion; // para crear una nueva region, sera de tipo modelo Regiones
        $nuevaComuna = new Comuna(); // usamos un constructor tipo modelo de regiones, donde id es autoincrementable,
                                       // y los parametros nombre y descripcion le asignamos valor 
        // una vez creada la nueva region tenemos que pasarle para que rellene los campos, le entregamos valores a travez de las variables creadas
        $nuevaComuna -> nombre = $nombre;  // ***** por que en ese orden? 
        $nuevaComuna -> descripcion = $descripcion;
        $nuevaComuna -> idregion = $idregion;


        $nuevaComuna -> save(); // metodo guardar
        return "Comuna ingresada con exito"; // retorna ok cuando agrego nuevo registro
    }

    public function listarComuna(){ 
        $comunas = Comuna::get(); 
        return $comunas;
    }

    public function listarComunaReg($idregion){ 

        if (Comuna::where("idregion", $idregion) == null){
            return "La Region no tiene comunas asociadas";
        }else {
            $comunas = Comuna::select("*")
                     ->where("idregion", $idregion)
                     ->get(); 
            return $comunas;
        }
        
        
    }

    public function actualizarComuna(Request $request, $id){

        if(Comuna::where("idcomuna", $id)->first() == null){
            return "La comuna que desea actualizar no es valida";
        }
        else{
        
        $comunaActualizada = Comuna::where("idcomuna", $id)->first();

        $nombre = $request -> nombre; 
        $descripcion = $request -> descripcion;
        $idregion = $request -> idregion;


        $comunaActualizada -> nombre = $nombre;//??? podria poner $regionActualizada->nombre = $request->nombre; sin tener que declarar variablea arriba????
        $comunaActualizada -> descripcion = $descripcion;
        $comunaActualizada -> idregion = $idregion;

        $comunaActualizada -> save();

        return "Comuna Actualizada ";

        }

        
    }

    public function consultarComuna($id){
  
        if (Comuna::where("idcomuna", $id)->first() == null){
            return "No existe la comuna que desea consultar";
        }else{
            $comunaConsulta = Comuna::where("idcomuna", $id)->first();
            return $comunaConsulta;

        }


}

public function eliminarComuna($id){
     
    if (Comuna::where("idcomuna", $id)->first() == null) {
        return "No existe la comuna que desea eliminar";
    }
    else {
        $comunaEliminar = Comuna::where("idcomuna", $id)->first();
        $comunaEliminar ->delete();
        return "Comuna eliminada correctamente";

    }

}




}