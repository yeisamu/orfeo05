<?
/*  Visualizador de Listados.
 * 	Creado por: Ing. Hollman Ladino Paredes.
 * 	Para el proyecto ORFEO.
 *
 * 	Permite la visualizacion general de paises, departemntos, municipios, tarifas, etc.
 * 	Es una idea basica. Aun esta bajo desarrollo.
 */
session_start();
$ruta_raiz = "../..";
/*
 * Se incluye archivo config.php con ruta dinámica para evitar 
 * errores si se incluye este archivo en otro
 */
include dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . 'config.php';           // incluir configuracion.
/*
 * Se incluye archivo ConnectionHandler.php con ruta dinámica para evitar 
 * errores si se incluye este archivo en otro
 */
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "include/db/ConnectionHandler.php";
//Creo nueva instancia de conexión a Base de datos.
$db = new ConnectionHandler("$ruta_raiz");
//$db->conn->debug = true;
include($ADODB_PATH . '/adodb.inc.php');
$ADODB_FETCH_MODE = ADODB_FETCH_NUM;
$ADODB_COUNTRECS = false;
error_reporting(E_ALL);
$error = 0;
//$dsn = $driver."://".$usuario."/".$contrasena."@".$servidor."/".$db;
//$db = NewADOConnection($dsn);

