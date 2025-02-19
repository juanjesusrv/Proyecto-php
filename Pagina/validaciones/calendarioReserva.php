<?php
    function tramosLibres(){
        return "calenReDiaLleno";
    }
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
    if(strtotime($year."-".$mes."-01")!=1){
        $calendario.="<tr>";
        for($i=1;$i<date("w",strtotime($year."-".$mes."-01"));$i++){
            $calendario.="<td></td>";
        } 
    }

    for ($i=1;$i<=3;$i++){
        if($i<10){
            $dia="0".$i;
        }else{
            $dia=$i;
        }
        
        $diaSemana=date("w",strtotime($year."-".$mes."-".$i));
        if($diaSemana==1){
            $calendario.="<tr>";
        }
            if($diaSemana>0&&$diaSemana<6){
                switch(tramosLibres($year."-".$mes."-".$i)){
                    case "todos":
                        $calendario.='<button type="submit" name="fecha" value="'.($year."-".$mes."-".$i).'" >'.$i.'<td class="calenReDiaVacio">$i</td></button>';
                        break;
                    case "algunos":
                        $calendario.='<button type="submit" name="fecha" value="'.($year."-".$mes."-".$i).'" >'.$i.'<td class="calenReDiaMedio">$i</td></button>';
                        break;
                    case"ninguno":
                        $calendario.='<td class="calenReDiaLleno">$i</td>';
                        break;
                }
            }
        if($diaSemana==7){
            $calendario.="</tr>";
        }
    }
    
    $calendario.="</tr>";
    
    for($i=1;$i<date("w",strtotime($year."-".$mes."-".strtotime('last day of this month', strtotime($year."-".$mes."-01"))));$i++){
        $calendario.="<td></td>";
    } 
    $calendario.="</tr>";
?>
$tramo["idTramo"]." - ".$tramo["hora"]
<button type="submit" name="fecha" value="" ></button>