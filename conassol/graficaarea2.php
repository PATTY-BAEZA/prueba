<?php



?>

<style>
.ejex{
	
	text-align: center;
	font-size: 8px;

}
.ejey{
	height: 24px;
	text-align: right;
	padding-right: 5px;
}
.lineaejey{
		height: 12px;
		width: 10px;
		border-bottom: solid 1px #ccc;
	
}
.nolineaejey{
		height: 12.5px;
		width: 10px;
		
	
}
.columna{
vertical-align: bottom;
width: 25px;
border-bottom: solid 1px #ccc;
}
.contgraf{
vertical-align: bottom;
width: 100%;
border-bottom: solid 1px #ccc;
vertical-align: bottom;
}
</style>

<?php
$datos=array(0,25,67,24,89,45,80,160,350);
$ejex=array('','ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO');

$tamdatos=count($datos);

$maximo=max($datos);
$maximo2 = $maximo + 1;

while($maximo2%4 != 0){
$maximo2++;
}



$distanciay = $maximo2 / 4;

$num1 = $distanciay;
$num2 = $num1 + $distanciay;
$num3 = $num2 + $distanciay;
$num4 = $num3 + $distanciay;

//$num4 = number_format($num4, 2, '.', '');
//$num1 = number_format($num1, 1, '.', '');
//$num2 = number_format($num2, 1, '.', '');
//$num3 = number_format($num3, 1, '.', '');

//echo "Tamaño: $tamdatos <br> Maximo: $maximo <br> Maximo 2: $maximo2 <br> $num4 <br /> $num3 <br /> $num2 <br /> $num1 <br /> 0";
?>




<style>
#divPadre {
display: inline-block;
	position:relative;
    height:100px;
    width:25px;
    text-align:center;
    background-color:#f4f4f4;
}
#divHijo {
	position: absolute;
    bottom: 0px;

    width:1px;

}
</style>


<table border=0 cellpadding="0" cellspacing="0">
<tr>
<td rowspan=2 class="ejey"><?php echo $num4; ?></td><td class="lineaejey"></td>

<?php


$base=0;
$tamdatos=$tamdatos-1;
echo "<td rowspan=9 colspan=".$tamdatos." class='congraf'> ";
for($col=1;$col<=$tamdatos;$col++){

	echo "<div id=divPadre>";

		$valory = ($datos[$col]/$maximo)*100;


	if($base < $valory){
		$incremento = ($valory - $base) / 25;
		$valoreny = $base + $incremento;
	}else{
		$incremento = ($base - $valory) / 25;
		$valoreny = $base - $incremento;	
	}

	$x=1;
	while($x <= 25){

		echo "<div id=divHijo style='left: ".$x."px; height: ".$valoreny."px;background-color:red;filter:alpha(opacity=50); opacity:0.5;'><div id=divHijo style='position: absolute; background: #00ff00; height: 15px; width: 1px;filter:alpha(opacity=50); opacity:0.5;'> </div></div>";
		$x++;
		$base=$valoreny;
		if($base < $valory){
			$valoreny=$valoreny + $incremento;
		}else{
			$valoreny=$valoreny - $incremento;	
		}
	
	}
	echo "</div>";
}	
echo "</td>";
?>

</tr>
<tr>
<td class="nolineaejey"></td>
</tr>
<tr>
<td rowspan=2 class="ejey"><?php echo $num3; ?></td><td class="lineaejey"></td>
</tr>
<tr>
<td class="nolineaejey"></td>
</tr>
<tr>
<td rowspan=2 class="ejey"><?php echo $num2; ?></td><td class="lineaejey"></td>
</tr>
<tr>
<td class="nolineaejey"></td>
</tr>
<tr>
<td rowspan=2 class="ejey"><?php echo $num1; ?></td><td class="lineaejey"></td>
</tr>
<tr>
<td class="nolineaejey"></td>
</tr>
<tr>
<td rowspan=2 class="ejey">0</td><td class="lineaejey"></td>
</tr>
<tr>
<td class="nolineaejey"></td>

<?php 
for($col=1;$col<=$tamdatos-1;$col++){
echo "<td class='ejex'>".$ejex[$col]."</td>";
}	
?>

</tr>

</table>


