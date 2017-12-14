<?
session_start();
/**
 * Modulo de Formularios Web para atencion a Ciudadanos.
 * @autor Sebastian Ortiz
 * @fecha 2012/06
 *
 */
foreach ($_GET as $key => $valor)   ${$key} = $valor;
foreach ($_POST as $key => $valor)   ${$key} = $valor;

define('ADODB_ASSOC_CASE', 1);

$ruta_raiz = "..";
$ADODB_COUNTRECS = false;
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
include "../config.php";
$_SESSION["depeRadicaFormularioWeb"]=$depeRadicaFormularioWeb;  // Es radicado en la Dependencia 900
$_SESSION["usuaRecibeWeb"]=$usuaRecibeWeb; // Usuario que Recibe los Documentos Web
$_SESSION["secRadicaFormularioWeb"]=$secRadicaFormularioWeb; // Osea que usa la Secuencia sec_tp2_900
$_SESSION["idFormulario"] = sha1(microtime(true).mt_rand(10000,90000));
$db = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//$db->conn->debug = true;

include('./funciones.php');
include('./formulario_sql.php');
//include('./captcha/simple-php-captcha.php');
//$_SESSION['captcha_formulario'] = captcha();

//TamaNo mAximo del todos los archivos en bytes 10MB = 10(MB)*1024(KB)*1024(B) =  10485760 bytes
$max_file_size  = 10485760;

