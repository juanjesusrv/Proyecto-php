<?php
session_start(); // Siempre al inicio

if (isset($_POST['usr']) && isset($_POST['con'])) {
    require_once "./conexion.php"; // Conexión a la BD

    // Guardar credenciales en variables seguras
    $idUsuario = htmlspecialchars($_POST['usr']);
    $contrasena = htmlspecialchars($_POST['con']);

    // 1. Verificar conexión
    if (!$con) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // 2. Verificar si el usuario existe en la BD
    $stmt = mysqli_prepare($con, "SELECT idUsuario, nombreUsuario, apellido1, apellido2, email, idDepartamento, contrasena 
                                  FROM usuarios WHERE idUsuario = ?");
    mysqli_stmt_bind_param($stmt, "s", $idUsuario);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // 3. Mostrar los datos recuperados para depuración
        echo "<pre>";
        var_dump($row);
        echo "</pre>";

        $hashGuardado = $row['contrasena'];

        // 4. Verificar si la contraseña coincide
        if (password_verify($contrasena, $hashGuardado)) {
            echo "Contraseña correcta";

            // Guardar datos en la sesión
            $_SESSION['idUsuario'] = $row['idUsuario'];
            $_SESSION['nombreUsuario'] = $row['nombreUsuario'];
            $_SESSION['apellido1'] = $row['apellido1'];
            $_SESSION['apellido2'] = $row['apellido2'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['idDepartamento'] = $row['idDepartamento'];

            // Consultar roles del usuario
            $stmt_roles = mysqli_prepare($con, "SELECT idRol FROM `usuarios-roles` WHERE idUsuario = ?");
            mysqli_stmt_bind_param($stmt_roles, "s", $idUsuario);
            mysqli_stmt_execute($stmt_roles);
            $result_roles = mysqli_stmt_get_result($stmt_roles);

            if (mysqli_num_rows($result_roles) > 0) {
                $roles = [];
                while ($row_rol = mysqli_fetch_assoc($result_roles)) {
                    $roles[] = $row_rol['idRol'];
                }
                $_SESSION['roles'] = $roles;
            } else {
                echo "⚠ El usuario no tiene roles asignados";
            }

            // Redirigir a la página principal
            header("Location: ../reserva.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos";
        }
    } else {
        echo "Usuario no encontrado en la base de datos";
    }
}
?>
