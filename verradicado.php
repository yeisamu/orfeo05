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
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;


$imagenes=$_SESSION["imagenes"];
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre=$_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img =$_SESSION["tip3img"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$usuaPermExpediente = $_SESSION["usuaPermExpediente"];

$nomcarpeta=$_GET["nomcarpeta"];
$ruta_raiz = ".";

// Modificado Infom�trika 22-Julio-2009
// Compatibilidad con register_globals = Off
$verradicado = $_GET['verrad'];

// if (!isset($_SESSION['dependencia'])) include "./rec_session.php";
if (!isset($ent)) $ent = substr($verradicado, -1 );
if(!$carpeta) $carpeta = $carpetaOld;
if(!isset($menu_ver_tmpOld)) $menu_ver_tmpOld="";
if(!isset($menu_ver_tmp)) $menu_ver_tmp = $menu_ver_tmpOld;
if(!$menu_ver) $menu_ver = $menu_ver_Old;
if(!$menu_ver) $menu_ver=3;
if($menu_ver_tmp)	$menu_ver=$menu_ver_tmp;
if (!defined('ADODB_ASSOC_CASE')) define('ADODB_ASSOC_CASE', 1);
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.".".DIRECTORY_SEPARATOR."config.php";
include_once "./include/db/ConnectionHandler.php";
if($verradicado)	$verrad= $verradicado;
if(!$ruta_raiz)	$ruta_raiz=".";
$numrad = $verrad;
error_reporting(7);
$db = new ConnectionHandler(".");
$db->conn->SetFetchMode(3);
//$db->conn->debug = true;
if($carpeta==8)
{	$info=8;
	$nombcarpeta = "Informados";
}
include_once "$ruta_raiz/class_control/Radicado.php";
$objRadicado = new Radicado($db);
$objRadicado->radicado_codigo($verradicado);
$path = $objRadicado->getRadi_path();
/** verificacion si el radicado se encuentra en el usuario Actual
*
*/
include "$ruta_raiz/tx/verifSession.php";
?>
<html><head><title>.: Modulo total :.</title>
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<!-- seleccionar todos los checkboxes-->
<script language="JavaScript">
//Menu inferior visible
var visible = true;

 window.onload = function () {   }
 
function datosBasicos()
{
	window.location='radicacion/NEW.PHP?<?=session_name()."=".session_id()?>&<?="nurad=$verrad&fechah=$fechah&ent=$ent&Buscar=Buscar Radicado&carpeta=$carpeta&nomcarpeta=$nomcarpeta"; ?>';
}
function mostrar(nombreCapa)
{
	document.getElementById(nombreCapa).style.display="";
}
function ocultar(nombreCapa)
{
  document.getElementById(nombreCapa).style.display='none';
}
var contadorVentanas=0
<?
if($verradPermisos == "Full" or $datoVer=="985")
{	if($datoVer=="985")
	{
?>
function  window_onload(){
            <?
            if ($verradPermisos == "Full" or $datoVer == "985") {
                ?>
            	window_onload2();
                <?
            }
            ?>
        }
            <?
        }
        ?>
</script>

<?
include "js/pestanas.js";
?>

<script >
<?
}
else
{
?>
  function changedepesel(xx)
  {
  }
<?
}
?>

function window_onload2()
{
<?
if ($menu_ver==3)
{
	echo "ocultar_mod(); ";
	if ($ver_causal) {echo "ver_causales();"; }
	if ($ver_tema) {echo "ver_temas();"; }
	if ($ver_sectores) {echo "ver_sector();"; }
	if ($ver_flujo) {echo "ver_flujo();"; }
	//if ($ver_subtipo) {echo "verSubtipoDocto();"; }
	if ($ver_VinAnexo) {echo "verVinculoDocto();"; }
}
 ?>
}
function verNotificacion() {
   mostrar("mod_notificacion");
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   ocultar("mod_flujo");
}
function ver_datos()
{
   mostrar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   ocultar("mod_flujo");
}
function ocultar_mod()
{
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
   ocultar("mod_flujo");
}

function ver_tipodocumental()
{
<?
	if($menu_ver_tmp!=2)
	{
?>
	   ocultar("tb_general");
	   ocultar("mod_causales");
	   ocultar("mod_temas");
	   ocultar("mod_flujo");
<?	} ?>

}
function ver_tipodocumento()
{
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_flujo");
}

function verDecision()
{
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_flujo");
}

 function ver_tipodocuTRD(codserie,tsub)
 {
   <?php
 	//	echo "ver_tipodocumental(); ";
 		$isqlDepR = "SELECT RADI_DEPE_ACTU,RADI_USUA_ACTU from radicado
 		            WHERE RADI_NUME_RADI = '$numrad'";
 		$rsDepR = $db->conn->Execute($isqlDepR);
 		$coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
 		$codusua = $rsDepR->fields['RADI_USUA_ACTU'];
 		$ind_ProcAnex="N";
   ?>
   window.open("./radicacion/tipificar_documento.php?nurad=<?=$verrad?>&ind_ProcAnex=<?=$ind_ProcAnex?>&codusua=<?=$codusua?>&coddepe=<?=$coddepe?>&codusuario=<?=$codusuario?>&dependencia=<?=$dependencia?>&tsub="+tsub+"&codserie="+codserie,"Tipificacion_Documento","height=500,width=750,scrollbars=yes");
 }

function ver_notificacionR(tNotNotifica,tNotNotificado,tNotObserva,tFechNot,tipoNotific)
 {
   <?php
                $isqlDepR = "SELECT RADI_DEPE_ACTU,RADI_USUA_ACTU from radicado
                            WHERE RADI_NUME_RADI = '$numrad'";
                $rsDepR = $db->conn->Execute($isqlDepR);
                $coddepe = $rsDepR->fields['RADI_DEPE_ACTU'];
                $codusua = $rsDepR->fields['RADI_USUA_ACTU'];
                $ind_ProcAnex="N";
   ?>
   window.open("./notificacion/notificacion.php?nurad=<?=$verrad?>&codusua=<?=$codusua?>&coddepe=<?=$coddepe?>&codusuario=<?=$codusuario?>&dependencia=<?=$dependencia?>&radi_fech_radi=<?=$radi_fech_radi?>&nomcarpeta=<?=$nomcarpeta?>&mostrar_opc_envio=<?=$mostrar_opc_envio?>&carpeta=<?=$carpeta?>&leido=<?=$leido?>&tNotNotifica="+tNotNotifica+"&tNotNotificado="+tNotNotificado+"&tNotObserva="+tNotObserva+"&tFechNot="+tFechNot+"&tipoNotific="+tipoNotific,"NotificaciondeResolucion","height=300,width=500,scrollbars=yes");
 }

function verVinculoDocto()
{
<?php
	//	echo "ver_tipodocumental(); ";
  ?>
  window.open("./vinculacion/mod_vinculacion.php?verrad=<?=$verrad?>&codusuario=<?=$codusuario?>&dependencia=<?=$dependencia?>","Vinculacion_Documento","height=500,width=750,scrollbars=yes");
}


function verResolucion()
{
   ocultar("tb_general");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_flujo");
   ocultar("mod_tipodocumento");
   mostrar("mod_resolucion");
   ocultar("mod_notificacion");
}

function ver_temas()
{
   ocultar("tb_general");
   ocultar("mod_tipodocumento");
   ocultar("mod_causales");
   ocultar("mod_sector");
   ocultar("mod_flujo");
   ocultar("mod_tipodocumento");
   mostrar("mod_temas");
   ocultar("mod_resolucion");
   ocultar("mod_notificacion");
}

function ver_flujo()
{
   mostrar("mod_flujo");
   ocultar("tb_general");
   ocultar("mod_tipodocumento");
   ocultar("mod_causales");
   ocultar("mod_temas");
   ocultar("mod_sector");
  // mostrar("mod_flujo");
   ocultar("mod_resolucion");
   ocultar("mod_notificacion");
}

function hidden_tipodocumento(){
<?
if (!$ver_tipodoc) {
    ?>
          //ocultar_mod();
    <?
}
?>

}
/** FUNCION DE JAVA SCRIPT DE LAS PESTA�S
  * Esta funcion es la que produce el efecto de pertanas de mover a,
  * Reasignar, Informar, Devolver, Vobo y Archivar
  */
</script>

<div id="spiffycalendar" class="text"></div>
<script language="JavaScript" src="js/spiffyCal/spiffyCal_v2_1.js"></script>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css">
</head>
<?php
// Modificado Supersolidaria
if( isset( $_GET['ordenarPor'] ) && $_GET['ordenarPor'] != "" )
{
    $body = "document.location.href='#t1';";
}
?>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();<? print $body; ?>">

<?
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$fechah=date("dmy_h_m_s") . " ". time("h_m_s");
	$check=1;
	$numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
	 ?>
 	 <?
 	 include "ver_datosrad.php";
   		if($verradPermisos == "Full" or $datoVer=="985")
 		{

 		}else
 		{
 			$numRad = $verrad;
 			if($nivelRad==1) include "$ruta_raiz/seguridad/sinPermisoRadicado.php";
 			if($nivelRad==1) die("-");
 		}
 ?>
    
<center>
    <br>
<div id="titulo" style="width: 95%;" align="center">
    <table border=0 width=95%  cellpadding="0" cellspacing="5" class="borde_tab">
     <tr>
       <td class="titulos2"><A class=vinculosCabezote HREF='javascript:history.back();'>Página Anterior</A></td>
       <td width=55% class="titulos2">
    <?
     if($krd)
            {
            $isql = "select * From usuario where USUA_LOGIN ='$krd' and USUA_SESION='". substr(session_id(),0,29)."' ";
            $rs = $db->query($isql);
            // Validacion de Usuario y COntrase� MD5
            //echo "** $krd *** $drde";
            //Modificado por idrd
            if (($krd)){
            //  $iusuario = " and us_usuario='$krd'";
            //  $isql = "select a.* from radicado a where radi_depe_actu=$dependencia  and radi_nume_radi=$verrad";
      ?>
            Datos del radicado No:
            <?
            if ($mostrar_opc_envio==0 and $carpeta!=8 and !$agendado)
            {
                    $ent=substr($verrad, -1);
            echo "<a aria-label='Datos del radicado número' class='vinculosCabezote' title='Click para modificar el Documento' href='./radicacion/NEW.php?nurad=$verrad&Buscar=BuscarDocModUS&".session_name()."=".session_id()."&Submit3=ModificarDocumentos&Buscar1=BuscarOrfeo78956jkgf' notborder >$verrad</a>";
            }else echo $verrad;

        /*
         *  Modificado: 15-Agosto-2006 Supersolidaria
         *  Muestra el numero del expediente al que pertenece el radicado.
             */
            if( $numExpediente && $_GET['expIncluido'][0] == "" )
        { 
            echo "<span class=noleidos>&nbsp;&nbsp;&nbsp;PERTENECIENTE AL EXPEDIENTE No. ". ( $_SESSION['numExpedienteSelected'] != "" ?  $_SESSION['numExpedienteSelected'] : $numExpediente )."</span>";
            }
        else if( $_GET['expIncluido'][0] != "" ){
            echo "<span class=noleidos>&nbsp;&nbsp;&nbsp;PERTENECIENTE AL EXPEDIENTE No. ".$_GET['expIncluido'][0]."</span>";
            $_SESSION['numExpedienteSelected'] = $_GET['expIncluido'][0];
            }
            ?>
            </td>
            <?
            $datosaenviar = "fechaf=$fechaf&mostrar_opc_envio=$mostrar_opc_envio&tipo_carp=$tipo_carp&carpeta=$carpeta&nomcarpeta=$nomcarpeta&datoVer=$datoVer&ascdesc=$ascdesc&orno=$orno";
            ?>
            <td height="20" class="titulos2">Listado&nbsp;de:&nbsp;<?= $nomcarpeta ?> </td>

            <td class="titulos2">
          <a aria-label="Enlace para revisar estado de reservas del usuario actual" class="vinculosCabezote" href='./solicitar/Reservas.php?radicado=<?="$verrad"?>'>Solicitados</a>
        </td>
        <td class="titulos2">
          <a aria-label="Enlace para solicitar el documento físico del radicado actual" class="vinculosCabezote" href='./solicitar/Reservar.php?radicado=<?="$verrad&sAction=insert"?>'>Solicitar&nbspFísico</a>
        </td>
      </tr>
    </table>
</div>
</center>
<form name="form1" id="form1" action="<?=$ruta_raiz?>/tx/formEnvio.php?<?=session_name()?>=<?=session_id()?>" method="GET">
<?
if($verradPermisos=="Full"){
	include "$ruta_raiz/tx/txOrfeo.php";
}
else{
?>

<?
}
?>
 <script>
     //Ajustar ancho de barra de acciones del radicado
   barra = document.getElementById('menuListar');
   barra.style.width="95%";
   barra.style.marginTop="9px";
 </script>
<input type=hidden name='checkValue[<?=$verrad?>]' value='CHKANULAR'>
<input type=hidden name=enviara value='9'>
</form>

<table border=1 align='center'  cellpadding="0" cellspacing="0" width="95%" ><form action='verradicado.php?<?=session_name()?>=<?=trim(session_id())?>&verrad=<?=$verrad?>&datoVer=<?=$datoVer?>&chk1=<?=$verrad."&carpeta=$carpeta&nomcarpeta=$nomcarpeta"?>' method='GET' name='form2'>
 <?
  echo "<input type='hidden' name='fechah' value='$fechah'>";
  // Modificado Infom�trika 22-Julio-2009
  // Compatibilidad con register_globals = Off.
  print "<input type='hidden' name='verrad' value='".$verrad."'>";
	if($flag==2)
		{
		echo "<CENTER>No se ha podido realizar la consulta<CENTER>";
		}
	else
		{
		$row = array();
		$row1 = array();
		if($info)
			{
			$row["INFO_LEIDO"]=1;
			$row1["DEPE_CODI"] = "'".$dependencia."'";
			$row1["USUA_CODI"] = $codusuario;
			$row1["RADI_NUME_RADI"] = "'".$verrad."'";
			$rs = $db->update("informados", $row, $row1);
			}
		elseif (($leido!="no" or !$leido) and $datoVer!=985)
			{
			$row["RADI_LEIDO"]=1;
			$row1["radi_depe_actu"] = "'".$dependencia."'";
			$row1["radi_usua_actu"] = $codusuario;
			$row1["radi_nume_radi"] = "'".$verrad."'";
			$rs = $db->update("radicado", $row, $row1);
			}
				}
include "ver_datosrad.php";
include "ver_datosgeo.php";
$tipo_documento .= "<input type=hidden name=menu_ver value='$menu_ver'>";
$hdatos = session_name()."=".session_id()."&leido=$leido&nomcarpeta=$nomcarpeta&tipo_carp=$tipo_carp&carpeta=$carpeta&verrad=$verrad&datoVer=$datoVer&fechah=fechah&menu_ver_tmp=";
?>
    <tr>
      <!--<td height="99" rowspan="4" width="3%" valign="top" class="listado2">&nbsp;</td>-->
      <td height="8" width="94%" class="titulos3">
<!--           <?
		     $datos1 = "";$datos2 = "";$datos3 = "";$datos4 = "";$datos5 = "";
//                     Mecanismo anterior colocaba _R para resaltar la etiqueta
//			 if($menu_ver==5){$datos5 = "_R";}
			 if($menu_ver==5){$datos5 = "tabberactive";}
			 if($menu_ver==1){$datos1 = "tabberactive";}
			 if($menu_ver==2){$datos2 = "tabberactive";}
			 if($menu_ver==3){$datos3 = "tabberactive";}
			 if($menu_ver==4){$datos4 = "tabberactive";}
		  ?>

        <table border=0 width=69% cellpadding="0" cellspacing="0">
          <tr>
            <td width="13%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar la información general del radicado seleccionado" href='verradicado.php?<?=$hdatos ?>3' ><img src='<?=$imagenes?>/infoGeneral<?=$datos3?>.gif' alt='' border=0 width="110" height="25"></a></td>
            <td width="13%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar el historial del radicado seleccionado" href='verradicado.php?<?=$hdatos ?>1' ><img src='<?=$imagenes?>/historico<?=$datos1?>.gif' alt='' border=0 width="110" height="25" ></a></td>
            <td width="13%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar los documentos anexados al radicado seleccionado" href='verradicado.php?<?=$hdatos ?>2' ><img src='<?=$imagenes?>/documentos<?=$datos2?>.gif' alt='' border=0 width="110" height="25" ></a></td>
            <td width="61%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar el o los expedientes a los que pertenece el radicado seleccionado" href='verradicado.php?<?=$hdatos ?>4' ><img src='<?=$imagenes?>/expediente<?=$datos4?>.gif' alt='' border=0 width="110" height="25"  ></a></td>
            <td width="61%" valign="bottom" class="" >&nbsp;</td>
          </tr>
        </table>-->
          
          <table border=0 width=69% cellpadding="0" cellspacing="0">
          <tr>
              <td>
                  <ul class="tabbernav">
                  <li class='<?=$datos3?>'>
                      <a id="opGeneral" title="Básicos" href='verradicado.php?<?=$hdatos ?>3'>Información general</a>
                  </li>
                  <li class="<?=$datos1?>">
                      <a id="opHistorico" title="Consecutivos" href='verradicado.php?<?=$hdatos ?>1'>Histórico</a>
                  </li>
                  <li class="<?=$datos2?>">
                      <a id="opDocumentos" title="Consecutivos" href='verradicado.php?<?=$hdatos ?>2'>Documentos</a>
                  </li>
                  <li class="<?=$datos4?>">
                      <a id="opExpedientes" title="Consecutivos" href='verradicado.php?<?=$hdatos ?>4'>Expedientes</a>
                  </li>
              </ul>
               </td>       
<!--            <td width="13%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar la información general del radicado seleccionado" href='verradicado.php?<?=$hdatos ?>3' ><img src='<?=$imagenes?>/infoGeneral<?=$datos3?>.gif' alt='' border=0 width="110" height="25"  ></a></td>
            <td width="13%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar el historial del radicado seleccionado" href='verradicado.php?<?=$hdatos ?>1' ><img src='<?=$imagenes?>/historico<?=$datos1?>.gif' alt='' border=0 width="110" height="25" ></a></td>
            <td width="13%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar los documentos anexados al radicado seleccionado" href='verradicado.php?<?=$hdatos ?>2' ><img src='<?=$imagenes?>/documentos<?=$datos2?>.gif' alt='' border=0 width="110" height="25" ></a></td>
            <td width="61%" valign="bottom" class="" ><a alt="Enlace gráfico para consultar el o los expedientes a los que pertenece el radicado seleccionado" href='verradicado.php?<?=$hdatos ?>4' ><img src='<?=$imagenes?>/expediente<?=$datos4?>.gif' alt='' border=0 width="110" height="25"></a></td>-->
          </tr>
        </table>
          
      </td>
      <!--<td height="149" rowspan="4" class="" width="3%">&nbsp;</td>-->
    </tr>
    <tr >
      <td  bgcolor="" width="94%" height="100">
          <?
		  error_reporting(7);
		  switch ($menu_ver) {	
		  	case 1:
				include "ver_historico.php";
				break;
			case 2:
				include "./lista_anexos.php";
				break;
			case 3:
				include "lista_general.php";
				break;
			case 4:
				include "./expediente/lista_expediente.php";
				break;
			case 5:
				include "plantilla.php";
				break;
                	default:break;
            }
		  ?>
      </td>
    </tr>
    <input type=hidden name=menu_ver value='<?=$menu_ver ?>'>
    <tr>
      <!--<td height="17" width="94%" class="celdaGris">--> 
        <?
	}else {
	?>  </td>
  </tr>
</table>
	   <form name='form1' action='enviar.php' method='GET'>
	   <input type=hidden name=depsel>
	   <input type=hidden name=depsel8>
	   <input type=hidden name=carpper>
	   <CENTER>
       <span class='eerrores'>Su sesión ha terminado o ha sido iniciada en otro equipo</span><BR>
       <span class='eerrores'>
       </CENTER></form>
           <?
		   }
			}else {
                            echo "<center><b><span class='eerrores'>NO TIENE AUTORIZACION PARA INGRESAR</span><BR><span class='eerrores'><a href='login.php' target=_parent>Por Favor intente validarse de nuevo. Presione aca!</span></a>";}
?> </td>
    </tr>
<!--    <tr>
      <td height="15" width="94%" class="listado2">&nbsp;</TD>
    </tr>-->
</form>
</table>
<br>
</body>
</html>
