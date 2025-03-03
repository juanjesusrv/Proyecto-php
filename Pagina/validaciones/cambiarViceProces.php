<?php 

session_start();
require_once "conexion.php";

$idUsuario = mysqli_real_escape_string($con, $_SESSION['idUsuario']);

            if (isset($_POST['cambia'])) {   
                // Cambia el vicedirectór
                $query = "DELETE FROM `usuarios-roles` WHERE idUsuario IN ('" . $_SESSION['idUsuario'] . "', '" . $_POST['cambia'] . "');";
                $result = mysqli_query($con, $query);
                $query = "INSERT INTO `usuarios-roles` (idUsuario, idRol) VALUES ('" . $_SESSION['idUsuario'] . "', 1), ('" . $_POST['cambia'] . "', 2);";
                $result = mysqli_query($con, $query);
            
                // Cerrar la sesión y redirigir al index.php
                session_unset();  // Elimina todas las variables de sesión
                session_destroy();  // Destruye la sesión
                header("Location: ../index.php");  // Redirige al index.php
                exit();  // Asegúrate de detener la ejecución del script aquí
            }



?>