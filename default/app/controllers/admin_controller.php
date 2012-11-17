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
        $this->obj = new Contratos();
        $this->obj->find_first($idcontrato);
    }

}

?>
