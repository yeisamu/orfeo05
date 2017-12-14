-- ----------------------------------------------------------------------------
-- MySQL Workbench Migration
-- Migrated Schemata: orfeo
-- Source Schemata: orfeo
-- Created: Thu Jul 16 11:34:48 2015
-- ----------------------------------------------------------------------------

SET FOREIGN_KEY_CHECKS = 0;;

-- ----------------------------------------------------------------------------
-- Schema orfeo
-- ----------------------------------------------------------------------------
DROP SCHEMA IF EXISTS `orfeo` ;
CREATE SCHEMA IF NOT EXISTS `orfeo` ;

-- ----------------------------------------------------------------------------
-- Table orfeo.anexos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`anexos` (
  `anex_radi_nume` DECIMAL(15,0) NOT NULL,
  `anex_codigo` VARCHAR(20) NOT NULL,
  `anex_tipo` DECIMAL(4,0) NOT NULL,
  `anex_tamano` DECIMAL NULL,
  `anex_solo_lect` VARCHAR(1) NOT NULL,
  `anex_creador` VARCHAR(50) NOT NULL,
  `anex_desc` VARCHAR(512) NULL,
  `anex_numero` DECIMAL(5,0) NOT NULL,
  `anex_nomb_archivo` VARCHAR(50) NOT NULL,
  `anex_borrado` VARCHAR(1) NOT NULL,
  `anex_origen` DECIMAL(1,0) NULL DEFAULT 0,
  `anex_ubic` VARCHAR(15) NULL,
  `anex_salida` DECIMAL(1,0) NULL DEFAULT 0,
  `radi_nume_salida` DECIMAL(15,0) NULL,
  `anex_radi_fech` DATETIME NULL,
  `anex_estado` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_doc` VARCHAR(14) NULL,
  `sgd_rem_destino` DECIMAL(1,0) NULL DEFAULT 0,
  `anex_fech_envio` DATETIME NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NULL,
  `anex_fech_impres` DATETIME NULL,
  `anex_depe_creador` DECIMAL(4,0) NULL,
  `sgd_doc_secuencia` DECIMAL(15,0) NULL,
  `sgd_doc_padre` VARCHAR(20) NULL,
  `sgd_arg_codigo` DECIMAL(2,0) NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  `sgd_deve_codigo` DECIMAL(2,0) NULL,
  `sgd_deve_fech` DATE NULL,
  `sgd_fech_impres` DATETIME NULL,
  `anex_fech_anex` DATETIME NULL,
  `anex_depe_codi` VARCHAR(3) NULL,
  `sgd_pnufe_codi` DECIMAL(4,0) NULL,
  `sgd_dnufe_codi` DECIMAL(4,0) NULL,
  `anex_usudoc_creador` VARCHAR(15) NULL,
  `sgd_fech_doc` DATE NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_trad_codigo` DECIMAL(2,0) NULL,
  `sgd_dir_direccion` VARCHAR(150) NULL,
  `sgd_exp_numero` VARCHAR(18) NULL,
  `numero_doc` VARCHAR(15) NULL,
  `sgd_srd_codigo` VARCHAR(3) NULL,
  `sgd_sbrd_codigo` VARCHAR(4) NULL,
  `anex_num_hoja` DECIMAL NULL,
  `texto_archivo_anex` LONGTEXT NULL,
  `anex_idarch_version` DECIMAL(3,0) NULL,
  `anex_num_version` DECIMAL(2,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.anexos_historico
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`anexos_historico` (
  `anex_hist_anex_codi` VARCHAR(20) NOT NULL,
  `anex_hist_num_ver` DECIMAL(4,0) NOT NULL,
  `anex_hist_tipo_mod` VARCHAR(2) NOT NULL,
  `anex_hist_usua` VARCHAR(15) NOT NULL,
  `anex_hist_fecha` DATE NOT NULL,
  `usua_doc` VARCHAR(14) NULL,
  UNIQUE INDEX `anex_hist_pk` (`anex_hist_anex_codi` ASC, `anex_hist_num_ver` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.anexos_tipo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`anexos_tipo` (
  `anex_tipo_codi` DECIMAL(4,0) NOT NULL,
  `anex_tipo_ext` VARCHAR(10) NOT NULL,
  `anex_tipo_desc` VARCHAR(50) NULL,
  UNIQUE INDEX `anex_pk_anex_tipo_codi` (`anex_tipo_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.aux_01
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`aux_01` (
  `r` DECIMAL NULL,
  INDEX `r_index` (`r` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.bodega_empresas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`bodega_empresas` (
  `nombre_de_la_empresa` VARCHAR(300) NULL,
  `nuir` VARCHAR(13) NULL,
  `nit_de_la_empresa` VARCHAR(80) NULL,
  `sigla_de_la_empresa` VARCHAR(80) NULL,
  `direccion` VARCHAR(4000) NULL,
  `codigo_del_departamento` VARCHAR(4000) NULL,
  `codigo_del_municipio` VARCHAR(4000) NULL,
  `telefono_1` VARCHAR(4000) NULL,
  `telefono_2` VARCHAR(4000) NULL,
  `email` VARCHAR(4000) NULL,
  `nombre_rep_legal` VARCHAR(4000) NULL,
  `cargo_rep_legal` VARCHAR(4000) NULL,
  `identificador_empresa` DECIMAL(5,0) NOT NULL,
  `are_esp_secue` DECIMAL(8,0) NOT NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  `activa` DECIMAL(1,0) NULL DEFAULT 1,
  `flag_rups` VARCHAR(10) NULL,
  `codigo_suscriptor` VARCHAR(50) NULL,
  PRIMARY KEY (`identificador_empresa`),
  INDEX `ind_bodega_empresas` (`identificador_empresa` ASC),
  INDEX `sgd_bodega_` (`nuir` ASC),
  INDEX `sgd_bodega_are_esp_secue` (`are_esp_secue` ASC),
  INDEX `sgd_bodega_nit` (`nit_de_la_empresa` ASC),
  INDEX `sgd_bodega_nombre` (`nombre_de_la_empresa`(255) ASC),
  INDEX `sgd_bodega_rep_legal` (`nombre_rep_legal`(255) ASC),
  INDEX `sgd_bodega_sigla` (`sigla_de_la_empresa` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.bodega_empresas_old
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`bodega_empresas_old` (
  `identificador_de_la_empresa` DECIMAL(5,0) NOT NULL,
  `nuir` VARCHAR(13) NULL,
  `nombre_de_la_empresa` VARCHAR(150) NULL,
  `nit_de_la_empresa` VARCHAR(13) NULL,
  `sigla_de_la_empresa` VARCHAR(30) NULL,
  `codigo_de_la_nat_juridica` DECIMAL(2,0) NULL,
  `direccion` VARCHAR(50) NULL,
  `codigo_del_departamento` DECIMAL(2,0) NULL,
  `codigo_del_municipio` DECIMAL(3,0) NULL,
  `codigo_de_la_unidad` DECIMAL(3,0) NULL,
  `telefono_1` VARCHAR(15) NULL,
  `telefono_2` VARCHAR(15) NULL,
  `telefono_3` VARCHAR(15) NULL,
  `apartado_aereo` DECIMAL(10,0) NULL,
  `numero_de_fax` VARCHAR(15) NULL,
  `zona_postal` DECIMAL(3,0) NULL,
  `email` VARCHAR(50) NULL,
  `tiene_contab_por_servicio` VARCHAR(2) NULL,
  `fecha_de_actualizacion` DATE NULL,
  `codigo_regional` DECIMAL(3,0) NULL,
  `estado_de_la_empresa` VARCHAR(50) NULL,
  `fecha_del_estado` DATE NULL,
  `obsv_del_estado` VARCHAR(100) NULL,
  `esp_cias` DECIMAL(4,0) NULL,
  `esp_auxi` DECIMAL(8,0) NULL,
  `esp_etco` DECIMAL(2,0) NULL,
  `esp_ceco` VARCHAR(16) NULL,
  `estado` DECIMAL(2,0) NULL,
  `tipo_identificacion_repl` VARCHAR(1) NULL,
  `numero_identificaci_repl` VARCHAR(11) NULL,
  `nombre_rep_legal` VARCHAR(75) NULL,
  `cargo_rep_legal` DECIMAL(2,0) NULL,
  `numero_camara_ccio` VARCHAR(20) NULL,
  `cod_estado_vigilancia` DECIMAL(2,0) NULL,
  `identificador_empresa` DECIMAL(5,0) NOT NULL,
  `nombre_de_la_empresa_anterior` VARCHAR(150) NULL,
  `direccion_anterior` VARCHAR(50) NULL,
  UNIQUE INDEX `ind_bodega_` (`identificador_empresa` ASC),
  INDEX `ind_bodega_empresas_nombreemp` (`nombre_de_la_empresa` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.borrar_carpeta_personalizada
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`borrar_carpeta_personalizada` (
  `carp_per_codi` DECIMAL(2,0) NOT NULL,
  `carp_per_usu` VARCHAR(15) NOT NULL,
  `carp_per_desc` VARCHAR(80) NOT NULL,
  UNIQUE INDEX `pk_rad_carp_per` (`carp_per_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.borrar_empresa_esp
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`borrar_empresa_esp` (
  `eesp_codi` DECIMAL(7,0) NOT NULL,
  `eesp_nomb` VARCHAR(150) NOT NULL,
  `essp_nit` VARCHAR(13) NULL,
  `essp_sigla` VARCHAR(30) NULL,
  `depe_codi` DECIMAL(2,0) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `eesp_dire` VARCHAR(50) NULL,
  `eesp_rep_leg` VARCHAR(75) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.carpeta
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`carpeta` (
  `carp_codi` DECIMAL(2,0) NOT NULL,
  `carp_desc` VARCHAR(80) NOT NULL,
  UNIQUE INDEX `carpetas_pk` (`carp_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.carpeta_per
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`carpeta_per` (
  `usua_codi` DECIMAL(3,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `nomb_carp` VARCHAR(15) NULL,
  `desc_carp` VARCHAR(50) NULL,
  `codi_carp` DECIMAL(3,0) NULL DEFAULT 99,
  INDEX `carpetas_per` (`codi_carp` ASC, `depe_codi` ASC, `usua_codi` ASC),
  INDEX `carpetas_per1` (`usua_codi` ASC, `depe_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.centro_poblado
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`centro_poblado` (
  `cpob_codi` DECIMAL(4,0) NOT NULL,
  `muni_codi` DECIMAL(4,0) NOT NULL,
  `dpto_codi` DECIMAL(2,0) NOT NULL,
  `cpob_nomb` VARCHAR(100) NOT NULL,
  `cpob_nomb_anterior` VARCHAR(100) NULL,
  UNIQUE INDEX `centro_poblado_pk` (`cpob_codi` ASC, `muni_codi` ASC, `dpto_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.departamento
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`departamento` (
  `dpto_codi` DECIMAL(3,0) NOT NULL,
  `dpto_nomb` VARCHAR(70) NOT NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  UNIQUE INDEX `departamento_pk` (`dpto_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.dependencia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`dependencia` (
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `depe_nomb` VARCHAR(70) NOT NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `depe_codi_padre` DECIMAL(5,0) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `depe_codi_territorial` DECIMAL(4,0) NULL,
  `dep_sigla` VARCHAR(100) NULL,
  `dep_central` DECIMAL(1,0) NULL,
  `dep_direccion` VARCHAR(100) NULL,
  `depe_num_interna` DECIMAL(4,0) NULL,
  `depe_num_resolucion` DECIMAL(4,0) NULL,
  `depe_rad_tp1` DECIMAL(3,0) NULL,
  `depe_rad_tp2` DECIMAL(3,0) NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  `depe_estado` DECIMAL(1,0) NULL DEFAULT 0,
  `depe_rad_tp4` SMALLINT NULL,
  `depe_segu` SMALLINT NULL,
  `depe_rad_tp3` SMALLINT NULL,
  `depe_rad_tp5` SMALLINT NULL,
  UNIQUE INDEX `pk_depe` (`depe_codi` ASC),
  INDEX `pk_dpto_muni` (`depe_codi` ASC, `muni_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.dependencia_visibilidad
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`dependencia_visibilidad` (
  `codigo_visibilidad` DECIMAL(18,0) NOT NULL,
  `dependencia_visible` DECIMAL(5,0) NOT NULL,
  `dependencia_observa` DECIMAL(5,0) NOT NULL,
  UNIQUE INDEX `dependencia_visibilidad_pk` (`codigo_visibilidad` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.dup_eliminar
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`dup_eliminar` (
  `sgd_oem_codigo` DECIMAL(8,0) NOT NULL,
  `tdid_codi` DECIMAL(2,0) NULL,
  `sgd_oem_oempresa` VARCHAR(150) NULL,
  `sgd_oem_rep_legal` VARCHAR(150) NULL,
  `sgd_oem_nit` VARCHAR(14) NULL,
  `sgd_oem_sigla` VARCHAR(50) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `sgd_oem_direccion` VARCHAR(100) NULL,
  `sgd_oem_telefono` VARCHAR(50) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.emp_cod_actualizar
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`emp_cod_actualizar` (
  `emp_cod_ant` VARCHAR(10) NULL,
  `emp_cod_nue` VARCHAR(10) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.empresas_temporal
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`empresas_temporal` (
  `nombre_de_la_empresa` VARCHAR(160) NULL,
  `nuir` VARCHAR(13) NULL,
  `nit_de_la_empresa` VARCHAR(80) NULL,
  `sigla_de_la_empresa` VARCHAR(80) NULL,
  `direccion` VARCHAR(4000) NULL,
  `codigo_del_departamento` VARCHAR(4000) NULL,
  `codigo_del_municipio` VARCHAR(4000) NULL,
  `telefono_1` VARCHAR(4000) NULL,
  `telefono_2` VARCHAR(4000) NULL,
  `email` VARCHAR(4000) NULL,
  `nombre_rep_legal` VARCHAR(4000) NULL,
  `cargo_rep_legal` VARCHAR(4000) NULL,
  `identificador_empresa` DECIMAL(5,0) NULL,
  `are_esp_secue` DECIMAL(8,0) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.encuesta
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`encuesta` (
  `usua_doc` VARCHAR(14) NOT NULL,
  `fecha` DATE NULL,
  `p1` VARCHAR(100) NULL,
  `p2` VARCHAR(100) NULL,
  `p3` VARCHAR(100) NULL,
  `p4` VARCHAR(100) NULL,
  `p5` VARCHAR(100) NULL,
  `p6` VARCHAR(100) NULL,
  `p7` VARCHAR(100) NULL,
  `p7_cual` VARCHAR(150) NULL,
  `p8` VARCHAR(100) NULL,
  `p9` VARCHAR(100) NULL,
  `p10` VARCHAR(100) NULL,
  `p11` VARCHAR(100) NULL,
  `p12` VARCHAR(100) NULL,
  `p13` VARCHAR(100) NULL,
  `p14` VARCHAR(100) NULL,
  `p15` VARCHAR(100) NULL,
  `p16` VARCHAR(100) NULL,
  `p17` VARCHAR(100) NULL,
  `p18` VARCHAR(100) NULL,
  `p19` VARCHAR(100) NULL,
  `p20` VARCHAR(100) NULL,
  `p20_cual` VARCHAR(150) NULL,
  `p21` VARCHAR(100) NULL,
  `p22` VARCHAR(100) NULL,
  `p23` VARCHAR(100) NULL,
  `p24` VARCHAR(100) NULL,
  `p25` VARCHAR(100) NULL,
  UNIQUE INDEX `pk_encuesta` (`usua_doc` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.entidades_asociativa
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`entidades_asociativa` (
  `nit` VARCHAR(12) NULL,
  `codentidad` DECIMAL(10,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.estado
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`estado` (
  `esta_codi` DECIMAL(2,0) NOT NULL,
  `esta_desc` VARCHAR(100) NOT NULL,
  UNIQUE INDEX `estados_pk` (`esta_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.example
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`example` (
  `campo1` DECIMAL(15,0) NOT NULL,
  `campo2` VARCHAR(10) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.fun_funcionario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`fun_funcionario` (
  `usua_doc` VARCHAR(14) NULL,
  `usua_fech_crea` DATE NOT NULL,
  `usua_esta` VARCHAR(10) NOT NULL,
  `usua_nomb` VARCHAR(45) NULL,
  `usua_ext` DECIMAL(4,0) NULL,
  `usua_nacim` DATE NULL,
  `usua_email` VARCHAR(50) NULL,
  `usua_at` VARCHAR(15) NULL,
  `usua_piso` DECIMAL(2,0) NULL,
  `cedula_ok` CHAR(1) NULL DEFAULT 'n',
  `cedula_suip` VARCHAR(15) NULL,
  `nombre_suip` VARCHAR(45) NULL,
  `observa` CHAR(20) NULL,
  INDEX `funcionario_fun_usuadoc` (`usua_doc` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.fun_funcionario_2
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`fun_funcionario_2` (
  `usua_doc` VARCHAR(14) NULL,
  `usua_fech_crea` DATE NOT NULL,
  `usua_esta` VARCHAR(10) NOT NULL,
  `usua_nomb` VARCHAR(45) NULL,
  `usua_ext` DECIMAL(4,0) NULL,
  `usua_nacim` DATE NULL,
  `usua_email` VARCHAR(50) NULL,
  `usua_at` VARCHAR(15) NULL,
  `usua_piso` DECIMAL(2,0) NULL,
  `cedula_ok` CHAR(1) NULL,
  `cedula_suip` VARCHAR(15) NULL,
  `nombre_suip` VARCHAR(45) NULL,
  `observa` CHAR(20) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.hist_eventos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`hist_eventos` (
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `hist_fech` DATETIME NOT NULL,
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `hist_obse` VARCHAR(10000) NOT NULL,
  `usua_codi_dest` DECIMAL(10,0) NULL,
  `usua_doc` VARCHAR(14) NULL,
  `usua_doc_old` VARCHAR(15) NULL,
  `sgd_ttr_codigo` DECIMAL(3,0) NULL,
  `hist_usua_autor` VARCHAR(14) NULL,
  `hist_doc_dest` VARCHAR(14) NULL,
  `depe_codi_dest` DECIMAL(3,0) NULL,
  INDEX `hist_consulta` (`radi_nume_radi` ASC, `hist_fech` ASC, `depe_codi` ASC, `usua_codi` ASC),
  INDEX `hist_tipotrans` (`sgd_ttr_codigo` ASC),
  INDEX `radi_nume_radi` (`radi_nume_radi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.informados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`informados` (
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `depe_codi` DECIMAL(3,0) NOT NULL,
  `info_desc` VARCHAR(600) NULL,
  `info_fech` DATE NOT NULL,
  `info_leido` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_codi_info` DECIMAL(3,0) NULL,
  `info_codi` DECIMAL(10,0) NULL,
  `usua_doc` VARCHAR(14) NULL,
  `info_resp` VARCHAR(10) NULL,
  INDEX `ind_informado_depe_codi` (`depe_codi` ASC),
  INDEX `ind_informado_usua` (`usua_codi` ASC),
  INDEX `informado_usuario` (`depe_codi` ASC, `usua_codi` ASC, `info_fech` ASC),
  INDEX `radicado_informados` (`radi_nume_radi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.medio_recepcion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`medio_recepcion` (
  `mrec_codi` DECIMAL(2,0) NOT NULL,
  `mrec_desc` VARCHAR(100) NOT NULL,
  UNIQUE INDEX `pk_medio_recepcion` (`mrec_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.municipio
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`municipio` (
  `muni_codi` DECIMAL(4,0) NOT NULL,
  `dpto_codi` DECIMAL(3,0) NOT NULL,
  `muni_nomb` VARCHAR(100) NOT NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  `homologa_muni` VARCHAR(10) NULL,
  `homologa_idmuni` VARCHAR(15) NULL,
  `activa` DECIMAL(1,0) NULL DEFAULT 1,
  INDEX `municipio_depto_idx` (`dpto_codi` ASC),
  UNIQUE INDEX `pk_municipio` (`muni_codi` ASC, `dpto_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.ortega_prueba_orfeo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`ortega_prueba_orfeo` (
  `radi_nume_hoja` DECIMAL(3,0) NULL,
  `radi_fech_radi` DATE NULL,
  `radi_nume_radi` DECIMAL(15,0) NULL,
  `ra_asun` VARCHAR(350) NULL,
  `radi_path` VARCHAR(100) NULL,
  `radi_usu_ante` VARCHAR(45) NULL,
  `nombre_de_la_empresa` VARCHAR(150) NULL,
  `fecha` VARCHAR(20) NULL,
  `sgd_tpr_descrip` VARCHAR(150) NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  `sgd_tpr_termino` DECIMAL(4,0) NULL,
  `diasr` DECIMAL(4,0) NULL,
  `radi_leido` DECIMAL(1,0) NULL,
  `radi_tipo_deri` DECIMAL(2,0) NULL,
  `radi_nume_deri` DECIMAL(15,0) NULL,
  `sgd_ciu_nombre` VARCHAR(50) NULL,
  `sgd_ciu_apell1` VARCHAR(50) NULL,
  `sgd_ciu_apell2` VARCHAR(50) NULL,
  `tipo_query` VARCHAR(50) NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NULL,
  `sgd_dir_nombre` VARCHAR(60) NULL,
  `radi_cuentai` VARCHAR(20) NULL,
  `sgd_exp_numero` VARCHAR(15) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.p_sgd_oem_oempresas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`p_sgd_oem_oempresas` (
  `sgd_oem_codigo` DECIMAL(8,0) NOT NULL,
  `tdid_codi` DECIMAL(2,0) NULL,
  `sgd_oem_oempresa` VARCHAR(150) NULL,
  `sgd_oem_rep_legal` VARCHAR(150) NULL,
  `sgd_oem_nit` VARCHAR(14) NULL,
  `sgd_oem_sigla` VARCHAR(50) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `sgd_oem_direccion` VARCHAR(100) NULL,
  `sgd_oem_telefono` VARCHAR(50) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.par_serv_servicios
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`par_serv_servicios` (
  `par_serv_secue` DECIMAL(8,0) NOT NULL,
  `par_serv_codigo` VARCHAR(5) NULL,
  `par_serv_nombre` VARCHAR(100) NULL,
  `par_serv_estado` VARCHAR(1) NULL,
  UNIQUE INDEX `pk_par_serv_servicios` (`par_serv_secue` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.pl_generado_plg
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`pl_generado_plg` (
  `depe_codi` DECIMAL(5,0) NULL,
  `radi_nume_radi` DECIMAL(15,0) NULL,
  `plt_codi` DECIMAL(4,0) NULL,
  `plg_codi` DECIMAL(4,0) NULL,
  `plg_comentarios` VARCHAR(150) NULL,
  `plg_analiza` DECIMAL(10,0) NULL,
  `plg_firma` DECIMAL(10,0) NULL,
  `plg_autoriza` DECIMAL(10,0) NULL,
  `plg_imprime` DECIMAL(10,0) NULL,
  `plg_envia` DECIMAL(10,0) NULL,
  `plg_archivo_tmp` VARCHAR(150) NULL,
  `plg_archivo_final` VARCHAR(150) NULL,
  `plg_nombre` VARCHAR(30) NULL,
  `plg_crea` DECIMAL(10,0) NULL DEFAULT 0,
  `plg_autoriza_fech` DATE NULL,
  `plg_imprime_fech` DATE NULL,
  `plg_envia_fech` DATE NULL,
  `plg_crea_fech` DATE NULL,
  `plg_creador` VARCHAR(20) NULL,
  `pl_codi` DECIMAL(4,0) NULL,
  `usua_doc` VARCHAR(14) NULL,
  `sgd_rem_destino` DECIMAL(1,0) NULL DEFAULT 0,
  `radi_nume_sal` DECIMAL(15,0) NULL DEFAULT 0);

-- ----------------------------------------------------------------------------
-- Table orfeo.pl_tipo_plt
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`pl_tipo_plt` (
  `plt_codi` DECIMAL(4,0) NOT NULL,
  `plt_desc` VARCHAR(35) NULL,
  UNIQUE INDEX `pk_pl_tipo_plt` (`plt_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.plan_table
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`plan_table` (
  `statement_id` VARCHAR(30) NULL,
  `timestamp` DATE NULL,
  `remarks` VARCHAR(80) NULL,
  `operation` VARCHAR(30) NULL,
  `options` VARCHAR(30) NULL,
  `object_node` VARCHAR(128) NULL,
  `object_owner` VARCHAR(30) NULL,
  `object_name` VARCHAR(30) NULL,
  `object_instance` INT NULL,
  `object_type` VARCHAR(30) NULL,
  `optimizer` VARCHAR(255) NULL,
  `search_columns` DECIMAL NULL,
  `id` INT NULL,
  `parent_id` INT NULL,
  `position` INT NULL,
  `cost` INT NULL,
  `cardinality` INT NULL,
  `s` INT NULL,
  `other_tag` VARCHAR(255) NULL,
  `partition_start` VARCHAR(255) NULL,
  `partition_stop` VARCHAR(255) NULL,
  `partition_id` INT NULL,
  `other` VARCHAR(255) NULL,
  `distribution` VARCHAR(30) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.plantilla_pl
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`plantilla_pl` (
  `pl_codi` DECIMAL(4,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `pl_nomb` VARCHAR(35) NULL,
  `pl_archivo` VARCHAR(35) NULL,
  `pl_desc` VARCHAR(150) NULL,
  `pl_fech` DATE NULL,
  `usua_codi` DECIMAL(10,0) NULL,
  `pl_uso` DECIMAL(1,0) NULL DEFAULT 0,
  UNIQUE INDEX `pk_plantilla_pl` (`pl_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.plsql_profiler_data
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`plsql_profiler_data` (
  `runid` DECIMAL NULL,
  `unit_numeric` DECIMAL NULL,
  `line` DECIMAL NOT NULL,
  `total_occur` DECIMAL NULL,
  `total_time` DECIMAL NULL,
  `min_time` DECIMAL NULL,
  `max_time` DECIMAL NULL,
  `spare1` DECIMAL NULL,
  `spare2` DECIMAL NULL,
  `spare3` DECIMAL NULL,
  `spare4` DECIMAL NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.plsql_profiler_runs
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`plsql_profiler_runs` (
  `runid` DECIMAL NULL,
  `related_run` DECIMAL NULL,
  `run_owner` VARCHAR(32) NULL,
  `run_date` DATE NULL,
  `run_comment` VARCHAR(2047) NULL,
  `run_total_time` DECIMAL NULL,
  `run_system_info` VARCHAR(2047) NULL,
  `run_comment1` VARCHAR(2047) NULL,
  `spare1` VARCHAR(256) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.plsql_profiler_units
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`plsql_profiler_units` (
  `runid` DECIMAL NULL,
  `unit_numeric` DECIMAL NULL,
  `unit_type` VARCHAR(32) NULL,
  `unit_owner` VARCHAR(32) NULL,
  `unit_name` VARCHAR(32) NULL,
  `unit_timestamp` DATE NULL,
  `total_time` DECIMAL NOT NULL DEFAULT 0,
  `spare1` DECIMAL NULL,
  `spare2` DECIMAL NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.prestamo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`prestamo` (
  `pres_id` DECIMAL(10,0) NOT NULL,
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `usua_login_actu` VARCHAR(50) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `usua_login_pres` VARCHAR(50) NULL,
  `pres_desc` VARCHAR(200) NULL,
  `pres_fech_pres` DATETIME NULL,
  `pres_fech_devo` DATETIME NULL,
  `pres_fech_pedi` DATETIME NOT NULL,
  `pres_estado` DECIMAL(2,0) NULL,
  `pres_requerimiento` DECIMAL(2,0) NULL,
  `pres_depe_arch` DECIMAL(5,0) NULL,
  `pres_fech_venc` DATETIME NULL,
  `dev_desc` VARCHAR(500) NULL,
  `pres_fech_canc` DATETIME NULL,
  `usua_login_canc` VARCHAR(50) NULL,
  `usua_login_rx` VARCHAR(50) NULL,
  UNIQUE INDEX `pk_prestamo` (`pres_id` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.pruba
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`pruba` (
  `nombre` VARCHAR(20) NULL,
  `tel` VARCHAR(20) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.radicado
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`radicado` (
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `radi_fech_radi` DATETIME NOT NULL,
  `tdoc_codi` DECIMAL(4,0) NOT NULL,
  `trte_codi` DECIMAL(2,0) NULL,
  `mrec_codi` DECIMAL(2,0) NULL,
  `eesp_codi` DECIMAL(10,0) NULL,
  `eotra_codi` DECIMAL(10,0) NULL,
  `radi_tipo_empr` VARCHAR(2) NULL,
  `radi_fech_ofic` DATE NULL,
  `tdid_codi` DECIMAL(2,0) NULL,
  `radi_nume_iden` VARCHAR(15) NULL,
  `radi_nomb` VARCHAR(90) NULL,
  `radi_prim_apel` VARCHAR(50) NULL,
  `radi_segu_apel` VARCHAR(50) NULL,
  `radi_pais` VARCHAR(70) NULL,
  `muni_codi` DECIMAL(5,0) NULL,
  `cpob_codi` DECIMAL(4,0) NULL,
  `carp_codi` DECIMAL(3,0) NULL,
  `esta_codi` DECIMAL(2,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `cen_muni_codi` DECIMAL(4,0) NULL,
  `cen_dpto_codi` DECIMAL(2,0) NULL,
  `radi_dire_corr` VARCHAR(100) NULL,
  `radi_tele_cont` VARCHAR(15) NULL,
  `radi_nume_hoja` DECIMAL(4,0) NULL,
  `radi_desc_anex` VARCHAR(500) NULL,
  `radi_nume_deri` DECIMAL(15,0) NULL,
  `radi_path` VARCHAR(100) NULL,
  `radi_usua_actu` DECIMAL(10,0) NULL,
  `radi_depe_actu` DECIMAL(5,0) NULL,
  `radi_fech_asig` DATETIME NULL,
  `radi_arch1` VARCHAR(10) NULL,
  `radi_arch2` VARCHAR(10) NULL,
  `radi_arch3` VARCHAR(10) NULL,
  `radi_arch4` VARCHAR(10) NULL,
  `ra_asun` VARCHAR(350) NULL,
  `radi_usu_ante` VARCHAR(45) NULL,
  `radi_depe_radi` DECIMAL(3,0) NULL,
  `radi_rem` VARCHAR(60) NULL,
  `radi_usua_radi` DECIMAL(10,0) NULL,
  `codi_nivel` DECIMAL(2,0) NULL DEFAULT 1,
  `flag_nivel` INT NULL DEFAULT 1,
  `carp_per` DECIMAL(1,0) NULL DEFAULT 0,
  `radi_leido` DECIMAL(1,0) NULL DEFAULT 0,
  `radi_cuentai` VARCHAR(20) NULL,
  `radi_tipo_deri` DECIMAL(2,0) NULL DEFAULT 0,
  `listo` VARCHAR(2) NULL,
  `sgd_tma_codigo` DECIMAL(4,0) NULL,
  `sgd_mtd_codigo` DECIMAL(4,0) NULL,
  `par_serv_secue` DECIMAL(8,0) NULL,
  `sgd_fld_codigo` DECIMAL(3,0) NULL DEFAULT 0,
  `radi_agend` DECIMAL(1,0) NULL,
  `radi_fech_agend` DATETIME NULL,
  `radi_fech_doc` DATE NULL,
  `sgd_doc_secuencia` DECIMAL(15,0) NULL,
  `sgd_pnufe_codi` DECIMAL(4,0) NULL,
  `sgd_eanu_codigo` DECIMAL(1,0) NULL,
  `sgd_not_codi` DECIMAL(3,0) NULL,
  `radi_fech_notif` DATETIME NULL,
  `sgd_tdec_codigo` DECIMAL(4,0) NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_ttr_codigo` INT NULL DEFAULT 0,
  `usua_doc_ante` VARCHAR(14) NULL,
  `radi_fech_antetx` DATETIME NULL,
  `sgd_trad_codigo` DECIMAL(2,0) NULL,
  `fech_vcmto` DATETIME NULL,
  `tdoc_vcmto` DECIMAL(4,0) NULL,
  `sgd_termino_real` DECIMAL(4,0) NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `sgd_spub_codigo` DECIMAL(2,0) NULL DEFAULT 0,
  `id_pais` DECIMAL(4,0) NULL,
  `medio_m` VARCHAR(5) NULL,
  `radi_nrr` DECIMAL(2,0) NULL,
  `numero_rm` VARCHAR(15) NULL,
  `numero_tran` VARCHAR(15) NULL,
  `texto_archivo` LONGTEXT NULL,
  PRIMARY KEY (`radi_nume_radi`),
  INDEX `idx_sgd_eanu_codigo` (`sgd_eanu_codigo` ASC),
  INDEX `ind_radi_cuentai` (`radi_cuentai` ASC),
  INDEX `ind_radi_depe_actu` (`radi_depe_actu` ASC),
  INDEX `ind_radi_fech_radi` (`radi_fech_radi` ASC),
  INDEX `ind_radi_mrec_codi` (`mrec_codi` ASC),
  INDEX `ind_radi_mtd_codigo` (`sgd_mtd_codigo` ASC),
  INDEX `ind_radi_par_serv` (`par_serv_secue` ASC),
  INDEX `ind_radicado_codi_nivel` (`codi_nivel` ASC),
  INDEX `ind_radicado_radi_path` (`radi_path` ASC),
  INDEX `ind_radicado_tdoc_codi` (`tdoc_codi` ASC),
  INDEX `radicado_dependencia` (`radi_cuentai` ASC, `radi_usua_actu` ASC, `carp_codi` ASC),
  UNIQUE INDEX `radicado_idx_001` (`radi_nume_radi` ASC, `tdoc_codi` ASC, `radi_usua_actu` ASC, `radi_depe_actu` ASC, `codi_nivel` ASC, `radi_fech_radi` ASC),
  INDEX `radicado_idx_003` (`radi_depe_radi` ASC, `radi_nume_radi` ASC, `sgd_eanu_codigo` ASC),
  INDEX `radicado_orden` (`radi_fech_asig` ASC, `radi_fech_radi` ASC, `radi_usua_actu` ASC, `radi_depe_actu` ASC, `carp_codi` ASC),
  UNIQUE INDEX `radicado_pk` (`radi_nume_radi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.retencion_doc_tmp
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`retencion_doc_tmp` (
  `cod_serie` DECIMAL(4,0) NULL,
  `serie` VARCHAR(100) NULL,
  `tipologia_doc` VARCHAR(200) NULL,
  `cod_subserie` VARCHAR(10) NULL,
  `subserie` VARCHAR(100) NULL,
  `tipologia_sub` VARCHAR(200) NULL,
  `dependencia` DECIMAL(5,0) NULL,
  `nom_depe` VARCHAR(200) NULL,
  `archivo_gestion` DECIMAL(3,0) NULL,
  `archivo_central` DECIMAL(3,0) NULL,
  `disposicion` VARCHAR(100) NULL,
  `soporte` VARCHAR(20) NULL,
  `procedimiento` VARCHAR(500) NULL,
  `tipo_doc` DECIMAL(4,0) NULL,
  `error` VARCHAR(200) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.series
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`series` (
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `seri_nume` DECIMAL(7,0) NOT NULL,
  `seri_tipo` DECIMAL(2,0) NULL,
  `seri_ano` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(2,0) NOT NULL,
  `bloq` VARCHAR(20) NULL,
  INDEX `bloqueo` (`bloq` ASC),
  UNIQUE INDEX `pk_seri` (`depe_codi` ASC, `seri_tipo` ASC, `seri_ano` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_acm_acusemsg
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_acm_acusemsg` (
  `sgd_msg_codi` DECIMAL(15,0) NOT NULL,
  `usua_doc` VARCHAR(14) NULL,
  `sgd_msg_leido` DECIMAL(3,0) NULL,
  UNIQUE INDEX `pk_sgd_acm_acusemsg` (`sgd_msg_codi` ASC, `usua_doc` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_actadd_actualiadicional
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_actadd_actualiadicional` (
  `sgd_actadd_codi` DECIMAL(4,0) NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_instorf_codi` DECIMAL(4,0) NULL,
  `sgd_actadd_query` VARCHAR(500) NULL,
  `sgd_actadd_desc` VARCHAR(150) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_agen_agendados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_agen_agendados` (
  `sgd_agen_fech` DATE NULL,
  `sgd_agen_observacion` VARCHAR(4000) NULL,
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `usua_doc` VARCHAR(18) NOT NULL,
  `depe_codi` VARCHAR(3) NULL,
  `sgd_agen_codigo` DECIMAL NULL,
  `sgd_agen_fechplazo` DATE NULL,
  `sgd_agen_activo` DECIMAL NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_anar_anexarg
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_anar_anexarg` (
  `sgd_anar_codi` DECIMAL(4,0) NOT NULL,
  `anex_codigo` VARCHAR(20) NULL,
  `sgd_argd_codi` DECIMAL(4,0) NULL,
  `sgd_anar_argcod` DECIMAL(4,0) NULL,
  UNIQUE INDEX `pk_sgd_anar_anexarg` (`sgd_anar_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_anu_anulados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_anu_anulados` (
  `sgd_anu_id` DECIMAL(4,0) NULL,
  `sgd_anu_desc` VARCHAR(250) NULL,
  `radi_nume_radi` DECIMAL NULL,
  `sgd_eanu_codi` DECIMAL(4,0) NULL,
  `sgd_anu_sol_fech` DATE NULL,
  `sgd_anu_fech` DATE NULL,
  `depe_codi` DECIMAL(3,0) NULL,
  `usua_doc` VARCHAR(14) NULL,
  `usua_codi` DECIMAL(4,0) NULL,
  `depe_codi_anu` DECIMAL(3,0) NULL,
  `usua_doc_anu` VARCHAR(14) NULL,
  `usua_codi_anu` DECIMAL(4,0) NULL,
  `usua_anu_acta` DECIMAL(8,0) NULL,
  `sgd_anu_path_acta` VARCHAR(200) NULL,
  `sgd_trad_codigo` DECIMAL(2,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_aper_adminperfiles
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_aper_adminperfiles` (
  `sgd_aper_codigo` DECIMAL(2,0) NULL,
  `sgd_aper_descripcion` VARCHAR(20) NULL,
  UNIQUE INDEX `pk_sgd_aper_adminperfiles` (`sgd_aper_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_aplfad_plicfunadi
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_aplfad_plicfunadi` (
  `sgd_aplfad_codi` DECIMAL(4,0) NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_aplfad_menu` VARCHAR(150) NOT NULL,
  `sgd_aplfad_lk1` VARCHAR(150) NOT NULL,
  `sgd_aplfad_desc` VARCHAR(150) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_apli_aplintegra
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_apli_aplintegra` (
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_apli_descrip` VARCHAR(150) NULL,
  `sgd_apli_lk1desc` VARCHAR(150) NULL,
  `sgd_apli_lk1` VARCHAR(150) NULL,
  `sgd_apli_lk2desc` VARCHAR(150) NULL,
  `sgd_apli_lk2` VARCHAR(150) NULL,
  `sgd_apli_lk3desc` VARCHAR(150) NULL,
  `sgd_apli_lk3` VARCHAR(150) NULL,
  `sgd_apli_lk4desc` VARCHAR(150) NULL,
  `sgd_apli_lk4` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_apli_aplintegra` (`sgd_apli_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_aplmen_aplimens
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_aplmen_aplimens` (
  `sgd_aplmen_codi` DECIMAL(4,0) NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_aplmen_ref` VARCHAR(20) NULL,
  `sgd_aplmen_haciaorfeo` DECIMAL(4,0) NULL,
  `sgd_aplmen_desdeorfeo` DECIMAL(4,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_aplus_plicusua
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_aplus_plicusua` (
  `sgd_aplus_codi` DECIMAL(4,0) NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `usua_doc` VARCHAR(14) NULL,
  `sgd_trad_codigo` DECIMAL(2,0) NULL,
  `sgd_aplus_prioridad` DECIMAL(1,0) NULL,
  UNIQUE INDEX `pk_sgd_aplus_plicusua` (`sgd_aplus_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_arch_depe
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_arch_depe` (
  `sgd_arch_depe` VARCHAR(4) NULL,
  `sgd_arch_edificio` DECIMAL(6,0) NULL,
  `sgd_arch_item` DECIMAL(6,0) NULL,
  `sgd_arch_id` DECIMAL NOT NULL,
  PRIMARY KEY (`sgd_arch_id`));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_archivo_central
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_archivo_central` (
  `sgd_archivo_id` DECIMAL NOT NULL,
  `sgd_archivo_tipo` DECIMAL NULL,
  `sgd_archivo_orden` VARCHAR(15) NULL,
  `sgd_archivo_fechai` DATETIME NULL,
  `sgd_archivo_demandado` VARCHAR(1500) NULL,
  `sgd_archivo_demandante` VARCHAR(200) NULL,
  `sgd_archivo_cc_demandante` DECIMAL NULL,
  `sgd_archivo_depe` VARCHAR(5) NULL,
  `sgd_archivo_zona` VARCHAR(4) NULL,
  `sgd_archivo_carro` DECIMAL NULL,
  `sgd_archivo_cara` VARCHAR(4) NULL,
  `sgd_archivo_estante` DECIMAL NULL,
  `sgd_archivo_entrepano` DECIMAL NULL,
  `sgd_archivo_caja` DECIMAL NULL,
  `sgd_archivo_unidocu` VARCHAR(40) NULL,
  `sgd_archivo_anexo` VARCHAR(4000) NULL,
  `sgd_archivo_inder` DECIMAL NULL DEFAULT 0,
  `sgd_archivo_path` VARCHAR(4000) NULL,
  `sgd_archivo_year` DECIMAL(4,0) NULL,
  `sgd_archivo_rad` VARCHAR(15) NOT NULL,
  `sgd_archivo_srd` DECIMAL NULL,
  `sgd_archivo_sbrd` DECIMAL NULL,
  `sgd_archivo_folios` DECIMAL NULL,
  `sgd_archivo_mata` DECIMAL NULL DEFAULT 0,
  `sgd_archivo_fechaf` DATETIME NULL,
  `sgd_archivo_prestamo` DECIMAL(1,0) NULL,
  `sgd_archivo_funprest` CHAR(100) NULL,
  `sgd_archivo_fechprest` DATETIME NULL,
  `sgd_archivo_fechprestf` DATETIME NULL,
  `depe_codi` VARCHAR(5) NULL,
  `sgd_archivo_usua` VARCHAR(15) NULL,
  `sgd_archivo_fech` DATETIME NULL,
  PRIMARY KEY (`sgd_archivo_id`),
  INDEX `ano` (`sgd_archivo_year` ASC),
  INDEX `busqueda` (`sgd_archivo_demandado`(255) ASC, `sgd_archivo_demandante` ASC, `sgd_archivo_orden` ASC),
  INDEX `carro` (`sgd_archivo_carro` ASC),
  INDEX `idx_dependencia` (`sgd_archivo_depe` ASC),
  UNIQUE INDEX `radicado_archivo` (`sgd_archivo_rad` ASC),
  UNIQUE INDEX `sgd_archivo_central_pk` (`sgd_archivo_id` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_archivo_fondo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_archivo_fondo` (
  `sgd_archivo_id` DECIMAL NOT NULL,
  `sgd_archivo_tipo` DECIMAL NULL,
  `sgd_archivo_orden` VARCHAR(15) NULL,
  `sgd_archivo_fechai` DATETIME NULL,
  `sgd_archivo_demandado` VARCHAR(1500) NULL,
  `sgd_archivo_demandante` VARCHAR(200) NULL,
  `sgd_archivo_cc_demandante` DECIMAL NULL,
  `sgd_archivo_depe` VARCHAR(5) NULL,
  `sgd_archivo_zona` VARCHAR(4) NULL,
  `sgd_archivo_carro` DECIMAL NULL,
  `sgd_archivo_cara` VARCHAR(4) NULL,
  `sgd_archivo_estante` DECIMAL NULL,
  `sgd_archivo_entrepano` DECIMAL NULL,
  `sgd_archivo_caja` DECIMAL NULL,
  `sgd_archivo_unidocu` VARCHAR(40) NULL,
  `sgd_archivo_anexo` VARCHAR(4000) NULL,
  `sgd_archivo_inder` DECIMAL NULL DEFAULT 0,
  `sgd_archivo_path` VARCHAR(4000) NULL,
  `sgd_archivo_year` DECIMAL(4,0) NULL,
  `sgd_archivo_rad` VARCHAR(15) NOT NULL,
  `sgd_archivo_srd` DECIMAL NULL,
  `sgd_archivo_folios` DECIMAL NULL,
  `sgd_archivo_mata` DECIMAL NULL DEFAULT 0,
  `sgd_archivo_fechaf` DATETIME NULL,
  `sgd_archivo_prestamo` DECIMAL(1,0) NULL,
  `sgd_archivo_funprest` CHAR(100) NULL,
  `sgd_archivo_fechprest` DATETIME NULL,
  `sgd_archivo_fechprestf` DATETIME NULL,
  `depe_codi` VARCHAR(5) NULL,
  `sgd_archivo_usua` VARCHAR(15) NULL,
  `sgd_archivo_fech` DATETIME NULL,
  PRIMARY KEY (`sgd_archivo_id`));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_archivo_hist
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_archivo_hist` (
  `depe_codi` VARCHAR(5) NOT NULL,
  `hist_fech` DATETIME NOT NULL,
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `sgd_archivo_rad` VARCHAR(14) NULL,
  `hist_obse` VARCHAR(600) NOT NULL,
  `usua_doc` VARCHAR(14) NULL,
  `sgd_ttr_codigo` DECIMAL(3,0) NULL,
  `hist_id` DECIMAL NULL,
  INDEX `hist_consulta_archivo` (`sgd_archivo_rad` ASC, `hist_fech` ASC, `depe_codi` ASC, `usua_codi` ASC),
  INDEX `hist_tipotrans_archivo` (`sgd_ttr_codigo` ASC),
  INDEX `sgd_archivo_rad` (`sgd_archivo_rad` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_arg_pliego
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_arg_pliego` (
  `sgd_arg_codigo` DECIMAL(2,0) NOT NULL,
  `sgd_arg_desc` VARCHAR(150) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_argd_argdoc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_argd_argdoc` (
  `sgd_argd_codi` DECIMAL(4,0) NOT NULL,
  `sgd_pnufe_codi` DECIMAL(4,0) NULL,
  `sgd_argd_tabla` VARCHAR(100) NULL,
  `sgd_argd_tcodi` VARCHAR(100) NULL,
  `sgd_argd_tdes` VARCHAR(100) NULL,
  `sgd_argd_llist` VARCHAR(150) NULL,
  `sgd_argd_campo` VARCHAR(100) NULL,
  UNIQUE INDEX `pk_sgd_argd_argdoc` (`sgd_argd_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_argup_argudoctop
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_argup_argudoctop` (
  `sgd_argup_codi` DECIMAL(4,0) NOT NULL,
  `sgd_argup_desc` VARCHAR(50) NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  UNIQUE INDEX `pk_sgd_argup_argudoctop` (`sgd_argup_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_auditoria
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_auditoria` (
  `fecha` VARCHAR(10) NULL,
  `usua_doc` VARCHAR(12) NULL,
  `ip` VARCHAR(15) NULL,
  `tipo` VARCHAR(5) NULL,
  `tabla` VARCHAR(50) NULL,
  `isql` LONGTEXT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_camexp_campoexpediente
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_camexp_campoexpediente` (
  `sgd_camexp_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_camexp_campo` VARCHAR(30) NOT NULL,
  `sgd_parexp_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_camexp_fk` DECIMAL NULL DEFAULT 0,
  `sgd_camexp_tablafk` VARCHAR(30) NULL,
  `sgd_camexp_campofk` VARCHAR(30) NULL,
  `sgd_camexp_campovalor` VARCHAR(30) NULL,
  `sgd_camexp_orden` DECIMAL(1,0) NULL,
  UNIQUE INDEX `pk_sgd_camexp_campoexpediente` (`sgd_camexp_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_carp_descripcion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_carp_descripcion` (
  `sgd_carp_depecodi` VARCHAR(5) NOT NULL,
  `sgd_carp_tiporad` DECIMAL(2,0) NOT NULL,
  `sgd_carp_descr` VARCHAR(40) NULL,
  PRIMARY KEY (`sgd_carp_depecodi`, `sgd_carp_tiporad`),
  CONSTRAINT `sgd_carp_descripcion_fk2`
    FOREIGN KEY (`sgd_carp_tiporad`)
    REFERENCES `orfeo`.`sgd_trad_tiporad` (`sgd_trad_codigo`)
    ON DELETE RESTRICT
    ON UPDATE NO ACTION);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_cau_causal
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_cau_causal` (
  `sgd_cau_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_cau_descrip` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_cau_causal` (`sgd_cau_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_caux_causales
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_caux_causales` (
  `sgd_caux_codigo` DECIMAL(10,0) NOT NULL,
  `radi_nume_radi` DECIMAL(15,0) NULL,
  `sgd_dcau_codigo` DECIMAL(4,0) NULL,
  `sgd_ddca_codigo` DECIMAL(4,0) NULL,
  `sgd_caux_fecha` DATE NULL,
  `usua_doc` VARCHAR(14) NULL,
  UNIQUE INDEX `pk_sgd_caux_causales` (`sgd_caux_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_ciu_ciudadano
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_ciu_ciudadano` (
  `tdid_codi` DECIMAL(2,0) NULL,
  `sgd_ciu_codigo` DECIMAL(8,0) NOT NULL,
  `sgd_ciu_nombre` VARCHAR(150) NULL,
  `sgd_ciu_direccion` VARCHAR(150) NULL,
  `sgd_ciu_apell1` VARCHAR(50) NULL,
  `sgd_ciu_apell2` VARCHAR(50) NULL,
  `sgd_ciu_telefono` VARCHAR(50) NULL,
  `sgd_ciu_email` VARCHAR(50) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `sgd_ciu_cedula` VARCHAR(13) NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  UNIQUE INDEX `idx_ciu` (`sgd_ciu_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_clta_clstarif
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_clta_clstarif` (
  `sgd_fenv_codigo` DECIMAL(5,0) NULL,
  `sgd_clta_codser` DECIMAL(5,0) NULL,
  `sgd_tar_codigo` DECIMAL(5,0) NULL,
  `sgd_clta_descrip` VARCHAR(100) NULL,
  `sgd_clta_pesdes` DECIMAL(15,0) NULL,
  `sgd_clta_peshast` DECIMAL(15,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_cob_campobliga
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_cob_campobliga` (
  `sgd_cob_codi` DECIMAL(4,0) NOT NULL,
  `sgd_cob_desc` VARCHAR(150) NULL,
  `sgd_cob_label` VARCHAR(50) NULL,
  `sgd_tidm_codi` DECIMAL(4,0) NULL,
  UNIQUE INDEX `pk_sgd_cob_campobliga` (`sgd_cob_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_dcau_causal
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_dcau_causal` (
  `sgd_dcau_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_cau_codigo` DECIMAL(4,0) NULL,
  `sgd_dcau_descrip` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_dcau_causal` (`sgd_dcau_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_ddca_ddsgrgdo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_ddca_ddsgrgdo` (
  `sgd_ddca_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_dcau_codigo` DECIMAL(4,0) NULL,
  `par_serv_secue` DECIMAL(8,0) NULL,
  `sgd_ddca_descrip` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_ddca_ddsgrgdo` (`sgd_ddca_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_def_contactos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_def_contactos` (
  `ctt_id` DECIMAL(15,0) NOT NULL,
  `ctt_nombre` VARCHAR(60) NOT NULL,
  `ctt_cargo` VARCHAR(60) NOT NULL,
  `ctt_telefono` VARCHAR(25) NULL,
  `ctt_id_tipo` DECIMAL(4,0) NOT NULL,
  `ctt_id_empresa` DECIMAL(15,0) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_def_continentes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_def_continentes` (
  `id_cont` DECIMAL(2,0) NULL,
  `nombre_cont` VARCHAR(20) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_def_paises
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_def_paises` (
  `id_pais` DECIMAL(4,0) NULL,
  `id_cont` DECIMAL(2,0) NOT NULL DEFAULT 1,
  `nombre_pais` VARCHAR(30) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_deve_dev_envio
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_deve_dev_envio` (
  `sgd_deve_codigo` DECIMAL(2,0) NOT NULL,
  `sgd_deve_desc` VARCHAR(150) NOT NULL,
  UNIQUE INDEX `pk_sgd_deve` (`sgd_deve_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_dir_drecciones
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_dir_drecciones` (
  `sgd_dir_codigo` DECIMAL(10,0) NOT NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NOT NULL,
  `sgd_oem_codigo` DECIMAL(8,0) NULL,
  `sgd_ciu_codigo` DECIMAL(8,0) NULL,
  `radi_nume_radi` DECIMAL(15,0) NULL,
  `sgd_esp_codi` DECIMAL(5,0) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(3,0) NULL,
  `sgd_dir_direccion` VARCHAR(150) NULL,
  `sgd_dir_telefono` VARCHAR(50) NULL,
  `sgd_dir_mail` VARCHAR(50) NULL,
  `sgd_sec_codigo` DECIMAL(13,0) NULL,
  `sgd_temporal_nombre` VARCHAR(150) NULL,
  `anex_codigo` DECIMAL(20,0) NULL,
  `sgd_anex_codigo` VARCHAR(20) NULL,
  `sgd_dir_nombre` VARCHAR(150) NULL,
  `sgd_doc_fun` VARCHAR(14) NULL,
  `sgd_dir_nomremdes` VARCHAR(1000) NULL,
  `sgd_trd_codigo` DECIMAL(1,0) NULL,
  `sgd_dir_tdoc` DECIMAL(1,0) NULL,
  `sgd_dir_doc` VARCHAR(14) NULL,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  INDEX `ind_anex_codigo` (`sgd_anex_codigo` ASC),
  INDEX `ind_dir_ciu_codigo` (`sgd_ciu_codigo` ASC),
  INDEX `ind_dir_direcc_sgd_esp_codi` (`sgd_esp_codi` ASC),
  INDEX `ind_sgd_dir_nombre` (`sgd_dir_nombre` ASC),
  INDEX `ind_sgd_dir_nomremdes` (`sgd_dir_nomremdes`(255) ASC),
  INDEX `ind_sgd_dir_oem_codigo` (`sgd_oem_codigo` ASC),
  INDEX `ind_sgd_dir_radi_nume` (`radi_nume_radi` ASC),
  INDEX `ind_sgd_doc_fun` (`sgd_doc_fun` ASC),
  INDEX `ind_sgd_trd_codigo` (`sgd_trd_codigo` ASC),
  UNIQUE INDEX `pk_sgd_dir` (`sgd_dir_codigo` ASC),
  INDEX `sgd_dir_drecciones_idx_001` (`sgd_dir_tipo` ASC, `radi_nume_radi` ASC, `sgd_esp_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_dnufe_docnufe
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_dnufe_docnufe` (
  `sgd_dnufe_codi` DECIMAL(4,0) NOT NULL,
  `sgd_pnufe_codi` DECIMAL(4,0) NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  `sgd_dnufe_label` VARCHAR(150) NULL,
  `trte_codi` DECIMAL(2,0) NULL,
  `sgd_dnufe_main` VARCHAR(1) NULL,
  `sgd_dnufe_path` VARCHAR(150) NULL,
  `sgd_dnufe_gerarq` VARCHAR(10) NULL,
  `anex_tipo_codi` DECIMAL(4,0) NULL,
  UNIQUE INDEX `pk_sgd_dnufe_docnufe` (`sgd_dnufe_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_dt_radicado
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_dt_radicado` (
  `radi_nume_radi` DECIMAL(14,0) NOT NULL,
  `dias_termino` DECIMAL(2,0) NOT NULL,
  PRIMARY KEY (`radi_nume_radi`));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_eanu_estanulacion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_eanu_estanulacion` (
  `sgd_eanu_desc` VARCHAR(150) NULL,
  `sgd_eanu_codi` DECIMAL NULL,
  UNIQUE INDEX `pk_estanulacion` (`sgd_eanu_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_einv_inventario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_einv_inventario` (
  `sgd_einv_codigo` DECIMAL NOT NULL,
  `sgd_depe_nomb` VARCHAR(400) NULL,
  `sgd_depe_codi` VARCHAR(3) NULL,
  `sgd_einv_expnum` VARCHAR(18) NULL,
  `sgd_einv_titulo` VARCHAR(400) NULL,
  `sgd_einv_unidad` DECIMAL NULL,
  `sgd_einv_fech` DATE NULL,
  `sgd_einv_fechfin` DATE NULL,
  `sgd_einv_radicados` VARCHAR(40) NULL,
  `sgd_einv_folios` DECIMAL NULL,
  `sgd_einv_nundocu` DECIMAL NULL,
  `sgd_einv_nundocubodega` DECIMAL NULL,
  `sgd_einv_caja` DECIMAL NULL,
  `sgd_einv_cajabodega` DECIMAL NULL,
  `sgd_einv_srd` DECIMAL NULL,
  `sgd_einv_nomsrd` VARCHAR(400) NULL,
  `sgd_einv_sbrd` DECIMAL NULL,
  `sgd_einv_nomsbrd` VARCHAR(400) NULL,
  `sgd_einv_retencion` VARCHAR(400) NULL,
  `sgd_einv_disfinal` VARCHAR(400) NULL,
  `sgd_einv_ubicacion` VARCHAR(400) NULL,
  `sgd_einv_observacion` VARCHAR(400) NULL,
  PRIMARY KEY (`sgd_einv_codigo`));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_eit_items
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_eit_items` (
  `sgd_eit_codigo` DECIMAL NOT NULL,
  `sgd_eit_cod_padre` DECIMAL NULL DEFAULT 0,
  `sgd_eit_nombre` VARCHAR(40) NULL,
  `sgd_eit_sigla` VARCHAR(6) NULL,
  `codi_dpto` DECIMAL(4,0) NULL,
  `codi_muni` DECIMAL(5,0) NULL,
  PRIMARY KEY (`sgd_eit_codigo`),
  INDEX `padre` (`sgd_eit_cod_padre` ASC),
  UNIQUE INDEX `sgd_eit_items_uk1` (`sgd_eit_cod_padre` ASC, `sgd_eit_nombre` ASC, `sgd_eit_sigla` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_eje_tema
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_eje_tema` (
  `sgd_tema_codigo` VARCHAR(10) NOT NULL,
  `sgd_tema_nomb` VARCHAR(150) NOT NULL,
  `sgd_tema_desc` VARCHAR(350) NOT NULL,
  `sgd_tema_plazo` DECIMAL(2,0) NULL,
  `sgd_tema_tpplazo` VARCHAR(50) NULL,
  `sgd_tema_estado` DECIMAL(2,0) NOT NULL,
  `sgd_tema_depe` DECIMAL(5,0) NOT NULL,
  PRIMARY KEY (`sgd_tema_codigo`));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_empus_empusuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_empus_empusuario` (
  `usua_login` VARCHAR(10) NULL,
  `identificador_empresa` DECIMAL(10,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_ent_entidades
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_ent_entidades` (
  `sgd_ent_nit` VARCHAR(13) NOT NULL,
  `sgd_ent_codsuc` VARCHAR(4) NOT NULL,
  `sgd_ent_pias` DECIMAL(5,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `sgd_ent_descrip` VARCHAR(80) NULL,
  `sgd_ent_direccion` VARCHAR(50) NULL,
  `sgd_ent_telefono` VARCHAR(50) NULL,
  UNIQUE INDEX `pk_sgd_ent` (`sgd_ent_nit` ASC, `sgd_ent_codsuc` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_enve_envioespecial
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_enve_envioespecial` (
  `sgd_fenv_codigo` DECIMAL(4,0) NULL,
  `sgd_enve_valorl` VARCHAR(30) NULL,
  `sgd_enve_valorn` VARCHAR(30) NULL,
  `sgd_enve_desc` VARCHAR(30) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_estc_estconsolid
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_estc_estconsolid` (
  `sgd_estc_codigo` DECIMAL NULL,
  `sgd_tpr_codigo` DECIMAL NULL,
  `dep_nombre` VARCHAR(30) NULL,
  `depe_codi` DECIMAL NULL,
  `sgd_estc_ctotal` DECIMAL NULL,
  `sgd_estc_centramite` DECIMAL NULL,
  `sgd_estc_csinriesgo` DECIMAL NULL,
  `sgd_estc_criesgomedio` DECIMAL NULL,
  `sgd_estc_criesgoalto` DECIMAL NULL,
  `sgd_estc_ctramitados` DECIMAL NULL,
  `sgd_estc_centermino` DECIMAL NULL,
  `sgd_estc_cfueratermino` DECIMAL NULL,
  `sgd_estc_fechgen` DATE NULL,
  `sgd_estc_fechini` DATE NULL,
  `sgd_estc_fechfin` DATE NULL,
  `sgd_estc_fechiniresp` DATE NULL,
  `sgd_estc_fechfinresp` DATE NULL,
  `sgd_estc_dsinriesgo` DECIMAL NULL,
  `sgd_estc_driesgomegio` DECIMAL NULL,
  `sgd_estc_driesgoalto` DECIMAL NULL,
  `sgd_estc_dtermino` DECIMAL NULL,
  `sgd_estc_grupgenerado` DECIMAL NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_estinst_estadoinstancia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_estinst_estadoinstancia` (
  `sgd_estinst_codi` DECIMAL(4,0) NULL,
  `sgd_apli_codi` DECIMAL(4,0) NULL,
  `sgd_instorf_codi` DECIMAL(4,0) NULL,
  `sgd_estinst_valor` DECIMAL(4,0) NULL,
  `sgd_estinst_habilita` DECIMAL(1,0) NULL,
  `sgd_estinst_mensaje` VARCHAR(100) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_exp_expediente
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_exp_expediente` (
  `sgd_exp_numero` VARCHAR(18) NULL,
  `radi_nume_radi` DECIMAL(18,0) NULL,
  `sgd_exp_fech` DATE NULL,
  `sgd_exp_fech_mod` DATE NULL,
  `depe_codi` DECIMAL(4,0) NULL,
  `usua_codi` DECIMAL(3,0) NULL,
  `usua_doc` VARCHAR(15) NULL,
  `sgd_exp_estado` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_exp_titulo` VARCHAR(50) NULL,
  `sgd_exp_asunto` VARCHAR(150) NULL,
  `sgd_exp_carpeta` VARCHAR(30) NULL,
  `sgd_exp_ufisica` VARCHAR(20) NULL,
  `sgd_exp_isla` VARCHAR(10) NULL,
  `sgd_exp_estante` VARCHAR(10) NULL,
  `sgd_exp_caja` VARCHAR(10) NULL,
  `sgd_exp_fech_arch` DATE NULL,
  `sgd_srd_codigo` DECIMAL(3,0) NULL,
  `sgd_sbrd_codigo` DECIMAL(3,0) NULL,
  `sgd_fexp_codigo` DECIMAL(3,0) NULL,
  `sgd_exp_subexpediente` VARCHAR(20) NULL,
  `sgd_exp_archivo` DECIMAL(1,0) NULL,
  `sgd_exp_unicon` DECIMAL(1,0) NULL,
  `sgd_exp_fechfin` DATE NULL,
  `sgd_exp_folios` VARCHAR(6) NULL,
  `sgd_exp_rete` DECIMAL(2,0) NULL,
  `sgd_exp_entrepa` DECIMAL(6,0) NULL,
  `radi_usua_arch` VARCHAR(40) NULL,
  `sgd_exp_edificio` VARCHAR(400) NULL,
  `sgd_exp_caja_bodega` VARCHAR(40) NULL,
  `sgd_exp_carro` VARCHAR(40) NULL,
  `sgd_exp_carpeta_bodega` VARCHAR(40) NULL,
  `sgd_exp_privado` DECIMAL(1,0) NULL,
  `sgd_exp_cd` VARCHAR(10) NULL,
  `sgd_exp_nref` VARCHAR(7) NULL,
  `sgd_sexp_paraexp1` VARCHAR(50) NULL,
  INDEX `ind_exp_radi` (`radi_nume_radi` ASC),
  INDEX `sgd_expediente_depe_usua` (`usua_codi` ASC, `depe_codi` ASC),
  INDEX `sgd_expediente_fecha` (`sgd_exp_fech` ASC),
  INDEX `sgd_expediente_nume_radi` (`sgd_exp_numero` ASC, `radi_nume_radi` ASC),
  INDEX `sgd_expediente_usua_doc` (`usua_doc` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_fars_faristas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_fars_faristas` (
  `sgd_fars_codigo` DECIMAL(5,0) NOT NULL,
  `sgd_pexp_codigo` DECIMAL(4,0) NULL,
  `sgd_fexp_codigoini` DECIMAL(6,0) NULL,
  `sgd_fexp_codigofin` DECIMAL(6,0) NULL,
  `sgd_fars_diasminimo` DECIMAL(3,0) NULL,
  `sgd_fars_diasmaximo` DECIMAL(3,0) NULL,
  `sgd_fars_desc` VARCHAR(100) NULL,
  `sgd_trad_codigo` DECIMAL(2,0) NULL,
  `sgd_srd_codigo` DECIMAL(3,0) NULL,
  `sgd_sbrd_codigo` DECIMAL(3,0) NULL,
  `sgd_fars_tipificacion` DECIMAL(1,0) NULL,
  `sgd_tpr_codigo` DECIMAL NULL,
  `sgd_fars_automatico` DECIMAL NULL,
  `sgd_fars_rolgeneral` DECIMAL NULL,
  UNIQUE INDEX `sgd_fars_faristas_pk` (`sgd_fars_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_fenv_frmenvio
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_fenv_frmenvio` (
  `sgd_fenv_codigo` DECIMAL(5,0) NOT NULL,
  `sgd_fenv_descrip` VARCHAR(40) NULL,
  `sgd_fenv_planilla` DECIMAL(1,0) NOT NULL DEFAULT 0,
  `sgd_fenv_estado` DECIMAL(1,0) NOT NULL DEFAULT 1,
  UNIQUE INDEX `pk_sgd_fenv` (`sgd_fenv_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_fexp_flujoexpedientes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_fexp_flujoexpedientes` (
  `sgd_fexp_codigo` DECIMAL(6,0) NULL,
  `sgd_pexp_codigo` DECIMAL(6,0) NULL,
  `sgd_fexp_orden` DECIMAL(4,0) NULL,
  `sgd_fexp_terminos` DECIMAL(4,0) NULL,
  `sgd_fexp_imagen` VARCHAR(50) NULL,
  `sgd_fexp_descrip` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_fexp_descrip` (`sgd_fexp_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_firrad_firmarads
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_firrad_firmarads` (
  `sgd_firrad_id` DECIMAL(15,0) NOT NULL,
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `usua_doc` VARCHAR(14) NOT NULL,
  `sgd_firrad_firma` VARCHAR(255) NULL,
  `sgd_firrad_fecha` DATE NULL,
  `sgd_firrad_docsolic` VARCHAR(14) NOT NULL,
  `sgd_firrad_fechsolic` DATE NOT NULL,
  `sgd_firrad_pk` VARCHAR(255) NULL,
  UNIQUE INDEX `pk_sgd_firrad_firmarads` (`sgd_firrad_id` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_fld_flujodoc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_fld_flujodoc` (
  `sgd_fld_codigo` DECIMAL(3,0) NULL,
  `sgd_fld_desc` VARCHAR(100) NULL,
  `sgd_tpr_codigo` DECIMAL(3,0) NULL,
  `sgd_fld_imagen` VARCHAR(50) NULL,
  `sgd_fld_grupoweb` INT NULL DEFAULT 0);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_fun_funciones
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_fun_funciones` (
  `sgd_fun_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_fun_descrip` VARCHAR(530) NULL,
  `sgd_fun_fech_ini` DATE NULL,
  `sgd_fun_fech_fin` DATE NULL,
  UNIQUE INDEX `pk_sgd_fun_funciones` (`sgd_fun_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_hfld_histflujodoc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_hfld_histflujodoc` (
  `sgd_hfld_codigo` DECIMAL(6,0) NULL,
  `sgd_fexp_codigo` DECIMAL(3,0) NOT NULL,
  `sgd_exp_fechflujoant` DATE NULL,
  `sgd_hfld_fech` DATETIME NULL,
  `sgd_exp_numero` VARCHAR(18) NULL,
  `radi_nume_radi` DECIMAL(15,0) NULL,
  `usua_doc` VARCHAR(10) NULL,
  `usua_codi` DECIMAL(10,0) NULL,
  `depe_codi` DECIMAL(4,0) NULL,
  `sgd_ttr_codigo` DECIMAL(2,0) NULL,
  `sgd_fexp_observa` VARCHAR(500) NULL,
  `sgd_hfld_observa` VARCHAR(500) NULL,
  `sgd_fars_codigo` DECIMAL NULL,
  `sgd_hfld_automatico` DECIMAL NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_hmtd_hismatdoc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_hmtd_hismatdoc` (
  `sgd_hmtd_codigo` DECIMAL(6,0) NOT NULL,
  `sgd_hmtd_fecha` DATE NOT NULL,
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `sgd_hmtd_obse` VARCHAR(600) NOT NULL,
  `usua_doc` DECIMAL(13,0) NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_mtd_codigo` DECIMAL(4,0) NULL,
  UNIQUE INDEX `pk_sgd_hmtd_hismatdoc` (`sgd_hmtd_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_instorf_instanciasorfeo
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_instorf_instanciasorfeo` (
  `sgd_instorf_codi` DECIMAL(4,0) NULL,
  `sgd_instorf_desc` VARCHAR(100) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_lip_linkip
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_lip_linkip` (
  `sgd_lip_id` DECIMAL(4,0) NOT NULL,
  `sgd_lip_ipini` VARCHAR(20) NOT NULL,
  `sgd_lip_ipfin` VARCHAR(20) NULL,
  `sgd_lip_dirintranet` VARCHAR(150) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `sgd_lip_arch` VARCHAR(70) NULL,
  `sgd_lip_diascache` DECIMAL(5,0) NULL,
  `sgd_lip_rutaftp` VARCHAR(150) NULL,
  `sgd_lip_servftp` VARCHAR(50) NULL,
  `sgd_lip_usbd` VARCHAR(20) NULL,
  `sgd_lip_nombd` VARCHAR(20) NULL,
  `sgd_lip_pwdbd` VARCHAR(20) NULL,
  `sgd_lip_usftp` VARCHAR(20) NULL,
  `sgd_lip_pwdftp` VARCHAR(30) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_mat_matriz
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_mat_matriz` (
  `sgd_mat_codigo` DECIMAL(4,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_fun_codigo` DECIMAL(4,0) NULL,
  `sgd_prc_codigo` DECIMAL(4,0) NULL,
  `sgd_prd_codigo` DECIMAL(4,0) NULL,
  `sgd_mat_fech_ini` DATE NULL,
  `sgd_mat_fech_fin` DATE NULL,
  `sgd_mat_peso_prd` DECIMAL(5,2) NULL,
  UNIQUE INDEX `pk_sgd_mat_matriz` (`sgd_mat_codigo` ASC),
  UNIQUE INDEX `uk_sgd_mat` (`depe_codi` ASC, `sgd_fun_codigo` ASC, `sgd_prc_codigo` ASC, `sgd_prd_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_mpes_mddpeso
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_mpes_mddpeso` (
  `sgd_mpes_codigo` DECIMAL(5,0) NOT NULL,
  `sgd_mpes_descrip` VARCHAR(10) NULL,
  UNIQUE INDEX `pk_sgd_mpes` (`sgd_mpes_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_mrd_matrird
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_mrd_matrird` (
  `sgd_mrd_codigo` DECIMAL(4,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `sgd_srd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_sbrd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NOT NULL,
  `soporte` VARCHAR(10) NULL,
  `sgd_mrd_fechini` DATE NULL,
  `sgd_mrd_fechfin` DATE NULL,
  `sgd_mrd_esta` VARCHAR(10) NULL,
  UNIQUE INDEX `pk_sgd_mrd_matrird` (`sgd_mrd_codigo` ASC),
  UNIQUE INDEX `uk_sgd_mrd_matrird` (`depe_codi` ASC, `sgd_srd_codigo` ASC, `sgd_sbrd_codigo` ASC, `sgd_tpr_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_msdep_msgdep
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_msdep_msgdep` (
  `sgd_msdep_codi` DECIMAL(15,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `sgd_msg_codi` DECIMAL(15,0) NOT NULL,
  UNIQUE INDEX `pk_sgd_msdep_msgdep` (`sgd_msdep_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_msg_mensaje
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_msg_mensaje` (
  `sgd_msg_codi` DECIMAL(15,0) NOT NULL,
  `sgd_tme_codi` DECIMAL(3,0) NOT NULL,
  `sgd_msg_desc` VARCHAR(150) NULL,
  `sgd_msg_fechdesp` DATE NOT NULL,
  `sgd_msg_url` VARCHAR(150) NOT NULL,
  `sgd_msg_veces` DECIMAL(3,0) NOT NULL,
  `sgd_msg_ancho` DECIMAL(6,0) NOT NULL,
  `sgd_msg_largo` DECIMAL(6,0) NOT NULL,
  UNIQUE INDEX `pk_sgd_msg_mensaje` (`sgd_msg_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_mtd_matriz_doc
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_mtd_matriz_doc` (
  `sgd_mtd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_mat_codigo` DECIMAL(4,0) NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  UNIQUE INDEX `pk_sgd_mtd_matriz_doc` (`sgd_mtd_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_noh_nohabiles
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_noh_nohabiles` (
  `noh_fecha` DATE NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_not_notificacion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_not_notificacion` (
  `sgd_not_codi` DECIMAL(3,0) NOT NULL,
  `sgd_not_descrip` VARCHAR(100) NOT NULL,
  UNIQUE INDEX `pk_sgd_not` (`sgd_not_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_ntrd_notifrad
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_ntrd_notifrad` (
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `sgd_not_codi` DECIMAL(3,0) NOT NULL,
  `sgd_ntrd_notificador` VARCHAR(150) NULL,
  `sgd_ntrd_notificado` VARCHAR(150) NULL,
  `sgd_ntrd_fecha_not` DATE NULL,
  `sgd_ntrd_num_edicto` DECIMAL(6,0) NULL,
  `sgd_ntrd_fecha_fija` DATE NULL,
  `sgd_ntrd_fecha_desfija` DATE NULL,
  `sgd_ntrd_observaciones` VARCHAR(150) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_oem_oempresas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_oem_oempresas` (
  `sgd_oem_codigo` DECIMAL(8,0) NOT NULL,
  `tdid_codi` DECIMAL(2,0) NULL,
  `sgd_oem_oempresa` VARCHAR(300) NULL,
  `sgd_oem_rep_legal` VARCHAR(300) NULL,
  `sgd_oem_nit` VARCHAR(14) NULL,
  `sgd_oem_sigla` VARCHAR(1000) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `sgd_oem_direccion` VARCHAR(1000) NULL,
  `sgd_oem_telefono` VARCHAR(1000) NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  `email` VARCHAR(1000) NULL,
  UNIQUE INDEX `pk_sgd_oem_oempresas` (`sgd_oem_codigo` ASC),
  INDEX `sgd_busq_nit` (`sgd_oem_nit` ASC),
  INDEX `sqg_busq_empresa` (`sgd_oem_oempresa`(255) ASC, `sgd_oem_sigla`(255) ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_panu_peranulados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_panu_peranulados` (
  `sgd_panu_codi` DECIMAL(4,0) NULL,
  `sgd_panu_desc` VARCHAR(200) NULL,
  UNIQUE INDEX `pk_peranualdos` (`sgd_panu_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_parametro
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_parametro` (
  `param_nomb` VARCHAR(25) NOT NULL,
  `param_codi` DECIMAL(5,0) NOT NULL,
  `param_valor` VARCHAR(25) NOT NULL,
  UNIQUE INDEX `sgd_parametro_pk` (`param_nomb` ASC, `param_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_parexp_paramexpediente
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_parexp_paramexpediente` (
  `sgd_parexp_codigo` DECIMAL(4,0) NOT NULL,
  `depe_codi` DECIMAL(4,0) NOT NULL,
  `sgd_parexp_tabla` VARCHAR(30) NOT NULL,
  `sgd_parexp_etiqueta` VARCHAR(15) NOT NULL,
  `sgd_parexp_orden` DECIMAL(1,0) NULL,
  `sgd_parexp_editable` DECIMAL(1,0) NULL,
  UNIQUE INDEX `pk_sgd_parexp_paramexpediente` (`sgd_parexp_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_pen_pensionados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_pen_pensionados` (
  `tdid_codi` DECIMAL(2,0) NULL,
  `sgd_ciu_codigo` DECIMAL(8,0) NOT NULL,
  `sgd_ciu_nombre` VARCHAR(150) NULL,
  `sgd_ciu_direccion` VARCHAR(150) NULL,
  `sgd_ciu_apell1` VARCHAR(50) NULL,
  `sgd_ciu_apell2` VARCHAR(50) NULL,
  `sgd_ciu_telefono` VARCHAR(50) NULL,
  `sgd_ciu_email` VARCHAR(50) NULL,
  `muni_codi` DECIMAL(4,0) NULL,
  `dpto_codi` DECIMAL(2,0) NULL,
  `sgd_ciu_cedula` VARCHAR(20) NULL,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_pexp_procexpedientes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_pexp_procexpedientes` (
  `sgd_pexp_codigo` DECIMAL NOT NULL,
  `sgd_pexp_descrip` VARCHAR(100) NULL,
  `sgd_pexp_terminos` DECIMAL NULL DEFAULT 0,
  `sgd_srd_codigo` DECIMAL(3,0) NULL,
  `sgd_sbrd_codigo` DECIMAL(3,0) NULL,
  `sgd_pexp_automatico` DECIMAL(1,0) NULL DEFAULT 1,
  `sgd_pexp_tieneflujo` DECIMAL(1,0) NULL DEFAULT 0,
  UNIQUE INDEX `pk_sgd_pexp_procexpedientes` (`sgd_pexp_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_pnufe_procnumfe
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_pnufe_procnumfe` (
  `sgd_pnufe_codi` DECIMAL(4,0) NOT NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  `sgd_pnufe_descrip` VARCHAR(150) NULL,
  `sgd_pnufe_serie` VARCHAR(50) NULL,
  UNIQUE INDEX `pk_sgd_pnufe_procnumfe` (`sgd_pnufe_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_pnun_procenum
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_pnun_procenum` (
  `sgd_pnun_codi` DECIMAL(4,0) NOT NULL,
  `sgd_pnufe_codi` DECIMAL(4,0) NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_pnun_prepone` VARCHAR(50) NULL,
  UNIQUE INDEX `pk_sgd_pnun_procenum` (`sgd_pnun_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_prc_proceso
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_prc_proceso` (
  `sgd_prc_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_prc_descrip` VARCHAR(150) NULL,
  `sgd_prc_fech_ini` DATE NULL,
  `sgd_prc_fech_fin` DATE NULL,
  UNIQUE INDEX `pk_sgd_prc_proceso` (`sgd_prc_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_prd_prcdmentos
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_prd_prcdmentos` (
  `sgd_prd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_prd_descrip` VARCHAR(200) NULL,
  `sgd_prd_fech_ini` DATE NULL,
  `sgd_prd_fech_fin` DATE NULL,
  UNIQUE INDEX `pk_sgd_prd_prcdmentos` (`sgd_prd_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_rda_retdoca
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_rda_retdoca` (
  `anex_radi_nume` DECIMAL(15,0) NOT NULL,
  `anex_codigo` VARCHAR(20) NOT NULL,
  `radi_nume_salida` DECIMAL(15,0) NULL,
  `anex_borrado` VARCHAR(1) NULL,
  `sgd_mrd_codigo` DECIMAL(4,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `usua_doc` VARCHAR(14) NOT NULL,
  `sgd_rda_fech` DATE NULL,
  `sgd_deve_codigo` DECIMAL(2,0) NULL,
  `anex_solo_lect` VARCHAR(1) NULL,
  `anex_radi_fech` DATE NULL,
  `anex_estado` DECIMAL(1,0) NULL,
  `anex_nomb_archivo` VARCHAR(50) NULL,
  `anex_tipo` DECIMAL(4,0) NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_rdf_retdocf
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_rdf_retdocf` (
  `sgd_mrd_codigo` DECIMAL(4,0) NOT NULL,
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `usua_doc` VARCHAR(14) NOT NULL,
  `sgd_rdf_fech` DATE NOT NULL,
  UNIQUE INDEX `uk_sgd_rdf_retdocf` (`radi_nume_radi` ASC, `depe_codi` ASC, `sgd_mrd_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_renv_regenvio
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_renv_regenvio` (
  `sgd_renv_codigo` DECIMAL NOT NULL,
  `sgd_fenv_codigo` DECIMAL NULL,
  `sgd_renv_fech` DATETIME NULL,
  `radi_nume_sal` DECIMAL NULL,
  `sgd_renv_destino` LONGTEXT NULL,
  `sgd_renv_telefono` LONGTEXT NULL,
  `sgd_renv_mail` LONGTEXT NULL,
  `sgd_renv_peso` LONGTEXT NULL,
  `sgd_renv_valor` DECIMAL NULL,
  `sgd_renv_certificado` DECIMAL NULL,
  `sgd_renv_estado` DECIMAL NULL,
  `usua_doc` DECIMAL NULL,
  `sgd_renv_nombre` LONGTEXT NULL,
  `sgd_rem_destino` DECIMAL NULL DEFAULT 0,
  `sgd_dir_codigo` DECIMAL NULL,
  `sgd_renv_planilla` VARCHAR(8) NULL,
  `sgd_renv_fech_sal` DATETIME NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NULL DEFAULT 0,
  `radi_nume_grupo` DECIMAL(14,0) NULL,
  `sgd_renv_dir` VARCHAR(100) NULL,
  `sgd_renv_depto` VARCHAR(30) NULL,
  `sgd_renv_mpio` VARCHAR(30) NULL,
  `sgd_renv_tel` VARCHAR(20) NULL,
  `sgd_renv_cantidad` DECIMAL(4,0) NULL DEFAULT 0,
  `sgd_renv_tipo` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_renv_observa` VARCHAR(200) NULL,
  `sgd_renv_grupo` DECIMAL(14,0) NULL,
  `sgd_deve_codigo` DECIMAL(2,0) NULL,
  `sgd_deve_fech` DATETIME NULL,
  `sgd_renv_valortotal` VARCHAR(14) NULL DEFAULT 0,
  `sgd_renv_valistamiento` VARCHAR(10) NULL DEFAULT 0,
  `sgd_renv_vdescuento` VARCHAR(10) NULL DEFAULT 0,
  `sgd_renv_vadicional` VARCHAR(14) NULL DEFAULT 0,
  `sgd_depe_genera` DECIMAL(5,0) NULL,
  `sgd_renv_pais` VARCHAR(30) NULL DEFAULT 'colombia',
  `sgd_renv_guia` VARCHAR(10) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_renv_regenvio1
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_renv_regenvio1` (
  `sgd_renv_codigo` DECIMAL(6,0) NOT NULL,
  `sgd_fenv_codigo` DECIMAL(5,0) NULL,
  `sgd_renv_fech` DATE NULL,
  `radi_nume_sal` DECIMAL(14,0) NULL,
  `sgd_renv_destino` VARCHAR(150) NULL,
  `sgd_renv_telefono` VARCHAR(50) NULL,
  `sgd_renv_mail` VARCHAR(150) NULL,
  `sgd_renv_peso` VARCHAR(10) NULL,
  `sgd_renv_valor` VARCHAR(10) NULL,
  `sgd_renv_certificado` DECIMAL(1,0) NULL,
  `sgd_renv_estado` DECIMAL(1,0) NULL,
  `usua_doc` DECIMAL(15,0) NULL,
  `sgd_renv_nombre` VARCHAR(100) NULL,
  `sgd_rem_destino` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_dir_codigo` DECIMAL(10,0) NULL,
  `sgd_renv_planilla` VARCHAR(8) NULL,
  `sgd_renv_fech_sal` DATE NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NULL DEFAULT 0,
  `radi_nume_grupo` DECIMAL(14,0) NULL,
  `sgd_renv_dir` VARCHAR(100) NULL,
  `sgd_renv_depto` VARCHAR(30) NULL,
  `sgd_renv_mpio` VARCHAR(30) NULL,
  `sgd_renv_tel` VARCHAR(20) NULL,
  `sgd_renv_cantidad` DECIMAL(4,0) NULL DEFAULT 0,
  `sgd_renv_tipo` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_renv_observa` VARCHAR(200) NULL,
  `sgd_renv_grupo` DECIMAL(14,0) NULL,
  `sgd_deve_codigo` DECIMAL(2,0) NULL,
  `sgd_deve_fech` DATE NULL,
  `sgd_renv_valortotal` VARCHAR(14) NULL DEFAULT 0,
  `sgd_renv_valistamiento` VARCHAR(10) NULL DEFAULT 0,
  `sgd_renv_vdescuento` VARCHAR(10) NULL DEFAULT 0,
  `sgd_renv_vadicional` VARCHAR(14) NULL DEFAULT 0,
  `sgd_depe_genera` DECIMAL(5,0) NULL,
  `sgd_renv_pais` VARCHAR(30) NULL DEFAULT 'colombia',
  INDEX `ind_regenvio_depcodi` (`depe_codi` ASC),
  INDEX `ind_renv_codigo` (`sgd_renv_codigo` ASC),
  INDEX `ind_renv_fech` (`sgd_renv_fech` ASC),
  INDEX `ind_renv_fech_sal` (`sgd_renv_fech_sal` ASC),
  INDEX `ind_renv_fenv` (`sgd_fenv_codigo` ASC),
  INDEX `ind_renv_grupo` (`sgd_renv_grupo` ASC),
  INDEX `ind_renv_radi_sal` (`radi_nume_sal` ASC, `depe_codi` ASC, `sgd_fenv_codigo` ASC),
  INDEX `ind_sgd_renv_planilla` (`sgd_renv_planilla` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_rfax_reservafax
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_rfax_reservafax` (
  `sgd_rfax_codigo` DECIMAL(10,0) NULL,
  `sgd_rfax_fax` VARCHAR(30) NULL,
  `usua_login` VARCHAR(30) NULL,
  `sgd_rfax_fech` DATE NULL,
  `sgd_rfax_fechradi` DATE NULL,
  `radi_nume_radi` DECIMAL(15,0) NULL,
  `sgd_rfax_observa` VARCHAR(500) NULL,
  INDEX `ind_rfax_codigo` (`sgd_rfax_codigo` ASC),
  INDEX `ind_rfax_fax` (`sgd_rfax_fax` ASC),
  INDEX `ind_rfax_fech` (`sgd_rfax_fech` ASC),
  INDEX `ind_rfax_radi_nume_radi` (`radi_nume_radi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_rmr_radmasivre
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_rmr_radmasivre` (
  `sgd_rmr_grupo` DECIMAL(15,0) NOT NULL,
  `sgd_rmr_radi` DECIMAL(15,0) NOT NULL,
  UNIQUE INDEX `pk_sgd_rmr_radmasivre` (`sgd_rmr_grupo` ASC, `sgd_rmr_radi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_san_sancionados
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_san_sancionados` (
  `sgd_san_ref` VARCHAR(20) NOT NULL,
  `sgd_san_decision` VARCHAR(60) NULL,
  `sgd_san_cargo` VARCHAR(50) NULL,
  `sgd_san_expediente` VARCHAR(20) NULL,
  `sgd_san_tipo_sancion` VARCHAR(50) NULL,
  `sgd_san_plazo` VARCHAR(100) NULL,
  `sgd_san_valor` DECIMAL(14,2) NULL,
  `sgd_san_radicacion` VARCHAR(15) NULL,
  `sgd_san_fecha_radicado` DATE NULL,
  `sgd_san_valorletras` VARCHAR(1000) NULL,
  `sgd_san_nombreempresa` VARCHAR(160) NULL,
  `sgd_san_motivos` VARCHAR(160) NULL,
  `sgd_san_sectores` VARCHAR(160) NULL,
  `sgd_san_padre` VARCHAR(15) NULL,
  `sgd_san_fecha_padre` DATE NULL,
  `sgd_san_notificado` VARCHAR(100) NULL,
  UNIQUE INDEX `pk_sgd_san_sancionados` (`sgd_san_ref` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_san_sancionados_x
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_san_sancionados_x` (
  `radi_nume_radi` DECIMAL(15,0) NOT NULL,
  `sgd_san_decision` VARCHAR(60) NULL,
  `sgd_san_cargo` VARCHAR(50) NULL,
  `sgd_san_expediente` VARCHAR(15) NULL,
  `sgd_san_tipo_sancion` VARCHAR(50) NULL,
  `sgd_san_plazo` VARCHAR(100) NULL,
  `sgd_san_valor` DECIMAL(14,2) NULL,
  `sgd_san_radicacion` VARCHAR(15) NULL,
  `sgd_san_fecha_radicado` DATE NULL,
  `sgd_san_valorletras` VARCHAR(1000) NULL,
  `sgd_san_nombreempresa` VARCHAR(160) NULL,
  `sgd_san_motivos` VARCHAR(160) NULL,
  `sgd_san_sectores` VARCHAR(160) NULL,
  `sgd_san_padre` VARCHAR(15) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_sbrd_subserierd
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_sbrd_subserierd` (
  `sgd_srd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_sbrd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_sbrd_descrip` VARCHAR(500) NOT NULL,
  `sgd_sbrd_fechini` DATE NOT NULL,
  `sgd_sbrd_fechfin` DATE NOT NULL,
  `sgd_sbrd_tiemag` DECIMAL(4,0) NULL,
  `sgd_sbrd_tiemac` DECIMAL(4,0) NULL,
  `sgd_sbrd_dispfin` VARCHAR(50) NULL,
  `sgd_sbrd_soporte` VARCHAR(50) NULL,
  `sgd_sbrd_procedi` VARCHAR(1500) NULL,
  UNIQUE INDEX `uk_sgd_sbrd_subserierd` (`sgd_srd_codigo` ASC, `sgd_sbrd_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_sed_sede
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_sed_sede` (
  `sgd_sed_codi` DECIMAL(4,0) NOT NULL,
  `sgd_sed_desc` VARCHAR(50) NULL,
  UNIQUE INDEX `sede_codi` (`sgd_sed_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_senuf_secnumfe
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_senuf_secnumfe` (
  `sgd_senuf_codi` DECIMAL(4,0) NOT NULL,
  `sgd_pnufe_codi` DECIMAL(4,0) NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_senuf_sec` VARCHAR(50) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_sexp_secexpedientes
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_sexp_secexpedientes` (
  `sgd_exp_numero` VARCHAR(18) NOT NULL,
  `sgd_srd_codigo` DECIMAL NULL,
  `sgd_sbrd_codigo` DECIMAL NULL,
  `sgd_sexp_secuencia` DECIMAL NULL,
  `depe_codi` DECIMAL NULL,
  `usua_doc` VARCHAR(15) NULL,
  `sgd_sexp_fech` DATE NULL,
  `sgd_fexp_codigo` DECIMAL NULL,
  `sgd_sexp_ano` DECIMAL NULL,
  `usua_doc_responsable` VARCHAR(18) NULL,
  `sgd_sexp_parexp1` VARCHAR(250) NULL,
  `sgd_sexp_parexp2` VARCHAR(160) NULL,
  `sgd_sexp_parexp3` VARCHAR(160) NULL,
  `sgd_sexp_parexp4` VARCHAR(160) NULL,
  `sgd_sexp_parexp5` VARCHAR(160) NULL,
  `sgd_pexp_codigo` DECIMAL(3,0) NULL,
  `sgd_exp_fech_arch` DATE NULL,
  `sgd_fld_codigo` DECIMAL(3,0) NULL,
  `sgd_exp_fechflujoant` DATE NULL,
  `sgd_mrd_codigo` DECIMAL(4,0) NULL,
  `sgd_exp_subexpediente` DECIMAL(18,0) NULL,
  `sgd_exp_privado` DECIMAL(1,0) NULL,
  `sgd_sexp_estado` DECIMAL(1,0) NOT NULL DEFAULT 0,
  UNIQUE INDEX `pk_sgd_sexp_secexpedientes` (`sgd_exp_numero` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_srd_seriesrd
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_srd_seriesrd` (
  `sgd_srd_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_srd_descrip` VARCHAR(60) NOT NULL,
  `sgd_srd_fechini` DATE NOT NULL,
  `sgd_srd_fechfin` DATE NOT NULL,
  UNIQUE INDEX `pk_sgd_srd_seriesrd` (`sgd_srd_codigo` ASC),
  UNIQUE INDEX `uk_sgd_srd_descrip` (`sgd_srd_descrip` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tar_tarifas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tar_tarifas` (
  `sgd_fenv_codigo` DECIMAL(5,0) NULL,
  `sgd_tar_codser` DECIMAL(5,0) NULL,
  `sgd_tar_codigo` DECIMAL(5,0) NULL,
  `sgd_tar_valenv1` DECIMAL(15,0) NULL,
  `sgd_tar_valenv2` DECIMAL(15,0) NULL,
  `sgd_tar_valenv1g1` DECIMAL(15,0) NULL,
  `sgd_clta_codser` DECIMAL(5,0) NULL,
  `sgd_tar_valenv2g2` DECIMAL(15,0) NULL,
  `sgd_clta_descrip` VARCHAR(100) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tdec_tipodecision
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tdec_tipodecision` (
  `sgd_apli_codi` DECIMAL(4,0) NOT NULL,
  `sgd_tdec_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_tdec_descrip` VARCHAR(150) NULL,
  `sgd_tdec_sancionar` DECIMAL(1,0) NULL,
  `sgd_tdec_firmeza` DECIMAL(1,0) NULL,
  `sgd_tdec_versancion` DECIMAL(1,0) NULL,
  `sgd_tdec_showmenu` DECIMAL(1,0) NULL,
  `sgd_tdec_updnotif` DECIMAL(1,0) NULL,
  `sgd_tdec_veragota` DECIMAL(1,0) NULL,
  UNIQUE INDEX `pk_sgd_tdec_tipodecision` (`sgd_tdec_codigo` ASC),
  INDEX `sgd_tdec_tipodecision_inx1` (`sgd_tdec_showmenu` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tid_tipdecision
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tid_tipdecision` (
  `sgd_tid_codi` DECIMAL(4,0) NOT NULL,
  `sgd_tid_desc` VARCHAR(150) NULL,
  `sgd_tpr_codigo` DECIMAL(4,0) NULL,
  `sgd_pexp_codigo` DECIMAL(2,0) NULL,
  `sgd_tpr_codigop` DECIMAL(2,0) NULL,
  UNIQUE INDEX `pk_sgd_tid_tipdecision` (`sgd_tid_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tidm_tidocmasiva
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tidm_tidocmasiva` (
  `sgd_tidm_codi` DECIMAL(4,0) NOT NULL,
  `sgd_tidm_desc` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_tdm_tidomasiva` (`sgd_tidm_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tip3_tipotercero
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tip3_tipotercero` (
  `sgd_tip3_codigo` DECIMAL(2,0) NOT NULL,
  `sgd_dir_tipo` DECIMAL(4,0) NULL,
  `sgd_tip3_nombre` VARCHAR(15) NULL,
  `sgd_tip3_desc` VARCHAR(30) NULL,
  `sgd_tip3_imgpestana` VARCHAR(20) NULL,
  `sgd_tpr_tp1` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_tpr_tp2` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_tpr_tp4` SMALLINT NULL DEFAULT 1,
  `sgd_tpr_tp3` SMALLINT NULL DEFAULT 1,
  `sgd_tpr_tp5` SMALLINT NULL DEFAULT 1);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tma_temas
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tma_temas` (
  `sgd_tma_codigo` DECIMAL(4,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NULL,
  `sgd_prc_codigo` DECIMAL(4,0) NULL,
  `sgd_tma_descrip` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_tma_temas` (`sgd_tma_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tme_tipmen
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tme_tipmen` (
  `sgd_tme_codi` DECIMAL(3,0) NOT NULL,
  `sgd_tme_desc` VARCHAR(150) NULL,
  UNIQUE INDEX `pk_sgd_tme_tipmen` (`sgd_tme_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tpr_tpdcumento
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tpr_tpdcumento` (
  `sgd_tpr_codigo` DECIMAL(4,0) NOT NULL,
  `sgd_tpr_descrip` VARCHAR(500) NULL,
  `sgd_tpr_termino` DECIMAL(4,0) NULL,
  `sgd_tpr_tpuso` DECIMAL(1,0) NULL,
  `sgd_tpr_numera` CHAR(1) NULL,
  `sgd_tpr_radica` CHAR(1) NULL,
  `sgd_tpr_tp1` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_tpr_tp2` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_tpr_estado` DECIMAL(1,0) NULL,
  `sgd_termino_real` DECIMAL(4,0) NULL,
  `sgd_tpr_web` SMALLINT NULL DEFAULT 1,
  `sgd_tpr_tiptermino` VARCHAR(5) NULL,
  `sgd_tpr_tp4` SMALLINT NULL,
  `sgd_tpr_tp3` SMALLINT NULL,
  `sgd_tpr_tp5` SMALLINT NULL,
  INDEX `ind_sgd_tpr_tpdocdescrp` (`sgd_tpr_descrip`(255) ASC),
  UNIQUE INDEX `pk_sgd_tpr_tpdcumento` (`sgd_tpr_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_trad_tiporad
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_trad_tiporad` (
  `sgd_trad_codigo` DECIMAL(2,0) NOT NULL,
  `sgd_trad_descr` VARCHAR(30) NULL,
  `sgd_trad_icono` VARCHAR(30) NULL,
  `sgd_trad_diasbloqueo` DECIMAL(2,0) NULL,
  `sgd_trad_genradsal` SMALLINT NULL,
  PRIMARY KEY (`sgd_trad_codigo`),
  UNIQUE INDEX `sgd_trad_tiporad_codigo_inx2` (`sgd_trad_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_ttr_transaccion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_ttr_transaccion` (
  `sgd_ttr_codigo` DECIMAL(3,0) NOT NULL,
  `sgd_ttr_descrip` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`sgd_ttr_codigo`),
  UNIQUE INDEX `pk_sgd_ttr_transaccion` (`sgd_ttr_codigo` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tvd_dependencia
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tvd_dependencia` (
  `sgd_depe_codi` DECIMAL(5,0) NOT NULL,
  `sgd_depe_nombre` VARCHAR(200) NOT NULL,
  `sgd_depe_fechini` DATE NOT NULL,
  `sgd_depe_fechfin` DATE NOT NULL,
  UNIQUE INDEX `sgd_tvd_dependencia_id` (`sgd_depe_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_tvd_series
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_tvd_series` (
  `sgd_depe_codi` DECIMAL(4,0) NOT NULL,
  `sgd_stvd_codi` DECIMAL(4,0) NOT NULL,
  `sgd_stvd_nombre` VARCHAR(200) NOT NULL,
  `sgd_stvd_ac` DECIMAL(4,0) NULL,
  `sgd_stvd_dispfin` DECIMAL(2,0) NULL,
  `sgd_stvd_proc` VARCHAR(500) NULL,
  PRIMARY KEY (`sgd_depe_codi`, `sgd_stvd_codi`));

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_ush_usuhistorico
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_ush_usuhistorico` (
  `sgd_ush_admcod` DECIMAL(10,0) NOT NULL,
  `sgd_ush_admdep` DECIMAL(5,0) NOT NULL,
  `sgd_ush_admdoc` VARCHAR(14) NOT NULL,
  `sgd_ush_usucod` DECIMAL(10,0) NOT NULL,
  `sgd_ush_usudep` DECIMAL(5,0) NOT NULL,
  `sgd_ush_usudoc` VARCHAR(14) NOT NULL,
  `sgd_ush_modcod` DECIMAL(5,0) NOT NULL,
  `sgd_ush_fechevento` DATE NOT NULL,
  `sgd_ush_usulogin` VARCHAR(20) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.sgd_usm_usumodifica
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`sgd_usm_usumodifica` (
  `sgd_usm_modcod` DECIMAL(5,0) NOT NULL,
  `sgd_usm_moddescr` VARCHAR(60) NOT NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.tipo_doc_identificacion
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`tipo_doc_identificacion` (
  `tdid_codi` DECIMAL(2,0) NOT NULL,
  `tdid_desc` VARCHAR(100) NOT NULL,
  UNIQUE INDEX `tipo_doc_identificacion_pk` (`tdid_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.tipo_remitente
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`tipo_remitente` (
  `trte_codi` DECIMAL(2,0) NOT NULL,
  `trte_desc` VARCHAR(100) NOT NULL,
  UNIQUE INDEX `tipo_remitente_pk` (`trte_codi` ASC));

-- ----------------------------------------------------------------------------
-- Table orfeo.ubicacion_fisica
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`ubicacion_fisica` (
  `ubic_depe_radi` DECIMAL(5,0) NULL,
  `ubic_depe_arch` DECIMAL(5,0) NULL);

-- ----------------------------------------------------------------------------
-- Table orfeo.usuario
-- ----------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `orfeo`.`usuario` (
  `usua_codi` DECIMAL(10,0) NOT NULL,
  `depe_codi` DECIMAL(5,0) NOT NULL,
  `usua_login` VARCHAR(50) NOT NULL,
  `usua_fech_crea` DATE NULL,
  `usua_pasw` VARCHAR(35) NOT NULL,
  `usua_esta` VARCHAR(10) NOT NULL,
  `usua_nomb` VARCHAR(45) NULL,
  `perm_radi` CHAR(1) NULL DEFAULT 0,
  `usua_admin` CHAR(1) NULL DEFAULT 0,
  `usua_nuevo` CHAR(1) NULL DEFAULT 0,
  `usua_doc` VARCHAR(14) NULL DEFAULT 0,
  `codi_nivel` DECIMAL(2,0) NULL DEFAULT 1,
  `usua_sesion` VARCHAR(30) NULL,
  `usua_fech_sesion` DATE NULL,
  `usua_ext` DECIMAL(4,0) NULL,
  `usua_nacim` DATE NULL,
  `usua_email` VARCHAR(50) NULL,
  `usua_at` VARCHAR(50) NULL,
  `usua_piso` DECIMAL(2,0) NULL,
  `perm_radi_sal` DECIMAL NULL DEFAULT 0,
  `usua_admin_archivo` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_masiva` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_perm_dev` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_perm_numera_res` VARCHAR(1) NULL,
  `usua_doc_suip` VARCHAR(15) NULL,
  `usua_perm_numeradoc` DECIMAL(1,0) NULL,
  `sgd_panu_codi` DECIMAL(4,0) NULL,
  `usua_prad_tp1` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_prad_tp2` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_perm_envios` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_perm_modifica` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_perm_impresion` DECIMAL(1,0) NULL DEFAULT 0,
  `sgd_aper_codigo` DECIMAL(2,0) NULL,
  `usu_telefono1` VARCHAR(14) NULL,
  `usua_encuesta` VARCHAR(1) NULL,
  `sgd_perm_estadistica` DECIMAL(2,0) NULL,
  `usua_perm_sancionados` DECIMAL(1,0) NULL,
  `usua_admin_sistema` DECIMAL(1,0) NULL,
  `usua_perm_trd` DECIMAL(1,0) NULL,
  `usua_perm_firma` DECIMAL(1,0) NULL,
  `usua_perm_prestamo` DECIMAL(1,0) NULL,
  `usuario_publico` DECIMAL(1,0) NULL,
  `usuario_reasignar` DECIMAL(1,0) NULL,
  `usua_perm_notifica` DECIMAL(1,0) NULL,
  `usua_perm_expediente` DECIMAL NULL,
  `usua_login_externo` VARCHAR(15) NULL,
  `id_pais` DECIMAL(4,0) NULL DEFAULT 170,
  `id_cont` DECIMAL(2,0) NULL DEFAULT 1,
  `usua_auth_ldap` DECIMAL(1,0) NULL DEFAULT 0,
  `perm_archi` CHAR(1) NULL DEFAULT 1,
  `perm_vobo` CHAR(1) NULL DEFAULT 1,
  `perm_borrar_anexo` DECIMAL(1,0) NULL,
  `perm_tipif_anexo` DECIMAL(1,0) NULL,
  `usua_perm_adminflujos` DECIMAL(1,0) NOT NULL DEFAULT 0,
  `usua_exp_trd` DECIMAL(2,0) NULL DEFAULT 0,
  `usua_perm_rademail` SMALLINT NULL,
  `usua_prad_tp4` SMALLINT NULL,
  `usua_perm_accesi` DECIMAL(1,0) NULL DEFAULT 0,
  `usua_prad_tp3` SMALLINT NULL,
  `usua_prad_tp5` SMALLINT NULL,
  `usua_perm_agrcontacto` DECIMAL(1,0) NULL DEFAULT 0,
  PRIMARY KEY (`usua_login`),
  INDEX `usua_doc` (`usua_doc` ASC),
  INDEX `usuario_depe_codi` (`depe_codi` ASC),
  UNIQUE INDEX `usuario_pk` (`usua_login` ASC),
  UNIQUE INDEX `usuario_uk` (`usua_codi` ASC, `depe_codi` ASC),
  UNIQUE INDEX `usuario_uk3` (`usua_codi` ASC, `depe_codi` ASC));

-- ----------------------------------------------------------------------------
-- View orfeo.V_USUARIO
-- ----------------------------------------------------------------------------
-- USE `orfeo`;
-- SELECT usuario.usua_codi, usuario.usua_nomb, usuario.usua_login, usuario.depe_codi FROM usuario;;

-- ----------------------------------------------------------------------------
-- View orfeo.rad1000
-- ----------------------------------------------------------------------------
-- USE `orfeo`;
-- SELECT radicado.radi_nume_radi, radicado.radi_fech_radi FROM radicado WHERE (((((((((radicado.radi_nume_radi = ((1995000001142::bigint - 5))::numeric) OR (radicado.radi_nume_radi = ((1995000001281::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1995000001387::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000015::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000374::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000390::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000526::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000647::bigint - 5))::numeric)) OR (radicado.radi_nume_radi = ((1996000000717::bigint - 5))::numeric));;

-- ----------------------------------------------------------------------------
-- View orfeo.sgd_est_estadi
-- ----------------------------------------------------------------------------
-- USE `orfeo`;
-- SELECT a.radi_nume_radi, a.radi_fech_radi, a.radi_depe_radi, a.radi_usua_radi, a.radi_depe_actu, a.radi_usua_actu, a.trte_codi, a.tdid_codi, a.radi_nomb, a.eesp_codi, b.usua_nomb, c.depe_nomb, d.tdid_desc FROM radicado a, usuario b, dependencia c, tipo_doc_identificacion d, tipo_remitente e WHERE (((((a.radi_usua_actu = b.usua_codi) AND (a.radi_depe_actu = b.depe_codi)) AND (a.radi_depe_actu = c.depe_codi)) AND (d.tdid_codi = a.tdoc_codi)) AND (a.trte_codi = e.trte_codi));;
SET FOREIGN_KEY_CHECKS = 1;;
