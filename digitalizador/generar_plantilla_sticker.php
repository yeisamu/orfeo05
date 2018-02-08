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

//Incluyo la libreria del digitalizador
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."class/Digitalizador.php");

//Crago la clase de conexión si no esta definida
$digitalizador = new Digitalizador();

?>
<html lang="es">
<head>
    	<title>Impresi&oacute;n de Sticker</title>
	<link rel="stylesheet" href="../estilos/orfeo.css">
        <link rel="stylesheet" href="./css/estilos_dig.css" >
        <script type="text/javascript" src="./js/funciones_dig.js"></script> 
        <script src="./js/jquery.js"></script>
	<script type="text/javascript" src="./js/jquery-barcode.js"></script>
</head>
<body id='grid'>
<page size="A4"></page>
<div id='div_grid'>
	<tr>
	<?php
		//print "<div id='div_grid'>";
		for ($i=0;$i<22;$i++) {
			if ($i % 2 == 0) {
				$column='left_col';
			} else {
				$column='right_col';
			}
			print "<div id='sticker".$i."' name='sticker".$i."' class='div_sticker ".$column."' 
				onclick='detectClick(\"#sticker".$i."\", ".$i.", \"".$_GET['radicado']."\")'>
				</div> ";
		}
		//print "</div>";
	?>
	</tr>
</div>
</body>
</html>
