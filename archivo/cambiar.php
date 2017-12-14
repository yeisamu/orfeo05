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

 $krdOld = $krd;
$per=1;
session_start();
if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
if (!$dependencia) include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
$db = new ConnectionHandler("$ruta_raiz");
$objHistorico= new Historico($db);
$encabezado = session_name()."=".session_id()."&krd=$krd&nomcarpeta=$nomcarpeta";
?>
<html height=50,width=150>
<head>
<title>Cambio Estado Expediente</title>
<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<body bgcolor="#FFFFFF">

<form name=cambiar action="lista_expediente.php?<?=$encabezado?>" method='get'>
<?
$dat=date("Y-m-d");
$sqle="update SGD_EXP_EXPEDIENTE set SGD_EXP_ARCHIVO='$est',SGD_EXP_FECHFIN='$dat' where SGD_EXP_NUMERO LIKE '$expediente'";
$rs=$db->query($sqle);
$arrayRad[0]=$numRad;
$isqlDepR = "SELECT USUA_CODI
			FROM usuario
			WHERE USUA_LOGIN = '$krd'";
	$rsDepR = $db->conn->Execute($isqlDepR);
	$codusua = $rsDepR->fields['USUA_CODI'];
if ($est==2){
	$observa = "Se Cerro el Expediente  ";
	$objHistorico->insertarHistoricoExp($expediente,$arrayRad,$dependencia, $codusua,$observa,58,1);
?>
<center> <b> El Expediente fue Cerrado<b>
<?
}
if ($est==1){
	$observa = "Se Reabrio el Expediente  ";
	$objHistorico->insertarHistoricoExp($expediente,$arrayRad,$dependencia, $codusua,$observa,59,1);
?>

<center>El Expediente fue Reabierto
<?
}
?>

<input type="button" value="Cerrar" class="botones_mediano" onclick="opener.regresar();window.close()">
</center>
</form>
</html>
