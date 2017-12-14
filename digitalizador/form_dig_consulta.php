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
error_reporting( E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED));

//Defino variables de entorno para el ambiente de Orfeo
$krd         = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc    = $_SESSION["usua_doc"];
$codusuario  = $_SESSION["codusuario"];

if (isset($_POST["radicadoDig"]))
{
   $radicadoDig = $_POST["radicadoDig"];
}

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
                      <center>DIGITE EL NUMERO DEL RADICADO, PARA CONSULTAR
                      </center>
                 </h4>
                 <center>
                 <!--Formulario de consulta-->
                 <form id="FormConsultaDig" method="post"
                       action="./form_dig_consulta.php"
                       name="FormConsultaDig" class="center">
                     <input id="radicadoDig" name="radicadoDig"
                         type="text"
                         class="center"> 
                 </form>
                 <hr>
                 <!--Fin formulario de consulta-->
                 <!--Formulario -->
                 <form id="FormEnvioConsultaDig" method="post"
                       action="./form_dig_desic.php"
                       name="FormEnvioConsultaDig" class="center">
                     <?php
                          //Muestro tabla del radicado encontrado o no
                          if (isset($_POST["radicadoDig"]))
                          {	
                              //Imprimo listado con el radicado si se encontro
                              echo "
                              <center>
                              <!--Botón para digitalizar-->
                              <input type='button' 
                              onClick='
                              checkSelectedRecord(\"#FormEnvioConsultaDig\")' 
                              name='enviaDig' value='Asociar Imagen'
                              class='btn_aceptar_form center'>
                              </center>";
                              $digitalizador->listaRadConsulta($radicadoDig);
                          }
                     ?>
                     <hr>
                 </form> 
                 <center>
                 <!--Botón para digitalizar-->
                 <input type='button' 
                        onClick='enviar_formulario("#FormConsultaDig")' 
                        name='enviaDig' value='Buscar Radicado'
                        class="btn_aceptar_form center">
                 <!--Botón para volver atras-->
                 <input type='button' 
                        onClick="javascript:window.location='./form_dig_menu.php'" 
                        name='volverDig' value='Volver al Menu'
                        class="btn_cancelar_form center">

                 </center>
            </fieldset>
        <div>
    </body>
</html>
