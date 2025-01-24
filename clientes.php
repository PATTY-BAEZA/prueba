<?php
include "funciones/codifica.php";
//Limito la busqueda
$TAMANO_PAGINA = 10;
$url="index.php?op=clientes";
//examino la página a mostrar y el inicio del registro a mostrar

//CICLO IF
if(isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
$inicio = ($pagina - 1) * $TAMANO_PAGINA;

}else{
   $inicio = 0;
   $pagina = 1;	
}    

//CICLO IF


if(isset($_GET['b'])){$b=$_GET['b'];}else{$b="";}

if($b==""){
		$query = "SELECT COUNT(*) FROM usuario WHERE usu_cen_id = $cenid AND usu_rol_id = 1;";  
		$result = $cxn->query($query); 
		$count = $result->fetch_array(); 
		$num_total_registros= $count[0];  
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

 		$notifi="";
 		$consulta = "SELECT usu_id, usu_num_cliente, usu_nombre, usu_apellidos FROM usuario where usu_cen_id = $cenid AND usu_rol_id = 1 order by usu_num_cliente LIMIT $inicio,$TAMANO_PAGINA;"; 
    }else{
		$query = "SELECT COUNT(*) FROM usuario where usu_cen_id = $cenid AND usu_rol_id = 1 AND (usu_num_cliente LIKE '%$b%' OR usu_nombre LIKE '%$b%' OR usu_apellidos LIKE '%$b%')"; 
		$result = $cxn->query($query); 
		$count = $result->fetch_array(); 
		$num_total_registros= $count[0];  
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

    	$notifi="<div class='alert alert-warning' role='alert'>
		$num_total_registros Resultados para busqueda: <strong>$b</strong> <i class='small'><a href='?op=clientes'>Limpiar Filtro</a></i></div> ";
    	$consulta = "SELECT usu_id, usu_num_cliente, usu_nombre, usu_apellidos FROM usuario where usu_cen_id = $cenid AND usu_rol_id = 1 AND (usu_num_cliente LIKE '%$b%' OR usu_nombre LIKE '%$b%' OR usu_apellidos LIKE '%$b%') order by usu_num_cliente LIMIT $inicio,$TAMANO_PAGINA;"; 
	}
?>
<div class="row">
  <div class="col-md-12">
<div class="card">
  <div class="card-header"><i class="icon-users"></i> <strong>Clientes</strong> </div>
  <div class="card-block">

<div class="row">
 <div class="col-sm-12 col-md-4 " ><a class="btn btn-secondary" href="?op=ncliente" > <i class="icon-user-plus"></i> Nuevo Cliente </a>
 </div>

<div class="col-sm-12 col-md-8 text-right">
  <form action="#" method="GET" class="form-inline form-horizontal" style="margin:0 auto">
<div class="input-group text-right">
	<input type="hidden"  name="op"  value="clientes">
    <input type="text" class="form-control mt-1 mr-1 mt-md-0" name="b" size="30">
    <input type="submit" class="btn btn-secondary mt-1 mr-1 mt-md-0" value="Buscar"> 
</div>
  </form>
  </div>
</div>
<br />
<?php echo $notifi; ?>
<table class="table table-hover table-sm">
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

    if ($resultado = $cxn->query($consulta)){
        while( $fila=$resultado->fetch_object()) 
        { 
            $usuid = $fila -> usu_id;
            $usuidc=mic_encode($usuid);
            $usunumcliente = $fila -> usu_num_cliente;
            $usunombre= $fila -> usu_nombre;
            $usuapellidos= $fila -> usu_apellidos;

            echo "<tr>
			<td>$usunumcliente</td>
			<td>$usunombre $usuapellidos</td>
			<td><font color='#339933'><i class='icon-check'></i></font> </td>
			<td><div id='acciones' class='btn-group btn-group-sm mt-1 mb-1' role='group' aria-label='First group'>
			    <a href='?op=perfil&s=$usuidc' class='btn btn-secondary small'><i class='icon-list'></i></a>
			  </div> </td>
			</tr>";

 		}
}
?>
</tbody>
</table>


<?php 


if($total_paginas<=9){
	$inicio=1;
	$final=$total_paginas;
}else{
	$inicio=$pagina-4;
	$final=$pagina+4;
	
	
	while($inicio <= 0){
	$inicio++;
	$final++;
	}

	while($final > $total_paginas){
	$inicio--;
	$final--;
	}

}

//paginacion
echo "<nav aria-label='Paginacion'><ul class='pagination pagination-sm justify-content-center'>";

   if ($pagina != 1){
      echo '<li class="page-item">
      <a class="page-link" href="'.$url.'&pagina='.($pagina-1).'&b='.$b.'" aria-label="Anterior">
        <span aria-hidden="true">&laquo;</span>
        <span class="sr-only">Anterior</span>
      </a>
  </li>';
   }
      for($x=$inicio;$x<=$final;$x++){
         if ($pagina == $x){
            //si muestro el índice de la página actual, no coloco enlace
            echo '<li class="page-item  active"><a class="page-link" href="#">'.$pagina.'</a></li>';
         }else{
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.$x.'&b='.$b.'">'.$x.'</a></li>';
      		}
      	}


      if ($pagina != $total_paginas){
         echo '<li class="page-item"><a class="page-link" href="'.$url.'&pagina='.($pagina+1).'&b='.$b.'"><span aria-hidden="true">&raquo;</span><span class="sr-only">Siguiente</span></a></li>';
      }
      


echo "</nav>";// Termina paginacion < 123 >

?>



</div></div></div></div>
