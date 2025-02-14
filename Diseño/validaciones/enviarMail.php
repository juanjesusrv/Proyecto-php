<?php

session_start();



require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Consulta a la base de datos
    $idReserva=$_POST['idReserva'];
    $sql=`select * from reservas where idReserva="`+$idReserva+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $idUsuario=$campos["idUsuario"];
        $idAsignatura=$campos["idAsignatura"];
    }

    $sql=`select * from asignaturas where idAsignatura="`+$idAsignatura+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $nombreAsignatura=$campos["nombreAsignatura"];
        $curso=$campos["curso"];
    }

    $sql=`select * from usuarios where idUsuarios="`+$idUsuarios+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $nombreUsuario=$campos["nombreUsuario"];
        $apellido1=$campos["apellido1"];
        $apellido2=$campos["apellido2"];
        $email=$campos["email"];
    }

    //////////////////////////


    // Captura los datos del formulario
    $nombre = htmlspecialchars($_POST['nombre']);
    $email = htmlspecialchars($_POST['email']);
    $mensaje = htmlspecialchars($_POST['mensaje']);
    $asunto = htmlspecialchars($_POST['asunto']);

    // Crear mensaje

    $mensaje=`
    <div>
        <h1>Resguardo de la reserva del aula de examenes</h1>
        <p>
            ID de la reserva: `+$_SESSION["idReserva"]+`<br>
            Fecha de la reserva: <br>
            Asignatura: <br>
            Curso: <br>
            Nº alumnos: <br>
            Profesor: <br>
            Tramos reservados<br>
            - <br>
        </p>
    </div>
    <div>
        <img src="../Diseño/imgs/iesjorgeguillen.svg" alt=""> I.E.S. Jorge Guillén
    </div>
    `;


    // Crear una instancia de PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();  
        $mail->Host       = 'smtp.gmail.com';  
        $mail->SMTPAuth   = true;  
        $mail->Username   = 'rtorsua@g.educaand.es';  
        $mail->Password   = 'zeyd bhbs clab xqwu';  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  
        $mail->Port       = 465;

        // Destinatarios
        $mail->setFrom('rtorsua@g.educaand.es', 'Mailer');
        $mail->addAddress($email);  // Añadir destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Asunto: ' . $asunto;
        $mail->Body    = 'Nombre: ' . $nombre . '<br>Email: ' . $email . '<br>Mensaje: ' . $mensaje;
        $mail->AltBody = 'Nombre: ' . $nombre . '\nEmail: ' . $email . '\nMensaje: ' . $mensaje;

        // Enviar el correo
        $mail->send();
        echo '<p>El mensaje ha sido enviado correctamente.</p>';
    } catch (Exception $e) {
        echo "<p class='error'>No se pudo enviar el mensaje. Error de Mailer: {$mail->ErrorInfo}</p>";
    }
}
?>