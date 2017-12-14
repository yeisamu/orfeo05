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


error_reporting( 7 ); 
$krdold = $krd;
session_start(); 

// $_SESSION['numeroExpediente']=0;
// $_SESSION['nombreExpediente']=0;
// $_POST['nombreExpediente']=true;
// $_POST['numeroExpediente']=false;
//$_SESSION["i"]=0;

//include ("common.php");

$ruta_raiz = ".."; 	
if( !$krd ){
   $krd = $krdold;
}

if (!$nurad) $nurad= $record_id;

if ($record_id){
   $record_id = $rad;
}

if (!isset($_SESSION['dependencia']))	include "$ruta_raiz/rec_session.php";

include_once( "$ruta_raiz/include/db/ConnectionHandler.php" );
$db = new ConnectionHandler( "$ruta_raiz" );

include_once( "$ruta_raiz/include/tx/Historico.php" );
include_once( "$ruta_raiz/include/tx/ExpedienteMultiple.php" );

//$db->conn->debug=true;
$record_id = $whereFiltro;
$whereFiltro2=  substr($whereFiltro2,0,(strlen($whereFiltro2)-1));
$expediente = new Expediente( $db );

// Inserta el radicado en el expediente
if( $funExpediente == "INSERT_EXP" )
{ 
   // Paso de variable de js a php
   $_POST['numeroExpediente'] = $numExpHidden;
 
   // Consulta si el radicado est� incluido en el expediente.
   // by skina  $arrExpedientes = $expediente->expedientesRadicado( $_GET['nurad'] );
   $arrExpedientes = $expediente->expedientesRadicado($whereFiltro2);
   /* Si el radicado esta incluido en el expediente digitado por el usuario.
   * != No identico no se puede poner !== por que la funcion array_search 
   * tambien arroja 0 o "" vacio al ver que un expediente no se encuentra
   */ 

   foreach ( $arrExpedientes as $line_num => $line){
      if ($line == $_POST['numeroExpediente']) {
         print '<center><hr><font color="red">El radicado ya est&aacute; incluido en el expediente.</font><hr></center>';
      }else {
         $resultadoExp = $expediente->insertar_expediente( $_POST['numeroExpediente'], $whereFiltro2, $dependencia, $codusuario, $usua_doc );
         if( $resultadoExp == 1 )
         {
            $observa = "Incluir radicado en Expediente ".$numExpHidden;

            //include_once "$ruta_raiz/include/tx/Historico.php";

            // $radicados[] = $_GET['nurad'];
            $radicados[] = $whereFiltro2;
            //$tipoTx = 53;
            $tipoTx = 62;
            $Historico = new Historico( $db );

            if (strpos($radicados[0],',')){

	       //Si trae coma, trae varios radicados 
	       $tmp = explode(',',$radicados[0]);
	       $counter = count($tmp);
	       $i=0;
               $rad_array=array();
	       while($i<$counter){
                  $rad_array[0]=$tmp[$i];
	          //$Historico->insertarHistoricoExp( $_POST['numeroExpediente'], $rad_array, $dependencia, $codusuario, $observa, $tipoTx, "0" );
                  $i++; 
               }
            }else{
                  $rad_array=array();
                  $rad_array[0]=$whereFiltro2;
	          //$Historico->insertarHistoricoExp( $_POST['numeroExpediente'], $rad_array, $dependencia, $codusuario, $observa, $tipoTx, "0");
            }    
?>
            <script language="JavaScript">
               alert("Radicado(s) insertado correctamente, la ventana se cerrara automaticamente, No olvide anexar su observacion y dar click en realizar!");
               //opener.regresar();
               window.close();
            </script>  
<?php
         }else{
            print '<hr><font color=red>No se anexo este radicado al expediente. Verifique que el numero del expediente exista e intente de nuevo.</font><hr>';	    
         }
      }
   }
}
?>
<html>
<head>
<title>Incluir en Expediente</title>
<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">

