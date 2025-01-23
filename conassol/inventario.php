<?php
include "funciones/codifica.php";
//Limito la busqueda
$TAMANO_PAGINA = 10;
$url="index.php?op=inventario";
//examino la página a mostrar y el inicio del registro a mostrar

if(isset($_GET['pagina'])){
$pagina = $_GET['pagina'];
$inicio = ($pagina - 1) * $TAMANO_PAGINA;

}else{
   $inicio = 0;
   $pagina = 1;	
}    

if(isset($_GET['b'])){$b=$_GET['b'];}else{$b="";}

if($b==""){
		$query = "SELECT COUNT(*) FROM producto WHERE prod_cen_id = $cenid";  
		$result = $cxn->query($query); 
		$count = $result->fetch_array(); 
		$num_total_registros= $count[0];  
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

 		$notifi="";
 		$consulta = "SELECT prod_id, prod_codigo, prod_nombre, prod_descripcion, prod_stock FROM producto where prod_cen_id = $cenid  order by prod_codigo LIMIT $inicio,$TAMANO_PAGINA;"; 
    }else{
		$query = "SELECT COUNT(*) FROM producto where prod_cen_id = $cenid AND (prod_codigo LIKE '%$b%' OR prod_nombre LIKE '%$b%' OR prod_descripcion LIKE '%$b%')"; 
		$result = $cxn->query($query); 
		$count = $result->fetch_array(); 
		$num_total_registros= $count[0];  
		$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

    	$notifi="<div class='alert alert-warning' role='alert'>
		$num_total_registros Resultados para busqueda: <strong>$b</strong> <i class='small'><a href='?op=inventario'>Limpiar Filtro</a></i></div> ";

    	$consulta = "SELECT prod_id, prod_codigo, prod_nombre, prod_descripcion, prod_stock FROM producto where prod_cen_id = $cenid AND (prod_codigo LIKE '%$b%' OR prod_nombre LIKE '%$b%' OR prod_descripcion LIKE '%$b%') order by prod_codigo LIMIT $inicio,$TAMANO_PAGINA;"; 
	}
?>
<div class="row">
  <div class="col-md-12">
<div class="card">
  <div class="card-header"><i class="icon-users"></i> <strong>Listado de productos</strong> </div>
  <div class="card-block">

<div class="row">
 <div class="col-sm-12 col-md-4 " ><a class="btn btn-secondary" href="?op=nprod" > <i class="icon-user-plus"></i> Agregar Producto </a>
 </div>

<div class="col-sm-12 col-md-8 text-right">
  <form action="#" method="GET" class="form-inline form-horizontal" style="margin:0 auto">
<div class="input-group text-right">
	<input type="hidden"  name="op"  value="inventario">
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
<th>Codigo</th>
<th>Nombre</th>
<th>Descripcion</th>
<th>Stock</th>
<th class="text-right"> <i class="icon-print"></i> </th>
</tr>
</thead>
<tfoot>
<tr>
<th>Codigo</th>
<th>Nombre</th>
<th>Descripcion</th>
<th>Stock</th>
<th> </th>
</tr>
</tfoot>
<tbody>
<?php

    if ($resultado = $cxn->query($consulta)){
        while( $fila=$resultado->fetch_object()) 
        { 
            $prodid = $fila -> prod_id;
            $prodidc=mic_encode($prodid);
            $prodcodigo = $fila -> prod_codigo;
            $prodnombre= $fila -> prod_nombre;
            $proddescripcion= $fila -> prod_descripcion;
            $prodstock = $fila -> prod_stock;

            echo "<tr>
			<td>$prodcodigo</td>
			<td>$prodnombre</td>
			<td>$proddescripcion </td>
      <td>$prodstock</td>
			<td><div id='acciones' class='btn-group btn-group-sm mt-1 mb-1' role='group' aria-label='First group'>
			    <a href='?op=prod&s=$prodidc' class='btn btn-secondary small'><i class='icon-list'></i></a>
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