if(!isset($isFacebook)){
	$isFacebook = 0;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<title> <?=$entidad_largo ?> - Formulario PQRS</title>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<!--Deshabilitar modo de compatiblidad de Internet Explorer-->
<meta http-equiv="X-UA-Compatible" content="IE=edge"><!-- CSS -->
<link rel="stylesheet" href="css/structure2.css" type="text/css" />
<link rel="stylesheet" href="css/form.css" type="text/css" />
<link rel="stylesheet" href="css/fineuploader.css" type="text/css" />

<!-- JavaScript --> <script type="text/javascript" src="scripts/wufoo.js"></script>
<!-- prototype --> <script type="text/javascript" src="prototype.js"></script> 
<!-- jQuery --> <script	src="scripts/jquery.js"></script> 
<!--funciones--> <script type="text/javascript" src="ajax.js"></script>
<!--funciones--> <script type="text/javascript" src="../ajax/js/ajax.js"></script>
<!--funciones--> <script type="text/javascript" src="ajaxCiu.js"></script>
 <!--       <script src="../jquery-ui/development-bundle/jquery-1.7.1.js"></script>-->
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
        <script src="../jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>
<!-- FineUploader --> <script type="text/javascript" src="scripts/jquery.fineuploader-3.0.js"></script>

<script>
       var ajax = new sack();
        var CiudadanoId=false;
	var mensaje;
        function getCiudadanoDatos()
        {
                var ciudadanoDoc = document.getElementById('doc_ciu').value.replace(/[^0-9]/g,'');
                if(ciudadanoDoc.length>=5 && ciudadanoDoc!=CiudadanoId){
               	       CiudadanoId = ciudadanoDoc;
                        ajax.requestFile = 'datosCiu.php?producto='+ciudadanoDoc;       // Specifying which file to get
                        ajax.onCompletion = showCiudadanoData;  // Specify function that will be executed after file has been found
                        ajax.runAJAX();         // Execute AJAX function                        
                }
                
        }
        
        function showCiudadanoData()
        {
		document.getElementById("solNat").style.display='none';
                document.getElementById("solEmp").style.display='none';
		var muni;
                var formObj=document.forms['contactoOrfeo'];     
                eval(ajax.response);	
		alert (eval(ajax.response));	
                cambia_pais();
                trae_municipio(muni);
		validaTipoDocumento();
        }
        
        
        function initFormEvents()
        {
                document.getElementById('doc_ciu').onchange = getCiudadanoDatos;
                document.getElementById('doc_ciu').focus();
		document.getElementById("solNat").style.display='none';
                document.getElementById("solEmp").style.display='none';
                createUploader();
        }
        
function trae_municipio(muni) {
        var url = "municipio.php";
        var pars = "depto=" + document.quejas.depto.value + "&muni=" + muni;
        var ajax = new Ajax.Request(url, {
                asynchronous : false,
                parameters : pars,
                method : "get",
                onComplete : procesaRespuesta});
        function procesaRespuesta(resp) {
                document.getElementById("div-contenidos").innerHTML = resp.responseText;
        }
}

function validarForm(quejas) {
  if(quejas.doc_ciu.value.length==0) { //comprueba que no esté vacío
    quejas.doc_ciu.focus();   
    alert('Escriba No.documento'); 
    return false; //devolvemos el foco
  }
  if(quejas.direccion.value.length==0) { //comprueba que no esté vacío
    quejas.direccion.focus();
    alert('Escriba una direccion');
    return false;
  }
  if(quejas.telefono.value.length==0) { //comprueba que no esté vacío
    quejas.telefono.focus();
    alert('Escriba un telefono');
    return false;
  }
  if(quejas.email.value.length==0) { //comprueba que no esté vacío
    quejas.email.focus();
    alert('Escriba correo electronico');
    return false;
  }
  if(quejas.tipoSolicitud.value.length==0) { //comprueba que no esté vacío
    quejas.tipoSolicitud.focus();
    alert('Seleccione Solicitud');
    return false;
  }
  if(quejas.asunto.value.length==0) { //comprueba que no esté vacío
    quejas.asunto.focus();
    alert('Escriba un asunto');
    return false;
  }
  if(quejas.comentario.value.length==0) { //comprueba que no esté vacío
    quejas.comentario.focus();
    alert('Escriba un comentario');
    return false;
  }
  return true;
}

function validaTipoDocumento(){
    /*
 *  walter cespedes
 *   18 de noviembre del 2013
 *    Minsalud
 *     funcion para completar select de tipo de docmuento de acuerdo a la opcion elegida en select tipo de persona   
 *      */
var tipoSolicitante = document.getElementById('tipoSolicitante').value;
document.getElementById("tipoDocumento").options.length = 0;

if(tipoSolicitante==2){
        var opt1 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt1);
        opt1.text = 'Seleccione';
        opt1.value = 0;
        var opt2 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt2);
        opt2.text = 'NIT - Número de Identificación Tributaria';
        opt2.value = 4;
        document.getElementById("solEmp").style.display='block';
        document.getElementById("solNat").style.display='none';
}if(tipoSolicitante==1){
       //var selectvacio = document.forms["tipoDocumento"].options.length=0;
       //var opt = document.createElement("option");
        document.getElementById("tipoDocumento").options.length = 0;
        var opt1 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt1);
        opt1.text = 'Seleccione';
        opt1.value = '';
        var opt2 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt2);
        opt2.text = 'CC - Cédula de ciudadanía';
        opt2.value = 0;
        var opt3 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt3);
        opt3.text = 'CE - Cédula extranjería';
        opt3.value = 2;
        var opt4 = document.createElement("option");
	document.getElementById("tipoDocumento").options.add(opt4);
        opt4.text = 'TI - Tarjeta de Identidad';
        opt4.value = 1;
        var opt5 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt5);
        opt5.text = 'NUIP - Número Único de Identificación Personal';
        opt5.value = 5;
        var opt6 = document.createElement("option");
        document.getElementById("tipoDocumento").options.add(opt6);
        opt6.text = 'Pasaporte';
        opt6.value = 3;
        document.getElementById("solNat").style.display='block';
        document.getElementById("solEmp").style.display='none';


 }if(tipoSolicitante==''){
   document.getElementById("tipoDocumento").options.length = 0;
    var opt1 = document.createElement("option");
    document.getElementById("tipoDocumento").options.add(opt1);
    opt1.text = 'Seleccione';
    opt1.value = '';
}

}
       	
 
        window.onload = initFormEvents;

