<?php

include "conexion.php";

if(isset($_REQUEST['coditsjc'])){
	$coditsjc=$_REQUEST['coditsjc'];
}else{
	$coditsjc="";
}

$consulta="SELECT usu_id, usu_valido, usu_codigo FROM usuarios where usu_codigo = '$coditsjc'";

    if ($ejecuta_consulta=$cxn->query($consulta)){
        $datos_guardados=$ejecuta_consulta->fetch_assoc();

        	if($datos_guardados['usu_valido'] == 1){

        		$converi="UPDATE 'usuarios' SET 'usu_valido' = '1' WHERE 'usuarios'.'usu_id' =  $usuid;";

        	echo "Su cuenta ya fue verificada con anterioridad <br>";

        	}else{
        		
        		if($datos_guardados['usu_codigo'] == $coditsjc){
        			echo "iguales su cuenta se ha verificado <br>  ";
        		}else{
        			echo "su codigo es incorrecto";
        		}

        		//echo "usuario invalido <br>";


        	}
        }

echo $coditsjc;
?>