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
if (!$ruta_raiz)
    $ruta_raiz = "..";
$isqlC = 'select 
			radi_nume_deri        AS "DERIVADO"
			, radi_tipo_deri      AS "TIPO"
			from 
			   RADICADO
	   		where radi_nume_radi    = \'' . $verrad . "'";
error_reporting(7);
?>
<TABLE class="borde_tab">
    <tr>
        <td>
            <b>
            Documento vinculado al radicado No. <?= $verrad ?>
            </b>
        </td>
    </tr>
</table>
<br>
<table class=borde_tab width="100%" cellpadding="0" border="1" cellspacing="5">
    <tr class="titulos3" align="center">
        <td width="20%"  >Tipo</td>
        <td width="30%"  >Radicado vinculado</td>
        <td width="30%"  >Acción</td>
    </tr>
    <?php
    $rsC = $db->query($isqlC);
    $numRadiVin = $rsC->fields["DERIVADO"];
    if ($numRadiVin != '') {
        $tipVinculo = $rsC->fields["TIPO"];
        $numRadiVin = $rsC->fields["DERIVADO"];
        ?> 
        <td class="listado4"> <?= $tipVinculo ?> </td>
        <td class="listado4"> <?= $numRadiVin ?> </td>
        <td  <? if (!$rsC->fields["DERIVADO"]) echo " class='celdaGris ' ";
    else echo " class='e_tablas ' "; ?>  > 
            <?php
            echo "<a href=javascript:borrarArchivo('$verrad','si')><span class='botones_largo'>&nbsp;Borrar Vinculo&nbsp;</a> ";
            ?> 

        </td>
    </tr>
    <?
}
?>
</table>
