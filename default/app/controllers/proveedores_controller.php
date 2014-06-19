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
View::template('admin/admin');

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

            $pro = new Proveedores();

            $this->proveedor = $pro->find_first($id);

            if ($this->proveedor) {// verificamos la existencia del usuario
                if (Input::hasPost('proveedor')) {

                    if ($pro->guardar(Input::post('proveedor'))) {
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

    public function eliminar($id = NULL) {
        try {
            $pro = new Proveedores();
            if (is_int($id)) {


                if (!$pro->find_first($id)) { //si no existe
                    Flash::warning("No existe ningun Usuario con id '{$id}'");
                } else if ($pro->delete()) {
                    Flash::valid("El Usuario <b>"+ $pro->nombres . $pro->apellidos +"</b> fué Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudo Eliminar el Rol <b>{$pro->nombres}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($pro->delete_all("id IN ($id)")) {
                    Flash::valid("Los usuarios <b>{$id}</b> fueron Eliminados...!!!");
                } else {
                    Flash::warning("No se Pudieron Eliminar los Usuarios...!!!");
                }
            } elseif (Input::hasPost('roles_id')) {
                $this->ids = Input::post('roles_id');
                return;
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }

}

?>
