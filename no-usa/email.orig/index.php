<?php
   error_reporting(0);
   session_start();
  //cho "<hr>--".$_SESSION['dependencia']." --";
  /* if(!$dependencia or !$krd) 
   //{
//	echo "<hr>--".$_SESSION['dependencia']." --";
	echo "No se ha podido Iniciar Session";
	//	  include "../rec_session.php";
   }*/
   $carpeta=$carpetano;
   $tipo_carp = $tipo_carpp;
	 $encabezado = session_name()."=".session_id()."";
?>
<html>
<head>
	<title>Email Entrante</title>
</head>
<frameset rows="50%,50%" border="3" name="filas">
<frame name="image" src="./image.php?<?=$encabezado?>" name="columnas">
 <frameset cols="100,997" name="secundario">
   <frame name="lista" src="menu.php?<?=$encabezado?>" parent="secundario" resize=true border=1> 
   <frame name="formulario" src="login_email.php?<?=$encabezado?>" parent="secundario" resize=true>
 </frameset>
</html>
