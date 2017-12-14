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


/**********************************************************************************
Diseno de un Web Service que permita la interconexion de aplicaciones con Orfeo
**********************************************************************************/

/**
 * @author German Mahecha
 * @author William Duarte (modificacion del archivo original y adicion de funcionalidad)
 * @author Donaldo Jinete Forero
 * @author isabel rodriguez compatibilidad para ccpsd
 */

//Llamado a la clase nusoap

$ruta_raiz = "../";

include_once RUTA_RAIZ."include/db/ConnectionHandler.php";
require_once RUTA_RAIZ."include/fpdf/fpdf.php";

class img{
/**
 * UploadFile es una funcion que permite almacenar cualquier tipo de archivo en el lado del servidor
 * @param $bytes 
 * @param $filename es el nombre del archivo con que queremos almacenar en el servidor
 * @author German A. Mahecha
 * @return Retorna un String indicando si la operacion fue satisfactoria o no
 */
function UploadFile($bytes, $filename){
    //$var = explode(".",$filename);
        //try{
                //direccion donde se quiere guardar los archivos
                $year=substr($filename,0,4);
                $depe=substr($filename,4,3);
                $path="../bodega/{$year}/{$depe}/docs/{$filename}";
		if(!$fp = fopen("$path", "w")){
                        die("fallo");
                }
                // decodificamos el archivo 
                $bytes=base64_decode($bytes);
                $salida=true;
                if( is_array($bytes) ){
                        foreach($bytes as $k => $v){
 				   $salida=($salida && fwrite($fp,$bytes));
                        }
                }else{
                        $salida=fwrite($fp,$bytes);
                }
                fclose($fp);
        /*}catch (Exception $e){
                return "error";  
        }*/
        if ($salida){
        return "exito";
        }else{
        return "error";
        }
}

/**
 * funcion encargada regenerar un archivo enviado en base64 para un anexo
 *
 * @param string $ruta ruta donde se almacenara el archivo 
 * @param base64 $archivo archivo codificado en base64
 * @param string $nombre nombre del archivo
 * @return boolean retorna si se pudo decodificar el archivo
 */
function subirAnexo($ruta,$archivo,$nombre){
                //try{
                //direccion donde se quiere guardar los archivos
                $fp = @fopen("{$ruta}{$nombre}", "w");
                $bytes=base64_decode($archivo);

                $salida=true;
                if( is_array($bytes) ){
                        foreach($bytes as $k => $v){
                                $salida=($salida && fwrite($fp,$bytes));
                        }
                }else{
        	 $salida=fwrite($fp,$bytes);
	                }
                fclose($fp);
        /*}catch (Exception $e){
                return "error";  
        }*/
        return $salida;
}



}


?>
