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
// Report runtime errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

//Defino variables de entorno para el ambiente de Orfeo
$krd         = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc    = $_SESSION["usua_doc"];
$codusuario  = $_SESSION["codusuario"];

//Valido si viene la variables de tipo de radicado del select
if (!isset($_POST["tipo_radicado"])) {
    $tipo_rad = 2;
} else {
    $tipo_rad = $_POST["tipo_radicado"]; 
}

//Valido si viene la variable de códgio de dependencia del select
if (!isset($_POST["codigo_dependencia"])) {
    $codigo_dependencia = $dependencia;
} else {
    $codigo_dependencia = $_POST["codigo_dependencia"]; 
}

//Obtengo por get si selecciono anexo o asociar imagen
if (isset($_GET['asociar']))
$operacion_seleccionada = $_GET['asociar'];

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
                      <center>DIGITALIZACI&Oacute;N DE DOCUMENTOS</center>
                 </h4>
                 <!--Formulario listas seleccionable dependencia y tipo radicado-->
                 <form id="FormListDig" method="post" action=""
                       name="FormListDig" class="center">
                     <hr>
                         <label class="titulos5" id="title_codigo_dependencia"
                                for="codigo_dependencia">Seleccione Dependencia:  
                         </label>
                     <?php
                          //Genero el select de las dependencias	
                          $digitalizador->traeListaDependencia($codigo_dependencia);
                     ?>
                         <label class="titulos5" id="title_tipo_radicado"
                                for="tipo_radicado">Seleccione Tipo Radicado:  
                         </label>
                     <?php
                          //Genero el select de los tipos de radicación
                          $digitalizador->traeListaTipoRad($tipo_rad);
                     ?>
			<div>
			<label class="titulos5" id="title_buscar_radicado"
                                for="buscar_radicado">Ingrese un numero de Radicado:  
                        </label>

			<input type="text" id="buscar_radicado" name="buscar_radicado"/>
			<input type="button" class="btn_aceptar_form" id="procesar_busqueda" 
			name="procesar_busqueda" value="Consultar" onClick="enviar_formulario('#FormListDig')"/>
			</div><br/>
                 </form> 
            <!--Fin Formulario listas seleccionable dependencia y tipo radicado-->
                 <center>
		 <div>
                 <!--Botón para digitalizar-->
		<?php if (isset($_GET['asociar']) && $_GET['asociar']=='si') {?>
                 	<input type='button' 
                        onClick='addFormAttribute("#FormDigSeleccion");checkSelectedRecord("#FormDigSeleccion");' 
                        name='enviaDig' value='Asociar Imagen'
                        class="btn_aceptar_form center">
		<?php } elseif (isset($_GET['asociar']) && $_GET['asociar']=='no') {?>
			<input type='button' 
                        onClick='addFormAttribute("#FormDigSeleccion");checkSelectedRecord("#FormDigSeleccion");' 
                        name='enviaDig' value='Anexar Imagen'
                        class="btn_aceptar_form center">
		<?php } elseif (isset($_GET['asociar']) && $_GET['asociar']=='reemplazar') {?>
			<input type='button' 
                        onClick='addFormAttribute("#FormDigSeleccion");checkSelectedRecord("#FormDigSeleccion");' 
                        name='enviaDig' value='Reemplazar Imagen'
                        class="btn_aceptar_form center">
		<?php } else {?>
			<a type='button' href='' 
                        onClick='addFormAttribute("#FormDigSeleccion");checkSelectedRecord("#FormDigSeleccion");' 
                        id='print' name='print'
                        class="btn_aceptar_form center"
			target="_blank">Imprimir Sticker</a>
		<?php } ?>
                 <!--Botón para volver atras-->
                 <input type='button' 
                        onClick="javascript:window.location='./form_dig_menu.php'" 
                        name='volverDig' value='Volver al Menu'
                        class="btn_cancelar_form center">
		 </div>
                 </center>
                 <br>
                 <!--Formulario lista digitalización-->
                 <form id="FormDigSeleccion" method="post"
                       action="" name="FormDigSeleccion"
                       class="center">
                     <?php
                          if (isset($_GET['asociar']) && ($_GET['asociar']=='no' || $_GET['asociar']=='reemplazar')) {
                              /**MUestro la tabla con radicados sin imagen**/
                              $digitalizador->listaRadImagen($tipo_rad,$codigo_dependencia, $_POST['buscar_radicado']); 
                          } else {
                              /**MUestro la tabla con radicados sin imagen**/
                              $digitalizador->listaRadSinImagen($tipo_rad,$codigo_dependencia, $_POST['buscar_radicado']);
                          }
                     ?>
			<input type="hidden" id="asociar" name="asociar" value="<?=$operacion_seleccionada?>"/>
                 </form> 
                 <!--Fin Formulario lista digitalización-->
            </fieldset>
        <div>
    </body>
</html>
