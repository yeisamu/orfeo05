<?php

include "nuevaConexion.php";

$conexion = new nuevaConexion();
                $conexion->conectar();
                if($conexion->conectar()==true){
                        echo "conexion exitosa";
			echo "<br>";
			$result=$conexion->consultar("SELECT * FROM radicado where radi_nume_radi = 201501000000102");
			echo "<br>";
			while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
				print_r($line);
				echo "<br>";
  				  foreach ($line as $col_value) {
       					 echo "$col_value";
   					 }
			}
			echo "<br>";
                        }else{
                                echo "no se pudo conectar";
                        }


?>