switch ($_GET['var']) {
    case 'tar' : {
            $titulo = "LISTADO GENERAL DE TARIFAS";
            $tit_columnas = array('Forma Envio', 'Nal / InterNal.', 'C&oacute;d. Tarifa', 'Desc. Tarifa', 'Valor Local/America', 'Valor Nal./Resto');
            $valor1 = $db->conn->IfNull('SGD_TAR_TARIFAS.SGD_TAR_VALENV1', 'SGD_TAR_TARIFAS.SGD_TAR_VALENV1G1');
            $valor2 = $db->conn->IfNull('SGD_TAR_TARIFAS.SGD_TAR_VALENV2', 'SGD_TAR_TARIFAS.SGD_TAR_VALENV2G2');
            $isql = "SELECT SGD_FENV_FRMENVIO.SGD_FENV_DESCRIP, SGD_CLTA_CLSTARIF.SGD_CLTA_CODSER, SGD_CLTA_CLSTARIF.SGD_TAR_CODIGO, SGD_CLTA_CLSTARIF.SGD_CLTA_DESCRIP, 
                      $valor1 AS VALOR1, $valor2 AS VALOR2 
					FROM SGD_CLTA_CLSTARIF, SGD_TAR_TARIFAS, SGD_FENV_FRMENVIO 
					WHERE SGD_CLTA_CLSTARIF.SGD_FENV_CODIGO = SGD_TAR_TARIFAS.SGD_FENV_CODIGO AND 
                      SGD_CLTA_CLSTARIF.SGD_TAR_CODIGO = SGD_TAR_TARIFAS.SGD_TAR_CODIGO AND 
                      SGD_CLTA_CLSTARIF.SGD_CLTA_CODSER = SGD_TAR_TARIFAS.SGD_CLTA_CODSER AND
					  SGD_CLTA_CLSTARIF.SGD_FENV_CODIGO = SGD_FENV_FRMENVIO.SGD_FENV_CODIGO
					ORDER BY SGD_CLTA_CLSTARIF.SGD_CLTA_CODSER, SGD_CLTA_CLSTARIF.SGD_FENV_CODIGO, 
					SGD_CLTA_CLSTARIF.SGD_TAR_CODIGO";
        }break;
    //MODIFICACION SKINA
    //ING CAMILO PINTOR
    //MODIFICACION DUPLICA RESULTADOS QUERY, TRAE DATOS UNICOS EN LA DB.	
    //DIC- 9- 2013
    case 'pai' : {
            $titulo = "LISTADO GENERAL DE PAISES";
            $tit_columnas = array('Id Pa&iacute;s', 'Continente', 'Nombre Pa&iacute;s');
            $isql = "SELECT DISTINCT(SGD_DEF_PAISES.ID_PAIS), SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS 
                                        FROM SGD_DEF_PAISES, SGD_DEF_CONTINENTES WHERE SGD_DEF_PAISES.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT
                                        ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS";
        }break;
    case 'tpr' : {
            $titulo = "LISTADO GENERAL DE TIPOS DE RADICADOS";
            $tit_columnas = array('Id T.R.', 'Nombre', 'Genera Rad. Salida?', 'D&iacute;as Bloqueo.');
            $isql = 'SELECT SGD_TRAD_CODIGO as "Id T.R.", SGD_TRAD_DESCR as "Nombre", 
					SGD_TRAD_GENRADSAL as "Genera Rad. Salida?", SGD_TRAD_DIASBLOQUEO as "Dias Bloqueo" 
					FROM SGD_TRAD_TIPORAD ORDER BY SGD_TRAD_CODIGO';
        }break;
    case 'fnv' : {
            $titulo = "LISTADO GENERAL DE FORMAS DE ENVIO";
            $tit_columnas = array('Id', 'Nombre', 'Estado', 'Genera Planilla?');
            $isql = "SELECT SGD_FENV_CODIGO, SGD_FENV_DESCRIP,
					 (CASE WHEN SGD_FENV_ESTADO = 0 THEN 'INACTIVO' WHEN SGD_FENV_ESTADO = 1 THEN 'ACTIVO' END),
					 (CASE WHEN SGD_FENV_PLANILLA = 0 THEN 'NO' WHEN SGD_FENV_PLANILLA = 1 THEN 'SI' END) 
					FROM SGD_FENV_FRMENVIO ORDER BY SGD_FENV_DESCRIP";
        }break;
    case 'lcd' : {
            $titulo = "LISTADO GENERAL DE RESOLUCIONES";
            $tit_columnas = array('Id', 'Resoluci&oacute;n');
            $isql = "SELECT SGD_TRES_CODIGO, SGD_TRES_DESCRIP FROM SGD_TRES_TPRESOLUCION ORDER BY SGD_TRES_CODIGO";
        }break;
    //MODIFICACION SKINA
    //ING CAMILO PINTOR
    //MODIFICACION DUPLICA RESULTADOS QUERY, TRAE DATOS UNICOS EN LA DB.	
    //DIC- 9- 2013
    case 'dpt' : {
            $titulo = "LISTADO GENERAL DE DEPARTAMENTOS";
            $tit_columnas = array('Continente', 'Nombre País', 'Id Dpto', 'Nombre Dpto');
            $isql = "SELECT DISTINCT SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, DEPARTAMENTO.DPTO_CODI, DEPARTAMENTO.DPTO_NOMB
					FROM SGD_DEF_PAISES, SGD_DEF_CONTINENTES, DEPARTAMENTO 
					WHERE SGD_DEF_PAISES.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT AND 
						SGD_DEF_PAISES.ID_PAIS = DEPARTAMENTO.id_pais AND 
						SGD_DEF_PAISES.ID_CONT = DEPARTAMENTO.id_cont
					ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, DEPARTAMENTO.DPTO_NOMB";
        }break;
    case 'dpc' : {
            $titulo = "LISTADO GENERAL DE DEPENDENCIAS";
            $tit_columnas = array('Id', 'Nombre', 'Sigla', 'Estado', 'Nombre Dpto');
            $isql = "SELECT DEPE_CODI, DEPE_NOMB, DEP_SIGLA, DEPE_ESTADO	
					FROM DEPENDENCIA 
					ORDER BY DEPE_CODI";
        }break;
    case 'cau' : {
            $titulo = "LISTADO GENERAL DE CAUSALES";
            $tit_columnas = array('Id', 'Nombre');
            $isql = "SELECT SGD_CAU_CODIGO, SGD_CAU_DESCRIP FROM SGD_CAU_CAUSAL ORDER BY 1";
        }break;
    case 'mdv' : {
            $titulo = "LISTADO GENERAL DE MOTIVOS DE DEVOLUCI&Oacute;N";
            $tit_columnas = array('Id', 'Nombre');
            $isql = 'SELECT SGD_DEVE_CODIGO AS "ID", SGD_DEVE_DESC AS "MOTIVO" FROM SGD_DEVE_DEV_ENVIO ORDER BY 1';
        }break;
    case 'tma' : {
            $titulo = "LISTADO GENERAL DE TEMAS";
            $tit_columnas = array('Id', 'Nombre', 'Dependencia Vinculada');
            $isql = "SELECT t.SGD_TMA_CODIGO, t.SGD_TMA_DESCRIP, d.DEPE_NOMB 
					FROM DEPENDENCIA d, SGD_TMA_TEMAS t, SGD_TMD_TEMADEPE td
					WHERE td.SGD_TMA_CODIGO=t.SGD_TMA_CODIGO AND td.depe_codi=d.depe_codi
					ORDER BY t.SGD_TMA_DESCRIP, d.DEPE_NOMB";
        }break;
    case 'ctt' : {
            $titulo = "LISTADO GENERAL DE CONTACTOS";
            $tit_columnas = array('Tipo Contacto', 'Empresa/Entidad', 'Id Contacto', 'Nombre Contacto', 'Cargo Contacto', 'Telefono Contacto');
            $isql = "SELECT (CASE WHEN c.CTT_ID_TIPO = 0 THEN 'Entidad' 
					WHEN c.CTT_ID_TIPO = 1 THEN 'Otras Emp.' END) AS TIPO, 
				b.NOMBRE_DE_LA_EMPRESA, 
				c.CTT_ID, 
				c.CTT_NOMBRE, 
				c.CTT_CARGO, 
				c.CTT_TELEFONO 
				FROM SGD_DEF_CONTACTOS c, BODEGA_EMPRESAS b 
				WHERE c.CTT_ID_EMPRESA = b.IDENTIFICADOR_EMPRESA 
				AND c.CTT_ID_TIPO=0 
				UNION SELECT (CASE WHEN c.CTT_ID_TIPO = 0 THEN 'Entidad' 
					WHEN c.CTT_ID_TIPO = 1 THEN 'Otras Emp.' END) AS TIPO, 
				b.SGD_OEM_OEMPRESA, 
				c.CTT_ID, 
				c.CTT_NOMBRE, 
				c.CTT_CARGO, 
				c.CTT_TELEFONO 
				FROM SGD_DEF_CONTACTOS c, SGD_OEM_OEMPRESAS b 
				WHERE c.CTT_ID_EMPRESA = b.SGD_OEM_CODIGO 
				AND c.CTT_ID_TIPO=1 
				ORDER BY 1, 2, 4";
        }break;
    case 'bge' : {
            $titulo = "LISTADO GENERAL DE ESP";
            $tit_columnas = array('Empresa', 'Sigla', 'Correo E', 'Tel&eacute;fonos', 'NIT', 'NIUR', 'Id Empresa');
            $isql = "SELECT NOMBRE_DE_LA_EMPRESA, SIGLA_DE_LA_EMPRESA, EMAIL, TELEFONO_1, NIT_DE_LA_EMPRESA,
					NUIR, IDENTIFICADOR_EMPRESA 
					FROM BODEGA_EMPRESAS
					ORDER BY NOMBRE_DE_LA_EMPRESA, SIGLA_DE_LA_EMPRESA";
        }break;
    case 'sts' : {
            $titulo = "LISTADO GENERAL DE SECTORES";
            $tit_columnas = array('Id Sector', 'Nombre');
            $isql = "SELECT PAR_SERV_SECUE, PAR_SERV_NOMBRE FROM PAR_SERV_SERVICIOS ORDER BY PAR_SERV_SECUE";
        }break;
    case 'dpc' : {
            $titulo = "LISTADO GENERAL DE DEPENDENCIAS";
            $tit_columnas = array('Id', 'Nombre', 'Sigla', 'Estado', 'Nombre Dpto');
            $isql = "SELECT DEPE_CODI, DEPE_NOMB, DEP_SIGLA, DEPE_ESTADO	
				FROM DEPENDENCIA ORDER BY DEPE_CODI";
        }break;
    //MODIFICACION SKINA
    //ING CAMILO PINTOR
    //MODIFICACION DUPLICA RESULTADOS QUERY, TRAE DATOS UNICOS EN LA DB.	
    //DIC- 9- 2013
