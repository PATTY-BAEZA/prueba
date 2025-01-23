<?php



?>

<style>
.ejex{
	
	text-align: center;
	font-size: 8px;

}
.ejey{
	height: 26px;
	text-align: right;
	padding-right: 5px;
}
.lineaejey{
		height: 13px;
		width: 10px;
		border-bottom: solid 1px #ccc;
	
}
.nolineaejey{
		height: 13px;
		width: 10px;
		
	
}
.columna{
vertical-align: bottom;
width: 25px;
border-bottom: solid 1px #ccc;
}

</style>

<?php
$datos=array(0,8,200,160,116,10,8,5,6,6,18,28,5);
//$datos2=array(09,150,120,116,30,80,78,99,65,75,86,75,55);
$ejex=array('','ENE','FEB','MAR','ABR','MAY','JUN','JUL','AGO','SEP','OCT','NOV','DIC');

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



$base=	($datos[0]/$maximo)*100;
?>



<style>
#divPadre {
display: inline-block;
	position:relative;
    height:104px;
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



for($col=1;$col<=$tamdatos-1;$col++){

	echo "<td rowspan=9 class='columna'><div id=divPadre>";

	$valory = ($datos[$col]/$maximo)*100;


	if($base < $valory){
		$incremento = ($valory - $base) / 25;
		$valoreny = $base + $incremento;
	}else{
		$incremento = ($base - $valory) / 25;
		$valoreny = $base - $incremento;	
	}

	$x=0;
	while($x < 25){

		echo "<div id=divHijo style='left: ".$x."px; height: ".$valoreny."px;background-color:red;filter:alpha(opacity=50); opacity:0.5;'><div id=divHijo style='position: absolute; background: #0000ff; height: 15px; width: 1px;filter:alpha(opacity=50); opacity:0.5;'> </div></div>";
		$x++;
		$base=$valoreny;
		if($base < $valory){
			$valoreny=$valoreny + $incremento;
		}else{
			$valoreny=$valoreny - $incremento;	
		}
	
	}
	echo "</div></td>";
}	

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