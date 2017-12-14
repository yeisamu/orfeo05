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
$ruta_raiz = "..";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once("$ruta_raiz/include/combos.php");
if(!isset($_SESSION['dependencia']))
        include "$ruta_raiz/rec_session.php";
(!isset($db)) ? $conexion = new ConnectionHandler($ruta_raiz) : $conexion = $db;
//$conexion->conn->debug = true;
$conexion->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$tprad=12;

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
if (!isset($db))	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
//$db->conn->debug=true;
$phpsession = session_name()."=".session_id();
if (!isset($codusua)) $codusua = ''; if (!isset($coddepe)) $coddepe = ''; if (!isset($arch)) $arch  = '';
    $params=$phpsession."&krd=$krd&codusua=$codusua&coddepe=$coddepe&arch=$arch";
    $hora=date("H")."_".date("i");
    // var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el a?o de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;
$arcCsv=$fecha."_".$hora;
$p=1;
?>
<html>
<head>
<title>Seguridad de Dependencias</title>
<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="<?= $ruta_raiz.$_SESSION['ESTILOS_PATH_ORFEO']?>" rel="stylesheet" type="text/css">


<script language="JavaScript" type="text/JavaScript">

function enviar() {    
       
        document.formAdjuntarArchivos.submit();
}

function checkBoxChange() {
        if (document.getElementById('Restrin').checked == true) {
                document.getElementById('unlock').checked = false;
        }
        if (document.getElementById('unlock').checked == true) {
                document.getElementById('Restrin').checked = false;
        }
}
</script>
</head>
<br>
<br>
<body bgcolor="#FFFFFF">

<form action="seguridad.php?<?=$params?>" name="formAdjuntarArchivos" method="POST" enctype="multipart/form-data" >

<table border=2 width=30% align="center" class="borde_tab" cellspacing="1" cellpadding="0">
<tr align="center" class="titulos2">
  <div id="titulo" style="width: 30%; margin-left: 35%" align="center" >Dependencias Restringidas</div>
<!--<td height="15" class="titulos2" colspan="2">DEPENDENCIAS RESTRINGIDAS</td>-->
</tr>
</table>

<table border=2 width=30% align="center" class="borde_tab">
<tr align="center">
<td class="titulos5" align="left" nowrap><label for="depe[]">Dependencias :</label> </td>
<td class="titulos5" align="left" nowrap>
<?
$dsql="select  depe_codi  from dependencia order  by depe_codi";
$dsql2="select  depe_codi  from dependencia where depe_segu=1 ";
$rs= $db->conn->Execute($dsql);
$rs2=$db->conn->Execute($dsql2);
$a=array();
$i=0;
while(!$rs2->EOF)
{

$a[$i]=$rs2->fields['DEPE_CODI'];
$i=$i +1;
$rs2->MoveNext();
}

$tt=$rs->GetMenu2('depe[]',$a,false,true,0," class=\"select\" id='depe[]' title='Listado de dependencias restringidas'");
echo $tt;
?>
<div>
<br>
<input type="checkbox" name="Restrin" id="Restrin" value="Restrin" title="Active la casilla para restringir la dependencia seleccionada" onchange="checkBoxChange()">
<label for="Restrin"> Restringir</label></>
<br/>
<input type="checkbox" name="unlock" id="unlock" value="Restrin" title="Active la casilla para desbloquear la dependencia seleccionada" onchange="checkBoxChange()">
<label for="unlock"> Desbloquear </label></>
</div>
</td>

<?                 		
	if (isset($_POST['depe']))
{
   $dependen = $_POST['depe'];
   $n        = count($dependen);
   $i        = 0;
   while ($i < $n)
   {
       $res=$_POST['Restrin'];
        if($res) 
            $sql="update dependencia  set depe_segu=1 where  depe_codi='$dependen[$i]'";
        else
            $sql="update dependencia  set depe_segu=0 where  depe_codi='$dependen[$i]'";

       $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
       $rs=$db->conn->Execute($sql);
      $i++;
   }
   echo "</ol>";
}
	?>
</td>

<tr>

    <td class="titulos5" colspan="2" align="left" nowrap>
 <input type="submit" class="botones"  value="Actualizar">
</td>
</tr>


</table>
<?
        if (isset($_POST['depe']))
{
   $dependen = $_POST['depe'];
   $n        = count($dependen);
   $i        = 0;
?>
<BR>
<BR>
<div align="center">
<?
   echo "Las dependencias actualizadas son: " .
        "<ol>";
   while ($i < $n)
   {
      echo "<li>{$dependen[$i]}</li> ";
      $i++;
   }
   echo "</ol>";
?>
</div>
<?
}

?>
</FORM>
</html>
