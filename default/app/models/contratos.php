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
    
    public function paginar2($pagina = 1) {
        return $this->paginate("page: $pagina");
    }
    
    function getRepProveedor($idproveedor){
        $sql = "
                select c.id,p.identificacion,p.razonsocial,c.numero,
                c.objeto,c.valorini,c.fechaini,
                c.fechafinal,c.puntaje
                 from proveedores p,contratos c
                where p.id = c.proveedores_id and p.id=$idproveedor";
        
        return $this->find_all_by_sql($sql);
    }
    
    function getPonderadoPorProveedor($idproveedor){
        $sql  = "select sum(valorini) as suma from contratos where proveedores_id=$idproveedor";
        $valor = $this->find_by_sql($sql);
        $sql  = "select valorini*puntaje as parcial from contratos where proveedores_id=$idproveedor";
        $parciales = $this->find_all_by_sql($sql);
        $parc =0;
        
        foreach ($parciales as $obj){
            $parc+=$obj->parcial;
        }
        if($valor->suma>0){
        return round($parc/$valor->suma,2);
        }
        else{
            return 0;
        }
        
    }
}

?>