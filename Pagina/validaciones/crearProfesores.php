<link rel="stylesheet" href="../Estilos/ruben.css">
<?php
require_once "conexion.php";

// Comprobamos si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idUsuario']) && isset($_POST['contrasena']) && isset($_POST['nombre']) && isset($_POST['apellido1']) && isset($_POST['apellido2']) && isset($_POST['email']) && isset($_POST['departamento']) && isset($_POST['rol'])) {

    /* Guardamos los datos del usuario en variables */
    $idUsuario = htmlspecialchars($_POST['idUsuario']);
    $contrasena = htmlspecialchars($_POST['contrasena']);

    $contrasenaCod = password_hash($contrasena, PASSWORD_BCRYPT);

    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido1 = htmlspecialchars($_POST['apellido1']);
    $apellido2 = htmlspecialchars($_POST['apellido2']);
    $email = htmlspecialchars($_POST['email']);
    $departamento = htmlspecialchars($_POST['departamento']);
    $rol = htmlspecialchars($_POST['rol']);

    if (!$con) {
        header("Location: ../gestion_profesorado.php?errorP=Error al conectar a la base de datos");
        exit();
    } else {
        // Verificamos si el idUsuario ya existe en la base de datos
        $sql_comprobarIdUsuario = "SELECT idUsuario FROM usuarios WHERE idUsuario = '$idUsuario'";
        $result_check = mysqli_query($con, $sql_comprobarIdUsuario);

        if (mysqli_num_rows($result_check) == 0) {
            // Insertamos el usuario
            $sql = "INSERT INTO usuarios (idUsuario, contrasena, nombreUsuario, apellido1, apellido2, email, idDepartamento) 
                    VALUES ('$idUsuario','$contrasenaCod','$nombre', '$apellido1', '$apellido2', '$email', '$departamento')";

            if (mysqli_query($con, $sql)) {
                // Añadimos el rol de usuario
                $sql2 = "INSERT INTO `usuarios-roles` (idUsuario, idRol) VALUES ('$idUsuario', '$rol')";
                mysqli_query($con, $sql2);
                header("Location: ../gestion_profesorado.php");
                exit();
            } else {
                header("Location: ../gestion_profesorado.php?errorP=Error al insertar los datos en la base de datos");
                exit();
            }
        } else {
            header("Location: ../gestion_profesorado.php?errorP=El usuario ya existe en la base de datos");
            exit();
        }
    }
} else {
    ?>

    <form action="./validaciones/crearProfesores.php" method="POST" class="formularioSecundario">
        <h2>Añadir profesor</h2>
        <input type="text" name="idUsuario" id="idUsuario" placeholder="DNI" required>
        <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
        <input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido" required>
        <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido" required>
        <input type="email" name="email" id="email" placeholder="Email" required>
        <select name="departamento" id="departamento" required>
            <option value="">Selecciona un departamento</option>
            <?php
            $sql = "SELECT * FROM departamentos";
            $resultado = mysqli_query($con, $sql);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['idDepartamento'] . "'>" . $fila['nombreDepartamento'] . "</option>";
            }
            ?>
        </select>
        <select name="rol" id="rol" required>
            <option value="">Selecciona un rol</option>
            <?php
            $sql = "SELECT * FROM roles";
            $resultado = mysqli_query($con, $sql);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['idRol'] . "'>" . $fila['nombreRol'] . "</option>";
            }
            ?>
        </select>
        <button type="submit" class="botones">Añadir usuario</button>
    </form>

    <?php
    // Mostrar mensaje de error si existe en la URL
    if (isset($_GET['errorP'])) {
        echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['errorP']) . "</p>";
    }
}
?>
