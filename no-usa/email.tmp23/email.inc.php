<?php
/************************************************************************
# PROYECTO: Orfeo   MODULO: Email - email.inc.php  FECHA: Octubre 2012  *
#~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~*
#                                                                       *
# Funciones que se usan en el Modulo de Email                           *
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

function sup_tilde($str){
/*-----------------------------------------------------------------------
Funcion Suprime caracteres no imprimibles

DESCRIPTION:

PARAMETERS: 
RESULT: string sin caracteres especiales
-----------------------------------------------------------------------*/
   $stdchars= array("@","a","e","i","o","u","n","A","E","I","O","U","N"," "," "," "," ");
   $tildechars= array("@","=E1","=E9","=ED","=F3","=FA","=F1","=C1","=C9","=CD","=D3","=DA","=D1","=?iso-8859-1?Q?","=?utf-8?Q?","?=","=20");
   return str_replace($tildechars,$stdchars, $str);
}

?>
