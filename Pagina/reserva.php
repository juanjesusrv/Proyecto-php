<!DOCTYPE html>
<html lang="es">
<?php session_start(); 

require_once "./validaciones/conexion.php";

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Estilos/styles.css">
    <title>Reservas</title>
</head>

<body>
    <?php require_once "./plantillas/header.php" ?>
    <main>
        <div class="reservas">
            <div class="contenedorEstandar">Calendario</div>
            <div class="contenedorEstandar">
                <form action="" method="post">
                    <p>Haz tu Reserva</p>
                    <br>
                    <p>Selecciona el tramo</p>
                    <!-- los asteriscos son para modificar con php -->
                    <input id="*" name="*" type="checkbox">
                    <!-- el #hora es para modificar con el php -->
                    <label for="">*</label>
                    <br>
                </form>
            </div>
        </div>
        <div class="listaReservas">
             <?php require_once "validaciones/listaReserva.php" ?>
        </div>
    </main>
    <?php require_once "./plantillas/footer.php" ?>
</body>

</html>