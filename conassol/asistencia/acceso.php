<?php

include "../conexion.php";
include "../funciones/codifica.php";
$errorlogin="";

if (isset($_POST['alias'])){
    $nombre_de_usuario=mysqli_real_escape_string($cxn,$_POST['alias']);
    $nombre_de_usuario=trim($nombre_de_usuario);
    $nombre_de_usuario=strtolower($nombre_de_usuario);

    $contraseña_introducida=$_POST['pass'];
    //se hará la consulta a la base de datos
    $consulta='select * from usuario where usu_alias="'.$nombre_de_usuario.'"';
    //si hubo un resultado
    if ($ejecución_de_la_consulta=$cxn->query($consulta)){
        //se obtiene la contraseña registrada
        $datos_guardados=$ejecución_de_la_consulta->fetch_assoc();
       
        //se compara la contraseña
        //$verificar_contraseña=password_verify($contraseña_introducida,$contraseña_guardada['usu_password']);
        //si el resultado de la comparación ha sido verdadero
        if($nombre_de_usuario == $datos_guardados['usu_alias']){
            
       
            if ($contraseña_introducida == $datos_guardados['usu_pass']){
            //se asigna la sesión y redirecciona

            $usugimid=$datos_guardados['usu_gim_id'];
            $usugimid=mic_encode($usugimid);
            //include "funciones.php";
            //$laip=getRealIP();
            //$conslog="INSERT INTO logeventos (log_usu_id, log_eve_id, log_mensaje) VALUES ('$usuid',1,'$laip')";
            //if($cxn->query($conslog) === TRUE){echo "log";}else{echo "Error: " . $consulta . "<br>" . $cxn->error;}
            header ('location: index.php?s=THcya2wgV3cgSndzZzlxeXh5IDNscCBPd2tseWwgV3Fv&ng='.$usugimid); 
            }//si la contraseña es incorrecta
            else{
            //header ('location: index.php');
            $errorlogin="Password Incorrecto";
            }
        }else{
            $errorlogin = "El usuario no existe en nuestra base de datos.";
        }   
    }//si el usuario no está registrado
}else{ $nombre_de_usuario = " ";}

echo $errorlogin;
?> 

<form action="index.php?s=THcya2wgV3cgSndzZzlxeXh5IDNscCBPd2tseWwgV3Fv" method="POST" autocomplete="off">

<input type="text" name="alias" value="<?php echo $nombre_de_usuario; ?>"  />
<input type="password" name="pass" value="" />

<input type="submit" name="entrar" value="Entrar" />

</form>