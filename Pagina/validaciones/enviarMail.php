<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function enviarMail($con,$idReserva,$tramos,$tipoMensaje){
    $idUsuarios=$_SESSION["idUsuario"];

    // Consulta a la base de datos
    $sql='SELECT * from reservas where idReserva="'.$idReserva.'"';
    $resultado=mysqli_query($con,$sql);
    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $idAsignatura=$campos["idAsignatura"];
        $fecha=$campos["fecha"];
        $numAlumnos=$campos["alumnosReserva"];
    }

    $sql='SELECT * from asignaturas where idAsignatura="'.$idAsignatura.'"';
    $resultado=mysqli_query($con,$sql);
    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $nombreAsignatura=$campos["nombreAsignatura"];
        $curso=$campos["curso"];
    }

    $sql='SELECT * FROM `usuarios-asignaturas` WHERE idAsignatura="'.$idAsignatura.'" and idUsuario="'.$idUsuarios.'"';
    $resultado=mysqli_query($con,$sql);
    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $grupo=$campos["grupo"];
    }

    $sql='SELECT * from asignaturas where idAsignatura="'.$idAsignatura.'"';
    $resultado=mysqli_query($con,$sql);
    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $nombreAsignatura=$campos["nombreAsignatura"];
        $curso=$campos["curso"];
    }

    // Opciones del destinatario
    $nombre = $_SESSION["apellido1"].' '.$_SESSION["apellido2"].', '.$_SESSION["nombreUsuario"];
    //$email = $_SESSION["email"];
    $email = "servidorejerciciophp@gmail.com";
    

    if($tipoMensaje=="crear"){
        $asunto = 'Reserva de la clase de examenes el dia '.$fecha.' para la asignatura '.$nombreAsignatura;
        $mensaje='<div>
            <h1>Resguardo de la reserva del aula de examenes</h1>';
    }
    if($tipoMensaje=="borrar"){
        $asunto = 'Borrado de la reserva del dia '.$fecha.' para la asignatura '.$nombreAsignatura;
        $mensaje='<div>
            <h1>Resguardo del borrado de la reserva</h1>';
    }
    // Crear mensaje
    $mensaje.='<p>
            ID de la reserva: '.$idReserva.'<br>
            Fecha de la reserva: '.$fecha.'<br>
            Profesor: '.$_SESSION["apellido1"].' '.$_SESSION["apellido2"].', '.$_SESSION["nombreUsuario"].'<br>
            Asignatura: '.$nombreAsignatura.'<br>
            Curso: '.$curso.' - '.$grupo.'<br>
            Nº alumnos: '.$numAlumnos.'<br><br>';
        if($tipoMensaje=="crear"){
            $mensaje.='Tramos reservados<br>';
        }
        if($tipoMensaje=="borrar"){
            $mensaje.='Tramos borrados<br>';
        }
            foreach($tramos as $tramo){
                $sqlHoras='SELECT * FROM tramos WHERE idTramo="'.$tramo.'"';
                $hora=mysqli_query($con,$sqlHoras);
                $hora=mysqli_fetch_assoc($hora);
                $mensaje.='&nbsp;&nbsp;&nbsp;&nbsp;·'.$tramo.': '.$hora["hora"].'<br>';
            }
    $mensaje.='</p></div><hr>
    <div style="display: flex;">
        <img src="cid:logo">
        <p>I.E.S. Jorge Guillén<p>
    </div>
    ';

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
        $mail->addEmbeddedImage('../imgs/iesjorgeguillen.png', 'logo');
        $mail->Subject = 'Asunto: ' . $asunto;
        $mail->Body    = $mensaje;
        $mail->AltBody = 'Nombre: ' . $nombre . '\nEmail: ' . $email . '\nMensaje: ' . $mensaje;

        // Enviar el correo
        $mail->send();
        echo '<p>El mensaje ha sido enviado correctamente.</p>';
    } catch (Exception $e) {
        echo "<p class='error'>No se pudo enviar el mensaje. Error de Mailer: {$mail->ErrorInfo}</p>";
    }
} 
?>