<?php
/*
  V4.52 10 Aug 2004  (c) 2000-2004 John Lim (jlim@natsoft.com.my). All rights reserved.
  Re  library license.
  Whenever there is any discrepancy between the two licenses,
  the BSD license will take precedence.

  Some pretty-printing by Chris Oxenreider <oxenreid@state.net>
*/

// specific code for tohtml

GLOBAL $gSQLMaxRows,$gSQLBlockRows, $HTTP_GET_VARS;



$gSQLMaxRows = 1000; // max no of rows to download
$gSQLBlockRows=20; // max no of rows per table block



// RecordSet to HTML Table
//------------------------------------------------------------
// Convert a recordset to a html table. Multiple tables are generated
// if the number of rows is > $gSQLBlockRows. This is because
// web browsers normally require the whole table to be downloaded
// before it can be rendered, so we break the output into several
// smaller faster rendering tables.
//
// $rsTmp: the recordset
// $ztabhtml: the table tag attributes (optional)
// $zheaderarray: contains the replacement strings for the headers (optional)
//
//  USAGE:
//	include('adodb.inc.php');
//	$db = ADONewConnection('mysql');
//	$db->Connect('mysql','userid','password','database');
//	$rsTmp = $db->Execute('select col1,col2,col3 from table');
//	rs2html($rsTmp, 'BORDER=2', array('Title1', 'Title2', 'Title3'));
//	$rsTmp->Close();
//
// RETURNS: number of rows displayed

