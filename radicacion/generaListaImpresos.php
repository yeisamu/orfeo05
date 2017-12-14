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


function get_dep_name($iadb, $num_radica){
/*-----------------------------------------------------------------------
Retorna el nombre de una dependencia

DESCRIPTION:

PARAMETERS: 

RESULT: 
PRE:
POST
OJO:
-----------------------------------------------------------------------*/
     $asql="SELECT depe_nomb
           FROM dependencia 
           WHERE depe_codi='$num_radica'";

     $ars_dep=$iadb->conn->Execute($asql);
     return $ars_dep->fields['DEPE_NOMB'];
}

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
<table class=borde_tab width='95%' cellspacing="5"><tr><td class=titulos2><center>Listado documentos radicados</center>
</td>
</tr>
</table>
</center>
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
       $radicadosSel[$i] = "'".$record_id."'";
        $setFiltroSelect .= "'".$record_id."'" ;
        if($i<=($num-2))
        {
            $setFiltroSelect .= ",";
        }
      next($checkValue);
    $i++;
    }
    if ($radicadosSel)     $whereFiltro = " and c.radi_nume_radi in($setFiltroSelect)";
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
    include "$ruta_raiz/include/query/radicacion/queryListaImpresos.php";            
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    $rsMarcar = $db->conn->Execute($isql);    
    //$db->conn->debug=true;
   // echo "sql = ".$isql;
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    $no_registros = 0;

        //$no_registros = $rsMarcar->recordcount(); 
         $radiNumero = $rsMarcar->fields["NUMERO_RADICADO"];
    //echo "radi $radiNumero";
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
    //Modificacion skina 040411
    $sql="select depe_nomb from dependencia where depe_codi='$dep_sel'";
    $rs_dep=$db->conn->Execute($sql);
    $dep_sel_nomb=$rs_dep->fields['DEPE_NOMB'];
    //Modificado skina 31-10-08
        //$archivo = "../bodega/pdfs/planillas/envios/$krd". date("Ymd_hms") . "_lis_IMP.csv";
        $archivo = "../bodega/pdfs/planillas/radicacion/$krd". date("Ymd_hms") . "_lis_IMP.txt";
        $fp=fopen($archivo,"w");
        $com = chr(34); 
        $tab=chr(9);
              $contenido="$com*Radicado*$com$tab$com*Fecha Radicado*$com$tab$com*Asunto*$com$tab$com*Tipo de Documento*$com$tab$com*Remitente*$com$tab$com*Valor de factura*$com\n";
                $query_t = $isql ;
            
            $ruta_raiz = "..";
            error_reporting(7);
            define('ADODB_FETCH_NUM',1);
            $ADODB_FETCH_MODE = ADODB_FETCH_NUM;
            //require "../radicacion/classControlLis.php";
            require "../radsalida/classControlLis.php";
            $btt = new CONTROL_ORFEO($db);
            $campos_align = array("C","C","C","C","C","C","C","C","C","C","C");
            //$campos_tabla = array("$verrad_sal","$fecha_radi","$no_facturia","$asunto","$sgd_tpr_codigo","$rem_destino","$valor_factura");
            $campos_vista = array ("Radicado","Fecha Radicado","Empresa","Nombre","Asunto","Dependencia","Colaborador", "");
            $campos_width = array (120,120,120,120,250,120,120,120);
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
          $fecha_radi     = $rsMarcar->fields["FECHA_RADICADO"];
          $remitente    = $rsMarcar->fields["EMPRESA"];
   	  $nombre    = $rsMarcar->fields["NOMBRE"];
	  $asunto         = $rsMarcar->fields["ASUNTO"];
	  $usuarioResponsable = $rsMarcar->fields["USUARIO"];
 	  $direccionEnvio = $rsMarcar->fields["DIRECCION"];
	  $fecha = substr($fecha_radi,0,16);
          //$sgd_tpr_codigo = $rsMarcar->fields["TDOC"];
          //$rem_destino    = $rsMarcar->fields["EMPRESA"];
//          $no_factura     = $rsMarcar->fields["NO_FACTURA"];
//          $valor_factura  = $rsMarcar->fields["VALOR"];
          //$anexo_radicado = $rsMarcar->fields["ANEXOS"];
