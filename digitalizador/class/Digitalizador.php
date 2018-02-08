<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Funciones de Digitalizacion
 *
 * Esta clase se encarga de proporcionar las funciones necesarias para 
 * el manejo de la digitalización y carga de imagenes como principal o
 * anexos a los radicados.
 *
 * PHP version 5
 *
 * @category  Digitalizador
 * @package   Orfeo
 * @author    Camilo Andres Pintor Gutierrez <cpintor@skinatech.com>
 * @copyright 2015 Skina Technologies Ltda.
 * @license   ../LICENSE.txt <http://www.gnu.org/licenses/gpl-2.0.html>
 * @version   SVN: $Id$
 * @link      http://www.skinatech.com
 * @since     Archivo disponible desde la version 4.2.0
 */

/**
 * Class Digitalizador
 * 
 * Permite registrar, validar y cargar las digitalizaciones realizadas
 *
 * @category  Digitalizador
 * @package   Orfeo
 * @author    Camilo Andres Pintor Gutierrez <cpintor@skinatech.com>
 * @copyright 2015 Skina Technologies Ltda.
 * @license   ../LICENSE.txt <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link      http://www.skinatech.com
 * @since     Archivo disponible desde la version 4.2.0
 */

class Digitalizador 
{

    private $db;
    private $debug;
    private $longitud_codigo_dependencia;

    /**
     * Constructor de la clase
     *
     * El constructor de la clase, recibe los parametros necesarios para
     * definir la configuración general del digitalizador y carga las librerias 
     * necesarias para su funcionamiento
     *
     * @param boolean $debug      True / False si se habilita el debug 
     *
     * @return void
     *
     * @author     Camilo Andres Pintor Gutierrez <cpintor@skinatech.com>
     */

     function Digitalizador($debug=FALSE)
     {
         /**Defino case sensitive de adodb            **/
         define('ADODB_ASSOC_CASE', 1);

         /**Llamo la libreria de conexión a db usada por Orfeo **/
         require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../../include/db/ConnectionHandler.php';
         /**Llamo archivo de configuración del aplicativo **/
         require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../../config.php';

         //Asigno valor de longitud de dependencia a variable de la clase
         $this->longitud_codigo_dependencia = $longitud_codigo_dependencia;

         /**Instancio objeto de la conexión a bd usada por Orfeo **/
         $this->db = new ConnectionHandler("..");
         /**Defino la form en como se va a generar los registros resulatdos de query**/
         $this->db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
         /**Defino objeto de debug de la libreria adodb **/
         $this->db->conn->debug= false;
     }

    /**
    * Genera las secuencias de actualización bd para el versionamiento
    *
    * Genera las secuencias para actualizar la tabla del versionamiento
    * valida si es la primera versión o es una nueva y saca la huella digital
    * sha1 del archivo cargado
    *
    * @param string $radicado      Numero de raicado a versionar
    * @param string $ruta_archivo  Ruta de archivo a versionar
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return string $head
    */

    function actualizaVersionamientoImagen($radicado, $ruta_archivo, $usua_doc)
    {
        $numero_version = $this->obtenerVersionamientoImagen($radicado);
        $sql_actualiza_version = "insert into sgd_versiones_imgrad
                              (radi_nume_radi, radi_path, numero_version,
                               tamano_archivo, sha1_archivo, doc_usu_upload)
                              values ('$radicado', 
                                      '".$ruta_archivo["RUTA_ARCHIVO"]."',
                                       ".$numero_version["numero"].", 
                                      ".filesize($ruta_archivo["RUTA_TOTAL"]).",
                                      '".sha1_file($ruta_archivo["RUTA_TOTAL"])."'                                      , $usua_doc)";
        if($this->db->conn->query($sql_actualiza_version))
        {
            return true;
            $this->db->conn->CompleteTrans();
        } else {
            return false;
            $this->db->conn->CompleteTrans();
            echo "<hr>No actualizo la BD <hr>";
        }
    }

    /**
    * Genera las secuencias de verificación numero actual para el versionamiento
    *
    * Genera las secuencias para obtener el numero actual del versionamiento
    * valida si es la primera versión o es una nueva y devuelve el conteo
    * siguiente
    *
    * @param string $radicado      Numero de raicado a versionar
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return array $version
    */

    function obtenerVersionamientoImagen($radicado)
    {
        //Sql para obtener maximo numero de version
        $sql_busca_versionimg = "select MAX(numero_version)
                                 AS numero_version 
                                 from sgd_versiones_imgrad 
                                  where radi_nume_radi ='".$radicado."'";
        //Se ejecuta la sql
        $rs_busca_versionimg  = $this->db->conn->query($sql_busca_versionimg);
        //Valido la ejecución de la query
        if ($rs_busca_versionimg->fields["NUMERO_VERSION"] == NULL)
        {
            //Si no se encontraron registros es por que es la primera version
            //Numero de version
            $version["numero"]   = 1;
            //Prefijo para concatenar a los nombres de archivos
            $version["postfijo"] = "_".$version["numero"];
        } else {
            //Numero de version
            $version["numero"] = $rs_busca_versionimg->fields["NUMERO_VERSION"]+1;
            //Prefijo para concatenar a los nombres de archivos
            $version["postfijo"]= "_".$version["numero"];
        }
        //Devuelvo resultados
        return $version;
    }

