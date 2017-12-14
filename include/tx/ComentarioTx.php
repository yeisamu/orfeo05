<?
	/** Archivo que se utiliza para colocar informacion de acciones realizadas en el codigo html 
	  * @$numRegs  int 	Numero de registros afectados en la transaccion
	  * @$varQuery String 	Consulta utilizada
	  * @$pOrfeo   int	Numero de secuencia utilizada para estos comentarios
		*/
	if(!isset($pOrfeo)) $pOrfeo="";
	if(!isset($cNumRegs)) $cNumRegs="";
	if(!isset($cVarQuery)) $cVarQuery="";
	if(!isset($numRegs)) $numRegs="";
	if(!isset($varQuery)) $varQuery="";
	$pOrfeo++;
	if($numRegs) $cNumRegs = " Registros $numRegs \n";
	if($varQuery) $cVarQuery = "Consulta: $varQuery \n";
echo "<!-- \n************************************************************************\n (Dev$pOrfeo)$comentarioDev  \n $cNumRegs $cVarQuery ************************************************************************ -->\n ";
$varQuery="";
?>
