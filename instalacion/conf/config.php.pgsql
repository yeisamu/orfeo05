<?php
//servidor donde esta la bd
$servidor = "localhost:5432";
//Nombre de la base de datos de ORFEO
$servicio = "orfeo";
//$servicio = "orfeopruebas";
//by skinatech (usuario bd)
$usuario = "admin";
//by skinatech (pass usuario bd)
$contrasena= "orfeo";
//Nombre o IP del servidor de BD. Opcional puerto, p.e. 120.0.0.1:1521
$db = $servicio;
//Tipo de Base de datos. Los valores validos son: postgres, oci8, mssql.
$driver = "postgres";
 //Variable que indica el ambiente de trabajo, sus valores pueden ser  desarrollo,prueba,orfeo
$ambiente = "orfeo";
//Servidor que procesa los documentos
$servProcDocs = "127.0.0.1:8000";
//Acronimo de la empresa
$entidad= "Autopista Rio Magdalena";
//Nombre de la EmpresaCD
$entidad_largo= 'Autopista Rio Magdalena';     //Variable usada generalmente para los t�tulos en informes.
//Telefono o PBX de la empresa.
$entidad_tel =  '(4) 832-6779';
//URL de contacto de la empresa o entidad
$entidad_contacto = "www.autopistamagdalena.com.co";
//Direccion de la Empresa.
$entidad_dir = "Calle 47A, # 6 - 20 Puerto Berrio, Antioquia";
			// 0 = Carpeta salida del radicador	>0 = Redirecciona a la dependencia especificada
/**
*	Se crea la variable $ADODB_PATH.
*	El Objetivo es que al independizar ADODB de ORFEO, este (ADODB) se pueda actualizar sin causar
*	traumatismos en el resto del codigo de ORFEO. En adelante se utilizara esta variable para hacer
*	referencia donde se encuentre ADODB
*/

//$ADODB_PATH = "/var/www/orfeo/trunk/include/class/adodb";
$ADODB_PATH = "/var/www/orfeo/adodb";
$ADODB_CACHE_DIR = "/tmp";

$MODULO_RADICACION_DOCS_ANEXOS=1;
$MODULO_ENVIOS = 2;

/**
 * Configuracion LDAP
 */

// Escriba la configuracion en el archivo autenticaLDAP

//Nombre o IP del servidor de autenticacion LDAP
/*$ldapServer = '192.1.1.100';
//Cadena de busqueda en el servidor.
$cadenaBusqLDAP = 'dc=skinatech,dc=com,dc=co';
//Campo seleccionado (de las variables LDAP) para realizar la autenticacion.
$campoBusqLDAP = 'sAMAccountName';*/

/*Configuracion de Fax Server*/
/*if ((!defined(FAXSERVER_IP)) || (!defined(FAXSERVER_SSH_USER)))
{
    //	define(FAXSERVER_IP,'LOCALHOST');
    define(FAXSERVER_IP,'localhost');
    //define(FAXSERVER_SSH_USER,'www-data');
    define(FAXSERVER_SSH_USER,'orfeofax');
}*/
$menuAdicional = 0;

// Variables que se usan para la radicacion del correo electronio
// Sitio en el que encontramos la libreria pear instalada
$PEAR_PATH="/var/www/orfeo/pear/";
// Servidor de Acceso al correo Electronico
$servidor_mail_imap="outlook.office365.com";
// Servidor de Acceso al correo Electronico
//$servidor_mail_smtp="mail.skinatech.com";
$servidor_mail_smtp="smtp.office365.com";
// Tipo de servidor de correo Usado
$protocolo_mail="imaps"; // imap  | pop3
// Puerto del servidor de Mail.
$puerto_mail_imap=993; //Segun servidor defecto 143 | 110
// Puerto del servidor de Mail.
$puerto_mail_smtp=25; //Se587n servidor defecto 143 | 110
// Puerto del servidor de Mail.
$cuenta_mail="notificaciones.am@autopistamagdalena.com.co"; //Segun servidor defecto 143 | 110
// Puerto del servidor de Mail.
$contrasena_mail="cqVfVt50"; //Segun servidor defecto 143 | 110
//Color de Fondo de OrfeoGPL
$colorFondo = "8cacc1";
// Pais Empresa o Entidad
$pais = "Colombia";
// Correo Contacto o Administrador del Sistema
$administrador = " ";
// Directorio de estilos a Usar... Si no se establece una Ruta el sistema usara el que posee por Defecto en el directorio estilos.  orfeo.css para usarlo cree una carpeta con su personalizacion y luego copie el archivo orfeo.css y cambie sus colores.
$ESTILOS_PATH = "/estilos/orfeo38/";
$imagenes = "imagenes";
// Datos configuración para el formulario web pqrs
$longitud_codigo_dependencia = '3';
$depeRadicaFormularioWeb = str_pad("630",$longitud_codigo_dependencia,'0', STR_PAD_LEFT);  // Dependencia a la cual se Es radicado en la Dependencia 990
$entidad_depsal = str_pad("999",$longitud_codigo_dependencia,'0', STR_PAD_LEFT);//Guarda el codigo de la dependencia de salida por defecto al radicar dcto de salida
$usuaRecibeWeb           = 1;  // Usuario que va a recepcionar los radicados web-pqr
$secRadicaFormularioWeb  = "secr_tp4_630"; // Esta secuencia es para los consecutivos de PQR para pruebas es la 998 pero para produccion es 630 en Rio Magdalena
?>
