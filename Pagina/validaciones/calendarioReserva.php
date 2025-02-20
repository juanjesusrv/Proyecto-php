<p>Selecciona una asignatura</p>
<form action="reserva.php" method="post">
    <select name="idAsignatura" id="idAsignatura">
        <?php
            $sql="SELECT * from `usuarios-asignaturas` ua
                    join asignaturas a on ua.idAsignatura=a.idAsignatura
                    where ua.idUsuario='".$_SESSION['idUsuario']."'";
            $resultado=mysqli_query($con, $sql);
            while ($asignatura=mysqli_fetch_assoc($resultado)){
                echo '<option value="'.$asignatura["idAsignatura"].'" ';
                if (isset($_POST["idAsignatura"])&&$_POST["idAsignatura"]==$asignatura["idAsignatura"]){
                    echo 'selected';
                }
                echo'>'.$asignatura["nombreAsignatura"].' - '.$asignatura["curso"].' - '.$asignatura["grupo"].'</option>';
            }
        ?>
    </select>
    <button class="botonesCalendario" type="submit">Seleccionar</button>
</form>
<?php
    if(($_SERVER["REQUEST_METHOD"] == "POST") && isset($_POST["idAsignatura"])){
        $numeroAlumnos=numeroAlumnos($_POST["idAsignatura"],$con);
        $arrayTramos=listaTramos($con);
        $diaActual="";
        if (isset($_POST["mesBuscar"])||isset($_POST["yearBuscar"])) {
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
        ?>
        <P>Selecciona una fecha</P>
        <form action="reserva.php" method="post">
            <input type="hidden" name="idAsignatura" value="<?php echo $_POST["idAsignatura"] ?>">
            <select name="mesBuscar" id="mesBuscar">
            <?php 
                $arrayMeses=['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
                for($i=0;$i<12;$i++){
                    if($i<10){$numeroMes="0".($i+1);}
                    else{$numeroMes=($i+1);}
                    echo '<option value="'.$numeroMes.'" ';
                    if($numeroMes==$mes){echo 'selected';}
                    echo'>'.$arrayMeses[$i].'</option>';
                }
            ?>
            </select>
            <select name="yearBuscar" id="yearBuscar">
            <?php
                if(date('m')<8){echo '<option value="'.(date('Y')-1).'">'.(date('Y')-1).'</option>';}
                echo '<option value="'.(date('Y')).'" selected>'.(date('Y')).'</option>';
                if(date('m')>=8){echo '<option value="'.(date('Y')+1).'">'.(date('Y')+1).'</option>';}
            ?>
            </select>
            <button class="botonesCalendario" type="submit">Seleccionar</button>
        </form><br>
        <?php
        $ultimoDiaMes=date("t", strtotime($year."-".$mes."-01"));
        $calendario="<table class='tablaCalendario'><tr><th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th><th>Vie</th><th>Sab</th><th>Dom</th></tr>";
        if(strtotime($year."-".$mes."-01")!=1){
            $calendario.="<tr>";
            if(date("w",strtotime($year."-".$mes."-01"))==0){
                for($i=1;$i<=6;$i++){
                    $calendario.="<td></td>";
                } 
            }else{
                for($i=1;$i<date("w",strtotime($year."-".$mes."-01"));$i++){
                    $calendario.="<td></td>";
                } 
            }
        }

        for ($i=1;$i<=$ultimoDiaMes;$i++){
            if($i<10){ $dia="0".$i; }
            else{ $dia=$i; }
            
            $diaSemana=date("w",strtotime($year."-".$mes."-".$dia));
            if($diaSemana==1){ $calendario.="<tr>"; }
                if($diaSemana>0&&$diaSemana<6){
                    if(date($year.'-'.$mes.'-'.$dia<date('Y-m-d'))){
                        $calendario.='<td class="calenReDiaNoSeleccionable">'.$i.'</td>';
                    }else{
                        switch(tramosLibres($year."-".$mes."-".$dia,$_POST["idAsignatura"],$numeroAlumnos,$arrayTramos,$con)){
                        case "todos":
                            $calendario.='<td class="calenReDiaVacio"><button type="submit" name="fecha" value="'.($year."-".$mes."-".$dia).'" >'.$i.'</button></td>';
                            break;
                        case "algunos":
                            $calendario.='<td class="calenReDiaMedio"><button type="submit" name="fecha" value="'.($year."-".$mes."-".$dia).'" >'.$i.'</button></td>';
                            break;
                        case"ninguno":
                            $calendario.='<td class="calenReDiaLleno">'.$i.'</td>';
                            break;
                        }
                    }
                    
                }else{
                    $calendario.='<td class="calenReDiaNoSeleccionable">'.$i.'</td>';
                }
            if($diaSemana==7){ $calendario.="</tr>"; }
        }
        if(date("w",strtotime($year."-".$mes."-".$ultimoDiaMes))!=0){
            for($i=7;$i>date("w",strtotime($year."-".$mes."-".$ultimoDiaMes));$i--){
                $calendario.="<td></td>";
            }
        }

        $calendario.="</tr></table>";
        echo '<form action="reserva.php" method="post">
        <input type="hidden" name="numAlumnos" value="'.$numeroAlumnos.'">
        <input type="hidden" name="idAsignatura" value="'.$_POST["idAsignatura"].'">
        <input type="hidden" name="mesBuscar" value="'.$mes.'">
        <input type="hidden" name="yearBuscar" value="'.$year.'">';
        echo $calendario;
        echo '</form>';
    }


    function numeroAlumnos($idAsignatura,$con) {
        $sql='SELECT * FROM `usuarios-asignaturas` WHERE idUsuario="'.$_SESSION['idUsuario'].'" and idAsignatura="'.$idAsignatura.'"';
        $resultado=mysqli_query($con, $sql);
        $curso=mysqli_fetch_assoc($resultado);
        return $curso["numAlumnos"];
    }

    function listaTramos($con){
        $sql='SELECT idTramo FROM tramos ';
        $resultado=mysqli_query($con, $sql);
        $resul=[];
        while($curso=mysqli_fetch_assoc($resultado)){
            $resul[$curso["idTramo"]]=0;
        }
        return $resul;
    }

    function tramosLibres($fecha,$idAsig,$numAlum,$aTramos,$con){
        $tramosLLenos=0;
        
        $sql = "SELECT * FROM reservas WHERE fecha = '$fecha'"; //sacamos todas las reservas de la fecha seleccionada
        $result = mysqli_query($con, $sql);
        while ($fila = mysqli_fetch_assoc($result)) {

            $sql3 = "SELECT * FROM `usuarios-asignaturas` WHERE idAsignatura = '".$fila["idAsignatura"]."' AND idUsuario = '".$fila["idUsuario"]."'";  //sacamos el numero de alumnos de la asignatura
            $numAlumnos = 0;
            $result3 = mysqli_query($con, $sql3);
            foreach ($result3 as $fila3) {
                $numAlumnos = $fila3["numAlumnos"]; //guardamos el numero de alumnos
            }

            $sql2 = "SELECT * FROM `reservas-tramo` WHERE idReserva = '".$fila["idReserva"]."'"; //sacamos los tramos de la reserva
            $result2 = mysqli_query($con, $sql2);
            while ($fila2 = mysqli_fetch_assoc($result2)) {
                if($_SESSION["idUsuario"]==$fila["idUsuario"]){
                    $aTramos[$fila2["idTramo"]] = 101;
                }else{
                    $aTramos[$fila2["idTramo"]] += $numAlumnos;
                }
            }
        }

        foreach($aTramos as $ocupado){
            if(($ocupado+$numAlum)>100){
                $tramosLLenos++;
            }
        }

        if($tramosLLenos>=count($aTramos)){
            return "ninguno";
        }else if($tramosLLenos>0){
            return "algunos";
        }else{
            return "todos";
        }
    }
?>