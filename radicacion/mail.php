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


//Envio de mail by skinatech

session_start();
error_reporting(7);
$ruta_raiz = "..";
define('ADODB_ASSOC_CASE', 0);
echo $nombre=utf8_decode($nombre);
 
// include_once "../include/db/ConnectionHandler.php";
// include_once($ruta_raiz."/include/PHPMailer/class.phpmailer.php");
// include_once($ruta_raiz."/config.php");

// $db = new ConnectionHandler("$ruta_raiz");
// $mail = new PHPMailer();

// $tx=$_GET['tx'];
// $codusu=$_GET['codusu'];
// $verrad=$_GET['verrad'];
// $asunto=$_GET['asunto'];
// $asunto=utf8_decode($asunto);
// $nombre=$_GET['nombre'];
// $nombre=utf8_decode($nombre);
// $apellido=$_GET['apellido'];
// $apellido=utf8_decode($apellido);
// $krd=$_SESSION['krd'];
// //$db->conn->debug=true;
// if ($tx!='Radicado')
// {
// 	if($tx=='Reasignado' or $tx=='Informado'){
//                 $nombre=$krd;
//                 $apellido=$depe_nomb;
// 		$where="USUA_NOMB='$usunom'";
//                                 }

// 	if($tx=='Devuelto'){
//                 $nombre=$krd;
//                 $apellido=$depe_nomb;
//                 //$where=" USUA_LOGIN='$usunom'";
//                 $where=" USUA_NOMB='$usunom'";//modificado  skina para enviar correo devueltos
//                 }

// 	$sql="SELECT USUA_CODI,DEPE_CODI  FROM USUARIO WHERE $where";
// 	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
// 	$rs=$db->conn->query($sql);
// 	$codusu=$rs->fields["usua_codi"];
// 	$depemail=$rs->fields["depe_codi"];
// 	}
// else
// {
// 	$sql='SELECT RADI_DEPE_ACTU  as "DEPENDENCIA" FROM RADICADO WHERE RADI_NUME_RADI=\''.$verrad."'";
// 	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
// 	$rs=$db->conn->query($sql);
// 	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
// 	$depemail=$rs->fields["dependencia"];
// }
// //echo " codusu $codusu DEPEN $depemail usus $usunom asunto:  $asunto Rad $verrad radi $radi_nume";

// $sql="SELECT USUA_EMAIL FROM USUARIO WHERE USUA_CODI=$codusu AND DEPE_CODI='$depemail'";
// $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
// $rs=$db->conn->query($sql);
// echo $mail_usu=$rs->fields["usua_email"];

// //SE VERIFICA SI ES EMAIL
//     $mail_correcto = 0;
//     //compruebo unas cosas primeras
//     if ((strlen($mail_usu) >= 6) && (substr_count($mail_usu,"@") == 1) && (substr($mail_usu,0,1) != "@") && (substr($mail_usu,strlen($mail_usu)-1,1) != "@")){
//        if ((!strstr($mail_usu,"'")) && (!strstr($mail_usu,"\"")) && (!strstr($mail_usu,"\\")) && (!strstr($mail_usu,"\$")) && (!strstr($mail_usu," "))) {
//           //miro si tiene caracter .
//           if (substr_count($mail_usu,".")>= 1){
//              //obtengo la terminacion del dominio
//              $term_dom = substr(strrchr ($mail_usu, '.'),1);
//              //compruebo que la terminación del dominio sea correcta
//              if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
//                 //compruebo que lo de antes del dominio sea correcto
//                 $antes_dom = substr($mail_usu,0,strlen($mail_usu) - strlen($term_dom) - 1);
//                 $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
//                 if ($caracter_ult != "@" && $caracter_ult != "."){
//                    $mail_correcto = 1;
//                 }
//              }
//           }
//        }
//     }
 

// if($mail==' ' or $mail_correcto==0)
// 	{
//   echo "No se pudo enviar notificacion, el usuario no tiene correo electronico o tiene un formato incorrecto, comuniquese con el administrador del sistema";
// 	}
// else
// {
// 	$fecha=date("F j, Y H:i:s");
//     $usMailSelect  = $cuenta_mail;
//     list($a,$b)=split("@",$usMailSelect);
//     $userName=$a;

//     $mail->IsSMTP(); // telling the class to use SMTP
//     /*$mail->AddReplyTo($usMailSelect);*/
//     $mail->SetFrom($usMailSelect,"Sistema Gestion documental ORFEO");
//     $mail->Host       = $servidor_mail_smtp;
//     $mail->Port       = $puerto_mail_smtp;
//     $mail->SMTPDebug  = "1";  // 1 = errors and messages // 2 = messages only 
//     $mail->SMTPAuth   = "true";
//     $mail->SMTPSecure = "";
//     /*$mail->AuthType   = $tipoAutenticacion;*/
//     $mail->Username   = $usMailSelect;   // SMTP account username
//     $mail->Password   = $contrasena_mail; // SMTP account password
//     $mail->Subject    = "Ha recibido un documento en orfeo";
//     $mail->AltBody    = "Para ver el mensaje, por favor use un visor de E-mail compatible!";
//     /*$url=true;*/
//     $mail->AddAddress($mail_usu);
//     $expCant = explode("','",$verrad." ".$radi_nume);
    
//     $asu .= "<hr>Sistema de gestion documental Orfeo.";
//     $mensaje = "<html>
//         <head>
//         <title>CORRESPONDENCIA EN ORFEO</title>
//         </head>
//         <body><p>
//         Sociedad Hotelera Tequendama , ".$fecha." <br>
//         <br></br>
//         Ha recibido un ".$tx." en el Sistema de Gesti&oacute;n Documental Orfeo. Ingrese ";

// 	// By Skina - jmgamez@skinatech.com - 22 de Julio 2016
// 	// Se agrega el ciclo para validar la URL por cada radicado que se notifique, este cambio aplica para Informados, Radicacion, Reasignacion 	
// 	for($i=0; $i<count($expCant); $i++){
// 	 $bodytag = str_replace("'", "", $expCant[$i]);
//          $mensaje .=  'al radicado <a href="http://192.168.8.74/old/orfeoRIO/verradicado.php?verrad='.$bodytag.'"> '.$bodytag.' </a> , ';
//    	}

//     $mensaje .= "enviado por  ".$nombre." ".$apellido." <br></br>
//         <br>Asunto:  ".$asunto."</br>
//         <br></br>
//         <br>Cordialmente, </br>
//         <br>Sistema de Gestion Documental Orfeo
//         </p>
//         </body>
//         </html>
//         ";
//     $mail->MsgHTML(utf8_decode($mensaje));
   
// 	 while ((!$exito) && ($intentos < 5) && $mail_usu!="") {
//             $mail->ErrorInfo;
//             $exito = $mail->Send();
//            if (!$exito)
//               { 
//                 echo ("<br> No se pudo enviar correo");
//               }else{
// 	        echo("<br> Se ha enviado una notificaci&oacute;n a $mail_usu");
//               }
//             $intentos=$intentos+1;
//             sleep(7);
//          }     

// }
?>
<html>
<HEAD>
<TITLE>Envio de Notificacion a Email
</TITLE></HEAD>
<BODY>
<script>
	//window.close();
</script>
</BODY>
</html>