<!-- Autocompletar para el nombre de expediente -->
<link rel="stylesheet" href="../js/jquery-ui/development-bundle/themes/base/jquery.ui.all.css">
<script src="../js/jquery-ui/development-bundle/jquery-1.7.1.js"></script>
<script src="../js/jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
<script src="../js/jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
<script src="../js/jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
<script src="../js/jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>
<script type="text/javascript" src="../ajax/js/ajax.js"></script> 
<link rel="stylesheet" href="../js/jquery-ui/development-bundle/demos/demos.css">
<style>
   .ui-autocomplete-loading { background: white url('../js/jquery-ui/development-bundle/demos/autocomplete/images/ui-anim_basic_16x16.gif') right center no-repeat; }
</style>

<script language="JavaScript">
   var nomExp="xyz ";
      $(function() {
         var cache = {},
             lastXhr;
         $( "#nombreExpediente" ).autocomplete({
            minLength: 3,
            select: seleccion,
            source: function( request, response ) {
               var term = request.term;
               if ( term in cache ) {
                  response( cache[ term ] );
                  return;
               }

               lastXhr = $.getJSON( "search.php", request, function( data, status, xhr ) {
                  cache[ term ] = data;
                  if ( xhr === lastXhr ) {
                     response( data );
                  }
               });
            }
         });
      });

   function seleccion(event, ui){
      var nomExp;  

      // Capta informacion del expediente seleccionado  
      nomExp = ui.item.value;

      // Funcion en ajax  para traer numero del expediente seleccionado
      $.ajax({
         data: "nomExp="+nomExp+"", //parametro a enviar para obtenerlo en search2.php
         type: "GET",
         dataType: "json",  
         url: "search2.php",
         success: function(data){
            results(data);
         }
      });
   } 

   function results(data){
      // Numero extraido de la DB para ese nombre
      document.insExp.numeroExpediente.value = data.EXP_NUM.substring(0,17);
      //Submit debido a que estan todos los datos
      document.insExp.submit();
   }
</script>

<script language="JavaScript">
   function validarNumExpediente(){
      // document.insExp.numeroExpediente.value ='<?=$numeroExpediente?>';
      numExpediente = document.getElementById( 'numeroExpediente' ).value;
      nomExpediente = document.getElementById( 'nombreExpediente' ).value;

      // Valida que se haya digitado el nombre del expediente
      // anho dependencia serie subserie consecutivo E
      if( (numExpediente.length != 0 && numExpediente != "") || ( nomExpediente.length != 0 && nomExpediente != "") ){
         insertarExpedienteVal = true;
      }else if( (numExpediente.length == 0 || numExpediente == "") || ( nomExpediente.length != 0 && nomExpediente != "") ){
         alert( "Error. Debe especificar el nombre de un expediente." );
         document.getElementById( 'numeroExpediente' ).focus();
         insertarExpedienteVal = false;
      }

      if( insertarExpedienteVal == true ){
         // alert("Hace el submit");
         document.insExp.submit();
         // alert("Hice el submit");
      }
   }

   function confirmaIncluir(){
      document.getElementById( 'funExpediente' ).value = "INSERT_EXP";
      document.getElementById( 'numExpHidden' ).value = document.getElementById( 'numeroExpediente' ).value;
      document.insExp.submit();
   }
</script>
</head>

<body bgcolor="#FFFFFF" onLoad="document.insExp.numeroExpediente.focus();">

<form method="post" action="<?php print $encabezado; ?>" name="insExp">

<input type="hidden" name='funExpediente' id='funExpediente' value="" >
<input type="hidden" name='confirmaIncluirExp' id='confirmaIncluirExp' value="" >
<input type="hidden" name='numExpHidden' id='numExpHidden' value="" >

<table border=0 width=70% align="center" class="borde_tab" cellspacing="1" cellpadding="0">        
   <tr align="center" class="titulos2">
      <td height="15" class="titulos2" colspan="2">INCLUIR EN EL EXPEDIENTE</td>
   </tr>
</table>

<table width="70%" border="0" cellspacing="1" cellpadding="0" align="center" class="borde_tab">
</table>

