
--LIMPIEZA DE BASE DE DATOS PARA MODELO ORFEO-- 

--Parametrización Tipos de radicación
delete from sgd_trad_tiporad; --tipos de radicación
INSERT INTO sgd_trad_tiporad VALUES (1, 'Salida', NULL, 1);
INSERT INTO sgd_trad_tiporad VALUES (2, 'Entrada', NULL, 1);
INSERT INTO sgd_trad_tiporad VALUES (4, 'Factura', NULL, 1);
delete from carpeta; --carpetas del sistema
INSERT INTO carpeta VALUES (1, 'Salida');
INSERT INTO carpeta VALUES (12, 'Devueltos');
INSERT INTO carpeta VALUES (11, 'Vo.Bo.');
INSERT INTO carpeta VALUES (0, 'Entrada');
INSERT INTO carpeta VALUES (4, 'Factura');
delete from carpeta_per; --carpetas personales
INSERT INTO carpeta_per VALUES (1, 998, 'Masiva', 'Radicacion Masiva', 99);


--Parametrización dependencias
DELETE FROM dependencia; --dependencias
INSERT INTO dependencia(depe_codi,depe_nomb,dpto_codi,muni_codi,depe_codi_padre,depe_codi_territorial, id_cont,id_pais,dep_central,depe_estado)  VALUES (999, 'Dependencia de Salida', 11, 1, 999,999, 1, 170, 1, 1);
INSERT INTO dependencia(depe_codi,depe_nomb,dpto_codi,muni_codi,depe_codi_padre,depe_codi_territorial, id_cont,id_pais,dep_central,depe_estado) VALUES (998, 'Dependencia de Prueba', 11, 1, 998, 998,1, 170, 1, 1);
ALTER TABLE dependencia DROP COLUMN depe_rad_tp3;
ALTER TABLE dependencia DROP COLUMN depe_rad_tp5;
ALTER TABLE dependencia DROP COLUMN depe_rad_tp6;
ALTER TABLE dependencia DROP COLUMN depe_rad_tp7;
ALTER TABLE dependencia DROP COLUMN depe_rad_tp8;
ALTER TABLE dependencia DROP COLUMN depe_rad_tp9;
delete from dependencia_visibilidad; --visibilidad entre dependencias

--Parametrización usuarios
delete from usuario; --todos los usuarios
INSERT INTO usuario(usua_codi,depe_codi,usua_login,usua_fech_crea,usua_pasw,usua_esta,usua_nomb,
perm_radi,usua_admin,usua_nuevo,usua_doc,codi_nivel,usua_sesion,usua_fech_sesion,
usua_ext,usua_nacim,usua_email,perm_radi_sal,usua_admin_archivo,usua_masiva,
usua_perm_dev,usua_perm_numeradoc,sgd_panu_codi,usua_prad_tp1,usua_prad_tp2,
usua_prad_tp4,usua_perm_envios,usua_perm_modifica,usua_perm_impresion,
sgd_aper_codigo,sgd_perm_estadistica,usua_perm_sancionados,usua_admin_sistema,
usua_perm_trd,usua_perm_firma,usua_perm_prestamo,usuario_publico,usuario_reasignar,
usua_perm_notifica,usua_perm_expediente,id_pais,id_cont,usua_auth_ldap,perm_archi,
perm_vobo,perm_borrar_anexo,perm_tipif_anexo,usua_perm_adminflujos,usua_exp_trd,
usua_perm_parques,usua_perm_emp)
VALUES (1, 999, 'DSALIDA', '2011-09-09', '123', '1', 'Usuario DE SALIDA', 
'0', '0', '0', '12345678909', 1,NULL, NULL, 
NULL, NULL, NULL, NULL,0, 0, 
0, 0, 0, 0, 0, 
0, 0, 0, NULL, 
NULL, 0, NULL, 0,
0, 0, NULL, 0, NULL,
NULL, 0, 170, 1, 0, '1',
'1', NULL, NULL, 0, 0, 
0,0);
INSERT INTO usuario (usua_codi,depe_codi,usua_login,usua_fech_crea,usua_pasw,usua_esta,usua_nomb,
perm_radi,usua_admin,usua_nuevo,usua_doc,codi_nivel,usua_sesion,usua_fech_sesion,
usua_ext,usua_nacim,usua_email,perm_radi_sal,usua_admin_archivo,usua_masiva,
usua_perm_dev,usua_perm_numeradoc,sgd_panu_codi,usua_prad_tp1,usua_prad_tp2,
usua_prad_tp4,usua_perm_envios,usua_perm_modifica,usua_perm_impresion,
sgd_aper_codigo,sgd_perm_estadistica,usua_perm_sancionados,usua_admin_sistema,
usua_perm_trd,usua_perm_firma,usua_perm_prestamo,usuario_publico,usuario_reasignar,
usua_perm_notifica,usua_perm_expediente,id_pais,id_cont,usua_auth_ldap,perm_archi,
perm_vobo,perm_borrar_anexo,perm_tipif_anexo,usua_perm_adminflujos,usua_exp_trd,
usua_perm_parques,usua_perm_emp)
VALUES (1, 998, 'ADMON', '2011-09-09', 'df466d570b7884201b25c7a8d3', '1', 'Usuario Administrador', 
'0', '1', '0', '1234567890', 5, NULL, NULL,
NULL, NULL, 'soporte@skinatech.com', NULL, 4, 0,
1, 1, 1, 3, 3,
3, 1, 1, 2,
NULL, 2, NULL, 1, 
1, 0, 1, 0, 1,
1, 2, 170, 1, 0, '1',
'1', 1, 1, 1, 0, 
0,0);
ALTER TABLE usuario DROP COLUMN usua_prad_tp3;
ALTER TABLE usuario DROP COLUMN usua_prad_tp5;
ALTER TABLE usuario DROP COLUMN usua_prad_tp6;
ALTER TABLE usuario DROP COLUMN usua_prad_tp7;
ALTER TABLE usuario DROP COLUMN usua_prad_tp8;
ALTER TABLE usuario DROP COLUMN usua_prad_tp9;

delete from sgd_ush_usuhistorico; -- Registro historico por usuario sobre el tipo de transaccion realizada

--Parametrización TRD
delete from sgd_srd_seriesrd; --series
delete from sgd_sbrd_subserierd; --subseries
delete from sgd_mrd_matrird; --matriz
delete from sgd_rdf_retdocf; -- asigancion de TRD por area

--Parametrización tipos documentales
delete from sgd_tpr_tpdcumento;
INSERT INTO sgd_tpr_tpdcumento(sgd_tpr_codigo,sgd_tpr_descrip,sgd_tpr_termino,sgd_tpr_tpuso,sgd_tpr_numera,
sgd_tpr_radica,sgd_tpr_tp1,sgd_tpr_tp2,sgd_tpr_tp4,sgd_tpr_estado,sgd_termino_real,
sgd_tpr_web) VALUES (0, 'No Definido', 0, 1, ' ', '1', 1, 1, 1, 1, 0, 1);
ALTER TABLE sgd_tpr_tpdcumento DROP COLUMN sgd_tpr_tp3;
ALTER TABLE sgd_tpr_tpdcumento DROP COLUMN sgd_tpr_tp5;
ALTER TABLE sgd_tpr_tpdcumento DROP COLUMN sgd_tpr_tp6;
ALTER TABLE sgd_tpr_tpdcumento DROP COLUMN sgd_tpr_tp7;
ALTER TABLE sgd_tpr_tpdcumento DROP COLUMN sgd_tpr_tp8;
ALTER TABLE sgd_tpr_tpdcumento DROP COLUMN sgd_tpr_tp9;

--Parametrizacion contactos
delete from sgd_def_contactos; --(Hacen parte de la parametrización)


--Parametrizacion Archivo de gestión y central
delete from sgd_eit_items; -- Edificios, estantes, cajas etc
delete from sgd_exp_expediente; -- radicados con expedientes
delete from sgd_archivo_central; --radicados de archivo central
delete from sgd_sexp_secexpedientes; -- secuencia de expedientes

--Parametrización conexiones de flujos 
delete from sgd_fars_faristas; --conexiones entre etapas
delete from sgd_fexp_flujoexpedientes; --etapas
delete from sgd_pexp_procexpedientes; -- procesos
delete from sgd_hfld_histflujodoc; --historico de los flujos

--Parametrización Empresas
delete from sgd_oem_oempresas; 
delete from bodega_empresas; 

--Parametrizacion de envios
delete from sgd_clta_clstarif; --tarifas de envios
delete from sgd_fenv_frmenvio; --formas de envios
delete from sgd_renv_regenvio; -- envios realizados
delete from sgd_tar_tarifas; --valores de las tarifas

---Documentos radicados---
delete from radicado; -- radicados en el sistema
delete from sgd_agen_agendados; -- radicados agendados
delete from sgd_anu_anulados; -- radicados anulados
delete from sgd_rfax_reservafax;--Fax recibidos
delete from anexos; -- anexos de los radicados
delete from hist_eventos; -- flujo historico de los radicados
delete from informados; -- radicados informados
delete from prestamo; -- radicados para prestamos

