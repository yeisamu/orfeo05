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
//include ('config.php');
include_once("config.php");

foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

if(isset($_GET["tipo_carp"]))  $tipo_carp = $_GET["tipo_carp"];

if (isset($_SESSION["krd"])) $krd = $_SESSION["krd"];
if (isset($_SESSION["dependencia"])) $dependencia = $_SESSION["dependencia"];
if (isset($_SESSION["usua_doc"])) $usua_doc = $_SESSION["usua_doc"];
if (isset($_SESSION["codusuario"])) $codusuario = $_SESSION["codusuario"];
if (isset($_SESSION["tip3Nombre"])) $tip3Nombre=$_SESSION["tip3Nombre"];
if (isset($_SESSION["tip3desc"])) $tip3desc = $_SESSION["tip3desc"];
if (isset($_SESSION["tip3img"])) $tip3img =$_SESSION["tip3img"];
if (isset($_SESSION["tpNumRad"])) $tpNumRad = $_SESSION["tpNumRad"];
if (isset($_SESSION["tpPerRad"])) $tpPerRad = $_SESSION["tpPerRad"];
if (isset($_SESSION["tpDescRad"])) $tpDescRad = $_SESSION["tpDescRad"];
if (isset($_SESSION["tip3Nombre"])) $tip3Nombre = $_SESSION["tip3Nombre"];
if (isset($_SESSION["ESTILOS_PATH"])) $ESTILOS_PATH= $_SESSION["ESTILOS_PATH"];
if (isset($_SESSION["imagenes"])) $imagenes= $_SESSION["imagenes"];
$ruta_raiz = ".";

if(!isset($_SESSION['dependencia'])) include "./rec_session.php";
if (isset($carpetano)) $carpeta=$carpetano;
else $carpeta='';

if (!isset($dep)) $dep = $dependencia;
//if (!isset($faxPath)) $faxPath = dirname(__FILE__);

include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug = true;
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
/* Modificacion Skina
 * Se comenta, no se usa en la versiòn actual, no existe la estructura
 * en la base de datos para parametrizar.
 * Ing Camilo Pintor - cpintor@skinatech.com
 * Agosto 2015


include("$ruta_raiz/class_control/Param_admin.php"); 
$param=Param_admin::getObject($db,'%','ALERT_FUNCTION');

 Fin Modificacion Skina */

require("include/xajax/xajax.inc.php");
$xajax = new xajax(); 
$xajax->registerExternalFunction("updateInBox", "inBox_xajax.php");
$xajax->registerExternalFunction("updateFolders", "inBox_xajax.php");
//$xajax->debugOn();
$xajax->processRequests();
?>
<html>
<head>
<link rel="stylesheet" href="<?=$ruta_raiz.$ESTILOS_PATH?>orfeo.css"><script type="text/javascript" language="javascript">
/* 	FUNCION QUE MUESTRA LA VENTANA DE NOVEDADES DE USUARIO
	Busca los radicados de entrada o internos que le llegaron al usuario.
	Además los documentos que le devolvieron,
	le reasignaron, le informaron, le dieron visto bueno.
*/
/*
 *	La funcion updateFolders es la encargada de verificar
	los contenidos de las carpetas del usuario que se
	encuentra en la sesion actual,

	El intervalo de tiempo para hacer estas consultas se
	define en la funcion setTimeout
 */
function showInBox()
{   xajax_updateInBox('<?php echo $_SESSION['usua_doc']?>');
    setTimeout(showInBox, 10000);
}

// refresca las carpetas de documentos
function updateFolders()
{
    xajax_updateFolders('<?php echo $krd ?>');
    setTimeout(updateFolders, 10000);
}
</script>
<?php
$xajax->printJavascript('include/xajax/'); 
?><script type="text/javascript">
// Variable que guarda la �ltima opci�n de la barra de herramientas de funcionalidades seleccionada
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

