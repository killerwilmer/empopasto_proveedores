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
Load::models('proveedores', 'contratos');
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

    public function nuevocontrato() {
        if (Input::hasPost('contratos')) {
            $contrato = new Contratos(Input::post("contratos"));
            if ($contrato->save()) {
                Flash::success("Creado correctamente");
                Router::redirect("admin/contratos");
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

    public function proveedores($pagina = 1) {
        try {
            $pro = new Proveedores();
            $this->proveedores = $pro->paginar($pagina);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function nuevoproveedor() {
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
                Flash::success("Creado correctamente");
                Router::redirect("admin/proveedores");
            }
        }
    }

    public function editarproveedor($idproveedor) {
        $this->proveedor = new Proveedores();
        $this->proveedor->find_first($idproveedor);

        if (Input::hasPost("proveedores")) {

            $tid = Input::post("tipo_identificacion");
            $tci = Input::post("ciudad");
            $ten = Input::post("tipo_entidad");
            $tpr = Input::post("tipo_proveedor");

            $proveedor = new Proveedores(Input::post("proveedores"));
            $proveedor->id = $idproveedor;
            $proveedor->tipo_identificacion_id = $tid["tipo_identificacion_id"];
            $proveedor->ciudad_id = $tci["ciudad_id"];
            $proveedor->tipo_entidad_id = $ten["tipo_entidad_id"];
            $proveedor->tipo_proveedor_id = $tpr["tipo_proveedor_id"];
            $proveedor->tipo_user = "2";

            if ($proveedor->update()) {
                Flash::success("Actualizado correctamente");
                Router::redirect("admin/proveedores");
            }
        }
    }

}

?>
