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


/*Hecho por skina technologies ltda 2009*/
session_start();
error_reporting(7);
$ruta_raiz = "/var/www/pruebas";
define('ADODB_ASSOC_CASE', 1);
include_once "../include/db/ConnectionHandler.php";
include_once($ruta_raiz."/include/PHPMailer/class.phpmailer.php");
include_once "$ruta_raiz/config.php";
$db = new ConnectionHandler("$ruta_raiz");
$mail = new PHPMailer();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;
$fechahoy=date("Y-m-d"); 
$sqlChar = $db->conn->SQLDate("Y-m-d","SGD_AGEN_FECHPLAZO");
$tx='Agendado';
$nombre='ADMINISTRADOR';
$apellido='SGD ORFEO';
//Busco los documentos agendados vencidos
echo "Alertas para los documentos agendados vencidos";
echo "<br>";

$sql="SELECT RADI_NUME_RADI AS RADICADO,
		SGD_AGEN_OBSERVACION,
		USUA_DOC,
		SGD_AGEN_FECHPLAZO AS PLAZO,
		round(SGD_AGEN_FECHPLAZO-current_date) as HID_DIAS_R,
		DEPE_CODI,
		SGD_AGEN_ACTIVO
	FROM SGD_AGEN_AGENDADOS
	WHERE SGD_AGEN_ACTIVO=1";
//		AND  $sqlChar = '$fechahoy'";
$rs=$db->conn->query($sql);
while(!$rs->EOF){
	$radi_nume=$rs->fields["RADICADO"];
	$asunto=$rs->fields["SGD_AGEN_OBSERVACION"];
	$usua_doc=$rs->fields["USUA_DOC"];
	$plazo=$rs->fields["PLAZO"];
	$diasr=$rs->fields["HID_DIAS_R"];
	$depe_codi=$rs->fields["DEPE_CODI"];
	
	echo "<br> rad $radi_nume plazo $plazo dias $diasr"; 
	//Envio correo para los responsables de los documentos
	if($diasr<=0 AND $depe_codi!='999'){ 

	$sql_mail="SELECT USUA_EMAIL 
		FROM USUARIO 
		WHERE USUA_DOC='$usua_doc'";
echo "usua-doc  $usua_doc";
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rs_mail=$db->conn->query($sql_mail);
	$mail_usu=$rs_mail->fields["USUA_EMAIL"];
  if ($mail_usu != "") {
    $usMailSelect  = $cuenta_mail;
    list($a,$b)=split("@",$usMailSelect);
    $userName=$a;
    $fecha=date("F j, Y H:i:s");

    $mail->IsSMTP(); // telling the class to use SMTP
    /*$mail->AddReplyTo($usMailSelect);*/
    $mail->SetFrom($usMailSelect,"Sistema Gestion documental ORFEO");
    $mail->Host       = $servidor_mail_smtp;
    $mail->Port       = $puerto_mail_smtp;
    $mail->SMTPDebug  = "1";  // 1 = errors and messages // 2 = messages only 
    $mail->SMTPAuth   = "true";
    $mail->SMTPSecure = "";
    /*$mail->AuthType   = $tipoAutenticacion;*/
    $mail->Username   = $userName;   // SMTP account username
    $mail->Password   = $contrasena_mail; // SMTP account password
    $mail->Subject    = "Tiene un documento Agendado vencido en Orfeo";
    $mail->AltBody    = "Para ver el mensaje, por favor use un visor de E-mail compatible!";
    /*$url=true;*/
    $mail->AddAddress($mail_usu);

    $asu .= "<hr>Sistema de gestion documental Orfeo.";
    $mail->MsgHTML(utf8_decode("
         <html>
        <head>
        <title>CORRESPONDENCIA EN ORFEO</title>
        </head>
        <body><p>
        Espinal ".$fecha." <br>
        <br></br>
        Tiene un documento agendado vencido en el Sistema de Gestion Documental. Para verlo, ingrese a su Orfeo y revise el radicado  No  ".$verrad." ".$radi_nume."  enviado por  ".$nombre." ".$apellido." . Este documento fue ".$tx.". <br>
        <br>Asunto:  ".$asunto."</br>
        <br></br>
        <br>Cordial saludo, </br>
        <br>Sistema de Gestion Documental 
        </p>
        </body>
        </html>
        "));

         /*while ((!$exito) && ($intentos < 5) && $mail_usu!="") {
         //   $mail->ErrorInfo;
           // $exito = $mail->Send();*/
           if (!$mail->Send())
              {
               echo "<br> No se pudo enviar correo" . $mail->ErrorInfo;
              }else{
                echo "<br> Se ha enviado una notificaci&oacute;n a ". $mail_usu;
                $mail->ClearAddresses();
              }
//            $intentos=$intentos+1;
            //sleep(7);
         }

echo "<br>";
}
	$rs->MoveNext();
} 	

?>
