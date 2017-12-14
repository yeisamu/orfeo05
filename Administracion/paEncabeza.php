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


  	include_once "$ruta_raiz/include/db/ConnectionHandler.php";
	$db = new ConnectionHandler($ruta_raiz);	 
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$nomcarpetaOLD = $nomcarpeta;

		if (!$carpeta) 
		{
		  $carpeta = "0";
		  $nomcarpeta = "Entrada";
		}
?>
<br>
<table BORDER=0  cellpad=2 cellspacing='0' WIDTH=98% class='t_bordeGris' valign='top' align='center' >
  <tr>
    <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
<!--          <td height="20" bgcolor="377584"><div align="left" class="titulo1">LISTADO DE: </div></td>-->
        </tr>
		<tr class="info">
<!--          <td height="20"><?=$nomcarpeta?></td>-->
        </tr>
      </table>
    </td>
     <td width='35%' >
      <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
<!--          <td height="20" bgcolor="377584"><div align="left" class="titulo1">USUARIO </div></td>-->
        </tr>
		<tr class="info">
<!--          <td height="20" ><?=$usua_nomb?></td>-->
        </tr>
      </table>
    </td>
	<?
    if (!$swBusqDep)  {
    ?>
 	<td width="33%">
	    <table width='100%' border='0' cellspacing='1' cellpadding='0'>
        <tr> 
          <td height="20" bgcolor="377584"><div align="left" class="titulo1">Dependencia </div></td>
        </tr>
		<tr class="info">
          <td height="20" ><?=$depe_nomb?></td>
        </tr>
      </table>
     </td>
	<?
    } else {
    ?>
	<td width="35%">
      <table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr class="info" height="20">
    	<td bgcolor="377584"  ><div align="left" class="titulo1"><label for="dep_sel">Dependencia</label></div></td>
        </tr>
		<tr>
	<?php if (!isset($estado_sal)) $estado_sal = ''; if (!isset($estado_sal_max)) $estado_sal_max = ''; ?>
		  <form name=formboton action='<?=$pagina_actual?>?<?=session_name()."=".session_id()."&krd=$krd" ?>&estado_sal=<?=$estado_sal?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>' method=get>	
			<td height="1">
<?		
	include_once "$ruta_raiz/include/query/envios/queryPaencabeza.php";			
	//$sqlConcat = $db->conn->Concat($db->conn->substr."($conversion,1,5) ", "'-'",$db->conn->substr."(depe_nomb,1,30) ");
	$sqlConcat = $db->conn->Concat($conversion, "'-'",$db->conn->substr."(depe_nomb,1,30) ");
	$sql = "select $sqlConcat ,depe_codi from dependencia where depe_estado=1 order by depe_codi";
	$rsDep = $db->conn->Execute($sql);
	if(!isset($depeBuscada)) $depeBuscada=$dependencia;
	print $rsDep->GetMenu2("dep_sel","$dep_sel",false, false, 0," onChange='submit();' class='select' id='dep_sel' title='Listado de todas las dependencias existentes'");
?>			
		</td>
 		  </form>
		</tr>
      </table>
    </td>

	<?
    } 
    ?>

  </tr>
</table>
