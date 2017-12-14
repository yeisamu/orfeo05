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



// Ultima Modificacion Kasandra 2012-10    Agregamos templates documentacion

error_reporting(E_ALL);
// error_reporting(E_ERROR | E_PARSE);
$ruta_raiz = "..";
session_start();
if (!isset($_SESSION['krd']))
    include "../rec_session.php";

foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;

set_include_path(".:/usr/share/php:/usr/share/pear");
?>
<html>
    <head>
       	<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    </head>	
    <body>
        <div class="panelCorreo">
            <ul style="padding-left: 0px;">
                <li class="tit"><h4>Opciones</h4></li>
                <?
                /** ******************************************************
                 *          Encabezados de librerias estandares          *
                 * *******************************************************/

                include "connectIMAP.php";

                /** ******************************************************
                 *           Constantes del archivo                      *
                 * *******************************************************/

                $TIT_Recargar_Carpetas = "Recargar <br> Carpetas";

                /* ******************************************************
                 *                   Programa Principal                  *
                 * *******************************************************/

                if ($msg->getMailboxes($host)) {
                    $listMailBoxes = $msg->getMailboxes($host);
                    foreach ($listMailBoxes as $name) {
                        ?>
                        <li><a href='emailinbox.php?inboxEmail=<?= $name ?>' target='formulario'><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<?= $name ?></a></li>
                        <?
                    }
                } else {
                    ?>
                    <li><a href='menu_buzones.php?inboxEmail=<?= $name ?>'><span class="glyphicon glyphicon-refresh"></span> <? echo $TIT_Recargar_Carpetas ?></a></li>
                    <li><a href='login_email.php?inboxEmail=<?= $name ?>'><span class="glyphicon glyphicon-inbox"></span> Inbox</a></li>
                        <?
                    }
                    ?>
                <!--    <li><a href="#"><span class="glyphicon glyphicon-refresh"></span> Inbox</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-inbox"></span> Inbox</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-folder-open"></span> Archive</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-erase"></span> Drafts</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-asterisk"></span> Trash</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-trash"></span> Junk</a></li>
                        <li><a href="#"><span class="glyphicon glyphicon-send"></span> Sent</a></li>-->
            </ul>
        </div>

    </body>
</html>
