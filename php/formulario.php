<?php
require 'vendor/autoload.php'; // Asegura que esta ruta sea correcta.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $asuntoSeleccionado = $_POST['asunto'];
    $empresa = $_POST['Empresa'];
    $nombre = $_POST['Nombre'];
    $emailFormulario = $_POST['email']; // Asegúrate de que el campo 'name' en tu formulario sea 'email'
    $mensaje = $_POST['mensaje'];

    // Preparar el contenido del correo
    $contenido = "De: $nombre\n
                Empresa: $empresa\n
                Email: $emailFormulario\n
                Mensaje:\n$mensaje";

    // Usa tu API Key de SendGrid aquí
    $sendgridApiKey = 'TU_API_KEY_AQUÍ';
    $email = new \SendGrid\Mail\Mail(); 
    $email->setFrom("tu_correo@example.com", "Tu Nombre o Empresa");

    // Seleccionar el destinatario según el asunto
    $destinatarioEmail = '';
    switch ($asuntoSeleccionado) {
        case 'dest1':
            $destinatarioEmail = 'lsca_gabriel_hs@hotmail.com';
            break;
        case 'dest2':
            $destinatarioEmail = 'lsca_gabriel_hs@hotmail.com';
            break;
        case 'dest3':
            $destinatarioEmail = 'lsca_gabriel_hs@hotmail.com';
            break;
    }

    if (!empty($destinatarioEmail)) {
        $email->addTo($destinatarioEmail, 'Nombre del Destinatario');
        $email->setSubject("Nuevo mensaje: " . $asuntoSeleccionado);
        $email->addContent("text/plain", $contenido);

        $sendgrid = new \SendGrid($sendgridApiKey);

        try {
            $response = $sendgrid->send($email);
            if ($response->statusCode() == 202) { // 202 Accepted
                echo "Correo enviado exitosamente a {$destinatarioEmail}";
            } else {
                echo "No se pudo enviar el correo. Código de respuesta: " . $response->statusCode();
            }
        } catch (Exception $e) {
            echo 'Capturado error de SendGrid: '. $e->getMessage() ."\n";
        }
    } else {
        echo "No se ha seleccionado un destinatario válido.";
    }
} else {
    // Redirigir al usuario al formulario si intentan acceder a este script directamente
    header('Location: ../index.html'); // Asegúrate de que esta ruta sea correcta
}
?>