    /**
    * Genera la secuencia de cargo de archivos como principal
    *
    * Genera las secuencias para cargar los archivos como principal
    * a un radicado, sube el archivo y genera las sqlś para afectar
    * los registros y tablas necesarias
    *
    * @param string $codificacion      Tipo de codificacion a utlizar
    * @param string $OMSG_Titulo_Login Mensaje para el titulo de la pagina
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return string $head
    */

    function cargarImagenPrincipal ($radicado, $dependencia, $codusuario,
                                    $observa, $codTx, $accion, $usua_doc, $krd = null)
    {
        //Inicio transaccion adodb
	$this->db->conn->StartTrans();
        //$this->db->conn->debug =true;
	$subir = $this->subirArchivo($radicado, $accion);
        //Sql para actualizar datos de la imagen principal del radicado
        $sql_cargar_imagen = "update radicado
                              set radi_path='".$subir["RUTA_ARCHIVO"]."'
                              where radi_nume_radi='$radicado'";
        //Valido si se ejecuta la query
        if($this->db->conn->query($sql_cargar_imagen))
        {
	   // Se comentarea este bloque de codigo para que no cree ningun anexo al momento de  Asociar imagen al radicado
	   /* $ultimo_anexo_sql = "SELECT MAX(anex_codigo) AS codigo FROM anexos WHERE anex_radi_nume='".$radicado."'";
	    $obtener_codigo = $this->db->conn->Execute($ultimo_anexo_sql);
	    $codigo_anexo = $obtener_codigo->FetchRow();
	    $codigo_siguiente = str_pad(substr($codigo_anexo['CODIGO'], -1) + 2, 5, "0", STR_PAD_LEFT);
            //Asigno el radicado a ser actualizado para el historico
            $radicadosSel[] = $radicado;
            //Incluyo libreria de hstorico
	    $insert_anexo_sql = "INSERT INTO anexos (
			anex_radi_nume, 
			anex_codigo, 
			anex_tipo, 
			anex_solo_lect,
			anex_creador, 
			anex_desc, 
			anex_numero, 
			anex_nomb_archivo, 
			anex_borrado, 
			anex_origen, 
			anex_salida,
			radi_nume_salida, 
			anex_radi_fech, 
			anex_estado, 
			sgd_rem_destino, 
			sgd_dir_tipo, 
			anex_depe_creador,
			anex_fech_anex 
		) VALUES (
			'".$radicado."',
			'".$radicado.$codigo_siguiente."' , 
			7, 
			'S', 
			'".$krd."', 
			'".$observa."',
			".$codigo_siguiente.",
			'1".$radicado."_".$codigo_siguiente.".pdf', 
			'N', 
			0, 
			1, 
			NULL, 
			NULL, 
			0, 
			1, 
			3, 
			'".$dependencia."', 
			TO_DATE(SYSDATE, 'YYYY-MM-DD HH:MI:SS') 
		)";
	    $insertar_anexo = $this->db->conn->Execute($insert_anexo_sql);*/
            include dirname(__FILE__).DIRECTORY_SEPARATOR."../../include/tx/Historico.php";
            //Instancio clase
            $hist = new Historico($this->db);
            //Ingreso historico en el radicado
            $radicadosSel[] = $radicado;
            $hist->insertarHistorico($radicadosSel,  $dependencia , $codusuario,
                                     $dependencia, $codusuario, $observa, $codTx);
            //Ingreso versionamiento de imagen 
            if (!$this->actualizaVersionamientoImagen($radicado,
                 $subir, $usua_doc))
            {
                //Valido ejecucion de las sqls
                $this->db->conn->CompleteTrans();
                 echo "<hr>No actualizo la BD <hr>";
            }
            //Valido ejecucion de las sqls
            $this->db->conn->CompleteTrans();
            echo '<script>alert("Se realizo la carga de la imagen con exito");
                  </script> ';
        } else {
            echo "<hr>No actualizo la BD <hr>";
        }
    }

    /**
    * Genera la secuencia de reemplazo de archivos como principal
    *
    * Genera las secuencias para cargar los archivos como principal
    * a un radicado, sube el archivo y genera las sqlś para afectar
    * los registros y tablas necesarias
    *
    * @param string $codificacion      Tipo de codificacion a utlizar
    * @param string $OMSG_Titulo_Login Mensaje para el titulo de la pagina
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    *
    * 
    * @return string $head
    */

