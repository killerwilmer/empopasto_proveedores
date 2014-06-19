<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Email
 *
 * @author cristhianlombana
 */
class Email {
    //put your code here
    public static function enviar($destino, $html){
        $fecha = date('l jS \of F Y h:i:s A');
        $sfrom = "notificaciones@empopasto.com.co";
        $sheader = "From:" . $sfrom . "\nReply-To:" . $sfrom . "\n";
        $sheader = $sheader . "X-Mailer:PHP/" . phpversion() . "\n";
        $sheader = $sheader . "Mime-Version: 1.0\n";
        $sheader = $sheader . "Content-Type: text/html";
        $html.="<br>Este es un mensaje generado automáticamente.";
        mail("$destino", "Mensaje desde notificaciones@empopasto.com.co el día:" . $fecha, $html, $sheader) or die("Su mensaje no pudo enviarse.");
    }
}
?>
