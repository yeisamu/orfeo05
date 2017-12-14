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


session_start();
/**
 * Modulo de consulta Web para atencion a Ciudadanos.
 * @autor Sebastian Ortiz
 * @fecha 2012/06
 *
 */

/*Ultima modificacion CAMILO PINTOR 11-12-2013 inci*/
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;
define('ADODB_ASSOC_CASE', 1);

$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include "../config.php";
$_SESSION["depeRadicaFormularioWeb"]=$depeRadicaFormularioWeb;  // Es radicado en la Dependencia 900
$_SESSION["usuaRecibeWeb"]=$usuaRecibeWeb; // Usuario que Recibe los Documentos Web
$_SESSION["secRadicaFormularioWeb"]=$secRadicaFormularioWeb; // Osea que usa la Secuencia sec_tp2_900
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;

/*include('./captcha/simple-php-captcha.php');
$_SESSION['captcha_consulta'] = captcha();*/
//Revisar si se envio el formulario
if(isset($numeroRadicado)){
	$fechah = date("dmy") . "_" . time("hms");
	$usua_nuevo=3;
	if ($numeroRadicado)
	{
		$numeroRadicado = str_replace("-","",$numeroRadicado);
		$numeroRadicado = str_replace("_","",$numeroRadicado);
		$numeroRadicado = str_replace(".","",$numeroRadicado);
		$numeroRadicado = str_replace(",","",$numeroRadicado);
		$numeroRadicado = str_replace(" ","",$numeroRadicado);
		include "$ruta_raiz/include/tx/ConsultaRad.php";
		$ConsultaRad = new ConsultaRad($db);
		$idWeb = $ConsultaRad->idRadicado($numeroRadicado);
		//Skina
		//MOdificacion no se usa codigo de verificacion
		//if($numeroRadicado==$idWeb and substr($numeroRadicado,-1)=='2' && (strcasecmp ($captcha ,$_SESSION['captcha_consulta']['code'] ) == 0))
		if($numeroRadicado==$idWeb and (substr($numeroRadicado,-1)=='2' or substr($numeroRadicado,-1)=='4'))
		{
			$ValidacionWeb="Si";
			$idRadicado = $idWeb;
		}
		else
		{
			$ValidacionWeb="No";
			$mensaje = "El numero de radicado digitado no existe, el codigo de verificacion no corresponde o esta mal escrito o la imagen de verificacion no fue bien digitada.  Por favor corrijalo e intente de nuevo.";
			echo "<center><font color=red class=tpar><font color=red size=3>$mensaje</font></font>";
			echo "<script>alert('$mensaje');</script>";
		}
	}
	$krd = "usWeb";
	$datosEnvio = "$fechah&".session_name()."=".trim(session_id())."&ard=$krd";
	$ulrPrincipal = "Location: principal.php?fechah=$datosEnvio&pasar=no&verdatos=no&idRadicado=$idRadicado&estadosTot=".md5(date('Ymd'));
	header($ulrPrincipal);
	return ;
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title><?=$entidad_largo ?>Consulta Web PQRS</title>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!-- CSS -->
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- CSS -->
<link rel="stylesheet" href="css/structure2.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />

<!--Skina
    Se modifica no se usa esat libreria-->
<!-- JavaScript 
<script type="text/javascript" src="js/wufoo.js"></script>-->
<!-- prototype 
<script type="text/javascript" src="js/prototype.js"></script>-->
<!--funciones
<script type="text/javascript" src="js/orfeo.js"></script>-->
<script type="text/javascript">
function loginTrue()
{
        document.formulario.submit();
}

function validar_formulario(){
        var formulario = document.getElementById('consultaweb');
        var error = 0;
        var mensaje = "Verifique los siguientes errores:\n\n";
        if(formulario.numeroRadicado.value.length < 14){
                error = 1;
                mensaje += "-Número de radicado debe ser de 14 digitos\n";

        }
	
	if(error > 0){
                alert(mensaje);
                return false;
        }else{
                return true;
        }
}

</script>
</head>

<body id="public">
<div id="container">
<h1>&nbsp;</h1> 
       <form id="consultaweb" class="wufoo topLabel" autocomplete="on" enctype="multipart/form-data" method="POST" action="<?=$_SERVER['PHP_SELF']?>" name="consultaweb">
                <div class="info">
                       <center> <img src="../logoEntidad.png" width="30%" height="30%" align="center"/></center>
                        <p>
                                <br> Se&ntilde;or Ciudadano al diligenciar el formulario, tenga en cuenta lo siguiente: </br>
                                <br> S&oacute;lo podr&aacute; consultar radicados conociendo el numero de radicado que se genero al crear la solicitud.</br>
                        </p>
                </div>
                <ul>
			<fieldset>
			<h4>CONSULTA SOLICITUD</h4>
                        <div id="foli3">
                                <label class="desc" id="lbl_radicado" for="numeroRadicado">N&uacute;mero de Radicado (s&oacute;lo n&uacute;meros) <font color="#FF0000">*</font></label>
                                <div><input id="numeroRadicado" name="numeroRadicado" type="text" class="field text small" value="" maxlength="16" tabindex="1" /></div>
                        </div>
                        <div class="buttons">
                                <input id="saveForm" type="submit" value="Consultar" onclick="return validar_formulario();" />
                                <input name="button" type="reset" id="button" onclick="window.close();" value="Cancelar" />
                        </div>
			</fieldset>
                </ul>
        </form>
</div>
<!--container-->
</body>

</html>
