CREATE TABLE anexos (
	anex_radi_nume NUMBER(15) NOT NULL,
	anex_codigo VARCHAR2(20) NOT NULL,
	anex_tipo NUMBER(4) NOT NULL,
	anex_tamano NUMBER,
	anex_solo_lect VARCHAR2(1) NOT NULL,
	anex_creador VARCHAR2(50) NOT NULL,
	anex_desc VARCHAR2(512),
	anex_numero NUMBER(5) NOT NULL,
	anex_nomb_archivo VARCHAR2(50) NOT NULL,
	anex_borrado VARCHAR2(1) NOT NULL,
	anex_origen NUMBER(1),
	anex_ubic VARCHAR2(15),
	anex_salida NUMBER(1),
	radi_nume_salida NUMBER(15),
	anex_radi_fech VARCHAR2(50),
	anex_estado NUMBER(1),
	usua_doc VARCHAR2(14),
	sgd_rem_destino NUMBER(1),
	anex_fech_envio VARCHAR2(50),
	sgd_dir_tipo NUMBER(4),
	anex_fech_impres VARCHAR2(50),
	anex_depe_creador NUMBER(4),
	sgd_doc_secuencia NUMBER(15),
	sgd_doc_padre VARCHAR2(20),
	sgd_arg_codigo NUMBER(2),
	sgd_tpr_codigo NUMBER(4),
	sgd_deve_codigo NUMBER(2),
	sgd_deve_fech DATE,
	sgd_fech_impres TIMESTAMP,
	anex_fech_anex VARCHAR2(50),
	anex_depe_codi VARCHAR2(3),
	sgd_pnufe_codi NUMBER(4),
	sgd_dnufe_codi NUMBER(4),
	anex_usudoc_creador VARCHAR2(15),
	sgd_fech_doc DATE,
	sgd_apli_codi NUMBER(4),
	sgd_trad_codigo NUMBER(2),
	sgd_dir_direccion VARCHAR2(150),
	sgd_exp_numero VARCHAR2(18),
	numero_doc VARCHAR2(15),
	sgd_srd_codigo VARCHAR2(3),
	sgd_sbrd_codigo VARCHAR2(4),
	anex_num_hoja NUMBER,
	texto_archivo_anex CLOB,
	anex_idarch_version NUMBER(3),
	anex_num_version NUMBER(2)
);
CREATE TABLE anexos_historico (
	anex_hist_anex_codi VARCHAR2(20) NOT NULL,
	anex_hist_num_ver NUMBER(4) NOT NULL,
	anex_hist_tipo_mod VARCHAR2(2) NOT NULL,
	anex_hist_usua VARCHAR2(15) NOT NULL,
	anex_hist_fecha DATE NOT NULL,
	usua_doc VARCHAR2(14)
);
CREATE TABLE anexos_tipo (
	anex_tipo_codi NUMBER(4) NOT NULL,
	anex_tipo_ext VARCHAR2(10) NOT NULL,
	anex_tipo_desc VARCHAR2(50)
);
CREATE TABLE aux_01 (
	r NUMBER
);
CREATE TABLE bodega_empresas (
	nombre_de_la_empresa VARCHAR2(300),
	nuir VARCHAR2(13),
	nit_de_la_empresa VARCHAR2(80),
	sigla_de_la_empresa VARCHAR2(80),
	direccion VARCHAR2(4000),
	codigo_del_departamento VARCHAR2(4000),
	codigo_del_municipio VARCHAR2(4000),
	telefono_1 VARCHAR2(4000),
	telefono_2 VARCHAR2(4000),
	email VARCHAR2(4000),
	nombre_rep_legal VARCHAR2(4000),
	cargo_rep_legal VARCHAR2(4000),
	identificador_empresa NUMBER(5) NOT NULL,
	are_esp_secue NUMBER(8) NOT NULL,
	id_cont NUMBER(2),
	id_pais NUMBER(4),
	activa NUMBER(1),
	flag_rups VARCHAR2(10),
	codigo_suscriptor VARCHAR2(50),
	PRIMARY KEY (identificador_empresa)
);
CREATE TABLE bodega_empresas_old (
	identificador_de_la_empresa NUMBER(5) NOT NULL,
	nuir VARCHAR2(13),
	nombre_de_la_empresa VARCHAR2(150),
	nit_de_la_empresa VARCHAR2(13),
	sigla_de_la_empresa VARCHAR2(30),
	codigo_de_la_nat_juridica NUMBER(2),
	direccion VARCHAR2(50),
	codigo_del_departamento NUMBER(2),
	codigo_del_municipio NUMBER(3),
	codigo_de_la_unidad NUMBER(3),
	telefono_1 VARCHAR2(15),
	telefono_2 VARCHAR2(15),
	telefono_3 VARCHAR2(15),
	apartado_aereo NUMBER(10),
	numero_de_fax VARCHAR2(15),
	zona_postal NUMBER(3),
	email VARCHAR2(50),
	tiene_contab_por_servicio VARCHAR2(2),
	fecha_de_actualizacion DATE,
	codigo_regional NUMBER(3),
	estado_de_la_empresa VARCHAR2(50),
	fecha_del_estado DATE,
	obsv_del_estado VARCHAR2(100),
	esp_cias NUMBER(4),
	esp_auxi NUMBER(8),
	esp_etco NUMBER(2),
	esp_ceco VARCHAR2(16),
	estado NUMBER(2),
	tipo_identificacion_repl VARCHAR2(1),
	numero_identificaci_repl VARCHAR2(11),
	nombre_rep_legal VARCHAR2(75),
	cargo_rep_legal NUMBER(2),
	numero_camara_ccio VARCHAR2(20),
	cod_estado_vigilancia NUMBER(2),
	identificador_empresa NUMBER(5) NOT NULL,
	nombre_de_la_empresa_anterior VARCHAR2(150),
	direccion_anterior VARCHAR2(50)
);
CREATE TABLE borrar_carpeta_personalizada (
	carp_per_codi NUMBER(2) NOT NULL,
	carp_per_usu VARCHAR2(15) NOT NULL,
	carp_per_desc VARCHAR2(80) NOT NULL
);
CREATE TABLE borrar_empresa_esp (
	eesp_codi NUMBER(7) NOT NULL,
	eesp_nomb VARCHAR2(150) NOT NULL,
	essp_nit VARCHAR2(13),
	essp_sigla VARCHAR2(30),
	depe_codi NUMBER(2),
	muni_codi NUMBER(4),
	eesp_dire VARCHAR2(50),
	eesp_rep_leg VARCHAR2(75)
);
CREATE TABLE carpeta (
	carp_codi NUMBER(2) NOT NULL,
	carp_desc VARCHAR2(80) NOT NULL
);
CREATE TABLE carpeta_per (
	usua_codi NUMBER(3) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	nomb_carp VARCHAR2(15),
	desc_carp VARCHAR2(50),
	codi_carp NUMBER(3)
);
CREATE TABLE centro_poblado (
	cpob_codi NUMBER(4) NOT NULL,
	muni_codi NUMBER(4) NOT NULL,
	dpto_codi NUMBER(2) NOT NULL,
	cpob_nomb VARCHAR2(100) NOT NULL,
	cpob_nomb_anterior VARCHAR2(100)
);
CREATE TABLE departamento (
	dpto_codi NUMBER(3) NOT NULL,
	dpto_nomb VARCHAR2(70) NOT NULL,
	id_cont NUMBER(2),
	id_pais NUMBER(4)
);
CREATE TABLE dependencia (
	depe_codi NUMBER(5) NOT NULL,
	depe_nomb VARCHAR2(70) NOT NULL,
	dpto_codi NUMBER(2),
	depe_codi_padre NUMBER(5),
	muni_codi NUMBER(4),
	depe_codi_territorial NUMBER(4),
	dep_sigla VARCHAR2(100),
	dep_central NUMBER(1),
	dep_direccion VARCHAR2(100),
	depe_num_interna NUMBER(4),
	depe_num_resolucion NUMBER(4),
	depe_rad_tp1 NUMBER(3),
	depe_rad_tp2 NUMBER(3),
	id_cont NUMBER(2),
	id_pais NUMBER(4),
	depe_estado NUMBER(1),
	depe_rad_tp4 NUMBER(38),
	depe_segu NUMBER(38),
	depe_rad_tp3 NUMBER(38),
	depe_rad_tp5 NUMBER(38)
);
CREATE TABLE dependencia_visibilidad (
	codigo_visibilidad NUMBER(18) NOT NULL,
	dependencia_visible NUMBER(5) NOT NULL,
	dependencia_observa NUMBER(5) NOT NULL
);
CREATE TABLE dup_eliminar (
	sgd_oem_codigo NUMBER(8) NOT NULL,
	tdid_codi NUMBER(2),
	sgd_oem_oempresa VARCHAR2(150),
	sgd_oem_rep_legal VARCHAR2(150),
	sgd_oem_nit VARCHAR2(14),
	sgd_oem_sigla VARCHAR2(50),
	muni_codi NUMBER(4),
	dpto_codi NUMBER(2),
	sgd_oem_direccion VARCHAR2(100),
	sgd_oem_telefono VARCHAR2(50)
);
CREATE TABLE emp_cod_actualizar (
	emp_cod_ant VARCHAR2(10),
	emp_cod_nue VARCHAR2(10)
);
CREATE TABLE empresas_temporal (
	nombre_de_la_empresa VARCHAR2(160),
	nuir VARCHAR2(13),
	nit_de_la_empresa VARCHAR2(80),
	sigla_de_la_empresa VARCHAR2(80),
	direccion VARCHAR2(4000),
	codigo_del_departamento VARCHAR2(4000),
	codigo_del_municipio VARCHAR2(4000),
	telefono_1 VARCHAR2(4000),
	telefono_2 VARCHAR2(4000),
	email VARCHAR2(4000),
	nombre_rep_legal VARCHAR2(4000),
	cargo_rep_legal VARCHAR2(4000),
	identificador_empresa NUMBER(5),
	are_esp_secue NUMBER(8) NOT NULL
);
CREATE TABLE encuesta (
	usua_doc VARCHAR2(14) NOT NULL,
	fecha DATE,
	p1 VARCHAR2(100),
	p2 VARCHAR2(100),
	p3 VARCHAR2(100),
	p4 VARCHAR2(100),
	p5 VARCHAR2(100),
	p6 VARCHAR2(100),
	p7 VARCHAR2(100),
	p7_cual VARCHAR2(150),
	p8 VARCHAR2(100),
	p9 VARCHAR2(100),
	p10 VARCHAR2(100),
	p11 VARCHAR2(100),
	p12 VARCHAR2(100),
	p13 VARCHAR2(100),
	p14 VARCHAR2(100),
	p15 VARCHAR2(100),
	p16 VARCHAR2(100),
	p17 VARCHAR2(100),
	p18 VARCHAR2(100),
	p19 VARCHAR2(100),
	p20 VARCHAR2(100),
	p20_cual VARCHAR2(150),
	p21 VARCHAR2(100),
	p22 VARCHAR2(100),
	p23 VARCHAR2(100),
	p24 VARCHAR2(100),
	p25 VARCHAR2(100)
);
CREATE TABLE entidades_asociativa (
	nit VARCHAR2(12),
	codentidad NUMBER(10)
);
CREATE TABLE estado (
	esta_codi NUMBER(2) NOT NULL,
	esta_desc VARCHAR2(100) NOT NULL
);
CREATE TABLE example (
	campo1 NUMBER(15) NOT NULL,
	campo2 VARCHAR2(10)
);
CREATE TABLE fun_funcionario (
	usua_doc VARCHAR2(14),
	usua_fech_crea DATE NOT NULL,
	usua_esta VARCHAR2(10) NOT NULL,
	usua_nomb VARCHAR2(45),
	usua_ext NUMBER(4),
	usua_nacim DATE,
	usua_email VARCHAR2(50),
	usua_at VARCHAR2(15),
	usua_piso NUMBER(2),
	cedula_ok CHAR(1),
	cedula_suip VARCHAR2(15),
	nombre_suip VARCHAR2(45),
	observa CHAR(20)
);
CREATE TABLE fun_funcionario_2 (
	usua_doc VARCHAR2(14),
	usua_fech_crea DATE NOT NULL,
	usua_esta VARCHAR2(10) NOT NULL,
	usua_nomb VARCHAR2(45),
	usua_ext NUMBER(4),
	usua_nacim DATE,
	usua_email VARCHAR2(50),
	usua_at VARCHAR2(15),
	usua_piso NUMBER(2),
	cedula_ok CHAR(1),
	cedula_suip VARCHAR2(15),
	nombre_suip VARCHAR2(45),
	observa CHAR(20)
);
CREATE TABLE hist_eventos (
	depe_codi NUMBER(5) NOT NULL,
	hist_fech VARCHAR2(50) NOT NULL,
	usua_codi NUMBER(10) NOT NULL,
	radi_nume_radi NUMBER(15) NOT NULL,
	hist_obse CLOB NOT NULL,
	usua_codi_dest NUMBER(10),
	usua_doc VARCHAR2(14),
	usua_doc_old VARCHAR2(15),
	sgd_ttr_codigo NUMBER(3),
	hist_usua_autor VARCHAR2(14),
	hist_doc_dest VARCHAR2(14),
	depe_codi_dest NUMBER(3)
);
CREATE TABLE informados (
	radi_nume_radi NUMBER(15) NOT NULL,
	usua_codi NUMBER(10) NOT NULL,
	depe_codi NUMBER(3) NOT NULL,
	info_desc VARCHAR2(600),
	info_fech DATE NOT NULL,
	info_leido NUMBER(1),
	usua_codi_info NUMBER(3),
	info_codi NUMBER(10),
	usua_doc VARCHAR2(14),
	info_resp VARCHAR2(10)
);
CREATE TABLE medio_recepcion (
	mrec_codi NUMBER(2) NOT NULL,
	mrec_desc VARCHAR2(100) NOT NULL
);
CREATE TABLE municipio (
	muni_codi NUMBER(4) NOT NULL,
	dpto_codi NUMBER(3) NOT NULL,
	muni_nomb VARCHAR2(100) NOT NULL,
	id_cont NUMBER(2),
	id_pais NUMBER(4),
	homologa_muni VARCHAR2(10),
	homologa_idmuni VARCHAR2(15),
	activa NUMBER(1)
);
CREATE TABLE ortega_prueba_orfeo (
	radi_nume_hoja NUMBER(3),
	radi_fech_radi DATE,
	radi_nume_radi NUMBER(15),
	ra_asun VARCHAR2(350),
	radi_path VARCHAR2(100),
	radi_usu_ante VARCHAR2(45),
	nombre_de_la_empresa VARCHAR2(150),
	fecha VARCHAR2(20),
	sgd_tpr_descrip VARCHAR2(150),
	sgd_tpr_codigo NUMBER(4),
	sgd_tpr_termino NUMBER(4),
	diasr NUMBER(4),
	radi_leido NUMBER(1),
	radi_tipo_deri NUMBER(2),
	radi_nume_deri NUMBER(15),
	sgd_ciu_nombre VARCHAR2(50),
	sgd_ciu_apell1 VARCHAR2(50),
	sgd_ciu_apell2 VARCHAR2(50),
	tipo_query VARCHAR2(50),
	sgd_dir_tipo NUMBER(4),
	sgd_dir_nombre VARCHAR2(60),
	radi_cuentai VARCHAR2(20),
	sgd_exp_numero VARCHAR2(15)
);
CREATE TABLE p_sgd_oem_oempresas (
	sgd_oem_codigo NUMBER(8) NOT NULL,
	tdid_codi NUMBER(2),
	sgd_oem_oempresa VARCHAR2(150),
	sgd_oem_rep_legal VARCHAR2(150),
	sgd_oem_nit VARCHAR2(14),
	sgd_oem_sigla VARCHAR2(50),
	muni_codi NUMBER(4),
	dpto_codi NUMBER(2),
	sgd_oem_direccion VARCHAR2(100),
	sgd_oem_telefono VARCHAR2(50)
);
CREATE TABLE par_serv_servicios (
	par_serv_secue NUMBER(8) NOT NULL,
	par_serv_codigo VARCHAR2(5),
	par_serv_nombre VARCHAR2(100),
	par_serv_estado VARCHAR2(1)
);
CREATE TABLE pl_generado_plg (
	depe_codi NUMBER(5),
	radi_nume_radi NUMBER(15),
	plt_codi NUMBER(4),
	plg_codi NUMBER(4),
	plg_comentarios VARCHAR2(150),
	plg_analiza NUMBER(10),
	plg_firma NUMBER(10),
	plg_autoriza NUMBER(10),
	plg_imprime NUMBER(10),
	plg_envia NUMBER(10),
	plg_archivo_tmp VARCHAR2(150),
	plg_archivo_final VARCHAR2(150),
	plg_nombre VARCHAR2(30),
	plg_crea NUMBER(10),
	plg_autoriza_fech DATE,
	plg_imprime_fech DATE,
	plg_envia_fech DATE,
	plg_crea_fech DATE,
	plg_creador VARCHAR2(20),
	pl_codi NUMBER(4),
	usua_doc VARCHAR2(14),
	sgd_rem_destino NUMBER(1),
	radi_nume_sal NUMBER(15)
);
CREATE TABLE pl_tipo_plt (
	plt_codi NUMBER(4) NOT NULL,
	plt_desc VARCHAR2(35)
);
CREATE TABLE plan_table (
	statement_id VARCHAR2(30),
	timestamp DATE,
	remarks VARCHAR2(80),
	operation VARCHAR2(30),
	options VARCHAR2(30),
	object_node VARCHAR2(128),
	object_owner VARCHAR2(30),
	object_name VARCHAR2(30),
	object_instance NUMBER(38),
	object_type VARCHAR2(30),
	optimizer VARCHAR2(255),
	search_columns NUMBER,
	id NUMBER(38),
	parent_id NUMBER(38),
	position NUMBER(38),
	cost NUMBER(38),
	cardinality NUMBER(38),
	s NUMBER(38),
	other_tag VARCHAR2(255),
	partition_start VARCHAR2(255),
	partition_stop VARCHAR2(255),
	partition_id NUMBER(38),
	other VARCHAR2(255),
	distribution VARCHAR2(30)
);
CREATE TABLE plantilla_pl (
	pl_codi NUMBER(4) NOT NULL,
	depe_codi NUMBER(5),
	pl_nomb VARCHAR2(35),
	pl_archivo VARCHAR2(35),
	pl_desc VARCHAR2(150),
	pl_fech DATE,
	usua_codi NUMBER(10),
	pl_uso NUMBER(1)
);
CREATE TABLE plsql_profiler_data (
	runid NUMBER,
	unit_numeric NUMBER,
	line NUMBER NOT NULL,
	total_occur NUMBER,
	total_time NUMBER,
	min_time NUMBER,
	max_time NUMBER,
	spare1 NUMBER,
	spare2 NUMBER,
	spare3 NUMBER,
	spare4 NUMBER
);
CREATE TABLE plsql_profiler_runs (
	runid NUMBER,
	related_run NUMBER,
	run_owner VARCHAR2(32),
	run_date DATE,
	run_comment VARCHAR2(2047),
	run_total_time NUMBER,
	run_system_info VARCHAR2(2047),
	run_comment1 VARCHAR2(2047),
	spare1 VARCHAR2(256)
);
CREATE TABLE plsql_profiler_units (
	runid NUMBER,
	unit_numeric NUMBER,
	unit_type VARCHAR2(32),
	unit_owner VARCHAR2(32),
	unit_name VARCHAR2(32),
	unit_timestamp DATE,
	total_time NUMBER NOT NULL,
	spare1 NUMBER,
	spare2 NUMBER
);
CREATE TABLE prestamo (
	pres_id NUMBER(10) NOT NULL,
	radi_nume_radi NUMBER(15) NOT NULL,
	usua_login_actu VARCHAR2(50) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	usua_login_pres VARCHAR2(50),
	pres_desc VARCHAR2(200),
	pres_fech_pres TIMESTAMP,
	pres_fech_devo TIMESTAMP,
	pres_fech_pedi TIMESTAMP NOT NULL,
	pres_estado NUMBER(2),
	pres_requerimiento NUMBER(2),
	pres_depe_arch NUMBER(5),
	pres_fech_venc TIMESTAMP,
	dev_desc VARCHAR2(500),
	pres_fech_canc TIMESTAMP,
	usua_login_canc VARCHAR2(50),
	usua_login_rx VARCHAR2(50)
);
CREATE TABLE pruba (
	nombre VARCHAR2(20),
	tel VARCHAR2(20)
);
CREATE TABLE radicado (
	radi_nume_radi NUMBER(15) NOT NULL,
	radi_fech_radi VARCHAR2(50) NOT NULL,
	tdoc_codi NUMBER(4) NOT NULL,
	trte_codi NUMBER(2),
	mrec_codi NUMBER(2),
	eesp_codi NUMBER(10),
	eotra_codi NUMBER(10),
	radi_tipo_empr VARCHAR2(2),
	radi_fech_ofic DATE,
	tdid_codi NUMBER(2),
	radi_nume_iden VARCHAR2(15),
	radi_nomb VARCHAR2(90),
	radi_prim_apel VARCHAR2(50),
	radi_segu_apel VARCHAR2(50),
	radi_pais VARCHAR2(70),
	muni_codi NUMBER(5),
	cpob_codi NUMBER(4),
	carp_codi NUMBER(3),
	esta_codi NUMBER(2),
	dpto_codi NUMBER(2),
	cen_muni_codi NUMBER(4),
	cen_dpto_codi NUMBER(2),
	radi_dire_corr VARCHAR2(100),
	radi_tele_cont VARCHAR2(15),
	radi_nume_hoja NUMBER(4),
	radi_desc_anex VARCHAR2(500),
	radi_nume_deri NUMBER(15),
	radi_path VARCHAR2(100),
	radi_usua_actu NUMBER(10),
	radi_depe_actu NUMBER(5),
	radi_fech_asig VARCHAR2(50),
	radi_arch1 VARCHAR2(10),
	radi_arch2 VARCHAR2(10),
	radi_arch3 VARCHAR2(10),
	radi_arch4 VARCHAR2(10),
	ra_asun VARCHAR2(350),
	radi_usu_ante VARCHAR2(45),
	radi_depe_radi NUMBER(3),
	radi_rem VARCHAR2(60),
	radi_usua_radi NUMBER(10),
	codi_nivel NUMBER(2),
	flag_nivel NUMBER(38),
	carp_per NUMBER(1),
	radi_leido NUMBER(1),
	radi_cuentai VARCHAR2(20),
	radi_tipo_deri NUMBER(2),
	listo VARCHAR2(2),
	sgd_tma_codigo NUMBER(4),
	sgd_mtd_codigo NUMBER(4),
	par_serv_secue NUMBER(8),
	sgd_fld_codigo NUMBER(3),
	radi_agend NUMBER(1),
	radi_fech_agend VARCHAR2(50),
	radi_fech_doc DATE,
	sgd_doc_secuencia NUMBER(15),
	sgd_pnufe_codi NUMBER(4),
	sgd_eanu_codigo NUMBER(1),
	sgd_not_codi NUMBER(3),
	radi_fech_notif VARCHAR2(50),
	sgd_tdec_codigo NUMBER(4),
	sgd_apli_codi NUMBER(4),
	sgd_ttr_codigo NUMBER(38),
	usua_doc_ante VARCHAR2(14),
	radi_fech_antetx VARCHAR2(50),
	sgd_trad_codigo NUMBER(2),
	fech_vcmto VARCHAR2(50),
	tdoc_vcmto NUMBER(4),
	sgd_termino_real NUMBER(4),
	id_cont NUMBER(2),
	sgd_spub_codigo NUMBER(2),
	id_pais NUMBER(4),
	medio_m VARCHAR2(5),
	radi_nrr NUMBER(2),
	numero_rm VARCHAR2(15),
	numero_tran VARCHAR2(15),
	texto_archivo CLOB,
	PRIMARY KEY (radi_nume_radi)
);
CREATE TABLE retencion_doc_tmp (
	cod_serie NUMBER(4),
	serie VARCHAR2(100),
	tipologia_doc VARCHAR2(200),
	cod_subserie VARCHAR2(10),
	subserie VARCHAR2(100),
	tipologia_sub VARCHAR2(200),
	dependencia NUMBER(5),
	nom_depe VARCHAR2(200),
	archivo_gestion NUMBER(3),
	archivo_central NUMBER(3),
	disposicion VARCHAR2(100),
	soporte VARCHAR2(20),
	procedimiento VARCHAR2(500),
	tipo_doc NUMBER(4),
	error VARCHAR2(200)
);
CREATE TABLE series (
	depe_codi NUMBER(5) NOT NULL,
	seri_nume NUMBER(7) NOT NULL,
	seri_tipo NUMBER(2),
	seri_ano NUMBER(4),
	dpto_codi NUMBER(2) NOT NULL,
	bloq VARCHAR2(20)
);
CREATE TABLE sgd_acm_acusemsg (
	sgd_msg_codi NUMBER(15) NOT NULL,
	usua_doc VARCHAR2(14),
	sgd_msg_leido NUMBER(3)
);
CREATE TABLE sgd_actadd_actualiadicional (
	sgd_actadd_codi NUMBER(4),
	sgd_apli_codi NUMBER(4),
	sgd_instorf_codi NUMBER(4),
	sgd_actadd_query VARCHAR2(500),
	sgd_actadd_desc VARCHAR2(150)
);
CREATE TABLE sgd_agen_agendados (
	sgd_agen_fech DATE,
	sgd_agen_observacion VARCHAR2(4000),
	radi_nume_radi NUMBER(15) NOT NULL,
	usua_doc VARCHAR2(18) NOT NULL,
	depe_codi VARCHAR2(3),
	sgd_agen_codigo NUMBER,
	sgd_agen_fechplazo DATE,
	sgd_agen_activo NUMBER
);
CREATE TABLE sgd_anar_anexarg (
	sgd_anar_codi NUMBER(4) NOT NULL,
	anex_codigo VARCHAR2(20),
	sgd_argd_codi NUMBER(4),
	sgd_anar_argcod NUMBER(4)
);
CREATE TABLE sgd_anu_anulados (
	sgd_anu_id NUMBER(4),
	sgd_anu_desc VARCHAR2(250),
	radi_nume_radi NUMBER,
	sgd_eanu_codi NUMBER(4),
	sgd_anu_sol_fech DATE,
	sgd_anu_fech DATE,
	depe_codi NUMBER(3),
	usua_doc VARCHAR2(14),
	usua_codi NUMBER(4),
	depe_codi_anu NUMBER(3),
	usua_doc_anu VARCHAR2(14),
	usua_codi_anu NUMBER(4),
	usua_anu_acta NUMBER(8),
	sgd_anu_path_acta VARCHAR2(200),
	sgd_trad_codigo NUMBER(2)
);
CREATE TABLE sgd_aper_adminperfiles (
	sgd_aper_codigo NUMBER(2),
	sgd_aper_descripcion VARCHAR2(20)
);
CREATE TABLE sgd_aplfad_plicfunadi (
	sgd_aplfad_codi NUMBER(4),
	sgd_apli_codi NUMBER(4),
	sgd_aplfad_menu VARCHAR2(150) NOT NULL,
	sgd_aplfad_lk1 VARCHAR2(150) NOT NULL,
	sgd_aplfad_desc VARCHAR2(150) NOT NULL
);
CREATE TABLE sgd_apli_aplintegra (
	sgd_apli_codi NUMBER(4),
	sgd_apli_descrip VARCHAR2(150),
	sgd_apli_lk1desc VARCHAR2(150),
	sgd_apli_lk1 VARCHAR2(150),
	sgd_apli_lk2desc VARCHAR2(150),
	sgd_apli_lk2 VARCHAR2(150),
	sgd_apli_lk3desc VARCHAR2(150),
	sgd_apli_lk3 VARCHAR2(150),
	sgd_apli_lk4desc VARCHAR2(150),
	sgd_apli_lk4 VARCHAR2(150)
);
CREATE TABLE sgd_aplmen_aplimens (
	sgd_aplmen_codi NUMBER(4),
	sgd_apli_codi NUMBER(4),
	sgd_aplmen_ref VARCHAR2(20),
	sgd_aplmen_haciaorfeo NUMBER(4),
	sgd_aplmen_desdeorfeo NUMBER(4)
);
CREATE TABLE sgd_aplus_plicusua (
	sgd_aplus_codi NUMBER(4),
	sgd_apli_codi NUMBER(4),
	usua_doc VARCHAR2(14),
	sgd_trad_codigo NUMBER(2),
	sgd_aplus_prioridad NUMBER(1)
);
CREATE TABLE sgd_arch_depe (
	sgd_arch_depe VARCHAR2(4),
	sgd_arch_edificio NUMBER(6),
	sgd_arch_item NUMBER(6),
	sgd_arch_id NUMBER NOT NULL,
	PRIMARY KEY (sgd_arch_id)
);
CREATE TABLE sgd_archivo_central (
	sgd_archivo_id NUMBER NOT NULL,
	sgd_archivo_tipo NUMBER,
	sgd_archivo_orden VARCHAR2(15),
	sgd_archivo_fechai VARCHAR2(50),
	sgd_archivo_demandado VARCHAR2(1500),
	sgd_archivo_demandante VARCHAR2(200),
	sgd_archivo_cc_demandante NUMBER,
	sgd_archivo_depe VARCHAR2(5),
	sgd_archivo_zona VARCHAR2(4),
	sgd_archivo_carro NUMBER,
	sgd_archivo_cara VARCHAR2(4),
	sgd_archivo_estante NUMBER,
	sgd_archivo_entrepano NUMBER,
	sgd_archivo_caja NUMBER,
	sgd_archivo_unidocu VARCHAR2(40),
	sgd_archivo_anexo VARCHAR2(4000),
	sgd_archivo_inder NUMBER,
	sgd_archivo_path VARCHAR2(4000),
	sgd_archivo_year NUMBER(4),
	sgd_archivo_rad VARCHAR2(15) NOT NULL,
	sgd_archivo_srd NUMBER,
	sgd_archivo_sbrd NUMBER,
	sgd_archivo_folios NUMBER,
	sgd_archivo_mata NUMBER,
	sgd_archivo_fechaf VARCHAR2(50),
	sgd_archivo_prestamo NUMBER(1),
	sgd_archivo_funprest CHAR(100),
	sgd_archivo_fechprest VARCHAR2(50),
	sgd_archivo_fechprestf VARCHAR2(50),
	depe_codi VARCHAR2(5),
	sgd_archivo_usua VARCHAR2(15),
	sgd_archivo_fech VARCHAR2(50),
	PRIMARY KEY (sgd_archivo_id)
);
CREATE TABLE sgd_archivo_fondo (
	sgd_archivo_id NUMBER NOT NULL,
	sgd_archivo_tipo NUMBER,
	sgd_archivo_orden VARCHAR2(15),
	sgd_archivo_fechai VARCHAR2(50),
	sgd_archivo_demandado VARCHAR2(1500),
	sgd_archivo_demandante VARCHAR2(200),
	sgd_archivo_cc_demandante NUMBER,
	sgd_archivo_depe VARCHAR2(5),
	sgd_archivo_zona VARCHAR2(4),
	sgd_archivo_carro NUMBER,
	sgd_archivo_cara VARCHAR2(4),
	sgd_archivo_estante NUMBER,
	sgd_archivo_entrepano NUMBER,
	sgd_archivo_caja NUMBER,
	sgd_archivo_unidocu VARCHAR2(40),
	sgd_archivo_anexo VARCHAR2(4000),
	sgd_archivo_inder NUMBER,
	sgd_archivo_path VARCHAR2(4000),
	sgd_archivo_year NUMBER(4),
	sgd_archivo_rad VARCHAR2(15) NOT NULL,
	sgd_archivo_srd NUMBER,
	sgd_archivo_folios NUMBER,
	sgd_archivo_mata NUMBER,
	sgd_archivo_fechaf VARCHAR2(50),
	sgd_archivo_prestamo NUMBER(1),
	sgd_archivo_funprest CHAR(100),
	sgd_archivo_fechprest VARCHAR2(50),
	sgd_archivo_fechprestf VARCHAR2(50),
	depe_codi VARCHAR2(5),
	sgd_archivo_usua VARCHAR2(15),
	sgd_archivo_fech VARCHAR2(50),
	PRIMARY KEY (sgd_archivo_id)
);
CREATE TABLE sgd_archivo_hist (
	depe_codi VARCHAR2(5) NOT NULL,
	hist_fech VARCHAR2(50) NOT NULL,
	usua_codi NUMBER(10) NOT NULL,
	sgd_archivo_rad VARCHAR2(14),
	hist_obse VARCHAR2(600) NOT NULL,
	usua_doc VARCHAR2(14),
	sgd_ttr_codigo NUMBER(3),
	hist_id NUMBER
);
CREATE TABLE sgd_arg_pliego (
	sgd_arg_codigo NUMBER(2) NOT NULL,
	sgd_arg_desc VARCHAR2(150) NOT NULL
);
CREATE TABLE sgd_argd_argdoc (
	sgd_argd_codi NUMBER(4) NOT NULL,
	sgd_pnufe_codi NUMBER(4),
	sgd_argd_tabla VARCHAR2(100),
	sgd_argd_tcodi VARCHAR2(100),
	sgd_argd_tdes VARCHAR2(100),
	sgd_argd_llist VARCHAR2(150),
	sgd_argd_campo VARCHAR2(100)
);
CREATE TABLE sgd_argup_argudoctop (
	sgd_argup_codi NUMBER(4) NOT NULL,
	sgd_argup_desc VARCHAR2(50),
	sgd_tpr_codigo NUMBER(4)
);
CREATE TABLE sgd_auditoria (
	fecha VARCHAR2(10),
	usua_doc VARCHAR2(12),
	ip VARCHAR2(15),
	tipo VARCHAR2(5),
	tabla VARCHAR2(50),
	isql CHAR(5000)
);
CREATE TABLE sgd_camexp_campoexpediente (
	sgd_camexp_codigo NUMBER(4) NOT NULL,
	sgd_camexp_campo VARCHAR2(30) NOT NULL,
	sgd_parexp_codigo NUMBER(4) NOT NULL,
	sgd_camexp_fk NUMBER,
	sgd_camexp_tablafk VARCHAR2(30),
	sgd_camexp_campofk VARCHAR2(30),
	sgd_camexp_campovalor VARCHAR2(30),
	sgd_camexp_orden NUMBER(1)
);
CREATE TABLE sgd_carp_descripcion (
	sgd_carp_depecodi VARCHAR2(5) NOT NULL,
	sgd_carp_tiporad NUMBER(2) NOT NULL,
	sgd_carp_descr VARCHAR2(40),
	PRIMARY KEY (sgd_carp_depecodi,sgd_carp_tiporad)
);
CREATE TABLE sgd_cau_causal (
	sgd_cau_codigo NUMBER(4) NOT NULL,
	sgd_cau_descrip VARCHAR2(150)
);
CREATE TABLE sgd_caux_causales (
	sgd_caux_codigo NUMBER(10) NOT NULL,
	radi_nume_radi NUMBER(15),
	sgd_dcau_codigo NUMBER(4),
	sgd_ddca_codigo NUMBER(4),
	sgd_caux_fecha DATE,
	usua_doc VARCHAR2(14)
);
CREATE TABLE sgd_ciu_ciudadano (
	tdid_codi NUMBER(2),
	sgd_ciu_codigo NUMBER(8) NOT NULL,
	sgd_ciu_nombre VARCHAR2(150),
	sgd_ciu_direccion VARCHAR2(150),
	sgd_ciu_apell1 VARCHAR2(50),
	sgd_ciu_apell2 VARCHAR2(50),
	sgd_ciu_telefono VARCHAR2(50),
	sgd_ciu_email VARCHAR2(50),
	muni_codi NUMBER(4),
	dpto_codi NUMBER(2),
	sgd_ciu_cedula VARCHAR2(13),
	id_cont NUMBER(2),
	id_pais NUMBER(4)
);
CREATE TABLE sgd_clta_clstarif (
	sgd_fenv_codigo NUMBER(5),
	sgd_clta_codser NUMBER(5),
	sgd_tar_codigo NUMBER(5),
	sgd_clta_descrip VARCHAR2(100),
	sgd_clta_pesdes NUMBER(15),
	sgd_clta_peshast NUMBER(15)
);
CREATE TABLE sgd_cob_campobliga (
	sgd_cob_codi NUMBER(4) NOT NULL,
	sgd_cob_desc VARCHAR2(150),
	sgd_cob_label VARCHAR2(50),
	sgd_tidm_codi NUMBER(4)
);
CREATE TABLE sgd_dcau_causal (
	sgd_dcau_codigo NUMBER(4) NOT NULL,
	sgd_cau_codigo NUMBER(4),
	sgd_dcau_descrip VARCHAR2(150)
);
CREATE TABLE sgd_ddca_ddsgrgdo (
	sgd_ddca_codigo NUMBER(4) NOT NULL,
	sgd_dcau_codigo NUMBER(4),
	par_serv_secue NUMBER(8),
	sgd_ddca_descrip VARCHAR2(150)
);
CREATE TABLE sgd_def_contactos (
	ctt_id NUMBER(15) NOT NULL,
	ctt_nombre VARCHAR2(60) NOT NULL,
	ctt_cargo VARCHAR2(60) NOT NULL,
	ctt_telefono VARCHAR2(25),
	ctt_id_tipo NUMBER(4) NOT NULL,
	ctt_id_empresa NUMBER(15) NOT NULL
);
CREATE TABLE sgd_def_continentes (
	id_cont NUMBER(2),
	nombre_cont VARCHAR2(20) NOT NULL
);
CREATE TABLE sgd_def_paises (
	id_pais NUMBER(4),
	id_cont NUMBER(2) NOT NULL,
	nombre_pais VARCHAR2(30) NOT NULL
);
CREATE TABLE sgd_deve_dev_envio (
	sgd_deve_codigo NUMBER(2) NOT NULL,
	sgd_deve_desc VARCHAR2(150) NOT NULL
);
CREATE TABLE sgd_dir_drecciones (
	sgd_dir_codigo NUMBER(10) NOT NULL,
	sgd_dir_tipo NUMBER(4) NOT NULL,
	sgd_oem_codigo NUMBER(8),
	sgd_ciu_codigo NUMBER(8),
	radi_nume_radi NUMBER(15),
	sgd_esp_codi NUMBER(5),
	muni_codi NUMBER(4),
	dpto_codi NUMBER(3),
	sgd_dir_direccion VARCHAR2(150),
	sgd_dir_telefono VARCHAR2(50),
	sgd_dir_mail VARCHAR2(50),
	sgd_sec_codigo NUMBER(13),
	sgd_temporal_nombre VARCHAR2(150),
	anex_codigo NUMBER(20),
	sgd_anex_codigo VARCHAR2(20),
	sgd_dir_nombre VARCHAR2(150),
	sgd_doc_fun VARCHAR2(14),
	sgd_dir_nomremdes VARCHAR2(1000),
	sgd_trd_codigo NUMBER(1),
	sgd_dir_tdoc NUMBER(1),
	sgd_dir_doc VARCHAR2(14),
	id_pais NUMBER(4),
	id_cont NUMBER(2)
);
CREATE TABLE sgd_dnufe_docnufe (
	sgd_dnufe_codi NUMBER(4) NOT NULL,
	sgd_pnufe_codi NUMBER(4),
	sgd_tpr_codigo NUMBER(4),
	sgd_dnufe_label VARCHAR2(150),
	trte_codi NUMBER(2),
	sgd_dnufe_main VARCHAR2(1),
	sgd_dnufe_path VARCHAR2(150),
	sgd_dnufe_gerarq VARCHAR2(10),
	anex_tipo_codi NUMBER(4)
);
CREATE TABLE sgd_dt_radicado (
	radi_nume_radi NUMBER(14) NOT NULL,
	dias_termino NUMBER(2) NOT NULL,
	PRIMARY KEY (radi_nume_radi)
);
CREATE TABLE sgd_eanu_estanulacion (
	sgd_eanu_desc VARCHAR2(150),
	sgd_eanu_codi NUMBER
);
CREATE TABLE sgd_einv_inventario (
	sgd_einv_codigo NUMBER NOT NULL,
	sgd_depe_nomb VARCHAR2(400),
	sgd_depe_codi VARCHAR2(3),
	sgd_einv_expnum VARCHAR2(18),
	sgd_einv_titulo VARCHAR2(400),
	sgd_einv_unidad NUMBER,
	sgd_einv_fech DATE,
	sgd_einv_fechfin DATE,
	sgd_einv_radicados VARCHAR2(40),
	sgd_einv_folios NUMBER,
	sgd_einv_nundocu NUMBER,
	sgd_einv_nundocubodega NUMBER,
	sgd_einv_caja NUMBER,
	sgd_einv_cajabodega NUMBER,
	sgd_einv_srd NUMBER,
	sgd_einv_nomsrd VARCHAR2(400),
	sgd_einv_sbrd NUMBER,
	sgd_einv_nomsbrd VARCHAR2(400),
	sgd_einv_retencion VARCHAR2(400),
	sgd_einv_disfinal VARCHAR2(400),
	sgd_einv_ubicacion VARCHAR2(400),
	sgd_einv_observacion VARCHAR2(400),
	PRIMARY KEY (sgd_einv_codigo)
);
CREATE TABLE sgd_eit_items (
	sgd_eit_codigo NUMBER NOT NULL,
	sgd_eit_cod_padre NUMBER,
	sgd_eit_nombre VARCHAR2(40),
	sgd_eit_sigla VARCHAR2(6),
	codi_dpto NUMBER(4),
	codi_muni NUMBER(5),
	PRIMARY KEY (sgd_eit_codigo)
);
CREATE TABLE sgd_eje_tema (
	sgd_tema_codigo VARCHAR2(10) NOT NULL,
	sgd_tema_nomb VARCHAR2(150) NOT NULL,
	sgd_tema_desc VARCHAR2(350) NOT NULL,
	sgd_tema_plazo NUMBER(2),
	sgd_tema_tpplazo VARCHAR2(50),
	sgd_tema_estado NUMBER(2) NOT NULL,
	sgd_tema_depe NUMBER(5) NOT NULL,
	PRIMARY KEY (sgd_tema_codigo)
);
CREATE TABLE sgd_empus_empusuario (
	usua_login VARCHAR2(10),
	identificador_empresa NUMBER(10)
);
CREATE TABLE sgd_ent_entidades (
	sgd_ent_nit VARCHAR2(13) NOT NULL,
	sgd_ent_codsuc VARCHAR2(4) NOT NULL,
	sgd_ent_pias NUMBER(5),
	dpto_codi NUMBER(2),
	muni_codi NUMBER(4),
	sgd_ent_descrip VARCHAR2(80),
	sgd_ent_direccion VARCHAR2(50),
	sgd_ent_telefono VARCHAR2(50)
);
CREATE TABLE sgd_enve_envioespecial (
	sgd_fenv_codigo NUMBER(4),
	sgd_enve_valorl VARCHAR2(30),
	sgd_enve_valorn VARCHAR2(30),
	sgd_enve_desc VARCHAR2(30)
);
CREATE TABLE sgd_estc_estconsolid (
	sgd_estc_codigo NUMBER,
	sgd_tpr_codigo NUMBER,
	dep_nombre VARCHAR2(30),
	depe_codi NUMBER,
	sgd_estc_ctotal NUMBER,
	sgd_estc_centramite NUMBER,
	sgd_estc_csinriesgo NUMBER,
	sgd_estc_criesgomedio NUMBER,
	sgd_estc_criesgoalto NUMBER,
	sgd_estc_ctramitados NUMBER,
	sgd_estc_centermino NUMBER,
	sgd_estc_cfueratermino NUMBER,
	sgd_estc_fechgen DATE,
	sgd_estc_fechini DATE,
	sgd_estc_fechfin DATE,
	sgd_estc_fechiniresp DATE,
	sgd_estc_fechfinresp DATE,
	sgd_estc_dsinriesgo NUMBER,
	sgd_estc_driesgomegio NUMBER,
	sgd_estc_driesgoalto NUMBER,
	sgd_estc_dtermino NUMBER,
	sgd_estc_grupgenerado NUMBER
);
CREATE TABLE sgd_estinst_estadoinstancia (
	sgd_estinst_codi NUMBER(4),
	sgd_apli_codi NUMBER(4),
	sgd_instorf_codi NUMBER(4),
	sgd_estinst_valor NUMBER(4),
	sgd_estinst_habilita NUMBER(1),
	sgd_estinst_mensaje VARCHAR2(100)
);
CREATE TABLE sgd_exp_expediente (
	sgd_exp_numero VARCHAR2(18),
	radi_nume_radi NUMBER(18),
	sgd_exp_fech DATE,
	sgd_exp_fech_mod DATE,
	depe_codi NUMBER(4),
	usua_codi NUMBER(3),
	usua_doc VARCHAR2(15),
	sgd_exp_estado NUMBER(1),
	sgd_exp_titulo VARCHAR2(50),
	sgd_exp_asunto VARCHAR2(150),
	sgd_exp_carpeta VARCHAR2(30),
	sgd_exp_ufisica VARCHAR2(20),
	sgd_exp_isla VARCHAR2(10),
	sgd_exp_estante VARCHAR2(10),
	sgd_exp_caja VARCHAR2(10),
	sgd_exp_fech_arch DATE,
	sgd_srd_codigo NUMBER(3),
	sgd_sbrd_codigo NUMBER(3),
	sgd_fexp_codigo NUMBER(3),
	sgd_exp_subexpediente VARCHAR2(20),
	sgd_exp_archivo NUMBER(1),
	sgd_exp_unicon NUMBER(1),
	sgd_exp_fechfin DATE,
	sgd_exp_folios VARCHAR2(6),
	sgd_exp_rete NUMBER(2),
	sgd_exp_entrepa NUMBER(6),
	radi_usua_arch VARCHAR2(40),
	sgd_exp_edificio VARCHAR2(400),
	sgd_exp_caja_bodega VARCHAR2(40),
	sgd_exp_carro VARCHAR2(40),
	sgd_exp_carpeta_bodega VARCHAR2(40),
	sgd_exp_privado NUMBER(1),
	sgd_exp_cd VARCHAR2(10),
	sgd_exp_nref VARCHAR2(7),
	sgd_sexp_paraexp1 VARCHAR2(50)
);
CREATE TABLE sgd_fars_faristas (
	sgd_fars_codigo NUMBER(5) NOT NULL,
	sgd_pexp_codigo NUMBER(4),
	sgd_fexp_codigoini NUMBER(6),
	sgd_fexp_codigofin NUMBER(6),
	sgd_fars_diasminimo NUMBER(3),
	sgd_fars_diasmaximo NUMBER(3),
	sgd_fars_desc VARCHAR2(100),
	sgd_trad_codigo NUMBER(2),
	sgd_srd_codigo NUMBER(3),
	sgd_sbrd_codigo NUMBER(3),
	sgd_fars_tipificacion NUMBER(1),
	sgd_tpr_codigo NUMBER,
	sgd_fars_automatico NUMBER,
	sgd_fars_rolgeneral NUMBER
);
CREATE TABLE sgd_fenv_frmenvio (
	sgd_fenv_codigo NUMBER(5) NOT NULL,
	sgd_fenv_descrip VARCHAR2(40),
	sgd_fenv_planilla NUMBER(1) NOT NULL,
	sgd_fenv_estado NUMBER(1) NOT NULL
);
CREATE TABLE sgd_fexp_flujoexpedientes (
	sgd_fexp_codigo NUMBER(6),
	sgd_pexp_codigo NUMBER(6),
	sgd_fexp_orden NUMBER(4),
	sgd_fexp_terminos NUMBER(4),
	sgd_fexp_imagen VARCHAR2(50),
	sgd_fexp_descrip VARCHAR2(150)
);
CREATE TABLE sgd_firrad_firmarads (
	sgd_firrad_id NUMBER(15) NOT NULL,
	radi_nume_radi NUMBER(15) NOT NULL,
	usua_doc VARCHAR2(14) NOT NULL,
	sgd_firrad_firma VARCHAR2(255),
	sgd_firrad_fecha DATE,
	sgd_firrad_docsolic VARCHAR2(14) NOT NULL,
	sgd_firrad_fechsolic DATE NOT NULL,
	sgd_firrad_pk VARCHAR2(255)
);
CREATE TABLE sgd_fld_flujodoc (
	sgd_fld_codigo NUMBER(3),
	sgd_fld_desc VARCHAR2(100),
	sgd_tpr_codigo NUMBER(3),
	sgd_fld_imagen VARCHAR2(50),
	sgd_fld_grupoweb NUMBER(38)
);
CREATE TABLE sgd_fun_funciones (
	sgd_fun_codigo NUMBER(4) NOT NULL,
	sgd_fun_descrip VARCHAR2(530),
	sgd_fun_fech_ini DATE,
	sgd_fun_fech_fin DATE
);
CREATE TABLE sgd_hfld_histflujodoc (
	sgd_hfld_codigo NUMBER(6),
	sgd_fexp_codigo NUMBER(3) NOT NULL,
	sgd_exp_fechflujoant DATE,
	sgd_hfld_fech TIMESTAMP,
	sgd_exp_numero VARCHAR2(18),
	radi_nume_radi NUMBER(15),
	usua_doc VARCHAR2(10),
	usua_codi NUMBER(10),
	depe_codi NUMBER(4),
	sgd_ttr_codigo NUMBER(2),
	sgd_fexp_observa VARCHAR2(500),
	sgd_hfld_observa VARCHAR2(500),
	sgd_fars_codigo NUMBER,
	sgd_hfld_automatico NUMBER
);
CREATE TABLE sgd_hmtd_hismatdoc (
	sgd_hmtd_codigo NUMBER(6) NOT NULL,
	sgd_hmtd_fecha DATE NOT NULL,
	radi_nume_radi NUMBER(15) NOT NULL,
	usua_codi NUMBER(10) NOT NULL,
	sgd_hmtd_obse VARCHAR2(600) NOT NULL,
	usua_doc NUMBER(13),
	depe_codi NUMBER(5),
	sgd_mtd_codigo NUMBER(4)
);
CREATE TABLE sgd_instorf_instanciasorfeo (
	sgd_instorf_codi NUMBER(4),
	sgd_instorf_desc VARCHAR2(100)
);
CREATE TABLE sgd_lip_linkip (
	sgd_lip_id NUMBER(4) NOT NULL,
	sgd_lip_ipini VARCHAR2(20) NOT NULL,
	sgd_lip_ipfin VARCHAR2(20),
	sgd_lip_dirintranet VARCHAR2(150) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	sgd_lip_arch VARCHAR2(70),
	sgd_lip_diascache NUMBER(5),
	sgd_lip_rutaftp VARCHAR2(150),
	sgd_lip_servftp VARCHAR2(50),
	sgd_lip_usbd VARCHAR2(20),
	sgd_lip_nombd VARCHAR2(20),
	sgd_lip_pwdbd VARCHAR2(20),
	sgd_lip_usftp VARCHAR2(20),
	sgd_lip_pwdftp VARCHAR2(30)
);
CREATE TABLE sgd_mat_matriz (
	sgd_mat_codigo NUMBER(4) NOT NULL,
	depe_codi NUMBER(5),
	sgd_fun_codigo NUMBER(4),
	sgd_prc_codigo NUMBER(4),
	sgd_prd_codigo NUMBER(4),
	sgd_mat_fech_ini DATE,
	sgd_mat_fech_fin DATE,
	sgd_mat_peso_prd NUMBER(5,2)
);
CREATE TABLE sgd_mpes_mddpeso (
	sgd_mpes_codigo NUMBER(5) NOT NULL,
	sgd_mpes_descrip VARCHAR2(10)
);
CREATE TABLE sgd_mrd_matrird (
	sgd_mrd_codigo NUMBER(4) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	sgd_srd_codigo NUMBER(4) NOT NULL,
	sgd_sbrd_codigo NUMBER(4) NOT NULL,
	sgd_tpr_codigo NUMBER(4) NOT NULL,
	soporte VARCHAR2(10),
	sgd_mrd_fechini DATE,
	sgd_mrd_fechfin DATE,
	sgd_mrd_esta VARCHAR2(10)
);
CREATE TABLE sgd_msdep_msgdep (
	sgd_msdep_codi NUMBER(15) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	sgd_msg_codi NUMBER(15) NOT NULL
);
CREATE TABLE sgd_msg_mensaje (
	sgd_msg_codi NUMBER(15) NOT NULL,
	sgd_tme_codi NUMBER(3) NOT NULL,
	sgd_msg_desc VARCHAR2(150),
	sgd_msg_fechdesp DATE NOT NULL,
	sgd_msg_url VARCHAR2(150) NOT NULL,
	sgd_msg_veces NUMBER(3) NOT NULL,
	sgd_msg_ancho NUMBER(6) NOT NULL,
	sgd_msg_largo NUMBER(6) NOT NULL
);
CREATE TABLE sgd_mtd_matriz_doc (
	sgd_mtd_codigo NUMBER(4) NOT NULL,
	sgd_mat_codigo NUMBER(4),
	sgd_tpr_codigo NUMBER(4)
);
CREATE TABLE sgd_noh_nohabiles (
	noh_fecha DATE NOT NULL
);
CREATE TABLE sgd_not_notificacion (
	sgd_not_codi NUMBER(3) NOT NULL,
	sgd_not_descrip VARCHAR2(100) NOT NULL
);
CREATE TABLE sgd_ntrd_notifrad (
	radi_nume_radi NUMBER(15) NOT NULL,
	sgd_not_codi NUMBER(3) NOT NULL,
	sgd_ntrd_notificador VARCHAR2(150),
	sgd_ntrd_notificado VARCHAR2(150),
	sgd_ntrd_fecha_not DATE,
	sgd_ntrd_num_edicto NUMBER(6),
	sgd_ntrd_fecha_fija DATE,
	sgd_ntrd_fecha_desfija DATE,
	sgd_ntrd_observaciones VARCHAR2(150)
);
CREATE TABLE sgd_oem_oempresas (
	sgd_oem_codigo NUMBER(8) NOT NULL,
	tdid_codi NUMBER(2),
	sgd_oem_oempresa VARCHAR2(300),
	sgd_oem_rep_legal VARCHAR2(300),
	sgd_oem_nit VARCHAR2(14),
	sgd_oem_sigla VARCHAR2(1000),
	muni_codi NUMBER(4),
	dpto_codi NUMBER(2),
	sgd_oem_direccion VARCHAR2(1000),
	sgd_oem_telefono VARCHAR2(1000),
	id_cont NUMBER(2),
	id_pais NUMBER(4),
	email VARCHAR2(1000)
);
CREATE TABLE sgd_panu_peranulados (
	sgd_panu_codi NUMBER(4),
	sgd_panu_desc VARCHAR2(200)
);
CREATE TABLE sgd_parametro (
	param_nomb VARCHAR2(25) NOT NULL,
	param_codi NUMBER(5) NOT NULL,
	param_valor VARCHAR2(25) NOT NULL
);
CREATE TABLE sgd_parexp_paramexpediente (
	sgd_parexp_codigo NUMBER(4) NOT NULL,
	depe_codi NUMBER(4) NOT NULL,
	sgd_parexp_tabla VARCHAR2(30) NOT NULL,
	sgd_parexp_etiqueta VARCHAR2(15) NOT NULL,
	sgd_parexp_orden NUMBER(1),
	sgd_parexp_editable NUMBER(1)
);
CREATE TABLE sgd_pen_pensionados (
	tdid_codi NUMBER(2),
	sgd_ciu_codigo NUMBER(8) NOT NULL,
	sgd_ciu_nombre VARCHAR2(150),
	sgd_ciu_direccion VARCHAR2(150),
	sgd_ciu_apell1 VARCHAR2(50),
	sgd_ciu_apell2 VARCHAR2(50),
	sgd_ciu_telefono VARCHAR2(50),
	sgd_ciu_email VARCHAR2(50),
	muni_codi NUMBER(4),
	dpto_codi NUMBER(2),
	sgd_ciu_cedula VARCHAR2(20),
	id_cont NUMBER(2),
	id_pais NUMBER(4)
);
CREATE TABLE sgd_pexp_procexpedientes (
	sgd_pexp_codigo NUMBER NOT NULL,
	sgd_pexp_descrip VARCHAR2(100),
	sgd_pexp_terminos NUMBER,
	sgd_srd_codigo NUMBER(3),
	sgd_sbrd_codigo NUMBER(3),
	sgd_pexp_automatico NUMBER(1),
	sgd_pexp_tieneflujo NUMBER(1)
);
CREATE TABLE sgd_pnufe_procnumfe (
	sgd_pnufe_codi NUMBER(4) NOT NULL,
	sgd_tpr_codigo NUMBER(4),
	sgd_pnufe_descrip VARCHAR2(150),
	sgd_pnufe_serie VARCHAR2(50)
);
CREATE TABLE sgd_pnun_procenum (
	sgd_pnun_codi NUMBER(4) NOT NULL,
	sgd_pnufe_codi NUMBER(4),
	depe_codi NUMBER(5),
	sgd_pnun_prepone VARCHAR2(50)
);
CREATE TABLE sgd_prc_proceso (
	sgd_prc_codigo NUMBER(4) NOT NULL,
	sgd_prc_descrip VARCHAR2(150),
	sgd_prc_fech_ini DATE,
	sgd_prc_fech_fin DATE
);
CREATE TABLE sgd_prd_prcdmentos (
	sgd_prd_codigo NUMBER(4) NOT NULL,
	sgd_prd_descrip VARCHAR2(200),
	sgd_prd_fech_ini DATE,
	sgd_prd_fech_fin DATE
);
CREATE TABLE sgd_rda_retdoca (
	anex_radi_nume NUMBER(15) NOT NULL,
	anex_codigo VARCHAR2(20) NOT NULL,
	radi_nume_salida NUMBER(15),
	anex_borrado VARCHAR2(1),
	sgd_mrd_codigo NUMBER(4) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	usua_codi NUMBER(10) NOT NULL,
	usua_doc VARCHAR2(14) NOT NULL,
	sgd_rda_fech DATE,
	sgd_deve_codigo NUMBER(2),
	anex_solo_lect VARCHAR2(1),
	anex_radi_fech DATE,
	anex_estado NUMBER(1),
	anex_nomb_archivo VARCHAR2(50),
	anex_tipo NUMBER(4),
	sgd_dir_tipo NUMBER(4)
);
CREATE TABLE sgd_rdf_retdocf (
	sgd_mrd_codigo NUMBER(4) NOT NULL,
	radi_nume_radi NUMBER(15) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	usua_codi NUMBER(10) NOT NULL,
	usua_doc VARCHAR2(14) NOT NULL,
	sgd_rdf_fech DATE NOT NULL
);
CREATE TABLE sgd_renv_regenvio (
	sgd_renv_codigo NUMBER NOT NULL,
	sgd_fenv_codigo NUMBER,
	sgd_renv_fech TIMESTAMP,
	radi_nume_sal NUMBER,
	sgd_renv_destino VARCHAR2(4000),
	sgd_renv_telefono VARCHAR2(4000),
	sgd_renv_mail VARCHAR2(4000),
	sgd_renv_peso VARCHAR2(4000),
	sgd_renv_valor NUMBER,
	sgd_renv_certificado NUMBER,
	sgd_renv_estado NUMBER,
	usua_doc NUMBER,
	sgd_renv_nombre VARCHAR2(4000),
	sgd_rem_destino NUMBER,
	sgd_dir_codigo NUMBER,
	sgd_renv_planilla VARCHAR2(8),
	sgd_renv_fech_sal TIMESTAMP,
	depe_codi NUMBER(5),
	sgd_dir_tipo NUMBER(4),
	radi_nume_grupo NUMBER(14),
	sgd_renv_dir VARCHAR2(100),
	sgd_renv_depto VARCHAR2(30),
	sgd_renv_mpio VARCHAR2(30),
	sgd_renv_tel VARCHAR2(20),
	sgd_renv_cantidad NUMBER(4),
	sgd_renv_tipo NUMBER(1),
	sgd_renv_observa VARCHAR2(200),
	sgd_renv_grupo NUMBER(14),
	sgd_deve_codigo NUMBER(2),
	sgd_deve_fech TIMESTAMP,
	sgd_renv_valortotal VARCHAR2(14),
	sgd_renv_valistamiento VARCHAR2(10),
	sgd_renv_vdescuento VARCHAR2(10),
	sgd_renv_vadicional VARCHAR2(14),
	sgd_depe_genera NUMBER(5),
	sgd_renv_pais VARCHAR2(30),
	sgd_renv_guia VARCHAR2(10)
);
CREATE TABLE sgd_renv_regenvio1 (
	sgd_renv_codigo NUMBER(6) NOT NULL,
	sgd_fenv_codigo NUMBER(5),
	sgd_renv_fech DATE,
	radi_nume_sal NUMBER(14),
	sgd_renv_destino VARCHAR2(150),
	sgd_renv_telefono VARCHAR2(50),
	sgd_renv_mail VARCHAR2(150),
	sgd_renv_peso VARCHAR2(10),
	sgd_renv_valor VARCHAR2(10),
	sgd_renv_certificado NUMBER(1),
	sgd_renv_estado NUMBER(1),
	usua_doc NUMBER(15),
	sgd_renv_nombre VARCHAR2(100),
	sgd_rem_destino NUMBER(1),
	sgd_dir_codigo NUMBER(10),
	sgd_renv_planilla VARCHAR2(8),
	sgd_renv_fech_sal DATE,
	depe_codi NUMBER(5),
	sgd_dir_tipo NUMBER(4),
	radi_nume_grupo NUMBER(14),
	sgd_renv_dir VARCHAR2(100),
	sgd_renv_depto VARCHAR2(30),
	sgd_renv_mpio VARCHAR2(30),
	sgd_renv_tel VARCHAR2(20),
	sgd_renv_cantidad NUMBER(4),
	sgd_renv_tipo NUMBER(1),
	sgd_renv_observa VARCHAR2(200),
	sgd_renv_grupo NUMBER(14),
	sgd_deve_codigo NUMBER(2),
	sgd_deve_fech DATE,
	sgd_renv_valortotal VARCHAR2(14),
	sgd_renv_valistamiento VARCHAR2(10),
	sgd_renv_vdescuento VARCHAR2(10),
	sgd_renv_vadicional VARCHAR2(14),
	sgd_depe_genera NUMBER(5),
	sgd_renv_pais VARCHAR2(30)
);
CREATE TABLE sgd_rfax_reservafax (
	sgd_rfax_codigo NUMBER(10),
	sgd_rfax_fax VARCHAR2(30),
	usua_login VARCHAR2(30),
	sgd_rfax_fech DATE,
	sgd_rfax_fechradi DATE,
	radi_nume_radi NUMBER(15),
	sgd_rfax_observa VARCHAR2(500)
);
CREATE TABLE sgd_rmr_radmasivre (
	sgd_rmr_grupo NUMBER(15) NOT NULL,
	sgd_rmr_radi NUMBER(15) NOT NULL
);
CREATE TABLE sgd_san_sancionados (
	sgd_san_ref VARCHAR2(20) NOT NULL,
	sgd_san_decision VARCHAR2(60),
	sgd_san_cargo VARCHAR2(50),
	sgd_san_expediente VARCHAR2(20),
	sgd_san_tipo_sancion VARCHAR2(50),
	sgd_san_plazo VARCHAR2(100),
	sgd_san_valor NUMBER(14,2),
	sgd_san_radicacion VARCHAR2(15),
	sgd_san_fecha_radicado DATE,
	sgd_san_valorletras VARCHAR2(1000),
	sgd_san_nombreempresa VARCHAR2(160),
	sgd_san_motivos VARCHAR2(160),
	sgd_san_sectores VARCHAR2(160),
	sgd_san_padre VARCHAR2(15),
	sgd_san_fecha_padre DATE,
	sgd_san_notificado VARCHAR2(100)
);
CREATE TABLE sgd_san_sancionados_x (
	radi_nume_radi NUMBER(15) NOT NULL,
	sgd_san_decision VARCHAR2(60),
	sgd_san_cargo VARCHAR2(50),
	sgd_san_expediente VARCHAR2(15),
	sgd_san_tipo_sancion VARCHAR2(50),
	sgd_san_plazo VARCHAR2(100),
	sgd_san_valor NUMBER(14,2),
	sgd_san_radicacion VARCHAR2(15),
	sgd_san_fecha_radicado DATE,
	sgd_san_valorletras VARCHAR2(1000),
	sgd_san_nombreempresa VARCHAR2(160),
	sgd_san_motivos VARCHAR2(160),
	sgd_san_sectores VARCHAR2(160),
	sgd_san_padre VARCHAR2(15)
);
CREATE TABLE sgd_sbrd_subserierd (
	sgd_srd_codigo NUMBER(4) NOT NULL,
	sgd_sbrd_codigo NUMBER(4) NOT NULL,
	sgd_sbrd_descrip VARCHAR2(500) NOT NULL,
	sgd_sbrd_fechini DATE NOT NULL,
	sgd_sbrd_fechfin DATE NOT NULL,
	sgd_sbrd_tiemag NUMBER(4),
	sgd_sbrd_tiemac NUMBER(4),
	sgd_sbrd_dispfin VARCHAR2(50),
	sgd_sbrd_soporte VARCHAR2(50),
	sgd_sbrd_procedi VARCHAR2(1500)
);
CREATE TABLE sgd_sed_sede (
	sgd_sed_codi NUMBER(4) NOT NULL,
	sgd_sed_desc VARCHAR2(50)
);
CREATE TABLE sgd_senuf_secnumfe (
	sgd_senuf_codi NUMBER(4) NOT NULL,
	sgd_pnufe_codi NUMBER(4),
	depe_codi NUMBER(5),
	sgd_senuf_sec VARCHAR2(50)
);
CREATE TABLE sgd_sexp_secexpedientes (
	sgd_exp_numero VARCHAR2(18) NOT NULL,
	sgd_srd_codigo NUMBER,
	sgd_sbrd_codigo NUMBER,
	sgd_sexp_secuencia NUMBER,
	depe_codi NUMBER,
	usua_doc VARCHAR2(15),
	sgd_sexp_fech DATE,
	sgd_fexp_codigo NUMBER,
	sgd_sexp_ano NUMBER,
	usua_doc_responsable VARCHAR2(18),
	sgd_sexp_parexp1 VARCHAR2(250),
	sgd_sexp_parexp2 VARCHAR2(160),
	sgd_sexp_parexp3 VARCHAR2(160),
	sgd_sexp_parexp4 VARCHAR2(160),
	sgd_sexp_parexp5 VARCHAR2(160),
	sgd_pexp_codigo NUMBER(3),
	sgd_exp_fech_arch DATE,
	sgd_fld_codigo NUMBER(3),
	sgd_exp_fechflujoant DATE,
	sgd_mrd_codigo NUMBER(4),
	sgd_exp_subexpediente NUMBER(18),
	sgd_exp_privado NUMBER(1),
	sgd_sexp_estado NUMBER(1) NOT NULL
);
CREATE TABLE sgd_srd_seriesrd (
	sgd_srd_codigo NUMBER(4) NOT NULL,
	sgd_srd_descrip VARCHAR2(60) NOT NULL,
	sgd_srd_fechini DATE NOT NULL,
	sgd_srd_fechfin DATE NOT NULL
);
CREATE TABLE sgd_tar_tarifas (
	sgd_fenv_codigo NUMBER(5),
	sgd_tar_codser NUMBER(5),
	sgd_tar_codigo NUMBER(5),
	sgd_tar_valenv1 NUMBER(15),
	sgd_tar_valenv2 NUMBER(15),
	sgd_tar_valenv1g1 NUMBER(15),
	sgd_clta_codser NUMBER(5),
	sgd_tar_valenv2g2 NUMBER(15),
	sgd_clta_descrip VARCHAR2(100)
);
CREATE TABLE sgd_tdec_tipodecision (
	sgd_apli_codi NUMBER(4) NOT NULL,
	sgd_tdec_codigo NUMBER(4) NOT NULL,
	sgd_tdec_descrip VARCHAR2(150),
	sgd_tdec_sancionar NUMBER(1),
	sgd_tdec_firmeza NUMBER(1),
	sgd_tdec_versancion NUMBER(1),
	sgd_tdec_showmenu NUMBER(1),
	sgd_tdec_updnotif NUMBER(1),
	sgd_tdec_veragota NUMBER(1)
);
CREATE TABLE sgd_tid_tipdecision (
	sgd_tid_codi NUMBER(4) NOT NULL,
	sgd_tid_desc VARCHAR2(150),
	sgd_tpr_codigo NUMBER(4),
	sgd_pexp_codigo NUMBER(2),
	sgd_tpr_codigop NUMBER(2)
);
CREATE TABLE sgd_tidm_tidocmasiva (
	sgd_tidm_codi NUMBER(4) NOT NULL,
	sgd_tidm_desc VARCHAR2(150)
);
CREATE TABLE sgd_tip3_tipotercero (
	sgd_tip3_codigo NUMBER(2) NOT NULL,
	sgd_dir_tipo NUMBER(4),
	sgd_tip3_nombre VARCHAR2(15),
	sgd_tip3_desc VARCHAR2(30),
	sgd_tip3_imgpestana VARCHAR2(20),
	sgd_tpr_tp1 NUMBER(1),
	sgd_tpr_tp2 NUMBER(1),
	sgd_tpr_tp4 NUMBER(38),
	sgd_tpr_tp3 NUMBER(38),
	sgd_tpr_tp5 NUMBER(38)
);
CREATE TABLE sgd_tma_temas (
	sgd_tma_codigo NUMBER(4) NOT NULL,
	depe_codi NUMBER(5),
	sgd_prc_codigo NUMBER(4),
	sgd_tma_descrip VARCHAR2(150)
);
CREATE TABLE sgd_tme_tipmen (
	sgd_tme_codi NUMBER(3) NOT NULL,
	sgd_tme_desc VARCHAR2(150)
);
CREATE TABLE sgd_tpr_tpdcumento (
	sgd_tpr_codigo NUMBER(4) NOT NULL,
	sgd_tpr_descrip VARCHAR2(500),
	sgd_tpr_termino NUMBER(4),
	sgd_tpr_tpuso NUMBER(1),
	sgd_tpr_numera CHAR(1),
	sgd_tpr_radica CHAR(1),
	sgd_tpr_tp1 NUMBER(1),
	sgd_tpr_tp2 NUMBER(1),
	sgd_tpr_estado NUMBER(1),
	sgd_termino_real NUMBER(4),
	sgd_tpr_web NUMBER(38),
	sgd_tpr_tiptermino VARCHAR2(5),
	sgd_tpr_tp4 NUMBER(38),
	sgd_tpr_tp3 NUMBER(38),
	sgd_tpr_tp5 NUMBER(38)
);
CREATE TABLE sgd_trad_tiporad (
	sgd_trad_codigo NUMBER(2) NOT NULL,
	sgd_trad_descr VARCHAR2(30),
	sgd_trad_icono VARCHAR2(30),
	sgd_trad_diasbloqueo NUMBER(2),
	sgd_trad_genradsal NUMBER(38),
	PRIMARY KEY (sgd_trad_codigo)
);
CREATE TABLE sgd_ttr_transaccion (
	sgd_ttr_codigo NUMBER(3) NOT NULL,
	sgd_ttr_descrip VARCHAR2(100) NOT NULL,
	PRIMARY KEY (sgd_ttr_codigo)
);
CREATE TABLE sgd_tvd_dependencia (
	sgd_depe_codi NUMBER(5) NOT NULL,
	sgd_depe_nombre VARCHAR2(200) NOT NULL,
	sgd_depe_fechini DATE NOT NULL,
	sgd_depe_fechfin DATE NOT NULL
);
CREATE TABLE sgd_tvd_series (
	sgd_depe_codi NUMBER(4) NOT NULL,
	sgd_stvd_codi NUMBER(4) NOT NULL,
	sgd_stvd_nombre VARCHAR2(200) NOT NULL,
	sgd_stvd_ac NUMBER(4),
	sgd_stvd_dispfin NUMBER(2),
	sgd_stvd_proc VARCHAR2(500),
	PRIMARY KEY (sgd_depe_codi,sgd_stvd_codi)
);
CREATE TABLE sgd_ush_usuhistorico (
	sgd_ush_admcod NUMBER(10) NOT NULL,
	sgd_ush_admdep NUMBER(5) NOT NULL,
	sgd_ush_admdoc VARCHAR2(14) NOT NULL,
	sgd_ush_usucod NUMBER(10) NOT NULL,
	sgd_ush_usudep NUMBER(5) NOT NULL,
	sgd_ush_usudoc VARCHAR2(14) NOT NULL,
	sgd_ush_modcod NUMBER(5) NOT NULL,
	sgd_ush_fechevento DATE NOT NULL,
	sgd_ush_usulogin VARCHAR2(20) NOT NULL
);
CREATE TABLE sgd_usm_usumodifica (
	sgd_usm_modcod NUMBER(5) NOT NULL,
	sgd_usm_moddescr VARCHAR2(60) NOT NULL
);
CREATE TABLE tipo_doc_identificacion (
	tdid_codi NUMBER(2) NOT NULL,
	tdid_desc VARCHAR2(100) NOT NULL
);
CREATE TABLE tipo_remitente (
	trte_codi NUMBER(2) NOT NULL,
	trte_desc VARCHAR2(100) NOT NULL
);
CREATE TABLE ubicacion_fisica (
	ubic_depe_radi NUMBER(5),
	ubic_depe_arch NUMBER(5)
);
CREATE TABLE usuario (
	usua_codi NUMBER(10) NOT NULL,
	depe_codi NUMBER(5) NOT NULL,
	usua_login VARCHAR2(50) NOT NULL,
	usua_fech_crea DATE,
	usua_pasw VARCHAR2(35) NOT NULL,
	usua_esta VARCHAR2(10) NOT NULL,
	usua_nomb VARCHAR2(45),
	perm_radi CHAR(1),
	usua_admin CHAR(1),
	usua_nuevo CHAR(1),
	usua_doc VARCHAR2(14),
	codi_nivel NUMBER(2),
	usua_sesion VARCHAR2(30),
	usua_fech_sesion DATE,
	usua_ext NUMBER(4),
	usua_nacim DATE,
	usua_email VARCHAR2(50),
	usua_at VARCHAR2(50),
	usua_piso NUMBER(2),
	perm_radi_sal NUMBER,
	usua_admin_archivo NUMBER(1),
	usua_masiva NUMBER(1),
	usua_perm_dev NUMBER(1),
	usua_perm_numera_res VARCHAR2(1),
	usua_doc_suip VARCHAR2(15),
	usua_perm_numeradoc NUMBER(1),
	sgd_panu_codi NUMBER(4),
	usua_prad_tp1 NUMBER(1),
	usua_prad_tp2 NUMBER(1),
	usua_perm_envios NUMBER(1),
	usua_perm_modifica NUMBER(1),
	usua_perm_impresion NUMBER(1),
	sgd_aper_codigo NUMBER(2),
	usu_telefono1 VARCHAR2(14),
	usua_encuesta VARCHAR2(1),
	sgd_perm_estadistica NUMBER(2),
	usua_perm_sancionados NUMBER(1),
	usua_admin_sistema NUMBER(1),
	usua_perm_trd NUMBER(1),
	usua_perm_firma NUMBER(1),
	usua_perm_prestamo NUMBER(1),
	usuario_publico NUMBER(1),
	usuario_reasignar NUMBER(1),
	usua_perm_notifica NUMBER(1),
	usua_perm_expediente NUMBER,
	usua_login_externo VARCHAR2(15),
	id_pais NUMBER(4),
	id_cont NUMBER(2),
	usua_auth_ldap NUMBER(1),
	perm_archi CHAR(1),
	perm_vobo CHAR(1),
	perm_borrar_anexo NUMBER(1),
	perm_tipif_anexo NUMBER(1),
	usua_perm_adminflujos NUMBER(1) NOT NULL,
	usua_exp_trd NUMBER(2),
	usua_perm_rademail NUMBER(38),
	usua_prad_tp4 NUMBER(38),
	usua_perm_accesi NUMBER(1),
	usua_prad_tp3 NUMBER(38),
	usua_prad_tp5 NUMBER(38),
	usua_perm_agrcontacto NUMBER(1),
	PRIMARY KEY (usua_login)
);
ALTER TABLE municipio
	ADD FOREIGN KEY (dpto_codi) 
	REFERENCES departamento (dpto_codi);


ALTER TABLE sgd_carp_descripcion
	ADD FOREIGN KEY (sgd_carp_tiporad) 
	REFERENCES sgd_trad_tiporad (sgd_trad_codigo);

