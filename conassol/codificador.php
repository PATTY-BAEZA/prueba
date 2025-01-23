<?php

$s=$_GET['s'];

include "funciones/codifica.php";


$codificado = mic_encode($s); //echo $reversa;

$decodificado = mic_decode($codificado);

echo "$codificado <br> $decodificado <br>";

echo sha1($codificado);



?>