--Columnas de la tabla tipo tercero
DELETE FROM sgd_tip3_tipotercero;
INSERT INTO sgd_tip3_tipotercero(sgd_tip3_codigo,sgd_dir_tipo,sgd_tip3_nombre,sgd_tip3_desc,sgd_tip3_imgpestana,
sgd_tpr_tp1,sgd_tpr_tp2,sgd_tpr_tp4) VALUES (1, 1, 'REMITENTE', 'REMITENTE', 'tip3remitente.jpg', 0, 1, 1);
INSERT INTO sgd_tip3_tipotercero(sgd_tip3_codigo,sgd_dir_tipo,sgd_tip3_nombre,sgd_tip3_desc,sgd_tip3_imgpestana,
sgd_tpr_tp1,sgd_tpr_tp2,sgd_tpr_tp4) VALUES (2, 1, 'DESTINATARIO', 'DESTINATARIO', 'tip3destina.jpg', 1,0,0);
INSERT INTO sgd_tip3_tipotercero(sgd_tip3_codigo,sgd_dir_tipo,sgd_tip3_nombre,sgd_tip3_desc,sgd_tip3_imgpestana,
sgd_tpr_tp1,sgd_tpr_tp2,sgd_tpr_tp4) VALUES (3, 2, 'EMPRESAS', 'EMPRESAS', 'tip3predio.jpg', 1, 1, 1);
INSERT INTO sgd_tip3_tipotercero(sgd_tip3_codigo,sgd_dir_tipo,sgd_tip3_nombre,sgd_tip3_desc,sgd_tip3_imgpestana,
sgd_tpr_tp1,sgd_tpr_tp2,sgd_tpr_tp4) VALUES (4, 3, 'TERCEROS', 'TERCEROS', 'tip3ent.jpg', 1, 1, 1);
ALTER TABLE sgd_tip3_tipotercero DROP COLUMN sgd_tpr_tp3;
ALTER TABLE sgd_tip3_tipotercero DROP COLUMN sgd_tpr_tp5;
ALTER TABLE sgd_tip3_tipotercero DROP COLUMN sgd_tpr_tp6;
ALTER TABLE sgd_tip3_tipotercero DROP COLUMN sgd_tpr_tp7;
ALTER TABLE sgd_tip3_tipotercero DROP COLUMN sgd_tpr_tp8;
ALTER TABLE sgd_tip3_tipotercero DROP COLUMN sgd_tpr_tp9;

-- Valores obligatorios

--Tabla sgd_apli_aplintegra
DELETE FROM sgd_apli_aplintegra;
insert into sgd_apli_aplintegra (SGD_APLI_CODI)values(0);

--Tabla sgd_dir_drecciones
DELETE FROM sgd_dir_drecciones;
insert into sgd_dir_drecciones (SGD_DIR_CODIGO, SGD_DIR_TIPO)values(0, 0);

--Tabla sgd_ciu_ciudadano
DELETE FROM sgd_ciu_ciudadano;
insert into sgd_ciu_ciudadano (SGD_CIU_CODIGO)values(0);

--Tabla sgd_oem_oempresas ---
DELETE FROM sgd_oem_oempresas;
insert into sgd_oem_oempresas (SGD_OEM_CODIGO)values(0); 

--Inserta Campo Obligatorio Tabla SGD_PEXP_PROCEXPEDIENTES
DELETE FROM SGD_PEXP_PROCEXPEDIENTES;
insert into SGD_PEXP_PROCEXPEDIENTES (SGD_PEXP_CODIGO,SGD_PEXP_TIENEFLUJO)values(0,0);

--Inserta Campo Obligatorio Tabla ESTADO
DELETE FROM ESTADO;
insert into ESTADO (ESTA_CODI, ESTA_DESC) values (9,'Documento Orfeo');

--Inserta tipos de anexos que se pueden subir
delete from anexos_tipo;
INSERT INTO anexos_tipo VALUES (1, 'doc', 'Word');
INSERT INTO anexos_tipo VALUES (2, 'xls', 'Excel');
INSERT INTO anexos_tipo VALUES (3, 'ppt', 'PowerPoint');
INSERT INTO anexos_tipo VALUES (4, 'tif', 'Imagen Tif');
INSERT INTO anexos_tipo VALUES (5, 'jpg', 'Imagen jpg');
INSERT INTO anexos_tipo VALUES (6, 'gif', 'Imagen gif');
INSERT INTO anexos_tipo VALUES (7, 'pdf', 'Acrobat Reader');
INSERT INTO anexos_tipo VALUES (8, 'txt', 'Documento txt');
INSERT INTO anexos_tipo VALUES (9, 'zip', 'Comprimido');
INSERT INTO anexos_tipo VALUES (10, 'rtf', 'Rich Text Format (rtf)');
INSERT INTO anexos_tipo VALUES (11, 'dia', 'Dia(Diagrama)');
INSERT INTO anexos_tipo VALUES (12, 'zargo', 'Argo(Diagrama)');
INSERT INTO anexos_tipo VALUES (13, 'csv', 'csv (separado por comas)');
INSERT INTO anexos_tipo VALUES (14, 'odt', 'OpenDocument Text');
INSERT INTO anexos_tipo VALUES (20, 'avi', '.avi (Video)');
INSERT INTO anexos_tipo VALUES (21, 'mpg', '.mpg (video)');
INSERT INTO anexos_tipo VALUES (23, 'tar', '.tar (Comprimido)');

--Continentes
delete from sgd_def_continentes;
INSERT INTO sgd_def_continentes VALUES (1, 'AMERICA');
INSERT INTO sgd_def_continentes VALUES (2, 'EUROPA');
INSERT INTO sgd_def_continentes VALUES (3, 'ASIA');
INSERT INTO sgd_def_continentes VALUES (4, 'AFRICA');
INSERT INTO sgd_def_continentes VALUES (5, 'OCEANIA');
INSERT INTO sgd_def_continentes VALUES (6, 'ANTARTIDA');

--Paises
delete from sgd_def_paises;
INSERT INTO sgd_def_paises VALUES (170, 1, 'COLOMBIA');
INSERT INTO sgd_def_paises VALUES (4, 3, 'Afganistan');
INSERT INTO sgd_def_paises VALUES (862, 1, 'VENEZUELA');
INSERT INTO sgd_def_paises VALUES (1, 1, 'MEXICO');
INSERT INTO sgd_def_paises VALUES (32, 1, 'Argentina');
INSERT INTO sgd_def_paises VALUES (724, 2, 'ESPAÑA');
INSERT INTO sgd_def_paises VALUES (214, 1, 'REPUBLICA DOMINICANA');


--Departamentos
delete from departamento;
INSERT INTO departamento VALUES (1, 'TODOS', 1, 170);
INSERT INTO departamento VALUES (5, 'ANTIOQUIA', 1, 170);
INSERT INTO departamento VALUES (8, 'ATLANTICO', 1, 170);
INSERT INTO departamento VALUES (13, 'BOLIVAR', 1, 170);
INSERT INTO departamento VALUES (15, 'BOYACA', 1, 170);
INSERT INTO departamento VALUES (18, 'CAQUETA', 1, 170);
INSERT INTO departamento VALUES (19, 'CAUCA', 1, 170);
INSERT INTO departamento VALUES (20, 'CESAR', 1, 170);
INSERT INTO departamento VALUES (23, 'CORDOBA', 1, 170);
INSERT INTO departamento VALUES (25, 'CUNDINAMARCA', 1, 170);
INSERT INTO departamento VALUES (27, 'CHOCO', 1, 170);
INSERT INTO departamento VALUES (41, 'HUILA', 1, 170);
INSERT INTO departamento VALUES (44, 'LA GUAJIRA', 1, 170);
INSERT INTO departamento VALUES (47, 'MAGDALENA', 1, 170);
INSERT INTO departamento VALUES (50, 'META', 1, 170);
INSERT INTO departamento VALUES (52, 'NARIÑO', 1, 170);
INSERT INTO departamento VALUES (54, 'NORTE DE SANTANDER', 1, 170);
INSERT INTO departamento VALUES (63, 'QUINDIO', 1, 170);
INSERT INTO departamento VALUES (66, 'RISARALDA', 1, 170);
INSERT INTO departamento VALUES (68, 'SANTANDER', 1, 170);
INSERT INTO departamento VALUES (70, 'SUCRE', 1, 170);
INSERT INTO departamento VALUES (73, 'TOLIMA', 1, 170);
INSERT INTO departamento VALUES (76, 'VALLE DEL CAUCA', 1, 170);
INSERT INTO departamento VALUES (81, 'ARAUCA', 1, 170);
INSERT INTO departamento VALUES (85, 'CASANARE', 1, 170);
INSERT INTO departamento VALUES (86, 'PUTUMAYO', 1, 170);
INSERT INTO departamento VALUES (88, 'SAN ANDRES', 1, 170);
INSERT INTO departamento VALUES (91, 'AMAZONAS', 1, 170);
INSERT INTO departamento VALUES (94, 'GUAINIA', 1, 170);
INSERT INTO departamento VALUES (95, 'GUAVIARE', 1, 170);
INSERT INTO departamento VALUES (97, 'VAUPES', 1, 170);
INSERT INTO departamento VALUES (99, 'VICHADA', 1, 170);
INSERT INTO departamento VALUES (2, 'ASTURIAS', 2, 724);
INSERT INTO departamento VALUES (11, 'D.C.', 1, 170);
INSERT INTO departamento VALUES (89, 'CALDAS', 1, 170);

