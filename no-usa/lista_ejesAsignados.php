<?php
session_start();
if (!$ruta_raiz) $ruta_raiz= ".";

$isqlC = 'select        sgd_tema_codigo           AS "CODIGO"
			, sgd_tema_nomb           AS "NOMBRE" 
			, sgd_tema_desc           AS "DESCRIPCION" 
			, sgd_tema_depe           AS "DEPE_TRAMITA" 
			from 
			sgd_eje_tema
	   		where sgd_tema_codigo=\''.$CodEjeTem.'\' ';
     error_reporting(7);
?>
    <br>
	<br>
	<TABLE class="borde_tab"><tr><td>
   EJE TEMATICO ASIGNADO AL RADICADO No. <?=$nurad ?></td></tr></table>
	<br>
	<table class=borde_tab width="100%" cellpadding="0" cellspacing="5">
  	<tr class="titulo5" align="center">
    	<th width="10%"  class="titulos5">CODIGO</th>
		<th width="20%"  class="titulos5">NOMBRE</th>
		<th width="20%"  class="titulos5">DESCRIPCION</th>
 		<th width="20%"  class="titulos5">DEPENDENCIA TRAMITA</th>
   	   	<th width="20%"  class="titulos5">ACCION</th>
  		</tr>
  	<?php
	 	$rsC=$db->query($isqlC);
   		while(!$rsC->EOF)
			{
      			$CodEjeTem  =$rsC->fields["CODIGO"];
	  			$NomEjeTem  =$rsC->fields["NOMBRE"]; 
				$DescEjeTem  =$rsC->fields["DESCRIPCION"];
				$DepeEjeTem  =$rsC->fields["DEPE_TRAMITA"];
				
		?> 
				<td class="listado5"> <font size=-3><?=$CodEjeTem?></font> </td>
				<td class="listado5"> <font size=-3><?=$NomEjeTem?></font> </td>
				<td class="listado5"> <font size=-3><?=$DescEjeTem?></font> </td>
				<td class="listado5"> <font size=-3><?=$DepeEjeTem?></font> </td>
	 			<td  <? if (!$rsC->fields["CODIGO"]) echo " class='celdaGris ' "; else echo " class='e_tablas ' "; ?>  > <font size=2>
		<?php 
					echo "<a href=javascript:borrarArchivo('$CodEjeTem','si')><span class='botones_largo'>Borrar</a> ";
		  ?> 
		 
	</font>
	</td>
	</tr>
	<?
				$rsC->MoveNext();
  		}
		//<font face="Arial, Helvetica, sans-serif" class="etextomenu">
		 ?>
   </table>
