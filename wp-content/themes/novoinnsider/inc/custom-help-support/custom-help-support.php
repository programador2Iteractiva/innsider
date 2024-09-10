<?php 

/**
 * Function Get HTML
 */
function novo_inssider_get_html($slug, $name = null)
{
    ob_start();
    get_template_part($slug, $name);
    $html = ob_get_contents();
    ob_end_clean();

    return $html;
}

/**
 * Function to create new user in novo-innsider
*/

function novo_inssider_data_support()
{
    $to = 'egonzalez@interactiva.net.co';
    $subject = 'Solicitud de Soporte Técnico - Página web iNNsider';
    $body = novo_inssider_get_html('inc/mail/mail-support');
    $headers = 'From: iNNsider <info@innsider.com.co>' . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8";

    $mail_sent = wp_mail($to, $subject, $body, $headers);

    // Verifica si el correo se envió correctamente
    if ($mail_sent) {
        // Si el correo se envió correctamente, responde con un mensaje de éxito
        wp_send_json(['message' => 'Tu mensaje ha sido enviado.']);
    } else {
        // Si hubo un error al enviar el correo, responde con un mensaje de error
        wp_send_json(['message' => 'Hubo un error al enviar el mensaje.'], 500);
    }
}

add_action('wp_ajax_nopriv_data_support', 'novo_inssider_data_support');
add_action('wp_ajax_data_support', 'novo_inssider_data_support');

add_action('wp_mail_failed', function ($wp_error) {
    // Guarda el error en el log de errores de PHP
    error_log('Error al enviar el correo: ' . print_r($wp_error, true));
});