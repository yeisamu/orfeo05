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

?>
<table border=0 width="100%"  cellpad=2 cellspacing='0' class="borde_tab" valign='top' align='center' >
    <tr>
        <td width='100%'>
            <table align="center" cellspacing="0" cellpadding="0" width="100%" border="0">
                <tr class="tablas"><td class="etextomenu" >
                        <span class="etextomenu">
                            <?php if (!isset($estado_sal)) $estado_sal = "";
                            if (!isset($estado_sal_max)) $estado_sal_max = "";
                            if (!isset($pagina_sig)) $pagina_sig = ""; ?>
                            <form name=form_busq_rad action='<?= $pagina_actual ?>?<?= session_name() . "=" . session_id() ?>&estado_sal=<?= $estado_sal ?>&tpAnulacion=<? if (isset($tpAnulacion)) $tpAnulacion ?>&estado_sal=<?= $estado_sal ?>&estado_sal_max=<?= $estado_sal_max ?>&pagina_sig=<?= $pagina_sig ?>&dep_sel=<?= $dep_sel ?>&nomcarpeta=<?= $nomcarpeta ?>' method=POST>
                                <label for="busqRadicados">Buscar radicado(s) (Separados por coma)</label>
                                <input name="busqRadicados" id="busqRadicados" type="text" size="60" class="tex_area" value="<? if (isset($busqRadicados)) $busqRadicados ?>" title="Ingrese el numero de radicado completo o una parte de el">
                                <input type=hidden name=estado_sal value='<?= $estado_sal ?>'>
                                <input type=submit value='Buscar ' name=Buscar valign='middle' class='botones' aria-label="Buscar radicados ingresados">
                                <?
                                if (isset($busqRadicados)) {
                                    $busqRadicados = trim($busqRadicados);
                                    $textElements = split(",", $busqRadicados);
                                    $newText = "";
                                    $i = 0;
                                    foreach ($textElements as $item) {
                                        //$item = trim ( $item );
                                        if ($item) {
                                            if ($i != 0)
                                                $busq_and = " or ";
                                            else
                                                $busq_and = " ";
                                            $busq_radicados_tmp .= " $busq_and $varBuscada like '%$item%' ";
                                            $i++;
                                        }
                                    } //FIN foreach
                                    // Validacion para identificar si en el campo de busqueda de anulacion llega algun dato para de esta forma no afectar la query
                                    // By skina jmgamez@skinatech.com
                                    if ($busq_radicados_tmp != '') {
                                        $dependencia_busq2 .= " and $busq_radicados_tmp ";
                                    }
                                    $dependencia_busq2 .= "";
                                } //FIN if ($busqRadicados)
                                ?>
                            </form>
                        </span>
                    </td></tr>
            </table>
<!--        <td/>
    <tr/>-->
</table>
