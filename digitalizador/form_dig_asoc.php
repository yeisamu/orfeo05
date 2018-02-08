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

//Valido que venga la accion y el radicado para hacer las tareas de digitalización
if (((isset($_GET["radicado"]) && isset($_GET["action"])
    && $_GET["radicado"] != "" && $_GET["action"] != ""))
    || (isset($_POST["radicadoDig"]) && isset($_POST["action"])
    && $_POST["radicadoDig"] != "" && $_POST["action"] != ""))
{
    if (isset($_GET["radicado"]))
    {
        $radicadoDig = $_GET["radicado"];
        $accion      = $_GET["action"];
    } elseif (isset($_POST["radicadoDig"])) {
        $radicadoDig = $_POST["radicadoDig"];
        $accion      = $_POST["action"];        
        $observa     = trim($_POST["observa"]); 
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
        <script src="./js/jquery.js"></script>
        <script type="text/javascript" src="./js/funciones_dig.js"></script> 
    </head>
    <body>
        <div>
            <fieldset>
	         <h4 class="titulos4"><br>
                 <center>
                      ENV&Iacute;O IMAGEN A RADICADO <?php echo $radicadoDig;?>
                 </center>
                 </h4>
                 <form id="FormUploadDig" method="post" action="form_dig_asoc.php"
                       name="FormUploadDig" class="center" 
                       enctype="multipart/form-data">
                     <center>
                         <table width="500"  border=0 align="center" 
                                bgcolor="White">
                             <tr bgcolor="White">
                                 <td width="100">
                                     <img src="../iconos/tuxTx.gif"
                                          alt="Tux Transaccion"
                                          title="Tux Transaccion">
                                 </td>
                                 <td align="left">
                                     <label for="observa" class="leidos">
                                            Observaciones :
                                     </label>
                                     <textarea name="observa" id="observa" 
                                               cols="70" rows="3"
                                               value=""
                                               class="tex_area">
                                     </textarea>
                                 </td>
                             </tr>
                             <tr>
                                 <td colspan=5 align="center">
                                     <input type="hidden" name="MAX_FILE_SIZE"
                                            value="<?php echo $digitalizador->return_bytes(ini_get('upload_max_filesize')); ?>"><br>
                                     <span class="leidos">
                                         <label for="upload">
                                                Seleccione un Archivo (pdf Tama&ntilde;o Max. <?=ini_get('upload_max_filesize')?>)
                                         </label>
                                         <input type="file" id="upload"
                                                name="upload" size="50" 
                                                class="tex_area"
                                                accept="application/pdf" 
                                                title="Permite abrir una ventana para buscar el archivo en el equipo para  asociarlo al radicado o radicados seleccionados">
                                     </span>
                                        <input type="hidden" name="radicadoDig"
                                               value="<?=$radicadoDig?>"
                                        title="Campo oculto con numero radicado">
                                        <input type="hidden" name="action"
                                               value="<?=$accion?>"
                                        title="Campo oculto con accion a realizar">
                                </td>
                             </tr>

                         </table>
                     </center>
                     <?php
                          //Valido si tiene imagen o no el radicado para mostrar
                          //opciones de digitalizacion
                          if($accion == "asociar" && isset($_POST["observa"]))
                          {
                              $codTx = 42;
                              echo $digitalizador->cargarImagenPrincipal(
                                              $radicadoDig, $dependencia,
                                              $codusuario, $observa,
                                              $codTx, $accion, $usua_doc, $krd);
                              
                          
                     ?>
                     <hr>
                     <?php
                         } elseif($accion == "reemplazar" && isset($_POST["observa"])) {
                             $codTx = 23;
                             echo  $digitalizador->reemplazarImagenPrincipal(
                                              $radicadoDig, $dependencia,
                                              $codusuario, $observa,
                                              $codTx, $accion, $usua_doc);
                     ?>
                     <hr>
                     <?php
                         } elseif ($accion == 'anexar' && isset($_POST["observa"])) {
				$codTx = 29;
				$archivo = $_POST['upload'];
                             	echo  $digitalizador->anexarArchivo(
                                        $radicadoDig, $dependencia,
                                        $codusuario, $_SESSION['codigo_departamento'],
					$_SESSION['codigo_municipio'], $observa,
                                        $usua_doc, $codTx, $archivo, $_SESSION['krd']);
                     ?>
                     <hr>
		     <?php
			}
		     ?>
                     <hr>
                 </form> 
                 <center>
                 <!--Botón para digitalizar-->
		 <?php
		     if (isset($_GET['action']) && $_GET['action'] == 'asociar') {
		 ?>
                     	<input type='button' 
                             onClick='enviar_formulario("#FormUploadDig")' 
                             name='enviaDig' value='Asociar Imagen'
                             class="btn_aceptar_form center">
		 <?php
		    } elseif (isset($_GET['action']) && $_GET['action'] == 'anexar') {
		 ?>
			<input type='button' 
                             onClick='enviar_formulario("#FormUploadDig")' 
                             name='enviaDig' value='Anexar'
                             class="btn_aceptar_form center">
		<?php
		    } elseif (isset($_GET['action']) && $_GET['action'] == 'reemplazar') {
		?>
			<input type='button' 
                             onClick='enviar_formulario("#FormUploadDig")' 
                             name='enviaDig' value='Reemplazar Imagen'
                             class="btn_aceptar_form center">
                <?php
                    }
                ?>
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
