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


$krdOld = $krd;
session_start();

if(!$krd) $krd = $krdOld;
if (!$ruta_raiz) $ruta_raiz = "..";
//include "$ruta_raiz/rec_session.php";
include_once("$ruta_raiz/include/db/ConnectionHandler.php");
include_once "$ruta_raiz/include/tx/Historico.php";
include_once "$ruta_raiz/include/tx/Expediente.php";
$db = new ConnectionHandler( "$ruta_raiz" );
//$db->conn->debug = true;
$encabezadol = "$PHP_SELF?".session_name()."=".session_id()."&dependencia=$dependencia&krd=$krd&tipo=$tipo&codp=$codp&codig=$codig";

?>
<html>
<head>
<title>Relación entre tipos de almacenamiento</title>
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<body bgcolor="#FFFFFF">
<form name="relacionTiposAlmac" action="<?=$encabezadol?>" method="POST" >
<?
if($grabar){
$t=0;
if($tipoAlmacPadre==$codp){
$nom=strtoupper($hijo);
$sig=strtoupper($Shijo);
	$sql="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ( ".$db->conn->nextId( 'SEC_EDIFICIO' ).",'$tipoAlmacPadre','$nom','$sig')";

$rs=$db->conn->Execute($sql);
}
else
{
for($i=1;$i<=$cantidad;$i++){
$hijoc=$hijo." ".$i;
$Shijoc=$Shijo.$i;
$nomc=strtoupper($hijoc);
$sigc=strtoupper($Shijoc);
$sql="insert into sgd_eit_items (sgd_eit_codigo,sgd_eit_cod_padre,sgd_eit_nombre,sgd_eit_sigla) values ( ".$db->conn->nextId( 'SEC_EDIFICIO' ).",'$tipoAlmacPadre','$nomc','$sigc')";
//$db->conn->debug=true;
$rs=$db->conn->Execute($sql);
}
}
if($rs->EOF)$t+=1;
if($t==0)echo "No se pudo ingresar el registro";
else echo "El registro fue ingresado";
}
?>
<center>
<div id="titulo" style="width: 90%;" align="center">Relación entre tipos de almacenamiento</div>  
<table border="1" width="90%" cellpadding="0" class="borde_tab">
<tr>
<td class="listado2" colspan="5" >
<?
//skina
$sq="select sgd_eit_nombre from sgd_eit_items where sgd_eit_cod_padre='$codp'";
$rt=$db->conn->Execute($sq);
if(!$rt->EOF)$nop=$rt->fields['SGD_EIT_NOMBRE'];
$nod=explode(' ',$nop);
echo $nod[0]."  ";
$c=0;
$cp=0;
$conD=$db->conn->Concat("sgd_eit_codigo","'-'","sgd_eit_nombre");
//skina
$sqli="select ($conD) as detalle,sgd_eit_codigo from sgd_eit_items where sgd_eit_cod_padre='$codp' or sgd_eit_codigo= '$codp'";
$rsi=$db->conn->Execute($sqli);
print $rsi->GetMenu2('codig',$codig,true,false,"","class='select'; onchange=submit();");
?>
</tr>
<tr>
<td class="titulos2">Nombre Padre:<br>
  Cod_pa-Cod-Nombre

