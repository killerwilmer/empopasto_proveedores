<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of clientes_controller
 *
 * @author wilmerarteaga
 */

/**
 * Carga de Modelos
 */
Load::models('seccion','division','actividad');
class ClientesController extends AppController{
	public function index() {
 
	}
	public function create(){
		$regiones = new Regiones();
		$this->regiones = $regiones->buscar();
		if(Input::hasPost('clientes')){
			//SUBMIT
		}
	}
	public function getComunas(){
		View::response('view');
		$comunas = new Comunas();
		//$this->comunas = $comunas->buscar(Input::post('regiones_id'));
                $this->comunas = Input::post('regiones_id');
	}
 
	public function getCiudades(){
		View::response('view');
		$ciudades = new Ciudades();
		//$this->ciudades = $ciudades->buscar(Input::post('comunas_id'));
                $this->ciudades = Input::post('comunas_id');
	}
}
?>
