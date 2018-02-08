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
if (!$dependencia and !$depe_codi_territorial)include "../rec_session.php";
include_once dirname(__FILE__).DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config.php";
$htmlE ="";

error_reporting(7);
?>
<html>
<head>
<title>Untitled Document</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
</head>
<body>
<?
  if($gen_lisDefi and !$cancelarListado)
{
    $indi_generar = "SI";
}
else
{
    $indi_generar = "NO";
}

 if($indi_generar=="SI")
 {
  
?>
<center>
<table class=borde_tab width='95%' cellspacing="5"><tr><td class=titulos2><center>Listado documentos reasignados</center></td></tr></table>
</center>
<br>
<form name='forma' action='generaListaImpresos.php?<?=session_name()."=".session_id()."&krd=$krd&hora_ini=$hora_ini&hora_fin=$hora_fin&minutos_ini=$minutos_ini&minutos_fin=$minutos_fin&tip_radi=$tip_radi&fecha_busq=$fecha_busq&fecha_busqH=$fecha_busqH&fecha_h=$fechah&dep_sel=$dep_sel&num=$num"?>' method=post>
    <?
	$fecha_ini = $fecha_busq . ":" .$hora_ini. ":" .$minutos_ini ;
	$fecha_fin = $fecha_busqH . ":" .$hora_fin. ":" .$minutos_fin ;
 	if ($checkValue)
 	{
	$num = count($checkValue);
	$i = 0;
	while ($i < $num)
	{
	   $record_id = key($checkValue);
	   $radicadosSel[$i] = $record_id;
		$setFiltroSelect .= "'".$record_id."'" ;
		if($i<=($num-2))
		{
			$setFiltroSelect .= ",";
		}
  	next($checkValue);
	$i++;
	}
	if ($radicadosSel) 	$whereFiltro = " and c.radi_nume_radi in($setFiltroSelect)";
 	} // FIN  if ($checkValue)
 
 	if ($setFiltroSelect) $filtroSelect = $setFiltroSelect;
 	if ($filtroSelect)
 	{

// En este proceso se utilizan las variabels $item, $textElements, $newText que son temporales para esta operacion.

		$filtroSelect = trim($filtroSelect);
		$textElements = split (",", $filtroSelect);
		$newText = "";
		foreach ($textElements as $item) {
		   $item = trim ( $item );
		   if ( strlen ( $item ) != 0) {
			  if (strlen($item)<=6)  $sec = str_pad($item,6,"0",STR_PAD_left);
		   }   
		}
 	} // FIN if ($filtroSelect)
 
	$carp_codi = substr($dep_radicado,0,2);

	error_reporting(7);

    include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz");
    define('ADODB_FETCH_ASSOC',2);
    $ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
	//Condicion Dependencia
        $dependencia_busq1 = " and h.depe_codi = '$dep_sel'";
        if($dep_sel_dest==0) $dependencia_busq2= " ";
        else $dependencia_busq2 = " and h.depe_codi_dest = '$dep_sel_dest'";
        //Construccion Condicion de Fechas//
        $fecha_ini = $fecha_busq;
        $fecha_fin = $fecha_busqH;
        $fecha_ini = mktime($hora_ini,$minutos_ini,00,substr($fecha_busq,5,2),substr($fecha_busq,8,2),substr($fecha_busq,0,4));
        $fecha_fin = mktime($hora_fin,$minutos_fin,59,substr($fecha_busqH,5,2),substr($fecha_busqH,8,2),substr($fecha_busqH,0,4));

        $where_fecha = " and h.hist_fech BETWEEN
                ".$db->conn->DBTimeStamp($fecha_ini)." and ".$db->conn->DBTimeStamp($fecha_fin) ;
        //Condicion Tipo Radicacion
        if ($tip_radi==0)
	{ $where_tipRadi = "";
        }
        else
        {
        $where_tipRadi = " and c.radi_nume_radi like '%$tip_radi'";}

	include "$ruta_raiz/include/query/tx/queryListaImpresos.php";			
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$rsMarcar = $db->conn->Execute($isql);	
	//$db->conn->debug=true;
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	$no_registros = 0;

    	//$no_registros = $rsMarcar->recordcount(); 
     	$radiNumero = $rsMarcar->fields["NUMERO_RADICADO"];
	//if ($no_registros <=0) {
	if ($radiNumero =='') {
          	$estado = "Error";
 	   	$mensaje = "Verifique..."; 
	   	foreach ($textElements as $item) {
	      					$verrad_sal = trim ( $item );
    	   					}
	   	echo "<script>alert('No se puede Generar el Listado $verrad_sal . $mensaje  ')</script>";
	}
	else 
	{
	//Modificacion 28112005
	//Modificado skina 31-10-08
		//$archivo = "../bodega/pdfs/planillas/envios/$krd". date("Ymd_hms") . "_lis_IMP.csv";
		$archivo = "../bodega/pdfs/planillas/envios/$krd". date("Ymd_hms") . "_lis_IMP.txt";
		$fp=fopen($archivo,"w");
		$com = chr(34); 
		$tab=chr(9);
  	        //$contenido="$com*Radicado*$com$tab$com*Fecha Radicado*$com$tab$com*No de Factura*$com$tab$com*Asunto*$com$tab$com*Tipo de Documento*$com$tab$com*Remitente*$com$tab$com*Valor de factura*$com\n";
  	        $contenido="$com*Radicado*$com$tab$com*Fecha Radicado*$com$tab$com*Remitente*$com$tab$com*Asunto*$com$tab$com*Dependencia*$com$tab$com*Firma*$com$tab$com*Nombre recibe*$com$tab$com*Fecha*$com\n";
           	 $query_t = $isql ;
			
			$ruta_raiz = "..";
			error_reporting(7);
			define('ADODB_FETCH_NUM',1);
			$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
			require "../tx/classControlLis.php";
			$btt = new CONTROL_ORFEO($db);
			$campos_align = array("C","C","L","L","L","L","L","L");
			//$campos_tabla = array("$verrad_sal","$fecha_radi","$no_factura","$asunto","$sgd_tpr_codigo","$rem_destino","$valor_factura");
			$campos_tabla = array("$verrad_sal","$fecha_radi","$cuentai","$rem_destino","$asunto","$depe_nomb","$firma","$fecha");
			//$campos_vista = array ("Radicado","Fecha Radicado","No de Factura","Asunto","Tipo Documento","Remitente","Valor de factura");
			$campos_vista = array ("Radicado","Fecha Radicado","Remitente","Asunto","Dependencia","Firma","Nombre quien recibe","Fecha");
			$campos_width = array (120        ,120            ,200          ,320        ,180, 150, 150, 110);
			$btt->campos_align = $campos_align;
			$btt->campos_tabla = $campos_tabla;
			$btt->campos_vista = $campos_vista;
			$btt->campos_width = $campos_width;
			$btt->tabla_sql($query_t,$fecha_ini,$fecha_fin);
			$htmlE = $btt->tabla_htmlE;
	//Fin Modificacion 28112005
	   while (!$rsMarcar->EOF) {
		  $no_registros = $no_registros + 1;
          	  $mensaje = "";
		  $verrad_sal     = $rsMarcar->fields["NUMERO_RADICADO"];  
		  $fecha_radi	  = $rsMarcar->fields["FECHA_RADICADO"];
		  $asunto         = $rsMarcar->fields["ASUNTO"];
		  $rem_destino    = $rsMarcar->fields["REMITENTE"];
		  $cuentai	  = $rsMarcar->fields["NO_DOCUMENTO"];
		  $firma	  = $rsMarcar->fields["FIRMA"];
		  $fecha	  = $rsMarcar->fields["FECHA"];
		  $depe_nomb	  = $rsMarcar->fields["DEPENDENCIA"];
		  $dep_radicado   = substr($verrad_sal,4,$longitud_codigo_dependencia);
		  $ano_radicado   = substr($verrad_sal,0,4);
		  $carp_codi      = substr($dep_radicado,0,2);
		  $radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";
	
//		  $campos_tabla = array("$verrad_sal","$fecha_radi","$no_factura","$asunto","$sgd_tpr_codigo","$rem_destino","$valor_factura");
			$campos_tabla = array("$verrad_sal","$fecha_radi","$rem_destino","$asunto","$depe_nomb","$firma","$cuentai","$fecha");
		$btt->campos_tabla = $campos_tabla;
		$btt->tabla_Cuerpo();
		error_reporting(7);
  	        //$contenido= $contenido ."$com$verrad_sal$com$tab$com$fecha_radi$com$tab$com$no_factura$com$tab$com$asunto$com$tab$com$sgd_tpr_codigo$com$tab$com$rem_destino$com$tab$com$valor_factura$com\n";
  	        $contenido= $contenido ."$com$verrad_sal$com$tab$com$fecha_radi$com$tab$com$rem_destino$com$tab$com$asunto$com$tab$com$depe_nomb$com$tab$com$firma$com$tab$com$cuentai$com$tab$com$fecha$com\n";
		//Fin Modificacion 28112005
 	       $rsMarcar->MoveNext();
	
	   } // FIN del WHILE (!$rsMarcar->EOF)
	
	  $no_planilla=	$db->conn->nextId('SEC_PLANILLA_TX');
	   fputs($fp,$contenido);
		fclose($fp);
		$fecha_dia = date("Ymd - H:i:s");
		$html  = $htmlE;
		$html  .= $btt->tabla_html;
		//$html  = $btt->tabla_html;
		error_reporting(7);
		define(FPDF_FONTPATH,'../fpdf/font/');
		require("../fpdf/html_table.php");
		error_reporting(7);
		//$pdf = new PDF("L","mm","A4");
		$pdf = new PDF("L","mm","Legal");
		$pdf->AddPage();
		$pdf->SetFont('Arial','',8);
		$entidad = $db->entidad;

                // By skina para correccion de fechas de inicio y finalizacion
                if ($hora_ini < 10)
			$hora_ini = "0" .$hora_ini;

                if ($hora_fin < 10)
			$hora_fin = "0" .$hora_fin;

                if ($minutos_ini < 10)
			$minutos_ini = "0" .$minutos_ini;

                if ($hora_fin < 10)
			$minutos_fin = "0" .$minutos_fin;
	        
                $fecha_ini = $fecha_busq . " - " .$hora_ini. ":" .$minutos_ini ;
	        $fecha_fin = $fecha_busqH . " - " .$hora_fin. ":" .$minutos_fin ;
                

		//$encaenti = "../images/".$entidad . ".png";
		$encaenti = "../logoEntidad.jpg";
		$encabezado = "<table border=0>
           	 <tr><td height=43><img src=$encaenti height=63></td></tr>
			<tr><td width=1120 height=40> </td></tr>
			<tr><td width=1120 height=40> </td></tr>
			<tr><td width=1120 height=40> </td></tr>
			<tr><td width=1120 height=80> </td></tr> 
			<tr><td width=1120 height=20>Planilla de Reasignacion No        : $no_planilla </td></tr>
			<tr><td width=1120 height=20>Usuario  	 	 : $krd </td></tr>
			<tr><td width=1120 height=20>Dependencia         : $dependencia </td></tr>
			<tr><td width=1120 height=20>Fecha Inicial       : $fecha_ini </td></tr>
			<tr><td width=1120 height=20>Fecha Final         : $fecha_fin </td></tr>
			<tr><td width=1120 height=20>Fecha Generado      : $fecha_dia </td></tr>
			<tr><td width=1120 height=20>Numero de Registros : $no_registros </td></tr>
			<tr><td width=1120 height=40></td></tr>
			</table>";
		$fin = "<table border=0 >
		    <tr><td width=1120 height=40></td></tr>
			<tr><td width=1120 height=40 >Fecha de Entrega         ________________________________________________</td></tr>
			<tr><td width=560 height=40 > Usuario que Entrega  ________________________________________________</td>
			<td width=560 height=30 > Usuario que Recibe   ______________________________________________</td></tr>
			<tr><td width=1120 height=40 >Observaciones	  ____________________________________________________________________________________________________________________________________________________________________</td></tr>
			<tr><td width=1120 height=40 >__________________________________________________________________________________________________________________________________________________________________________________</td></tr>
			<tr><td width=1120 height=40></td></tr>
		</table>
		<br>";
	
		$pdf->WriteHTML($encabezado. $html. $fin);
		$arpdf_tmp = "../bodega/pdfs/planillas/tx/$krd". date("Ymd_hms") . "_lis_IMP.pdf";
		$pdf->Output($arpdf_tmp);
		echo "Se genero la planilla No. $no_planilla";
		echo "<br>";
		echo "Para obtener el archivo pdf haga click en el siguiente vinculo <a class=vinculos href='$arpdf_tmp' target='".date("dmYh").time("his")."'>Abrir Archivo Pdf</a>";
		echo "<br>";
		$salida = "csv";
		//modificado skina 31-10-08
		//cambio de csv a txt
		echo "Para obtener el archivo txt guarde del destino del siguiente v&iacute;nculo  <a class=vinculos href='$archivo' target='".date("dmYh").time("his")."'>Generado
              </a>";
	} 
	//FIN else if ($no_registros <=0)
?>
 </form>
 <?

}
else
{
echo "<hr><center><b><span class='alarmas'>Operacion CANCELADA</span></center></b></hr>";
}
?>  
</body>
</html>
 
