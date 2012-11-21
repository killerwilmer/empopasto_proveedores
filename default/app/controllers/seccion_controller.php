<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seccion_controller
 *
 * @author Admin
 */
load::models('seccion');

class SeccionController extends ApplicationController {

    public function index($pagina = 1) {
        try {
            $sec = new Seccion();
            $this->seccion = $sec->paginar($pagina);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function editar($id) {
        try {

            $id = (int) $id;

            $sec = new Seccion();

            $this->seccion = $sec->find_first($id);

            if ($this->seccion) {// verificamos la existencia del usuario
                if (Input::hasPost('seccion')) {

                    if ($sec->guardar(Input::post('seccion'))) {
                        Flash::valid('Seccion actualizada correctamente...!!!');
                        if (!Input::isAjax()) {
                            return Router::redirect();
                        }
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            } else {
                Flash::warning("No existe ninguna seccion con id '{$id}'");
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
