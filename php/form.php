<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $destinatarioCodigo = $_POST['asunto'];

    $Asunto = $_POST['asunto'];
    $Empresa = $_POST['Empresa'];
    $Nombre = $_POST['Nombre'];
    $email = $_POST['email'];
    $Estado = $_POST['Estado'];
    $Alcaldia = $_POST['Alcaldia'];
    $CodigoP = $_POST['CP'];
    $telefono = $_POST['Telefono'];
    $mensaje = nl2br($_POST['mensaje']);

    // Determina el destinatario basado en el valor enviado
    switch ($destinatarioCodigo) {
        case "dest1":
            $destinatarioEmail = "quejas@cuanda.com.mx";
            break;
        case "dest2":
            $destinatarioEmail = "ventas@cuanda.com.mx";
            break;
        case "dest3":
            $destinatarioEmail = "proveedores@cuanda.com.mx";
            break;
        default:
            echo "Destinatario no válido.";
            exit;
    }

    $message = "Empresa: $Empresa\n" .
        "Nombre: $Nombre\n" .
        "Correo: $email\n" .
        "Estado: $Estado\n" .
        "Alcaldía: $Alcaldia\n" .
        "No. telefónico: $telefono\n" .
        "Mensaje: $mensaje";

    // Encabezados adicionales
    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Envía el correo electrónico
    $exito = mail($destinatarioEmail, $Asunto, $message, $headers);
    
    if ($exito) {
        echo "Mensaje enviado con éxito.";
    } else {
        echo "Hubo un error al enviar el mensaje.";
    }
} else {
    echo "Método no permitido";
}