</script>
</head>
<body id="public">
<div id="container">
<h1>&nbsp;</h1>
<form id="contactoOrfeo" class="wufoo topLabel"	enctype="multipart/form-data" method="post" action="formulariotx.php" name="quejas" onsubmit="return validarForm(this);">
<div class="info">
<center><img src="../logoEntidad.gif" width="40%" height="35%" /></center>
<p>
<br> Apreciado ciudadano: </br>
&nbsp <br>Al diligenciar el formulario, tenga en cuenta lo siguiente: </br><br>En cualquier caso su requerimiento puede realizarse de manera anónima o identificada. Si usted opta por presentar su comunicación en forma anónima, no será posible que reciba de manera directa respuesta por parte de este Ministerio. Los campos con 
(<font color="#FF0000">*</font>) son obligatorios. </br>
</p>
</div>
<ul>
	<fieldset>
        <h4>INFORMACI&Oacute;N SOLICITANTE</h4>
	<div id="soliDatos">
        <li id="li_tipoSolicitante"><label class="desc" id="title_tipoSolicitante" for="tipoSolicitante">Seleccione tipo de solicitante <font color="#FF0000">*</font></label>
        <div><select id="tipoSolicitante" name="tipoSolicitante" class="field select maximun" tabindex="0" title="Lista de tipo de solicitante que va a realizar la solicitud" onchange="validaTipoDocumento();">
                <option value="0" selected="selected">Seleccione</option>
                <option value="1">Persona Natural</option>
                <option value="2">Empresa - Persona Juridica</option>
        </select> &nbsp;</div>
        </li>
	<li id="li_numeroDocumento"><label class="desc" id="lbl_numid" for="doc_ciu">N&uacute;mero de identificaci&oacute;n (solon&uacute;meros o letras) <font color="#FF0000">*</font></label>
	<div><input id="doc_ciu" name="doc_ciu" type="text" class="field text medium" value="" maxlength="11" tabindex="4" title="Digite el numero de identificación del solicitante"
		onkeypress="return alpha(event,numbers+letters)"  /> &nbsp;</div>
	<li id="li_tipoDocumento"><label class="desc" id="title_tipoDocumento" for="tipoDocumento">Tipo de documento <font color="#FF0000">*</font></label>
        <div><select id="tipoDocumento" name="tipoDocumento" class="field select maximun" tabindex="2" title="Lista de tipo de documentos de identificación">
                <option value="0" selected="selected">Seleccione</option>
        </select> &nbsp;</div>
        </li>
	</div>
        <div id="solNat">
        <li id="li_nombre"><label class="desc" id="title_Nombre" for="nom_ciu"> Nombres Solicitante: <font color="#FF0000">*</font> </label>
        <div><input id="nom_ciu" name="nom_ciu" type="text"
                class="field text" value="" size="20" tabindex="3" title="Ingrese nombre y apellidos del solicitante" placeholder="Nombres y Apellidos"
                onkeypressS="return alpha(event,letters);" /></div>
        </li>

	<li id="li_apellido"><label for="apll1_ciu" id="lbl_apellido" class="desc">Primer Apellido: <font color="#FF0000">*</font></label>
        <div><input id="apll1_ciu" name="apell1_ciu" type="text"
                class="field text" value="" size="20" tabindex="4" title="Ingrese Primer apellido del solicitante"
                onkeypress="return alpha(event,letters);" /></div></span></li>

       <li id="li_apellido2"><label for="apll2_ciu" id="lbl_apellido2" class="desc">Segundo Apellido: </label>
        <div><input id="apll2_ciu" name="apell2_ciu" type="text"
                class="field text" value="" size="20" tabindex="5" title="Ingrese Segundo apellido del solicitante"
                onkeypress="return alpha(event,letters);" /></div></span></li></div>
        <div id="solEmp">
        <li id="li_razonsoc"><label class="desc" id="title_Razon" for="raz_social"> Raz&oacute;n Social: <font color="#FF0000">*</font> </label>
        <div><input id="raz_social" name="raz_social" type="text"
                class="field text" value="" size="20" tabindex="3" title="Ingrese razón social" placeholder="Razón Social"
                onkeypressS="return alpha(event,letters);" /></div>
        </li>

        <li id="li_sigla"><label for="sigla" id="lbl_sigla" class="desc">Sigla:</label>
        <div><input id="sigla" name="sigla" type="text"
                class="field text" value="" size="20" tabindex="4" title="Ingrese Primer apellido del solicitante o sigla de la empresa"
                onkeypress="return alpha(event,letters);" /></div></span></li>

       <li id="li_replegal"><label for="rep_legal" id="lbl_replegal" class="desc">Rep. Legal: <font color="#FF0000">*</font></label>
        <div><input id="rep_legal" name="rep_legal" type="text"
                class="field text" value="" size="20" tabindex="5" title="Ingrese el Representante Legal"
                onkeypress="return alpha(event,letters);" /></div></span></li></div>

        </fieldset>
        <fieldset>
	<h4>DATOS DE CONTACTO DEL SOLICITANTE</h4>
	<li id="li_pais" class="   "><label class="desc" id="lbl_pais"
		for="label"> País : <font color="#FF0000">*</font> </label>
	<div><select id="slc_pais" name="pais" class="field select medium"
		tabindex="8" onchange="cambia_pais()" title="Lista desplegable de paises para datos de correspondencia">
		<?=$pais ?>
	</select> &nbsp;<font color="#FF0000"></font></div>
	</li>

	<li id="li_departamento" class="   "><label class="desc" id="lbl_deptop"
		for="label"> Departamento <font color="#FF0000">*</font> </label>
	<div><select id="slc_depto" name="depto" class="field select medium"
		tabindex="9" onchange="trae_municipio()" title="Lista desplegble de departamentos para datos de correspondencia">
		<option value="0" selected="selected">Seleccione</option>
		<?=$depto ?>
	</select> &nbsp;<font color="#FF0000"></font></div>
	</li>
	<li id="li_municipio" class="   "><label class="desc" id="lbl_municipio"
		for="slc_municipio"> Municipio <font color="#FF0000">*</font> </label>
		<div id="div-contenidos"><select id="slc_municipio" name="muni"
		class="field select medium" tabindex="10" title="Lista desplegable de municipios para datos de correspondencia">
		<option value="0" selected="selected">Seleccione..</option>
	</select> &nbsp;<font color="#FF0000"></font></div>
	</li>

	<li id="li_direccion"> <label class="desc" id="lbl_direccion" for="dir_ciu">Direcci&oacute;n
	</label>
	<div><input id="dir_ciu" name="direccion" type="text"
		class="field text medium" value="" maxlength="150" tabindex="11" title="Ingrese Dirección de correspondencia para el solicitante"
		onkeypress="return alpha(event,numbers+letters+signs+custom)" />
	&nbsp;</div>
	</li>

	<li id="li_telefono"><label class="desc" id="lbl_telefono" for="tel_ciu">Tel&eacute;fono
	<font color="#FF0000">*</font></label>
	<div><input id="tel_ciu" name="telefono" type="text"
		class="field text medium" value="" maxlength="50" tabindex="12" title="Ingrese Telefono de correspndencia para el solicitante"
		onkeypress="return alpha(event,numbers+alpha)" /> &nbsp;</div>
	</li>

	<li id="li_email"><label class="desc" id="lbl_email" for="email_ciu"> E-mail <font color="#FF0000">*</font></label>
	<div><input id="email_ciu" name="email" type="text" title="Ingrese correo electrónico del solicitante"
		class="field text medium"  maxlength="50" tabindex="13"></div>
	</li>
	</fieldset>
