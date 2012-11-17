<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sesion_controller
 *
 * @author equipo1
 */

View::template("sesion/logueo");
class SesionController extends AppController {
    //put your code here
    function index(){
        if(Input::hasPost("identificacion")){
            $login = Input::post("identificacion");
            $clave = Input::post("clave");
            
            $auth = new Auth("model","class: proveedores","identificacion: $login","clave: $clave");
            if($auth->authenticate()){
                $usu = new Proveedores();
                $usu->find_first("identificacion='$login' and clave='$clave'");
                if($usu->tipousuario_id==1){//admin
                    Router::redirect("proveedores/nuevoadmin");
                }
                else if($usu->tipousuario_id==2){//proveedor
                    Session::set("idproveedor", $usu->id);
                    Router::redirect("asistente/editar/");
                }
            }
            else{
                Flash::error("Login o Clave inválido.");
            }
        }
    }
    
    function cerrar(){
        Auth::destroy_identity();
        Router::redirect("sesion/index");
    }
}

?>
