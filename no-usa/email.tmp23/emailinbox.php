<?php
/************************************************************************
# PROYECTO: Orfeo  MODULO: Email - emailinbox.php  FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
# Muestra el contenido del inbox de una cuenta                          *
#                                                                       *
#  Una vez se ha proveido la contrasena, este programa es llamado en    *
#  marco inferior y despliega los correos en el inbox.                  *
#                                                                       *
#************************************************************************
# AUTOR DE ESTE MODULO:  Orfeo                                          *
#************************************************************************
# AUTORES DEL Superintendencia de Servicios Publicos D. de Colombia     *
#  PROYECTO:  Infometrika, Iyunxi y SkinaTech                           *
#             Comunidades Correlibre y Orfeolibre                       *
#************************************************************************
# LICENCIA: GNU/GPL                                                     *
#***********************************************************************/

// Ultima Modificacion Kasandra 2012-10    Agregamos templates documentacion

//error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

set_include_path(".:/usr/share/php:/usr/share/pear");



        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include '../config.php';
include 'email.inc.php';
include 'connectIMAP.php';

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

$TIT_Email_Entra="Email Entrante";
$TIT_Entradas_Pendientes="Entradas Pendientes";
$MSG_No_Servidor="No se pudo establecer coneccion con el Servidor."; 

        /********************************************************
        *           Variables  del archivo                      *
        ********************************************************/

$_SESSION['eMailAmp']="";
$_SESSION['eMailMid']="";
$_SESSION['eMailPid']="";
$_SESSION['fileeMailAtach']="";
$_SESSION['tipoMedio']="";

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

$krd =  $_SESSION["krd"];

$usuaEmail=$_SESSION['usuaEmail'];
$usuario_mail=$_SESSION['usua_email'];
$dominioEmail=$_SESSION['dominioEmail'];
if (! $_SESSION['passwdEmail']){
   $passwdEmail=$passwd_mail;
   $_SESSION['passwdEmail']=$passwd_mail;
}else{
   $passwdEmail=$_SESSION['passwdEmail'];
}
// echo $usuaEmail,"-",$usuario_mail,"-",$dominioEmail,"-",$passwdEmail,"+" ;

if(!$passwdEmail) {
    $splitEmail = split("@",$usuario_mail);
    $usuaEmail = $splitEmail[0];
    $dominioEmail = $splitEmail[1];
    $_SESSION['usuaEmail']=$usuaEmail;
    $_SESSION['dominioEmail']=$dominioEmail;
    $_SESSION['passwdEmail']=$passwd_mail;
}
if(!$dominioEmail){
    $splitEmail = split("@",$usuario_mail);
    $usuaEmail = $splitEmail[0];
    $dominioEmail = $splitEmail[1];
}

if($_GET['inboxEmail']){
    $buzon_mail = $_GET['inboxEmail'];
}else{
    $buzon_mail = "INBOX";
}

$_SESSION['buzon_mail'] = $buzon_mail ;

//------------------------------------------------------------------------------
$msgcount = $msg->messageCount();
?>
<html>
<head>
   <title> <?=$TIT_Entradas_Pendientes?> </title>
   <link rel="stylesheet" href="../estilos/orfeo.css" />
</head>
<body>
<?php
//echo " ". $msg->mailboxInfo['folder'].":(".$msgcount.") messages total.<br>.mailbox:".$msg->mailboxInfo['user'];
//echo var_dump($_SESSION);
?>
<table  class="borde_tab" width="100%">
<tr class="titulos3">
    <td colspan="5" align="center">EMAILS DE ENTRADA (<?=$usuaEmail?>@<?=$dominioEmail?>) Buzon <?=$buzon_mail?></td>
</tr>
<tr class="titulos5">
    <th> Asunto </th>
    <th> Remitente </th>
    <th> Fecha </th>
    <th> Adjuntos </th>
</tr>

