<!DOCTYPE html>
<html lang="en">
<?php session_start();

require_once "./validaciones/conexion.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de profesorado</title>
    <link rel="stylesheet" href="Estilos/styles.css">
</head>

<body>
    <?php require_once "./plantillas/header.php" ?>
    <main>
    <div class="reservas">
            <div class="contenedorEstandar">
            <?php require_once "./validaciones/crearProfesores.php" ?> 
            </div>
            <div class="contenedorEstandar">
                <?php require_once "validaciones/asignarAsignaturaAprofesor.php" ?> 
            </div>
        </div>
        <div class="listaReservas">
            <?php require_once "validaciones/eliminarProfesores.php" ?>
        </div>
    </main>
    <?php require_once "./plantillas/footer.php" ?>
</body>

</html>