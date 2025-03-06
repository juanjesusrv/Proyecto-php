<link rel="stylesheet" href="../Estilos/ruben.css">
<?php
require_once "conexion.php";

// Comprobamos si se han enviado los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['idUsuario']) && isset($_POST['idAsignatura']) && isset($_POST['numAlumnos'])) {

    /* Guardamos los datos del usuario en variables */
    $idUsuario = htmlspecialchars($_POST['idUsuario']);
    $idAsignatura = htmlspecialchars($_POST['idAsignatura']);
    $numAlumnos = htmlspecialchars($_POST['numAlumnos']);

    if (isset($_POST['grupo'])) {
        $grupo = htmlspecialchars($_POST['grupo']);
    } else {
        $grupo = "";
    }

    // Obtenemos el curso de la asignatura seleccionada
    $sql_curso = "SELECT curso FROM asignaturas WHERE idAsignatura = '$idAsignatura'";
    $resultado_curso = mysqli_query($con, $sql_curso);

    // Verificamos si obtuvimos el curso de la asignatura
    if ($resultado_curso && mysqli_num_rows($resultado_curso) > 0) {
        $curso = mysqli_fetch_assoc($resultado_curso)['curso'];

        // Comprobamos si ya existe un profesor asignado al mismo grupo, asignatura y curso
        $sql_comprobarAsignacion = "SELECT * 
                                    FROM `usuarios-asignaturas` uas
                                    JOIN `asignaturas` a ON uas.idAsignatura = a.idAsignatura
                                    WHERE uas.idAsignatura = '$idAsignatura' 
                                    AND uas.grupo = '$grupo' 
                                    AND a.curso = '$curso'";

        $resultado_check = mysqli_query($con, $sql_comprobarAsignacion);

        if (mysqli_num_rows($resultado_check) == 0) {
            // Insertamos la asignación
            $sql = "INSERT INTO `usuarios-asignaturas` (idUsuario, idAsignatura, numAlumnos, grupo) 
                    VALUES ('$idUsuario', '$idAsignatura', '$numAlumnos', '$grupo')";
            if (mysqli_query($con, $sql)) {
                header("Location: ../gestion_profesorado.php");
                exit();
            } else {
                header("Location: ../gestion_profesorado.php?errorA=Error al asignar la asignatura al profesor");
                exit();
            }
        } else {
            header("Location: ../gestion_profesorado.php?errorA=Ya existe un profesor asignado a este grupo en la asignatura y curso seleccionados");
            exit();
        }
    } else {
        header("Location: ../gestion_profesorado.php?errorA=No se pudo obtener el curso de la asignatura seleccionada");
        exit();
    }
} else {
?>

    <form action="./validaciones/asignarAsignaturaAprofesor.php" method="POST" class="formularioSecundario" onsubmit="return confirmarAsignacionAsignatura();">
        <h2>Añadir asignatura</h2>
        <select name="idUsuario" id="idUsuario" required>
            <option value="">Selecciona un usuario</option>
            <?php
            $sql = "SELECT * FROM usuarios";
            $resultado = mysqli_query($con, $sql);
            while ($fila = mysqli_fetch_assoc($resultado)) {
                echo "<option value='" . $fila['idUsuario'] . "'>" . $fila['nombreUsuario'] . " " . $fila['apellido1'] . "</option>";
            }
            ?>
        </select>
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
        <input type="number" name="numAlumnos" id="numAlumnos" placeholder="Número de alumnos" required>
        <input type="text" name="grupo" id="grupo" placeholder="Grupo" pattern="[A-Za-z]" title="Debe ser una sola letra" maxlength="1">
        <button type="submit" class="botones">Añadir asignatura</button>
    </form>

<?php
    // Mostrar mensaje de error si existe en la URL
    if (isset($_GET['errorA'])) {
        echo "<p style='color: red; text-align: center;'>" . htmlspecialchars($_GET['errorA']) . "</p>";
    }
}
?>
<script>
    function confirmarAsignacionAsignatura() {
        return alert("Se ha asignado asignatura con exito");
    }
</script>