<?php
$ferror="";
if(isset($_POST['monto'])){$montoinicial=$_POST['monto'];}else{$montoinicial=0;}

if(isset($_POST['apertura'])){

	if(is_numeric($montoinicial)){
	
			if($montoinicial==0 OR $montoinicial==""){ $ferror="Debe agregar un monto inicial";}

			}else{$ferror="Debe agregar solo valores numericos"; $montoinicial=0;}

if($ferror==""){
$consulta="INSERT INTO caja (caja_fecha_apertura, caja_monto_inicial) values ('$fechahoy $horahoy', '$montoinicial')";
$_SESSION['pvta']=1;
if($resultado=$cxn->query($consulta)){
	        header ('location: index.php?op=pvta'); 
//	echo "se registro";
}

}

}else{}
//echo "$horahoy";

?>


<div class="card mt-3 mb-3">
  	<div class="card-header text-left"><i class="icon-key"></i> Apertura de caja 
  	</div>
	<div class="card-block">
		<?php if($ferror != ""){echo "<div class='alert alert-danger' role='alert'>$ferror</div>";}?>
	<form action="#" method="POST" autocomplete="off">
  		<div class="row ">
    		
    		<div class="col-sm-6 mb-1">
    		<label>Fecha</label>
			<input type="text" class="form-control" name="fechaapertura" value="<?php echo $fechahoy; ?>" readonly>
			</div>
			
			<div class="col-sm-6 mb-1">
			<label>Monto Inicial</label>
				<div class="input-group">
				<div class="input-group-addon">$</div>
				<input type="text" class="form-control" name="monto" value="<?php echo $montoinicial; ?>">
				</div>
				<i class="text-muted small">Efectivo en caja. Ejem. 420.50</i>
			</div>

			<div class="col-sm-12 mb-1 text-right">
				<input type="submit" class="btn btn-success" name="apertura" value="Apertura">
			</div>

		</div>
	</form>
	</div>
</div>