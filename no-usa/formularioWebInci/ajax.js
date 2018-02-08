// JavaScript Document
function trae_municipio(muni_cod)
	{
	  document.getElementById('loader1').style.display="block";
      var url = "municipio.php";
      var pars = "depto="+document.formulario.depto.value"&muni_cod="+muni_cod;
  	  var ajax = new Ajax.Request( url, {
                                      parameters: pars,
                                      method:"get",
                                      onComplete: procesaRespuesta
                                         }
      );
	function procesaRespuesta( resp )
		{
        $("div-contenidos").innerHTML = resp.responseText;	
		document.getElementById('loader1').style.display="none";
		}
	}	
function trae_entidad()
	{
	  document.getElementById('loader2').style.display="block";
      var url = "entidad.php";
      var pars = "nit="+document.formulario.nit.value;
      var ajax = new Ajax.Request( url, {
                                      parameters: pars,
                                      method:"get",
                                      onComplete: procesaRespuesta
                                         }
      );
	function procesaRespuesta( resp )
		{
		$("div-contenidos2").style.display="block";
		$("div-contenidos2").innerHTML = resp.responseText;	
		$("loader2").style.display="none";
		}
	}
function trae_radicado()
	{
	  document.getElementById('loader3').style.display="block";
      var url = "radicado.php";
      var pars = "radicado="+document.formualrio.radicado_rel.value;
      var ajax = new Ajax.Request( url, {
                                      parameters: pars,
                                      method:"get",
                                      onComplete: procesaRespuesta
                                         }
      );
	function procesaRespuesta( resp )
		{
		$("div-contenidos3").style.display="block";
		$("div-contenidos3").innerHTML = resp.responseText;	
		$("loader3").style.display="none";
		}
	}
function valida_form()
{
mensaje='Se han encontrado los siguientes errores:\n\n';
error=0;
	if((document.formulario.nom_ciu.value.length==0) || (document.formulario.nom_ciu.value==""))
		{
			mensaje+='\n-Nombre del ciudadano no puede ser vacio;';
			error=1;
			
		}
	if((document.formulario.apell1_ciu.value.length==0) || (document.formulario.apll1_ciu.value==""))
		{
			mensaje+='\n-El Primer Apellido no puede estar vacio;';
			error=1;
			
		}
	if((document.formulario.cedula.value.length < 6))
		{
			mensaje+='\n-Documento de identificacion no valido';
			error=1;
			
		}
		if((document.formulario.depto.value==0))
		{
			mensaje+='\n-Debe Seleccionar  un Departamento';
			error=1;
			
		}
		if((document.formulario.muni.value==0))
		{
			mensaje+='\n- Debe Seleccionar un Municipio';
			error=1;
			
		}
		if((document.formulario.direccion_remitente.value.length==0))
		{
			mensaje+='\n-Direccion de correspondencia no puede ser vacio';
			error=1;
			
		}
		if((document.formulario.tipo.value==0))
		{
			mensaje+='\n-Debe Seleccionar un tipo de solicitud';
			error=1;
		}

		if((document.formulario.asunto.value.length==0))
		{
			mensaje+='\n-Asunto no puede ser vacio';
			error=1;
		}
		if((document.formulario.desc.value.length==0))
		{
			mensaje+='\n-Descripcion Invalida';
			error=1;
		}
	
	if((document.formulario.valor_rad) && (document.formulario.valor_rad.value==1))
		{
			mensaje+='\n-Referencia de radicado invalida';
			error=1;
		}
	if(isEmailAddress(document.formulario.email)==false)
		{
			mensaje+='\n-Direccion de correo electronico invalida';
			error=1;

		}
if(error==1)
	{
		alert(mensaje);	
		return false;
	}
else
	return true;
}


function pasa_nit()
	{
		var i
    	for (i=0;i<document.busqueda.nit.length;i++){
       if (document.busqueda.nit[i].checked)
          break;
    }
    valor_nit = document.busqueda.nit[i].value;
	window.opener.document.formulario.nit.value=valor_nit;
	window.opener.trae_entidad();
	window.close();

}

//validacion caracteres

/*
<input type="text" onkeypress="return alpha(event,numbers)" />
<input type="text" onkeypress="return alpha(event,letters)" />
<input type="text" onkeypress="return alpha(event,numbers+letters+signs)" />
*/

var letters=' ABC�DEFGHIJKLMN�OPQRSTUVWXYZabc�defghijklmn�opqrstuvwxyz������������������������\u0008'
var numbers='1234567890\u0008'
var signs=',.:;@-\''
var mathsigns='+-=()*/'
var custom='<>#$%&?�'

function alpha(e,allow) {
var k;
k=document.all?parseInt(e.keyCode): parseInt(e.which);
return (allow.indexOf(String.fromCharCode(k))!=-1);
}

//validacion email
function isEmailAddress(theElement)
{
var s = theElement.value;
var filter=/^[A-Za-z][A-Za-z0-9_]*@[A-Za-z0-9_]+\.[A-Za-z0-9_.]+[A-za-z]$/;
if (s.length == 0 ) return true;
if (filter.test(s))
return true;
else
return false;
}
