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

    public function nuevonormal() {
        View::template('index/index');        
    }
    
    public function nuevoadmin() {
        
    }
    
    public function editar($id) {
        try {

            $id = (int) $id;

            $usr = new Proveedores();

            $this->proveedor = $usr->find_first($id);

            if ($this->proveedor) {// verificamos la existencia del usuario

                if (Input::hasPost('proveedor')) {

                    if ($usr->guardar(Input::post('usuario'), Input::post('rolesUser'))) {
                        Flash::valid('El Usuario Ha Sido Actualizado Exitosamente...!!!');
                        if (!Input::isAjax()) {
                            return Router::redirect();
                        }
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            } else {
                Flash::warning("No existe ningun usuario con id '{$id}'");
                if (!Input::isAjax()) {
                    return Router::redirect();
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
}

?>
