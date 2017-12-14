<?php
session_start();
//error_reporting(E_ALL);
//ini_set('display_errors', '1');
/**
 * Modulo de Formularios Web para atencion a Ciudadanos.
 * @autor Carlos Barrero   carlosabc81@gmail.com SuperSolidaria
 * @author Sebastian Ortiz Vasquez 2012
 * @fecha 2009/05
 * @Fundacion CorreLibre.org
 * @licencia GNU/GPL V2
 *
 * Se tiene que modificar el post_max_size, max_file_uploads, upload_max_filesize
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;//iconv("ISO-8859-1","UTF-8",$valor);
foreach ($_POST as $key => $valor)   ${$key} = $valor; //iconv("ISO-8859-1","UTF-8",$valor);
$pais_formulario = $pais;
define('ADODB_ASSOC_CASE', 2);


$ruta_raiz = "..";
$ADODB_COUNTRECS = false;

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once 'funciones.php';
include_once './adjuntarArchivos.php';
include_once($ruta_raiz."/include/PHPMailer/class.phpmailer.php");
include_once($ruta_raiz."/config.php");
//require_once($ruta_raiz."/conf/configPHPMailer.php");

$db   = new ConnectionHandler($ruta_raiz);
$mail = new PHPMailer();
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
$db->conn->debug=true;

	//inserta en radicado
$tipoRadicado = 4;
session_start();
$errorFormulario = 0;

		//Skina
                //Modificacion 
                // Ing Camilo Pintor - cpintor@skinatech.com
                // No se usa el captcha por cuestiones de accesibilidad
//strcasecmp ($captcha ,$_SESSION['captcha_formulario']['code'] )
/*if(strcasecmp ($captcha ,$_SESSION['captcha_formulario']['code'] ) != 0 || strcasecmp ($idFormulario ,$_SESSION["idFormulario"] ) != 0){
	$errorFormulario = 1;
	//Deshabilitada mientras se pueban otras cosas
	//return;
}*/
if($errorFormulario==0){
//	echo 'valor de errorFormulario </br>';
	$uploader = new Uploader($_FILES);
	$uploader->FILES = $_FILES;
	$adjuntosSubidos = json_decode($adjuntosSubidos);
	$uploader->subidos = $adjuntosSubidos;
	$uploader->adjuntarYaSubidos();
}
if($errorFormulario==0){
		//Skina
                //Modificacion 
                // Ing Camilo Pintor - cpintor@skinatech.com
                // Se modifica ya que no se maneja anonimos
	/*if($anonimo==1){
		//Esto es anónimo
		$_SESSION['nombre_remitente']="Anónimo";
		$_SESSION['apellidos_remitente']="N.N";
		$_SESSION['cedula']=0;
		$_SESSION['nit'] = 0;
		$_SESSION['depto']=0;
		$_SESSION['muni']=$muni;
		$_SESSION['direccion_remitente']="No registra";
		$_SESSION['telefono_remitente']="No registra";
		$_SESSION['email']=$email==''?"":$email;
		$mediorespuesta=$_SESSION['email']==""?3:$mediorespuesta;
		//Puede ser anonima.
		if(!$_SESSION['nombre_remitente']) $_SESSION['nombre_remitente']="Anónimo";
		if(!$_SESSION['cedula']) $_SESSION['cedula']=0;
		if(!$_SESSION['depto']) $_SESSION['depto']=0;
		if(!$_SESSION['muni']) $_SESSION['muni']=0;
		if(!$_SESSION['direccion_remitente']) $_SESSION['direccion_remitente']="No registra";
		if(!$_SESSION['telefono_remitente']) $_SESSION['telefono_remitente']="No registra";
		$_SESSION['email']=$email==''?"":$email;

	} else if ($anonimo == 0){*/
		//No es anónimo
		//Skina
                //Modificacion 
                // Ing Camilo Pintor - cpintor@skinatech.com
                // Se renombran las variable para ser constantes con el formulario y se discrimina
		// campo de segundo apellido o representante legal.
		$_SESSION['nom_ciu']=$nom_ciu;
		$_SESSION['apell1_ciu']=$apell1_ciu;
		$_SESSION['apell2_ciu']=$apell2_ciu;
		//campos para personas juriridicas o empresas
                $_SESSION['sigla']=$sigla;
                $_SESSION['razonSocial']=$raz_social;
                $_SESSION['repLegal']=$rep_legal;				

		if($tipoDocumento == ''){
                        //No selecciono tipo de documento
                        $_SESSION['documento'] = 0;
                        //$_SESSION['nit'] = 0;
                //Skina
                //Modificacion 
                // Ing Camilo Pintor - cpintor@skinatech.com
                // Se modifica el tipo de dosumento para ser constantes con la db
                }else if($tipoDocumento==4){
                        //Tipo de documento NIT
                        //$_SESSION['cedula'] = 0 ;
                        $_SESSION['documento'] = $doc_ciu!=""?$doc_ciu:0;
                } else{
                        //Tipo de documento diferente de NIT
                        $_SESSION['documento']=$doc_ciu;
                        //$_SESSION['nit'] = 0;
                }

                if($depto!=0 && ($muni<1 || $muni >999)){
                        $muni=1;
                }

                $_SESSION['depto']=$depto;
                $_SESSION['muni']=$muni;
                $_SESSION['direccion']=$direccion==''?"No registra":$direccion;
                $_SESSION['telefono']=$telefono;
                $_SESSION['email']=$email==''?"No registra":$email;

	/*}*/

	if($pqrsFacebook=="1"){
		//Medio de recepción Facebook
		$_SESSION['mrec_codi']=10;
	}else{
		//Medio de recepción Internet
		$_SESSION['mrec_codi']=3;
	}
	//Skina
        //Modificacion 
        // Ing Camilo Pintor - cpintor@skinatech.com
        // Se agrega para grabar dias de termino y codigo de solicitud
	$tipoSolicTerm = explode("-",$tipoSolicitud);
	$_SESSION['tipo']=$tipoSolicTerm[0];
	$_SESSION['dtermino']=$tipoSolicTerm[1];
	$_SESSION['asunto']=$asunto;
	$_SESSION['desc']=textoPDF($comentario);
	//TODO Imprimir el grupo de poblacional haciendo la consulta a sgd_tma_temas
	//$_SESSION['desc'].= textoPDF("Manifiesto que pertenezco al grupo pblacional: " );
	$_SESSION['desc'].= textoPDF("\n\n".$uploader->listadoImprimible);
	
	//Todos se responden a través del correo electrónico
//	if($mediorespuesta==0){
//		$_SESSION['desc'].=textoPDF("\nPor favor responder a través de mi correo electrónico: ".$_SESSION['email']);
//	}else if($mediorespuesta==1){
//		$_SESSION['desc'].=textoPDF("\nPor favor responder a través de mi dirección de correspondencia: ".$_SESSION['direccion_remitente']);
//	}
	//TODO Revisar que hacer con todas estas otras cosas.
	//radicado.eesp_codi
	$_SESSION['codigo_orfeo']="0";

	$_SESSION['usuario']=1;

	//Skina
        //Modificacion 
        // Ing Camilo Pintor - cpintor@skinatech.com
        // Se cambia para usar la dependencias del eje tematico seleccionado
	if(!$_SESSION['dependencia']) $_SESSION['dependencia']='630';
	$dependenciaRad = $_SESSION['dependencia'];

        if (isset($tipoEje)) $_SESSION['depeRadicaFormularioWeb']= $tipoEje;
	if(!$_SESSION['depeRadicaFormularioWeb']) $_SESSION['depeRadicaFormularioWeb'] = $depeRadicaFormularioWeb;
        $_SESSION['radicado']= $radicado;
        if(!$_SESSION['usuaRecibeWeb']) $_SESSION['usuaRecibeWeb'] = $usuaRecibeWeb;
        $_SESSION['documento_destino']=$_GET['documento_destino'];

	$numero_completado = "000000".$db->conn->GenID($secRadicaFormularioWeb);
	$numero=substr($numero_completado , -6 );
	$num_dir=$db->conn->GenID('SEC_DIR_DIRECCIONES');
	$dependenciaCompletada = "00000".$_SESSION['depeRadicaFormularioWeb'];

	$depeRadicaFormularioWeb;  // Es radicado en la Dependencia 440 CALIDAD DE SERVICIO
	$usuaRecibeWeb ; // Usuario que Recibe los Documentos Web
	$secRadicaFormularioWeb ;
        //4 hace referencia a las PQR en el caso de EEBP
	$numeroRadicado = date('Y').substr($dependenciaCompletada,-1*$longitud_codigo_dependencia).$numero.$tipoRadicado;//se multiplica por el numero de digitos de dependencia - Skina
                //Skina
                //Modificacion 
                // Ing Camilo Pintor - cpintor@skinatech.com
                // Se modifica el tipo de documento para ser constantes con la db
	if($tipoDocumento >= 0 && $tipoDocumento != 4 ){
		//inserta ciudadano
		
		$num_ciu=$db->conn->GenID('SEC_CIU_CIUDADANO');
                $record["TDID_CODI"] = $tipoDocumento;
                $record["SGD_CIU_CODIGO"] = $num_ciu;
                $record["SGD_CIU_NOMBRE"] = "'".mb_strtoupper($_SESSION['nom_ciu'],"utf-8")."'";
                $record["SGD_CIU_DIRECCION"] = "'".mb_strtoupper($_SESSION['direccion'],"utf-8")."'";
                $record["SGD_CIU_APELL1"] = "'".mb_strtoupper($_SESSION['apell1_ciu'],"utf-8")."'";
                $record["SGD_CIU_APELL2"] = "'".mb_strtoupper($_SESSION['apell2_ciu'],"utf-8")."'";
                $record["SGD_CIU_TELEFONO"] = "'".$_SESSION['telefono']."'";
                $record["SGD_CIU_EMAIL"] = "'".$_SESSION['email']."'";
                $record["MUNI_CODI"] = $_SESSION['muni'];
                $record["DPTO_CODI"] = $_SESSION['depto'];
                $record["SGD_CIU_CEDULA"] = "'".$_SESSION['documento']."'";



                $ins_ciu=$db->conn->Replace("SGD_CIU_CIUDADANO",$record,array('SGD_CIU_CEDULA','SGD_CIU_CODIGO'),false);


                if ($ins_ciu == 0){

                    include "./pag_error.php";
                }

		//inserta en sgd_dir_direcciones
                $ins_dir="insert into sgd_dir_drecciones(sgd_dir_codigo,sgd_dir_tipo,sgd_oem_codigo,sgd_ciu_codigo,radi_nume_radi,sgd_esp_codi,muni_codi,dpto_codi,sgd_dir_direccion,sgd_dir_telefono,sgd_sec_codigo,sgd_dir_nombre,sgd_dir_nomremdes,sgd_trd_codigo,sgd_dir_doc,sgd_dir_mail)
        values(".$num_dir.",1,0,".$num_ciu.",'$numeroRadicado',0,".$_SESSION['muni'].",".$_SESSION['depto'].",'".$_SESSION['direccion']."','".$_SESSION['telefono']."',0,'".mb_strtoupper($_SESSION['nom_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell1_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell2_ciu'],"utf-8")."','".mb_strtoupper($_SESSION['nom_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell1_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell2_ciu'],"utf-8")."',1,'".$_SESSION['documento']."','".$_SESSION['email']."')";
		//Skina
                //Modificacion 
                // Ing Camilo Pintor - cpintor@skinatech.com
                // Se modifica el tipo de dosumento para ser constantes con la db
	}else if($tipoDocumento == 4){
	
		$num_oem=$db->conn->GenID('SEC_OEM_EMPRESAS');
                //insertar empresa en sgc_oem_empresas
                $record["SGD_OEM_CODIGO"] = $num_oem;
                $record["TDID_CODI"] = $tipoDocumento;
                $record["SGD_OEM_OEMPRESA"] = "'".mb_strtoupper($_SESSION['razonSocial'],"utf-8")."'";
                $record["SGD_OEM_REP_LEGAL"] = "'".mb_strtoupper($_SESSION['repLegal'],"utf-8")."'";
                $record["SGD_OEM_NIT"] = "'".$_SESSION['documento']."'";
                $record["SGD_OEM_SIGLA"] ="'".mb_strtoupper($_SESSION['sigla'],"utf-8")."'";
                $record["MUNI_CODI"] = $_SESSION['muni'];
                $record["DPTO_CODI"] = $_SESSION['depto'];
                $record["SGD_OEM_DIRECCION"] ="'".mb_strtoupper($_SESSION['direccion'],"utf-8")."'";
                $record["SGD_OEM_TELEFONO"] = $_SESSION['telefono'];
                $record["ID_CONT"] = 1;
                $record["ID_PAIS"] = 170;
                $record["EMAIL"] = "'".$_SESSION['email']."'";

                
                $ins_empresa= $db->conn->Replace("SGD_OEM_OEMPRESAS",$record,array('SGD_OEM_NIT','SGD_OEM_CODIGO'),false);
        
                    if ($ins_empresa == 0){
                
                    include "./pag_error.php";
                }

        $_SESSION['radicado']= $radicado;
        $_SESSION['documento_destino']=$_GET['documento_destino'];
        if(!$_SESSION['dependencia']) $_SESSION['dependencia']='630';
        
                //inserta en sgd_dir_direcciones
                $ins_dir="insert into sgd_dir_drecciones(sgd_dir_codigo,sgd_dir_tipo,sgd_oem_codigo,sgd_ciu_codigo,radi_nume_radi,sgd_esp_codi,muni_codi,dpto_codi,sgd_dir_direccion,sgd_dir_telefono,sgd_sec_codigo,sgd_dir_nombre,sgd_dir_nomremdes,sgd_trd_codigo,sgd_dir_doc,sgd_dir_mail)
        values(".$num_dir.",1,".$num_oem.",0,'$numeroRadicado',0,".$_SESSION['muni'].",".$_SESSION['depto'].",'".$_SESSION['direccion']."','".$_SESSION['telefono']."',0,'".mb_strtoupper($_SESSION['nom_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell1_ciu'],"utf-8")."','".mb_strtoupper($_SESSION['nom_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell1_ciu'],"utf-8")." ".mb_strtoupper($_SESSION['apell2_ciu'],"utf-8")."',1,'".$_SESSION['documento']."','".$_SESSION['email']."')";
	}
	//Skina
        //Modificacion 
        // Ing Camilo Pintor - cpintor@skinatech.com
        // Se modifica no se usa el caso de anonimo
/*	else {
		//Anonimo
		$num_ciu=$db->conn->GenID('SEC_CIU_CIUDADANO');
		$tipdoc= $tipoDocumento-1;
		$ins_ciu="insert into sgd_ciu_ciudadano values($tipdoc,".$num_ciu.",'".mb_strtoupper($_SESSION['nombre_remitente'],"utf-8")."','".mb_strtoupper($_SESSION['direccion_remitente'],"utf-8")."','".mb_strtoupper($_SESSION['apellidos_remitente'],"utf-8")."','','".$_SESSION['telefono_remitente']."','".$_SESSION['email']."',".$_SESSION['muni'].",".$_SESSION['depto'].",'".$_SESSION['cedula']."')";
		$rs_ins_ciu=$db->conn->Execute($ins_ciu);
		//inserta en sgd_dir_direcciones
		$ins_dir="insert into sgd_dir_drecciones(sgd_dir_codigo,sgd_dir_tipo,sgd_oem_codigo,sgd_ciu_codigo,radi_nume_radi,sgd_esp_codi,muni_codi,dpto_codi,sgd_dir_direccion,sgd_dir_telefono,sgd_sec_codigo,sgd_dir_nombre,sgd_dir_nomremdes,sgd_trd_codigo,sgd_dir_doc,sgd_dir_mail)
	values(".$num_dir.",1,0,".$num_ciu.",$numeroRadicado,0,".$_SESSION['muni'].",".$_SESSION['depto'].",'".$_SESSION['direccion_remitente']."','".$_SESSION['telefono_remitente']."',0,'".mb_strtoupper($_SESSION['nombre_remitente'],"utf-8")." ".mb_strtoupper($_SESSION['apellidos_remitente'],"utf-8")."','".mb_strtoupper($_SESSION['nombre_remitente'],"utf-8")." ".mb_strtoupper($_SESSION['apellidos_remitente'],"utf-8")."',3,'".$_SESSION['cedula']."','".$_SESSION['email']."')";

	}*/

	//Skina
        //Modificacion 
        // Ing Camilo Pintor - cpintor@skinatech.com
        // Se modifica no se usa el codigo de verificacion para la generación de la radicacion
        //$_SESSION['codigoverificacion'] = substr(sha1(microtime()), 0 , 5);
	$descripcionAnexos = $uploader->tieneArchivos?count($uploader->subidos):0;
	$descripcionAnexos .=  " Anexos";
        //variable de radi_tipo_deri para manejo de radicado asociado.
        $radi_tp_deri=1;
        //inserta en radicado
	$ins_rad="insert into radicado (radi_nume_radi,radi_fech_radi,tdoc_codi,mrec_codi,eesp_codi,radi_fech_ofic,radi_pais,muni_codi,carp_codi,dpto_codi,radi_nume_hoja,radi_desc_anex,";
	if($_SESSION['radicado']!=NULL)
	{
		$ins_rad.=" radi_nume_deri,";
		$radi_tp_deri = 4;
	}

	$ins_rad.="radi_path,radi_usua_actu,radi_depe_actu,ra_asun,radi_depe_radi,radi_usua_radi,codi_nivel,flag_nivel,carp_per,radi_leido,radi_tipo_deri,sgd_fld_codigo,sgd_apli_codi,sgd_ttr_codigo,sgd_spub_codigo,sgd_trad_codigo)
values ('$numeroRadicado', now(),".$_SESSION['tipo'].",".$_SESSION['mrec_codi'].",".$_SESSION['codigo_orfeo'].",to_date('".date('d')."/".date('m')."/".date('Y')."','dd/mm/yyyy'),'COLOMBIA',".$_SESSION['muni'].",".$tipoRadicado.",".$_SESSION['depto'].",1,'". $descripcionAnexos ."', ";

	if($_SESSION['radicado']!=NULL){
		$ins_rad.="'".$_SESSION['radicado']."', ";
	}
	
	$depeRadicaFormularioWeb =  $_SESSION['depeRadicaFormularioWeb'];
	$anoRad = date("Y");

	$rutaPdf ="/$anoRad/".intval($depeRadicaFormularioWeb)."/$numeroRadicado".".pdf";
	$ins_rad.="'/$anoRad/".intval($depeRadicaFormularioWeb)."/$numeroRadicado".".pdf'
	,".$_SESSION['usuaRecibeWeb']."
	,'".$_SESSION['depeRadicaFormularioWeb']."'
	,'".mb_strtoupper($_SESSION['asunto'],"utf-8")."'
	,'".$_SESSION['depeRadicaFormularioWeb']."',1,5,1,0,0,".$radi_tp_deri.",0,0,0,0,".$tipoRadicado.")";
	//inserta en radicado

	if($rs_ins_rad=$db->conn->Execute($ins_rad)){
		$rs_ins_dir=$db->conn->Execute($ins_dir);
	}else{
		die;
	}

        //Skina
        //Modificacion 
        // Ing Camilo Pintor - cpintor@skinatech.com
        // Se agrega inserción de radicado en sgd_dt_radicado
	// para compatibilidad en el aplicativo
        $ins_dtRad="insert into sgd_dt_radicado values ('".$numeroRadicado."','".$_SESSION['dtermino']."');";	
	$rs_ins_dtRad=$db->conn->Execute($ins_dtRad);

	//Inserta historico
	$ins_his="insert into hist_eventos (depe_codi,hist_fech,usua_codi,radi_nume_radi,hist_obse,usua_codi_dest,usua_doc,sgd_ttr_codigo,hist_doc_dest,depe_codi_dest)
values('$dependenciaRad',now(),6,'$numeroRadicado','RADICACION P.Q.R.S',".$_SESSION['usuario'].",'22222222',2,'".$_SESSION['documento_destino']."','".$_SESSION['dependencia']."')";
	$rs_ins_his=$db->conn->Execute($ins_his);

	//num radicado completo
	$_SESSION['radcom']=$numeroRadicado;


	$uploader->bodega_dir .= date('Y') . "/" . $_SESSION['depeRadicaFormularioWeb'] . "/docs/";
	$uploader->moverArchivoCarpetaBodegaYaSubidos($numeroRadicado);

	//trae usualogin

	$sql_login="select usua_login, usua_email from usuario where usua_codi=".$_SESSION["usuaRecibeWeb"]." and depe_codi='".$_SESSION["depeRadicaFormularioWeb"]."'";
	$rs_login=$db->conn->Execute($sql_login);

	//insertar anexos
	$fechaval=valida_fecha($db);
	$_SESSION['cantidad_adjuntos'] = 0;
	if($uploader->tieneArchivos){
	echo 'llegaron anexos y la cantidad de anexos son '.$_SESSION['cantidad_adjuntos'].'<br>';	
		for($i=0; $i < count($uploader->subidos);$i++)
		{
		echo 'valido correctamente <br>';
			if(strlen($uploader->subidos[$i]) == 0){
				continue;
			}
			$_SESSION['cantidad_adjuntos'] = $_SESSION['cantidad_adjuntos'] + 1;
			$extension = strtolower(end(explode('.',$uploader->subidos[$i])));
			$sql_tipoAnex = "select anex_tipo_codi from anexos_tipo where anex_tipo_ext = '".$extension ."'";
			$rs_tipoAnexo = $db->conn->Execute($sql_tipoAnex);
			$tipoCodigo = 24;
			echo 'valor de sql...... '.$sql_tipoAnex.'<br>';
			if(!$rs_tipoAnexo->EOF){
				$tipoCodigo = $rs_tipoAnexo->fields["anex_tipo_codi"];
			}else {
				$sql_tipoAnex = "select anex_tipo_codi from anexos_tipo where anex_tipo_ext = '*'";
				$rs_tipoAnexo = $db->conn->Execute($sql_tipoAnex);
				if(!$rs_tipoAnexo->EOF){
					$tipoCodigo = $rs_tipoAnexo->fields["anex_tipo_codi"];
				}
			}

			$ins_anex="insert into anexos(anex_radi_nume,anex_codigo,anex_tipo,anex_tamano,anex_solo_lect,anex_creador,anex_desc,anex_numero,anex_nomb_archivo,anex_borrado,anex_origen,anex_salida,anex_estado,sgd_rem_destino,sgd_dir_tipo,anex_depe_creador,anex_fech_anex,sgd_apli_codi)
values('".$numeroRadicado."','".$numeroRadicado.sprintf("%05d",($i+1))."',".$tipoCodigo.",".$uploader->sizes[$i].",'S','".$rs_login->fields['usua_login']."','".$uploader->sha1sums[$i]."',1,'".$uploader->nombreOrfeo[$i]."','N',0,0,0,1,1,'".$_SESSION["depeRadicaFormularioWeb"]."',now(),0)";
			$rs_ins_anex = $db->conn->Execute($ins_anex);
		}
	}


require('barcode.php');
include_once "../config.php";

$depeNomb = "";
$muniNomb = "";
$deptNomb = "";
$paisNomb = "";
$sql_depeNomb = "select depe_nomb from dependencia where depe_codi = '". $_SESSION['depeRadicaFormularioWeb']."'";
				$rs_depeNomb = $db->conn->Execute($sql_depeNomb);
				if(!$rs_depeNomb->EOF){
					$depeNomb = substr($rs_depeNomb->fields["depe_nomb"],0,40);
				}

$sql_muniNomb = "select muni_nomb from municipio where muni_codi = ". $_SESSION['muni'] . " and dpto_codi = " . $_SESSION['depto'] ;
				$rs_muniNomb = $db->conn->Execute($sql_muniNomb);
				if(!$rs_muniNomb->EOF){
					$muniNomb = $rs_muniNomb->fields["muni_nomb"];
				}else {
					$muniNomb = "";
				}

$sql_deptoNomb = "select dpto_nomb from departamento where dpto_codi = ". $_SESSION['depto'] . " and id_pais = 170";
				$rs_deptoNomb = $db->conn->Execute($sql_deptoNomb);
				if(!$rs_deptoNomb->EOF){
					$deptNomb = $rs_deptoNomb->fields["dpto_nomb"];
				}else{
					$deptNomb = "";	
				}

$sql_paisNomb = "select nombre_pais from sgd_def_paises where id_pais = ". $pais_formulario;
                                $rs_paisNomb = $db->conn->Execute($sql_paisNomb);
                                if(!$rs_paisNomb->EOF){
                                        $paisNomb = $rs_paisNomb->fields["nombre_pais"];
                                }else{
                                        $paisNomb = "No Registra";
                                }

$sql_fecha_rad = "select radi_fech_radi from radicado where radi_nume_radi= '". $_SESSION['radcom']."'";
                                $rs_fechrad = $db->conn->Execute($sql_fecha_rad);
                                if(!$rs_fechrad->EOF){
                                        $fechrad = date('Y-m-d H:i:s',strtotime( $rs_fechrad->fields["radi_fech_radi"]));
                                }else{
                                        $fechrad = date('d')." - ".date('m')." - ".date('Y');
                                }
//Genero compatiblidad de campos para la realización del pdf
if (isset($_SESSION['razonSocial']) && $_SESSION['razonSocial'] != '' &&
        isset ($_SESSION['repLegal']) && $_SESSION['repLegal'] != ''){

$_SESSION['nom_ciu'] =  $_SESSION['razonSocial'];
$_SESSION['apell1_ciu'] =  $_SESSION['sigla'];
$_SESSION['apell2_ciu'] =  $_SESSION['rep_legal'];

}
				
$pdf=new PDF_Code39();
$pdf->AddPage();

$pdf->Code39(110,25,$_SESSION['radcom'],1,8);
$pdf->Text(130,37,textoPDF("Radicado N°. ".$_SESSION['radcom']));
#$pdf->Image('images/logo_entidad_radicacion_web.gif',20,20,75);
//$pdf->SetFont('Arial','',16);
//$pdf->Text(110,40,textoPDF(textoPDF($entidad_largo)));
$pdf->Text(110,41,textoPDF("Folios: N/A (WEB)  ".date('d')." - ".date('m')." - ".date('Y')." ".date('h:i:s')."  Anexos: ". $_SESSION['cantidad_adjuntos'] ));
$pdf->SetFont('Arial','',8);
$pdf->Text(110,45,textoPDF("Destino: ". $depeRadicaFormularioWeb . " " . substr($depeNomb, 0,10) ." - Rem/D: ". substr($_SESSION['nom_ciu'],0,10)." ".substr($_SESSION['apell1_ciu'],0,10)));
$pdf->SetFont('Arial','',7);
$pdf->Text(110,48,textoPDF("Consulte su trámite en la página web http://www.skinatech.com"));
//$pdf->Text(135,51,textoPDF("Código de verificación: " . $_SESSION['codigoverificacion']));
//$pdf->Text(110,51,textoPDF(strtoupper($_SESSION['nombre_remitente'])." ".strtoupper($_SESSION['apellidos_remitente'])));
//$pdf->Text(110,55,$_SESSION['cedula']!='0'?$_SESSION['cedula']:$_SESSION['nit']);

$pdf->Text(12,67,textoPDF("$muniNomb, $deptNomb ".date('d')." de ".nombremes(date('m'))." de ".date('Y')));
$pdf->Text(12,81,textoPDF("Señores"));
$pdf->SetFont('','B');
$pdf->Text(12,85,textoPDF($entidad_largo));
$pdf->SetFont('','');
	$pdf->Text(12,89,textoPDF("Ciudad"));
$pdf->Text(12,99,textoPDF("Asunto : ".mb_strtoupper($_SESSION['asunto'],"utf-8")));
$pdf->SetXY(11,105);
//$pdf->MultiCell(0,4,textoPDF($_SESSION['desc'],0));
$pdf->MultiCell(0,4,$_SESSION['desc'],0);
$pdf->Text(12,236,"Atentamente,");
$pdf->SetFont('','B');
$pdf->Text(12,246,textoPDF(($_SESSION['nom_ciu'])." ".$_SESSION['apell1_ciu']." ".$_SESSION['apell2_ciu']));
$pdf->SetFont('','');
$pdf->Text(12,250,$_SESSION['documento']!='0'?"C.C. " . $_SESSION['documento']:"NIT. " . $_SESSION['documento']);
$pdf->Text(12,254,textoPDF($_SESSION['direccion'] . " " . $muniNomb . ", ". $deptNomb . "."));
$pdf->Text(12,258,textoPDF($paisNomb));
$pdf->Text(12,262,textoPDF("Tel. " . $_SESSION['telefono']));
$pdf->Text(12,266,textoPDF($_SESSION['email']));
//guarda documento en un SERVIDOR
 // $pdf->Output("../bodega/tmp/".$_SESSION['radcom'].".pdf",'F');
$pdf->Output("../bodega/$rutaPdf",'F');

//Realizar el conteo de hojas del radicado final//
$conteoPaginas = getNumPagesPdf("../bodega/$rutaPdf");

$sqlu = "UPDATE radicado SET radi_nume_hoja= $conteoPaginas where radi_nume_radi='" . $_SESSION['radcom']."'";
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC); 
$db->conn->Execute($sqlu);


