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
class RegistroController extends ApplicationController {

    public function nuevonormal() {
        Load::model('proveedores');
        View::template('index/index');

        if (Input::hasPost('proveedores')) {

            $miProveedor = new Proveedores(Input::post('proveedores'));
            if ($miProveedor->guardar(Input::post('proveedores'))) {

                Flash::valid('Campos guardados Exitosamente...!!!');
            } else {
                Flash::warning('No se Pudieron Guardar los Datos...!!!');
            }
        }
    }

}

?>
