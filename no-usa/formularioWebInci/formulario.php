<?
session_start();
/**
  * Modulo de Formularios Web para atencion a Ciudadanos.
  * @autor Carlos Barrero   carlosabc81@gmail.com SuperSolidaria
  * @fecha 2009/05
  * 
  */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 1);

if($_GET["orderNo"]) $orderNo=$_GET["orderNo"];
if($_GET["orderTipo"]) $orderTipo=$_GET["orderTipo"];
if($_GET["busqRadicados"]) $gen_lisDefi=$_GET["busqRadicados"];

$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
	$db = new ConnectionHandler($ruta_raiz);
	$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
	//$db->conn->debug = true;

include('./funciones.php');
include('./formulario_sql.php');
?>

<!doctype html>
<html lang="es">
<head>
	<meta charset="UTF-8" />	
	<title>Formulario PQRS I.N.C.I</title>
	<!-- CSS -->
	<link rel="stylesheet" href="css/structure.css" type="text/css" />
	<link rel="stylesheet" href="../jquery-ui/development-bundle/themes/base/jquery.ui.all.css">
	<link rel="stylesheet" href="css/form.css" type="text/css" />
	<!-- JavaScript -->
	<script type="text/javascript" src="scripts/wufoo.js"></script>
	<script type="text/javascript" src="prototype.js"></script>
	<!--funciones-->
        <script src="../jquery-ui/development-bundle/jquery-1.7.1.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>
        <script type="text/javascript" src="ajax.js"></script> 
	<SCRIPT Language="JavaScript" src="../js/crea_combos_2.js"></SCRIPT>
        <script type="text/javascript" src="../ajax/js/ajax.js"></script> 
       <link rel="stylesheet" href="../jquery-ui/development-bundle/demos/demos.css">
        <style>
        .ui-autocomplete-loading { background: white url('../jquery-ui/development-bundle/demos/autocomplete/images/ui-anim_basic_16x16.gif') right center no-repeat; }
        </style>

<script>

	var ajax = new sack();
	var CiudadanoId=false;
	function getCiudadanoDatos()
	{
		var ciudadanoDoc = document.getElementById('doc_ciu').value.replace(/[^0-9]/g,'');
		if(ciudadanoDoc.length>4 && ciudadanoDoc!=CiudadanoId){
			CiudadanoId = ciudadanoDoc
			ajax.requestFile = 'datosCiu.php?producto='+ciudadanoDoc;	// Specifying which file to get
			ajax.onCompletion = showCiudadanoData;	// Specify function that will be executed after file has been found
			ajax.runAJAX();		// Execute AJAX function			
		}
		
	}
	
	function showCiudadanoData()
	{
		var formObj = document.forms['formulario'];	
		eval(ajax.response);
                window.location.reload();
	}
	
	
	function initFormEvents()
	{
		document.getElementById('doc_ciu').onchange = getCiudadanoDatos;
		document.getElementById('doc_ciu').focus();
	}
	
	
	window.onload = initFormEvents;


</script>

