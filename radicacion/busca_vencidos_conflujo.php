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



//session_start();
error_reporting(7);
$ruta_raiz = "/var/www/pruebas";
//$ruta_raiz = "/var/www/html/pruebas";
define('ADODB_ASSOC_CASE', 1);

include_once "$ruta_raiz/include/db/ConnectionHandler.php";
include_once($ruta_raiz."/include/PHPMailer/class.phpmailer.php");
//include_once "/var/www/html/pruebas/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
$mail = new PHPMailer();
include_once "$ruta_raiz/config.php";

//$db->conn->debug=true;
$fechahoy=date("Y-m-d"); 
$sqlFecha = $db->conn->SQLDate("Y-m-d","RADI_FECH_RADI");
$order = " 1";
$nombre='ADMINISTRADOR';
$apellido='SGD ORFEO';
$dependencia="b.radi_depe_actu";
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//Busco los expedientes que tienen flujo
echo "Alertas para los documentos que tienen flujo";
echo "<br>";

$redondeo="date_part('days', radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(fe.SGD_FEXP_TERMINOS * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp.")";


$isql_exp='SELECT se.SGD_FEXP_CODIGO, se.SGD_PEXP_CODIGO, fe.SGD_FEXP_DESCRIP as ETAPA,
                e.SGD_EXP_NUMERO, r.RADI_NUME_RADI as CHK_CHKANULAR, dir.SGD_DIR_NOMREMDES AS "Remitente/Destinatario",
                r.RADI_USUA_ACTU AS HID_USUA, r.RADI_DEPE_ACTU AS HID_DEPE,'.$redondeo.' as "HID_DIAS_R",
		tp.SGD_TPR_DESCRIP as "Tipo_Documento", r. RA_ASUN      AS HID_ASUN
                from SGD_TPR_TPDCUMENTO tp, SGD_DIR_DRECCIONES dir, 
			RADICADO r LEFT OUTER JOIN SGD_EXP_EXPEDIENTE e
                         ON r.RADI_NUME_RADI=e.RADI_NUME_RADI
                join  SGD_SEXP_SECEXPEDIENTES se ON  SE.SGD_EXP_NUMERO=E.SGD_EXP_NUMERO 
			AND SE.SGD_PEXP_CODIGO!=0, SGD_FEXP_FLUJOEXPEDIENTES fe
	         WHERE  SE.SGD_FEXP_CODIGO=FE.SGD_FEXP_CODIGO
                 	AND SE.SGD_PEXP_CODIGO=FE.SGD_PEXP_CODIGO
			AND r.RADI_NUME_RADI=dir.RADI_NUME_RADI
			AND r.tdoc_codi=tp.sgd_tpr_codigo
		ORDER BY HID_DEPE';

$rs=$db->conn->query($isql_exp);

while(!$rs->EOF){
	$usua_codi=$rs->fields["HID_USUA"];
	$depe_codi=$rs->fields["HID_DEPE"];
	$radi_nume=$rs->fields["CHK_CHKANULAR"];
	$asunto=$rs->fields["HID_ASUN"];
	$diasr=$rs->fields["HID_DIAS_R"];
	//$remitente=$rs->fields["Remitente/Destinatario"];
	$remitente=$rs->fields["REMITENTE/DESTINATARIO"];
	$remitente=utf8_decode($remitente);
	$tipodoc=$rs->fields["TIPO_DOCUMENTO"];
	$tipodoc=utf8_decode($tipodoc);
	$etapa=$rs->fields["ETAPA"];
	
	//if($diasr<=1){
	if($diasr<=1 and $depe_codi!='999'){
	echo "<br>";
        echo "Radicado $radi_nume fecha $fecha_rad Dias restantes $diasr Tipo Documental $tipodoc <br> Etapa $etapa";
	echo "<br>";

	$sql_mail="SELECT USUA_EMAIL 
		FROM USUARIO 
		WHERE USUA_CODI=$usua_codi
			AND DEPE_CODI=$depe_codi";
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rs_mail=$db->conn->query($sql_mail);
	$mail_usu=$rs_mail->fields["USUA_EMAIL"];
	$fecha=date("F j, Y H:i:s");
//        echo "mail usu $mail_usu <br>";
	
		if($usua_codi!=1) {
			$sql_mail="SELECT USUA_EMAIL 
				FROM USUARIO 
				WHERE USUA_CODI=1
				AND DEPE_CODI=$depe_codi";
			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
			$rs_mail=$db->conn->query($sql_mail);
			$mail_jefe=$rs_mail->fields["USUA_EMAIL"];
		        //echo "mail jefe $mail_jefe <br>";
		}
    if ($mail_usu != "") {
    $usMailSelect  = $cuenta_mail;
    list($a,$b)=split("@",$usMailSelect);
    $userName=$a;

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
    $mail->Subject    = "Tiene un documento vencido en Orfeo";
    $mail->AltBody    = "Para ver el mensaje, por favor use un visor de E-mail compatible!";
    /*$url=true;*/
    $mail->AddAddress($mail_usu);
  $mail->MsgHTML(utf8_decode("
        <html>
        <head>
        <title>CORRESPONDENCIA EN ORFEO</title>
        </head>
        <body><p>
        Espinal, ".$fecha." <br>
        <br></br>
        Tiene un documento en flujo pendiente que esta pr&oacute;ximo a vencerse en el Sistema de Gesti&oacute;n Documental. Para verlo, ingrese a su Orfeo y revise el radicado  No  ".$verrad." ".$radi_nume."  enviado por  ".$remitente." .  <br>
        <br>Asunto:  ".$asunto."</br>
        <br>Tipo de documento:  ".$tipodoc."</br>
        <br>Etapa:  ".$etapa."</br>
        <br></br>
        <br>Cordial saludo, </br>
        <br>Sistema de Gesti&oacute;n Documental
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