    function reemplazarImagenPrincipal ($radicado, $dependencia, $codusuario,
                                    $observa, $codTx, $accion, $usua_doc)
    {
        //Inicio transaccion adodb
        $this->db->conn->StartTrans();
        $subir = $this->subirArchivo($radicado, $accion);
        //Sql para actualizar datos de la imagen principal del radicado
        $sql_reemplazar_imagen = "update radicado
                              set radi_path='".$subir["RUTA_ARCHIVO"]."'
                              where radi_nume_radi='$radicado'";
        //Valido si se ejecuta la query
        if($this->db->conn->query($sql_reemplazar_imagen))
        {
            //Asigno el radicado a ser actualizado para el historico
            $radicadosSel[] = $radicado;
            //Incluyo libreria de hstorico
            include dirname(__FILE__).DIRECTORY_SEPARATOR."../../include/tx/Historico.php";
            //Instancio clase
            $hist = new Historico($this->db);
            //Ingreso historico en el radicado
            $hist->insertarHistorico($radicadosSel,  $dependencia , $codusuario,
                                     $dependencia, $codusuario, $observa, $codTx);
            //Ingreso versionamiento de imagen 
            if (!$this->actualizaVersionamientoImagen($radicado,
                 $subir, $usua_doc))
            {
                //Valido ejecucion de las sqls
                $this->db->conn->CompleteTrans();
                 echo "<hr>No actualizo la BD <hr>";
            }
            //Valido ejecucion de las sqls
            $this->db->conn->CompleteTrans();
            echo '<script>alert("Se realizo el reemplazo de la imagen con exito");
                  </script> ';
        } else {
            echo "<hr>No actualizo la BD <hr>";
        }
    }

    
    /**
    * Consulta las dependencias activas pendientes por digiatlizar
    *
    * Trae las dependencias activas en el sistema, para consultar los radicados 
    * sin imagen en el sistema
    *
    * @param string $codigo_dependencia Codigo de la dependencia defecto (0998)
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return string $rs_datos_rad_sinimg
    */
     
