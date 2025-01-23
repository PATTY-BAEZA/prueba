<?php

if(isset($_REQUEST['s'])){
  $s=$_REQUEST['s'];
}else{
  $s="";
}

if(isset($_REQUEST['tf'])){
  $tf=$_REQUEST['tf'];
}else{
  $tf="";
}

if(isset($_REQUEST['ng'])){
      $ng = $_REQUEST['ng'];
}else{
  $ng = "";
}
 

      if($ng == ""){
              //echo "formulario usuario y password para obtener ng y tf y s THcya2wgV3cgSndzZzlxeXh5IDNscCBPd2tseWwgV3Fv";
              include "acceso.php";
      }else{



              if($tf == ""){
                    echo "mostrar botones para seleccionar tipo de formulario <br /> <a href='?s=THcya2wgV3cgSndzZzlxeXh5IDNscCBPd2tseWwgV3Fv&ng=".$ng."&tf=WGw5bmcxeDlxbCAzbHAgT3drbHlsIEpxbm8xdw==' >Formulario Simple</a> <a href='?s=THcya2wgV3cgSndzZzlxeXh5IDNscCBPd2tseWwgV3Fv&ng=".$ng."&tf=WGw5bmcxeDlxbCAzbHAgT3drbHlsIFd3IFlna3dwa3F2eHZxbHA=' >Formulario con Autenticacion</a>";
              }else{
                    echo "mostrar formulario simple o con autenticacion segun el caso <br>";
                    if($tf=="WGw5bmcxeDlxbCAzbHAgT3drbHlsIFd3IFlna3dwa3F2eHZxbHA="){
                      echo "formauth.php";
                    }
                    if($tf == "WGw5bmcxeDlxbCAzbHAgT3drbHlsIEpxbm8xdw=="){
                      echo "formsimple.php";
                    }
              }
      }



?>