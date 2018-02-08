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



	class nuevaConexion{
		//declaración de variables
		public $host; // para conectarnos a localhost o el ip del servidor de postgres
		public $db; // seleccionar la base de datos que vamos a utilizar
		public $user; // seleccionar el usuario con el que nos vamos a conectar
		public $pass; // la clave del usuario
		public $conexion;  //donde se guardara la conexión
		public $url; //dirección de la conexión que se usara para destruirla mas adelante

		//creación del constructor
		function __construct(){
			}

		//creación de la función para cargar los valores de la conexión.
		public function cargarValores(){
			$this->host='localhost';
			$this->db='rio';
			$this->user='admin';
			$this->pass='orfeo';
			$this->conexion="host='$this->host' dbname='$this->db' user='$this->user' password='$this->pass' ";
			}

			//función que se utilizara al momento de hacer la instancia de la clase
			function conectar(){
				$this->cargarValores();
				$this->url=pg_connect($this->conexion);
				return true;
			}
	
			function consultar($query){
			$result = pg_query($query) or die('La consulta fallo: ' . pg_last_error());
			return $result;

			}

			//función para destruir la conexión.
			function destruir(){
				pg_close($this->url);
			}

		}

?>
