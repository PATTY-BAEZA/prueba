<?php
$ferror="";

if(isset($_POST['fnumcliente'])){$fnumcliente = $_POST['fnumcliente'];}else{$fnumcliente = "";}
//if(isset($_POST['fnacimiento'])){$fnacimiento = $_POST['fnacimiento'];}else{$fnacimiento ="";}
if(isset($_POST['fnombres'])){$fnombres = $_POST['fnombres'];}else{$fnombres ="";}
if(isset($_POST['fapellidos'])){$fapellidos = $_POST['fapellidos'];}else{$fapellidos ="";}
if(isset($_POST['fdireccion'])){$fdireccion = $_POST['fdireccion'];}else{$fdireccion ="";}
if(isset($_POST['fnip'])){$fnip = $_POST['fnip'];}else{$fnip ="";}
if(isset($_POST['fcnip'])){$fcnip = $_POST['fcnip'];}else{$fcnip ="";}

		if($fnumcliente == ""){
			$consulta="SELECT MAX(usu_num_cliente) FROM usuario where usu_cen_id = $cenid";

			if($ejecucion_de_la_consulta=$cxn->query($consulta)){
				$datos_de_la_fila=$ejecucion_de_la_consulta->fetch_row();

				$fnumcliente = $datos_de_la_fila[0] + 1;
			}
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
  <div class="card-header"><i class="icon-user-plus"></i> <strong>Registro de Nuevo Cliente</strong> </div>
  <div class="card-block">
<?php if($ferror != ""){echo "<div class='alert alert-danger' role='alert'>$ferror</div>";}?>
<form action="#" method="POST">

  <div class="row ">
    <div class="col-sm-6 mb-1">
     <label>Numero de Cliente</label>
      <input type="text" class="form-control" name="fnumcliente" placeholder="Num Cliente" value="<?php echo $fnumcliente; ?>" disabled>
    </div>
    <div class="col-sm-6 mb-1">
    	     <label>???</label>
    	 <input type="text" class="form-control" name=""  placeholder="" value="<?php echo ""; ?>">
    </div>
  </div>

  <div class="row ">
    <div class="col-sm-6 mb-1">
    	<label>Nombre(s)</label>
      <input type="text" class="form-control" name="fnombres" placeholder="Nombres" value="<?php echo $fnombres; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Apellidos</label>
      <input type="text" class="form-control" name="fapellidos" placeholder="Apellidos" value="<?php echo $fapellidos; ?>">
    </div>
  </div>

  <div class="row ">
    <div class="col-sm-12 mb-1">
    	    	<label>Direccion</label>
      <input type="text" class="form-control" name="fdireccion" placeholder="Direccion" value="<?php echo $fdireccion; ?>">
    </div>
  </div>

 <div class="row ">
    <div class="col-sm-6 mb-1">
    	    	<label>NIP de acceso</label>
      <input type="text" class="form-control" name="fnip" placeholder="NIP" value="<?php echo $fnip; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Confirmar NIP</label>
      <input type="text" class="form-control" name="fcnip" placeholder="Confirma NIP" value="<?php echo $fcnip; ?>">
    </div>
  </div>


  <button type="submit" class="btn btn-primary" name="guardar" value="1">Guardar</button>
</form>

</div>

</div></div></div>