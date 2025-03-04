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
        <h1>Lista de profesores con sus asignaturas</h1>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Grupo</th>
            </tr>

            <?php
            $idUsuario = mysqli_real_escape_string($con, $_SESSION['idUsuario']);

                $query = "SELECT u.nombreUsuario, u.apellido1 , a.nombreAsignatura, a.curso, ua.grupo
                        FROM `usuarios-asignaturas` ua
                        JOIN usuarios u ON ua.idUsuario = u.idUsuario
                        JOIN asignaturas a ON ua.idAsignatura = a.idAsignatura;";

            $result = mysqli_query($con, $query);
            if (!$result) {
                die("Error en la consulta: " . mysqli_error($con));
            }

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nombreUsuario'] . "</td>";
                    echo "<td>" . $row['apellido1'] . "</td>";
                    echo "<td>" . $row['nombreAsignatura'] . "</td>";
                    echo "<td>" . $row['curso'] . "</td>";
                    echo "<td>" . $row['grupo'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay asignaturas asignadas</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
