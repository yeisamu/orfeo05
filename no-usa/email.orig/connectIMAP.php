<?
/**
  *  Conexion al Correo Electronico.
  *
  **/
 error_reporting(7);
 $PEAR_PATH = $_SESSION["PEAR_PATH"];
 require_once "$PEAR_PATH/Mail/IMAPv2.php";
 //require_once "$PEAR_PATH/Mail/IMAPv2/ManageMB/ManageMB.php";
 $passwdEmail=$_SESSION['passwdEmail'];
 $usuaEmail = $_SESSION['usuaEmail'];
 $usuaDoc = $_SESSION['usua_doc'];
 $usuario_mail=$_SESSION['usuario_mail'];
 $servidor_mail = $_SESSION['servidor_mail'];
 $puerto_mail = $_SESSION['puerto_mail'];
 $protocolo_mail = $_SESSION['protocolo_mail'];
 $tmpNameEmail = "tmpEmail_".$usuaDoc."_".md5(date("dmy hms")).".html";
 $_SESSION['tmpNameEmail'] = $tmpNameEmail;
 $tmpNameEmail = $_SESSION['tmpNameEmail']; 
 if(!$_SESSION['eMailPid'])
 {
  $_SESSION['eMailAmp']=$_GET['mid'];
  $_SESSION['eMailPid']=$_GET['pid'];
  $eMailPid = $_GET['pid'];
  $eMailMid = $_GET['mid'];
  
 }else{
  $eMailPid = $_SESSION['eMailPid'];
  $eMailMid = $_SESSION['eMailMid'];
  $eMailAmp = $_SESSION['eMailAmp'];
 }
 list($a,$b)=split("@",$usuaEmail);
 $usuaEmail1=$a;
 $buzon_mail = $_SESSION['buzon_mail'];
 $connection = "$protocolo_mail://$usuaEmail1:$passwdEmail@$servidor_mail:$puerto_mail/$buzon_mail#notls"; 
//echo "{$servidor_mail}$buzon_mail", "$usuaEmail1", "$passwdEmail";
 //$buzonImap = imap_open("{$servidor_mail}$buzon_mail", "$usuaEmail1", "$passwdEmail") or die("No es posible conectarse: Con imap de PHP" . imap_last_error());
 $buzonImap = imap_open("{".$servidor_mail.":".$puerto_mail."/notls}INBOX", "$usuaEmail1", "$passwdEmail") or die("No es posible conectarse: Con imap de PHP" . imap_last_error());
	
//echo $connection;
 if (!isset($_GET['dump_mid'])) {
  $msg =& new Mail_IMAPv2();
 } else {
  include  "$PEAR_PATH/Mail/IMAPv2/Debug/Debug.php";
  $msg =& new Mail_IMAP_Debug($connection);
  if ($msg->error->hasErrors()) {
  $msg->dump($msg->error->getErrors(FALSE));
  }
 }
//$msgMng = new Mail_IMAPv2_ManageMB($connection);
 // Open up a mail connection
 if (!$msg->connect($connection)) 
 {
  echo "<span style='font-weight: bold;'>Error:</span> No se pudo realizar la conexion al serv. de correo.";
 }
//print_r($msg);
?>
