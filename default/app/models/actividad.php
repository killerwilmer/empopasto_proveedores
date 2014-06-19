<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of actividad
 *
 * @author wilmerarteaga
 */
class Actividad extends ActiveRecord {
    //put your code here
    public function buscar($division_id) {
        return $this->find("division_id = $division_id", 'order: nombre');
    }
}

?>
