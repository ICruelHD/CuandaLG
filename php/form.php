<?php
// Verificar si se accedió al script mediante una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $asuntoSeleccionado = $_POST['asunto'];
    $empresa = $_POST['Empresa'];
    $nombre = $_POST['Nombre'];
    $email = $_POST['email'];
    $estado = $_POST['Estado'];
    $cp = $_POST['CP'];
    $alcaldia = $_POST['Alcaldia'];
    $telefono = $_POST['Telefono'];
    $mensaje = $_POST['mensaje'];
    
    // Definir el destinatario del correo electrónico según la selección del asunto
    $destinatario = '';
    switch ($asuntoSeleccionado) {
        case 'dest1':
            $destinatario = 'correo1@example.com'; 
            break;
        case 'dest2':
            $destinatario = 'correo2@example.com'; 
            break;
        case 'dest3':
            $destinatario = 'correo3@example.com';
            break;
    }

    // Verificar si se ha establecido un destinatario
    if (!empty($destinatario)) {
        // Preparar el mensaje de correo electrónico
        $asunto = "Nuevo mensaje: " . $asuntoSeleccionado;
        $contenido =    "De: $nombre\n
                        Empresa: $empresa\n
                        Email: $email\n
                        Estado: $estado\n
                        Código Postal: $cp\n
                        Alcaldía: $alcaldia\n
                        Teléfono: $telefono\n
                        Mensaje:\n$mensaje";
        $cabeceras = "From: $email";

        // Enviar el correo electrónico
        if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
            echo "Correo enviado exitosamente a {$destinatario}";
        } else {
            echo "No se pudo enviar el correo.";
        }
    } else {
        echo "No se ha seleccionado un destinatario válido.";
    }
} else {
    // Redirigir al usuario al formulario si intentan acceder a este script directamente
    header('Location: ../index.html'); // Asegúrate de que esta ruta sea correcta
}
?>
