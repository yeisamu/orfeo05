<?php
/************************************************************************
# PROYECTO: Orfeo    MODULO: Email - index.php     FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
#  Inicio del lector de Correo electronico                              *
#                                                                       *
#  Despliega tres marcos, arriba para ver los correos, a la izquierda   *
#  se ven las carpetas del buzon y abajo el lista de correos en el      *
#  INBOX                                                                *
#                                                                       *
#************************************************************************
# AUTOR DE ESTE MODULO:  Orfeo                                          *
#************************************************************************
# AUTORES DEL Superintendencia de Servicios Publicos D. de Colombia     *
#  PROYECTO:  Infometrika, Iyunxi y SkinaTech                           *
#             Comunidades Correlibre y Orfeolibre                       *
#************************************************************************
# LICENCIA: GNU/GPL                                                     *
#***********************************************************************/

// Ultima Modificacion Kasandra 2012-10    Agregamos templates documentacion

// error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

if (!$ruta_raiz) $ruta_raiz = "..";

  //cho "<hr>--".$_SESSION['dependencia']." --";
  /* if(!$dependencia or !$krd) 
   //{
//    echo "<hr>--".$_SESSION['dependencia']." --";
    echo "No se ha podido Iniciar Session";
    //      include "../rec_session.php";
   }
   $carpeta=$carpetano;
   $tipo_carp = $tipo_carpp;*/



        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

$TIT_Email_Entra="Email Entrante";


        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

$encabezado = session_name()."=".session_id()."";

?>
<html>
<head>
    <title><? echo $TIT_Email_Entra ?></title>
</head>
<frameset rows="50%,50%" border="3" name="filas">
    <frame name="image" src="./marco_superior.php?<?=$encabezado?>" name="columnas">
    <frameset cols="100,997" name="secundario">
        <frame name="lista" src="menu_buzones.php?<?=$encabezado?>" parent="secundario" resize=true border=1> 
        <frame name="formulario" src="login_email.php?<?=$encabezado?>" parent="secundario" resize=true>
    </frameset>
</html>
