<!-- Creamos el formulario para añadir profesores -->
<link rel="stylesheet" href="../Estilos/ruben.css">
<?php
// Comprobamos si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "./conexion.php"; // Incluimos el archivo de conexión a la base de datos

    /* Guardamos los datos del usuario en variables */
    $idUsuario = htmlspecialchars($_POST['idUsuario']); // Guardamos el id en una variable
    $contrasena = htmlspecialchars($_POST['contrasena']); // Guardamos la contraseña en una variable
    $nombre = htmlspecialchars($_POST['nombre']); // Guardamos el nombre en una variable
    $apellido1 = htmlspecialchars($_POST['apellido1']); // Guardamos el primer apellido en una variable
    $apellido2 = htmlspecialchars($_POST['apellido2']); // Guardamos el segundo apellido en una variable
    $email = htmlspecialchars($_POST['email']); // Guardamos el email en una variable
    $departamento = htmlspecialchars($_POST['departamento']); // Guardamos el departamento en una variable

    if (!$con) {
        echo "Error al conectar a la base de datos";
    } else {
        //Añadimos el profesor a la base de datos
        $sql = "INSERT INTO usuarios (idUsuario, contrasena, nombreUsuario, apellido1, apellido2, email, idDepartamento) VALUES ('$idUsuario','$contrasena','$nombre', '$apellido1', '$apellido2', '$email', '$departamento')";
        mysqli_query($con, $sql);
        header("Location: ../gestion_profesorado.php");
        
    }
}

?>
<form action="./validaciones/crearProfesores.php" method="POST" class="formularioProfesores">
    <h2>Añadir profesor</h2>
    <input type="text" name="idUsuario" id="idUsuario" placeholder="DNI" required>
    <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña" required>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre" required>
    <input type="text" name="apellido1" id="apellido1" placeholder="Primer apellido" required>
    <input type="text" name="apellido2" id="apellido2" placeholder="Segundo apellido" required>
    <input type="email" name="email" id="email" placeholder="Email" required>
    <br>
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
    <br>
    <button type="submit" class="botones">Añadir usuario</button>
</form>