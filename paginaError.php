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
<html>
    <title>Cierre de sesión - ORFEO 5 </title>
    <head>
        <link rel="stylesheet" href="estilos/orfeo.css">
        <link href="estilos/orfeo50/logout.css" rel="stylesheet" type="text/css"/>
        <link href="estilos/orfeo50/bootstrap.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
    <center>
        <div class="flotante">
            <h2>Su sesión ha expirado o ha ingresado en otro equipo por favor cierre su navegador e intente de nuevo</h2>
            <div id="imgOrfeo">
            <a href="<?= $ruta_raiz ?>/login.php" target="_parent">
                <img border="0" src="estilos/orfeo50/imagenes50/sgd.png" alt='Volver al formulario de inicio de sesion'></a>
            </div>
        </div>
        
    </center>
    <?
    if (session_id())
        session_destroy();
    ?>	
</body>
</html>
