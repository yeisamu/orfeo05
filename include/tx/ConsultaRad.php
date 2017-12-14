<?php 
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
require_once("$ruta_raiz/class_control/TipoDocumento.php");
 
/**
 * ConsultaRad es la clase encargada de consultar datos sobre numeros de radicaods. Inicialmente creada para las consultas Web.
 * @author      Jairo H Losada C.
 * @version     3.0
 */

class ConsultaRad {
// Bloque de atributos que corresponden a los campos de la tabla anexos

  /**
   * Variable que se corresponde con su par, uno de los campos de la tabla anexos
   * @var numeric
   * @access public
   */
var $numeroRadicado;
  /**
   * Variable que contiene el numero de Radicado
   * @var numeric
   * @access public
   */
var $idRadicado;
  /**
   * Variable que se corresponde a la clave generada en el numero de radicado.
   * @var string
   * @access public
   */

var $db;
 /**
   * Gestor de las transacciones con la base de datos
   * @var ConnectionHandler
   * @access public
   */




/** 
* Constructor encargado de obtener la conexion
* @param	$db	ConnectionHandler es el objeto conexion
* @return   void
*/
function ConsultaRad($db) {
	$this->db = $db;
}

 /** 
     * Busca la clave de entrada del numero de radicado buscado. 
     * Retorna la clave del radicado
     * que recibe como parámetros
     * @param $radicado   es el código del radica que contien el anexo
     * @param $idRad      es el Id asignado al Radicado.
     * @return Retorna la clave del numero de radicado.
     */

function idRadicado($radicado) {
	$q="select 
		 RADI_NUME_RADI
	  from 
		 radicado 
		where RADI_NUME_RADI='$radicado' ";
	$rs=$this->db->query($q);
	$idRad = 0;
	if 	(!$rs->EOF) 
 		{
			$idRad = $this->sgd_rem_destino=$rs->fields["RADI_NUME_RADI"];
		}
	$this->idRadicado = $idRad;
	return $idRad;
}


/** 
     * Retorna el valor string correspondiente al radicado de salida generado al radicar el anexo
     * @return   string
     */

function get_idRadicado(){
	return  $this->idRadicado;
}

function serieRadicado($radicado){

  $radicado = explode(",", $radicado);
  for ($i=0;$i<count($radicado);$i++) {
      $radicado[$i] = "'".$radicado[$i]."'";
  }
  
  $radicado = implode(',', $radicado);
  $query  = "select s.sgd_srd_codigo AS SERIE ";
  $query .= "from SGD_RDF_RETDOCF mf, SGD_MRD_MATRIRD m, DEPENDENCIA d, SGD_SRD_SERIESRD s, SGD_SBRD_SUBSERIERD su, SGD_TPR_TPDCUMENTO t ";
  $query .= "where d.depe_codi = mf.depe_codi and s.sgd_srd_codigo = m.sgd_srd_codigo and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ";
  $query .= "su.sgd_srd_codigo = m.sgd_srd_codigo and t.sgd_tpr_codigo = m.sgd_tpr_codigo and mf.sgd_mrd_codigo = m.sgd_mrd_codigo and ";
  $query .= "mf.radi_nume_radi in ($radicado)";

  $rs = $this->db->conn->query($query);
  if ($rs->EOF){ $serieRadicado = 0; }
  else{ $serieRadicado = $rs->fields['SERIE']; }
  
  return $serieRadicado;
}

function subserieRadicado($radicado){
  
  $radicado = explode(",", $radicado);
  for ($i=0;$i<count($radicado);$i++) {
      $radicado[$i] = "'".$radicado[$i]."'";
  }

  $radicado = implode(',', $radicado);
  $query  = "select su.sgd_sbrd_codigo AS SUBSERIE ";
  $query .= "from SGD_RDF_RETDOCF mf, SGD_MRD_MATRIRD m, DEPENDENCIA d, SGD_SRD_SERIESRD s, SGD_SBRD_SUBSERIERD su, SGD_TPR_TPDCUMENTO t ";
  $query .= "where d.depe_codi = mf.depe_codi and s.sgd_srd_codigo = m.sgd_srd_codigo and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ";
  $query .= "su.sgd_srd_codigo = m.sgd_srd_codigo and t.sgd_tpr_codigo = m.sgd_tpr_codigo and mf.sgd_mrd_codigo = m.sgd_mrd_codigo and ";
  $query .= "mf.radi_nume_radi in ($radicado)";

  $rs = $this->db->conn->query($query);
  if ($rs->EOF){ $subserieRadicado = 0; }
  else{ $subserieRadicado = $rs->fields['SUBSERIE']; }
  
  return $subserieRadicado;
}

function tipoDocRadicado($radicado){

  $radicado = explode(",", $radicado);
  for ($i=0;$i<count($radicado);$i++) {
      $radicado[$i] = "'".$radicado[$i]."'";
  }
  
  $radicado = implode(',', $radicado);
  $query  = "select t.sgd_tpr_codigo AS TIPO_DOCUMENTO ";
  $query .= "from SGD_RDF_RETDOCF mf, SGD_MRD_MATRIRD m, DEPENDENCIA d, SGD_SRD_SERIESRD s, SGD_SBRD_SUBSERIERD su, SGD_TPR_TPDCUMENTO t ";
  $query .= "where d.depe_codi = mf.depe_codi and s.sgd_srd_codigo = m.sgd_srd_codigo and su.sgd_sbrd_codigo = m.sgd_sbrd_codigo and ";
  $query .= "su.sgd_srd_codigo = m.sgd_srd_codigo and t.sgd_tpr_codigo = m.sgd_tpr_codigo and mf.sgd_mrd_codigo = m.sgd_mrd_codigo and ";
  $query .= "mf.radi_nume_radi in ($radicado)";

  $rs = $this->db->conn->query($query);
  if ($rs->EOF){ $tipoDocRadicado = 0; }
  else{ $tipoDocRadicado = $rs->fields['TIPO_DOCUMENTO']; }
  
  return $tipoDocRadicado;
}

}


?>
