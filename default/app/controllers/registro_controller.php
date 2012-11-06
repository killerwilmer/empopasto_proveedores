<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registro_controller
 *
 * @author wilmerarteaga
 */
Load::models('proveedores');

class RegistroController extends ApplicationController {
        public function nuevonormal() {
        View::template('index/index');        
    }
}

?>
