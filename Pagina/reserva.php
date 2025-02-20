<!DOCTYPE html>
<html lang="es">
<?php session_start(); 

require_once "./validaciones/conexion.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilos/styles.css">
    <link rel="stylesheet" href="Estilos/jj.css">
    <link rel="stylesheet" href="Estilos/dani.css">
    <link rel="stylesheet" href="Estilos/pablo.css">
    <link rel="stylesheet" href="Estilos/rafa.css">
    <link rel="stylesheet" href="Estilos/ruben.css">
    <title>Reservas</title>
</head>

<body>
    <?php require_once "./plantillas/header.php" ?>
    <main>
        <div class="reservas">
            <div class="contenedorEstandar">
            <?php require_once "./validaciones/calendarioReserva.php" ?> 
            </div>
            <div class="contenedorEstandar">
                <?php require_once "reservas_tramos.php" ?> 
            </div>
        </div>
        <div class="listaReservas">
             <?php require_once "validaciones/listaReserva.php" ?>
        </div>
    </main>
    <?php require_once "./plantillas/footer.php" ?>
</body>

</html>