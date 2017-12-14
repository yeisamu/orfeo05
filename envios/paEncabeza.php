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


if (isset($swBusqDep)) {
 ?>
    <table border='0'  cellpadding=2 cellspacing='0' WIDTH=100% class='borde_tab' valign='top' align='center' >
        <tr class="info">
            <td height="20"></td>
            <td height="20"id="usuaNomb"></td>
            <td width="35%">
                <table width="100%" border="0" cellspacing="5" cellpadding="0" id="deps">
                    <tr class="info" height="20">
                        <td><div align="left" class="titulo1"><label for="dep_sel">Dependencia</label></div></td>
                    </tr>
                    <tr>
                    <form name=formboton action='<? if (isset($pagina_actual)) $pagina_actual ?>?<?= session_name() . "=" . session_id() ?>&estado_sal_max=<?= $estado_sal_max ?>&pagina_sig=<?= $pagina_sig ?>&dep_sel=<?= $dep_sel ?>&nomcarpeta=<?= $nomcarpeta ?>' method='GET'>
                        <input type=hidden name=estado_sal value='<?= $estado_sal ?>'>
                        <td height="1">
                            <?
                            include_once "$ruta_raiz/include/query/envios/queryPaencabeza.php";
                            $sqlConcat = $db->conn->Concat($conversion, "'-'", 'depe_nomb');
                            $sql = "select $sqlConcat ,depe_codi from dependencia where depe_estado=1
						order by depe_codi";
                            //	$db->conn->debug = true;
                            $rsDep = $db->conn->Execute($sql);
                            if (!isset($depeBuscada))
                                $depeBuscada = $dependencia;
                            print $rsDep->GetMenu2("dep_sel", "$dep_sel", false, false, 0, " onChange='submit();' class='select' id='dep_sel' title='Listado con todas las dependencias existentes'");
                            ?>
                        </td>
                    </form>
        </tr>
    </table>
    </td>
    </tr>
    </table>
<?php
}
?>
