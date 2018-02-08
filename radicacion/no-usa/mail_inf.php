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


//Email 

session_start();
error_reporting(7);
$ruta_raiz = "..";
define('ADODB_ASSOC_CASE', 0);
include_once "../include/db/ConnectionHandler.php";
include_once($ruta_raiz."/include/PHPMailer/class.phpmailer.php");
include_once "$ruta_raiz/config.php";
$db = new ConnectionHandler("$ruta_raiz");
$mail = new PHPMailer();
//$db->conn->debug=true;
$tx=$_GET['tx'];
$codusu=$_GET['codusu'];
$depemail=$_GET['depemail'];
$verrad=$_GET['verrad'];
$asunto=$_GET['asunto'];
$asunto=utf8_decode($asunto);
$nombre=$_GET['nombre'];
$nombre=utf8_decode($nombre);
$apellido=$_GET['apellido'];
$apellido=utf8_decode($apellido);
$usunom=$_GET['usunom'];
$krd=$_SESSION['krd'];

//while (list($recordid,$tmp) = each($usunom))
//      {  
//	$record_id = $recordid;
//	echo "record_id $record_id";
//busco la coma, si la trae son varios
if (strpos($usunom,','))
  {
  $tmp = explode(',',$usunom);
  while (list($recordid,$usu) = each($tmp))
	{
               /*Modificacion skina             05/11/2013*/
               /*Ing Camilo Pintor   cpintor@skinatech.com*/
               /*Se inicializan las varibales mail y $where*/
               /* para evitar duplicidades en el ciclo y se*/
               /*eliminan espacios del nombre para la sql  */
               $mail_usu=null;
               $where=null;
               
               $usu=trim($usu);
                    if($tx=='Informado' and $usu!=''){
                	$nombre=$krd;
	                $apellido=$depe_nomb;
			$where="USUA_NOMB like '%$usu%'";
		$sql="SELECT USUA_CODI,DEPE_CODI,USUA_EMAIL FROM USUARIO WHERE $where";
               /* Fin Modificacion                         */
                $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
		$rs=$db->conn->query($sql);
		$codusu=$rs->fields["usua_codi"];
		$depemail=$rs->fields["depe_codi"];
		$mail_usu=$rs->fields["usua_email"];

//echo "<br> codusu $codusu DEPEN $depemail usus $usunom asu  $asunto Rad $verrad radi $radi_nume mail $mail";

//SE VERIFICA SI ES EMAIL
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($mail_usu) >= 6) && (substr_count($mail_usu,"@") == 1) && (substr($mail_usu,0,1) != "@") && (substr($mail_usu,strlen($mail_usu)-1,1) != "@")){
       if ((!strstr($mail_usu,"'")) && (!strstr($mail_usu,"\"")) && (!strstr($mail_usu,"\\")) && (!strstr($mail_usu,"\$")) && (!strstr($mail_usu," "))) {
          //miro si tiene caracter .
          if (substr_count($mail_usu,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($mail_usu, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($mail_usu,0,strlen($mail_usu) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
 

//echo "mail $mail";
               /*Modificacion skina             05/11/2013*/
               /*Ing Camilo Pintor   cpintor@skinatech.com*/
               /*Se agrega validacion, para verificar que */
               /*el nombre no este vacio                  */
if($mail_usu==' ' or $mail_correcto==0 || $usunom==' ' )
               /* Fin Modificacion                         */
	{
  echo "<br> No se pudo enviar notificacion, el usuario no tiene correo electronico o tiene un formato incorrecto, comuniquese con el administrador del sistema";
	}
else
{
	$fecha=date("F j, Y H:i:s");

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
    $mail->Subject    = "Ha recibido un documento en orfeo";
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
        C&uacute;cuta, ".$fecha." <br>
	<br></br>
	Ha recibido un documento en el Sistema de Gesti&oacute;n Documental. Para verlo, ingrese a su Orfeo y revise el radicado  No  ".$verrad." ".$radi_nume."  enviado por  ".$nombre." ".$apellido." . Este documento fue ".$tx.". <br>
	<br>Asunto:  ".$asunto."</br>
	<br></br>
	<br>Cordialmente, </br>
	<br>Sistema de Gesti&oacute;n Documental Orfeo
	</p>
	</body>
	</html>
	"));

         while ((!$exito) && ($intentos < 5) && $mail_usu!="") {
            $mail->ErrorInfo;
            $exito = $mail->Send();
           if (!$exito)
              {
                echo ("<br> No se pudo enviar correo");
              }else{
                echo("<br> Se ha enviado una notificaci&oacute;n a $mail_usu");
              }
            $intentos=$intentos+1;
            sleep(7);
         }


}//fin del envio de mail
}	//fin del if que verifica que nombre no este vacio
}//fin del ciclo
}	//fin del if que busca la coma
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