<!--	<li id="li_medioRespuesta"><label class="desc" id="lbl_mediorespuesta"-->
<!--		for="campo_mediorespuesta">Seleccione un medio por el cual se le-->
<!--	dar&aacute; respuesta <font color="#FF0000">*</font> </label>-->
<!--	<div><select id="campo_mediorespuesta" name="mediorespuesta"-->
<!--		class="field select maximun" tabindex="13">-->
<!--		<option value="0" selected="selected">Correo Electr&oacute;nico</option>-->
<!--		<option value="1">Correo Postal</option>-->
<!---->
<!--	</select> &nbsp;<font color="#FF0000"></font></div>-->
<!--	</li>-->

        <fieldset>
	<h4>INFORMACI&Oacute;N DE SU SOLICITUD</h4>
	<li id="li_tipoSolicitud"><label class="desc" id="title_tipoSolicitud" for="tipoSolicitud">Tipo
	de solicitud <font color="#FF0000">*</font></label>
	<div><select id="tipoSolicitud" name="tipoSolicitud" class="field select medium" tabindex="1" title="Lista desplegable de los tipos de solicitud disponibles para su elección">
	<option value="0" selected="selected">Seleccione</option>
	<?=$tipo; ?>
	</select> &nbsp;</div>
	</li>

<!--	<li id="li_tipoEje"> <label class="desc" id="title_tipoEje" for="tipoEje">Eje Tem&aacute;tico </label>
	<div><select id="tipoEje" name="tipoEje" title="Lista desplegable de los tipos de eje tematicos disponibles para seleccionar en su solicitud"
		class="field select medium" tabindex="14">
		<?=$temas;?>
	</select> &nbsp;<font color="#FF0000"></font></div>
	</li>-->
	&nbsp;

	<li id="foli4" class="">
  	<label class="desc" id="title4" for="label7">Referente al Radicado No. (solo numeros, 14 d&iacute;gitos)</label>
  	<div><input id="label7" name="radicado" type="text" class="field text medium" value="" maxlength="14"
        title="Ingrese el numero de radicado de entrada con el cual va a hacer referencia su solicitud" tabindex="15" onchange="trae_radicado()" onkeypress="return alpha(event,numbers);"/></div>
	<div id="div-contenidos3" style="display:none; color:#FF0000;"></div>
	</li>

	<li id="li_asunto" class="   "><label class="desc" id="lbl_asunto"
		for="campo_asunto">Asunto <font color="#FF0000">*</font></label>
	<div><input id="campo_asunto" name="asunto" type="text" title="Ingrese el asunto de solicitud"
		class="field text large" value="" maxlength="80" tabindex="16" />
	&nbsp;</div>
	</li>
	<li id="li_comentario" class="    "><label class="desc" id="lbl_comentario"
		for="campo_comentario">Descripci&oacute;n <font color="#FF0000">*</font></label>

	<div><textarea id="campo_comentario" name="comentario" title="Ingrese la descripción detallada de su solicitud"
		class="field textarea small" rows="10" cols="50" tabindex="17"
		onkeyup="countChar(this)" defaultValue="Escriba ac&aacute; ..."></textarea>
	<input type="hidden" id="adjuntosSubidos" name="adjuntosSubidos"
		value="" /> &nbsp;</div>
	<div align="right" id="charNum"></div>
	</li>
