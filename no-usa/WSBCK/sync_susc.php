<?php

/*
NOMBRE:
sync_susc.php

DESCRIPCION:
Programa para realizar la copia inicial de los datos principales de
los suscriptores,  desde la BD del programa  financiero "GCI" 
(Vista: VW_USRORFEO), hacia la BD del sistema de gestion documental 
"orfeo" (Tabla: bodega_empresas).

El mapeo se realiza de la siguiente forma:

GCI             | ORFEO                   | observaciones
(VWUSRORFEO)    | bodega_empresas         |
=========================================================================
ID              | codigo_suscriptor       |ID del suscriptor
NOMBRE          | nombre_de_la_empresa	  |
CC              | nit_de_la_empresa	  |
DIRECCION       | direccion		  |
TELEFONO        | telefono_1              |
DEPTO           | codigo_del_departamento |
MPIO            | codigo_del_municipio    |
EMAIL           | email                   |
                | are_esp_secue           |    default:8
                | id_cont                 |    default:1
                | id_pais                 |   default:170
================================================================

PARAMETROS:
No tiene parametros de inicio.

RESULTADO:
Copia de datos necesarios para el manejo de suscriptores en orfeo.

ADICIONALES:
Lo realizado se va guardando en el archivo sync_susc.log, con
el fin de poder detectar cualquier error en la ejecucion. 

AUTOR(ES)
Juan Carlos Piñeros C. jpineros@skinatech.com
*/

/* Creacion de sesion */
session_start();
$session = session_id();

/* Conexion DB Firebird/Interbase (GCI) */

// Variables de conexion DB pruebas GCI

// Variables de conexion DB produccion GCI
$host='192.168.0.140:ESP_ESPI';
$username='UORFEO';
$password='U2014orfeo';
$encode='ISO8859_1';


/* Conexion DB PostgreSQL (Orfeo) */

// Variables de conexion DB pruebas Postgresql
$host_pgsql     = "192.168.0.64";
$user_pgsql     = "admin";
$password_pgsql = "orfeo";
$sid_pgsql      = "orfeo_produccion";


/* Log de actividad */
$fp = fopen('/tmp/sync_susc.log', 'a');

/* Migracion inicial de datos */

// Variables predeterminadas

//$dpto = 52;
//$muni = 1;

// Creando conexion a Firebird/Interbase
if ( !($conn_fb = ibase_connect($host, $username, $password, $encode))) {
    fwrite($fp, date('Y-m-d')."\tConexión a Firebird/Interbase fallida:" . ibase_errmsg()."\n");
    die("Conexión a Firebird/Interbase fallida:" . ibase_errmsg()."\n");
} else {
    fwrite($fp, date('Y-m-d')."\tConexión a Firebird/Interbase establecida!\n");
    if (php_sapi_name() == 'cli') {
        echo "Conexión a Firebird/Interbase establecida!\n";
    } else {
        if (ob_get_level() == 0) ob_start();
        echo "<h1>Actualización de suscriptores</h1>";
        echo "Conexión a Firebird/Interbase establecida! ...<br>";
        ob_flush();
        flush();
    }
}

// Seleccionando numero total de suscriptores en CGI
$query_max = "SELECT COUNT(*) AS MAXSUSC FROM VW_USRORFEO";

$cursor    = ibase_query($conn_fb, $query_max) or die('Error en consulta: '.ibase_errmsg());
$row_array = ibase_fetch_assoc($cursor);
$maxsuscf  = $row_array['MAXSUSC'];

ibase_free_result($cursor);


/* Creando conexion a PostgreSQL */
if ( !($conn_pg = pg_connect("host=$host_pgsql dbname=$sid_pgsql user=$user_pgsql password=$password_pgsql options='--client_encoding=latin1'"))) {
    fwrite($fp, date('Y-m-d')."\tConexión a PostgreSQL fallida:" . pg_last_error()."\n");
    die("Conexión a PostgreSQL fallida:" . pg_last_error()."\n");
}else {
    fwrite($fp, date('Y-m-d')."\tConexión a PostgreSQL establecida!\n");
    if (php_sapi_name() == 'cli') {
        echo "Conexión a Firebird/Interbase establecida!\n";
    } else {
        echo "Conexión a PostgreSQL establecida! ...<br>";
        ob_flush();
        flush();
    }
}

