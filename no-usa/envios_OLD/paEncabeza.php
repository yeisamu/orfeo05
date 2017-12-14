<?php
	$nomcarpetaOLD = $nomcarpeta;
	if (!isset($_GET['carpeta']))
	{
	  $carpeta = "0";
	  $nomcarpeta = "Entrada";
	}
?>
<table BORDER=0  cellpadding=2 cellspacing='0' WIDTH=100% class='borde_tab' valign='top' align='center' >
        <tr> 
          <th height="20" bgcolor="8cacc1"><div align="left" class="titulo1">LISTADO DE: </div></th>
          <th height="20" bgcolor="8cacc1"><div align="left" class="titulo1">USUARIO </div></th>
          <th height="20" bgcolor="8cacc1"><div align="left" class="titulo1">DEPENDENCIA </div></th>
        </tr>
		<tr class="info">
          <td height="20"><? if (isset($_GET['nomcarpeta'])) $_GET['nomcarpeta']?></td>
          <td height="20" ><?=$_SESSION['usua_nomb']?></td>
          <?  
          if (!isset($swBusqDep))  {
          ?>  
          <td height="20" ><?=$_SESSION['depe_nomb']?></td>
        </tr>
      </table>
	<?
    } else {
    ?>
	<td width="35%">
    <table width="100%" border="0" cellspacing="5" cellpadding="0">
     <tr class="info" height="20">
    	<td bgcolor="8cacc1"  ><div align="left" class="titulo1"><label for="dep_sel">DEPENDENCIA</label></div></td>
        </tr>
		<tr>
		<form name=formboton action='<? if (isset($pagina_actual)) $pagina_actual?>?<?=session_name()."=".session_id()?>&estado_sal_max=<?=$estado_sal_max?>&pagina_sig=<?=$pagina_sig?>&dep_sel=<?=$dep_sel?>&nomcarpeta=<?=$nomcarpeta?>' method='GET'>
		<input type=hidden name=estado_sal value='<?=$estado_sal?>'>
		<td height="1">
		<?
		include_once "$ruta_raiz/include/query/envios/queryPaencabeza.php";
		$sqlConcat = $db->conn->Concat($conversion , "'-'",'depe_nomb');
		$sql = "select $sqlConcat ,depe_codi from dependencia where depe_estado=1
						order by depe_codi";
	//	$db->conn->debug = true;
		$rsDep = $db->conn->Execute($sql);
		if(!isset($depeBuscada)) $depeBuscada=$dependencia;
		print $rsDep->GetMenu2("dep_sel","$dep_sel",false, false, 0," onChange='submit();' class='select' id='dep_sel' title='Listado con todas las dependencias existentes'");
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
