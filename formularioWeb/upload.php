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


session_start();
/**
  * Modificacion Variables Globales Infometrika 2009-05
  * Licencia GNU/GPL 
  */

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];

$ruta_raiz = ".";

echo "<script>
    function f_close(){
        window.opener.location.reload();
        window.close();
    }
    </script>
";

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
function return_bytes($val)
{       $val = trim($val);
        $ultimo = strtolower($val{strlen($val)-1});
        switch($ultimo)
{       // El modificador 'G' se encuentra disponible desde PHP 5.1.0
                case 'g':       $val *= 1024;
                case 'm':       $val *= 1024;
                case 'k':       $val *= 1024;
        }
        return $val;
}
//$userfile1_Size = $_FILES['userfile1']['size'];

if ((!$codigo && $_FILES['userfile1']['size']==0)||($codigo && $_FILES['userfile1']['size']>=return_bytes(ini_get('upload_max_filesize')))) {
    die("<table><tr><td>El tama&ntilde;o del archivo no es correcto.</td></tr><tr><td><li>se permiten archivos de ".ini_get('upload_max_filesize')." m&aacute;ximo.</td></tr><tr><td><input type='button' value='cerrar' onclick='opener.regresar();window.close();'></td></tr></table>");

}
print ("Entra....");
$fechaHoy = Date("Y-m-d");
if (!$ruta_raiz) $ruta_raiz= ".";
include_once("$ruta_raiz/class_control/anexo.php");
include_once("$ruta_raiz/class_control/anex_tipo.php");
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."config.php";
session_start();
if (!isset($_SESSION['dependencia']))   include "./rec_session.php";

$db = new ConnectionHandler($ruta_raiz);
//$db->conn->debug=true;

$sqlFechaHoy= $db->conn->OffsetDate(0,$db->conn->sysTimeStamp);
$anex = & new Anexo($db);
$anexTip = & new Anex_tipo($db);

if (!$aplinteg)
        $aplinteg='null';
if (!$tpradic)
        $tpradic='null';
if(!$cc)
{       error_reporting(7);
        session_start();
        if($codigo)
		$nuevo="no";
        else
                $nuevo="si";
        if ($sololect)
                $auxsololect="S";
        else
                $auxsololect="N";
        $db->conn->BeginTrans();
        if($nuevo=="si")
        {       $auxnumero=$anex->obtenerMaximoNumeroAnexo($numrad);
                do
                {       $auxnumero+=1;
                        $codigo=trim($numrad).trim(str_pad($auxnumero,5,"0",STR_PAD_LEFT));
                }while ($anex->existeAnexo($codigo));
        }
        else
        {       $bien = true;
        $auxnumero=substr($codigo,-4);
        $codigo=trim($numrad).trim(str_pad($auxnumero,5,"0",STR_PAD_LEFT));
        }
        if($radicado_salida)
        {       $anex_salida = 1;       }
        else
        {       $anex_salida = 0;       }

        $bien = "si";

        if ($bien and $tipo)
        {       error_reporting(7);
                $anexTip->anex_tipo_codigo($tipo);

                $ext=$anexTip->get_anex_tipo_ext();
                $ext = strtolower($ext);
                $auxnumero = str_pad($auxnumero,5,"0",STR_PAD_LEFT);
                $archivo=trim($numrad."_".$auxnumero.".".$ext);
                $archivoconversion=trim("1").trim(trim($numrad)."_".trim($auxnumero).".".trim($ext));
        }
 if(!$radicado_rem)
                $radicado_rem=7;
        if($_FILES['userfile1']['size'])
        {
                $tamano = ($_FILES['userfile1']['size']/1000);
        }else
        {
          $tamano = 0;
        }
        if ($nuevo=="si")
        {
                // $radi = radicado padre
                // $radicado_rem = Codigo del tipo de remitente = sgd_dir_tipo
                // $codigo = ID UNICO DE LA TABLA
                // $tamano = tamano del archivo
                // $auxsololect = solo lectura?
                // $usua = usuario creador
                // $descr = Descripcion, el asunto
                // $auxnumero = Es codigo del consecutivo del anexo al radicado
                // Esta borrado?
                // $anex_salida = marca con 1 si es un radicado de salida

                include "$ruta_raiz/include/query/queryUpload2.php";
                if ($expIncluidoAnexo) {
                        $expAnexo =     $expIncluidoAnexo;
                }else {
                        $expAnexo = null;
                }
                IF(!$anex_salida && $tpradic) $anex_salida=1;
                $isql = "insert into anexos
                                (sgd_rem_destino,anex_radi_nume,anex_codigo,anex_tipo,anex_tamano   ,anex_solo_lect,anex_creador,anex_desc,anex_numero,anex_nomb_archivo   ,anex_borrado,anex_salida ,sgd_dir_tipo,anex_depe_creador,sgd_tpr_codigo,anex_fech_anex,SGD_APLI_CODI,SGD_TRAD_CODIGO, SGD_EXP_NUMERO)
                   values ($radicado_rem  ,'$numrad'         ,'$codigo'    ,$tipo    ,$tamano     ,'$auxsololect','$krd'     ,'$descr' ,$auxnumero ,'$archivoconversion','N'         ,$anex_salida,$radicado_rem,'$dependencia',null,$sqlFechaHoy,        $aplinteg    ,$tpradic, '$expAnexo' ) ";
                $subir_archivo= "si ...";
        }
        else
        {
if($userfile1) $subir_archivo = " anex_nomb_archivo='1$archivo',anex_tamano = $tamano,anex_tipo=$tipo, "; else {$subir_archivo="";}
                $isql = "update anexos set $subir_archivo anex_salida=$anex_salida,sgd_rem_destino=$radicado_rem,sgd_dir_tipo=$radicado_rem,anex_desc='$descr', SGD_TRAD_CODIGO = $tpradic, SGD_APLI_CODI = $aplinteg  where anex_codigo='$codigo'";
        }

//$db->conn->debug=true;
        // print ("trata doss codigo($codigo)($nuevo)");
    $bien=$db->query($isql);
        //print("Ha efectuado la transaccion($isql)($dependencia)");

        if ($bien)      //Si actualizo BD correctamente
        {       $respUpdate="OK";
                $bien2 = false;
                if ($subir_archivo)
                {
                        //include dirname(__FILE__).DIRECTORY_SEPARATOR.".".DIRECTORY_SEPARATOR."config.php";
                        $directorio="./bodega/".substr(trim($archivo),0,4)."/".strtoupper(substr(trim($archivo),4,$longitud_codigo_dependencia))."/docs/";
                        $userfile1_Temp = $_FILES['userfile1']['tmp_name'];
                        $bien2=move_uploaded_file($userfile1_Temp,$directorio.trim($archivoconversion));
                        if ($bien2)     //Si intento anexar archivo y Subio correctamente
                        {       $resp1="OK";
                                $db->conn->CommitTrans();
                        }
                        else
                        {       $resp1="ERROR";
                                $db->conn->RollbackTrans();

                        }
                }
                else {
                        $db->conn->CommitTrans();

                }
        }
        else{
                $db->conn->RollbackTrans();

        }
}
//include "nuevo_archivo.php";
?>
