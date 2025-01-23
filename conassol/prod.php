<?php $ferror=0; 
include "funciones/codifica.php";

if(isset($_REQUEST['s'])){$s=$_REQUEST['s'];}else{$s="";}
if(isset($_REQUEST['tab'])){$tab=$_REQUEST['tab'];}else{$tab="";}

$prodid = mic_decode($s);


$consulta="SELECT * FROM producto where prod_id = $prodid";
if($resultado=$cxn->query($consulta)){
$fila=$resultado->fetch_object();

$prodcodigo = $fila-> prod_codigo;
$prodnombre = $fila -> prod_nombre;
$proddescripcion = $fila -> prod_descripcion;
$prodmarid = $fila -> prod_mar_id;
$prodmargen = $fila -> prod_margen;
 
}
//$variablita = "$nombre $apellidos";
//$nc = mic_encode($variablita);
?>

<div class="row mb-2">
  <div class="col-md-12">



<div class="card ">
  <div class="card-header"><i class="icon-user-tie"></i> <strong><?php echo $prodcodigo; ?></strong> <i><?php echo $prodnombre; ?></i> 
 
  </div>
  <div class="card-block">

  
  <?php echo "Nombre:  <br> Direccion:  <br> "; ?>
  
  <div class="text-right"> <a href="#" ><i class="icon-pencil"></i> Modificar</a></div>
  
 







  </div> <!-- card block -->
</div>


</div></div>