<?php

    $destinatarioCodigo = $_POST['asunto'];

    $Empresa = $_POST['Empresa'];
    $Nombre = $_POST['Nombre'];
    $email = $_POST['email'];
    $Estado = $_POST['Estado'];
    $CodigoP = $_POST['CP'];
    $Alcaldia = $_POST['Alcaldia'];
    $telefono = $_POST['Telefono'];
    $mensaje = nl2br($_POST['mensaje']);

    // Determina el destinatario basado en el valor enviado
    switch ($destinatarioCodigo) {
        case "dest1":
            $destinatarioEmail = "Lsca_gabriel_hs@hotmail.com";
            
            break;
        case "dest2":
            $destinatarioEmail = "Lsca_gabriel_hs@hotmail.com";
            break;
        case "dest3":
            $destinatarioEmail = "Lsca_gabriel_hs@hotmail.com";
            break;
        default:
            echo "Destinatario no válido.";
            exit;
    }

    $message =
        "Empresa: $Empresa\n" .
        "Nombre: $Nombre\n" .
        "Correo: $email\n" .
        "Estado: $Estado\n" .
        "CP: $CodigoP\n" .
        "Alcaldía: $Alcaldia\n" .
        "No. telefónico: $telefono\n" .
        "Mensaje: $mensaje";

    $headers = "From: $email" . "\r\n" .
        "Reply-To: $email" . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    // Envía el correo electrónico
    $exito = mail($destinatarioEmail, $message, $headers);

    if ($exito) {
        echo "Mensaje enviado con éxito.";
    } else {
        echo "Hubo un error al enviar el mensaje.";
    }
?>