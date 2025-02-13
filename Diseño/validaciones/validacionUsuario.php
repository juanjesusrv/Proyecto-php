<?php

    if (isset($_POST['provincia'])) { // Si se ha enviado el formulario con la provincia entra en el if
        $host = "localhost"; // Nombre del host
        $user = "root"; // Usuario de la base de datos
        $password = ""; // Contraseña de la base de datos
        $db = "campeonatos"; // Nombre de la base de datos

        $provincia = htmlspecialchars($_POST['provincia']); // Guardamos la provincia en una variable
        
        $con = mysqli_connect($host, $user, $password, $db); // Conectamos a la base de datos
        
        $query1 = "SELECT * FROM ciudades WHERE provincia = '$provincia'"; // Creamos la consulta para obtener las ciudades de la provincia
        $resultado = mysqli_query($con, $query1); // Ejecutamos la consulta

        

        if (mysqli_num_rows($resultado) > 0) { // Si hay ciudades en la provincia entra en el if
            echo "<h1>Ciudades de la provincia de " . $provincia . "</h1>";
            echo "<table border='1'>";
                echo "<tr>";
                    echo "<td>Nombre de la ciudad </td>";
                    echo "<td>Provincia </td>";
                    echo "<td>Numero de habitantes </td>";
                echo "</tr>";
            while ($registro = mysqli_fetch_assoc($resultado)) { // Recorremos las ciudades
                echo "<tr>";
                    echo "<td>" . $registro['NombreCiudad'] . "</td>";
                    echo "<td>" . $registro['Provincia'] . "</td>";
                    echo "<td>" . $registro['NumHab'] . "</td>";
                echo "</tr>";
            }
            echo "</table><br>";
        } else { // Si no hay ciudades en la provincia entra en el else
            echo "No se encontraron ciudades en la provincia de " . $provincia;
            echo "<br><br>";
        }

        
        echo "<button onclick='history.go(-1)'>Volver</button>"; // Botón para volver a la página anterior

        echo "<hr>";
    }

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php if (!isset($_POST['provincia'])): ?> <!-- Si no se ha enviado el formulario muestra el formulario -->
    <form action="Ej_ConsultaCiudades.php" method="POST">
        <label for="provincia">Ingrese el nombre de una provincia:</label>
        <input type="text" name="provincia" id="provincia">
        <input type="submit" value="Enviar">
    </form>
    <?php endif; ?> <!-- Fin del if -->

</body>
</html>