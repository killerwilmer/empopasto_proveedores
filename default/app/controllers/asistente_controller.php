<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of asistente_controller
 *
 * @author equipo1
 */


class AsistenteController extends AppController {
     
     
    //put your code here
    
    function asistente1(){//personales
        View::template("asistente/default");
        Load::model("proveedores");
        if(Input::hasPost("proveedores")){
            
            
            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");
            
            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->tipo_identificacion_id= $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id= $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];
            $proveedor->tipo_user="2";
            
            if($proveedor->save()){
                Flash::success("Creado correctamente");
                Router::redirect("asistente/editar");
            }
            
        }
    }
    
    function editar(){
        View::template("asistente/default_ribbon");
         Load::model("proveedores");
         
         $idproveedor = Session::get("idproveedor");
         $this->proveedor = new Proveedores();
         $this->proveedor->find_first($idproveedor);
         
        if(Input::hasPost("proveedores")){
            
            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");
            
            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->id = Session::get("idproveedor");
            $proveedor->tipo_identificacion_id= $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id= $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];
            $proveedor->tipo_user="2";
            
            if($proveedor->update()){
                Flash::success("Actualizado correctamente");
                Router::redirect("asistente/editar");
            }
            
        }
    }
    
    function actividades(){
         View::template("asistente/default_ribbon");
    }
    
   
}

?>
