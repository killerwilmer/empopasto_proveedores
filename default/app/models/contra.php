<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of contra
 *
 * @author wilmerarteaga
 */
class Contra extends ActiveRecord {
    public $is_view = true;
    
    public function paginar($pagina = 1,$idproveedor) {
        return $this->paginate("page: $pagina","proveedores_id=$idproveedor","per_page: 10","order: fechafinal desc");
    }
    
    public function paginar2($pagina = 1) {
        return $this->paginate("page: $pagina");
    }
}

?>
