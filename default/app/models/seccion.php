<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of seccion
 *
 * @author Admin
 */
class Seccion extends ActiveRecord {

    public function initialize() {
        $this->validates_presence_of('nombre', 'message: Campo necesario  <b>Nombre.</b>');
    }

    /**
     * Devuelve los usuarios de la bd Paginados.
     * 
     * @param  integer $pagina numero de pagina a mostrar
     * @return array          resultado de la consulta
     */
    public function paginar($pagina = 1) {
        return $this->paginate("page: $pagina");
    }

    public function guardar($seccion) {

        $this->begin(); //iniciamos la trasaccion

        if (!$this->save($seccion)) {
            $this->rollback();
            return FALSE;
        }
        $this->commit();
        return TRUE;
    }

}

?>