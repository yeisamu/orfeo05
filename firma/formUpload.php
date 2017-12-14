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


/**
* Administrador de Firmas Digitales
* Sistema de gestion Documental ORFEO.
* Permite subir un documento y un certificado para posteriormente firmarlo digitalmente
*/

    session_start(); 
    $ruta_raiz = ".."; 
    
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $usua_doc = $_SESSION["usua_doc"];
    $codusuario = $_SESSION["codusuario"];
    
    if($_REQUEST["busqRadicados"]) $busqRadicados=$_REQUEST["busqRadicados"];

echo "busq $busqRadicados";
    //valido sesion
     if(!$_SESSION['dependencia'])        include "$ruta_raiz/rec_session.php";

    require_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler($ruta_raiz);

    $encabezado = "".session_name()."=".session_id()."&krd=$krd&busqRadicados=$busqRadicados";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";
 
   /**
    * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
    *
    * @param char $var
    * @return numeric
    */
    function return_bytes($val)
    {	$val = trim($val);
	$ultimo = strtolower($val{strlen($val)-1});
	switch($ultimo)
	{	// El modificador 'G' se encuentra disponible desde PHP 5.1.0
		case 'g':	$val *= 1024;
		case 'm':	$val *= 1024;
		case 'k':	$val *= 1024;
	}
	return $val;
     }
?>
    <html>
    <head>
    <title>Subir Datos</title>
    <link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
    <script>

    function validar()
    {	
    if (document.realizarTx.upload_cert.value.length == 0)
		{	alert('Seleccione el documento');
			document.realizarTx.upload_cert.focus();
			return false;
		}
		else return true;
    }

    </script>
    </head>
    <body bgcolor="#FFFFFF" topmargin="0" >
    <form action="uploadTx.php?<?=$encabezado?>" method="post" name="realizarTx" enctype="multipart/form-data">
    <table width="98%" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
	<TR>
	<TD width=30% class="titulos4">	USUARIO:<br><br><?=$_SESSION['usua_nomb']?>
	</TD>
	<TD width='30%' class="titulos4">DEPENDENCIA:<br><br><?=$_SESSION['depe_nomb']?><br>
	</TD>
	<td class="titulos4">Asociacion de Firma Radicado<BR></td>
	<td width='5' class="grisCCCCCC">
	<input type="submit" value="Realizar" name="Realizar" align="bottom" class="botones" id="Realizar" onclick="return validar();">
	</td>
	</TR>
	<tr align="center">
	<td colspan="4" class="celdaGris" align=center><br>
	</td>
	</tr>
	<tr>
	<td colspan=5 align="center">
  	<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo return_bytes(ini_get('upload_max_filesize')); ?>"><br>
	<span class="leidos"><label for="upload_file">Seleccione un Archivo (pdf o odt Tama&ntilde;o Max. <?=ini_get('upload_max_filesize')?>)</label>
	<input type="file" id="upload_file" name="upload_file" size="50" class=tex_area ></span>
	<span class="leidos"><label for="upload_cert">Seleccione un Certificado (crt)</label>
	<input type="file" id="upload_cert" name="upload_cert" size="50" class=tex_area ></span>
	<input type="hidden" name="valRadio" value="<?=$valRadio?>" title="Boton para seleccionar el radicado">
 	</td>
  	</tr>
	</TABLE>
    </form>
    </body>
    </html>
