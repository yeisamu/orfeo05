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
/* ---------------------------------------------------------+
  |                     INCLUDES                             |
  +--------------------------------------------------------- */


/* ---------------------------------------------------------+
  |                    DEFINICIONES                          |
  +--------------------------------------------------------- */


/* ---------------------------------------------------------+
  |                       MAIN                               |
  +--------------------------------------------------------- */


/**
 * Vista busquedas OCR
 * @autor Skinatech 
 * @fecha 2017/03
 */
session_start();

if (empty($_SESSION)) {
    return null;
}
$ruta_raiz = "..";
?>
<html>
    <header>
        <link href="../estilos/orfeo50/bootstrap.css" rel="stylesheet" type="text/css"/>
    </header>

    <style>
        body{ margin-top:20px;}
        .glyphicon { margin-right:5px;}
        .section-box h2 { margin-top:0px;}
        .section-box h2 a { font-size:15px; }
        .glyphicon-heart { color:#e74c3c;}
        .glyphicon-comment { color:#27ae60;}
        .separator { padding-right:5px;padding-left:5px; }
        .section-box hr {margin-top: 0;margin-bottom: 5px;border: 0;border-top: 1px solid rgb(199, 199, 199);}
    </style>

    <body>
        <nav class="navbar navbar-default" role="navigation" style="background-color: #D33F4B;">
            <div class="navbar-header">
                <a class="navbar-brand" style="color: #FFF;" href="#"><b>Full Text Search</b></a>
            </div>
        </nav>


        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-3">
                    <div class="well well-sm">
                        <div class="row">
                            <div class="col-xs-3 col-md-3 text-center">
                                <img src="images/logo_skina_naranja_vertical.png" alt="bootsnipp"
                                     class="img-rounded img-responsive" />
                            </div>
                            <div class="col-xs-9 col-md-9 section-box">
                                <h2>
                                    Nueva Característica
                                </h2>
                                <p>
                                   Quieres activar la búsqueda texto dentro de los documentos radicados?
                                </p>
                                <p>
                                   Contáctanos.
                                </p>
                                <hr />
                                <div class="row rating-desc">
                                    <div class="col-md-12">
                                        <a href="http://www.skinatech.com" target="_blank">Skina Technologies</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>



    </body>
</html>
