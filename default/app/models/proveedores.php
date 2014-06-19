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

    public $logger=false;
    
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
    
    function getRepExProv($idproveedor){
        $sql = "select p.id,p.identificacion,p.razonsocial,p.nombres,p.apellidos,p.direccion,p.telefono,
                p.celular,p.email,s.nombre as seccion,a.nombre as actividad,d.nombre as division
                from proveedores p,actividad a,actividad_has_proveedores ap,division d,seccion s
                where p.id=ap.proveedores_id and a.id=ap.actividad_id and a.division_id=d.id
                and d.seccion_id=s.id and p.id=$idproveedor";
        
        return $this->find_all_by_sql($sql);
    }

}

?>