<table border=0 width=70% align="center" class="borde_tab">
   <tr align="center">
      <td class="titulos5" align="left" nowrap>Numero del Expediente</td>
      <td class="titulos5" align="left">
      <input type="text" name="numeroExpediente" id="numeroExpediente" value="<?php print $_POST['numeroExpediente']; ?>" size="30">
      </td>
   </tr>
   <tr align="center">
      <td class="titulos5" align="left" nowrap>
         <label for="nombreExpediente">Nombre de la carpeta</label>
      </td>
      <td class="titulos5" align="left">
         <input type="text" name="nombreExpediente" id="nombreExpediente" size="30" value="<?php print $_POST['nombreExpediente']; ?>">
      </td>
   </tr>
</table>

<table border=0 width=70% align="center" class="borde_tab">
   <td width="33%" height="25" class="listado2" align="center">
   <center>
      <input name=btnIncluirExp" type=button class=botones_funcion id=btnIncluirExp onClick="validarNumExpediente();" value=Incluir_en_Exp>
   </center>
</td>
 
<?
if ( ($expediente->existeExpediente( $_POST['numeroExpediente'] ) !== 0 )){
   // By skina para ciac
   // Busco expediente por parametro 1
/*   if ($_POST['nombreExpediente'] ){

      $nom_expe=strtoupper($_POST['nombreExpediente']);
      //$db->conn->debug=true;
      $sql_nomEx="select sgd_exp_numero from sgd_sexp_secexpedientes where upper(sgd_sexp_parexp1) like '%".$nom_expe."%'";
      //echo   $sql_nomEx;
      $rs_nomEx=$db->conn->Execute($sql_nomEx);
      $Rs_esp=$rs_nomEx;
      $numeroExpediente=$rs_nomEx->fields['SGD_EXP_NUMERO'];
      $_POST['numeroExpediente']= $numeroExpediente;
      $_SESSION['numeroExpediente']= $numeroExpediente;
//      $_SESSION['numeroExpediente']= $_POST['numeroExpediente'];
      //echo "num $numeroExpediente";*/
?>

      <!--script>document.insExp.numeroExpediente.value ='<?//=$numeroExpediente?>';
      </script-->
<?
//   }
?>

<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
      <center class="titulosError2">
        ESTA SEGURO DE INCLUIR ESTOS RADICADOS EN EL EXPEDIENTE: 
      </center>
      <B>
        <center class="style1"><b><?php print $numeroExpediente; ?></b></center>
      </B>
      <div align="justify"><br>
        <strong><b>Recuerde:</b>No podr&aacute; modificar el numero de expediente si hay
        un error en el expediente, m&aacute;s adelante tendr&aacute; que excluir este radicado del
        expediente y si es el caso solicitar la anulaci&oacute;n del mismo. Adem&aacute;s debe
        tener en cuenta que tan pronto coloca un nombre de expediente, en Archivo crean
        una carpeta f&iacute;sica en el cual empezaran a incluir los documentos
        pertenecientes al mismo.
        </strong>
      </div>
    </td>
  </tr>
</table>
<table border=0 width=70% align="center" class="borde_tab">
  <tr align="center">
    <td width="33%" height="25" class="listado2" align="center">
	  <center>
	    <input name="btnConfirmar" type="button" onClick="confirmaIncluir();" class="botones_funcion" value="Confirmar">
	  </center>
    </td>
	<td width="33%" class="listado2" height="25">
	<center><input name="cerrar" type="button" class="botones_funcion" id="envia22" onClick=" window.close();" value=" Cerrar "></center></TD>
	</tr>
</table>
<?	
}else if ( $_POST['numeroExpediente'] != "" && ( $expediente->existeExpediente( $_POST['numeroExpediente'] ) === 0 ) ){
?>
<script language="JavaScript">
   alert( "Error. El nombre del Expediente en el que desea incluir este radicado \n\r no existe en el sistema. Por favor verifique e intente de nuevo." );
   document.getElementById( 'numeroExpediente' ).focus();
</script>
<?php
}
?>
</form>
</body>
</html>
