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


error_reporting(0);
	if(isset($var_filename))
	{
		if(!file_exists("../bodega/faxtmp/$var_filename"."pdf") or !file_exists("../bodega/faxtmp/$var_filename"."tif"))
		{
			$sshExec = "chmod 775 /var/spool/hylafax/recvq/$var_filename"."tif";
			exec($sshExec,$execOutput,$execReturn);	
			$dirRaiz = str_replace("/fax/image.php","/bodega/faxtmp/",$PHP_SELF);
			$sshExec = "cp /var/spool/hylafax/recvq/$var_filename"."tif  $dirRaiz".".";
			
			$sshExec = "cp /var/spool/hylafax/recvq/$var_filename"."tif  ../bodega/faxtmp/.";
			exec($sshExec,$execOutput,$execReturn);	
			if($execReturn==0)
			{
			$sshExec = "/usr/bin/convert "." ../bodega/faxtmp/$var_filename"."tif ../bodega/faxtmp/$var_filename-%d".".jpg";
			exec($sshExec,$execOutput,$execReturn);	
				if($execReturn==0)
				{
				}
				else
				{
					echo "<script>alert('Convirtio Mal  --- $sshExec');</script>";
				}
			//Modificado skinatech 30-10-08
			//$sshExec = "/usr/bin/convert "."../bodega/faxtmp/$var_filename*.jpg ../bodega/faxtmp/$var_filename"."pdf";
			$sshExec = "/usr/bin/convert "."../bodega/faxtmp/$var_filename"."tif ../bodega/faxtmp/$var_filename"."pdf";
			exec($sshExec,$execOutput,$execReturn);

				echo"return $execReturn";	
				if($execReturn==0)
				{
				}
				else
				{
					echo "<script>alert('Convirtio Mal  --- ');</script>";
				}
				$sshExec = "rm ../bodega/faxtmp/$var_filename*.jpg";
				exec($sshExec,$execOutput,$execReturn);
			}else
			{
				echo "<script>alert('No pudo copiar la Imagen  --- ');</script>";
			}
		}else
		{
			exec("chmod 775 ../bodega/faxtmp/$var_filename"."tif");
		}
		header("Content-type: application/pdf");
		readfile("../bodega/faxtmp/$var_filename"."pdf");
	}
	else
	{
		print("<center><img src=\"warning.png\"><h1>No hay Imagen Cargada</h1></center>");
	}
?>
