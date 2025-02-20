<?php

    session_start(); // Iniciamos la sesión

    if (isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['email']) && isset($_POST['departamento'])) {
        
        require_once "./conexion.php"; // Incluimos el archivo de conexión a la base de datos

        /* Guardamos los datos del usuario en variables */
        $nombre = htmlspecialchars($_POST['nombre']); // Guardamos el nombre en una variable
        $apellido1 = htmlspecialchars($_POST['apellido1']); // Guardamos el primer apellido en una variable
        $apellido2 = htmlspecialchars($_POST['apellido2']); // Guardamos el segundo apellido en una variable
        $email = htmlspecialchars($_POST['email']); // Guardamos el email en una variable
        $departamento = htmlspecialchars($_POST['departamento']); // Guardamos el departamento en una variable

        if (!$con) {
            echo "Error al conectar a la base de datos";
        } else {
            $query = "INSERT INTO profesores (nombre, apellido1, apellido2, email, idDepartamento) VALUES ('$nombre', '$apellido1', '$apellido2', '$email', '$departamento')"; // Creamos la consulta
            $result = mysqli_query($con, $query); // Realizamos la consulta

            if ($result) { // Si la consulta devuelve algún resultado
                header("Location: ../gestion_profesorado.php"); // Redirigimos a la página principal
            } else {
                echo "Error al insertar el profesor"; // Si no devuelve resultados, mostramos un mensaje de error
            }
        }
    }
?>