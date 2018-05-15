<?php
require_once("conexion.php");

class ProntoPago{
    function __construct(){

    }
    
    public static function listarAlert(){
        $sql = "SELECT idchofer,cedula,nombre FROM chofer WHERE condicion=1";
        return Consulta($sql);
    }

    public static function enviarEmailPP($ruta,$nombre,$email,$startDate,$endDate){
        include_once("../mail/PHPMailerAutoload.php");
        $mail = new PHPMailer;
        $mail->Host = 'mail.transmarim.com';  // Specify main and backup SMTP servers
        /*$mail->isSMTP();*//// Set mailer to use SMTP
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'info@transmarim.com';                 // SMTP username
        $mail->Password = 'info.tsm.2018';                           // SMTP password
        $mail->SMTPSecure = 'tls';                    // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25;                                    // TCP port to connect to
        $mail->setFrom('info@transmarim.com', 'Mensaje de SIGTSM');
        $mail->addAddress($email,"Informacion");     // Add a recipient
        $mail->addReplyTo('info@transmarim.com', 'NO-REPLY');
        $mail->AddAttachment('../'.$ruta, $name = 'PP',  $encoding = 'base64', $type = 'application/pdf');   // Optional name
        $mail->AddCC('facturacion@transmarim.com', 'TSM ADM');
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Mensaje SIGTSM + PRONTO-PAGO';
        $contenido = utf8_decode('<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><!-- NAME: SELL PRODUCTS --><!--[if gte mso 15]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><meta charset="UTF-8"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta name="viewport" content="width=device-width, initial-scale=1"><title>PRONTOPAGO</title>  <style type="text/css">
        p{margin:10px 0;padding:0}table{border-collapse:collapse}h1,h2,h3,h4,h5,h6{display:block;margin:0;padding:0}img,a img{border:0;height:auto;outline:none;text-decoration:none}body,#bodyTable,#bodyCell{height:100%;margin:0;padding:0;width:100%}.mcnPreviewText{display:none!important}#outlook a{padding:0}img{-ms-interpolation-mode:bicubic}table{mso-table-lspace:0;mso-table-rspace:0}.ReadMsgBody{width:100%}.ExternalClass{width:100%}p,a,li,td,blockquote{mso-line-height-rule:exactly}a[href^=tel],a[href^=sms]{color:inherit;cursor:default;text-decoration:none}p,a,li,td,body,table,blockquote{-ms-text-size-adjust:100%;-webkit-text-size-adjust:100%}.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{line-height:100%}a[x-apple-data-detectors]{color:inherit!important;text-decoration:none!important;font-size:inherit!important;font-family:inherit!important;font-weight:inherit!important;line-height:inherit!important}.templateContainer{max-width:600px!important}a.mcnButton{display:block}.mcnImage,.mcnRetinaImage{vertical-align:bottom}.mcnTextContent{word-break:break-word}.mcnTextContent img{height:auto!important}.mcnDividerBlock{table-layout:fixed!important}h1{color:#222;font-family:Helvetica;font-size:40px;font-style:normal;font-weight:700;line-height:150%;letter-spacing:normal;text-align:center}h2{color:#222;font-family:Helvetica;font-size:34px;font-style:normal;font-weight:700;line-height:150%;letter-spacing:normal;text-align:left}h3{color:#444;font-family:Helvetica;font-size:22px;font-style:normal;font-weight:700;line-height:150%;letter-spacing:normal;text-align:left}h4{color:#999;font-family:Georgia;font-size:20px;font-style:italic;font-weight:400;line-height:125%;letter-spacing:normal;text-align:left}#templateHeader{background-color:#3f3f3f;background-image:url(https://gallery.mailchimp.com/cf6db962f7bbd0f24390c2132/images/44152424-0cc5-406b-9adf-7d30830ca266.jpg);background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:45px;padding-bottom:45px}.headerContainer{background-color:transparent;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0}.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{color:gray;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left}.headerContainer .mcnTextContent a,.headerContainer .mcnTextContent p a{color:#00ADD8;font-weight:400;text-decoration:underline}#templateBody{background-color:#FFF;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:36px;padding-bottom:45px}.bodyContainer{background-color:transparent;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0}.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{color:gray;font-family:Helvetica;font-size:16px;line-height:150%;text-align:left}.bodyContainer .mcnTextContent a,.bodyContainer .mcnTextContent p a{color:#00ADD8;font-weight:400;text-decoration:underline}#templateFooter{background-color:#333;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:45px;padding-bottom:63px}.footerContainer{background-color:transparent;background-image:none;background-repeat:no-repeat;background-position:center;background-size:cover;border-top:0;border-bottom:0;padding-top:0;padding-bottom:0}.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{color:#FFF;font-family:Helvetica;font-size:12px;line-height:150%;text-align:center}.footerContainer .mcnTextContent a,.footerContainer .mcnTextContent p a{color:#FFF;font-weight:400;text-decoration:underline}@media only screen and (min-width:768px){.templateContainer{width:600px!important}}@media only screen and (max-width: 480px){body,table,td,p,a,li,blockquote{-webkit-text-size-adjust:none!important}body{width:100%!important;min-width:100%!important}.mcnRetinaImage{max-width:100%!important}.mcnImage{width:100%!important}.mcnCartContainer,.mcnCaptionTopContent,.mcnRecContentContainer,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer,.mcnImageCardLeftImageContentContainer,.mcnImageCardRightImageContentContainer{max-width:100%!important;width:100%!important}.mcnBoxedTextContentContainer{min-width:100%!important}.mcnImageGroupContent{padding:9px!important}.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{padding-top:9px!important}.mcnImageCardTopImageContent,.mcnCaptionBottomContent:last-child .mcnCaptionBottomImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{padding-top:18px!important}.mcnImageCardBottomImageContent{padding-bottom:9px!important}.mcnImageGroupBlockInner{padding-top:0!important;padding-bottom:0!important}.mcnImageGroupBlockOuter{padding-top:9px!important;padding-bottom:9px!important}.mcnTextContent,.mcnBoxedTextContentColumn{padding-right:18px!important;padding-left:18px!important}.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{padding-right:18px!important;padding-bottom:0!important;padding-left:18px!important}.mcpreview-image-uploader{display:none!important;width:100%!important}h1{font-size:30px!important;line-height:125%!important}h2{font-size:26px!important;line-height:125%!important}h3{font-size:20px!important;line-height:150%!important}h4{font-size:18px!important;line-height:150%!important}.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{font-size:14px!important;line-height:150%!important}.headerContainer .mcnTextContent,.headerContainer .mcnTextContent p{font-size:16px!important;line-height:150%!important}.bodyContainer .mcnTextContent,.bodyContainer .mcnTextContent p{font-size:16px!important;line-height:150%!important}.footerContainer .mcnTextContent,.footerContainer .mcnTextContent p{font-size:14px!important;line-height:150%!important}}</style>  </head>
     <body><!--*|IF:MC_PREVIEW_TEXT|*--><!--[if !gte mso 9]><!----><span class="mcnPreviewText" style="display:none; font-size:0px; line-height:0px; max-height:0px; max-width:0px; opacity:0; overflow:hidden; visibility:hidden; mso-hide:all;"></span><!--<![endif]--><!--*|END:IF|*--> <center> <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable"> <tr> <td align="center" valign="top" id="bodyCell"> <!-- BEGIN TEMPLATE // --> <table border="0" cellpadding="0" cellspacing="0" width="100%"><tr><td align="center" valign="top" id="templateHeader" data-template-container><!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"><tr><td valign="top" class="headerContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnImageBlock" style="min-width:100%;"><tbody class="mcnImageBlockOuter"><tr><td valign="top" style="padding:9px" class="mcnImageBlockInner"><table align="left" width="100%" border="0" cellpadding="0" cellspacing="0" class="mcnImageContentContainer" style="min-width:100%;"><tbody><tr><td class="mcnImageContent" valign="top" style="padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;"><img align="center" alt="" src="https://gallery.mailchimp.com/cf6db962f7bbd0f24390c2132/images/a4395d98-1a90-4d84-9ec1-2557a0186dff.png" width="200" style="max-width:200px; padding-bottom: 0; display: inline !important; vertical-align: bottom;" class="mcnImage"></td></tr></tbody></table></td></tr></tbody></table></td></tr></table><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td> </tr><tr><td align="center" valign="top" id="templateBody" data-template-container><!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"><tr> <td valign="top" class="bodyContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;"> <tbody class="mcnTextBlockOuter"> <tr> <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;"> <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr><![endif]--> <!--[if mso]><td valign="top" width="600" style="width:600px;"><![endif]--> <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer"> <tbody><tr> <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;"> <h3>Estimado usuario '.$nombre.' de SIGTSM.</h3><p>El presente email es para informarle que ha sido generado su pronto-pago de manera exitosa. Comprendido por la semana <strong>'.$startDate.'</strong>&nbsp;al <strong>'.$endDate.'</strong><br><br>Recuerde elaborar su factura a nombre de <strong>TRANSPORT AND SERVICES MARINE, C.A. RIF: J-29762126-1</strong><br><br><strong>Gracias</strong> por trabajar con nosotros, cualquier duda con el pronto-pago generado, contactenos via email.&nbsp;<strong>asistente@transmarim.com</strong></p> </td> </tr> </tbody></table><!--[if mso]></td><![endif]--> <!--[if mso]></tr></table><![endif]--> </td> </tr> </tbody></table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnButtonBlock" style="min-width:100%;"> <tbody class="mcnButtonBlockOuter"> <tr> <td style="padding-top:0; padding-right:18px; padding-bottom:18px; padding-left:18px;" valign="top" align="center" class="mcnButtonBlockInner"> <table border="0" cellpadding="0" cellspacing="0" class="mcnButtonContentContainer" style="border-collapse: separate !important;border-radius: 3px;background-color: #00ADD8;"> <tbody> <tr> <td align="center" valign="middle" class="mcnButtonContent" style="font-family: Helvetica; font-size: 18px; padding: 18px;"> <a class="mcnButton " title="Ver Adjunto" href="" target="_self" style="font-weight: bold;letter-spacing: -0.5px;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;">Ver Adjunto</a> </td> </tr> </tbody> </table> </td> </tr> </tbody></table></td></tr></table><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td> </tr> <tr><td align="center" valign="top" id="templateFooter" data-template-container><!--[if (gte mso 9)|(IE)]><table align="center" border="0" cellspacing="0" cellpadding="0" width="600" style="width:600px;"><tr><td align="center" valign="top" width="600" style="width:600px;"><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" width="100%" class="templateContainer"><tr> <td valign="top" class="footerContainer"><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowBlock" style="min-width:100%;"> <tbody class="mcnFollowBlockOuter"> <tr> <td align="center" valign="top" style="padding:9px" class="mcnFollowBlockInner"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentContainer" style="min-width:100%;"> <tbody><tr> <td align="center" style="padding-left:9px;padding-right:9px;"> <table border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width:100%;" class="mcnFollowContent"> <tbody><tr> <td align="center" valign="top" style="padding-top:9px; padding-right:9px; padding-left:9px;"> <table align="center" border="0" cellpadding="0" cellspacing="0"> <tbody><tr> <td align="center" valign="top"> <!--[if mso]> <table align="center" border="0" cellspacing="0" cellpadding="0"> <tr> <![endif]--> <!--[if mso]> <td align="center" valign="top"> <![endif]--> <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;"> <tbody><tr> <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"> <tbody><tr> <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"> <table align="left" border="0" cellpadding="0" cellspacing="0" width=""> <tbody><tr> <td align="center" valign="middle" width="24" class="mcnFollowIconContent"> <a href="http://www.facebook.com" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-facebook-48.png" style="display:block;" height="24" width="24" class=""></a> </td> </tr> </tbody></table> </td> </tr> </tbody></table> </td> </tr> </tbody></table> <!--[if mso]> </td> <![endif]--> <!--[if mso]> <td align="center" valign="top"> <![endif]--> <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;"> <tbody><tr> <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"> <tbody><tr> <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"> <table align="left" border="0" cellpadding="0" cellspacing="0" width=""> <tbody><tr> <td align="center" valign="middle" width="24" class="mcnFollowIconContent"> <a href="http://www.twitter.com/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-twitter-48.png" style="display:block;" height="24" width="24" class=""></a> </td> </tr> </tbody></table> </td> </tr> </tbody></table> </td> </tr> </tbody></table> <!--[if mso]> </td> <![endif]--> <!--[if mso]> <td align="center" valign="top"> <![endif]--> <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;"> <tbody><tr> <td valign="top" style="padding-right:10px; padding-bottom:9px;" class="mcnFollowContentItemContainer"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"> <tbody><tr> <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"> <table align="left" border="0" cellpadding="0" cellspacing="0" width=""> <tbody><tr> <td align="center" valign="middle" width="24" class="mcnFollowIconContent"> <a href="http://www.instagram.com/" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-instagram-48.png" style="display:block;" height="24" width="24" class=""></a> </td> </tr> </tbody></table> </td> </tr> </tbody></table> </td> </tr> </tbody></table> <!--[if mso]> </td> <![endif]--> <!--[if mso]> <td align="center" valign="top"> <![endif]--> <table align="left" border="0" cellpadding="0" cellspacing="0" style="display:inline;"> <tbody><tr> <td valign="top" style="padding-right:0; padding-bottom:9px;" class="mcnFollowContentItemContainer"> <table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnFollowContentItem"> <tbody><tr> <td align="left" valign="middle" style="padding-top:5px; padding-right:10px; padding-bottom:5px; padding-left:9px;"> <table align="left" border="0" cellpadding="0" cellspacing="0" width=""> <tbody><tr> <td align="center" valign="middle" width="24" class="mcnFollowIconContent"> <a href="http://mailchimp.com" target="_blank"><img src="https://cdn-images.mailchimp.com/icons/social-block-v2/outline-light-link-48.png" style="display:block;" height="24" width="24" class=""></a> </td> </tr> </tbody></table> </td> </tr> </tbody></table> </td> </tr> </tbody></table> <!--[if mso]> </td> <![endif]--> <!--[if mso]> </tr> </table> <![endif]--> </td> </tr> </tbody></table> </td> </tr> </tbody></table> </td> </tr></tbody></table> </td> </tr> </tbody></table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnDividerBlock" style="min-width:100%;"> <tbody class="mcnDividerBlockOuter"> <tr> <td class="mcnDividerBlockInner" style="min-width:100%; padding:18px;"> <table class="mcnDividerContent" border="0" cellpadding="0" cellspacing="0" width="100%" style="min-width: 100%;border-top: 2px solid #505050;"> <tbody><tr> <td> <span></span> </td> </tr> </tbody></table><!-- <td class="mcnDividerBlockInner" style="padding: 18px;"> <hr class="mcnDividerContent" style="border-bottom-color:none; border-left-color:none; border-right-color:none; border-bottom-width:0; border-left-width:0; border-right-width:0; margin-top:0; margin-right:0; margin-bottom:0; margin-left:0;" />--> </td> </tr> </tbody></table><table border="0" cellpadding="0" cellspacing="0" width="100%" class="mcnTextBlock" style="min-width:100%;"> <tbody class="mcnTextBlockOuter"> <tr> <td valign="top" class="mcnTextBlockInner" style="padding-top:9px;"> <!--[if mso]><table align="left" border="0" cellspacing="0" cellpadding="0" width="100%" style="width:100%;"><tr><![endif]--> <!--[if mso]><td valign="top" width="600" style="width:600px;"><![endif]--> <table align="left" border="0" cellpadding="0" cellspacing="0" style="max-width:100%; min-width:100%;" width="100%" class="mcnTextContentContainer"> <tbody><tr> <td valign="top" class="mcnTextContent" style="padding-top:0; padding-right:18px; padding-bottom:9px; padding-left:18px;"> <em>Copyright © 2018 TRANSPORT AND SERVICES MARINE, C.A, All rights reserved.</em><br>DESCRIPCION<br> <br> <strong>Nuestro email de contacto:</strong> <br> transmarim@gmail.com<br> <br>Sistema desarrollado por L.VILLALBA / J. HERNANDEZ<br> Contacto: <a href="">+58-414 7975299</a> o <a href="">villalbatransmarim@gmail.com</a>. <br> <br> SIGTSM - Sistema Integrado de Gestion - TSM</td> </tr> </tbody></table><!--[if mso]></td><![endif]--> <!--[if mso]></tr></table><![endif]--> </td> </tr> </tbody></table></td></tr></table><!--[if (gte mso 9)|(IE)]></td></tr></table><![endif]--></td> </tr> </table> <!-- // END TEMPLATE --> </td> </tr> </table> </center> </body></html>');
        $mail->Body = $contenido;
        if(!$mail->send()) {
            $sw = false;
        } else {
            $sw = true;
        }
        return $sw;
    }

}
