<?php

//Limito la busqueda
$TAMANO_PAGINA = 7;
$url="index.php?op=socios";
//examino la página a mostrar y el inicio del registro a mostrar

if(isset($_GET['pagina'])){
$pagina = $_GET['pagina'];

$inicio = ($pagina - 1) * $TAMANO_PAGINA;

}else{
   $inicio = 0;
   $pagina = 1;	
}    

//calculo el total de páginas

$query = "SELECT COUNT(*) FROM usuario WHERE usu_gim_id = $gimid AND usu_rol_id = 1;";  
$result = $cxn->query($query); 
$count = $result->fetch_array(); 
$num_total_registros= $count[0];  


$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);


if(isset($_GET['b'])){$b=$_GET['b'];}else{$b="";}

if($b==""){
 //$consulta = "SELECT usu_id, usu_num_socio, usu_nombre, usu_ape_pat, usu_ape_mat FROM usuario where usu_gim_id = $gimid AND usu_rol_id = 1 LIMIT $inicio,$TAMANO_PAGINA;"; 
 		$notifi="";
    }else{
    	$notifi="<div class='alert alert-warning' role='alert'>
Resultados para busqueda: <strong>$b</strong> <i class='small'><a href='?op=socios'>Limpiar Filtro</a></i></div> ";
//$consulta = "SELECT usu_id, usu_num_socio, usu_nombre, usu_ape_pat, usu_ape_mat FROM usuario where usu_gim_id = $gimid AND usu_rol_id = 1 AND (usu_num_socio LIKE '%$b%' OR usu_nombre LIKE '%$b%' OR usu_ape_pat LIKE '%$b%' OR usu_ape_mat LIKE '%$b%') ";     	
    }

?>
<div class="row">
  <div class="col-md-12">
<div class="card">
  <div class="card-header"><i class="icon-users"></i> <strong>Socios</strong> </div>
  <div class="card-block">

<div class="row">
 <div class="col-sm-12 col-md-4 " ><a class="btn btn-secondary" href="?op=nsocio" > <i class="icon-add-user"></i> Nuevo Socio </a>
 </div>

<div class="col-sm-12 col-md-8 text-right">
  <form action="#" method="GET" class="form-inline form-horizontal" style="margin:0 auto">
<div class="input-group text-right">
	<input type="hidden"  name="op"  value="socios">
    <input type="text" class="form-control mt-1 mr-1 mt-md-0" name="b" size="30">
    <input type="submit" class="btn btn-secondary mt-1 mr-1 mt-md-0" value="Buscar"> 
</div>
  </form>
  </div>
</div>
<br />
<?php echo $notifi; ?>
<table class="table table-hover">
<thead>
<tr>
<th>No.</th>
<th>Nombre</th>
<th>Edo</th>
<th class="text-right"> <i class="icon-print"></i> </th>
</tr>
</thead>
<tfoot>
<tr>
<th>No.</th>
<th>Nombre</th>
<th>Edo</th>
<th> </th>
</tr>
</tfoot>
<tbody>
<?php
if($b==""){
 $consulta = "SELECT usu_id, usu_num_socio, usu_nombre, usu_apellidos FROM usuario where usu_gim_id = $gimid AND usu_rol_id = 1 order by usu_num_socio LIMIT $inicio,$TAMANO_PAGINA;"; 
    }else{
    	$notifi="Busqueda: $b Limpiar ";
$consulta = "SELECT usu_id, usu_num_socio, usu_nombre, usu_apellidos FROM usuario where usu_gim_id = $gimid AND usu_rol_id = 1 AND (usu_num_socio LIKE '%$b%' OR usu_nombre LIKE '%$b%' OR usu_apellidos LIKE '%$b%') ";     	
    }
    if ($resultado = $cxn->query($consulta)){
        while( $fila=$resultado->fetch_object()) 
        { 
            $usuid = $fila -> usu_id;
            $usunumsocio = $fila -> usu_num_socio;
            $usunombre= $fila -> usu_nombre;
            $usuapellidos= $fila -> usu_apellidos;

            echo "<tr>
			<td>$usunumsocio</td>
			<td>$usunombre $usuapellidos</td>
			<td><font color='#339933'><i class='icon-check'></i></font> </td>
			<td><div id='acciones' class='btn-group btn-group-sm mt-1 mb-1' role='group' aria-label='First group'>
			    <a href='?op=perfil' class='btn btn-secondary small'><i class='icon-list'></i></a>
			   <a href='?op=inbox' class='btn btn-secondary'><i class='icon-pencil'></i></a>
			<a href='?op=borsoc' class='btn btn-secondary'><font color='#ff0000'><i class='icon-cross'></i></font></a>
			  </div> </td>
			</tr>";

 		}
}
?>
</tbody>
</table>


