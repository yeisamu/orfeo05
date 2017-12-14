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
$ruta_raiz = "..";

if (!isset($_SESSION['dependencia']))
    include "$ruta_raiz/rec_session.php";

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
function return_bytes($val) {
    $val = trim($val);
    $ultimo = strtolower($val{strlen($val) - 1});
    switch ($ultimo) { // El modificador 'G' se encuentra disponible desde PHP 5.1.0
        case 'g': $val *= 1024;
        case 'm': $val *= 1024;
        case 'k': $val *= 1024;
    }
    return $val;
}
?>
<html>
    <head>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    </head>
    <body bgcolor="#FFFFFF" topmargin="0">
        <script language="JavaScript" type="text/JavaScript">

            /**
            * Valida que el formulario desplegado se encuentre adecuadamente diligenciado
            */
            function validar() {

            archCSV = document.formAdjuntarArchivos.archivoCsv.value;

            var extension = archCSV.split('.').pop().toLowerCase();
            var allowed = ['xls', 'xlsx'];

            if(allowed.indexOf(extension) === -1) {
            // Not valid.
            alert ( "El archivo de datos debe tener formato .xls(x)" );
            return false;
            }

            //if ( (archCSV.substring(archCSV.length-1-4,archCSV.length)).indexOf(".xlsx") == -1 ||
            //	(archCSV.substring(archCSV.length-1-3,archCSV.length)).indexOf(".xls") == -1 ) {


            //}

            if (document.formAdjuntarArchivos.archivoCsv.value.length<1){
            alert ("Debe ingresar el archivo XLSX");
            return false;
            }

            return true;
            }

            function enviar() {

            if (!validar())
            return;

            document.formAdjuntarArchivos.accion.value="PRUEBA";
            document.formAdjuntarArchivos.submit();
            }

        </script>

        <?
        $phpsession = session_name() . "=" . session_id();


        $params = $phpsession . "&krd=$krd&dependencia=$dependencia&codiTRD=$codiTRD&depe_codi_territorial=$depe_codi_territorial&usua_nomb=$usua_nomb&depe_nomb=$depe_nomb&usua_doc=$usua_doc&tipo=$tipo&codusuario=$codusuario";
        ?>  <br>
        <form action="adjuntar_masiva.php?<?= $params ?>" method="post" enctype="multipart/form-data" name="formAdjuntarArchivos">
            <input type=hidden name=pNodo value='<?= $pNodo ?>'>
            <input type=hidden name=codProceso value='<?= $codProceso ?>'>
            <input type=hidden name=tipoRad value='<?= $tipoRad ?>'>
            <center>
                <div id="titulo" style="width: 43%;" align="center">Adjuntar base de datos para certificaciones</div>
            <table width="43%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                <tr align="center">
                    <td class="titulos2"><label for="archivoCsv">XLSX</label></td>
                    <td height="30" class="listado2" colspan="2">
                                 <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo return_bytes(ini_get('upload_max_filesize')); ?>">
                        <input name="accion" type="hidden" id="accion">
                        <input name="archivoCsv" type="file" class="tex_area" id="archivoCsv" title="Presione espacio para abrir ventana y adjuntar el archivo CSV" value='<?= $archivoCsv ?>'>
                    </td>
                </tr>
                <tr align="center">
                    <td height="30" colspan="2" class="listado1">
                        <input name="enviaPrueba" type="button" class="botones" id="envia22" onClick="enviar();" value="Cargar DB">
                    </td>
                    <td class="listado1">
                        <div class="alertaFlotante">
                    <h5>&nbsp;Ejemplo archivo base:<a href="ejemplo.xls" target="_blank" class="vinculosCabezote"> XLS ejemplo</a>.</h5>
                </div>
                    </td>
                </tr>
                </table>
                </center>
                </form>
                <!--<blockquote>-->
                <div class="alertaFlotante" style="width: 65%;">
                    <h5><strong>Nota.</strong> Esta operaci&oacute;n borrara todos los datos existentes e insertara los proveídos en 
                            la hoja de cálculo. Por favor tenga cuidado con esta opci&oacute;n ya
                            que se realizar&aacute; cambios irreversibles en la base de datos.</h5>
                </div>
                <!--</blockquote>-->
                </body>
                </html>
