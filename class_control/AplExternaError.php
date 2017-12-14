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
 * CombinaError es la clase encargada de gestionar los mensajes de errores presentadas al tratar de combinar un documento
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */
require_once("$ruta_raiz/class_control/Error.php");
class AplExternaError extends Error {	     	
		
	/** 
	* Constructor encargado de inicializar el codigo de error
	* @param	$code	Es el codigo del error
	* @return   void
	*/
   function AplExternaError($code = 0) {
   		Error::Error($code);
   		Error::setMessage($this->tipoError($code));
	}

   /** 
	* Funcion encargada de obtener el mensaje de error de acuerdo al codigo del error
	* @param	$code	Es el codigo del error
	* @return   void
	*/
    function tipoError() {
    	$error.="<BR> <input type=button  name=Regresar value=Regresar  class='botones' onClick='history.go(-1);'>";
	    return $error;
    }  	
    
    /** 
     * Retorna el valor string correspondiente al atributo texto del error
     * @return   string
     */
    function getMessage(){
    	return Error::getMessage()	;
    }

}


?>
