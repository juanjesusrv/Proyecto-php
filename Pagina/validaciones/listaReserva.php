<?php

if (!$con) {
    echo "Error al conectar a la base de datos";
}

if (!isset($_SESSION['eleccion'])) {
    $_SESSION['eleccion'] = true;
}

if (isset($_POST['cambiar_vista'])) {
    $_SESSION['eleccion'] = !$_SESSION['eleccion'];
}

$eleccion = $_SESSION['eleccion'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid black;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div>
        <?php if (!isset($_SESSION['nombreUsuario'])) { //Salta un error de inicio de sesión si no hay una cuenta iniciada
            header('Location: ../Pagina/errorsesion.php');
         } ?>
         <?php if (in_array(2, $_SESSION['roles']) && $eleccion) { ?>
        <h1>Lista de reservas del profesorado</h1>
        <?php }else{ ?>
            <h1>Lista de reservas de <?= $_SESSION['nombreUsuario'] ?></h1>
        <?php } ?>
        
        <?php if (in_array(2, $_SESSION['roles'])) { ?>
            <form method="post" style="margin-bottom: 10px;">
                <button class="botones" type="submit" name="cambiar_vista" id="list-reservas" onclick="window.location.hash='list-reservas';">
                    <?= $eleccion ? "Ver solo mis reservas" : "Ver todas las reservas"; ?>
                </button>
            </form>
        <?php } ?>

        <table>
            <tr>
                <th>ID Reserva</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Grupo</th>
                <th>Alumnos</th>
                <?php if (in_array(2, $_SESSION['roles']) && $eleccion) { ?>
                    <th>ID Usuario</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                <?php } ?>
            </tr>

            <?php
            $idUsuario = mysqli_real_escape_string($con, $_SESSION['idUsuario']);

            if (in_array(2, $_SESSION['roles']) && $eleccion) {
                $query = "SELECT r.idReserva, r.fecha, t.hora, a.nombreAsignatura, a.curso, ua.grupo, alumnosReserva, r.idUsuario, u.nombreUsuario, u.apellido1 
                        FROM reservas r 
                        JOIN `reservas-tramo` rt ON r.idReserva = rt.idReserva 
                        JOIN tramos t ON rt.idTramo = t.idTramo 
                        JOIN asignaturas a ON r.idAsignatura = a.idAsignatura 
                        JOIN `usuarios-asignaturas` ua ON r.idUsuario = ua.idUsuario 
                        AND r.idAsignatura = ua.idAsignatura 
                        AND r.grupo = ua.grupo
                        JOIN usuarios u ON r.idUsuario = u.idUsuario
                        ORDER BY r.fecha ASC";
            } else {
                $query = "SELECT r.idReserva, r.fecha, t.hora, a.nombreAsignatura, a.curso, ua.grupo, alumnosReserva 
                        FROM reservas r 
                        JOIN `reservas-tramo` rt ON r.idReserva = rt.idReserva 
                        JOIN tramos t ON rt.idTramo = t.idTramo 
                        JOIN asignaturas a ON r.idAsignatura = a.idAsignatura 
                        JOIN `usuarios-asignaturas` ua ON r.idUsuario = ua.idUsuario 
                        AND r.idAsignatura = ua.idAsignatura 
                        AND r.grupo = ua.grupo
                        WHERE r.idUsuario = '$idUsuario'
                        ORDER BY r.fecha ASC";
            }

            $result = mysqli_query($con, $query);
            if (!$result) {
                die("Error en la consulta: " . mysqli_error($con));
            }

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['idReserva'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['hora'] . "</td>";
                    echo "<td>" . $row['nombreAsignatura'] . "</td>";
                    echo "<td>" . $row['curso'] . "</td>";
                    echo "<td>" . $row['grupo'] . "</td>";
                    echo "<td>" . $row['alumnosReserva'] . "</td>";
                    if (in_array(2, $_SESSION['roles']) && $eleccion) {
                        echo "<td>" . $row['idUsuario'] . "</td>";
                        echo "<td>" . $row['nombreUsuario'] . "</td>";
                        echo "<td>" . $row['apellido1'] . "</td>";
                    } else if (in_array(2, $_SESSION['roles']) && !$eleccion) {
                        echo "<td>
                            <form action='./validaciones/eliminarReserva.php#listaReservas' method='post' onsubmit='return confirmarEliminacion();'>
                            <input type='hidden' name='idReserva' value='" . $row['idReserva'] . "'>
                            <input type='hidden' name='hora' value='" . $row['hora'] . "'>
                            <button type='submit'><img src='./imgs/papelera.png' width='20' height='20'></button>
                            </form>
                        </td>";
                    } else {
                        echo "<td>
                            <form action='./validaciones/eliminarReserva.php' method='post' onsubmit='return confirmarEliminacion();'>
                            <input type='hidden' name='idReserva' value='" . $row['idReserva'] . "'>
                            <input type='hidden' name='hora' value='" . $row['hora'] . "'>
                            <button type='submit'><img src='./imgs/papelera.png' width='20' height='20'></button>
                            </form>
                        </td>";
                    }
                    echo "</tr>";
                }
            } else {
                if (in_array(2, $_SESSION['roles']) && $eleccion) {
                    echo "<tr><td colspan='10'>No hay reservas</td></tr>";
                } else {
                    echo "<tr><td colspan='7'>No hay reservas</td></tr>";
                }
            }
            ?>
        </table>
    </div>
    <script>
        function confirmarEliminacion() {
            return confirm("¿Estás seguro de que quieres eliminar la reserva?");
        }
    </script>
</body>
</html>
