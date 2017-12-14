/************************************************************************
# PROYECTO: Orfeo   MODULO: Email - email.inc1.js  FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
#                                                                       *
#                                                                       *
#************************************************************************
# AUTOR DE ESTE MODULO:  Orfeo                                          *
#************************************************************************
# AUTORES DEL Superintendencia de Servicios Publicos D. de Colombia     *
#  PROYECTO:  Infometrika, Iyunxi y SkinaTech                           *
#             Comunidades Correlibre y Orfeolibre                       *
#************************************************************************
# LICENCIA: GNU/GPL                                                     *
#***********************************************************************/


        /********************************************************
        *          Encabezados de librerias estandares          *
        ********************************************************/


        /********************************************************
        *    Definicion de las demas funciones del programa     *
        *                   (orden alfabetico)                  *
        ********************************************************/

closetime = 0; // Cantidad de segundos a esperar para abrir la ventana nueva
dato1 = 333;
<?php
// Convertimos los vectores de los paises, dptos y municipios creados en crea_combos_universales.php a vectores en JavaScript.
echo arrayToJsArray($vpaisesv, 'vp');
echo arrayToJsArray($vdptosv, 'vd');
echo arrayToJsArray($vmcposv, 'vm');
?>

function cambIntgAp(valor){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    fecha_hoy =  '<?=date('d')."-".date('m')."-".date('Y')?>';

    if (valor!=0){
        if  (document.formulario.fecha_gen_doc.value.length==0)
            document.formulario.fecha_gen_doc.value=fecha_hoy;
    } else
        document.formulario.fecha_gen_doc.value="";
}

function fechf(formulario,n) {
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    var fechaActual = new Date();
        fecha_doc = document.formulario.fecha_gen_doc.value;
        dias_doc=fecha_doc.substring(0,2);
        mes_doc=fecha_doc.substring(3,5);
        ano_doc=fecha_doc.substring(6,10);
    var fecha = new Date(ano_doc,mes_doc-1, dias_doc);
    var tiempoRestante = fechaActual.getTime() - fecha.getTime();
    var dias = Math.floor(tiempoRestante / (1000 * 60 * 60 * 24));
    if (dias >60 && dias < 1500) {
        alert("El documento tiene fecha anterior a 60 dias!!");
    }else{
        if (dias > 1500) {
            sftp://jlosada@172.16.0.168/home/orfeodev/jlosada/public_html/orfeointer/radicacion/NEW.php
            alert("Verifique la fecha del documento!!");
            fecha_doc = "";
        }else {
            fecha_doc = "ok";
            if (dias < 0){
                alert("Verifique la fecha del documento !!, es Una fecha Superior a la Del dia de Hoy");
                fecha_doc = "asdfa";
            }
        }
  
    }
    return fecha_doc;
}
function radicar_doc(){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    if(fechf ("formulario",16)=="ok"){
        if ( document.formulario.documento_us1.value != 0 &&
             document.formulario.muni_us1.value != 0 &&
             document.formulario.direccion_us1.value != 0) {
           document.formulario.submit();
        } else {
           alert("El tipo de Documento, Remitente/Destinatario, Direccion son obligatorios ");    }
     }
}

function modificar_doc(){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    if (document.formulario.documento_us1.value) {
        document.formulario.submit();
    }else{
       alert("Remitente/Destinatario son obligatorios ");
    }
}

function pestanas(pestana){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
<?
    //if($ent==1) $ver_pestana="none"; else $ver_pestana="";
    if($ent==1) $ver_pestana=""; else $ver_pestana="";
?>
    document.getElementById('remitente').style.display = "";
    document.getElementById('remitente_R').style.display = "none";
    document.getElementById('predio').style.display = "<?=$ver_pestana?>";
    document.getElementById('predio_R').style.display = "none";
    document.getElementById('empresa').style.display = "<?=$ver_pestana?>";
    document.getElementById('empresa_R').style.display = "none";
    if(pestana==1) {
        document.getElementById('pes1').style.display = "";
        document.getElementById('remitente').style.display = "none";
        document.getElementById('remitente_R').style.display = "";
    }else {
        document.getElementById('pes1').style.display = "none";
    }
    if(pestana==2) {
        document.getElementById('pes2').style.display = "";
        document.getElementById('predio').style.display = "none";
        document.getElementById('predio_R').style.display = "";
    }else{
        document.getElementById('pes2').style.display = "none";
    }
    if(pestana==3) {
        document.getElementById('pes3').style.display = "";
        document.getElementById('empresa').style.display = "none";
        document.getElementById('empresa_R').style.display = "";
    }else {
        document.getElementById('pes3').style.display = "none";
    }
}

function pb1(){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    dato1 = document.forma.no_documento.value;
}

function Start(URL, WIDTH, HEIGHT) {
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=1100,height=550";
    preview = window.open(URL , "preview", windowprops);
}

function doPopup() {
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    url = "popup.htm";
    width = 800; // ancho en pixels
    height = 320; // alto en pixels
    delay = 2; // tiempo de delay en segundos
    timer = setTimeout("Start(url, width, height)", delay*1000);
}

function buscar_usuario(){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    document.write('<form target=Buscar_Usuario name=formb action=buscar_usuario.php?envio_salida=true&ent=<?=$ent?> method=POST>************');
    document.write("<input type='hidden' name=no_documento value='" + documento +"'>");
    document.write("</form> ");
}

function regresar(){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    i=1;
}

