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
                    Session::set("idproveedor", $usu->id);
                    Session::set("idtipoproveedor",$usu->tipousuario_id);
                    Router::redirect("admin/index");
                }
                else if($usu->tipousuario_id==2){//proveedor
                    Session::set("idproveedor", $usu->id);
                    Session::set("idtipoproveedor",$usu->tipousuario_id);
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
        Session::delete("idproveedor");
        Session::delete("idtipoproveedor");
        Router::redirect("sesion/index");
    }
    
    function recordar(){
        if(Input::hasPost("correo")){
            $email = Input::post("correo");
            
            Load::lib("Email//Email");

            $usu = new Proveedores();
            $condicion = "conditions: email='$email'";
            $usu->find_first($condicion);

            if ($usu) {

                $mensaje = "Su contraseña es:".$usu->clave;
                $html= "Mensaje: " . $mensaje . "\n";
                Email::enviar($email,$html);
                Flash::notice("La contraseña fue enviada a su email.");
            }
            else{
                Flash::warning("Usuario no encontrado en la base de datos");
            }
        }
    }
}

?>
