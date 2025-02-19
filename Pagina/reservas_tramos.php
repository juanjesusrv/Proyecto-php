<?php

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["fecha"])) {
    if (isset($_POST["fecha"])) {
        $array_tramos = array(); //para guardar los tramos que tienen alumnos
        $array_tramos_reservaUsuario = array(); //para guardar los tramos que tiene reservados el usuario
        $fecha = $_POST["fecha"];
        $sql = "select * from reservas where fecha = '$fecha'"; //sacamos todas las reservas de la fecha seleccionada
        $result = mysqli_query($con, $sql);
        foreach ($result as $fila) {
            $idReserva = $fila["idReserva"];
            $idUsuario = $fila["idUsuario"];
            $idAsignatura = $fila["idAsignatura"];


            $sql3 = "select * from usuarios-asignaturas where idAsignatura = '$idAsignatura' and idUsuario = '$idUsuario'"; //sacamos el numero de alumnos de la asignatura
            $numAlumnos = 0;
            $result3 = mysqli_query($con, $sql3);
            foreach ($result3 as $fila3) {
                $numAlumnos = $fila3["numAlumnos"]; //guardamos el numero de alumnos
            }

            $sql2 = "select * from reservas-tramo where idReserva = '$idReserva'"; //sacamos los tramos de la reserva
            $result2 = mysqli_query($con, $sql2);
            foreach ($result2 as $fila2) {
                $idTramo = $fila2["idTramo"];
                //si el tramo no esta en el array, lo añadimos
                if ($array_tramos[$idTramo] == null) {
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
}

?>

<form action="reservas_tramos.php" method="post">
    <p>Haz tu Reserva</p>
    <br>
    <p>Selecciona el tramo</p>
    <label for="tramo">Hora:</label>
    <select name="tramo" id="tramo">
        <?php
        if (isset($fecha)) {
            $sql4 = "SELECT t.* 
                     FROM tramos t 
                     LEFT JOIN `reservas-tramo` rt ON t.idTramo = rt.idTramo 
                     LEFT JOIN reservas r ON rt.idReserva = r.idReserva AND r.fecha = '$fecha' 
                     WHERE r.idReserva IS NULL";
            $result4 = mysqli_query($con, $sql4);


            if (mysqli_num_rows($result4) == 0) {
                echo "<option>No hay tramos disponibles</option>";
            } else {
                while ($tramo = mysqli_fetch_assoc($result4)) {
                    //mostrar solo los tramos que esten libres
                    if (!isset($array_tramos[$tramo["idTramo"]])) { ?>
                        <option value="<?php echo $tramo["idTramo"] ?>"><?php echo $tramo["idTramo"] . " - " . $tramo["hora"] ?></option>
        <?php }
                }
            }
        } else {
            echo "<option>Por favor, selecciona una fecha primero</option>";
        }
        ?>
    </select>
    <br>
    <br>
    <button type="submit">Enviar</button>
</form>