<?php
if ($msgcount > 0) {
    $stl=1;
    for ($mid = 1; $mid <= $msgcount; $mid++) {
        // Lee las cabecera
        $msg->getHeaders($mid);
        $style = ((isset($msg->header[$mid]['Recent']) && $msg->header[$mid]['Recent'] == 'N') || (isset($msg->header[$mid]['Unseen']) && $msg->header[$mid]['Unseen'] == 'U'))? 'gray' : 'black';
        $msg->getParts($mid);
        if (!isset($msg->header[$mid]['subject']) || empty($msg->header[$mid]['subject'])) {
            $msg->header[$mid]['subject'] = "<span style='font-style: italic;'>no subject provided</a>";
        }

        echo " <tr class=listado$stl>",
             " <td class='msgitem'>
               <a href='mensaje.php?mid=$mid&amp;pid=".$msg->msg[$mid]['pid']."' target='image'>".
               sup_tilde($msg->header[$mid]['Subject'])
               ."</a>
               </td>\n".
             " <td class='msgitem'>\n".
             " ", (isset($msg->header[$mid]['from_personal'][0]) && !empty($msg->header[$mid]['from_personal'][0]))? '<span title="'.sup_tilde($msg->header[$mid]['from'][0]).'">'.sup_tilde($msg->header[$mid]['from_personal'][0])."</span>" : sup_tilde( $msg->header[$mid]['from'][0]), "\n",
             " </td>\n",
             " <td class='msgitem'>".date('D d M, Y h:i:s', $msg->header[$mid]['udate'])."</td>\n",
             " <td class='msgitem'>";
    
    /*   //Visualiza Inline Parts----------------------------------------------
         if (isset($msg->msg[$mid]['in']['pid']) && count($msg->msg[$mid]['in']['pid']) > 0) {
             foreach ($msg->msg[$mid]['in']['pid'] as $i => $inid) {
                 $fname = (isset($msg->msg[$mid]['in']['fname'][$i]))? $msg->msg[$mid]['in']['fname'][$i] : "No Disponible";
                 echo "<a href='attachement.php?mid=$mid&amp;pid=".$msg->msg[$mid]['in']['pid'][$i]."' target='_blank'><img src='../img/ath1.jpg' width=18 height=18 alt='".$fname."' title='".$fname."'></a><br />\n";
             }
         }
    */
        // Visualiza attachments----------------------------------------------

        if (isset($msg->msg[$mid]['at']['pid']) && count($msg->msg[$mid]['at']['pid']) > 0) {
            foreach ($msg->msg[$mid]['at']['pid'] as $i => $aid) {
                $fname = (isset($msg->msg[$mid]['at']['fname'][$i]))? $msg->msg[$mid]['at']['fname'][$i] : "No Disponible";
                echo "<a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['at']['pid'][$i]."' target='_blank'><img src='imagenes/attach.png' width=18 height=18 border=0 alt='".$fname."' title='".$fname."'></a>";
                $fname = (isset($msg->msg[$mid]['at']['fname'][$i]))? $msg->msg[$mid]['at']['fname'][$i] : NULL;
                echo " <a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['at']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['at']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['at']['fsize'][$i])."</a><br />\n";
                //echo "$fname";
            }
        } else
            echo "</br>";
        //echo "<a href='' ><img src='./iconos/anexos.gif' width=18 height=18 alt='Carpeta Actual: Entrada -- Numero de Hojas :0' title='Carpeta Actual: Entrada -- Numero de Hojas :0'></a>";
        echo "</td>";
        //echo "<td><a href='../radicacion/chequear.php?".session_name()."=".session_id()."&ent=2&eMailMid={$mid}&eMailAmp&eMailPid={$msg->msg[$mid]['pid']}&fileeMailAtach=".$fname."&tipoMedio=eMail'>Radicar</a></td>",    
        echo    "</tr>\n";
   /*
  // In-line Parts no borrar

        if (isset($msg->msg[$mid]['in']['pid']) && count($msg->msg[$mid]['in']['pid']) > 0) {
            foreach ($msg->msg[$mid]['in']['pid'] as $i => $inid) {
                 $fname = (isset($msg->msg[$mid]['in']['fname'][$i]))? $msg->msg[$mid]['in']['fname'][$i] : NULL;
                 echo " Inline part: <a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['in']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['in']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['in']['fsize'][$i])."</a><br />\n";
            }
        }
  // Attachments no borrar

        if (isset($msg->msg[$mid]['at']['pid']) && count($msg->msg[$mid]['at']['pid']) > 0) {
            foreach ($msg->msg[$mid]['at']['pid'] as $i => $aid) {
                 $fname = (isset($msg->msg[$mid]['at']['fname'][$i]))? $msg->msg[$mid]['at']['fname'][$i] : NULL;
                 echo " Attachment: <a href='attachement.php?mid={$mid}&amp;pid=".$msg->msg[$mid]['at']['pid'][$i]."' target='_blank'>".$fname." ".$msg->msg[$mid]['at']['ftype'][$i]." ".$msg->convertBytes($msg->msg[$mid]['at']['fsize'][$i])."</a><br />\n";
            }
        }
  */
        if($stl==1)
           $stl=2;
        else
           $stl=1;
    }
} else {
    echo "<tr><td colspan='3' style='font-size: 30pt; text-align: center; padding: 50px 0;'>No hay Mensajes</td></tr>";
}
echo "</table>";
echo"<div id='quota' align='center'>mailbox:".$msg->mailboxInfo['user']."<br/>";
if ($quota = $msg->getQuota()) {
    echo " Quota: {$quota['STORAGE']['usage']} useados de un total de{$quota['STORAGE']['limit']}\n";
}
$msg->close();
?>
</div>

<div align="center" >
<p>" &copy; BT, .<br /></p>
</div>
</body>
</html>
