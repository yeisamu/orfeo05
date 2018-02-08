<?
session_start();
   /**
     * Modificacion para aceptar Variables GLobales
     * @autor Jairo Losada
     * @fecha 2009/05
     */
   $krd = $_SESSION["krd"];
   $dependencia = $_SESSION["dependencia"];
  $usua_doc = $_SESSION["usua_doc"];
  $codusuario = $_SESSION["codusuario"];
  $tip3Nombre=$_SESSION["tip3Nombre"];
  $tip3desc = $_SESSION["tip3desc"];
  $tip3img =$_SESSION["tip3img"];

/*
   * Lista Envios Intersedes 
   * @autor Isabel rodriguez - Skinatech
   * @fecha 2008
   * Modificacion Variables Globales. Arreglo cambio de los req    uest Gracias a recomendacion de Hollman Ladino
   */
  foreach ($_GET as $key => $valor)   ${$key} = $valor;
  foreach ($_POST as $key => $valor)   ${$key} = $valor;

$verrad = "";
$ruta_raiz = "..";
if (!$_SESSION['dependencia'])   include "$ruta_raiz/rec_session.php";
if (!$dep_sel) $dep_sel = $dependencia;
?>
<html>
<head>
<title>Envio de Documentos. Orfeo...</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<div id="spiffycalendar" class="text"></div>
<link rel="stylesheet" type="text/css" href="js/spiffyCal/spiffyCal_v2_1.css    ">
<?
$ruta_raiz = "..";
// Modificado SGD 14-Septiembre-2007
define('ADODB_ASSOC_CASE', 2);
//include_once "$ruta_raiz/include/db/ConnectionHandler.php";
include_once "../include/db/ConnectionHandler.php";
$db = new ConnectionHandler("$ruta_raiz");

//$db->conn->debug=true;
if(!$carpeta) $carpeta=0;
 if(!$estado_sal)   {$estado_sal=2;}
 if(!$estado_sal_max) $estado_sal_max=3;
 if($estado_sal==3) {
        $accion_sal = "Envio de Documentos";
        $pagina_sig = "cuerpoEnvioFactura.php";
        $nomcarpeta = "Radicados Para Envio Intersedes";
        if(!$dep_sel) $dep_sel = $dependencia;

        $dependencia_busq1 = " and c.radi_depe_radi = $dep_sel ";
        //$dependencia_busq2 = " and c.radi_depe_radi = $dep_sel";
        $dependencia_busq2 = " ";
        } 
  if ($orden_cambio==1)  {
        if  (!$orderTipo)  {
           $orderTipo="desc";
        }else  {
           $orderTipo="";
        }
 }
 $encabezado = "".session_name()."=".session_id()."&krd=$krd&estado_sal=$estado_sal&estado_sal_max=$estado_sal_max&accion_sal=$accion_sal&dependencia_busq2=$dependencia_busq2&dep_sel=$dep_sel&filtroSelect=$filtroSelect&tpAnulacion=$tpAnulacion&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
 $linkPagina = "$PHP_SELF?$encabezado&orderNo=$orderNo";


 $carpeta = "nada";
 include "../envios/paEncabeza.php";
 $pagina_actual = "../envios/cuerpoEnvioFactura.php";
 $varBuscada = "c.radi_nume_radi";
 include "../envios/paBuscar.php";
 $pagina_sig = "../envios/enviafactura.php";
 include "../envios/paOpciones.php";

        /*  GENERACION LISTADO DE RADICADOS<F3*/

?>

<form name=formEnviar action='../envios/enviafactura.php?<?=$encabezado?>' method=post>
<?
if ($orderNo==98 or $orderNo==99) {
       $order=1;
           if ($orderNo==98)   $orderTipo="desc";
       if ($orderNo==99)   $orderTipo="";
        }
    else  {
           if (!$orderNo)  {
                        $orderNo=3;
                        $orderTipo="desc";
                }
           $order = $orderNo + 1;
    }
		
if(!isset($fecha_ini)) $fecha_ini = date( "Y/m/d", strtotime( "-1 week" ));
if(!isset($fecha_fin)) $fecha_fin = date("Y/m/d");

 //Se valida rango de fechas
     $sqlFecha = $db->conn->SQLDate('Y/m/d',"H.HIST_FECH");
     $where_general = " and ".$sqlFecha . " BETWEEN '$fecha_ini' AND '$fecha_fin'" ;

 $radiPath = $db->conn->Concat($db->conn->substr."(a.anex_codigo,1,4) ", "'/'",$db->conn->substr."(a.anex_codigo,5,3) ","'/docs/'","a.anex_nomb_archivo");
 $radi_nume_radi = "cast(c.RADI_NUME_RADI as varchar(15))";
 $depe_codi= "cast(h.depe_codi_dest as varchar(5))";
 $tmp_cad = $db->conn->concat($depe_codi,"'-'",$radi_nume_radi);

        include "$ruta_raiz/include/query/envios/queryCuerpoEnvioFactura.php";
       // include "$ruta_raiz/include/query/envios/queryCuerpoEnvioNormal.php";
        $rs=$db->conn->Execute($isql);
 
if (!$rs->fields["IMG_Radicado Salida"])  {
                echo "<table class=borde_tab width='100%'><tr><td class=titulosError><center>NO se encontro nada con el criterio de busqueda</center></td></tr></table>"; }
else  {
	 $pager = new ADODB_Pager($db,$isql,'adodb', true,$orderNo,$orderTipo);
         $pager->checkAll = false;
         $pager->checkTitulo = true;
         $pager->toRefLinks = $linkPagina;
         $pager->toRefVars = $encabezado;
         $pager->Render($rows_per_page=20,$linkPagina,$checkbox=chkEnviar);
     }

 ?>
</form>
</body>
</html>
