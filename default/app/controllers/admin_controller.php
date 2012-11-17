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
        Load::model("Contratos");
        $obj = new Contratos();
        $this->contratos = array();
        $this->contratos = $obj->find();
    }
    
    public function nuevocontrato(){
        
    }

}

?>
