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
 * Error es la clase basica encargada de gestionar los mensajes de error presentados durante la ejecucion de un proceso
 * @author      Sixto Angel Pinzon
 * @version     1.0
 */

class Error {	 

  /**
   * Variable que indica el codigo del error
   * @var numeric
   * @access public
   */
	var $code;
	
  /**
   * Variable que indica el mensaje asociado con el tipo de error
   * @var numeric
   * @access public
   */
	var $message;    	

   /** 
	* Constructor encargado de inicializar el codigo de error
	* @param	$code	Es el codigo del error
	* @return   void
	*/
    function Error($code = 0) {
    	$this->code=$code;
    }
	
    /** 
     * Retorna el valor string correspondiente al atributo texto del error
     * @return   string
     */
    function getMessage() {
    	return $this->message;
   	}
   	
   	/** 
	* Funcion encargada de asignar el texto del mensaje de error
	* @param	$mess	Es el texto del error
	* @return   void
	*/
   	function setMessage($mess){
   		$this->message=$mess;
   	}
   	
   	/** 
	* Funcion encargada de asignar el texto del mensaje de error añadiendo el parametro de entrada al valor actual del mensaje
	* @param	$mess	Es el texto del error
	* @return   void
	*/
   	function setMessageAdd($mess){
   		$this->message="<span class='alarmas'>".$mess."</span>".$this->message;
   	}
}

?>
