<?php
    require_once "nusoap/nusoap.php";

    function month ($monthEn) {
        if ($monthEn=="January") return "Enero";
        if ($monthEn=="February") return "Febrero";
        if ($monthEn=="March") return "Marzo";
        if ($monthEn=="April") return "Abril";
        if ($monthEn=="May")  return "Mayo";
        if ($monthEn=="June") return "Junio";
        if ($monthEn=="July") return "Julio";
        if ($monthEn=="August") return "Agosto";
        if ($monthEn=="September") return "Septiembre";
        if ($monthEn=="October") return "Octubre";
        if ($monthEn=="November") return "Noviembre";
        if ($monthEn=="December") return "Diciembre";
    }

    function monthAlpha ($month) {
        if ($month==1) return "Enero";
        if ($month==2) return "Febrero";
        if ($month==3) return "Marzo";
        if ($month==4) return "Abril";
        if ($month==5)  return "Mayo";
        if ($month==6) return "Junio";
        if ($month==7) return "Julio";
        if ($month==8) return "Agosto";
        if ($month==9) return "Septiembre";
        if ($month==10) return "Octubre";
        if ($month==11) return "Noviembre";
        if ($month==12) return "Diciembre";
    }

    function searchID ($id, $name) {
        // Buscando documento en las tres tablas que deberia existir sgd_ciu_ciudadano, sgd_pen_pensionado, bodega_empresas
        $ruta_raiz="..";
        require_once("$ruta_raiz/include/db/ConnectionHandler.php");
        if(!$db) $db = new ConnectionHandler("$ruta_raiz");

        // Limpiando id, quitando espacios y puntos
        $id=trim(str_replace(".","",$id));

        // Extrayendo secuencias necesarias
        $secRad=$db->nextId("secr_tp1_100");
        $secDir=$db->nextId("sec_dir_direcciones");

        // Valores defecto radicado
        $dependencia=230;

        // Numero de radicado
        $numRad=date("Y").$dependencia.str_pad($secRad,6,"0",STR_PAD_LEFT)."1";
        $path=date("Y")."/$dependencia/$numRad.pdf";
        $dateRad=date("Y-m-d");

        // Insertando tabla radicado
        $sql_radicado="INSERT INTO radicado (radi_tipo_deri, radi_cuentai, 
                       eesp_codi, mrec_codi, radi_fech_ofic, radi_nume_deri, 
                       radi_usua_radi, radi_pais, ra_asun, radi_desc_anex, 
                       radi_depe_radi, radi_usua_actu, carp_codi, carp_per,
                       radi_nume_radi, trte_codi, radi_fech_radi, 
                       radi_depe_actu, tdoc_codi, tdid_codi,codi_nivel, 
                       sgd_apli_codi, radi_path)
                       VALUES (0, '', 0, 1, '$dateRad', 0, 1, '170', 
                       'Expedición de certificado via WS', '1 folio', '230',
                       1, 1, 0,$numRad, 0, CURRENT_TIMESTAMP, '999', 107, 0, 3, 
                       0,'$path')";

        $results=$db->query($sql_radicado);

        // Insertando SGD_DT_RADICADO
        $sql_dt="INSERT INTO sgd_dt_radicado(radi_nume_radi, dias_termino)
                 VALUES ($numRad, 0)";

        $results=$db->query($sql_dt);

        // Insertando historico
        $sql_hist="INSERT INTO hist_eventos (radi_nume_radi, depe_codi, 
                   usua_codi, usua_codi_dest, depe_codi_dest, usua_doc, 
                   hist_doc_dest, sgd_ttr_codigo, hist_obse, hist_fech) 
                   VALUES ($numRad,$dependencia,1,1,$dependencia,
                   (SELECT usua_doc FROM usuario WHERE usua_codi=1 and depe_codi=$dependencia),
                   (SELECT usua_doc FROM usuario WHERE usua_codi=1 and depe_codi=$dependencia),2,'Radicación externa certificación', CURRENT_TIMESTAMP)";

        $results=$db->query($sql_hist);


        // CASO I: Funcionario
        $sql_fun = "SELECT u.usua_doc AS r_doc, u.usua_nomb AS r_nomb, u.usua_login AS r_login, 
                    u.usua_ext AS r_ext, u.usua_email AS r_mail, d.depe_nomb AS r_dep
                    FROM usuario u, dependencia d 
                    WHERE TRIM(both ' ' from REPLACE(u.usua_doc,'.',''))='$id' 
                    AND u.depe_codi=d.depe_codi";
        $results=$db->query($sql_fun);

        if (! $results->EOF ) {
            $r_name=$results->fields["R_NOMB"]."-".$results->fields["R_LOGIN"];
            $r_id=$results->fields["R_DOC"];
            $r_dir=$results->fields["R_DEP"];

            // Insert SGD_DIR_DRECCIONES
            $sql_dir="INSERT INTO sgd_dir_drecciones (sgd_dir_codigo, 
                      sgd_dir_tipo, radi_nume_radi, muni_codi, dpto_codi, 
                      sgd_dir_direccion, sgd_sec_codigo, sgd_doc_fun,
                      sgd_dir_nomremdes, sgd_trd_codigo, sgd_dir_doc, 
                      id_pais, id_cont)
                      VALUES ($secDir, 1,$numRad,1, 11,'$r_dir',0, '1',
                      '$r_name', 4, '$r_id', 170, 1)";

            $results=$db->query($sql_dir);

            return array('rad'=>$numRad,'date'=>$dateRad,'path'=>$path);

        }


        // CASO II: FFMM
        $sql_ffmm= "SELECT nombre_de_la_empresa AS r_nomb, nit_de_la_empresa AS r_doc, 
                    direccion AS r_dir, telefono_1 AS r_tel, identificador_empresa AS r_bodega
                    FROM bodega_empresas 
                    WHERE TRIM(both ' ' from REPLACE(nit_de_la_empresa,'.',''))='$id'";
        $results=$db->query($sql_ffmm);

        if (! $results->EOF ) {
            $r_name=$results->fields["R_NOMB"];
            $r_id=$results->fields["R_DOC"];
            $r_dir=$results->fields["R_DIR"];
            $r_tel=$results->fields["R_TEL"];
            $r_idBod=$results->fields["R_BODEGA"];

            $sql_dir="INSERT INTO sgd_dir_drecciones (sgd_dir_codigo, 
                      sgd_dir_tipo, sgd_esp_codi, radi_nume_radi, muni_codi, 
                      dpto_codi, sgd_dir_direccion, sgd_dir_telefono,
                      sgd_sec_codigo, sgd_dir_nomremdes, sgd_trd_codigo, 
                      sgd_dir_doc, id_pais,id_cont)
                      VALUES ($secDir, 1, $r_idBod, $numRad, 1, 11, '$r_dir',
                      '$r_tel', 0, '$r_name', 3, '$r_id', 170, 1)";

            $results=$db->query($sql_dir);

            return array('rad'=>$numRad,'date'=>$dateRad,'path'=>$path);
        }



        // CASO III: Pensionados

        $sql_pen = "SELECT sgd_ciu_codigo AS r_pen, sgd_ciu_nombre AS r_nomb, sgd_ciu_direccion AS r_dir, 
                    sgd_ciu_apell1 AS r_apel1, sgd_ciu_apell2 AS r_apel2, sgd_ciu_telefono AS r_tel, 
                    sgd_ciu_cedula AS r_doc
                    FROM sgd_pen_pensionados 
                    WHERE TRIM(both ' ' from REPLACE(sgd_ciu_cedula,'.',''))='$id'";
        $results=$db->query($sql_pen);

        if (! $results->EOF ) {
            $r_name=$results->fields["R_NOMB"]." ".$results->fields["R_APEL1"]." ".$results->fields["R_APEL2"];
            $r_id=$results->fields["R_DOC"];
            $r_dir=$results->fields["R_DIR"];
            $r_tel=$results->fields["R_TEL"];
            $r_idPen=$results->fields["R_PEN"];

            $sql_dir="INSERT INTO sgd_dir_drecciones (sgd_dir_codigo, 
                      sgd_dir_tipo, sgd_ciu_codigo, radi_nume_radi, 
                      muni_codi, dpto_codi, sgd_dir_direccion, sgd_dir_telefono,
                      sgd_sec_codigo, sgd_dir_nomremdes, sgd_trd_codigo, 
                      sgd_dir_doc, id_pais, id_cont)
                      VALUES ($secDir, 1,$r_idPen,$numRad,1, 11,'$r_dir',
                      '$r_tel',0,'$r_name', 1, '$r_id', 170, 1)"; 

            $results=$db->query($sql_dir);

            return array('rad'=>$numRad,'date'=>$dateRad,'path'=>$path);

        }


        // CASO IV: Ciudadanos
        $sql_ciu = "SELECT sgd_ciu_codigo AS r_ciu, sgd_ciu_nombre AS r_nomb, sgd_ciu_direccion AS r_dir, 
                    sgd_ciu_apell1 AS r_apel1, sgd_ciu_apell2 AS r_apel2, sgd_ciu_telefono AS r_tel, 
                    sgd_ciu_cedula AS r_doc
                    FROM sgd_ciu_ciudadano 
                    WHERE TRIM(both ' ' from REPLACE(sgd_ciu_cedula,'.',''))='$id'";
        $results=$db->query($sql_ciu);

        if (! $results->EOF ) {
            $r_name=$results->fields["R_NOMB"]." ".$results->fields["R_APEL1"]." ".$results->fields["R_APEL2"];
            $r_id=$results->fields["R_DOC"];
            $r_dir=$results->fields["R_DIR"];
            $r_tel=$results->fields["R_TEL"];
            $r_idCiu=$results->fields["R_CIU"];

            $sql_dir="INSERT INTO sgd_dir_drecciones (sgd_dir_codigo, 
                      sgd_dir_tipo, sgd_ciu_codigo, radi_nume_radi, 
                      muni_codi, dpto_codi, sgd_dir_direccion, sgd_dir_telefono,
                      sgd_sec_codigo, sgd_dir_nomremdes, sgd_trd_codigo, 
                      sgd_dir_doc, id_pais, id_cont)
                      VALUES ($secDir, 1,$r_idCiu,$numRad,1, 11,'$r_dir',
                      '$r_tel',0,'$r_name', 1, '$r_id', 170, 1)"; 

            $results=$db->query($sql_dir);

            return array('rad'=>$numRad,'date'=>$dateRad,'path'=>$path);
        }

        // Si llego aqui es que toca agregarlo porque no existe en ninguna de las anteriores tablas

        // Agregandolo en la tabla sgd_ciu_ciudadanos

        if ( isset($name) ) {

            // Insertando ciudadano
            $secCiu=$db->nextId("sec_ciu_ciudadano");

            $r_name=$name;
            $r_id=$id;
            $r_dir="Carrera 13 No. 26-30";
            $r_tel="(571) 2822860";
            $r_idCiu=$secCiu;

            $sql_ciu="INSERT INTO sgd_ciu_ciudadano (tdid_codi, sgd_ciu_codigo,
                      sgd_ciu_nombre, sgd_ciu_direccion, sgd_ciu_telefono,
                      sgd_ciu_email, muni_codi, dpto_codi, sgd_ciu_cedula,
                      id_cont, id_pais) VALUES (2, $secCiu, '$r_name', 
                      '$r_dir', '$r_tel', 'info@sht.com.co', 1, 11, '$r_id',
                      1,170)";

            $results=$db->query($sql_ciu);

            $sql_dir="INSERT INTO sgd_dir_drecciones (sgd_dir_codigo, 
                      sgd_dir_tipo, sgd_ciu_codigo, radi_nume_radi, 
                      muni_codi, dpto_codi, sgd_dir_direccion, sgd_dir_telefono,
                      sgd_sec_codigo, sgd_dir_nomremdes, sgd_trd_codigo, 
                      sgd_dir_doc, id_pais, id_cont)
                      VALUES ($secDir, 1,$r_idCiu,$numRad,1, 11,'$r_dir',
                      '$r_tel',0,'$r_name', 1, '$r_id', 170, 1)"; 

            $results=$db->query($sql_dir);

            return array('rad'=>$numRad,'date'=>$dateRad,'path'=>$path);
        }

        // Si no entro en ningun lado error
        die("Error no se pudo agregar el ciudadano");

    }
      
    function genRadi($category,$name,$idPerson,$idPlace,$contractTerm,$position,$admissionDate,$salary,$bfc,$requestOf,$commissions) {

        // Dependiendo la certificacion validamos los valores
        switch ($category) {
            case 1:
               // Definiendo formato
               $typeCert="tipoI.odt"; 
               break;
            case 2:
               // Definiendo formato
               $typeCert="tipoII.odt";
               break;
            case 3:
               // Definiendo formato
               $typeCert="tipoIII.odt";
               break;
            case 4:
               // Definiendo formato
               $typeCert="tipoIV.odt";
               break;
            case 5:
               // Definiendo formato
               $typeCert="tipoV.odt";
               break;
            case 6:
               // Definiendo formato
               $typeCert="tipoVI.odt";
               break;
            case 7:
               // Definiendo formato
               $typeCert="tipoVII.odt";
               break;
            case 8:
               // Definiendo formato
               $typeCert="tipoVIII.odt";
               break;
            case 9:
               // Definiendo formato
               $typeCert="tipoIX.odt";
               break;
            case 10:
               // Definiendo formato
               $typeCert="tipoX.odt";
               break;
            default:
                   return "El tipo de certificación usado: $category, no existe! Verifique los datos suministrados";
        }

        // Validacion de insercion de usuario
        $datosRad=searchID($idPerson, $name);

        // Clase para generar valor en letras
        require_once "enletras.php";
        $L=new EnLetras();

	// Combine correspondencia
        include ( "../radsalida/masiva/OpenDocText.class.php" );
        define ( 'WORKDIR', '../bodega/tmp/workDir/' );
        define ( 'CACHE', WORKDIR . 'cacheODT/' );

        $accion = false;
        $odt = new OpenDocText();
        $odt->setDebugMode(true);
        //Se carga el archivo odt Original 
        $archivoACargar = "../../quixplorer/orfeo/Plantillas/Certificaciones/$typeCert";
        $odt->cargarOdt( "$archivoACargar", $typeCert );
        $odt->setWorkDir( WORKDIR );
        $accion = $odt->abrirOdt();
        if(!$accion)
        {
                die( "Problemas en el servidor abriendo archivo ODT para combinaci&oacute;n." );
        }
        $odt->cargarContenido();

        // Definimos variables a reemplazar
        $cadaVariable[0]="*NAME*";
        $cadaVariable[1]="*IDNUM*";
        $cadaVariable[2]="*IDPLACE*";
        $cadaVariable[3]="*CTERM*";
        $cadaVariable[4]="*DD*";
        $cadaVariable[5]="*MM*";
        $cadaVariable[6]="*YYYY*";
        $cadaVariable[7]="*POS*";
        $cadaVariable[8]="*SAL*";
        $cadaVariable[9]="*BFC*";
        $cadaVariable[10]="*DD_ALPHA*";
        $cadaVariable[11]="*DD_NUM*";
        $cadaVariable[12]="*MM_ALPHA*";
        $cadaVariable[13]="*YY_ALPHA*";
        $cadaVariable[14]="*YY_NUM*";
        $cadaVariable[15]="*RAD_S*";
        $cadaVariable[16]="*ROF*";
        $cadaVariable[17]="*MM_IN_ALPHA*";
        $cadaVariable[18]="*COMMISSION*";

        $cadaValor[0]=mb_strtoupper($name,"UTF-8");
        $cadaValor[1]=number_format($idPerson, 0, ",", ".");
        $cadaValor[2]=$idPlace;
        $cadaValor[3]=$contractTerm;
        $cadaValor[4]=substr($admissionDate,8,2);
        $cadaValor[5]=substr($admissionDate,5,2);
        $cadaValor[6]=substr($admissionDate,0,4);
        $cadaValor[7]=$position;
        $cadaValor[8]=$salary;
        $cadaValor[9]=$bfc;
        $cadaValor[10]=$L->ValorEnLetras(date('d'),"");
        $cadaValor[11]=date('d');
        $cadaValor[12]=month(date('F'));
        $cadaValor[13]=$L->ValorEnLetras(date('Y'),"");
        $cadaValor[14]=date('Y');
        $cadaValor[15]=$datosRad['rad'];
        $cadaValor[16]=$requestOf;
        $cadaValor[17]=monthAlpha(substr($admissionDate,5,2));
        $cadaValor[18]=$commissions;


        $odt->setVariable( $cadaVariable, $cadaValor );
        $odt->salvarCambios( null, substr($datosRad['path'],0,-3)."odt", '1' );
        $odt->borrar();

        $command = 'sudo unoconv --format %s %s';
        $command = sprintf($command, "pdf", "/var/www/orfeo/bodega/".substr($datosRad['path'],0,-3)."odt");
        system($command, $output);

        //return "http://172.18.2.90/pruebas/bodega/".$datosRad['path'];
        return "../bodega/".$datosRad['path'];
 
    }
      
    $server = new soap_server();
    $server->configureWSDL("certi_SHT", "urn:certi_SHT");
      
    $server->register("genRadi",
        array("category" => "xsd:int",
              "name" => "xsd:string",
              "idPerson" => "xsd:string",
              "idPlace" => "xsd:string",
              "contractTerm" => "xsd:string",
              "position" => "xsd:string",
              "admissionDate" => "xsd:string",
              "salary" => "xsd:string",
              "bfc" => "xsd:string",
              "requestOf" => "xsd:string",
              "commissions" => "xsd:string"),
        array("return" => "xsd:string"),
        "urn:certi_SHT",
        "urn:certi_SHT#genRadi",
        "rpc",
        "encoded",
        "Genera el certificado utilizando las variables descritas y lo radica en el SGD Orfeo, devolviendo como respuesta la URL para la descarga del PDF");
      
    $server->service($HTTP_RAW_POST_DATA);
?>
