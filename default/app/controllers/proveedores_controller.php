<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of proveedores_controller
 *
 * @author wilmerarteaga
 */
Load::models('proveedores');

class ProveedoresController extends ApplicationController {

    public function index($pagina = 1) {
        try {
            $pro = new Proveedores();
            $this->proveedores = $pro->paginar($pagina);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function nuevo() {
        
    }

}

?>