function rs2html(&$db,&$rsTmp,$ztabhtml=false,$zheaderarray=false,$htmlspecialchars=true,$echo = true, $toRefVar,$orderTipo,$ordenActual,$rutaRaiz,$checkAll=false, $checkTitulo=false,$descCarpetasGen,$descCarpetasPer)
{
if(strtoupper(trim($orderTipo))!="DESC")
{
	$orderTipo = "asc";
}else
{
	$orderTipo = "desc";
}
$s =''; $rows=0;$docnt = false;
GLOBAL $gSQLMaxRows,$gSQLBlockRows,$HTTP_GET_VARS,$HTTP_SESSION_VARS;
	if (!$rsTmp) {
		printf(ADODB_BAD_RS,'rs2html');
		return false;
	}
	if (! $ztabhtml) $ztabhtml = " WIDTH='98%'";
	//else $docnt = true;
	$typearr = array();
	$ncols = $rsTmp->FieldCount();

	$hdr = "<TABLE COLS=$ncols $ztabhtml><tr>\n\n";
	$img_no = $ordenActual;
	$iRad = 0;
	for ($i=0; $i < $ncols; $i++)
	{
		$field = $rsTmp->FetchField($i);
		if ($zheaderarray) $fname = $zheaderarray[$i];
		else $fname = htmlspecialchars($field->name);
		$typearr[$i] = $rsTmp->MetaType($field->type,$field->max_length);
			//print " $field->name $field->type $typearr[$i] ";
		if (strlen($fname)==0) $fname = '&nbsp;';
		if(isset($hor))
		{
			$order = $i -$hor;
			$hor = 0;
		}else
		{
	   $order = $i;
		}
		$order = $i;
		$encabezado = $toRefVar.$order;
		if($fname == "HID_RADI_LEIDO")
		{
			$campoLeido = $i;
		}
		if($fname == "IMG_Numero Radicado")
		{
			$iRad = $i;
		}
		$prefijo = substr($fname,0,4);
	switch(substr($fname,0,4))
		{
			case 'CHU_':
				break;
			case 'CHR_':
				break;
			case 'CHK_':
				break;
			case 'IDT_';
				$fname = substr($fname,4,20);
				break;
			case 'IMG_';
				$fname = substr($fname,4,20);
				break;
			case 'DAT_':
				$fname = substr($fname,4,20);
				break;
			case 'HOR_':
				$hor = 1;
				break;
			case 'HID_':
				$hor = 1;
				break;
		}
		if($prefijo!="HID_" AND $prefijo!="CHU_" AND $prefijo!="CHR_" AND $prefijo!="CHK_" AND $prefijo!="HOR_")
		{
			$hdr .= "<Th class=titulos3><a href='".$_SERVER['PHP_SELF']."?$encabezado&orden_cambio=1' aria-label='Ordenar por $fname' title='Ordenar por $fname' alt='Ordenar por $fname'><span class=titulos3>";
			if($img_no==$i)
				{
					$hdr .= "<img src=$rutaRaiz/iconos/flecha$orderTipo.gif alt='Listado ordenado por esta columna' border=0>";
				}
                                //correcciones de ortografia que no afectan los nombres de las columnas
                                $fname=($fname=='Numero Radicado')?"Número Radicado":$fname;
                                $fname=($fname=='Numero Radicacion')?"Número Radicación":$fname;
                                $fname=($fname=='Dias Restantes')?"Días Restantes":$fname;
                                $fname=($fname=='Descripcion')?"Descripción":$fname;
                                $fname=($fname=='Fecha Envio')?"Fecha Envío":$fname;
                                $fname=($fname=='FECHA ENVIO')?"Fecha Envío":$fname;
                                $fname=($fname=='Fecha Transaccion')?"Fecha Transacción":$fname;
                                $fname=($fname=='Empresa de Envio')?"Empresa de Envío":$fname;
                                $fname=($fname=='Tipo Transaccion')?"Tipo Transacción":$fname;
                                $fname=($fname=='Direccion')?"Dirección":$fname;
                                $fname=($fname=='Observacion')?"Observación":$fname;
                                $fname=($fname=='Valor de envio')?"Valor de Envío":$fname;
                                $fname=($fname=='Pais')?"País":$fname;
                                $fname=($fname=='Fecha Impresion')?"Fecha Impresión":$fname;
                                $fname=($fname=='DESTINATARIO')?"Destinatario":$fname;
                                $fname=($fname=='NOMBRE')?"Nombre":$fname;
                                $fname=($fname=='USUARIO')?"Usuario":$fname;
                                $fname=($fname=='DEPENDENCIA')?"Dependencia":$fname;
                                $fname=($fname=='Fecha Devolucion')?"Fecha Devolución":$fname;
                                $fname=($fname=='Usuario Realiza Devolucion')?"Usuario Realiza Devolución":$fname;
                                $fname=($fname=='Tiempo de Espera (Dias)')?"Tiempo de Espera (Días)":$fname;
			$hdr .= "$fname</span></a></Th>";
		}
		else
		{
            // by skina (es necesario corregir esto)
            $imagenes=$_SESSION["imagenes"];

			if(substr($fname,0,4)=="CHU_")
			{
				$hdr .= "<Td class=titulos3 width=1%><center><img src=$rutaRaiz/$imagenes/estadoDoc.gif border=0 align=left width=130 height=32 alt='Imagen con estados del documento, dividida en 4 partes con valores de izquierda a derecha anexado,radicado,impreso,enviado'></Td>";
			}
			if(substr($fname,0,4)=="CHR_")
			{
			 $hdr .= "<TH class=titulos3 width=1%><center></TH>";
			}
			if(substr($fname,0,4)=="CHK_")
			{
			if($checkAll==true) $valueCheck = " checked "; else $valueCheck = "";
			if($checkTitulo==true)
			{
			 $fname = "<center><input type=checkbox class='chkrow' name=checkAll value=checkAll onClick='markAll();' $valueCheck title='Active esta casilla para seleccionar todos los adicados encontrados'></center>";
			}
			else
			{
			 $fname = " ";
			}
/*			$hdr .= "<TH class=titulos2 width=1%>$fname</TH>"; */
			if (!isset($fTitulo)) {$fTitulo =""; $hdr .= "<TH class=titulos3 width=1%>$fTitulo $fname</TH>";} else $hdr .= "<TH class=titulos2 width=1%>$fTitulo $fname</TH>";
			}
		}
	}
	$hdr .= "\n</tr>";
	if ($echo) print $hdr."\n\n";
	else $html = $hdr;
	// smart algorithm - handles ADODB_FETCH_MODE's correctly by probing...
	$numoffset = isset($rsTmp->fields[0]) ||isset($rsTmp->fields[1]) || isset($rsTmp->fields[2]);
	$ii = 0;
	while (!$rsTmp->EOF)
	{
	  if($ii==0)
		{
			$class_grid = "listado1";
			$ii=1;
		}
		else
		{
		  $class_grid = "listado2";
			$ii = 0;
		}
		$s .= "<TR class=$class_grid valign=top>\n";
			if (isset($rsTmp->fields["HID_RADI_LEIDO"])) $estadoRad = $rsTmp->fields["HID_RADI_LEIDO"]; else $estadoRad = "";
			$radicado = $rsTmp->fields[$iRad];
			if(isset($radicado) && strlen($radicado) > 13) include("$rutaRaiz/tx/imgRadicado.php");
			if($estadoRad==1)
			{
				$radFileClass = "leidos";
			}else
			{
				$radFileClass = "no_leidos";
			}
		if (strlen(trim($estadoRad)) == 0)
			$radFileClass = "leidos";
		for ($i=0; $i < $ncols; $i++)
		{
		  $special = "no";

			if ($i===0) $v=($numoffset) ? $rsTmp->fields[0] : reset($rsTmp->fields);
			else $v = ($numoffset) ? $rsTmp->fields[$i] : next($rsTmp->fields);
			$field = $rsTmp->FetchField($i);
			if (isset($rsTmp->fields[($i+1)])) $vNext = $rsTmp->fields[($i+1)];
			if (isset($rsTmp->fields[($i+2)])) $vNext1 = $rsTmp->fields[($i+2)];
			$fname = substr($field->name,0,4);
			$noCheckjDevolucion = "";
			switch($fname)
			{
			 case 'CHU_';
				$chk_nomb = substr($field->name,4,20);
				$chk_value = $v;
				$valVNext = 0;
				if ($vNext ==99)  $valVNext = 99;
				if ($vNext ==0 OR $vNext ==NULL)  {$valVNext = 97;} else {if ($vNext > 0)  $valVNext = 98;}
					$fecha_dev  = $vNext1;
				switch($valVNext)
				{
				case 99:
				$v =	"<img src='$rutaRaiz/$imagenes/docDevuelto_tiempo.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
				break;
				case  98:
				$v =	"<img src='$rutaRaiz/$imagenes/docDevuelto.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
					break;
				case 97:
					$fecha_dev = $rsTmp->fields["HID_SGD_DEVE_FECH"];
					if($rsTmp->fields["HID_DEVE_CODIGO1"]==99)
					{
						$v =	"<img src='$rutaRaiz/$imagenes/docDevuelto_tiempo.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Devolucion por Tiempo de Espera'>";
						$noCheckjDevolucion = "enable";
						break;
					}
					if($rsTmp->fields["HID_DEVE_CODIGO"]>=1 and $rsTmp->fields["HID_DEVE_CODIGO"]<=98)
					{
						$v =	"<img src='$rutaRaiz/$imagenes/docDevuelto.gif'  border=0 alt='Fecha Devolucion :$fecha_dev' title='Fecha Devolucion :$fecha_dev'>";
						$noCheckjDevolucion = "disable";
						break;
					}
				switch($v)
				{

					case 2;
					$v = "<img src=$rutaRaiz/$imagenes/docRadicado.gif alt='Este documento se le ha asignado un radicado' border=0>";
					break;
					case 3;
					$v = "<img src=$rutaRaiz/$imagenes/docImpreso.gif alt='Este documento se le ha asignado el estado de impreso' border=0>";
					break;
					case 4;
					$v =	"<img src=$rutaRaiz/$imagenes/docEnviado.gif alt='Este documento ha sido enviado a su destinanatrio' border=0>";

					break;
				}
			break;
		}
	$special = "si";
	break;
		case 'CHR_';
			$chk_value = $v;
			if ($vNext !=0 AND $vNext !=NULL AND $vNext1 ==3)
			$v = "<img src=$rutaRaiz/$imagenes/check_x.jpg alt='Debe Modificar el Documento para poder reenviarlo'  title='Debe Modificar el Documento para poder reenviarlo' >";
			else
			$v = "<input type=radio name='valRadio' value='$chk_value' class='ebuttons2' title='Boton para seleccionar radicado al cual se le va a asociar la imagen'>";
			$special = "si";
			break;
			case 'CHK_';
			$chk_nomb = substr($field->name,4,20);
			$chk_value = $v;

			if($checkAll==true) $valueCheck = " checked "; else $valueCheck = "";

			if ($noCheckjDevolucion=="disable")
			$v = "<img src=$rutaRaiz/$imagenes/check_x.jpg alt='Debe Modificar el Documento para poder reenviarlo'  title='Debe Modificar el Documento para poder reenviarlo' >";
			else
			$v = "<input type=checkbox class='chkrow' name='checkValue[$chk_value]' title='Radicado $chk_value, Seleccione para realizar tarea' value='$chk_nomb' $valueCheck >";
			$special = "si";
			break;
		case ($fname =='IMG_' or $fname=='IDT_');
			$i_path = $i + 1;
			$fieldPATH = $rsTmp->FetchField($i_path);
			$fnamePATH = strtoupper($fieldPATH->name);
			$pathImagen = $rsTmp->fields[$fnamePATH];
			if($pathImagen)
			{
				$permisos_sql = "SELECT radicado.codi_nivel AS nivel_radicado, usuario.codi_nivel AS nivel_usuario, radicado.radi_usua_actu, 
                                        radicado.radi_depe_actu, radicado.sgd_spub_codigo AS permiso
                                        FROM radicado
                                        INNER JOIN usuario ON (radicado.radi_usua_actu=usuario.usua_codi AND radicado.radi_depe_actu=usuario.depe_codi)
                                        WHERE radicado.radi_nume_radi = '$v'";
                                $resultados = $db->conn->Execute($permisos_sql);
                                $nivel_radicado = $resultados->fields['nivel_radicado'];
                                $nivel_usuario = $resultados->fields['nivel_usuario'];
                                $usuario_actual = $resultados->fields['radi_usua_actu'];
                                $dependencia_actual = $resultados->fields['radi_depe_actu'];
                                $permission = $resultados->fields['PERMISO'];
                                if ((($_SESSION['codusuario']!=$usuario_actual) && ($_SESSION['depecodi']!=$dependencia_actual) && $permission == 1)
                                        || ($nivel_radicado > $nivel_usuario)
                                ) {
                                        $v = "<a href='#' onclick=\"alert('No tiene permiso para acceder')\"><span class=$radFileClass'>$v</span></a>";

                                } else {
                                        $v = "<a href=$rutaRaiz/bodega/$pathImagen><span class=$radFileClass title='Ver Imagen del radicado' aria-label='Abrir imagen del radicado'>$v</span></a>";
			}
		}
			else
			{
			$v = "$v";
			}
			if ($fname == 'IDT_')
			{
				$carpPer = $rsTmp->fields["HID_CARP_PER"];
				$carpCodi = $rsTmp->fields["HID_CARP_CODI"];
				$noHojas = $rsTmp->fields["HID_RADI_NUME_HOJA"];
				#Modificado idrd
				$info_resp = $rsTmp->fields["HID_INFO_RESP"]; 

				/** Icono para los informados que necesitan respuesta
				** Modificado idrd abril 4*/
	
				if($info_resp and $info_resp=='Responder')
					$imginfo = "<img src='$rutaRaiz/images/resp.jpeg' width=18 height=18 alt='$textCarpeta' title='$textCarpeta'>";
				else 
					$imginfo = "";

				if($carpPer==0)
				{
					$nombreCarpeta = $descCarpetasGen[$carpCodi];
				}else
				{
					$nombreCarpeta = "(Personal)".$descCarpetasPer[$carpCodi]."";
				}
				$textCarpeta ="Carpeta Actual: ".$nombreCarpeta . " -- Numero de Hojas :". $noHojas;
				if($rsTmp->fields["HID_EANU_CODIGO"]==2)
				{
					$imgTp = "$rutaRaiz/iconos/anulacionRad.gif";
					$textCarpeta = " ** RADICADO ANULADO ** ".$textCarpeta;
				}else
				{
					if($rsTmp->fields["HID_RADI_TIPO_DERI"]==0 AND $rsTmp->fields["HID_RADI_NUME_DERI"]!=0)
					{
						$imgTp = "$rutaRaiz/iconos/anexos.gif";
					}else{
						$imgTp = "$rutaRaiz/iconos/comentarios.gif";
					}

                    /** �cono que indica si el radicado est� incluido en un expediente.
                      * Fecha de modificaci�n: 30-Junio-2006
                      * Modificador: Supersolidaria
                      */
                    include_once ("$rutaRaiz/include/tx/Expediente.php");
                    $expediente = new Expediente( $db );
                    if( $rsTmp->fields["IDT_Numero Radicado"] != "" )
                    {
                        $arrEnExpediente = $expediente->expedientesRadicado( $rsTmp->fields["IDT_Numero Radicado"] );
                    }
                    else if( $rsTmp->fields["IDT_Numero_Radicado"] != "" )
                    {
                        $arrEnExpediente = $expediente->expedientesRadicado( $rsTmp->fields["IDT_Numero_Radicado"] );
                    }
					// Modificado SGD 20-Septiembre-2007
					if( is_array( $arrEnExpediente ) )
					{
						if( $arrEnExpediente[0] !== 0 )
						{
							$imgExpediente = "<img src='$rutaRaiz/iconos/folder_open.gif' width=18 height=18 alt='Incluido en un expediente' title='Incluido en un expediente'>";
						}
						else
						{
							$imgExpediente = "";
						}
					}
				}
				$imgEstado = "<img src='$imgTp' width=18 height=18 alt='$textCarpeta' title='$textCarpeta'>";
			}else{
				$imgEstado = "";
			}
            /** �cono que indica si el radicado est� incluido en un expediente.
              * Fecha de modificaci�n: 30-Junio-2006
              * Modificador: Supersolidaria
              */
			// if($i ==$iRad)  $v = $imgEstado.$imgRad.$v;
			//if($i ==$iRad)  $v = $imgEstado."&nbsp;".$imgExpediente.$imgRad.$v;
			if(isset($iRad) && $i ==$iRad)
				{
				if ($info_resp and $info_resp="'Responder'")
						$v = $imgEstado."&nbsp;".$imgExpediente."&nbsp;".$imginfo.$imgRad.$v;
				else
					$v = $imgEstado."&nbsp;".$imgExpediente."&nbsp;".$imgRad.$v;
				}
			break;
		case 'DAT_';
			$i_radicado = $i+1;
			$fieldDAT = $rsTmp->FetchField($i_radicado);
			$fnameDAT = $fieldDAT->name;
			// Modificado SGD 21-Septiembre-2007
                                                
			
                        //20170411 Los id de las columnas estan en mayusculas, no se ejecutaba correctamente
                        // uppercase en los formularios de comentarios, pero si en las listas de radicados
                        //$verNumRadicado = trim(strtoupper($rsTmp->fields[$fnameDAT]));
			$verNumRadicado = trim($rsTmp->fields[strtoupper($fnameDAT)]);
			$v = "<a href=".$rutaRaiz."/verradicado.php?verrad=".$verNumRadicado."&".$encabezado." title='Ver informacion del radicado' alt='Ver informacion del radicado' aria-label='Abrir Información del radicado' ><span class=$radFileClass>".$v."</span></a>";
			$special = "si";
			break;
		}
		$type = $typearr[$i];
		switch($type)
		{
		case 'D1':
			if (!strpos($v,':'))
			{
				$s .= "	<TD><span class=$radFileClass>".$rsTmp->UserDate($v,"d-m-Y, H:i") ."&nbsp;</span></TD>\n";
				break;
			}
		case 'T1':
		$s .= "	<TD><span class=$radFileClass>".$rsTmp->UserTimeStamp($v,"d-m-Y, H:I") ."&nbsp;</span></TD>\n";
		break;
		case 'I':
		/*case 'N':
		  if($fname=="CHU_" or $fname=="CHK_")
			$s .= "	<TD align=right>".stripslashes((trim($v))) ."&nbsp;</TD>\n";

			case 'B':
				if (substr($v,8,2)=="BM" ) $v = substr($v,8);
				$mtime = substr(str_replace(' ','_',microtime()),2);
				$tmpname = "tmp/".uniqid($mtime).getmypid();
				$fd = @fopen($tmpname,'a');
				@ftruncate($fd,0);
				@fwrite($fd,$v);
				@fclose($fd);
				if (!function_exists ("mime_content_type")) {
				  function mime_content_type ($file) {
				    return exec("file -bi ".escapeshellarg($file));
				  }
				}
				$t = mime_content_type($tmpname);
				$s .= (substr($t,0,5)=="image") ? " <td><img src='$tmpname' alt='$t'></td>\\n" : " <td><a
				href='$tmpname'>$t</a></td>\\n";
				break;
			*/
			//break;
			default:
				//if ($htmlspecialchars and $special !="si") $v = htmlspecialchars(trim($v));
			$v = stripcslashes(trim($v));
			if (strlen($v) == 0) $v = '&nbsp;';
			if(substr($fname,0,4)!="HID_" AND substr($fname,0,4)!="HOR_"  )
			{
				$s .= "	<TD><span class=$radFileClass>". str_replace("\n",'<br>',$v) ."</span></TD>\n";
			}
			}
		} // for
		$s .= "</TR>\n\n";
		$rows += 1;
		if ($rows >= $gSQLMaxRows) {
			$rows = "<p>Truncated at $gSQLMaxRows</p>";
			break;
		} // switch

		$rsTmp->MoveNext();

	// additional EOF check to prevent a widow header
		if (!$rsTmp->EOF && $rows % $gSQLBlockRows == 0) {

		//if (connection_aborted()) break;// not needed as PHP aborts script, unlike ASP
			if ($echo) print $s . "</TABLE>\n\n";
			else $html .= $s ."</TABLE>\n\n";
			$s = $hdr;
		}
	} // while

	if ($echo) print $s."</TABLE>\n\n";
	else $html .= $s."</TABLE>\n\n";
		if ($docnt) if ($echo) print "<H2>".$rows." Rows</H2>";
		return ($echo) ? $rows : $html;
 }
// pass in 2 dimensional array
function arr2html(&$arr,$ztabhtml='',$zheaderarray='')
{
	if (!$ztabhtml) $ztabhtml = 'BORDER=1';
	$s = "<TABLE $ztabhtml class=t_bordeGris width=98%>";//';print_r($arr);
	if ($zheaderarray)
	{
		$s .= '<TR class=tparr>';
		for ($i=0; $i<sizeof($zheaderarray); $i++)
		{
			$s .= "	<TH>{$zheaderarray[$i]}</TH>\n";
		}
		$s .= "\n</TR>";
	}
	for ($i=0; $i<sizeof($arr); $i++)
	{
		$s .= '<TR class=tparr>';
		$a = &$arr[$i];
		if (is_array($a))
			for ($j=0; $j<sizeof($a); $j++)
			{
				$val = $a[$j];
				if (empty($val)) $val = '&nbsp;';
				$s .= "	<TD>$val</TD>\n";
			}
		else if ($a)
		{
			$s .=  '	<TD>'.$a."</TD>\n";
		} else $s .= "	<TD>&nbsp;</TD>\n";
		$s .= "\n</TR>\n";
	}
	$s .= '</TABLE>';
	print $s;
}
?>