<?php
$i=1;
 	if($codig!=$codp){
	//skina
	$sqm1="select * from sgd_eit_items where sgd_eit_cod_padre = '$codig'";
	
	$rs1=$db->conn->Execute($sqm1);
	while(!$rs1->EOF){
		$cod_p=$rs1->fields['SGD_EIT_CODIGO'];
		$nom[$i]=$codig."-".$cod_p."-".$rs1->fields['SGD_EIT_NOMBRE'];
		$codi[$i]=$rs1->fields['SGD_EIT_CODIGO'];
		//modificado skina conversion de variables
		$sqm2="select * from sgd_eit_items where sgd_eit_cod_padre = '".$codi[$i]."'";
		$rs2=$db->conn->Execute($sqm2);
		$i++;
		while(!$rs2->EOF){
			$cod_p=$rs2->fields['SGD_EIT_CODIGO'];
			$cod_p2=$rs2->fields['SGD_EIT_COD_PADRE'];
			$codi[$i]=$rs2->fields['SGD_EIT_CODIGO'];
			$nom[$i]=$cod_p2."-".$cod_p."-".$rs2->fields['SGD_EIT_NOMBRE'];
			//modificado skina conversion de variables
			$sqm3="select * from sgd_eit_items where sgd_eit_cod_padre = '".$codi[$i]."'";
			$rs3=$db->conn->Execute($sqm3);
			$i++;
			while(!$rs3->EOF){
				$cod_p=$rs3->fields['SGD_EIT_CODIGO'];
				$codi[$i]=$rs3->fields['SGD_EIT_CODIGO'];
				$cod_p2=$rs3->fields['SGD_EIT_COD_PADRE'];
				$nom[$i]=$cod_p2."-".$cod_p."-".$rs3->fields['SGD_EIT_NOMBRE'];
				//modificado skina conversion de variable
				$sqm4="select * from sgd_eit_items where sgd_eit_cod_padre = '".$codi[$i]."'";
				$rs4=$db->conn->Execute($sqm4);
				$i++;
				while(!$rs4->EOF){
					$cod_p=$rs4->fields['SGD_EIT_CODIGO'];
					$codi[$i]=$rs4->fields['SGD_EIT_CODIGO'];
					$cod_p2=$rs4->fields['SGD_EIT_COD_PADRE'];
					$nom[$i]=$cod_p2."-".$cod_p."-".$rs4->fields['SGD_EIT_NOMBRE'];
					//modificado skina con version de variables
					$sqm5="select * from sgd_eit_items where sgd_eit_cod_padre = '".$codi[$i]."'";
					$rs5=$db->conn->Execute($sqm5);
					$i++;
					while(!$rs5->EOF){
						$cod_p=$rs5->fields['SGD_EIT_CODIGO'];
						$codi[$i]=$rs5->fields['SGD_EIT_CODIGO'];
						$cod_p2=$rs5->fields['SGD_EIT_COD_PADRE'];
						$nom[$i]=$cod_p2."-".$cod_p."-".$rs5->fields['SGD_EIT_NOMBRE'];
						//modificacion skina conversion de variable
						$sqm6="select * from sgd_eit_items where sgd_eit_cod_padre = '".$codi[$i]."'";
						$rs6=$db->conn->Execute($sqm6);
						$i++;
						while(!$rs6->EOF){
							$cod_p=$rs6->fields['SGD_EIT_CODIGO'];
							$codi[$i]=$rs6->fields['SGD_EIT_CODIGO'];
							$cod_p2=$rs6->fields['SGD_EIT_COD_PADRE'];
							$nom[$i]=$cod_p2."-".$cod_p."-".$rs6->fields['SGD_EIT_NOMBRE'];
							$i++;
							$rs6->MoveNext();
						}
						$rs5->MoveNext();
					}
					$rs4->MoveNext();
				}
				$rs3->Movenext();
			}
			$rs2->MoveNext();
		}
		$rs1->MoveNext();
	}
	//modificado skina conversion de variables
	$sqlp="select SGD_EIT_NOMBRE,sgd_eit_cod_padre from sgd_eit_items where sgd_eit_codigo = '$codig'";
	$rsp=$db->conn->Execute($sqlp);
	$cpd=$rsp->fields['SGD_EIT_COD_PADRE'];
	$nom_pa=$cpd."-".$codig."-".$rsp->fields['SGD_EIT_NOMBRE'];
	}
	else {
	$sqmpp="select * from sgd_eit_items where sgd_eit_codigo = '$codp'";
	$rs1=$db->conn->Execute($sqmpp);
	$nom_pa="0-".$codp."-".$rs1->fields['SGD_EIT_NOMBRE'];
	}
	
	/*
$q_tiposAlmac  = "SELECT SGD_EIT_CODIGO, SGD_EIT_NOMBRE";
$q_tiposAlmac .= " FROM SGD_EIT_ITEMS2";
$q_tiposAlmac .= " ORDER BY SGD_EIT_COD_PADRE ";
$rs_tiposAlmac = $db->query( $q_tiposAlmac );*/
?>
  <td height="30" class="listado2">
    <div align="center">
      <select name="tipoAlmacPadre" class="select">
	  <option value="<?=$codig?>" >  <?=$nom_pa?> </option>
	  
	  <?
	  for($p=1;$p<$i;$p++)
{    
    if($nom[$p]!=$nom_pa)print "<option value='".$codi[$p]."'>".$nom[$p]." </font></option>";
}
	  ?>
      </select>
    </div>
<?/*
$conD=$db->conn->Concat("SGD_EIT_COD_PADRE","'-'","SGD_EIT_CODIGO","'-'","SGD_EIT_NOMBRE");
$sqr="select $conD as detalle,SGD_EIT_CODIGO from sgd_eit_items order by sgd_eit_cod_padre";
$rs=$db->conn->Execute($sqr);
print $rs->GetMenu2('tipoAlmacPadre',$tipoAlmacPadre,true,false,"","class=select");*/
?>
  </td>
  
  <td class="listado2">
    <div align="center">
      <b>Tiene:</b>
      <input type="text" name="cantidad" value="<?=$cantidad?>" size="2" maxlength="2">
    </div>
  </td>
  
  <td class="listado2"><b>Hijo:</b>
    <input type="text" name="hijo" value="<?=$hijo?>" >
  </td>
  <td class="listado2"><b>Sigla Hijo:</b>
  <input type="text" name="Shijo" value="<?=$Shijo?>" size="4" maxlength="4">
  </td>
</tr>
<tr>
  <td class="listado2" colspan="5" align="center">
    <input type="submit" name="grabar" class="botones" value="GRABAR" >
    <input type="button" name="cerrar" class="botones" value="SALIR" onClick="window.close();opener.regresar();">
  </td>
</tr>
</table>
</center>
</form>
</body>
</html>
