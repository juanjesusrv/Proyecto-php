<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Reservas</title>
</head>

<body>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            if(isset($_POST["fecha"])){
                $fecha = $_POST["fecha"];
                $sql = "";
                $result = mysqli_query($conn, $sql);
                if($result){
                    echo "<script>alert('Reserva realizada con éxito')</script>";
                }else{
                    echo "<script>alert('Error al realizar la reserva')</script>";
                }
            }
        }
    ?>
    <?php require_once "header.php" ?>
    <main>
        <div class="reservas">
            <div class="contenedorEstandar">Calendario</div>
            <div class="contenedorEstandar">
                <form action="" method="post">
                    <p>Haz tu Reserva</p>
                    <br>
                    <p>Selecciona el tramo</p>
                    //los asteriscos son para modificar con php
                    <input id="<?php echo $idtramo ?>" name="<?php echo $idtramo ?>" type="checkbox">
                    //el #hora es para modificar con el php
                    <label for=""><?php echo $hora ?></label>
                    <br>
                </form>
            </div>
        </div>
        <div class="listaReservas">
             <?php require_once "validaciones/listaReserva.php" ?>
        </div>
    </main>
    <?php require_once "footer.php" ?>
</body>

</html>