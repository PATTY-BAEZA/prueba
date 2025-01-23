<?php

if(isset($_SESSION['pvta'])){
	$pvta=$_SESSION['pvta'];
if($pvta==1){

?>


				<div class="card mt-3 mb-3">
  				<div class="card-header text-left"><i class="icon-shopping-cart"></i> <strong>Venta</strong> </div>
                     
                    <div class="card-block">
						


                   	</div>
                </div>




<?php

}



}else{
	echo "Para usar el punto de venta es necesario hacer antes una apertura de caja <br>
	<a href='?op=apertura' class='btn btn-success'>Apertura de Caja</a> ";
}


?>