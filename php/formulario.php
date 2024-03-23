<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtencion de los datos del formulario
    $asuntoSeleccionado = $_POST['asunto'];
    $empresa = $_POST['Empresa'];
    $nombre = $_POST['Nombre'];
    $emailFormulario = $_POST['email'];
    $Estado = $_POST['Estado' ];
    $cp= $_POST['CP']; 
    $alcaldia = $_POST['Alcaldia'];
    $telefono = $_POST['Telefono'];
    $mensaje = $_POST['mensaje'];

    // Instancia PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP de Office 365
        $mail->isSMTP();
        $mail->Host = 'smtp.office365.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'desarrollo@cuanda.com.mx';
        $mail->Password = 'Xog417271'; 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remitente
        $mail->setFrom('desarrollo@cuanda.com.mx', 'Cuanda S.A de S.V.');

        // Destinatario, determinado por la selección en el formulario
        $destinatarioEmail = '';
        $mensajeasunto= '';
        switch ($asuntoSeleccionado) {
            case 'dest1':
                $destinatarioEmail = 'lsca_gabriel_hs@hotmail.com'; 
                $mensajeasunto = 'Tengo una queja y/o sugerencia';
                break;
            case 'dest2':
                $destinatarioEmail = 'lsca_gabriel_h@hotmail.com'; 
                $mensajeasunto = 'Quiero comprar un producto';
                break;
            case 'dest3':
                $destinatarioEmail = 'lsca_gabriel_hs@hotmail.com'; 
                $mensajeasunto ='Quiero ser proveedor';
                break;
        }

        if (!empty($destinatarioEmail)) {
            $mail->addAddress($destinatarioEmail);   // Añadir destinatario

            // Contenido
            $mail->isHTML(true); 
            $mail->Subject = "Nuevo mensaje de $nombre";
            $mail->Body    ="De: $nombre<br>
                            Empresa: $empresa<br>
                            Email: $emailFormulario<br>
                            Estado: $Estado<br>
                            Alcaldia/ Municipio: $alcaldia<br>
                            C.P: $cp <br>
                            Teléfono: $telefono<br>
                            Mensaje:<br>$mensaje";

            $mail->AltBody = "De: $nombre\nEmpresa: $empresa\nEmail: $emailFormulario\nMensaje:\n$mensaje";

            $mail->send();
            echo "Correo enviado exitosamente a {$destinatarioEmail}";
        } else {
            echo "No se ha seleccionado un destinatario válido.";
        }
    } catch (Exception $e) {
        echo "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
    }
} else {
    // Redirigir al usuario al formulario si intentan acceder a este script directamente
    header('Location: contacto.html');
}
