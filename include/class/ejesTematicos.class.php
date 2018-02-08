<?PHP
/**
** Clase donde gestionamos informacion referente a los ejes tematicos
 *
 * @copyright Sistema de Gestion Documental ORFEO
 * @version 1.0
 * @author Desarrollado por Ing. Camilo Pintor para el Instituto Nacional para Ciegos - INCI.
 */
class EjTema
{
private $cnn;	//Conexion a la BD.
private $flag;	//Bandera para usos varios.
private $vector;//Vector con los datos.

/**
 * Constructor de la classe.
 *
 * @param ConnectionHandler $db
 */
function __construct($db)
{
	$this->cnn = $db;
	$this->cnn->conn->SetFetchMode(ADODB_FETCH_ASSOC);
}

/**
 * Agrega un nuevo Motivo de Devolucion.
 *
 * @param array $datos  Vector asociativo con todos los campos y sus valores.
 * @return boolean $flag False on Error /
 */
function SetInsDatos($datos)
{
	return $this->flag;
}

/**
 * Modifica datos a un Motivo de devolución.
 *
 * @param array $datos  Vector asociativo con todos los campos y sus valores.
 * @return boolean $flag False on Error /
 */
function SetModDatos($datos)
{	
	return $this->flag;
}

/**
 * Elimina un sector.
 *
 * @param  int $dato  Id del causal a eliminar.
 * @return boolean $flag False on Error /
 */
function SetDelDatos($dato)
{
	$sql = "SELECT COUNT(*) FROM SGD_EJE_TEMA WHERE SGD_TEMA_CODIGO =".$dato;
	if ($this->cnn->GetOne($sql) > 0)
	{
		$this->flag = 0;
	}
	else 
	{
		$this->cnn->BeginTrans();
		$ok = $this->cnn->conn->Execute('DELETE FROM SGD_EJE_TEMA WHERE SGD_TEMA_CODIGO='.$dato);
		if($ok)
		{
			$this->cnn->CommitTrans();
			$this->flag = true;
		}
		else
		{
			$this->cnn->RollbackTrans() ;
			$this->flag = false;
		}
	}
	return $this->flag;
}

/**
 * Retorna un combo con las opciones de la tabla vector todos los tipos de radicados.
 * 
 * @param  boolean Habilita/Deshabilita la 1a opcion SELECCIONE.
 * @param  boolean Habilita/Deshabilita la validacion Onchange hacia una funcion llamada Actual().
 * @return string Cadena con el combo - False on Error.
 */
/*function Get_ComboOpc($dato1, $dato2)
{	
	$sql = "SELECT SGD_TEMA_DESC AS DESCRIP, SGD_TEMA_CODIGO AS ID  FROM SGD_EJE_TEMA ORDER BY 1";
	$rs = $this->cnn->Execute($sql);
	if (!$rs)
		$this->flag = false;
	else
	{
		($dato1) ? $tmp1="0:&lt;&lt;SELECCIONE&gt;&gt;" : $tmp1 = false;
		($dato2) ? $tmp2="Onchange='Actual()'" : $tmp2 = '';
		$this->flag = $rs->GetMenu('slc_cmb2',false,$tmp1,false,false,"id='slc_cmb2' class='select' $tmp2");
		unset($rs); unset($tmp1); unset($tmp2);
	}
	return $this->flag;
}*/

/**
 * Retorna un vector.
 *
 * @return Array Vector numérico con los datos - False on error.
 */
function Get_ArrayDatos($id)
{	
	$sql = "SELECT SGD_TEMA_CODIGO FROM SGD_EJE_TEMA ORDER BY 1";
	$rs = $this->cnn->conn->Execute($sql);
	if (!$rs)
		$this->vector = false;
	else
	{
		$this->vector = $this->cnn->conn->GetAll($sql);	
		unset($rs); unset($sql);
	}
	return $this->vector;
}
}
?>
