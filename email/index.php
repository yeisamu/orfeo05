<?php
/**
 * En este frame se van cargado cada una de las funcionalidades del sistema
 *
 * Descripcion Larga
 *
 * @category
 * @package      SGD Orfeo
 * @subpackage   Main
 * @author       Community
 * @author       Skina Technologies SAS (http://www.skinatech.com)
 * @license      GNU/GPL <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link         http://www.orfeolibre.org
 * @version      SVN: $Id$
 * @since
 */

        /*---------------------------------------------------------+
        |                     INCLUDES                             |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                    DEFINICIONES                          |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                       MAIN                               |
        +---------------------------------------------------------*/



// Ultima Modificacion Kasandra 2012-10    Agregamos templates documentacion

// error_reporting(E_ERROR | E_PARSE);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

if (!isset($ruta_raiz)) $ruta_raiz = "..";

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
    <link rel="stylesheet" href="../estilos/orfeo.css" />
</head>

<frameset rows="900,30" border="0" name="filas">
<!--    <frame name="image" src="./marco_superior.php?<?=$encabezado?>" name="columnas">-->
    <frameset cols="80,550" name="secundario">
        <frame name="lista" src="menu_buzones.php?<?=$encabezado?>" parent="secundario" resize=true border=1> 
        <frame name="formulario" src="login_email.php?<?=$encabezado?>" parent="secundario" resize=true>
    </frameset>
</html>
