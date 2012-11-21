<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of division
 *
 * @author Admin
 */
class Division extends ActiveRecord {
    //put your code here
     public function buscar($seccion_id) {
        return $this->find("seccion_id = $seccion_id", 'order: nombre');
    }
}

?>