function reload_window($carpetano,$carp_nomb,$tipo_carp)
{
	document.write("<form action=cuerpo.php?<?=session_name()."=".session_id()?>&krd=<?=$krd?>&ascdesc=desFc method=post name=form4 target=mainFrame>");
	document.write("<input type=hidden name=carpetano value=" + $carpetano + ">");
	document.write("<input type=hidden name=carp_nomb value=" + $carp_nomb + ">");
	document.write("<input type=hidden name=tipo_carpp value=" + $tipo_carp + ">");
	document.write("<input type=hidden name=tipo_carpt value=" + $tipo_carpt + ">");
	document.write("</form>");
	document.form4.submit();
}
selecMenuAnt=-1;
swVePerso = 0;
numPerso = 0;
function cambioMenu(img){

		MM_swapImage('plus' + img,'','<?=$imagenes?>/menuraya.gif',1);

	if (selecMenuAnt!=-1 && img!=selecMenuAnt)
		MM_swapImage('plus' + selecMenuAnt,'','<?=$imagenes?>/menu.gif',1);
	selecMenuAnt = img;

	if (swVePerso==1 && numPerso!=img){
		document.getElementById('carpersolanes').style.display="none";
		MM_swapImage('plus' + numPerso,'','<?=$imagenes?>/menu.gif',1);
		swVePerso=0;
	}
}
function verPersonales(img){

    if (swVePerso!=1){
		document.getElementById('carpersolanes').style.display="";
		swVePerso=1;
	}else{
		document.getElementById('carpersolanes').style.display="none";
		MM_swapImage('plus' + selecMenuAnt,'','<?=$imagenes?>/menu.gif',1);
		selecMenuAnt = img;
		swVePerso=0;
	}
	numPerso = img;
}
</script>
</head>
<!--
/* Modificacion Skina
 * Se comenta, no se usa en la versiòn actual, no existe la estructura
 * en la base de datos para parametrizar.
 * Ing Camilo Pintor - cpintor@skinatech.com
 * Agosto 2015
<body onload="<? /*if($param->PARAM_VALOR=='1'){ */?> showInBox();<?/* }*/ ?>"><form action=correspondencia.php method="get">
*/
-->
<body><form action=correspondencia.php method="get">
<?php
$fechah = date("dmy") . "_" . time("hms");
if (isset($carpetano)) $carpeta = $carpetano;
else $carpeta = "";
// Cambia a Mayuscula el login-->krd -- Permite al usuario escribir su login en mayuscula o Minuscula
$numeroa=0;$numero=0;$numeros=0;$numerot=0;$numerop=0;$numeroh=0;
$fechah=date("dmy") . time("hms");
//Realiza la consulta del usuarios y de una vez cruza con la tabla dependencia
$isql = "select a.*,b.depe_nomb from usuario a,dependencia b
           where a.depe_codi=b.depe_codi
           AND USUA_LOGIN ='$krd' ";