<?php 

//paginacion
echo "<nav aria-label='Paginacion'><ul class='pagination pagination-sm'>";
if ($total_paginas > 0 AND $total_paginas <=12) {
   if ($pagina != 1){
      echo '<li class="page-item">
      <a class="page-link" href="'.$url.'&pagina='.($pagina-1).'" aria-label="Anterior">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Anterior</span>
      </a>
  </li>';
   }
      for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            //si muestro el índice de la página actual, no coloco enlace
            echo '<li class="page-item  active"><a class="page-link" href="#">'.$pagina.'</a></li>';
         else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
      }
      if ($pagina != $total_paginas)
         echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.($pagina+1).'"><span aria-hidden="true">&raquo;</span><span class="sr-only">Siguiente</span></a></li>';
      }


$puntitos=1;
if ($total_paginas > 12) {
    
   if ($pagina != 1){
     echo '<li class="page-item">
      <a class="page-link" href="'.$url.'&pagina='.($pagina-1).'" aria-label="Anterior">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Anterior</span>
      </a>
  </li>';
   }
      for ($i=1;$i<=$total_paginas;$i++){
         if ($pagina == $i){
            //si muestro el índice de la página actual, no coloco enlace
            echo '<li class="page-item  active"><a class="page-link" href="#">'.$pagina.'</a></li>';
          }else{
              if($i<4 AND $i<=$pagina-3){
                 echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
                  if($i==3 AND $pagina != 6){
				echo '<li class="page-item"><a class="page-link" href="#">...</a></li>';
                  }
              }
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
              if($i!=$pagina AND $i>=$pagina-2 AND $i<=$pagina+2){
              echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
              
              }
              if($pagina<$total_paginas-5 AND $i==$total_paginas-3){echo '<li class="page-item"><a class="page-link" href="#">...</a></li>';}
              if($i>$pagina+2 AND $i>$total_paginas-3){
                    
           echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.$i.'">'.$i.'</a></li>';
              }
              
              
         }
      }
      if ($pagina != $total_paginas){
          
         echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.($pagina+1).'"><span aria-hidden="true">&raquo;</span><span class="sr-only">Siguiente</span></a></li>';
        }
   
}
echo "</div>";// Termina paginacion < 123 >

?>


<nav aria-label='Paginacion'>
  <ul class='pagination'>
  
  <li class='page-item'>
      <a class='page-link' href='#' aria-label='Anterior'>
        <span aria-hidden='true'>&laquo;</span>
        <span class='sr-only'>Anterior</span>
      </a>
  </li>

    <li class='page-item'><a class='page-link' href='#'>1</a></li>
    <li class='page-item'><a class='page-link' href='#'>...</a></li>
    <li class='page-item'><a class='page-link' href='#'>3</a></li>
    
    <li class='page-item'>
      <a class='page-link' href='#' aria-label='Siguiente'>
        <span aria-hidden='true'>&raquo;</span>
        <span class='sr-only'>Siguiente</span>
      </a>
    </li>

  </ul>
</nav>

</div></div></div></div>