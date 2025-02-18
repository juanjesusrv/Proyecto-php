<?php

if (!$con) {
    echo "Error al conectar a la base de datos";
} 
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
        <h1>Lista de reservas de <?= $_SESSION['nombreUsuario']?></h1>
        <table>
            <tr>
                <th>ID Reserva</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Asignatura</th>
                <th>Curso</th>
                <th>Grupo</th>
            </tr>

            <?php if (in_array(1, $_SESSION['roles'])) { ?> <!-- Si el usuario tiene el rol 1 -->
                <?php
                    

                    $idUsuario = mysqli_real_escape_string($con, $_SESSION['idUsuario']);

                    $query = "SELECT r.idReserva, r.fecha, t.hora, a.nombreAsignatura, a.curso, ua.grupo 
                            FROM reservas r 
                            JOIN `reservas-tramo` rt ON r.idReserva = rt.idReserva 
                            JOIN tramos t ON rt.idTramo = t.idTramo 
                            JOIN asignaturas a ON r.idAsignatura = a.idAsignatura 
                            JOIN `usuarios-asignaturas` ua ON r.idUsuario = ua.idUsuario 
                            AND r.idAsignatura = ua.idAsignatura 
                            WHERE r.idUsuario = '$idUsuario'";

                    $result = mysqli_query($con, $query);
                    if (!$result) {
                        die("Error en la consulta: " . mysqli_error($con)); // Muestra el error de SQL
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
                            echo "</tr>";
                        }
                    } else {
                        echo "No hay reservas";
                    }
                ?>

            <?php } ?> 

        </table>
    </div>
    <div>
        <img src="../imgs/" alt=""> I.E.S. Jorge Guillén
    </div>
</body>
</html>