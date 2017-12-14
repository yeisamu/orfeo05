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


/**
* Alertas al correo de Transferencias documentales
* Sistema de gestion Documental ORFEO.
* Permite traer un listado de los expedientes a los cuales se les debe realizar algun procedimiento por cumplimiento de tiempos por TRD
* Se verifica por expediente y NO por radicado
* se presume que un expediente tiene una unica Serie-subserie
*/  
    $ruta_raiz = "/var/www/html/orfeo/";

    include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz");
    $db->conn->debug=true;
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    
    $mail_usu="isabelr182@gmail.com";
    $ciudad="Bogota";

    //Para los expedientes que cumplieron su tiempo en gestion 
    $fechahoy=date("Y-m-d"); 
    echo "Alertas para los expedientes que cumplieron sus tiempos de retencion $fechahoy";
    echo "<br>";

    //Incluyo logica de busqueda
    include_once "$ruta_raiz/include/query/archivo/queryAlerta.php";
    include_once "$ruta_raiz/archivo/busca_transferencias.php";

    $fecha=date("F j, Y H:i:s");
    //Cuerpo del email
    $subject="Tiene expedientes pendientes en Orfeo";
    $cuerpo="
        <html>
        <head>
        <title>TRANSFERENCIA EN ORFEO</title>
        </head>
        <body><p>
        ".$ciudad."  ".$fecha." <br>
        <br></br>
        Tiene expedientes pendientes de aplicar TRD en el Sistema de Gestion Documental. Para verlos, ingrese a su Orfeo y revise el modulo de archivo,opcion Transferencias documentales .  <br>
        <br>Pendientes de transferencia primaria: ".$primaria."</br>
        <br>Pendientes de transferencia secundaria: ".$secundaria."</br>
        <br>Pendientes de eliminacion: ".$eliminar."</br>
        <br>Pendientes de seleccion: ".$seleccion."</br>
	<br></br>
        <br>Cordial saludo, </br>
        <br>Sistema de Gestion Documental
        </p>
        </body>
        </html>
        ";

    $headers  = "MIME-Version: 1.0\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\n";
    //direccion del remitente
    $headers .= "From: Orfeo <orfeo@empopasto.com.co>\n";
    //Envio mail 
    $ok=mail($mail_usu,$subject,$cuerpo,$headers);
    if ($ok) echo("Se ha enviado una notificacion a $mail_usu <br>");
    else echo ("No envio correo");
?>
