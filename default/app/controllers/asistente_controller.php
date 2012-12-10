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

    function asistente1() {//personales
        Load::model('proveedores');
        View::template("asistente/default");
 
        if (Input::hasPost("proveedores")) {


            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = "3";
            $proveedor->tipousuario_id = "2";

            if ($proveedor->save()) {
                Session::set("idproveedor", $proveedor->id);
                Session::set("idtipoproveedor","2");
                Flash::success("Creado correctamente");
                Router::redirect("asistente/editar/");
                
            }
        }
    }

    function editar() {
         
        Load::models("proveedores","actividad_has_proveedores");
        
        View::template('asistente/default_ribbon');
       
        $idproveedor= Session::get("idproveedor");
        
        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idproveedor);
        
        $actividades = new ActividadHasProveedores();       
        if($actividades->count("proveedores_id=$idproveedor")==0){
            Flash::notice("No tiene ninguna actividad relacionada.");
        }

        if (Input::hasPost("proveedores")) {

            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->id = Session::get("idproveedor");
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = "3";
            

            if ($proveedor->update()) {
                Flash::success("Actualizado correctamente");
                Router::redirect("asistente/editar/");
            }
        }
    }

    function actividades() {
        View::template("asistente/default_ribbon");
        Load::model("actividad_has_proveedores");

        $idproveedor = Session::get("idproveedor");
        $ap = new ActividadHasProveedores();
        $this->actividades = array();
        $this->actividades = $ap->find("proveedores_id=$idproveedor");

        if (Input::hasPost("actividad")) {
            $in = Input::post("actividad");
            $idactividad = $in["actividad_id"];
            $idproveedor = Session::get("idproveedor");

            $ap = new ActividadHasProveedores();
            
            if ($ap->count("actividad_id=$idactividad and proveedores_id=$idproveedor") == 0) {
                $ap->actividad_id = $idactividad;
                $ap->proveedores_id = $idproveedor;
                if ($ap->save()) {
                    Flash::success("Actividad agregada correctamente");
                    Router::redirect("asistente/actividades");
                } else {
                    Flash::error("Error agregando actividad");
                }
            } else {
                Flash::error("La actividad seleccionada ya existe");
            }
        }
    }

    function eliminar($idactividad) {
        View::template("asistente/default_ribbon");
        $idproveedor = Session::get("idproveedor");
        Load::model("actividad_has_proveedores");
        $ap = new ActividadHasProveedores();
        $ap->find_first($idactividad);

        if ($ap->delete()) {
            Flash::success("Se eliminó la actividad correctamente");
            Router::redirect("asistente/actividades");
        } else {
            Flash::error("Se eliminó la actividad correctamente");
            Router::redirect("asistente/actividades");
        }
    }

    //ajax actividades
    public function getDivisiones() {
        View::response('view');
        Load::model("division");
        $division = new Division();
        $this->seccion_id = Input::post('seccion_id');
    }

    public function getActividades() {
        View::response('view');
        Load::model("actividad");
        $actividad = new Actividad();
        $this->division_id = Input::post('division_id');
    }

    //listar contratos del proveedor
    function contratos($pagina = 1) {
        View::template("asistente/default_ribbon");
        Load::model("contratos");
        $idproveedor = Session::get("idproveedor");
        $this->contrato = array();

        try {
            $obj = new Contratos();
            $this->contrato = $obj->paginar($pagina, $idproveedor);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    function repExProvVertical(){
        View::template("asistente/default_ribbon");
        Load::models("actividad","division","seccion","proveedores","actividad_has_proveedores","tipo_identificacion","tipo_entidad","ciudad","contratos");
        Load::lib("PHPExcel/PHPExcel");
        $idproveedor = Session::get("idproveedor");
        $this->obj = new Proveedores();
        $this->obj->find_first($idproveedor);
        
        $ap = new ActividadHasProveedores();
        $this->actividades = array();
        $this->actividades = $ap->find("proveedores_id=$idproveedor");
        
        
    }

}

?>
