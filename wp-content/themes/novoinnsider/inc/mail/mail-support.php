<?php
if ( isset( $_POST['name'] ) ) {
    $name = $_POST['name'];
}

if ( isset( $_POST['lastName'] ) ) {
    $last_name = $_POST['lastName'];
}

if ( isset( $_POST['email'] ) ) {
    $email = $_POST['email'];
}

if ( isset( $_POST['phone'] ) ) {
    $phone = $_POST['phone'];
}

if ( isset( $_POST['description'] ) ) {
    $message = $_POST['description'];
}

$date = date('Y');

$linkimage = 'https://innsider.com.co/wp-content/uploads/2024/08/Capa_1-1-1.png';
?>

<?php echo "
    <!doctype html>
    <html lang=\"es\">
    <head>
        <meta charset=\"UTF - 8\">
        <meta name=\"viewport\"
              content=\"width = device - width, user - scalable = no, initial - scale = 1.0, maximum - scale = 1.0, minimum - scale = 1.0\">
        <meta http-equiv=\"X - UA - Compatible\" content=\"ie=edge\">
        <title>Mail</title>
        <style type=\"text/css\">

        </style>
    </head>
    <style>
    * {
    }
    </style>
    <body bgcolor=\"#ffffff\" style=\"background-color: #ffffff; margin: 30px\">
        
        <table width=\"600\" align=\"center\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"#ffffff\" style=\"background-color: #ffffff; border: 2px solid #14337e;
    padding: 0.3rem; border-radius: 0.5rem;\">
            <tr>
                <td align=\"center\">
                    <table width=\"600\" bgcolor=\"#fff\">
                        <tr>
                            <td align=\"center\" style=\"padding: 20px;background-color: #ebebeb; border-radius: 0.5rem;\">
                                <table width=\"100%\">
        
                                    <tr>
                                        <td width=\"40%\" align=\"center\">
                                            <img src='{$linkimage}' width=\"200\">
                                        </td >
        
                                        <td width=\"60%\" align=\"center\" style =\"color: #14337e; font-size: 20px;\" >
                                            <strong>FORMULARIO DE CONTACTO</strong>
                                        </td>
                                    </tr>
        
                                </table>
                            </td>
                        </tr>
                    </table>
        
                    <table width=\"600\">
                        <tr>
                            <td align=\"center\" style=\"padding: 30px\">
                                <table>
                                    <tr>
                                        <td style=\"font-size: 17px;\" align=\"center\">
                                            Estimado/a Administrador/a,<br><br>
                                            Se ha recibido una solicitud a través del formulario de ayuda y soporte técnico en su sitio web. A continuación, se presentan los detalles del contacto:
                                        </td>
                                    </tr>
                                    <tr><td align=\"center\" style=\"line-height: 20px\">&nbsp;</td></tr>
                                    <tr>
        
                                        <td colspan=\"2\" align=\"center\">
        
                                            <table width=\"100%\" cellpadding=\"0\" style=\"padding: 20px; border: 2px solid #14337e; border-radius: 0.5rem;\">
                                                    
                                                <tr>
                                                                                                     
                                                    <td width=\"30%\" style=\"font-size: 18px\">
                                                        <strong>Nombre:</strong>
                                                    </td>
        
                                                    <td width=\"70%\" style=\"font-size: 18px; color: #000;\">
                                                        {$name}
                                                    </td>
                                                    
                                                </tr>
                                                
                                                <tr><td colspan=\"2\" style=\"line-height: 10px\">&nbsp;</td></tr>

                                                                                                <tr>
                                                                                                     
                                                    <td width=\"30%\" style=\"font-size: 18px\">
                                                        <strong>Apellido:</strong>
                                                    </td>
        
                                                    <td width=\"70%\" style=\"font-size: 18px; color: #000;\">
                                                        {$last_name}
                                                    </td>
                                                    
                                                </tr>
                                                
                                                <tr><td colspan=\"2\" style=\"line-height: 10px\">&nbsp;</td></tr>
        
                                                <tr>
        
                                                    <td width=\"30%\" style=\"font-size: 18px\">
                                                        <strong>Correo electrónico:</strong>
                                                    </td>
        
                                                    <td width=\"70%\" style=\"font-size: 18px; color: #000;\">
                                                        {$email}
                                                    </td>
        
                                                </tr>
                                                                                            
                                                <tr><td colspan=\"2\" style=\"line-height: 10px\">&nbsp;</td></tr>
        
                                                <tr>
                                                  
                                                    <td width=\"30%\" style=\"font-size: 18px\">
                                                        <strong>Celular:</strong>
                                                    </td>
        
                                                    <td width=\"70%\" style=\"font-size: 18px; color: #000;\">
                                                        {$phone}
                                                    </td>
        
                                                </tr>
                                                
                                                <tr><td colspan=\"2\" style=\"line-height: 10px\">&nbsp;</td></tr>
        
                                                <tr>
                                                    
                                                    <td width=\"30%\" style=\"font-size: 18px\">
                                                        <strong>Mensaje:</strong>
                                                    </td>
        
                                                    <td width=\"70%\" style=\"font-size: 18px; color: #000;\">
                                                        {$message}
                                                    </td>
        
                                                </tr>
        
                                            </table>
        
                                        </td>
        
                                    </tr>
                                    <tr><td align=\"center\" style=\"line-height: 20px\">&nbsp;</td></tr>
                                    <tr>
        
                                        <td style=\"font-size: 17px;\" align=\"center\">
                                            Recuerde que este es un mensaje generado desde el formulario de ayuda y soporte técnico de su sitio web.
                                        </td>
        
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
        
                    <table width=\"600\" bgcolor=\"#14337e\" style=\"border-radius: 0.5rem; width: 100%;\">
                        <tr>
        
                            <td align=\"center\" style=\"background-color: #14337e;padding: 30px; color: #ffffff; width: 100%; \">
        
                                Mensaje enviado desde
                                <a href=\"https://innsider.com.co/\" style=\"color: #ffffff\">iNNsider</a>
                                <br>
                                © {$date} | iNNsider | Todos los derechos reservados
                            </td>
        
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        
    </body>
    </html>
"
?>