    function traeListaDependencia ($codigo_dependencia)
    {
        /**Genero la query para traer los radicados segun los parametros enviados**/
        $sql_trae_list_depe = "SELECT ".$this->db->conn->Concat( "DEPE_CODI", "'-'", "DEPE_NOMB" ).",
                                DEPE_CODI FROM DEPENDENCIA
                                WHERE DEPE_ESTADO = 1
                                ORDER BY DEPE_CODI, DEPE_NOMB";


        /**Obtengo la data resultante de la ejecución de la query **/
        $rs_datos_list_depe = $this->db->conn->query($sql_trae_list_depe);             
        /**Imprimo lista de dependencias activas**/
        print $rs_datos_list_depe->GetMenu2("codigo_dependencia", 
                                       $codigo_dependencia, "0:-- Seleccione  una Dependencia --",
                                       false, false, "class='listados5' id='codigo_dependencia' 
                                       title='Lista con las dependencias de la organizacion' onchange='enviar_formulario(\"#FormListDig\")' ")."<hr>";
           
    }


    /**
    * Consulta los tipos de radicado activos
    *
    * Trae los tipos de radicado activos en el sistema, para ser filtro
    * en la consulta los radicados sin imagen en el sistema
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return string $rs_datos_rad_sinimg
    */

    function traeListaTipoRad ($tipo_rad)
    {
        /**Genero la query para traer los radicados segun los parametros enviados**/
        $sql_trae_list_depe = "SELECT ".$this->db->conn->Concat( "SGD_TRAD_CODIGO", "'-'", "SGD_TRAD_DESCR" ).",
                                SGD_TRAD_CODIGO FROM SGD_TRAD_TIPORAD
                                ORDER BY SGD_TRAD_CODIGO, SGD_TRAD_DESCR";


        /**Obtengo la data resultante de la ejecución de la query **/
        $rs_datos_list_depe = $this->db->conn->query($sql_trae_list_depe);
        /**Imprimo lista de dependencias activas**/
        print $rs_datos_list_depe->GetMenu2("tipo_radicado",
                                       $tipo_rad, "0:-- Seleccione  un Tipo de Radicado--",
                                       false, false, "class='listados' id='tipo_radicado' 
                                       title='Lista con los tipos de radicado de la organizacion' onchange='enviar_formulario(\"#FormListDig\")' ")."<hr>";

    }

    
    /**
    * Genera el listado de radicados sin imagen
    *
    * Genera el listado de radicados sin imagen principal,
    * muestra los radicados dependiendo del filtro seleccionado de tipo de 
    * radicado, codigo de dependencia o por numero de radicado.
    *
    * @param string $tipo_radicado      Tipo de radicado a consultar (Ej: 2)
    * @param string $codigo_dependencia Codigo de la dependencia a consultar (0998)
    * @param string $radicado Numero del radicado a consultar
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * @author     Pablo Villate <pvillate@skinatech.com>
    * 
    * @return string $lista_rad_sinimg
    */

    function listaRadSinImagen ($tipo_radicado, $codigo_dependencia, $radicado=null)
    {
        /**Obtengo la data de los radicados **/
	if ($radicado != null) {
		$filtro_radicado = " tradicado.radi_nume_radi LIKE '%".$radicado."%'";
	} else {
		$filtro_radicado = ' tradicado.RADI_NUME_RADI LIKE \'%'.$tipo_radicado.'%\'';
	}
        $data_rad_sinimg = 'Select tradicado.RADI_NUME_RADI AS "IDT_NUMERO RADICADO",
                                tradicado.RADI_PATH AS "HID_RADI_PATH",
                                tradicado.RADI_FECH_RADI AS "DAT_FECHA RADICADO",
                                tradicado.RA_ASUN AS "ASUNTO", tradicado.RADI_DEPE_ACTU AS "DEPENDENCIA ACTUAL",
                                tradicado.RADI_USUA_ACTU AS "USUARIO ACTUAL",
                                tdependencia.depe_nomb AS "NOMBRE DEPENDENCIA", 
                                tradicado.RADI_NUME_RADI as "CHR_RADI_NUME_RADI" FROM 
                                Radicado tradicado,dependencia tdependencia WHERE
                                tradicado.RADI_DEPE_ACTU=tdependencia.DEPE_CODI
                                AND tradicado.radi_path is null AND 
                                substr(tradicado.RADI_NUME_RADI, 5, '.$this->longitud_codigo_dependencia.') = \''.$codigo_dependencia.'\'
                                AND '.$filtro_radicado.' 
                                order by tradicado.RADI_NUME_RADI DESC';
        /**Valido si vienen registros, sí no muestro error**/
        $rs_data_rad_sinimg = $this->db->conn->query($data_rad_sinimg);
        
        if(!$rs_data_rad_sinimg->fields["IDT_NUMERO RADICADO"])
        {
        /**Imprimo error**/
        echo "<span class=titulosError><center>
               !!! No se encontro nada con el criterio de busqueda !!!
              </center></span>";
        } else {
        /**Construyo listado con los radicados sin imagen **/
            $linkPagina            = "form_dig_list.php?action=listar";
            $paginador             = new ADODB_Pager($this->db, $data_rad_sinimg,                                                  'adodb', true, '1', 'DESC'); 
            $paginador->toRefLinks = $linkPagina;
            $paginador->toRefVars  = $encabezado;
            $paginador->Render($rows_per_page=20,$linkPagina,$checkbox=chkAnulados);
        }
    }

    /**
    * Genera el listado de radicados con imagen
    *
    * Genera el listado de radicados con imagen,
    * muestra los radicados dependiendo del filtro seleccionado de tipo de 
    * radicado, codigo de dependencia o por numero de radicado.
    *
    * @param string $tipo_radicado      Tipo de radicado a consultar (Ej: 2)
    * @param string $codigo_dependencia Codigo de la dependencia a consultar (0998)
    * @param string $radicado Numero del radicado a consultar
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return void
    */

    function listaRadImagen ($tipo_radicado, $codigo_dependencia, $radicado=null)
    {
        /**Obtengo la data de los radicados **/
	if ($radicado != null) {
		$filtro_radicado = " tradicado.radi_nume_radi LIKE '%".$radicado."%'";
	} else {
		$filtro_radicado = ' tradicado.RADI_NUME_RADI LIKE \'%'.$tipo_radicado.'%\'';
	}
        $data_rad_img_anex = 'Select tradicado.RADI_NUME_RADI AS "IDT_NUMERO RADICADO",
                                tradicado.RADI_PATH AS "HID_RADI_PATH",
                                tradicado.RADI_FECH_RADI AS "DAT_FECHA RADICADO",
                                tradicado.RA_ASUN AS "ASUNTO", tradicado.RADI_DEPE_ACTU AS "DEPENDENCIA ACTUAL",
                                tradicado.RADI_USUA_ACTU AS "USUARIO ACTUAL",
                                tdependencia.depe_nomb AS "NOMBRE DEPENDENCIA", 
                                tradicado.RADI_NUME_RADI as "CHR_RADI_NUME_RADI" FROM 
                                Radicado tradicado,dependencia tdependencia WHERE
                                tradicado.RADI_DEPE_ACTU=tdependencia.DEPE_CODI 
                                AND substr(tradicado.RADI_NUME_RADI, 5, '.$this->longitud_codigo_dependencia.') = \''.$codigo_dependencia.'\'
                                AND '.$filtro_radicado.' 
                                order by tradicado.RADI_NUME_RADI DESC';
        /**Valido si vienen registros, sí no muestro error**/
        $rs_data_rad_img_anex = $this->db->conn->query($data_rad_img_anex);
        
        if(!$rs_data_rad_img_anex->fields["IDT_NUMERO RADICADO"])
        {
        /**Imprimo error**/
        echo "<span class=titulosError><center>
               !!! No se encontro nada con el criterio de busqueda !!!
              </center></span>";
        } else {
        /**Construyo listado con los radicados sin imagen **/
            $linkPagina            = "form_dig_list.php?action=listar";
            $paginador             = new ADODB_Pager($this->db, $data_rad_img_anex,                                                  'adodb', true, '1', 'DESC'); 
            $paginador->toRefLinks = $linkPagina;
            $paginador->toRefVars  = $encabezado;
            $paginador->Render($rows_per_page=20,$linkPagina,$checkbox=chkAnulados);
        }
    }

    /**
    * Valida que opciones debo mostrar para asoc img a un radicado
    *
    * Genera la vaidación para saber si le muestro al usuario la opción de
    * asociar imagen a un radicado, reemplazar imagen y subir anexos
    *
    * @param string $radicadoDig   Numero de radicado
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return string $validacion
    */

    function validaOpcionesAsoc ($radicadoDig)
    {
        //Genero query de consulta
        $sql_rad_img = "Select radi_path from radicado
                        where radi_path is not null and
                        radi_nume_radi LIKE '%".$radicadoDig."%'";
        
        //Ejecuto la sql
        $rs_sql_rad_img = $this->db->conn->query($sql_rad_img);

        //Valido si tiene imagen o no
        if(!$rs_sql_rad_img->fields["RADI_PATH"]) {
            $validacion = '';
        } else {
            $validacion = '';
            //Busco el tipo de extensión para ver si tiene un pdf
            $info_archivo = pathinfo($rs_sql_rad_img->fields["RADI_PATH"]);
            switch($info_archivo['extension'])
            {
                case "PDF":
                case "pdf": $validacion = $rs_sql_rad_img->fields["RADI_PATH"];
                break;
               
                case "": // Handle file extension for files ending in '.'
                case NULL: // Handle no file extension
                break;
            }
        }
        return $validacion;
    }

    /**
    * Genera el listado de resultados de consultas
    *
    * Genera el listado de resultados que se traen con el radicado,
    * consultado por el formulario 
    *
    * @param string $radicadoDig    Radicado a consultar
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return void Tabla radicado encontrados
    */

    function listaRadConsulta ($radicadoDig)
    {
        /**Obtengo la data de los radicados **/
        $data_rad_consulta = 'Select tradicado.RADI_NUME_RADI AS "IDT_NUMERO RADICADO",
                                tradicado.RADI_PATH AS "HID_RADI_PATH",
                                tradicado.RADI_FECH_RADI AS "DAT_FECHA RADICADO",
                                tradicado.RA_ASUN AS "ASUNTO", tradicado.RADI_DEPE_ACTU AS "DEPENDENCIA ACTUAL",
                                tradicado.RADI_USUA_ACTU AS "USUARIO ACTUAL",
                                tdependencia.depe_nomb AS "NOMBRE DEPENDENCIA", 
                                tradicado.RADI_NUME_RADI as "CHR_RADI_NUME_RADI" FROM 
                                Radicado tradicado,dependencia tdependencia WHERE
                                tradicado.RADI_DEPE_ACTU=tdependencia.DEPE_CODI
                                AND tradicado.radi_nume_radi like \'%'.$radicadoDig.'%\'';
        /**Valido si vienen registros, sí no muestro error**/
        $rs_data_rad_consulta = $this->db->conn->query($data_rad_consulta);

        if(!$rs_data_rad_consulta->fields["IDT_NUMERO RADICADO"])
        {
        /**Imprimo error**/
        echo "<span class=titulosError><center>
               !!! No se encontro nada con el criterio de busqueda !!!
              </center></span>";
        } else {
        /**Construyo listado con los radicados sin imagen **/
            $linkPagina            = "form_dig_consulta.php";
            $paginador             = new ADODB_Pager($this->db, $data_rad_consulta,
                                                       'adodb', true, '1', 'DESC');
            $paginador->toRefLinks = $linkPagina;
            $paginador->toRefVars  = $encabezado;
            $paginador->Render($rows_per_page=20,$linkPagina,$checkbox=chkAnulados);
        }
    }

    /**
    * Hace la carga de archivos a la bodega
    *
    * Genera la secuencia de carga de archivos a la bodega del aplicativo,
    * sube y valida el tipo de archivo y ruta
    *
    * @param string $file           Objeto php files
    * @param string $radicadoDig    Radicado a subir
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return void True o False en la carga del archivo
    */

    function subirArchivo ($radicadoDig, $accion, $upload = null)
    {
        //Clase upload para la carga de archivos
        include_once dirname(__FILE__).DIRECTORY_SEPARATOR."../../include/upload/upload_class.php";
        //Tamaño maximo para la carga
        $max_size = $this->return_bytes(ini_get('upload_max_filesize'));
        //instancio clase file upload
        $my_upload = new file_upload;
        //lenguaje
        $my_upload->language="es";
        //Carpeta para cargar los archivos
        $my_upload->upload_dir = dirname(__FILE__).DIRECTORY_SEPARATOR."../../bodega/tmp/";
        //Extensiones permitidas
        $my_upload->extensions = array(".pdf");
        //Longitud nombre de archivo, debe coincidir con el tamaño del archivo en
        //la bd
        $my_upload->max_length_filename = 50;
        //Bandera renombra archivo
        $my_upload->rename_file = true;
        $tmpFile = trim($_FILES['upload']['name']);
        $uploadDir = dirname(__FILE__).DIRECTORY_SEPARATOR."../../bodega/"
                    .substr($radicadoDig,0,4)."/".substr($radicadoDig,4,
                     $this->longitud_codigo_dependencia)."/";
        //Valido que accion voy a realizar
        if ($accion == "reemplazar")
        {
            //Valido version actual
            $numero_version = $this->obtenerVersionamientoImagen($radicadoDig);
            //Asigno nombre del archivo
            $newFile = $radicadoDig.$numero_version["postfijo"];
            //Asigno ruta del archivo
            $fileGrb = substr($radicadoDig, 0, 4)."/".
                       substr($radicadoDig, 4, $this->longitud_codigo_dependencia)
                       ."/$radicadoDig".$numero_version["postfijo"]."."
                       .substr($tmpFile,-3);
        } 
	if ($accion == "asociar") {
            //Valido version actual
            $numero_version = $this->obtenerVersionamientoImagen($radicadoDig);
            //Asigno nombre del archivo
            $newFile = $radicadoDig.$numero_version["postfijo"];
            //Asigno ruta del archivo
            $fileGrb = substr($radicadoDig,0,4)."/"
                       .substr($radicadoDig,4,$this->longitud_codigo_dependencia)
                       ."/$radicadoDig".$numero_version["postfijo"]."."
                       .substr($tmpFile,-3);
        } 
	if ($accion == "anexo") {
            //Incluyo librerias para control de anexos
            include_once dirname(__FILE__).DIRECTORY_SEPARATOR."../../class_control/anexo.php";
            include_once dirname(__FILE__).DIRECTORY_SEPARATOR."../../class_control/anex_tipo.php";
            //Instancio clases de control de anexos
            $anex = & new Anexo($this->db);
            $anexTip = & new Anex_tipo($this->db);
            //Asigno tipo de anexo a subir, por defecto el 7 en el sisstema es PDF
            $tipo = 7;
            //Obtengo el siguiente numero del anexo
            $auxnumero=$anex->obtenerMaximoNumeroAnexo($radicadoDig);
                //Secuencia de asignación nombre archivo y consecutivo nuevo anexo
                do
                {
                    $auxnumero+=1;
                    $codigo=trim($radicadoDig).trim(str_pad($auxnumero,5,"0",STR_PAD_LEFT));
                }while ($anex->existeAnexo($codigo));
            //Obtengo el tipo de anexo
            $anexTip->anex_tipo_codigo($tipo);
            //Obtengo la extension del anexo
            $ext=$anexTip->get_anex_tipo_ext();
            $ext = strtolower($ext);
            //Formateo data para conformar el nombre de archivo
            $auxnumero = str_pad($auxnumero,5,"0",STR_PAD_LEFT);
            $archivo=trim($radicadoDig."_".$auxnumero.".".$ext);
            $archivoconversion=trim("1").trim(trim($radicadoDig)."_".trim($auxnumero).".".trim($ext));
            //Asigno nombre del archivo 
            $newFile = trim("1").trim(trim($radicadoDig)."_".trim($auxnumero));
            //Asigno ruta del archivo
            $fileGrb = substr($radicadoDig,0,4)."/".substr($radicadoDig,4,$this->longitud_codigo_dependencia)."/docs/".$archivoconversion;
	    $uploadDir = dirname(__FILE__).DIRECTORY_SEPARATOR."../../bodega/"
                    .substr($radicadoDig,0,4)."/".substr($radicadoDig,4,
                     $this->longitud_codigo_dependencia)."/docs/";

        }
        //Asigno directorio de carga 
        $my_upload->upload_dir = $uploadDir;
        //Tomo nombre del archivo temporal cargado
        $my_upload->the_temp_file = $_FILES['upload']['tmp_name'];
        //Tomo nombre del archivo suido
        $my_upload->the_file = $_FILES['upload']['name'];
        //Capturo los posibles errores generados en la carga
        $my_upload->http_error = $_FILES['upload']['error'];
        //Envio condicional verdadero para validar nombre del archivo
        $my_upload->do_filename_check = "y";
        //Realizo la carga del archivo, envio nuevo nombre que va
        // a tomar el archivo.
        if ($my_upload->upload($newFile))
        {
            //Obtengo la ruta de carga del archivo
            $full_path = $my_upload->upload_dir.$my_upload->file_copy;
            //Genero array con información sobre la carga de archivo
            $info_archivo_final["RUTA_ARCHIVO"] = strtoupper(substr($fileGrb,0,-3))."pdf";
            $info_archivo_final["RUTA_ARCHIVO"] = str_replace("DOCS", "docs", $info_archivo_final["RUTA_ARCHIVO"]);
            $info_archivo_final["NOMBRE_ARCHIVO"] = strtoupper(basename($full_path));
            $info_archivo_final["NOMBRE_ARCHIVO"] = str_replace("DOCS", "docs", $info_archivo_final["NOMBRE_ARCHIVO"]);
            $info_archivo_final["RUTA_TOTAL"] = str_replace("DOCS", "docs", $full_path);
            $info_archivo_final["TAMANO"] = ($_FILES['upload']['size']/1000);
            $info_archivo_final["ANEX_CODIGO"] = $codigo; 
            $info_archivo_final["ANEX_NUMERO"] = $auxnumero; 
            $info_archivo_final["ANEX_NOMB_ARCHIVO"] = $archivoconversion; 
            //Devuelvo información del archivo en caso de que todo salga bien
            return $info_archivo_final; 
        } else {
            //Si no puedo subir el archivo cierro las tareas y muestro error
            $this->db->conn->CompleteTrans();
            die("<table class=borde_tab><tr>
                 <td class=titulosError>
                 Ocurrio un Error la Fila no fue cargada Correctamente <p>"
                 .$my_upload->show_error_string()."<br><blockquote>"
                  .nl2br($info)."</blockquote></td></tr></table>"
            );
        }
    }

    /**
    * Hace la carga de archivos a la bodega
    *
    * Genera la secuencia de carga de archivos a la bodega del aplicativo,
    * sube y valida el tipo de archivo y ruta
    *
    * @param string $var           tamaño de archivo
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return void True o False en la carga del archivo
    */

    function return_bytes($val)
    {
        $val = trim($val);
        $ultimo = strtolower($val{strlen($val)-1});
        switch($ultimo)
        {       // El modificador 'G' se encuentra disponible desde PHP 5.1.0
                case 'g':       $val *= 1024;
                case 'm':       $val *= 1024;
                case 'k':       $val *= 1024;
        }
        return $val;
    }   

    /**
    * Hace la tabla para mostrar las versiones de digitalización 
    * que tiene de la imagen principal un radicado en el momento
    *
    * @param string $radicado  Radicado a consultar
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * 
    * @return $tabla string Devuelve la tabla o error en caso de no tener
    *                       Imagenes   
    */

    function listaHistImagen($radicado)
    {
        $radicado = trim($radicado);
        /**Obtengo la data del radicado **/
        $data_rad_consulta = 'SELECT radicado.radi_nume_radi as "IDT_NUMERO RADICADO", 
                                     radicado.radi_path as "HID_RADI_PATH",
                                     radicado.numero_version as "NUMERO VERSION",
                                     radicado.tamano_archivo as "TAMAÑO",
                                     radicado.sha1_archivo as "HUELLA DIGITAL",
                                     usuarios.usua_nomb as "USUARIO DIGITALIZADOR"
                                     FROM sgd_versiones_imgrad radicado
                                     INNER JOIN usuario usuarios 
                                     ON radicado.doc_usu_upload = usuarios.usua_doc
                                     WHERE radi_nume_radi LIKE \'%'.$radicado.'%\'';

        /**Valido si vienen registros, sí no muestro error**/
        $rs_data_rad_consulta = $this->db->conn->query($data_rad_consulta);

        if(!$rs_data_rad_consulta->fields["IDT_NUMERO RADICADO"])
        {
        /**Imprimo error**/
        echo "<span class=titulosError><center>
               !!! No se encontro ningun historico asociado con 
                   el criterio de busqueda !!!
              </center></span>";
        } else {
        /**Construyo listado con los radicados sin imagen **/
            $linkPagina            = "form_dig_consulta.php";
            $paginador             = new ADODB_Pager($this->db, $data_rad_consulta,
                                                       'adodb', true, '1', 'DESC');
            $paginador->toRefLinks = $linkPagina;
            $paginador->toRefVars  = $encabezado;
            $paginador->Render($rows_per_page=20,$linkPagina,$checkbox=chkAnulados);
        }
    }

    /**
    * Consulta los datos del radicado para incluirlos en el sticker
    *
    * @author     Pablo Villate <pvillate@skinatech.com>
    * 
    * @return string 
    */

    function getRecordData ($radicado)
    {
        $data = array();
	/**Genero la query para traer los datos del radicado segun los parametros recibidos**/
	$record_data_sql = $this->db->conn->query(
	    "SELECT radicado.radi_nume_radi, radicado.ra_asun, TO_CHAR(radicado.RADI_FECH_RADI, 'YYYY-MM-DD HH24:MI:SS') AS radi_fech_radi,
	    dependencia.depe_nomb AS origen, direcciones.sgd_dir_nomremdes, 
	    usuario.usua_nomb, dependencia_destino.depe_nomb AS destino
	    FROM radicado 
	    INNER JOIN dependencia ON radicado.radi_depe_radi=dependencia.depe_codi
	    INNER JOIN dependencia dependencia_destino ON radicado.radi_depe_actu=dependencia_destino.depe_codi
	    INNER JOIN sgd_dir_drecciones direcciones ON radicado.radi_nume_radi=direcciones.radi_nume_radi
	    INNER JOIN usuario ON (radicado.radi_usua_radi=usuario.usua_codi AND radicado.radi_depe_radi=usuario.depe_codi)
	    WHERE radicado.radi_nume_radi LIKE '%".$radicado."%'"
	);
        if($record_data_sql->fields["RADI_NUME_RADI"]) {

		$fila=$record_data_sql->FetchRow();
		$data[0]=$fila["RADI_NUME_RADI"];
		$data[1]=$fila["RA_ASUN"];
		$data[2]=$fila["USUA_NOMB"];
		$data[3]=$fila["ORIGEN"];
                $data[4]=$fila["RADI_FECH_RADI"]; 
		//$data[4]=date('Y-m-d H:i:s', strtotime($fila["RADI_FECH_RADI"]));
		$data[5]=$fila["DESTINO"];
		$data[6]=$fila["SGD_DIR_NOMREMDES"];
	}
      	
	return $data; 

    }
    /**
    * Anexar archivo 
    *
    *  
    *
    * @param string $radicado      		Numero de radicado de entrada
    * @param string $dependencia_origen		Dependencia donde se realiza el anexo
    * @param string $usuario_origen		Usuario que realiza el anexo
    * @param string $departamento		Departamento donde se realiza el anexo
    * @param string $municipio			Municipio donde se realiza el anexo
    * @param string $descripcion		Descripcion del anexo donde se realiza el anexo
    * @param string $documento			Dodumento del usuario que genera el anexo
    * @param string $transaccion		Codigo de transaccion para el historial
    * @param string $archivo			Nombre del archivo a subir
    * 
    * @author     Camilo Pintor <cpintor@skinatech.com>
    * @author     Pablo Villate <pvillate@skinatech.com>
    * 
    * @return string $head
    */

    function anexarArchivo ($radicado, $dependencia_origen, $usuario_origen, $departamento, $municipio, $descripcion, $documento, $transaccion, $archivo, $krd)
    {
        $file_info = $this->subirArchivo($radicado, 'anexo');
	$ruta_archivo = str_replace("DOCS", "docs", $file_info['RUTA_ARCHIVO']); 
	$tamano_archivo = $file_info['TAMANO']; 
	
	$insert_anexo_sql = "INSERT INTO anexos (
			anex_radi_nume, 
			anex_codigo, 
			anex_tipo, 
			anex_tamano, 
			anex_solo_lect,
			anex_creador, 
			anex_desc, 
			anex_numero, 
			anex_nomb_archivo, 
			anex_borrado, 
			anex_salida,
			radi_nume_salida, 
			anex_radi_fech, 
			anex_estado, 
			sgd_rem_destino, 
			sgd_dir_tipo, 
			anex_depe_creador,
			anex_fech_anex, 
			sgd_trad_codigo
		) VALUES (
			'".$radicado."',
			'".$file_info['ANEX_CODIGO']."', 
			7, 
			$tamano_archivo, 
			'S', 
			'".$krd."', 
			'".$descripcion."',
			".$file_info['ANEX_NUMERO'].",
			'".$file_info['ANEX_NOMB_ARCHIVO']."', 
			'N', 
			1, 
			null, 
			null, 
			0,
			1, 
			1, 
			'".$dependencia_origen."', 
			".$this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp).", 
			null
		)";

		$insert_historico_sql = "INSERT INTO hist_eventos VALUES(
		'".$dependencia_origen."', 
		".$this->db->conn->OffsetDate(0,$this->db->conn->sysTimeStamp).", 
		".$usuario_origen.", 
		'".$radicado."', 
		'Anexado desde digitalización web', 
		1, 
		'".$documento."', 
		'".$documento."',
		29, 
		NULL, 
		NULL, 
		'".$dependencia_origen."'
	)";

	$insertar_anexo = $this->db->conn->Execute($insert_anexo_sql);
	$insertar_historico = $this->db->conn->Execute($insert_historico_sql);

	if ($insertar_anexo != false && $insertar_historico != false) {
		$this->db->conn->CompleteTrans();
		echo "<script>
			alert('Anexo realizado correctamente, puede encontrarlo en la pestaña de documentos');
			window.close();
			</script>";
	} else {
		echo "<script>alert('Ha ocurrido un error intente nuevamente');</script>";
	}
    }
}
?>
