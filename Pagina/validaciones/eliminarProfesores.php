<?php
if (!isset($_POST['eleccion'])) {
    $_SESSION['eleccion'] = true;
}

if (!$con) {
    echo "Error al conectar a la base de datos";
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
        <p>Eliminar Profesores</p>

        <table>
            <tr>
                <?php if (in_array(2, $_SESSION['roles']) && $eleccion) { ?>
                    <th>DNI</th>
                    <th>Usuario</th>
                <?php }
                ?>
            </tr>

            <?php
            $idUsuario = mysqli_real_escape_string($con, $_SESSION['idUsuario']);

            if (isset($_POST['borra'])) {   
            //Si recibe un elemento que borrar, lo borra
            //Borra las reservas que tenga
                $query = "DELETE FROM `reservas-tramo` WHERE idReserva IN (SELECT idReserva FROM `reservas` WHERE idUsuario = '" . $_POST['borra'] . "');";
                $result = mysqli_query($con, $query);
                $query = "DELETE FROM `reservas` WHERE idUsuario = '" . $_POST['borra'] . "';";
                $result = mysqli_query($con, $query);
            //Borra los datos relacionados
                $query = "DELETE FROM `usuarios-roles` WHERE idUsuario = '" . $_POST['borra'] . "';";
                $result = mysqli_query($con, $query);
                $query = "DELETE FROM `usuarios-asignaturas` WHERE idUsuario = '" . $_POST['borra'] . "';";
                $result = mysqli_query($con, $query);
            //Borra el usuario
                $query = "DELETE FROM usuarios WHERE idUsuario = '" . $_POST['borra'] . "';";
                $result = mysqli_query($con, $query);
                echo '<b>El usuario ' . $_POST['borra'] . ' ha sido eliminado.</b><br>';

            }

            $query = "SELECT idUsuario, nombreUsuario, apellido1 
                        FROM usuarios";

            $result = mysqli_query($con, $query);
            if (!$result) {
                die("Error en la consulta: " . mysqli_error($con));
            }

            if (mysqli_num_rows($result) > 0) {
                echo '<form  action="gestion_profesorado.php" method="post">';
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<td> <b><input type="submit" value="' . $row['idUsuario'] . '" name="borra"></td>';
                    echo "<td>" .  $row['nombreUsuario'] . ", " . $row['apellido1'] . "</td></tr>";
                }
                echo "</form>";
            } else {
                echo "<tr><td colspan='6'>No hay reservas</td></tr>";
            }
            ?>
        </table>
    </div>
    
</body>
</html>
