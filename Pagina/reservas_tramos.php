<?php
session_start();
$con = $_SESSION["con"];

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["fecha"])) {
    if (isset($_POST["fecha"])) {
        $array_tramos = array(); //para guardar los tramos que tienen alumnos
        $array_tramos_reservaUsuario = array(); //para guardar los tramos que tiene reservados el usuario
        $fecha = $_POST["fecha"];
        $sql = "select * from reservas where fecha = '$fecha'";
        $result = mysqli_query($con, $sql);
        foreach ($result as $fila) {
            $idReserva = $fila["idReserva"];
            $idUsuario = $fila["idUsuario"];
            $idAsignatura = $fila["idAsignatura"];


            $sql3 = "select * from usuarios-asignaturas where idAsignatura = '$idAsignatura' and idUsuario = '$idUsuario'";
            $numAlumnos = 0;
            $result3 = mysqli_query($con, $sql3);
            foreach ($result3 as $fila3) {
                $numAlumnos = $fila3["numAlumnos"];
            }

            $sql2 = "select * from reservas-tramo where idReserva = '$idReserva'";
            $result2 = mysqli_query($con, $sql2);
            foreach ($result2 as $fila2) {
                $idTramo = $fila2["idTramo"];
                if ($array_tramos[$idTramo] == null) {
                    $array_tramos[$idTramo] = $numAlumnos;
                } else {
                    $array_tramos[$idTramo] += $numAlumnos;
                }
                if ($idUsuario == $_SESSION["idUsuario"]) {
                    $array_tramos_reservaUsuario[] = $idTramo;
                }
            }
        }
    }
}
