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

                $row = mysqli_fetch_assoc($result); // Guardamos los datos del usuario en un array
                $_SESSION['idUsuario'] = $row['idUsuario']; // Guardamos el id del usuario en una variable de sesión
                $_SESSION['nombreUsuario'] = $row['nombreUsuario']; // Guardamos el nombre del usuario en una variable de sesión
                $_SESSION['apellido1'] = $row['apellido1']; // Guardamos el primer apellido del usuario en una variable de sesión
                $_SESSION['apellido2'] = $row['apellido2']; // Guardamos el segundo apellido del usuario en una variable de sesión
                $_SESSION['email'] = $row['email']; // Guardamos el email del usuario en una variable de sesión
                $_SESSION['idDepartamento'] = $row['idDepartamento']; // Guardamos el id del departamento del usuario en una variable de sesión
                $_SESSION['con'] = $con; // Guardamos la conexión a la base de datos en una variable de sesión
                $query = "SELECT * FROM `usuarios-roles` WHERE idUsuario = '$idUsuario'"; // Creamos la consulta
                $result = mysqli_query($con, $query); // Realizamos la consulta
                
                if (mysqli_num_rows($result) > 0) { // Si la consulta devuelve algún resultado
                    $roles = array(); // Creamos un array para almacenar los roles
                    while ($row = mysqli_fetch_assoc($result)) { // Recorremos los resultados
                        $roles[] = $row['idRol']; // Añadimos cada rol al array
                    }
                    $_SESSION['roles'] = $roles; // Guardamos los roles en una variable de sesión
                } else {
                    echo "El usuario no tiene roles asignados"; // Si no devuelve resultados, mostramos un mensaje de error
                }
                

                header("Location: ../reserva.php"); // Redirigimos a la página principal
            } else {
                echo "Usuario o contraseña incorrectos"; // Si no devuelve resultados, mostramos un mensaje de error
            }
        }
    }

?>