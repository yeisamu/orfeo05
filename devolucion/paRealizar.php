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
<input type='hidden' name=depsel value='<?= $depsel ?>'>
<input type=hidden name=rad_recuperar value='<?= $rad_recuperar ?>'>
<input type=hidden name=enviara value='<?= $enviara ?>'>
<input type=hidden name=EnviaraV value='<?= $EnviaraV ?>'>
<script language="JavaScript" type="text/javascript">
    function ver()
    {
        var obj = document.getElementById('observa');
        if (obj.value.length > 5)
            return true;
        else
        {
            alert('Por favor escriba un comentario');
            return false;
        }
    }
</script>
<table  WIDTH=100% cellspacing="5" align="center" class="borde_tab">
    <tr class="titulos4 tdTitulo">
        <td width=30%><span class='etextomenu'>Usuario</span><br> </td>
       
        <td  width='30%'><span class='etextomenu'> Dependencia</span><br></td>
       
        <td rowspan="2">Archivar Envio
            <?
            if ($rad_recuperar) {
                echo "<br>Se devolvera de la dependencia de Salida el Radicado ($rad_recuperar)";
            }
            ?>
        </td>
        <?
        /*
          Aqui empieza a realiza el translado del documento.
         */
        if ($enviardoc != "REALIZAR"){
            ?>
        <td width='5' rowspan="2">
                <input type=submit value=REALIZAR name=enviardoc id=enviardoc align=bottom class='botones' onclick="return ver()">
            </td>
        </tr>
        <tr class="titulos4 tdTitulo">
             <td width=30%><span class='etextou'><?= $usua_nomb ?></span></td>
              <td width=30%><span class=etextou><?= $depe_nomb ?></span><br></td>
        </tr>
        <tr align="center">
            <td colspan="4" class="celdaGris">
                <textarea name="observa" id="observa" cols="70" rows="3" class="tex_area"></textarea>
                <input type=hidden name=enviar value=enviarsi>
                <input type=hidden name=enviara value='<?= $enviara ?>'>
                <input type=hidden name=depsel value=$depsel>
                <input type=hidden name=EnviaraV value='<?= $EnviaraV ?>'>
                <?
            }
            ?>
    </tr>
</table>
