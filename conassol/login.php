<?php
$errorlogin="";

$nombre_de_usuario = "";
if (isset($_POST['alias'])){
    $elalias=strtolower($_POST['alias']);
    $nombre_de_usuario=mysqli_real_escape_string($cxn,$elalias);
    $nombre_de_usuario=trim($nombre_de_usuario);
    $contraseña_introducida=$_POST['pass'];
    //se hará la consulta a la base de datos
    $consulta="select usu_id, usu_alias, usu_pass, usu_valido, dato_nombre from usuarios join datos on usu_id = dato_usu_id where usu_alias = '$nombre_de_usuario' ";
    //si hubo un resultado
    if ($ejecución_de_la_consulta=$cxn->query($consulta)){
        //se obtiene la contraseña registrada
        $datos_guardados=$ejecución_de_la_consulta->fetch_assoc();
        //se compara la contraseña
        //$verificar_contraseña=password_verify($contraseña_introducida,$contraseña_guardada['usu_password']);
        //si el resultado de la comparación ha sido verdadero
        if($nombre_de_usuario == $datos_guardados['usu_alias']){
            
       
            if ($contraseña_introducida == $datos_guardados['usu_pass']){
                $usuvalido=$datos_guardados['usu_valido'];
                    if($usuvalido==1){
                           
                        //se asigna la sesión y redirecciona
                        $_SESSION['usu_alias']=$datos_guardados['usu_alias'];
                        $_SESSION['usu_id']=$datos_guardados['usu_id'];
                        $_SESSION['usu_nombre']=$datos_guardados['dato_nombre'];
                        //$_SESSION['usu_nombre']=$datos_guardados['usu_nombre'];
            

                        $usuid=$datos_guardados['usu_id'];
                        //$cenid=$datos_guardados['usu_cen_id'];

                            //$consulta2 = "INSERT INTO historial (his_cen_id, his_usu_id, his_evento) VALUES           ('$cenid','$usuid','Ingreso de usuario $usuid')";
                            //$history = $cxn->query($consulta2);

                        header ('location: index.php?op=tablero'); 
                    }else{
                        $errorlogin = "Su correo aún no a sido verificado, debe hacer clic en el enlace que aparece en el mensaje que le enviamos a su correo cuando hizo su registro. <br> Si el mensaje no llego a su bandeja de entrada es posible que su proveedor de correo lo haya enviado a correo no deseado por error.";
                    }
            
            }//si la contraseña es incorrecta
            else{
            //header ('location: index.php');
            $errorlogin="Password Incorrecto";
            }
        }else{
            $errorlogin = "El usuario no existe en nuestra base de datos.";
        }   
    }//si el usuario no está registrado
}
?>        
        <div class="text-right col-sm-12">   


				<div class="card mt-3 mb-3">
  				<div class="card-header text-left"><i class="icon-key"></i> Login </div>
                       
                    <div class="card-block">

<?php 
if($errorlogin != ""){
echo "<div class='alert alert-danger text-left' role='alert'>$errorlogin</div>";
}

?>

<div style="float:right; font-size: 80%; position: relative; "><a href="#">Olvidaste tu Password?</a> | <a href="?op=registro">Registrarse</a></div>
                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="loginform" class="form-horizontal" role="form" method="POST" action="?op=login" autocomplete="on">
                                    
                            <div style="padding: 25px;" class="input-group">
                                        <span class="input-group-addon"><i class="icon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control text-lowercase" name="alias" value="<?php echo $nombre_de_usuario; ?>" placeholder="Usuario" >        
                                                                 
                                    </div>
                                
                            <div style="padding: 25px;" class="input-group">
                                        <span class="input-group-addon"><i class="icon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="pass" placeholder="password" autocomplete="off" >
                                    </div>

                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->

                                    <div class="col-sm-12 controls">

                                        <input type="submit" name="submit" value="Entrar" class="btn btn-success">


                                    </div>
                                </div>
                        
                            </form>     
                     </div>                     
             </div>  
        </div>
    
<br><br><br><br>