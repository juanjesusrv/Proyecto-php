<?php

    session_start(); // Iniciamos la sesión

    if (isset($_POST['usr']) && isset($_POST['con'])) {
        $host = "localhost"; // Nombre del host
        $user = "root"; // Usuario de la base de datos
        $password = ""; // Contraseña de la base de datos
        $db = "reservas"; // Nombre de la base de datos

        /* Guardamos los datos del usuario en variables */
       $contrasena = htmlspecialchars($_POST['con']); // Guardamos la contraseña en una variable
        $idUsuario = htmlspecialchars($_POST['usr']); // 


        $con = mysqli_connect($host, $user, $password, $db); // Conectamos a la base de datos
        
        if (!$con) {
            echo "Error al conectar a la base de datos";
        } else {
            $query = "SELECT * FROM usuarios WHERE idUsuario = '$idUsuario' AND contrasena = '$contrasena'"; // Creamos la consulta
            $result = mysqli_query($con, $query); // Realizamos la consulta

            if (mysqli_num_rows($result) > 0) { // Si la consulta devuelve algún resultado
                $_SESSION['idUsuario'] = $idUsuario; // Guardamos el id del usuario en la sesión

                header("Location: ../###"); // Redirigimos a la página principal
            } else {
                echo "Usuario o contraseña incorrectos"; // Si no devuelve resultados, mostramos un mensaje de error
            }
        }
    }

?>