<?php 

session_start();

require_once "./conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idReserva=htmlspecialchars($_POST['idReserva']);
    $hora=htmlspecialchars($_POST['hora']);

    $query="SELECT idTramo FROM tramos WHERE hora = '$hora'";
    $result = mysqli_query($con, $query);
    $result = mysqli_fetch_assoc($result);
    require_once "enviarMail.php";
    enviarMail($con,$idReserva,[$result["idTramo"]],"borrar");

    $query = "DELETE FROM `reservas-tramo` 
    WHERE idReserva = '$idReserva' 
    AND idTramo = (SELECT idTramo FROM tramos WHERE hora = '$hora')";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    $query = "SELECT * FROM `reservas-tramo` WHERE idReserva = '$idReserva'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Error en la consulta: " . mysqli_error($con));
    }

    if (mysqli_num_rows($result) == 0) {
        $query = "DELETE FROM reservas WHERE idReserva = '$idReserva'";
        $result = mysqli_query($con, $query);

        if (!$result) {
            die("Error en la consulta: " . mysqli_error($con));
        }
    }
    
    header("Location: ../reserva.php");

}
?>