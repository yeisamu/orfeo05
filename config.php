<?php 
/**
 * Archivo de Configuracion ejemplo
 *
 * @category  
 * @package      SGD Orfeo
 * @subpackage   
 * @author       Jaime E. Gomez H.
 * @author       Skina Technologies SAS (http://www.skinatech.com)
 * @license      GNU/GPL <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link         http://www.orfeolibre.org
 * @version      SVN: $Id$
 * @since        
 */

//############# Datos de Empresa instalada

$entidad= "Alcaldia Bugalagrande";                 //Acronimo de la empresa  //Nombre de la EmpresaCD
$entidad_largo= 'Alcaldia municiapl de Bugalagrande';   //Variable usada generalmente para los titulos en informes.
$nit_entidad = '000.000.000-0';             // Nit de la empresa
$entidad_tel =  '+571 2262080';             //Telefono o PBX de la empresa.
$entidad_contacto = "www.bugalagrande.gov.co";    //URL de contacto de la empresa o entidad
$entidad_dir = "Carrera 64 No 96-17 - Bogotá D.C., Colombia";  //Direccion de la Empresa.
$pais = "Colombia";                         // Pais Empresa o Entidad

//############# Servidor de Bases de datos

$driver =   "postgres";                // Tipo de Base de datos. Los valores validos son: postgres, oci8, mssql.
$servidor = "localhost:5432";          // Nombre o IP del srv de BD. Opcional puerto, 120.0.0.1:1521
$servicio = "orfeo1";               // Nombre de la base de datos de ORFEO
$usuario = "postgres";                    // Usuario de conexion
$contrasena= "orfeo";           // Contraseña
$db = $servicio;

//#############  Servidor de correo Electronico

$servidor_mail="imap.gmail.com";  //Servidor de consulta de correo
$protocolo_mail="imaps";              // Protocolo e consulta correo ( imap  | pop3 )
$puerto_mail=993;                     // Puerto de consulta de correo
                                      // ** El usario de consulta esta en la BS
$servidor_mail_smtp="smtp.gmail.com";  // Servidor de Salida
$puerto_mail_smtp=587;                     // Puerto del servidor de Mail (25 | 587)
$cuenta_mail="yeison.velasquez@gmaill.com";      // Usuario de conexion
$contrasena_mail="samu0118";           //  Contrasena

//#############  Servidor de autenticacion LDAP / AD

//Nombre o IP del servidor de autenticacion LDAP
//- $ldapServer = '192.1.1.100';
//Cadena de busqueda en el servidor.
//- $cadenaBusqLDAP = 'dc=skinatech,dc=com';
//Campo seleccionado (de las variables LDAP) para realizar la autenticacion.
//- $campoBusqLDAP = 'sAMAccountName';

//#############  Servidor de FAX

/*if ((!defined(FAXSERVER_IP)) || (!defined(FAXSERVER_SSH_USER)))
{
    //	define(FAXSERVER_IP,'LOCALHOST');
    define(FAXSERVER_IP,'localhost');
    //define(FAXSERVER_SSH_USER,'www-data');
    define(FAXSERVER_SSH_USER,'orfeofax');
}*/


//############# Librerias externas
/**
*	Se crea la variable $ADODB_PATH.
*	El Objetivo es que al independizar ADODB de ORFEO, este (ADODB) se pueda actualizar sin causar
*	traumatismos en el resto del codigo de ORFEO. En adelante se utilizara esta variable para hacer
*	referencia donde se encuentre ADODB
*/

//$ADODB_PATH = "/var/www/orfeo/trunk/include/class/adodb";
$ADODB_PATH = "/var/www/html/orfeo05/adodb";
$ADODB_CACHE_DIR = "/tmp";

// Variables que se usan para la radicacion del correo electronio
// Sitio en el que encontramos la libreria pear instalada
$PEAR_PATH="/var/www/html/orfeo05/pear/";


//#############  Configuracion / Personalizacion Orfeo

$menuAdicional = 0;
// 0 = Carpeta salida del radicador	>0 = Redirecciona a la dependencia especificada
$usua_perm_avaz = 1;
//Habilita la configuracion avanzada de usuarios
 //Variable que indica el ambiente de trabajo, sus valores pueden ser  desarrollo,prueba,orfeo
$ambiente = "orfeo";
//Servidor que procesa los documentos
$servProcDocs = "127.0.0.1:8000";

$MODULO_RADICACION_DOCS_ANEXOS=1;
$MODULO_ENVIOS = 2;

//Color de Fondo de OrfeoGPL
$colorFondo = "8cacc1";
// Correo Contacto o Administrador del Sistema
$administrador = "yeison.velasquez@gmaill.com";

// Directorio de estilos a Usar... Si no se establece una Ruta el sistema usara
//el que posee por Defecto en el directorio estilos.  
//orfeo.css para usarlo cree una carpeta con su personalizacion y luego copie 
//el archivo orfeo.css y cambie sus colores.
$ESTILOS_PATH = "/estilos/orfeo38/";
//ruta para estilos de prueba
$ESTILOS_PATH2 = "/estilos/orfeo50/";
$ESTILOS_PATH_ORFEO = "/estilos/orfeo.css";
//Logo orfeo en el header
$logoSuperiorOrfeo=true;
$imagenes = "imagenes";
$imagenes2 = "/estilos/orfeo50/imagenes50/";
//Codigo dep pruebas, en consultas no tiene encuenta esta dep para listar radicados
$dependenciaPruebas="0998";
// Datos configuración para el formulario web pqrs
$tipoRadicadoPqr = '4';
$longitud_codigo_dependencia = '4';

// Dependencia encargada de manejar las PQRs
$depeRadicaFormularioWeb = str_pad("0998",$longitud_codigo_dependencia,'0', STR_PAD_LEFT); 
$entidad_depsal = str_pad("0999",$longitud_codigo_dependencia,'0', STR_PAD_LEFT);//Guarda el codigo de la dependencia de salida por defecto al radicar dcto de salida
$usuaRecibeWeb           = 1;  // Usuario que va a recepcionar los radicados web-pqr
$secRadicaFormularioWeb  = "secr_tp4_0998"; // Esta secuencia es para los consecutivos de PQR para pruebas 
?>
