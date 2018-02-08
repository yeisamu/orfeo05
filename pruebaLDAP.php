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



   print ("<html>\n<body>\n<head>");
   print ("   <META HTTP-EQUIV=\"Cache-Control\" content=\"no-cache\">
              <META HTTP-EQUIV=\"Pragma\" CONTENT=\"no-cache\">
              <meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
              <meta name=\"Author\" content=\"Jaime Enrique Gomez (Kasandra)\" >
           </head>\n\n");

//$ldapServer =  '192.168.8.18';
//$ldapServer =  '127.0.0.1';
//Modificado skina Arbol de Zion
/*$ldapServer =  '192.168.8.205';
//$cadenaBusqLDAP = 'ou=People,dc=skinatech,dc=com';
$cadenaBusqLDAP = 'ou=People,dc=skina,dc=com,dc=co';
//$campoBusqLDAP = 'uid';
$campoBusqLDAP = 'givenName';

$adminLDAP = 'Replicator';
$paswLDAP='passwdroot';*/
//Nombre o IP del servidor de autenticacion LDAP
$ldapServer = '192.168.12.235';
//Cadena de busqueda en el servidor.
$cadenaBusqLDAP = 'dc=aseourbanoesp,dc=com,dc=co';
//Campo seleccionado (de las variables LDAP) para realizar la autenticacion.
$campoBusqLDAP = 'sAMAccountName';


$adminLDAP = 'Orfeo';
//$adminLDAP = 'Orfeo@aseourbanoesp';
$paswLDAP='Acceso.2014';

if($connect=ldap_connect($ldapServer)){ 

   ldap_set_option($connect, LDAP_OPT_PROTOCOL_VERSION, 3);
   ldap_set_option($connect, LDAP_OPT_REFERRALS, 0);

   // enlace a la conexión
   if(($bind=ldap_bind($connect,$adminLDAP,$paswLDAP)) == false){
       //$mensajeError =  "Falla la conexi&oacute;n con el servidor LDAP<br>".$bind.$connect;
       echo $mensajeError;
   }
  /* else
     echo "Estoy conectado ..que bien <br>\n" ;*/

   // busca el usuario
   if (($res_id =ldap_search( $connect,
                        //"ou=People,dc=skinatech,dc=com",
                        "ou=People,dc=skina,dc=com,dc=co",
                        "(givenName=$username)")) == false) {
       $mensajeError = "No encontrado el usuario en el Arbol LDAP (".$res_id.")".$username;
//       $mensajeError=ldap_error($conexion);  
        echo $mensajeError;
   }
 /* else
     echo "Encontre usuario ..que bien <br>\n " ;
     print $res_id;	*/

   if (ldap_count_entries($connect, $res_id) != 1) {
     	$mensajeError =  "El usuario $username se encontr&oacute; mas de 1 vez<br>";
     echo $mensajeError;
   }
/*  else
     echo "Solo un usuario encontrado ..que bien <br>\n " ;*/

   if (( $entry_id = ldap_first_entry($connect, $res_id))== false) {
     	$mensajeError =  "No se obtuvieron resultados<br>";
     echo $mensajeError;
   }
 /*  else
     echo "Obtiene el primer resultado ..que bien <br>\n " ;*/

   if (( $user_dn = ldap_get_dn($connect, $entry_id)) == false) {
     	$mensajeError = "No se puede obtener el dn del usuario<br>";
     echo $mensajeError;
   }
/*  else
     echo "DN del usuario encontrado..que bien <br>\n ".$user_dn."<br>" ;*/

   /* Autentica el usuario */
   if (($link_id = ldap_bind($connect, $user_dn, $password)) == false) {
   	$mensajeError = "USUARIO O CONTRASE&Ntilde;A INCORRECTOS<br>";
     	echo $mensajeError;
	}
 /*  else
     echo "Usuario conectado ..que bien <br>\n ".$link_id."<br>" ;*/

   //ldap_close($connect);
  } else {                                 
    $mensajeError = "no hay conexión a '$ldap_server'";
    echo $mensajeError;
  }


  print ("</body>\n</html>");
?>
