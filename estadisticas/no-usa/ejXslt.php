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


include "pagVariables.php";
$proc = new XSLTProcessor;
if (!$proc->hasExsltSupport()) {
   die('EXSLT support not available');
}

error_reporting(7);
// Load the XML source
$xml = new DOMDocument;
$xml->load('usOrfeo.xml');

$xsl = new DOMDocument;
$xsl->load('jh.xsl'); 

// Configure the transformer
if(!$cOrden or !$cOrdenType) 
{
	$cOrden="DEPE_CODI";
	$cOrdenDType="number";
	$cOrdenType="descending";
}
if($cOrdenType=="descending")
{
	$cOrdenType = "ascending";
}else
{
	$cOrdenType = "descending";
}
$proc = new XSLTProcessor;
$proc->setParameter('','cOrdenDType',$cOrdenDType);
$proc->setParameter('','cOrdenType',$cOrdenType);
$proc->setParameter('','cOrden',$cOrden);
$proc->setParameter('','pos1',0);
$proc->setParameter('','pos1',1);
$proc->importStyleSheet($xsl); 
$proc->setParameter('','varDependencia','529');
$proc->setParameter('','paginaActual',$PHP_SELF);
$proc->transformToURI($xml, 'out.html'); 
include "out.html";
?> 
