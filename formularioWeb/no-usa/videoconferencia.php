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


include('../adodb/adodb.inc.php');
include('../conecta/conecta.php');
include('../sql/sala_prensa_doc.php');
include('../funciones/funciones.php');

while(!$rs_documentos->EOF)
	 {
		?>
         <tr>
            <td class="Estilo4" align="justify">
			  <br><br>
			  <strong><?= utf8_decode($rs_documentos->fields["titulo"])?></strong>
					<br>
					<a href="data/<?=utf8_decode($rs_documentos->fields["vinculo"])?>">Ver</a>					
			</td>
         </tr>
	  <?
	  $rs_documentos->MoveNext();
	  }
?>
