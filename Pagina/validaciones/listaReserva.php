<?php
$host = "localhost"; // Nombre del host
$user = "root"; // Usuario de la base de datos
$password = ""; // Contraseña de la base de datos
$db = "reservas"; // Nombre de la base de datos
$con = mysqli_connect($host, $user, $password, $db); // Conectamos a la base de datos
if (!$con) {
    echo "Error al conectar a la base de datos";
} else {
    $idUsr = $_SESSION['idUsuario'];
    $query = "SELECT reservas.*, asignaturas.nombreAsignatura, asignaturas.curso FROM reservas INNER JOIN asignaturas ON reservas.idAsignatura = asignaturas.idAsignatura WHERE reservas.idUsuario = '$idUsr';"; // Creamos la consulta
    $result = mysqli_query($con, $query); // Realizamos la consulta

    $row = mysqli_fetch_assoc($result); // Guardamos los datos del usuario en un array
    $_SESSION['idReserva'] = $row['idReserva'];
    $_SESSION['fechaReserva'] = $row['fecha'];
    $_SESSION['asignaturaReserva'] = $row['nombreAsignatura'];
    $_SESSION['cursoReserva'] = $row['curso'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h1>Resguardo de la reserva del aula de examenes</h1>
        <p>
            ID de la reserva: <?=$_SESSION['idReserva']?><br>
            Fecha de la reserva: <?=$_SESSION['fechaReserva']?><br>
            Asignatura: <?=$_SESSION['asignaturaReserva']?><br>
            Curso: <?=$_SESSION['cursoReserva']?><br>
            Nº alumnos: <br>
            Profesor: <?=$_SESSION['nombreUsuario']?><br>
            Tramos reservados: <br>
            - <br>
        </p>
    </div>
    <div>
        <img src="../Diseño/imgs/iesjorgeguillen.svg" alt=""> I.E.S. Jorge Guillén
    </div>
</body>
</html>