// MODIFICADO SKINA	
    case 'mcp' : {
            $titulo = "LISTADO GENERAL DE MUNICIPIOS";
            $isql = "SELECT DISTINCT SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, 
                      DEPARTAMENTO.DPTO_NOMB, MUNICIPIO.MUNI_CODI, MUNICIPIO.MUNI_NOMB 
					FROM MUNICIPIO, SGD_DEF_CONTINENTES, SGD_DEF_PAISES, DEPARTAMENTO 
					WHERE MUNICIPIO.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT AND
                      MUNICIPIO.ID_PAIS = SGD_DEF_PAISES.ID_PAIS AND
                      MUNICIPIO.DPTO_CODI = DEPARTAMENTO.DPTO_CODI
					ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS, 
                      DEPARTAMENTO.DPTO_NOMB, MUNICIPIO.MUNI_NOMB ";
        }break;

    /* default:
      {	$titulo = "LISTADO GENERAL DE MUNICIPIOS";
      $isql = "SELECT SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS,
      DEPARTAMENTO.DPTO_NOMB, MUNICIPIO.MUNI_CODI, MUNICIPIO.MUNI_NOMB
      FROM MUNICIPIO, SGD_DEF_CONTINENTES, SGD_DEF_PAISES, DEPARTAMENTO
      WHERE MUNICIPIO.ID_CONT = SGD_DEF_CONTINENTES.ID_CONT AND
      MUNICIPIO.ID_PAIS = SGD_DEF_PAISES.ID_PAIS AND
      MUNICIPIO.DPTO_CODI = DEPARTAMENTO.DPTO_CODI
      ORDER BY SGD_DEF_CONTINENTES.NOMBRE_CONT, SGD_DEF_PAISES.NOMBRE_PAIS,
      DEPARTAMENTO.DPTO_NOMB, MUNICIPIO.MUNI_NOMB ";
      }break; */
}

