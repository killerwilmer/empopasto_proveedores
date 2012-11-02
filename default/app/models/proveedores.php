<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of proveedores
 *
 * @author wilmerarteaga
 */
class Proveedores extends ActiveRecord {

    /**
     * Devuelve los usuarios de la bd Paginados.
     * 
     * @param  integer $pagina numero de pagina a mostrar
     * @return array          resultado de la consulta
     */
    public function paginar($pagina = 1) {
        return $this->paginate("page: $pagina");
    }

}

?>