if ($_SESSION['email']!="" && $_SESSION['email']!="No registra") {
    $usMailSelect  = "notificaciones.am@autopistamagdalena.com.co"; 
    /*$mail->IsSMTP(); // telling the class to use SMTP
    $mail->AddReplyTo($usMailSelect);*/
    $mail->SetFrom($usMailSelect,"Sistema PQR'S SkinaTech");
    $mail->Host       = "mail.skinatech.com";
    $mail->Port       = "587";
    $mail->SMTPDebug  = "0";  // 1 = errors and messages // 2 = messages only 
    $mail->SMTPAuth   = "true";
    $mail->SMTPSecure = "tls";
    /*$mail->AuthType   = $tipoAutenticacion;*/
    $mail->Username   = "pruebas@skinatech.com";   // SMTP account username
    $mail->Password   = "louisecooper123"; // SMTP account password
    $mail->Subject    = "Radicado " .$numeroRadicado . " SkinaTech";
    $mail->AltBody    = "Para ver el mensaje, por favor use un visor de E-mail compatible!";
    /*$url=true;*/
    $mail->AddAttachment("../bodega/$rutaPdf");
    $mail->AddAddress($_SESSION['email']);

    $asu .= "<hr>Sistema de gestion documental Orfeo. http://www.skinatech.com/";
    $mail->MsgHTML(utf8_decode('Señor Usuario, <br><br>
<b>La información de su solicitud es:</b><br><br>
  <b>No. Radicado :</b>'.$numeroRadicado.'<br>
  <b>Asunto       :</b> '.mb_strtoupper($_SESSION["asunto"],'utf-8').'<br><br>
Para consultar su solicitud da click <a href=\'http://192.168.8.74/old/orfeoRIO/consultaWeb/\' > aqu&iacute;</a>.<br><br>
<center>
<b>Autopista Rio Magdalena</b><br>
Línea de atención: 57 (4) 832-6779 <br>
E-mail:pruebas@skinatech.com<br>
Calle 47A, # 6 - 20 Puerto Berrio, Antioquia – Colombia
<br><br>
Horario:
Lunes a viernes: 08:00 a 18:00 horas<br>
Sabados: 08:00 a 14:00 horas

'));

    while ((!$exito) && ($intentos < 5) && $_SESSION['email']!="" && $_SESSION['email']!="No registra") {
            $mail->ErrorInfo;
            $exito = $mail->Send();
            $intentos=$intentos+1;
            sleep(7);
    }
}
// Envio Correo de notificacion de radicacion a funcionario.
        $subject="Ha recibido un documento en Orfeo";
        $cuerpo="
        <html>
        <head>
        <title>CORRESPONDENCIA EN ORFEO</title>
        </head>
        <body><p>
        Bogota;  ".$fecha." <br>
        <br></br>
        Ha recibido un documento en el Sistema de Gestion Documental Orfeo. Para verlo, ingrese al Sistema y revise el radicado  No  ".$numeroRadicado."  enviado por ".$_SESSION['nom_ciu']." ".$_SESSION['apell1_ciu']." ".$_SESSION['apell2_ciu']." . Este documento fue radicado por la interfaz del formulario web. <br>
        <br>Asunto:  ".mb_strtoupper($_SESSION['asunto'])."</br>
        <br></br>
        <br>Cordialmente, </br>
        <br>Sistema de Gestion Documental Orfeo
        </p>
        </body>
        </html>
        ";
//     echo $cuerpo;
        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "Content-Transfer-Encoding: base64\r\n";

        //direcci? del remitente
        $headers .= "From: Orfeo Autopista Rio Magdalena <notificaciones.am@autopistamagdalena.com.co>\r\n";
        $cuerpo=chunk_split(base64_encode($cuerpo));

        $ok=mail($rs_login->fields['usua_email'],$subject,$cuerpo,$headers);



    $_SESSION["idFormulario"] = "";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!--Deshabilitar modo de compatiblidad de Internet Explorer-->
<meta http-equiv="X-UA-Compatible" content="IE=edge" >

<title>- PQR EEBP -</title>
<link rel="stylesheet" href="css/structure.css" type="text/css" />
</head>

<body>
<p>&nbsp;</p>
<table width="80%" border="0" align="center" cellpadding="0"
	cellspacing="0" bgcolor="#FFFFFF">
	<tr>
		<td align="center"><br />
		<img src="../logoEntidad.png" width="20%" height="15%" /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>

	<?php if($errorFormulario==0){?>
	<tr>
	<td align="center">
	Su solicitud ha sido registrada de forma exitosa con el radicado No. <b><?=$numeroRadicado?></b> .Por favor tenga en cuenta estos datos para
	que realice la consulta del estado a su solicitud a través de la página web de la entidad.
	</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center">Pulse continuar para <b>finalizar la solicitud</b> y
		visualizar el documento en formato PDF. Si desea almacenelo en su
		equipo o imprímalo.</td>
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><input type="button" name="Submit"
			value="Continuar"
			onclick="window.open('../bodega/<?=$rutaPdf?>')" />
			<input type="button" name="Cerrar"
			value="Cerrar"
			onclick="window.location='http://www.autopistamagdalena.com.co'" />
	</tr>
	<tr>
		<td align="center">&nbsp;</td>
	</tr>
	<?php } else if ($errorFormulario==1){?>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>

	<tr>
		<td><font><b>Existe un error en su petici&oactue; o est&aacute; intentando enviar una petici&oacute;n de nuevo.</b></font></td>


		<tr />
		<td>
		<form name=back action="javascript:history.go(-1)()" method=post><input
			type=submit value="Atr&aacute;s"></form>
		</td>
		<?php } else if($errorFormulario==2){?>
		<tr>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td><font><b>Ocurrió un error al subir el archivo</b></font></td>
			<tr>
			<td>
			<?php echo implode($uploader->messages);?>
			</td>
			</tr>
		</tr>
		<td>
		<form name=back action="javascript:history.go(-1)()" method=post><input
			type=submit value="Atr&aacute;s"></form>
		</td>

		<?php }?>

</table>
</body>
</html>
