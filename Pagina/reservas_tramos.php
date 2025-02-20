<?php
$array_tramos_reservaUsuario = array(); //para guardar los tramos que tiene reservados el usuario
$fecha = $_POST["fecha"];

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["fecha"])) {
    $array_tramos = array(); //para guardar los tramos que tienen alumnos

    //$fecha = $_POST["fecha"];
    $sql = "SELECT * FROM reservas WHERE fecha = '$fecha'"; //sacamos todas las reservas de la fecha seleccionada
    $result = mysqli_query($con, $sql);
    while ($fila = mysqli_fetch_assoc($result)) {
        $idReserva = $fila["idReserva"];
        $idUsuario = $fila["idUsuario"];
        $idAsignatura = $fila["idAsignatura"];


        $sql3 = "SELECT * FROM `usuarios-asignaturas` WHERE idAsignatura = '$idAsignatura' AND idUsuario = '$idUsuario'";  //sacamos el numero de alumnos de la asignatura
        $numAlumnos = 0;
        $result3 = mysqli_query($con, $sql3);
        foreach ($result3 as $fila3) {
            $numAlumnos = $fila3["numAlumnos"]; //guardamos el numero de alumnos
        }

        $sql2 = "SELECT * FROM `reservas-tramo` WHERE idReserva = '$idReserva'"; //sacamos los tramos de la reserva
        $result2 = mysqli_query($con, $sql2);
        while ($fila2 = mysqli_fetch_assoc($result2)) {
            $idTramo = $fila2["idTramo"];
            //si el tramo no esta en el array, lo añadimos
            if (!isset($array_tramos[$idTramo])) {
                $array_tramos[$idTramo] = $numAlumnos;
            } else {
                $array_tramos[$idTramo] += $numAlumnos;
            }
            //si el idUsuario es el mismo que el de la sesion, guardamos el idTramo
            if ($idUsuario == $_SESSION["idUsuario"]) {
                $array_tramos_reservaUsuario[] = $idTramo;
            }
        }
    }
}
?>

<form action="reservas_tramos.php" method="post">
    <label for="tramo">Selecciona uno o varios tramos:</label>
    <br>
    <?php
    $numAlumnos = 20;
    if (isset($fecha)) {
        $sql5 = "SELECT * FROM tramos";
        $result5 = mysqli_query($con, $sql5);
        while ($tramo = mysqli_fetch_assoc($result5)) {

            if (!in_array($tramo["idTramo"], $array_tramos_reservaUsuario)) {
                echo $tramo["idTramo"];
                if ((isset($array_tramos[$tramo["idTramo"]]) && $array_tramos[$tramo["idTramo"]] + $numAlumnos <= 100) || !isset($array_tramos[$tramo["idTramo"]])) { ?>
                    <input type="checkbox" id="tramos" name="tramos[]" value="<?php echo $tramo["idTramo"] ?>">
                    <label for="tramos"><?php echo $tramo["idTramo"] . ": " . $tramo["hora"] ?></label><br>
    <?php }
            }
        }
    }
    ?>
    <br>
    <br>
    <button class="botones" type="submit">Enviar</button>
</form>