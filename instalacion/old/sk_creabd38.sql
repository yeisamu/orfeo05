--
-- PostgreSQL database dump
--

SET client_encoding = 'UTF8';
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA public IS 'Standard public schema';


--
-- Name: plpgsql; Type: PROCEDURAL LANGUAGE; Schema: -; Owner: 
--

CREATE PROCEDURAL LANGUAGE plpgsql;


SET search_path = public, pg_catalog;

--
-- Name: concat(text, text); Type: FUNCTION; Schema: public; Owner: postgres
--

CREATE FUNCTION concat(text, text) RETURNS text
    AS $_$select case when $1 = '' then $2 else ($1 || ', ' || $2) end$_$
    LANGUAGE sql;


ALTER FUNCTION public.concat(text, text) OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE usuario (
    usua_codi numeric(10,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_login character varying(50) NOT NULL,
    usua_fech_crea date,
    usua_pasw character varying(35) NOT NULL,
    usua_esta character varying(10) NOT NULL,
    usua_nomb character varying(45),
    perm_radi character(1) DEFAULT 0,
    usua_admin character(1) DEFAULT 0,
    usua_nuevo character(1) DEFAULT 0,
    usua_doc character varying(14) DEFAULT 0,
    codi_nivel numeric(2,0) DEFAULT 1,
    usua_sesion character varying(30),
    usua_fech_sesion date,
    usua_ext numeric(4,0),
    usua_nacim date,
    usua_email character varying(50),
    usua_at character varying(50),
    usua_piso numeric(2,0),
    perm_radi_sal numeric DEFAULT 0,
    usua_admin_archivo numeric(1,0) DEFAULT 0,
    usua_masiva numeric(1,0) DEFAULT 0,
    usua_perm_dev numeric(1,0) DEFAULT 0,
    usua_perm_numera_res character varying(1),
    usua_doc_suip character varying(15),
    usua_perm_numeradoc numeric(1,0),
    sgd_panu_codi numeric(4,0),
    usua_prad_tp1 numeric(1,0) DEFAULT 0,
    usua_prad_tp2 numeric(1,0) DEFAULT 0,
    usua_perm_envios numeric(1,0) DEFAULT 0,
    usua_perm_modifica numeric(1,0) DEFAULT 0,
    usua_perm_impresion numeric(1,0) DEFAULT 0,
    sgd_aper_codigo numeric(2,0),
    usu_telefono1 character varying(14),
    usua_encuesta character varying(1),
    sgd_perm_estadistica numeric(2,0),
    usua_perm_sancionados numeric(1,0),
    usua_admin_sistema numeric(1,0),
    usua_perm_trd numeric(1,0),
    usua_perm_firma numeric(1,0),
    usua_perm_prestamo numeric(1,0),
    usuario_publico numeric(1,0),
    usuario_reasignar numeric(1,0),
    usua_perm_notifica numeric(1,0),
    usua_perm_expediente numeric,
    usua_login_externo character varying(15),
    id_pais numeric(4,0) DEFAULT 170,
    id_cont numeric(2,0) DEFAULT 1,
    usua_auth_ldap numeric(1,0) DEFAULT 0 NOT NULL,
    perm_archi character(1) DEFAULT 1,
    perm_vobo character(1) DEFAULT 1,
    perm_borrar_anexo numeric(1,0),
    perm_tipif_anexo numeric(1,0),
    usua_perm_adminflujos numeric(1,0) DEFAULT 0 NOT NULL,
    usua_exp_trd numeric(2,0) DEFAULT 0,
    usua_perm_parques numeric(1,0),
    usua_perm_emp numeric(1,0),
    "USUA_PERM_RADEMAIL" smallint,
    usua_prad_tp7 smallint,
    usua_prad_tp8 smallint,
    usua_prad_tp3 smallint,
    usua_prad_tp4 smallint,
    usua_prad_tp5 smallint,
    usua_prad_tp6 smallint,
    usua_prad_tp9 smallint
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: TABLE usuario; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE usuario IS 'USUARIO';


--
-- Name: COLUMN usuario.usua_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_codi IS 'CODIGO DE USUARIO';


--
-- Name: COLUMN usuario.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.depe_codi IS 'DEPE_CODI';


--
-- Name: COLUMN usuario.usua_login; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_login IS 'LOGIN USUARIO';


--
-- Name: COLUMN usuario.usua_fech_crea; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_fech_crea IS 'FECHA DE CREACION DEL USUARIO';


--
-- Name: COLUMN usuario.usua_pasw; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_pasw IS 'USUA_PASW';


--
-- Name: COLUMN usuario.usua_esta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_esta IS 'ESTADO DEL USUARIO - Activo o No (1/0)';


--
-- Name: COLUMN usuario.usua_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_nomb IS 'NOMBRE DEL USUARIO';


--
-- Name: COLUMN usuario.perm_radi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.perm_radi IS 'Permiso para digitalizacion de documentos: 1 permiso asignado';


--
-- Name: COLUMN usuario.usua_admin; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_admin IS 'Prestamo de documentos fisicos: 0 sin permiso -  1 permiso asignado ';


--
-- Name: COLUMN usuario.usua_nuevo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_nuevo IS 'Usuario Nuevo ? Si esta en ''0'' resetea la contrase?a';


--
-- Name: COLUMN usuario.usua_doc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_doc IS 'No. de Documento de Identificacion. ';


--
-- Name: COLUMN usuario.codi_nivel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.codi_nivel IS 'Nivel del Usuario';


--
-- Name: COLUMN usuario.usua_sesion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_sesion IS 'Sesion Actual del usuario o Ultima fecha que entro.';


--
-- Name: COLUMN usuario.usua_fech_sesion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_fech_sesion IS 'Fecha de Actual de la session o Ultima Fecha.';


--
-- Name: COLUMN usuario.usua_ext; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_ext IS 'Numero de extension del usuario';


--
-- Name: COLUMN usuario.usua_nacim; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_nacim IS 'Fecha Nacimiento';


--
-- Name: COLUMN usuario.usua_email; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_email IS 'Mail';


--
-- Name: COLUMN usuario.usua_at; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_at IS 'Nombre del Equipo';


--
-- Name: COLUMN usuario.usua_piso; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_piso IS 'Piso en el que se encuentra laborando';


--
-- Name: COLUMN usuario.usua_admin_archivo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_admin_archivo IS 'Administrador de Archivo (Expedientes): 0 sin permiso - 1 permiso asignado ';


--
-- Name: COLUMN usuario.usua_masiva; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_masiva IS 'Permiso de radicacion masiva de documentos';


--
-- Name: COLUMN usuario.usua_perm_dev; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_dev IS 'Devoluciones de correo (Dev_correo): 0 sin permiso - 1 permiso asignado';


--
-- Name: COLUMN usuario.sgd_panu_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.sgd_panu_codi IS 'Permisos de anulacion de radicados: 1 - Permiso de solicitud de anulado 2- Permiso de anulacion y generacion de actas 3- Permiso 1 y 2';


--
-- Name: COLUMN usuario.usua_prad_tp1; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_prad_tp1 IS 'Si esta en ''1'' El usuario Tiene Permisos de radicacicion Tipo 1.  En nuestro caso de salida';


--
-- Name: COLUMN usuario.usua_prad_tp2; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_prad_tp2 IS 'Si esta en ''2'' El usuario Tiene Permisos de radicacicion Tipo 2.  En nuestro caso de Entrada';


--
-- Name: COLUMN usuario.usua_perm_envios; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_envios IS 'Envios de correo (correspondencia): 0 sin permiso - 1 permiso asignado';


--
-- Name: COLUMN usuario.usua_perm_modifica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_modifica IS 'Permiso de modificar Radicados';


--
-- Name: COLUMN usuario.usua_perm_impresion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_impresion IS 'Carpeta de impresion: 0 sin permiso - 1 permiso asignado';


--
-- Name: COLUMN usuario.sgd_perm_estadistica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.sgd_perm_estadistica IS 'Si tiene ''1'' tiene permisos como jefe para ver las estadisticas de la dependencia.';


--
-- Name: COLUMN usuario.usua_admin_sistema; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_admin_sistema IS 'Administrador del sistema : 0 sin permiso - 1 permiso asignado';


--
-- Name: COLUMN usuario.usua_perm_trd; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_trd IS 'Usuario Administracion de tablas de retencion documental : 0 sin permiso - 1 permiso asignado';


--
-- Name: COLUMN usuario.usua_perm_prestamo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_prestamo IS 'Indica si un usuario tiene o no permiso de acceso al modulo de prestamo. Segun su valor:

Tiene permiso

(0) No tiene permiso';


--
-- Name: COLUMN usuario.perm_borrar_anexo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.perm_borrar_anexo IS 'Indica si un usuario tiene (1) o no (0) permiso para tipificar anexos .tif';


--
-- Name: COLUMN usuario.perm_tipif_anexo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.perm_tipif_anexo IS 'Indica si un usuario tiene (1)  o no (0) permiso para tipificar anexos .tif';


--
-- Name: COLUMN usuario.usua_perm_parques; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_parques IS 'Permiso para administrar parques';


--
-- Name: COLUMN usuario.usua_perm_emp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario.usua_perm_emp IS 'Permiso para modificar empresas';


--
-- Name: COLUMN usuario."USUA_PERM_RADEMAIL"; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN usuario."USUA_PERM_RADEMAIL" IS 'Permiso de radicacion de email';


--
-- Name: V_USUARIO; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW "V_USUARIO" AS
    SELECT usuario.usua_codi, usuario.usua_nomb, usuario.usua_login, usuario.depe_codi FROM usuario;


ALTER TABLE public."V_USUARIO" OWNER TO postgres;

--
-- Name: anexos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos (
    anex_radi_nume numeric(15,0) NOT NULL,
    anex_codigo character varying(20) NOT NULL,
    anex_tipo numeric(4,0) NOT NULL,
    anex_tamano numeric,
    anex_solo_lect character varying(1) NOT NULL,
    anex_creador character varying(50) NOT NULL,
    anex_desc character varying(512),
    anex_numero numeric(5,0) NOT NULL,
    anex_nomb_archivo character varying(50) NOT NULL,
    anex_borrado character varying(1) NOT NULL,
    anex_origen numeric(1,0) DEFAULT 0,
    anex_ubic character varying(15),
    anex_salida numeric(1,0) DEFAULT 0,
    radi_nume_salida numeric(15,0),
    anex_radi_fech timestamp with time zone,
    anex_estado numeric(1,0) DEFAULT 0,
    usua_doc character varying(14),
    sgd_rem_destino numeric(1,0) DEFAULT 0,
    anex_fech_envio timestamp with time zone,
    sgd_dir_tipo numeric(4,0),
    anex_fech_impres timestamp with time zone,
    anex_depe_creador numeric(4,0),
    sgd_doc_secuencia numeric(15,0),
    sgd_doc_padre character varying(20),
    sgd_arg_codigo numeric(2,0),
    sgd_tpr_codigo numeric(4,0),
    sgd_deve_codigo numeric(2,0),
    sgd_deve_fech date,
    sgd_fech_impres timestamp without time zone,
    anex_fech_anex timestamp with time zone,
    anex_depe_codi character varying(3),
    sgd_pnufe_codi numeric(4,0),
    sgd_dnufe_codi numeric(4,0),
    anex_usudoc_creador character varying(15),
    sgd_fech_doc date,
    sgd_apli_codi numeric(4,0),
    sgd_trad_codigo numeric(2,0),
    sgd_dir_direccion character varying(150),
    sgd_exp_numero character varying(18),
    numero_doc character varying(15),
    sgd_srd_codigo character varying(3),
    sgd_sbrd_codigo character varying(4)
);


ALTER TABLE public.anexos OWNER TO postgres;

--
-- Name: COLUMN anexos.numero_doc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN anexos.numero_doc IS 'Numero de documento';


--
-- Name: COLUMN anexos.sgd_srd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN anexos.sgd_srd_codigo IS 'Serie';


--
-- Name: COLUMN anexos.sgd_sbrd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN anexos.sgd_sbrd_codigo IS 'Subserie';


--
-- Name: anexos_historico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos_historico (
    anex_hist_anex_codi character varying(20) NOT NULL,
    anex_hist_num_ver numeric(4,0) NOT NULL,
    anex_hist_tipo_mod character varying(2) NOT NULL,
    anex_hist_usua character varying(15) NOT NULL,
    anex_hist_fecha date NOT NULL,
    usua_doc character varying(14)
);


ALTER TABLE public.anexos_historico OWNER TO postgres;

--
-- Name: anexos_tipo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE anexos_tipo (
    anex_tipo_codi numeric(4,0) NOT NULL,
    anex_tipo_ext character varying(10) NOT NULL,
    anex_tipo_desc character varying(50)
);


ALTER TABLE public.anexos_tipo OWNER TO postgres;

--
-- Name: aux_01; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE aux_01 (
    r numeric
);


ALTER TABLE public.aux_01 OWNER TO postgres;

--
-- Name: bodega_empresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bodega_empresas (
    nombre_de_la_empresa character varying(300),
    nuir character varying(13),
    nit_de_la_empresa character varying(80),
    sigla_de_la_empresa character varying(80),
    direccion character varying(4000),
    codigo_del_departamento character varying(4000),
    codigo_del_municipio character varying(4000),
    telefono_1 character varying(4000),
    telefono_2 character varying(4000),
    email character varying(4000),
    nombre_rep_legal character varying(4000),
    cargo_rep_legal character varying(4000),
    identificador_empresa numeric(5,0),
    are_esp_secue numeric(8,0) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    activa numeric(1,0) DEFAULT 1,
    flag_rups character varying(10)
);


ALTER TABLE public.bodega_empresas OWNER TO postgres;

--
-- Name: bodega_empresas_old; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE bodega_empresas_old (
    identificador_de_la_empresa numeric(5,0) NOT NULL,
    nuir character varying(13),
    nombre_de_la_empresa character varying(150),
    nit_de_la_empresa character varying(13),
    sigla_de_la_empresa character varying(30),
    codigo_de_la_nat_juridica numeric(2,0),
    direccion character varying(50),
    codigo_del_departamento numeric(2,0),
    codigo_del_municipio numeric(3,0),
    codigo_de_la_unidad numeric(3,0),
    telefono_1 character varying(15),
    telefono_2 character varying(15),
    telefono_3 character varying(15),
    apartado_aereo numeric(10,0),
    numero_de_fax character varying(15),
    zona_postal numeric(3,0),
    email character varying(50),
    tiene_contab_por_servicio character varying(2),
    fecha_de_actualizacion date,
    codigo_regional numeric(3,0),
    estado_de_la_empresa character varying(50),
    fecha_del_estado date,
    obsv_del_estado character varying(100),
    esp_cias numeric(4,0),
    esp_auxi numeric(8,0),
    esp_etco numeric(2,0),
    esp_ceco character varying(16),
    estado numeric(2,0),
    tipo_identificacion_repl character varying(1),
    numero_identificaci_repl character varying(11),
    nombre_rep_legal character varying(75),
    cargo_rep_legal numeric(2,0),
    numero_camara_ccio character varying(20),
    cod_estado_vigilancia numeric(2,0),
    identificador_empresa numeric(5,0) NOT NULL,
    nombre_de_la_empresa_anterior character varying(150),
    direccion_anterior character varying(50)
);


ALTER TABLE public.bodega_empresas_old OWNER TO postgres;

--
-- Name: borrar_carpeta_personalizada; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE borrar_carpeta_personalizada (
    carp_per_codi numeric(2,0) NOT NULL,
    carp_per_usu character varying(15) NOT NULL,
    carp_per_desc character varying(80) NOT NULL
);


ALTER TABLE public.borrar_carpeta_personalizada OWNER TO postgres;

--
-- Name: borrar_empresa_esp; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE borrar_empresa_esp (
    eesp_codi numeric(7,0) NOT NULL,
    eesp_nomb character varying(150) NOT NULL,
    essp_nit character varying(13),
    essp_sigla character varying(30),
    depe_codi numeric(2,0),
    muni_codi numeric(4,0),
    eesp_dire character varying(50),
    eesp_rep_leg character varying(75)
);


ALTER TABLE public.borrar_empresa_esp OWNER TO postgres;

--
-- Name: TABLE borrar_empresa_esp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE borrar_empresa_esp IS 'EMPRESA_ESP';


--
-- Name: COLUMN borrar_empresa_esp.eesp_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN borrar_empresa_esp.eesp_codi IS 'CODGO DE EMPRESA DE SERVICIOS PUBLICOS';


--
-- Name: COLUMN borrar_empresa_esp.eesp_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN borrar_empresa_esp.eesp_nomb IS 'NOMBRE DE EMPRESA';


--
-- Name: COLUMN borrar_empresa_esp.essp_nit; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN borrar_empresa_esp.essp_nit IS 'ESSP_NIT';


--
-- Name: COLUMN borrar_empresa_esp.essp_sigla; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN borrar_empresa_esp.essp_sigla IS 'ESSP_SIGLA';


--
-- Name: COLUMN borrar_empresa_esp.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN borrar_empresa_esp.depe_codi IS 'DEPE_CODI';


--
-- Name: COLUMN borrar_empresa_esp.muni_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN borrar_empresa_esp.muni_codi IS 'MUNI_CODI';


--
-- Name: carpeta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE carpeta (
    carp_codi numeric(2,0) NOT NULL,
    carp_desc character varying(80) NOT NULL
);


ALTER TABLE public.carpeta OWNER TO postgres;

--
-- Name: TABLE carpeta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE carpeta IS 'CARPETA';


--
-- Name: COLUMN carpeta.carp_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN carpeta.carp_codi IS 'CARP_CODI';


--
-- Name: COLUMN carpeta.carp_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN carpeta.carp_desc IS 'CARP_DESC';


--
-- Name: carpeta_per; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE carpeta_per (
    usua_codi numeric(3,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    nomb_carp character varying(10),
    desc_carp character varying(30),
    codi_carp numeric(3,0) DEFAULT 99
);


ALTER TABLE public.carpeta_per OWNER TO postgres;

--
-- Name: centro_poblado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE centro_poblado (
    cpob_codi numeric(4,0) NOT NULL,
    muni_codi numeric(4,0) NOT NULL,
    dpto_codi numeric(2,0) NOT NULL,
    cpob_nomb character varying(100) NOT NULL,
    cpob_nomb_anterior character varying(100)
);


ALTER TABLE public.centro_poblado OWNER TO postgres;

--
-- Name: TABLE centro_poblado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE centro_poblado IS 'CENTRO_POBLADO';


--
-- Name: COLUMN centro_poblado.cpob_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centro_poblado.cpob_codi IS 'CPOB_CODI';


--
-- Name: COLUMN centro_poblado.muni_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centro_poblado.muni_codi IS 'MUNI_CODI';


--
-- Name: COLUMN centro_poblado.dpto_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centro_poblado.dpto_codi IS 'DPTO_CODI';


--
-- Name: COLUMN centro_poblado.cpob_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN centro_poblado.cpob_nomb IS 'CPOB_NOMB';


--
-- Name: departamento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE departamento (
    dpto_codi numeric(3,0) NOT NULL,
    dpto_nomb character varying(70) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);


ALTER TABLE public.departamento OWNER TO postgres;

--
-- Name: TABLE departamento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE departamento IS 'DEPARTAMENTO';


--
-- Name: COLUMN departamento.dpto_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN departamento.dpto_codi IS 'DPTO_CODI';


--
-- Name: COLUMN departamento.dpto_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN departamento.dpto_nomb IS 'DPTO_NOMB';


--
-- Name: dependencia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dependencia (
    depe_codi numeric(5,0) NOT NULL,
    depe_nomb character varying(70) NOT NULL,
    dpto_codi numeric(2,0),
    depe_codi_padre numeric(5,0),
    muni_codi numeric(4,0),
    depe_codi_territorial numeric(4,0),
    dep_sigla character varying(100),
    dep_central numeric(1,0),
    dep_direccion character varying(100),
    depe_num_interna numeric(4,0),
    depe_num_resolucion numeric(4,0),
    depe_rad_tp1 numeric(3,0),
    depe_rad_tp2 numeric(3,0),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    depe_estado numeric(1,0) DEFAULT 0,
    depe_rad_tp7 smallint,
    depe_rad_tp8 smallint,
    depe_rad_tp3 smallint,
    depe_rad_tp4 smallint,
    depe_rad_tp5 smallint,
    depe_rad_tp6 smallint,
    depe_segu smallint
);


ALTER TABLE public.dependencia OWNER TO postgres;

--
-- Name: TABLE dependencia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE dependencia IS 'DEPENDENCIA';


--
-- Name: COLUMN dependencia.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN dependencia.depe_codi IS 'CODIGO DE DEPENDENCIA';


--
-- Name: COLUMN dependencia.depe_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN dependencia.depe_nomb IS 'NOMBRE DE DEPENDENCIA';


--
-- Name: COLUMN dependencia.dep_sigla; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN dependencia.dep_sigla IS 'SIGLA DE LA DEPENDENCIA';


--
-- Name: COLUMN dependencia.dep_central; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN dependencia.dep_central IS 'INDICA SI SE TRATA DE UNA DEPENDENCIA DEL NIVEL CENTRAL';


--
-- Name: COLUMN dependencia.depe_segu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN dependencia.depe_segu IS 'campo para  restringir acceso a la dependencia.';


--
-- Name: dependencia_visibilidad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dependencia_visibilidad (
    codigo_visibilidad numeric(18,0) NOT NULL,
    dependencia_visible numeric(5,0) NOT NULL,
    dependencia_observa numeric(5,0) NOT NULL
);


ALTER TABLE public.dependencia_visibilidad OWNER TO postgres;

--
-- Name: dependencias; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE dependencias
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 9999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.dependencias OWNER TO postgres;

--
-- Name: dup_eliminar; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE dup_eliminar (
    sgd_oem_codigo numeric(8,0) NOT NULL,
    tdid_codi numeric(2,0),
    sgd_oem_oempresa character varying(150),
    sgd_oem_rep_legal character varying(150),
    sgd_oem_nit character varying(14),
    sgd_oem_sigla character varying(50),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_oem_direccion character varying(100),
    sgd_oem_telefono character varying(50)
);


ALTER TABLE public.dup_eliminar OWNER TO postgres;

--
-- Name: emp_cod_actualizar; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE emp_cod_actualizar (
    emp_cod_ant character varying(10),
    emp_cod_nue character varying(10)
);


ALTER TABLE public.emp_cod_actualizar OWNER TO postgres;

--
-- Name: empresas_temporal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE empresas_temporal (
    nombre_de_la_empresa character varying(160),
    nuir character varying(13),
    nit_de_la_empresa character varying(80),
    sigla_de_la_empresa character varying(80),
    direccion character varying(4000),
    codigo_del_departamento character varying(4000),
    codigo_del_municipio character varying(4000),
    telefono_1 character varying(4000),
    telefono_2 character varying(4000),
    email character varying(4000),
    nombre_rep_legal character varying(4000),
    cargo_rep_legal character varying(4000),
    identificador_empresa numeric(5,0),
    are_esp_secue numeric(8,0) NOT NULL
);


ALTER TABLE public.empresas_temporal OWNER TO postgres;

--
-- Name: encuesta; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE encuesta (
    usua_doc character varying(14) NOT NULL,
    fecha date,
    p1 character varying(100),
    p2 character varying(100),
    p3 character varying(100),
    p4 character varying(100),
    p5 character varying(100),
    p6 character varying(100),
    p7 character varying(100),
    p7_cual character varying(150),
    p8 character varying(100),
    p9 character varying(100),
    p10 character varying(100),
    p11 character varying(100),
    p12 character varying(100),
    p13 character varying(100),
    p14 character varying(100),
    p15 character varying(100),
    p16 character varying(100),
    p17 character varying(100),
    p18 character varying(100),
    p19 character varying(100),
    p20 character varying(100),
    p20_cual character varying(150),
    p21 character varying(100),
    p22 character varying(100),
    p23 character varying(100),
    p24 character varying(100),
    p25 character varying(100)
);


ALTER TABLE public.encuesta OWNER TO postgres;

--
-- Name: entidades_asociativa; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE entidades_asociativa (
    nit character varying(12),
    codentidad numeric(10,0)
);


ALTER TABLE public.entidades_asociativa OWNER TO "admin";

--
-- Name: estado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE estado (
    esta_codi numeric(2,0) NOT NULL,
    esta_desc character varying(100) NOT NULL
);


ALTER TABLE public.estado OWNER TO postgres;

--
-- Name: TABLE estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE estado IS 'ESTADO';


--
-- Name: COLUMN estado.esta_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN estado.esta_codi IS 'ESTA_CODI';


--
-- Name: COLUMN estado.esta_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN estado.esta_desc IS 'ESTA_DESC';


--
-- Name: example; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE example (
    campo1 numeric(15,0) NOT NULL,
    campo2 character varying(10)
);


ALTER TABLE public.example OWNER TO postgres;

--
-- Name: fun_funcionario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE fun_funcionario (
    usua_doc character varying(14),
    usua_fech_crea date NOT NULL,
    usua_esta character varying(10) NOT NULL,
    usua_nomb character varying(45),
    usua_ext numeric(4,0),
    usua_nacim date,
    usua_email character varying(50),
    usua_at character varying(15),
    usua_piso numeric(2,0),
    cedula_ok character(1) DEFAULT 'n'::bpchar,
    cedula_suip character varying(15),
    nombre_suip character varying(45),
    observa character(20)
);


ALTER TABLE public.fun_funcionario OWNER TO postgres;

--
-- Name: fun_funcionario_2; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE fun_funcionario_2 (
    usua_doc character varying(14),
    usua_fech_crea date NOT NULL,
    usua_esta character varying(10) NOT NULL,
    usua_nomb character varying(45),
    usua_ext numeric(4,0),
    usua_nacim date,
    usua_email character varying(50),
    usua_at character varying(15),
    usua_piso numeric(2,0),
    cedula_ok character(1),
    cedula_suip character varying(15),
    nombre_suip character varying(45),
    observa character(20)
);


ALTER TABLE public.fun_funcionario_2 OWNER TO postgres;

--
-- Name: hist_eventos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE hist_eventos (
    depe_codi numeric(5,0) NOT NULL,
    hist_fech timestamp with time zone NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    hist_obse character varying(10000) NOT NULL,
    usua_codi_dest numeric(10,0),
    usua_doc character varying(14),
    usua_doc_old character varying(15),
    sgd_ttr_codigo numeric(3,0),
    hist_usua_autor character varying(14),
    hist_doc_dest character varying(14),
    depe_codi_dest numeric(3,0)
);


ALTER TABLE public.hist_eventos OWNER TO postgres;

--
-- Name: TABLE hist_eventos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE hist_eventos IS 'HIST_EVENTOS';


--
-- Name: COLUMN hist_eventos.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.depe_codi IS 'DEPE_CODI';


--
-- Name: COLUMN hist_eventos.hist_fech; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.hist_fech IS 'HIST_FECH';


--
-- Name: COLUMN hist_eventos.usua_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.usua_codi IS 'USUA_CODI';


--
-- Name: COLUMN hist_eventos.radi_nume_radi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.radi_nume_radi IS 'Numero de Radicado';


--
-- Name: COLUMN hist_eventos.hist_obse; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.hist_obse IS 'HIST_OBSE';


--
-- Name: COLUMN hist_eventos.usua_codi_dest; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.usua_codi_dest IS 'Codigo del usuario destino.';


--
-- Name: COLUMN hist_eventos.sgd_ttr_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.sgd_ttr_codigo IS 'Tipo de Evento';


--
-- Name: COLUMN hist_eventos.hist_doc_dest; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.hist_doc_dest IS 'Documento del usuario destino No. implentado';


--
-- Name: COLUMN hist_eventos.depe_codi_dest; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN hist_eventos.depe_codi_dest IS 'Codigo de la dependencia del usuario destino';


--
-- Name: informados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE informados (
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    depe_codi numeric(3,0) NOT NULL,
    info_desc character varying(600),
    info_fech date NOT NULL,
    info_leido numeric(1,0) DEFAULT 0,
    usua_codi_info numeric(3,0),
    info_codi numeric(10,0),
    usua_doc character varying(14),
    info_resp character varying(10)
);


ALTER TABLE public.informados OWNER TO postgres;

--
-- Name: COLUMN informados.usua_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN informados.usua_codi IS 'Codigo de usuario';


--
-- Name: COLUMN informados.info_resp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN informados.info_resp IS 'Indica si el informado necesita respuesta.';


--
-- Name: medio_recepcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE medio_recepcion (
    mrec_codi numeric(2,0) NOT NULL,
    mrec_desc character varying(100) NOT NULL
);


ALTER TABLE public.medio_recepcion OWNER TO postgres;

--
-- Name: TABLE medio_recepcion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE medio_recepcion IS 'MEDIO_RECEPCION';


--
-- Name: COLUMN medio_recepcion.mrec_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN medio_recepcion.mrec_codi IS 'CODIGO DE MEDIO DE RECEPCION';


--
-- Name: COLUMN medio_recepcion.mrec_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN medio_recepcion.mrec_desc IS 'DESCRIPCION DEL MEDIO';


--
-- Name: municipio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE municipio (
    muni_codi numeric(4,0) NOT NULL,
    dpto_codi numeric(3,0) NOT NULL,
    muni_nomb character varying(100) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    homologa_muni character varying(10),
    homologa_idmuni character varying(15),
    activa numeric(1,0) DEFAULT 1
);


ALTER TABLE public.municipio OWNER TO postgres;

--
-- Name: TABLE municipio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE municipio IS 'MUNICIPIO';


--
-- Name: COLUMN municipio.muni_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN municipio.muni_codi IS 'MUNI_CODI';


--
-- Name: COLUMN municipio.dpto_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN municipio.dpto_codi IS 'DPTO_CODI';


--
-- Name: COLUMN municipio.muni_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN municipio.muni_nomb IS 'MUNI_NOMB';


--
-- Name: num_resol_dtc; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE num_resol_dtc
    START WITH 24
    INCREMENT BY 1
    MAXVALUE 999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.num_resol_dtc OWNER TO postgres;

--
-- Name: num_resol_dtn; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE num_resol_dtn
    START WITH 101
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.num_resol_dtn OWNER TO postgres;

--
-- Name: num_resol_dtoc; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE num_resol_dtoc
    START WITH 21
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.num_resol_dtoc OWNER TO postgres;

--
-- Name: num_resol_dtor; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE num_resol_dtor
    START WITH 61
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.num_resol_dtor OWNER TO postgres;

--
-- Name: num_resol_dts; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE num_resol_dts
    START WITH 61
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.num_resol_dts OWNER TO postgres;

--
-- Name: num_resol_gral; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE num_resol_gral
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 20;


ALTER TABLE public.num_resol_gral OWNER TO postgres;

--
-- Name: ortega_prueba_orfeo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ortega_prueba_orfeo (
    radi_nume_hoja numeric(3,0),
    radi_fech_radi date,
    radi_nume_radi numeric(15,0),
    ra_asun character varying(350),
    radi_path character varying(100),
    radi_usu_ante character varying(45),
    nombre_de_la_empresa character varying(150),
    fecha character varying(20),
    sgd_tpr_descrip character varying(150),
    sgd_tpr_codigo numeric(4,0),
    sgd_tpr_termino numeric(4,0),
    diasr numeric(4,0),
    radi_leido numeric(1,0),
    radi_tipo_deri numeric(2,0),
    radi_nume_deri numeric(15,0),
    sgd_ciu_nombre character varying(50),
    sgd_ciu_apell1 character varying(50),
    sgd_ciu_apell2 character varying(50),
    tipo_query character varying(50),
    sgd_dir_tipo numeric(4,0),
    sgd_dir_nombre character varying(60),
    radi_cuentai character varying(20),
    sgd_exp_numero character varying(15)
);


ALTER TABLE public.ortega_prueba_orfeo OWNER TO postgres;

--
-- Name: p_sgd_oem_oempresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE p_sgd_oem_oempresas (
    sgd_oem_codigo numeric(8,0) NOT NULL,
    tdid_codi numeric(2,0),
    sgd_oem_oempresa character varying(150),
    sgd_oem_rep_legal character varying(150),
    sgd_oem_nit character varying(14),
    sgd_oem_sigla character varying(50),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_oem_direccion character varying(100),
    sgd_oem_telefono character varying(50)
);


ALTER TABLE public.p_sgd_oem_oempresas OWNER TO postgres;

--
-- Name: par_serv_servicios; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE par_serv_servicios (
    par_serv_secue numeric(8,0) NOT NULL,
    par_serv_codigo character varying(5),
    par_serv_nombre character varying(100),
    par_serv_estado character varying(1)
);


ALTER TABLE public.par_serv_servicios OWNER TO postgres;

--
-- Name: pl_generado_plg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pl_generado_plg (
    depe_codi numeric(5,0),
    radi_nume_radi numeric(15,0),
    plt_codi numeric(4,0),
    plg_codi numeric(4,0),
    plg_comentarios character varying(150),
    plg_analiza numeric(10,0),
    plg_firma numeric(10,0),
    plg_autoriza numeric(10,0),
    plg_imprime numeric(10,0),
    plg_envia numeric(10,0),
    plg_archivo_tmp character varying(150),
    plg_archivo_final character varying(150),
    plg_nombre character varying(30),
    plg_crea numeric(10,0) DEFAULT 0,
    plg_autoriza_fech date,
    plg_imprime_fech date,
    plg_envia_fech date,
    plg_crea_fech date,
    plg_creador character varying(20),
    pl_codi numeric(4,0),
    usua_doc character varying(14),
    sgd_rem_destino numeric(1,0) DEFAULT 0,
    radi_nume_sal numeric(15,0) DEFAULT 0
);


ALTER TABLE public.pl_generado_plg OWNER TO postgres;

--
-- Name: pl_tipo_plt; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pl_tipo_plt (
    plt_codi numeric(4,0) NOT NULL,
    plt_desc character varying(35)
);


ALTER TABLE public.pl_tipo_plt OWNER TO postgres;

--
-- Name: plan_table; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plan_table (
    statement_id character varying(30),
    "timestamp" date,
    remarks character varying(80),
    operation character varying(30),
    options character varying(30),
    object_node character varying(128),
    object_owner character varying(30),
    object_name character varying(30),
    object_instance integer,
    object_type character varying(30),
    optimizer character varying(255),
    search_columns numeric,
    id integer,
    parent_id integer,
    "position" integer,
    cost integer,
    cardinality integer,
    s integer,
    other_tag character varying(255),
    partition_start character varying(255),
    partition_stop character varying(255),
    partition_id integer,
    other character varying(255),
    distribution character varying(30)
);


ALTER TABLE public.plan_table OWNER TO postgres;

--
-- Name: plantilla_pl; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plantilla_pl (
    pl_codi numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    pl_nomb character varying(35),
    pl_archivo character varying(35),
    pl_desc character varying(150),
    pl_fech date,
    usua_codi numeric(10,0),
    pl_uso numeric(1,0) DEFAULT 0
);


ALTER TABLE public.plantilla_pl OWNER TO postgres;

--
-- Name: plsql_profiler_data; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plsql_profiler_data (
    runid numeric,
    unit_numeric numeric,
    line numeric NOT NULL,
    total_occur numeric,
    total_time numeric,
    min_time numeric,
    max_time numeric,
    spare1 numeric,
    spare2 numeric,
    spare3 numeric,
    spare4 numeric
);


ALTER TABLE public.plsql_profiler_data OWNER TO postgres;

--
-- Name: plsql_profiler_runnumeric; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE plsql_profiler_runnumeric
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.plsql_profiler_runnumeric OWNER TO postgres;

--
-- Name: plsql_profiler_runs; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plsql_profiler_runs (
    runid numeric,
    related_run numeric,
    run_owner character varying(32),
    run_date date,
    run_comment character varying(2047),
    run_total_time numeric,
    run_system_info character varying(2047),
    run_comment1 character varying(2047),
    spare1 character varying(256)
);


ALTER TABLE public.plsql_profiler_runs OWNER TO postgres;

--
-- Name: plsql_profiler_units; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE plsql_profiler_units (
    runid numeric,
    unit_numeric numeric,
    unit_type character varying(32),
    unit_owner character varying(32),
    unit_name character varying(32),
    unit_timestamp date,
    total_time numeric DEFAULT 0 NOT NULL,
    spare1 numeric,
    spare2 numeric
);


ALTER TABLE public.plsql_profiler_units OWNER TO postgres;

--
-- Name: pres_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE pres_seq
    START WITH 30392
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.pres_seq OWNER TO postgres;

--
-- Name: prestamo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE prestamo (
    pres_id numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_login_actu character varying(50) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_login_pres character varying(50),
    pres_desc character varying(200),
    pres_fech_pres timestamp without time zone,
    pres_fech_devo timestamp without time zone,
    pres_fech_pedi timestamp without time zone NOT NULL,
    pres_estado numeric(2,0),
    pres_requerimiento numeric(2,0),
    pres_depe_arch numeric(5,0),
    pres_fech_venc timestamp without time zone,
    dev_desc character varying(500),
    pres_fech_canc timestamp without time zone,
    usua_login_canc character varying(50),
    usua_login_rx character varying(50)
);


ALTER TABLE public.prestamo OWNER TO postgres;

--
-- Name: COLUMN prestamo.dev_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN prestamo.dev_desc IS 'Observaciones realizadas por el usuario que recibe la devolucion acerca de la cantidad, el estado, tipo o sucesos acontecidos con los documentos y anexos fisicos';


--
-- Name: COLUMN prestamo.pres_fech_canc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN prestamo.pres_fech_canc IS 'Fecha de cancelacion de la solicitud';


--
-- Name: COLUMN prestamo.usua_login_canc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN prestamo.usua_login_canc IS 'Login del usuario que cancela la solicitud';


--
-- Name: COLUMN prestamo.usua_login_rx; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN prestamo.usua_login_rx IS 'Login del usuario que recibe el documento al momento de entregar.';


--
-- Name: pruba; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pruba (
    nombre character varying(20),
    tel character varying(20)
);


ALTER TABLE public.pruba OWNER TO postgres;

--
-- Name: TABLE pruba; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE pruba IS 'Almacena parametros compuestos por dos valores: identificador y valor';


--
-- Name: radicado; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE radicado (
    radi_nume_radi numeric(15,0) NOT NULL,
    radi_fech_radi timestamp with time zone NOT NULL,
    tdoc_codi numeric(4,0) NOT NULL,
    trte_codi numeric(2,0),
    mrec_codi numeric(2,0),
    eesp_codi numeric(10,0),
    eotra_codi numeric(10,0),
    radi_tipo_empr character varying(2),
    radi_fech_ofic date,
    tdid_codi numeric(2,0),
    radi_nume_iden character varying(15),
    radi_nomb character varying(90),
    radi_prim_apel character varying(50),
    radi_segu_apel character varying(50),
    radi_pais character varying(70),
    muni_codi numeric(5,0),
    cpob_codi numeric(4,0),
    carp_codi numeric(3,0),
    esta_codi numeric(2,0),
    dpto_codi numeric(2,0),
    cen_muni_codi numeric(4,0),
    cen_dpto_codi numeric(2,0),
    radi_dire_corr character varying(100),
    radi_tele_cont character varying(15),
    radi_nume_hoja numeric(4,0),
    radi_desc_anex character varying(500),
    radi_nume_deri numeric(15,0),
    radi_path character varying(100),
    radi_usua_actu numeric(10,0),
    radi_depe_actu numeric(5,0),
    radi_fech_asig timestamp with time zone,
    radi_arch1 character varying(10),
    radi_arch2 character varying(10),
    radi_arch3 character varying(10),
    radi_arch4 character varying(10),
    ra_asun character varying(350),
    radi_usu_ante character varying(45),
    radi_depe_radi numeric(3,0),
    radi_rem character varying(60),
    radi_usua_radi numeric(10,0),
    codi_nivel numeric(2,0) DEFAULT 1,
    flag_nivel integer DEFAULT 1,
    carp_per numeric(1,0) DEFAULT 0,
    radi_leido numeric(1,0) DEFAULT 0,
    radi_cuentai character varying(20),
    radi_tipo_deri numeric(2,0) DEFAULT 0,
    listo character varying(2),
    sgd_tma_codigo numeric(4,0),
    sgd_mtd_codigo numeric(4,0),
    par_serv_secue numeric(8,0),
    sgd_fld_codigo numeric(3,0) DEFAULT 0,
    radi_agend numeric(1,0),
    radi_fech_agend timestamp with time zone,
    radi_fech_doc date,
    sgd_doc_secuencia numeric(15,0),
    sgd_pnufe_codi numeric(4,0),
    sgd_eanu_codigo numeric(1,0),
    sgd_not_codi numeric(3,0),
    radi_fech_notif timestamp with time zone,
    sgd_tdec_codigo numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_ttr_codigo integer DEFAULT 0,
    usua_doc_ante character varying(14),
    radi_fech_antetx timestamp with time zone,
    sgd_trad_codigo numeric(2,0),
    fech_vcmto timestamp with time zone,
    tdoc_vcmto numeric(4,0),
    sgd_termino_real numeric(4,0),
    id_cont numeric(2,0) DEFAULT 1,
    sgd_spub_codigo numeric(2,0) DEFAULT 0,
    id_pais numeric(4,0),
    medio_m character varying(5),
    radi_nrr numeric(2,0),
    numero_rm character varying(15),
    numero_tran character varying(15)
);


ALTER TABLE public.radicado OWNER TO postgres;

--
-- Name: COLUMN radicado.radi_nume_radi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_nume_radi IS 'Numero de Radicado';


--
-- Name: COLUMN radicado.radi_fech_radi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_fech_radi IS 'FECHA DE RADICACION';


--
-- Name: COLUMN radicado.tdoc_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.tdoc_codi IS 'Tipo de Documento, (ej. Res, derecho pet, tutela, etc .. . . . .)';


--
-- Name: COLUMN radicado.trte_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.trte_codi IS 'TRTE_CODI';


--
-- Name: COLUMN radicado.mrec_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.mrec_codi IS 'MREC_CODI';


--
-- Name: COLUMN radicado.eesp_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.eesp_codi IS 'EESP_CODI';


--
-- Name: COLUMN radicado.eotra_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.eotra_codi IS 'EOTRA_CODI';


--
-- Name: COLUMN radicado.radi_tipo_empr; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_tipo_empr IS 'TIPO DE EMPRESA (OTRA O ESP)';


--
-- Name: COLUMN radicado.radi_fech_ofic; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_fech_ofic IS 'FECHA DE OFICIO';


--
-- Name: COLUMN radicado.tdid_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.tdid_codi IS 'TDID_CODI';


--
-- Name: COLUMN radicado.radi_nume_iden; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_nume_iden IS 'NUMERO DE IDENTIFICACION';


--
-- Name: COLUMN radicado.radi_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_nomb IS 'NOMBRE';


--
-- Name: COLUMN radicado.radi_prim_apel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_prim_apel IS '1 APELLIDO';


--
-- Name: COLUMN radicado.radi_segu_apel; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_segu_apel IS '2 APELLIDO';


--
-- Name: COLUMN radicado.radi_pais; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_pais IS 'PAIS (DEFAULT COLOMBIA)';


--
-- Name: COLUMN radicado.muni_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.muni_codi IS 'MUNI_CODI';


--
-- Name: COLUMN radicado.cpob_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.cpob_codi IS 'CPOB_CODI';


--
-- Name: COLUMN radicado.carp_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.carp_codi IS 'CARP_CODI';


--
-- Name: COLUMN radicado.esta_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.esta_codi IS 'ESTA_CODI';


--
-- Name: COLUMN radicado.dpto_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.dpto_codi IS 'DPTO_CODI';


--
-- Name: COLUMN radicado.cen_muni_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.cen_muni_codi IS 'CEN_MUNI_CODI';


--
-- Name: COLUMN radicado.cen_dpto_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.cen_dpto_codi IS 'CEN_DPTO_CODI';


--
-- Name: COLUMN radicado.radi_dire_corr; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_dire_corr IS 'DIRECCION CORRESPONDENCIA';


--
-- Name: COLUMN radicado.radi_tele_cont; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_tele_cont IS 'TELEFONO CONTACTO';


--
-- Name: COLUMN radicado.radi_nume_hoja; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_nume_hoja IS 'NUMERO DE HOJAS';


--
-- Name: COLUMN radicado.radi_desc_anex; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_desc_anex IS 'DESCRIPCION DE ANEXOS';


--
-- Name: COLUMN radicado.radi_nume_deri; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_nume_deri IS 'NUMERO DERIVADO';


--
-- Name: COLUMN radicado.radi_path; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_path IS 'RADI_PATH';


--
-- Name: COLUMN radicado.radi_usua_actu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_usua_actu IS 'USUARIO ACTUAL';


--
-- Name: COLUMN radicado.radi_depe_actu; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_depe_actu IS 'DEPENDENCIA ACTUAL (USUARIO)';


--
-- Name: COLUMN radicado.radi_fech_asig; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_fech_asig IS 'FECHA DE ASIGNACION DEL USUARIO';


--
-- Name: COLUMN radicado.radi_arch1; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_arch1 IS 'CAMPO PARA ARCHIVO FISICO';


--
-- Name: COLUMN radicado.radi_arch2; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_arch2 IS 'CAMPO PARA ARCHIVO FISICO';


--
-- Name: COLUMN radicado.radi_arch3; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_arch3 IS 'CAMPO PARA ARCHIVO FISICO';


--
-- Name: COLUMN radicado.radi_arch4; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_arch4 IS 'CAMPO PARA ARCHIVO FISICO';


--
-- Name: COLUMN radicado.usua_doc_ante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.usua_doc_ante IS 'Codigo TTR. transaccion.';


--
-- Name: COLUMN radicado.radi_fech_antetx; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.radi_fech_antetx IS 'Documento del usuario que realizo la anterior tx';


--
-- Name: COLUMN radicado.sgd_trad_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.sgd_trad_codigo IS 'Fecha de la Ultima transaccion.';


--
-- Name: COLUMN radicado.numero_rm; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.numero_rm IS 'numero de registro';


--
-- Name: COLUMN radicado.numero_tran; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN radicado.numero_tran IS 'Numero de transaccion';


--
-- Name: rad1000; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW rad1000 AS
    SELECT radicado.radi_nume_radi, radicado.radi_fech_radi FROM radicado WHERE (((((((((radicado.radi_nume_radi = ((1995000001142::bigint - 5))::numeric) OR (radicado.radi_nume_radi = ((1995000001281::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1995000001387::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000015::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000374::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000390::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000526::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000647::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000717::bigint - 5))::numeric));


ALTER TABLE public.rad1000 OWNER TO postgres;

--
-- Name: retencion_doc_tmp; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE retencion_doc_tmp (
    cod_serie numeric(4,0),
    serie character varying(100),
    tipologia_doc character varying(200),
    cod_subserie character varying(10),
    subserie character varying(100),
    tipologia_sub character varying(200),
    dependencia numeric(5,0),
    nom_depe character varying(200),
    archivo_gestion numeric(3,0),
    archivo_central numeric(3,0),
    disposicion character varying(100),
    soporte character varying(20),
    procedimiento character varying(500),
    tipo_doc numeric(4,0),
    error character varying(200)
);


ALTER TABLE public.retencion_doc_tmp OWNER TO postgres;

--
-- Name: sec_100; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_100
    START WITH 81073
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_100 OWNER TO postgres;

--
-- Name: sec_101; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_101
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_101 OWNER TO postgres;

--
-- Name: sec_120; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_120
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_120 OWNER TO postgres;

--
-- Name: sec_130; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_130
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_130 OWNER TO postgres;

--
-- Name: sec_131; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_131
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_131 OWNER TO postgres;

--
-- Name: sec_140; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_140
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_140 OWNER TO postgres;

--
-- Name: sec_160; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_160
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_160 OWNER TO postgres;

--
-- Name: sec_170; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_170
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_170 OWNER TO postgres;

--
-- Name: sec_200; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_200
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_200 OWNER TO postgres;

--
-- Name: sec_201; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_201
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_201 OWNER TO postgres;

--
-- Name: sec_210; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_210
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_210 OWNER TO postgres;

--
-- Name: sec_211; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_211
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_211 OWNER TO postgres;

--
-- Name: sec_220; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_220
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_220 OWNER TO postgres;

--
-- Name: sec_230; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_230
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_230 OWNER TO postgres;

--
-- Name: sec_240; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_240
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_240 OWNER TO postgres;

--
-- Name: sec_300; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_300
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_300 OWNER TO postgres;

--
-- Name: sec_310; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_310
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_310 OWNER TO postgres;

--
-- Name: sec_330; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_330
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_330 OWNER TO postgres;

--
-- Name: sec_331; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_331
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_331 OWNER TO postgres;

--
-- Name: sec_340; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_340
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_340 OWNER TO postgres;

--
-- Name: sec_400; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_400
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_400 OWNER TO postgres;

--
-- Name: sec_401; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_401
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_401 OWNER TO postgres;

--
-- Name: sec_410; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_410
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_410 OWNER TO postgres;

--
-- Name: sec_411; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_411
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_411 OWNER TO postgres;

--
-- Name: sec_420; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_420
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_420 OWNER TO postgres;

--
-- Name: sec_421; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_421
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_421 OWNER TO postgres;

--
-- Name: sec_422; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_422
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_422 OWNER TO postgres;

--
-- Name: sec_430; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_430
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_430 OWNER TO postgres;

--
-- Name: sec_431; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_431
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_431 OWNER TO postgres;

--
-- Name: sec_432; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_432
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_432 OWNER TO postgres;

--
-- Name: sec_440; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_440
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_440 OWNER TO postgres;

--
-- Name: sec_500; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_500
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_500 OWNER TO postgres;

--
-- Name: sec_520; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_520
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_520 OWNER TO postgres;

--
-- Name: sec_521; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_521
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_521 OWNER TO postgres;

--
-- Name: sec_522; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_522
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_522 OWNER TO postgres;

--
-- Name: sec_523; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_523
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_523 OWNER TO postgres;

--
-- Name: sec_524; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_524
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_524 OWNER TO postgres;

--
-- Name: sec_527; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_527
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_527 OWNER TO postgres;

--
-- Name: sec_528; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_528
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_528 OWNER TO postgres;

--
-- Name: sec_529; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_529
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_529 OWNER TO postgres;

--
-- Name: sec_530; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_530
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_530 OWNER TO postgres;

--
-- Name: sec_531; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_531
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_531 OWNER TO postgres;

--
-- Name: sec_532; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_532
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_532 OWNER TO postgres;

--
-- Name: sec_533; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_533
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_533 OWNER TO postgres;

--
-- Name: sec_534; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_534
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_534 OWNER TO postgres;

--
-- Name: sec_535; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_535
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_535 OWNER TO postgres;

--
-- Name: sec_536; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_536
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_536 OWNER TO postgres;

--
-- Name: sec_600; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_600
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_600 OWNER TO postgres;

--
-- Name: sec_610; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_610
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_610 OWNER TO postgres;

--
-- Name: sec_800; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_800
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_800 OWNER TO postgres;

--
-- Name: sec_810; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_810
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_810 OWNER TO postgres;

--
-- Name: sec_811; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_811
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_811 OWNER TO postgres;

--
-- Name: sec_812; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_812
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_812 OWNER TO postgres;

--
-- Name: sec_813; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_813
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_813 OWNER TO postgres;

--
-- Name: sec_814; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_814
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_814 OWNER TO postgres;

--
-- Name: sec_815; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_815
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_815 OWNER TO postgres;

--
-- Name: sec_820; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_820
    START WITH 14375
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_820 OWNER TO postgres;

--
-- Name: sec_830; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_830
    START WITH 5460
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_830 OWNER TO postgres;

--
-- Name: sec_840; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_840
    START WITH 7534
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_840 OWNER TO postgres;

--
-- Name: sec_850; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_850
    START WITH 7662
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_850 OWNER TO postgres;

--
-- Name: sec_900; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_900
    START WITH 12449
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_900 OWNER TO postgres;

--
-- Name: sec_905; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_905
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_905 OWNER TO postgres;

--
-- Name: sec_906; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_906
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_906 OWNER TO postgres;

--
-- Name: sec_907; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_907
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_907 OWNER TO postgres;

--
-- Name: sec_908; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_908
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_908 OWNER TO postgres;

--
-- Name: sec_909; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_909
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_909 OWNER TO postgres;

--
-- Name: sec_910; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_910
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_910 OWNER TO postgres;

--
-- Name: sec_911; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_911
    START WITH 0
    INCREMENT BY 1
    MAXVALUE 99999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_911 OWNER TO postgres;

--
-- Name: sec_bodega_empresas; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_bodega_empresas
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_bodega_empresas OWNER TO postgres;

--
-- Name: sec_central; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_central
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_central OWNER TO postgres;

--
-- Name: sec_ciu_ciudadano; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_ciu_ciudadano
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_ciu_ciudadano OWNER TO "admin";

--
-- Name: sec_def_contactos; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_def_contactos
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_def_contactos OWNER TO "admin";

--
-- Name: sec_dir_direcciones; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_dir_direcciones
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_dir_direcciones OWNER TO "admin";

--
-- Name: sec_edificio; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_edificio
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_edificio OWNER TO "admin";

--
-- Name: sec_inv; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_inv
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_inv OWNER TO postgres;

--
-- Name: sec_oem_oempresas; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_oem_oempresas
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_oem_oempresas OWNER TO "admin";

--
-- Name: sec_planilla; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_planilla
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_planilla OWNER TO "admin";

--
-- Name: sec_planilla_envio; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_planilla_envio
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_planilla_envio OWNER TO "admin";

--
-- Name: sec_prestamo; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE sec_prestamo
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_prestamo OWNER TO "admin";

--
-- Name: sec_resol_820; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_resol_820
    START WITH 9992
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_resol_820 OWNER TO postgres;

--
-- Name: sec_resol_830; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_resol_830
    START WITH 1991
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_resol_830 OWNER TO postgres;

--
-- Name: sec_resol_840; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_resol_840
    START WITH 2417
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_resol_840 OWNER TO postgres;

--
-- Name: sec_resol_850; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_resol_850
    START WITH 4579
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_resol_850 OWNER TO postgres;

--
-- Name: sec_rinterna_100; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_100
    START WITH 2769
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_rinterna_100 OWNER TO postgres;

--
-- Name: sec_rinterna_820; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_820
    START WITH 17
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_rinterna_820 OWNER TO postgres;

--
-- Name: sec_rinterna_830; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_830
    START WITH 103
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_rinterna_830 OWNER TO postgres;

--
-- Name: sec_rinterna_840; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_840
    START WITH 57
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_rinterna_840 OWNER TO postgres;

--
-- Name: sec_rinterna_850; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_850
    START WITH 75
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_rinterna_850 OWNER TO postgres;

--
-- Name: sec_rinterna_900; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_900
    START WITH 5
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_rinterna_900 OWNER TO postgres;

--
-- Name: sec_rinterna_905; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_rinterna_905
    START WITH 30
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    MINVALUE 0
    CACHE 1;


ALTER TABLE public.sec_rinterna_905 OWNER TO postgres;

--
-- Name: sec_sgd_hfld_histflujodoc; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sec_sgd_hfld_histflujodoc
    START WITH 22298
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sec_sgd_hfld_histflujodoc OWNER TO postgres;

--
-- Name: secr_tp1_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp1_
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp1_ OWNER TO "admin";

--
-- Name: secr_tp1_100; Type: SEQUENCE; Schema: public; Owner: orfeo
--

CREATE SEQUENCE secr_tp1_100
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp1_100 OWNER TO orfeo;

--
-- Name: secr_tp1_998; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp1_998
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp1_998 OWNER TO "admin";

--
-- Name: secr_tp1_999; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp1_999
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp1_999 OWNER TO postgres;

--
-- Name: secr_tp2_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp2_
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_ OWNER TO "admin";

--
-- Name: secr_tp2_100; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp2_100
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_100 OWNER TO "admin";

--
-- Name: secr_tp2_200; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp2_200
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_200 OWNER TO "admin";

--
-- Name: secr_tp2_331; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp2_331
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_331 OWNER TO "admin";

--
-- Name: secr_tp2_800; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp2_800
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_800 OWNER TO "admin";

--
-- Name: secr_tp2_998; Type: SEQUENCE; Schema: public; Owner: orfeo
--

CREATE SEQUENCE secr_tp2_998
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp2_998 OWNER TO orfeo;

--
-- Name: secr_tp3_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp3_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp3_ OWNER TO "admin";

--
-- Name: secr_tp4_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp4_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp4_ OWNER TO "admin";

--
-- Name: secr_tp5_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp5_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp5_ OWNER TO "admin";

--
-- Name: secr_tp6_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp6_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp6_ OWNER TO "admin";

--
-- Name: secr_tp7_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp7_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp7_ OWNER TO "admin";

--
-- Name: secr_tp8_; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp8_
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp8_ OWNER TO "admin";

--
-- Name: secr_tp8_100; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp8_100
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp8_100 OWNER TO "admin";

--
-- Name: secr_tp9_; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE secr_tp9_
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp9_ OWNER TO postgres;

--
-- Name: secr_tp9_100; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp9_100
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp9_100 OWNER TO "admin";

--
-- Name: secr_tp_800; Type: SEQUENCE; Schema: public; Owner: admin
--

CREATE SEQUENCE secr_tp_800
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.secr_tp_800 OWNER TO "admin";

--
-- Name: series; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE series (
    depe_codi numeric(5,0) NOT NULL,
    seri_nume numeric(7,0) NOT NULL,
    seri_tipo numeric(2,0),
    seri_ano numeric(4,0),
    dpto_codi numeric(2,0) NOT NULL,
    bloq character varying(20)
);


ALTER TABLE public.series OWNER TO postgres;

--
-- Name: TABLE series; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE series IS 'SERIES';


--
-- Name: COLUMN series.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN series.depe_codi IS 'CODIGO SERIE DEPENDENCIA';


--
-- Name: COLUMN series.seri_nume; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN series.seri_nume IS 'NUMERO DE SERIE PARA DEPENDENCIA';


--
-- Name: sgd_acm_acusemsg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_acm_acusemsg (
    sgd_msg_codi numeric(15,0) NOT NULL,
    usua_doc character varying(14),
    sgd_msg_leido numeric(3,0)
);


ALTER TABLE public.sgd_acm_acusemsg OWNER TO postgres;

--
-- Name: sgd_actadd_actualiadicional; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_actadd_actualiadicional (
    sgd_actadd_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_instorf_codi numeric(4,0),
    sgd_actadd_query character varying(500),
    sgd_actadd_desc character varying(150)
);


ALTER TABLE public.sgd_actadd_actualiadicional OWNER TO postgres;

--
-- Name: sgd_agen_agendados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_agen_agendados (
    sgd_agen_fech date,
    sgd_agen_observacion character varying(4000),
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_doc character varying(18) NOT NULL,
    depe_codi character varying(3),
    sgd_agen_codigo numeric,
    sgd_agen_fechplazo date,
    sgd_agen_activo numeric
);


ALTER TABLE public.sgd_agen_agendados OWNER TO postgres;

--
-- Name: sgd_anar_anexarg; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_anar_anexarg (
    sgd_anar_codi numeric(4,0) NOT NULL,
    anex_codigo character varying(20),
    sgd_argd_codi numeric(4,0),
    sgd_anar_argcod numeric(4,0)
);


ALTER TABLE public.sgd_anar_anexarg OWNER TO postgres;

--
-- Name: TABLE sgd_anar_anexarg; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_anar_anexarg IS 'Indica los argumentos o criterios a incluir dentro de un tipo de documento generado';


--
-- Name: COLUMN sgd_anar_anexarg.sgd_anar_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_anar_anexarg.sgd_anar_codi IS 'id del registro';


--
-- Name: COLUMN sgd_anar_anexarg.anex_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_anar_anexarg.anex_codigo IS 'codigo del anexo';


--
-- Name: COLUMN sgd_anar_anexarg.sgd_argd_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_anar_anexarg.sgd_argd_codi IS 'codigo del argumento empleado';


--
-- Name: COLUMN sgd_anar_anexarg.sgd_anar_argcod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_anar_anexarg.sgd_anar_argcod IS 'valor del campo llave, de tabla que contiene el argumento referenciado';


--
-- Name: sgd_anar_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_anar_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 99999999999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_anar_secue OWNER TO postgres;

--
-- Name: sgd_anu_anulados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_anu_anulados (
    sgd_anu_id numeric(4,0),
    sgd_anu_desc character varying(250),
    radi_nume_radi numeric,
    sgd_eanu_codi numeric(4,0),
    sgd_anu_sol_fech date,
    sgd_anu_fech date,
    depe_codi numeric(3,0),
    usua_doc character varying(14),
    usua_codi numeric(4,0),
    depe_codi_anu numeric(3,0),
    usua_doc_anu character varying(14),
    usua_codi_anu numeric(4,0),
    usua_anu_acta numeric(8,0),
    sgd_anu_path_acta character varying(200),
    sgd_trad_codigo numeric(2,0)
);


ALTER TABLE public.sgd_anu_anulados OWNER TO postgres;

--
-- Name: sgd_aper_adminperfiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aper_adminperfiles (
    sgd_aper_codigo numeric(2,0),
    sgd_aper_descripcion character varying(20)
);


ALTER TABLE public.sgd_aper_adminperfiles OWNER TO postgres;

--
-- Name: sgd_aplfad_plicfunadi; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplfad_plicfunadi (
    sgd_aplfad_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_aplfad_menu character varying(150) NOT NULL,
    sgd_aplfad_lk1 character varying(150) NOT NULL,
    sgd_aplfad_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_aplfad_plicfunadi OWNER TO postgres;

--
-- Name: sgd_apli_aplintegra; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_apli_aplintegra (
    sgd_apli_codi numeric(4,0),
    sgd_apli_descrip character varying(150),
    sgd_apli_lk1desc character varying(150),
    sgd_apli_lk1 character varying(150),
    sgd_apli_lk2desc character varying(150),
    sgd_apli_lk2 character varying(150),
    sgd_apli_lk3desc character varying(150),
    sgd_apli_lk3 character varying(150),
    sgd_apli_lk4desc character varying(150),
    sgd_apli_lk4 character varying(150)
);


ALTER TABLE public.sgd_apli_aplintegra OWNER TO postgres;

--
-- Name: sgd_aplmen_aplimens; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplmen_aplimens (
    sgd_aplmen_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_aplmen_ref character varying(20),
    sgd_aplmen_haciaorfeo numeric(4,0),
    sgd_aplmen_desdeorfeo numeric(4,0)
);


ALTER TABLE public.sgd_aplmen_aplimens OWNER TO postgres;

--
-- Name: sgd_aplus_plicusua; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_aplus_plicusua (
    sgd_aplus_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    usua_doc character varying(14),
    sgd_trad_codigo numeric(2,0),
    sgd_aplus_prioridad numeric(1,0)
);


ALTER TABLE public.sgd_aplus_plicusua OWNER TO postgres;

--
-- Name: sgd_arch_depe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_arch_depe (
    sgd_arch_depe character varying(4),
    sgd_arch_edificio numeric(6,0),
    sgd_arch_item numeric(6,0),
    sgd_arch_id numeric NOT NULL
);


ALTER TABLE public.sgd_arch_depe OWNER TO postgres;

--
-- Name: sgd_archivo_central; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_archivo_central (
    sgd_archivo_id numeric NOT NULL,
    sgd_archivo_tipo numeric,
    sgd_archivo_orden character varying(15),
    sgd_archivo_fechai timestamp with time zone,
    sgd_archivo_demandado character varying(1500),
    sgd_archivo_demandante character varying(200),
    sgd_archivo_cc_demandante numeric,
    sgd_archivo_depe character varying(5),
    sgd_archivo_zona character varying(4),
    sgd_archivo_carro numeric,
    sgd_archivo_cara character varying(4),
    sgd_archivo_estante numeric,
    sgd_archivo_entrepano numeric,
    sgd_archivo_caja numeric,
    sgd_archivo_unidocu character varying(40),
    sgd_archivo_anexo character varying(4000),
    sgd_archivo_inder numeric DEFAULT 0,
    sgd_archivo_path character varying(4000),
    sgd_archivo_year numeric(4,0),
    sgd_archivo_rad character varying(15) NOT NULL,
    sgd_archivo_srd numeric,
    sgd_archivo_sbrd numeric,
    sgd_archivo_folios numeric,
    sgd_archivo_mata numeric DEFAULT 0,
    sgd_archivo_fechaf timestamp with time zone,
    sgd_archivo_prestamo numeric(1,0),
    sgd_archivo_funprest character(100),
    sgd_archivo_fechprest timestamp with time zone,
    sgd_archivo_fechprestf timestamp with time zone,
    depe_codi character varying(5),
    sgd_archivo_usua character varying(15),
    sgd_archivo_fech timestamp with time zone
);


ALTER TABLE public.sgd_archivo_central OWNER TO postgres;

--
-- Name: sgd_archivo_hist; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_archivo_hist (
    depe_codi character varying(5) NOT NULL,
    hist_fech timestamp with time zone NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    sgd_archivo_rad character varying(14),
    hist_obse character varying(600) NOT NULL,
    usua_doc character varying(14),
    sgd_ttr_codigo numeric(3,0),
    hist_id numeric
);


ALTER TABLE public.sgd_archivo_hist OWNER TO postgres;

--
-- Name: sgd_arg_pliego; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_arg_pliego (
    sgd_arg_codigo numeric(2,0) NOT NULL,
    sgd_arg_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_arg_pliego OWNER TO postgres;

--
-- Name: sgd_argd_argdoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_argd_argdoc (
    sgd_argd_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    sgd_argd_tabla character varying(100),
    sgd_argd_tcodi character varying(100),
    sgd_argd_tdes character varying(100),
    sgd_argd_llist character varying(150),
    sgd_argd_campo character varying(100)
);


ALTER TABLE public.sgd_argd_argdoc OWNER TO postgres;

--
-- Name: TABLE sgd_argd_argdoc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_argd_argdoc IS 'Define los argumentos que ha de incluir un tipo de documento';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_argd_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_argd_codi IS 'Id del registro';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_pnufe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_pnufe_codi IS 'Codigo del proceso';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_argd_tabla; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_argd_tabla IS 'Nombre de la tabla tabla a la que hace refencia el argumento';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_argd_tcodi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_argd_tcodi IS 'Nombre del campo llave de la tabla referenciada';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_argd_tdes; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_argd_tdes IS 'Nombre del campo descripcion de la tabla referenciada';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_argd_llist; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_argd_llist IS 'Texto del label descriptor  que ha  de aparecen de forma dinamica en la pagina web';


--
-- Name: COLUMN sgd_argd_argdoc.sgd_argd_campo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argd_argdoc.sgd_argd_campo IS 'Etiqueta que ha de incluirse en el documento para referenciar este campo';


--
-- Name: sgd_argup_argudoctop; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_argup_argudoctop (
    sgd_argup_codi numeric(4,0) NOT NULL,
    sgd_argup_desc character varying(50),
    sgd_tpr_codigo numeric(4,0)
);


ALTER TABLE public.sgd_argup_argudoctop OWNER TO postgres;

--
-- Name: TABLE sgd_argup_argudoctop; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_argup_argudoctop IS 'Almacena los argumentos para contestar pliegos de cargos';


--
-- Name: COLUMN sgd_argup_argudoctop.sgd_argup_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argup_argudoctop.sgd_argup_codi IS 'Id del registro';


--
-- Name: COLUMN sgd_argup_argudoctop.sgd_argup_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_argup_argudoctop.sgd_argup_desc IS 'Descripcion';


--
-- Name: sgd_auditoria; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE sgd_auditoria (
    fecha character varying(10),
    usua_doc character varying(12),
    ip character varying(15),
    tipo character varying(5),
    tabla character varying(50),
    isql character(5000)
);


ALTER TABLE public.sgd_auditoria OWNER TO "admin";

--
-- Name: TABLE sgd_auditoria; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON TABLE sgd_auditoria IS 'Tabla para radicacion via web';


--
-- Name: sgd_camexp_campoexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_camexp_campoexpediente (
    sgd_camexp_codigo numeric(4,0) NOT NULL,
    sgd_camexp_campo character varying(30) NOT NULL,
    sgd_parexp_codigo numeric(4,0) NOT NULL,
    sgd_camexp_fk numeric DEFAULT 0,
    sgd_camexp_tablafk character varying(30),
    sgd_camexp_campofk character varying(30),
    sgd_camexp_campovalor character varying(30),
    sgd_camexp_orden numeric(1,0)
);


ALTER TABLE public.sgd_camexp_campoexpediente OWNER TO postgres;

--
-- Name: sgd_carp_descripcion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_carp_descripcion (
    sgd_carp_depecodi character varying(5) NOT NULL,
    sgd_carp_tiporad numeric(2,0) NOT NULL,
    sgd_carp_descr character varying(40)
);


ALTER TABLE public.sgd_carp_descripcion OWNER TO postgres;

--
-- Name: sgd_cau_causal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_cau_causal (
    sgd_cau_codigo numeric(4,0) NOT NULL,
    sgd_cau_descrip character varying(150)
);


ALTER TABLE public.sgd_cau_causal OWNER TO postgres;

--
-- Name: sgd_caux_causales; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_caux_causales (
    sgd_caux_codigo numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0),
    sgd_dcau_codigo numeric(4,0),
    sgd_ddca_codigo numeric(4,0),
    sgd_caux_fecha date,
    usua_doc character varying(14)
);


ALTER TABLE public.sgd_caux_causales OWNER TO postgres;

--
-- Name: sgd_ciu_ciudadano; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ciu_ciudadano (
    tdid_codi numeric(2,0),
    sgd_ciu_codigo numeric(8,0) NOT NULL,
    sgd_ciu_nombre character varying(150),
    sgd_ciu_direccion character varying(150),
    sgd_ciu_apell1 character varying(50),
    sgd_ciu_apell2 character varying(50),
    sgd_ciu_telefono character varying(50),
    sgd_ciu_email character varying(50),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_ciu_cedula character varying(13),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);


ALTER TABLE public.sgd_ciu_ciudadano OWNER TO postgres;

--
-- Name: sgd_ciu_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_ciu_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 99999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_ciu_secue OWNER TO postgres;

--
-- Name: sgd_clta_clstarif; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_clta_clstarif (
    sgd_fenv_codigo numeric(5,0),
    sgd_clta_codser numeric(5,0),
    sgd_tar_codigo numeric(5,0),
    sgd_clta_descrip character varying(100),
    sgd_clta_pesdes numeric(15,0),
    sgd_clta_peshast numeric(15,0)
);


ALTER TABLE public.sgd_clta_clstarif OWNER TO postgres;

--
-- Name: sgd_cob_campobliga; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_cob_campobliga (
    sgd_cob_codi numeric(4,0) NOT NULL,
    sgd_cob_desc character varying(150),
    sgd_cob_label character varying(50),
    sgd_tidm_codi numeric(4,0)
);


ALTER TABLE public.sgd_cob_campobliga OWNER TO postgres;

--
-- Name: TABLE sgd_cob_campobliga; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_cob_campobliga IS 'Indica los campos obligatorios que hacen parte de un tipo de documento de correspondencia masiva';


--
-- Name: COLUMN sgd_cob_campobliga.sgd_cob_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_cob_campobliga.sgd_cob_codi IS 'ID del registro';


--
-- Name: COLUMN sgd_cob_campobliga.sgd_cob_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_cob_campobliga.sgd_cob_desc IS 'Descripcion';


--
-- Name: COLUMN sgd_cob_campobliga.sgd_cob_label; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_cob_campobliga.sgd_cob_label IS 'Rotulo del campo a incluir dentro del documento';


--
-- Name: COLUMN sgd_cob_campobliga.sgd_tidm_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_cob_campobliga.sgd_tidm_codi IS 'Codigo del documento';


--
-- Name: sgd_dcau_causal; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dcau_causal (
    sgd_dcau_codigo numeric(4,0) NOT NULL,
    sgd_cau_codigo numeric(4,0),
    sgd_dcau_descrip character varying(150)
);


ALTER TABLE public.sgd_dcau_causal OWNER TO postgres;

--
-- Name: sgd_ddca_ddsgrgdo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ddca_ddsgrgdo (
    sgd_ddca_codigo numeric(4,0) NOT NULL,
    sgd_dcau_codigo numeric(4,0),
    par_serv_secue numeric(8,0),
    sgd_ddca_descrip character varying(150)
);


ALTER TABLE public.sgd_ddca_ddsgrgdo OWNER TO postgres;

--
-- Name: sgd_def_contactos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_contactos (
    ctt_id numeric(15,0) NOT NULL,
    ctt_nombre character varying(60) NOT NULL,
    ctt_cargo character varying(60) NOT NULL,
    ctt_telefono character varying(25),
    ctt_id_tipo numeric(4,0) NOT NULL,
    ctt_id_empresa numeric(15,0) NOT NULL
);


ALTER TABLE public.sgd_def_contactos OWNER TO postgres;

--
-- Name: sgd_def_continentes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_continentes (
    id_cont numeric(2,0),
    nombre_cont character varying(20) NOT NULL
);


ALTER TABLE public.sgd_def_continentes OWNER TO postgres;

--
-- Name: sgd_def_paises; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_def_paises (
    id_pais numeric(4,0),
    id_cont numeric(2,0) DEFAULT 1 NOT NULL,
    nombre_pais character varying(30) NOT NULL
);


ALTER TABLE public.sgd_def_paises OWNER TO postgres;

--
-- Name: sgd_deve_dev_envio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_deve_dev_envio (
    sgd_deve_codigo numeric(2,0) NOT NULL,
    sgd_deve_desc character varying(150) NOT NULL
);


ALTER TABLE public.sgd_deve_dev_envio OWNER TO postgres;

--
-- Name: sgd_dir_drecciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dir_drecciones (
    sgd_dir_codigo numeric(10,0) NOT NULL,
    sgd_dir_tipo numeric(4,0) NOT NULL,
    sgd_oem_codigo numeric(8,0),
    sgd_ciu_codigo numeric(8,0),
    radi_nume_radi numeric(15,0),
    sgd_esp_codi numeric(5,0),
    muni_codi numeric(4,0),
    dpto_codi numeric(3,0),
    sgd_dir_direccion character varying(150),
    sgd_dir_telefono character varying(50),
    sgd_dir_mail character varying(50),
    sgd_sec_codigo numeric(13,0),
    sgd_temporal_nombre character varying(150),
    anex_codigo numeric(20,0),
    sgd_anex_codigo character varying(20),
    sgd_dir_nombre character varying(150),
    sgd_doc_fun character varying(14),
    sgd_dir_nomremdes character varying(1000),
    sgd_trd_codigo numeric(1,0),
    sgd_dir_tdoc numeric(1,0),
    sgd_dir_doc character varying(14),
    id_pais numeric(4,0) DEFAULT 170,
    id_cont numeric(2,0) DEFAULT 1
);


ALTER TABLE public.sgd_dir_drecciones OWNER TO postgres;

--
-- Name: COLUMN sgd_dir_drecciones.sgd_dir_nomremdes; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dir_drecciones.sgd_dir_nomremdes IS 'NOMBRE DE REMITENTE O DESTINATARIO';


--
-- Name: COLUMN sgd_dir_drecciones.sgd_trd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dir_drecciones.sgd_trd_codigo IS 'TIPO DE REMITENTE/DESTINATARIO (1 Ciudadanao, 2 OtrasEmpresas, 3 Esp, 4 Funcionario)';


--
-- Name: COLUMN sgd_dir_drecciones.sgd_dir_tdoc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dir_drecciones.sgd_dir_tdoc IS 'NUMERO DE DOCUMENTO';


--
-- Name: sgd_dir_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_dir_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 99999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_dir_secue OWNER TO postgres;

--
-- Name: sgd_dnufe_docnufe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_dnufe_docnufe (
    sgd_dnufe_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    sgd_tpr_codigo numeric(4,0),
    sgd_dnufe_label character varying(150),
    trte_codi numeric(2,0),
    sgd_dnufe_main character varying(1),
    sgd_dnufe_path character varying(150),
    sgd_dnufe_gerarq character varying(10),
    anex_tipo_codi numeric(4,0)
);


ALTER TABLE public.sgd_dnufe_docnufe OWNER TO postgres;

--
-- Name: TABLE sgd_dnufe_docnufe; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_dnufe_docnufe IS 'Indica los documentos que componen un proceso de numeracion y fechado';


--
-- Name: COLUMN sgd_dnufe_docnufe.sgd_dnufe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dnufe_docnufe.sgd_dnufe_codi IS 'Id del registro';


--
-- Name: COLUMN sgd_dnufe_docnufe.sgd_pnufe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dnufe_docnufe.sgd_pnufe_codi IS 'codigo del proceso';


--
-- Name: COLUMN sgd_dnufe_docnufe.sgd_tpr_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dnufe_docnufe.sgd_tpr_codigo IS 'codigo del documento que hace parte de un proceso de numeracion y fechado';


--
-- Name: COLUMN sgd_dnufe_docnufe.sgd_dnufe_label; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dnufe_docnufe.sgd_dnufe_label IS 'label del documento que ha de usarse en la interfaz de gestion de procesos de numeracion y fechado';


--
-- Name: COLUMN sgd_dnufe_docnufe.trte_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dnufe_docnufe.trte_codi IS 'indica el tipo de remitente para quien va dirigida la comunicacion';


--
-- Name: COLUMN sgd_dnufe_docnufe.sgd_dnufe_main; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_dnufe_docnufe.sgd_dnufe_main IS 'Indica si el registro es el documento principal del paquete';


--
-- Name: sgd_eanu_estanulacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_eanu_estanulacion (
    sgd_eanu_desc character varying(150),
    sgd_eanu_codi numeric
);


ALTER TABLE public.sgd_eanu_estanulacion OWNER TO postgres;

--
-- Name: sgd_einv_inventario; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_einv_inventario (
    sgd_einv_codigo numeric NOT NULL,
    sgd_depe_nomb character varying(400),
    sgd_depe_codi character varying(3),
    sgd_einv_expnum character varying(18),
    sgd_einv_titulo character varying(400),
    sgd_einv_unidad numeric,
    sgd_einv_fech date,
    sgd_einv_fechfin date,
    sgd_einv_radicados character varying(40),
    sgd_einv_folios numeric,
    sgd_einv_nundocu numeric,
    sgd_einv_nundocubodega numeric,
    sgd_einv_caja numeric,
    sgd_einv_cajabodega numeric,
    sgd_einv_srd numeric,
    sgd_einv_nomsrd character varying(400),
    sgd_einv_sbrd numeric,
    sgd_einv_nomsbrd character varying(400),
    sgd_einv_retencion character varying(400),
    sgd_einv_disfinal character varying(400),
    sgd_einv_ubicacion character varying(400),
    sgd_einv_observacion character varying(400)
);


ALTER TABLE public.sgd_einv_inventario OWNER TO postgres;

--
-- Name: sgd_eit_items; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_eit_items (
    sgd_eit_codigo numeric NOT NULL,
    sgd_eit_cod_padre numeric DEFAULT 0,
    sgd_eit_nombre character varying(40),
    sgd_eit_sigla character varying(6),
    codi_dpto numeric(4,0),
    codi_muni numeric(5,0)
);


ALTER TABLE public.sgd_eit_items OWNER TO postgres;

--
-- Name: sgd_empus_empusuario; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE sgd_empus_empusuario (
    usua_login character varying(10),
    identificador_empresa numeric(10,0)
);


ALTER TABLE public.sgd_empus_empusuario OWNER TO "admin";

--
-- Name: COLUMN sgd_empus_empusuario.identificador_empresa; Type: COMMENT; Schema: public; Owner: admin
--

COMMENT ON COLUMN sgd_empus_empusuario.identificador_empresa IS 'Corresponde al identificador de la tabla bodega_empresas';


--
-- Name: sgd_ent_entidades; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ent_entidades (
    sgd_ent_nit character varying(13) NOT NULL,
    sgd_ent_codsuc character varying(4) NOT NULL,
    sgd_ent_pias numeric(5,0),
    dpto_codi numeric(2,0),
    muni_codi numeric(4,0),
    sgd_ent_descrip character varying(80),
    sgd_ent_direccion character varying(50),
    sgd_ent_telefono character varying(50)
);


ALTER TABLE public.sgd_ent_entidades OWNER TO postgres;

--
-- Name: sgd_enve_envioespecial; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_enve_envioespecial (
    sgd_fenv_codigo numeric(4,0),
    sgd_enve_valorl character varying(30),
    sgd_enve_valorn character varying(30),
    sgd_enve_desc character varying(30)
);


ALTER TABLE public.sgd_enve_envioespecial OWNER TO postgres;

--
-- Name: COLUMN sgd_enve_envioespecial.sgd_fenv_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_enve_envioespecial.sgd_fenv_codigo IS 'Codigo Empresa de envio';


--
-- Name: COLUMN sgd_enve_envioespecial.sgd_enve_valorl; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_enve_envioespecial.sgd_enve_valorl IS 'Valor Campo Local';


--
-- Name: COLUMN sgd_enve_envioespecial.sgd_enve_valorn; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_enve_envioespecial.sgd_enve_valorn IS 'Valor Campo Nacional';


--
-- Name: COLUMN sgd_enve_envioespecial.sgd_enve_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_enve_envioespecial.sgd_enve_desc IS 'Descripcion Valor';


--
-- Name: tipo_doc_identificacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_doc_identificacion (
    tdid_codi numeric(2,0) NOT NULL,
    tdid_desc character varying(100) NOT NULL
);


ALTER TABLE public.tipo_doc_identificacion OWNER TO postgres;

--
-- Name: TABLE tipo_doc_identificacion; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE tipo_doc_identificacion IS 'TIPO_DOC_IDENTIFICACION';


--
-- Name: COLUMN tipo_doc_identificacion.tdid_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tipo_doc_identificacion.tdid_codi IS 'CODIGO DEL TIPO DE DOCUMENTO DE IDENTIFICACION';


--
-- Name: COLUMN tipo_doc_identificacion.tdid_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tipo_doc_identificacion.tdid_desc IS 'DESCIPCION DEL TIPO DE DOCUMENTO DE IDENTIFICACION';


--
-- Name: tipo_remitente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tipo_remitente (
    trte_codi numeric(2,0) NOT NULL,
    trte_desc character varying(100) NOT NULL
);


ALTER TABLE public.tipo_remitente OWNER TO postgres;

--
-- Name: TABLE tipo_remitente; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE tipo_remitente IS 'TIPO_REMITENTE';


--
-- Name: COLUMN tipo_remitente.trte_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tipo_remitente.trte_codi IS 'CODIGO TIPO DE REMITENTE';


--
-- Name: COLUMN tipo_remitente.trte_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN tipo_remitente.trte_desc IS 'DESC DEL TIPO DE REMITENTE';


--
-- Name: sgd_est_estadi; Type: VIEW; Schema: public; Owner: postgres
--

CREATE VIEW sgd_est_estadi AS
    SELECT a.radi_nume_radi, a.radi_fech_radi, a.radi_depe_radi, a.radi_usua_radi, a.radi_depe_actu, a.radi_usua_actu, a.trte_codi, a.tdid_codi, a.radi_nomb, a.eesp_codi, b.usua_nomb, c.depe_nomb, d.tdid_desc FROM radicado a, usuario b, dependencia c, tipo_doc_identificacion d, tipo_remitente e WHERE (((((a.radi_usua_actu = b.usua_codi) AND (a.radi_depe_actu = b.depe_codi)) AND (a.radi_depe_actu = c.depe_codi)) AND (d.tdid_codi = a.tdoc_codi)) AND (a.trte_codi = e.trte_codi));


ALTER TABLE public.sgd_est_estadi OWNER TO postgres;

--
-- Name: sgd_estc_estconsolid; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_estc_estconsolid (
    sgd_estc_codigo numeric,
    sgd_tpr_codigo numeric,
    dep_nombre character varying(30),
    depe_codi numeric,
    sgd_estc_ctotal numeric,
    sgd_estc_centramite numeric,
    sgd_estc_csinriesgo numeric,
    sgd_estc_criesgomedio numeric,
    sgd_estc_criesgoalto numeric,
    sgd_estc_ctramitados numeric,
    sgd_estc_centermino numeric,
    sgd_estc_cfueratermino numeric,
    sgd_estc_fechgen date,
    sgd_estc_fechini date,
    sgd_estc_fechfin date,
    sgd_estc_fechiniresp date,
    sgd_estc_fechfinresp date,
    sgd_estc_dsinriesgo numeric,
    sgd_estc_driesgomegio numeric,
    sgd_estc_driesgoalto numeric,
    sgd_estc_dtermino numeric,
    sgd_estc_grupgenerado numeric
);


ALTER TABLE public.sgd_estc_estconsolid OWNER TO postgres;

--
-- Name: TABLE sgd_estc_estconsolid; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_estc_estconsolid IS 'Tabla en la cual se almacenan consolidados de las territoriales.';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_codigo IS 'Codigo Registro Unico';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_tpr_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_tpr_codigo IS 'Tipo de Documento';


--
-- Name: COLUMN sgd_estc_estconsolid.dep_nombre; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.dep_nombre IS 'Nombre Grupo Dependenciad de cada Territorial';


--
-- Name: COLUMN sgd_estc_estconsolid.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.depe_codi IS 'Codigo dependencia';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_ctotal; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_ctotal IS 'Cantidad Documentos';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_centramite; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_centramite IS 'Cantidad Documentos En tramite';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_csinriesgo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_csinriesgo IS 'Cantidad Documentos Sin riesgo';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_criesgomedio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_criesgomedio IS 'Cantidad de Documentos en Riesgo Medio';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_criesgoalto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_criesgoalto IS 'Cantidad de Documentos en Riesgo Alto';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_ctramitados; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_ctramitados IS 'Cantidad de Documentos Tramitados';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_centermino; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_centermino IS 'Cantidad Documentos Tramitados en Termino';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_cfueratermino; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_cfueratermino IS 'Cantidad Documentos Tramitados Fuera de Termino';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_fechgen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_fechgen IS 'Fecha Generados';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_fechini; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_fechini IS 'Fecha Inicio de Reporde de Radicados';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_fechfin; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_fechfin IS 'Fecha Fin de Reporte de Radicados';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_fechiniresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_fechiniresp IS 'Fecha inicio de Documentos respuesta';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_fechfinresp; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_fechfinresp IS 'Fecha Fin de Documentos Respuesta';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_dsinriesgo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_dsinriesgo IS 'Dias definidos para Riesgo Bajo';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_driesgomegio; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_driesgomegio IS 'Dias Para Riesgo Medio';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_driesgoalto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_driesgoalto IS 'Dias Para Riesgo Alto';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_dtermino; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_dtermino IS 'Dias Reales de Termino de los Documentos.';


--
-- Name: COLUMN sgd_estc_estconsolid.sgd_estc_grupgenerado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_estc_estconsolid.sgd_estc_grupgenerado IS 'Numero Historico de la Generacion.';


--
-- Name: sgd_estinst_estadoinstancia; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_estinst_estadoinstancia (
    sgd_estinst_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_instorf_codi numeric(4,0),
    sgd_estinst_valor numeric(4,0),
    sgd_estinst_habilita numeric(1,0),
    sgd_estinst_mensaje character varying(100)
);


ALTER TABLE public.sgd_estinst_estadoinstancia OWNER TO postgres;

--
-- Name: sgd_exp_expediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_exp_expediente (
    sgd_exp_numero character varying(18),
    radi_nume_radi numeric(18,0),
    sgd_exp_fech date,
    sgd_exp_fech_mod date,
    depe_codi numeric(4,0),
    usua_codi numeric(3,0),
    usua_doc character varying(15),
    sgd_exp_estado numeric(1,0) DEFAULT 0,
    sgd_exp_titulo character varying(50),
    sgd_exp_asunto character varying(150),
    sgd_exp_carpeta character varying(30),
    sgd_exp_ufisica character varying(20),
    sgd_exp_isla character varying(10),
    sgd_exp_estante character varying(10),
    sgd_exp_caja character varying(10),
    sgd_exp_fech_arch date,
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_fexp_codigo numeric(3,0),
    sgd_exp_subexpediente character varying(20),
    sgd_exp_archivo numeric(1,0),
    sgd_exp_unicon numeric(1,0),
    sgd_exp_fechfin date,
    sgd_exp_folios character varying(6),
    sgd_exp_rete numeric(2,0),
    sgd_exp_entrepa numeric(6,0),
    radi_usua_arch character varying(40),
    sgd_exp_edificio character varying(400),
    sgd_exp_caja_bodega character varying(40),
    sgd_exp_carro character varying(40),
    sgd_exp_carpeta_bodega character varying(40),
    sgd_exp_privado numeric(1,0),
    sgd_exp_cd character varying(10),
    sgd_exp_nref character varying(7),
    sgd_sexp_paraexp1 character varying(50)
);


ALTER TABLE public.sgd_exp_expediente OWNER TO postgres;

--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_numero; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_numero IS 'Numero de Expediente';


--
-- Name: COLUMN sgd_exp_expediente.radi_nume_radi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.radi_nume_radi IS 'Radicado Asociado por cada radicado puede existir un registro de ubicacion en el expediente.';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_fech; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_fech IS 'Fecha de Creacion del Expediente';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_fech_mod; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_fech_mod IS 'Fecha de Ultima modificacion';


--
-- Name: COLUMN sgd_exp_expediente.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.depe_codi IS 'Dependencia que crea el expediente';


--
-- Name: COLUMN sgd_exp_expediente.usua_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.usua_codi IS 'Codigo del Usuario que crea el expediente ';


--
-- Name: COLUMN sgd_exp_expediente.usua_doc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.usua_doc IS 'Documento del usuario que crea el documento';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_estado IS 'Indica si el radicado esta archivado (1) o no (0)';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_titulo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_titulo IS 'Titulo de expediente se coloca en archivo';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_asunto; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_asunto IS 'Asunto del expediente';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_carpeta; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_carpeta IS 'Ubicacion en carpeta';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_ufisica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_ufisica IS 'Ubicacion fisica';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_isla; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_isla IS 'Isla';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_estante; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_estante IS 'Estante';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_caja; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_caja IS 'Caja';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_fech_arch; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_fech_arch IS 'Fecha de archivado';


--
-- Name: COLUMN sgd_exp_expediente.sgd_srd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_srd_codigo IS 'Serie';


--
-- Name: COLUMN sgd_exp_expediente.sgd_sbrd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_sbrd_codigo IS 'Subserie';


--
-- Name: COLUMN sgd_exp_expediente.sgd_fexp_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_fexp_codigo IS 'Fecha del expediente';


--
-- Name: COLUMN sgd_exp_expediente.sgd_exp_subexpediente; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_exp_expediente.sgd_exp_subexpediente IS 'Nombre de subexpediente';


--
-- Name: sgd_fars_faristas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fars_faristas (
    sgd_fars_codigo numeric(5,0) NOT NULL,
    sgd_pexp_codigo numeric(4,0),
    sgd_fexp_codigoini numeric(6,0),
    sgd_fexp_codigofin numeric(6,0),
    sgd_fars_diasminimo numeric(3,0),
    sgd_fars_diasmaximo numeric(3,0),
    sgd_fars_desc character varying(100),
    sgd_trad_codigo numeric(2,0),
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_fars_tipificacion numeric(1,0),
    sgd_tpr_codigo numeric,
    sgd_fars_automatico numeric,
    sgd_fars_rolgeneral numeric
);


ALTER TABLE public.sgd_fars_faristas OWNER TO postgres;

--
-- Name: sgd_fenv_frmenvio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fenv_frmenvio (
    sgd_fenv_codigo numeric(5,0) NOT NULL,
    sgd_fenv_descrip character varying(40),
    sgd_fenv_planilla numeric(1,0) DEFAULT 0 NOT NULL,
    sgd_fenv_estado numeric(1,0) DEFAULT 1 NOT NULL
);


ALTER TABLE public.sgd_fenv_frmenvio OWNER TO postgres;

--
-- Name: sgd_fexp_flujoexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fexp_flujoexpedientes (
    sgd_fexp_codigo numeric(6,0),
    sgd_pexp_codigo numeric(6,0),
    sgd_fexp_orden numeric(4,0),
    sgd_fexp_terminos numeric(4,0),
    sgd_fexp_imagen character varying(50),
    sgd_fexp_descrip character varying(150)
);


ALTER TABLE public.sgd_fexp_flujoexpedientes OWNER TO postgres;

--
-- Name: TABLE sgd_fexp_flujoexpedientes; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_fexp_flujoexpedientes IS 'Descripcion de la etapa en el Tipo de Proceso incicado en el campo SGD_PEXP_CODIGO';


--
-- Name: COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_codigo IS 'Codigo etapa del Flujo. Codigo debe ser Unico.';


--
-- Name: COLUMN sgd_fexp_flujoexpedientes.sgd_pexp_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_fexp_flujoexpedientes.sgd_pexp_codigo IS 'Codigo de proceso al cual se le incluira el flujo';


--
-- Name: COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_orden; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_orden IS 'Orden de la Etapa en el Flujo Documental';


--
-- Name: COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_terminos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_terminos IS 'Numero de dias de plazo para cumplimiento de esta etapa.';


--
-- Name: COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_imagen; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_imagen IS 'Icono para distinguir la etapa.';


--
-- Name: COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_descrip; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_fexp_flujoexpedientes.sgd_fexp_descrip IS 'Descripcion de la etapa en el Tipo de Proceso incicado en el campo SGD_PEXP_CODIGO';


--
-- Name: sgd_firrad_firmarads; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_firrad_firmarads (
    sgd_firrad_id numeric(15,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_firrad_firma character varying(255),
    sgd_firrad_fecha date,
    sgd_firrad_docsolic character varying(14) NOT NULL,
    sgd_firrad_fechsolic date NOT NULL,
    sgd_firrad_pk character varying(255)
);


ALTER TABLE public.sgd_firrad_firmarads OWNER TO postgres;

--
-- Name: sgd_fld_flujodoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fld_flujodoc (
    sgd_fld_codigo numeric(3,0),
    sgd_fld_desc character varying(100),
    sgd_tpr_codigo numeric(3,0),
    sgd_fld_imagen character varying(50),
    sgd_fld_grupoweb integer DEFAULT 0
);


ALTER TABLE public.sgd_fld_flujodoc OWNER TO postgres;

--
-- Name: sgd_fun_funciones; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_fun_funciones (
    sgd_fun_codigo numeric(4,0) NOT NULL,
    sgd_fun_descrip character varying(530),
    sgd_fun_fech_ini date,
    sgd_fun_fech_fin date
);


ALTER TABLE public.sgd_fun_funciones OWNER TO postgres;

--
-- Name: sgd_hfld_histflujodoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_hfld_histflujodoc (
    sgd_hfld_codigo numeric(6,0),
    sgd_fexp_codigo numeric(3,0) NOT NULL,
    sgd_exp_fechflujoant date,
    sgd_hfld_fech timestamp without time zone,
    sgd_exp_numero character varying(18),
    radi_nume_radi numeric(15,0),
    usua_doc character varying(10),
    usua_codi numeric(10,0),
    depe_codi numeric(4,0),
    sgd_ttr_codigo numeric(2,0),
    sgd_fexp_observa character varying(500),
    sgd_hfld_observa character varying(500),
    sgd_fars_codigo numeric,
    sgd_hfld_automatico numeric
);


ALTER TABLE public.sgd_hfld_histflujodoc OWNER TO postgres;

--
-- Name: COLUMN sgd_hfld_histflujodoc.sgd_hfld_fech; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_hfld_histflujodoc.sgd_hfld_fech IS 'Fecha Historico de expediente';


--
-- Name: sgd_hmtd_hismatdoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_hmtd_hismatdoc (
    sgd_hmtd_codigo numeric(6,0) NOT NULL,
    sgd_hmtd_fecha date NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    sgd_hmtd_obse character varying(600) NOT NULL,
    usua_doc numeric(13,0),
    depe_codi numeric(5,0),
    sgd_mtd_codigo numeric(4,0)
);


ALTER TABLE public.sgd_hmtd_hismatdoc OWNER TO postgres;

--
-- Name: sgd_hmtd_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_hmtd_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_hmtd_secue OWNER TO postgres;

--
-- Name: sgd_info_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_info_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_info_secue OWNER TO postgres;

--
-- Name: sgd_instorf_instanciasorfeo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_instorf_instanciasorfeo (
    sgd_instorf_codi numeric(4,0),
    sgd_instorf_desc character varying(100)
);


ALTER TABLE public.sgd_instorf_instanciasorfeo OWNER TO postgres;

--
-- Name: sgd_lip_linkip; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_lip_linkip (
    sgd_lip_id numeric(4,0) NOT NULL,
    sgd_lip_ipini character varying(20) NOT NULL,
    sgd_lip_ipfin character varying(20),
    sgd_lip_dirintranet character varying(150) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_lip_arch character varying(70),
    sgd_lip_diascache numeric(5,0),
    sgd_lip_rutaftp character varying(150),
    sgd_lip_servftp character varying(50),
    sgd_lip_usbd character varying(20),
    sgd_lip_nombd character varying(20),
    sgd_lip_pwdbd character varying(20),
    sgd_lip_usftp character varying(20),
    sgd_lip_pwdftp character varying(30)
);


ALTER TABLE public.sgd_lip_linkip OWNER TO postgres;

--
-- Name: sgd_mat_matriz; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mat_matriz (
    sgd_mat_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    sgd_fun_codigo numeric(4,0),
    sgd_prc_codigo numeric(4,0),
    sgd_prd_codigo numeric(4,0),
    sgd_mat_fech_ini date,
    sgd_mat_fech_fin date,
    sgd_mat_peso_prd numeric(5,2)
);


ALTER TABLE public.sgd_mat_matriz OWNER TO postgres;

--
-- Name: sgd_mat_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_mat_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 99999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_mat_secue OWNER TO postgres;

--
-- Name: sgd_mpes_mddpeso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mpes_mddpeso (
    sgd_mpes_codigo numeric(5,0) NOT NULL,
    sgd_mpes_descrip character varying(10)
);


ALTER TABLE public.sgd_mpes_mddpeso OWNER TO postgres;

--
-- Name: sgd_mrd_matrird; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mrd_matrird (
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_sbrd_codigo numeric(4,0) NOT NULL,
    sgd_tpr_codigo numeric(4,0) NOT NULL,
    soporte character varying(10),
    sgd_mrd_fechini date,
    sgd_mrd_fechfin date,
    sgd_mrd_esta character varying(10)
);


ALTER TABLE public.sgd_mrd_matrird OWNER TO postgres;

--
-- Name: sgd_msdep_msgdep; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_msdep_msgdep (
    sgd_msdep_codi numeric(15,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_msg_codi numeric(15,0) NOT NULL
);


ALTER TABLE public.sgd_msdep_msgdep OWNER TO postgres;

--
-- Name: sgd_msg_mensaje; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_msg_mensaje (
    sgd_msg_codi numeric(15,0) NOT NULL,
    sgd_tme_codi numeric(3,0) NOT NULL,
    sgd_msg_desc character varying(150),
    sgd_msg_fechdesp date NOT NULL,
    sgd_msg_url character varying(150) NOT NULL,
    sgd_msg_veces numeric(3,0) NOT NULL,
    sgd_msg_ancho numeric(6,0) NOT NULL,
    sgd_msg_largo numeric(6,0) NOT NULL
);


ALTER TABLE public.sgd_msg_mensaje OWNER TO postgres;

--
-- Name: sgd_mtd_matriz_doc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_mtd_matriz_doc (
    sgd_mtd_codigo numeric(4,0) NOT NULL,
    sgd_mat_codigo numeric(4,0),
    sgd_tpr_codigo numeric(4,0)
);


ALTER TABLE public.sgd_mtd_matriz_doc OWNER TO postgres;

--
-- Name: sgd_noh_nohabiles; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_noh_nohabiles (
    noh_fecha date NOT NULL
);


ALTER TABLE public.sgd_noh_nohabiles OWNER TO postgres;

--
-- Name: sgd_not_notificacion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_not_notificacion (
    sgd_not_codi numeric(3,0) NOT NULL,
    sgd_not_descrip character varying(100) NOT NULL
);


ALTER TABLE public.sgd_not_notificacion OWNER TO postgres;

--
-- Name: sgd_ntrd_notifrad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ntrd_notifrad (
    radi_nume_radi numeric(15,0) NOT NULL,
    sgd_not_codi numeric(3,0) NOT NULL,
    sgd_ntrd_notificador character varying(150),
    sgd_ntrd_notificado character varying(150),
    sgd_ntrd_fecha_not date,
    sgd_ntrd_num_edicto numeric(6,0),
    sgd_ntrd_fecha_fija date,
    sgd_ntrd_fecha_desfija date,
    sgd_ntrd_observaciones character varying(150)
);


ALTER TABLE public.sgd_ntrd_notifrad OWNER TO postgres;

--
-- Name: sgd_oem_oempresas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_oem_oempresas (
    sgd_oem_codigo numeric(8,0) NOT NULL,
    tdid_codi numeric(2,0),
    sgd_oem_oempresa character varying(300),
    sgd_oem_rep_legal character varying(300),
    sgd_oem_nit character varying(14),
    sgd_oem_sigla character varying(1000),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_oem_direccion character varying(1000),
    sgd_oem_telefono character varying(1000),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    email character varying(1000)
);


ALTER TABLE public.sgd_oem_oempresas OWNER TO postgres;

--
-- Name: sgd_oem_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_oem_secue
    START WITH 18398
    INCREMENT BY 1
    MAXVALUE 99999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_oem_secue OWNER TO postgres;

--
-- Name: sgd_panu_peranulados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_panu_peranulados (
    sgd_panu_codi numeric(4,0),
    sgd_panu_desc character varying(200)
);


ALTER TABLE public.sgd_panu_peranulados OWNER TO postgres;

--
-- Name: TABLE sgd_panu_peranulados; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_panu_peranulados IS 'Define los permisos de anulacion de documentos';


--
-- Name: COLUMN sgd_panu_peranulados.sgd_panu_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_panu_peranulados.sgd_panu_codi IS 'Descripcion';


--
-- Name: sgd_parametro; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_parametro (
    param_nomb character varying(25) NOT NULL,
    param_codi numeric(5,0) NOT NULL,
    param_valor character varying(25) NOT NULL
);


ALTER TABLE public.sgd_parametro OWNER TO postgres;

--
-- Name: TABLE sgd_parametro; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_parametro IS 'Almacena parametros compuestos por dos valores: identificador y valor';


--
-- Name: COLUMN sgd_parametro.param_nomb; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_parametro.param_nomb IS 'Nombre del tipo de parametro';


--
-- Name: COLUMN sgd_parametro.param_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_parametro.param_codi IS 'Codigo identificador del parametro';


--
-- Name: COLUMN sgd_parametro.param_valor; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_parametro.param_valor IS 'Valor del parametro';


--
-- Name: sgd_parexp_paramexpediente; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_parexp_paramexpediente (
    sgd_parexp_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(4,0) NOT NULL,
    sgd_parexp_tabla character varying(30) NOT NULL,
    sgd_parexp_etiqueta character varying(15) NOT NULL,
    sgd_parexp_orden numeric(1,0),
    sgd_parexp_editable numeric(1,0)
);


ALTER TABLE public.sgd_parexp_paramexpediente OWNER TO postgres;

--
-- Name: COLUMN sgd_parexp_paramexpediente.sgd_parexp_editable; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_parexp_paramexpediente.sgd_parexp_editable IS '1 o 0';


--
-- Name: sgd_pen_pensionados; Type: TABLE; Schema: public; Owner: admin; Tablespace: 
--

CREATE TABLE sgd_pen_pensionados (
    tdid_codi numeric(2,0),
    sgd_ciu_codigo numeric(8,0) NOT NULL,
    sgd_ciu_nombre character varying(150),
    sgd_ciu_direccion character varying(150),
    sgd_ciu_apell1 character varying(50),
    sgd_ciu_apell2 character varying(50),
    sgd_ciu_telefono character varying(50),
    sgd_ciu_email character varying(50),
    muni_codi numeric(4,0),
    dpto_codi numeric(2,0),
    sgd_ciu_cedula character varying(20),
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);


ALTER TABLE public.sgd_pen_pensionados OWNER TO "admin";

--
-- Name: sgd_pexp_procexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pexp_procexpedientes (
    sgd_pexp_codigo numeric NOT NULL,
    sgd_pexp_descrip character varying(100),
    sgd_pexp_terminos numeric DEFAULT 0,
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_pexp_automatico numeric(1,0) DEFAULT 1,
    sgd_pexp_tieneflujo numeric(1,0) DEFAULT 0
);


ALTER TABLE public.sgd_pexp_procexpedientes OWNER TO postgres;

--
-- Name: COLUMN sgd_pexp_procexpedientes.sgd_pexp_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pexp_procexpedientes.sgd_pexp_codigo IS 'Codigo que identifica el proceso';


--
-- Name: COLUMN sgd_pexp_procexpedientes.sgd_pexp_descrip; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pexp_procexpedientes.sgd_pexp_descrip IS 'Nombre del proceso';


--
-- Name: COLUMN sgd_pexp_procexpedientes.sgd_pexp_terminos; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pexp_procexpedientes.sgd_pexp_terminos IS 'termino del proceso';


--
-- Name: COLUMN sgd_pexp_procexpedientes.sgd_srd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pexp_procexpedientes.sgd_srd_codigo IS 'Serie (trd) que identifica el proceso';


--
-- Name: COLUMN sgd_pexp_procexpedientes.sgd_sbrd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pexp_procexpedientes.sgd_sbrd_codigo IS 'Subserie (trd) que identifica el proceso';


--
-- Name: COLUMN sgd_pexp_procexpedientes.sgd_pexp_tieneflujo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pexp_procexpedientes.sgd_pexp_tieneflujo IS 'Si el expediente tiene flujo';


--
-- Name: sgd_plg_secue; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE sgd_plg_secue
    START WITH 1
    INCREMENT BY 1
    MAXVALUE 9999999999
    NO MINVALUE
    CACHE 1;


ALTER TABLE public.sgd_plg_secue OWNER TO postgres;

--
-- Name: sgd_pnufe_procnumfe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pnufe_procnumfe (
    sgd_pnufe_codi numeric(4,0) NOT NULL,
    sgd_tpr_codigo numeric(4,0),
    sgd_pnufe_descrip character varying(150),
    sgd_pnufe_serie character varying(50)
);


ALTER TABLE public.sgd_pnufe_procnumfe OWNER TO postgres;

--
-- Name: TABLE sgd_pnufe_procnumfe; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_pnufe_procnumfe IS 'Cataloga los procesos de numeracion y fechado';


--
-- Name: COLUMN sgd_pnufe_procnumfe.sgd_pnufe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnufe_procnumfe.sgd_pnufe_codi IS 'Codigo del proceso';


--
-- Name: COLUMN sgd_pnufe_procnumfe.sgd_tpr_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnufe_procnumfe.sgd_tpr_codigo IS 'Codigo del documento que genera el procedimiento';


--
-- Name: COLUMN sgd_pnufe_procnumfe.sgd_pnufe_descrip; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnufe_procnumfe.sgd_pnufe_descrip IS 'Descripcion del procedimiento generado';


--
-- Name: COLUMN sgd_pnufe_procnumfe.sgd_pnufe_serie; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnufe_procnumfe.sgd_pnufe_serie IS 'Serie que maneja la numeracion de los documentos';


--
-- Name: sgd_pnun_procenum; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_pnun_procenum (
    sgd_pnun_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    depe_codi numeric(5,0),
    sgd_pnun_prepone character varying(50)
);


ALTER TABLE public.sgd_pnun_procenum OWNER TO postgres;

--
-- Name: COLUMN sgd_pnun_procenum.sgd_pnun_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnun_procenum.sgd_pnun_codi IS 'Id del registro';


--
-- Name: COLUMN sgd_pnun_procenum.sgd_pnufe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnun_procenum.sgd_pnufe_codi IS 'Codigo del proceso';


--
-- Name: COLUMN sgd_pnun_procenum.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnun_procenum.depe_codi IS 'Codigo de la dependencia';


--
-- Name: COLUMN sgd_pnun_procenum.sgd_pnun_prepone; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_pnun_procenum.sgd_pnun_prepone IS 'Preposicion empleada para generar el numero completo del documento';


--
-- Name: sgd_prc_proceso; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_prc_proceso (
    sgd_prc_codigo numeric(4,0) NOT NULL,
    sgd_prc_descrip character varying(150),
    sgd_prc_fech_ini date,
    sgd_prc_fech_fin date
);


ALTER TABLE public.sgd_prc_proceso OWNER TO postgres;

--
-- Name: sgd_prd_prcdmentos; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_prd_prcdmentos (
    sgd_prd_codigo numeric(4,0) NOT NULL,
    sgd_prd_descrip character varying(200),
    sgd_prd_fech_ini date,
    sgd_prd_fech_fin date
);


ALTER TABLE public.sgd_prd_prcdmentos OWNER TO postgres;

--
-- Name: sgd_rda_retdoca; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rda_retdoca (
    anex_radi_nume numeric(15,0) NOT NULL,
    anex_codigo character varying(20) NOT NULL,
    radi_nume_salida numeric(15,0),
    anex_borrado character varying(1),
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_rda_fech date,
    sgd_deve_codigo numeric(2,0),
    anex_solo_lect character varying(1),
    anex_radi_fech date,
    anex_estado numeric(1,0),
    anex_nomb_archivo character varying(50),
    anex_tipo numeric(4,0),
    sgd_dir_tipo numeric(4,0)
);


ALTER TABLE public.sgd_rda_retdoca OWNER TO postgres;

--
-- Name: sgd_rdf_retdocf; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rdf_retdocf (
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_rdf_fech date NOT NULL
);


ALTER TABLE public.sgd_rdf_retdocf OWNER TO postgres;

--
-- Name: sgd_renv_regenvio; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_renv_regenvio (
    sgd_renv_codigo numeric NOT NULL,
    sgd_fenv_codigo numeric,
    sgd_renv_fech timestamp without time zone,
    radi_nume_sal numeric,
    sgd_renv_destino character varying,
    sgd_renv_telefono character varying,
    sgd_renv_mail character varying,
    sgd_renv_peso character varying,
    sgd_renv_valor numeric,
    sgd_renv_certificado numeric,
    sgd_renv_estado numeric,
    usua_doc numeric,
    sgd_renv_nombre character varying,
    sgd_rem_destino numeric DEFAULT 0,
    sgd_dir_codigo numeric,
    sgd_renv_planilla character varying(8),
    sgd_renv_fech_sal timestamp without time zone,
    depe_codi numeric(5,0),
    sgd_dir_tipo numeric(4,0) DEFAULT 0,
    radi_nume_grupo numeric(14,0),
    sgd_renv_dir character varying(100),
    sgd_renv_depto character varying(30),
    sgd_renv_mpio character varying(30),
    sgd_renv_tel character varying(20),
    sgd_renv_cantidad numeric(4,0) DEFAULT 0,
    sgd_renv_tipo numeric(1,0) DEFAULT 0,
    sgd_renv_observa character varying(200),
    sgd_renv_grupo numeric(14,0),
    sgd_deve_codigo numeric(2,0),
    sgd_deve_fech timestamp without time zone,
    sgd_renv_valortotal character varying(14) DEFAULT 0,
    sgd_renv_valistamiento character varying(10) DEFAULT 0,
    sgd_renv_vdescuento character varying(10) DEFAULT 0,
    sgd_renv_vadicional character varying(14) DEFAULT 0,
    sgd_depe_genera numeric(5,0),
    sgd_renv_pais character varying(30) DEFAULT 'colombia'::character varying,
	sgd_renv_guia character varying(10)
);


ALTER TABLE public.sgd_renv_regenvio OWNER TO postgres;

--
-- Name: sgd_renv_regenvio1; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_renv_regenvio1 (
    sgd_renv_codigo numeric(6,0) NOT NULL,
    sgd_fenv_codigo numeric(5,0),
    sgd_renv_fech date,
    radi_nume_sal numeric(14,0),
    sgd_renv_destino character varying(150),
    sgd_renv_telefono character varying(50),
    sgd_renv_mail character varying(150),
    sgd_renv_peso character varying(10),
    sgd_renv_valor character varying(10),
    sgd_renv_certificado numeric(1,0),
    sgd_renv_estado numeric(1,0),
    usua_doc numeric(15,0),
    sgd_renv_nombre character varying(100),
    sgd_rem_destino numeric(1,0) DEFAULT 0,
    sgd_dir_codigo numeric(10,0),
    sgd_renv_planilla character varying(8),
    sgd_renv_fech_sal date,
    depe_codi numeric(5,0),
    sgd_dir_tipo numeric(4,0) DEFAULT 0,
    radi_nume_grupo numeric(14,0),
    sgd_renv_dir character varying(100),
    sgd_renv_depto character varying(30),
    sgd_renv_mpio character varying(30),
    sgd_renv_tel character varying(20),
    sgd_renv_cantidad numeric(4,0) DEFAULT 0,
    sgd_renv_tipo numeric(1,0) DEFAULT 0,
    sgd_renv_observa character varying(200),
    sgd_renv_grupo numeric(14,0),
    sgd_deve_codigo numeric(2,0),
    sgd_deve_fech date,
    sgd_renv_valortotal character varying(14) DEFAULT 0,
    sgd_renv_valistamiento character varying(10) DEFAULT 0,
    sgd_renv_vdescuento character varying(10) DEFAULT 0,
    sgd_renv_vadicional character varying(14) DEFAULT 0,
    sgd_depe_genera numeric(5,0),
    sgd_renv_pais character varying(30) DEFAULT 'colombia'::character varying
);


ALTER TABLE public.sgd_renv_regenvio1 OWNER TO postgres;

--
-- Name: COLUMN sgd_renv_regenvio1.sgd_renv_valistamiento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_renv_regenvio1.sgd_renv_valistamiento IS 'Valor Alistamiento';


--
-- Name: COLUMN sgd_renv_regenvio1.sgd_renv_vdescuento; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_renv_regenvio1.sgd_renv_vdescuento IS 'Descuento Autorizado para el envio';


--
-- Name: COLUMN sgd_renv_regenvio1.sgd_renv_vadicional; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_renv_regenvio1.sgd_renv_vadicional IS 'Valores Adicionales cobrados dependiendo del envio';


--
-- Name: sgd_rfax_reservafax; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rfax_reservafax (
    sgd_rfax_codigo numeric(10,0),
    sgd_rfax_fax character varying(30),
    usua_login character varying(30),
    sgd_rfax_fech date,
    sgd_rfax_fechradi date,
    radi_nume_radi numeric(15,0),
    sgd_rfax_observa character varying(500)
);


ALTER TABLE public.sgd_rfax_reservafax OWNER TO postgres;

--
-- Name: sgd_rmr_radmasivre; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_rmr_radmasivre (
    sgd_rmr_grupo numeric(15,0) NOT NULL,
    sgd_rmr_radi numeric(15,0) NOT NULL
);


ALTER TABLE public.sgd_rmr_radmasivre OWNER TO postgres;

--
-- Name: sgd_san_sancionados; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_san_sancionados (
    sgd_san_ref character varying(20) NOT NULL,
    sgd_san_decision character varying(60),
    sgd_san_cargo character varying(50),
    sgd_san_expediente character varying(20),
    sgd_san_tipo_sancion character varying(50),
    sgd_san_plazo character varying(100),
    sgd_san_valor numeric(14,2),
    sgd_san_radicacion character varying(15),
    sgd_san_fecha_radicado date,
    sgd_san_valorletras character varying(1000),
    sgd_san_nombreempresa character varying(160),
    sgd_san_motivos character varying(160),
    sgd_san_sectores character varying(160),
    sgd_san_padre character varying(15),
    sgd_san_fecha_padre date,
    sgd_san_notificado character varying(100)
);


ALTER TABLE public.sgd_san_sancionados OWNER TO postgres;

--
-- Name: sgd_san_sancionados_x; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_san_sancionados_x (
    radi_nume_radi numeric(15,0) NOT NULL,
    sgd_san_decision character varying(60),
    sgd_san_cargo character varying(50),
    sgd_san_expediente character varying(15),
    sgd_san_tipo_sancion character varying(50),
    sgd_san_plazo character varying(100),
    sgd_san_valor numeric(14,2),
    sgd_san_radicacion character varying(15),
    sgd_san_fecha_radicado date,
    sgd_san_valorletras character varying(1000),
    sgd_san_nombreempresa character varying(160),
    sgd_san_motivos character varying(160),
    sgd_san_sectores character varying(160),
    sgd_san_padre character varying(15)
);


ALTER TABLE public.sgd_san_sancionados_x OWNER TO postgres;

--
-- Name: sgd_sbrd_subserierd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sbrd_subserierd (
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_sbrd_codigo numeric(4,0) NOT NULL,
    sgd_sbrd_descrip character varying(500) NOT NULL,
    sgd_sbrd_fechini date NOT NULL,
    sgd_sbrd_fechfin date NOT NULL,
    sgd_sbrd_tiemag numeric(4,0),
    sgd_sbrd_tiemac numeric(4,0),
    sgd_sbrd_dispfin character varying(50),
    sgd_sbrd_soporte character varying(50),
    sgd_sbrd_procedi character varying(500)
);


ALTER TABLE public.sgd_sbrd_subserierd OWNER TO postgres;

--
-- Name: sgd_sed_sede; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sed_sede (
    sgd_sed_codi numeric(4,0) NOT NULL,
    sgd_sed_desc character varying(50),
    sgd_tpr_codigo numeric(4,0)
);


ALTER TABLE public.sgd_sed_sede OWNER TO postgres;

--
-- Name: sgd_senuf_secnumfe; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_senuf_secnumfe (
    sgd_senuf_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    depe_codi numeric(5,0),
    sgd_senuf_sec character varying(50)
);


ALTER TABLE public.sgd_senuf_secnumfe OWNER TO postgres;

--
-- Name: sgd_sexp_secexpedientes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_sexp_secexpedientes (
    sgd_exp_numero character varying(18) NOT NULL,
    sgd_srd_codigo numeric,
    sgd_sbrd_codigo numeric,
    sgd_sexp_secuencia numeric,
    depe_codi numeric,
    usua_doc character varying(15),
    sgd_sexp_fech date,
    sgd_fexp_codigo numeric,
    sgd_sexp_ano numeric,
    usua_doc_responsable character varying(18),
    sgd_sexp_parexp1 character varying(250),
    sgd_sexp_parexp2 character varying(160),
    sgd_sexp_parexp3 character varying(160),
    sgd_sexp_parexp4 character varying(160),
    sgd_sexp_parexp5 character varying(160),
    sgd_pexp_codigo numeric(3,0),
    sgd_exp_fech_arch date,
    sgd_fld_codigo numeric(3,0),
    sgd_exp_fechflujoant date,
    sgd_mrd_codigo numeric(4,0),
    sgd_exp_subexpediente numeric(18,0),
    sgd_exp_privado numeric(1,0)
);


ALTER TABLE public.sgd_sexp_secexpedientes OWNER TO postgres;

--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_exp_numero; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_exp_numero IS 'Numero del expediente';


--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_srd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_srd_codigo IS 'codigo serie';


--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_sbrd_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_sbrd_codigo IS 'codigo subserie';


--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_sexp_secuencia; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_sexp_secuencia IS 'numero del expediente';


--
-- Name: COLUMN sgd_sexp_secexpedientes.depe_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.depe_codi IS 'Dependencia creadora';


--
-- Name: COLUMN sgd_sexp_secexpedientes.usua_doc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.usua_doc IS 'Documento del usuario creador';


--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_sexp_fech; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_sexp_fech IS 'Fecha de inicio del proceso';


--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_fexp_codigo; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_fexp_codigo IS 'Codigo de proceso';


--
-- Name: COLUMN sgd_sexp_secexpedientes.sgd_sexp_ano; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_sexp_secexpedientes.sgd_sexp_ano IS 'A?o del expediente';


--
-- Name: sgd_srd_seriesrd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_srd_seriesrd (
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_srd_descrip character varying(60) NOT NULL,
    sgd_srd_fechini date NOT NULL,
    sgd_srd_fechfin date NOT NULL
);


ALTER TABLE public.sgd_srd_seriesrd OWNER TO postgres;

--
-- Name: sgd_tar_tarifas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tar_tarifas (
    sgd_fenv_codigo numeric(5,0),
    sgd_tar_codser numeric(5,0),
    sgd_tar_codigo numeric(5,0),
    sgd_tar_valenv1 numeric(15,0),
    sgd_tar_valenv2 numeric(15,0),
    sgd_tar_valenv1g1 numeric(15,0),
    sgd_clta_codser numeric(5,0),
    sgd_tar_valenv2g2 numeric(15,0),
    sgd_clta_descrip character varying(100)
);


ALTER TABLE public.sgd_tar_tarifas OWNER TO postgres;

--
-- Name: sgd_tdec_tipodecision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tdec_tipodecision (
    sgd_apli_codi numeric(4,0) NOT NULL,
    sgd_tdec_codigo numeric(4,0) NOT NULL,
    sgd_tdec_descrip character varying(150),
    sgd_tdec_sancionar numeric(1,0),
    sgd_tdec_firmeza numeric(1,0),
    sgd_tdec_versancion numeric(1,0),
    sgd_tdec_showmenu numeric(1,0),
    sgd_tdec_updnotif numeric(1,0),
    sgd_tdec_veragota numeric(1,0)
);


ALTER TABLE public.sgd_tdec_tipodecision OWNER TO postgres;

--
-- Name: sgd_tid_tipdecision; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tid_tipdecision (
    sgd_tid_codi numeric(4,0) NOT NULL,
    sgd_tid_desc character varying(150),
    sgd_tpr_codigo numeric(4,0),
    sgd_pexp_codigo numeric(2,0),
    sgd_tpr_codigop numeric(2,0)
);


ALTER TABLE public.sgd_tid_tipdecision OWNER TO postgres;

--
-- Name: TABLE sgd_tid_tipdecision; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_tid_tipdecision IS 'Tipos de decision';


--
-- Name: COLUMN sgd_tid_tipdecision.sgd_tid_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tid_tipdecision.sgd_tid_codi IS 'Id del registro';


--
-- Name: COLUMN sgd_tid_tipdecision.sgd_tid_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tid_tipdecision.sgd_tid_desc IS 'Descripcion';


--
-- Name: sgd_tidm_tidocmasiva; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tidm_tidocmasiva (
    sgd_tidm_codi numeric(4,0) NOT NULL,
    sgd_tidm_desc character varying(150)
);


ALTER TABLE public.sgd_tidm_tidocmasiva OWNER TO postgres;

--
-- Name: TABLE sgd_tidm_tidocmasiva; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_tidm_tidocmasiva IS 'Cataloga los documentos que hacen parte del procedimiento de correspondencia masiva';


--
-- Name: COLUMN sgd_tidm_tidocmasiva.sgd_tidm_codi; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tidm_tidocmasiva.sgd_tidm_codi IS 'Codigo del documento';


--
-- Name: COLUMN sgd_tidm_tidocmasiva.sgd_tidm_desc; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tidm_tidocmasiva.sgd_tidm_desc IS 'Descripcion';


--
-- Name: sgd_tip3_tipotercero; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tip3_tipotercero (
    sgd_tip3_codigo numeric(2,0) NOT NULL,
    sgd_dir_tipo numeric(4,0),
    sgd_tip3_nombre character varying(15),
    sgd_tip3_desc character varying(30),
    sgd_tip3_imgpestana character varying(20),
    sgd_tpr_tp1 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp2 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp7 smallint DEFAULT 1,
    sgd_tpr_tp8 smallint DEFAULT 1,
    sgd_tpr_tp3 smallint DEFAULT 1,
    sgd_tpr_tp4 smallint DEFAULT 1,
    sgd_tpr_tp5 smallint DEFAULT 1,
    sgd_tpr_tp6 smallint DEFAULT 1
);


ALTER TABLE public.sgd_tip3_tipotercero OWNER TO postgres;

--
-- Name: sgd_tma_temas; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tma_temas (
    sgd_tma_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    sgd_prc_codigo numeric(4,0),
    sgd_tma_descrip character varying(150)
);


ALTER TABLE public.sgd_tma_temas OWNER TO postgres;

--
-- Name: sgd_tme_tipmen; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tme_tipmen (
    sgd_tme_codi numeric(3,0) NOT NULL,
    sgd_tme_desc character varying(150)
);


ALTER TABLE public.sgd_tme_tipmen OWNER TO postgres;

--
-- Name: sgd_tpr_tpdcumento; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_tpr_tpdcumento (
    sgd_tpr_codigo numeric(4,0) NOT NULL,
    sgd_tpr_descrip character varying(500),
    sgd_tpr_termino numeric(4,0),
    sgd_tpr_tpuso numeric(1,0),
    sgd_tpr_numera character(1),
    sgd_tpr_radica character(1),
    sgd_tpr_tp1 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp2 numeric(1,0) DEFAULT 0,
    sgd_tpr_estado numeric(1,0),
    sgd_termino_real numeric(4,0),
    sgd_tpr_tp7 smallint,
    sgd_tpr_web smallint DEFAULT 1,
    sgd_tpr_tiptermino character varying(5),
    sgd_tpr_tp8 smallint,
    sgd_tpr_tp3 smallint,
    sgd_tpr_tp4 smallint,
    sgd_tpr_tp5 smallint,
    sgd_tpr_tp6 smallint,
    sgd_tpr_tp9 smallint
);


ALTER TABLE public.sgd_tpr_tpdcumento OWNER TO postgres;

--
-- Name: COLUMN sgd_tpr_tpdcumento.sgd_tpr_numera; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tpr_tpdcumento.sgd_tpr_numera IS 'INDICA SI UN DOCUMNTO PUEDE NUMERARSE';


--
-- Name: COLUMN sgd_tpr_tpdcumento.sgd_tpr_radica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tpr_tpdcumento.sgd_tpr_radica IS 'INDICA SI UN DOCUMNTO PUEDE RADICARSE';


--
-- Name: COLUMN sgd_tpr_tpdcumento.sgd_tpr_tp1; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tpr_tpdcumento.sgd_tpr_tp1 IS 'Radicados de salida';


--
-- Name: COLUMN sgd_tpr_tpdcumento.sgd_tpr_tp2; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tpr_tpdcumento.sgd_tpr_tp2 IS 'Radicados de entrada';


--
-- Name: COLUMN sgd_tpr_tpdcumento.sgd_tpr_estado; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tpr_tpdcumento.sgd_tpr_estado IS 'Estado del documento 1- habilitado 2- deshabilitado';


--
-- Name: COLUMN sgd_tpr_tpdcumento.sgd_tpr_web; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN sgd_tpr_tpdcumento.sgd_tpr_web IS 'Prueba';


--
-- Name: sgd_trad_tiporad; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_trad_tiporad (
    sgd_trad_codigo numeric(2,0) NOT NULL,
    sgd_trad_descr character varying(30),
    sgd_trad_icono character varying(30),
    sgd_trad_diasbloqueo numeric(2,0),
    sgd_trad_genradsal smallint
);


ALTER TABLE public.sgd_trad_tiporad OWNER TO postgres;

--
-- Name: sgd_ttr_transaccion; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ttr_transaccion (
    sgd_ttr_codigo numeric(3,0) NOT NULL,
    sgd_ttr_descrip character varying(100) NOT NULL
);


ALTER TABLE public.sgd_ttr_transaccion OWNER TO postgres;

--
-- Name: sgd_ush_usuhistorico; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_ush_usuhistorico (
    sgd_ush_admcod numeric(10,0) NOT NULL,
    sgd_ush_admdep numeric(5,0) NOT NULL,
    sgd_ush_admdoc character varying(14) NOT NULL,
    sgd_ush_usucod numeric(10,0) NOT NULL,
    sgd_ush_usudep numeric(5,0) NOT NULL,
    sgd_ush_usudoc character varying(14) NOT NULL,
    sgd_ush_modcod numeric(5,0) NOT NULL,
    sgd_ush_fechevento date NOT NULL,
    sgd_ush_usulogin character varying(20) NOT NULL
);


ALTER TABLE public.sgd_ush_usuhistorico OWNER TO postgres;

--
-- Name: TABLE sgd_ush_usuhistorico; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_ush_usuhistorico IS 'Representa las modificaciones hechas a los usuarios. Registro historico por usuario sobre el tipo de transaccion realizada y los cambios con fecha y hora de realizacion.';


--
-- Name: sgd_usm_usumodifica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE sgd_usm_usumodifica (
    sgd_usm_modcod numeric(5,0) NOT NULL,
    sgd_usm_moddescr character varying(60) NOT NULL
);


ALTER TABLE public.sgd_usm_usumodifica OWNER TO postgres;

--
-- Name: TABLE sgd_usm_usumodifica; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON TABLE sgd_usm_usumodifica IS 'Contiene los tipos de modificaciones que se pueden hacer a los usuarios del sistema.';


--
-- Name: ubicacion_fisica; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ubicacion_fisica (
    ubic_depe_radi numeric(5,0),
    ubic_depe_arch numeric(5,0)
);


ALTER TABLE public.ubicacion_fisica OWNER TO postgres;

--
-- Name: ID; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_arch_depe
    ADD CONSTRAINT "ID" PRIMARY KEY (sgd_arch_id);


--
-- Name: PK_SGD_TTR_TRANSACCION; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_ttr_transaccion
    ADD CONSTRAINT "PK_SGD_TTR_TRANSACCION" PRIMARY KEY (sgd_ttr_codigo);


--
-- Name: SGD_TRAD_TIPORAD_CODIGO_INX; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_trad_tiporad
    ADD CONSTRAINT "SGD_TRAD_TIPORAD_CODIGO_INX" PRIMARY KEY (sgd_trad_codigo);


--
-- Name: pk_radicados; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY radicado
    ADD CONSTRAINT pk_radicados PRIMARY KEY (radi_nume_radi);


--
-- Name: sgd_archivo_central2_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_archivo_central
    ADD CONSTRAINT sgd_archivo_central2_pk PRIMARY KEY (sgd_archivo_id);


--
-- Name: sgd_carp_descripcion_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_pk PRIMARY KEY (sgd_carp_depecodi, sgd_carp_tiporad);


--
-- Name: sgd_einv_inventario_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_einv_inventario
    ADD CONSTRAINT sgd_einv_inventario_pk PRIMARY KEY (sgd_einv_codigo);


--
-- Name: sgd_eit_items_pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_eit_items
    ADD CONSTRAINT sgd_eit_items_pk PRIMARY KEY (sgd_eit_codigo);


--
-- Name: sgd_eit_items_uk1; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY sgd_eit_items
    ADD CONSTRAINT sgd_eit_items_uk1 UNIQUE (sgd_eit_cod_padre, sgd_eit_nombre, sgd_eit_sigla);


--
-- Name: usuario_pk2; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_pk2 PRIMARY KEY (usua_login);


--
-- Name: usuario_uk3; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY usuario
    ADD CONSTRAINT usuario_uk3 UNIQUE (usua_codi, depe_codi);


--
-- Name: anex_hist_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX anex_hist_pk ON anexos_historico USING btree (anex_hist_anex_codi, anex_hist_num_ver);


--
-- Name: anex_pk_anex_tipo_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX anex_pk_anex_tipo_codi ON anexos_tipo USING btree (anex_tipo_codi);


--
-- Name: ano; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ano ON sgd_archivo_central USING btree (sgd_archivo_year);


--
-- Name: bloqueo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX bloqueo ON series USING btree (bloq);


--
-- Name: busqueda; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX busqueda ON sgd_archivo_central USING btree (sgd_archivo_demandado, sgd_archivo_demandante, sgd_archivo_orden);


--
-- Name: carpetas_per; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX carpetas_per ON carpeta_per USING btree (codi_carp, depe_codi, usua_codi);


--
-- Name: carpetas_per1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX carpetas_per1 ON carpeta_per USING btree (usua_codi, depe_codi);


--
-- Name: carpetas_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX carpetas_pk ON carpeta USING btree (carp_codi);


--
-- Name: carro; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX carro ON sgd_archivo_central USING btree (sgd_archivo_carro);


--
-- Name: centro_poblado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX centro_poblado_pk ON centro_poblado USING btree (cpob_codi, muni_codi, dpto_codi);


--
-- Name: departamento_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX departamento_pk ON departamento USING btree (dpto_codi);


--
-- Name: dependencia_visibilidad_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX dependencia_visibilidad_pk ON dependencia_visibilidad USING btree (codigo_visibilidad);


--
-- Name: estados_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX estados_pk ON estado USING btree (esta_codi);


--
-- Name: funcionario_fun_usuadoc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX funcionario_fun_usuadoc ON fun_funcionario USING btree (usua_doc);


--
-- Name: hist_consulta; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX hist_consulta ON hist_eventos USING btree (radi_nume_radi, hist_fech, depe_codi, usua_codi);


--
-- Name: hist_consulta_archivo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX hist_consulta_archivo ON sgd_archivo_hist USING btree (sgd_archivo_rad, hist_fech, depe_codi, usua_codi);


--
-- Name: hist_tipotrans; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX hist_tipotrans ON hist_eventos USING btree (sgd_ttr_codigo);


--
-- Name: hist_tipotrans_archivo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX hist_tipotrans_archivo ON sgd_archivo_hist USING btree (sgd_ttr_codigo);


--
-- Name: idx_dependencia; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_dependencia ON sgd_archivo_central USING btree (sgd_archivo_depe);


--
-- Name: idx_sgd_eanu_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX idx_sgd_eanu_codigo ON radicado USING btree (sgd_eanu_codigo);


--
-- Name: ind_anex_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_anex_codigo ON sgd_dir_drecciones USING btree (sgd_anex_codigo);


--
-- Name: ind_bodega_; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX ind_bodega_ ON bodega_empresas_old USING btree (identificador_empresa);


--
-- Name: ind_bodega_empresas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_bodega_empresas ON bodega_empresas USING btree (identificador_empresa);


--
-- Name: ind_bodega_empresas_nombreemp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_bodega_empresas_nombreemp ON bodega_empresas_old USING btree (nombre_de_la_empresa);


--
-- Name: ind_dir_ciu_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_dir_ciu_codigo ON sgd_dir_drecciones USING btree (sgd_ciu_codigo);


--
-- Name: ind_dir_direcc_sgd_esp_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_dir_direcc_sgd_esp_codi ON sgd_dir_drecciones USING btree (sgd_esp_codi);


--
-- Name: ind_exp_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_exp_radi ON sgd_exp_expediente USING btree (radi_nume_radi);


--
-- Name: ind_informado_depe_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_informado_depe_codi ON informados USING btree (depe_codi);


--
-- Name: ind_informado_usua; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_informado_usua ON informados USING btree (usua_codi);


--
-- Name: ind_radi_cuentai; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radi_cuentai ON radicado USING btree (radi_cuentai);


--
-- Name: ind_radi_depe_actu; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radi_depe_actu ON radicado USING btree (radi_depe_actu);


--
-- Name: ind_radi_fech_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radi_fech_radi ON radicado USING btree (radi_fech_radi);


--
-- Name: ind_radi_mrec_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radi_mrec_codi ON radicado USING btree (mrec_codi);


--
-- Name: ind_radi_mtd_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radi_mtd_codigo ON radicado USING btree (sgd_mtd_codigo);


--
-- Name: ind_radi_par_serv; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radi_par_serv ON radicado USING btree (par_serv_secue);


--
-- Name: ind_radicado_codi_nivel; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radicado_codi_nivel ON radicado USING btree (codi_nivel);


--
-- Name: ind_radicado_radi_path; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radicado_radi_path ON radicado USING btree (radi_path);


--
-- Name: ind_radicado_tdoc_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_radicado_tdoc_codi ON radicado USING btree (tdoc_codi);


--
-- Name: ind_regenvio_depcodi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_regenvio_depcodi ON sgd_renv_regenvio1 USING btree (depe_codi);


--
-- Name: ind_renv_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_codigo ON sgd_renv_regenvio1 USING btree (sgd_renv_codigo);


--
-- Name: ind_renv_fech; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_fech ON sgd_renv_regenvio1 USING btree (sgd_renv_fech);


--
-- Name: ind_renv_fech_sal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_fech_sal ON sgd_renv_regenvio1 USING btree (sgd_renv_fech_sal);


--
-- Name: ind_renv_fenv; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_fenv ON sgd_renv_regenvio1 USING btree (sgd_fenv_codigo);


--
-- Name: ind_renv_grupo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_grupo ON sgd_renv_regenvio1 USING btree (sgd_renv_grupo);


--
-- Name: ind_renv_radi_sal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_renv_radi_sal ON sgd_renv_regenvio1 USING btree (radi_nume_sal, depe_codi, sgd_fenv_codigo);


--
-- Name: ind_rfax_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_rfax_codigo ON sgd_rfax_reservafax USING btree (sgd_rfax_codigo);


--
-- Name: ind_rfax_fax; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_rfax_fax ON sgd_rfax_reservafax USING btree (sgd_rfax_fax);


--
-- Name: ind_rfax_fech; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_rfax_fech ON sgd_rfax_reservafax USING btree (sgd_rfax_fech);


--
-- Name: ind_rfax_radi_nume_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_rfax_radi_nume_radi ON sgd_rfax_reservafax USING btree (radi_nume_radi);


--
-- Name: ind_sgd_dir_nombre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_dir_nombre ON sgd_dir_drecciones USING btree (sgd_dir_nombre);


--
-- Name: ind_sgd_dir_nomremdes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_dir_nomremdes ON sgd_dir_drecciones USING btree (sgd_dir_nomremdes);


--
-- Name: ind_sgd_dir_oem_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_dir_oem_codigo ON sgd_dir_drecciones USING btree (sgd_oem_codigo);


--
-- Name: ind_sgd_dir_radi_nume; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_dir_radi_nume ON sgd_dir_drecciones USING btree (radi_nume_radi);


--
-- Name: ind_sgd_doc_fun; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_doc_fun ON sgd_dir_drecciones USING btree (sgd_doc_fun);


--
-- Name: ind_sgd_renv_planilla; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_renv_planilla ON sgd_renv_regenvio1 USING btree (sgd_renv_planilla);


--
-- Name: ind_sgd_tpr_tpdocdescrp; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_tpr_tpdocdescrp ON sgd_tpr_tpdcumento USING btree (sgd_tpr_descrip);


--
-- Name: ind_sgd_trd_codigo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ind_sgd_trd_codigo ON sgd_dir_drecciones USING btree (sgd_trd_codigo);


--
-- Name: informado_usuario; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX informado_usuario ON informados USING btree (depe_codi, usua_codi, info_fech);


--
-- Name: municipio_depto_idx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX municipio_depto_idx ON municipio USING btree (dpto_codi);


--
-- Name: padre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX padre ON sgd_eit_items USING btree (sgd_eit_cod_padre);


--
-- Name: pk_depe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_depe ON dependencia USING btree (depe_codi);


--
-- Name: pk_dpto_muni; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX pk_dpto_muni ON dependencia USING btree (depe_codi, muni_codi);


--
-- Name: pk_encuesta; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_encuesta ON encuesta USING btree (usua_doc);


--
-- Name: pk_estanulacion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_estanulacion ON sgd_eanu_estanulacion USING btree (sgd_eanu_codi);


--
-- Name: pk_medio_recepcion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_medio_recepcion ON medio_recepcion USING btree (mrec_codi);


--
-- Name: pk_municipio; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_municipio ON municipio USING btree (muni_codi, dpto_codi);


--
-- Name: pk_par_serv_servicios; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_par_serv_servicios ON par_serv_servicios USING btree (par_serv_secue);


--
-- Name: pk_peranualdos; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_peranualdos ON sgd_panu_peranulados USING btree (sgd_panu_codi);


--
-- Name: pk_pl_tipo_plt; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_pl_tipo_plt ON pl_tipo_plt USING btree (plt_codi);


--
-- Name: pk_plantilla_pl; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_plantilla_pl ON plantilla_pl USING btree (pl_codi);


--
-- Name: pk_prestamo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_prestamo ON prestamo USING btree (pres_id);


--
-- Name: pk_rad_carp_per; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_rad_carp_per ON borrar_carpeta_personalizada USING btree (carp_per_codi);


--
-- Name: pk_seri; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_seri ON series USING btree (depe_codi, seri_tipo, seri_ano);


--
-- Name: pk_sgd_acm_acusemsg; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_acm_acusemsg ON sgd_acm_acusemsg USING btree (sgd_msg_codi, usua_doc);


--
-- Name: pk_sgd_anar_anexarg; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_anar_anexarg ON sgd_anar_anexarg USING btree (sgd_anar_codi);


--
-- Name: pk_sgd_aper_adminperfiles; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_aper_adminperfiles ON sgd_aper_adminperfiles USING btree (sgd_aper_codigo);


--
-- Name: pk_sgd_apli_aplintegra; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_apli_aplintegra ON sgd_apli_aplintegra USING btree (sgd_apli_codi);


--
-- Name: pk_sgd_aplus_plicusua; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_aplus_plicusua ON sgd_aplus_plicusua USING btree (sgd_aplus_codi);


--
-- Name: pk_sgd_argd_argdoc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_argd_argdoc ON sgd_argd_argdoc USING btree (sgd_argd_codi);


--
-- Name: pk_sgd_argup_argudoctop; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_argup_argudoctop ON sgd_argup_argudoctop USING btree (sgd_argup_codi);


--
-- Name: pk_sgd_camexp_campoexpediente; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_camexp_campoexpediente ON sgd_camexp_campoexpediente USING btree (sgd_camexp_codigo);


--
-- Name: pk_sgd_cau_causal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_cau_causal ON sgd_cau_causal USING btree (sgd_cau_codigo);


--
-- Name: pk_sgd_caux_causales; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_caux_causales ON sgd_caux_causales USING btree (sgd_caux_codigo);


--
-- Name: pk_sgd_cob_campobliga; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_cob_campobliga ON sgd_cob_campobliga USING btree (sgd_cob_codi);


--
-- Name: pk_sgd_dcau_causal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_dcau_causal ON sgd_dcau_causal USING btree (sgd_dcau_codigo);


--
-- Name: pk_sgd_ddca_ddsgrgdo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_ddca_ddsgrgdo ON sgd_ddca_ddsgrgdo USING btree (sgd_ddca_codigo);


--
-- Name: pk_sgd_deve; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_deve ON sgd_deve_dev_envio USING btree (sgd_deve_codigo);


--
-- Name: pk_sgd_dir; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_dir ON sgd_dir_drecciones USING btree (sgd_dir_codigo);


--
-- Name: pk_sgd_dnufe_docnufe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_dnufe_docnufe ON sgd_dnufe_docnufe USING btree (sgd_dnufe_codi);


--
-- Name: pk_sgd_ent; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_ent ON sgd_ent_entidades USING btree (sgd_ent_nit, sgd_ent_codsuc);


--
-- Name: pk_sgd_fenv; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_fenv ON sgd_fenv_frmenvio USING btree (sgd_fenv_codigo);


--
-- Name: pk_sgd_fexp_descrip; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_fexp_descrip ON sgd_fexp_flujoexpedientes USING btree (sgd_fexp_codigo);


--
-- Name: pk_sgd_firrad_firmarads; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_firrad_firmarads ON sgd_firrad_firmarads USING btree (sgd_firrad_id);


--
-- Name: pk_sgd_fun_funciones; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_fun_funciones ON sgd_fun_funciones USING btree (sgd_fun_codigo);


--
-- Name: pk_sgd_hmtd_hismatdoc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_hmtd_hismatdoc ON sgd_hmtd_hismatdoc USING btree (sgd_hmtd_codigo);


--
-- Name: pk_sgd_mat_matriz; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_mat_matriz ON sgd_mat_matriz USING btree (sgd_mat_codigo);


--
-- Name: pk_sgd_mpes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_mpes ON sgd_mpes_mddpeso USING btree (sgd_mpes_codigo);


--
-- Name: pk_sgd_mrd_matrird; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_mrd_matrird ON sgd_mrd_matrird USING btree (sgd_mrd_codigo);


--
-- Name: pk_sgd_msdep_msgdep; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_msdep_msgdep ON sgd_msdep_msgdep USING btree (sgd_msdep_codi);


--
-- Name: pk_sgd_msg_mensaje; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_msg_mensaje ON sgd_msg_mensaje USING btree (sgd_msg_codi);


--
-- Name: pk_sgd_mtd_matriz_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_mtd_matriz_doc ON sgd_mtd_matriz_doc USING btree (sgd_mtd_codigo);


--
-- Name: pk_sgd_not; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_not ON sgd_not_notificacion USING btree (sgd_not_codi);


--
-- Name: pk_sgd_oem_oempresas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_oem_oempresas ON sgd_oem_oempresas USING btree (sgd_oem_codigo);


--
-- Name: pk_sgd_parexp_paramexpediente; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_parexp_paramexpediente ON sgd_parexp_paramexpediente USING btree (sgd_parexp_codigo);


--
-- Name: pk_sgd_pexp_procexpedientes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_pexp_procexpedientes ON sgd_pexp_procexpedientes USING btree (sgd_pexp_codigo);


--
-- Name: pk_sgd_pnufe_procnumfe; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_pnufe_procnumfe ON sgd_pnufe_procnumfe USING btree (sgd_pnufe_codi);


--
-- Name: pk_sgd_pnun_procenum; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_pnun_procenum ON sgd_pnun_procenum USING btree (sgd_pnun_codi);


--
-- Name: pk_sgd_prc_proceso; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_prc_proceso ON sgd_prc_proceso USING btree (sgd_prc_codigo);


--
-- Name: pk_sgd_prd_prcdmentos; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_prd_prcdmentos ON sgd_prd_prcdmentos USING btree (sgd_prd_codigo);


--
-- Name: pk_sgd_rmr_radmasivre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_rmr_radmasivre ON sgd_rmr_radmasivre USING btree (sgd_rmr_grupo, sgd_rmr_radi);


--
-- Name: pk_sgd_san_sancionados; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_san_sancionados ON sgd_san_sancionados USING btree (sgd_san_ref);


--
-- Name: pk_sgd_sexp_secexpedientes; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_sexp_secexpedientes ON sgd_sexp_secexpedientes USING btree (sgd_exp_numero);


--
-- Name: pk_sgd_srd_seriesrd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_srd_seriesrd ON sgd_srd_seriesrd USING btree (sgd_srd_codigo);


--
-- Name: pk_sgd_tdec_tipodecision; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_tdec_tipodecision ON sgd_tdec_tipodecision USING btree (sgd_tdec_codigo);


--
-- Name: pk_sgd_tid_tipdecision; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_tid_tipdecision ON sgd_tid_tipdecision USING btree (sgd_tid_codi);


--
-- Name: pk_sgd_tma_temas; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_tma_temas ON sgd_tma_temas USING btree (sgd_tma_codigo);


--
-- Name: pk_sgd_tme_tipmen; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_tme_tipmen ON sgd_tme_tipmen USING btree (sgd_tme_codi);


--
-- Name: pk_sgd_tpr_tpdcumento; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_tpr_tpdcumento ON sgd_tpr_tpdcumento USING btree (sgd_tpr_codigo);


--
-- Name: pk_sgd_ttr_transaccion; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_sgd_ttr_transaccion ON sgd_ttr_transaccion USING btree (sgd_ttr_codigo);


--
-- Name: pk_tdm_tidomasiva; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX pk_tdm_tidomasiva ON sgd_tidm_tidocmasiva USING btree (sgd_tidm_codi);


--
-- Name: r_index; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX r_index ON aux_01 USING btree (r);


--
-- Name: radi_nume_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radi_nume_radi ON hist_eventos USING btree (radi_nume_radi);


--
-- Name: radicado_archivo; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX radicado_archivo ON sgd_archivo_central USING btree (sgd_archivo_rad);


--
-- Name: radicado_dependencia; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radicado_dependencia ON radicado USING btree (radi_cuentai, radi_usua_actu, carp_codi);


--
-- Name: radicado_idx_001; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX radicado_idx_001 ON radicado USING btree (radi_nume_radi, tdoc_codi, radi_usua_actu, radi_depe_actu, codi_nivel, radi_fech_radi);


--
-- Name: radicado_idx_003; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radicado_idx_003 ON radicado USING btree (radi_depe_radi, radi_nume_radi, sgd_eanu_codigo);


--
-- Name: radicado_informados; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radicado_informados ON informados USING btree (radi_nume_radi);


--
-- Name: radicado_orden; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX radicado_orden ON radicado USING btree (radi_fech_asig, radi_fech_radi, radi_usua_actu, radi_depe_actu, carp_codi);


--
-- Name: radicado_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX radicado_pk ON radicado USING btree (radi_nume_radi);


--
-- Name: sgd_archivo_central_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sgd_archivo_central_pk ON sgd_archivo_central USING btree (sgd_archivo_id);


--
-- Name: sgd_archivo_rad; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_archivo_rad ON sgd_archivo_hist USING btree (sgd_archivo_rad);


--
-- Name: sgd_bodega_; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_ ON bodega_empresas USING btree (nuir);


--
-- Name: sgd_bodega_are_esp_secue; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_are_esp_secue ON bodega_empresas USING btree (are_esp_secue);


--
-- Name: sgd_bodega_nit; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_nit ON bodega_empresas USING btree (nit_de_la_empresa);


--
-- Name: sgd_bodega_nombre; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_nombre ON bodega_empresas USING btree (nombre_de_la_empresa);


--
-- Name: sgd_bodega_rep_legal; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_rep_legal ON bodega_empresas USING btree (nombre_rep_legal);


--
-- Name: sgd_bodega_sigla; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_bodega_sigla ON bodega_empresas USING btree (sigla_de_la_empresa);


--
-- Name: sgd_busq_nit; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_busq_nit ON sgd_oem_oempresas USING btree (sgd_oem_nit);


--
-- Name: sgd_dir_drecciones_idx_001; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_dir_drecciones_idx_001 ON sgd_dir_drecciones USING btree (sgd_dir_tipo, radi_nume_radi, sgd_esp_codi);


--
-- Name: sgd_expediente_depe_usua; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_expediente_depe_usua ON sgd_exp_expediente USING btree (usua_codi, depe_codi);


--
-- Name: sgd_expediente_fecha; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_expediente_fecha ON sgd_exp_expediente USING btree (sgd_exp_fech);


--
-- Name: sgd_expediente_nume_radi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_expediente_nume_radi ON sgd_exp_expediente USING btree (sgd_exp_numero, radi_nume_radi);


--
-- Name: sgd_expediente_usua_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_expediente_usua_doc ON sgd_exp_expediente USING btree (usua_doc);


--
-- Name: sgd_fars_faristas_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sgd_fars_faristas_pk ON sgd_fars_faristas USING btree (sgd_fars_codigo);


--
-- Name: sgd_parametro_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sgd_parametro_pk ON sgd_parametro USING btree (param_nomb, param_codi);


--
-- Name: sgd_tdec_tipodecision_inx1; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sgd_tdec_tipodecision_inx1 ON sgd_tdec_tipodecision USING btree (sgd_tdec_showmenu);


--
-- Name: sgd_trad_tiporad_codigo_inx2; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX sgd_trad_tiporad_codigo_inx2 ON sgd_trad_tiporad USING btree (sgd_trad_codigo);


--
-- Name: sqg_busq_empresa; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX sqg_busq_empresa ON sgd_oem_oempresas USING btree (sgd_oem_oempresa, sgd_oem_sigla);


--
-- Name: tipo_doc_identificacion_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_doc_identificacion_pk ON tipo_doc_identificacion USING btree (tdid_codi);


--
-- Name: tipo_remitente_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX tipo_remitente_pk ON tipo_remitente USING btree (trte_codi);


--
-- Name: uk_sgd_mat; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uk_sgd_mat ON sgd_mat_matriz USING btree (depe_codi, sgd_fun_codigo, sgd_prc_codigo, sgd_prd_codigo);


--
-- Name: uk_sgd_mrd_matrird; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uk_sgd_mrd_matrird ON sgd_mrd_matrird USING btree (depe_codi, sgd_srd_codigo, sgd_sbrd_codigo, sgd_tpr_codigo);


--
-- Name: uk_sgd_rdf_retdocf; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uk_sgd_rdf_retdocf ON sgd_rdf_retdocf USING btree (radi_nume_radi, depe_codi, sgd_mrd_codigo);


--
-- Name: uk_sgd_sbrd_subserierd; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uk_sgd_sbrd_subserierd ON sgd_sbrd_subserierd USING btree (sgd_srd_codigo, sgd_sbrd_codigo);


--
-- Name: uk_sgd_srd_descrip; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX uk_sgd_srd_descrip ON sgd_srd_seriesrd USING btree (sgd_srd_descrip);


--
-- Name: usua_doc; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX usua_doc ON usuario USING btree (usua_doc);


--
-- Name: usuario_depe_codi; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX usuario_depe_codi ON usuario USING btree (depe_codi);


--
-- Name: usuario_pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usuario_pk ON usuario USING btree (usua_login);


--
-- Name: usuario_uk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE UNIQUE INDEX usuario_uk ON usuario USING btree (usua_codi, depe_codi);


--
-- Name: fk_municipi_ref_128_departam; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY municipio
    ADD CONSTRAINT fk_municipi_ref_128_departam FOREIGN KEY (dpto_codi) REFERENCES departamento(dpto_codi);


--
-- Name: sgd_carp_descripcion_fk2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY sgd_carp_descripcion
    ADD CONSTRAINT sgd_carp_descripcion_fk2 FOREIGN KEY (sgd_carp_tiporad) REFERENCES sgd_trad_tiporad(sgd_trad_codigo) ON DELETE RESTRICT;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- Name: concat(text, text); Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON FUNCTION concat(text, text) FROM PUBLIC;
REVOKE ALL ON FUNCTION concat(text, text) FROM postgres;
GRANT ALL ON FUNCTION concat(text, text) TO postgres;
GRANT ALL ON FUNCTION concat(text, text) TO PUBLIC;


--
-- Name: usuario; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE usuario FROM PUBLIC;
REVOKE ALL ON TABLE usuario FROM postgres;
GRANT ALL ON TABLE usuario TO postgres;
GRANT ALL ON TABLE usuario TO PUBLIC;


--
-- Name: anexos; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE anexos FROM PUBLIC;
REVOKE ALL ON TABLE anexos FROM postgres;
GRANT ALL ON TABLE anexos TO postgres;
GRANT ALL ON TABLE anexos TO PUBLIC;


--
-- Name: anexos_historico; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE anexos_historico FROM PUBLIC;
REVOKE ALL ON TABLE anexos_historico FROM postgres;
GRANT ALL ON TABLE anexos_historico TO postgres;
GRANT ALL ON TABLE anexos_historico TO PUBLIC;


--
-- Name: anexos_tipo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE anexos_tipo FROM PUBLIC;
REVOKE ALL ON TABLE anexos_tipo FROM postgres;
GRANT ALL ON TABLE anexos_tipo TO postgres;
GRANT ALL ON TABLE anexos_tipo TO PUBLIC;


--
-- Name: aux_01; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE aux_01 FROM PUBLIC;
REVOKE ALL ON TABLE aux_01 FROM postgres;
GRANT ALL ON TABLE aux_01 TO postgres;
GRANT ALL ON TABLE aux_01 TO PUBLIC;


--
-- Name: bodega_empresas; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE bodega_empresas FROM PUBLIC;
REVOKE ALL ON TABLE bodega_empresas FROM postgres;
GRANT ALL ON TABLE bodega_empresas TO postgres;
GRANT ALL ON TABLE bodega_empresas TO PUBLIC;


--
-- Name: bodega_empresas_old; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE bodega_empresas_old FROM PUBLIC;
REVOKE ALL ON TABLE bodega_empresas_old FROM postgres;
GRANT ALL ON TABLE bodega_empresas_old TO postgres;
GRANT ALL ON TABLE bodega_empresas_old TO PUBLIC;


--
-- Name: borrar_carpeta_personalizada; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE borrar_carpeta_personalizada FROM PUBLIC;
REVOKE ALL ON TABLE borrar_carpeta_personalizada FROM postgres;
GRANT ALL ON TABLE borrar_carpeta_personalizada TO postgres;
GRANT ALL ON TABLE borrar_carpeta_personalizada TO PUBLIC;


--
-- Name: borrar_empresa_esp; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE borrar_empresa_esp FROM PUBLIC;
REVOKE ALL ON TABLE borrar_empresa_esp FROM postgres;
GRANT ALL ON TABLE borrar_empresa_esp TO postgres;
GRANT ALL ON TABLE borrar_empresa_esp TO PUBLIC;


--
-- Name: carpeta; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE carpeta FROM PUBLIC;
REVOKE ALL ON TABLE carpeta FROM postgres;
GRANT ALL ON TABLE carpeta TO postgres;
GRANT ALL ON TABLE carpeta TO PUBLIC;


--
-- Name: carpeta_per; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE carpeta_per FROM PUBLIC;
REVOKE ALL ON TABLE carpeta_per FROM postgres;
GRANT ALL ON TABLE carpeta_per TO postgres;
GRANT ALL ON TABLE carpeta_per TO PUBLIC;


--
-- Name: centro_poblado; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE centro_poblado FROM PUBLIC;
REVOKE ALL ON TABLE centro_poblado FROM postgres;
GRANT ALL ON TABLE centro_poblado TO postgres;
GRANT ALL ON TABLE centro_poblado TO PUBLIC;


--
-- Name: departamento; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE departamento FROM PUBLIC;
REVOKE ALL ON TABLE departamento FROM postgres;
GRANT ALL ON TABLE departamento TO postgres;
GRANT ALL ON TABLE departamento TO PUBLIC;


--
-- Name: dependencia; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE dependencia FROM PUBLIC;
REVOKE ALL ON TABLE dependencia FROM postgres;
GRANT ALL ON TABLE dependencia TO postgres;
GRANT ALL ON TABLE dependencia TO PUBLIC;


--
-- Name: dependencia_visibilidad; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE dependencia_visibilidad FROM PUBLIC;
REVOKE ALL ON TABLE dependencia_visibilidad FROM postgres;
GRANT ALL ON TABLE dependencia_visibilidad TO postgres;
GRANT ALL ON TABLE dependencia_visibilidad TO PUBLIC;


--
-- Name: dup_eliminar; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE dup_eliminar FROM PUBLIC;
REVOKE ALL ON TABLE dup_eliminar FROM postgres;
GRANT ALL ON TABLE dup_eliminar TO postgres;
GRANT ALL ON TABLE dup_eliminar TO PUBLIC;


--
-- Name: emp_cod_actualizar; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE emp_cod_actualizar FROM PUBLIC;
REVOKE ALL ON TABLE emp_cod_actualizar FROM postgres;
GRANT ALL ON TABLE emp_cod_actualizar TO postgres;
GRANT ALL ON TABLE emp_cod_actualizar TO PUBLIC;


--
-- Name: empresas_temporal; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE empresas_temporal FROM PUBLIC;
REVOKE ALL ON TABLE empresas_temporal FROM postgres;
GRANT ALL ON TABLE empresas_temporal TO postgres;
GRANT ALL ON TABLE empresas_temporal TO PUBLIC;


--
-- Name: encuesta; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE encuesta FROM PUBLIC;
REVOKE ALL ON TABLE encuesta FROM postgres;
GRANT ALL ON TABLE encuesta TO postgres;
GRANT ALL ON TABLE encuesta TO PUBLIC;


--
-- Name: estado; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE estado FROM PUBLIC;
REVOKE ALL ON TABLE estado FROM postgres;
GRANT ALL ON TABLE estado TO postgres;
GRANT ALL ON TABLE estado TO PUBLIC;


--
-- Name: example; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE example FROM PUBLIC;
REVOKE ALL ON TABLE example FROM postgres;
GRANT ALL ON TABLE example TO postgres;
GRANT ALL ON TABLE example TO PUBLIC;


--
-- Name: fun_funcionario; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE fun_funcionario FROM PUBLIC;
REVOKE ALL ON TABLE fun_funcionario FROM postgres;
GRANT ALL ON TABLE fun_funcionario TO postgres;
GRANT ALL ON TABLE fun_funcionario TO PUBLIC;


--
-- Name: fun_funcionario_2; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE fun_funcionario_2 FROM PUBLIC;
REVOKE ALL ON TABLE fun_funcionario_2 FROM postgres;
GRANT ALL ON TABLE fun_funcionario_2 TO postgres;
GRANT ALL ON TABLE fun_funcionario_2 TO PUBLIC;


--
-- Name: hist_eventos; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE hist_eventos FROM PUBLIC;
REVOKE ALL ON TABLE hist_eventos FROM postgres;
GRANT ALL ON TABLE hist_eventos TO postgres;
GRANT ALL ON TABLE hist_eventos TO PUBLIC;


--
-- Name: informados; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE informados FROM PUBLIC;
REVOKE ALL ON TABLE informados FROM postgres;
GRANT ALL ON TABLE informados TO postgres;
GRANT ALL ON TABLE informados TO PUBLIC;


--
-- Name: medio_recepcion; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE medio_recepcion FROM PUBLIC;
REVOKE ALL ON TABLE medio_recepcion FROM postgres;
GRANT ALL ON TABLE medio_recepcion TO postgres;
GRANT ALL ON TABLE medio_recepcion TO PUBLIC;


--
-- Name: municipio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE municipio FROM PUBLIC;
REVOKE ALL ON TABLE municipio FROM postgres;
GRANT ALL ON TABLE municipio TO postgres;
GRANT ALL ON TABLE municipio TO PUBLIC;


--
-- Name: ortega_prueba_orfeo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE ortega_prueba_orfeo FROM PUBLIC;
REVOKE ALL ON TABLE ortega_prueba_orfeo FROM postgres;
GRANT ALL ON TABLE ortega_prueba_orfeo TO postgres;
GRANT ALL ON TABLE ortega_prueba_orfeo TO PUBLIC;


--
-- Name: p_sgd_oem_oempresas; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE p_sgd_oem_oempresas FROM PUBLIC;
REVOKE ALL ON TABLE p_sgd_oem_oempresas FROM postgres;
GRANT ALL ON TABLE p_sgd_oem_oempresas TO postgres;
GRANT ALL ON TABLE p_sgd_oem_oempresas TO PUBLIC;


--
-- Name: par_serv_servicios; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE par_serv_servicios FROM PUBLIC;
REVOKE ALL ON TABLE par_serv_servicios FROM postgres;
GRANT ALL ON TABLE par_serv_servicios TO postgres;
GRANT ALL ON TABLE par_serv_servicios TO PUBLIC;


--
-- Name: pl_generado_plg; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE pl_generado_plg FROM PUBLIC;
REVOKE ALL ON TABLE pl_generado_plg FROM postgres;
GRANT ALL ON TABLE pl_generado_plg TO postgres;
GRANT ALL ON TABLE pl_generado_plg TO PUBLIC;


--
-- Name: pl_tipo_plt; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE pl_tipo_plt FROM PUBLIC;
REVOKE ALL ON TABLE pl_tipo_plt FROM postgres;
GRANT ALL ON TABLE pl_tipo_plt TO postgres;
GRANT ALL ON TABLE pl_tipo_plt TO PUBLIC;


--
-- Name: plan_table; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE plan_table FROM PUBLIC;
REVOKE ALL ON TABLE plan_table FROM postgres;
GRANT ALL ON TABLE plan_table TO postgres;
GRANT ALL ON TABLE plan_table TO PUBLIC;


--
-- Name: plantilla_pl; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE plantilla_pl FROM PUBLIC;
REVOKE ALL ON TABLE plantilla_pl FROM postgres;
GRANT ALL ON TABLE plantilla_pl TO postgres;
GRANT ALL ON TABLE plantilla_pl TO PUBLIC;


--
-- Name: plsql_profiler_data; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE plsql_profiler_data FROM PUBLIC;
REVOKE ALL ON TABLE plsql_profiler_data FROM postgres;
GRANT ALL ON TABLE plsql_profiler_data TO postgres;
GRANT ALL ON TABLE plsql_profiler_data TO PUBLIC;


--
-- Name: plsql_profiler_runs; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE plsql_profiler_runs FROM PUBLIC;
REVOKE ALL ON TABLE plsql_profiler_runs FROM postgres;
GRANT ALL ON TABLE plsql_profiler_runs TO postgres;
GRANT ALL ON TABLE plsql_profiler_runs TO PUBLIC;


--
-- Name: plsql_profiler_units; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE plsql_profiler_units FROM PUBLIC;
REVOKE ALL ON TABLE plsql_profiler_units FROM postgres;
GRANT ALL ON TABLE plsql_profiler_units TO postgres;
GRANT ALL ON TABLE plsql_profiler_units TO PUBLIC;


--
-- Name: prestamo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE prestamo FROM PUBLIC;
REVOKE ALL ON TABLE prestamo FROM postgres;
GRANT ALL ON TABLE prestamo TO postgres;
GRANT ALL ON TABLE prestamo TO PUBLIC;


--
-- Name: pruba; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE pruba FROM PUBLIC;
REVOKE ALL ON TABLE pruba FROM postgres;
GRANT ALL ON TABLE pruba TO postgres;
GRANT ALL ON TABLE pruba TO PUBLIC;


--
-- Name: radicado; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE radicado FROM PUBLIC;
REVOKE ALL ON TABLE radicado FROM postgres;
GRANT ALL ON TABLE radicado TO postgres;
GRANT ALL ON TABLE radicado TO PUBLIC;


--
-- Name: rad1000; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE rad1000 FROM PUBLIC;
REVOKE ALL ON TABLE rad1000 FROM postgres;
GRANT ALL ON TABLE rad1000 TO postgres;
GRANT ALL ON TABLE rad1000 TO PUBLIC;


--
-- Name: retencion_doc_tmp; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE retencion_doc_tmp FROM PUBLIC;
REVOKE ALL ON TABLE retencion_doc_tmp FROM postgres;
GRANT ALL ON TABLE retencion_doc_tmp TO postgres;
GRANT ALL ON TABLE retencion_doc_tmp TO PUBLIC;


--
-- Name: series; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE series FROM PUBLIC;
REVOKE ALL ON TABLE series FROM postgres;
GRANT ALL ON TABLE series TO postgres;
GRANT ALL ON TABLE series TO PUBLIC;


--
-- Name: sgd_acm_acusemsg; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_acm_acusemsg FROM PUBLIC;
REVOKE ALL ON TABLE sgd_acm_acusemsg FROM postgres;
GRANT ALL ON TABLE sgd_acm_acusemsg TO postgres;
GRANT ALL ON TABLE sgd_acm_acusemsg TO PUBLIC;


--
-- Name: sgd_actadd_actualiadicional; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_actadd_actualiadicional FROM PUBLIC;
REVOKE ALL ON TABLE sgd_actadd_actualiadicional FROM postgres;
GRANT ALL ON TABLE sgd_actadd_actualiadicional TO postgres;
GRANT ALL ON TABLE sgd_actadd_actualiadicional TO PUBLIC;


--
-- Name: sgd_agen_agendados; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_agen_agendados FROM PUBLIC;
REVOKE ALL ON TABLE sgd_agen_agendados FROM postgres;
GRANT ALL ON TABLE sgd_agen_agendados TO postgres;
GRANT ALL ON TABLE sgd_agen_agendados TO PUBLIC;


--
-- Name: sgd_anar_anexarg; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_anar_anexarg FROM PUBLIC;
REVOKE ALL ON TABLE sgd_anar_anexarg FROM postgres;
GRANT ALL ON TABLE sgd_anar_anexarg TO postgres;
GRANT ALL ON TABLE sgd_anar_anexarg TO PUBLIC;


--
-- Name: sgd_anu_anulados; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_anu_anulados FROM PUBLIC;
REVOKE ALL ON TABLE sgd_anu_anulados FROM postgres;
GRANT ALL ON TABLE sgd_anu_anulados TO postgres;
GRANT ALL ON TABLE sgd_anu_anulados TO PUBLIC;


--
-- Name: sgd_aper_adminperfiles; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_aper_adminperfiles FROM PUBLIC;
REVOKE ALL ON TABLE sgd_aper_adminperfiles FROM postgres;
GRANT ALL ON TABLE sgd_aper_adminperfiles TO postgres;
GRANT ALL ON TABLE sgd_aper_adminperfiles TO PUBLIC;


--
-- Name: sgd_aplfad_plicfunadi; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_aplfad_plicfunadi FROM PUBLIC;
REVOKE ALL ON TABLE sgd_aplfad_plicfunadi FROM postgres;
GRANT ALL ON TABLE sgd_aplfad_plicfunadi TO postgres;
GRANT ALL ON TABLE sgd_aplfad_plicfunadi TO PUBLIC;


--
-- Name: sgd_apli_aplintegra; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_apli_aplintegra FROM PUBLIC;
REVOKE ALL ON TABLE sgd_apli_aplintegra FROM postgres;
GRANT ALL ON TABLE sgd_apli_aplintegra TO postgres;
GRANT ALL ON TABLE sgd_apli_aplintegra TO PUBLIC;


--
-- Name: sgd_aplmen_aplimens; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_aplmen_aplimens FROM PUBLIC;
REVOKE ALL ON TABLE sgd_aplmen_aplimens FROM postgres;
GRANT ALL ON TABLE sgd_aplmen_aplimens TO postgres;
GRANT ALL ON TABLE sgd_aplmen_aplimens TO PUBLIC;


--
-- Name: sgd_aplus_plicusua; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_aplus_plicusua FROM PUBLIC;
REVOKE ALL ON TABLE sgd_aplus_plicusua FROM postgres;
GRANT ALL ON TABLE sgd_aplus_plicusua TO postgres;
GRANT ALL ON TABLE sgd_aplus_plicusua TO PUBLIC;


--
-- Name: sgd_archivo_central; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_archivo_central FROM PUBLIC;
REVOKE ALL ON TABLE sgd_archivo_central FROM postgres;
GRANT ALL ON TABLE sgd_archivo_central TO postgres;
GRANT ALL ON TABLE sgd_archivo_central TO PUBLIC;


--
-- Name: sgd_archivo_hist; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_archivo_hist FROM PUBLIC;
REVOKE ALL ON TABLE sgd_archivo_hist FROM postgres;
GRANT ALL ON TABLE sgd_archivo_hist TO postgres;
GRANT ALL ON TABLE sgd_archivo_hist TO PUBLIC;


--
-- Name: sgd_arg_pliego; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_arg_pliego FROM PUBLIC;
REVOKE ALL ON TABLE sgd_arg_pliego FROM postgres;
GRANT ALL ON TABLE sgd_arg_pliego TO postgres;
GRANT ALL ON TABLE sgd_arg_pliego TO PUBLIC;


--
-- Name: sgd_argd_argdoc; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_argd_argdoc FROM PUBLIC;
REVOKE ALL ON TABLE sgd_argd_argdoc FROM postgres;
GRANT ALL ON TABLE sgd_argd_argdoc TO postgres;
GRANT ALL ON TABLE sgd_argd_argdoc TO PUBLIC;


--
-- Name: sgd_argup_argudoctop; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_argup_argudoctop FROM PUBLIC;
REVOKE ALL ON TABLE sgd_argup_argudoctop FROM postgres;
GRANT ALL ON TABLE sgd_argup_argudoctop TO postgres;
GRANT ALL ON TABLE sgd_argup_argudoctop TO PUBLIC;


--
-- Name: sgd_camexp_campoexpediente; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_camexp_campoexpediente FROM PUBLIC;
REVOKE ALL ON TABLE sgd_camexp_campoexpediente FROM postgres;
GRANT ALL ON TABLE sgd_camexp_campoexpediente TO postgres;
GRANT ALL ON TABLE sgd_camexp_campoexpediente TO PUBLIC;


--
-- Name: sgd_carp_descripcion; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_carp_descripcion FROM PUBLIC;
REVOKE ALL ON TABLE sgd_carp_descripcion FROM postgres;
GRANT ALL ON TABLE sgd_carp_descripcion TO postgres;
GRANT ALL ON TABLE sgd_carp_descripcion TO PUBLIC;


--
-- Name: sgd_cau_causal; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_cau_causal FROM PUBLIC;
REVOKE ALL ON TABLE sgd_cau_causal FROM postgres;
GRANT ALL ON TABLE sgd_cau_causal TO postgres;
GRANT ALL ON TABLE sgd_cau_causal TO PUBLIC;


--
-- Name: sgd_caux_causales; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_caux_causales FROM PUBLIC;
REVOKE ALL ON TABLE sgd_caux_causales FROM postgres;
GRANT ALL ON TABLE sgd_caux_causales TO postgres;
GRANT ALL ON TABLE sgd_caux_causales TO PUBLIC;


--
-- Name: sgd_clta_clstarif; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_clta_clstarif FROM PUBLIC;
REVOKE ALL ON TABLE sgd_clta_clstarif FROM postgres;
GRANT ALL ON TABLE sgd_clta_clstarif TO postgres;
GRANT ALL ON TABLE sgd_clta_clstarif TO PUBLIC;


--
-- Name: sgd_cob_campobliga; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_cob_campobliga FROM PUBLIC;
REVOKE ALL ON TABLE sgd_cob_campobliga FROM postgres;
GRANT ALL ON TABLE sgd_cob_campobliga TO postgres;
GRANT ALL ON TABLE sgd_cob_campobliga TO PUBLIC;


--
-- Name: sgd_dcau_causal; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_dcau_causal FROM PUBLIC;
REVOKE ALL ON TABLE sgd_dcau_causal FROM postgres;
GRANT ALL ON TABLE sgd_dcau_causal TO postgres;
GRANT ALL ON TABLE sgd_dcau_causal TO PUBLIC;


--
-- Name: sgd_ddca_ddsgrgdo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_ddca_ddsgrgdo FROM PUBLIC;
REVOKE ALL ON TABLE sgd_ddca_ddsgrgdo FROM postgres;
GRANT ALL ON TABLE sgd_ddca_ddsgrgdo TO postgres;
GRANT ALL ON TABLE sgd_ddca_ddsgrgdo TO PUBLIC;


--
-- Name: sgd_def_contactos; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_def_contactos FROM PUBLIC;
REVOKE ALL ON TABLE sgd_def_contactos FROM postgres;
GRANT ALL ON TABLE sgd_def_contactos TO postgres;
GRANT ALL ON TABLE sgd_def_contactos TO PUBLIC;


--
-- Name: sgd_def_continentes; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_def_continentes FROM PUBLIC;
REVOKE ALL ON TABLE sgd_def_continentes FROM postgres;
GRANT ALL ON TABLE sgd_def_continentes TO postgres;
GRANT ALL ON TABLE sgd_def_continentes TO PUBLIC;


--
-- Name: sgd_def_paises; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_def_paises FROM PUBLIC;
REVOKE ALL ON TABLE sgd_def_paises FROM postgres;
GRANT ALL ON TABLE sgd_def_paises TO postgres;
GRANT ALL ON TABLE sgd_def_paises TO PUBLIC;


--
-- Name: sgd_deve_dev_envio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_deve_dev_envio FROM PUBLIC;
REVOKE ALL ON TABLE sgd_deve_dev_envio FROM postgres;
GRANT ALL ON TABLE sgd_deve_dev_envio TO postgres;
GRANT ALL ON TABLE sgd_deve_dev_envio TO PUBLIC;


--
-- Name: sgd_dir_drecciones; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_dir_drecciones FROM PUBLIC;
REVOKE ALL ON TABLE sgd_dir_drecciones FROM postgres;
GRANT ALL ON TABLE sgd_dir_drecciones TO postgres;
GRANT ALL ON TABLE sgd_dir_drecciones TO PUBLIC;


--
-- Name: sgd_dnufe_docnufe; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_dnufe_docnufe FROM PUBLIC;
REVOKE ALL ON TABLE sgd_dnufe_docnufe FROM postgres;
GRANT ALL ON TABLE sgd_dnufe_docnufe TO postgres;
GRANT ALL ON TABLE sgd_dnufe_docnufe TO PUBLIC;


--
-- Name: sgd_eanu_estanulacion; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_eanu_estanulacion FROM PUBLIC;
REVOKE ALL ON TABLE sgd_eanu_estanulacion FROM postgres;
GRANT ALL ON TABLE sgd_eanu_estanulacion TO postgres;
GRANT ALL ON TABLE sgd_eanu_estanulacion TO PUBLIC;


--
-- Name: sgd_einv_inventario; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_einv_inventario FROM PUBLIC;
REVOKE ALL ON TABLE sgd_einv_inventario FROM postgres;
GRANT ALL ON TABLE sgd_einv_inventario TO postgres;
GRANT ALL ON TABLE sgd_einv_inventario TO PUBLIC;


--
-- Name: sgd_eit_items; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_eit_items FROM PUBLIC;
REVOKE ALL ON TABLE sgd_eit_items FROM postgres;
GRANT ALL ON TABLE sgd_eit_items TO postgres;
GRANT ALL ON TABLE sgd_eit_items TO PUBLIC;


--
-- Name: sgd_ent_entidades; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_ent_entidades FROM PUBLIC;
REVOKE ALL ON TABLE sgd_ent_entidades FROM postgres;
GRANT ALL ON TABLE sgd_ent_entidades TO postgres;
GRANT ALL ON TABLE sgd_ent_entidades TO PUBLIC;


--
-- Name: sgd_enve_envioespecial; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_enve_envioespecial FROM PUBLIC;
REVOKE ALL ON TABLE sgd_enve_envioespecial FROM postgres;
GRANT ALL ON TABLE sgd_enve_envioespecial TO postgres;
GRANT ALL ON TABLE sgd_enve_envioespecial TO PUBLIC;


--
-- Name: tipo_doc_identificacion; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tipo_doc_identificacion FROM PUBLIC;
REVOKE ALL ON TABLE tipo_doc_identificacion FROM postgres;
GRANT ALL ON TABLE tipo_doc_identificacion TO postgres;
GRANT ALL ON TABLE tipo_doc_identificacion TO PUBLIC;


--
-- Name: tipo_remitente; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE tipo_remitente FROM PUBLIC;
REVOKE ALL ON TABLE tipo_remitente FROM postgres;
GRANT ALL ON TABLE tipo_remitente TO postgres;
GRANT ALL ON TABLE tipo_remitente TO PUBLIC;


--
-- Name: sgd_est_estadi; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_est_estadi FROM PUBLIC;
REVOKE ALL ON TABLE sgd_est_estadi FROM postgres;
GRANT ALL ON TABLE sgd_est_estadi TO postgres;
GRANT ALL ON TABLE sgd_est_estadi TO PUBLIC;


--
-- Name: sgd_estc_estconsolid; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_estc_estconsolid FROM PUBLIC;
REVOKE ALL ON TABLE sgd_estc_estconsolid FROM postgres;
GRANT ALL ON TABLE sgd_estc_estconsolid TO postgres;
GRANT ALL ON TABLE sgd_estc_estconsolid TO PUBLIC;


--
-- Name: sgd_estinst_estadoinstancia; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_estinst_estadoinstancia FROM PUBLIC;
REVOKE ALL ON TABLE sgd_estinst_estadoinstancia FROM postgres;
GRANT ALL ON TABLE sgd_estinst_estadoinstancia TO postgres;
GRANT ALL ON TABLE sgd_estinst_estadoinstancia TO PUBLIC;


--
-- Name: sgd_exp_expediente; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_exp_expediente FROM PUBLIC;
REVOKE ALL ON TABLE sgd_exp_expediente FROM postgres;
GRANT ALL ON TABLE sgd_exp_expediente TO postgres;
GRANT ALL ON TABLE sgd_exp_expediente TO PUBLIC;


--
-- Name: sgd_fars_faristas; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_fars_faristas FROM PUBLIC;
REVOKE ALL ON TABLE sgd_fars_faristas FROM postgres;
GRANT ALL ON TABLE sgd_fars_faristas TO postgres;
GRANT ALL ON TABLE sgd_fars_faristas TO PUBLIC;


--
-- Name: sgd_fenv_frmenvio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_fenv_frmenvio FROM PUBLIC;
REVOKE ALL ON TABLE sgd_fenv_frmenvio FROM postgres;
GRANT ALL ON TABLE sgd_fenv_frmenvio TO postgres;
GRANT ALL ON TABLE sgd_fenv_frmenvio TO PUBLIC;


--
-- Name: sgd_fexp_flujoexpedientes; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_fexp_flujoexpedientes FROM PUBLIC;
REVOKE ALL ON TABLE sgd_fexp_flujoexpedientes FROM postgres;
GRANT ALL ON TABLE sgd_fexp_flujoexpedientes TO postgres;
GRANT ALL ON TABLE sgd_fexp_flujoexpedientes TO PUBLIC;


--
-- Name: sgd_firrad_firmarads; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_firrad_firmarads FROM PUBLIC;
REVOKE ALL ON TABLE sgd_firrad_firmarads FROM postgres;
GRANT ALL ON TABLE sgd_firrad_firmarads TO postgres;
GRANT ALL ON TABLE sgd_firrad_firmarads TO PUBLIC;


--
-- Name: sgd_fld_flujodoc; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_fld_flujodoc FROM PUBLIC;
REVOKE ALL ON TABLE sgd_fld_flujodoc FROM postgres;
GRANT ALL ON TABLE sgd_fld_flujodoc TO postgres;
GRANT ALL ON TABLE sgd_fld_flujodoc TO PUBLIC;


--
-- Name: sgd_fun_funciones; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_fun_funciones FROM PUBLIC;
REVOKE ALL ON TABLE sgd_fun_funciones FROM postgres;
GRANT ALL ON TABLE sgd_fun_funciones TO postgres;
GRANT ALL ON TABLE sgd_fun_funciones TO PUBLIC;


--
-- Name: sgd_hfld_histflujodoc; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_hfld_histflujodoc FROM PUBLIC;
REVOKE ALL ON TABLE sgd_hfld_histflujodoc FROM postgres;
GRANT ALL ON TABLE sgd_hfld_histflujodoc TO postgres;
GRANT ALL ON TABLE sgd_hfld_histflujodoc TO PUBLIC;


--
-- Name: sgd_hmtd_hismatdoc; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_hmtd_hismatdoc FROM PUBLIC;
REVOKE ALL ON TABLE sgd_hmtd_hismatdoc FROM postgres;
GRANT ALL ON TABLE sgd_hmtd_hismatdoc TO postgres;
GRANT ALL ON TABLE sgd_hmtd_hismatdoc TO PUBLIC;


--
-- Name: sgd_instorf_instanciasorfeo; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_instorf_instanciasorfeo FROM PUBLIC;
REVOKE ALL ON TABLE sgd_instorf_instanciasorfeo FROM postgres;
GRANT ALL ON TABLE sgd_instorf_instanciasorfeo TO postgres;
GRANT ALL ON TABLE sgd_instorf_instanciasorfeo TO PUBLIC;


--
-- Name: sgd_lip_linkip; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_lip_linkip FROM PUBLIC;
REVOKE ALL ON TABLE sgd_lip_linkip FROM postgres;
GRANT ALL ON TABLE sgd_lip_linkip TO postgres;
GRANT ALL ON TABLE sgd_lip_linkip TO PUBLIC;


--
-- Name: sgd_mat_matriz; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_mat_matriz FROM PUBLIC;
REVOKE ALL ON TABLE sgd_mat_matriz FROM postgres;
GRANT ALL ON TABLE sgd_mat_matriz TO postgres;
GRANT ALL ON TABLE sgd_mat_matriz TO PUBLIC;


--
-- Name: sgd_mpes_mddpeso; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_mpes_mddpeso FROM PUBLIC;
REVOKE ALL ON TABLE sgd_mpes_mddpeso FROM postgres;
GRANT ALL ON TABLE sgd_mpes_mddpeso TO postgres;
GRANT ALL ON TABLE sgd_mpes_mddpeso TO PUBLIC;


--
-- Name: sgd_mrd_matrird; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_mrd_matrird FROM PUBLIC;
REVOKE ALL ON TABLE sgd_mrd_matrird FROM postgres;
GRANT ALL ON TABLE sgd_mrd_matrird TO postgres;
GRANT ALL ON TABLE sgd_mrd_matrird TO PUBLIC;


--
-- Name: sgd_msdep_msgdep; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_msdep_msgdep FROM PUBLIC;
REVOKE ALL ON TABLE sgd_msdep_msgdep FROM postgres;
GRANT ALL ON TABLE sgd_msdep_msgdep TO postgres;
GRANT ALL ON TABLE sgd_msdep_msgdep TO PUBLIC;


--
-- Name: sgd_msg_mensaje; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_msg_mensaje FROM PUBLIC;
REVOKE ALL ON TABLE sgd_msg_mensaje FROM postgres;
GRANT ALL ON TABLE sgd_msg_mensaje TO postgres;
GRANT ALL ON TABLE sgd_msg_mensaje TO PUBLIC;


--
-- Name: sgd_mtd_matriz_doc; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_mtd_matriz_doc FROM PUBLIC;
REVOKE ALL ON TABLE sgd_mtd_matriz_doc FROM postgres;
GRANT ALL ON TABLE sgd_mtd_matriz_doc TO postgres;
GRANT ALL ON TABLE sgd_mtd_matriz_doc TO PUBLIC;


--
-- Name: sgd_noh_nohabiles; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_noh_nohabiles FROM PUBLIC;
REVOKE ALL ON TABLE sgd_noh_nohabiles FROM postgres;
GRANT ALL ON TABLE sgd_noh_nohabiles TO postgres;
GRANT ALL ON TABLE sgd_noh_nohabiles TO PUBLIC;


--
-- Name: sgd_not_notificacion; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_not_notificacion FROM PUBLIC;
REVOKE ALL ON TABLE sgd_not_notificacion FROM postgres;
GRANT ALL ON TABLE sgd_not_notificacion TO postgres;
GRANT ALL ON TABLE sgd_not_notificacion TO PUBLIC;


--
-- Name: sgd_ntrd_notifrad; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_ntrd_notifrad FROM PUBLIC;
REVOKE ALL ON TABLE sgd_ntrd_notifrad FROM postgres;
GRANT ALL ON TABLE sgd_ntrd_notifrad TO postgres;
GRANT ALL ON TABLE sgd_ntrd_notifrad TO PUBLIC;


--
-- Name: sgd_oem_oempresas; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_oem_oempresas FROM PUBLIC;
REVOKE ALL ON TABLE sgd_oem_oempresas FROM postgres;
GRANT ALL ON TABLE sgd_oem_oempresas TO postgres;
GRANT ALL ON TABLE sgd_oem_oempresas TO PUBLIC;


--
-- Name: sgd_panu_peranulados; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_panu_peranulados FROM PUBLIC;
REVOKE ALL ON TABLE sgd_panu_peranulados FROM postgres;
GRANT ALL ON TABLE sgd_panu_peranulados TO postgres;
GRANT ALL ON TABLE sgd_panu_peranulados TO PUBLIC;


--
-- Name: sgd_parametro; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_parametro FROM PUBLIC;
REVOKE ALL ON TABLE sgd_parametro FROM postgres;
GRANT ALL ON TABLE sgd_parametro TO postgres;
GRANT ALL ON TABLE sgd_parametro TO PUBLIC;


--
-- Name: sgd_parexp_paramexpediente; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_parexp_paramexpediente FROM PUBLIC;
REVOKE ALL ON TABLE sgd_parexp_paramexpediente FROM postgres;
GRANT ALL ON TABLE sgd_parexp_paramexpediente TO postgres;
GRANT ALL ON TABLE sgd_parexp_paramexpediente TO PUBLIC;


--
-- Name: sgd_pexp_procexpedientes; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_pexp_procexpedientes FROM PUBLIC;
REVOKE ALL ON TABLE sgd_pexp_procexpedientes FROM postgres;
GRANT ALL ON TABLE sgd_pexp_procexpedientes TO postgres;
GRANT ALL ON TABLE sgd_pexp_procexpedientes TO PUBLIC;


--
-- Name: sgd_pnufe_procnumfe; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_pnufe_procnumfe FROM PUBLIC;
REVOKE ALL ON TABLE sgd_pnufe_procnumfe FROM postgres;
GRANT ALL ON TABLE sgd_pnufe_procnumfe TO postgres;
GRANT ALL ON TABLE sgd_pnufe_procnumfe TO PUBLIC;


--
-- Name: sgd_pnun_procenum; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_pnun_procenum FROM PUBLIC;
REVOKE ALL ON TABLE sgd_pnun_procenum FROM postgres;
GRANT ALL ON TABLE sgd_pnun_procenum TO postgres;
GRANT ALL ON TABLE sgd_pnun_procenum TO PUBLIC;


--
-- Name: sgd_prc_proceso; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_prc_proceso FROM PUBLIC;
REVOKE ALL ON TABLE sgd_prc_proceso FROM postgres;
GRANT ALL ON TABLE sgd_prc_proceso TO postgres;
GRANT ALL ON TABLE sgd_prc_proceso TO PUBLIC;


--
-- Name: sgd_prd_prcdmentos; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_prd_prcdmentos FROM PUBLIC;
REVOKE ALL ON TABLE sgd_prd_prcdmentos FROM postgres;
GRANT ALL ON TABLE sgd_prd_prcdmentos TO postgres;
GRANT ALL ON TABLE sgd_prd_prcdmentos TO PUBLIC;


--
-- Name: sgd_rda_retdoca; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_rda_retdoca FROM PUBLIC;
REVOKE ALL ON TABLE sgd_rda_retdoca FROM postgres;
GRANT ALL ON TABLE sgd_rda_retdoca TO postgres;
GRANT ALL ON TABLE sgd_rda_retdoca TO PUBLIC;


--
-- Name: sgd_rdf_retdocf; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_rdf_retdocf FROM PUBLIC;
REVOKE ALL ON TABLE sgd_rdf_retdocf FROM postgres;
GRANT ALL ON TABLE sgd_rdf_retdocf TO postgres;
GRANT ALL ON TABLE sgd_rdf_retdocf TO PUBLIC;


--
-- Name: sgd_renv_regenvio; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_renv_regenvio FROM PUBLIC;
REVOKE ALL ON TABLE sgd_renv_regenvio FROM postgres;
GRANT ALL ON TABLE sgd_renv_regenvio TO postgres;
GRANT ALL ON TABLE sgd_renv_regenvio TO PUBLIC;


--
-- Name: sgd_renv_regenvio1; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_renv_regenvio1 FROM PUBLIC;
REVOKE ALL ON TABLE sgd_renv_regenvio1 FROM postgres;
GRANT ALL ON TABLE sgd_renv_regenvio1 TO postgres;
GRANT ALL ON TABLE sgd_renv_regenvio1 TO PUBLIC;


--
-- Name: sgd_rfax_reservafax; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_rfax_reservafax FROM PUBLIC;
REVOKE ALL ON TABLE sgd_rfax_reservafax FROM postgres;
GRANT ALL ON TABLE sgd_rfax_reservafax TO postgres;
GRANT ALL ON TABLE sgd_rfax_reservafax TO PUBLIC;


--
-- Name: sgd_rmr_radmasivre; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_rmr_radmasivre FROM PUBLIC;
REVOKE ALL ON TABLE sgd_rmr_radmasivre FROM postgres;
GRANT ALL ON TABLE sgd_rmr_radmasivre TO postgres;
GRANT ALL ON TABLE sgd_rmr_radmasivre TO PUBLIC;


--
-- Name: sgd_san_sancionados; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_san_sancionados FROM PUBLIC;
REVOKE ALL ON TABLE sgd_san_sancionados FROM postgres;
GRANT ALL ON TABLE sgd_san_sancionados TO postgres;
GRANT ALL ON TABLE sgd_san_sancionados TO PUBLIC;


--
-- Name: sgd_san_sancionados_x; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_san_sancionados_x FROM PUBLIC;
REVOKE ALL ON TABLE sgd_san_sancionados_x FROM postgres;
GRANT ALL ON TABLE sgd_san_sancionados_x TO postgres;
GRANT ALL ON TABLE sgd_san_sancionados_x TO PUBLIC;


--
-- Name: sgd_sbrd_subserierd; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_sbrd_subserierd FROM PUBLIC;
REVOKE ALL ON TABLE sgd_sbrd_subserierd FROM postgres;
GRANT ALL ON TABLE sgd_sbrd_subserierd TO postgres;
GRANT ALL ON TABLE sgd_sbrd_subserierd TO PUBLIC;


--
-- Name: sgd_sed_sede; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_sed_sede FROM PUBLIC;
REVOKE ALL ON TABLE sgd_sed_sede FROM postgres;
GRANT ALL ON TABLE sgd_sed_sede TO postgres;
GRANT ALL ON TABLE sgd_sed_sede TO PUBLIC;


--
-- Name: sgd_senuf_secnumfe; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_senuf_secnumfe FROM PUBLIC;
REVOKE ALL ON TABLE sgd_senuf_secnumfe FROM postgres;
GRANT ALL ON TABLE sgd_senuf_secnumfe TO postgres;
GRANT ALL ON TABLE sgd_senuf_secnumfe TO PUBLIC;


--
-- Name: sgd_sexp_secexpedientes; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_sexp_secexpedientes FROM PUBLIC;
REVOKE ALL ON TABLE sgd_sexp_secexpedientes FROM postgres;
GRANT ALL ON TABLE sgd_sexp_secexpedientes TO postgres;
GRANT ALL ON TABLE sgd_sexp_secexpedientes TO PUBLIC;


--
-- Name: sgd_srd_seriesrd; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_srd_seriesrd FROM PUBLIC;
REVOKE ALL ON TABLE sgd_srd_seriesrd FROM postgres;
GRANT ALL ON TABLE sgd_srd_seriesrd TO postgres;
GRANT ALL ON TABLE sgd_srd_seriesrd TO PUBLIC;


--
-- Name: sgd_tar_tarifas; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tar_tarifas FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tar_tarifas FROM postgres;
GRANT ALL ON TABLE sgd_tar_tarifas TO postgres;
GRANT ALL ON TABLE sgd_tar_tarifas TO PUBLIC;


--
-- Name: sgd_tdec_tipodecision; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tdec_tipodecision FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tdec_tipodecision FROM postgres;
GRANT ALL ON TABLE sgd_tdec_tipodecision TO postgres;
GRANT ALL ON TABLE sgd_tdec_tipodecision TO PUBLIC;


--
-- Name: sgd_tid_tipdecision; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tid_tipdecision FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tid_tipdecision FROM postgres;
GRANT ALL ON TABLE sgd_tid_tipdecision TO postgres;
GRANT ALL ON TABLE sgd_tid_tipdecision TO PUBLIC;


--
-- Name: sgd_tidm_tidocmasiva; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tidm_tidocmasiva FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tidm_tidocmasiva FROM postgres;
GRANT ALL ON TABLE sgd_tidm_tidocmasiva TO postgres;
GRANT ALL ON TABLE sgd_tidm_tidocmasiva TO PUBLIC;


--
-- Name: sgd_tip3_tipotercero; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tip3_tipotercero FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tip3_tipotercero FROM postgres;
GRANT ALL ON TABLE sgd_tip3_tipotercero TO postgres;
GRANT ALL ON TABLE sgd_tip3_tipotercero TO PUBLIC;


--
-- Name: sgd_tma_temas; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tma_temas FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tma_temas FROM postgres;
GRANT ALL ON TABLE sgd_tma_temas TO postgres;
GRANT ALL ON TABLE sgd_tma_temas TO PUBLIC;


--
-- Name: sgd_tme_tipmen; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tme_tipmen FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tme_tipmen FROM postgres;
GRANT ALL ON TABLE sgd_tme_tipmen TO postgres;
GRANT ALL ON TABLE sgd_tme_tipmen TO PUBLIC;


--
-- Name: sgd_tpr_tpdcumento; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_tpr_tpdcumento FROM PUBLIC;
REVOKE ALL ON TABLE sgd_tpr_tpdcumento FROM postgres;
GRANT ALL ON TABLE sgd_tpr_tpdcumento TO postgres;
GRANT ALL ON TABLE sgd_tpr_tpdcumento TO PUBLIC;


--
-- Name: sgd_trad_tiporad; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_trad_tiporad FROM PUBLIC;
REVOKE ALL ON TABLE sgd_trad_tiporad FROM postgres;
GRANT ALL ON TABLE sgd_trad_tiporad TO postgres;
GRANT ALL ON TABLE sgd_trad_tiporad TO PUBLIC;


--
-- Name: sgd_ttr_transaccion; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_ttr_transaccion FROM PUBLIC;
REVOKE ALL ON TABLE sgd_ttr_transaccion FROM postgres;
GRANT ALL ON TABLE sgd_ttr_transaccion TO postgres;
GRANT ALL ON TABLE sgd_ttr_transaccion TO PUBLIC;


--
-- Name: sgd_ush_usuhistorico; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_ush_usuhistorico FROM PUBLIC;
REVOKE ALL ON TABLE sgd_ush_usuhistorico FROM postgres;
GRANT ALL ON TABLE sgd_ush_usuhistorico TO postgres;
GRANT ALL ON TABLE sgd_ush_usuhistorico TO PUBLIC;


--
-- Name: sgd_usm_usumodifica; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE sgd_usm_usumodifica FROM PUBLIC;
REVOKE ALL ON TABLE sgd_usm_usumodifica FROM postgres;
GRANT ALL ON TABLE sgd_usm_usumodifica TO postgres;
GRANT ALL ON TABLE sgd_usm_usumodifica TO PUBLIC;


--
-- Name: ubicacion_fisica; Type: ACL; Schema: public; Owner: postgres
--

REVOKE ALL ON TABLE ubicacion_fisica FROM PUBLIC;
REVOKE ALL ON TABLE ubicacion_fisica FROM postgres;
GRANT ALL ON TABLE ubicacion_fisica TO postgres;
GRANT ALL ON TABLE ubicacion_fisica TO PUBLIC;


--
-- PostgreSQL database dump complete
--

