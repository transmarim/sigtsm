<?php
require_once("conexion.php");

class Enviaralert{
    function __construct(){

    }
    public static function enviarEmailAlert($idchofer,$nombre,$asunto,$descripcion,$fecha,$email){
        include_once("../mail/PHPMailerAutoload.php");
        $mail = new PHPMailer;
        $contenido = '<table width="600" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="left" valign="top" style="padding:5px;"><img src="http://seamasterinc.com/views/img/logo.png" width="298" height="67" style="display:block;"></td>
                </tr>
                <tr>
                  <td align="left" valign="top"><img src="http://www.lanza.com.ve/top.png" width="600" height="133" style="display:block;"></td>
                </tr>
                <tr>
                  <td align="center" valign="top" bgcolor="#183152" style="background-color:#183152; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td width="50%" align="left" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;">&nbsp;&nbsp;'.$fecha.' </td>
                      <td align="right" valign="top" style="color:#ffffff; font-family:Verdana, Geneva, sans-serif; font-size:11px;"></td>
                    </tr>
                  </table></td>
                </tr>
                <tr>
                  <td align="center" valign="top" bgcolor="#ffffff" style="background-color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#000000; padding:12px;"><table width="100%" border="0" cellspacing="0" cellpadding="10" style="margin-bottom:10px;">
                    <tr>
                      <td align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#525252;">
                      <div style="font-size:18px; color:#183152;"><h3>Estimado $nombre, has recibido un mensaje del SigTSM</h3></div>
                        <div style="font-size:28px;">Uno de nuestros trabajadores te ha enviado el siguiente mensaje: </div>
          <div><br>
            <p>'.$descripcion.'</p><br><p>Puedes ponerte en contacto al email: ejemplo@gmail.com o por su numero tlf: 99999 </p>.</div> </td>
                    </tr>
                  </table>
                  </td>
                </tr>
                <tr>
                  <td align="left" valign="top" bgcolor="#183152" style="background-color:#183152;"><table width="100%" border="0" cellspacing="0" cellpadding="15">
                    <tr>
                      <td align="left" valign="top" style="color:#ffffff; font-family:Arial, Helvetica, sans-serif; font-size:13px;"><p>Este mensaje ha sido generado automaticamente desde seamasterinc.com. (NO RESPONDER)</p></td>
                    </tr>
                  </table></td>
                </tr>
            </table>
              <br>
              <br></td>
            </tr>
          </table>';
        
        $mail->Host = 'mail.seamasterinc.com';  // Specify main and backup SMTP servers
        /*$mail->isSMTP();*//// Set mailer to use SMTP
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@seamasterinc.com';                 // SMTP username
        $mail->Password = 'sea.master2017';                           // SMTP password
        $mail->SMTPSecure = 'tls';                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to
        $mail->setFrom('info@seamasterinc.com', 'Mensaje de SigTSM');
        $mail->addAddress($email,"Informacion");     // Add a recipient
        $mail->addReplyTo('info@seamasterinc.com', 'NO-REPLY');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Mensaje desde SigTSM ';
        $mail->Body = $contenido;
        if(!$mail->send()) {
            $sw = false;
        } else {
            $sw = true;
        }
        return $sw;
    }

}
