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
// Report all errors except E_NOTICE, E_DEPRECATED, E_WARNING
error_reporting( E_ALL | E_NOTICE ^ (E_WARNING | E_DEPRECATED));

//Defino variables de entorno para el ambiente de Orfeo
$krd         = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc    = $_SESSION["usua_doc"];
$codusuario  = $_SESSION["codusuario"];

if (isset($_POST["valRadio"]))
{
    $radicadoDig = $_POST["valRadio"];

//Incluyo la libreria del digitalizador
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."class/Digitalizador.php");

//Crago la clase de conexión si no esta definida
$digitalizador = new Digitalizador();
?>
<html>
    <head>
        <title>DIGITALIZACI&Oacute;N DE DOCUMENTOS</title>
        <link rel="stylesheet" href="../estilos/orfeo.css">
        <link rel="stylesheet" href="./css/estilos_dig.css">
        <script type="text/javascript" src="./js/funciones_dig.js"></script> 
        <script src="./js/jquery.js"></script>
    </head>
    <body>
        <div>
            <fieldset>
	         <h4 class="titulos4"><br>
                 <center>
                      ESCOJA LA ACCI&Oacute;N A REALIZAR SOBRE EL RADICADO 
                      <?php echo $radicadoDig;?>
                 </center>
                 </h4>
                 <form id="FormListDig" method="post" action="form_dig_list.php"
                       name="FormListDig" class="center">
                     <?php
                          //Valido si tiene imagen o no el radicado para mostrar
                          //opciones de digitalizacion	
                          if($digitalizador->validaOpcionesAsoc($radicadoDig) != '' ) {
                     ?>
                     <hr>
                     <a id="lnk_remplaza_rad" name="lnk_remplaza_rad"
                         type="button"
                         class="vinculo_dig center" 
                         href="./form_dig_asoc.php?action=reemplazar&radicado=<?php echo $radicadoDig;?>">
                         Remplazar Imagen a Radicado <?php echo $radicadoDig;?>
                     </a>
                     <hr>
                     <?php
                         } if (isset($_POST['asociar']) && $_POST['asociar'] == 'si') {
                     ?>
                     <hr>
                     <a id="lnk_asociar_rad" name="lnk_asociar_rad"
                         type="button"
                         class="vinculo_dig center"
                         href="./form_dig_asoc.php?action=asociar&radicado=<?php echo $radicadoDig;?>">
                         Asociar Imagen a Radicado <?php echo $radicadoDig;?>
                     </a>
                     <hr>
                     <?php
                         }
                     ?>
		     <?php if (isset($_POST['asociar']) && $_POST['asociar'] == 'no') { ?>
                     <hr>
                     <a id="lnk_anexo_rad" name="lnk_anexo_rad"
                         type="button"
                         class="vinculo_dig center"
                         href="./form_dig_asoc.php?action=anexo&radicado=<?php echo $radicadoDig;?>">
                         Subir Anexo a Radicado <?php echo $radicadoDig;?>
                     </a>
		     <?php } ?>
                     <hr>
                 </form> 
                 <center>
                 <!--Botón para volver atras-->
                 <input type='button' 
                        onClick="javascript:window.location='./form_dig_menu.php'" 
                        name='volverDig' value='Volver al Menu'
                        class="btn_cancelar_form center">
                 </center>
                 </form> 
            </fieldset>
        <div>
    </body>
</html>
<?php
} else {

}
?>
