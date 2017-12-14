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


/*Hecho por skina technologies ltda 2010*/
error_reporting(7);
$ruta_raiz = "/var/www/pruebas";
define('ADODB_ASSOC_CASE', 0);

include_once($ruta_raiz."/include/PHPMailer/class.phpmailer.php");
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
include_once "$ruta_raiz/config.php";
$db = new ConnectionHandler("$ruta_raiz");
$mail = new PHPMailer();

//$db->conn->debug=true;
$fechahoy=date("Y-m-d"); 
$sqlFecha = $db->conn->SQLDate("Y-m-d","RADI_FECH_RADI");
$order = " b.RADI_DEPE_ACTU";
$nombre='ADMINISTRADOR';
$apellido='SGD ORFEO';
$dependencia="b.radi_depe_actu";
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);


//Para los que no tienen flujo
echo "Alertas para los documentos que no tienen flujo $fechahoy";
echo "<br>";
 $redondeo="date_part('days', radi_fech_radi-".$db->conn->sysTimeStamp.")+floor(dt.dias_termino * 7/5)+(select count(*) from sgd_noh_nohabiles where NOH_FECHA between radi_fech_radi and ".$db->conn->sysTimeStamp.")";

$isql = 'select                 '.$sqlFecha.' as "DAT_Fecha Radicado"
                                ,b.RA_ASUN  as "HID_ASUN"'.
                                $colAgendado.
                                ',d.SGD_DIR_NOMREMDES  as "Remitente/Destinatario"
                                ,c.SGD_TPR_DESCRIP as "Tipo_Documento"
                                ,'.$redondeo.' as "HID_DIAS_R"
                                ,b.RADI_USUA_ACTU as "HID_USUA"
                                ,b.RADI_DEPE_ACTU as "HID_DEPE"
                                ,cast(b.RADI_NUME_RADI as varchar(15)) as "CHK_CHKANULAR"
	from
                 radicado b left outer join SGD_TPR_TPDCUMENTO c on b.tdoc_codi=c.sgd_tpr_codigo
        		    left outer join SGD_DIR_DRECCIONES d on b.radi_nume_radi=d.radi_nume_radi
		            left outer join SGD_DT_RADICADO dt on b.radi_nume_radi=dt.radi_nume_radi
         where
                b.radi_nume_radi is not null
                and b.radi_depe_actu='.$dependencia.
                $whereUsuario.$whereFiltro.
                '
                '.$whereCarpeta.'
                '.$sqlAgendado.'
          order by '.$order .' ' .$orderTipo;


$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$rs=$db->conn->query($isql);

while(!$rs->EOF){
	//$usua_codi=$rs->fields["HID_USUA"];
	$usua_codi=$rs->fields["hid_usua"];
	//$depe_codi=$rs->fields["HID_DEPE"];
	$depe_codi=$rs->fields["hid_depe"];
	//$radi_nume=$rs->fields["CHK_CHKANULAR"];
	$radi_nume=$rs->fields["chk_chkanular"];
	//$asunto=$rs->fields["HID_ASUN"];
	$asunto=$rs->fields["hid_asun"];
	$asunto=utf8_decode($asunto);
	//$diasr=$rs->fields["HID_DIAS_R"];
	$diasr=$rs->fields["hid_dias_r"];
	//$remitente=$rs->fields["Remitente/Destinatario"];
	$remitente=$rs->fields["remitente/destinatario"];
	$remitente=utf8_decode($remitente);
	//$tipodoc=$rs->fields["Tipo_Documento"];
	$tipodoc=$rs->fields["tipo_documento"];
	$tipodoc=utf8_decode($tipodoc);
	//$fecha_rad=$rs->fields["DAT_Fecha Radicado"];
	$fecha_rad=$rs->fields["dat_fecha radicado"];
	
	if($diasr<=3 and $depe_codi!='999'){

	echo "<br>";
	echo "Radicado $radi_nume fecha $fecha_rad Dias restantes $diasr Tipo Documental $tipodoc <br>";
	$sql_mail="SELECT USUA_EMAIL 
		FROM USUARIO 
		WHERE USUA_CODI=$usua_codi
			AND DEPE_CODI=$depe_codi";
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rs_mail=$db->conn->query($sql_mail);
	//$mail_usu=$rs_mail->fields["USUA_EMAIL"];
	$mail_usu=$rs_mail->fields["usua_email"];
	$fecha=date("F j, Y H:i:s");
        echo "mail usu $mail_usu <br>";
	
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

    $asu .= "<hr>Sistema de gestion documental Orfeo.";
    $mail->MsgHTML(utf8_decode("
        <html>
        <head>
        <title>CORRESPONDENCIA EN ORFEO</title>
        </head>
        <body><p>
        Espinal, ".$fecha." <br>
        <br></br>
        Tiene un documento pendiente que esta pr&oacute;ximo a vencerse en el Sistema de Gesti&oacute;n Documental. Para verlo, ingrese a su Orfeo y revise el radicado  No  ".$verrad." ".$radi_nume."  enviado por  ".$remitente." .  <br>
        <br>Asunto:  ".$asunto."</br>
        <br>Tipo de documento:  ".$tipodoc."</br>
        <br>Dias restantes: ".$diasr."</br>
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
