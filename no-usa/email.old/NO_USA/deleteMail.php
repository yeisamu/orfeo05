<?
/************************************************************************
# PROYECTO: Orfeo   MODULO: Email - deleteMail.php FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
# Borra un correo electronico indicado                                  *
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

if (!$ruta_raiz) $ruta_raiz = "..";

set_include_path(".:/usr/share/php:/usr/share/pear");

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/

define('ADODB_ASSOC_CASE', 1); 

        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include_once $ruta_raiz."/include/db/ConnectionHandler.php";
include "connectIMAP.php";

       /********************************************************
        *                   Programa Principal                  *
        ********************************************************/


print_r($_SESSION);
//if(!$dependencia or !$tpDepeRad) include "$ruta_raiz/rec_session.php";
$tipoMed = $_GET['tipoMedio'];
$eMailMid = $_GET['eMailMid'];
$tmpNameEmail = $_SESSION['tmpNameEmail']; 


$db = new ConnectionHandler("$ruta_raiz");
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug =true;
//$sqlFechaHoy=$db->conn->query("select * from usuario");


$chequeo = imap_mailboxmsginfo($buzon_mail);
echo "Mensajes antes de borrar: " . $chequeo->Nmsgs . "<br />\n";
echo "a Borrar $eMailMid ";
imap_delete($buzonImap, $eMailMid);

$chequeo = imap_mailboxmsginfo($buzonImap);
echo "Mensajes después de borrar: " . $chequeo->Nmsgs . "<br />\n";

imap_expunge($buzonImap);

$chequeo = imap_mailboxmsginfo($buzonImap);
echo "Mensajes después de purgar: " . $chequeo->Nmsgs . "<br />\n";

imap_close($buzon);


?>
<html>
<head>
<title>:: Confirmaci&oacute;n Borrado de Mail ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos_totales.css">
</head>

<body bgcolor="#FFFFFF" text="#000000" topmargin="0">
Borrando el Correo Electr&oacute;nico . . ..
<form method=post action="deleteMail.php??nurad=<?=$nurad?>&faxPath=<?=$faxPath?>&faxRemitente=<?=$faxRemitente?>&<?=$var_envio?>">
	<input type=submit value='Borrar este Correo' name=deleteMail>
</form>

<?
$msg->imap_expunge();

$krd = $_SESSION['krd'];
$dependencia = $_SESSION['dependencia'];
// echo "<hr>$dependencia<hr>";
$var_envio=session_name()."=".trim(session_id())."&faxPath=$faxPath&leido=no&krd=$krd&ent=$ent&carp_per=$carp_per&carp_codi=$carp_codi&nurad=$nurad&depende=$depende&radi_usua_actu=radi_usua_actu";
if (strlen($nurad)==14) $consecutivo =6; else  $consecutivo =5; 
$x1=substr($nurad,0,4);
$x2=substr($nurad,4,3);
$x3=substr($nurad,7,$consecutivo);
$x4=substr($nurad,-1);
?> 
<center />

</center>
</body>
</html>
