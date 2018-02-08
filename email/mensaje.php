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
// error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);

session_start();
if (!isset($_SESSION['krd']))
    include "../rec_session.php";

foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;

if (!$ruta_raiz)
    $ruta_raiz = "..";

set_include_path(".:/usr/share/php:/usr/share/pear");

/* * ******************************************************
 *          Encabezados de librerias estandares          *
 * ****************************************************** */

include($ruta_raiz . '/config.php');
include "email.inc.php";
include "connectIMAP.php";

/* * ******************************************************
 *                   Programa Principal                  *
 * ****************************************************** */
?>
<html>
    <HEAD>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <STYLE TYPE="text/css">
            #flotante { position: absolute; top:100; left: 550px; visibility: visible;}
        </STYLE>
    </HEAD>
    <BODY>
        <?
// print_r($_SESSION);
//$encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";print "mid: ".$mid."<br/>pid: ".$pid;
//---------- Las acciones .. radicar o forwardiar --------------//
        ?>

        <?
//----------- Imprime el correo escogido  ----------------------//
        if (isset($_GET['mid']) && isset($_GET['pid'])) {
            $body = $msg->getBody($_GET['mid'], $_GET['pid']);
            //lectura cabeceras----
            $msg->getHeaders($mid);
            $eMailRemitente = $_SESSION['eMailRemitente'];
            $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
            if ($body['ftype'] == "text/html")
                $nl = "</br>";
            else
                $nl = "<br>";

//---Encabezado de email-----------------------------------------------------//
//  print_r ($msg->header[$mid] );
//  
//  
//  Metodo antiguo para mostrar el correo y sus datos
//            $contenidoEmail = $head;
//            $contenidoEmail .= $body['message'];
//            $head = "<u><b>De:</b></u> " . sup_tilde($msg->header[$mid]['fromaddress']) . " &lt;" . sup_tilde($msg->header[$mid]['from'][0]) . "&gt;$nl";
//            $head .= "<u><b>Para:</b></u> " . sup_tilde($msg->header[$mid]['toaddress']) . " &lt;" . sup_tilde($msg->header[$mid]['to'][0]) . "&gt;$nl";
//            $head .= "<u><b>Asunto:</b></u> " . sup_tilde($msg->header[$mid]['Subject']) . "<BR>";
//              Los otros paras no funciona
//            $iMail = 0;
//            if (count($msg->header[$mid]['to_personal']) >= 1) {
//                foreach ($msg->header[$mid]['to_personal'] as $key => $value) {
//                    if ($iMail == 0)
//                        $head .= "<u><b>Para:</b></u> ";
//                    else
//                        $head .= ", ";
//                    $head .= "" . sup_tilde($msg->header[$mid]['to_personal'][$iMail]) . "";
//                    $head .= "< " . $msg->header[$mid]['to'][$iMail] . " >";
//                    $iMail++;
//                }
//            }
//            
//            $head .= "$nl   <u><b>Enviado Desde Serv:</b></u> " . $msg->header[$mid]['sender_host'][0] . "";
//          
//          Contruccion de la tabla superior con los datos de correo
//            $headRadicado = "
//<TABLE width=\"100%\" cellspacing=\"0\" border=\"1\" cellpadding=\"4\" >
//    $head
//    <td>
//        *$nurad*<br>
//        <u><b>Radicado No.</b></u>  $nurad<br><br>
//        <u><b>Fecha:</b></u> " . $msg->header[$mid]['Date'] . "
//    </td>
//    </tr>
//</TABLE>
//";
//----------------------------------------------------------------------------//
            //$head =$headRadicado . $head;
            //echo $head;
            ?>
            <br>
        <center>
            <div id="titulo" style="width: 95%;" align="center">Correo: <?= $msg->header[$mid]['Subject'] ?></div>
            <table  class="borde_tab" border="1" width="95%" cellspacing="5">
                <tr class="titulos5">
                    <td><b><font size=3><a href='../radicacion/NEW.php?<?= session_name() ?>=<?= session_id() ?>&ent=2&eMailMid=<?= $mid ?>&eMailAmp=<?= $eMailAmp ?>&eMailPid=<?= $eMailPid ?>&fileeMailAtach=<?= $fname ?>&tipoMedio=eMail' target='formulario'>Radicar Este Correo</a></font></b>
                    </td>
                    <!--<td><b><font size=3><a href='forwardMail.php?<?= session_name() ?>=<?= session_id() ?>&ent=2&eMailMid=<?= $mid ?>&eMailAmp=<?= $eMailAmp ?>&eMailPid=<?= $eMailPid ?>&fileeMailAtach=<?= $fname ?>&tipoMedio=eMail' >Reenviar</a></font></b>-->
                    </TD>
                    <td><b><font size=3><a href='deleteMail.php?<?= session_name() ?>=<?= session_id() ?>&ent=2&eMailMid=<?= $mid ?>&eMailAmp=<?= $eMailAmp ?>&eMailPid=<?= $eMailPid ?>&fileeMailAtach=<?= $fname ?>&tipoMedio=eMail' >Eliminar</a></font></b>
                    </TD>
                </TR>
            </table>
        </center>
        <br>
        <div class="cuerpoMail">
            <div class="headMail">
                <table border="0" style="width:100%" class="borde_tabReducido">
                    <tr>
                        <td><u><b>De:</b></u></td>
                        <td><?= sup_tilde($msg->header[$mid]['fromaddress']) ?> &lt; <?= sup_tilde($msg->header[$mid]['from'][0]) ?>&gt;</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><u><b>Para:</b></u></td>
                        <td><?= sup_tilde($msg->header[$mid]['toaddress']) ?> &lt; <?= sup_tilde($msg->header[$mid]['to'][0]) ?>&gt;</td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><u><b>Asunto:</b></u> </td>
                        <td><?= sup_tilde($msg->header[$mid]['Subject']) ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><u><b>Enviado Desde Serv:</b></u></td>
                        <td><?= $msg->header[$mid]['sender_host'][0] ?></td>
                        <td><u><b>Fecha:</b></u></td>
                        <td><?= $msg->header[$mid]['Date'] ?></td>
                    </tr>
                </table>
            </div>
            <div class="mensajeMail">
                <div class="cuerpomensaje">
                    <p><?= str_replace("\n", "<br>", $body['message']); ?></p>
                    <!--<p><?= $body['message']; ?></p>-->
                </div>
            </div>
        </div>
    </div>

    <table border="1" class="borde_tab" width="100%">
        <tr class="titulos3">
        <br>
        <?php
        //dibujado de los datos del correo con el metodo anterior
        //echo "<br>";
        // echo $headRadicado;
        //echo "<br>";
        // echo str_replace("\n", "<br>", $body['message']);
        //$content = "" . $head . $body['message'];
    }else {
        print("No hay Correo disponible");
    }
    $fn = $body['fname'];
//--Variable con la Cabecera en formato html----------------------------------//
    $nl = "<br>";
    ?>
    </tr>
</table>
</BODY>
</html>
