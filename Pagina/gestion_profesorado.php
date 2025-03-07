<?php
session_start();
require_once "./validaciones/conexion.php";

// Verificar sesión y rol
if (!isset($_SESSION['roles']) || !in_array(2, $_SESSION['roles'])) {
    header('Location: ./reserva.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de profesorado</title>
    <link rel="stylesheet" href="Estilos/styles.css">
    <style>

        .menu ul {
            list-style: none;
            padding: 0;
            display: flex;
            gap: 10px;
            background-color: #f4f4f4;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            margin-top: 0;
            border-top: 1px solid black;
        }

        .menu ul li a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .menu ul li a:hover {
            background-color: #ddd;
        }

        .contenido-seccion {
            display: none;
        }

        .contenido-seccion.activo {
            display: block;
            background-color: white;
            padding: 20px;
            border-bottom: 1px solid #ccc;
            border-radius: 8px;
        }
        .menu ul li a.activo {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <?php require_once "./plantillas/header.php"; ?>

    <!-- Menú de navegación -->
    <nav class="menu">
        <ul>
            <li><a href="#" data-seccion="crearProfesor">Crear Profesor</a></li>
            <li><a href="#" data-seccion="eliminarProfesor">Eliminar Profesor</a></li>
            <li><a href="#" data-seccion="asignarAsignatura">Asignar Asignatura</a></li>
            <li><a href="#" data-seccion="cambiarVice">Cambiar Vicedirector</a></li>
            <li><a href="#" data-seccion="listaAsignaturas">Lista de Asignaturas Asignadas</a></li>
        </ul>
    </nav>

    <main>
        <!-- Secciones de contenido -->
        <div id="crearProfesor" class="contenido-seccion">
            <?php require_once "./validaciones/crearProfesores.php"; ?>
        </div>

        <div id="eliminarProfesor" class="contenido-seccion">
            <?php require_once "./validaciones/eliminarProfesores.php"; ?>
        </div>

        <div id="asignarAsignatura" class="contenido-seccion">
            <?php require_once "./validaciones/asignarAsignaturaAprofesor.php"; ?>
        </div>

        <div id="cambiarVice" class="contenido-seccion">
            <?php require_once "./validaciones/cambiarVice.php"; ?>
        </div>

        <div id="listaAsignaturas" class="contenido-seccion">
            <?php require_once "./validaciones/listaAsignaturas.php"; ?>
        </div>
    </main>

    <?php require_once "./plantillas/footer.php"; ?>

    <script>
        // JavaScript para manejar la visualización de las secciones
        document.addEventListener('DOMContentLoaded', function () {
            const enlaces = document.querySelectorAll('.menu a');
            const secciones = document.querySelectorAll('.contenido-seccion');

            // Mostrar la primera sección por defecto
            secciones[0].classList.add('activo');
            enlaces[0].classList.add('activo');

            // Manejar clics en los enlaces del menú
            enlaces.forEach(enlace => {
                enlace.addEventListener('click', function (e) {
                    e.preventDefault(); // Evitar que el enlace recargue la página

                    // Ocultar todas las secciones
                    secciones.forEach(seccion => {
                        seccion.classList.remove('activo');
                    });

                    // Remover clase activa de todos los enlaces
                    enlaces.forEach(enlace => {
                        enlace.classList.remove('activo');
                    });

                    // Mostrar la sección correspondiente
                    const seccionId = this.getAttribute('data-seccion');
                    document.getElementById(seccionId).classList.add('activo');

                    // Añadir clase activa al enlace clicado
                    this.classList.add('activo');
                });
            });
        });
    </script>
</body>
</html>