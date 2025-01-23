<?php
if(isset($_REQUEST['op'])){
	$op=$_REQUEST['op'];
}else{
	$op="";
}

switch($op){

case 'login':
include "login.php";
break;

case 'clientes':
include "clientes.php";
break;

case 'ncliente':
include "ncliente.php";
break;

case 'prod':
include "prod.php";
break;

case 'nprod':
include "nprod.php";
break;

case 'inventario':
include "inventario.php";
break;

case 'nunidad':
include "nunidad.php";
break;

case 'empleados':
include "empleados.php";
break;

case 'administradores':
include "administradores.php";
break;

case 'registro':
include "registro.php";
break;

case 'tablero':
include "tablero.php";
break;

case 'perfil':
include 'perfil.php';
break;

case 'pvta':
include "pvta.php";
break;

case 'apertura':
include "acaja.php";
break;

case 'cierre':
include "ccaja.php";
break;

default:
include "tablero.php";
break;

}



?>