--municipios
delete from municipio;
INSERT INTO municipio VALUES (1, 5, 'MEDELLIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (2, 5, 'ABEJORRAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (4, 5, 'ABRIAQUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (21, 5, 'ALEJANDRIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (30, 5, 'AMAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (31, 5, 'AMALFI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (34, 5, 'ANDES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (36, 5, 'ANGELOPOLIS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (38, 5, 'ANGOSTURA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (40, 5, 'ANORI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (42, 5, 'ANTIOQUIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (44, 5, 'ANZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (45, 5, 'APARTADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (51, 5, 'ARBOLETES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (55, 5, 'ARGELIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (59, 5, 'ARMENIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (79, 5, 'BARBOSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (86, 5, 'BELMIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (88, 5, 'BELLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (90, 5, 'LA PINTADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (91, 5, 'BETANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (93, 5, 'BETULIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (101, 5, 'BOLIVAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (107, 5, 'BRICEÑO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (113, 5, 'BURITICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (120, 5, 'CACERES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (125, 5, 'CAICEDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (129, 5, 'CALDAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (134, 5, 'CAMPAMENTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (138, 5, 'CAÑASGORDAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (142, 5, 'CARACOLI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (145, 5, 'CARAMANTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (147, 5, 'CAREPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (148, 5, 'CARMEN DE VIBORAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (150, 5, 'CAROLINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (154, 5, 'CAUCASIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (172, 5, 'CHIGORODO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (190, 5, 'CISNEROS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (197, 5, 'COCORNA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (206, 5, 'CONCEPCION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (209, 5, 'CONCORDIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (212, 5, 'COPACABANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (234, 5, 'DABEIBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (237, 5, 'DON MATIAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (240, 5, 'EBEJICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 5, 'EL BAGRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (264, 5, 'ENTRERRIOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (266, 5, 'ENVIGADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (282, 5, 'FREDONIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (284, 5, 'FRONTINO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (306, 5, 'GIRALDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (308, 5, 'GIRARDOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (310, 5, 'GOMEZ PLATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (313, 5, 'GRANADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (315, 5, 'GUADALUPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 5, 'GUARNE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (321, 5, 'GUATAPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (347, 5, 'HELICONIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (353, 5, 'HISPANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (360, 5, 'ITAGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (361, 5, 'ITUANGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (364, 5, 'JARDIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (368, 5, 'JERICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (376, 5, 'LA CEJA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (380, 5, 'LA ESTRELLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (390, 5, 'LA PINTADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 5, 'LA UNION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (411, 5, 'LIBORINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (425, 5, 'MACEO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (440, 5, 'MARINILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (467, 5, 'MONTEBELLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (475, 5, 'MURINDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (480, 5, 'MUTATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (483, 5, 'NARIÑO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (490, 5, 'NECOCLI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (495, 5, 'NECHI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (501, 5, 'OLAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (541, 5, 'PEÑOL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (543, 5, 'PEQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (576, 5, 'PUEBLORRICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (579, 5, 'PUERTO BERRIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (585, 5, 'PTO NARE(LAMAGDALENA)', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (591, 5, 'PUERTO TRIUNFO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (604, 5, 'REMEDIOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (607, 5, 'RETIRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (615, 5, 'RIONEGRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (628, 5, 'SABANALARGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (631, 5, 'SABANETA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (642, 5, 'SALGAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (647, 5, 'SAN ANDRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (649, 5, 'SAN CARLOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (652, 5, 'SAN FRANCISCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (656, 5, 'SAN JERONIMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (658, 5, 'SAN JOSE DE LA MONTAÑA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (659, 5, 'SAN JUAN DE URABA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (660, 5, 'SAN LUIS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (664, 5, 'SAN PEDRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (665, 5, 'SAN PEDRO DE URABA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (667, 5, 'SAN RAFAEL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (670, 5, 'SAN ROQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (674, 5, 'SAN VICENTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (679, 5, 'SANTA BARBARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (686, 5, 'SANTA ROSA DE OSOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (690, 5, 'SANTO DOMINGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (697, 5, 'SANTUARIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (736, 5, 'SEGOVIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (756, 5, 'SONSON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (761, 5, 'SOPETRAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (789, 5, 'TAMESIS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (790, 5, 'TARAZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (792, 5, 'TARSO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (809, 5, 'TITIRIBI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (819, 5, 'TOLEDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (837, 5, 'TURBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (842, 5, 'URAMITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (847, 5, 'URRAO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (854, 5, 'VALDIVIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (856, 5, 'VALPARAISO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (858, 5, 'VEGACHI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (861, 5, 'VENECIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (873, 5, 'VIGIA DEL FUERTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (885, 5, 'YALI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (887, 5, 'YARUMAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (890, 5, 'YOLOMBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (893, 5, 'YONDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (895, 5, 'ZARAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 8, 'BARRANQUILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (78, 8, 'BARANOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (137, 8, 'CAMPO DE LA CRUZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (141, 8, 'CANDELARIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (296, 8, 'GALAPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (372, 8, 'JUAN DE ACOSTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (421, 8, 'LURUACO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (433, 8, 'MALAMBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (436, 8, 'MANATI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (520, 8, 'PALMAR DE VARELA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (549, 8, 'PIOJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (558, 8, 'POLONUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (560, 8, 'PONEDERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (573, 8, 'PUERTO COLOMBIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (606, 8, 'REPELON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (634, 8, 'SABANAGRANDE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (638, 8, 'SABANALARGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (675, 8, 'SANTA LUCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (685, 8, 'SANTO TOMAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (758, 8, 'SOLEDAD', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (770, 8, 'SUAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (832, 8, 'TUBARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (849, 8, 'USIACURI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 13, 'CARTAGENA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (6, 13, 'ACHI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (42, 13, 'ARENAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (52, 13, 'ARJONA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (62, 13, 'ARROYOHONDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (74, 13, 'BARRANCO DE LOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (140, 13, 'CALAMAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (160, 13, 'CANTAGALLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (188, 13, 'CICUCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (212, 13, 'CORDOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (222, 13, 'CLEMENCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (244, 13, 'EL CARMEN DE BOLIVAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (248, 13, 'EL GUAMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (268, 13, 'EL PEÑON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (300, 13, 'HATILLO DE LOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (430, 13, 'MAGANGUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (433, 13, 'MAHATES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (440, 13, 'MARGARITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (442, 13, 'MARIA LA BAJA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (458, 13, 'MONTECRISTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (468, 13, 'MOMPOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (473, 13, 'MORALES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (549, 13, 'PINILLOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (580, 13, 'REGIDOR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (600, 13, 'RIO VIEJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (620, 13, 'SAN CRISTÓBAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (647, 13, 'SAN ESTANISLAO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (650, 13, 'SAN FERNANDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (654, 13, 'SAN JACINTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (655, 13, 'SAN JACINTO DEL CAUCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (657, 13, 'SAN JUAN NEPOMUCENO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (667, 13, 'SAN MARTIN DE LOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (670, 13, 'SAN PABLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (673, 13, 'SANTA CATALINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (683, 13, 'SANTA ROSA NORTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (688, 13, 'SANTA ROSA DEL SUR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (744, 13, 'SIMITI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (760, 13, 'SOPLAVIENTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (780, 13, 'TALAIGUA NUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (810, 13, 'IQUISIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (836, 13, 'TURBACO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (838, 13, 'TURBANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (873, 13, 'VILLANUEVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (894, 13, 'ZAMBRANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 15, 'TUNJA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (22, 15, 'ALMEIDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (47, 15, 'AQUITANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (51, 15, 'ARCABUCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (87, 15, 'BELEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (90, 15, 'BERBEO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (92, 15, 'BETEITIVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (97, 15, 'BOAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (104, 15, 'BOYACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (106, 15, 'BRICENO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (109, 15, 'BUENAVISTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (114, 15, 'BUSBANZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (131, 15, 'CALDAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (135, 15, 'CAMPOHERMOSO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (162, 15, 'CERINZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (172, 15, 'CHINAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (176, 15, 'CHIQUINQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (180, 15, 'CHISCAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (183, 15, 'CHITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (185, 15, 'CHITARAQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (187, 15, 'CHIVATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (189, 15, 'CIENEGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (30, 13, 'ALTOS DEL ROSARIO', 1, 170, '0', NULL, 1);
INSERT INTO municipio VALUES (204, 15, 'COMBITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (212, 15, 'COPER', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (215, 15, 'CORRALES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (218, 15, 'COVARACHIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (223, 15, 'CUBARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (224, 15, 'CUCAITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (226, 15, 'CUITIVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (232, 15, 'CHIQUIZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (236, 15, 'CHIVOR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (238, 15, 'DUITAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (244, 15, 'EL COCUY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (248, 15, 'EL ESPINO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (272, 15, 'FIRAVITOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (276, 15, 'FLORESTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (293, 15, 'GACHANTIVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (296, 15, 'GAMEZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (299, 15, 'GARAGOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (317, 15, 'GUACAMAYAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (322, 15, 'GUATEQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (325, 15, 'GUAYATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (332, 15, 'GUICAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (362, 15, 'IZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (367, 15, 'JENESANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (368, 15, 'JERICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (377, 15, 'LABRANZAGRANDE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (380, 15, 'LA CAPILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (401, 15, 'LA VICTORIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (403, 15, 'LA UVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (407, 15, 'VILLA DE LEYVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (425, 15, 'MACANAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (442, 15, 'MARIPI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (455, 15, 'MIRAFLORES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (464, 15, 'MONGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (466, 15, 'MONGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (469, 15, 'MONIQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (476, 15, 'MOTAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (480, 15, 'MUZO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (491, 15, 'NOBSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (494, 15, 'NUEVO COLON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (500, 15, 'OICATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (507, 15, 'OTANCHE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (511, 15, 'PACHAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (514, 15, 'PAEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (516, 15, 'PAIPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (518, 15, 'PAJARITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (522, 15, 'PANQUEBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (531, 15, 'PAUNA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (533, 15, 'PAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (537, 15, 'PAZ DE RIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (542, 15, 'PESCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (550, 15, 'PISVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (572, 15, 'PUERTO BOYACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (580, 15, 'QUIPAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (599, 15, 'RAMIRIQUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (600, 15, 'RAQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (621, 15, 'RONDON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (632, 15, 'SABOYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (638, 15, 'SACHICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (646, 15, 'SAMACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (660, 15, 'SAN EDUARDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (664, 15, 'SAN JOSE DE PARE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (667, 15, 'SAN LUIS DE GACENO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (673, 15, 'SAN MATEO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (676, 15, 'SAN MIGUEL DE SEMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (681, 15, 'SAN PABLO DE BORBUR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (686, 15, 'SANTANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (690, 15, 'SANTA MARIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (693, 15, 'SANTA ROSA DE VITERBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (696, 15, 'SANTA SOFIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (720, 15, 'SATIVANORTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (723, 15, 'SATIVASUR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (740, 15, 'SIACHOQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (753, 15, 'SOATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (755, 15, 'SOCOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (757, 15, 'SOCHA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (759, 15, 'SOGAMOSO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (761, 15, 'SOMONDOCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (762, 15, 'SORA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (763, 15, 'SOTAQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (764, 15, 'SORACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (774, 15, 'SUSACON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (776, 15, 'SUTAMARCHAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (778, 15, 'SUTATENZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (790, 15, 'TASCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (798, 15, 'TENZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (804, 15, 'TIBANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (806, 15, 'TIBASOSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (808, 15, 'TINJACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (810, 15, 'TIPACOQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (814, 15, 'TOCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (816, 15, 'TOGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (820, 15, 'TOPAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (822, 15, 'TOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (832, 15, 'TUNUNGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (835, 15, 'TURMEQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (837, 15, 'TUTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (839, 15, 'TUTASA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (842, 15, 'UMBITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (861, 15, 'VENTAQUEMADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (879, 15, 'VIRACACHA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (897, 15, 'ZETAQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 18, 'FLORENCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (29, 18, 'ALBANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (94, 18, 'BELEN DE LOS ANDAQUIES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (150, 18, 'CARTAGENA DEL CHAIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (205, 18, 'CURILLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (247, 18, 'EL DONCELLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (256, 18, 'EL PAUJIL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (410, 18, 'LA MONTAÑITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (460, 18, 'MILAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (479, 18, 'MORELIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (592, 18, 'PUERTO RICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (610, 18, 'SAN JOSE DE FRAGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (753, 18, 'SAN VICENTE DEL CAGUAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (756, 18, 'SOLANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (765, 18, 'SOLANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (785, 18, 'SOLITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (860, 18, 'VALPARAISO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 19, 'POPAYAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (22, 19, 'ALMAGUER', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (50, 19, 'ARGELIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (75, 19, 'BALBOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (100, 19, 'BOLIVAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (110, 19, 'BUENOS AIRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (130, 19, 'CAJIBIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (137, 19, 'CALDONO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (142, 19, 'CALOTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (212, 19, 'CORINTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (256, 19, 'EL TAMBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (290, 19, 'FLORENCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 19, 'GUAPI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (355, 19, 'INZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (364, 19, 'JAMBALO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (392, 19, 'LA SIERRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (397, 19, 'LA VEGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (418, 19, 'LOPEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (450, 19, 'MERCADERES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (455, 19, 'MIRANDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (473, 19, 'MORALES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (513, 19, 'PADILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (517, 19, 'PAEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (532, 19, 'PATIA (EL BORDO)', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (533, 19, 'PIAMONTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (548, 19, 'PIENDAMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (573, 19, 'PUERTO TEJADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (585, 19, 'PURACE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (622, 19, 'ROSAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (693, 19, 'SAN SEBASTIAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (698, 19, 'SANTANDER DE QUILICHAO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (701, 19, 'SANTA ROSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (743, 19, 'SILVIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (760, 19, 'SOTARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (780, 19, 'SUAREZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (785, 19, 'SUCRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (807, 19, 'TIMBIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (809, 19, 'TIMBIQUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (821, 19, 'TORIBIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (824, 19, 'TOTORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (845, 19, 'VILLA RICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 20, 'VALLEDUPAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (11, 20, 'AGUACHICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (13, 20, 'AGUSTIN CODAZZI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (32, 20, 'ASTREA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (45, 20, 'BECERRIL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (60, 20, 'BOSCONIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (175, 20, 'CHIMICHAGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (178, 20, 'CHIRIGUANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (228, 20, 'CURUMANI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (238, 20, 'EL COPEY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 20, 'EL PASO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (295, 20, 'GAMARRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (310, 20, 'GONZALEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (383, 20, 'LA GLORIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 20, 'LA JAGUA DE IBIRICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (443, 20, 'MANAURE BALCON DL CESAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (517, 20, 'PAILITAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (550, 20, 'PELAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (570, 20, 'PUEBLO BELLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (614, 20, 'RIO DE ORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (621, 20, 'LA PAZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (710, 20, 'SAN ALBERTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (750, 20, 'SAN DIEGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (770, 20, 'SAN MARTIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (787, 20, 'TAMALAMEQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 23, 'MONTERIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (68, 23, 'AYAPEL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (79, 23, 'BUENAVISTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (90, 23, 'CANALETE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (162, 23, 'CERETE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (168, 23, 'CHIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (182, 23, 'CHINU', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (189, 23, 'CIENAGA DE ORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (300, 23, 'COTORRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (350, 23, 'LA APARTADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (417, 23, 'LORICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (419, 23, 'LOS CORDOBAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (464, 23, 'MOMIL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (466, 23, 'MONTELIBANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (500, 23, 'MOÑITOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (555, 23, 'PLANETA RICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (570, 23, 'PUEBLO NUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (574, 23, 'PUERTO ESCONDIDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (580, 23, 'PUERTO LIBERTADOR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (586, 23, 'PURISIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (660, 23, 'SAHAGUN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (670, 23, 'SAN ANDRES SOTAVENTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (672, 23, 'SAN ANTERO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (675, 23, 'SAN BERNARDO DEL VIENTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (678, 23, 'SAN CARLOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (686, 23, 'SAN PELAYO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (807, 23, 'TIERRALTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (855, 23, 'VALENCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 25, 'AGUA DE DIOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (19, 25, 'ALBAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (35, 25, 'ANAPOIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (40, 25, 'ANOLAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (53, 25, 'ARBELAEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (86, 25, 'BELTRAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (95, 25, 'BITUIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (99, 25, 'BOJACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (120, 25, 'CABRERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (123, 25, 'CACHIPAY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (126, 25, 'CAJICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (148, 25, 'CAPARRAPI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (151, 25, 'CAQUEZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (154, 25, 'CARMEN DE CARUPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (168, 25, 'CHAGUANI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (175, 25, 'CHIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (178, 25, 'CHIPAQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (181, 25, 'CHOACHI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (183, 25, 'CHOCONTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (200, 25, 'COGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (214, 25, 'COTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (224, 25, 'CUCUNUBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (245, 25, 'EL COLEGIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (258, 25, 'EL PENON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (260, 25, 'EL ROSAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (269, 25, 'FACATATIVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (279, 25, 'FOMEQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (281, 25, 'FOSCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (286, 25, 'FUNZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (288, 25, 'FUQUENE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (290, 25, 'FUSAGASUGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (293, 25, 'GACHALA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (295, 25, 'GACHANCIPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (297, 25, 'GACHETA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (299, 25, 'GAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (307, 25, 'GIRARDOT', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (312, 25, 'GRANADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (317, 25, 'GUACHETA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (320, 25, 'GUADUAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (322, 25, 'GUASCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (324, 25, 'GUATAQUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (326, 25, 'GUATAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (328, 25, 'GUAYABAL DE SIQUIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (335, 25, 'GUAYABETAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (339, 25, 'GUTIERREZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (368, 25, 'JERUSALEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (372, 25, 'JUNIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (377, 25, 'LA CALERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (386, 25, 'LA MESA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (394, 25, 'LA PALMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (398, 25, 'LA PEÑA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (402, 25, 'LA VEGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (407, 25, 'LENGUAZAQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (426, 25, 'MACHETA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (430, 25, 'MADRID', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (436, 25, 'MANTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (438, 25, 'MEDINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (473, 25, 'MOSQUERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (483, 25, 'NARIÑO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (486, 25, 'NEMOCON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (488, 25, 'NILO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (489, 25, 'NIMAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (491, 25, 'NOCAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (506, 25, 'VENECIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (513, 25, 'PACHO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (518, 25, 'PAIME', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (524, 25, 'PANDI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (530, 25, 'PARATEBUENO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (535, 25, 'PASCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (572, 25, 'PUERTO SALGAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (580, 25, 'PULI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (592, 25, 'QUEBRADANEGRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (594, 25, 'QUETAME', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (596, 25, 'QUIPILE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (599, 25, 'APULO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (612, 25, 'RICAURTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (645, 25, 'S.ANTONIO TEQUENDAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (649, 25, 'SAN BERNARDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (653, 25, 'SAN CAYETANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (658, 25, 'SAN FRANCISCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (662, 25, 'SAN JUAN DE RIO SECO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (718, 25, 'SASAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (736, 25, 'SESQUILE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (740, 25, 'SIBATE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (743, 25, 'SILVANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (745, 25, 'SIMIJACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (754, 25, 'SOACHA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (758, 25, 'SOPO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (769, 25, 'SUBACHOQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (772, 25, 'SUESCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (777, 25, 'SUPATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (779, 25, 'SUSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (781, 25, 'SUTATAUSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (785, 25, 'TABIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (793, 25, 'TAUSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (797, 25, 'TENA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (799, 25, 'TENJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (805, 25, 'TIBACUY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (807, 25, 'TIBIRITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (815, 25, 'TOCAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (817, 25, 'TOCANCIPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (823, 25, 'TOPAIPI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (839, 25, 'UBALA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (841, 25, 'UBAQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (843, 25, 'UBATE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (845, 25, 'UNE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (851, 25, 'UTICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (862, 25, 'VERGARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (867, 25, 'VIANI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (871, 25, 'VILLAGOMEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (873, 25, 'VILLAPINZON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (875, 25, 'VILLETA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (878, 25, 'VIOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (885, 25, 'YACOPI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (898, 25, 'ZIPACON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (899, 25, 'ZIPAQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 27, 'QUIBDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (6, 27, 'ACANDI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (25, 27, 'ALTO BAUDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (50, 27, 'ATRATO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (73, 27, 'BAGADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (75, 27, 'BAHIA SOLANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (77, 27, 'BAJO BAUDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (99, 27, 'BOJAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (135, 27, 'CANTON DEL SAN PABLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (160, 27, 'CERTEGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (205, 27, 'CONDOTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (245, 27, 'EL CARMEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 27, 'EL LITORAL DEL SAN JUAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (361, 27, 'ITSMINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (372, 27, 'JURADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (413, 27, 'LLORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (491, 27, 'NOVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (495, 27, 'NUQUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (615, 27, 'RIOSUCIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (660, 27, 'SAN JOSE DEL PALMAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (745, 27, 'SIPI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (787, 27, 'TADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (800, 27, 'UNGUIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 41, 'NEIVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (6, 41, 'ACEVEDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (13, 41, 'AGRADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (16, 41, 'AIPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (20, 41, 'ALGECIRAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (26, 41, 'ALTAMIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (78, 41, 'BARAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (132, 41, 'CAMPOALEGRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (206, 41, 'COLOMBIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (244, 41, 'ELIAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (298, 41, 'GARZON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (306, 41, 'GIGANTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (319, 41, 'GUADALUPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (349, 41, 'HOBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (357, 41, 'IQUIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (359, 41, 'ISNOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (378, 41, 'LA ARGENTINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (396, 41, 'LA PLATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (483, 41, 'NATAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (503, 41, 'OPORAPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (518, 41, 'PAICOL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (524, 41, 'PALERMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (530, 41, 'PALESTINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (548, 41, 'PITAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (551, 41, 'PITALITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (615, 41, 'RIVERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (660, 41, 'SALADOBLANCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (668, 41, 'SAN AGUSTIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (676, 41, 'SANTA MARIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (770, 41, 'SUAZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (791, 41, 'TARQUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (797, 41, 'TESALIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (799, 41, 'TELLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (801, 41, 'TERUEL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (807, 41, 'TIMANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (872, 41, 'VILLAVIEJA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (885, 41, 'YAGUARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 44, 'RIOHACHA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (35, 44, 'ALBANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (78, 44, 'BARRANCAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (90, 44, 'DIBULLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (98, 44, 'DISTRACCIÓN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (110, 44, 'EL MOLINO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (279, 44, 'FONSECA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (378, 44, 'HATONUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (420, 44, 'LA JAGUA DEL PILAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (430, 44, 'MAICAO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (560, 44, 'MANAURE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (650, 44, 'SAN JUAN DEL CESAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (847, 44, 'URIBIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (855, 44, 'URUMITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (874, 44, 'VILLANUEVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 47, 'SANTAMARTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (53, 47, 'ARACATACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (58, 47, 'ARIGUANI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (98, 47, 'ZONA BANANERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (161, 47, 'CERRO SAN ANTONIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (170, 47, 'CHIVOLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (189, 47, 'CIENAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (245, 47, 'EL BANCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (258, 47, 'EL PIÑON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (268, 47, 'EL RETÉN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (288, 47, 'FUNDACION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 47, 'GUAMAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (541, 47, 'PEDRAZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (545, 47, 'PIJIÑO DEL CARMEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (551, 47, 'PIVIJAY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (555, 47, 'PLATO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (570, 47, 'PUEBLOVIEJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (605, 47, 'REMOLINO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (675, 47, 'SALAMINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (692, 47, 'SAN SEBASTIAN BUENAVISTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (703, 47, 'SAN ZENON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (707, 47, 'SANTA ANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (745, 47, 'SITIONUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (798, 47, 'TENERIFE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (999, 47, 'NUEVA GRANADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 50, 'VILLAVICENCIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (6, 50, 'ACACIAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (110, 50, 'BARRANCA DE UPIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (124, 50, 'CABUYARO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (150, 50, 'CASTILLA LA NUEVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (223, 50, 'CUBARRAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (226, 50, 'CUMARAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (245, 50, 'EL CALVARIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (251, 50, 'EL CASTILLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (270, 50, 'EL DORADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (287, 50, 'FUENTE DE ORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (313, 50, 'GRANADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 50, 'GUAMAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (325, 50, 'MAPIRIPAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (330, 50, 'MESETAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (350, 50, 'LA MACARENA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (370, 50, 'LA URIBE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 50, 'LEJANIAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (450, 50, 'PUERTO CONCORDIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (568, 50, 'PUERTO GAITAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (573, 50, 'PUERTO LOPEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (577, 50, 'PUERTO LLERAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (590, 50, 'PUERTO RICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (606, 50, 'RESTREPO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (680, 50, 'SAN CARLOS DE GUAROA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (683, 50, 'SAN JUAN DE ARAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (686, 50, 'SAN JUANITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (689, 50, 'SAN MARTIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (711, 50, 'VISTA HERMOSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 52, 'PASTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (19, 52, 'ALBAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (22, 52, 'ALDANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (36, 52, 'ANCUYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (51, 52, 'ARBOLEDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (79, 52, 'BARBACOAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (83, 52, 'BELEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (110, 52, 'BUESACO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (203, 52, 'COLON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (207, 52, 'CONSACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (210, 52, 'CONTADERO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (215, 52, 'CORDOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (224, 52, 'CUASPUD', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (227, 52, 'CUMBAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (233, 52, 'CUMBITARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (240, 52, 'CHACHAGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 52, 'EL CHARCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (256, 52, 'EL ROSARIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (258, 52, 'EL TABLON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (260, 52, 'EL TAMBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (287, 52, 'FUNES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (317, 52, 'GUACHUCAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (320, 52, 'GUAITARILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (323, 52, 'GUALMATAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (352, 52, 'ILES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (354, 52, 'IMUES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (356, 52, 'IPIALES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (378, 52, 'LA CRUZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (381, 52, 'LA FLORIDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (385, 52, 'LA LLANADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (390, 52, 'LA TOLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (399, 52, 'LA UNION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (405, 52, 'LEIVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (411, 52, 'LINARES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (418, 52, 'LOS ANDES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (427, 52, 'MAGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (435, 52, 'MALLAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (473, 52, 'MOSQUERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (490, 52, 'OLAYA HERRERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (506, 52, 'OSPINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (520, 52, 'FRANCIS PIZARRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (540, 52, 'POLICARPA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (560, 52, 'POTOSI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (565, 52, 'PROVIDENCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (573, 52, 'PUERRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (585, 52, 'PUPIALES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (612, 52, 'RICAURTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (621, 52, 'ROBERTO PAYAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (678, 52, 'SAMANIEGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (683, 52, 'SANDONA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (685, 52, 'SAN BERNARDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (687, 52, 'SAN LORENZO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (693, 52, 'SAN PABLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (694, 52, 'SAN PEDRO DE CARTAGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (696, 52, 'SANTABARBARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (699, 52, 'SANTACRUZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (720, 52, 'SAPUYES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (786, 52, 'TAMINANGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (788, 52, 'TANGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (835, 52, 'TUMACO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (838, 52, 'TUQUERRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (885, 52, 'YACUANQUER', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 54, 'CUCUTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (3, 54, 'ABREGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (51, 54, 'ARBOLEDAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (99, 54, 'BOCHALEMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (109, 54, 'BUCARASICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (125, 54, 'CACOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (128, 54, 'CACHIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (172, 54, 'CHINACOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (174, 54, 'CHITAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (206, 54, 'CONVENCION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (223, 54, 'CUCUTILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (239, 54, 'DURANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (245, 54, 'EL CARMEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 54, 'EL TARRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (261, 54, 'EL ZULIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (313, 54, 'GRAMALOTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (344, 54, 'HACARI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (347, 54, 'HERRAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (377, 54, 'LABATECA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (385, 54, 'LA ESPERANZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (398, 54, 'LA PLAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (405, 54, 'LOS PATIOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (418, 54, 'LOURDES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (480, 54, 'MUTISCUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (498, 54, 'OCAÑA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (518, 54, 'PAMPLONA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (520, 54, 'PAMPLONITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (553, 54, 'PUERTO SANTANDER', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (599, 54, 'RAGONVALIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (660, 54, 'SALAZAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (670, 54, 'SAN CALIXTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (673, 54, 'SAN CAYETANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (680, 54, 'SANTIAGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (720, 54, 'SARDINATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (743, 54, 'SILOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (800, 54, 'TEORAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (810, 54, 'TIBU', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (820, 54, 'TOLEDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (871, 54, 'VILLA CARO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (874, 54, 'VILLA DEL ROSARIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 63, 'ARMENIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (111, 63, 'BUENAVISTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (130, 63, 'CALARCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (190, 63, 'CIRCASIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (212, 63, 'CORDOBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (272, 63, 'FILANDIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (302, 63, 'GENOVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (401, 63, 'LA TEBAIDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (470, 63, 'MONTENEGRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (548, 63, 'PIJAO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (594, 63, 'QUIMBAYA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (690, 63, 'SALENTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 66, 'PEREIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (45, 66, 'APIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (75, 66, 'BALBOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (88, 66, 'BELEN DE UMBRIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (170, 66, 'DOS QUEBRADAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 66, 'GUATICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (383, 66, 'LA CELIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 66, 'LA VIRGINIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (440, 66, 'MARSELLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (456, 66, 'MISTRATO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (572, 66, 'PUEBLO RICO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (594, 66, 'QUINCHIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (682, 66, 'SANTA ROSA DE CABAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (687, 66, 'SANTUARIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 68, 'BUCARAMANGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (13, 68, 'AGUADA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (20, 68, 'ALBANIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (51, 68, 'ARATOCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (77, 68, 'BARBOSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (79, 68, 'BARICHARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (81, 68, 'BARRANCABERMEJA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (92, 68, 'BETULIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (101, 68, 'BOLIVAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (121, 68, 'CABRERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (132, 68, 'CALIFORNIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (147, 68, 'CAPITANEJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (152, 68, 'CARCASI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (160, 68, 'CEPITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (162, 68, 'CERRITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (167, 68, 'CHARALA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (169, 68, 'CHARTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (176, 68, 'CHIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (179, 68, 'CHIPATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (190, 68, 'CIMITARRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (207, 68, 'CONCEPCION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (209, 68, 'CONFINES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (211, 68, 'CONTRATACION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (217, 68, 'COROMORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (229, 68, 'CURITI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (235, 68, 'EL CARMEN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (245, 68, 'EL GUACAMAYO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 68, 'EL PEÑON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (255, 68, 'EL PLAYON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (264, 68, 'ENCINO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (266, 68, 'ENCISO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (271, 68, 'FLORIAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (276, 68, 'FLORIDABLANCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (296, 68, 'GALAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (298, 68, 'GAMBITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (307, 68, 'GIRON (SAN JUAN DE)', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 68, 'GUACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (320, 68, 'GUADALUPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (322, 68, 'GUAPOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (324, 68, 'GUAVATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (327, 68, 'GUEPSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (344, 68, 'HATO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (368, 68, 'JESUS MARIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (370, 68, 'JORDAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (377, 68, 'LA BELLEZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (385, 68, 'LANDAZURI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (397, 68, 'LA PAZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (406, 68, 'LEBRIJA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (418, 68, 'LOS SANTOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (425, 68, 'MACARAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (432, 68, 'MALAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (444, 68, 'MATANZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (464, 68, 'MOGOTES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (468, 68, 'MOLAGAVITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (498, 68, 'OCAMONTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (500, 68, 'OIBA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (502, 68, 'ONZAGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (522, 68, 'PALMAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (524, 68, 'PALMAS SOCORRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (533, 68, 'PARAMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (547, 68, 'PIEDECUESTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (549, 68, 'PINCHOTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (572, 68, 'PUENTE NACIONAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (573, 68, 'PUERTO PARRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (575, 68, 'PUERTO WILCHES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (615, 68, 'RIONEGRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (655, 68, 'SABANA DE TORRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (669, 68, 'SAN ANDRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (673, 68, 'SAN BENITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (679, 68, 'SAN GIL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (682, 68, 'SAN JOAQUIN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (684, 68, 'SAN JOSE DE MIRANDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (686, 68, 'SAN MIGUEL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (689, 68, 'SAN VICENTE DE CHUCURI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (705, 68, 'SANTA BARBARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (720, 68, 'SANTA HELENA DEL OPON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (745, 68, 'SIMACOTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (755, 68, 'SOCORRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (770, 68, 'SUAITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (773, 68, 'SUCRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (780, 68, 'SURATA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (820, 68, 'TONA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (855, 68, 'VALLE DE SAN JOSE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (861, 68, 'VELEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (867, 68, 'VETAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (872, 68, 'VILLANUEVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (895, 68, 'ZAPATOCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 70, 'SINCELEJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (110, 70, 'BUENAVISTA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (124, 70, 'CAIMITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (204, 70, 'COLOSO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (215, 70, 'COROZAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (221, 70, 'COVEÑAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (230, 70, 'CHALAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (235, 70, 'GALERAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (265, 70, 'GUARANDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 70, 'LA UNION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (418, 70, 'LOS PALMITOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (429, 70, 'MAJAGUAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (473, 70, 'MORROA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (508, 70, 'OVEJAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (523, 70, 'PALMITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (670, 70, 'SAMPUES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (678, 70, 'SAN BENITO ABAD', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (702, 70, 'SAN JUAN DE BETULIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (708, 70, 'SAN MARCOS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (713, 70, 'SAN ONOFRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (717, 70, 'SAN PEDRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (742, 70, 'SINCE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (771, 70, 'SUCRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (820, 70, 'TOLU', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (823, 70, 'TOLUVIEJO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 73, 'IBAGUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (24, 73, 'ALPUJARRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (26, 73, 'ALVARADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (30, 73, 'AMBALEMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (43, 73, 'ANZOATEGUI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (55, 73, 'ARMERO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (67, 73, 'ATACO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (124, 73, 'CAJAMARCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (148, 73, 'CARMEN DE APICALA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (152, 73, 'CASABIANCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (168, 73, 'CHAPARRAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (200, 73, 'COELLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (217, 73, 'COYAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (226, 73, 'CUNDAY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (236, 73, 'DOLORES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (268, 73, 'ESPINAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (270, 73, 'FALAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (275, 73, 'FLANDES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (283, 73, 'FRESNO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (319, 73, 'GUAMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (347, 73, 'HERVEO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (349, 73, 'HONDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (352, 73, 'ICONONZO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (408, 73, 'LERIDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (411, 73, 'LIBANO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (443, 73, 'MARIQUITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (449, 73, 'MELGAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (461, 73, 'MURILLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (483, 73, 'NATAGAIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (504, 73, 'ORTEGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (520, 73, 'PALOCABILDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (547, 73, 'PIEDRAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (555, 73, 'PLANADAS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (563, 73, 'PRADO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (585, 73, 'PURIFICACION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (616, 73, 'RIOBLANCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (622, 73, 'RONCESVALLES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (624, 73, 'ROVIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (671, 73, 'SALDAÑA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (675, 73, 'SAN ANTONIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (678, 73, 'SAN LUIS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (686, 73, 'SANTA ISABEL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (770, 73, 'SUAREZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (854, 73, 'VALLE DE SAN JUAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (861, 73, 'VENADILLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (870, 73, 'VILLAHERMOSA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (873, 73, 'VILLARRICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 76, 'CALI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (20, 76, 'ALCALA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (36, 76, 'ANDALUCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (41, 76, 'ANSERMANUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (54, 76, 'ARGELIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (100, 76, 'BOLIVAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (109, 76, 'BUENAVENTURA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (111, 76, 'BUGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (113, 76, 'BUGALAGRANDE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (122, 76, 'CAICEDONIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (126, 76, 'CALIMA (DARIEN)', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (130, 76, 'CANDELARIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (147, 76, 'CARTAGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (233, 76, 'DAGUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (243, 76, 'EL AGUILA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (246, 76, 'EL CAIRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (248, 76, 'EL CERRITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 76, 'EL DOVIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (275, 76, 'FLORIDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (306, 76, 'GINEBRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (318, 76, 'GUACARI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (364, 76, 'JAMUNDI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (377, 76, 'LA CUMBRE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 76, 'LA UNION', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (403, 76, 'LA VICTORIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (497, 76, 'OBANDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (520, 76, 'PALMIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (563, 76, 'PRADERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (606, 76, 'RESTREPO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (616, 76, 'RIOFRIO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (622, 76, 'ROLDANILLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (670, 76, 'SAN PEDRO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (736, 76, 'SEVILLA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (823, 76, 'TORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (828, 76, 'TRUJILLO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (834, 76, 'TULUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (845, 76, 'ULLOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (863, 76, 'VERSALLES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (869, 76, 'VIJES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (890, 76, 'YOTOCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (892, 76, 'YUMBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (895, 76, 'ZARZAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 81, 'ARAUCA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (65, 81, 'ARAUQUITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (220, 81, 'CRAVO NORTE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (300, 81, 'FORTUL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (591, 81, 'PUERTO RONDON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (736, 81, 'SARAVENA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (794, 81, 'TAME', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 85, 'YOPAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (10, 85, 'AGUAZUL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (15, 85, 'CHAMEZA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (125, 85, 'HATO COROZAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (136, 85, 'LA SALINA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (139, 85, 'MANI', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (162, 85, 'MONTERREY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (225, 85, 'NUNCHIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (230, 85, 'OROCUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (250, 85, 'PAZ DE ARIPORO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (263, 85, 'PORE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (279, 85, 'RECETOR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (300, 85, 'SABANALARGA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (315, 85, 'SACAMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (325, 85, 'SAN LUIS DE PALENQUE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (400, 85, 'TAMARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (410, 85, 'TAURAMENA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (430, 85, 'TRINIDAD', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (440, 85, 'VILLANUEVA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 86, 'MOCOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (219, 86, 'COLON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (320, 86, 'ORITO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (568, 86, 'PUERTO ASIS', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (569, 86, 'PUERTO CAICEDO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (571, 86, 'PUERTO GUZMAN', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (573, 86, 'PUERTO  LEGUIZAMO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (749, 86, 'SIBUNDOY', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (755, 86, 'SAN FRANCISCO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (757, 86, 'SAN MIGUEL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (760, 86, 'SANTIAGO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (865, 86, 'VALLE GUAMUEZ', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (885, 86, 'VILLAGARZON', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 88, 'SAN ANDRES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (564, 88, 'PROVIDENCIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 91, 'LETICIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (263, 91, 'EL ENCANTO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (405, 91, 'LA CHORRERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (407, 91, 'LA PEDRERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (430, 91, 'LA VICTORIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (460, 91, 'MIRITI-PARANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (530, 91, 'PUERTO ALEGRIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (536, 91, 'PUERTO ARICA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (540, 91, 'PUERTO NARIÑO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (669, 91, 'PTO SANTANDER', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (798, 91, 'TARAPACA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 94, 'INIRIDA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (343, 94, 'GUAVIARE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (883, 94, 'SAN FELIPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (884, 94, 'PUERTO COLOMBIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (885, 94, 'LA GUADALUPE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (886, 94, 'CACAHUAL', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (887, 94, 'PANA PANA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (888, 94, 'CD. MORICHAL NUEVO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 95, 'SAN JOSE DEL GUAVIARE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (15, 95, 'CALAMAR', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (25, 95, 'EL RETORNO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (200, 95, 'MIRAFLORES', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 97, 'MITU', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (161, 97, 'CARURU', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (511, 97, 'PACOA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (666, 97, 'TARAIRA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (777, 97, 'PAPUNAUA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (889, 97, 'YAVARATE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (890, 97, 'VILLA FATIMA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (891, 97, 'ACARICUARA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 99, 'PUERTO CARRENO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (524, 99, 'LA PRIMAVERA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (572, 99, 'SANTA RITA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (624, 99, 'SANTA ROSALIA', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (760, 99, 'SAN JOSE DE OCUNE', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (773, 99, 'CUMARIBO', 1, 170, NULL, NULL, 1);
INSERT INTO municipio VALUES (1, 11, 'BOGOTA', 1, 170, '0', NULL, 1);
INSERT INTO municipio VALUES (999, 1, 'TODOS', 1, 170, '0', NULL, 1);
INSERT INTO municipio VALUES (999, 23, 'balsa', 1, 170, '0', NULL, 1);
INSERT INTO municipio VALUES (1, 2, 'ASTURIAS', 2, 724, '1', '2-724-2-1', 1);
INSERT INTO municipio VALUES (1,89, 'MANIZALES', 1, 170, '0', NULL, 1);

--medios de recepcion
delete from medio_recepcion;
INSERT INTO medio_recepcion VALUES (1, 'Correo');
INSERT INTO medio_recepcion VALUES (2, 'Fax');
INSERT INTO medio_recepcion VALUES (3, 'Internet');
INSERT INTO medio_recepcion VALUES (4, 'Mail');
INSERT INTO medio_recepcion VALUES (5, 'Personal');
INSERT INTO medio_recepcion VALUES (6, 'Telefonico');


--obligatorios
delete from sgd_cob_campobliga;
INSERT INTO sgd_cob_campobliga VALUES (1, 'PAIS_NOMBRE', 'PAIS_NOMBRE', 2);
INSERT INTO sgd_cob_campobliga VALUES (2, 'NOMBRE', 'NOMBRE', 1);
INSERT INTO sgd_cob_campobliga VALUES (3, 'MUNI_NOMBRE', 'MUNI_NOMBRE', 1);
INSERT INTO sgd_cob_campobliga VALUES (4, 'DEPTO_NOMBRE', 'DEPTO_NOMBRE', 1);
INSERT INTO sgd_cob_campobliga VALUES (5, 'F_RAD_S', 'F_RAD_S', 1);
INSERT INTO sgd_cob_campobliga VALUES (6, 'TIPO', 'TIPO', 2);
INSERT INTO sgd_cob_campobliga VALUES (7, 'NOMBRE', 'NOMBRE', 2);
INSERT INTO sgd_cob_campobliga VALUES (8, 'MUNI_NOMBRE', 'MUNI_NOMBRE', 2);
INSERT INTO sgd_cob_campobliga VALUES (9, 'DEPTO_NOMBRE', 'DEPTO_NOMBRE', 2);
INSERT INTO sgd_cob_campobliga VALUES (10, 'DIR', 'DIR', 2);

--motivos de devolucion
delete from sgd_deve_dev_envio;
INSERT INTO sgd_deve_dev_envio VALUES (1, 'CASA DESOCUPADA');
INSERT INTO sgd_deve_dev_envio VALUES (3, 'CERRADO');
INSERT INTO sgd_deve_dev_envio VALUES (5, 'DEVUELTO DE PORTERIA');
INSERT INTO sgd_deve_dev_envio VALUES (6, 'DIRECCION DEFICIENTE');
INSERT INTO sgd_deve_dev_envio VALUES (7, 'FALLECIDO');
INSERT INTO sgd_deve_dev_envio VALUES (8, 'NO EXISTE NUMERO');
INSERT INTO sgd_deve_dev_envio VALUES (9, 'NO RESIDE');
INSERT INTO sgd_deve_dev_envio VALUES (10, 'NO RECLAMADO');
INSERT INTO sgd_deve_dev_envio VALUES (12, 'SE TRASLADO');
INSERT INTO sgd_deve_dev_envio VALUES (13, 'NO EXISTE EMPRESA');
INSERT INTO sgd_deve_dev_envio VALUES (14, 'ZONA DE ALTO RIESGO');
INSERT INTO sgd_deve_dev_envio VALUES (15, 'SOBRE DESOCUPADO');
INSERT INTO sgd_deve_dev_envio VALUES (16, 'FUERA PERIMETRO URBANO');
INSERT INTO sgd_deve_dev_envio VALUES (17, 'ENVIADO A ADPOSTAL, CONTROL DE CALIDAD');
INSERT INTO sgd_deve_dev_envio VALUES (18, 'SIN SELLO');
INSERT INTO sgd_deve_dev_envio VALUES (90, 'DOCUMENTO MAL RADICADO');
INSERT INTO sgd_deve_dev_envio VALUES (99, 'SOBREPASO TIEMPO DE ESPERA');
INSERT INTO sgd_deve_dev_envio VALUES (2, 'CAMBIO DE DOMICILIO');

--Estados de anulacion
delete from sgd_eanu_estanulacion;
INSERT INTO sgd_eanu_estanulacion VALUES ('RADICADO EN SOLICITUD DE ANULACION', 1);
INSERT INTO sgd_eanu_estanulacion VALUES ('RADICADO ANULADO', 2);
INSERT INTO sgd_eanu_estanulacion VALUES ('RADICADO EN SOLICITUD DE REVIVIR', 3);
INSERT INTO sgd_eanu_estanulacion VALUES ('RADICADO IMPOSIBLE DE ANULAR', 9);


-- Envios especiales
INSERT INTO sgd_enve_envioespecial VALUES (109, '1200', '1200', 'Valor descuento automático');
INSERT INTO sgd_enve_envioespecial VALUES (109, '160', '160', 'Valor alistamiento');
INSERT INTO sgd_enve_envioespecial VALUES (109, '1300', '3300', 'Valor cert. acuse de recibido');

INSERT INTO sgd_not_notificacion VALUES (1, 'PERSONAL');
INSERT INTO sgd_not_notificacion VALUES (2, 'TELEFONICA');

--
-- Parametros para prestamos
--

INSERT INTO sgd_parametro VALUES ('PRESTAMO_ESTADO', 5, 'Prestamo indefinido');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_REQUERIMIENTO', 1, 'Documento');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_REQUERIMIENTO', 2, 'Anexo');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_REQUERIMIENTO', 3, 'Anexo y Documento');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_DIAS_PREST', 1, '8');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_DIAS_CANC', 1, '2');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_PASW', 1, '1');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_ESTADO', 4, 'Cancelado');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_ESTADO', 3, 'Devuelto');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_ESTADO', 2, 'Prestado');
INSERT INTO sgd_parametro VALUES ('PRESTAMO_ESTADO', 1, 'Solicitado');

--parametros de masiva
INSERT INTO sgd_tidm_tidocmasiva VALUES (1, 'PLANTILLA');
INSERT INTO sgd_tidm_tidocmasiva VALUES (2, 'CSV');

--tipos de transacciones
INSERT INTO sgd_ttr_transaccion VALUES (40, 'Firma Digital de Documento');
INSERT INTO sgd_ttr_transaccion VALUES (41, 'Eliminacion solicitud de Firma Digital');
INSERT INTO sgd_ttr_transaccion VALUES (50, 'Cambio de Estado Expediente');
INSERT INTO sgd_ttr_transaccion VALUES (51, 'Creacion Expediente');
INSERT INTO sgd_ttr_transaccion VALUES (1, 'Recuperacion Radicado');
INSERT INTO sgd_ttr_transaccion VALUES (9, 'Reasignacion');
INSERT INTO sgd_ttr_transaccion VALUES (8, 'Informar');
INSERT INTO sgd_ttr_transaccion VALUES (19, 'Cambiar Tipo de Documento');
INSERT INTO sgd_ttr_transaccion VALUES (20, 'Crear Registro');
INSERT INTO sgd_ttr_transaccion VALUES (21, 'Editar Registro');
INSERT INTO sgd_ttr_transaccion VALUES (10, 'Movimiento entre Carpetas');
INSERT INTO sgd_ttr_transaccion VALUES (11, 'Modificacion Radicado');
INSERT INTO sgd_ttr_transaccion VALUES (7, 'Borrar Informado');
INSERT INTO sgd_ttr_transaccion VALUES (12, 'Devuelto-Reasignar');
INSERT INTO sgd_ttr_transaccion VALUES (13, 'Archivar');
INSERT INTO sgd_ttr_transaccion VALUES (14, 'Agendar');
INSERT INTO sgd_ttr_transaccion VALUES (15, 'Sacar de la agenda');
INSERT INTO sgd_ttr_transaccion VALUES (0, '--');
INSERT INTO sgd_ttr_transaccion VALUES (16, 'Reasignar para Vo.Bo.');
INSERT INTO sgd_ttr_transaccion VALUES (2, 'Radicacion');
INSERT INTO sgd_ttr_transaccion VALUES (22, 'Digitalizacion de Radicado');
INSERT INTO sgd_ttr_transaccion VALUES (23, 'Digitalizacion - Modificacion');
INSERT INTO sgd_ttr_transaccion VALUES (24, 'Asociacion Imagen fax');
INSERT INTO sgd_ttr_transaccion VALUES (30, 'Radicacion Masiva');
INSERT INTO sgd_ttr_transaccion VALUES (17, 'Modificacion de Causal');
INSERT INTO sgd_ttr_transaccion VALUES (18, 'Modificacion del Sector');
INSERT INTO sgd_ttr_transaccion VALUES (25, 'Solicitud de Anulacion');
INSERT INTO sgd_ttr_transaccion VALUES (26, 'Anulacion Rad');
INSERT INTO sgd_ttr_transaccion VALUES (27, 'Rechazo de Anulacion');
INSERT INTO sgd_ttr_transaccion VALUES (37, 'Cambio de Estado del Documento');
INSERT INTO sgd_ttr_transaccion VALUES (28, 'Devolucion de correo');
INSERT INTO sgd_ttr_transaccion VALUES (29, 'Digitalizacion de Anexo');
INSERT INTO sgd_ttr_transaccion VALUES (31, 'Borrado de Anexo a radicado');
INSERT INTO sgd_ttr_transaccion VALUES (32, 'Asignacion TRD');
INSERT INTO sgd_ttr_transaccion VALUES (33, 'Eliminar TRD');
INSERT INTO sgd_ttr_transaccion VALUES (35, 'Tipificacion de la decision');
INSERT INTO sgd_ttr_transaccion VALUES (36, 'Cambio en la Notificacion');
INSERT INTO sgd_ttr_transaccion VALUES (38, 'Cambio Vinculacion Documento');
INSERT INTO sgd_ttr_transaccion VALUES (39, 'Solicitud de Firma');
INSERT INTO sgd_ttr_transaccion VALUES (42, 'Digitalizacion Radicado(Asoc. Imagen Web)');
INSERT INTO sgd_ttr_transaccion VALUES (52, 'Excluir radicado de expediente');
INSERT INTO sgd_ttr_transaccion VALUES (53, 'Incluir radicado en expediente');
INSERT INTO sgd_ttr_transaccion VALUES (54, 'Cambio Seguridad del Documento');
INSERT INTO sgd_ttr_transaccion VALUES (57, 'Ingreso al Archivo Fisico');
INSERT INTO sgd_ttr_transaccion VALUES (55, 'Creación Subexpediente');
INSERT INTO sgd_ttr_transaccion VALUES (56, 'Cambio de Responsable');
INSERT INTO sgd_ttr_transaccion VALUES (58, 'Expediente Cerrado');
INSERT INTO sgd_ttr_transaccion VALUES (59, 'Expediente Reabierto');
INSERT INTO sgd_ttr_transaccion VALUES (61, 'Asignar TRD Multiple');
INSERT INTO sgd_ttr_transaccion VALUES (62, 'Insercion Expediente Multiple');
INSERT INTO sgd_ttr_transaccion VALUES (65, 'No requiere respuesta');


--
-- Modificaciones en los permisos de los usuarios
--

INSERT INTO sgd_usm_usumodifica VALUES (47, 'Quito permiso impresion');
INSERT INTO sgd_usm_usumodifica VALUES (43, 'Otorgo permiso prestamo de documentos');
INSERT INTO sgd_usm_usumodifica VALUES (44, 'Quito permiso prestamo de documentos');
INSERT INTO sgd_usm_usumodifica VALUES (45, 'Otorgo permiso digitalizacion de documentos');
INSERT INTO sgd_usm_usumodifica VALUES (46, 'Quito permiso digitalizacion de documentos');
INSERT INTO sgd_usm_usumodifica VALUES (48, 'Otorgo permiso modificaciones');
INSERT INTO sgd_usm_usumodifica VALUES (49, 'Quito permiso modificaciones');
INSERT INTO sgd_usm_usumodifica VALUES (50, 'Cambio de perfil');
INSERT INTO sgd_usm_usumodifica VALUES (1, 'Creacion de usuario');
INSERT INTO sgd_usm_usumodifica VALUES (51, 'Otorgo permiso tablas retencion documental');
INSERT INTO sgd_usm_usumodifica VALUES (52, 'Quito permiso tablas retencion documental');
INSERT INTO sgd_usm_usumodifica VALUES (3, 'Cambio dependencia');
INSERT INTO sgd_usm_usumodifica VALUES (4, 'Cambio cedula');
INSERT INTO sgd_usm_usumodifica VALUES (5, 'Cambio nombre');
INSERT INTO sgd_usm_usumodifica VALUES (7, 'Cambio ubicacion');
INSERT INTO sgd_usm_usumodifica VALUES (8, 'Cambio piso');
INSERT INTO sgd_usm_usumodifica VALUES (9, 'Cambio estado');
INSERT INTO sgd_usm_usumodifica VALUES (10, 'Otorgo permiso radicacion entrada');
INSERT INTO sgd_usm_usumodifica VALUES (11, 'Otorgo permisos radicacion de entrada');
INSERT INTO sgd_usm_usumodifica VALUES (12, 'Quito permiso administracion sistema');
INSERT INTO sgd_usm_usumodifica VALUES (13, 'Otorgo permiso administracion sistema');
INSERT INTO sgd_usm_usumodifica VALUES (14, 'Quito permiso administracion archivo');
INSERT INTO sgd_usm_usumodifica VALUES (15, 'Otorgo permiso administracion archivo');
INSERT INTO sgd_usm_usumodifica VALUES (16, 'Habilitado como usuario nuevo');
INSERT INTO sgd_usm_usumodifica VALUES (17, 'Habilitado como usuario antiguo con clave');
INSERT INTO sgd_usm_usumodifica VALUES (18, 'Cambio nivel');
INSERT INTO sgd_usm_usumodifica VALUES (19, 'Otorgo permiso radicacion salida');
INSERT INTO sgd_usm_usumodifica VALUES (20, 'Otorgo permiso impresion');
INSERT INTO sgd_usm_usumodifica VALUES (21, 'Otorgo permiso radicacion masiva');
INSERT INTO sgd_usm_usumodifica VALUES (22, 'Quito permiso radicacion masiva');
INSERT INTO sgd_usm_usumodifica VALUES (23, 'Quito permiso devoluciones de correo');
INSERT INTO sgd_usm_usumodifica VALUES (24, 'Otorgo permiso devoluciones de correo');
INSERT INTO sgd_usm_usumodifica VALUES (25, 'Otorgo permiso de solicitud de anulacion');
INSERT INTO sgd_usm_usumodifica VALUES (26, 'Otorgo permiso de anulacion');
INSERT INTO sgd_usm_usumodifica VALUES (27, 'Otorgo permiso de solicitud de anulacion y anulacion');
INSERT INTO sgd_usm_usumodifica VALUES (28, 'Quito permiso radicacion memorandos');
INSERT INTO sgd_usm_usumodifica VALUES (29, 'Otorgo permiso radicacion memorandos');
INSERT INTO sgd_usm_usumodifica VALUES (30, 'Quito permiso radicacion resoluciones');
INSERT INTO sgd_usm_usumodifica VALUES (31, 'Otorgo permiso radicacion resoluciones');
INSERT INTO sgd_usm_usumodifica VALUES (33, 'Quito permiso envio de correo');
INSERT INTO sgd_usm_usumodifica VALUES (34, 'Otorgo permiso envio de correo');
INSERT INTO sgd_usm_usumodifica VALUES (35, 'Otorgo permiso radicacion de salida ');
INSERT INTO sgd_usm_usumodifica VALUES (39, 'Cambio extension');
INSERT INTO sgd_usm_usumodifica VALUES (40, 'Cambio email');
INSERT INTO sgd_usm_usumodifica VALUES (41, 'Quito permisos radicacion entrada');
INSERT INTO sgd_usm_usumodifica VALUES (42, 'Quito permisos de solicitud de anulacion y anulaciones');


--
--Tipos de identificacion
--

INSERT INTO tipo_doc_identificacion VALUES (0, 'Cedula de Ciudadania');
INSERT INTO tipo_doc_identificacion VALUES (1, 'Tarjeta de Identidad');
INSERT INTO tipo_doc_identificacion VALUES (2, 'Cedula de Extranjería');
INSERT INTO tipo_doc_identificacion VALUES (3, 'Pasaporte');
INSERT INTO tipo_doc_identificacion VALUES (4, 'Nit');
INSERT INTO tipo_doc_identificacion VALUES (5, 'NUIR');


--
--Tipos de remitente
--

INSERT INTO tipo_remitente VALUES (0, 'Entidades');
INSERT INTO tipo_remitente VALUES (1, 'Otras empresas');
INSERT INTO tipo_remitente VALUES (2, 'Persona natural');
INSERT INTO tipo_remitente VALUES (3, 'Predio');
INSERT INTO tipo_remitente VALUES (5, 'Otros');
INSERT INTO tipo_remitente VALUES (6, 'Funcionario');


--SECUENCIAS

drop SEQUENCE sec_bodega_empresas;
CREATE SEQUENCE sec_bodega_empresas start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;


drop SEQUENCE sec_central;
CREATE SEQUENCE sec_central start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE sec_ciu_ciudadano; 
CREATE SEQUENCE sec_ciu_ciudadano start 1 increment 1 maxvalue 9999999999999999 minvalue 0 cache 1;

drop SEQUENCE sec_def_contactos; 
CREATE SEQUENCE sec_def_contactos start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE sec_dir_direcciones;
CREATE SEQUENCE sec_dir_direcciones start 1 increment 1 maxvalue 9999999999999999 minvalue 0 cache 1;

drop SEQUENCE sec_edificio;
CREATE SEQUENCE sec_edificio start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE sec_oem_oempresas;
CREATE SEQUENCE sec_oem_oempresas start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE sec_planilla;
CREATE SEQUENCE sec_planilla start 1 increment 1 maxvalue 9999999999999999 minvalue 0 cache 1;

drop SEQUENCE sec_planilla_envio;
CREATE SEQUENCE sec_planilla_envio start 1 increment 1 maxvalue 9999999999999999 minvalue 0 cache 1;

drop SEQUENCE sec_prestamo;
CREATE SEQUENCE sec_prestamo start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE sec_sgd_hfld_histflujodoc;
CREATE SEQUENCE sec_sgd_hfld_histflujodoc start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE secr_tp1_;
drop SEQUENCE secr_tp2_;
drop SEQUENCE secr_tp3_;
drop SEQUENCE secr_tp4_;
drop SEQUENCE secr_tp5_;
drop SEQUENCE secr_tp6_;
drop SEQUENCE secr_tp7_;
drop SEQUENCE secr_tp8_;
drop SEQUENCE secr_tp9_;

CREATE SEQUENCE secr_tp1_ start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;
CREATE SEQUENCE secr_tp2_ start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;
CREATE SEQUENCE secr_tp4_ start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

drop SEQUENCE secr_tp1_100;
drop SEQUENCE secr_tp2_100;
drop SEQUENCE secr_tp3_100;
drop SEQUENCE secr_tp4_100;
drop SEQUENCE secr_tp5_100;
drop SEQUENCE secr_tp6_100;
drop SEQUENCE secr_tp7_100;
drop SEQUENCE secr_tp8_100;
drop SEQUENCE secr_tp9_100;

CREATE SEQUENCE secr_tp1_100 start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;
CREATE SEQUENCE secr_tp2_100 start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;
CREATE SEQUENCE secr_tp4_100 start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

--Dependencia de pruebas
drop SEQUENCE secr_tp1_998;
drop SEQUENCE secr_tp2_998;
drop SEQUENCE secr_tp3_998;
drop SEQUENCE secr_tp4_998;
drop SEQUENCE secr_tp5_998;
drop SEQUENCE secr_tp6_998;
drop SEQUENCE secr_tp7_998;
drop SEQUENCE secr_tp8_998;
drop SEQUENCE secr_tp9_998;
CREATE SEQUENCE secr_tp1_998 start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;
CREATE SEQUENCE secr_tp2_998 start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;
CREATE SEQUENCE secr_tp4_998 start 1 increment 1 maxvalue 9999999999999999 minvalue 1 cache 1;

