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


	class configHelperOrfeo{
		//declaración de variables
		private $configPath; 

		//creación del constructor
		function __construct($path){
			$this->configPath = $path;
			}

		//creación de la función para cargar los valores de la conexión.
		public function readJson(){
			$json_data = file_get_contents($this->configPath);
			$array=	json_decode($json_data, true);
			return $array;
			}

			//función que se utilizara al momento de hacer la instancia de la clase
		public	function writeJson($datos){
			$fh = fopen($this->configPath, 'w') or die("can't open file");
			fwrite($fh, json_encode($datos));
			fclose($fh);	
			}

                public  function addJson($datos){
			$array=$this->readJson();
			$array=(array_merge($array,$datos));
			$this->writeJson($array);
			return $array;
                        }


		}

?>