// Seleccionando numero total de suscriptores en Orfeo
$query_last = "SELECT COUNT(*) AS TOTAL FROM bodega_empresas";

$result    = pg_query($query_last) or die('Error en consulta: ' . pg_last_error());
$row_array = pg_fetch_row($result, null, PGSQL_ASSOC);
$maxsuscp  = $row_array['total'];

pg_free_result($result);



// Despliegue de resultados totales
fwrite($fp, date('Y-m-d')."Numero total de suscriptores CGI: ".$maxsuscf."\n");
fwrite($fp, date('Y-m-d')."Numero total de suscriptores SGD Orfeo: ".$maxsuscp."\n");

$updatesusc=$maxsuscf-$maxsuscp;

if (php_sapi_name() == 'cli') {
    echo "Numero total de suscriptores CGI: ".$maxsuscf."\n";
    echo "Numero total de suscriptores SGD Orfeo: ".$maxsuscp."\n";
    echo "Numero de suscriptores nuevos a ingresar en orfeo: ".$updatesusc."\n";
}else{
    echo "Numero total de suscriptores CGI: <b>".$maxsuscf."</b><br>";
    echo "Numero total de suscriptores SGD Orfeo: <b>".$maxsuscp."</b><br>";
    echo "Numero de suscriptores nuevos a ingresar en orfeo: ".$updatesusc."<br>";
    ob_flush();
    flush();
}

/* Ciclo de recorrido de suscriptores Actualiza si cambio, o inserta si no existe */

/* Extraccion de datos */
$query_fp = "SELECT ID, CC, NOMBRE, DIRECCION, DEPTO, MPIO, TELEFONO, EMAIL FROM VW_USRORFEO ORDER BY ID"; 

$cursor = ibase_query($conn_fb, $query_fp) or die('Error en consulta: '.ibase_errmsg());

// Contadores de operaciones
$updated=0;
$created=0;

while ($row_array = ibase_fetch_assoc($cursor)) {
    $id        = $row_array["ID"];
    $cc        = $row_array["CC"];
    $nombre    = $row_array["NOMBRE"];
    $direccion = $row_array["DIRECCION"];
    $dpto      = $row_array["DEPTO"];
    $mpio      = $row_array["MPIO"];
    $telefono  = $row_array["TELEFONO"];
    $email     = $row_array["EMAIL"];

    // Buscando si existe, de lo contrario se inserta
    $query_search = "SELECT codigo_suscriptor, nit_de_la_empresa, nombre_de_la_empresa, direccion, codigo_del_departamento, codigo_del_municipio, telefono_1, email FROM bodega_empresas WHERE codigo_suscriptor='$id'";

    $result = pg_query($query_search) or die('Error en consulta: ' . pg_last_error());

    $rows = pg_num_rows($result);

    if ($rows != 0) {
        $row_array1 = pg_fetch_row($result, null, PGSQL_ASSOC);

        $id1        = $row_array1["codigo_suscriptor"];
        $cc1        = $row_array1["nit_de_la_empresa"];
        $nombre1    = $row_array1["nombre_de_la_empresa"];
        $direccion1 = $row_array1["direccion"];
        $dpto1      = $row_array1["codigo_del_departamento"];
        $mpio1      = $row_array1["codigo_del_municipio"];
        $telefono1  = $row_array1["telefono_1"];
        $email1     = $row_array1["email"];

        if ($id.$cc.$nombre.$direccion.$telefono.$email ===
            $id1.$cc1.$nombre1.$direccion1.$telefono1.$email1) {
           //Actualizado
        } else {
            $sql_update = "UPDATE bodega_empresas SET(nit_de_la_empresa, nombre_de_la_empresa, direccion, telefono_1, email)=('$cc','$nombre','$direccion','$telefono','$email') WHERE codigo_suscriptor='$id'";
            $update = pg_query($sql_update) or die('Error en consulta: ' . pg_last_error());
            $updated++;
        }
    } else {
        $sql_insert = "INSERT INTO bodega_empresas (identificador_empresa,nit_de_la_empresa, nombre_de_la_empresa, direccion, telefono_1, email, codigo_suscriptor,are_esp_secue,codigo_del_departamento,codigo_del_municipio) 
                       VALUES (nextval('sec_bodega_empresas'),'$cc','$nombre','$direccion','$telefono','$email','$id',8,73,268)";

        $insert = pg_query($sql_insert) or die('Error en consulta: ' . pg_last_error());
        $created++;
    }
}
if (php_sapi_name() == 'cli') {
    echo "Suscriptores actualizados: $updated";
    echo "Suscriptores creados: $created";
} else {
    echo "Suscriptores actualizados: <b>$updated</b> <br>";
    echo "Suscriptores creados: <b>$created</b> <br>";
    ob_flush();
    flush();
}

