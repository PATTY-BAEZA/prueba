<?php
$ferror="";

if(isset($_POST['fcodigo'])){$fcodigo = $_POST['fcodigo'];}else{$fcodigo = "";}
if(isset($_POST['fnombre'])){$fnombre = $_POST['fnombre'];}else{$fnombre ="";}
if(isset($_POST['fdescripcion'])){$fdescripcion = $_POST['fdescripcion'];}else{$fdescripcion ="";}
if(isset($_POST['fmarid'])){$fmarid = $_POST['fmarid'];}else{$fmarid ="";}
if(isset($_POST['fcosto'])){$fcosto = $_POST['fcosto'];}else{$fcosto ="";}
if(isset($_POST['fprecio'])){$fprecio = $_POST['fprecio'];}else{$fprecio ="";}
if(isset($_POST['fminimo'])){$fminimo = $_POST['fminimo'];}else{$fminimo ="";}
if(isset($_POST['fstock'])){$fstock = $_POST['fstock'];}else{$fstock ="";}


		//if($fnumcliente == ""){
	//		$consulta="SELECT MAX(prod_codigo) FROM producto where prod_cen_id = $cenid";

		//	if($ejecucion_de_la_consulta=$cxn->query($consulta)){
		//		$datos_de_la_fila=$ejecucion_de_la_consulta->fetch_row();

	//			$fnumcliente = $datos_de_la_fila[0] + 1;
	//		}
	//	}

if(isset($_POST['guardar'])){

		if($fminimo == ""){$ferror = "El campo minimo es requerido";}
		if($fdescripcion == ""){$ferror = "Es necesario una descripcion para el producto";}
		if($fprecio == ""){$ferror="El campo precio es requerido";}	
		if($fcosto == ""){$ferror="El campo costo es requerido";}
		if($fnombre == ""){$ferror="El campo Nombre requerido";}
    if($fmarid == ""){$ferror="El campo marca es requerido.";}
		if($fcodigo == ""){$ferror="El campo codigo es requerido.";}else{
			$consulta="select * from producto where prod_codigo = '$fcodigo' ";

		             if($ejecucion_de_la_consulta=$cxn->query($consulta)){
		                 $datos_de_fila=$ejecucion_de_la_consulta->fetch_object();
		                 if(isset($datos_de_fila->prod_codigo)){$prodcodigo=$datos_de_fila->prod_codigo;}else{$prodcodigo="";}
		                 if($fcodigo == $prodcodigo){
		                     $ferror="El Codigo ya existe, intente otro.";
		                 }
		             }
		}

		if($ferror == ""){

      $margen = (($fprecio - $fcosto) / $fcosto) * 100;

		            $consulta = "INSERT INTO producto (prod_cen_id, prod_codigo, prod_nombre, prod_mar_id, prod_margen, prod_costo, prod_descripcion, prod_minimo) VALUES ('$cenid','$fcodigo','$fnombre','$fmarid','$margen', '$fcosto','$fdescripcion','$fminimo') ";

                $consulta2 = "INSERT INTO historial (his_cen_id, his_usu_id, his_evento) VALUES ('$cenid','$usuid','Producto Agregado con codigo $fcodigo')";
                $history = $cxn->query($consulta2);
		            if($cxn->query($consulta) === TRUE){
		                header ('Location: index.php?op=inventario');
		            }else{
		                echo "Error: " . $consulta . "<br>" . $cxn->error;
		            }

		}
}

?>
<div class="row mb-2">
  <div class="col-md-12">
<div class="card">
  <div class="card-header"><i class="icon-user-plus"></i> <strong>Registro de Nuevo Producto</strong> </div>
  <div class="card-block">
<?php if($ferror != ""){echo "<div class='alert alert-danger' role='alert'>$ferror</div>";}?>
<form action="#" method="POST">

  <div class="row ">
    <div class="col-sm-6 mb-1">
     <label>Codigo</label>
      <input type="text" class="form-control" name="fcodigo" placeholder="Codigo" value="<?php echo $fcodigo; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	     <label>Marca</label>
    	 <input type="text" class="form-control" name="fmarid"  placeholder="" value="<?php echo "$fmarid"; ?>">
    </div>
  </div>

  <div class="row ">
    <div class="col-sm-6 mb-1">
    	<label>Nombre</label>
      <input type="text" class="form-control" name="fnombre" placeholder="Nombre" value="<?php echo $fnombre; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Costo</label>
      <input type="text" class="form-control" name="fcosto" placeholder="Costo" value="<?php echo $fcosto; ?>">
    </div>
  </div>

  <div class="row ">
    <div class="col-sm-12 mb-1">
    	    	<label>Precio</label>
      <input type="text" class="form-control" name="fprecio" placeholder="Precio" value="<?php echo $fprecio; ?>">
    </div>
  </div>

 <div class="row ">
    <div class="col-sm-6 mb-1">
    	    	<label>Descripcion</label>
      <input type="text" class="form-control" name="fdescripcion" placeholder="Descripcion" value="<?php echo $fdescripcion; ?>">
    </div>
    <div class="col-sm-6 mb-1">
    	    	<label>Minimo</label>
      <input type="text" class="form-control" name="fminimo" placeholder="Minimo" value="<?php echo $fminimo; ?>">
    </div>
  </div>


  <button type="submit" class="btn btn-primary" name="guardar" value="1">Guardar</button>
</form>

</div>

</div></div></div>