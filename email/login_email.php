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
//error_reporting(E_ERROR | E_PARSE);

session_start();
if (!isset($_SESSION['krd']))
    include "../rec_session.php";

foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;

if (!$ruta_raiz)
    $ruta_raiz = "..";

$encabezado = session_name() . "=" . session_id() . "";

/* * ******************************************************
 *           Constantes del archivo                      *
 * ****************************************************** */

$TIT_Vista_Previa = "..Vista Previa..";
$TIT_MSG_No_Servidor = "No se pudo establecer conexion con el Servidor.";
$TIT_Ingrese_Contra = "Ingrese su Clave de Correo para: ";
$TIT_Ingresar = "Ingresar";

/* * ******************************************************
 *           Variables  del archivo                      *
 * ****************************************************** */

/* * ******************************************************
 *                   Programa Principal                  *
 * ****************************************************** */


// obtengo los datos del usuario de la sesion
$krd = $_SESSION["krd"];
$usuaEmail = $_SESSION["usua_email"];
$imagenes = $_SESSION["imagenes"];
$dependencia = $_SESSION["dependencia"];
if ($passwd_mail) {
    $passwdEmail = $passwd_mail;
    $usuaEmail = $_SESSION['usuaEmail'];
    $dominioEmail = $_SESSION['dominioEmail'];
}

// Si hay password ya en la sesion
if ($_SESSION['passwdEmail']) {
    $passwdEmail = $_SESSION['passwdEmail'];
}

if ($passwdEmail) {      // Ya logueado
    include "emailinbox.php";
} else {                             // Show login box
    ?>

    <html>
        <head>
            <title><? echo $TIT_Vista_Previa ?></title>
            <!--<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">-->
            <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        </head>
        <body>

            <h2 align="center">
                <?php
                if ($err == 1)
                    echo $TIT_MSG_No_Servidor;
                ?>
            </h2>
            <form action="login_email.php?<?php echo $encabezado; ?>">
                <div class="container" style="margin-top:20px">
                    <div class="row">
                        <div class="col-sm-6 col-md-5 col-md-offset-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <strong><? echo $TIT_Ingrese_Contra ?></strong>
                                </div>
                                <div class="panel-body">
                                    <fieldset>
                                        <div class="row">
                                            <div class="center-block">
                                                <!--<img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120" alt="">-->
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-user"></i>
                                                        </span> 
                                                        <input class="form-control"  name="loginname" type="text" value="<?= $usuaEmail ?>" readonly autofocus>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <span class="input-group-addon">
                                                            <i class="glyphicon glyphicon-lock"></i>
                                                        </span>
                                                        <input class="form-control" placeholder="Password" name="passwd_mail" type="password" value="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-md btn-primary btn-block" value="<? echo $TIT_Ingresar ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="panel-footer ">
                                    <?= $_SESSION['entidad'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </body>
    </html>
    <?
}
?>