<!--	<div>
	<li id="adjuntos" class="   "><label class="desc" id="lbl_adjuntos"
		for="campo_adjuntos">Adjuntos(Máximo 5MB por archivo, 20MB en total)</label>
		 <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" /> 
		<input class="field file large" id="campo_adjuntos" name="userfile[]" type="file" onChange="addInputFile();" />
	</li>
	</div>-->

<!-- 	<li id="li_upload">
	<div id="filelimit-fine-uploader"></div>
	<div id="availabeForUpload"></div>
	&nbsp;
	</li>-->
	</fieldset>
	
<!--	<li id="li_imagenVerificacion"><label class="desc" id="lbl_captcha" for="campo_captcha">Imagen de
	verificaci&oacute;n (Digite en el recuadro las letras o número de la
	imagen). <font color="#FF0000">*</font></label>
	<div><input id="campo_captcha" name="captcha" type="text"
		class="field text small" value="" maxlength="5" tabindex="20"
		onkeypress="return alpha(event,numbers+letters)"
		alt="Digite las letras y n&uacute;meros de la im&aacute;gen" /> &nbsp;
	<p><?php/*
	echo '<img id="imgcaptcha" src="' . $_SESSION['captcha_formulario']['image_src'] . '" alt="CAPTCHA" /><br>';
	echo '<a href="#" onClick="return reloadImg(\'imgcaptcha\');">Cambiar imagen<a>'
        */	
    ?></p>
    <input type="hidden" name="idFormulario" value="<?=$_SESSION["idFormulario"]?>" />
	</div>
	</li>-->

	<li id="li_botones" class="buttons"><input id="saveForm" type="submit" value="Enviar" title="Enviar y radicar su solicitud"
		onclick="return valida_form();" /> <input name="button" type="button"
		id="button" onclick="window.close();" value="Cancelar" title="Cancelar el proceso de solicitud actual" /></li>

		<input id="cont" name="continente" type="hidden" class="field text large" value=""/>
                <input id="cod_ciu" name="codigo de usuario" type="hidden" class="field text large" value="" />

</ul>
</form>

</div>
<!--container-->

</body>
</html>
