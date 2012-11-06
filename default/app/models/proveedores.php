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

    public function initialize() {

        $this->validates_presence_of('email', 'message: Debe escribir un <b>correo electronico</b>');
        $this->validates_email_in('email', 'message: Debe escribir un <b>correo electronico</b> válido');
        $this->validates_presence_of('tipo_proveedor_id', 'message: Debe escojer un <b>Tipo de proveedor.</b>');
        $this->validates_presence_of('tipo_entidad_id', 'message: Debe escojer un <b>Tipo de entidad.</b>');
        $this->validates_presence_of('ciudad_id', 'message: Debe escojer una <b>Ciudad.</b>');
        $this->validates_presence_of('tipo_identificacion_id', 'message: Debe escojer un  <b>Tipo de identificación.</b>');
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

    public function guardar($proveedores) {

        $this->begin(); //iniciamos la trasaccion

        if (!$this->save($proveedores)) {
            $this->rollback();
            return FALSE;
        }
        $this->commit();
        return TRUE;
    }

}

?>
