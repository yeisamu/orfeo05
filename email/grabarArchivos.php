<?
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


// Ultima Modificacion Kasandra 2012-10    Agregamos templates documentacion

// error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);

if (!$ruta_raiz) $ruta_raiz = "..";

        /********************************************************
        *           Constantes del archivo                      *
        ********************************************************/


        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/

include "connectIMAP.php";
include "email.inc.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config.php";

        /********************************************************
        *                   Programa Principal                  *
        ********************************************************/



//$db->conn->debug =true;
//if(!$dependencia or !$krd) include ("../rec_session.php");
$encabezado = session_name()."=".session_id()."&krd=$krd&fechah=$fechah";

$iEmail = 0;
$eMailMid = $_GET['eMailMid'];
// $eMailMid = $_SESSION['eMailMid'];
if( $eMailMid != 0 ){
    $eMailPid = $_SESSION['eMailPid'];
    $body =$msg->getBody($eMailMid,$eMailPid);
    //lectura cabeceras----
   // echo 'body '.$body;
    $msg->getHeaders($eMailMid);
    $eMailRemitente = $_SESSION['eMailRemitente'];
    $eMailNombreRemitente = $_SESSION['eMailNombreRemitente'];
    if($body['ftype']=="text/html") $nl="</br>"; else $nl="\n";

   // print_r($msg->header);

    $remitente = sup_tilde($msg->header[$eMailMid]['fromaddresss'])." &lt;".sup_tilde($msg->header[$eMailMid]['from'][0])."&gt;";
    $head="<u><b>De:</b></u> $remitente<br>";
    $head .="<u><b>Para:</b></u> ".sup_tilde($msg->header[$eMailMid]['toaddresss'])." &lt;".sup_tilde($msg->header[$eMailMid]['to'][0])."&gt;";
    $head .="<u><b>Asunto:</b></u> ".sup_tilde($msg->header[$eMailMid]['Subject'])."<br>";
    $iMailMid = 0;
    $iMail = 0;
    foreach($msg->header[$eMailMid]['to_personal'] as $key => $value){
        if($iMail==0) {
            $head.="<u><b>Para:</b></u>";
        } else {
            $head.=", ";
        }
        $head.="".$msg->header[$eMailMid]['to_personal'][$iMail]."";
        $head.="< ".$msg->header[$eMailMid]['to'][$iMail]." >";
        $iMail++;
    }

    $headRadicado = "
<TABLE width=\"80%\" cellspacing=\"0\" border=\"1\" cellpadding=\"4\" >
<tr><td width=60%>$head</td>
<td border=1>
<FONT face='free3of9,FREE3OF9, FREE3OF9X' SIZE=12>*$nurad*</FONT><br>
    Radicado No. $nurad<br>
    Fecha : ".$msg->header[$eMailMid]['Date']."<br>";
    $headRadicado .= "<FONT SIZE=2>".$_SESSION['entidad']."<br>";
    $headRadicado .= "Consulte su Tramite en ".$_SESSION['pagina_web']."<br></FONT>
  </td></tr>
  </TABLE>
";
    
// Graba el Radicado 

//$body =$msg->getBody($eMailMid,1.2);
    $msg->getHeaders($eMailMid);
    if($body['ftype']=="text/html") {
         $aExtension="html"; 
         $nl = "<br>";
    }else{
         $aExtension="html";
         $nl = "<br>";
    }
   $tmpNameEmail = $nurad.".".$aExtension;
  // $directorio = substr($nurad,0,4) ."/". substr($nurad,4,$longitud_codigo_dependencia)."/";
    $anoBodega = substr($nurad,0,4) ."/";
    $depeBodega = substr($nurad,4,$longitud_codigo_dependencia)."/";
    $directorio = $anoBodega.$depeBodega;
    $fileRadicado = $ruta_raiz."/bodega/$directorio".$tmpNameEmail;
    $cuerpoMensaje = str_replace("\n","<br>",$body['message']);
    $archivoRadicado = $headRadicado . $head. " $nl ". $cuerpoMensaje;
    $file1=fopen($fileRadicado,'w');
    if ( $file1 == NULL ) {
       print ("Esto no abre el archivo");
    } 
    fputs($file1,$body['message']);
    fclose($file1);
    
    $msg->getParts($eMailMid);
// Finalizacion Grabacion de Radicado e inicio Grabacion de Attachment

    $numPartes =  count($msg->structure[$eMailMid]['obj']->parts);
    $radicadoAttach = "______________________________________________________________________________________$nl";
    $iMail = 0;

    if (count($msg->msg[$eMailMid]['at']['pid']) >= 0){
        // Forr para colocar los remitentes en el Texto 0, o del correo.
        if (count($msg->msg[$eMailMid]['at']['pid']) > 0) {
            $numPartesi=0;
            foreach ($msg->msg[$eMailMid]['at']['pid'] as $i => $aid) {
                echo "Archivo -->". $msg->structure[$eMailMid]['obj']->parts[$numPartesi]->dparameters[0]->value;
                $Pid = $aid;
                $body =$msg->getBody($eMailMid,$Pid);
                $msg->getHeaders($eMailMid);
                //$msg->getMailinboxes;
               //  print_r('mensaje de msg '.$msg);
                $fname = strtolower($msg->msg[$eMailMid]['at']['fname'][$i]);
                $aExtension = substr($fname,-3,3);
    
                $numPartesi++;
                $fn=$body['fname'];
                //--Variable con la Cabecera en formato html---------------------//
                //---------------------------------------------------------------//
                $codigoAnexo = $nurad."000$numPartesi";
                $tmpNameEmail = $nurad."_000".$numPartesi.".".$aExtension;
		$directorio = substr($nurad,0,4) ."/".substr($nurad,4,$longitud_codigo_dependencia)."/docs/";
                $fileEmailMsg = "../bodega/$directorio".$tmpNameEmail;
        
                $file1=fopen($fileEmailMsg,'w');
                $archivo = $body['message'];
                fputs($file1,$body['message']);
                fclose($file1);
                $anexoTamano = $msg->msg[$eMailMid]['at']['fsize'][$i];
                echo "<br>Grabado Archivo en ---> <a href='$fileEmailMsg'> $fn </a>";
                $radicadoAttach .= "< ". $fname ." Tama&ntilde;o :". $anexoTamano . " >";
                $fileEmailMsg = str_replace("..","",$fileEmailMsg);
                $fecha_hoy = Date("Y-m-d");
                if(!$db->conn) echo "No hay conexion";
                $sqlFechaHoy=$db->conn->DBDate($fecha_hoy);
                $record["ANEX_RADI_NUME"] =$nurad;
                $record["ANEX_CODIGO"] =$codigoAnexo;
                $record["ANEX_TAMANO"] ="'".$anexoTamano."'";
                $record["ANEX_SOLO_LECT"] ="'S'";
                $record["ANEX_CREADOR"] ="'".$krd."'";
                $record["ANEX_DESC"] ="' Archivo:.". $fname."'";
                $record["ANEX_NUMERO"] =$numPartesi;
                $record["ANEX_NOMB_ARCHIVO"] ="'".$tmpNameEmail."'";
                $record["ANEX_BORRADO"] ="'N'";
                $record["ANEX_DEPE_CREADOR"] =$dependencia;
                $record["SGD_TPR_CODIGO"] ='0';
                $record["ANEX_TIPO"] ="1";
                $record["ANEX_FECH_ANEX"] =$sqlFechaHoy;
                $db->insert("anexos", $record, "true");
            }
            $radicadoAttach = $radicadoAttach ."$nl ______________________________________________________________________________________";
            $archivoRadicado = $archivoRadicado . " $nl 
                                                                                    Documentos Adjuntos : 
                                                                                    $nl $radicadoAttach";
        }
        echo "<br> <h4> Documento de Radicado ---> <a href='$fileRadicado' target='image'> $fileRadicado </a></h4>";
        $file1=fopen($fileRadicado,'w');
        fputs($file1,$archivoRadicado);
        fclose($file1);
        str_replace('..','',$fileRadicado);
        $isqlRadicado = "update radicado set RADI_PATH = '$fileRadicado' where radi_nume_radi = '$nurad'";
        $rs=$db->conn->query($isqlRadicado);
        print("Ha efectuado la transaccion($isql)($dependencia)");
        if (!$rs) {  //Si actualizo BD correctamente
            echo "Fallo la Actualizacion del Path en radicado < $isqlRadicado >";
        }
    } else {
        print("No hay Correo disponible");
    }
}

//$msgMng->manageMail('move', array($eMailMid), 'trash');
?>
