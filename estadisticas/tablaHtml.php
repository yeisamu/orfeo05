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


		
  	require_once($ruta_raiz."/include/myPaginador.inc.php");
	  //$db->conn->debug = true;

  	$paginador=new myPaginador($db,($queryE),$orden);
		$paginador->moreLinks = "$tipoEstadistica=$tipoEstadistica&";

  	if(!isset($_GET['genDetalle'])){
        	$orden=isset($orden)?$orden:"";
        	$paginador->setFuncionFilas("pintarEstadistica");
		 } else {
        	$paginador->setFuncionFilas("pintarEstadisticaDetalle");
        }
        	$paginador->setImagenASC($ruta_raiz."iconos/flechaasc.gif");
        	$paginador->setImagenDESC($ruta_raiz."iconos/flechadesc.gif");
        	//$paginador->setPie($pie);
        	echo $paginador->generarPagina($titulos,"titulos3");
                                                                      
if(!isset($_GET['genDetalle'])&& $paginador->getTotal() > 0){	
    $total=$paginador->getId()."_total";         
	if(!isset($_REQUEST[$total])) {
		$res=$db->query($queryE);
		$datos=0;
		while(!$res->EOF){ 
			  $data1y[]=$res->fields[1];
              $nombUs[]=$res->fields[0];
            $res->MoveNext();	
		}
		$nombYAxis=substr($titulos[1],strpos($titulos[1],"#")+1);
		$nombXAxis=substr($titulos[2],strpos($titulos[2],"#")+1);
		$nombreGraficaTmp = $ruta_raiz."bodega/tmp/E_$krd.png";
		$rutaImagen = $nombreGraficaTmp;
		if(file_exists($rutaImagen)){
			unlink($rutaImagen);
		}
		$notaSubtitulo = $subtituloE[$tipoEstadistica]."\n";
		$tituloGraph = $tituloE[$tipoEstadistica];
		include "genBarras1.php";
	} 	
?>
    <table align="center">
    <tr>
    	<td>
  			<!-- Modificado SGD 21-Agosto-2007
			<input type=button class="botones_largo" value="Ver Grafica" onClick='window.open("image.php?rutaImagen=<?=$rutaImagen."&fechaH=".date("YmdHis")?>" , "Grafica Estadisticas - Orfeo", "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=560,height=720");' />
			-->
			<input type=button class="botones_largo" value="Ver Grafica" onClick='window.open("<?php print $ruta_raiz; ?>/estadisticas/image.php?rutaImagen=<?=$rutaImagen."&fechaH=".date("YmdHis")?>" , "Grafica Estadisticas - Orfeo", "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=560,height=720");' />
		</td>  	
  	</tr> 
  	</table>
<?
}
?>
</center>
</body>
</html>

