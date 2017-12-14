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
   error_reporting(0);
   session_start();
   if(!$krd) $krd=$krdOsld;
   $ruta_raiz = "..";
   if(!$_SESSION['dependencia'] or !$_SESSION['tpDepeRad']) include "$ruta_raiz/rec_session.php";
   if(!$carpeta) {
      $carpeta = $carpetaOld;
      $tipo_carp = $tipoCarpOld;
   }
   $verrad = "";
   include_once "$ruta_raiz/include/db/ConnectionHandler.php";
   $db = new ConnectionHandler($ruta_raiz);	 
/*********************************************************************************
 *       Filename: menu_prestamo.php
 *       Modificado: 
 *          1/3/2006  IIAC  Men� del m�dulo de pr�stamos. Carga e inicializa los
 *                          formularios.  
 *********************************************************************************/
   // prestamo CustomIncludes begin
   include ("common.php");   
   // Save Page and File Name available into variables
   $sFileName = "menu_prestamo.php";
   // Variables de control   
   $opcionMenu=strip(get_param("opcionMenu")); 
?>
<html>
<head>
   <title>Archivo - Manejo de prestamos y devoluciones</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<body class="PageBODY">
    <br>
   <form method="post" action="prestamo.php" name="menu"> 
      <input type="hidden" name="opcionMenu" value="1">      
      <input type="hidden" name="sFileName" value="<?=$sFileName?>"> 
      <input type="hidden"  value='<?=$krd?>' name="krd">
      <input type="hidden" value=" " name="radicado">  	          
      <script>
         // Inicializa la opcion seleccionada
         function seleccionar(i) {
            document.menu.opcionMenu.value=i;
            document.menu.submit();
	     }
  	     var opcionM='<?=$opcionMenu?>';
	     if(opcionM!=""){ seleccionar(opcionM); }
      </script>
      <center>
        <div id="titulo" style="width: 31%;" align="center">Prestamo y Control de Documentos</div>
      <table width="31%" border="1" cellpadding="0" cellspacing="5" class="borde_tab" align="center">
         <tr>
            <td class="listado1">1. <a class="vinculos" href="javascript:seleccionar(1);">Prestamo de documentos</a></td>   
         </tr>
         <tr>
            <td class="listado2">2. <a class="vinculos" href="javascript:seleccionar(2);">Devolución de documentos</a></td>   	  
         </tr>
         <tr>
            <td class="listado1">3. <a class="vinculos" href="javascript:seleccionar(0);">Generación de reportes</a></td>   	  	  
         </tr>
         <tr>
            <td class="listado2">4. <a class="vinculos" href="javascript:seleccionar(3);">Cancelar solicitudes</a></td>   
         </tr>
      </table>
      </center>
   </form>  
</body>
</html>