/*
   // Aumentando last_susc para que inserte desde el siguiente valido
   $last_susc++;

   for ($i = $last_susc; $i <= $ora_max_susc; $i++) {
      // Busqueda de campos necesarios en la tabla suscript 
      $query = "select SUS.SUSCCODI AS SUSCCODI, SUS.SUSCNOMB AS SUSCNOMB, SUS.SUSCTELE AS SUSCTELE, SUS.SUSCDIRE AS SUSCDIRE, BAR.BARRNOMB AS SUSCBARR
                from SUSCRIPT SUS, BARRIO BAR 
		where SUS.SUSCBARR=BAR.BARRCODI AND SUS.SUSCCODI LIKE '$i'";

      $stid = oci_parse($conn, $query);
      $r = oci_execute($stid);

      // Fetch each row in an associative array
      while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
         $ora_susccodi = $row["SUSCCODI"];
         $ora_suscnomb = str_replace("'","",$row["SUSCNOMB"]);
         $ora_susctele = str_replace("'","",$row["SUSCTELE"]);
         $ora_suscdire = str_replace("'","",$row["SUSCDIRE"]." ".$row["SUSCBARR"]);
      }

      if (isset($ora_susccodi)){

         // Insercion de suscriptor en orfeo
         $sql_bod_emp = "INSERT INTO bodega_empresas (nit_de_la_empresa, nombre_de_la_empresa,  direccion, telefono_1,codigo_del_departamento, 
                     codigo_del_municipio, id_cont, id_pais, activa,are_esp_secue, identificador_empresa)
                     VALUES ('$ora_susccodi','$ora_suscnomb','$ora_suscdire','$ora_susctele',$dpto,$muni,1,170,1,8,NEXTVAL('SEC_BODEGA_EMPRESAS'))";

         //print $sql_bod_emp; // Para imprimir SQL e insertar a mano si se presenta algun error

         $result = pg_query($sql_bod_emp) or die('Query failed: ' . pg_last_error());

         // Liberando result
         pg_free_result($result);

         fwrite($fp, "Datos suscriptor $i insertados correctamente\n");
	
         //Agregando query para insertar expediente
         $depe=501;
         $srd=37;
         $sbrd=1;
	 $secNew=str_pad($ora_susccodi,5,"0", STR_PAD_LEFT);
         $exp_num=date("Y").$depe.$srd."0".$sbrd.$secNew."E";
	 $exp_nom="SUSCRIPTOR".$ora_susccodi;
	 $fecha=date("Y-m-d");
         $isql_sexp="INSERT INTO sgd_sexp_secexpedientes (sgd_exp_numero,sgd_srd_codigo, sgd_sbrd_codigo,sgd_sexp_secuencia,depe_codi,usua_doc,sgd_sexp_fech,sgd_fexp_codigo,sgd_sexp_ano,usua_doc_responsable,sgd_sexp_parexp1,sgd_pexp_codigo)
                        VALUES ('$exp_num',$srd,$sbrd,$ora_susccodi,$depe,'12985294','$fecha',0,".date('Y').",'12985294','$exp_nom',0)";
		
         $result = pg_query($isql_sexp) or die('Query failed: ' . pg_last_error());

         // Liberando stid
         oci_free_statement($stid);

         // Liberando result
         pg_free_result($result);

         fwrite($fp, "Expediente de suscriptor $i insertado correctamente\n");

         unset($ora_susccodi);
      }else{  
         fwrite($fp, "Datos NULOS para suscriptor $i ERROR, pasando al siguiente\n");
      }
   }

}*/
// Cerrando conexion a PostgreSQL
pg_close($conn_pg);
// Cerrando conexion a Firebird/Interbase
ibase_close($conn_fb);

// Cerrando archivo de log
fclose($fp);
ob_end_flush();
?>
