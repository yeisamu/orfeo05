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



//Variables de sesion de php
session_start();

//Defino variables de entorno para el ambiente de Orfeo
if (!isset($ruta_raiz)) $ruta_raiz="..";
$krd         = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc    = $_SESSION["usua_doc"];
$codusuario  = $_SESSION["codusuario"];

//Incluyo las libreria adodb para conectar a la bd
require_once("$ruta_raiz/include/db/ConnectionHandler.php");

//Crago la clase de conexión si no esta definida
if (!isset($db)) $db = new ConnectionHandler("$ruta_raiz");

//Definimos como se hara el fetch dela data en adodb
//la llave del array sera el nombre de la columna de la tabla
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

?>
<html>
    <head>
        <title>DIGITALIZACI&Oacute;N DE DOCUMENTOS</title>
        <link rel="stylesheet" href="../estilos/orfeo.css">
        <link rel="stylesheet" href="./css/estilos_dig.css">
    </head>
    <body>
        <div>
            <fieldset>
			 <h4 class="titulos4"><br>
                      <center>DIGITALIZACI&Oacute;N DE DOCUMENTOS</center>
                 </h4>
                 <form id="FormDigiUpload" enctype="multipart/form-data" 
                     method="post" action="form_dig_list.php" name="FormDigiUpload"
                     class="center">
                     <hr>
                     <a id="lnk_list_rad" name="lnk_list_rad" type="button"
                         href="./form_dig_list.php?action=listar&asociar=si" class="vinculo_dig center">
                         Asociar Imag&eacute;nes</a>
		     <hr>
                     <a id="lnk_list_rad" name="lnk_list_rad" type="button"
                         href="./form_dig_list.php?action=listar&asociar=no" class="vinculo_dig center">
                         Subir Anexos</a>

                     <hr>
                     <a id="lnk_asoc_img" name="lnk_asoc_img" type="button"
                         href="./form_dig_list.php?action=listar&asociar=reemplazar" class="vinculo_dig center">
                         Modificar Imagen</a>
                     <hr>
                     <a id="lnk_stick_web" name="lnk_stick_web" type="button"
		         href="./form_dig_list.php?action=imprimir&asociar=print" class="vinculo_dig center">
                         Sticker Web Radicaci&oacute;n</a>
                     <hr>
                 </form> 
            </fieldset>
        <div>
    </body>
</html>
