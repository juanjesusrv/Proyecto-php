<?php
$array_tramos_reservaUsuario = array(); //para guardar los tramos que tiene reservados el usuario
$fecha = "2025-03-31"; //para probar que funciona

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["fecha"])) {
    if (isset($_POST["fecha"])) {
        $array_tramos = array(); //para guardar los tramos que tienen alumnos

        $fecha = $_POST["fecha"];
        $sql = "SELECT * FROM reservas WHERE fecha = '$fecha'"; //sacamos todas las reservas de la fecha seleccionada
        $result = mysqli_query($con, $sql);
        foreach ($result as $fila) {
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
    <label for="tramo">Selecciona uno o varios tramos:</label>
    <br>
    <?php
    if (isset($fecha)) {
        $sql4 = "SELECT t.* 
                     FROM tramos t 
                     LEFT JOIN `reservas-tramo` rt ON t.idTramo = rt.idTramo 
                     LEFT JOIN reservas r ON rt.idReserva = r.idReserva AND r.fecha = '$fecha' 
                     WHERE r.idReserva IS NULL";
        $result4 = mysqli_query($con, $sql4);


        if (mysqli_num_rows($result4) == 0) {
            echo "<p>No hay tramos disponibles</p>";
        } else {
            while ($tramo = mysqli_fetch_assoc($result4)) {
                //mostrar solo los tramos que esten libres
                if (!isset($array_tramos[$tramo["idTramo"]])) { ?>
                    <input type="checkbox" name="tramos[]" value="<?php echo $tramo["idTramo"] ?>">
                    <label><?php echo $tramo["idTramo"] . " - " . $tramo["hora"] ?></label><br>
    <?php }
            }
        }
    } else {
        echo "<p>Por favor, selecciona una fecha primero</p>";
    }
    ?>
    <br>
    <br>
    <label for="curso">Curso:</label>
    <select name="curso" id="curso">
        <option value="">Selecciona un curso</option>
        <?php
        //sacamos los cursos que imparte el usuario
        $sql = "SELECT DISTINCT a.curso 
            FROM `asignaturas` a
            JOIN `usuarios-asignaturas` ua ON a.idAsignatura = ua.idAsignatura
            WHERE ua.idUsuario = '" . $_SESSION["idUsuario"] . "'";
        $result = mysqli_query($con, $sql);
        while ($curso = mysqli_fetch_assoc($result)) {
            $selected = (isset($_POST['curso']) && $_POST['curso'] == $curso['curso']) ? 'selected' : '';
        ?>
            <option value="<?php echo $curso["curso"] ?>" <?php echo $selected; ?>><?php echo $curso["curso"] ?></option>
        <?php }
        ?>
    </select>
    <br>
    <br>
    <label for="asignatura">Asignatura:</label>
    <select name="asignatura" id="asignatura">
        <?php
        if (isset($_POST['curso']) && !empty($_POST['curso'])) {
            //sacamos las asignaturas del usuario para el curso seleccionado
            $cursoSeleccionado = $_POST['curso'];
            $sql = "SELECT a.idAsignatura, a.nombreAsignatura 
                FROM `asignaturas` a
                JOIN `usuarios-asignaturas` ua ON a.idAsignatura = ua.idAsignatura
                WHERE ua.idUsuario = '" . $_SESSION["idUsuario"] . "' AND a.curso = '$cursoSeleccionado'";
            $result = mysqli_query($con, $sql);
            while ($asignatura = mysqli_fetch_assoc($result)) {
        ?>
                <option value="<?php echo $asignatura["idAsignatura"] ?>"><?php echo $asignatura["nombreAsignatura"] ?></option>
        <?php }
        } else {
            echo "<option>Selecciona un curso primero</option>";
        }
        ?>
    </select>
    <br>
    <br>
    <button class="botones" type="submit">Enviar</button>
</form>