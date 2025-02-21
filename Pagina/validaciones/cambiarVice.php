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
        <h2>Cambiar Vicedirectór</h2>
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

            if (isset($_POST['cambia'])) {   
            //Cambia el vicedirectór
                $query = "DELETE FROM `usuarios-roles` WHERE idUsuario IN ('" . $_SESSION['idUsuario'] . "', '" . $_POST['cambia'] . "');";
                $result = mysqli_query($con, $query);
                $query = "INSERT INTO `usuarios-roles` (idUsuario, idRol) VALUES ('" . $_SESSION['idUsuario'] . "', 1), ('" . $_POST['cambia'] . "', 2);";
                $result = mysqli_query($con, $query);
                echo '<b>El usuario ' . $_POST['cambia'] . ' ha sido convertido a Vicedirectór.</b><br>';

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
                    //Si la id actuál es la misma que la del usuario iniciado (el vicedirectór) no se muestra.
                    if ($row['idUsuario'] != $_SESSION['idUsuario']) {
                        echo '<td> <b><input type="submit" value="' . $row['idUsuario'] . '" name="cambia"></td>';
                        echo "<td>" .  $row['nombreUsuario'] . ", " . $row['apellido1'] . "</td></tr>";
                    }
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
