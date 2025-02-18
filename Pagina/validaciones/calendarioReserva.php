<?php
    $diaActual="";
    if ($_SERVER["REQUEST_METHOD"] == "POST"&&(isset($_POST["mesBuscar"])||isset($_POST["yearBuscar"]))) {
        if ($_POST["mesBuscar"]==date('m')&&$_POST["yearBuscar"]==date('Y')){
            $diaActual=date('d');
        }
        $mes=$_POST["mesBuscar"];
        $year=$_POST["yearBuscar"];
    }else{
        $diaActual=date('d');
        $mes=date('m');
        $year=date('Y');
    }
    $calendario="<table><tr>Lunes</th><th>Martes</th><th>Miercoles</th><th>Jueves</th><th>Viernes</th><th>Sabado</th><th>Domingo</th></tr>";
    $calendario.="<tr>";
    for($i=1;$i<date("w",strtotime($year."-".$mes."-01"));$i++){
        $calendario.="<td></td>";
    } 
    $calendario.="</tr>";
    
?>