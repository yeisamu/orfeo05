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
    include_once dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config.php";
    require_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler($ruta_raiz);

    $encabezado = "".session_name()."=".session_id()."&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";

  /**
    * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
    *
    * @param char $var
    * @return numeric
    */
    function return_bytes($val)
    {   $val = trim($val);
        $ultimo = strtolower($val{strlen($val)-1});
        switch($ultimo)
        {       // El modificador 'G' se encuentra disponible desde PHP 5.1.0
                case 'g':       $val *= 1024;
                case 'm':       $val *= 1024;
                case 'k':       $val *= 1024;
        }
        return $val;
     }

?>
    <html>
    <head>
    <title>Realizar Transaccion - Orfeo </title>
    <link rel="stylesheet" href="<?=$ruta_raiz?>/estilos/orfeo.css">
    </head>
    <body>
    <br>
<?
    /**
     * Aqui se intenta subir el archivo al sitio original
     *
     */
    include ("$ruta_raiz/include/upload/upload_class.php");
    $max_size = return_bytes(ini_get('upload_max_filesize')); 
    $my_upload = new file_upload;
    $my_upload->language="es";
    $my_upload->upload_dir = "$ruta_raiz/bodega/tmp/"; 
    $my_upload->extensions = array(".crt"); 
    $my_upload->max_length_filename = 50; 
    $my_upload->rename_file = true;

    if(isset($_POST['Realizar'])) {
	$valRadio=$busqRadicados;
	$newFile = $valRadio;
	$tmpFile = trim($_FILES['upload_cert']['name']);
	$fileGrb = substr($valRadio,0,4)."/".substr($valRadio,4,$longitud_codigo_dependencia)."/$valRadio".".".substr($tmpFile,-3);

	$my_upload->the_temp_file = $_FILES['upload_cert']['tmp_name'];
	$my_upload->the_file = $_FILES['upload_cert']['name'];
	$my_upload->http_error = $_FILES['upload_cert']['error'];
	$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; 
	$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; 
	if ($my_upload->upload($newFile)) {
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		$info = $my_upload->get_uploaded_file_info($full_path);
		//include ("firma_radicado_sk.php");
	}else
	{

			die("<table class=borde_tab><tr><td class=titulosError>Ocurrio un Error la Fila no fue cargada Correctamente <p>".$my_upload->show_error_string()."<br><blockquote>".nl2br($info)."</blockquote></td></tr></table>");
	}
}
?>
    <table cellspace=2 WIDTH=60% id=tb_general align="left" class="borde_tab">
    <tr>
	<td colspan="2" class="titulos4">ACCION REQUERIDA </td>
    </tr>
    <tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">ACCION REQUERIDA :
    </td>
	<td  width="65%" height="25" class="listado2_no_identa">
	ASOCIACION DE FIRMA A RADICADO
	</td>
    </tr>
    <tr>
	<td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">RADICADOS INVOLUCRADOS :
	</td>
    <td  width="65%" height="25" class="listado2_no_identa"><?=$valRadio?>
    </td>
    </tr>
    <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">Datos Fila Asociada :
    </td>
    <td  width="65%" height="25" class="listado2_no_identa">
    <?=$info?>
    </td>
    </tr>
    <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">FECHA Y HORA :
    </td>
    <td  width="65%" height="25" class="listado2_no_identa">
    <?=date("m-d-Y  H:i:s")?>
    </td>
    </tr>
    <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">USUARIO ORIGEN:
    </td>
    <td  width="65%" height="25" class="listado2_no_identa">
    <?=$_SESSION['usua_nomb']?>
    </td>
    </tr>
    <tr>
    <td align="right" bgcolor="#CCCCCC" height="25" class="titulos2">DEPENDENCIA ORIGEN:
    </td>
    <td  width="65%" height="25" class="listado2_no_identa">
    <?=$_SESSION['depe_nomb']?>
    </td>
    </tr>
    </table>
    </form>
    </body>
    </html>