//          $radi_depe_actu = $rsMarcar->fields["RADI_DEPE_ACTU"];
//          $radi_depe_radi = $rsMarcar->fields["RADI_DEPE_RADI"];
          $dep_radicado   = substr($verrad_sal,4,$longitud_codigo_dependencia);
          $ano_radicado   = substr($verrad_sal,0,4);
          $carp_codi      = substr($dep_radicado,0,2);
          $radi_path_sal = "/$ano_radicado/$dep_radicado/docs/$ref_pdf";
          //by skina 
          $radi_depe_actu=get_dep_name($db, $rsMarcar->fields["RADI_DEPE_ACTU"]);
          $radi_depe_radi=get_dep_name($db, $rsMarcar->fields["RADI_DEPE_RADI"]);
          if(substr($verrad_sal,-1)==2 or substr($verrad_sal,-1)==4
                                          or substr($verrad_sal,-1)==7)
               $destino="$radi_depe_actu";
          else {
               $destino=$rem_destino;
               $rem_destino="$radi_depe_radi";
          }
       // $campos_tabla = array("$verrad_sal","$fecha","$remitente","$nombre","$asunto","$rem_destino","","");
	$campos_tabla = array("$verrad_sal","$fecha","$rem_destino","$usuarioResponsable","$asunto","$remitente","$nombre","$direccionEnvio","");
	$btt->campos_tabla = $campos_tabla;
        $btt->tabla_Cuerpo();
        error_reporting(7);
        //$contenido= $contenido ."$com$verrad_sal$com$tab$com$fecha_radi$com$tab$com$rem_destino$com$tab$com$nom_destino$com$tab$com$asunto$com$tab$com$sgd_tpr_codigo$com\n";
	$contenido= $contenido ."$tab$verrad_sal$tab$tab$tab$fecha$tab$tab$tab$rem_destino$tab$tab$tab$usuarioResponsable$tab$tab$tab$asunto$tab$tab$tab$remitente$tab$tab$tab$nombre$tab$tab$tab$direccionEnvio$tab$tab$tab\n";
	//Fin Modificacion 28112005
            $rsMarcar->MoveNext();
    
       } // FIN del WHILE (!$rsMarcar->EOF)
    

      $no_planilla=    $db->conn->nextId('SEC_PLANILLA');
       fputs($fp,$contenido);
        fclose($fp);
        $fecha_dia = date("Ymd - H:i:s");
        //$html  = $htmlE;
        $html  .= $btt->tabla_html;
                $html  .= "</tbody>";
        $html  .= "</table>";

        //$html  = $btt->tabla_html;
        error_reporting(7);

        // by skina
        // Cambio de clase y progrma para generar los PDF's

        //define(FPDF_FONTPATH,'../fpdf/font/');
        //require("../fpdf/html_table.php");
        error_reporting(7);
        //$pdf = new PDF("L","mm","A4");
        //$pdf = new PDF("L","mm","Letter");
        //$pdf->AddPage();
        //$pdf->SetFont('Arial','',8);

        require_once('../include/tcpdf/config/lang/spa.php');
        require_once('../include/tcpdf/tcpdf.php');
                $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->AddPage();

	$entidad = strtoupper($db->entidad);
        $nit_entidad = $_SESSION['nit_entidad'];
        $dependenciaPlanila = $_SESSION["depe_nomb"]; 
	//$encaenti = "../images/".$entidad . ".png";
        $encaenti = "../iconos/orfeo.png";
        //echo $encaenti;       
$empo_encabeza = <<<EOD
<table border="1" cellpadding="1" cellspacing="1">
<tbody>
<tr>
<td colspan="2" rowspan="5" align="center"><br><br><img src="$encaenti" alt=logo_inci height=70%></td>
<td colspan="10" rowspan="1" align="center"><small>$entidad</small></td>
</tr>
<tr align="center">
<td colspan="10" rowspan="1"><small>NIT: $nit_entidad </small></td>
</tr>
<tr align="center">
<td colspan="10" rowspan="1"><small>FORAMTO: CONTROL ENTREGA DE CORRESPONDENCIA</small></td>
</tr>
<tr align="center">
<td colspan="4" rowspan="1"><small>USUARIO RESPONSABLE</small></td>
<td colspan="4" rowspan="1"><small>DEPENDENCIA ENTREGA</small></td>
<td colspan="2" rowspan="1"><small>FECHA DE ENTREGA</small></td>
</tr>
<tr align="center">
<td colspan="4" rowspan="1"><small>$usua_nomb</small></td>
<td colspan="4" rowspan="1"><small>$dependenciaPlanila</small></td>
<td colspan="2" rowspan="1"><small>$fecha_dia</small></td>
</tr>
</tbody>
</table>
<br>
    <table border="1">
        <tr align="center">
            <td colspan="2" rowspan="3" align="center" bgcolor="#BDBDBD"><small><br>RADICADO        </small></td>
            <td colspan="2" rowspan="1" align="center" bgcolor="#BDBDBD"><small>RECIBIDO            </small></td>
            <td colspan="4" rowspan="1" align="center" bgcolor="#BDBDBD"><small>DATOS REMITENTE     </small></td>
            <td colspan="2" rowspan="2" align="center" bgcolor="#BDBDBD"><small><br>ASUNTO          </small></td>
            <td colspan="6" rowspan="1" align="center" bgcolor="#BDBDBD"><small>DATOS DESTINATARIO  </small></td>
            <td colspan="2" rowspan="2" align="center" bgcolor="#BDBDBD"><small><br>Firma Recibido  </small></td>
        </tr>
        <tr>
            <td colspan="2" align="center" bgcolor="#BDBDBD"><small>Fecha Radicado   </small></td>
            <td colspan="2" align="center" bgcolor="#BDBDBD"><small>Dependencia          </small></td>
	    <td colspan="2" align="center" bgcolor="#BDBDBD"><small>Responsable           </small></td>
            <td colspan="2" align="center" bgcolor="#BDBDBD"><small>Nombre/Raz.Social      </small></td>
            <td colspan="2" align="center" bgcolor="#BDBDBD"><small>Dignatario      </small></td>
	    <td colspan="2" align="center" bgcolor="#BDBDBD"><small>Dirección      </small></td>
        </tr>
    </table>
<table border="1">
EOD;

        $fin = "<table border=0 >
            <tr><td width=1120 height=40></td></tr>
            <tr><td width=1120 height=40 ><small> Fecha de Entrega     </small>    ________________________________________________</td></tr>
            <tr><td width=560 height=40 ><small> Usuario que Entrega </small> ________________________________________________</td>
            <td width=560 height=30 ><small> Usuario que Recibe  </small> ______________________________________________</td></tr>
            <tr><td width=1120 height=40 ><small> Observaciones  </small>    _________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________________</td></tr>
            <tr><td width=1120 height=40></td></tr>
        </table>
        <br>";   	
 
        $pdf->WriteHTML($empo_encabeza. $html. $fin,true, false, false,'');
        $arpdf_tmp = "../bodega/pdfs/planillas/radicacion/$krd". date("Ymd_hms") . "_lis_IMP.pdf";
        $pdf->Output($arpdf_tmp, 'F');
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
 