$rs = $db->query($isql);
$phpsession = session_name()."=".session_id();
echo "<font size=1 face=verdana>";
// Valida Longin y contraseña encriptada con funcion md5()
if(trim($rs->fields["USUA_LOGIN"])==trim($krd)){
    $contraxx=$rs->fields["USUA_PASW"];
    if (trim($contraxx)){
        $codusuario =$rs->fields["USUA_CODI"];
	$dependencianomb=$rs->fields["DEPE_NOMB"];
	$fechah = date("dmy") . "_" . time("hms");
	$contraxx=$rs->fields["USUA_PASW"];
	$nivel=$rs->fields["CODI_NIVEL"];
	$iusuario = " and us_usuario='$krd'";
	$perrad = $rs->fields["PERM_RADI"];
        //Adicionado as contador
	// si el usuario tiene permiso de radicar el prog. muestra los iconos de radicaci�
	include "$ruta_raiz/menu/menuPrimero.php";
	include "$ruta_raiz/menu/radicacion.php";

	// Esta consulta selecciona las carpetas Basicas de DocuImage que son extraidas de la tabla Carp_Codi
 	$isql ="select CARP_CODI,CARP_DESC from carpeta order by carp_codi ";
	//$db->conn->debug = true;
	$rs = $db->query($isql);
 	$addadm = "";
?>
        
        
<table border="0" cellpadding="0" cellspacing="0" width="160">
	<!-- fwtable fwsrc="Sin t�tulo" fwbase="menu.gif" fwstyle="Dreamweaver" fwdocid = "742308039" fwnested="0" -->
	<tr>
            <!--<td><img src="<?=$imagenes?>/spacer.gif" width="10" height="1" border="0" alt=""></td>
            <td><img src="<?=$imagenes?>/spacer.gif" width="150" height="1" border="0" alt=""></td>
            <td><img src="<?=$imagenes?>/spacer.gif" width="1" height="1" border="0" alt=""></td>-->
	</tr>
        <tr>
            <th colspan="2"><a href="#" onClick="window.location.reload()">
            <img name="menu_r3_c1" src="./<?=$imagenes?>/menu_r5_c1.gif" alt="Presione para actualizar valore de las carpetas" height="31" border="0" ></a></th>
            <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
            <!--<td><img src="./<?=$imagenes?>/spacer.gif" width="1" height="25" border="0" alt=""></td>-->
	</tr>
	<tr>
            <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci 	<td>&nbsp;</td>-->
            <td valign="top">
                <table width="150" border="0" cellpadding="0" cellspacing="0" class="eMenu">
                    <tr>
                        <td valign="top">
                            <table width="150"  border="0" cellpadding="0" cellspacing="3" id="carpetasPerm">
                            <?php
                            while(!$rs->EOF){
                                if(!isset($data))   $data = "NULL";
                                $numdata = trim($rs->fields["CARP_CODI"]);
                                $sqlCarpDep = "select SGD_CARP_DESCR from SGD_CARP_DESCRIPCION where SGD_CARP_DEPECODI = '$dependencia' and SGD_CARP_TIPORAD = $numdata";
                                $rsCarpDesc = $db->query($sqlCarpDep);
                                $descripcionCarpeta =  $rsCarpDesc->fields["SGD_CARP_DESCR"];
                                ( $descripcionCarpeta ) ?   $data = $descripcionCarpeta : $data = trim($rs->fields["CARP_DESC"]);

                                if($numdata==11){   // Se realiza la cuenta de radicados en Visto Bueno VoBo
                                    if($codusuario ==1){
                                       $isql="select count(*) as CONTADOR from radicado where carp_per=0 and carp_codi=$numdata and radi_depe_actu='$dependencia' and radi_usua_actu=$codusuario";
                                    }else{
                                      $isql="select count(*) as CONTADOR from radicado where carp_per=0 and carp_codi=$numdata and radi_depe_actu='$dependencia' and radi_usu_ante='$krd'";
                                    }
                                    $addadm = "&adm=1";
                                } else {
                                   $isql="select count(*) as CONTADOR from radicado where carp_per=0 and carp_codi=$numdata and  radi_depe_actu='$dependencia'	and radi_usua_actu=$codusuario  ";
                                   $addadm = "&adm=0";
                                }

                                ($carpeta==$numdata)? $imagen="folder_open.gif" : $imagen="folder_cerrado.gif";
                                $flag = 0;
                                $rs1 = $db->query($isql);
                                $numerot = $rs1->fields["CONTADOR"];
                                //echo 'valor correspondiente a isql.......'.$isql;
                                if ($flag==1) echo "$isql";
                                ?>
                                <tr  valign="middle">
                                    <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
                                    <!--<td width="25"><img src="<?=$imagenes?>/menu.gif" height="18" alt='<?=$data ?> ' title='<?=$data ?>'  name="plus<?=$i?>"></td>-->
                                    <td width="125">
                                        <a onclick="cambioMenu(<?=$i?>);" href='cuerpo.php?<?=$phpsession?>&adodb_next_page=1&fechah=<?php echo "$fechah&nomcarpeta=$data&carpeta=$numdata&tipo_carpt=0&adodb_next_page=1"; ?>' class="menu_princ menu3" target="mainFrame" title="Carpeta de <?php echo $data;?>" alt="Carpeta <?php echo $data; ?>" aria-label="Carpeta de radicados <?php echo $data;?>, usted tiene <?php echo $numerot;?> radicados "><? echo "$data($numerot)";?></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                                $rs->MoveNext();
                                }

                            /**
                            * PARA ARCHIVOS AGENDADOS NO VENCIDOS
                            *  (Por. SIXTO 20040302)
                            */
                            $sqlFechaHoy=$db->conn->DBTimeStamp(time());
                            //$db->conn->debug = true;
                            $sqlAgendado=" and (agen.SGD_AGEN_FECHPLAZO >= ".$sqlFechaHoy.")";
                            $isql="select count(*) as CONTADOR from SGD_AGEN_AGENDADOS agen
                            where  usua_doc='$usua_doc' and agen.SGD_AGEN_ACTIVO=1 $sqlAgendado";
                            $rs=$db->query($isql);
                            $num_exp = $rs->fields["CONTADOR"];
                            $data="Agendados no vencidos";
                            ?>

                            <tr  valign="middle">
                                <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
                                <!--<td width="25"><img src="<?=$imagenes?>/menu.gif" height="18" alt='<?=$data ?> ' title='<?=$data ?>'  name="plus<?=$i?>"></td>-->
                                <td width="125">
                                    <a onclick="cambioMenu(<?=$i?>);" href='cuerpoAgenda.php?<?=$phpsession?>&agendado=1&fechah=<?php echo "$fechah&nomcarpeta=$data&tipo_carpt=0"; ?>' class="menu_princ menu3" target="mainFrame" title="Carpeta de agendados para tr&aacute;mite" alt="Carpeta de agendados" aria-label="Carpeta de agendados para tr&aacute;mite, usted tiene <?php echo $num_exp;?> radicados">
                                    <? echo "Agendado($num_exp)";?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            /**
                            * PARA ARCHIVOS AGENDADOS  VENCIDOS
                            *  (Por. SIXTO 20040302)
                            */
                            $sqlAgendado=" and (agen.SGD_AGEN_FECHPLAZO <= ".$sqlFechaHoy.")";
                            $isql="select count(*) as CONTADOR from SGD_AGEN_AGENDADOS agen
                            where  usua_doc='$usua_doc' and agen.SGD_AGEN_ACTIVO=1 $sqlAgendado";
                            //$db->conn->debug = true;
                            $rs=$db->query($isql);
                            $num_exp = $rs->fields["CONTADOR"];
                            $data="Agendados vencidos";
                            $i++;
                            ?>
                            <tr  valign="middle">
                            <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
                            <!--		<td width="25"><img src="<?=$imagenes?>/menu.gif" height="18" alt='<?=$data ?> ' title='<?=$data ?>'  name="plus<?=$i?>"></td>-->
                            <td width="125">
                                    <a onclick="cambioMenu(<?=$i?>);" href='cuerpoAgenda.php?<?=$phpsession?>&agendado=2&fechah=<?php echo "$fechah&nomcarpeta=$data&&tipo_carpt=0&adodb_next_page=1"; ?>' class="menu_princ menu3" target="mainFrame" title="Carpeta de Agendado vencido" aria-label="Carpeta radicados agendados que ya se han vencido,usted tiene <?php $num_exp;?> radicados" alt="Carpeta Agendado vencido">
                                    <? echo "Agendado Vencido(<font color='#990000'>$num_exp</font>)";?>
                                    </a>
                            </td>
                            </tr>
                            <?php
                            // Coloca el mensaje de Informados y cuenta cuantos registros hay en informados
                            $isql="select count(*) as CONTADOR from informados where depe_codi='$dependencia' and usua_codi=$codusuario ";
                            if (!isset($numdata)) $numdata = ""; ($carpeta==$numdata and $tipo_carp=0) ? $imagen="folder_open.gif" : $imagen="folder_cerrado.gif";
                            $rs1=$db->query($isql);
                            $numerot = $rs1->fields["CONTADOR"];
                            $i++;
                            $data="Documentos De Informacion";
                            ?>
                            <tr  valign="middle">
                                <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
                                <!--	<td width="25"><img src="<?=$imagenes?>/menu.gif" height="18" alt='<?=$data ?> ' title='<?=$data ?>' name="plus<?=$i?>"></td>-->
                                <td width="125">
                                    <a onclick="cambioMenu(<?=$i?>);" href='cuerpoinf.php?<?=$phpsession?>&<?= "mostrar_opc_envio=1&orderNo=2&fechaf=$fechah&carpeta=8&nomcarpeta=Informados&orderTipo=desc&adodb_next_page=1"; ?>' class="menu_princ menu3" target="mainFrame" alt='Radicados Informados' aria-label="Radicados que le han sido Informados, usted tiene <?php echo $numerot;?>  radicados" title="Radicados Informados">
                                    Informados (<?=$numerot?>) <? $i++; ?>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            /**
                            * Carpeta de transacciones realizadas por el usuario
                            * @autor Jairo Losada
                            * @fecha Marzo del 2009
                            * @version Orfeo 3.7.2
                            * @licencia GNU/GPL
                            *
                            */
                            $data="Ultimas Transacciones del Usuario";
                            ?>
                            <tr  valign="middle">
                                <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
                                <!--	<td width="25"><img src="<?=$imagenes?>/menu.gif" height="18" alt='<?=$data ?> ' title='<?=$data ?>'  name="plus<?=$i?>"></td>-->
                                <td width="125">
                                    <a onclick="cambioMenu(<?=$i?>);" href='cuerpoTx.php?<?=$phpsession?>&fechah=<?php echo "$fechah&nomcarpeta=$data&tipo_carpt=0"; ?>' class="menu_princ menu3" target="mainFrame" title="&Uacute;ltimas transacciones del usuario" aria-label="&Uacute;ltimas transacciones del usuario" alt="&Uacute;ltimas transacciones del Usuario">
                                    Transacciones
                                    </a>
                                </td>
                            </tr>
                            <tr  valign="middle">
                            <!--By Skina -Ing Camilo Pintor Nov-12-2013 Se comenta para dar accesibilidad en el movimiento entre aplicaciones con el tab inci -->
                            <!--	<?  $data="Despliegue de Carpetas Personales";  ?>
                            <td width="25">
                                            <img src="./<?=$imagenes?>/menu.gif" height="18" alt='<?=$data ?> ' title='<?=$data ?>' name="plus<?=$i?>">
                            </td>-->
                                <td width="125">
<!--                                    <a onclick="cambioMenu(<?=$i?>);verPersonales(<?=$i?>);" href='#marcaPersonales";' class="menu_princ menu3"  alt="Despliegue Administración de Carpetas Personales" title="Despliegue de Carpetas Personales" aria-label="Despliegue Administración de Carpetas Personales" name="marcaPersonales">-->
                                        <a class="menu_princ" id="submenu3item"  alt="Despliegue Administración de Carpetas Personales" title="Despliegue de Carpetas Personales" aria-label="Despliegue Administración de Carpetas Personales" name="marcaPersonales">
                                    Carpetas Personales
                                    </a>
                                </td>
                            </tr>
                            </table>

                            <div id="folders"></div>
                            <table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="cacac9" id="carpersolanes">
                                <tr>
                                    <td>
                                        <a class="vinculos" id="itemNuevaCarp" href="crear_carpeta.php?<?=$phpsession?>&krd=<?=$krd?>&<? echo "fechah=$fechah&adodb_next_page=1"; ?>"  target='mainFrame' alt='Creacion de Carpetas Personales'  aria-label='Creacion de Carpetas Personales' title='Creacion de Carpetas Personales'>
                                        <font size=2>Nueva carpeta</font>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            // BUSCA LAS CARPETAS PERSONALES DE CADA USUARIO Y LAS COLOCA contando el numero de documentos en cada carpeta.
                            $isql ="select distinct CODI_CARP,DESC_CARP,NOMB_CARP from carpeta_per where usua_codi=$codusuario and depe_codi='$dependencia' order by codi_carp  ";
                            $rs=$db->query($isql);
                            while(!$rs->EOF){
                                if($data=="") $data = "NULL";
                                    $data = trim($rs->fields["NOMB_CARP"]);
                                    $numdata =  trim($rs->fields["CODI_CARP"]);
                                    $detalle = trim($rs->fields["DESC_CARP"]);
                                    $data = trim($rs->fields["NOMB_CARP"]) ;
                                    $isql="select count(1) as CONTADOR from radicado where carp_per=1 and carp_codi=$numdata and  radi_depe_actu='$dependencia' and radi_usua_actu=$codusuario ";

                                    $rs1=$db->query($isql);
                                    $numerot = $rs1->fields["CONTADOR"];
                                    $datap = "$data(Personal)";
                                    ?>
                                    <tr>
                                        <td height="18"><a href="cuerpo.php?<?=$phpsession ?>&<? echo "fechah=$fechah&tipo_carp=1&carpeta=$numdata&nomcarpeta=$data "; ?>(Personal)<? echo ""; ?>" alt="Carpeta Personal <?=$detalle?>" title="Carpeta Personal <?=$detalle?>" aria-label="Carpeta Personal <?=$detalle?>" class="menu_princ itemsSubmenu3" target="mainFrame">	<? echo "$data($numerot)";?></a> </td>
                                    </tr>
                                    <?php
                                    $rs->MoveNext();
                            }
                            ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
</table>
<?php
    }
 }
 
//*********************TRANSACCIONES DEL CURSOR DE CONSULTA PRIMARIA**************************************************************************************************
(!$db->imagen()) ?  $logo = "logoEntidad.gif" : $logo = $db->imagen();
?>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  class="t_bordeVerde">
<tr align="center">
<td height="35"><img width=90% src='<?=$logo?>'></td>
</tr>
<tr align="center">
<td height="20">
		<font size="1" face="Verdana, Arial, Helvetica, sans-serif">
<!-- Equipo: --> 
<?php	// Coloca de direccion ip del equipo desde el cual se esta entrando a la pagina.
//					echo $_SERVER['REMOTE_ADDR'];
?></font>
	</td>
</tr>
</table>
</form>
</body>
</html>
