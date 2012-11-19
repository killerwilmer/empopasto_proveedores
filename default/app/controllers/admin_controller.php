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

}

?>
