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


/**
* Instalador Web Orfeo 
* Desarrollo Ing. Isabel Rodriguez
* Diseño Ing. Erlyzeth Feria
* SkinaTech
* Fecha: 20-Marzo-2012
* Sistema de gestion Documental ORFEO.
*
* Permite la instalacion de Orfeo via web
* Paso 1. Empiezo a escribir configuracion y subo logos
*/

//traigo datos
$nomempresa=$_POST["nomempresa"];
$sigla=$_POST["sigla"];
$dir=$_POST["dir"];
$tel=$_POST["tel"];
$url=$_POST["url"];
$logo=$_POST["logo"];
$correo=$_POST["correo"];
$check=$_POST["check"];

//Primero escribo el config, y despues subo logo!!!
if($nomempresa!='' and $sigla!='') {
 $nombre_archivo = 'config.txt';
 $line_break ="\n";
 $contenido = '<?php'.$line_break;
 $contenido .= '$entidad_largo = "'.$nomempresa.'";'.$line_break;
 $contenido .= '$entidad = "'.$sigla.'";'.$line_break;
 $contenido .= '$entidad_tel = "'.$tel.'";'.$line_break;
 $contenido .= '$entidad_dir = "'.$dir.'";'.$line_break;
 $contenido .= '$entidad_contacto = "'.$url.'";'.$line_break;
 $contenido .= '$administrador = "'.$correo.'";'.$line_break;
 //Agregamos otros datos de arranque
 $contenido .= '$entidad_depsal = 999;  //Guarda el codigo de la dependencia de salida por defecto al radicar dcto de salida
                        // 0 = Carpeta salida del radicador Redirecciona a la dependencia especificada
'.$line_break;
 $contenido .= '$MODULO_RADICACION_DOCS_ANEXOS=1;'.$line_break;
 $contenido .= '$MODULO_ENVIOS = 2;'.$line_break;
 $contenido .= '$menuAdicional = 0;'.$line_break;

 // Primero vamos a asegurarnos de que el archivo existe y es escribible.
 if (is_writable($nombre_archivo)) {

    if (!$gestor = fopen($nombre_archivo, 'w')) {
         echo "No se puede abrir el archivo ($nombre_archivo)";
         exit;
    }

    // Escribir $contenido a nuestro archivo abierto.
    if (fwrite($gestor, $contenido) === FALSE) {
        echo "No se puede escribir en el archivo ($nombre_archivo)";
        exit;
    }

    echo "Se escribio contenido en el archivo ($nombre_archivo)";

    fclose($gestor);

 } else {
    echo "El archivo $nombre_archivo no es escribible";
 }

 //si viene correo y desea soporte
	if ($correo!='' and $check) 
	{
		//verifico que sea correcto
		$mail_correcto = 0;
		$mail=$correo;
	    //compruebo unas cosas primeras
	    if ((strlen($mail) >= 6) && (substr_count($mail,"@") == 1) && (substr($mail,0,1) != "@") && (substr($mail,strlen($mail)-1,1) != "@")){
       		if ((!strstr($mail,"'")) && (!strstr($mail,"\"")) && (!strstr($mail,"\\")) && (!strstr($mail,"\$")) && (!strstr($mail," "))) {
          //miro si tiene caracter .
	          if (substr_count($mail,".")>= 1){
        	     //obtengo la terminacion del dominio
	             $term_dom = substr(strrchr ($mail, '.'),1);
        	     //compruebo que la terminación del dominio sea correcta
	             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($mail,0,strlen($mail) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
	if($mail==' ' or $mail_correcto==0)
        {
	  echo "No se pudo enviar notificacion, el usuario no tiene correo electronico o tiene un formato incorrecto, comuniquese con el administrador del sistema";
        }
	else
	{
		//Correo a soporte
		$fecha= date('Ymd');
		$subject = "Soporte nuevo - instalador orfeo";	
		$body = "El usuario ".$correo." instalo Orfeo y desea soporte una semana a partir de ".$fecha.", en la empresa ".$nomempresa."";
		
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	        $headers .= "Content-Transfer-Encoding: base64\r\n";
	        $headers .= "From: Instalador <soporte@skinatech.com>\r\n";
        	$body=chunk_split(base64_encode($body));

		$ok=mail("irodriguez@skinatech.com",$subject,$body,$headers);
        	if ($ok) echo("Se ha enviado una notificacion");
	        else echo ("No envio correo");

		//Correo al usuario
		$subject = "Bienvenido al servicio de soporte SkinaTech";
		$body = "Su correo se ha inscrito para revibir soporte durante una semana a partir de ".$fecha."";
        	$body=chunk_split(base64_encode($body));
		$ok=mail($correo,$subject,$body,$headers);
        	if ($ok) echo("Se ha enviado una notificacion a $correo");
	        else echo ("No envio correo");
		}
	}
	
	//subo logo
	//datos del arhivo 
	$nombre_archivo = "logoEntidad.gif";
	$dir = '.';
	$tipo_archivo = $_FILES['logo']['type']; 
	$tamano_archivo = $_FILES['logo']['size']; 
	
	if($tamano_archivo){
	//compruebo si las caracteríicas del archivo son las que deseo 
	//if (!((strpos($tipo_archivo, "gif") or (strpos($tipo_archivo, "GIF"))) && ($tamano_archivo < 100000))) { 
	//if (!((strpos($tipo_archivo, "gif") or strpos($tipo_archivo, "GIF")) && ($tamano_archivo < 100000))) { 
	if (!((strpos($tipo_archivo, "gif"))) && ($tamano_archivo < 100000)) { 
	 	 header("Location: pasouno.php?error=2");
	}else{ 
		if (move_uploaded_file($_FILES['logo']['tmp_name'], "$dir/$nombre_archivo")){ 
			echo "<BR><HR><center><B><FONT COLOR=RED>EL ARCHIVO HA SIDO CARGADO CORRECTAMENTE</FONT></B></center><HR>"; 
		}else{ 
	 	 	header("Location: pasouno.php?error=3");
			} 
		} 	
	}
	 //todo Ok lo envio al siguiente paso
	 header ("Location: pasodos.php");
}
else {
	//si no existe le mando otra vez a la portada
    header("Location: pasouno.php?error=1");
}
?>