//$db->conn->->debug=true;
$Rs_clta = $db->conn->Execute($isql);
?>
<html>
    <head>
        <title><?= $titulo ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <!--        <link href="../../estilos/orfeo50/bootstrap.css" rel="stylesheet" type="text/css"/>
                <link href="../../estilos/orfeo.css" rel="stylesheet" type="text/css"/>-->
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    </head>
    <body>
        <?
//Mecanismo anterior para crear listados
//switch ($_GET['var'])
//{	case 'tar'	:
//	case 'pai'	:
//	case 'tpr'	:
//	case 'fnv'	:
//	case 'lcd'	:
//	case 'dpt'	:
//	case 'dpc'	: //repetido
//	case 'cau'	:
//	case 'mdv'	:
//	case 'tma'	:
//	case 'ctt'	:
//	case 'bge'	:
//	case 'sts'	:
//	case 'dpc'	:	
//	case 'mcp'      :
//		{
//			$html = rs2html($db, $Rs_clta,'border="1" cellpadding="0" align="center"',$tit_columnas,true,false);
//			$pos1 = strpos($html,"</TABLE>\n\n");
//			$cnt_tmp = substr_count($html,"</TH>\n</tr>");
//			if($cnt_tmp > 1)
//			while(--$cnt_tmp)
//			{
//				$pos1 = strpos($html,"</TABLE>\n\n");
//				$pos2 = strpos($html,"</TH>\n</tr>",$pos1)+11;
//				$html = substr($html,0,$pos1) . substr($html,$pos2,strlen($html));
//			}
//			echo $html;
//		}break;
//	default		: 
//		{			
//			include($ADODB_PATH.'/adodb-pager.inc.php'); //genera conflicto al re-instanciar la clase ADODB_Pager (ya incuida en alguna parte)
//			$pager = new ADODB_Pager($db,$isql);
//			$pager->Render($rows_per_page=20);
//			break;
//		}
//}
//$Rs_clta->Close();
        ?>

        <?
        //24-02-2017 se actualiza a la libreria de creacion de tablas de bootstrap
        switch ($_GET['var']) {
            case 'tar' :
            case 'pai' :
            case 'tpr' :
            case 'fnv' :
            case 'lcd' :
            case 'dpt' :
            case 'cau' :
            case 'mdv' :
            case 'tma' :
            case 'ctt' :
            case 'bge' :
            case 'sts' :
            case 'dpc' :
            case 'mcp' : {
                    $linkPagina = $PHP_SELF . "?var=" . $_GET['var'];
                    $pager = new ADODB_Pager($db, $isql, 'adodb', true,"1","asc");
                    $pager->checkAll = false;
                    $pager->checkTitulo = true;
                    $pager->toRefLinks = $linkPagina;
//                    $pager->toRefVars = $encabezado;
                    $pager->toRefVars = "var=" . $_GET['var']."&";
                    $pager->Render($rows_per_page = 15, $linkPagina);
                    break;
                }break;

            default : {
                    $html = rs2html($db, $Rs_clta, 'border="1" cellpadding="0" align="center"', $tit_columnas, true, false);
                    $pos1 = strpos($html, "</TABLE>\n\n");
                    $cnt_tmp = substr_count($html, "</TH>\n</tr>");
                    if ($cnt_tmp > 1)
                        while (--$cnt_tmp) {
                            $pos1 = strpos($html, "</TABLE>\n\n");
                            $pos2 = strpos($html, "</TH>\n</tr>", $pos1) + 11;
                            $html = substr($html, 0, $pos1) . substr($html, $pos2, strlen($html));
                        }
                    echo $html;
                }
        }
        $Rs_clta->Close();
        ?>
    </body>
</html>