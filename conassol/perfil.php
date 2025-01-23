<?php $ferror=0; 
include "funciones/codifica.php";

if(isset($_REQUEST['s'])){$s=$_REQUEST['s'];}else{$s="";}
if(isset($_REQUEST['tab'])){$tab=$_REQUEST['tab'];}else{$tab="";}

if ($s=="") {
  $usuid=$_SESSION['usu_id'];
  $sinhistorial=1;
}else{$usuid = mic_decode($s);
$sinhistorial=0;}

$consulta="SELECT * FROM usuario where usu_id = $usuid";
if($resultado=$cxn->query($consulta)){
$fila=$resultado->fetch_object();

$numcliente = $fila-> usu_num_cliente;
$alias = $fila -> usu_alias;
$nombre = $fila -> usu_nombre;
$apellidos = $fila -> usu_apellidos;
$direccion = $fila -> usu_direccion;



 
}
$variablita = "$nombre $apellidos";
$nc = mic_encode($variablita);
?>

<div class="row mb-2">
  <div class="col-md-12">



<div class="card ">
  <div class="card-header"><i class="icon-user-tie"></i> <strong>Perfil</strong> <i><?php echo $alias; ?></i> 
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link <?php if($tab=="" OR $tab==1){echo "active";}?>" href="?op=perfil&s=<?php echo $s;?>&tab=1">Datos Personales</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($tab==2){echo "active";}?>" href="?op=perfil&s=<?php echo $s;?>&tab=2">Datos Usuario</a>
      </li>

      <li class="nav-item">
        <a class="nav-link <?php if($tab==3){echo "active";}?>" href="?op=perfil&s=<?php echo $s;?>&tab=3">Unidades Registradas</a>
      </li>

    </ul>
  </div>
  <div class="card-block">

  <?php if($tab=="" OR $tab==1){ ?>
  
  <?php echo "Nombre: $nombre $apellidos <br> Direccion: $direccion <br> "; ?>
  
  <div class="text-right"> <a href="#" ><i class="icon-pencil"></i> Modificar</a></div>
  
   <?php }
   if($tab==2){

echo " Alias de Ingreso: $alias <br>  NIP: **** <br>";

    ?>
 
   <div class="text-right"> <a href="#" ><i class="icon-pencil"></i> Cambiar NIP</a></div>
   
   <?php }
   if($tab==3){

//echo "Tabla de Vehiculos registrados";    
?>


<table class="table table-hover table-sm">
<thead>
<tr>
<th>Placa</th>
<th>Modelo</th>
<th>Año</th>
<th class="text-right"> <i class="icon-print"></i> </th>
</tr>
</thead>
<tfoot>
<tr>
<th>Placa</th>
<th>Modelo</th>
<th>Año</th>
<th> </th>
</tr>
</tfoot>
<tbody>

<div class="row">
 <div class="col-sm-12 col-md-4 " ><a class="btn btn-secondary" href="?op=nunidad&s=<?php echo $s; ?>&nc=<?php echo $nc; ?>" > <i class="icon-motorcycle"></i> Agregar Unidad </a><br><br>
 </div>
<?php


  echo "<tr>
      <td>aad</td>
      <td>asdasd</td>
      <td>2012</td>
      <td>
          ver
        </td>
      </tr>";

echo "</tbody>
</table>";

} ?>



  </div> <!-- card block -->
</div>


</div></div>