<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar datos del formulario
    $asuntoSeleccionado = $_POST['asunto'];
    $empresa = $_POST['Empresa'];
    $nombre = $_POST['Nombre'];
    $correo = $_POST['email'];
    $estado = $_POST['Estado'];
    $cp = $_POST['CP'];
    $alcaldia = $_POST['Alcaldia'];
    $telefono = $_POST['Telefono'];
    $mensaje = $_POST['mensaje'];

    // Determinar el destinatario basado en la selección del asunto
    $destinatario = '';
    switch ($asuntoSeleccionado) {
        case 'dest1':
            $destinatario = 'LSCA_Gabriel_HS@Hotmail.com'; 
            break;
        case 'dest2':
            $destinatario = 'LSCA_Gabriel_HS@Hotmail.com'; 
            break;
        case 'dest3':
            $destinatario = 'LSCA_Gabriel_HS@Hotmail.com'; 
            break;
        default:
            die('Selecciona un asunto válido.');
    }

    // Definir el asunto del correo y el cuerpo del mensaje
    $asuntoCorreo = "Nuevo mensaje: " . $asuntoSeleccionado;
    $mensajeCorreo = "Recibiste un mensaje de: $nombre, 
                    $empresa\n
                    Correo: $correo\n
                    Estado: $estado, C.P.: $cp, Alcaldía: $alcaldia\n
                    Teléfono: $telefono\n
                    Mensaje:\n$mensaje";

    // Encabezados para el correo
    $headers = "From: tu_correo@example.com";

    // Enviar el correo
    if (mail($destinatario, $asuntoCorreo, $mensajeCorreo, $headers)) {
        echo "Correo enviado exitosamente a {$destinatario}";
    } else {
        echo "No se pudo enviar el correo.";
    }
} else {
    header('Location: ../formulario.html');
}
