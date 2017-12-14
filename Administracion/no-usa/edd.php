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

/**
 * Retorna la cantidad de bytes de una expresion como 7M, 4G u 8K.
 *
 * @param char $var
 * @return numeric
 */
function return_bytes($val)
{	$val = trim($val);
	$ultimo = strtolower($val{strlen($val)-1});
	switch($ultimo)
	{	// El modificador 'G' se encuentra disponible desde PHP 5.1.0
		case 'g':	$val *= 1024;
		case 'm':	$val *= 1024;
		case 'k':	$val *= 1024;
	}
	return $val;
}
if (!$db)	$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
$db->conn->debug=true;
$phpsession = session_name()."=".session_id();
    $params=$phpsession."&krd=$krd&codusua=$codusua&coddepe=$coddepe&arch=$arch";
    $hora=date("H")."_".date("i");
    // var que almacena el dia de la fecha
$ddate=date('d');
// var que almacena el mes de la fecha
$mdate=date('m');
// var que almacena el a�o de la fecha
$adate=date('Y');
// var que almacena  la fecha formateada
$fecha=$adate."_".$mdate."_".$ddate;
$arcCsv=$fecha."_".$hora;
$p=1;
?>
<head>
<title>Cargar en CSV</title>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>

<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<script language="JavaScript" type="text/JavaScript">

function validar() {

	archCSV = document.formAdjuntarArchivos.archivoCsv.value;

	if ( (archCSV.substring(archCSV.length-1-3,archCSV.length)).indexOf(".csv") == -1 ){
		alert ("El archivo de datos debe ser .csv");
		return false;
	}

	if (document.formAdjuntarArchivos.archivoCsv.value.length<1){
		alert ("Debe ingresar el archivo CSV");
		return false;
	}
	return true;
}

function enviar() {

	if (!validar()){
	<?$carga_tmp=true;?>
		return;
	}
	//document.formAdjuntarArchivos.accion.value="PRUEBA";
	document.formAdjuntarArchivos.submit();
}

</script>
<CENTER>
<form action="cargarcsv.php?<?=$params?>" name="formAdjuntarArchivos" method="POST" enctype="multipart/form-data" >
<?
if ($archivoCsv_size >= 10000000 )
{	echo "el tama&nacute;o de los archivos no es correcto. <br><br><table><tr><td><li>se permiten archivos de 100 Kb m&aacute;ximo.</td></tr></table>";
}
include ("$ruta_raiz/include/upload/upload_class.php");
$max_size = return_bytes(ini_get('upload_max_filesize')); // the max. size for uploading
$my_upload = new file_upload;
 $my_upload->language="es";
$my_upload->upload_dir = "$ruta_raiz/bodega/tmp/"; // "files" is the folder for the uploaded files (you have to create this folder

