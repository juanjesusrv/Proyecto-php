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

    $idUsuarios=$_SESSION["idUsuario"];
    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $idAsignatura=$campos["idAsignatura"];
        $fecha=$campos["fecha"];
    }

    $sql=`select * from asignaturas where idAsignatura="`+$idAsignatura+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $nombreAsignatura=$campos["nombreAsignatura"];
        $curso=$campos["curso"];
    }

    $sql=`SELECT * FROM usuarios-asignaturas WHERE idAsignatura="`+$idAsignatura+`" and idUsuario=""`+$idUsuarios+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $numAlumnos=$campos["numAlumnos"];
        $grupo=$campos["grupo"];
    }

    $sql=`select * from asignaturas where idAsignatura="`+$idAsignatura+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)==1){
        $campos=mysqli_fetch_assoc($resultado);
        $nombreAsignatura=$campos["nombreAsignatura"];
        $curso=$campos["curso"];
    }

    $sql=`select  from reservas-tramo where idReserva="`+$idReserva+`"`;
    $resultado=mysqli_query($_SESSION["con"],$sql);

    if(mysqli_num_rows($resultado)>0){
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $tramos[] = $fila['idTramo'];
        }
    }



    // Captura los datos del formulario
    $nombre = $_SESSION["apellido1"]+` `+$_SESSION["apellido2"]+`, `+$_SESSION["nombreUsuario"];
    //$email = $_SESSION["email"];
    $email = "rjimrui727@g.educaand.es";
    $asunto = `Reserva de la clase de examenes el dia `+$fecha+` para la asignatura `+$nombreAsignatura;

    // Crear mensaje

    $mensaje=`
    <div>
        <h1>Resguardo de la reserva del aula de examenes</h1>
        <p>
            ID de la reserva: `+$_SESSION["idReserva"]+`<br>
            Fecha de la reserva: `+$fecha+`<br>
            Asignatura: `+$nombreAsignatura+`<br>
            Curso: `+$curso+` - `+$grupo+`<br>
            Nº alumnos: `+$numAlumnos+`<br>
            Profesor: `+$_SESSION["apellido1"]+` `+$_SESSION["apellido2"]+`, `+$_SESSION["nombreUsuario"]+`<br>
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