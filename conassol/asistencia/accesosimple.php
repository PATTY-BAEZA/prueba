<?php
if(isset($_GET['bnVtZXJv'])){
$numero=$_GET['bnVtZXJv'];
}else{
$numero="";	
}
?>

<html>
<head>
<meta name="viewport" content="width=device-width, user-scalable=no, inicial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" >
<meta http-equiv="Content-Type" content="text/html; UTF-8" />
<link rel='stylesheet' id='bootstrap'  href='css/bootstrap.min.css' type='text/css'  />
<link rel='stylesheet' id='bootstrap'  href='css/bootstrap-grid.min.css' type='text/css'  />
<link rel='stylesheet' id='estilo'  href='fonts/style.css' type='text/css'  />
</head>
<body>
<style>
body{
	background-image: url(img/bg.jpg);
	background-repeat: repeat-x;
}

</style>

<header>
	<div class="container">	
<section class="row" style="margin-top: 25px">
<article  class="col-sm-12  text-center "> 
<img src="img/logo.png" height="200" />
</article>
</section>
	</div>
</header>

<aside class="container">

  <div class="row justify-content-center">

    <div class="col-lg-6 col-sm-12 text-center">
      <input type="text" id="oculto" class="form-control"  autofocus />
      <div class="clearfix" style="height: 5px;"></div>
    </div>

    <div class="col-lg-6 col-sm-12 text-center">

<div class=row>
<div class="col-7">
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'1';">1</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'2';">2</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'3';">3</a>
</div>
<div class="col-3" >

</div>
</div>

<div class="clearfix" style="height: 5px;"></div>
<div class=row>
<div class="col-7">
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'4';">4</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'5';">5</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'6';">6</a>
</div>
<div class="col-3">
<a href="#" class="btn btn-warning">Limpiar</a>
</div>
</div>
<div class="clearfix" style="height: 5px;"></div>

<div class=row>
<div class="col-7">
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'7';">7</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'8';">8</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'9';">9</a> 
</div>
<div class="col-3">
<a href="#" class="btn btn-success">Aceptar</a><br />
</div>
</div>
<div class="clearfix" style="height: 5px;"></div>

<div class=row>
<div class="col-7">
<a href="#" class="btn btn-secondary">#</a>
<a href="#" class="btn btn-secondary" onclick="document.getElementById('oculto').value=document.getElementById('oculto').value+'0';">0</a>
<a href="#" class="btn btn-secondary">*</a>
</div>
<div class="col-3">

</div>
</div>

    </div>
  </div>

</aside>

</body>
</html>