$my_upload->extensions = array(".csv"); // specify the allowed extensions here
//$my_upload->extensions = "de"; // use this to switch the messages into an other language (translate first!!!)
$my_upload->max_length_filename = 50; // change this value to fit your field length in your database (standard 100)
$my_upload->rename_file = true;
$archivoCsv = $_POST['cargarArchivo'];
if(isset($archivoCsv)) {
	$tmpFile = trim($_FILES['archivoCsv']['name']);
	$newFile = $arcCsv;
	$uploadDir = "$ruta_raiz/bodega/tmp/";
	$fileGrb = $arcCsv;
	$my_upload->upload_dir = $uploadDir;

	$my_upload->the_temp_file = $_FILES['archivoCsv']['tmp_name'];
	$my_upload->the_file = $_FILES['archivoCsv']['name'];
	$my_upload->http_error = $_FILES['archivoCsv']['error'];
	$my_upload->replace = (isset($_POST['replace'])) ? $_POST['replace'] : "n"; // because only a checked checkboxes is true
	$my_upload->do_filename_check = (isset($_POST['check'])) ? $_POST['check'] : "n"; // use this boolean to check for a valid filename
	//$new_name = (isset($_POST['name'])) ? $_POST['name'] : "";
	if ($my_upload->upload($newFile)) {
		// new name is an additional filename information, use this to rename the uploaded file
		$full_path = $my_upload->upload_dir.$my_upload->file_copy;
		$info = $my_upload->get_uploaded_file_info($full_path);
		// ... or do something like insert the filename to the database
		$h = fopen($full_path,"r") ;

		if (!$h)
		{	echo "<BR> No hay un archivo csv llamado *". $full_path."*";
		}
		else
		{
			echo "Subio CSV ".$full_path;
			$alltext_csv = "";
			$encabezado = array();
			$datos = array();
			//$j=-1;
			$j=0;
			//	Comentariada por HLP. Para puebas de arhivo csv delimitado por ;
			//while ($line=fgetcsv ($h, 10000, ";"))
			//while ($line=fgetcsv ($h, 10000, ","))
			while ($line=fgetcsv ($h, 10000, "|"))
			{	$num= count($line);
 				if($num==10) {  echo "<p> $num fields in line $j: <br /></p>\n";
				$j++;
				if ($j==0)
					$encabezado = array_merge ($encabezado,array($line));
				else
					$datos=  array_merge ($datos,array($line));
				/*for ($c=0; $c < $num; $c++) {
         			   echo $line[$c] . "<br />\n";
					}
				*/
				//Asigno variables
				$rm=$line[0];
				$asunto=$line[1];
				$nombre=$line[2];
				$dir=$line[3];
				$tel=$line[4];
				$mail=$line[5];
				$fecha=$line[6];
				$ruta=$line[7];
				$rnc=$line[8];
				$ciudad=$line[9];

				//Verifico vacios
				/*if($asunto=='') die ("El asunto no puede estar en blanco");
				if($dir=='') die ("La direccion no puede estar en blanco");
				if($ciudad=='') die ("La ciudad no puede estar en blanco");
				if($nombre=='') die ("El nombre no puede estar en blanco");
				*/
				/*if($tel=='') $tel='""';
				if($mail=='') $mail='""';
				if($rnc=='') $rnc='""';*/
				
				//Busco si el RM existe, si no inserto la empresa
				$sql_doc="select nit_de_la_empresa from bodega_empresas where nit_de_la_empresa='$rm'";
				$rs_doc=$db->conn->Execute($sql_doc);
				if($rs_doc->EOF){		
					//busco id del municipio
					$sql_muni="select muni_codi,dpto_codi from municipio where muni_nomb='$ciudad'";
        				$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
					$rs_muni=$db->conn->Execute($sql_muni);
					$muni=$rs_muni->fields["MUNI_CODI"];
					$dpto=$rs_muni->fields["DPTO_CODI"];
					echo " muni $muni dpto $dpto";	
					if(!$muni or $muni=='') $muni=1;
					if(!$dpto or $dpto=='') $dpto=101; 
					$id_bod=$db->conn->nextId('SEC_BODEGA_EMPRESAS');
	
					$sql_bodega="Insert into bodega_empresas (nit_de_la_empresa, nombre_de_la_empresa,  direccion, telefono_1,codigo_del_departamento, codigo_del_municipio, id_cont, id_pais, activa,are_esp_secue, identificador_empresa,email,nuir)
					 values ('$rm','$nombre','$dir','$tel',$dpto,$muni,1,214,1,8,$id_bod,'$mail','$rnc')";
				//echo $sql_bodega."<br>";
				$rs_bod=$db->conn->Execute($sql_bodega);
				if($rs_bod) echo "<br> <br> Subo empresa nueva $line[0]";	
				

				//Inserto direccion para el radicado por cada empresa
				$secNew=$db->conn->nextId('SECR_TP1_998');
				$radicado= date("Y") . "998" . str_pad($secNew,6,"0", STR_PAD_LEFT) . "1";
                               
				$secdir=$db->conn->nextId('SEC_DIR_DIRECCIONES');

				$sql_dir="INSERT INTO SGD_DIR_DRECCIONES (SGD_DIR_CODIGO, 
						SGD_DIR_TIPO,SGD_ESP_CODI,RADI_NUME_RADI, ID_CONT, 
						ID_PAIS, MUNI_CODI, DPTO_CODI, SGD_DIR_DIRECCION, 
						SGD_DIR_TELEFONO, SGD_DIR_NOMREMDES,SGD_DIR_MAIL,SGD_DIR_DOC,SGD_TRD_CODIGO) 
						VALUES ($secdir,1,$id_bod,$radicado,1,214,$muni,$dpto,'$dir','$tel','$nombre','$mail','$rm',3)";

				//echo $sql_dir."<br>";
				$rs_dir=$db->conn->Execute($sql_dir);
			
				//Busco TRD
				$sql_tdoc="select sgd_tpr_codigo from sgd_tpr_tpdcumento where sgd_tpr_descrip like '%$asunto%'";
        			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
				$rs_tdoc=$db->conn->Execute($sql_tdoc);
				if($rs_tdoc->EOF){
					$tipo_doc=0;
					echo "<br> <br> No encontre el tipo documental";
				       }
                                 else { 
					$tipo_doc=$rs_doc->fields["SGD_TPR_CODIGO"];
					
					if (!$tipo_doc or $tipo_doc=='') $tipo_doc=0;
					echo "<br> <br> Encontre el tipo documental $tipo_doc";
					}

				//Inserto radicado
				$sql_rad="INSERT INTO RADICADO( RADI_NUME_RADI,RADI_FECH_OFIC,RADI_FECH_RADI, TDOC_CODI,TRTE_CODI,  ID_CONT, radi_pais, muni_codi, DPTO_CODI, CARP_CODI, RADI_USUA_ACTU, RADI_DEPE_ACTU, RADI_DEPE_RADI, RADI_USUA_RADI, CODI_NIVEL, RA_ASUN, RADI_LEIDO, FLAG_NIVEL, CARP_PER, esta_codi,sgd_spub_codigo,radi_path) 
				VALUES ($radicado,'$fecha',CURRENT_TIMESTAMP,$tipo_doc,0,1,214,$muni,$dpto,0,1,998,998,1,1,'$asunto',0,1,0,9,0,'$ruta')";

				//echo $sql_rad."<br>";
				$rs_rad=$db->conn->Execute($sql_rad);

				//Solo para CCPSD
				//$sql_rm="update radicado set numero_rm='$rm' where radi_nume_radi=$radicado";
				//$rs_rm=$db->conn->Execute($sql_rm);

				if($rs_rad and $rs_dir) echo "<br> <br> Subo radicado nuevo $radicado";
				else echo "<br> <br> No pude insertar radicado";
				//if($rs_rm) echo "<br> <br> Actualizo radicado nuevo $radicado con RM $rm";
				//else echo "<br> <br> No pude insertar RM en radicado";
				
				}//fin si existe rm 
				
				//Ya existe la empresa, busco el radicado creado	
				echo "<br> Ya existe la empresa $rm - $nombre busco los datos para el expediente";	
				$sql_brad="select radi_nume_radi,radi_path from radicado where numero_rm='$rm'";
				$rs_brad=$db->conn->Execute($sql_brad);	
				$radicado=$rs_brad->fields['RADI_NUME_RADI'];
				$radi_path=$rs_brad->fields['RADI_PATH'];	
				//
				if ($radicado){
				//Busco cada subserie 
				$sql_sbrd="select sgd_srd_codigo,sgd_sbrd_codigo from sgd_sbrd_subserierd where sgd_sbrd_descrip like '%$asunto%'";
        			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
				$rs_sbrd=$db->conn->Execute($sql_sbrd);
				if($rs_sbrd->EOF){
					$srd=43;
					$sbrd=13;
					echo "<br> <br> No encontre la serie y subserie, por defecto uso un expediente de serie $srd y subserie $sbrd";

					}else { 
					$srd=$rs_sbrd->fields["SGD_SRD_CODIGO"];
					$sbrd=$rs_sbrd->fields["SGD_SBRD_CODIGO"];
					echo "<br> <br> Encontre la serie y subserie, se creara un expediente de serie $srd y subserie $sbrd";
					}

				//Busco si ya existe un expediente
				$sql_bexp="select sgd_exp_numero from sgd_sexp_secexpedientes 
				where sgd_exp_numero like '%998$srd$sbrd%' and sgd_sexp_parexp1 like '%$rm%'";
        			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
				$rs_bexp=$db->conn->Execute($sql_bexp);		

				//si no existe, creo el exp
				if ($rs_bexp->EOF) {
					
					$sql_bexp="select max(sgd_sexp_secuencia) as EXP from sgd_sexp_secexpedientes 
					where sgd_exp_numero like '%998$srd$sbrd%'";
        				$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
					$rs_bexp=$db->conn->Execute($sql_bexp);		
					$secexp1=$rs_bexp->fields['EXP'];
					$secexp=$secexp1 + 1;
					echo "1 $secexp1 sexp $secexp";
					$expediente= date("Y") . "998".$srd.$sbrd.str_pad($secexp,5,"0", STR_PAD_LEFT)."E";
	
					$sql_secexp="insert into sgd_sexp_secexpedientes(sgd_exp_numero, sgd_srd_codigo, sgd_sbrd_codigo, sgd_sexp_secuencia, depe_codi, usua_doc, sgd_sexp_fech, sgd_fexp_codigo, sgd_sexp_ano, usua_doc_responsable, sgd_pexp_codigo,sgd_sexp_parexp1) 
					values ('$expediente',$srd,$sbrd,$secexp,999,'12345678909',current_date,0,2011,'12345678909',0,'$rm - $nombre')";

				//echo $sql_secexp."<br>";
				$rs_sexp=$db->conn->Execute($sql_secexp);
				if($rs_sexp) echo "<br> <br> Creo expediente nuevo $expediente";
				}else {
				$expediente=$rs_bexp->fields['SGD_EXP_NUMERO'];
				}
				
				
				//Busco si ya existe un expediente
				$sql_rexp="select sgd_exp_numero from sgd_exp_expediente 
				where sgd_exp_numero like '$expediente' and radi_nume_radi like '$radicado'";
        			$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
				$rs_rexp=$db->conn->Execute($sql_rexp);		
				
				if($rs_rexp->EOF){
				//Inserto el radicado en el expediente
				$sql_exp="insert into sgd_exp_expediente(sgd_exp_numero, radi_nume_radi, sgd_exp_fech, depe_codi, usua_codi, usua_doc, sgd_exp_estado) 
					values ('$expediente',$radicado,current_date,999,1,'12345678909',0)";

				//echo $sql_exp."<br>";
				$rs_exp=$db->conn->Execute($sql_exp);
				if($rs_exp) echo "<br> <br> Subo radicado nuevo a $expediente";

				}
				//Los anexos los ingreso uno a uno, si ya existe una ruta para el radicado principal
				if($radi_path and $radi_path!=''){
					$isql_max= "select max(anex_codigo) as NUM from anexos
             where anex_radi_nume=$radicado ";
        				$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
        				$sw=0;
        				$rs_max=$db->conn->query($isql_max);

        				if  (!$rs_max->EOF)
                        		$auxnumero=$rs_max->fields["NUM"];
        				else
                				$auxnumero=0;
        				$auxnumero = substr ($auxnumero, strlen($auxnumero)-4, 4);
			        	$uxnumeroSig = $auxnumero + 1;
					$anexo= $radicado . str_pad($uxnumeroSig,5,"0", STR_PAD_LEFT) ;
				echo "siguiente anexo $uxnumeroSig $radicado anex $anexo";
	
					$sql_anex="INSERT INTO ANEXOS(ANEX_RADI_NUME, ANEX_CODIGO, ANEX_TIPO, ANEX_SOLO_LECT, ANEX_CREADOR, ANEX_DESC, ANEX_NUMERO, ANEX_NOMB_ARCHIVO, ANEX_BORRADO, ANEX_ESTADO, USUA_DOC, SGD_DIR_TIPO, ANEX_DEPE_CREADOR, ANEX_FECH_ANEX, SGD_EXP_NUMERO) 
				VALUES ($radicado,$anexo,7,'S','DSALIDA','$asunto',$uxnumeroSig,'$ruta','N',0,'12345678909',1,998,current_timestamp,'$expediente')";

			}else {
				//$sql_anex="update radicado set radi_path='$ruta' where radi_nume_radi=$radicado";
			}//fin del if path  vacio
		
					//echo $sql_anex."<br>";
					$rs_anex=$db->conn->Execute($sql_anex);
					if($rs_anex) echo "<br> <br> Subo anexo nuevo $anexo";
			}else{
			echo "<br> No encontre radicado para insertar expediente y anexo";
			} //fin if radicado
			}else{
				 echo ("<br> <br> Deben ser 10 campos en cada linea, hay $num en la linea $j");
			}//fin if nume>10
			} // while get

		}
	}else
	{
	die("<table class=borde_tab><tr><td class=titulosError>Ocurrio un Error la Fila no fue cargada Correctamente <p>".$my_upload->show_error_string()."<br><blockquote>".nl2br($info)."</blockquote></td></tr></table>");
	}



}

	?>
<table width="90%" border="0" cellspacing="5" class="borde_tab">
    <tr align="center">
    <td class="titulos5" colspan="2">Inserte el Nombre del Archivo CSV </td></tr>
<tr>
    <td> <input name="archivoCsv" type="file" class="tex_area" id=archivoCsv  value='<?=$archivoCsv?>'>
<input type=hidden value='cargarArchivo' name=cargarArchivo>
    </td>
    </tr>
    <tr><td align="center"> <input type="button" class="botones_funcion" onClick="enviar();" id="envia22" name="Cargar" value="Cargar">

    <input type="button" value="Cerrar" class="botones_funcion"  onclick="window.close();"> </td>
    </tr>
    </table>
</FORM>
