<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contratos
 *
 * @author wilmerarteaga
 */
class Contratos extends ActiveRecord {
    //put your code here
    public function paginar($pagina = 1,$idproveedor) {
        return $this->paginate("page: $pagina","proveedores_id=$idproveedor","per_page: 10","order: fechafinal desc");
    }
}

?>