<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"&&(isset($_POST["mesBuscar"])||isset($_POST["yearBuscar"]))) {
        $diaSemana=date('L');
        if ($_POST["mesBuscar"]==date('m')&&$_POST["yearBuscar"]==date('Y')){
            $diaActual=date('d');
            $mes=date('m');
            $year=date('Y');
        }
        $mes=$_POST["mesBuscar"];
        $year=$_POST["yearBuscar"];
    }else{
        $diaActual=date('d');
        $mes=date('m');
        $year=date('Y');
    }
?>