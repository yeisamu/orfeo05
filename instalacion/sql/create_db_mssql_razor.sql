CREATE TABLE anexos (
	anex_radi_nume decimal(15) NOT NULL,
	anex_codigo varchar(20) NOT NULL,
	anex_tipo decimal(4) NOT NULL,
	anex_tamano decimal(21,6),
	anex_solo_lect varchar(1) NOT NULL,
	anex_creador varchar(50) NOT NULL,
	anex_desc varchar(512),
	anex_numero decimal(5) NOT NULL,
	anex_nomb_archivo varchar(50) NOT NULL,
	anex_borrado varchar(1) NOT NULL,
	anex_origen decimal(1),
	anex_ubic varchar(15),
	anex_salida decimal(1),
	radi_nume_salida decimal(15),
	anex_radi_fech varchar(50),
	anex_estado decimal(1),
	usua_doc varchar(14),
	sgd_rem_destino decimal(1),
	anex_fech_envio varchar(50),
	sgd_dir_tipo decimal(4),
	anex_fech_impres varchar(50),
	anex_depe_creador decimal(4),
	sgd_doc_secuencia decimal(15),
	sgd_doc_padre varchar(20),
	sgd_arg_codigo decimal(2),
	sgd_tpr_codigo decimal(4),
	sgd_deve_codigo decimal(2),
	sgd_deve_fech date,
	sgd_fech_impres datetime,
	anex_fech_anex varchar(50),
	anex_depe_codi varchar(3),
	sgd_pnufe_codi decimal(4),
	sgd_dnufe_codi decimal(4),
	anex_usudoc_creador varchar(15),
	sgd_fech_doc date,
	sgd_apli_codi decimal(4),
	sgd_trad_codigo decimal(2),
	sgd_dir_direccion varchar(150),
	sgd_exp_numero varchar(18),
	numero_doc varchar(15),
	sgd_srd_codigo varchar(3),
	sgd_sbrd_codigo varchar(4),
	anex_num_hoja decimal(21,6),
	texto_archivo_anex text,
	anex_idarch_version decimal(3),
	anex_num_version decimal(2)
);
CREATE TABLE anexos_historico (
	anex_hist_anex_codi varchar(20) NOT NULL,
	anex_hist_num_ver decimal(4) NOT NULL,
	anex_hist_tipo_mod varchar(2) NOT NULL,
	anex_hist_usua varchar(15) NOT NULL,
	anex_hist_fecha date NOT NULL,
	usua_doc varchar(14)
);
CREATE TABLE anexos_tipo (
	anex_tipo_codi decimal(4) NOT NULL,
	anex_tipo_ext varchar(10) NOT NULL,
	anex_tipo_desc varchar(50)
);
CREATE TABLE aux_01 (
	r decimal(21,6)
);
CREATE TABLE bodega_empresas (
	nombre_de_la_empresa varchar(300),
	nuir varchar(13),
	nit_de_la_empresa varchar(80),
	sigla_de_la_empresa varchar(80),
	direccion varchar(4000),
	codigo_del_departamento varchar(4000),
	codigo_del_municipio varchar(4000),
	telefono_1 varchar(4000),
	telefono_2 varchar(4000),
	email varchar(4000),
	nombre_rep_legal varchar(4000),
	cargo_rep_legal varchar(4000),
	identificador_empresa decimal(5) NOT NULL,
	are_esp_secue decimal(8) NOT NULL,
	id_cont decimal(2),
	id_pais decimal(4),
	activa decimal(1),
	flag_rups varchar(10),
	codigo_suscriptor varchar(50),
	PRIMARY KEY (identificador_empresa)
);
CREATE TABLE bodega_empresas_old (
	identificador_de_la_empresa decimal(5) NOT NULL,
	nuir varchar(13),
	nombre_de_la_empresa varchar(150),
	nit_de_la_empresa varchar(13),
	sigla_de_la_empresa varchar(30),
	codigo_de_la_nat_juridica decimal(2),
	direccion varchar(50),
	codigo_del_departamento decimal(2),
	codigo_del_municipio decimal(3),
	codigo_de_la_unidad decimal(3),
	telefono_1 varchar(15),
	telefono_2 varchar(15),
	telefono_3 varchar(15),
	apartado_aereo decimal(10),
	numero_de_fax varchar(15),
	zona_postal decimal(3),
	email varchar(50),
	tiene_contab_por_servicio varchar(2),
	fecha_de_actualizacion date,
	codigo_regional decimal(3),
	estado_de_la_empresa varchar(50),
	fecha_del_estado date,
	obsv_del_estado varchar(100),
	esp_cias decimal(4),
	esp_auxi decimal(8),
	esp_etco decimal(2),
	esp_ceco varchar(16),
	estado decimal(2),
	tipo_identificacion_repl varchar(1),
	numero_identificaci_repl varchar(11),
	nombre_rep_legal varchar(75),
	cargo_rep_legal decimal(2),
	numero_camara_ccio varchar(20),
	cod_estado_vigilancia decimal(2),
	identificador_empresa decimal(5) NOT NULL,
	nombre_de_la_empresa_anterior varchar(150),
	direccion_anterior varchar(50)
);
CREATE TABLE borrar_carpeta_personalizada (
	carp_per_codi decimal(2) NOT NULL,
	carp_per_usu varchar(15) NOT NULL,
	carp_per_desc varchar(80) NOT NULL
);
CREATE TABLE borrar_empresa_esp (
	eesp_codi decimal(7) NOT NULL,
	eesp_nomb varchar(150) NOT NULL,
	essp_nit varchar(13),
	essp_sigla varchar(30),
	depe_codi decimal(2),
	muni_codi decimal(4),
	eesp_dire varchar(50),
	eesp_rep_leg varchar(75)
);
CREATE TABLE carpeta (
	carp_codi decimal(2) NOT NULL,
	carp_desc varchar(80) NOT NULL
);
CREATE TABLE carpeta_per (
	usua_codi decimal(3) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	nomb_carp varchar(15),
	desc_carp varchar(50),
	codi_carp decimal(3)
);
CREATE TABLE centro_poblado (
	cpob_codi decimal(4) NOT NULL,
	muni_codi decimal(4) NOT NULL,
	dpto_codi decimal(2) NOT NULL,
	cpob_nomb varchar(100) NOT NULL,
	cpob_nomb_anterior varchar(100)
);
CREATE TABLE departamento (
	dpto_codi decimal(3) NOT NULL,
	dpto_nomb varchar(70) NOT NULL,
	id_cont decimal(2),
	id_pais decimal(4)
);
CREATE TABLE dependencia (
	depe_codi decimal(5) NOT NULL,
	depe_nomb varchar(70) NOT NULL,
	dpto_codi decimal(2),
	depe_codi_padre decimal(5),
	muni_codi decimal(4),
	depe_codi_territorial decimal(4),
	dep_sigla varchar(100),
	dep_central decimal(1),
	dep_direccion varchar(100),
	depe_num_interna decimal(4),
	depe_num_resolucion decimal(4),
	depe_rad_tp1 decimal(3),
	depe_rad_tp2 decimal(3),
	id_cont decimal(2),
	id_pais decimal(4),
	depe_estado decimal(1),
	depe_rad_tp4 int,
	depe_segu int,
	depe_rad_tp3 int,
	depe_rad_tp5 int
);
CREATE TABLE dependencia_visibilidad (
	codigo_visibilidad decimal(18) NOT NULL,
	dependencia_visible decimal(5) NOT NULL,
	dependencia_observa decimal(5) NOT NULL
);
CREATE TABLE dup_eliminar (
	sgd_oem_codigo decimal(8) NOT NULL,
	tdid_codi decimal(2),
	sgd_oem_oempresa varchar(150),
	sgd_oem_rep_legal varchar(150),
	sgd_oem_nit varchar(14),
	sgd_oem_sigla varchar(50),
	muni_codi decimal(4),
	dpto_codi decimal(2),
	sgd_oem_direccion varchar(100),
	sgd_oem_telefono varchar(50)
);
CREATE TABLE emp_cod_actualizar (
	emp_cod_ant varchar(10),
	emp_cod_nue varchar(10)
);
CREATE TABLE empresas_temporal (
	nombre_de_la_empresa varchar(160),
	nuir varchar(13),
	nit_de_la_empresa varchar(80),
	sigla_de_la_empresa varchar(80),
	direccion varchar(4000),
	codigo_del_departamento varchar(4000),
	codigo_del_municipio varchar(4000),
	telefono_1 varchar(4000),
	telefono_2 varchar(4000),
	email varchar(4000),
	nombre_rep_legal varchar(4000),
	cargo_rep_legal varchar(4000),
	identificador_empresa decimal(5),
	are_esp_secue decimal(8) NOT NULL
);
CREATE TABLE encuesta (
	usua_doc varchar(14) NOT NULL,
	fecha date,
	p1 varchar(100),
	p2 varchar(100),
	p3 varchar(100),
	p4 varchar(100),
	p5 varchar(100),
	p6 varchar(100),
	p7 varchar(100),
	p7_cual varchar(150),
	p8 varchar(100),
	p9 varchar(100),
	p10 varchar(100),
	p11 varchar(100),
	p12 varchar(100),
	p13 varchar(100),
	p14 varchar(100),
	p15 varchar(100),
	p16 varchar(100),
	p17 varchar(100),
	p18 varchar(100),
	p19 varchar(100),
	p20 varchar(100),
	p20_cual varchar(150),
	p21 varchar(100),
	p22 varchar(100),
	p23 varchar(100),
	p24 varchar(100),
	p25 varchar(100)
);
CREATE TABLE entidades_asociativa (
	nit varchar(12),
	codentidad decimal(10)
);
CREATE TABLE estado (
	esta_codi decimal(2) NOT NULL,
	esta_desc varchar(100) NOT NULL
);
CREATE TABLE example (
	campo1 decimal(15) NOT NULL,
	campo2 varchar(10)
);
CREATE TABLE fun_funcionario (
	usua_doc varchar(14),
	usua_fech_crea date NOT NULL,
	usua_esta varchar(10) NOT NULL,
	usua_nomb varchar(45),
	usua_ext decimal(4),
	usua_nacim date,
	usua_email varchar(50),
	usua_at varchar(15),
	usua_piso decimal(2),
	cedula_ok char(1),
	cedula_suip varchar(15),
	nombre_suip varchar(45),
	observa char(20)
);
CREATE TABLE fun_funcionario_2 (
	usua_doc varchar(14),
	usua_fech_crea date NOT NULL,
	usua_esta varchar(10) NOT NULL,
	usua_nomb varchar(45),
	usua_ext decimal(4),
	usua_nacim date,
	usua_email varchar(50),
	usua_at varchar(15),
	usua_piso decimal(2),
	cedula_ok char(1),
	cedula_suip varchar(15),
	nombre_suip varchar(45),
	observa char(20)
);
CREATE TABLE hist_eventos (
	depe_codi decimal(5) NOT NULL,
	hist_fech varchar(50) NOT NULL,
	usua_codi decimal(10) NOT NULL,
	radi_nume_radi decimal(15) NOT NULL,
	hist_obse varchar(max) NOT NULL,
	usua_codi_dest decimal(10),
	usua_doc varchar(14),
	usua_doc_old varchar(15),
	sgd_ttr_codigo decimal(3),
	hist_usua_autor varchar(14),
	hist_doc_dest varchar(14),
	depe_codi_dest decimal(3)
);
CREATE TABLE informados (
	radi_nume_radi decimal(15) NOT NULL,
	usua_codi decimal(10) NOT NULL,
	depe_codi decimal(3) NOT NULL,
	info_desc varchar(600),
	info_fech date NOT NULL,
	info_leido decimal(1),
	usua_codi_info decimal(3),
	info_codi decimal(10),
	usua_doc varchar(14),
	info_resp varchar(10)
);
CREATE TABLE medio_recepcion (
	mrec_codi decimal(2) NOT NULL,
	mrec_desc varchar(100) NOT NULL
);
CREATE TABLE municipio (
	muni_codi decimal(4) NOT NULL,
	dpto_codi decimal(3) NOT NULL,
	muni_nomb varchar(100) NOT NULL,
	id_cont decimal(2),
	id_pais decimal(4),
	homologa_muni varchar(10),
	homologa_idmuni varchar(15),
	activa decimal(1)
);
CREATE TABLE ortega_prueba_orfeo (
	radi_nume_hoja decimal(3),
	radi_fech_radi date,
	radi_nume_radi decimal(15),
	ra_asun varchar(350),
	radi_path varchar(100),
	radi_usu_ante varchar(45),
	nombre_de_la_empresa varchar(150),
	fecha varchar(20),
	sgd_tpr_descrip varchar(150),
	sgd_tpr_codigo decimal(4),
	sgd_tpr_termino decimal(4),
	diasr decimal(4),
	radi_leido decimal(1),
	radi_tipo_deri decimal(2),
	radi_nume_deri decimal(15),
	sgd_ciu_nombre varchar(50),
	sgd_ciu_apell1 varchar(50),
	sgd_ciu_apell2 varchar(50),
	tipo_query varchar(50),
	sgd_dir_tipo decimal(4),
	sgd_dir_nombre varchar(60),
	radi_cuentai varchar(20),
	sgd_exp_numero varchar(15)
);
CREATE TABLE p_sgd_oem_oempresas (
	sgd_oem_codigo decimal(8) NOT NULL,
	tdid_codi decimal(2),
	sgd_oem_oempresa varchar(150),
	sgd_oem_rep_legal varchar(150),
	sgd_oem_nit varchar(14),
	sgd_oem_sigla varchar(50),
	muni_codi decimal(4),
	dpto_codi decimal(2),
	sgd_oem_direccion varchar(100),
	sgd_oem_telefono varchar(50)
);
CREATE TABLE par_serv_servicios (
	par_serv_secue decimal(8) NOT NULL,
	par_serv_codigo varchar(5),
	par_serv_nombre varchar(100),
	par_serv_estado varchar(1)
);
CREATE TABLE pl_generado_plg (
	depe_codi decimal(5),
	radi_nume_radi decimal(15),
	plt_codi decimal(4),
	plg_codi decimal(4),
	plg_comentarios varchar(150),
	plg_analiza decimal(10),
	plg_firma decimal(10),
	plg_autoriza decimal(10),
	plg_imprime decimal(10),
	plg_envia decimal(10),
	plg_archivo_tmp varchar(150),
	plg_archivo_final varchar(150),
	plg_nombre varchar(30),
	plg_crea decimal(10),
	plg_autoriza_fech date,
	plg_imprime_fech date,
	plg_envia_fech date,
	plg_crea_fech date,
	plg_creador varchar(20),
	pl_codi decimal(4),
	usua_doc varchar(14),
	sgd_rem_destino decimal(1),
	radi_nume_sal decimal(15)
);
CREATE TABLE pl_tipo_plt (
	plt_codi decimal(4) NOT NULL,
	plt_desc varchar(35)
);
CREATE TABLE plan_table (
	statement_id varchar(30),
	timestamp date,
	remarks varchar(80),
	operation varchar(30),
	options varchar(30),
	object_node varchar(128),
	object_owner varchar(30),
	object_name varchar(30),
	object_instance int,
	object_type varchar(30),
	optimizer varchar(255),
	search_columns decimal(21,6),
	id int,
	parent_id int,
	position int,
	cost int,
	cardinality int,
	s int,
	other_tag varchar(255),
	partition_start varchar(255),
	partition_stop varchar(255),
	partition_id int,
	other varchar(255),
	distribution varchar(30)
);
CREATE TABLE plantilla_pl (
	pl_codi decimal(4) NOT NULL,
	depe_codi decimal(5),
	pl_nomb varchar(35),
	pl_archivo varchar(35),
	pl_desc varchar(150),
	pl_fech date,
	usua_codi decimal(10),
	pl_uso decimal(1)
);
CREATE TABLE plsql_profiler_data (
	runid decimal(21,6),
	unit_numeric decimal(21,6),
	line decimal(21,6) NOT NULL,
	total_occur decimal(21,6),
	total_time decimal(21,6),
	min_time decimal(21,6),
	max_time decimal(21,6),
	spare1 decimal(21,6),
	spare2 decimal(21,6),
	spare3 decimal(21,6),
	spare4 decimal(21,6)
);
CREATE TABLE plsql_profiler_runs (
	runid decimal(21,6),
	related_run decimal(21,6),
	run_owner varchar(32),
	run_date date,
	run_comment varchar(2047),
	run_total_time decimal(21,6),
	run_system_info varchar(2047),
	run_comment1 varchar(2047),
	spare1 varchar(256)
);
CREATE TABLE plsql_profiler_units (
	runid decimal(21,6),
	unit_numeric decimal(21,6),
	unit_type varchar(32),
	unit_owner varchar(32),
	unit_name varchar(32),
	unit_timestamp date,
	total_time decimal(21,6) NOT NULL,
	spare1 decimal(21,6),
	spare2 decimal(21,6)
);
CREATE TABLE prestamo (
	pres_id decimal(10) NOT NULL,
	radi_nume_radi decimal(15) NOT NULL,
	usua_login_actu varchar(50) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	usua_login_pres varchar(50),
	pres_desc varchar(200),
	pres_fech_pres datetime,
	pres_fech_devo datetime,
	pres_fech_pedi datetime NOT NULL,
	pres_estado decimal(2),
	pres_requerimiento decimal(2),
	pres_depe_arch decimal(5),
	pres_fech_venc datetime,
	dev_desc varchar(500),
	pres_fech_canc datetime,
	usua_login_canc varchar(50),
	usua_login_rx varchar(50)
);
CREATE TABLE pruba (
	nombre varchar(20),
	tel varchar(20)
);
CREATE TABLE radicado (
	radi_nume_radi decimal(15) NOT NULL,
	radi_fech_radi varchar(50) NOT NULL,
	tdoc_codi decimal(4) NOT NULL,
	trte_codi decimal(2),
	mrec_codi decimal(2),
	eesp_codi decimal(10),
	eotra_codi decimal(10),
	radi_tipo_empr varchar(2),
	radi_fech_ofic date,
	tdid_codi decimal(2),
	radi_nume_iden varchar(15),
	radi_nomb varchar(90),
	radi_prim_apel varchar(50),
	radi_segu_apel varchar(50),
	radi_pais varchar(70),
	muni_codi decimal(5),
	cpob_codi decimal(4),
	carp_codi decimal(3),
	esta_codi decimal(2),
	dpto_codi decimal(2),
	cen_muni_codi decimal(4),
	cen_dpto_codi decimal(2),
	radi_dire_corr varchar(100),
	radi_tele_cont varchar(15),
	radi_nume_hoja decimal(4),
	radi_desc_anex varchar(500),
	radi_nume_deri decimal(15),
	radi_path varchar(100),
	radi_usua_actu decimal(10),
	radi_depe_actu decimal(5),
	radi_fech_asig varchar(50),
	radi_arch1 varchar(10),
	radi_arch2 varchar(10),
	radi_arch3 varchar(10),
	radi_arch4 varchar(10),
	ra_asun varchar(350),
	radi_usu_ante varchar(45),
	radi_depe_radi decimal(3),
	radi_rem varchar(60),
	radi_usua_radi decimal(10),
	codi_nivel decimal(2),
	flag_nivel int,
	carp_per decimal(1),
	radi_leido decimal(1),
	radi_cuentai varchar(20),
	radi_tipo_deri decimal(2),
	listo varchar(2),
	sgd_tma_codigo decimal(4),
	sgd_mtd_codigo decimal(4),
	par_serv_secue decimal(8),
	sgd_fld_codigo decimal(3),
	radi_agend decimal(1),
	radi_fech_agend varchar(50),
	radi_fech_doc date,
	sgd_doc_secuencia decimal(15),
	sgd_pnufe_codi decimal(4),
	sgd_eanu_codigo decimal(1),
	sgd_not_codi decimal(3),
	radi_fech_notif varchar(50),
	sgd_tdec_codigo decimal(4),
	sgd_apli_codi decimal(4),
	sgd_ttr_codigo int,
	usua_doc_ante varchar(14),
	radi_fech_antetx varchar(50),
	sgd_trad_codigo decimal(2),
	fech_vcmto varchar(50),
	tdoc_vcmto decimal(4),
	sgd_termino_real decimal(4),
	id_cont decimal(2),
	sgd_spub_codigo decimal(2),
	id_pais decimal(4),
	medio_m varchar(5),
	radi_nrr decimal(2),
	numero_rm varchar(15),
	numero_tran varchar(15),
	texto_archivo text,
	PRIMARY KEY (radi_nume_radi)
);
CREATE TABLE retencion_doc_tmp (
	cod_serie decimal(4),
	serie varchar(100),
	tipologia_doc varchar(200),
	cod_subserie varchar(10),
	subserie varchar(100),
	tipologia_sub varchar(200),
	dependencia decimal(5),
	nom_depe varchar(200),
	archivo_gestion decimal(3),
	archivo_central decimal(3),
	disposicion varchar(100),
	soporte varchar(20),
	procedimiento varchar(500),
	tipo_doc decimal(4),
	error varchar(200)
);
CREATE TABLE series (
	depe_codi decimal(5) NOT NULL,
	seri_nume decimal(7) NOT NULL,
	seri_tipo decimal(2),
	seri_ano decimal(4),
	dpto_codi decimal(2) NOT NULL,
	bloq varchar(20)
);
CREATE TABLE sgd_acm_acusemsg (
	sgd_msg_codi decimal(15) NOT NULL,
	usua_doc varchar(14),
	sgd_msg_leido decimal(3)
);
CREATE TABLE sgd_actadd_actualiadicional (
	sgd_actadd_codi decimal(4),
	sgd_apli_codi decimal(4),
	sgd_instorf_codi decimal(4),
	sgd_actadd_query varchar(500),
	sgd_actadd_desc varchar(150)
);
CREATE TABLE sgd_agen_agendados (
	sgd_agen_fech date,
	sgd_agen_observacion varchar(4000),
	radi_nume_radi decimal(15) NOT NULL,
	usua_doc varchar(18) NOT NULL,
	depe_codi varchar(3),
	sgd_agen_codigo decimal(21,6),
	sgd_agen_fechplazo date,
	sgd_agen_activo decimal(21,6)
);
CREATE TABLE sgd_anar_anexarg (
	sgd_anar_codi decimal(4) NOT NULL,
	anex_codigo varchar(20),
	sgd_argd_codi decimal(4),
	sgd_anar_argcod decimal(4)
);
CREATE TABLE sgd_anu_anulados (
	sgd_anu_id decimal(4),
	sgd_anu_desc varchar(250),
	radi_nume_radi decimal(21,6),
	sgd_eanu_codi decimal(4),
	sgd_anu_sol_fech date,
	sgd_anu_fech date,
	depe_codi decimal(3),
	usua_doc varchar(14),
	usua_codi decimal(4),
	depe_codi_anu decimal(3),
	usua_doc_anu varchar(14),
	usua_codi_anu decimal(4),
	usua_anu_acta decimal(8),
	sgd_anu_path_acta varchar(200),
	sgd_trad_codigo decimal(2)
);
CREATE TABLE sgd_aper_adminperfiles (
	sgd_aper_codigo decimal(2),
	sgd_aper_descripcion varchar(20)
);
CREATE TABLE sgd_aplfad_plicfunadi (
	sgd_aplfad_codi decimal(4),
	sgd_apli_codi decimal(4),
	sgd_aplfad_menu varchar(150) NOT NULL,
	sgd_aplfad_lk1 varchar(150) NOT NULL,
	sgd_aplfad_desc varchar(150) NOT NULL
);
CREATE TABLE sgd_apli_aplintegra (
	sgd_apli_codi decimal(4),
	sgd_apli_descrip varchar(150),
	sgd_apli_lk1desc varchar(150),
	sgd_apli_lk1 varchar(150),
	sgd_apli_lk2desc varchar(150),
	sgd_apli_lk2 varchar(150),
	sgd_apli_lk3desc varchar(150),
	sgd_apli_lk3 varchar(150),
	sgd_apli_lk4desc varchar(150),
	sgd_apli_lk4 varchar(150)
);
CREATE TABLE sgd_aplmen_aplimens (
	sgd_aplmen_codi decimal(4),
	sgd_apli_codi decimal(4),
	sgd_aplmen_ref varchar(20),
	sgd_aplmen_haciaorfeo decimal(4),
	sgd_aplmen_desdeorfeo decimal(4)
);
CREATE TABLE sgd_aplus_plicusua (
	sgd_aplus_codi decimal(4),
	sgd_apli_codi decimal(4),
	usua_doc varchar(14),
	sgd_trad_codigo decimal(2),
	sgd_aplus_prioridad decimal(1)
);
CREATE TABLE sgd_arch_depe (
	sgd_arch_depe varchar(4),
	sgd_arch_edificio decimal(6),
	sgd_arch_item decimal(6),
	sgd_arch_id decimal(21,6) NOT NULL,
	PRIMARY KEY (sgd_arch_id)
);
CREATE TABLE sgd_archivo_central (
	sgd_archivo_id decimal(21,6) NOT NULL,
	sgd_archivo_tipo decimal(21,6),
	sgd_archivo_orden varchar(15),
	sgd_archivo_fechai varchar(50),
	sgd_archivo_demandado varchar(1500),
	sgd_archivo_demandante varchar(200),
	sgd_archivo_cc_demandante decimal(21,6),
	sgd_archivo_depe varchar(5),
	sgd_archivo_zona varchar(4),
	sgd_archivo_carro decimal(21,6),
	sgd_archivo_cara varchar(4),
	sgd_archivo_estante decimal(21,6),
	sgd_archivo_entrepano decimal(21,6),
	sgd_archivo_caja decimal(21,6),
	sgd_archivo_unidocu varchar(40),
	sgd_archivo_anexo varchar(4000),
	sgd_archivo_inder decimal(21,6),
	sgd_archivo_path varchar(4000),
	sgd_archivo_year decimal(4),
	sgd_archivo_rad varchar(15) NOT NULL,
	sgd_archivo_srd decimal(21,6),
	sgd_archivo_sbrd decimal(21,6),
	sgd_archivo_folios decimal(21,6),
	sgd_archivo_mata decimal(21,6),
	sgd_archivo_fechaf varchar(50),
	sgd_archivo_prestamo decimal(1),
	sgd_archivo_funprest char(100),
	sgd_archivo_fechprest varchar(50),
	sgd_archivo_fechprestf varchar(50),
	depe_codi varchar(5),
	sgd_archivo_usua varchar(15),
	sgd_archivo_fech varchar(50),
	PRIMARY KEY (sgd_archivo_id)
);
CREATE TABLE sgd_archivo_fondo (
	sgd_archivo_id decimal(21,6) NOT NULL,
	sgd_archivo_tipo decimal(21,6),
	sgd_archivo_orden varchar(15),
	sgd_archivo_fechai varchar(50),
	sgd_archivo_demandado varchar(1500),
	sgd_archivo_demandante varchar(200),
	sgd_archivo_cc_demandante decimal(21,6),
	sgd_archivo_depe varchar(5),
	sgd_archivo_zona varchar(4),
	sgd_archivo_carro decimal(21,6),
	sgd_archivo_cara varchar(4),
	sgd_archivo_estante decimal(21,6),
	sgd_archivo_entrepano decimal(21,6),
	sgd_archivo_caja decimal(21,6),
	sgd_archivo_unidocu varchar(40),
	sgd_archivo_anexo varchar(4000),
	sgd_archivo_inder decimal(21,6),
	sgd_archivo_path varchar(4000),
	sgd_archivo_year decimal(4),
	sgd_archivo_rad varchar(15) NOT NULL,
	sgd_archivo_srd decimal(21,6),
	sgd_archivo_folios decimal(21,6),
	sgd_archivo_mata decimal(21,6),
	sgd_archivo_fechaf varchar(50),
	sgd_archivo_prestamo decimal(1),
	sgd_archivo_funprest char(100),
	sgd_archivo_fechprest varchar(50),
	sgd_archivo_fechprestf varchar(50),
	depe_codi varchar(5),
	sgd_archivo_usua varchar(15),
	sgd_archivo_fech varchar(50),
	PRIMARY KEY (sgd_archivo_id)
);
CREATE TABLE sgd_archivo_hist (
	depe_codi varchar(5) NOT NULL,
	hist_fech varchar(50) NOT NULL,
	usua_codi decimal(10) NOT NULL,
	sgd_archivo_rad varchar(14),
	hist_obse varchar(600) NOT NULL,
	usua_doc varchar(14),
	sgd_ttr_codigo decimal(3),
	hist_id decimal(21,6)
);
CREATE TABLE sgd_arg_pliego (
	sgd_arg_codigo decimal(2) NOT NULL,
	sgd_arg_desc varchar(150) NOT NULL
);
CREATE TABLE sgd_argd_argdoc (
	sgd_argd_codi decimal(4) NOT NULL,
	sgd_pnufe_codi decimal(4),
	sgd_argd_tabla varchar(100),
	sgd_argd_tcodi varchar(100),
	sgd_argd_tdes varchar(100),
	sgd_argd_llist varchar(150),
	sgd_argd_campo varchar(100)
);
CREATE TABLE sgd_argup_argudoctop (
	sgd_argup_codi decimal(4) NOT NULL,
	sgd_argup_desc varchar(50),
	sgd_tpr_codigo decimal(4)
);
CREATE TABLE sgd_auditoria (
	fecha varchar(10),
	usua_doc varchar(12),
	ip varchar(15),
	tipo varchar(5),
	tabla varchar(50),
	isql char(5000)
);
CREATE TABLE sgd_camexp_campoexpediente (
	sgd_camexp_codigo decimal(4) NOT NULL,
	sgd_camexp_campo varchar(30) NOT NULL,
	sgd_parexp_codigo decimal(4) NOT NULL,
	sgd_camexp_fk decimal(21,6),
	sgd_camexp_tablafk varchar(30),
	sgd_camexp_campofk varchar(30),
	sgd_camexp_campovalor varchar(30),
	sgd_camexp_orden decimal(1)
);
CREATE TABLE sgd_carp_descripcion (
	sgd_carp_depecodi varchar(5) NOT NULL,
	sgd_carp_tiporad decimal(2) NOT NULL,
	sgd_carp_descr varchar(40),
	PRIMARY KEY (sgd_carp_depecodi,sgd_carp_tiporad)
);
CREATE TABLE sgd_cau_causal (
	sgd_cau_codigo decimal(4) NOT NULL,
	sgd_cau_descrip varchar(150)
);
CREATE TABLE sgd_caux_causales (
	sgd_caux_codigo decimal(10) NOT NULL,
	radi_nume_radi decimal(15),
	sgd_dcau_codigo decimal(4),
	sgd_ddca_codigo decimal(4),
	sgd_caux_fecha date,
	usua_doc varchar(14)
);
CREATE TABLE sgd_ciu_ciudadano (
	tdid_codi decimal(2),
	sgd_ciu_codigo decimal(8) NOT NULL,
	sgd_ciu_nombre varchar(150),
	sgd_ciu_direccion varchar(150),
	sgd_ciu_apell1 varchar(50),
	sgd_ciu_apell2 varchar(50),
	sgd_ciu_telefono varchar(50),
	sgd_ciu_email varchar(50),
	muni_codi decimal(4),
	dpto_codi decimal(2),
	sgd_ciu_cedula varchar(13),
	id_cont decimal(2),
	id_pais decimal(4)
);
CREATE TABLE sgd_clta_clstarif (
	sgd_fenv_codigo decimal(5),
	sgd_clta_codser decimal(5),
	sgd_tar_codigo decimal(5),
	sgd_clta_descrip varchar(100),
	sgd_clta_pesdes decimal(15),
	sgd_clta_peshast decimal(15)
);
CREATE TABLE sgd_cob_campobliga (
	sgd_cob_codi decimal(4) NOT NULL,
	sgd_cob_desc varchar(150),
	sgd_cob_label varchar(50),
	sgd_tidm_codi decimal(4)
);
CREATE TABLE sgd_dcau_causal (
	sgd_dcau_codigo decimal(4) NOT NULL,
	sgd_cau_codigo decimal(4),
	sgd_dcau_descrip varchar(150)
);
CREATE TABLE sgd_ddca_ddsgrgdo (
	sgd_ddca_codigo decimal(4) NOT NULL,
	sgd_dcau_codigo decimal(4),
	par_serv_secue decimal(8),
	sgd_ddca_descrip varchar(150)
);
CREATE TABLE sgd_def_contactos (
	ctt_id decimal(15) NOT NULL,
	ctt_nombre varchar(60) NOT NULL,
	ctt_cargo varchar(60) NOT NULL,
	ctt_telefono varchar(25),
	ctt_id_tipo decimal(4) NOT NULL,
	ctt_id_empresa decimal(15) NOT NULL
);
CREATE TABLE sgd_def_continentes (
	id_cont decimal(2),
	nombre_cont varchar(20) NOT NULL
);
CREATE TABLE sgd_def_paises (
	id_pais decimal(4),
	id_cont decimal(2) NOT NULL,
	nombre_pais varchar(30) NOT NULL
);
CREATE TABLE sgd_deve_dev_envio (
	sgd_deve_codigo decimal(2) NOT NULL,
	sgd_deve_desc varchar(150) NOT NULL
);
CREATE TABLE sgd_dir_drecciones (
	sgd_dir_codigo decimal(10) NOT NULL,
	sgd_dir_tipo decimal(4) NOT NULL,
	sgd_oem_codigo decimal(8),
	sgd_ciu_codigo decimal(8),
	radi_nume_radi decimal(15),
	sgd_esp_codi decimal(5),
	muni_codi decimal(4),
	dpto_codi decimal(3),
	sgd_dir_direccion varchar(150),
	sgd_dir_telefono varchar(50),
	sgd_dir_mail varchar(50),
	sgd_sec_codigo decimal(13),
	sgd_temporal_nombre varchar(150),
	anex_codigo decimal(20),
	sgd_anex_codigo varchar(20),
	sgd_dir_nombre varchar(150),
	sgd_doc_fun varchar(14),
	sgd_dir_nomremdes varchar(1000),
	sgd_trd_codigo decimal(1),
	sgd_dir_tdoc decimal(1),
	sgd_dir_doc varchar(14),
	id_pais decimal(4),
	id_cont decimal(2)
);
CREATE TABLE sgd_dnufe_docnufe (
	sgd_dnufe_codi decimal(4) NOT NULL,
	sgd_pnufe_codi decimal(4),
	sgd_tpr_codigo decimal(4),
	sgd_dnufe_label varchar(150),
	trte_codi decimal(2),
	sgd_dnufe_main varchar(1),
	sgd_dnufe_path varchar(150),
	sgd_dnufe_gerarq varchar(10),
	anex_tipo_codi decimal(4)
);
CREATE TABLE sgd_dt_radicado (
	radi_nume_radi decimal(14) NOT NULL,
	dias_termino decimal(2) NOT NULL,
	PRIMARY KEY (radi_nume_radi)
);
CREATE TABLE sgd_eanu_estanulacion (
	sgd_eanu_desc varchar(150),
	sgd_eanu_codi decimal(21,6)
);
CREATE TABLE sgd_einv_inventario (
	sgd_einv_codigo decimal(21,6) NOT NULL,
	sgd_depe_nomb varchar(400),
	sgd_depe_codi varchar(3),
	sgd_einv_expnum varchar(18),
	sgd_einv_titulo varchar(400),
	sgd_einv_unidad decimal(21,6),
	sgd_einv_fech date,
	sgd_einv_fechfin date,
	sgd_einv_radicados varchar(40),
	sgd_einv_folios decimal(21,6),
	sgd_einv_nundocu decimal(21,6),
	sgd_einv_nundocubodega decimal(21,6),
	sgd_einv_caja decimal(21,6),
	sgd_einv_cajabodega decimal(21,6),
	sgd_einv_srd decimal(21,6),
	sgd_einv_nomsrd varchar(400),
	sgd_einv_sbrd decimal(21,6),
	sgd_einv_nomsbrd varchar(400),
	sgd_einv_retencion varchar(400),
	sgd_einv_disfinal varchar(400),
	sgd_einv_ubicacion varchar(400),
	sgd_einv_observacion varchar(400),
	PRIMARY KEY (sgd_einv_codigo)
);
CREATE TABLE sgd_eit_items (
	sgd_eit_codigo decimal(21,6) NOT NULL,
	sgd_eit_cod_padre decimal(21,6),
	sgd_eit_nombre varchar(40),
	sgd_eit_sigla varchar(6),
	codi_dpto decimal(4),
	codi_muni decimal(5),
	PRIMARY KEY (sgd_eit_codigo)
);
CREATE TABLE sgd_eje_tema (
	sgd_tema_codigo varchar(10) NOT NULL,
	sgd_tema_nomb varchar(150) NOT NULL,
	sgd_tema_desc varchar(350) NOT NULL,
	sgd_tema_plazo decimal(2),
	sgd_tema_tpplazo varchar(50),
	sgd_tema_estado decimal(2) NOT NULL,
	sgd_tema_depe decimal(5) NOT NULL,
	PRIMARY KEY (sgd_tema_codigo)
);
CREATE TABLE sgd_empus_empusuario (
	usua_login varchar(10),
	identificador_empresa decimal(10)
);
CREATE TABLE sgd_ent_entidades (
	sgd_ent_nit varchar(13) NOT NULL,
	sgd_ent_codsuc varchar(4) NOT NULL,
	sgd_ent_pias decimal(5),
	dpto_codi decimal(2),
	muni_codi decimal(4),
	sgd_ent_descrip varchar(80),
	sgd_ent_direccion varchar(50),
	sgd_ent_telefono varchar(50)
);
CREATE TABLE sgd_enve_envioespecial (
	sgd_fenv_codigo decimal(4),
	sgd_enve_valorl varchar(30),
	sgd_enve_valorn varchar(30),
	sgd_enve_desc varchar(30)
);
CREATE TABLE sgd_estc_estconsolid (
	sgd_estc_codigo decimal(21,6),
	sgd_tpr_codigo decimal(21,6),
	dep_nombre varchar(30),
	depe_codi decimal(21,6),
	sgd_estc_ctotal decimal(21,6),
	sgd_estc_centramite decimal(21,6),
	sgd_estc_csinriesgo decimal(21,6),
	sgd_estc_criesgomedio decimal(21,6),
	sgd_estc_criesgoalto decimal(21,6),
	sgd_estc_ctramitados decimal(21,6),
	sgd_estc_centermino decimal(21,6),
	sgd_estc_cfueratermino decimal(21,6),
	sgd_estc_fechgen date,
	sgd_estc_fechini date,
	sgd_estc_fechfin date,
	sgd_estc_fechiniresp date,
	sgd_estc_fechfinresp date,
	sgd_estc_dsinriesgo decimal(21,6),
	sgd_estc_driesgomegio decimal(21,6),
	sgd_estc_driesgoalto decimal(21,6),
	sgd_estc_dtermino decimal(21,6),
	sgd_estc_grupgenerado decimal(21,6)
);
CREATE TABLE sgd_estinst_estadoinstancia (
	sgd_estinst_codi decimal(4),
	sgd_apli_codi decimal(4),
	sgd_instorf_codi decimal(4),
	sgd_estinst_valor decimal(4),
	sgd_estinst_habilita decimal(1),
	sgd_estinst_mensaje varchar(100)
);
CREATE TABLE sgd_exp_expediente (
	sgd_exp_numero varchar(18),
	radi_nume_radi decimal(18),
	sgd_exp_fech date,
	sgd_exp_fech_mod date,
	depe_codi decimal(4),
	usua_codi decimal(3),
	usua_doc varchar(15),
	sgd_exp_estado decimal(1),
	sgd_exp_titulo varchar(50),
	sgd_exp_asunto varchar(150),
	sgd_exp_carpeta varchar(30),
	sgd_exp_ufisica varchar(20),
	sgd_exp_isla varchar(10),
	sgd_exp_estante varchar(10),
	sgd_exp_caja varchar(10),
	sgd_exp_fech_arch date,
	sgd_srd_codigo decimal(3),
	sgd_sbrd_codigo decimal(3),
	sgd_fexp_codigo decimal(3),
	sgd_exp_subexpediente varchar(20),
	sgd_exp_archivo decimal(1),
	sgd_exp_unicon decimal(1),
	sgd_exp_fechfin date,
	sgd_exp_folios varchar(6),
	sgd_exp_rete decimal(2),
	sgd_exp_entrepa decimal(6),
	radi_usua_arch varchar(40),
	sgd_exp_edificio varchar(400),
	sgd_exp_caja_bodega varchar(40),
	sgd_exp_carro varchar(40),
	sgd_exp_carpeta_bodega varchar(40),
	sgd_exp_privado decimal(1),
	sgd_exp_cd varchar(10),
	sgd_exp_nref varchar(7),
	sgd_sexp_paraexp1 varchar(50)
);
CREATE TABLE sgd_fars_faristas (
	sgd_fars_codigo decimal(5) NOT NULL,
	sgd_pexp_codigo decimal(4),
	sgd_fexp_codigoini decimal(6),
	sgd_fexp_codigofin decimal(6),
	sgd_fars_diasminimo decimal(3),
	sgd_fars_diasmaximo decimal(3),
	sgd_fars_desc varchar(100),
	sgd_trad_codigo decimal(2),
	sgd_srd_codigo decimal(3),
	sgd_sbrd_codigo decimal(3),
	sgd_fars_tipificacion decimal(1),
	sgd_tpr_codigo decimal(21,6),
	sgd_fars_automatico decimal(21,6),
	sgd_fars_rolgeneral decimal(21,6)
);
CREATE TABLE sgd_fenv_frmenvio (
	sgd_fenv_codigo decimal(5) NOT NULL,
	sgd_fenv_descrip varchar(40),
	sgd_fenv_planilla decimal(1) NOT NULL,
	sgd_fenv_estado decimal(1) NOT NULL
);
CREATE TABLE sgd_fexp_flujoexpedientes (
	sgd_fexp_codigo decimal(6),
	sgd_pexp_codigo decimal(6),
	sgd_fexp_orden decimal(4),
	sgd_fexp_terminos decimal(4),
	sgd_fexp_imagen varchar(50),
	sgd_fexp_descrip varchar(150)
);
CREATE TABLE sgd_firrad_firmarads (
	sgd_firrad_id decimal(15) NOT NULL,
	radi_nume_radi decimal(15) NOT NULL,
	usua_doc varchar(14) NOT NULL,
	sgd_firrad_firma varchar(255),
	sgd_firrad_fecha date,
	sgd_firrad_docsolic varchar(14) NOT NULL,
	sgd_firrad_fechsolic date NOT NULL,
	sgd_firrad_pk varchar(255)
);
CREATE TABLE sgd_fld_flujodoc (
	sgd_fld_codigo decimal(3),
	sgd_fld_desc varchar(100),
	sgd_tpr_codigo decimal(3),
	sgd_fld_imagen varchar(50),
	sgd_fld_grupoweb int
);
CREATE TABLE sgd_fun_funciones (
	sgd_fun_codigo decimal(4) NOT NULL,
	sgd_fun_descrip varchar(530),
	sgd_fun_fech_ini date,
	sgd_fun_fech_fin date
);
CREATE TABLE sgd_hfld_histflujodoc (
	sgd_hfld_codigo decimal(6),
	sgd_fexp_codigo decimal(3) NOT NULL,
	sgd_exp_fechflujoant date,
	sgd_hfld_fech datetime,
	sgd_exp_numero varchar(18),
	radi_nume_radi decimal(15),
	usua_doc varchar(10),
	usua_codi decimal(10),
	depe_codi decimal(4),
	sgd_ttr_codigo decimal(2),
	sgd_fexp_observa varchar(500),
	sgd_hfld_observa varchar(500),
	sgd_fars_codigo decimal(21,6),
	sgd_hfld_automatico decimal(21,6)
);
CREATE TABLE sgd_hmtd_hismatdoc (
	sgd_hmtd_codigo decimal(6) NOT NULL,
	sgd_hmtd_fecha date NOT NULL,
	radi_nume_radi decimal(15) NOT NULL,
	usua_codi decimal(10) NOT NULL,
	sgd_hmtd_obse varchar(600) NOT NULL,
	usua_doc decimal(13),
	depe_codi decimal(5),
	sgd_mtd_codigo decimal(4)
);
CREATE TABLE sgd_instorf_instanciasorfeo (
	sgd_instorf_codi decimal(4),
	sgd_instorf_desc varchar(100)
);
CREATE TABLE sgd_lip_linkip (
	sgd_lip_id decimal(4) NOT NULL,
	sgd_lip_ipini varchar(20) NOT NULL,
	sgd_lip_ipfin varchar(20),
	sgd_lip_dirintranet varchar(150) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	sgd_lip_arch varchar(70),
	sgd_lip_diascache decimal(5),
	sgd_lip_rutaftp varchar(150),
	sgd_lip_servftp varchar(50),
	sgd_lip_usbd varchar(20),
	sgd_lip_nombd varchar(20),
	sgd_lip_pwdbd varchar(20),
	sgd_lip_usftp varchar(20),
	sgd_lip_pwdftp varchar(30)
);
CREATE TABLE sgd_mat_matriz (
	sgd_mat_codigo decimal(4) NOT NULL,
	depe_codi decimal(5),
	sgd_fun_codigo decimal(4),
	sgd_prc_codigo decimal(4),
	sgd_prd_codigo decimal(4),
	sgd_mat_fech_ini date,
	sgd_mat_fech_fin date,
	sgd_mat_peso_prd decimal(5,2)
);
CREATE TABLE sgd_mpes_mddpeso (
	sgd_mpes_codigo decimal(5) NOT NULL,
	sgd_mpes_descrip varchar(10)
);
CREATE TABLE sgd_mrd_matrird (
	sgd_mrd_codigo decimal(4) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	sgd_srd_codigo decimal(4) NOT NULL,
	sgd_sbrd_codigo decimal(4) NOT NULL,
	sgd_tpr_codigo decimal(4) NOT NULL,
	soporte varchar(10),
	sgd_mrd_fechini date,
	sgd_mrd_fechfin date,
	sgd_mrd_esta varchar(10)
);
CREATE TABLE sgd_msdep_msgdep (
	sgd_msdep_codi decimal(15) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	sgd_msg_codi decimal(15) NOT NULL
);
CREATE TABLE sgd_msg_mensaje (
	sgd_msg_codi decimal(15) NOT NULL,
	sgd_tme_codi decimal(3) NOT NULL,
	sgd_msg_desc varchar(150),
	sgd_msg_fechdesp date NOT NULL,
	sgd_msg_url varchar(150) NOT NULL,
	sgd_msg_veces decimal(3) NOT NULL,
	sgd_msg_ancho decimal(6) NOT NULL,
	sgd_msg_largo decimal(6) NOT NULL
);
CREATE TABLE sgd_mtd_matriz_doc (
	sgd_mtd_codigo decimal(4) NOT NULL,
	sgd_mat_codigo decimal(4),
	sgd_tpr_codigo decimal(4)
);
CREATE TABLE sgd_noh_nohabiles (
	noh_fecha date NOT NULL
);
CREATE TABLE sgd_not_notificacion (
	sgd_not_codi decimal(3) NOT NULL,
	sgd_not_descrip varchar(100) NOT NULL
);
CREATE TABLE sgd_ntrd_notifrad (
	radi_nume_radi decimal(15) NOT NULL,
	sgd_not_codi decimal(3) NOT NULL,
	sgd_ntrd_notificador varchar(150),
	sgd_ntrd_notificado varchar(150),
	sgd_ntrd_fecha_not date,
	sgd_ntrd_num_edicto decimal(6),
	sgd_ntrd_fecha_fija date,
	sgd_ntrd_fecha_desfija date,
	sgd_ntrd_observaciones varchar(150)
);
CREATE TABLE sgd_oem_oempresas (
	sgd_oem_codigo decimal(8) NOT NULL,
	tdid_codi decimal(2),
	sgd_oem_oempresa varchar(300),
	sgd_oem_rep_legal varchar(300),
	sgd_oem_nit varchar(14),
	sgd_oem_sigla varchar(1000),
	muni_codi decimal(4),
	dpto_codi decimal(2),
	sgd_oem_direccion varchar(1000),
	sgd_oem_telefono varchar(1000),
	id_cont decimal(2),
	id_pais decimal(4),
	email varchar(1000)
);
CREATE TABLE sgd_panu_peranulados (
	sgd_panu_codi decimal(4),
	sgd_panu_desc varchar(200)
);
CREATE TABLE sgd_parametro (
	param_nomb varchar(25) NOT NULL,
	param_codi decimal(5) NOT NULL,
	param_valor varchar(25) NOT NULL
);
CREATE TABLE sgd_parexp_paramexpediente (
	sgd_parexp_codigo decimal(4) NOT NULL,
	depe_codi decimal(4) NOT NULL,
	sgd_parexp_tabla varchar(30) NOT NULL,
	sgd_parexp_etiqueta varchar(15) NOT NULL,
	sgd_parexp_orden decimal(1),
	sgd_parexp_editable decimal(1)
);
CREATE TABLE sgd_pen_pensionados (
	tdid_codi decimal(2),
	sgd_ciu_codigo decimal(8) NOT NULL,
	sgd_ciu_nombre varchar(150),
	sgd_ciu_direccion varchar(150),
	sgd_ciu_apell1 varchar(50),
	sgd_ciu_apell2 varchar(50),
	sgd_ciu_telefono varchar(50),
	sgd_ciu_email varchar(50),
	muni_codi decimal(4),
	dpto_codi decimal(2),
	sgd_ciu_cedula varchar(20),
	id_cont decimal(2),
	id_pais decimal(4)
);
CREATE TABLE sgd_pexp_procexpedientes (
	sgd_pexp_codigo decimal(21,6) NOT NULL,
	sgd_pexp_descrip varchar(100),
	sgd_pexp_terminos decimal(21,6),
	sgd_srd_codigo decimal(3),
	sgd_sbrd_codigo decimal(3),
	sgd_pexp_automatico decimal(1),
	sgd_pexp_tieneflujo decimal(1)
);
CREATE TABLE sgd_pnufe_procnumfe (
	sgd_pnufe_codi decimal(4) NOT NULL,
	sgd_tpr_codigo decimal(4),
	sgd_pnufe_descrip varchar(150),
	sgd_pnufe_serie varchar(50)
);
CREATE TABLE sgd_pnun_procenum (
	sgd_pnun_codi decimal(4) NOT NULL,
	sgd_pnufe_codi decimal(4),
	depe_codi decimal(5),
	sgd_pnun_prepone varchar(50)
);
CREATE TABLE sgd_prc_proceso (
	sgd_prc_codigo decimal(4) NOT NULL,
	sgd_prc_descrip varchar(150),
	sgd_prc_fech_ini date,
	sgd_prc_fech_fin date
);
CREATE TABLE sgd_prd_prcdmentos (
	sgd_prd_codigo decimal(4) NOT NULL,
	sgd_prd_descrip varchar(200),
	sgd_prd_fech_ini date,
	sgd_prd_fech_fin date
);
CREATE TABLE sgd_rda_retdoca (
	anex_radi_nume decimal(15) NOT NULL,
	anex_codigo varchar(20) NOT NULL,
	radi_nume_salida decimal(15),
	anex_borrado varchar(1),
	sgd_mrd_codigo decimal(4) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	usua_codi decimal(10) NOT NULL,
	usua_doc varchar(14) NOT NULL,
	sgd_rda_fech date,
	sgd_deve_codigo decimal(2),
	anex_solo_lect varchar(1),
	anex_radi_fech date,
	anex_estado decimal(1),
	anex_nomb_archivo varchar(50),
	anex_tipo decimal(4),
	sgd_dir_tipo decimal(4)
);
CREATE TABLE sgd_rdf_retdocf (
	sgd_mrd_codigo decimal(4) NOT NULL,
	radi_nume_radi decimal(15) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	usua_codi decimal(10) NOT NULL,
	usua_doc varchar(14) NOT NULL,
	sgd_rdf_fech date NOT NULL
);
CREATE TABLE sgd_renv_regenvio (
	sgd_renv_codigo decimal(21,6) NOT NULL,
	sgd_fenv_codigo decimal(21,6),
	sgd_renv_fech datetime,
	radi_nume_sal decimal(21,6),
	sgd_renv_destino varchar,
	sgd_renv_telefono varchar,
	sgd_renv_mail varchar,
	sgd_renv_peso varchar,
	sgd_renv_valor decimal(21,6),
	sgd_renv_certificado decimal(21,6),
	sgd_renv_estado decimal(21,6),
	usua_doc decimal(21,6),
	sgd_renv_nombre varchar,
	sgd_rem_destino decimal(21,6),
	sgd_dir_codigo decimal(21,6),
	sgd_renv_planilla varchar(8),
	sgd_renv_fech_sal datetime,
	depe_codi decimal(5),
	sgd_dir_tipo decimal(4),
	radi_nume_grupo decimal(14),
	sgd_renv_dir varchar(100),
	sgd_renv_depto varchar(30),
	sgd_renv_mpio varchar(30),
	sgd_renv_tel varchar(20),
	sgd_renv_cantidad decimal(4),
	sgd_renv_tipo decimal(1),
	sgd_renv_observa varchar(200),
	sgd_renv_grupo decimal(14),
	sgd_deve_codigo decimal(2),
	sgd_deve_fech datetime,
	sgd_renv_valortotal varchar(14),
	sgd_renv_valistamiento varchar(10),
	sgd_renv_vdescuento varchar(10),
	sgd_renv_vadicional varchar(14),
	sgd_depe_genera decimal(5),
	sgd_renv_pais varchar(30),
	sgd_renv_guia varchar(10)
);
CREATE TABLE sgd_renv_regenvio1 (
	sgd_renv_codigo decimal(6) NOT NULL,
	sgd_fenv_codigo decimal(5),
	sgd_renv_fech date,
	radi_nume_sal decimal(14),
	sgd_renv_destino varchar(150),
	sgd_renv_telefono varchar(50),
	sgd_renv_mail varchar(150),
	sgd_renv_peso varchar(10),
	sgd_renv_valor varchar(10),
	sgd_renv_certificado decimal(1),
	sgd_renv_estado decimal(1),
	usua_doc decimal(15),
	sgd_renv_nombre varchar(100),
	sgd_rem_destino decimal(1),
	sgd_dir_codigo decimal(10),
	sgd_renv_planilla varchar(8),
	sgd_renv_fech_sal date,
	depe_codi decimal(5),
	sgd_dir_tipo decimal(4),
	radi_nume_grupo decimal(14),
	sgd_renv_dir varchar(100),
	sgd_renv_depto varchar(30),
	sgd_renv_mpio varchar(30),
	sgd_renv_tel varchar(20),
	sgd_renv_cantidad decimal(4),
	sgd_renv_tipo decimal(1),
	sgd_renv_observa varchar(200),
	sgd_renv_grupo decimal(14),
	sgd_deve_codigo decimal(2),
	sgd_deve_fech date,
	sgd_renv_valortotal varchar(14),
	sgd_renv_valistamiento varchar(10),
	sgd_renv_vdescuento varchar(10),
	sgd_renv_vadicional varchar(14),
	sgd_depe_genera decimal(5),
	sgd_renv_pais varchar(30)
);
CREATE TABLE sgd_rfax_reservafax (
	sgd_rfax_codigo decimal(10),
	sgd_rfax_fax varchar(30),
	usua_login varchar(30),
	sgd_rfax_fech date,
	sgd_rfax_fechradi date,
	radi_nume_radi decimal(15),
	sgd_rfax_observa varchar(500)
);
CREATE TABLE sgd_rmr_radmasivre (
	sgd_rmr_grupo decimal(15) NOT NULL,
	sgd_rmr_radi decimal(15) NOT NULL
);
CREATE TABLE sgd_san_sancionados (
	sgd_san_ref varchar(20) NOT NULL,
	sgd_san_decision varchar(60),
	sgd_san_cargo varchar(50),
	sgd_san_expediente varchar(20),
	sgd_san_tipo_sancion varchar(50),
	sgd_san_plazo varchar(100),
	sgd_san_valor decimal(14,2),
	sgd_san_radicacion varchar(15),
	sgd_san_fecha_radicado date,
	sgd_san_valorletras varchar(1000),
	sgd_san_nombreempresa varchar(160),
	sgd_san_motivos varchar(160),
	sgd_san_sectores varchar(160),
	sgd_san_padre varchar(15),
	sgd_san_fecha_padre date,
	sgd_san_notificado varchar(100)
);
CREATE TABLE sgd_san_sancionados_x (
	radi_nume_radi decimal(15) NOT NULL,
	sgd_san_decision varchar(60),
	sgd_san_cargo varchar(50),
	sgd_san_expediente varchar(15),
	sgd_san_tipo_sancion varchar(50),
	sgd_san_plazo varchar(100),
	sgd_san_valor decimal(14,2),
	sgd_san_radicacion varchar(15),
	sgd_san_fecha_radicado date,
	sgd_san_valorletras varchar(1000),
	sgd_san_nombreempresa varchar(160),
	sgd_san_motivos varchar(160),
	sgd_san_sectores varchar(160),
	sgd_san_padre varchar(15)
);
CREATE TABLE sgd_sbrd_subserierd (
	sgd_srd_codigo decimal(4) NOT NULL,
	sgd_sbrd_codigo decimal(4) NOT NULL,
	sgd_sbrd_descrip varchar(500) NOT NULL,
	sgd_sbrd_fechini date NOT NULL,
	sgd_sbrd_fechfin date NOT NULL,
	sgd_sbrd_tiemag decimal(4),
	sgd_sbrd_tiemac decimal(4),
	sgd_sbrd_dispfin varchar(50),
	sgd_sbrd_soporte varchar(50),
	sgd_sbrd_procedi varchar(1500)
);
CREATE TABLE sgd_sed_sede (
	sgd_sed_codi decimal(4) NOT NULL,
	sgd_sed_desc varchar(50)
);
CREATE TABLE sgd_senuf_secnumfe (
	sgd_senuf_codi decimal(4) NOT NULL,
	sgd_pnufe_codi decimal(4),
	depe_codi decimal(5),
	sgd_senuf_sec varchar(50)
);
CREATE TABLE sgd_sexp_secexpedientes (
	sgd_exp_numero varchar(18) NOT NULL,
	sgd_srd_codigo decimal(21,6),
	sgd_sbrd_codigo decimal(21,6),
	sgd_sexp_secuencia decimal(21,6),
	depe_codi decimal(21,6),
	usua_doc varchar(15),
	sgd_sexp_fech date,
	sgd_fexp_codigo decimal(21,6),
	sgd_sexp_ano decimal(21,6),
	usua_doc_responsable varchar(18),
	sgd_sexp_parexp1 varchar(250),
	sgd_sexp_parexp2 varchar(160),
	sgd_sexp_parexp3 varchar(160),
	sgd_sexp_parexp4 varchar(160),
	sgd_sexp_parexp5 varchar(160),
	sgd_pexp_codigo decimal(3),
	sgd_exp_fech_arch date,
	sgd_fld_codigo decimal(3),
	sgd_exp_fechflujoant date,
	sgd_mrd_codigo decimal(4),
	sgd_exp_subexpediente decimal(18),
	sgd_exp_privado decimal(1),
	sgd_sexp_estado decimal(1) NOT NULL
);
CREATE TABLE sgd_srd_seriesrd (
	sgd_srd_codigo decimal(4) NOT NULL,
	sgd_srd_descrip varchar(60) NOT NULL,
	sgd_srd_fechini date NOT NULL,
	sgd_srd_fechfin date NOT NULL
);
CREATE TABLE sgd_tar_tarifas (
	sgd_fenv_codigo decimal(5),
	sgd_tar_codser decimal(5),
	sgd_tar_codigo decimal(5),
	sgd_tar_valenv1 decimal(15),
	sgd_tar_valenv2 decimal(15),
	sgd_tar_valenv1g1 decimal(15),
	sgd_clta_codser decimal(5),
	sgd_tar_valenv2g2 decimal(15),
	sgd_clta_descrip varchar(100)
);
CREATE TABLE sgd_tdec_tipodecision (
	sgd_apli_codi decimal(4) NOT NULL,
	sgd_tdec_codigo decimal(4) NOT NULL,
	sgd_tdec_descrip varchar(150),
	sgd_tdec_sancionar decimal(1),
	sgd_tdec_firmeza decimal(1),
	sgd_tdec_versancion decimal(1),
	sgd_tdec_showmenu decimal(1),
	sgd_tdec_updnotif decimal(1),
	sgd_tdec_veragota decimal(1)
);
CREATE TABLE sgd_tid_tipdecision (
	sgd_tid_codi decimal(4) NOT NULL,
	sgd_tid_desc varchar(150),
	sgd_tpr_codigo decimal(4),
	sgd_pexp_codigo decimal(2),
	sgd_tpr_codigop decimal(2)
);
CREATE TABLE sgd_tidm_tidocmasiva (
	sgd_tidm_codi decimal(4) NOT NULL,
	sgd_tidm_desc varchar(150)
);
CREATE TABLE sgd_tip3_tipotercero (
	sgd_tip3_codigo decimal(2) NOT NULL,
	sgd_dir_tipo decimal(4),
	sgd_tip3_nombre varchar(15),
	sgd_tip3_desc varchar(30),
	sgd_tip3_imgpestana varchar(20),
	sgd_tpr_tp1 decimal(1),
	sgd_tpr_tp2 decimal(1),
	sgd_tpr_tp4 int,
	sgd_tpr_tp3 int,
	sgd_tpr_tp5 int
);
CREATE TABLE sgd_tma_temas (
	sgd_tma_codigo decimal(4) NOT NULL,
	depe_codi decimal(5),
	sgd_prc_codigo decimal(4),
	sgd_tma_descrip varchar(150)
);
CREATE TABLE sgd_tme_tipmen (
	sgd_tme_codi decimal(3) NOT NULL,
	sgd_tme_desc varchar(150)
);
CREATE TABLE sgd_tpr_tpdcumento (
	sgd_tpr_codigo decimal(4) NOT NULL,
	sgd_tpr_descrip varchar(500),
	sgd_tpr_termino decimal(4),
	sgd_tpr_tpuso decimal(1),
	sgd_tpr_numera char(1),
	sgd_tpr_radica char(1),
	sgd_tpr_tp1 decimal(1),
	sgd_tpr_tp2 decimal(1),
	sgd_tpr_estado decimal(1),
	sgd_termino_real decimal(4),
	sgd_tpr_web int,
	sgd_tpr_tiptermino varchar(5),
	sgd_tpr_tp4 int,
	sgd_tpr_tp3 int,
	sgd_tpr_tp5 int
);
CREATE TABLE sgd_trad_tiporad (
	sgd_trad_codigo decimal(2) NOT NULL,
	sgd_trad_descr varchar(30),
	sgd_trad_icono varchar(30),
	sgd_trad_diasbloqueo decimal(2),
	sgd_trad_genradsal int,
	PRIMARY KEY (sgd_trad_codigo)
);
CREATE TABLE sgd_ttr_transaccion (
	sgd_ttr_codigo decimal(3) NOT NULL,
	sgd_ttr_descrip varchar(100) NOT NULL,
	PRIMARY KEY (sgd_ttr_codigo)
);
CREATE TABLE sgd_tvd_dependencia (
	sgd_depe_codi decimal(5) NOT NULL,
	sgd_depe_nombre varchar(200) NOT NULL,
	sgd_depe_fechini date NOT NULL,
	sgd_depe_fechfin date NOT NULL
);
CREATE TABLE sgd_tvd_series (
	sgd_depe_codi decimal(4) NOT NULL,
	sgd_stvd_codi decimal(4) NOT NULL,
	sgd_stvd_nombre varchar(200) NOT NULL,
	sgd_stvd_ac decimal(4),
	sgd_stvd_dispfin decimal(2),
	sgd_stvd_proc varchar(500),
	PRIMARY KEY (sgd_depe_codi,sgd_stvd_codi)
);
CREATE TABLE sgd_ush_usuhistorico (
	sgd_ush_admcod decimal(10) NOT NULL,
	sgd_ush_admdep decimal(5) NOT NULL,
	sgd_ush_admdoc varchar(14) NOT NULL,
	sgd_ush_usucod decimal(10) NOT NULL,
	sgd_ush_usudep decimal(5) NOT NULL,
	sgd_ush_usudoc varchar(14) NOT NULL,
	sgd_ush_modcod decimal(5) NOT NULL,
	sgd_ush_fechevento date NOT NULL,
	sgd_ush_usulogin varchar(20) NOT NULL
);
CREATE TABLE sgd_usm_usumodifica (
	sgd_usm_modcod decimal(5) NOT NULL,
	sgd_usm_moddescr varchar(60) NOT NULL
);
CREATE TABLE tipo_doc_identificacion (
	tdid_codi decimal(2) NOT NULL,
	tdid_desc varchar(100) NOT NULL
);
CREATE TABLE tipo_remitente (
	trte_codi decimal(2) NOT NULL,
	trte_desc varchar(100) NOT NULL
);
CREATE TABLE ubicacion_fisica (
	ubic_depe_radi decimal(5),
	ubic_depe_arch decimal(5)
);
CREATE TABLE usuario (
	usua_codi decimal(10) NOT NULL,
	depe_codi decimal(5) NOT NULL,
	usua_login varchar(50) NOT NULL,
	usua_fech_crea date,
	usua_pasw varchar(35) NOT NULL,
	usua_esta varchar(10) NOT NULL,
	usua_nomb varchar(45),
	perm_radi char(1),
	usua_admin char(1),
	usua_nuevo char(1),
	usua_doc varchar(14),
	codi_nivel decimal(2),
	usua_sesion varchar(30),
	usua_fech_sesion date,
	usua_ext decimal(4),
	usua_nacim date,
	usua_email varchar(50),
	usua_at varchar(50),
	usua_piso decimal(2),
	perm_radi_sal decimal(21,6),
	usua_admin_archivo decimal(1),
	usua_masiva decimal(1),
	usua_perm_dev decimal(1),
	usua_perm_numera_res varchar(1),
	usua_doc_suip varchar(15),
	usua_perm_numeradoc decimal(1),
	sgd_panu_codi decimal(4),
	usua_prad_tp1 decimal(1),
	usua_prad_tp2 decimal(1),
	usua_perm_envios decimal(1),
	usua_perm_modifica decimal(1),
	usua_perm_impresion decimal(1),
	sgd_aper_codigo decimal(2),
	usu_telefono1 varchar(14),
	usua_encuesta varchar(1),
	sgd_perm_estadistica decimal(2),
	usua_perm_sancionados decimal(1),
	usua_admin_sistema decimal(1),
	usua_perm_trd decimal(1),
	usua_perm_firma decimal(1),
	usua_perm_prestamo decimal(1),
	usuario_publico decimal(1),
	usuario_reasignar decimal(1),
	usua_perm_notifica decimal(1),
	usua_perm_expediente decimal(21,6),
	usua_login_externo varchar(15),
	id_pais decimal(4),
	id_cont decimal(2),
	usua_auth_ldap decimal(1),
	perm_archi char(1),
	perm_vobo char(1),
	perm_borrar_anexo decimal(1),
	perm_tipif_anexo decimal(1),
	usua_perm_adminflujos decimal(1) NOT NULL,
	usua_exp_trd decimal(2),
	usua_perm_rademail int,
	usua_prad_tp4 int,
	usua_perm_accesi decimal(1),
	usua_prad_tp3 int,
	usua_prad_tp5 int,
	usua_perm_agrcontacto decimal(1),
	PRIMARY KEY (usua_login)
);
ALTER TABLE municipio
	ADD FOREIGN KEY (dpto_codi) 
	REFERENCES departamento (dpto_codi);


ALTER TABLE sgd_carp_descripcion
	ADD FOREIGN KEY (sgd_carp_tiporad) 
	REFERENCES sgd_trad_tiporad (sgd_trad_codigo);

