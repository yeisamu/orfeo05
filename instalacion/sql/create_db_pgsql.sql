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
    sgd_sbrd_codigo character varying(4),
    anex_num_hoja numeric,
    texto_archivo_anex text,
    anex_idarch_version numeric(3,0),
    anex_num_version numeric(2,0)
);
CREATE TABLE anexos_historico (
    anex_hist_anex_codi character varying(20) NOT NULL,
    anex_hist_num_ver numeric(4,0) NOT NULL,
    anex_hist_tipo_mod character varying(2) NOT NULL,
    anex_hist_usua character varying(15) NOT NULL,
    anex_hist_fecha date NOT NULL,
    usua_doc character varying(14)
);
CREATE TABLE anexos_tipo (
    anex_tipo_codi numeric(4,0) NOT NULL,
    anex_tipo_ext character varying(10) NOT NULL,
    anex_tipo_desc character varying(50)
);
CREATE TABLE aux_01 (
    r numeric
);
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
    identificador_empresa numeric(5,0) NOT NULL,
    are_esp_secue numeric(8,0) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170,
    activa numeric(1,0) DEFAULT 1,
    flag_rups character varying(10),
    codigo_suscriptor character varying(50)
);
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
CREATE TABLE borrar_carpeta_personalizada (
    carp_per_codi numeric(2,0) NOT NULL,
    carp_per_usu character varying(15) NOT NULL,
    carp_per_desc character varying(80) NOT NULL
);
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
CREATE TABLE carpeta (
    carp_codi numeric(2,0) NOT NULL,
    carp_desc character varying(80) NOT NULL
);
CREATE TABLE carpeta_per (
    usua_codi numeric(3,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    nomb_carp character varying(15),
    desc_carp character varying(50),
    codi_carp numeric(3,0) DEFAULT 99
);
CREATE TABLE centro_poblado (
    cpob_codi numeric(4,0) NOT NULL,
    muni_codi numeric(4,0) NOT NULL,
    dpto_codi numeric(2,0) NOT NULL,
    cpob_nomb character varying(100) NOT NULL,
    cpob_nomb_anterior character varying(100)
);
CREATE TABLE departamento (
    dpto_codi numeric(3,0) NOT NULL,
    dpto_nomb character varying(70) NOT NULL,
    id_cont numeric(2,0) DEFAULT 1,
    id_pais numeric(4,0) DEFAULT 170
);
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
    depe_rad_tp4 smallint,
    depe_segu smallint,
    depe_rad_tp3 smallint,
    depe_rad_tp5 smallint
);
CREATE TABLE dependencia_visibilidad (
    codigo_visibilidad numeric(18,0) NOT NULL,
    dependencia_visible numeric(5,0) NOT NULL,
    dependencia_observa numeric(5,0) NOT NULL
);
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
CREATE TABLE emp_cod_actualizar (
    emp_cod_ant character varying(10),
    emp_cod_nue character varying(10)
);
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
CREATE TABLE entidades_asociativa (
    nit character varying(12),
    codentidad numeric(10,0)
);
CREATE TABLE estado (
    esta_codi numeric(2,0) NOT NULL,
    esta_desc character varying(100) NOT NULL
);
CREATE TABLE example (
    campo1 numeric(15,0) NOT NULL,
    campo2 character varying(10)
);
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
CREATE TABLE medio_recepcion (
    mrec_codi numeric(2,0) NOT NULL,
    mrec_desc character varying(100) NOT NULL
);
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
CREATE TABLE par_serv_servicios (
    par_serv_secue numeric(8,0) NOT NULL,
    par_serv_codigo character varying(5),
    par_serv_nombre character varying(100),
    par_serv_estado character varying(1)
);
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
CREATE TABLE pl_tipo_plt (
    plt_codi numeric(4,0) NOT NULL,
    plt_desc character varying(35)
);
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
CREATE TABLE pruba (
    nombre character varying(20),
    tel character varying(20)
);
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
    numero_tran character varying(15),
    texto_archivo text
);
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
CREATE TABLE series (
    depe_codi numeric(5,0) NOT NULL,
    seri_nume numeric(7,0) NOT NULL,
    seri_tipo numeric(2,0),
    seri_ano numeric(4,0),
    dpto_codi numeric(2,0) NOT NULL,
    bloq character varying(20)
);
CREATE TABLE sgd_acm_acusemsg (
    sgd_msg_codi numeric(15,0) NOT NULL,
    usua_doc character varying(14),
    sgd_msg_leido numeric(3,0)
);
CREATE TABLE sgd_actadd_actualiadicional (
    sgd_actadd_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_instorf_codi numeric(4,0),
    sgd_actadd_query character varying(500),
    sgd_actadd_desc character varying(150)
);
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
CREATE TABLE sgd_anar_anexarg (
    sgd_anar_codi numeric(4,0) NOT NULL,
    anex_codigo character varying(20),
    sgd_argd_codi numeric(4,0),
    sgd_anar_argcod numeric(4,0)
);
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
CREATE TABLE sgd_aper_adminperfiles (
    sgd_aper_codigo numeric(2,0),
    sgd_aper_descripcion character varying(20)
);
CREATE TABLE sgd_aplfad_plicfunadi (
    sgd_aplfad_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_aplfad_menu character varying(150) NOT NULL,
    sgd_aplfad_lk1 character varying(150) NOT NULL,
    sgd_aplfad_desc character varying(150) NOT NULL
);
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
CREATE TABLE sgd_aplmen_aplimens (
    sgd_aplmen_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_aplmen_ref character varying(20),
    sgd_aplmen_haciaorfeo numeric(4,0),
    sgd_aplmen_desdeorfeo numeric(4,0)
);
CREATE TABLE sgd_aplus_plicusua (
    sgd_aplus_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    usua_doc character varying(14),
    sgd_trad_codigo numeric(2,0),
    sgd_aplus_prioridad numeric(1,0)
);
CREATE TABLE sgd_arch_depe (
    sgd_arch_depe character varying(4),
    sgd_arch_edificio numeric(6,0),
    sgd_arch_item numeric(6,0),
    sgd_arch_id numeric NOT NULL
);
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
CREATE TABLE sgd_archivo_fondo (
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
CREATE TABLE sgd_arg_pliego (
    sgd_arg_codigo numeric(2,0) NOT NULL,
    sgd_arg_desc character varying(150) NOT NULL
);
CREATE TABLE sgd_argd_argdoc (
    sgd_argd_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    sgd_argd_tabla character varying(100),
    sgd_argd_tcodi character varying(100),
    sgd_argd_tdes character varying(100),
    sgd_argd_llist character varying(150),
    sgd_argd_campo character varying(100)
);
CREATE TABLE sgd_argup_argudoctop (
    sgd_argup_codi numeric(4,0) NOT NULL,
    sgd_argup_desc character varying(50),
    sgd_tpr_codigo numeric(4,0)
);
CREATE TABLE sgd_auditoria (
    fecha character varying(10),
    usua_doc character varying(12),
    ip character varying(15),
    tipo character varying(5),
    tabla character varying(50),
    isql character(5000)
);
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
CREATE TABLE sgd_carp_descripcion (
    sgd_carp_depecodi character varying(5) NOT NULL,
    sgd_carp_tiporad numeric(2,0) NOT NULL,
    sgd_carp_descr character varying(40)
);
CREATE TABLE sgd_cau_causal (
    sgd_cau_codigo numeric(4,0) NOT NULL,
    sgd_cau_descrip character varying(150)
);
CREATE TABLE sgd_caux_causales (
    sgd_caux_codigo numeric(10,0) NOT NULL,
    radi_nume_radi numeric(15,0),
    sgd_dcau_codigo numeric(4,0),
    sgd_ddca_codigo numeric(4,0),
    sgd_caux_fecha date,
    usua_doc character varying(14)
);
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
CREATE TABLE sgd_clta_clstarif (
    sgd_fenv_codigo numeric(5,0),
    sgd_clta_codser numeric(5,0),
    sgd_tar_codigo numeric(5,0),
    sgd_clta_descrip character varying(100),
    sgd_clta_pesdes numeric(15,0),
    sgd_clta_peshast numeric(15,0)
);
CREATE TABLE sgd_cob_campobliga (
    sgd_cob_codi numeric(4,0) NOT NULL,
    sgd_cob_desc character varying(150),
    sgd_cob_label character varying(50),
    sgd_tidm_codi numeric(4,0)
);
CREATE TABLE sgd_dcau_causal (
    sgd_dcau_codigo numeric(4,0) NOT NULL,
    sgd_cau_codigo numeric(4,0),
    sgd_dcau_descrip character varying(150)
);
CREATE TABLE sgd_ddca_ddsgrgdo (
    sgd_ddca_codigo numeric(4,0) NOT NULL,
    sgd_dcau_codigo numeric(4,0),
    par_serv_secue numeric(8,0),
    sgd_ddca_descrip character varying(150)
);
CREATE TABLE sgd_def_contactos (
    ctt_id numeric(15,0) NOT NULL,
    ctt_nombre character varying(60) NOT NULL,
    ctt_cargo character varying(60) NOT NULL,
    ctt_telefono character varying(25),
    ctt_id_tipo numeric(4,0) NOT NULL,
    ctt_id_empresa numeric(15,0) NOT NULL
);
CREATE TABLE sgd_def_continentes (
    id_cont numeric(2,0),
    nombre_cont character varying(20) NOT NULL
);
CREATE TABLE sgd_def_paises (
    id_pais numeric(4,0),
    id_cont numeric(2,0) DEFAULT 1 NOT NULL,
    nombre_pais character varying(30) NOT NULL
);
CREATE TABLE sgd_deve_dev_envio (
    sgd_deve_codigo numeric(2,0) NOT NULL,
    sgd_deve_desc character varying(150) NOT NULL
);
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
CREATE TABLE sgd_dt_radicado (
    radi_nume_radi numeric(14,0) NOT NULL,
    dias_termino numeric(2,0) NOT NULL
);
CREATE TABLE sgd_eanu_estanulacion (
    sgd_eanu_desc character varying(150),
    sgd_eanu_codi numeric
);
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
CREATE TABLE sgd_eit_items (
    sgd_eit_codigo numeric NOT NULL,
    sgd_eit_cod_padre numeric DEFAULT 0,
    sgd_eit_nombre character varying(40),
    sgd_eit_sigla character varying(6),
    codi_dpto numeric(4,0),
    codi_muni numeric(5,0)
);
CREATE TABLE sgd_eje_tema (
    sgd_tema_codigo character varying(10) NOT NULL,
    sgd_tema_nomb character varying(150) NOT NULL,
    sgd_tema_desc character varying(350) NOT NULL,
    sgd_tema_plazo numeric(2,0),
    sgd_tema_tpplazo character varying(50),
    sgd_tema_estado numeric(2,0) NOT NULL,
    sgd_tema_depe numeric(5,0) NOT NULL
);
CREATE TABLE sgd_empus_empusuario (
    usua_login character varying(10),
    identificador_empresa numeric(10,0)
);
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
CREATE TABLE sgd_enve_envioespecial (
    sgd_fenv_codigo numeric(4,0),
    sgd_enve_valorl character varying(30),
    sgd_enve_valorn character varying(30),
    sgd_enve_desc character varying(30)
);
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
CREATE TABLE sgd_estinst_estadoinstancia (
    sgd_estinst_codi numeric(4,0),
    sgd_apli_codi numeric(4,0),
    sgd_instorf_codi numeric(4,0),
    sgd_estinst_valor numeric(4,0),
    sgd_estinst_habilita numeric(1,0),
    sgd_estinst_mensaje character varying(100)
);
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
CREATE TABLE sgd_fenv_frmenvio (
    sgd_fenv_codigo numeric(5,0) NOT NULL,
    sgd_fenv_descrip character varying(40),
    sgd_fenv_planilla numeric(1,0) DEFAULT 0 NOT NULL,
    sgd_fenv_estado numeric(1,0) DEFAULT 1 NOT NULL
);
CREATE TABLE sgd_fexp_flujoexpedientes (
    sgd_fexp_codigo numeric(6,0),
    sgd_pexp_codigo numeric(6,0),
    sgd_fexp_orden numeric(4,0),
    sgd_fexp_terminos numeric(4,0),
    sgd_fexp_imagen character varying(50),
    sgd_fexp_descrip character varying(150)
);
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
CREATE TABLE sgd_fld_flujodoc (
    sgd_fld_codigo numeric(3,0),
    sgd_fld_desc character varying(100),
    sgd_tpr_codigo numeric(3,0),
    sgd_fld_imagen character varying(50),
    sgd_fld_grupoweb integer DEFAULT 0
);
CREATE TABLE sgd_fun_funciones (
    sgd_fun_codigo numeric(4,0) NOT NULL,
    sgd_fun_descrip character varying(530),
    sgd_fun_fech_ini date,
    sgd_fun_fech_fin date
);
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
CREATE TABLE sgd_instorf_instanciasorfeo (
    sgd_instorf_codi numeric(4,0),
    sgd_instorf_desc character varying(100)
);
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
CREATE TABLE sgd_mpes_mddpeso (
    sgd_mpes_codigo numeric(5,0) NOT NULL,
    sgd_mpes_descrip character varying(10)
);
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
CREATE TABLE sgd_msdep_msgdep (
    sgd_msdep_codi numeric(15,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    sgd_msg_codi numeric(15,0) NOT NULL
);
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
CREATE TABLE sgd_mtd_matriz_doc (
    sgd_mtd_codigo numeric(4,0) NOT NULL,
    sgd_mat_codigo numeric(4,0),
    sgd_tpr_codigo numeric(4,0)
);
CREATE TABLE sgd_noh_nohabiles (
    noh_fecha date NOT NULL
);
CREATE TABLE sgd_not_notificacion (
    sgd_not_codi numeric(3,0) NOT NULL,
    sgd_not_descrip character varying(100) NOT NULL
);
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
CREATE TABLE sgd_panu_peranulados (
    sgd_panu_codi numeric(4,0),
    sgd_panu_desc character varying(200)
);
CREATE TABLE sgd_parametro (
    param_nomb character varying(25) NOT NULL,
    param_codi numeric(5,0) NOT NULL,
    param_valor character varying(25) NOT NULL
);
CREATE TABLE sgd_parexp_paramexpediente (
    sgd_parexp_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(4,0) NOT NULL,
    sgd_parexp_tabla character varying(30) NOT NULL,
    sgd_parexp_etiqueta character varying(15) NOT NULL,
    sgd_parexp_orden numeric(1,0),
    sgd_parexp_editable numeric(1,0)
);
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
CREATE TABLE sgd_pexp_procexpedientes (
    sgd_pexp_codigo numeric NOT NULL,
    sgd_pexp_descrip character varying(100),
    sgd_pexp_terminos numeric DEFAULT 0,
    sgd_srd_codigo numeric(3,0),
    sgd_sbrd_codigo numeric(3,0),
    sgd_pexp_automatico numeric(1,0) DEFAULT 1,
    sgd_pexp_tieneflujo numeric(1,0) DEFAULT 0
);
CREATE TABLE sgd_pnufe_procnumfe (
    sgd_pnufe_codi numeric(4,0) NOT NULL,
    sgd_tpr_codigo numeric(4,0),
    sgd_pnufe_descrip character varying(150),
    sgd_pnufe_serie character varying(50)
);
CREATE TABLE sgd_pnun_procenum (
    sgd_pnun_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    depe_codi numeric(5,0),
    sgd_pnun_prepone character varying(50)
);
CREATE TABLE sgd_prc_proceso (
    sgd_prc_codigo numeric(4,0) NOT NULL,
    sgd_prc_descrip character varying(150),
    sgd_prc_fech_ini date,
    sgd_prc_fech_fin date
);
CREATE TABLE sgd_prd_prcdmentos (
    sgd_prd_codigo numeric(4,0) NOT NULL,
    sgd_prd_descrip character varying(200),
    sgd_prd_fech_ini date,
    sgd_prd_fech_fin date
);
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
CREATE TABLE sgd_rdf_retdocf (
    sgd_mrd_codigo numeric(4,0) NOT NULL,
    radi_nume_radi numeric(15,0) NOT NULL,
    depe_codi numeric(5,0) NOT NULL,
    usua_codi numeric(10,0) NOT NULL,
    usua_doc character varying(14) NOT NULL,
    sgd_rdf_fech date NOT NULL
);
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
CREATE TABLE sgd_rfax_reservafax (
    sgd_rfax_codigo numeric(10,0),
    sgd_rfax_fax character varying(30),
    usua_login character varying(30),
    sgd_rfax_fech date,
    sgd_rfax_fechradi date,
    radi_nume_radi numeric(15,0),
    sgd_rfax_observa character varying(500)
);
CREATE TABLE sgd_rmr_radmasivre (
    sgd_rmr_grupo numeric(15,0) NOT NULL,
    sgd_rmr_radi numeric(15,0) NOT NULL
);
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
    sgd_sbrd_procedi character varying(1500)
);
CREATE TABLE sgd_sed_sede (
    sgd_sed_codi numeric(4,0) NOT NULL,
    sgd_sed_desc character varying(50)
);
CREATE TABLE sgd_senuf_secnumfe (
    sgd_senuf_codi numeric(4,0) NOT NULL,
    sgd_pnufe_codi numeric(4,0),
    depe_codi numeric(5,0),
    sgd_senuf_sec character varying(50)
);
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
    sgd_exp_privado numeric(1,0),
    sgd_sexp_estado numeric(1,0) DEFAULT 0 NOT NULL
);
CREATE TABLE sgd_srd_seriesrd (
    sgd_srd_codigo numeric(4,0) NOT NULL,
    sgd_srd_descrip character varying(60) NOT NULL,
    sgd_srd_fechini date NOT NULL,
    sgd_srd_fechfin date NOT NULL
);
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
CREATE TABLE sgd_tid_tipdecision (
    sgd_tid_codi numeric(4,0) NOT NULL,
    sgd_tid_desc character varying(150),
    sgd_tpr_codigo numeric(4,0),
    sgd_pexp_codigo numeric(2,0),
    sgd_tpr_codigop numeric(2,0)
);
CREATE TABLE sgd_tidm_tidocmasiva (
    sgd_tidm_codi numeric(4,0) NOT NULL,
    sgd_tidm_desc character varying(150)
);
CREATE TABLE sgd_tip3_tipotercero (
    sgd_tip3_codigo numeric(2,0) NOT NULL,
    sgd_dir_tipo numeric(4,0),
    sgd_tip3_nombre character varying(15),
    sgd_tip3_desc character varying(30),
    sgd_tip3_imgpestana character varying(20),
    sgd_tpr_tp1 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp2 numeric(1,0) DEFAULT 0,
    sgd_tpr_tp4 smallint DEFAULT 1,
    sgd_tpr_tp3 smallint DEFAULT 1,
    sgd_tpr_tp5 smallint DEFAULT 1
);
CREATE TABLE sgd_tma_temas (
    sgd_tma_codigo numeric(4,0) NOT NULL,
    depe_codi numeric(5,0),
    sgd_prc_codigo numeric(4,0),
    sgd_tma_descrip character varying(150)
);
CREATE TABLE sgd_tme_tipmen (
    sgd_tme_codi numeric(3,0) NOT NULL,
    sgd_tme_desc character varying(150)
);
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
    sgd_tpr_web smallint DEFAULT 1,
    sgd_tpr_tiptermino character varying(5),
    sgd_tpr_tp4 smallint,
    sgd_tpr_tp3 smallint,
    sgd_tpr_tp5 smallint
);
CREATE TABLE sgd_trad_tiporad (
    sgd_trad_codigo numeric(2,0) NOT NULL,
    sgd_trad_descr character varying(30),
    sgd_trad_icono character varying(30),
    sgd_trad_diasbloqueo numeric(2,0),
    sgd_trad_genradsal smallint
);
CREATE TABLE sgd_ttr_transaccion (
    sgd_ttr_codigo numeric(3,0) NOT NULL,
    sgd_ttr_descrip character varying(100) NOT NULL
);
CREATE TABLE sgd_tvd_dependencia (
    sgd_depe_codi numeric(5,0) NOT NULL,
    sgd_depe_nombre character varying(200) NOT NULL,
    sgd_depe_fechini date NOT NULL,
    sgd_depe_fechfin date NOT NULL
);
CREATE TABLE sgd_tvd_series (
    sgd_depe_codi numeric(4,0) NOT NULL,
    sgd_stvd_codi numeric(4,0) NOT NULL,
    sgd_stvd_nombre character varying(200) NOT NULL,
    sgd_stvd_ac numeric(4,0),
    sgd_stvd_dispfin numeric(2,0),
    sgd_stvd_proc character varying(500)
);
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
CREATE TABLE sgd_usm_usumodifica (
    sgd_usm_modcod numeric(5,0) NOT NULL,
    sgd_usm_moddescr character varying(60) NOT NULL
);
CREATE TABLE tipo_doc_identificacion (
    tdid_codi numeric(2,0) NOT NULL,
    tdid_desc character varying(100) NOT NULL
);
CREATE TABLE tipo_remitente (
    trte_codi numeric(2,0) NOT NULL,
    trte_desc character varying(100) NOT NULL
);
CREATE TABLE ubicacion_fisica (
    ubic_depe_radi numeric(5,0),
    ubic_depe_arch numeric(5,0)
);
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
    usua_auth_ldap numeric(1,0) DEFAULT 0,
    perm_archi character(1) DEFAULT 1,
    perm_vobo character(1) DEFAULT 1,
    perm_borrar_anexo numeric(1,0),
    perm_tipif_anexo numeric(1,0),
    usua_perm_adminflujos numeric(1,0) DEFAULT 0 NOT NULL,
    usua_exp_trd numeric(2,0) DEFAULT 0,
    usua_perm_rademail smallint,
    usua_prad_tp4 smallint,
    usua_perm_accesi numeric(1,0) DEFAULT 0,
    usua_prad_tp3 smallint,
    usua_prad_tp5 smallint,
    usua_perm_agrcontacto numeric(1,0) DEFAULT 0
);
