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
 * Anex_tipo es la clase encargada de gestionar las operaciones y
 * los datos básicos referentes a un tipo de formato de documento a anexar 
 * a un radicado
 * @author      Sixto Angel Pinzón
 * @version     1.0
 */

class Anex_tipo {

  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos_tipo
   * @var numeric
   * @access public
   */
var $anex_tipo_codi;
  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos_tipo
   * @var string
   * @access public
   */
var $anex_tipo_ext;
  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos_tipo
   * @var string
   * @access public
   */
var $anex_tipo_desc;

/**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
   */
var $cursor;


/** 
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
function Anex_tipo($db) {
	$this->cursor = $db;
}

/** 
* Retorna el valor entero correspondiente al atributo
* codigo del registro
* @return   entero
*/
function get_anex_tipo_codi() {
	return  $this->anex_tipo_codi;
}

/** 
* Retorna el valor string correspondiente al atributo
* nombre de la extension del archivo
* @return   string
*/
function get_anex_tipo_ext() {
	return $this->anex_tipo_ext;
}

/** 
* Retorna el valor string correspondiente al atributo
* descripción del formato del archivo a anexar
* @return   string
*/
function get_anex_tipo_desc() {
	return $this->anex_tipo_desc;
}

 /** 
  * Actualiza los atributos de la clase con los datos
  * del tipo de formato del documento a anexar correspondiente al  código del registro
  * que recibe como parámetros
  * @param $codigo     es el código del registro
  */
function anex_tipo_codigo($codigo){
	$q= "select *  from anexos_tipo
             where anex_tipo_codi=$codigo";
	$rs=$this->cursor->query($q);

	if ($rs&&!$rs->EOF){
		$this->anex_tipo_codi=$rs->fields['ANEX_TIPO_CODI'];
		$this->anex_tipo_ext=$rs->fields['ANEX_TIPO_EXT'];
		$this->anex_tipo_desc=$rs->fields['ANEX_TIPO_DESC'];
		
	}
	
}	
		
		
}


?>
