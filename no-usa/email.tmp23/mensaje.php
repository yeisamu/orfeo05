<?php
/************************************************************************
# PROYECTO: Orfeo   MODULO: Email - mensaje.php    FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
# Despliega un mensaje del buzon de correo electronico                  *
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

// error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);

session_start();
if(!isset($_SESSION['krd'])) include "../rec_session.php";

foreach ($_GET as $key => $valor)  ${$key} = $valor;
foreach ($_POST as $key => $valor) ${$key} = $valor;

if (!$ruta_raiz) $ruta_raiz = "..";

set_include_path(".:/usr/share/php:/usr/share/pear");

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include($ruta_raiz.'/config.php');
include "email.inc.php";
include "connectIMAP.php";

       /********************************************************
        *                   Programa Principal                  *
        ********************************************************/

?>
<html>
<HEAD>
   <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
   <link rel="stylesheet" href="../estilos/orfeo.css" />
   <STYLE TYPE="text/css">
    #flotante { position: absolute; top:100; left: 550px; visibility: visible;}
  </STYLE>
</HEAD>
<BODY>
<?
// print_r($_SESSION);
$encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";
//---------- Las acciones .. radicar o forwardiar --------------//
?>
<table  class="borde_tab" width="50%">
<tr class="titulos5">
    <td><b><font size=3><a href='../radicacion/NEW.php?<?=session_name()?>=<?=session_id()?>&ent=2&eMailMid=<?=$mid?>&eMailAmp=<?=$eMailAmp?>&eMailPid=<?=$eMailPid?>&fileeMailAtach=<?=$fname?>&tipoMedio=eMail' target='formulario'>Radicar Este Correo</a></font></b>
    </td>
    <td><b><font size=3><a href='forwardMail.php?<?=session_name()?>=<?=session_id()?>&ent=2&eMailMid=<?=$mid?>&eMailAmp=<?=$eMailAmp?>&eMailPid=<?=$eMailPid?>&fileeMailAtach=<?=$fname?>&tipoMedio=eMail' >Reenviar</a></font></b>
    </TD>
    <td><b><font size=3><a href='deleteMail.php?<?=session_name()?>=<?=session_id()?>&ent=2&eMailMid=<?=$mid?>&eMailAmp=<?=$eMailAmp?>&eMailPid=<?=$eMailPid?>&fileeMailAtach=<?=$fname?>&tipoMedio=eMail' >Eliminar</a></font></b>
    </TD>
    </TR>
</table>
<br>
<?
//----------- Imprime el correo escogido  ----------------------//
if(isset($_GET['mid'])&&isset($_GET['pid'])){
    $body =$msg->getBody($_GET['mid'], $_GET['pid']);
    //lectura cabeceras----
    $msg->getHeaders($mid);
    $eMailRemitente = $_SESSION['eMailRemitente'];
    $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
    if($body['ftype']=="text/html")
        $nl="</br>"; 
    else
        $nl="<br>";
    
//---Encabezado de email-----------------------------------------------------//
//  print_r ($msg->header[$mid] );
    $contenidoEmail = $head;
    $contenidoEmail .= $body['message'];

    $head="<u><b>De:</b></u> ". sup_tilde($msg->header[$mid]['fromaddress'])." &lt;".sup_tilde($msg->header[$mid]['from'][0])."&gt;$nl";
    $head .="<u><b>Para:</b></u> ". sup_tilde($msg->header[$mid]['toaddress'])." &lt;".sup_tilde($msg->header[$mid]['to'][0])."&gt;$nl";
    $head .="<u><b>Asunto:</b></u> ".sup_tilde($msg->header[$mid]['Subject'])."<BR>";
    // Los otros paras (?? aun no funciona )
    $iMail = 0;
    if(count($msg->header[$mid]['to_personal'])>=1) {
        foreach($msg->header[$mid]['to_personal'] as $key => $value){
            if($iMail==0) 
                $head.="<u><b>Para:</b></u> ";
            else 
                $head.=", ";
            $head.="".sup_tilde($msg->header[$mid]['to_personal'][$iMail])."";
            $head.="< ".$msg->header[$mid]['to'][$iMail]." >";
            $iMail++;
        }   
    }
    $head.="$nl   <u><b>Enviado Desde Serv:</b></u> ". $msg->header[$mid]['sender_host'][0]."";

    $headRadicado = "
<TABLE width=\"80%\" cellspacing=\"0\" border=\"1\" cellpadding=\"4\" >
    <tr><td width=60%>$head</td>
    <td>
        <FONT face='free3of9,FREE3OF9, FREE3OF9X' SIZE=12>*$nurad*</FONT><br>
        <u><b>Radicado No.</b></u>  $nurad<br><br>
        <u><b>Fecha:</b></u> ".$msg->header[$mid]['Date']."
    </td>
    </tr>
</TABLE>
";

//----------------------------------------------------------------------------//
    //$head =$headRadicado . $head;

    //echo $head;
    echo $headRadicado;
    echo "<br>";
    echo str_replace("\n","<br>",$body['message']);
    $content = "". $head . $body['message'];
}else{
     print("No hay Correo disponible");
}
$fn=$body['fname'];
//--Variable con la Cabecera en formato html----------------------------------//
$nl="<br>";
?>
</BODY>
</html>
