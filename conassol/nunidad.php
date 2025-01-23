<?php
include "funciones/codifica.php";
$ferror="";
$s=$_GET['s'];
$nc=$_GET['nc'];
$sd = mic_decode($s);
$ncd = mic_decode($nc);

if(isset($_POST['fcliente'])){$fcliente = $_POST['fcliente'];}else{$fcliente = "";}
if(isset($_POST['fnombres'])){$fnombres = $_POST['fnombres'];}else{$fnombres ="";}
if(isset($_POST['fapellidos'])){$fapellidos = $_POST['fapellidos'];}else{$fapellidos ="";}
if(isset($_POST['fdireccion'])){$fdireccion = $_POST['fdireccion'];}else{$fdireccion ="";}
if(isset($_POST['fnip'])){$fnip = $_POST['fnip'];}else{$fnip ="";}
if(isset($_POST['fcnip'])){$fcnip = $_POST['fcnip'];}else{$fcnip ="";}

if($fcliente == ""){

$fcliente=$ncd;

    }

if(isset($_POST['guardar'])){

		if($fnip == ""){$ferror = "El campo NIP es requerido";}
		if($fcnip == ""){$ferror = "Es necesario confirmar el NIP";}
		if($fnip != $fcnip){$ferror = "El NIP y la confirmacion del NIP no coinciden";}	
		if($fapellidos == ""){$ferror="El campo Apellidos es requerido";}	
		if($fnombres == ""){$ferror="El campo Nombre es requerido";}
		//if($fnacimiento == ""){$ferror="El campo Fecha de Nacimiento es requerido";}
		if($fnumcliente == ""){$ferror="El campo Numero de cliente es requerido.";}else{
			$consulta="select * from usuario where usu_num_cliente = '$fnumcliente' ";

		             if($ejecucion_de_la_consulta=$cxn->query($consulta)){
		                 $datos_de_fila=$ejecucion_de_la_consulta->fetch_object();
		                 if(isset($datos_de_fila->usu_num_socio)){$usunumcliente=$datos_de_fila->usu_num_cliente;}else{$usunumcliente="";}
		                 if($fnumcliente == $usunumcliente){
		                     $ferror="El Numero de cliente ya existe, intente otro.";
		                 }
		             }
		}

		if($ferror == ""){
		            $consulta = "INSERT INTO usuario (usu_cen_id,usu_alias, usu_pass, usu_num_cliente, usu_nombre, usu_apellidos, usu_direccion, usu_status, usu_rol_id) VALUES ('$cenid','$fnumcliente','$fnip','$fnumcliente','$fnombres','$fapellidos','$fdireccion','1','1') ";

                $consulta2 = "INSERT INTO historial (his_cen_id, his_usu_id, his_evento) VALUES ('$cenid','$usuid','Alta del Cliente $fnumcliente')";
                $history = $cxn->query($consulta2);
		            if($cxn->query($consulta) === TRUE){
		                header ('Location: index.php?op=clientes');
		            }else{
		                echo "Error: " . $consulta . "<br>" . $cxn->error;
		            }

		}
}

?>

<div class="row mb-2">
  <div class="col-md-12">
<div class="card">
  <div class="card-header"><i class="icon-motorcycle"></i> <strong>Registro de Unidad</strong> </div>
  <div class="card-block">
<?php if($ferror != ""){echo "<div class='alert alert-danger' role='alert'>$ferror</div>";}?>
<form action="#" method="POST">

  <div class="row ">
    <div class="col-sm-6 mb-1">
     <label>Cliente</label>
      <input type="text" class="form-control" name="fcliente" placeholder="Cliente" value="<?php echo $ncd; ?>" disabled>
    </div>
    <div class="col-sm-6 mb-1">
    	     <label>Placa</label>
    	 <input type="text" class="form-control" name="fplaca"  placeholder="Placa" value="<?php echo ""; ?>">
    </div>
  </div>

  <div class="row ">
    <div class="col-sm-6 mb-1">
    	<label>Num. de Serie</label>
      <input type="text" class="form-control" name="fnumserie" placeholder="Num Serie" value="<?php echo $fnombres; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Modelo</label>
      <input type="text" class="form-control" name="fmodelo" placeholder="Modelo" value="<?php echo $fapellidos; ?>">
    </div>
  </div>
 <div class="row ">
    <div class="col-sm-6 mb-1">
    	    	<label>Año</label>
      <input type="text" class="form-control" name="fano" placeholder="Año" value="<?php echo $fnip; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Color</label>
      <input type="text" class="form-control" name="fcolor" placeholder="Color" value="<?php echo $fcnip; ?>">
    </div>
  </div>

  <div class="row ">
    <div class="col-sm-12 mb-1">
            <label>Notas</label>
      <textarea class="form-control" name="fnotas" value="<?php echo $fdireccion; ?>"></textarea>
    </div>
  </div>

  <button type="submit" class="btn btn-primary" name="guardar" value="1">Guardar</button>
</form>

</div>

</div></div></div>