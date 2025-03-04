<?php
$array_tramos_reservaUsuario = array(); //para guardar los tramos que tiene reservados el usuario

if (($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["fecha"])) {
    $fecha = $_POST["fecha"];
    $asignaturaSeleccionada = $_POST["idAsignatura"];
    $alumnosAsignatura = $_POST["numeroAlumnos"];
    $array_tramos = array(); //para guardar los tramos que tienen alumnos

    $sql = "SELECT * FROM reservas WHERE fecha = '$fecha'"; //sacamos todas las reservas de la fecha seleccionada
    $result = mysqli_query($con, $sql);
    while ($fila = mysqli_fetch_assoc($result)) {
        $idReserva = $fila["idReserva"];
        $idUsuario = $fila["idUsuario"];
        $numAlumnos = $fila["alumnosReserva"];

        $sql2 = "SELECT * FROM `reservas-tramo` WHERE idReserva = '$idReserva'"; //sacamos los tramos de la reserva
        $result2 = mysqli_query($con, $sql2);
        while ($fila2 = mysqli_fetch_assoc($result2)) {
            $idTramo = $fila2["idTramo"];
            //si el tramo no esta en el array, lo añadimos
            if (!isset($array_tramos[$idTramo])) {
                $array_tramos[$idTramo] = $numAlumnos;
            } else {
                $array_tramos[$idTramo] += $numAlumnos;
            }
            //si el idUsuario es el mismo que el de la sesion, guardamos el idTramo
            if ($idUsuario == $_SESSION["idUsuario"]) {
                $array_tramos_reservaUsuario[] = $idTramo;
            }
        }
    }
}
if (isset($fecha)) {
?>
<div id="reservaTramos" class="contenedorEstandar">
    <form action="./validaciones/crearReservas.php" method="post" onsubmit="return enviarCorreo();">
        <h2><?php if (isset($_POST["fecha"])) {
                echo $_POST["fecha"];
            } ?></h2>

        <br>
        <?php
       
            echo '<h3><label for="tramo">Selecciona uno o varios tramos:</label></h3>';
            $sql5 = "SELECT * FROM tramos";
            $result5 = mysqli_query($con, $sql5);
            while ($tramo = mysqli_fetch_assoc($result5)) {
                if (!in_array($tramo["idTramo"], $array_tramos_reservaUsuario)) {
                    if ((isset($array_tramos[$tramo["idTramo"]]) && ($array_tramos[$tramo["idTramo"]] + $alumnosAsignatura) <= 100) || !isset($array_tramos[$tramo["idTramo"]])) { ?>
                        <input type="checkbox" class="tramo-checkbox" name="tramos[]" value="<?php echo $tramo["idTramo"] ?>">
                        <label><?php echo $tramo["idTramo"] . ": " . $tramo["hora"] ?></label><br>
            <?php }
                }
            }
            ?>
            <br>
            <br>
            <button class="botones" type="submit" id="enviarBtn" disabled>Enviar</button>
            <input type="hidden" name="idAsignatura" value="<?php echo $asignaturaSeleccionada ?>">
            <input type="hidden" name="fecha" value="<?php echo $fecha ?>">
            <input type="hidden" name="numAlumnos" value="<?php echo $alumnosAsignatura ?>">
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkboxes = document.querySelectorAll(".tramo-checkbox");
            const enviarBtn = document.getElementById("enviarBtn");

            function validarCheckboxes() {
                const algunoMarcado = [...checkboxes].some(checkbox => checkbox.checked);
                enviarBtn.disabled = !algunoMarcado;
            }

            checkboxes.forEach(checkbox => {
                checkbox.addEventListener("change", validarCheckboxes);
            });

            validarCheckboxes();
        });

        function enviarCorreo() {
            return alert("Se ha enviado un correo electronico confirmando la reserva");
        }
    </script>
</div>
<?php } ?>