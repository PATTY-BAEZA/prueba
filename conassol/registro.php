<?php
include "funciones/codifica.php";
$ferror="";

if(isset($_POST['fusualias'])){$fusualias = $_POST['fusualias'];}else{$fusualias ="";}
if(isset($_POST['fusupass'])){$fusupass = $_POST['fusupass'];}else{$fusupass ="";}
if(isset($_POST['fcusupass'])){$fcusupass = $_POST['fcusupass'];}else{$fcusupass ="";}


if(isset($_POST['guardar'])){

			if($fusupass == ""){$ferror = "El campo NIP es requerido";}else{
			if (!is_numeric($fusupass)) { $ferror = "El campo NIP requiere un valor numerico";}
		}

		if($fusupass != $fcusupass){$ferror = "El NIP y la confirmacion del NIP no coinciden";}

		if($fusualias == ""){$ferror="El campo Email es requerido.";}else{

if(filter_var($fusualias, FILTER_VALIDATE_EMAIL)){}else{$ferror="Necesita ingresar un direccion de correo valida.";}

			$consulta = "SELECT * FROM usuarios WHERE usu_alias = '$fusualias' ";

		             if($ejecucion_de_la_consulta=$cxn->query($consulta)){
		                 $datos_de_fila=$ejecucion_de_la_consulta->fetch_object();
		                 if(isset($datos_de_fila->usu_alias)){$usualias=$datos_de_fila->usu_alias;}else{$usualias="";}
		                 if($fusualias == $usualias){

		                     $ferror="El correo que proporciono ya fue registrado antes, intente con otro correo.<br>Si es su correo intente recuperar su contraseña";

		                 	}
		                 }
		             }
		

		if($ferror == ""){
			$numerito=rand(10,99);
			$azar=date('s/i/H');
				$generado=$numerito."itsjc".$azar;
			  $usucodigo= mic_encode($generado);   
		            $consulta = "INSERT INTO usuarios (usu_alias, usu_pass, usu_rol_id, usu_codigo) VALUES ('$fusualias','$fusupass','1', '$usucodigo') ";


		       

               // $consulta2 = "INSERT INTO historial (his_cen_id, his_usu_id, his_evento) VALUES ('$cenid','$usuid','Alta del Cliente $fnumcliente')";
              //  $history = $cxn->query($consulta2);
		            if($cxn->query($consulta) === TRUE){
		                header ('Location: index.php?op=nada');
		            }else{
		                echo "Error: " . $consulta . "<br>" . $cxn->error;
		            }

		}
}

?>
<div class="row mb-2">
  <div class="col-md-12">
<div class="card">
  <div class="card-header"><i class="icon-user-plus"></i> <strong>Registro de Alumno</strong> </div>
  <div class="card-block">
<?php if($ferror != ""){echo "<div class='alert alert-danger' role='alert'>$ferror</div>";}?>
<form action="#" method="POST">

  <div class="row ">
    <div class="col-sm-12 mb-1">
     <label>Email</label>
      <input type="text" class="form-control" name="fusualias" placeholder="Email" value="<?php echo $fusualias; ?>">
    </div>
      </div>


 <div class="row ">
    <div class="col-sm-6 mb-1">
    	    	<label>NIP de acceso</label>
      <input type="text" class="form-control" name="fusupass" placeholder="NIP" value="<?php echo $fusupass; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Confirmar NIP</label>
      <input type="text" class="form-control" name="fcusupass" placeholder="Confirma NIP" value="<?php echo $fcusupass; ?>">
    </div>
  </div>

*Tu NIP de acceso deben ser numeros que recuerdes facilmente para accesar a la plataforma!<br><br>
  <div style="float: right;"><button type="submit" class="btn btn-primary" name="guardar" value="1">Guardar</button></div>
</form>

</div>

</div></div></div><br><br>
