                               
<?php

/* 
 * Este archivo es parte de gym.dip.mx
 * Propiedad de Developers Intelligent Programs  * 
 */
   // $ubicacion="http://localhost/itsjc/index.php?op=perfil";    
        $consulta = "SELECT hor_id, hor_ini, hor_fin, hor_dia, act_nombre, usu_nombre from horario join actividad on hor_act_id = act_id join usuario on usu_id = hor_usu_id where act_id = hor_act_id AND hor_usu_id = usu_id AND hor_gim_id = $gimid order by hor_ini, hor_dia "; 
        //$rec = @mysql_query($sql) or die('Mi error es: '.mysql_error());  
  
 // if ($resultado = $cxn->query($consulta)) {
 //   $fila=$resultado->fetch_object();

//}

    if ($resultado = $cxn->query($consulta)){
        while( $fila=$resultado->fetch_object()) 
        { 
           
            $horid = $fila -> hor_id;
            $horini=$fila -> hor_ini;
            $horfin = $fila -> hor_fin;
            $hordia= $fila -> hor_dia;
            $clasnombre = $fila -> act_nombre;
            $usunombre= $fila -> usu_nombre;
 
            //echo "            <tr bgcolor=#f4f4f4><td> $horini </td><td>$clasnombre</td> <td width='25px'> <img src='$ubicacion/img/iconos/atributos.png'> </td> <td width='25px'><a href='?op=mclase&uid=$horid'><img src='$ubicacion/img/iconos/editar.png'></a> </td> <td width='25px'> <a href='?op=eliclas&eid=$horid'><img src='$ubicacion/img/iconos/eliminar.png' alt='eliminar' /></a> </td></tr>            ";
   
            
         $ini=substr($horini, 0,2);   
             if($ini<10){
             $ini=substr($horini, 1,1);
            }
             $horario[$ini][$hordia][0]=$clasnombre;
             $horario[$ini][$hordia][1]=$usunombre;

            }    
        }
    
    
        //echo"</table><br /><br />";
 //var_dump($horario);
?>



<table class="table table-striped table-sm">
<thead>
<tr>
<th>Hora</th>
<th>Lun</th>
<th>Mar</th>
<th>Mie</th>
<th>Jue</th>
<th>Vie</th>
<th></th>
<th></th>
</tr>
</thead>
<tfoot>
<tr>
<th>Hora</th>
<th>Lun</th>
<th>Mar</th>
<th>Mie</th>
<th>Jue</th>
<th>Vie</th>
<th></th>
<th></th>
</tr>
</tfoot>
<tbody>


<?php
for($hora=0;$hora<24;$hora++){
    if(isset($horario[$hora])){

    echo "<tr><td>$hora:00</td>";
            for($dia=1;$dia<8;$dia++){
                
                if(isset($horario[$hora][$dia])){
                      $laclase=$horario[$hora][$dia][0];
                      $elinstructor=$horario[$hora][$dia][1];
                    echo "<td class='small'>$laclase<br /><i>$elinstructor</i></td>";
                  
                }else{echo "<td></td>";}
            }
            echo "</tr>";
        }     

}
?>      
</tbody>  
</table>

