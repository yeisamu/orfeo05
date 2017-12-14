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

:
/**
* Administrador de Transferencias documentales
* Sistema de gestion Documental ORFEO.
* Permite setear el estado siguiente del expediente
* 
*/

    session_start();
    $ruta_raiz = "..";

    include_once("$ruta_raiz/include/db/ConnectionHandler.php");
    $db = new ConnectionHandler("$ruta_raiz");

    define('ADODB_ASSOC_CASE', 1);
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    //$db->conn->debug=true;
	
    $encabezado = session_name()."=".session_id()."&krd=$krd";
   
    $status=$_GET["status"]; 

    //desarmo el arreglo de expedientes seleccionados
    if($checkValue)
    {
        $num = count($checkValue);
        $i = 0;
	//$setFiltroSelect="'";
        while ($i < $num)
        {
                $record_id = key($checkValue);
                $setFiltroSelect .= $record_id ;
                $radicadosSel[] = $record_id;
                if($i<=($num-2))
                {
                        $setFiltroSelect .= "','";
                }
		//else $setFiltroSelect.="'";
        next($checkValue);
        $i++;
        }

        if ($radicadosSel)
        {
                
		$whereFiltro = " where sgd_exp_numero in ('$setFiltroSelect')";
        }
    }
    //Armo el mensaje a mostrar, haciendo un switch con el estado
    switch($status)
    {
    case 1: $next="Transferido a Central"; break;
    case 2: $next="Transferido a Historico"; break;
    case 3: $next="Eliminado"; break;
    case 4: $next="Seleccionado"; break;
    break;
    }
    //Ejecuto la actualizacion
    $query_up="update sgd_sexp_secexpedientes set sgd_sexp_estado=$status ".$whereFiltro;
    $rs=$db->conn->query($query_up);
    
    if(!$rs->EOF)  $msj="No se modifico el estado de $setFiltroSelect, por favor verifique"; 
    else { 
	$msj= "Se modifico el estado de $setFiltroSelect exitosamente, el estado actual es: $next"; 
	//Insertamos historico de expediente (pestana expediente)
	include "$ruta_raiz/include/tx/Historico.php";
	$hist = new Historico($db);
	//Codigo  de la transaccion  cambio de estado expediente
	$codTx = 50;
	foreach($radicadosSel as $noExp)
        {
	//buscamos el 1er radicado
	$query_rad = "select radi_nume_radi from sgd_exp_expediente where sgd_exp_numero = '$noExp'";
    	$rs_rad=$db->query($query_rad);
	$radicados[0] = $rs_rad->fields["RADI_NUME_RADI"];
	$observa= "Se modifico el estado de $noExp exitosamente el estado actual es: $next";
	//$hist->insertarHistorico($radicados,  $dependencia , $codusuario, $dependencia, $codusuario, $observa, $codTx);
	$hist->insertarHistoricoExp( $noExp, $radicados, $dependencia, $codusuario, $observa, $codTx, 0 );	
	}
    }
    ?>
    <html>
    <head>
    <title>Modificar estado de transferencia</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link rel="stylesheet" href="<?=$ruta_raiz; ?>/estilos/orfeo.css">
    <body bgcolor="#FFFFFF">

    <form name=cambiar method='post' action='alerta.php?<?=$encabezado?>'>
    <table border=0 width 100% cellpadding="0" cellspacing="5" class="borde_tab">
    <tr><TD class=titulos2 align="center" colspan="5" > <?=$msj?></td><tr>
    <tr><TD class=titulos5 align="center" colspan="5" > Asegurese de realizar todas las labores necesarias para el cambio de estado: transferir, eliminar, seleccionar, etc. Este procedimiento no realiza ninguna de estas labores, el sistema realizara el cambio de estado para posteriores consultas.</td><tr>
    <tr align="center"><td><input type=submit value=Regresar name=Regresar align=bottom class=botones id=confirmar></td>
    </tr>
    </table>
    </form>
    </body>
    </html>
