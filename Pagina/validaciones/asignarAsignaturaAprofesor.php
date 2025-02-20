<!-- Creamos el formulario para añadir profesores -->
<link rel="stylesheet" href="../Estilos/ruben.css">
<?php
// Comprobamos si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "./conexion.php"; // Incluimos el archivo de conexión a la base de datos

    /* Guardamos los datos del usuario en variables */
    $idUsuario = htmlspecialchars($_POST['idUsuario']); // Guardamos el id en una variable
    $idAsignatura = htmlspecialchars($_POST['idAsignatura']);
    $numAlumnos = htmlspecialchars($_POST['numAlumnos']);
    $grupo = htmlspecialchars(strtoupper($_POST['grupo'])); // Convierte el grupo a mayúscula

    $sql = "INSERT INTO `usuarios-asignaturas` (idUsuario, idAsignatura, numAlumnos, grupo) VALUES ('$idUsuario', '$idAsignatura', '$numAlumnos', '$grupo')";
    mysqli_query($con, $sql);
    header("Location: ../gestion_profesorado.php");
}

?>
<form action="./validaciones/asignarAsignaturaAprofesor.php" method="POST" class="formularioProfesores">
    <h2>Añadir asignación</h2>
    <select name="idUsuario" id="idUsuario" required>
        <option value="">Selecciona un usuario</option>
        <?php
        $sql = "SELECT * FROM usuarios";
        $resultado = mysqli_query($con, $sql);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<option value='" . $fila['idUsuario'] . "'>" . $fila['nombreUsuario'] . "</option>";
        }
        ?>
    </select>
    <br>
    <select name="idAsignatura" id="idAsignatura" required>
        <option value="">Selecciona una asignatura</option>
        <?php
        $sql = "SELECT * FROM asignaturas";
        $resultado = mysqli_query($con, $sql);
        while ($fila = mysqli_fetch_assoc($resultado)) {
            echo "<option value='" . $fila['idAsignatura'] . "'>" . $fila['nombreAsignatura']. " - " .$fila['curso'] . "</option>";
        }
        ?>
    </select>
    <br>
    <input type="number" name="numAlumnos" id="numAlumnos" placeholder="Número de alumnos" required>
    <input type="text" name="grupo" id="grupo" placeholder="Grupo" pattern="[A-Za-z]" title="Debe ser una sola letra" required>
        <br>
    <button type="submit" class="botones">Añadir asignación</button>
</form>
