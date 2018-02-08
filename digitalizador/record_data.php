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


/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Funcion para autocompletar campos
 *
 * Este archivo permite realizar una búsqueda por nombre de usuario
 * en la tabla de radicados para autocompletar el resto de campos
 * automáticamente
 *
 * PHP version 5
 *
 * @param string    $user_full_name
 *                  Captura el valor autocompletado en el input
 * @param array     $result
 *                  Arreglo que contiene los valores retornados por la
 *                  consulta en la tabla de radicados
 * @param array     $data
 *                  Arreglo que contendrá la información del usuario ingresado
 * @param array     $fila
 *                  Arreglo que extrae columna por columna los resultados de la query
 * @param array     $rs_reg
 *                  Arreglo que contiene los valores retornados por la consulta en la
 *                  tabla de regiones
 * @param string    $departamento
 *                  Contiene el código de la región padre del municipio
 * @param string    $pais
 *                  Contiene el código de la región padre del departamento
 * @param string    $pcontinente
 *                  Contiene el código de la región padre del país
 * @param string    $continente
 *                  Contiene el código de la región padre de la subdivisión del
 *                  continente 
 *
 * PHP Version 5
 *
 * LICENSE:  GNU GENERAL PUBLIC LICENSE Version 2, June 1991
 *
 * @category  Busqueda
 * @package   SkTimer
 * @author    Pablo Villate <pvillate@skinatech.com>
 * @copyright 2014 Skina Technologies Ltda.
 * @license   ../LICENSE.txt <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link      http://www.skinatech.com
 * @since     Archivo disponible desde la version 1.0.0
 */

 //Incluyo la libreria del digitalizador
require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."class/Digitalizador.php");

//Crago la clase de conexión si no esta definida
$digitalizador = new Digitalizador();
   
$data=array();

$data=$digitalizador->getRecordData($_GET['radicado']);
echo json_encode($data);

?>

