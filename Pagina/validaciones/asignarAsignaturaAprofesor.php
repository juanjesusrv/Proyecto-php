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

    // Obtenemos el curso de la asignatura seleccionada
    $sql_curso = "SELECT curso FROM asignaturas WHERE idAsignatura = '$idAsignatura'";
    $resultado_curso = mysqli_query($con, $sql_curso);

    // Verificamos si obtuvimos el curso de la asignatura
    if ($resultado_curso && mysqli_num_rows($resultado_curso) > 0) {
        $curso = mysqli_fetch_assoc($resultado_curso)['curso'];

        // Comprobamos si ya existe un profesor asignado al mismo grupo, asignatura y curso
        // Hacemos un JOIN con la tabla asignaturas para acceder al campo curso
        $sql_comprobarAsignacion = "SELECT * 
                                    FROM `usuarios-asignaturas` uas
                                    JOIN `asignaturas` a ON uas.idAsignatura = a.idAsignatura
                                    WHERE uas.idAsignatura = '$idAsignatura' 
                                    AND uas.grupo = '$grupo' 
                                    AND a.curso = '$curso'";

        $resultado_check = mysqli_query($con, $sql_comprobarAsignacion);

        if (mysqli_num_rows($resultado_check) > 0) {
            // Si no existe, procedemos con la inserción de los datos
            $sql = "INSERT INTO `usuarios-asignaturas` (idUsuario, idAsignatura, numAlumnos, grupo) 
                    VALUES ('$idUsuario', '$idAsignatura', '$numAlumnos', '$grupo')";
            if (mysqli_query($con, $sql)) {
                header("Location: ../gestion_profesorado.php"); // Redirigimos a la página de gestión
            } else {
                echo "Error al asignar la asignatura al profesor.";
                ?>
                <a href="../gestion_profesorado.php">Volver</a>
                <?php
            }
        } else {
            // Si ya existe la asignación, mostramos un mensaje y no insertamos
            echo "Ya existe un profesor asignado a este grupo en la asignatura y curso seleccionados.";
            ?>
            <a href="../gestion_profesorado.php">Volver</a>
    <?php
        }
    } else {
        echo "No se pudo obtener el curso de la asignatura seleccionada.";
            ?>
            <a href="../gestion_profesorado.php">Volver</a>
            <?php
    }
} else {
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
                echo "<option value='" . $fila['idAsignatura'] . "'>" . $fila['nombreAsignatura'] . " - " . $fila['curso'] . "</option>";
            }
            ?>
        </select>
        <br>
        <input type="number" name="numAlumnos" id="numAlumnos" placeholder="Número de alumnos" required>
        <input type="text" name="grupo" id="grupo" placeholder="Grupo" pattern="[A-Za-z]" title="Debe ser una sola letra" required>
        <br>
        <button type="submit" class="botones">Añadir asignación</button>
    </form>
<?php
}
?>