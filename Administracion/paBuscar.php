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
<br>
<table border=2  cellpad=2 cellspacing='0' width=100% class='t_bordeGris' valign='top' align='center' >
    <tr>
    <tr/>
    <tr><td width='100%'>
            <table width="100%" align="center" cellspacing="0" cellpadding="0">
                <tr class="tablas">
                    <td class="etextomenu" >
                <!--<span class="etextomenu">-->
                        <?php if (!isset($estado_sal)) $estado_sal = '';
                        if (!isset($tpAnulacion)) $tpAnulacion = '';
                        if (!isset($estado_sal_max)) $estado_sal_max = ''; ?>
<?php if (!isset($busqRadicados)) $busqRadicados = ''; ?>
                        <form name=form_busq_rad action='<?= $pagina_actual ?>?<?= session_name() . "=" . session_id() . "&krd=$krd" ?>&estado_sal=<?= $estado_sal ?>&tpAnulacion=<?= $tpAnulacion ?>&estado_sal_max=<?= $estado_sal_max ?>&pagina_sig=<?= $pagina_sig ?>&dep_sel=<?= $dep_sel ?>&nomcarpeta=<?= $nomcarpeta ?>' method=post style="margin-top: 12px;">
                            <label for="busqRadicados">Buscar usuario(s) (Separados por coma)</label>
                            <input id="busqRadicados" name="busqRadicados" type="text" size="60" class="tex_area" value="<?= $busqRadicados ?>" title="Ingrese el nombre o nombres de usuario separados por coma">
                            <input type=submit value='Buscar ' name=Buscar valign='middle' class='botones'>
                            <?
                            if (isset($busqRadicados)) {
                                $busqRadicados = trim($busqRadicados);
                                $textElements = split(",", $busqRadicados);
                                $newText = "";
                                $i = 0;
                                foreach ($textElements as $item) {
                                    $item = trim($item);
                                    if ($item) {
                                        if ($i != 0)
                                            $busq_and = " or ";
                                        else
                                            $busq_and = " ";
                                        $busq_radicados_tmp .= " $busq_and upper($varBuscada) like upper('%$item%') ";
                                        $i++;
                                    }
                                } //FIN foreach
                                if (!isset($dependencia_busq) && !isset($busq_radicados_tmp)) {
                                    $dependencia_busq2 = '';
                                    $busq_radicados_tmp = '';
                                } else
                                    $dependencia_busq2 .= " and ($busq_radicados_tmp) ";
                            } //FIN if ($busqRadicados)
                            ?>
                        </form>
                        <!--</span>-->
                    </td></tr>
            </table>
        <td/>
    <tr/>
</table>
<br>
