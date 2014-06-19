<?php

/**
 * Backend - KumbiaPHP Backend
 * PHP version 5
 * LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Libs
 * @license http://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE version 3.
 * @author Manuel José Aguirre Garcia <programador.manuel@gmail.com>
 */
class MyAuth
{

    protected static $_clave_sesion = PUBLIC_PATH;

    public static function autenticar($user, $pass, $encriptar = TRUE)
    {        
        Session::set(self::$_clave_sesion . '_sesion_activa', false);
        //$pass = $encriptar ? self::hash($pass) : $pass;

        $auth = new Auth("model", "class: proveedores", "identificacion: $user", "contrasena: $pass");
        if ($auth->authenticate()) {
            Session::set(self::$_clave_sesion . '_sesion_activa', true);
            if (Input::post('recordar')) {
                self::setCookies($user, $pass);
            } else {
                self::deleteCookies();
            }
        }
        return self::es_valido();
    }

    public static function es_valido()
    {
        return Session::get(self::$_clave_sesion . '_sesion_activa');
    }

    public static function cerrar_sesion()
    {
        Auth::destroy_identity();
        Session::delete(self::$_clave_sesion . '_sesion_activa');
        self::deleteCookies();
    }

    public static function hash($pass)
    {
        return crypt($pass, self::$_clave_sesion);
    }

    public static function cookiesActivas()
    {
        return isset($_COOKIE[md5(self::$_clave_sesion)]) && is_array(self::getCookies());
    }

    public static function setCookies($user, $pass)
    {
        setcookie(md5(self::$_clave_sesion), serialize(array(
                    'identificacion' => $user,//login
                    'contrasena' => $pass//clave
                )), time() + 60 * 60 * 24 * 30);
    }

    public static function getCookies()
    {
        if (isset($_COOKIE[md5(self::$_clave_sesion)])) {
            return unserialize($_COOKIE[md5(self::$_clave_sesion)]);
        } else {
            return NULL;
        }
    }

    public static function deleteCookies()
    {
        setcookie(md5(self::$_clave_sesion),'',time()- 1);
        unset($_COOKIE[md5(self::$_clave_sesion)]);
    }

}