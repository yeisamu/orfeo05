-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb2+deb7u1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 16, 2015 at 02:04 PM
-- Server version: 1.0.20
-- PHP Version: 5.3.3-7+squeeze19

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `orfeo`
--

-- --------------------------------------------------------

--
-- Table structure for table `anexos`
--

CREATE TABLE IF NOT EXISTS `anexos` (
  `anex_radi_nume` decimal(15,0) NOT NULL,
  `anex_codigo` varchar(20) NOT NULL,
  `anex_tipo` decimal(4,0) NOT NULL,
  `anex_tamano` decimal(21,6) DEFAULT NULL,
  `anex_solo_lect` varchar(1) NOT NULL,
  `anex_creador` varchar(50) NOT NULL,
  `anex_desc` varchar(512) DEFAULT NULL,
  `anex_numero` decimal(5,0) NOT NULL,
  `anex_nomb_archivo` varchar(50) NOT NULL,
  `anex_borrado` varchar(1) NOT NULL,
  `anex_origen` decimal(1,0) DEFAULT NULL,
  `anex_ubic` varchar(15) DEFAULT NULL,
  `anex_salida` decimal(1,0) DEFAULT NULL,
  `radi_nume_salida` decimal(15,0) DEFAULT NULL,
  `anex_radi_fech` varchar(50) DEFAULT NULL,
  `anex_estado` decimal(1,0) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `sgd_rem_destino` decimal(1,0) DEFAULT NULL,
  `anex_fech_envio` varchar(50) DEFAULT NULL,
  `sgd_dir_tipo` decimal(4,0) DEFAULT NULL,
  `anex_fech_impres` varchar(50) DEFAULT NULL,
  `anex_depe_creador` decimal(4,0) DEFAULT NULL,
  `sgd_doc_secuencia` decimal(15,0) DEFAULT NULL,
  `sgd_doc_padre` varchar(20) DEFAULT NULL,
  `sgd_arg_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_deve_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_deve_fech` date DEFAULT NULL,
  `sgd_fech_impres` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `anex_fech_anex` varchar(50) DEFAULT NULL,
  `anex_depe_codi` varchar(3) DEFAULT NULL,
  `sgd_pnufe_codi` decimal(4,0) DEFAULT NULL,
  `sgd_dnufe_codi` decimal(4,0) DEFAULT NULL,
  `anex_usudoc_creador` varchar(15) DEFAULT NULL,
  `sgd_fech_doc` date DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_trad_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_dir_direccion` varchar(150) DEFAULT NULL,
  `sgd_exp_numero` varchar(18) DEFAULT NULL,
  `numero_doc` varchar(15) DEFAULT NULL,
  `sgd_srd_codigo` varchar(3) DEFAULT NULL,
  `sgd_sbrd_codigo` varchar(4) DEFAULT NULL,
  `anex_num_hoja` decimal(21,6) DEFAULT NULL,
  `texto_archivo_anex` longtext,
  `anex_idarch_version` decimal(3,0) DEFAULT NULL,
  `anex_num_version` decimal(2,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anexos_historico`
--

CREATE TABLE IF NOT EXISTS `anexos_historico` (
  `anex_hist_anex_codi` varchar(20) NOT NULL,
  `anex_hist_num_ver` decimal(4,0) NOT NULL,
  `anex_hist_tipo_mod` varchar(2) NOT NULL,
  `anex_hist_usua` varchar(15) NOT NULL,
  `anex_hist_fecha` date NOT NULL,
  `usua_doc` varchar(14) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `anexos_tipo`
--

CREATE TABLE IF NOT EXISTS `anexos_tipo` (
  `anex_tipo_codi` decimal(4,0) NOT NULL,
  `anex_tipo_ext` varchar(10) NOT NULL,
  `anex_tipo_desc` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aux_01`
--

CREATE TABLE IF NOT EXISTS `aux_01` (
  `r` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bodega_empresas`
--

CREATE TABLE IF NOT EXISTS `bodega_empresas` (
  `nombre_de_la_empresa` varchar(300) DEFAULT NULL,
  `nuir` varchar(13) DEFAULT NULL,
  `nit_de_la_empresa` varchar(80) DEFAULT NULL,
  `sigla_de_la_empresa` varchar(80) DEFAULT NULL,
  `direccion` varchar(4000) DEFAULT NULL,
  `codigo_del_departamento` varchar(4000) DEFAULT NULL,
  `codigo_del_municipio` varchar(4000) DEFAULT NULL,
  `telefono_1` varchar(4000) DEFAULT NULL,
  `telefono_2` varchar(4000) DEFAULT NULL,
  `email` varchar(4000) DEFAULT NULL,
  `nombre_rep_legal` varchar(4000) DEFAULT NULL,
  `cargo_rep_legal` varchar(4000) DEFAULT NULL,
  `identificador_empresa` decimal(5,0) NOT NULL,
  `are_esp_secue` decimal(8,0) NOT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `activa` decimal(1,0) DEFAULT NULL,
  `flag_rups` varchar(10) DEFAULT NULL,
  `codigo_suscriptor` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`identificador_empresa`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bodega_empresas_old`
--

CREATE TABLE IF NOT EXISTS `bodega_empresas_old` (
  `identificador_de_la_empresa` decimal(5,0) NOT NULL,
  `nuir` varchar(13) DEFAULT NULL,
  `nombre_de_la_empresa` varchar(150) DEFAULT NULL,
  `nit_de_la_empresa` varchar(13) DEFAULT NULL,
  `sigla_de_la_empresa` varchar(30) DEFAULT NULL,
  `codigo_de_la_nat_juridica` decimal(2,0) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `codigo_del_departamento` decimal(2,0) DEFAULT NULL,
  `codigo_del_municipio` decimal(3,0) DEFAULT NULL,
  `codigo_de_la_unidad` decimal(3,0) DEFAULT NULL,
  `telefono_1` varchar(15) DEFAULT NULL,
  `telefono_2` varchar(15) DEFAULT NULL,
  `telefono_3` varchar(15) DEFAULT NULL,
  `apartado_aereo` decimal(10,0) DEFAULT NULL,
  `numero_de_fax` varchar(15) DEFAULT NULL,
  `zona_postal` decimal(3,0) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `tiene_contab_por_servicio` varchar(2) DEFAULT NULL,
  `fecha_de_actualizacion` date DEFAULT NULL,
  `codigo_regional` decimal(3,0) DEFAULT NULL,
  `estado_de_la_empresa` varchar(50) DEFAULT NULL,
  `fecha_del_estado` date DEFAULT NULL,
  `obsv_del_estado` varchar(100) DEFAULT NULL,
  `esp_cias` decimal(4,0) DEFAULT NULL,
  `esp_auxi` decimal(8,0) DEFAULT NULL,
  `esp_etco` decimal(2,0) DEFAULT NULL,
  `esp_ceco` varchar(16) DEFAULT NULL,
  `estado` decimal(2,0) DEFAULT NULL,
  `tipo_identificacion_repl` varchar(1) DEFAULT NULL,
  `numero_identificaci_repl` varchar(11) DEFAULT NULL,
  `nombre_rep_legal` varchar(75) DEFAULT NULL,
  `cargo_rep_legal` decimal(2,0) DEFAULT NULL,
  `numero_camara_ccio` varchar(20) DEFAULT NULL,
  `cod_estado_vigilancia` decimal(2,0) DEFAULT NULL,
  `identificador_empresa` decimal(5,0) NOT NULL,
  `nombre_de_la_empresa_anterior` varchar(150) DEFAULT NULL,
  `direccion_anterior` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `borrar_carpeta_personalizada`
--

CREATE TABLE IF NOT EXISTS `borrar_carpeta_personalizada` (
  `carp_per_codi` decimal(2,0) NOT NULL,
  `carp_per_usu` varchar(15) NOT NULL,
  `carp_per_desc` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `borrar_empresa_esp`
--

CREATE TABLE IF NOT EXISTS `borrar_empresa_esp` (
  `eesp_codi` decimal(7,0) NOT NULL,
  `eesp_nomb` varchar(150) NOT NULL,
  `essp_nit` varchar(13) DEFAULT NULL,
  `essp_sigla` varchar(30) DEFAULT NULL,
  `depe_codi` decimal(2,0) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `eesp_dire` varchar(50) DEFAULT NULL,
  `eesp_rep_leg` varchar(75) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carpeta`
--

CREATE TABLE IF NOT EXISTS `carpeta` (
  `carp_codi` decimal(2,0) NOT NULL,
  `carp_desc` varchar(80) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carpeta_per`
--

CREATE TABLE IF NOT EXISTS `carpeta_per` (
  `usua_codi` decimal(3,0) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `nomb_carp` varchar(15) DEFAULT NULL,
  `desc_carp` varchar(50) DEFAULT NULL,
  `codi_carp` decimal(3,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `centro_poblado`
--

CREATE TABLE IF NOT EXISTS `centro_poblado` (
  `cpob_codi` decimal(4,0) NOT NULL,
  `muni_codi` decimal(4,0) NOT NULL,
  `dpto_codi` decimal(2,0) NOT NULL,
  `cpob_nomb` varchar(100) NOT NULL,
  `cpob_nomb_anterior` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departamento`
--

CREATE TABLE IF NOT EXISTS `departamento` (
  `dpto_codi` decimal(3,0) NOT NULL,
  `dpto_nomb` varchar(70) NOT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dependencia`
--

CREATE TABLE IF NOT EXISTS `dependencia` (
  `depe_codi` decimal(5,0) NOT NULL,
  `depe_nomb` varchar(70) NOT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `depe_codi_padre` decimal(5,0) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `depe_codi_territorial` decimal(4,0) DEFAULT NULL,
  `dep_sigla` varchar(100) DEFAULT NULL,
  `dep_central` decimal(1,0) DEFAULT NULL,
  `dep_direccion` varchar(100) DEFAULT NULL,
  `depe_num_interna` decimal(4,0) DEFAULT NULL,
  `depe_num_resolucion` decimal(4,0) DEFAULT NULL,
  `depe_rad_tp1` decimal(3,0) DEFAULT NULL,
  `depe_rad_tp2` decimal(3,0) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `depe_estado` decimal(1,0) DEFAULT NULL,
  `depe_rad_tp4` int(11) DEFAULT NULL,
  `depe_segu` int(11) DEFAULT NULL,
  `depe_rad_tp3` int(11) DEFAULT NULL,
  `depe_rad_tp5` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dependencia_visibilidad`
--

CREATE TABLE IF NOT EXISTS `dependencia_visibilidad` (
  `codigo_visibilidad` decimal(18,0) NOT NULL,
  `dependencia_visible` decimal(5,0) NOT NULL,
  `dependencia_observa` decimal(5,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dup_eliminar`
--

CREATE TABLE IF NOT EXISTS `dup_eliminar` (
  `sgd_oem_codigo` decimal(8,0) NOT NULL,
  `tdid_codi` decimal(2,0) DEFAULT NULL,
  `sgd_oem_oempresa` varchar(150) DEFAULT NULL,
  `sgd_oem_rep_legal` varchar(150) DEFAULT NULL,
  `sgd_oem_nit` varchar(14) DEFAULT NULL,
  `sgd_oem_sigla` varchar(50) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `sgd_oem_direccion` varchar(100) DEFAULT NULL,
  `sgd_oem_telefono` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `empresas_temporal`
--

CREATE TABLE IF NOT EXISTS `empresas_temporal` (
  `nombre_de_la_empresa` varchar(160) DEFAULT NULL,
  `nuir` varchar(13) DEFAULT NULL,
  `nit_de_la_empresa` varchar(80) DEFAULT NULL,
  `sigla_de_la_empresa` varchar(80) DEFAULT NULL,
  `direccion` varchar(4000) DEFAULT NULL,
  `codigo_del_departamento` varchar(4000) DEFAULT NULL,
  `codigo_del_municipio` varchar(4000) DEFAULT NULL,
  `telefono_1` varchar(4000) DEFAULT NULL,
  `telefono_2` varchar(4000) DEFAULT NULL,
  `email` varchar(4000) DEFAULT NULL,
  `nombre_rep_legal` varchar(4000) DEFAULT NULL,
  `cargo_rep_legal` varchar(4000) DEFAULT NULL,
  `identificador_empresa` decimal(5,0) DEFAULT NULL,
  `are_esp_secue` decimal(8,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_cod_actualizar`
--

CREATE TABLE IF NOT EXISTS `emp_cod_actualizar` (
  `emp_cod_ant` varchar(10) DEFAULT NULL,
  `emp_cod_nue` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `encuesta`
--

CREATE TABLE IF NOT EXISTS `encuesta` (
  `usua_doc` varchar(14) NOT NULL,
  `fecha` date DEFAULT NULL,
  `p1` varchar(100) DEFAULT NULL,
  `p2` varchar(100) DEFAULT NULL,
  `p3` varchar(100) DEFAULT NULL,
  `p4` varchar(100) DEFAULT NULL,
  `p5` varchar(100) DEFAULT NULL,
  `p6` varchar(100) DEFAULT NULL,
  `p7` varchar(100) DEFAULT NULL,
  `p7_cual` varchar(150) DEFAULT NULL,
  `p8` varchar(100) DEFAULT NULL,
  `p9` varchar(100) DEFAULT NULL,
  `p10` varchar(100) DEFAULT NULL,
  `p11` varchar(100) DEFAULT NULL,
  `p12` varchar(100) DEFAULT NULL,
  `p13` varchar(100) DEFAULT NULL,
  `p14` varchar(100) DEFAULT NULL,
  `p15` varchar(100) DEFAULT NULL,
  `p16` varchar(100) DEFAULT NULL,
  `p17` varchar(100) DEFAULT NULL,
  `p18` varchar(100) DEFAULT NULL,
  `p19` varchar(100) DEFAULT NULL,
  `p20` varchar(100) DEFAULT NULL,
  `p20_cual` varchar(150) DEFAULT NULL,
  `p21` varchar(100) DEFAULT NULL,
  `p22` varchar(100) DEFAULT NULL,
  `p23` varchar(100) DEFAULT NULL,
  `p24` varchar(100) DEFAULT NULL,
  `p25` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `entidades_asociativa`
--

CREATE TABLE IF NOT EXISTS `entidades_asociativa` (
  `nit` varchar(12) DEFAULT NULL,
  `codentidad` decimal(10,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `estado`
--

CREATE TABLE IF NOT EXISTS `estado` (
  `esta_codi` decimal(2,0) NOT NULL,
  `esta_desc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `example`
--

CREATE TABLE IF NOT EXISTS `example` (
  `campo1` decimal(15,0) NOT NULL,
  `campo2` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fun_funcionario`
--

CREATE TABLE IF NOT EXISTS `fun_funcionario` (
  `usua_doc` varchar(14) DEFAULT NULL,
  `usua_fech_crea` date NOT NULL,
  `usua_esta` varchar(10) NOT NULL,
  `usua_nomb` varchar(45) DEFAULT NULL,
  `usua_ext` decimal(4,0) DEFAULT NULL,
  `usua_nacim` date DEFAULT NULL,
  `usua_email` varchar(50) DEFAULT NULL,
  `usua_at` varchar(15) DEFAULT NULL,
  `usua_piso` decimal(2,0) DEFAULT NULL,
  `cedula_ok` char(1) DEFAULT NULL,
  `cedula_suip` varchar(15) DEFAULT NULL,
  `nombre_suip` varchar(45) DEFAULT NULL,
  `observa` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fun_funcionario_2`
--

CREATE TABLE IF NOT EXISTS `fun_funcionario_2` (
  `usua_doc` varchar(14) DEFAULT NULL,
  `usua_fech_crea` date NOT NULL,
  `usua_esta` varchar(10) NOT NULL,
  `usua_nomb` varchar(45) DEFAULT NULL,
  `usua_ext` decimal(4,0) DEFAULT NULL,
  `usua_nacim` date DEFAULT NULL,
  `usua_email` varchar(50) DEFAULT NULL,
  `usua_at` varchar(15) DEFAULT NULL,
  `usua_piso` decimal(2,0) DEFAULT NULL,
  `cedula_ok` char(1) DEFAULT NULL,
  `cedula_suip` varchar(15) DEFAULT NULL,
  `nombre_suip` varchar(45) DEFAULT NULL,
  `observa` char(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hist_eventos`
--

CREATE TABLE IF NOT EXISTS `hist_eventos` (
  `depe_codi` decimal(5,0) NOT NULL,
  `hist_fech` varchar(50) NOT NULL,
  `usua_codi` decimal(10,0) NOT NULL,
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `hist_obse` varchar(10000) NOT NULL,
  `usua_codi_dest` decimal(10,0) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `usua_doc_old` varchar(15) DEFAULT NULL,
  `sgd_ttr_codigo` decimal(3,0) DEFAULT NULL,
  `hist_usua_autor` varchar(14) DEFAULT NULL,
  `hist_doc_dest` varchar(14) DEFAULT NULL,
  `depe_codi_dest` decimal(3,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `informados`
--

CREATE TABLE IF NOT EXISTS `informados` (
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `usua_codi` decimal(10,0) NOT NULL,
  `depe_codi` decimal(3,0) NOT NULL,
  `info_desc` varchar(600) DEFAULT NULL,
  `info_fech` date NOT NULL,
  `info_leido` decimal(1,0) DEFAULT NULL,
  `usua_codi_info` decimal(3,0) DEFAULT NULL,
  `info_codi` decimal(10,0) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `info_resp` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `medio_recepcion`
--

CREATE TABLE IF NOT EXISTS `medio_recepcion` (
  `mrec_codi` decimal(2,0) NOT NULL,
  `mrec_desc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `municipio`
--

CREATE TABLE IF NOT EXISTS `municipio` (
  `muni_codi` decimal(4,0) NOT NULL,
  `dpto_codi` decimal(3,0) NOT NULL,
  `muni_nomb` varchar(100) NOT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `homologa_muni` varchar(10) DEFAULT NULL,
  `homologa_idmuni` varchar(15) DEFAULT NULL,
  `activa` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ortega_prueba_orfeo`
--

CREATE TABLE IF NOT EXISTS `ortega_prueba_orfeo` (
  `radi_nume_hoja` decimal(3,0) DEFAULT NULL,
  `radi_fech_radi` date DEFAULT NULL,
  `radi_nume_radi` decimal(15,0) DEFAULT NULL,
  `ra_asun` varchar(350) DEFAULT NULL,
  `radi_path` varchar(100) DEFAULT NULL,
  `radi_usu_ante` varchar(45) DEFAULT NULL,
  `nombre_de_la_empresa` varchar(150) DEFAULT NULL,
  `fecha` varchar(20) DEFAULT NULL,
  `sgd_tpr_descrip` varchar(150) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_tpr_termino` decimal(4,0) DEFAULT NULL,
  `diasr` decimal(4,0) DEFAULT NULL,
  `radi_leido` decimal(1,0) DEFAULT NULL,
  `radi_tipo_deri` decimal(2,0) DEFAULT NULL,
  `radi_nume_deri` decimal(15,0) DEFAULT NULL,
  `sgd_ciu_nombre` varchar(50) DEFAULT NULL,
  `sgd_ciu_apell1` varchar(50) DEFAULT NULL,
  `sgd_ciu_apell2` varchar(50) DEFAULT NULL,
  `tipo_query` varchar(50) DEFAULT NULL,
  `sgd_dir_tipo` decimal(4,0) DEFAULT NULL,
  `sgd_dir_nombre` varchar(60) DEFAULT NULL,
  `radi_cuentai` varchar(20) DEFAULT NULL,
  `sgd_exp_numero` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `par_serv_servicios`
--

CREATE TABLE IF NOT EXISTS `par_serv_servicios` (
  `par_serv_secue` decimal(8,0) NOT NULL,
  `par_serv_codigo` varchar(5) DEFAULT NULL,
  `par_serv_nombre` varchar(100) DEFAULT NULL,
  `par_serv_estado` varchar(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plantilla_pl`
--

CREATE TABLE IF NOT EXISTS `plantilla_pl` (
  `pl_codi` decimal(4,0) NOT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `pl_nomb` varchar(35) DEFAULT NULL,
  `pl_archivo` varchar(35) DEFAULT NULL,
  `pl_desc` varchar(150) DEFAULT NULL,
  `pl_fech` date DEFAULT NULL,
  `usua_codi` decimal(10,0) DEFAULT NULL,
  `pl_uso` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan_table`
--

CREATE TABLE IF NOT EXISTS `plan_table` (
  `statement_id` varchar(30) DEFAULT NULL,
  `timestamp` date DEFAULT NULL,
  `remarks` varchar(80) DEFAULT NULL,
  `operation` varchar(30) DEFAULT NULL,
  `options` varchar(30) DEFAULT NULL,
  `object_node` varchar(128) DEFAULT NULL,
  `object_owner` varchar(30) DEFAULT NULL,
  `object_name` varchar(30) DEFAULT NULL,
  `object_instance` int(11) DEFAULT NULL,
  `object_type` varchar(30) DEFAULT NULL,
  `optimizer` varchar(255) DEFAULT NULL,
  `search_columns` decimal(21,6) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL,
  `cardinality` int(11) DEFAULT NULL,
  `s` int(11) DEFAULT NULL,
  `other_tag` varchar(255) DEFAULT NULL,
  `partition_start` varchar(255) DEFAULT NULL,
  `partition_stop` varchar(255) DEFAULT NULL,
  `partition_id` int(11) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `distribution` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plsql_profiler_data`
--

CREATE TABLE IF NOT EXISTS `plsql_profiler_data` (
  `runid` decimal(21,6) DEFAULT NULL,
  `unit_numeric` decimal(21,6) DEFAULT NULL,
  `line` decimal(21,6) NOT NULL,
  `total_occur` decimal(21,6) DEFAULT NULL,
  `total_time` decimal(21,6) DEFAULT NULL,
  `min_time` decimal(21,6) DEFAULT NULL,
  `max_time` decimal(21,6) DEFAULT NULL,
  `spare1` decimal(21,6) DEFAULT NULL,
  `spare2` decimal(21,6) DEFAULT NULL,
  `spare3` decimal(21,6) DEFAULT NULL,
  `spare4` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plsql_profiler_runs`
--

CREATE TABLE IF NOT EXISTS `plsql_profiler_runs` (
  `runid` decimal(21,6) DEFAULT NULL,
  `related_run` decimal(21,6) DEFAULT NULL,
  `run_owner` varchar(32) DEFAULT NULL,
  `run_date` date DEFAULT NULL,
  `run_comment` varchar(2047) DEFAULT NULL,
  `run_total_time` decimal(21,6) DEFAULT NULL,
  `run_system_info` varchar(2047) DEFAULT NULL,
  `run_comment1` varchar(2047) DEFAULT NULL,
  `spare1` varchar(256) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plsql_profiler_units`
--

CREATE TABLE IF NOT EXISTS `plsql_profiler_units` (
  `runid` decimal(21,6) DEFAULT NULL,
  `unit_numeric` decimal(21,6) DEFAULT NULL,
  `unit_type` varchar(32) DEFAULT NULL,
  `unit_owner` varchar(32) DEFAULT NULL,
  `unit_name` varchar(32) DEFAULT NULL,
  `unit_timestamp` date DEFAULT NULL,
  `total_time` decimal(21,6) NOT NULL,
  `spare1` decimal(21,6) DEFAULT NULL,
  `spare2` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_generado_plg`
--

CREATE TABLE IF NOT EXISTS `pl_generado_plg` (
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `radi_nume_radi` decimal(15,0) DEFAULT NULL,
  `plt_codi` decimal(4,0) DEFAULT NULL,
  `plg_codi` decimal(4,0) DEFAULT NULL,
  `plg_comentarios` varchar(150) DEFAULT NULL,
  `plg_analiza` decimal(10,0) DEFAULT NULL,
  `plg_firma` decimal(10,0) DEFAULT NULL,
  `plg_autoriza` decimal(10,0) DEFAULT NULL,
  `plg_imprime` decimal(10,0) DEFAULT NULL,
  `plg_envia` decimal(10,0) DEFAULT NULL,
  `plg_archivo_tmp` varchar(150) DEFAULT NULL,
  `plg_archivo_final` varchar(150) DEFAULT NULL,
  `plg_nombre` varchar(30) DEFAULT NULL,
  `plg_crea` decimal(10,0) DEFAULT NULL,
  `plg_autoriza_fech` date DEFAULT NULL,
  `plg_imprime_fech` date DEFAULT NULL,
  `plg_envia_fech` date DEFAULT NULL,
  `plg_crea_fech` date DEFAULT NULL,
  `plg_creador` varchar(20) DEFAULT NULL,
  `pl_codi` decimal(4,0) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `sgd_rem_destino` decimal(1,0) DEFAULT NULL,
  `radi_nume_sal` decimal(15,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pl_tipo_plt`
--

CREATE TABLE IF NOT EXISTS `pl_tipo_plt` (
  `plt_codi` decimal(4,0) NOT NULL,
  `plt_desc` varchar(35) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `prestamo`
--

CREATE TABLE IF NOT EXISTS `prestamo` (
  `pres_id` decimal(10,0) NOT NULL,
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `usua_login_actu` varchar(50) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `usua_login_pres` varchar(50) DEFAULT NULL,
  `pres_desc` varchar(200) DEFAULT NULL,
  `pres_fech_pres` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pres_fech_devo` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pres_fech_pedi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pres_estado` decimal(2,0) DEFAULT NULL,
  `pres_requerimiento` decimal(2,0) DEFAULT NULL,
  `pres_depe_arch` decimal(5,0) DEFAULT NULL,
  `pres_fech_venc` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dev_desc` varchar(500) DEFAULT NULL,
  `pres_fech_canc` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `usua_login_canc` varchar(50) DEFAULT NULL,
  `usua_login_rx` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pruba`
--

CREATE TABLE IF NOT EXISTS `pruba` (
  `nombre` varchar(20) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `p_sgd_oem_oempresas`
--

CREATE TABLE IF NOT EXISTS `p_sgd_oem_oempresas` (
  `sgd_oem_codigo` decimal(8,0) NOT NULL,
  `tdid_codi` decimal(2,0) DEFAULT NULL,
  `sgd_oem_oempresa` varchar(150) DEFAULT NULL,
  `sgd_oem_rep_legal` varchar(150) DEFAULT NULL,
  `sgd_oem_nit` varchar(14) DEFAULT NULL,
  `sgd_oem_sigla` varchar(50) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `sgd_oem_direccion` varchar(100) DEFAULT NULL,
  `sgd_oem_telefono` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `radicado`
--

CREATE TABLE IF NOT EXISTS `radicado` (
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `radi_fech_radi` varchar(50) NOT NULL,
  `tdoc_codi` decimal(4,0) NOT NULL,
  `trte_codi` decimal(2,0) DEFAULT NULL,
  `mrec_codi` decimal(2,0) DEFAULT NULL,
  `eesp_codi` decimal(10,0) DEFAULT NULL,
  `eotra_codi` decimal(10,0) DEFAULT NULL,
  `radi_tipo_empr` varchar(2) DEFAULT NULL,
  `radi_fech_ofic` date DEFAULT NULL,
  `tdid_codi` decimal(2,0) DEFAULT NULL,
  `radi_nume_iden` varchar(15) DEFAULT NULL,
  `radi_nomb` varchar(90) DEFAULT NULL,
  `radi_prim_apel` varchar(50) DEFAULT NULL,
  `radi_segu_apel` varchar(50) DEFAULT NULL,
  `radi_pais` varchar(70) DEFAULT NULL,
  `muni_codi` decimal(5,0) DEFAULT NULL,
  `cpob_codi` decimal(4,0) DEFAULT NULL,
  `carp_codi` decimal(3,0) DEFAULT NULL,
  `esta_codi` decimal(2,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `cen_muni_codi` decimal(4,0) DEFAULT NULL,
  `cen_dpto_codi` decimal(2,0) DEFAULT NULL,
  `radi_dire_corr` varchar(100) DEFAULT NULL,
  `radi_tele_cont` varchar(15) DEFAULT NULL,
  `radi_nume_hoja` decimal(4,0) DEFAULT NULL,
  `radi_desc_anex` varchar(500) DEFAULT NULL,
  `radi_nume_deri` decimal(15,0) DEFAULT NULL,
  `radi_path` varchar(100) DEFAULT NULL,
  `radi_usua_actu` decimal(10,0) DEFAULT NULL,
  `radi_depe_actu` decimal(5,0) DEFAULT NULL,
  `radi_fech_asig` varchar(50) DEFAULT NULL,
  `radi_arch1` varchar(10) DEFAULT NULL,
  `radi_arch2` varchar(10) DEFAULT NULL,
  `radi_arch3` varchar(10) DEFAULT NULL,
  `radi_arch4` varchar(10) DEFAULT NULL,
  `ra_asun` varchar(350) DEFAULT NULL,
  `radi_usu_ante` varchar(45) DEFAULT NULL,
  `radi_depe_radi` decimal(3,0) DEFAULT NULL,
  `radi_rem` varchar(60) DEFAULT NULL,
  `radi_usua_radi` decimal(10,0) DEFAULT NULL,
  `codi_nivel` decimal(2,0) DEFAULT NULL,
  `flag_nivel` int(11) DEFAULT NULL,
  `carp_per` decimal(1,0) DEFAULT NULL,
  `radi_leido` decimal(1,0) DEFAULT NULL,
  `radi_cuentai` varchar(20) DEFAULT NULL,
  `radi_tipo_deri` decimal(2,0) DEFAULT NULL,
  `listo` varchar(2) DEFAULT NULL,
  `sgd_tma_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_mtd_codigo` decimal(4,0) DEFAULT NULL,
  `par_serv_secue` decimal(8,0) DEFAULT NULL,
  `sgd_fld_codigo` decimal(3,0) DEFAULT NULL,
  `radi_agend` decimal(1,0) DEFAULT NULL,
  `radi_fech_agend` varchar(50) DEFAULT NULL,
  `radi_fech_doc` date DEFAULT NULL,
  `sgd_doc_secuencia` decimal(15,0) DEFAULT NULL,
  `sgd_pnufe_codi` decimal(4,0) DEFAULT NULL,
  `sgd_eanu_codigo` decimal(1,0) DEFAULT NULL,
  `sgd_not_codi` decimal(3,0) DEFAULT NULL,
  `radi_fech_notif` varchar(50) DEFAULT NULL,
  `sgd_tdec_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_ttr_codigo` int(11) DEFAULT NULL,
  `usua_doc_ante` varchar(14) DEFAULT NULL,
  `radi_fech_antetx` varchar(50) DEFAULT NULL,
  `sgd_trad_codigo` decimal(2,0) DEFAULT NULL,
  `fech_vcmto` varchar(50) DEFAULT NULL,
  `tdoc_vcmto` decimal(4,0) DEFAULT NULL,
  `sgd_termino_real` decimal(4,0) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `sgd_spub_codigo` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `medio_m` varchar(5) DEFAULT NULL,
  `radi_nrr` decimal(2,0) DEFAULT NULL,
  `numero_rm` varchar(15) DEFAULT NULL,
  `numero_tran` varchar(15) DEFAULT NULL,
  `texto_archivo` longtext,
  PRIMARY KEY (`radi_nume_radi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `retencion_doc_tmp`
--

CREATE TABLE IF NOT EXISTS `retencion_doc_tmp` (
  `cod_serie` decimal(4,0) DEFAULT NULL,
  `serie` varchar(100) DEFAULT NULL,
  `tipologia_doc` varchar(200) DEFAULT NULL,
  `cod_subserie` varchar(10) DEFAULT NULL,
  `subserie` varchar(100) DEFAULT NULL,
  `tipologia_sub` varchar(200) DEFAULT NULL,
  `dependencia` decimal(5,0) DEFAULT NULL,
  `nom_depe` varchar(200) DEFAULT NULL,
  `archivo_gestion` decimal(3,0) DEFAULT NULL,
  `archivo_central` decimal(3,0) DEFAULT NULL,
  `disposicion` varchar(100) DEFAULT NULL,
  `soporte` varchar(20) DEFAULT NULL,
  `procedimiento` varchar(500) DEFAULT NULL,
  `tipo_doc` decimal(4,0) DEFAULT NULL,
  `error` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `series`
--

CREATE TABLE IF NOT EXISTS `series` (
  `depe_codi` decimal(5,0) NOT NULL,
  `seri_nume` decimal(7,0) NOT NULL,
  `seri_tipo` decimal(2,0) DEFAULT NULL,
  `seri_ano` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) NOT NULL,
  `bloq` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_acm_acusemsg`
--

CREATE TABLE IF NOT EXISTS `sgd_acm_acusemsg` (
  `sgd_msg_codi` decimal(15,0) NOT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `sgd_msg_leido` decimal(3,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_actadd_actualiadicional`
--

CREATE TABLE IF NOT EXISTS `sgd_actadd_actualiadicional` (
  `sgd_actadd_codi` decimal(4,0) DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_instorf_codi` decimal(4,0) DEFAULT NULL,
  `sgd_actadd_query` varchar(500) DEFAULT NULL,
  `sgd_actadd_desc` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_agen_agendados`
--

CREATE TABLE IF NOT EXISTS `sgd_agen_agendados` (
  `sgd_agen_fech` date DEFAULT NULL,
  `sgd_agen_observacion` varchar(4000) DEFAULT NULL,
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `usua_doc` varchar(18) NOT NULL,
  `depe_codi` varchar(3) DEFAULT NULL,
  `sgd_agen_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_agen_fechplazo` date DEFAULT NULL,
  `sgd_agen_activo` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_anar_anexarg`
--

CREATE TABLE IF NOT EXISTS `sgd_anar_anexarg` (
  `sgd_anar_codi` decimal(4,0) NOT NULL,
  `anex_codigo` varchar(20) DEFAULT NULL,
  `sgd_argd_codi` decimal(4,0) DEFAULT NULL,
  `sgd_anar_argcod` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_anu_anulados`
--

CREATE TABLE IF NOT EXISTS `sgd_anu_anulados` (
  `sgd_anu_id` decimal(4,0) DEFAULT NULL,
  `sgd_anu_desc` varchar(250) DEFAULT NULL,
  `radi_nume_radi` decimal(21,6) DEFAULT NULL,
  `sgd_eanu_codi` decimal(4,0) DEFAULT NULL,
  `sgd_anu_sol_fech` date DEFAULT NULL,
  `sgd_anu_fech` date DEFAULT NULL,
  `depe_codi` decimal(3,0) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `usua_codi` decimal(4,0) DEFAULT NULL,
  `depe_codi_anu` decimal(3,0) DEFAULT NULL,
  `usua_doc_anu` varchar(14) DEFAULT NULL,
  `usua_codi_anu` decimal(4,0) DEFAULT NULL,
  `usua_anu_acta` decimal(8,0) DEFAULT NULL,
  `sgd_anu_path_acta` varchar(200) DEFAULT NULL,
  `sgd_trad_codigo` decimal(2,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_aper_adminperfiles`
--

CREATE TABLE IF NOT EXISTS `sgd_aper_adminperfiles` (
  `sgd_aper_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_aper_descripcion` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_aplfad_plicfunadi`
--

CREATE TABLE IF NOT EXISTS `sgd_aplfad_plicfunadi` (
  `sgd_aplfad_codi` decimal(4,0) DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_aplfad_menu` varchar(150) NOT NULL,
  `sgd_aplfad_lk1` varchar(150) NOT NULL,
  `sgd_aplfad_desc` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_apli_aplintegra`
--

CREATE TABLE IF NOT EXISTS `sgd_apli_aplintegra` (
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_apli_descrip` varchar(150) DEFAULT NULL,
  `sgd_apli_lk1desc` varchar(150) DEFAULT NULL,
  `sgd_apli_lk1` varchar(150) DEFAULT NULL,
  `sgd_apli_lk2desc` varchar(150) DEFAULT NULL,
  `sgd_apli_lk2` varchar(150) DEFAULT NULL,
  `sgd_apli_lk3desc` varchar(150) DEFAULT NULL,
  `sgd_apli_lk3` varchar(150) DEFAULT NULL,
  `sgd_apli_lk4desc` varchar(150) DEFAULT NULL,
  `sgd_apli_lk4` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_aplmen_aplimens`
--

CREATE TABLE IF NOT EXISTS `sgd_aplmen_aplimens` (
  `sgd_aplmen_codi` decimal(4,0) DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_aplmen_ref` varchar(20) DEFAULT NULL,
  `sgd_aplmen_haciaorfeo` decimal(4,0) DEFAULT NULL,
  `sgd_aplmen_desdeorfeo` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_aplus_plicusua`
--

CREATE TABLE IF NOT EXISTS `sgd_aplus_plicusua` (
  `sgd_aplus_codi` decimal(4,0) DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `sgd_trad_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_aplus_prioridad` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_archivo_central`
--

CREATE TABLE IF NOT EXISTS `sgd_archivo_central` (
  `sgd_archivo_id` decimal(21,6) NOT NULL,
  `sgd_archivo_tipo` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_orden` varchar(15) DEFAULT NULL,
  `sgd_archivo_fechai` varchar(50) DEFAULT NULL,
  `sgd_archivo_demandado` varchar(1500) DEFAULT NULL,
  `sgd_archivo_demandante` varchar(200) DEFAULT NULL,
  `sgd_archivo_cc_demandante` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_depe` varchar(5) DEFAULT NULL,
  `sgd_archivo_zona` varchar(4) DEFAULT NULL,
  `sgd_archivo_carro` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_cara` varchar(4) DEFAULT NULL,
  `sgd_archivo_estante` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_entrepano` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_caja` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_unidocu` varchar(40) DEFAULT NULL,
  `sgd_archivo_anexo` varchar(4000) DEFAULT NULL,
  `sgd_archivo_inder` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_path` varchar(4000) DEFAULT NULL,
  `sgd_archivo_year` decimal(4,0) DEFAULT NULL,
  `sgd_archivo_rad` varchar(15) NOT NULL,
  `sgd_archivo_srd` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_sbrd` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_folios` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_mata` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_fechaf` varchar(50) DEFAULT NULL,
  `sgd_archivo_prestamo` decimal(1,0) DEFAULT NULL,
  `sgd_archivo_funprest` char(100) DEFAULT NULL,
  `sgd_archivo_fechprest` varchar(50) DEFAULT NULL,
  `sgd_archivo_fechprestf` varchar(50) DEFAULT NULL,
  `depe_codi` varchar(5) DEFAULT NULL,
  `sgd_archivo_usua` varchar(15) DEFAULT NULL,
  `sgd_archivo_fech` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sgd_archivo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_archivo_fondo`
--

CREATE TABLE IF NOT EXISTS `sgd_archivo_fondo` (
  `sgd_archivo_id` decimal(21,6) NOT NULL,
  `sgd_archivo_tipo` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_orden` varchar(15) DEFAULT NULL,
  `sgd_archivo_fechai` varchar(50) DEFAULT NULL,
  `sgd_archivo_demandado` varchar(1500) DEFAULT NULL,
  `sgd_archivo_demandante` varchar(200) DEFAULT NULL,
  `sgd_archivo_cc_demandante` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_depe` varchar(5) DEFAULT NULL,
  `sgd_archivo_zona` varchar(4) DEFAULT NULL,
  `sgd_archivo_carro` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_cara` varchar(4) DEFAULT NULL,
  `sgd_archivo_estante` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_entrepano` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_caja` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_unidocu` varchar(40) DEFAULT NULL,
  `sgd_archivo_anexo` varchar(4000) DEFAULT NULL,
  `sgd_archivo_inder` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_path` varchar(4000) DEFAULT NULL,
  `sgd_archivo_year` decimal(4,0) DEFAULT NULL,
  `sgd_archivo_rad` varchar(15) NOT NULL,
  `sgd_archivo_srd` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_folios` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_mata` decimal(21,6) DEFAULT NULL,
  `sgd_archivo_fechaf` varchar(50) DEFAULT NULL,
  `sgd_archivo_prestamo` decimal(1,0) DEFAULT NULL,
  `sgd_archivo_funprest` char(100) DEFAULT NULL,
  `sgd_archivo_fechprest` varchar(50) DEFAULT NULL,
  `sgd_archivo_fechprestf` varchar(50) DEFAULT NULL,
  `depe_codi` varchar(5) DEFAULT NULL,
  `sgd_archivo_usua` varchar(15) DEFAULT NULL,
  `sgd_archivo_fech` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`sgd_archivo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_archivo_hist`
--

CREATE TABLE IF NOT EXISTS `sgd_archivo_hist` (
  `depe_codi` varchar(5) NOT NULL,
  `hist_fech` varchar(50) NOT NULL,
  `usua_codi` decimal(10,0) NOT NULL,
  `sgd_archivo_rad` varchar(14) DEFAULT NULL,
  `hist_obse` varchar(600) NOT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `sgd_ttr_codigo` decimal(3,0) DEFAULT NULL,
  `hist_id` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_arch_depe`
--

CREATE TABLE IF NOT EXISTS `sgd_arch_depe` (
  `sgd_arch_depe` varchar(4) DEFAULT NULL,
  `sgd_arch_edificio` decimal(6,0) DEFAULT NULL,
  `sgd_arch_item` decimal(6,0) DEFAULT NULL,
  `sgd_arch_id` decimal(21,6) NOT NULL,
  PRIMARY KEY (`sgd_arch_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_argd_argdoc`
--

CREATE TABLE IF NOT EXISTS `sgd_argd_argdoc` (
  `sgd_argd_codi` decimal(4,0) NOT NULL,
  `sgd_pnufe_codi` decimal(4,0) DEFAULT NULL,
  `sgd_argd_tabla` varchar(100) DEFAULT NULL,
  `sgd_argd_tcodi` varchar(100) DEFAULT NULL,
  `sgd_argd_tdes` varchar(100) DEFAULT NULL,
  `sgd_argd_llist` varchar(150) DEFAULT NULL,
  `sgd_argd_campo` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_argup_argudoctop`
--

CREATE TABLE IF NOT EXISTS `sgd_argup_argudoctop` (
  `sgd_argup_codi` decimal(4,0) NOT NULL,
  `sgd_argup_desc` varchar(50) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_arg_pliego`
--

CREATE TABLE IF NOT EXISTS `sgd_arg_pliego` (
  `sgd_arg_codigo` decimal(2,0) NOT NULL,
  `sgd_arg_desc` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_auditoria`
--

CREATE TABLE IF NOT EXISTS `sgd_auditoria` (
  `fecha` varchar(10) DEFAULT NULL,
  `usua_doc` varchar(12) DEFAULT NULL,
  `ip` varchar(15) DEFAULT NULL,
  `tipo` varchar(5) DEFAULT NULL,
  `tabla` varchar(50) DEFAULT NULL,
  `isql` varchar(5000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_camexp_campoexpediente`
--

CREATE TABLE IF NOT EXISTS `sgd_camexp_campoexpediente` (
  `sgd_camexp_codigo` decimal(4,0) NOT NULL,
  `sgd_camexp_campo` varchar(30) NOT NULL,
  `sgd_parexp_codigo` decimal(4,0) NOT NULL,
  `sgd_camexp_fk` decimal(21,6) DEFAULT NULL,
  `sgd_camexp_tablafk` varchar(30) DEFAULT NULL,
  `sgd_camexp_campofk` varchar(30) DEFAULT NULL,
  `sgd_camexp_campovalor` varchar(30) DEFAULT NULL,
  `sgd_camexp_orden` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_carp_descripcion`
--

CREATE TABLE IF NOT EXISTS `sgd_carp_descripcion` (
  `sgd_carp_depecodi` varchar(5) NOT NULL,
  `sgd_carp_tiporad` decimal(2,0) NOT NULL,
  `sgd_carp_descr` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`sgd_carp_depecodi`,`sgd_carp_tiporad`),
  KEY `sgd_carp_tiporad` (`sgd_carp_tiporad`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_caux_causales`
--

CREATE TABLE IF NOT EXISTS `sgd_caux_causales` (
  `sgd_caux_codigo` decimal(10,0) NOT NULL,
  `radi_nume_radi` decimal(15,0) DEFAULT NULL,
  `sgd_dcau_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_ddca_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_caux_fecha` date DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_cau_causal`
--

CREATE TABLE IF NOT EXISTS `sgd_cau_causal` (
  `sgd_cau_codigo` decimal(4,0) NOT NULL,
  `sgd_cau_descrip` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_ciu_ciudadano`
--

CREATE TABLE IF NOT EXISTS `sgd_ciu_ciudadano` (
  `tdid_codi` decimal(2,0) DEFAULT NULL,
  `sgd_ciu_codigo` decimal(8,0) NOT NULL,
  `sgd_ciu_nombre` varchar(150) DEFAULT NULL,
  `sgd_ciu_direccion` varchar(150) DEFAULT NULL,
  `sgd_ciu_apell1` varchar(50) DEFAULT NULL,
  `sgd_ciu_apell2` varchar(50) DEFAULT NULL,
  `sgd_ciu_telefono` varchar(50) DEFAULT NULL,
  `sgd_ciu_email` varchar(50) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `sgd_ciu_cedula` varchar(13) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_clta_clstarif`
--

CREATE TABLE IF NOT EXISTS `sgd_clta_clstarif` (
  `sgd_fenv_codigo` decimal(5,0) DEFAULT NULL,
  `sgd_clta_codser` decimal(5,0) DEFAULT NULL,
  `sgd_tar_codigo` decimal(5,0) DEFAULT NULL,
  `sgd_clta_descrip` varchar(100) DEFAULT NULL,
  `sgd_clta_pesdes` decimal(15,0) DEFAULT NULL,
  `sgd_clta_peshast` decimal(15,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_cob_campobliga`
--

CREATE TABLE IF NOT EXISTS `sgd_cob_campobliga` (
  `sgd_cob_codi` decimal(4,0) NOT NULL,
  `sgd_cob_desc` varchar(150) DEFAULT NULL,
  `sgd_cob_label` varchar(50) DEFAULT NULL,
  `sgd_tidm_codi` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_dcau_causal`
--

CREATE TABLE IF NOT EXISTS `sgd_dcau_causal` (
  `sgd_dcau_codigo` decimal(4,0) NOT NULL,
  `sgd_cau_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_dcau_descrip` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_ddca_ddsgrgdo`
--

CREATE TABLE IF NOT EXISTS `sgd_ddca_ddsgrgdo` (
  `sgd_ddca_codigo` decimal(4,0) NOT NULL,
  `sgd_dcau_codigo` decimal(4,0) DEFAULT NULL,
  `par_serv_secue` decimal(8,0) DEFAULT NULL,
  `sgd_ddca_descrip` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_def_contactos`
--

CREATE TABLE IF NOT EXISTS `sgd_def_contactos` (
  `ctt_id` decimal(15,0) NOT NULL,
  `ctt_nombre` varchar(60) NOT NULL,
  `ctt_cargo` varchar(60) NOT NULL,
  `ctt_telefono` varchar(25) DEFAULT NULL,
  `ctt_id_tipo` decimal(4,0) NOT NULL,
  `ctt_id_empresa` decimal(15,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_def_continentes`
--

CREATE TABLE IF NOT EXISTS `sgd_def_continentes` (
  `id_cont` decimal(2,0) DEFAULT NULL,
  `nombre_cont` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_def_paises`
--

CREATE TABLE IF NOT EXISTS `sgd_def_paises` (
  `id_pais` decimal(4,0) DEFAULT NULL,
  `id_cont` decimal(2,0) NOT NULL,
  `nombre_pais` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_deve_dev_envio`
--

CREATE TABLE IF NOT EXISTS `sgd_deve_dev_envio` (
  `sgd_deve_codigo` decimal(2,0) NOT NULL,
  `sgd_deve_desc` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_dir_drecciones`
--

CREATE TABLE IF NOT EXISTS `sgd_dir_drecciones` (
  `sgd_dir_codigo` decimal(10,0) NOT NULL,
  `sgd_dir_tipo` decimal(4,0) NOT NULL,
  `sgd_oem_codigo` decimal(8,0) DEFAULT NULL,
  `sgd_ciu_codigo` decimal(8,0) DEFAULT NULL,
  `radi_nume_radi` decimal(15,0) DEFAULT NULL,
  `sgd_esp_codi` decimal(5,0) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(3,0) DEFAULT NULL,
  `sgd_dir_direccion` varchar(150) DEFAULT NULL,
  `sgd_dir_telefono` varchar(50) DEFAULT NULL,
  `sgd_dir_mail` varchar(50) DEFAULT NULL,
  `sgd_sec_codigo` decimal(13,0) DEFAULT NULL,
  `sgd_temporal_nombre` varchar(150) DEFAULT NULL,
  `anex_codigo` decimal(20,0) DEFAULT NULL,
  `sgd_anex_codigo` varchar(20) DEFAULT NULL,
  `sgd_dir_nombre` varchar(150) DEFAULT NULL,
  `sgd_doc_fun` varchar(14) DEFAULT NULL,
  `sgd_dir_nomremdes` varchar(1000) DEFAULT NULL,
  `sgd_trd_codigo` decimal(1,0) DEFAULT NULL,
  `sgd_dir_tdoc` decimal(1,0) DEFAULT NULL,
  `sgd_dir_doc` varchar(14) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_dnufe_docnufe`
--

CREATE TABLE IF NOT EXISTS `sgd_dnufe_docnufe` (
  `sgd_dnufe_codi` decimal(4,0) NOT NULL,
  `sgd_pnufe_codi` decimal(4,0) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_dnufe_label` varchar(150) DEFAULT NULL,
  `trte_codi` decimal(2,0) DEFAULT NULL,
  `sgd_dnufe_main` varchar(1) DEFAULT NULL,
  `sgd_dnufe_path` varchar(150) DEFAULT NULL,
  `sgd_dnufe_gerarq` varchar(10) DEFAULT NULL,
  `anex_tipo_codi` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_dt_radicado`
--

CREATE TABLE IF NOT EXISTS `sgd_dt_radicado` (
  `radi_nume_radi` decimal(14,0) NOT NULL,
  `dias_termino` decimal(2,0) NOT NULL,
  PRIMARY KEY (`radi_nume_radi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_eanu_estanulacion`
--

CREATE TABLE IF NOT EXISTS `sgd_eanu_estanulacion` (
  `sgd_eanu_desc` varchar(150) DEFAULT NULL,
  `sgd_eanu_codi` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_einv_inventario`
--

CREATE TABLE IF NOT EXISTS `sgd_einv_inventario` (
  `sgd_einv_codigo` decimal(21,6) NOT NULL,
  `sgd_depe_nomb` varchar(400) DEFAULT NULL,
  `sgd_depe_codi` varchar(3) DEFAULT NULL,
  `sgd_einv_expnum` varchar(18) DEFAULT NULL,
  `sgd_einv_titulo` varchar(400) DEFAULT NULL,
  `sgd_einv_unidad` decimal(21,6) DEFAULT NULL,
  `sgd_einv_fech` date DEFAULT NULL,
  `sgd_einv_fechfin` date DEFAULT NULL,
  `sgd_einv_radicados` varchar(40) DEFAULT NULL,
  `sgd_einv_folios` decimal(21,6) DEFAULT NULL,
  `sgd_einv_nundocu` decimal(21,6) DEFAULT NULL,
  `sgd_einv_nundocubodega` decimal(21,6) DEFAULT NULL,
  `sgd_einv_caja` decimal(21,6) DEFAULT NULL,
  `sgd_einv_cajabodega` decimal(21,6) DEFAULT NULL,
  `sgd_einv_srd` decimal(21,6) DEFAULT NULL,
  `sgd_einv_nomsrd` varchar(400) DEFAULT NULL,
  `sgd_einv_sbrd` decimal(21,6) DEFAULT NULL,
  `sgd_einv_nomsbrd` varchar(400) DEFAULT NULL,
  `sgd_einv_retencion` varchar(400) DEFAULT NULL,
  `sgd_einv_disfinal` varchar(400) DEFAULT NULL,
  `sgd_einv_ubicacion` varchar(400) DEFAULT NULL,
  `sgd_einv_observacion` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`sgd_einv_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_eit_items`
--

CREATE TABLE IF NOT EXISTS `sgd_eit_items` (
  `sgd_eit_codigo` decimal(21,6) NOT NULL,
  `sgd_eit_cod_padre` decimal(21,6) DEFAULT NULL,
  `sgd_eit_nombre` varchar(40) DEFAULT NULL,
  `sgd_eit_sigla` varchar(6) DEFAULT NULL,
  `codi_dpto` decimal(4,0) DEFAULT NULL,
  `codi_muni` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`sgd_eit_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_eje_tema`
--

CREATE TABLE IF NOT EXISTS `sgd_eje_tema` (
  `sgd_tema_codigo` varchar(10) NOT NULL,
  `sgd_tema_nomb` varchar(150) NOT NULL,
  `sgd_tema_desc` varchar(350) NOT NULL,
  `sgd_tema_plazo` decimal(2,0) DEFAULT NULL,
  `sgd_tema_tpplazo` varchar(50) DEFAULT NULL,
  `sgd_tema_estado` decimal(2,0) NOT NULL,
  `sgd_tema_depe` decimal(5,0) NOT NULL,
  PRIMARY KEY (`sgd_tema_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_empus_empusuario`
--

CREATE TABLE IF NOT EXISTS `sgd_empus_empusuario` (
  `usua_login` varchar(10) DEFAULT NULL,
  `identificador_empresa` decimal(10,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_ent_entidades`
--

CREATE TABLE IF NOT EXISTS `sgd_ent_entidades` (
  `sgd_ent_nit` varchar(13) NOT NULL,
  `sgd_ent_codsuc` varchar(4) NOT NULL,
  `sgd_ent_pias` decimal(5,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `sgd_ent_descrip` varchar(80) DEFAULT NULL,
  `sgd_ent_direccion` varchar(50) DEFAULT NULL,
  `sgd_ent_telefono` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_enve_envioespecial`
--

CREATE TABLE IF NOT EXISTS `sgd_enve_envioespecial` (
  `sgd_fenv_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_enve_valorl` varchar(30) DEFAULT NULL,
  `sgd_enve_valorn` varchar(30) DEFAULT NULL,
  `sgd_enve_desc` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_estc_estconsolid`
--

CREATE TABLE IF NOT EXISTS `sgd_estc_estconsolid` (
  `sgd_estc_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(21,6) DEFAULT NULL,
  `dep_nombre` varchar(30) DEFAULT NULL,
  `depe_codi` decimal(21,6) DEFAULT NULL,
  `sgd_estc_ctotal` decimal(21,6) DEFAULT NULL,
  `sgd_estc_centramite` decimal(21,6) DEFAULT NULL,
  `sgd_estc_csinriesgo` decimal(21,6) DEFAULT NULL,
  `sgd_estc_criesgomedio` decimal(21,6) DEFAULT NULL,
  `sgd_estc_criesgoalto` decimal(21,6) DEFAULT NULL,
  `sgd_estc_ctramitados` decimal(21,6) DEFAULT NULL,
  `sgd_estc_centermino` decimal(21,6) DEFAULT NULL,
  `sgd_estc_cfueratermino` decimal(21,6) DEFAULT NULL,
  `sgd_estc_fechgen` date DEFAULT NULL,
  `sgd_estc_fechini` date DEFAULT NULL,
  `sgd_estc_fechfin` date DEFAULT NULL,
  `sgd_estc_fechiniresp` date DEFAULT NULL,
  `sgd_estc_fechfinresp` date DEFAULT NULL,
  `sgd_estc_dsinriesgo` decimal(21,6) DEFAULT NULL,
  `sgd_estc_driesgomegio` decimal(21,6) DEFAULT NULL,
  `sgd_estc_driesgoalto` decimal(21,6) DEFAULT NULL,
  `sgd_estc_dtermino` decimal(21,6) DEFAULT NULL,
  `sgd_estc_grupgenerado` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_estinst_estadoinstancia`
--

CREATE TABLE IF NOT EXISTS `sgd_estinst_estadoinstancia` (
  `sgd_estinst_codi` decimal(4,0) DEFAULT NULL,
  `sgd_apli_codi` decimal(4,0) DEFAULT NULL,
  `sgd_instorf_codi` decimal(4,0) DEFAULT NULL,
  `sgd_estinst_valor` decimal(4,0) DEFAULT NULL,
  `sgd_estinst_habilita` decimal(1,0) DEFAULT NULL,
  `sgd_estinst_mensaje` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_exp_expediente`
--

CREATE TABLE IF NOT EXISTS `sgd_exp_expediente` (
  `sgd_exp_numero` varchar(18) DEFAULT NULL,
  `radi_nume_radi` decimal(18,0) DEFAULT NULL,
  `sgd_exp_fech` date DEFAULT NULL,
  `sgd_exp_fech_mod` date DEFAULT NULL,
  `depe_codi` decimal(4,0) DEFAULT NULL,
  `usua_codi` decimal(3,0) DEFAULT NULL,
  `usua_doc` varchar(15) DEFAULT NULL,
  `sgd_exp_estado` decimal(1,0) DEFAULT NULL,
  `sgd_exp_titulo` varchar(50) DEFAULT NULL,
  `sgd_exp_asunto` varchar(150) DEFAULT NULL,
  `sgd_exp_carpeta` varchar(30) DEFAULT NULL,
  `sgd_exp_ufisica` varchar(20) DEFAULT NULL,
  `sgd_exp_isla` varchar(10) DEFAULT NULL,
  `sgd_exp_estante` varchar(10) DEFAULT NULL,
  `sgd_exp_caja` varchar(10) DEFAULT NULL,
  `sgd_exp_fech_arch` date DEFAULT NULL,
  `sgd_srd_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_sbrd_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_fexp_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_exp_subexpediente` varchar(20) DEFAULT NULL,
  `sgd_exp_archivo` decimal(1,0) DEFAULT NULL,
  `sgd_exp_unicon` decimal(1,0) DEFAULT NULL,
  `sgd_exp_fechfin` date DEFAULT NULL,
  `sgd_exp_folios` varchar(6) DEFAULT NULL,
  `sgd_exp_rete` decimal(2,0) DEFAULT NULL,
  `sgd_exp_entrepa` decimal(6,0) DEFAULT NULL,
  `radi_usua_arch` varchar(40) DEFAULT NULL,
  `sgd_exp_edificio` varchar(400) DEFAULT NULL,
  `sgd_exp_caja_bodega` varchar(40) DEFAULT NULL,
  `sgd_exp_carro` varchar(40) DEFAULT NULL,
  `sgd_exp_carpeta_bodega` varchar(40) DEFAULT NULL,
  `sgd_exp_privado` decimal(1,0) DEFAULT NULL,
  `sgd_exp_cd` varchar(10) DEFAULT NULL,
  `sgd_exp_nref` varchar(7) DEFAULT NULL,
  `sgd_sexp_paraexp1` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_fars_faristas`
--

CREATE TABLE IF NOT EXISTS `sgd_fars_faristas` (
  `sgd_fars_codigo` decimal(5,0) NOT NULL,
  `sgd_pexp_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_fexp_codigoini` decimal(6,0) DEFAULT NULL,
  `sgd_fexp_codigofin` decimal(6,0) DEFAULT NULL,
  `sgd_fars_diasminimo` decimal(3,0) DEFAULT NULL,
  `sgd_fars_diasmaximo` decimal(3,0) DEFAULT NULL,
  `sgd_fars_desc` varchar(100) DEFAULT NULL,
  `sgd_trad_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_srd_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_sbrd_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_fars_tipificacion` decimal(1,0) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_fars_automatico` decimal(21,6) DEFAULT NULL,
  `sgd_fars_rolgeneral` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_fenv_frmenvio`
--

CREATE TABLE IF NOT EXISTS `sgd_fenv_frmenvio` (
  `sgd_fenv_codigo` decimal(5,0) NOT NULL,
  `sgd_fenv_descrip` varchar(40) DEFAULT NULL,
  `sgd_fenv_planilla` decimal(1,0) NOT NULL,
  `sgd_fenv_estado` decimal(1,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_fexp_flujoexpedientes`
--

CREATE TABLE IF NOT EXISTS `sgd_fexp_flujoexpedientes` (
  `sgd_fexp_codigo` decimal(6,0) DEFAULT NULL,
  `sgd_pexp_codigo` decimal(6,0) DEFAULT NULL,
  `sgd_fexp_orden` decimal(4,0) DEFAULT NULL,
  `sgd_fexp_terminos` decimal(4,0) DEFAULT NULL,
  `sgd_fexp_imagen` varchar(50) DEFAULT NULL,
  `sgd_fexp_descrip` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_firrad_firmarads`
--

CREATE TABLE IF NOT EXISTS `sgd_firrad_firmarads` (
  `sgd_firrad_id` decimal(15,0) NOT NULL,
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `usua_doc` varchar(14) NOT NULL,
  `sgd_firrad_firma` varchar(255) DEFAULT NULL,
  `sgd_firrad_fecha` date DEFAULT NULL,
  `sgd_firrad_docsolic` varchar(14) NOT NULL,
  `sgd_firrad_fechsolic` date NOT NULL,
  `sgd_firrad_pk` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_fld_flujodoc`
--

CREATE TABLE IF NOT EXISTS `sgd_fld_flujodoc` (
  `sgd_fld_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_fld_desc` varchar(100) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_fld_imagen` varchar(50) DEFAULT NULL,
  `sgd_fld_grupoweb` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_fun_funciones`
--

CREATE TABLE IF NOT EXISTS `sgd_fun_funciones` (
  `sgd_fun_codigo` decimal(4,0) NOT NULL,
  `sgd_fun_descrip` varchar(530) DEFAULT NULL,
  `sgd_fun_fech_ini` date DEFAULT NULL,
  `sgd_fun_fech_fin` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_hfld_histflujodoc`
--

CREATE TABLE IF NOT EXISTS `sgd_hfld_histflujodoc` (
  `sgd_hfld_codigo` decimal(6,0) DEFAULT NULL,
  `sgd_fexp_codigo` decimal(3,0) NOT NULL,
  `sgd_exp_fechflujoant` date DEFAULT NULL,
  `sgd_hfld_fech` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `sgd_exp_numero` varchar(18) DEFAULT NULL,
  `radi_nume_radi` decimal(15,0) DEFAULT NULL,
  `usua_doc` varchar(10) DEFAULT NULL,
  `usua_codi` decimal(10,0) DEFAULT NULL,
  `depe_codi` decimal(4,0) DEFAULT NULL,
  `sgd_ttr_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_fexp_observa` varchar(500) DEFAULT NULL,
  `sgd_hfld_observa` varchar(500) DEFAULT NULL,
  `sgd_fars_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_hfld_automatico` decimal(21,6) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_hmtd_hismatdoc`
--

CREATE TABLE IF NOT EXISTS `sgd_hmtd_hismatdoc` (
  `sgd_hmtd_codigo` decimal(6,0) NOT NULL,
  `sgd_hmtd_fecha` date NOT NULL,
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `usua_codi` decimal(10,0) NOT NULL,
  `sgd_hmtd_obse` varchar(600) NOT NULL,
  `usua_doc` decimal(13,0) DEFAULT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_mtd_codigo` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_instorf_instanciasorfeo`
--

CREATE TABLE IF NOT EXISTS `sgd_instorf_instanciasorfeo` (
  `sgd_instorf_codi` decimal(4,0) DEFAULT NULL,
  `sgd_instorf_desc` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_lip_linkip`
--

CREATE TABLE IF NOT EXISTS `sgd_lip_linkip` (
  `sgd_lip_id` decimal(4,0) NOT NULL,
  `sgd_lip_ipini` varchar(20) NOT NULL,
  `sgd_lip_ipfin` varchar(20) DEFAULT NULL,
  `sgd_lip_dirintranet` varchar(150) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `sgd_lip_arch` varchar(70) DEFAULT NULL,
  `sgd_lip_diascache` decimal(5,0) DEFAULT NULL,
  `sgd_lip_rutaftp` varchar(150) DEFAULT NULL,
  `sgd_lip_servftp` varchar(50) DEFAULT NULL,
  `sgd_lip_usbd` varchar(20) DEFAULT NULL,
  `sgd_lip_nombd` varchar(20) DEFAULT NULL,
  `sgd_lip_pwdbd` varchar(20) DEFAULT NULL,
  `sgd_lip_usftp` varchar(20) DEFAULT NULL,
  `sgd_lip_pwdftp` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_mat_matriz`
--

CREATE TABLE IF NOT EXISTS `sgd_mat_matriz` (
  `sgd_mat_codigo` decimal(4,0) NOT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_fun_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_prc_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_prd_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_mat_fech_ini` date DEFAULT NULL,
  `sgd_mat_fech_fin` date DEFAULT NULL,
  `sgd_mat_peso_prd` decimal(5,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_mpes_mddpeso`
--

CREATE TABLE IF NOT EXISTS `sgd_mpes_mddpeso` (
  `sgd_mpes_codigo` decimal(5,0) NOT NULL,
  `sgd_mpes_descrip` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_mrd_matrird`
--

CREATE TABLE IF NOT EXISTS `sgd_mrd_matrird` (
  `sgd_mrd_codigo` decimal(4,0) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `sgd_srd_codigo` decimal(4,0) NOT NULL,
  `sgd_sbrd_codigo` decimal(4,0) NOT NULL,
  `sgd_tpr_codigo` decimal(4,0) NOT NULL,
  `soporte` varchar(10) DEFAULT NULL,
  `sgd_mrd_fechini` date DEFAULT NULL,
  `sgd_mrd_fechfin` date DEFAULT NULL,
  `sgd_mrd_esta` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_msdep_msgdep`
--

CREATE TABLE IF NOT EXISTS `sgd_msdep_msgdep` (
  `sgd_msdep_codi` decimal(15,0) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `sgd_msg_codi` decimal(15,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_msg_mensaje`
--

CREATE TABLE IF NOT EXISTS `sgd_msg_mensaje` (
  `sgd_msg_codi` decimal(15,0) NOT NULL,
  `sgd_tme_codi` decimal(3,0) NOT NULL,
  `sgd_msg_desc` varchar(150) DEFAULT NULL,
  `sgd_msg_fechdesp` date NOT NULL,
  `sgd_msg_url` varchar(150) NOT NULL,
  `sgd_msg_veces` decimal(3,0) NOT NULL,
  `sgd_msg_ancho` decimal(6,0) NOT NULL,
  `sgd_msg_largo` decimal(6,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_mtd_matriz_doc`
--

CREATE TABLE IF NOT EXISTS `sgd_mtd_matriz_doc` (
  `sgd_mtd_codigo` decimal(4,0) NOT NULL,
  `sgd_mat_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_noh_nohabiles`
--

CREATE TABLE IF NOT EXISTS `sgd_noh_nohabiles` (
  `noh_fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_not_notificacion`
--

CREATE TABLE IF NOT EXISTS `sgd_not_notificacion` (
  `sgd_not_codi` decimal(3,0) NOT NULL,
  `sgd_not_descrip` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_ntrd_notifrad`
--

CREATE TABLE IF NOT EXISTS `sgd_ntrd_notifrad` (
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `sgd_not_codi` decimal(3,0) NOT NULL,
  `sgd_ntrd_notificador` varchar(150) DEFAULT NULL,
  `sgd_ntrd_notificado` varchar(150) DEFAULT NULL,
  `sgd_ntrd_fecha_not` date DEFAULT NULL,
  `sgd_ntrd_num_edicto` decimal(6,0) DEFAULT NULL,
  `sgd_ntrd_fecha_fija` date DEFAULT NULL,
  `sgd_ntrd_fecha_desfija` date DEFAULT NULL,
  `sgd_ntrd_observaciones` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_oem_oempresas`
--

CREATE TABLE IF NOT EXISTS `sgd_oem_oempresas` (
  `sgd_oem_codigo` decimal(8,0) NOT NULL,
  `tdid_codi` decimal(2,0) DEFAULT NULL,
  `sgd_oem_oempresa` varchar(300) DEFAULT NULL,
  `sgd_oem_rep_legal` varchar(300) DEFAULT NULL,
  `sgd_oem_nit` varchar(14) DEFAULT NULL,
  `sgd_oem_sigla` varchar(1000) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `sgd_oem_direccion` varchar(1000) DEFAULT NULL,
  `sgd_oem_telefono` varchar(1000) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `email` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_panu_peranulados`
--

CREATE TABLE IF NOT EXISTS `sgd_panu_peranulados` (
  `sgd_panu_codi` decimal(4,0) DEFAULT NULL,
  `sgd_panu_desc` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_parametro`
--

CREATE TABLE IF NOT EXISTS `sgd_parametro` (
  `param_nomb` varchar(25) NOT NULL,
  `param_codi` decimal(5,0) NOT NULL,
  `param_valor` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_parexp_paramexpediente`
--

CREATE TABLE IF NOT EXISTS `sgd_parexp_paramexpediente` (
  `sgd_parexp_codigo` decimal(4,0) NOT NULL,
  `depe_codi` decimal(4,0) NOT NULL,
  `sgd_parexp_tabla` varchar(30) NOT NULL,
  `sgd_parexp_etiqueta` varchar(15) NOT NULL,
  `sgd_parexp_orden` decimal(1,0) DEFAULT NULL,
  `sgd_parexp_editable` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_pen_pensionados`
--

CREATE TABLE IF NOT EXISTS `sgd_pen_pensionados` (
  `tdid_codi` decimal(2,0) DEFAULT NULL,
  `sgd_ciu_codigo` decimal(8,0) NOT NULL,
  `sgd_ciu_nombre` varchar(150) DEFAULT NULL,
  `sgd_ciu_direccion` varchar(150) DEFAULT NULL,
  `sgd_ciu_apell1` varchar(50) DEFAULT NULL,
  `sgd_ciu_apell2` varchar(50) DEFAULT NULL,
  `sgd_ciu_telefono` varchar(50) DEFAULT NULL,
  `sgd_ciu_email` varchar(50) DEFAULT NULL,
  `muni_codi` decimal(4,0) DEFAULT NULL,
  `dpto_codi` decimal(2,0) DEFAULT NULL,
  `sgd_ciu_cedula` varchar(20) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_pexp_procexpedientes`
--

CREATE TABLE IF NOT EXISTS `sgd_pexp_procexpedientes` (
  `sgd_pexp_codigo` decimal(21,6) NOT NULL,
  `sgd_pexp_descrip` varchar(100) DEFAULT NULL,
  `sgd_pexp_terminos` decimal(21,6) DEFAULT NULL,
  `sgd_srd_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_sbrd_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_pexp_automatico` decimal(1,0) DEFAULT NULL,
  `sgd_pexp_tieneflujo` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_pnufe_procnumfe`
--

CREATE TABLE IF NOT EXISTS `sgd_pnufe_procnumfe` (
  `sgd_pnufe_codi` decimal(4,0) NOT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_pnufe_descrip` varchar(150) DEFAULT NULL,
  `sgd_pnufe_serie` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_pnun_procenum`
--

CREATE TABLE IF NOT EXISTS `sgd_pnun_procenum` (
  `sgd_pnun_codi` decimal(4,0) NOT NULL,
  `sgd_pnufe_codi` decimal(4,0) DEFAULT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_pnun_prepone` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_prc_proceso`
--

CREATE TABLE IF NOT EXISTS `sgd_prc_proceso` (
  `sgd_prc_codigo` decimal(4,0) NOT NULL,
  `sgd_prc_descrip` varchar(150) DEFAULT NULL,
  `sgd_prc_fech_ini` date DEFAULT NULL,
  `sgd_prc_fech_fin` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_prd_prcdmentos`
--

CREATE TABLE IF NOT EXISTS `sgd_prd_prcdmentos` (
  `sgd_prd_codigo` decimal(4,0) NOT NULL,
  `sgd_prd_descrip` varchar(200) DEFAULT NULL,
  `sgd_prd_fech_ini` date DEFAULT NULL,
  `sgd_prd_fech_fin` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_rda_retdoca`
--

CREATE TABLE IF NOT EXISTS `sgd_rda_retdoca` (
  `anex_radi_nume` decimal(15,0) NOT NULL,
  `anex_codigo` varchar(20) NOT NULL,
  `radi_nume_salida` decimal(15,0) DEFAULT NULL,
  `anex_borrado` varchar(1) DEFAULT NULL,
  `sgd_mrd_codigo` decimal(4,0) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `usua_codi` decimal(10,0) NOT NULL,
  `usua_doc` varchar(14) NOT NULL,
  `sgd_rda_fech` date DEFAULT NULL,
  `sgd_deve_codigo` decimal(2,0) DEFAULT NULL,
  `anex_solo_lect` varchar(1) DEFAULT NULL,
  `anex_radi_fech` date DEFAULT NULL,
  `anex_estado` decimal(1,0) DEFAULT NULL,
  `anex_nomb_archivo` varchar(50) DEFAULT NULL,
  `anex_tipo` decimal(4,0) DEFAULT NULL,
  `sgd_dir_tipo` decimal(4,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_rdf_retdocf`
--

CREATE TABLE IF NOT EXISTS `sgd_rdf_retdocf` (
  `sgd_mrd_codigo` decimal(4,0) NOT NULL,
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `usua_codi` decimal(10,0) NOT NULL,
  `usua_doc` varchar(14) NOT NULL,
  `sgd_rdf_fech` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_renv_regenvio`
--

CREATE TABLE IF NOT EXISTS `sgd_renv_regenvio` (
  `sgd_renv_codigo` decimal(21,6) NOT NULL,
  `sgd_fenv_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_renv_fech` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `radi_nume_sal` decimal(21,6) DEFAULT NULL,
  `sgd_renv_destino` varchar(255) DEFAULT NULL,
  `sgd_renv_telefono` varchar(255) DEFAULT NULL,
  `sgd_renv_mail` varchar(255) DEFAULT NULL,
  `sgd_renv_peso` varchar(255) DEFAULT NULL,
  `sgd_renv_valor` decimal(21,6) DEFAULT NULL,
  `sgd_renv_certificado` decimal(21,6) DEFAULT NULL,
  `sgd_renv_estado` decimal(21,6) DEFAULT NULL,
  `usua_doc` decimal(21,6) DEFAULT NULL,
  `sgd_renv_nombre` varchar(255) DEFAULT NULL,
  `sgd_rem_destino` decimal(21,6) DEFAULT NULL,
  `sgd_dir_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_renv_planilla` varchar(8) DEFAULT NULL,
  `sgd_renv_fech_sal` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_dir_tipo` decimal(4,0) DEFAULT NULL,
  `radi_nume_grupo` decimal(14,0) DEFAULT NULL,
  `sgd_renv_dir` varchar(100) DEFAULT NULL,
  `sgd_renv_depto` varchar(30) DEFAULT NULL,
  `sgd_renv_mpio` varchar(30) DEFAULT NULL,
  `sgd_renv_tel` varchar(20) DEFAULT NULL,
  `sgd_renv_cantidad` decimal(4,0) DEFAULT NULL,
  `sgd_renv_tipo` decimal(1,0) DEFAULT NULL,
  `sgd_renv_observa` varchar(200) DEFAULT NULL,
  `sgd_renv_grupo` decimal(14,0) DEFAULT NULL,
  `sgd_deve_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_deve_fech` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sgd_renv_valortotal` varchar(14) DEFAULT NULL,
  `sgd_renv_valistamiento` varchar(10) DEFAULT NULL,
  `sgd_renv_vdescuento` varchar(10) DEFAULT NULL,
  `sgd_renv_vadicional` varchar(14) DEFAULT NULL,
  `sgd_depe_genera` decimal(5,0) DEFAULT NULL,
  `sgd_renv_pais` varchar(30) DEFAULT NULL,
  `sgd_renv_guia` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_renv_regenvio1`
--

CREATE TABLE IF NOT EXISTS `sgd_renv_regenvio1` (
  `sgd_renv_codigo` decimal(6,0) NOT NULL,
  `sgd_fenv_codigo` decimal(5,0) DEFAULT NULL,
  `sgd_renv_fech` date DEFAULT NULL,
  `radi_nume_sal` decimal(14,0) DEFAULT NULL,
  `sgd_renv_destino` varchar(150) DEFAULT NULL,
  `sgd_renv_telefono` varchar(50) DEFAULT NULL,
  `sgd_renv_mail` varchar(150) DEFAULT NULL,
  `sgd_renv_peso` varchar(10) DEFAULT NULL,
  `sgd_renv_valor` varchar(10) DEFAULT NULL,
  `sgd_renv_certificado` decimal(1,0) DEFAULT NULL,
  `sgd_renv_estado` decimal(1,0) DEFAULT NULL,
  `usua_doc` decimal(15,0) DEFAULT NULL,
  `sgd_renv_nombre` varchar(100) DEFAULT NULL,
  `sgd_rem_destino` decimal(1,0) DEFAULT NULL,
  `sgd_dir_codigo` decimal(10,0) DEFAULT NULL,
  `sgd_renv_planilla` varchar(8) DEFAULT NULL,
  `sgd_renv_fech_sal` date DEFAULT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_dir_tipo` decimal(4,0) DEFAULT NULL,
  `radi_nume_grupo` decimal(14,0) DEFAULT NULL,
  `sgd_renv_dir` varchar(100) DEFAULT NULL,
  `sgd_renv_depto` varchar(30) DEFAULT NULL,
  `sgd_renv_mpio` varchar(30) DEFAULT NULL,
  `sgd_renv_tel` varchar(20) DEFAULT NULL,
  `sgd_renv_cantidad` decimal(4,0) DEFAULT NULL,
  `sgd_renv_tipo` decimal(1,0) DEFAULT NULL,
  `sgd_renv_observa` varchar(200) DEFAULT NULL,
  `sgd_renv_grupo` decimal(14,0) DEFAULT NULL,
  `sgd_deve_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_deve_fech` date DEFAULT NULL,
  `sgd_renv_valortotal` varchar(14) DEFAULT NULL,
  `sgd_renv_valistamiento` varchar(10) DEFAULT NULL,
  `sgd_renv_vdescuento` varchar(10) DEFAULT NULL,
  `sgd_renv_vadicional` varchar(14) DEFAULT NULL,
  `sgd_depe_genera` decimal(5,0) DEFAULT NULL,
  `sgd_renv_pais` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_rfax_reservafax`
--

CREATE TABLE IF NOT EXISTS `sgd_rfax_reservafax` (
  `sgd_rfax_codigo` decimal(10,0) DEFAULT NULL,
  `sgd_rfax_fax` varchar(30) DEFAULT NULL,
  `usua_login` varchar(30) DEFAULT NULL,
  `sgd_rfax_fech` date DEFAULT NULL,
  `sgd_rfax_fechradi` date DEFAULT NULL,
  `radi_nume_radi` decimal(15,0) DEFAULT NULL,
  `sgd_rfax_observa` varchar(500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_rmr_radmasivre`
--

CREATE TABLE IF NOT EXISTS `sgd_rmr_radmasivre` (
  `sgd_rmr_grupo` decimal(15,0) NOT NULL,
  `sgd_rmr_radi` decimal(15,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_san_sancionados`
--

CREATE TABLE IF NOT EXISTS `sgd_san_sancionados` (
  `sgd_san_ref` varchar(20) NOT NULL,
  `sgd_san_decision` varchar(60) DEFAULT NULL,
  `sgd_san_cargo` varchar(50) DEFAULT NULL,
  `sgd_san_expediente` varchar(20) DEFAULT NULL,
  `sgd_san_tipo_sancion` varchar(50) DEFAULT NULL,
  `sgd_san_plazo` varchar(100) DEFAULT NULL,
  `sgd_san_valor` decimal(14,2) DEFAULT NULL,
  `sgd_san_radicacion` varchar(15) DEFAULT NULL,
  `sgd_san_fecha_radicado` date DEFAULT NULL,
  `sgd_san_valorletras` varchar(1000) DEFAULT NULL,
  `sgd_san_nombreempresa` varchar(160) DEFAULT NULL,
  `sgd_san_motivos` varchar(160) DEFAULT NULL,
  `sgd_san_sectores` varchar(160) DEFAULT NULL,
  `sgd_san_padre` varchar(15) DEFAULT NULL,
  `sgd_san_fecha_padre` date DEFAULT NULL,
  `sgd_san_notificado` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_san_sancionados_x`
--

CREATE TABLE IF NOT EXISTS `sgd_san_sancionados_x` (
  `radi_nume_radi` decimal(15,0) NOT NULL,
  `sgd_san_decision` varchar(60) DEFAULT NULL,
  `sgd_san_cargo` varchar(50) DEFAULT NULL,
  `sgd_san_expediente` varchar(15) DEFAULT NULL,
  `sgd_san_tipo_sancion` varchar(50) DEFAULT NULL,
  `sgd_san_plazo` varchar(100) DEFAULT NULL,
  `sgd_san_valor` decimal(14,2) DEFAULT NULL,
  `sgd_san_radicacion` varchar(15) DEFAULT NULL,
  `sgd_san_fecha_radicado` date DEFAULT NULL,
  `sgd_san_valorletras` varchar(1000) DEFAULT NULL,
  `sgd_san_nombreempresa` varchar(160) DEFAULT NULL,
  `sgd_san_motivos` varchar(160) DEFAULT NULL,
  `sgd_san_sectores` varchar(160) DEFAULT NULL,
  `sgd_san_padre` varchar(15) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_sbrd_subserierd`
--

CREATE TABLE IF NOT EXISTS `sgd_sbrd_subserierd` (
  `sgd_srd_codigo` decimal(4,0) NOT NULL,
  `sgd_sbrd_codigo` decimal(4,0) NOT NULL,
  `sgd_sbrd_descrip` varchar(500) NOT NULL,
  `sgd_sbrd_fechini` date NOT NULL,
  `sgd_sbrd_fechfin` date NOT NULL,
  `sgd_sbrd_tiemag` decimal(4,0) DEFAULT NULL,
  `sgd_sbrd_tiemac` decimal(4,0) DEFAULT NULL,
  `sgd_sbrd_dispfin` varchar(50) DEFAULT NULL,
  `sgd_sbrd_soporte` varchar(50) DEFAULT NULL,
  `sgd_sbrd_procedi` varchar(1500) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_sed_sede`
--

CREATE TABLE IF NOT EXISTS `sgd_sed_sede` (
  `sgd_sed_codi` decimal(4,0) NOT NULL,
  `sgd_sed_desc` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_senuf_secnumfe`
--

CREATE TABLE IF NOT EXISTS `sgd_senuf_secnumfe` (
  `sgd_senuf_codi` decimal(4,0) NOT NULL,
  `sgd_pnufe_codi` decimal(4,0) DEFAULT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_senuf_sec` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_sexp_secexpedientes`
--

CREATE TABLE IF NOT EXISTS `sgd_sexp_secexpedientes` (
  `sgd_exp_numero` varchar(18) NOT NULL,
  `sgd_srd_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_sbrd_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_sexp_secuencia` decimal(21,6) DEFAULT NULL,
  `depe_codi` decimal(21,6) DEFAULT NULL,
  `usua_doc` varchar(15) DEFAULT NULL,
  `sgd_sexp_fech` date DEFAULT NULL,
  `sgd_fexp_codigo` decimal(21,6) DEFAULT NULL,
  `sgd_sexp_ano` decimal(21,6) DEFAULT NULL,
  `usua_doc_responsable` varchar(18) DEFAULT NULL,
  `sgd_sexp_parexp1` varchar(250) DEFAULT NULL,
  `sgd_sexp_parexp2` varchar(160) DEFAULT NULL,
  `sgd_sexp_parexp3` varchar(160) DEFAULT NULL,
  `sgd_sexp_parexp4` varchar(160) DEFAULT NULL,
  `sgd_sexp_parexp5` varchar(160) DEFAULT NULL,
  `sgd_pexp_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_exp_fech_arch` date DEFAULT NULL,
  `sgd_fld_codigo` decimal(3,0) DEFAULT NULL,
  `sgd_exp_fechflujoant` date DEFAULT NULL,
  `sgd_mrd_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_exp_subexpediente` decimal(18,0) DEFAULT NULL,
  `sgd_exp_privado` decimal(1,0) DEFAULT NULL,
  `sgd_sexp_estado` decimal(1,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_srd_seriesrd`
--

CREATE TABLE IF NOT EXISTS `sgd_srd_seriesrd` (
  `sgd_srd_codigo` decimal(4,0) NOT NULL,
  `sgd_srd_descrip` varchar(60) NOT NULL,
  `sgd_srd_fechini` date NOT NULL,
  `sgd_srd_fechfin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tar_tarifas`
--

CREATE TABLE IF NOT EXISTS `sgd_tar_tarifas` (
  `sgd_fenv_codigo` decimal(5,0) DEFAULT NULL,
  `sgd_tar_codser` decimal(5,0) DEFAULT NULL,
  `sgd_tar_codigo` decimal(5,0) DEFAULT NULL,
  `sgd_tar_valenv1` decimal(15,0) DEFAULT NULL,
  `sgd_tar_valenv2` decimal(15,0) DEFAULT NULL,
  `sgd_tar_valenv1g1` decimal(15,0) DEFAULT NULL,
  `sgd_clta_codser` decimal(5,0) DEFAULT NULL,
  `sgd_tar_valenv2g2` decimal(15,0) DEFAULT NULL,
  `sgd_clta_descrip` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tdec_tipodecision`
--

CREATE TABLE IF NOT EXISTS `sgd_tdec_tipodecision` (
  `sgd_apli_codi` decimal(4,0) NOT NULL,
  `sgd_tdec_codigo` decimal(4,0) NOT NULL,
  `sgd_tdec_descrip` varchar(150) DEFAULT NULL,
  `sgd_tdec_sancionar` decimal(1,0) DEFAULT NULL,
  `sgd_tdec_firmeza` decimal(1,0) DEFAULT NULL,
  `sgd_tdec_versancion` decimal(1,0) DEFAULT NULL,
  `sgd_tdec_showmenu` decimal(1,0) DEFAULT NULL,
  `sgd_tdec_updnotif` decimal(1,0) DEFAULT NULL,
  `sgd_tdec_veragota` decimal(1,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tidm_tidocmasiva`
--

CREATE TABLE IF NOT EXISTS `sgd_tidm_tidocmasiva` (
  `sgd_tidm_codi` decimal(4,0) NOT NULL,
  `sgd_tidm_desc` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tid_tipdecision`
--

CREATE TABLE IF NOT EXISTS `sgd_tid_tipdecision` (
  `sgd_tid_codi` decimal(4,0) NOT NULL,
  `sgd_tid_desc` varchar(150) DEFAULT NULL,
  `sgd_tpr_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_pexp_codigo` decimal(2,0) DEFAULT NULL,
  `sgd_tpr_codigop` decimal(2,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tip3_tipotercero`
--

CREATE TABLE IF NOT EXISTS `sgd_tip3_tipotercero` (
  `sgd_tip3_codigo` decimal(2,0) NOT NULL,
  `sgd_dir_tipo` decimal(4,0) DEFAULT NULL,
  `sgd_tip3_nombre` varchar(15) DEFAULT NULL,
  `sgd_tip3_desc` varchar(30) DEFAULT NULL,
  `sgd_tip3_imgpestana` varchar(20) DEFAULT NULL,
  `sgd_tpr_tp1` decimal(1,0) DEFAULT NULL,
  `sgd_tpr_tp2` decimal(1,0) DEFAULT NULL,
  `sgd_tpr_tp4` int(11) DEFAULT NULL,
  `sgd_tpr_tp3` int(11) DEFAULT NULL,
  `sgd_tpr_tp5` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tma_temas`
--

CREATE TABLE IF NOT EXISTS `sgd_tma_temas` (
  `sgd_tma_codigo` decimal(4,0) NOT NULL,
  `depe_codi` decimal(5,0) DEFAULT NULL,
  `sgd_prc_codigo` decimal(4,0) DEFAULT NULL,
  `sgd_tma_descrip` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tme_tipmen`
--

CREATE TABLE IF NOT EXISTS `sgd_tme_tipmen` (
  `sgd_tme_codi` decimal(3,0) NOT NULL,
  `sgd_tme_desc` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tpr_tpdcumento`
--

CREATE TABLE IF NOT EXISTS `sgd_tpr_tpdcumento` (
  `sgd_tpr_codigo` decimal(4,0) NOT NULL,
  `sgd_tpr_descrip` varchar(500) DEFAULT NULL,
  `sgd_tpr_termino` decimal(4,0) DEFAULT NULL,
  `sgd_tpr_tpuso` decimal(1,0) DEFAULT NULL,
  `sgd_tpr_numera` char(1) DEFAULT NULL,
  `sgd_tpr_radica` char(1) DEFAULT NULL,
  `sgd_tpr_tp1` decimal(1,0) DEFAULT NULL,
  `sgd_tpr_tp2` decimal(1,0) DEFAULT NULL,
  `sgd_tpr_estado` decimal(1,0) DEFAULT NULL,
  `sgd_termino_real` decimal(4,0) DEFAULT NULL,
  `sgd_tpr_web` int(11) DEFAULT NULL,
  `sgd_tpr_tiptermino` varchar(5) DEFAULT NULL,
  `sgd_tpr_tp4` int(11) DEFAULT NULL,
  `sgd_tpr_tp3` int(11) DEFAULT NULL,
  `sgd_tpr_tp5` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_trad_tiporad`
--

CREATE TABLE IF NOT EXISTS `sgd_trad_tiporad` (
  `sgd_trad_codigo` decimal(2,0) NOT NULL,
  `sgd_trad_descr` varchar(30) DEFAULT NULL,
  `sgd_trad_icono` varchar(30) DEFAULT NULL,
  `sgd_trad_diasbloqueo` decimal(2,0) DEFAULT NULL,
  `sgd_trad_genradsal` int(11) DEFAULT NULL,
  PRIMARY KEY (`sgd_trad_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_ttr_transaccion`
--

CREATE TABLE IF NOT EXISTS `sgd_ttr_transaccion` (
  `sgd_ttr_codigo` decimal(3,0) NOT NULL,
  `sgd_ttr_descrip` varchar(100) NOT NULL,
  PRIMARY KEY (`sgd_ttr_codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tvd_dependencia`
--

CREATE TABLE IF NOT EXISTS `sgd_tvd_dependencia` (
  `sgd_depe_codi` decimal(5,0) NOT NULL,
  `sgd_depe_nombre` varchar(200) NOT NULL,
  `sgd_depe_fechini` date NOT NULL,
  `sgd_depe_fechfin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_tvd_series`
--

CREATE TABLE IF NOT EXISTS `sgd_tvd_series` (
  `sgd_depe_codi` decimal(4,0) NOT NULL,
  `sgd_stvd_codi` decimal(4,0) NOT NULL,
  `sgd_stvd_nombre` varchar(200) NOT NULL,
  `sgd_stvd_ac` decimal(4,0) DEFAULT NULL,
  `sgd_stvd_dispfin` decimal(2,0) DEFAULT NULL,
  `sgd_stvd_proc` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`sgd_depe_codi`,`sgd_stvd_codi`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_ush_usuhistorico`
--

CREATE TABLE IF NOT EXISTS `sgd_ush_usuhistorico` (
  `sgd_ush_admcod` decimal(10,0) NOT NULL,
  `sgd_ush_admdep` decimal(5,0) NOT NULL,
  `sgd_ush_admdoc` varchar(14) NOT NULL,
  `sgd_ush_usucod` decimal(10,0) NOT NULL,
  `sgd_ush_usudep` decimal(5,0) NOT NULL,
  `sgd_ush_usudoc` varchar(14) NOT NULL,
  `sgd_ush_modcod` decimal(5,0) NOT NULL,
  `sgd_ush_fechevento` date NOT NULL,
  `sgd_ush_usulogin` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sgd_usm_usumodifica`
--

CREATE TABLE IF NOT EXISTS `sgd_usm_usumodifica` (
  `sgd_usm_modcod` decimal(5,0) NOT NULL,
  `sgd_usm_moddescr` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_doc_identificacion`
--

CREATE TABLE IF NOT EXISTS `tipo_doc_identificacion` (
  `tdid_codi` decimal(2,0) NOT NULL,
  `tdid_desc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tipo_remitente`
--

CREATE TABLE IF NOT EXISTS `tipo_remitente` (
  `trte_codi` decimal(2,0) NOT NULL,
  `trte_desc` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ubicacion_fisica`
--

CREATE TABLE IF NOT EXISTS `ubicacion_fisica` (
  `ubic_depe_radi` decimal(5,0) DEFAULT NULL,
  `ubic_depe_arch` decimal(5,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `usua_codi` decimal(10,0) NOT NULL,
  `depe_codi` decimal(5,0) NOT NULL,
  `usua_login` varchar(50) NOT NULL,
  `usua_fech_crea` date DEFAULT NULL,
  `usua_pasw` varchar(35) NOT NULL,
  `usua_esta` varchar(10) NOT NULL,
  `usua_nomb` varchar(45) DEFAULT NULL,
  `perm_radi` char(1) DEFAULT NULL,
  `usua_admin` char(1) DEFAULT NULL,
  `usua_nuevo` char(1) DEFAULT NULL,
  `usua_doc` varchar(14) DEFAULT NULL,
  `codi_nivel` decimal(2,0) DEFAULT NULL,
  `usua_sesion` varchar(30) DEFAULT NULL,
  `usua_fech_sesion` date DEFAULT NULL,
  `usua_ext` decimal(4,0) DEFAULT NULL,
  `usua_nacim` date DEFAULT NULL,
  `usua_email` varchar(50) DEFAULT NULL,
  `usua_at` varchar(50) DEFAULT NULL,
  `usua_piso` decimal(2,0) DEFAULT NULL,
  `perm_radi_sal` decimal(21,6) DEFAULT NULL,
  `usua_admin_archivo` decimal(1,0) DEFAULT NULL,
  `usua_masiva` decimal(1,0) DEFAULT NULL,
  `usua_perm_dev` decimal(1,0) DEFAULT NULL,
  `usua_perm_numera_res` varchar(1) DEFAULT NULL,
  `usua_doc_suip` varchar(15) DEFAULT NULL,
  `usua_perm_numeradoc` decimal(1,0) DEFAULT NULL,
  `sgd_panu_codi` decimal(4,0) DEFAULT NULL,
  `usua_prad_tp1` decimal(1,0) DEFAULT NULL,
  `usua_prad_tp2` decimal(1,0) DEFAULT NULL,
  `usua_perm_envios` decimal(1,0) DEFAULT NULL,
  `usua_perm_modifica` decimal(1,0) DEFAULT NULL,
  `usua_perm_impresion` decimal(1,0) DEFAULT NULL,
  `sgd_aper_codigo` decimal(2,0) DEFAULT NULL,
  `usu_telefono1` varchar(14) DEFAULT NULL,
  `usua_encuesta` varchar(1) DEFAULT NULL,
  `sgd_perm_estadistica` decimal(2,0) DEFAULT NULL,
  `usua_perm_sancionados` decimal(1,0) DEFAULT NULL,
  `usua_admin_sistema` decimal(1,0) DEFAULT NULL,
  `usua_perm_trd` decimal(1,0) DEFAULT NULL,
  `usua_perm_firma` decimal(1,0) DEFAULT NULL,
  `usua_perm_prestamo` decimal(1,0) DEFAULT NULL,
  `usuario_publico` decimal(1,0) DEFAULT NULL,
  `usuario_reasignar` decimal(1,0) DEFAULT NULL,
  `usua_perm_notifica` decimal(1,0) DEFAULT NULL,
  `usua_perm_expediente` decimal(21,6) DEFAULT NULL,
  `usua_login_externo` varchar(15) DEFAULT NULL,
  `id_pais` decimal(4,0) DEFAULT NULL,
  `id_cont` decimal(2,0) DEFAULT NULL,
  `usua_auth_ldap` decimal(1,0) DEFAULT NULL,
  `perm_archi` char(1) DEFAULT NULL,
  `perm_vobo` char(1) DEFAULT NULL,
  `perm_borrar_anexo` decimal(1,0) DEFAULT NULL,
  `perm_tipif_anexo` decimal(1,0) DEFAULT NULL,
  `usua_perm_adminflujos` decimal(1,0) NOT NULL,
  `usua_exp_trd` decimal(2,0) DEFAULT NULL,
  `usua_perm_rademail` int(11) DEFAULT NULL,
  `usua_prad_tp4` int(11) DEFAULT NULL,
  `usua_perm_accesi` decimal(1,0) DEFAULT NULL,
  `usua_prad_tp3` int(11) DEFAULT NULL,
  `usua_prad_tp5` int(11) DEFAULT NULL,
  `usua_perm_agrcontacto` decimal(1,0) DEFAULT NULL,
  PRIMARY KEY (`usua_login`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