</head>
<body id="public">
	<div id="container" style="background-image:url(../imagenes/logoOrfeoFondo.gif);">
		<form id="formulario" name="formulario" class="wufoo topLabel" enctype="multipart/form-data" method="GET" action="formulariotx.php">

	<div class="info">
		<img src='../logoEntidad.gif' class='logoEnt' >
		<h2 align='center' ><?=$db->entidad_largo?></h2>
		<br />
		<h4>RECUERDE. Este formulario solo es para registrar <u>peticiones, quejas y reclamos.</u> </h4>
		Campos requeridos ( <sup>*</sup> ) </div>
			<fieldset>
				<legend><h4>DATOS DE CONTACTO</h4></legend>
                        	 <!--  completado  automatico-->
        		         <div class="demo">
	                        <div class="ui-widget">
				<label class="desc" for="birds">Documento de Identificaci&oacute;n (solo numeros)<sup>*</sup> </label>
				<input id="doc_ciu" name="doc_ciu" type="text" class="field text medium" tabindex="1"  aria-autocomplete="list" aria-haspopup="true" aria-owns="ui-autocomplete-instance" onblur="initFormEvents();"/>
				</div>
				</div>
			    	<label class="desc" for="nom_ciu">Nombres<sup>*</sup></label>
				<input id="nom_ciu" name="nom_ciu" type="text" classi="field text" value="" size="20" tabindex="1" 				onkeypressS="return alpha(event,letters);"/>

				<label class="desc" for="apll1_ciu">Primer Apellido<sup>*</sup></label>
				<input id="apll1_ciu" name="apell1_ciu" type="text" class="field text" value="" size="20"	tabindex="2" 				onkeypressS="return alpha(event,letters);"/>
				<label class="desc" for="apll2_ciu">Segundo Apellido<sup>*</sup></label>
				<input id="apll2_ciu" name="apell2_ciu" type="text" class="field text" value="" size="20"	tabindex="2" 				onkeypressS="return alpha(event,letters);"/>
				<label class="desc" id="title112" for="label">  Departamento<sup>*</sup></label>
  				 <div>
				    <select id="label" name="depto" class="field select medium" tabindex="19" onchange="trae_municipio()">
				      <option value="0" selected="selected"> Seleccione </option>
					<?=$depto ?>
				      </select></div>
				  <label class="desc" id="title112" for="label2"> Municipio <sup>*</sup><img src="images/loading_animated2.gif"  width="48" height="48" style="display:none" id="loader1"/></label>
				  <div id="div-contenidos">
				    <select id="label2" name="muni" class="field select medium"	tabindex="19">
				      <option value="0" selected="selected">Seleccione..</option>
				    </select></div>
				  <label class="desc" id="tit12" for="label15"> Pais <sup>*</sup><img src="images/loading_animated2.gif"  width="48" height="48" style="display:none" id="loader2"/></label>
				  <div id="div-contenidos">
				    <select id="label15" name="pais" class="field select medium"	tabindex="19">
				      <option value="0" selected="selected">Seleccione..</option>
				    </select></div>
				<label class="desc" id="title4" for="dir_ciu">Direcci&oacute;n Correspondencia :<sup>*</sup></label>
			<div>
				<input id="dir_ciu" name="dir_ciu" type="text" class="field text large" 
				value="" maxlength="150" tabindex="4"/>
				</div>
			  	<label class="desc" id="title4" for="tel_ciu"> Tel&eacute;fono : </label>
				 <div>
				    <input id="tel_ciu"	name="tel_ciu" type="text" class="field text medium" value="" 
					maxlength="50"	tabindex="4">
				 </div>
			 	 <label class="desc" id="title4" for="email_ciu"> E-mail : <sup>*</sup> </label>
				  <div>
				    <input id="email_ciu" name="email_ciu" type="text" class="field text medium" value="" maxlength="50"
		 		     tabindex="4">
				  </div>
			</fieldset>
			<ul>
			<li id="foli4" class=" ">
<!-- <input id="label5" name="nit" type="text" class="field text large" value="" maxlength="255" tabindex="4"  onchange="trae_entidad()" onkeypress="return alpha(event,numbers);" />-->
    &nbsp;<!--<font color="#FF0000">*</font>-->  
				 <div id="div-contenidos2" style="display:none"></div>
			</li>
				<label class="desc" id="title4" for="label7">Referente al Radicado No. (solo numeros, 14 d&iacute;gitos)
				<img src="images/loading_animated2.gif" width="48" height="48" style="display:none" id="loader3"/>
				</label><div>
				<input id="label7" name="radicado" type="text" class="field text large" value="" maxlength="255"
	                         tabindex="4" onchange="trae_radicado()" onkeypress="return alpha(event,numbers);"/>
			<li id="foli109" 		class="   ">
			<br/>
				  <label class="desc" id="title109" for="Field109">Tipo de Solicitud <sup>*</sup></label>
				  <div>
				    <select id="tipo" name="tipo" class="field select large" tabindex="18">
					  <?= $tipo ?>
				    </select>
				   </div>
			</li>
			<li id="foli4" class=" ">
				  <label class="desc" id="title4" for="label6">Asunto<sup>*</sup></label>
				  <div>
				    <input id="label6" name="asunto" type="text" class="field text large" value="" maxlength="255" 
					tabindex="4"/>
				  </div>
			</li>
			<li id="foli111" class=" ">	
				<label class="desc" id="title111" for="Field111">Descripci&oacute;n<sup>*</sup></label>
				<div>
				<textarea id="desc" name="desc" class="field textarea small" rows="10" cols="50" 
				   tabindex="5"></textarea>
				</div>
			</li>
			<li class="buttons">
				<input id="saveForm" type="submit" value="Enviar" onclick="return valida_form();" />
	            		<input name="button" type="button" id="button" onclick="window.close();" value="Cancelar" />
			</li>
			<li style="display:none">
				<label for="comment">No llene esto</label>
				<textarea name="comment" id="comment" rows="1" cols="1"></textarea>
			</li>
				    <input id="cont" name="continente" type="hidden" class="field text large" value=""/>
				    <input id="tdid_ciu" name="tdid del ciudadano" type="hidden" class="field text large" value="" />
				    <input id="cod_ciu" name="codigo de usuario" type="hidden" class="field text large" value="" /> 
		</ul>
		</form>
	</div><!--container-->
</body>
</html>
