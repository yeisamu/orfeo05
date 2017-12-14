/************************************************************************
# PROYECTO: Orfeo   MODULO: Email - email.inc3.js  FECHA: Octubre 2012  *
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


function procEst2(formulario,tb){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    var lista = document.formulario.codep.value;
    i = document.formulario.codep.value;
    if (i != 0) {
        var dropdownObjectPath = document.formulario.tip_doc;
        var wichDropdown = "tip_doc";
        var d=tb;
        var withWhat = document.formulario.codep.value;
        populateOptions2(wichDropdown, withWhat,tb);
      }
}

function populateOptions2(wichDropdown, withWhat,tbres){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    r = new Array;
    i=0;
    if (withWhat == "2") {
        r[i++]=new Option("NIT", "1");
    }
    if (withWhat == "1") {
        document.formulario.submit();
        r[i++]=new Option("NIT","4");
        r[i++]=new Option("NUIR","5");
    }
    if (withWhat == "3"){
        r[i++]=new Option("CC", "0");
        r[i++]=new Option("CE", "2");
        r[i++]=new Option("TI", "1");
        r[i++]=new Option("PASAPORTE", "3");
    }
    if (i==0) {
        alert(i + " " + "Error!!!");
    }else{
        dropdownObjectPath = document.formulario.tip_doc;
        eval(document.formulario.tip_doc.length=r.length);
        largestwidth=0;
        for (i=0; i < r.length; i++) {
            eval(document.formulario.tip_doc.options[i]=r[i]);
            if (r[i].text.length > largestwidth) {
                largestwidth=r[i].text.length;  
            }
        }
        eval(document.formulario.tip_doc.length=r.length);
        //eval(document.myform.cod.options[0].selected=true);
    }
}

function vnum(formulario,n){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/
    valor = formulario.elements[n].value;
    if (isNaN(valor)) {
        alert ("Dato incorrecto..");
        formulario.elements[n].value="";
        formulario.elements[n].focus();
        return false;
    }else
        return true;
}

function fech(formulario,n){
/*-----------------------------------------------------------------------

DESCRIPTION:

PARAMETERS: 
RESULT: 
-----------------------------------------------------------------------*/

    m=n-1;
    s=m-1;
    var f=document.formulario.elements[n].value;
    var meses=parseInt(document.formulario.elements[m].value);
    eval(lona=document.formulario.elements[n].length);
    eval(lonm=document.formulario.elements[m].length);
    eval(lond=document.formulario.elements[s].length);
    if(lona==44 || lonm==44 || lond==44) {
        alert("Fecha incorrecta  debe ser DD/MM/AAAA !!!");
        document.formulario.elements[s].value="";
        document.formulario.elements[m].value="";
        document.formulario.elements[n].value="";
        document.formulario.elements[s].focus();
    }else{
    if ((f%4)==0){
        if(document.formulario.elements[m].value<13){
            switch(meses){
                case 12: if(document.formulario.elements[s].value>31){
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 11 : if(document.formulario.elements[s].value>30){
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 10 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 9 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 8 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 7 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 6 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 5 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 4 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 3 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 2 : if(document.formulario.elements[s].value>29) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }
                    break;
                case 1 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
            }
        }else {
           alert("Fecha mes inexistente!!");
           document.formulario.elements[s].value="";
           document.formulario.elements[m].value="";
           document.formulario.elements[n].value="";
           document.formulario.elements[s].focus();
       }
   } else {
       if(document.formulario.elements[m].value<13){
           switch(meses){
                case 12 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 11 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 10 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 9 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 8 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 7 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 6 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 5 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 4 : if(document.formulario.elements[s].value>30) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 3 : if(document.formulario.elements[s].value>31){
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 2 : if(document.formulario.elements[s].value>28) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
                 case 1 : if(document.formulario.elements[s].value>31) {
                        alert ("Fecha incorrecta..");
                        document.formulario.elements[s].value="";
                        document.formulario.elements[m].value="";
                        document.formulario.elements[n].value="";
                        document.formulario.elements[s].focus();
                        return false;
                    }break;
           }
       }else {
           alert("Fecha mes inexistente!!");
           document.formulario.elements[s].value="";
           document.formulario.elements[m].value="";
           document.formulario.elements[n].value="";
           document.formulario.elements[s].focus();
       }
   }
   }
   }
   var contadorVentanas=0
