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
include('../sql/faq.php');
include('../funciones/funciones.php');
?>
			<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#1F619B" class="Estilo4">
<? while (!$rs_faq->EOF) { ?>
              <tr>
                <td width="17%"><font color="#FFFFFF"><strong>Pregunta :</strong></font></td>
                <td width="83%" bgcolor="#FFFFFF"><strong><?= utf8_decode($rs_faq->fields['pregunta'])?></strong></td>
              </tr>
              <tr>
                <td><font color="#FFFFFF"><strong>Respuesta :</strong></font></td>
                <td bgcolor="#FFFFFF" align="justify"><?= utf8_decode($rs_faq->fields['respuesta'])?></td>
              </tr>
<? 
$rs_faq->MoveNext();
}
?>
            </table>
