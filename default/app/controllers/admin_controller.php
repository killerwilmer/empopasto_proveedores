<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_controller
 *
 * @author wilmerarteaga
 */
Load::models('proveedores', 'contratos', 'Actividad_Has_Proveedores','contra');
View::template('admin/admin');

class AdminController extends ApplicationController {

    public function index() {
        
    }

    //*** Contratos ***//

    public function contratos() {
        $obj = new Contratos();
        $this->contratos = array();
        $this->contratos = $obj->find();
    }

    public function nuevocontrato($idpro) {
        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idpro);
        if (Input::hasPost('contratos')) {
            $contrato = new Contratos(Input::post("contratos"));
            if ($contrato->save()) {
                Flash::success("Creado correctamente");
                Router::redirect("admin/ponderacion/".$this->proveedor->id);
            }
        }
    }

    public function editarcontrato($idcontrato) {
        $this->objContrato = new Contratos();
        $this->objContrato->find_first($idcontrato);

        if (Input::hasPost("contratos")) {
            $contrato = new Contratos(Input::post("contratos"));
            $contrato->id = Input::post("idcontrato");
            if ($contrato->update()) {
                $this->objContrato = new Contratos();
                $this->objContrato->find_first($idcontrato);
                Flash::success("Modificación exitosa");
            } else {
                Flash::error("No se puede actualizar..");
            }
        }
    }

    public function eliminarcontrato($idcontrato) {
        $this->objContrato = new Contratos();
        $this->objContrato->find_first($idcontrato);

        if (Input::hasPost("contratos")) {
            $contrato = new Contratos();
            $contrato->find_first($idcontrato);
            if ($contrato->delete()) {
                $this->redirect("admin/contratos");
            } else {
                Flash::error("No se pudo eliminar.");
            }
        }
    }

    //*** Proveedores ***//

    function proveedores($pagina = 1) {
        try {
            $pro = new Proveedores();
            $this->proveedores = $pro->paginar($pagina);

            if (Input::hasPost("textoBusqueda")) {
                $comboBusqueda = Input::post("comboBusqueda");
                $textoBusqueda = Input::post("textoBusqueda");

                $obj = new Proveedores();
                $this->proveedores = array();

                if ($textoBusqueda != "") {

                    //IDENTIFICACION
                    if ($comboBusqueda == 0) {
                        $this->proveedores = $obj->find("identificacion=$textoBusqueda");
                    }//APELLIDO
                    else if ($comboBusqueda == 1) {
                        $this->proveedores = $obj->find("apellidos like'%$textoBusqueda%'");
                    }
                } else {
                    Flash::success("Escriba texto de búsqueda");
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function nuevoproveedor() {
        Load::model('proveedores');
        View::template("admin/admin");


        Load::model("proveedores");
        if (Input::hasPost("proveedores")) {


            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];
            $proveedor->tipousuario_id = "2";

            if ($proveedor->save()) {
                Flash::success("Creando correctamente");
                Router::redirect("admin/proveedores");
            }
        }
    }

    public function editarproveedor($idproveedor) {
        Load::model("proveedores");

        View::template('admin/admin');

        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idproveedor);

        if (Input::hasPost("proveedores")) {

            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->id = Input::post("idproveedor");
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];


            if ($proveedor->update()) {
                Flash::success("Actualizado correctamente");
                Router::redirect("admin/proveedores/");
            }
        }
    }

    public function eliminarproveedor($idproveedor) {

        $prov = new Proveedores();
        $ap = new ActividadHasProveedores();
        $cont = new Contratos();

        if ($cont->count("proveedores_id=$idproveedor") == 0) {
            if ($ap->delete("proveedores_id=$idproveedor")) {

                if ($prov->delete($idproveedor)) {
                    Flash::success("Eliminado correctamente");
                    Router::redirect("admin/proveedores/");
                } else {
                    Flash::success("No se pudo eliminar");
                }
            }
        } else {
            Flash::notice("Tiene contratos relacionados imposible eliminar");
            Router::redirect("admin/proveedores");
        }
    }

    function actividades($idproveedor) {
        View::template("admin/admin");
        Load::model("actividad_has_proveedores");

        $ap = new ActividadHasProveedores();
        $this->actividades = array();
        $this->actividades = $ap->find("proveedores_id=$idproveedor");
        $this->idproveedor = $idproveedor;

        if (Input::hasPost("actividad")) {
            $in = Input::post("actividad");
            $idactividad = $in["actividad_id"];
            $idproveedor = Input::post("idproveedor");

            $ap = new ActividadHasProveedores();

            if ($ap->count("actividad_id=$idactividad and proveedores_id=$idproveedor") == 0) {
                $ap->actividad_id = $idactividad;
                $ap->proveedores_id = $idproveedor;
                if ($ap->save()) {
                    Flash::success("Actividad agregada correctamente");
                    Router::redirect("admin/actividades/$idproveedor");
                } else {
                    Flash::error("Error agregando actividad");
                }
            } else {
                Flash::error("La actividad seleccionada ya existe");
            }
        }
    }

    function eliminaractividad($idactividad, $idproveedor) {
        View::template("admin/admin");

        $ap = new ActividadHasProveedores();
        $ap->find_first($idactividad);

        if ($ap->delete()) {
            Flash::success("Se eliminó la actividad correctamente");
            Router::redirect("admin/actividades/$idproveedor");
        } else {
            Flash::error("Se eliminó la actividad correctamente");
            Router::redirect("asistente/actividade/$idproveedor");
        }
    }

     public function ponderacion($idproveedor,$pagina = 1){
        //campos del proveedor
        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idproveedor);
        
        //listamos los contratos del proveedor
        $idpro = $this->proveedor->id;        
        $obj = new Contratos();
        $this->contratos = array();
        $this->contratos2 = $obj->find("proveedores_id=$idpro");
        $this->contratos = $obj->paginar($pagina,$idpro);
    }

}

?>
