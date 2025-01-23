<?php

function mic_encode($cadena){
$resultado="";
$cadena = ucwords($cadena);
$malos = array("ñ");
$buenos   = array("n");
$cadenalimpia = str_replace($malos, $buenos, $cadena);
$arreglodecadena=str_split($cadenalimpia);
$contador=count($arreglodecadena);

$encontraraqui = " abcdefghijklmnopqrstuvwxyz9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA/-:";
$remplazarpor = " xzvyw4suqtr1nplom9ikgjh2dfbec7BaDAC5GEIFH0LJNKM6QOSPR8VTXUW3ZY-/:";
$aremplazarpor = str_split($remplazarpor);

		for($x=0;$x<$contador;$x++){
			$posicion = strpos($encontraraqui, $cadenalimpia[$x]);
			$resultado = "$resultado".$aremplazarpor[$posicion];
		}
$resultado=base64_encode($resultado);		
return $resultado;
}


function mic_decode($cadena){
$resultado="";
$cadena=base64_decode($cadena);
$arreglodecadena=str_split($cadena);
$contador=count($arreglodecadena);

$encontraraqui = " xzvyw4suqtr1nplom9ikgjh2dfbec7BaDAC5GEIFH0LJNKM6QOSPR8VTXUW3ZY-/:";
$remplazarpor = " abcdefghijklmnopqrstuvwxyz9876543210ZYXWVUTSRQPONMLKJIHGFEDCBA/-:";
$aremplazarpor = str_split($remplazarpor);

		for($x=0;$x<$contador;$x++){
			$posicion = strpos($encontraraqui, $cadena[$x]);
			$resultado = "$resultado".$aremplazarpor[$posicion];
		}
return $resultado;
}

function calcula_edad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}
?>