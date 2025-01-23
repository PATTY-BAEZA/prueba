<?php ob_start("ob_gzhandler"); //comprime y evita salidas antes de definir cabeceras 
date_default_timezone_set('America/Mexico_City');
session_start();
if(isset($_REQUEST['op'])){
	$op=$_REQUEST['op'];
}else{$op="";}

if(isset($_SESSION['usu_id'])){
$usuid=$_SESSION['usu_id'];
$logeado=1;	
}else{
	$logeado=0;
}

$fechahoy=date('Y/m/d');
$horahoy=date('H:i:s');
include "conexion.php";
?>
<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, inicial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" >
<meta http-equiv="Content-Type" content="text/html; UTF-8" />
<link rel='stylesheet' id='menu'  href='css/menu.css' type='text/css'  />
<link rel='stylesheet' id='bootstrap'  href='css/bootstrap.min.css' type='text/css'  />
<link rel='stylesheet' id='bootstrap'  href='css/bootstrap-grid.min.css' type='text/css'  />
<link rel='stylesheet' id='estilo'  href='fonts/style.css' type='text/css'  />
</head>
<body>
<style>
body{
	background: #fcfcfc;
}
.login {
	text-align: right;
}
a {
text-decoration: none !important;
}
.oscuro {
	background: #006171;
	color: #000000;
}
.negro {
	background: #ffffff;
	color: #000000;
}
.blanco {
	background: #fff;
	
}
.panel-info {
    border-color: #bce8f1;
}
.portada {
	background-image: url("img/portada.jpg");
	background-repeat: no-repeat;
  background-position: center top;
	color: #000000;
}

@media(max-width: 420px){
 #acciones {
 	width: 35px;
   display: flex;
   flex-direction: column;
 }
}
</style>

<header class="negro">
	<div class="container negro">	

<?php

include "header.php";
?>
	</div>


<?php
if ($logeado == 1){
include "menu.php";
}
?>
</header>

<div class="container">
<section class="main row">
	<?php
	if($logeado == 1){    
	include "barrausu.php";
	}
	?>
<article  class="col-xs-12 col-md-8"> 
<?php
if($logeado==1 OR $op == 'registro'){
include "contenido.php";
}else{
include "login.php";	
}
?>
</article>

<?php
if($logeado==1){
 include "sidebar.php"; 
}else{
	include "publicidad.php";
}
?>

</section> <!-- main row -->
</div> <!-- contenedor -->   


<footer class="oscuro">
<div class="container">
<div class="col-md-12 oscuro">
<?php include "footer.php"; ?>
<div>
</div>
</footer>

</body>
</html>
<?php ob_end_flush(); ?>