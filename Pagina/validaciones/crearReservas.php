<?php
session_start();
require_once "conexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["tramos"])) {
    $idAsignatura = $_POST["idAsignatura"];
    $fecha = $_POST["fecha"];
    $tramos = $_POST["tramos"];
    $idUsuario = $_SESSION["idUsuario"];

    if (isset($tramos)) {

        $sql1 = "INSERT INTO reservas (fecha, idUsuario, idAsignatura) VALUES ('$fecha','$idUsuario','$idAsignatura')";
        mysqli_query($con, $sql1);

        $sql2 = "SELECT idReserva FROM reservas ORDER BY idReserva DESC LIMIT 1";
        $result = mysqli_query($con, $sql2);
        $idReserva = mysqli_fetch_assoc($result)["idReserva"];

        foreach ($tramos as $tramo) {
            $sql3 = "INSERT INTO `reservas-tramo` (idReserva, idTramo) VALUES ('$idReserva','$tramo')";
            mysqli_query($con, $sql3);
        }
        header("Location: ../reserva.php");
    }
} else {
    echo "No se ha seleccionado ningún tramo"; ?>
    <br><br>

    <head>
        <link rel="stylesheet" href="../Estilos/ruben.css">
    </head>
    <form action="../reserva.php" method="post">
        <button class="botones" type="submit">Volver</button>
        <input type="hidden" name="idAsignatura" value="<?php echo $idAsignatura ?>">
        <input type="hidden" name="fecha" value="<?php echo $fecha ?>">
        <input type="hidden" name="numAlumnos" value="<?php echo $_POST["numAlumnos"] ?>">
    </form>
<?php } ?>