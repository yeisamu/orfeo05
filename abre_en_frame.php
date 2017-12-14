<?
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
<html>
<?
//echo ("<br> $datoenvio");
$lkfin =  str_replace("|", "/", $lkparam);
$lkfin = $lkfin . str_replace("|", "&", $datoenvio);
//echo ("$lkfin");


?>
<frameset cols="100%" frameborder="NO" border="0" framespacing="0" cols="*" onunload="opener.regresar();">
   <frameset cols=*" border="0" framespacing="0" rows="*">
     <frame name='mainFrame' src='<?=$lkfin ?>'  scrolling='AUTO'>
    </frameset>
</frameset>
<noframes></noframes>
</frameset>

</html>


