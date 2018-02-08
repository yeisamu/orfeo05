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
* Busqueda de Transferencias documentales
* Sistema de gestion Documental ORFEO.
* Permite traer un listado de los expedientes a los cuales se les debe realizar algun procedimiento por cumplimiento de tiempos por TRD
* Se verifica por expediente y no por radicado
* se presume que un expediente tiene una unica Serie-subserie
*/  
    $ruta_raiz = "..";

    include_once "$ruta_raiz/include/db/ConnectionHandler.php";
    $db = new ConnectionHandler("$ruta_raiz");
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
//    $db->conn->debug=true;
    
    //Genero una subconsulta de los expedientes que cumplieron su tiempo en gestion (dias_ag<0) 
    //y verifico disposicion final, siendo 1 - conservacion total, 2 - Eliminacion , 3 medio tecnico,  4 seleccion
    include_once "$ruta_raiz/include/query/archivo/queryAlerta.php";
    if(!$queryAlertaw) $queryAlertaw=$queryCont;
    $query_cont = 'select disp_fin, estado,
                     dias_ag,dias_ac,count(*)  AS conteo 
                from ( '.$queryAlertaw.' )  AS A 
                where dias_ag<0
                group by disp_fin, estado, dias_ag,dias_ac';

    $rsi=$db->conn->query($query_cont);
    while(!$rsi->EOF){
	$disp_fin=$rsi->fields["DISP_FIN"];
	$estado=$rsi->fields["ESTADO"];
	$conteo=$rsi->fields["CONTEO"];
	$dias_ag=$rsi->fields["DIAS_AG"];
	$dias_ac=$rsi->fields["DIAS_AC"];
	//echo "<br> $disp_fin $conteo $estado  $dias_ag $dias_ac<br>";
	switch ($disp_fin) {
	case 1: 
		{
		if($estado==0) $primaria+=$conteo;
		elseif($estado==1 and $dias_ac<0) $secundaria+=$conteo;  
		break;
		}
	case 2: 
		{
		if ($estado==0) $eliminar+=$conteo;
		break;
		}
	case 4:
		{
		if($estado==0) $seleccion+=$conteo;
		}
	}	
	$rsi->Movenext();
	} 	

?>
