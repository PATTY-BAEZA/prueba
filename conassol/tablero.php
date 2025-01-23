<div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-3">
                        <div class="card text-center no-boder bg-color-green">
                        	
                            <div class="card-block">
                                <h1><i class="icon-bar-graph"></i></h1>
                                <h3>78</h3>
                            </div>
                            <div class="card-footer back-footer-green">
                               Eventos

                            </div>
                        </div>
                    </div>


<?php 
$consulta = "SELECT COUNT(usu_id) from usuarios";

if($resultado = $cxn->query($consulta)){
    $fila = $resultado->fetch_array();
    $numalumnos = $fila[0];
}

?>                    
                    <div class="col-xs-6 col-sm-6 col-md-3 ">
                        <div class="card text-center no-boder bg-color-brown">
                            <div class="card-block">
                                <h1><i class="icon-users "></i></h1>
                                <h3><?php echo $numalumnos; $fila=NULL; ?> </h3>
                            </div>
                            <div class="card-footer ">
                                Asistentes
                            </div>
                        </div>
                    </div>
</div>


<br />
<div class="row">
	<div class="col-md-12">
<div class="card">
	<div class="card-header"><i class="icon-layers"></i> <strong>Actividades </strong> </div>
	<div class="card-block">

  </div>

</div>
</div>
</div>
<br />



<?php 
include "funciones/codifica.php";
            //$usucenid=$cenid;
            //$usucenid=mic_encode($usucenid);

?>

<div class="row">
    <div class="col-sm-12 col-md-6 mb-1">
<!--<a href="#" class="btn btn-success btn-block" onclick='javascript:window.open("asistencia/index.php?s=THcya2wgV3cgSndzZzlxeXh5IDNscCBPd2tseWwgV3Fv&ng=<?php echo $usucenid?>", "", "toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, fullscreen=yes") '>Abrir Panel de Acceso</a> -->
</div>


</div>

<br />

<div class="row">
    <div class="col-md-12">
<div class="card">
    <div class="card-header"><i class="icon-layers"></i> <strong>Eventos del Sistema</strong> </div>
    <div class="card-block">

<?php 
include "funciones/tiempo.php";
$consultat = "SELECT * from historial Order by his_fecha desc LIMIT 10";


   if ($resultadot = $cxn->query($consultat)){
        while( $filat=$resultadot->fetch_object()) 
        { 
    $hisusuid = $filat -> his_usu_id;
    $hisevento = $filat-> his_evento;
    $hisfecha = $filat -> his_fecha;



$hacextiempo = tiempo_transcurrido($hisfecha);

echo "<div style='float:left;'>$hisevento</div><div style='float:right; font-size: small;'>$hacextiempo</div><br>";
}
}
?>   


</div>
</div>
</div>
</div>