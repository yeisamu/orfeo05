/****** Object:  Database PbOrfeo    Script Date: 28/01/2007 01:55:29 p.m. ******/
IF EXISTS (SELECT name FROM master.dbo.sysdatabases WHERE name = N'PbOrfeo')
	DROP DATABASE [PbOrfeo]
GO

CREATE DATABASE [PbOrfeo]  ON (NAME = N'GdOrfeo_Data', FILENAME = N'D:\BaseDeDatos\SQL\data\PbOrfeo.mdf' , SIZE = 161, FILEGROWTH = 5) LOG ON (NAME = N'GdOrfeo_Log', FILENAME = N'D:\BaseDeDatos\SQL\data\PbOrfeo_log.ldf' , SIZE = 87, FILEGROWTH = 5)
 COLLATE SQL_Latin1_General_CP1_CI_AS
GO

exec sp_dboption N'PbOrfeo', N'autoclose', N'false'
GO

exec sp_dboption N'PbOrfeo', N'bulkcopy', N'false'
GO

exec sp_dboption N'PbOrfeo', N'trunc. log', N'false'
GO

exec sp_dboption N'PbOrfeo', N'torn page detection', N'true'
GO

exec sp_dboption N'PbOrfeo', N'read only', N'false'
GO

exec sp_dboption N'PbOrfeo', N'dbo use', N'false'
GO

exec sp_dboption N'PbOrfeo', N'single', N'false'
GO

exec sp_dboption N'PbOrfeo', N'autoshrink', N'false'
GO

exec sp_dboption N'PbOrfeo', N'ANSI null default', N'false'
GO

exec sp_dboption N'PbOrfeo', N'recursive triggers', N'false'
GO

exec sp_dboption N'PbOrfeo', N'ANSI nulls', N'false'
GO

exec sp_dboption N'PbOrfeo', N'concat null yields null', N'false'
GO

exec sp_dboption N'PbOrfeo', N'cursor close on commit', N'false'
GO

exec sp_dboption N'PbOrfeo', N'default to local cursor', N'false'
GO

exec sp_dboption N'PbOrfeo', N'quoted identifier', N'false'
GO

exec sp_dboption N'PbOrfeo', N'ANSI warnings', N'false'
GO

exec sp_dboption N'PbOrfeo', N'auto create statistics', N'true'
GO

exec sp_dboption N'PbOrfeo', N'auto update statistics', N'true'
GO

use [PbOrfeo]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANEX_FK_ANEX_TIPO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[ANEXOS] DROP CONSTRAINT ANEX_FK_ANEX_TIPO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DNUFE_ANEX_TIPO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DNUFE_DOCNUFE] DROP CONSTRAINT FK_SGD_DNUFE_ANEX_TIPO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_DEPENDENCIA_DEPARTAMENTO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[DEPENDENCIA] DROP CONSTRAINT FK_DEPENDENCIA_DEPARTAMENTO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_MUNICIPIO_DEPARTAMENTO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[MUNICIPIO] DROP CONSTRAINT FK_MUNICIPIO_DEPARTAMENTO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADI_ESTA]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADI_ESTA
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADI_MREC]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADI_MREC
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADICADO_PAR_SERV]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADICADO_PAR_SERV
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DDCA_REF_678_PAR_SERV]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DDCA_DDSGRGDO] DROP CONSTRAINT FK_SGD_DDCA_REF_678_PAR_SERV
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_DEPENDENCIA_DEPENDENCIA_ESTADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[DEPENDENCIA] DROP CONSTRAINT FK_DEPENDENCIA_DEPENDENCIA_ESTADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_ADMIN_HISTORICO_SGD_ADMIN_OBSERVACION]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_ADMIN_USUA_HISTORICO] DROP CONSTRAINT FK_SGD_ADMIN_HISTORICO_SGD_ADMIN_OBSERVACION
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_ANAR_SGD_ARGD]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_ANAR_ANEXARG] DROP CONSTRAINT FK_SGD_ANAR_SGD_ARGD
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DCAU_SGD_CAU_]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DCAU_CAUSAL] DROP CONSTRAINT FK_SGD_DCAU_SGD_CAU_
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_MUNICIPIO_SGD_DEF_CONTINENTES]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[MUNICIPIO] DROP CONSTRAINT FK_MUNICIPIO_SGD_DEF_CONTINENTES
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_MUNICIPIO_SGD_DEF_PAISES]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[MUNICIPIO] DROP CONSTRAINT FK_MUNICIPIO_SGD_DEF_PAISES
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_MAT_SGD_FUN]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_MAT_MATRIZ] DROP CONSTRAINT FK_SGD_MAT_SGD_FUN
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADICADO_SGD_NOT_NOTIFICACION]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADICADO_SGD_NOT_NOTIFICACION
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DNUFE_SGD_PNUFE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DNUFE_DOCNUFE] DROP CONSTRAINT FK_SGD_DNUFE_SGD_PNUFE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_PNUN_SGD_PNUFE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_PNUN_PROCENUM] DROP CONSTRAINT FK_SGD_PNUN_SGD_PNUFE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_MAT_SGD_PRC]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_MAT_MATRIZ] DROP CONSTRAINT FK_SGD_MAT_SGD_PRC
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_TMA_SGD_PRC]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_TMA_TEMAS] DROP CONSTRAINT FK_SGD_TMA_SGD_PRC
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_MAT_SGD_PRD]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_MAT_MATRIZ] DROP CONSTRAINT FK_SGD_MAT_SGD_PRD
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_COB__SGD_TIDM]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_COB_CAMPOBLIGA] DROP CONSTRAINT FK_SGD_COB__SGD_TIDM
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DNUFE_SGD_TPR]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DNUFE_DOCNUFE] DROP CONSTRAINT FK_SGD_DNUFE_SGD_TPR
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_MTD_SGD_TPR]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_MTD_MATRIZ_DOC] DROP CONSTRAINT FK_SGD_MTD_SGD_TPR
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADI_TDID]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADI_TDID
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_OEM__REFERENCE_TIPO_DOC]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_OEM_OEMPRESAS] DROP CONSTRAINT FK_SGD_OEM__REFERENCE_TIPO_DOC
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADI_TRTE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADI_TRTE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DNUFE_TRTE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DNUFE_DOCNUFE] DROP CONSTRAINT FK_SGD_DNUFE_TRTE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_CARP_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[CARPETA_PER] DROP CONSTRAINT FK_CARP_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_DEPE_PADRE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[DEPENDENCIA] DROP CONSTRAINT FK_DEPE_PADRE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_DEPENDENCIA_VISIBILIDAD_DEPENDENCIA]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[DEPENDENCIA_VISIBILIDAD] DROP CONSTRAINT FK_DEPENDENCIA_VISIBILIDAD_DEPENDENCIA
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_DEPENDENCIA_VISIBILIDAD_DEPENDENCIA1]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[DEPENDENCIA_VISIBILIDAD] DROP CONSTRAINT FK_DEPENDENCIA_VISIBILIDAD_DEPENDENCIA1
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_HIST_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[HIST_EVENTOS] DROP CONSTRAINT FK_HIST_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_PRESTAMO_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[PRESTAMO] DROP CONSTRAINT FK_PRESTAMO_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_PRESTAMO_DEPE_ARCH]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[PRESTAMO] DROP CONSTRAINT FK_PRESTAMO_DEPE_ARCH
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_ADMIN_DEPE_HISTORICO_DEPENDENCIA]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_ADMIN_DEPE_HISTORICO] DROP CONSTRAINT FK_SGD_ADMIN_DEPE_HISTORICO_DEPENDENCIA
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_ADMIN_HISTORICO_DEPENDENCIA]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_ADMIN_USUA_HISTORICO] DROP CONSTRAINT FK_ADMIN_HISTORICO_DEPENDENCIA
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_ADMIN_HISTORICO_DEPENDENCIA1]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_ADMIN_USUA_HISTORICO] DROP CONSTRAINT FK_ADMIN_HISTORICO_DEPENDENCIA1
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_HMTD_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_HMTD_HISMATDOC] DROP CONSTRAINT FK_SGD_HMTD_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_MAT_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_MAT_MATRIZ] DROP CONSTRAINT FK_SGD_MAT_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_PNUN_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_PNUN_PROCENUM] DROP CONSTRAINT FK_SGD_PNUN_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_TMA_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_TMA_TEMAS] DROP CONSTRAINT FK_SGD_TMA_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_USUA_DEPE]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[USUARIO] DROP CONSTRAINT FK_USUA_DEPE
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_CENTRO_POBLADO_MUNICIPIO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[CENTRO_POBLADO] DROP CONSTRAINT FK_CENTRO_POBLADO_MUNICIPIO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_CIU_CIUDADANO_MUNICIPIO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_CIU_CIUDADANO] DROP CONSTRAINT FK_SGD_CIU_CIUDADANO_MUNICIPIO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DIR_DRECCIONES_MUNICIPIO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DIR_DRECCIONES] DROP CONSTRAINT FK_SGD_DIR_DRECCIONES_MUNICIPIO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_OEM_OEMPRESAS_MUNICIPIO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_OEM_OEMPRESAS] DROP CONSTRAINT FK_SGD_OEM_OEMPRESAS_MUNICIPIO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_CAUX_SGD_DCAU]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_CAUX_CAUSALES] DROP CONSTRAINT FK_SGD_CAUX_SGD_DCAU
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DDCA_SGD_DCAU]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DDCA_DDSGRGDO] DROP CONSTRAINT FK_SGD_DDCA_SGD_DCAU
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADICADO_CENTRO_POBLADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADICADO_CENTRO_POBLADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DIR_SGD_CIU]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DIR_DRECCIONES] DROP CONSTRAINT FK_SGD_DIR_SGD_CIU
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_CAUX_SGD_DDCA]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_CAUX_CAUSALES] DROP CONSTRAINT FK_SGD_CAUX_SGD_DDCA
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_MTD_SGD_MTD]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_MTD_MATRIZ_DOC] DROP CONSTRAINT FK_SGD_MTD_SGD_MTD
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DIR_SGD_OEM]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DIR_DRECCIONES] DROP CONSTRAINT FK_SGD_DIR_SGD_OEM
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADICADO_SGD_TMA]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADICADO_SGD_TMA
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANEX_FK_ANEX_CREADOR]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[ANEXOS] DROP CONSTRAINT ANEX_FK_ANEX_CREADOR
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_PRESTAMO_FK_PRES_U_USUARIO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[PRESTAMO] DROP CONSTRAINT FK_PRESTAMO_FK_PRES_U_USUARIO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_PRESTAMO_FK_USUA_P_USUARIO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[PRESTAMO] DROP CONSTRAINT FK_PRESTAMO_FK_USUA_P_USUARIO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADICADO_SGD_MTD]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[RADICADO] DROP CONSTRAINT FK_RADICADO_SGD_MTD
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_HMTD_SGD_MTD]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_HMTD_HISMATDOC] DROP CONSTRAINT FK_SGD_HMTD_SGD_MTD
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANEX_FK_ANEX_RADI_NUME]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[ANEXOS] DROP CONSTRAINT ANEX_FK_ANEX_RADI_NUME
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_RADI_HIST]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[HIST_EVENTOS] DROP CONSTRAINT FK_RADI_HIST
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_INFO_RADI]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[INFORMADOS] DROP CONSTRAINT FK_INFO_RADI
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_PRESTAMO_FK_PRES_R_RADICADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[PRESTAMO] DROP CONSTRAINT FK_PRESTAMO_FK_PRES_R_RADICADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_CAUX_RADICADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_CAUX_CAUSALES] DROP CONSTRAINT FK_SGD_CAUX_RADICADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_DIR_RADICADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_DIR_DRECCIONES] DROP CONSTRAINT FK_SGD_DIR_RADICADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_EXP_RADICADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_EXP_EXPEDIENTE] DROP CONSTRAINT FK_SGD_EXP_RADICADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_HMTD_RADICADO]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_HMTD_HISMATDOC] DROP CONSTRAINT FK_SGD_HMTD_RADICADO
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[FK_SGD_ANAR_ANEXOS]') and OBJECTPROPERTY(id, N'IsForeignKey') = 1)
ALTER TABLE [dbo].[SGD_ANAR_ANEXARG] DROP CONSTRAINT FK_SGD_ANAR_ANEXOS
GO

/****** Object:  Table [dbo].[SGD_ANAR_ANEXARG]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ANAR_ANEXARG]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ANAR_ANEXARG]
GO

/****** Object:  Table [dbo].[ANEXOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANEXOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[ANEXOS]
GO

/****** Object:  Table [dbo].[HIST_EVENTOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[HIST_EVENTOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[HIST_EVENTOS]
GO

/****** Object:  Table [dbo].[INFORMADOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[INFORMADOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[INFORMADOS]
GO

/****** Object:  Table [dbo].[PRESTAMO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[PRESTAMO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[PRESTAMO]
GO

/****** Object:  Table [dbo].[SGD_CAUX_CAUSALES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_CAUX_CAUSALES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_CAUX_CAUSALES]
GO

/****** Object:  Table [dbo].[SGD_DIR_DRECCIONES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DIR_DRECCIONES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DIR_DRECCIONES]
GO

/****** Object:  Table [dbo].[SGD_EXP_EXPEDIENTE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_EXP_EXPEDIENTE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_EXP_EXPEDIENTE]
GO

/****** Object:  Table [dbo].[SGD_HMTD_HISMATDOC]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_HMTD_HISMATDOC]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_HMTD_HISMATDOC]
GO

/****** Object:  Table [dbo].[RADICADO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[RADICADO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[RADICADO]
GO

/****** Object:  Table [dbo].[SGD_MTD_MATRIZ_DOC]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_MTD_MATRIZ_DOC]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_MTD_MATRIZ_DOC]
GO

/****** Object:  Table [dbo].[CARPETA_PER]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[CARPETA_PER]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[CARPETA_PER]
GO

/****** Object:  Table [dbo].[CENTRO_POBLADO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[CENTRO_POBLADO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[CENTRO_POBLADO]
GO

/****** Object:  Table [dbo].[DEPENDENCIA_VISIBILIDAD]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[DEPENDENCIA_VISIBILIDAD]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[DEPENDENCIA_VISIBILIDAD]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_DEPE_HISTORICO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ADMIN_DEPE_HISTORICO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ADMIN_DEPE_HISTORICO]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_USUA_HISTORICO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ADMIN_USUA_HISTORICO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ADMIN_USUA_HISTORICO]
GO

/****** Object:  Table [dbo].[SGD_CIU_CIUDADANO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_CIU_CIUDADANO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_CIU_CIUDADANO]
GO

/****** Object:  Table [dbo].[SGD_DDCA_DDSGRGDO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DDCA_DDSGRGDO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DDCA_DDSGRGDO]
GO

/****** Object:  Table [dbo].[SGD_MAT_MATRIZ]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_MAT_MATRIZ]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_MAT_MATRIZ]
GO

/****** Object:  Table [dbo].[SGD_OEM_OEMPRESAS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_OEM_OEMPRESAS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_OEM_OEMPRESAS]
GO

/****** Object:  Table [dbo].[SGD_PNUN_PROCENUM]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_PNUN_PROCENUM]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_PNUN_PROCENUM]
GO

/****** Object:  Table [dbo].[SGD_TMA_TEMAS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TMA_TEMAS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TMA_TEMAS]
GO

/****** Object:  Table [dbo].[USUARIO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[USUARIO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[USUARIO]
GO

/****** Object:  Table [dbo].[DEPENDENCIA]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[DEPENDENCIA]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[DEPENDENCIA]
GO

/****** Object:  Table [dbo].[MUNICIPIO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[MUNICIPIO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[MUNICIPIO]
GO

/****** Object:  Table [dbo].[SGD_COB_CAMPOBLIGA]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_COB_CAMPOBLIGA]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_COB_CAMPOBLIGA]
GO

/****** Object:  Table [dbo].[SGD_DCAU_CAUSAL]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DCAU_CAUSAL]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DCAU_CAUSAL]
GO

/****** Object:  Table [dbo].[SGD_DNUFE_DOCNUFE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DNUFE_DOCNUFE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DNUFE_DOCNUFE]
GO

/****** Object:  Table [dbo].[ANEXOS_TIPO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ANEXOS_TIPO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[ANEXOS_TIPO]
GO

/****** Object:  Table [dbo].[BODEGA_EMPRESAS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[BODEGA_EMPRESAS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[BODEGA_EMPRESAS]
GO

/****** Object:  Table [dbo].[CARPETA]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[CARPETA]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[CARPETA]
GO

/****** Object:  Table [dbo].[DEPARTAMENTO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[DEPARTAMENTO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[DEPARTAMENTO]
GO

/****** Object:  Table [dbo].[ENCUESTA]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ENCUESTA]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[ENCUESTA]
GO

/****** Object:  Table [dbo].[ESTADO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[ESTADO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[ESTADO]
GO

/****** Object:  Table [dbo].[MEDIO_RECEPCION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[MEDIO_RECEPCION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[MEDIO_RECEPCION]
GO

/****** Object:  Table [dbo].[PAR_SERV_SERVICIOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[PAR_SERV_SERVICIOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[PAR_SERV_SERVICIOS]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_OBSERVACION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ADMIN_OBSERVACION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ADMIN_OBSERVACION]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_USUA_PERFILES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ADMIN_USUA_PERFILES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ADMIN_USUA_PERFILES]
GO

/****** Object:  Table [dbo].[SGD_ANU_ANULADOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ANU_ANULADOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ANU_ANULADOS]
GO

/****** Object:  Table [dbo].[SGD_APER_ADMINPERFILES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_APER_ADMINPERFILES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_APER_ADMINPERFILES]
GO

/****** Object:  Table [dbo].[SGD_ARGD_ARGDOC]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ARGD_ARGDOC]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ARGD_ARGDOC]
GO

/****** Object:  Table [dbo].[SGD_ARGUP_ARGUDOCTOP]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ARGUP_ARGUDOCTOP]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ARGUP_ARGUDOCTOP]
GO

/****** Object:  Table [dbo].[SGD_ARG_PLIEGO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ARG_PLIEGO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ARG_PLIEGO]
GO

/****** Object:  Table [dbo].[SGD_CAU_CAUSAL]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_CAU_CAUSAL]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_CAU_CAUSAL]
GO

/****** Object:  Table [dbo].[SGD_CLTA_CLSTARIF]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_CLTA_CLSTARIF]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_CLTA_CLSTARIF]
GO

/****** Object:  Table [dbo].[SGD_DEF_CONTINENTES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DEF_CONTINENTES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DEF_CONTINENTES]
GO

/****** Object:  Table [dbo].[SGD_DEF_PAISES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DEF_PAISES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DEF_PAISES]
GO

/****** Object:  Table [dbo].[SGD_DEVE_DEV_ENVIO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_DEVE_DEV_ENVIO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_DEVE_DEV_ENVIO]
GO

/****** Object:  Table [dbo].[SGD_EANU_ESTANULACION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_EANU_ESTANULACION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_EANU_ESTANULACION]
GO

/****** Object:  Table [dbo].[SGD_ENT_ENTIDADES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ENT_ENTIDADES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ENT_ENTIDADES]
GO

/****** Object:  Table [dbo].[SGD_ENVE_ENVIOESPECIAL]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_ENVE_ENVIOESPECIAL]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_ENVE_ENVIOESPECIAL]
GO

/****** Object:  Table [dbo].[SGD_FENV_FRMENVIO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_FENV_FRMENVIO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_FENV_FRMENVIO]
GO

/****** Object:  Table [dbo].[SGD_FLD_FLUJODOC]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_FLD_FLUJODOC]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_FLD_FLUJODOC]
GO

/****** Object:  Table [dbo].[SGD_FUN_FUNCIONES]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_FUN_FUNCIONES]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_FUN_FUNCIONES]
GO

/****** Object:  Table [dbo].[SGD_MPES_MDDPESO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_MPES_MDDPESO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_MPES_MDDPESO]
GO

/****** Object:  Table [dbo].[SGD_NOT_NOTIFICACION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_NOT_NOTIFICACION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_NOT_NOTIFICACION]
GO

/****** Object:  Table [dbo].[SGD_PANU_PERANULADOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_PANU_PERANULADOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_PANU_PERANULADOS]
GO

/****** Object:  Table [dbo].[SGD_PNUFE_PROCNUMFE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_PNUFE_PROCNUMFE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_PNUFE_PROCNUMFE]
GO

/****** Object:  Table [dbo].[SGD_PRC_PROCESO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_PRC_PROCESO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_PRC_PROCESO]
GO

/****** Object:  Table [dbo].[SGD_PRD_PRCDMENTOS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_PRD_PRCDMENTOS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_PRD_PRCDMENTOS]
GO

/****** Object:  Table [dbo].[SGD_RENV_REGENVIO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_RENV_REGENVIO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_RENV_REGENVIO]
GO

/****** Object:  Table [dbo].[SGD_RMR_RADMASIVRE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_RMR_RADMASIVRE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_RMR_RADMASIVRE]
GO

/****** Object:  Table [dbo].[SGD_SED_SEDE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_SED_SEDE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_SED_SEDE]
GO

/****** Object:  Table [dbo].[SGD_SENUF_SECNUMFE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_SENUF_SECNUMFE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_SENUF_SECNUMFE]
GO

/****** Object:  Table [dbo].[SGD_TAR_TARIFAS]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TAR_TARIFAS]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TAR_TARIFAS]
GO

/****** Object:  Table [dbo].[SGD_TIDM_TIDOCMASIVA]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TIDM_TIDOCMASIVA]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TIDM_TIDOCMASIVA]
GO

/****** Object:  Table [dbo].[SGD_TID_TIPDECISION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TID_TIPDECISION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TID_TIPDECISION]
GO

/****** Object:  Table [dbo].[SGD_TIP3_TIPOTERCERO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TIP3_TIPOTERCERO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TIP3_TIPOTERCERO]
GO

/****** Object:  Table [dbo].[SGD_TPR_TPDCUMENTO]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TPR_TPDCUMENTO]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TPR_TPDCUMENTO]
GO

/****** Object:  Table [dbo].[SGD_TRAD_TIPORAD]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TRAD_TIPORAD]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TRAD_TIPORAD]
GO

/****** Object:  Table [dbo].[SGD_TRES_TPRESOLUCION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TRES_TPRESOLUCION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TRES_TPRESOLUCION]
GO

/****** Object:  Table [dbo].[SGD_TTR_TRANSACCION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[SGD_TTR_TRANSACCION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[SGD_TTR_TRANSACCION]
GO

/****** Object:  Table [dbo].[TIPO_DOC_IDENTIFICACION]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[TIPO_DOC_IDENTIFICACION]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[TIPO_DOC_IDENTIFICACION]
GO

/****** Object:  Table [dbo].[TIPO_REMITENTE]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[TIPO_REMITENTE]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[TIPO_REMITENTE]
GO

/****** Object:  Table [dbo].[UBICACION_FISICA]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[UBICACION_FISICA]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[UBICACION_FISICA]
GO

/****** Object:  Table [dbo].[entidades]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[entidades]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[entidades]
GO

/****** Object:  Table [dbo].[sec_ciu_ciudadano]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[sec_ciu_ciudadano]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[sec_ciu_ciudadano]
GO

/****** Object:  Table [dbo].[sec_dir_direcciones]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[sec_dir_direcciones]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[sec_dir_direcciones]
GO

/****** Object:  Table [dbo].[sec_oem_oempresas]    Script Date: 28/01/2007 01:55:34 p.m. ******/
if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[sec_oem_oempresas]') and OBJECTPROPERTY(id, N'IsUserTable') = 1)
drop table [dbo].[sec_oem_oempresas]
GO

/****** Object:  Table [dbo].[ANEXOS_TIPO]    Script Date: 28/01/2007 01:55:38 p.m. ******/
CREATE TABLE [dbo].[ANEXOS_TIPO] (
	[ANEX_TIPO_CODI] [numeric](4, 0) NOT NULL ,
	[ANEX_TIPO_EXT] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ANEX_TIPO_DESC] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[BODEGA_EMPRESAS]    Script Date: 28/01/2007 01:55:39 p.m. ******/
CREATE TABLE [dbo].[BODEGA_EMPRESAS] (
	[NUIR] [varchar] (13) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[NOMBRE_DE_LA_EMPRESA] [varchar] (160) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[NIT_DE_LA_EMPRESA] [varchar] (80) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SIGLA_DE_LA_EMPRESA] [varchar] (80) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[DIRECCION] [varchar] (80) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[CODIGO_DEL_DEPARTAMENTO] [numeric](2, 0) NULL ,
	[CODIGO_DEL_MUNICIPIO] [numeric](3, 0) NULL ,
	[TELEFONO_1] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[TELEFONO_2] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[EMAIL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[NOMBRE_REP_LEGAL] [varchar] (75) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[CARGO_REP_LEGAL] [numeric](2, 0) NULL ,
	[IDENTIFICADOR_EMPRESA] [int] IDENTITY (1, 1) NOT NULL ,
	[ARE_ESP_SECUE] [numeric](18, 0) NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[CARPETA]    Script Date: 28/01/2007 01:55:39 p.m. ******/
CREATE TABLE [dbo].[CARPETA] (
	[CARP_CODI] [numeric](2, 0) NOT NULL ,
	[CARP_DESC] [varchar] (80) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[DEPARTAMENTO]    Script Date: 28/01/2007 01:55:39 p.m. ******/
CREATE TABLE [dbo].[DEPARTAMENTO] (
	[DPTO_CODI] [int] NOT NULL ,
	[DPTO_NOMB] [varchar] (70) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[DPTO_NOMB_ANTERIOR] [varchar] (70) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[id_pais] [smallint] NOT NULL ,
	[id_cont] [tinyint] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[ENCUESTA]    Script Date: 28/01/2007 01:55:39 p.m. ******/
CREATE TABLE [dbo].[ENCUESTA] (
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[FECHA] [datetime] NULL ,
	[P1] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P2] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P3] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P4] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P5] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P6] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P7] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P7_CUAL] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P8] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P9] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P10] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P11] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P12] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P13] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P14] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P15] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P16] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P17] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P18] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P19] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P20] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P20_CUAL] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P21] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P22] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P23] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P24] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[P25] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[ESTADO]    Script Date: 28/01/2007 01:55:39 p.m. ******/
CREATE TABLE [dbo].[ESTADO] (
	[ESTA_CODI] [numeric](2, 0) NOT NULL ,
	[ESTA_DESC] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[MEDIO_RECEPCION]    Script Date: 28/01/2007 01:55:40 p.m. ******/
CREATE TABLE [dbo].[MEDIO_RECEPCION] (
	[MREC_CODI] [numeric](2, 0) NOT NULL ,
	[MREC_DESC] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[PAR_SERV_SERVICIOS]    Script Date: 28/01/2007 01:55:40 p.m. ******/
CREATE TABLE [dbo].[PAR_SERV_SERVICIOS] (
	[PAR_SERV_SECUE] [numeric](8, 0) NOT NULL ,
	[PAR_SERV_CODIGO] [varchar] (5) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[PAR_SERV_NOMBRE] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[PAR_SERV_ESTADO] [varchar] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO]    Script Date: 28/01/2007 01:55:41 p.m. ******/
CREATE TABLE [dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO] (
	[CODIGO_ESTADO] [numeric](18, 0) IDENTITY (1, 1) NOT NULL ,
	[DESCRIPCION_ESTADO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_OBSERVACION]    Script Date: 28/01/2007 01:55:41 p.m. ******/
CREATE TABLE [dbo].[SGD_ADMIN_OBSERVACION] (
	[CODIGO_OBSERVACION] [numeric](18, 0) IDENTITY (1, 1) NOT NULL ,
	[DESCRIPCION_OBSERVACION] [varchar] (500) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_USUA_PERFILES]    Script Date: 28/01/2007 01:55:41 p.m. ******/
CREATE TABLE [dbo].[SGD_ADMIN_USUA_PERFILES] (
	[CODIGO_PERFIL] [numeric](18, 0) IDENTITY (1, 1) NOT NULL ,
	[DESCRIPCION_PERFIL] [varchar] (200) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ANU_ANULADOS]    Script Date: 28/01/2007 01:55:41 p.m. ******/
CREATE TABLE [dbo].[SGD_ANU_ANULADOS] (
	[SGD_ANU_ID] [numeric](4, 0) NULL ,
	[SGD_ANU_DESC] [varchar] (250) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_NUME_RADI] [numeric](18, 0) NULL ,
	[SGD_EANU_CODI] [numeric](4, 0) NULL ,
	[SGD_ANU_SOL_FECH] [datetime] NULL ,
	[SGD_ANU_FECH] [datetime] NULL ,
	[DEPE_CODI] [numeric](3, 0) NULL ,
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_CODI] [numeric](4, 0) NULL ,
	[DEPE_CODI_ANU] [numeric](3, 0) NULL ,
	[USUA_DOC_ANU] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_CODI_ANU] [numeric](4, 0) NULL ,
	[USUA_ANU_ACTA] [numeric](8, 0) NULL ,
	[SGD_ANU_PATH_ACTA] [varchar] (200) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TRAD_CODIGO] [numeric](9, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_APER_ADMINPERFILES]    Script Date: 28/01/2007 01:55:41 p.m. ******/
CREATE TABLE [dbo].[SGD_APER_ADMINPERFILES] (
	[SGD_APER_CODIGO] [numeric](18, 0) NOT NULL ,
	[SGD_APER_DESCRIPCION] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ARGD_ARGDOC]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_ARGD_ARGDOC] (
	[SGD_ARGD_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_PNUFE_CODI] [numeric](4, 0) NULL ,
	[SGD_ARGD_TABLA] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ARGD_TCODI] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ARGD_TDES] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ARGD_LLIST] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ARGD_CAMPO] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ARGUP_ARGUDOCTOP]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_ARGUP_ARGUDOCTOP] (
	[SGD_ARGUP_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_ARGUP_DESC] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ARG_PLIEGO]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_ARG_PLIEGO] (
	[SGD_ARG_CODIGO] [numeric](2, 0) NOT NULL ,
	[SGD_ARG_DESC] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_CAU_CAUSAL]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_CAU_CAUSAL] (
	[SGD_CAU_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_CAU_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_CLTA_CLSTARIF]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_CLTA_CLSTARIF] (
	[SGD_FENV_CODIGO] [numeric](5, 0) NULL ,
	[SGD_CLTA_CODSER] [numeric](5, 0) NULL ,
	[SGD_TAR_CODIGO] [numeric](5, 0) NULL ,
	[SGD_CLTA_DESCRIP] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_CLTA_PESDES] [numeric](15, 0) NULL ,
	[SGD_CLTA_PESHAST] [numeric](15, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DEF_CONTINENTES]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_DEF_CONTINENTES] (
	[id_cont] [tinyint] NOT NULL ,
	[nombre_cont] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DEF_PAISES]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_DEF_PAISES] (
	[ID_PAIS] [smallint] NOT NULL ,
	[ID_CONT] [tinyint] NOT NULL ,
	[NOMBRE_PAIS] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ID_GRPPAISES] [tinyint] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DEVE_DEV_ENVIO]    Script Date: 28/01/2007 01:55:42 p.m. ******/
CREATE TABLE [dbo].[SGD_DEVE_DEV_ENVIO] (
	[SGD_DEVE_CODIGO] [numeric](2, 0) NOT NULL ,
	[SGD_DEVE_DESC] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_EANU_ESTANULACION]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_EANU_ESTANULACION] (
	[SGD_EANU_DESC] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EANU_CODI] [numeric](18, 0) NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ENT_ENTIDADES]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_ENT_ENTIDADES] (
	[SGD_ENT_NIT] [varchar] (13) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[SGD_ENT_CODSUC] [varchar] (4) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[SGD_ENT_PIAS] [numeric](5, 0) NULL ,
	[DPTO_CODI] [int] NULL ,
	[MUNI_CODI] [int] NULL ,
	[SGD_ENT_DESCRIP] [varchar] (80) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ENT_DIRECCION] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ENT_TELEFONO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ENVE_ENVIOESPECIAL]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_ENVE_ENVIOESPECIAL] (
	[SGD_FENV_CODIGO] [numeric](4, 0) NULL ,
	[SGD_ENVE_VALORL] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ENVE_VALORN] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ENVE_DESC] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_FENV_FRMENVIO]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_FENV_FRMENVIO] (
	[SGD_FENV_CODIGO] [numeric](5, 0) NOT NULL ,
	[SGD_FENV_DESCRIP] [varchar] (40) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_FLD_FLUJODOC]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_FLD_FLUJODOC] (
	[SGD_FLD_CODIGO] [numeric](3, 0) NULL ,
	[SGD_FLD_DESC] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_CODIGO] [numeric](3, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_FUN_FUNCIONES]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_FUN_FUNCIONES] (
	[SGD_FUN_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_FUN_DESCRIP] [varchar] (530) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_FUN_FECH_INI] [datetime] NULL ,
	[SGD_FUN_FECH_FIN] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_MPES_MDDPESO]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_MPES_MDDPESO] (
	[SGD_MPES_CODIGO] [numeric](5, 0) NOT NULL ,
	[SGD_MPES_DESCRIP] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_NOT_NOTIFICACION]    Script Date: 28/01/2007 01:55:43 p.m. ******/
CREATE TABLE [dbo].[SGD_NOT_NOTIFICACION] (
	[SGD_NOT_CODI] [numeric](18, 0) NOT NULL ,
	[SGD_NOT_DESCRIP] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_PANU_PERANULADOS]    Script Date: 28/01/2007 01:55:44 p.m. ******/
CREATE TABLE [dbo].[SGD_PANU_PERANULADOS] (
	[SGD_PANU_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_PANU_DESC] [varchar] (200) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_PNUFE_PROCNUMFE]    Script Date: 28/01/2007 01:55:44 p.m. ******/
CREATE TABLE [dbo].[SGD_PNUFE_PROCNUMFE] (
	[SGD_PNUFE_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL ,
	[SGD_PNUFE_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_PNUFE_SERIE] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_PRC_PROCESO]    Script Date: 28/01/2007 01:55:44 p.m. ******/
CREATE TABLE [dbo].[SGD_PRC_PROCESO] (
	[SGD_PRC_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_PRC_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_PRC_FECH_INI] [datetime] NULL ,
	[SGD_PRC_FECH_FIN] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_PRD_PRCDMENTOS]    Script Date: 28/01/2007 01:55:44 p.m. ******/
CREATE TABLE [dbo].[SGD_PRD_PRCDMENTOS] (
	[SGD_PRD_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_PRD_DESCRIP] [varchar] (200) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_PRD_FECH_INI] [datetime] NULL ,
	[SGD_PRD_FECH_FIN] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_RENV_REGENVIO]    Script Date: 28/01/2007 01:55:44 p.m. ******/
CREATE TABLE [dbo].[SGD_RENV_REGENVIO] (
	[SGD_RENV_CODIGO] [numeric](6, 0) NOT NULL ,
	[SGD_FENV_CODIGO] [numeric](5, 0) NULL ,
	[SGD_RENV_FECH] [datetime] NULL ,
	[RADI_NUME_SAL] [numeric](14, 0) NULL ,
	[SGD_RENV_DESTINO] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_TELEFONO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_MAIL] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_PESO] [float] NULL ,
	[SGD_RENV_VALOR] [float] NULL ,
	[SGD_RENV_CERTIFICADO] [numeric](1, 0) NULL ,
	[SGD_RENV_ESTADO] [numeric](1, 0) NULL ,
	[USUA_DOC] [numeric](15, 0) NULL ,
	[SGD_RENV_NOMBRE] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_REM_DESTINO] [numeric](1, 0) NULL ,
	[SGD_DIR_CODIGO] [numeric](10, 0) NULL ,
	[SGD_RENV_PLANILLA] [varchar] (8) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_FECH_SAL] [datetime] NULL ,
	[DEPE_CODI] [numeric](5, 0) NULL ,
	[SGD_DIR_TIPO] [numeric](4, 0) NULL ,
	[RADI_NUME_GRUPO] [numeric](14, 0) NULL ,
	[SGD_RENV_DIR] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_DEPTO] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_MPIO] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_TEL] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_CANTIDAD] [numeric](4, 0) NULL ,
	[SGD_RENV_TIPO] [numeric](1, 0) NULL ,
	[SGD_RENV_OBSERVA] [varchar] (200) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_GRUPO] [numeric](14, 0) NULL ,
	[SGD_DEVE_CODIGO] [numeric](2, 0) NULL ,
	[SGD_DEVE_FECH] [datetime] NULL ,
	[SGD_RENV_VALORTOTAL] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_VALISTAMIENTO] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_VDESCUENTO] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_RENV_VADICIONAL] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DEPE_GENERA] [numeric](5, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_RMR_RADMASIVRE]    Script Date: 28/01/2007 01:55:44 p.m. ******/
CREATE TABLE [dbo].[SGD_RMR_RADMASIVRE] (
	[SGD_RMR_GRUPO] [numeric](15, 0) NOT NULL ,
	[SGD_RMR_RADI] [numeric](15, 0) NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_SED_SEDE]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_SED_SEDE] (
	[SGD_SED_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_SED_DESC] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_SENUF_SECNUMFE]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_SENUF_SECNUMFE] (
	[SGD_SENUF_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_PNUFE_CODI] [numeric](4, 0) NULL ,
	[DEPE_CODI] [numeric](5, 0) NULL ,
	[SGD_SENUF_SEC] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TAR_TARIFAS]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_TAR_TARIFAS] (
	[SGD_FENV_CODIGO] [numeric](5, 0) NULL ,
	[SGD_CLTA_CODSER] [numeric](5, 0) NULL ,
	[SGD_TAR_CODIGO] [numeric](5, 0) NULL ,
	[SGD_TAR_VALENV1] [numeric](15, 0) NULL ,
	[SGD_TAR_VALENV2] [numeric](15, 0) NULL ,
	[SGD_TAR_VALENV1G1] [numeric](18, 0) NULL ,
	[SGD_TAR_VALENV2G2] [numeric](18, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TIDM_TIDOCMASIVA]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_TIDM_TIDOCMASIVA] (
	[SGD_TIDM_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_TIDM_DESC] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TID_TIPDECISION]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_TID_TIPDECISION] (
	[SGD_TID_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_TID_DESC] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TIP3_TIPOTERCERO]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_TIP3_TIPOTERCERO] (
	[SGD_TIP3_CODIGO] [numeric](18, 0) NOT NULL ,
	[SGD_DIR_TIPO] [numeric](18, 0) NULL ,
	[SGD_TIP3_NOMBRE] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TIP3_DESC] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TIP3_IMGPESTANA] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_TP1] [numeric](18, 0) NOT NULL ,
	[SGD_TPR_TP2] [numeric](18, 0) NOT NULL
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TPR_TPDCUMENTO]    Script Date: 28/01/2007 01:55:45 p.m. ******/
CREATE TABLE [dbo].[SGD_TPR_TPDCUMENTO] (
	[SGD_TPR_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_TPR_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_TERMINO] [numeric](4, 0) NULL ,
	[SGD_TPR_NUMERA] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_RADICA] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TPR_TPUSO] [numeric] NOT NULL,
	[SGD_TPR_TP1] [numeric](18, 0) NULL ,
	[SGD_TPR_TP2] [numeric](18, 0) NULL,
	[SGD_TPR_ESTADO] [char] null
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TRAD_TIPORAD]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[SGD_TRAD_TIPORAD] (
	[SGD_TRAD_CODIGO] [numeric](2, 0) NOT NULL ,
	[SGD_TRAD_DESCR] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TRAD_ICONO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TRAD_GENRADSAL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TRES_TPRESOLUCION]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[SGD_TRES_TPRESOLUCION] (
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL ,
	[SGD_TRES_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_TRES_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TTR_TRANSACCION]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[SGD_TTR_TRANSACCION] (
	--[#] [float] NOT NULL ,
	[SGD_TTR_CODIGO] [float] NULL ,
	[SGD_TTR_DESCRIP] [nvarchar] (255) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[TIPO_DOC_IDENTIFICACION]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[TIPO_DOC_IDENTIFICACION] (
	[TDID_CODI] [numeric](2, 0) NOT NULL ,
	[TDID_DESC] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[TIPO_REMITENTE]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[TIPO_REMITENTE] (
	[TRTE_CODI] [numeric](2, 0) NOT NULL ,
	[TRTE_DESC] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[UBICACION_FISICA]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[UBICACION_FISICA] (
	[UBIC_DEPE_RADI] [numeric](5, 0) NOT NULL ,
	[UBIC_DEPE_ARCH] [numeric](5, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[entidades]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[entidades] (
	[SGD_OEM_CO] [float] NULL ,
	[TDID_CODI] [float] NULL ,
	[SGD_OEM_OE] [nvarchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_RE] [nvarchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_NI] [nvarchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_SI] [nvarchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[MUNI_CODI] [numeric](4, 0) NULL ,
	[DPTO_CODI] [numeric](4, 0) NULL ,
	[SGD_OEM_DI] [nvarchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_TE] [nvarchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[sec_ciu_ciudadano]    Script Date: 28/01/2007 01:55:46 p.m. ******/
CREATE TABLE [dbo].[sec_ciu_ciudadano] (
	[id] [float] NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[sec_dir_direcciones]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[sec_dir_direcciones] (
	[id] [float] NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[sec_oem_oempresas]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[sec_oem_oempresas] (
	[id] [float] NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[DEPENDENCIA]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[DEPENDENCIA] (
	[DEPE_CODI] [numeric](5, 0) NOT NULL ,
	[DEPE_NOMB] [varchar] (70) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ID_CONT] [smallint] null,
	[id_pais] [smallint] NULL ,
	[DPTO_CODI] [int] NULL ,
	[DEPE_CODI_PADRE] [numeric](5, 0) NULL ,
	[MUNI_CODI] [numeric](4, 0) NULL ,
	[DEPE_CODI_TERRITORIAL] [numeric](4, 0) NULL ,
	[DEP_SIGLA] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[DEP_CENTRAL] [numeric](1, 0) NULL ,
	[DEP_DIRECCION] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[DEPE_NUM_INTERNA] [numeric](4, 0) NULL ,
	[DEPE_NUM_RESOLUCION] [numeric](4, 0) NULL ,
	[DEPE_RAD_TP1] [int] NULL ,
	[DEPE_RAD_TP2] [int] NULL ,
	[DEPE_ESTADO] [smallint] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[MUNICIPIO]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[MUNICIPIO] (
	[MUNI_CODI] [int] NOT NULL ,
	[DPTO_CODI] [int] NOT NULL ,
	[MUNI_NOMB] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[MUNI_NOMB_ANTERIOR] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[id_pais] [smallint] NOT NULL ,
	[id_cont] [tinyint] NOT NULL ,
	[default_muni] [tinyint] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_COB_CAMPOBLIGA]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[SGD_COB_CAMPOBLIGA] (
	[SGD_COB_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_COB_DESC] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_COB_LABEL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TIDM_CODI] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DCAU_CAUSAL]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[SGD_DCAU_CAUSAL] (
	[SGD_DCAU_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_CAU_CODIGO] [numeric](4, 0) NULL ,
	[SGD_DCAU_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DNUFE_DOCNUFE]    Script Date: 28/01/2007 01:55:47 p.m. ******/
CREATE TABLE [dbo].[SGD_DNUFE_DOCNUFE] (
	[SGD_DNUFE_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_PNUFE_CODI] [numeric](4, 0) NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL ,
	[SGD_DNUFE_LABEL] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[TRTE_CODI] [numeric](2, 0) NULL ,
	[SGD_DNUFE_MAIN] [varchar] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DNUFE_PATH] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DNUFE_GERARQ] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ANEX_TIPO_CODI] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[CARPETA_PER]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[CARPETA_PER] (
	[USUA_CODI] [numeric](3, 0) NOT NULL ,
	[DEPE_CODI] [numeric](5, 0) NOT NULL ,
	[NOMB_CARP] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[DESC_CARP] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[CODI_CARP] [numeric](3, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[CENTRO_POBLADO]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[CENTRO_POBLADO] (
	[CPOB_CODI] [int] NOT NULL ,
	[MUNI_CODI] [int] NOT NULL ,
	[DPTO_CODI] [int] NOT NULL ,
	[id_pais] [smallint] NOT NULL ,
	[id_cont] [tinyint] NOT NULL ,
	[CPOB_NOMB] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[CPOB_NOMB_ANTERIOR] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[DEPENDENCIA_VISIBILIDAD]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[DEPENDENCIA_VISIBILIDAD] (
	[CODIGO_VISIBILIDAD] [numeric](18, 0) IDENTITY (1, 1) NOT NULL ,
	[DEPENDENCIA_VISIBLE] [numeric](5, 0) NOT NULL ,
	[DEPENDENCIA_OBSERVA] [numeric](5, 0) NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_DEPE_HISTORICO]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[SGD_ADMIN_DEPE_HISTORICO] (
	[ADMIN_DEPE_HISTORICO_CODIGO] [numeric](20, 0) IDENTITY (1, 1) NOT NULL ,
	[USUARIO_CODIGO_ADMINISTRADOR] [numeric](10, 0) NOT NULL ,
	[DEPENDENCIA_CODIGO_ADMINISTRADOR] [numeric](5, 0) NOT NULL ,
	[USUARIO_DOCUMENTO_ADMINISTRADOR] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[DEPENDENCIA_MODIFICADA] [numeric](5, 0) NOT NULL ,
	[ADMIN_OBSERVACION_CODIGO] [numeric](18, 0) NOT NULL ,
	[ADMIN_FECHA_EVENTO] [datetime] NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ADMIN_USUA_HISTORICO]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[SGD_ADMIN_USUA_HISTORICO] (
	[ADMIN_HISTORICO_CODIGO] [numeric](20, 0) IDENTITY (1, 1) NOT NULL ,
	[USUARIO_CODIGO_ADMINISTRADOR] [numeric](10, 0) NOT NULL ,
	[DEPENDENCIA_CODIGO_ADMINISTRADOR] [numeric](5, 0) NOT NULL ,
	[USUARIO_DOCUMENTO_ADMINISTRADOR] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[USUARIO_CODIGO_MODIFICADO] [numeric](18, 0) NOT NULL ,
	[DEPENDENCIA_CODIGO_MODIFICADO] [numeric](5, 0) NOT NULL ,
	[USUARIO_DOCUMENTO_MODIFICADO] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ADMIN_OBSERVACION_CODIGO] [numeric](18, 0) NOT NULL ,
	[ADMIN_FECHA_EVENTO] [datetime] NOT NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_CIU_CIUDADANO]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[SGD_CIU_CIUDADANO] (
	[TDID_CODI] [numeric](2, 0) NULL ,
	[SGD_CIU_CODIGO] [numeric](18, 0) NOT NULL ,
	[SGD_CIU_NOMBRE] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_CIU_DIRECCION] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_CIU_APELL1] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_CIU_APELL2] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_CIU_TELEFONO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_CIU_EMAIL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[MUNI_CODI] [int] NULL ,
	[DPTO_CODI] [int] NULL ,
	[id_pais] [smallint] NULL ,
	[id_cont] [tinyint] NULL ,
	[SGD_CIU_CEDULA] [varchar] (13) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DDCA_DDSGRGDO]    Script Date: 28/01/2007 01:55:48 p.m. ******/
CREATE TABLE [dbo].[SGD_DDCA_DDSGRGDO] (
	[SGD_DDCA_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_DCAU_CODIGO] [numeric](4, 0) NULL ,
	[PAR_SERV_SECUE] [numeric](8, 0) NULL ,
	[SGD_DDCA_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_MAT_MATRIZ]    Script Date: 28/01/2007 01:55:49 p.m. ******/
CREATE TABLE [dbo].[SGD_MAT_MATRIZ] (
	[SGD_MAT_CODIGO] [numeric](4, 0) NOT NULL ,
	[DEPE_CODI] [numeric](5, 0) NULL ,
	[SGD_FUN_CODIGO] [numeric](4, 0) NULL ,
	[SGD_PRC_CODIGO] [numeric](4, 0) NULL ,
	[SGD_PRD_CODIGO] [numeric](4, 0) NULL ,
	[SGD_MAT_FECH_INI] [datetime] NULL ,
	[SGD_MAT_FECH_FIN] [datetime] NULL ,
	[SGD_MAT_PESO_PRD] [numeric](5, 2) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_OEM_OEMPRESAS]    Script Date: 28/01/2007 01:55:49 p.m. ******/
CREATE TABLE [dbo].[SGD_OEM_OEMPRESAS] (
	[SGD_OEM_CODIGO] [numeric](8, 0) NOT NULL ,
	[TDID_CODI] [numeric](2, 0) NULL ,
	[SGD_OEM_OEMPRESA] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_REP_LEGAL] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_NIT] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_SIGLA] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[MUNI_CODI] [int] NULL ,
	[DPTO_CODI] [int] NULL ,
	[id_pais] [smallint] NULL ,
	[id_cont] [tinyint] NULL ,
	[SGD_OEM_DIRECCION] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_OEM_TELEFONO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[EMAIL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_PNUN_PROCENUM]    Script Date: 28/01/2007 01:55:49 p.m. ******/
CREATE TABLE [dbo].[SGD_PNUN_PROCENUM] (
	[SGD_PNUN_CODI] [numeric](4, 0) NOT NULL ,
	[SGD_PNUFE_CODI] [numeric](4, 0) NULL ,
	[DEPE_CODI] [numeric](5, 0) NULL ,
	[SGD_PNUN_PREPONE] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_TMA_TEMAS]    Script Date: 28/01/2007 01:55:49 p.m. ******/
CREATE TABLE [dbo].[SGD_TMA_TEMAS] (
	[SGD_TMA_CODIGO] [numeric](4, 0) NOT NULL ,
	[DEPE_CODI] [numeric](5, 0) NULL ,
	[SGD_PRC_CODIGO] [numeric](4, 0) NULL ,
	[SGD_TMA_DESCRIP] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[USUARIO]    Script Date: 28/01/2007 01:55:49 p.m. ******/
CREATE TABLE [dbo].[USUARIO] (
	[USUA_CODI] [numeric](10, 0) NOT NULL ,
	[DEPE_CODI] [numeric](5, 0) NOT NULL ,
	[USUA_LOGIN] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[USUA_FECH_CREA] [datetime] NOT NULL ,
	[USUA_PASW] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[USUA_ESTA] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[USUA_NOMB] [varchar] (45) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[PERM_RADI] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_ADMIN] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_NUEVO] [char] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[CODI_NIVEL] [numeric](2, 0) NULL ,
	[USUA_SESION] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_FECH_SESION] [datetime] NULL ,
	[USUA_EXT] [numeric](4, 0) NULL ,
	[USUA_NACIM] [datetime] NULL ,
	[USUA_EMAIL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_AT] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_PISO] [numeric](2, 0) NULL ,
	[USUA_ADMIN_ARCHIVO] [numeric](1, 0) NULL ,
	[USUA_MASIVA] [numeric](1, 0) NULL ,
	[USUA_PERM_DEV] [numeric](1, 0) NULL ,
	[USUA_PERM_NUMERA_RES] [varchar] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_PERM_NUMERADOC] [numeric](1, 0) NULL ,
	[SGD_PANU_CODI] [numeric](4, 0) NULL ,
	[USUA_PRAD_TP1] [int] NULL ,
	[USUA_PRAD_TP2] [int] NULL ,
	[ENVIO_CORREO] [numeric](18, 0) NULL ,
	[USUA_PERM_MODIFICA] [numeric](18, 0) NULL ,
	[USUA_PERM_ENVIOS] [numeric](18, 0) NULL ,
	[USUA_PERM_IMPRESION] [numeric](18, 0) NULL ,
	[SGD_APER_PERFILES] [numeric](18, 0) NOT NULL ,
	[USUARIO_PUBLICO] [int] NOT NULL ,
	[USUARIO_REASIGNAR] [int] NOT NULL ,
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_MTD_MATRIZ_DOC]    Script Date: 28/01/2007 01:55:50 p.m. ******/
CREATE TABLE [dbo].[SGD_MTD_MATRIZ_DOC] (
	[SGD_MTD_CODIGO] [numeric](4, 0) NOT NULL ,
	[SGD_MAT_CODIGO] [numeric](4, 0) NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[RADICADO]    Script Date: 28/01/2007 01:55:50 p.m. ******/
CREATE TABLE [dbo].[RADICADO] (
	[RADI_NUME_RADI] [numeric](15, 0) NOT NULL ,
	[RADI_FECH_RADI] [datetime] NOT NULL ,
	[TDOC_CODI] [numeric](4, 0) NOT NULL ,
	[TRTE_CODI] [numeric](2, 0) NULL ,
	[MREC_CODI] [numeric](2, 0) NULL ,
	[EESP_CODI] [numeric](10, 0) NULL ,
	[EOTRA_CODI] [numeric](10, 0) NULL ,
	[RADI_TIPO_EMPR] [varchar] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_FECH_OFIC] [datetime] NULL ,
	[TDID_CODI] [numeric](2, 0) NULL ,
	[RADI_NUME_IDEN] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_NOMB] [varchar] (90) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_PRIM_APEL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_SEGU_APEL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_PAIS] [varchar] (70) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[MUNI_CODI] [int] NULL ,
	[CPOB_CODI] [int] NULL ,
	[CARP_CODI] [numeric](3, 0) NULL ,
	[ESTA_CODI] [numeric](2, 0) NULL ,
	[DPTO_CODI] [numeric](2, 0) NULL ,
	[CEN_MUNI_CODI] [int] NULL ,
	[CEN_DPTO_CODI] [int] NULL ,
	[id_pais] [smallint] NULL ,
	[id_cont] [tinyint] NULL ,
	[RADI_DIRE_CORR] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_TELE_CONT] [numeric](15, 0) NULL ,
	[RADI_NUME_HOJA] [numeric](3, 0) NULL ,
	[RADI_DESC_ANEX] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_NUME_DERI] [numeric](15, 0) NULL ,
	[RADI_PATH] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_USUA_ACTU] [numeric](10, 0) NULL ,
	[RADI_DEPE_ACTU] [numeric](5, 0) NULL ,
	[RADI_FECH_ASIG] [datetime] NULL ,
	[RADI_ARCH1] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_ARCH2] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_ARCH3] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_ARCH4] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RA_ASUN] [varchar] (350) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_USU_ANTE] [varchar] (45) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_DEPE_RADI] [numeric](3, 0) NULL ,
	[RADI_REM] [varchar] (60) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_USUA_RADI] [numeric](10, 0) NULL ,
	[CODI_NIVEL] [numeric](2, 0) NULL ,
	[FLAG_NIVEL] [numeric](18, 0) NULL ,
	[CARP_PER] [numeric](1, 0) NULL ,
	[RADI_LEIDO] [numeric](1, 0) NULL ,
	[RADI_CUENTAI] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[RADI_TIPO_DERI] [numeric](2, 0) NULL ,
	[LISTO] [varchar] (2) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TMA_CODIGO] [numeric](4, 0) NULL ,
	[SGD_MTD_CODIGO] [numeric](4, 0) NULL ,
	[PAR_SERV_SECUE] [numeric](8, 0) NULL ,
	[SGD_FLD_CODIGO] [numeric](3, 0) NULL ,
	[RADI_AGEND] [numeric](1, 0) NULL ,
	[RADI_FECH_AGEND] [datetime] NULL ,
	[RADI_FECH_DOC] [datetime] NULL ,
	[SGD_DOC_SECUENCIA] [numeric](15, 0) NULL ,
	[SGD_PNUFE_CODI] [numeric](4, 0) NULL ,
	[SGD_EANU_CODIGO] [numeric](1, 0) NULL ,
	[SGD_NOT_CODI] [numeric](18, 0) NULL ,
	[RADI_FECH_NOTIFf] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[ANEXOS]    Script Date: 28/01/2007 01:55:50 p.m. ******/
CREATE TABLE [dbo].[ANEXOS] (
	[ANEX_RADI_NUME] [numeric](15, 0) NOT NULL ,
	[ANEX_CODIGO] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ANEX_TIPO] [numeric](4, 0) NOT NULL ,
	[ANEX_TAMANO] [numeric](18, 0) NULL ,
	[ANEX_SOLO_LECT] [varchar] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ANEX_CREADOR] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ANEX_DESC] [varchar] (512) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ANEX_NUMERO] [numeric](5, 0) NOT NULL ,
	[ANEX_NOMB_ARCHIVO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ANEX_BORRADO] [varchar] (1) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[ANEX_ORIGEN] [numeric](1, 0) NULL ,
	[ANEX_UBIC] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ANEX_SALIDA] [numeric](1, 0) NULL ,
	[RADI_NUME_SALIDA] [numeric](15, 0) NULL ,
	[ANEX_RADI_FECH] [datetime] NULL ,
	[ANEX_ESTADO] [numeric](1, 0) NULL ,
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_REM_DESTINO] [numeric](1, 0) NULL ,
	[ANEX_FECH_ENVIO] [datetime] NULL ,
	[SGD_DIR_TIPO] [numeric](4, 0) NULL ,
	[ANEX_FECH_IMPRES] [datetime] NULL ,
	[ANEX_DEPE_CREADOR] [numeric](4, 0) NULL ,
	[SGD_DOC_SECUENCIA] [numeric](15, 0) NULL ,
	[SGD_DOC_PADRE] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ARG_CODIGO] [numeric](2, 0) NULL ,
	[SGD_TPR_CODIGO] [numeric](4, 0) NULL ,
	[SGD_DEVE_CODIGO] [numeric](2, 0) NULL ,
	[SGD_DEVE_FECH] [datetime] NULL ,
	[SGD_FECH_IMPRES] [datetime] NULL ,
	[ANEX_FECH_ANEX] [datetime] NULL ,
	[ANEX_DEPE_CODI] [varchar] (3) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_PNUFE_CODI] [numeric](4, 0) NULL ,
	[SGD_DNUFE_CODI] [numeric](4, 0) NULL ,
	[ANEX_USUDOC_CREADOR] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_FECH_DOC] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[HIST_EVENTOS]    Script Date: 28/01/2007 01:55:51 p.m. ******/
CREATE TABLE [dbo].[HIST_EVENTOS] (
	[DEPE_CODI] [numeric](5, 0) NOT NULL ,
	[HIST_FECH] [datetime] NOT NULL ,
	[USUA_CODI] [numeric](10, 0) NOT NULL ,
	[RADI_NUME_RADI] [numeric](15, 0) NOT NULL ,
	[HIST_OBSE] [varchar] (600) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[USUA_CODI_DEST] [numeric](10, 0) NULL ,
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[USUA_DOC_OLD] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TTR_CODIGO] [numeric](3, 0) NULL ,
	[HIST_USUA_AUTOR] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[HIST_DOC_DEST] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[DEPE_CODI_DEST] [numeric](3, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[INFORMADOS]    Script Date: 28/01/2007 01:55:51 p.m. ******/
CREATE TABLE [dbo].[INFORMADOS] (
	[RADI_NUME_RADI] [numeric](15, 0) NOT NULL ,
	[USUA_CODI] [numeric](10, 0) NOT NULL ,
	[DEPE_CODI] [numeric](3, 0) NOT NULL ,
	[INFO_DESC] [varchar] (600) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[INFO_FECH] [datetime] NOT NULL ,
	[INFO_LEIDO] [numeric](1, 0) NULL ,
	[USUA_CODI_INFO] [numeric](3, 0) NULL ,
	[INFO_CODI] [numeric](10, 0) NULL ,
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[PRESTAMO]    Script Date: 28/01/2007 01:55:51 p.m. ******/
CREATE TABLE [dbo].[PRESTAMO] (
	[PRES_ID] [numeric](10, 0) NOT NULL ,
	[RADI_NUME_RADI] [numeric](15, 0) NOT NULL ,
	[USUA_LOGIN_ACTU] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[DEPE_CODI] [numeric](5, 0) NOT NULL ,
	[USUA_LOGIN_PRES] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[PRES_DESC] [varchar] (200) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[PRES_FECH_PRES] [datetime] NULL ,
	[PRES_FECH_DEVO] [datetime] NULL ,
	[PRES_FECH_PEDI] [datetime] NOT NULL ,
	[PRES_ESTADO] [numeric](2, 0) NULL ,
	[PRES_REQUERIMIENTO] [numeric](2, 0) NULL ,
	[PRES_DEPE_ARCH] [numeric](5, 0) NULL ,
	[PRES_FECH_VENC] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_CAUX_CAUSALES]    Script Date: 28/01/2007 01:55:51 p.m. ******/
CREATE TABLE [dbo].[SGD_CAUX_CAUSALES] (
	[SGD_CAUX_CODIGO] [numeric](10, 0) NOT NULL ,
	[RADI_NUME_RADI] [numeric](15, 0) NULL ,
	[SGD_DCAU_CODIGO] [numeric](4, 0) NULL ,
	[SGD_DDCA_CODIGO] [numeric](4, 0) NULL ,
	[SGD_CAUX_FECHA] [datetime] NULL ,
	[USUA_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_DIR_DRECCIONES]    Script Date: 28/01/2007 01:55:51 p.m. ******/
CREATE TABLE [dbo].[SGD_DIR_DRECCIONES] (
	[SGD_DIR_CODIGO] [numeric](10, 0) NOT NULL ,
	[SGD_DIR_TIPO] [numeric](4, 0) NOT NULL ,
	[SGD_OEM_CODIGO] [numeric](8, 0) NULL ,
	[SGD_CIU_CODIGO] [numeric](18, 0) NULL ,
	[RADI_NUME_RADI] [numeric](15, 0) NULL ,
	[SGD_ESP_CODI] [numeric](5, 0) NULL ,
	[MUNI_CODI] [int] NULL ,
	[DPTO_CODI] [int] NULL ,
	[id_pais] [smallint] NULL ,
	[id_cont] [tinyint] NULL ,
	[SGD_DIR_DIRECCION] [varchar] (100) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DIR_TELEFONO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DIR_MAIL] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_SEC_CODIGO] [numeric](13, 0) NULL ,
	[SGD_TEMPORAL_NOMBRE] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[ANEX_CODIGO] [numeric](20, 0) NULL ,
	[SGD_ANEX_CODIGO] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DIR_NOMBRE] [varchar] (60) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DOC_FUN] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_DIR_NOMREMDES] [varchar] (1000) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_TRD_CODIGO] [numeric](18, 0) NULL ,
	[SGD_DIR_TDOC] [numeric](18, 0) NULL ,
	[SGD_DIR_DOC] [varchar] (14) COLLATE SQL_Latin1_General_CP1_CI_AS NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_EXP_EXPEDIENTE]    Script Date: 28/01/2007 01:55:52 p.m. ******/
CREATE TABLE [dbo].[SGD_EXP_EXPEDIENTE] (
	[SGD_EXP_NUMERO] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[RADI_NUME_RADI] [numeric](15, 0) NOT NULL ,
	[SGD_EXP_FECH] [datetime] NULL ,
	[SGD_EXP_FECH_MOD] [datetime] NULL ,
	[DEPE_CODI] [numeric](4, 0) NULL ,
	[USUA_CODI] [numeric](3, 0) NULL ,
	[USUA_DOC] [varchar] (15) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_ESTADO] [numeric](1, 0) NULL ,
	[SGD_EXP_TITULO] [varchar] (50) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_ASUNTO] [varchar] (150) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_CARPETA] [varchar] (30) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_UFISICA] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_ISLA] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_ESTANTE] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_CAJA] [varchar] (10) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_EXP_FECH_ARCH] [datetime] NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_HMTD_HISMATDOC]    Script Date: 28/01/2007 01:55:52 p.m. ******/
CREATE TABLE [dbo].[SGD_HMTD_HISMATDOC] (
	[SGD_HMTD_CODIGO] [numeric](6, 0) NOT NULL ,
	[SGD_HMTD_FECHA] [datetime] NOT NULL ,
	[RADI_NUME_RADI] [numeric](15, 0) NOT NULL ,
	[USUA_CODI] [numeric](10, 0) NOT NULL ,
	[SGD_HMTD_OBSE] [varchar] (600) COLLATE SQL_Latin1_General_CP1_CI_AS NOT NULL ,
	[USUA_DOC] [numeric](13, 0) NULL ,
	[DEPE_CODI] [numeric](5, 0) NULL ,
	[SGD_MTD_CODIGO] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

/****** Object:  Table [dbo].[SGD_ANAR_ANEXARG]    Script Date: 28/01/2007 01:55:52 p.m. ******/
CREATE TABLE [dbo].[SGD_ANAR_ANEXARG] (
	[SGD_ANAR_CODI] [numeric](4, 0) NOT NULL ,
	[ANEX_CODIGO] [varchar] (20) COLLATE SQL_Latin1_General_CP1_CI_AS NULL ,
	[SGD_ARGD_CODI] [numeric](4, 0) NULL ,
	[SGD_ANAR_ARGCOD] [numeric](4, 0) NULL 
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[ANEXOS_TIPO] WITH NOCHECK ADD 
	CONSTRAINT [ANEX_PK_ANEX_TIPO_CODI] PRIMARY KEY  CLUSTERED 
	(
		[ANEX_TIPO_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[BODEGA_EMPRESAS] WITH NOCHECK ADD 
	CONSTRAINT [IND_BODEGA_] PRIMARY KEY  CLUSTERED 
	(
		[IDENTIFICADOR_EMPRESA]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[CARPETA] WITH NOCHECK ADD 
	CONSTRAINT [CARPETAS_PK] PRIMARY KEY  CLUSTERED 
	(
		[CARP_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[DEPARTAMENTO] WITH NOCHECK ADD 
	CONSTRAINT [DEPARTAMENTO_PK] PRIMARY KEY  CLUSTERED 
	(
		[DPTO_CODI],
		[id_pais]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[ENCUESTA] WITH NOCHECK ADD 
	CONSTRAINT [PK_ENCUESTA] PRIMARY KEY  CLUSTERED 
	(
		[USUA_DOC]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[ESTADO] WITH NOCHECK ADD 
	CONSTRAINT [ESTADOS_PK] PRIMARY KEY  CLUSTERED 
	(
		[ESTA_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[MEDIO_RECEPCION] WITH NOCHECK ADD 
	CONSTRAINT [PK_MEDIO_RECEPCION] PRIMARY KEY  CLUSTERED 
	(
		[MREC_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[PAR_SERV_SERVICIOS] WITH NOCHECK ADD 
	CONSTRAINT [PK_PAR_SERV_SERVICIOS] PRIMARY KEY  CLUSTERED 
	(
		[PAR_SERV_SECUE]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO] WITH NOCHECK ADD 
	CONSTRAINT [PK_DEPENDENCIA_ESTADO] PRIMARY KEY  CLUSTERED 
	(
		[CODIGO_ESTADO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ADMIN_OBSERVACION] WITH NOCHECK ADD 
	CONSTRAINT [PK_ADMIN_OBSERVACION] PRIMARY KEY  CLUSTERED 
	(
		[CODIGO_OBSERVACION]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ADMIN_USUA_PERFILES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_ADMIN_PERFILES] PRIMARY KEY  CLUSTERED 
	(
		[CODIGO_PERFIL]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_APER_ADMINPERFILES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_APER_ADMINPERFILES] PRIMARY KEY  CLUSTERED 
	(
		[SGD_APER_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ARGD_ARGDOC] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_ARGD_ARGDOC] PRIMARY KEY  CLUSTERED 
	(
		[SGD_ARGD_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ARGUP_ARGUDOCTOP] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_ARGUP_ARGUDOCTOP] PRIMARY KEY  CLUSTERED 
	(
		[SGD_ARGUP_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_CAU_CAUSAL] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_CAU_CAUSAL] PRIMARY KEY  CLUSTERED 
	(
		[SGD_CAU_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DEF_CONTINENTES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DEF_CONTINENTES] PRIMARY KEY  CLUSTERED 
	(
		[id_cont]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DEF_PAISES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DEF_PAISES] PRIMARY KEY  CLUSTERED 
	(
		[ID_PAIS]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DEVE_DEV_ENVIO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DEVE] PRIMARY KEY  CLUSTERED 
	(
		[SGD_DEVE_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_EANU_ESTANULACION] WITH NOCHECK ADD 
	CONSTRAINT [PK_ESTANULACION] PRIMARY KEY  CLUSTERED 
	(
		[SGD_EANU_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ENT_ENTIDADES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_ENT] PRIMARY KEY  CLUSTERED 
	(
		[SGD_ENT_NIT],
		[SGD_ENT_CODSUC]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_FENV_FRMENVIO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_FENV] PRIMARY KEY  CLUSTERED 
	(
		[SGD_FENV_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_FUN_FUNCIONES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_FUN_FUNCIONES] PRIMARY KEY  CLUSTERED 
	(
		[SGD_FUN_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_MPES_MDDPESO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_MPES] PRIMARY KEY  CLUSTERED 
	(
		[SGD_MPES_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_NOT_NOTIFICACION] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_NOT] PRIMARY KEY  CLUSTERED 
	(
		[SGD_NOT_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_PANU_PERANULADOS] WITH NOCHECK ADD 
	CONSTRAINT [PK_PERANUALDOS] PRIMARY KEY  CLUSTERED 
	(
		[SGD_PANU_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_PNUFE_PROCNUMFE] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_PNUFE_PROCNUMFE] PRIMARY KEY  CLUSTERED 
	(
		[SGD_PNUFE_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_PRC_PROCESO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_PRC_PROCESO] PRIMARY KEY  CLUSTERED 
	(
		[SGD_PRC_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_PRD_PRCDMENTOS] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_PRD_PRCDMENTOS] PRIMARY KEY  CLUSTERED 
	(
		[SGD_PRD_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_RMR_RADMASIVRE] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_RMR_RADMASIVRE] PRIMARY KEY  CLUSTERED 
	(
		[SGD_RMR_GRUPO],
		[SGD_RMR_RADI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_SED_SEDE] WITH NOCHECK ADD 
	CONSTRAINT [SYS_C003508] PRIMARY KEY  CLUSTERED 
	(
		[SGD_SED_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_SENUF_SECNUMFE] WITH NOCHECK ADD 
	CONSTRAINT [SYS_C003511] PRIMARY KEY  CLUSTERED 
	(
		[SGD_SENUF_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_TIDM_TIDOCMASIVA] WITH NOCHECK ADD 
	CONSTRAINT [PK_TDM_TIDOMASIVA] PRIMARY KEY  CLUSTERED 
	(
		[SGD_TIDM_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_TID_TIPDECISION] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_TID_TIPDECISION] PRIMARY KEY  CLUSTERED 
	(
		[SGD_TID_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_TIP3_TIPOTERCERO] WITH NOCHECK ADD 
	CONSTRAINT [PK_sgd_tip3_tipotercero] PRIMARY KEY  CLUSTERED 
	(
		[SGD_TIP3_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_TPR_TPDCUMENTO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_TPR_TPDCUMENTO] PRIMARY KEY  CLUSTERED 
	(
		[SGD_TPR_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_TRES_TPRESOLUCION] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_TRES] PRIMARY KEY  CLUSTERED 
	(
		[SGD_TRES_CODIGO]
	)  ON [PRIMARY] 
GO
/*
ALTER TABLE [dbo].[SGD_TTR_TRANSACCION] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_TTR_TRANSACCION] PRIMARY KEY  CLUSTERED 
	(
		[#]
	)  ON [PRIMARY] 
GO
*/
ALTER TABLE [dbo].[TIPO_DOC_IDENTIFICACION] WITH NOCHECK ADD 
	CONSTRAINT [TIPO_DOC_IDENTIFICACION_PK] PRIMARY KEY  CLUSTERED 
	(
		[TDID_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[TIPO_REMITENTE] WITH NOCHECK ADD 
	CONSTRAINT [TIPO_REMITENTE_PK] PRIMARY KEY  CLUSTERED 
	(
		[TRTE_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[DEPENDENCIA] WITH NOCHECK ADD 
	CONSTRAINT [PK_DEPE] PRIMARY KEY  CLUSTERED 
	(
		[DEPE_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[MUNICIPIO] WITH NOCHECK ADD 
	CONSTRAINT [PK_MUNICIPIO] PRIMARY KEY  CLUSTERED 
	(
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_COB_CAMPOBLIGA] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_COB_CAMPOBLIGA] PRIMARY KEY  CLUSTERED 
	(
		[SGD_COB_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DCAU_CAUSAL] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DCAU_CAUSAL] PRIMARY KEY  CLUSTERED 
	(
		[SGD_DCAU_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DNUFE_DOCNUFE] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DNUFE_DOCNUFE] PRIMARY KEY  CLUSTERED 
	(
		[SGD_DNUFE_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[CENTRO_POBLADO] WITH NOCHECK ADD 
	CONSTRAINT [CENTRO_POBLADO_PK] PRIMARY KEY  CLUSTERED 
	(
		[CPOB_CODI],
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[DEPENDENCIA_VISIBILIDAD] WITH NOCHECK ADD 
	CONSTRAINT [PK_DEPENDENCIA_VISIBILIDAD] PRIMARY KEY  CLUSTERED 
	(
		[CODIGO_VISIBILIDAD]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ADMIN_DEPE_HISTORICO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_ADMIN_DEPE_HISTORICO] PRIMARY KEY  CLUSTERED 
	(
		[ADMIN_DEPE_HISTORICO_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ADMIN_USUA_HISTORICO] WITH NOCHECK ADD 
	CONSTRAINT [PK_ADMIN_HISTORICO] PRIMARY KEY  CLUSTERED 
	(
		[ADMIN_HISTORICO_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_CIU_CIUDADANO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_CIU_CIUDADANO] PRIMARY KEY  CLUSTERED 
	(
		[SGD_CIU_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DDCA_DDSGRGDO] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DDCA_DDSGRGDO] PRIMARY KEY  CLUSTERED 
	(
		[SGD_DDCA_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_MAT_MATRIZ] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_MAT_MATRIZ] PRIMARY KEY  CLUSTERED 
	(
		[SGD_MAT_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_OEM_OEMPRESAS] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_OEM_OEMPRESAS] PRIMARY KEY  CLUSTERED 
	(
		[SGD_OEM_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_PNUN_PROCENUM] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_PNUN_PROCENUM] PRIMARY KEY  CLUSTERED 
	(
		[SGD_PNUN_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_TMA_TEMAS] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_TMA_TEMAS] PRIMARY KEY  CLUSTERED 
	(
		[SGD_TMA_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[USUARIO] WITH NOCHECK ADD 
	CONSTRAINT [USUARIO_PK] PRIMARY KEY  CLUSTERED 
	(
		[USUA_LOGIN]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_MTD_MATRIZ_DOC] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_MTD_MATRIZ_DOC] PRIMARY KEY  CLUSTERED 
	(
		[SGD_MTD_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[RADICADO] WITH NOCHECK ADD 
	CONSTRAINT [RADICADO_PK] PRIMARY KEY  CLUSTERED 
	(
		[RADI_NUME_RADI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[ANEXOS] WITH NOCHECK ADD 
	CONSTRAINT [ANEX_PK_ANEX_CODIGO] PRIMARY KEY  CLUSTERED 
	(
		[ANEX_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[PRESTAMO] WITH NOCHECK ADD 
	CONSTRAINT [PK_PRESTAMO] PRIMARY KEY  CLUSTERED 
	(
		[PRES_ID]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_CAUX_CAUSALES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_CAUX_CAUSALES] PRIMARY KEY  CLUSTERED 
	(
		[SGD_CAUX_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_DIR_DRECCIONES] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_DIR] PRIMARY KEY  CLUSTERED 
	(
		[SGD_DIR_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_EXP_EXPEDIENTE] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_EXP_EXPEDIENTE] PRIMARY KEY  CLUSTERED 
	(
		[SGD_EXP_NUMERO],
		[RADI_NUME_RADI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_HMTD_HISMATDOC] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_HMTD_HISMATDOC] PRIMARY KEY  CLUSTERED 
	(
		[SGD_HMTD_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[SGD_ANAR_ANEXARG] WITH NOCHECK ADD 
	CONSTRAINT [PK_SGD_ANAR_ANEXARG] PRIMARY KEY  CLUSTERED 
	(
		[SGD_ANAR_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[BODEGA_EMPRESAS] WITH NOCHECK ADD 
	CONSTRAINT [DF_BODEGA_EMPRESAS_ARE_ESP_SECUE] DEFAULT (8) FOR [ARE_ESP_SECUE]
GO

ALTER TABLE [dbo].[SGD_RENV_REGENVIO] WITH NOCHECK ADD 
	CONSTRAINT [DF__SGD_RENV___SGD_R__19DFD96B] DEFAULT ('0') FOR [SGD_REM_DESTINO],
	CONSTRAINT [DF_SGD_RENV_REGENVIO_SGD_RENV_PLANILLA] DEFAULT (null) FOR [SGD_RENV_PLANILLA],
	CONSTRAINT [DF__SGD_RENV___SGD_D__1AD3FDA4] DEFAULT ('0') FOR [SGD_DIR_TIPO],
	CONSTRAINT [DF__SGD_RENV___SGD_R__1BC821DD] DEFAULT ('0') FOR [SGD_RENV_CANTIDAD],
	CONSTRAINT [DF__SGD_RENV___SGD_R__1CBC4616] DEFAULT ('0') FOR [SGD_RENV_TIPO],
	CONSTRAINT [DF__SGD_RENV___SGD_R__1DB06A4F] DEFAULT ('0') FOR [SGD_RENV_VALORTOTAL],
	CONSTRAINT [DF__SGD_RENV___SGD_R__1EA48E88] DEFAULT ('0') FOR [SGD_RENV_VALISTAMIENTO],
	CONSTRAINT [DF__SGD_RENV___SGD_R__1F98B2C1] DEFAULT ('0') FOR [SGD_RENV_VDESCUENTO],
	CONSTRAINT [DF__SGD_RENV___SGD_R__208CD6FA] DEFAULT ('0') FOR [SGD_RENV_VADICIONAL]
GO

ALTER TABLE [dbo].[SGD_TIP3_TIPOTERCERO] WITH NOCHECK ADD 
	CONSTRAINT [DF_sgd_tip3_tipotercero_sgd_tpr_tp1] DEFAULT (0) FOR [SGD_TPR_TP1],
	CONSTRAINT [DF_sgd_tip3_tipotercero_sgd_tpr_tp2] DEFAULT (0) FOR [SGD_TPR_TP2]
GO

ALTER TABLE [dbo].[SGD_TPR_TPDCUMENTO] WITH NOCHECK ADD 
	CONSTRAINT [DF_SGD_TPR_TPDCUMENTO_SGD_TPR_TP1] DEFAULT (0) FOR [SGD_TPR_TP1],
	CONSTRAINT [DF__SGD_TPR_T__SGD_T__4222D4EF] DEFAULT ('0') FOR [SGD_TPR_TP2]
GO

/*ALTER TABLE [dbo].[DEPENDENCIA] WITH NOCHECK ADD 
	CONSTRAINT [DF_DEPENDENCIA_DEPENDENCIA_ESTADO] DEFAULT (2) FOR [DEPENDENCIA_ESTADO]
GO*/

ALTER TABLE [dbo].[MUNICIPIO] WITH NOCHECK ADD 
	CONSTRAINT [DF_MUNICIPIO_id_pais] DEFAULT (204) FOR [id_pais],
	CONSTRAINT [DF_MUNICIPIO_id_cont] DEFAULT (1) FOR [id_cont]
GO

ALTER TABLE [dbo].[SGD_MAT_MATRIZ] WITH NOCHECK ADD 
	CONSTRAINT [UK_SGD_MAT] UNIQUE  NONCLUSTERED 
	(
		[DEPE_CODI],
		[SGD_FUN_CODIGO],
		[SGD_PRC_CODIGO],
		[SGD_PRD_CODIGO]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[USUARIO] WITH NOCHECK ADD 
	CONSTRAINT [DF__USUARIO__PERM_RA__6477ECF3] DEFAULT ('0') FOR [PERM_RADI],
	CONSTRAINT [DF__USUARIO__USUA_AD__656C112C] DEFAULT ('0') FOR [USUA_ADMIN],
	CONSTRAINT [DF__USUARIO__USUA_NU__66603565] DEFAULT ('0') FOR [USUA_NUEVO],
	CONSTRAINT [DF__USUARIO__USUA_DO__6754599E] DEFAULT ('0') FOR [USUA_DOC],
	CONSTRAINT [DF__USUARIO__CODI_NI__68487DD7] DEFAULT ('1') FOR [CODI_NIVEL],
	CONSTRAINT [DF__USUARIO__USUA_AD__6C190EBB] DEFAULT ('0') FOR [USUA_ADMIN_ARCHIVO],
	CONSTRAINT [DF__USUARIO__USUA_MA__6D0D32F4] DEFAULT ('0') FOR [USUA_MASIVA],
	CONSTRAINT [DF__USUARIO__USUA_PE__6E01572D] DEFAULT ('0') FOR [USUA_PERM_DEV],
	CONSTRAINT [DF_USUARIO_USUA_PERM_MODIFICA] DEFAULT (0) FOR [USUA_PERM_MODIFICA],
	CONSTRAINT [DF_USUARIO_USUA_PERM_ENVIOS] DEFAULT (0) FOR [USUA_PERM_ENVIOS],
	CONSTRAINT [DF_USUARIO_USUA_PERM_IMPRESION] DEFAULT (0) FOR [USUA_PERM_IMPRESION],
	CONSTRAINT [DF_USUARIO_ADMIN_SISTEMA] DEFAULT (0) FOR [SGD_APER_PERFILES],
	CONSTRAINT [DF_USUARIO_USUARIO_PUBLICO] DEFAULT (0) FOR [USUARIO_PUBLICO],
	CONSTRAINT [DF_USUARIO_USUARIO_REENVIO] DEFAULT (0) FOR [USUARIO_REASIGNAR],
	CONSTRAINT [USUARIO_UK] UNIQUE  NONCLUSTERED 
	(
		[USUA_CODI],
		[DEPE_CODI]
	)  ON [PRIMARY] 
GO

ALTER TABLE [dbo].[RADICADO] WITH NOCHECK ADD 
	CONSTRAINT [DF__RADICADO__CODI_N__4BAC3F29] DEFAULT ('1') FOR [CODI_NIVEL],
	CONSTRAINT [DF__RADICADO__FLAG_N__4CA06362] DEFAULT ('1') FOR [FLAG_NIVEL],
	CONSTRAINT [DF__RADICADO__CARP_P__4D94879B] DEFAULT ('0') FOR [CARP_PER],
	CONSTRAINT [DF__RADICADO__RADI_L__4E88ABD4] DEFAULT ('0') FOR [RADI_LEIDO],
	CONSTRAINT [DF__RADICADO__RADI_T__4F7CD00D] DEFAULT ('0') FOR [RADI_TIPO_DERI],
	CONSTRAINT [DF__RADICADO__SGD_FL__5070F446] DEFAULT ('0') FOR [SGD_FLD_CODIGO]
GO

ALTER TABLE [dbo].[ANEXOS] WITH NOCHECK ADD 
	CONSTRAINT [DF__ANEXOS__ANEX_ORI__59063A47] DEFAULT ('0') FOR [ANEX_ORIGEN],
	CONSTRAINT [DF__ANEXOS__ANEX_SAL__59FA5E80] DEFAULT ('0') FOR [ANEX_SALIDA],
	CONSTRAINT [DF__ANEXOS__ANEX_EST__5AEE82B9] DEFAULT ('0') FOR [ANEX_ESTADO],
	CONSTRAINT [DF__ANEXOS__SGD_REM___5BE2A6F2] DEFAULT ('0') FOR [SGD_REM_DESTINO],
	CONSTRAINT [DF_ANEXOS_SGD_DEVE_CODIGO] DEFAULT (0) FOR [SGD_DEVE_CODIGO]
GO

ALTER TABLE [dbo].[INFORMADOS] WITH NOCHECK ADD 
	CONSTRAINT [DF__INFORMADO__INFO___02084FDA] DEFAULT ('0') FOR [INFO_LEIDO]
GO

ALTER TABLE [dbo].[SGD_EXP_EXPEDIENTE] WITH NOCHECK ADD 
	CONSTRAINT [DF__SGD_EXP_E__SGD_E__14270015] DEFAULT ('0') FOR [SGD_EXP_ESTADO]
GO

 CREATE  INDEX [IND_BODEGA_EMPRESAS_NOMBREEMP] ON [dbo].[BODEGA_EMPRESAS]([NOMBRE_DE_LA_EMPRESA]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_REGENVIO_DEPCODI] ON [dbo].[SGD_RENV_REGENVIO]([DEPE_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_CODIGO] ON [dbo].[SGD_RENV_REGENVIO]([SGD_RENV_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_FECH] ON [dbo].[SGD_RENV_REGENVIO]([SGD_RENV_FECH]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_FECH_SAL] ON [dbo].[SGD_RENV_REGENVIO]([SGD_RENV_FECH_SAL]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_FENV] ON [dbo].[SGD_RENV_REGENVIO]([SGD_FENV_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_GRUPO] ON [dbo].[SGD_RENV_REGENVIO]([SGD_RENV_GRUPO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_RADI_SAL] ON [dbo].[SGD_RENV_REGENVIO]([RADI_NUME_SAL], [DEPE_CODI], [SGD_FENV_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RENV_planilla] ON [dbo].[SGD_RENV_REGENVIO]([SGD_RENV_PLANILLA]) ON [PRIMARY]
GO

 CREATE  INDEX [CARPETAS_PER] ON [dbo].[CARPETA_PER]([CODI_CARP], [DEPE_CODI], [USUA_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [SGD_BUSCAR_NOMBRE] ON [dbo].[SGD_CIU_CIUDADANO]([SGD_CIU_APELL1], [SGD_CIU_APELL2], [SGD_CIU_NOMBRE]) ON [PRIMARY]
GO

 CREATE  INDEX [SGD_BUSQ_CEDULA] ON [dbo].[SGD_CIU_CIUDADANO]([SGD_CIU_CEDULA]) ON [PRIMARY]
GO

 CREATE  INDEX [SGD_BUSQ_NIT] ON [dbo].[SGD_OEM_OEMPRESAS]([SGD_OEM_NIT]) ON [PRIMARY]
GO

 CREATE  INDEX [SQG_BUSQ_EMPRESA] ON [dbo].[SGD_OEM_OEMPRESAS]([SGD_OEM_OEMPRESA], [SGD_OEM_SIGLA]) ON [PRIMARY]
GO

 CREATE  INDEX [USUARIO_DEPE_CODI] ON [dbo].[USUARIO]([DEPE_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [USUARIO_USUA_CODI] ON [dbo].[USUARIO]([USUA_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [USUARIO1_DEPE_CODI] ON [dbo].[USUARIO]([DEPE_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [USUARIO1_USUA_CODI] ON [dbo].[USUARIO]([USUA_CODI]) ON [PRIMARY]
GO

 CREATE  UNIQUE  INDEX [RADICADO_IDX_001] ON [dbo].[RADICADO]([RADI_NUME_RADI], [TDOC_CODI], [RADI_USUA_ACTU], [RADI_DEPE_ACTU], [CODI_NIVEL], [RADI_FECH_RADI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADICADO_CARP_CODI] ON [dbo].[RADICADO]([CARP_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADICADO_CODI_NIVEL] ON [dbo].[RADICADO]([CODI_NIVEL]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADICADO_TDOC_CODI] ON [dbo].[RADICADO]([TDOC_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_CUENTAI] ON [dbo].[RADICADO]([RADI_CUENTAI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_DEPE_ACTU] ON [dbo].[RADICADO]([RADI_DEPE_ACTU]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_ESTA_CODI] ON [dbo].[RADICADO]([ESTA_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_FECH_RADI] ON [dbo].[RADICADO]([RADI_FECH_RADI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_LEIDO] ON [dbo].[RADICADO]([RADI_LEIDO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_MREC_CODI] ON [dbo].[RADICADO]([MREC_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_MTD_CODIGO] ON [dbo].[RADICADO]([SGD_MTD_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_PAR_SERV] ON [dbo].[RADICADO]([PAR_SERV_SECUE]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_TDID_CODI] ON [dbo].[RADICADO]([TDID_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_TIPO_DERI] ON [dbo].[RADICADO]([RADI_TIPO_DERI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_TMA_CODIGO] ON [dbo].[RADICADO]([SGD_TMA_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_TRTE_CODI] ON [dbo].[RADICADO]([TRTE_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_RADI_USUA_ACTU] ON [dbo].[RADICADO]([RADI_USUA_ACTU]) ON [PRIMARY]
GO

 CREATE  INDEX [RADICADO_DEPENDENCIA] ON [dbo].[RADICADO]([RADI_CUENTAI], [RADI_USUA_ACTU], [CARP_CODI]) ON [PRIMARY]
GO

 CREATE  UNIQUE  INDEX [RADICADO_IDX_003] ON [dbo].[RADICADO]([RADI_DEPE_RADI], [RADI_NUME_RADI], [SGD_EANU_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [RADICADO_ORDEN] ON [dbo].[RADICADO]([RADI_FECH_ASIG], [RADI_FECH_RADI], [RADI_USUA_ACTU], [RADI_DEPE_ACTU], [CARP_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [ANEXOS_IDX_001] ON [dbo].[ANEXOS]([ANEX_BORRADO], [SGD_DEVE_CODIGO], [RADI_NUME_SALIDA], [ANEX_CREADOR], [ANEX_ESTADO]) ON [PRIMARY]
GO

 CREATE  INDEX [ANEXOS_IDX_002] ON [dbo].[ANEXOS]([ANEX_BORRADO], [RADI_NUME_SALIDA], [ANEX_CREADOR], [ANEX_ESTADO], [SGD_DEVE_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_ANEX_DEPE_CODI] ON [dbo].[ANEXOS]([ANEX_DEPE_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_ANEX_DIR_TIPO] ON [dbo].[ANEXOS]([SGD_DIR_TIPO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_ANEX_ESTADO] ON [dbo].[ANEXOS]([ANEX_ESTADO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_ANEX_NUMERO] ON [dbo].[ANEXOS]([ANEX_NUMERO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_ANEX_RADI] ON [dbo].[ANEXOS]([ANEX_RADI_NUME]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_ANEX_RADI_SAL] ON [dbo].[ANEXOS]([RADI_NUME_SALIDA]) ON [PRIMARY]
GO

 CREATE  INDEX [FECHA] ON [dbo].[HIST_EVENTOS]([HIST_FECH]) ON [PRIMARY]
GO

 CREATE  INDEX [HIST_CONSULTA] ON [dbo].[HIST_EVENTOS]([RADI_NUME_RADI], [HIST_FECH], [DEPE_CODI], [USUA_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [RADI_NUME_RADI] ON [dbo].[HIST_EVENTOS]([RADI_NUME_RADI]) ON [PRIMARY]
GO

 CREATE  INDEX [INFORMADO_USUARIO] ON [dbo].[INFORMADOS]([DEPE_CODI], [USUA_CODI], [INFO_FECH]) ON [PRIMARY]
GO

 CREATE  INDEX [RADICADO] ON [dbo].[INFORMADOS]([RADI_NUME_RADI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_DIR_CIU_CODIGO] ON [dbo].[SGD_DIR_DRECCIONES]([SGD_CIU_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_DIR_DIRECC_SGD_ESP_CODI] ON [dbo].[SGD_DIR_DRECCIONES]([SGD_ESP_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_DIR_TIPO] ON [dbo].[SGD_DIR_DRECCIONES]([SGD_DIR_TIPO], [RADI_NUME_RADI], [SGD_CIU_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_SGD_DIR_NOMBRE] ON [dbo].[SGD_DIR_DRECCIONES]([SGD_DIR_NOMBRE]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_SGD_DIR_OEM_CODIGO] ON [dbo].[SGD_DIR_DRECCIONES]([SGD_OEM_CODIGO]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_SGD_DIR_RADI_NUME] ON [dbo].[SGD_DIR_DRECCIONES]([RADI_NUME_RADI]) ON [PRIMARY]
GO

 CREATE  INDEX [SGD_DIR_DRECCIONES_IDX_001] ON [dbo].[SGD_DIR_DRECCIONES]([SGD_DIR_TIPO], [RADI_NUME_RADI], [SGD_ESP_CODI]) ON [PRIMARY]
GO

 CREATE  INDEX [IND_EXP_RADI] ON [dbo].[SGD_EXP_EXPEDIENTE]([RADI_NUME_RADI]) ON [PRIMARY]
GO

ALTER TABLE [dbo].[DEPENDENCIA] ADD 
	CONSTRAINT [FK_DEPE_PADRE] FOREIGN KEY 
	(
		[DEPE_CODI_PADRE]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_DEPENDENCIA_DEPARTAMENTO] FOREIGN KEY 
	(
		[DPTO_CODI],
		[id_pais]
	) REFERENCES [dbo].[DEPARTAMENTO] (
		[DPTO_CODI],
		[id_pais]
	)/*,
	CONSTRAINT [FK_DEPENDENCIA_DEPENDENCIA_ESTADO] FOREIGN KEY 
	(
		[DEPENDENCIA_ESTADO]
	) REFERENCES [dbo].[SGD_ADMIN_DEPENDENCIA_ESTADO] (
		[CODIGO_ESTADO]
	)*/
GO

ALTER TABLE [dbo].[MUNICIPIO] ADD 
	CONSTRAINT [FK_MUNICIPIO_DEPARTAMENTO] FOREIGN KEY 
	(
		[DPTO_CODI],
		[id_pais]
	) REFERENCES [dbo].[DEPARTAMENTO] (
		[DPTO_CODI],
		[id_pais]
	),
	CONSTRAINT [FK_MUNICIPIO_SGD_DEF_CONTINENTES] FOREIGN KEY 
	(
		[id_cont]
	) REFERENCES [dbo].[SGD_DEF_CONTINENTES] (
		[id_cont]
	),
	CONSTRAINT [FK_MUNICIPIO_SGD_DEF_PAISES] FOREIGN KEY 
	(
		[id_pais]
	) REFERENCES [dbo].[SGD_DEF_PAISES] (
		[ID_PAIS]
	)
GO

ALTER TABLE [dbo].[SGD_COB_CAMPOBLIGA] ADD 
	CONSTRAINT [FK_SGD_COB__SGD_TIDM] FOREIGN KEY 
	(
		[SGD_TIDM_CODI]
	) REFERENCES [dbo].[SGD_TIDM_TIDOCMASIVA] (
		[SGD_TIDM_CODI]
	)
GO

ALTER TABLE [dbo].[SGD_DCAU_CAUSAL] ADD 
	CONSTRAINT [FK_SGD_DCAU_SGD_CAU_] FOREIGN KEY 
	(
		[SGD_CAU_CODIGO]
	) REFERENCES [dbo].[SGD_CAU_CAUSAL] (
		[SGD_CAU_CODIGO]
	)
GO

ALTER TABLE [dbo].[SGD_DNUFE_DOCNUFE] ADD 
	CONSTRAINT [FK_SGD_DNUFE_ANEX_TIPO] FOREIGN KEY 
	(
		[ANEX_TIPO_CODI]
	) REFERENCES [dbo].[ANEXOS_TIPO] (
		[ANEX_TIPO_CODI]
	),
	CONSTRAINT [FK_SGD_DNUFE_SGD_PNUFE] FOREIGN KEY 
	(
		[SGD_PNUFE_CODI]
	) REFERENCES [dbo].[SGD_PNUFE_PROCNUMFE] (
		[SGD_PNUFE_CODI]
	),
	CONSTRAINT [FK_SGD_DNUFE_SGD_TPR] FOREIGN KEY 
	(
		[SGD_TPR_CODIGO]
	) REFERENCES [dbo].[SGD_TPR_TPDCUMENTO] (
		[SGD_TPR_CODIGO]
	),
	CONSTRAINT [FK_SGD_DNUFE_TRTE] FOREIGN KEY 
	(
		[TRTE_CODI]
	) REFERENCES [dbo].[TIPO_REMITENTE] (
		[TRTE_CODI]
	)
GO

ALTER TABLE [dbo].[CARPETA_PER] ADD 
	CONSTRAINT [FK_CARP_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	)
GO

ALTER TABLE [dbo].[CENTRO_POBLADO] ADD 
	CONSTRAINT [FK_CENTRO_POBLADO_MUNICIPIO] FOREIGN KEY 
	(
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	) REFERENCES [dbo].[MUNICIPIO] (
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	)
GO

ALTER TABLE [dbo].[DEPENDENCIA_VISIBILIDAD] ADD 
	CONSTRAINT [FK_DEPENDENCIA_VISIBILIDAD_DEPENDENCIA] FOREIGN KEY 
	(
		[DEPENDENCIA_VISIBLE]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_DEPENDENCIA_VISIBILIDAD_DEPENDENCIA1] FOREIGN KEY 
	(
		[DEPENDENCIA_OBSERVA]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	)
GO

ALTER TABLE [dbo].[SGD_ADMIN_DEPE_HISTORICO] ADD 
	CONSTRAINT [FK_SGD_ADMIN_DEPE_HISTORICO_DEPENDENCIA] FOREIGN KEY 
	(
		[DEPENDENCIA_MODIFICADA]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	)
GO

ALTER TABLE [dbo].[SGD_ADMIN_USUA_HISTORICO] ADD 
	CONSTRAINT [FK_ADMIN_HISTORICO_DEPENDENCIA] FOREIGN KEY 
	(
		[DEPENDENCIA_CODIGO_ADMINISTRADOR]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_ADMIN_HISTORICO_DEPENDENCIA1] FOREIGN KEY 
	(
		[DEPENDENCIA_CODIGO_MODIFICADO]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_SGD_ADMIN_HISTORICO_SGD_ADMIN_OBSERVACION] FOREIGN KEY 
	(
		[ADMIN_OBSERVACION_CODIGO]
	) REFERENCES [dbo].[SGD_ADMIN_OBSERVACION] (
		[CODIGO_OBSERVACION]
	)
GO

ALTER TABLE [dbo].[SGD_CIU_CIUDADANO] ADD 
	CONSTRAINT [FK_SGD_CIU_CIUDADANO_MUNICIPIO] FOREIGN KEY 
	(
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	) REFERENCES [dbo].[MUNICIPIO] (
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	)
GO

ALTER TABLE [dbo].[SGD_DDCA_DDSGRGDO] ADD 
	CONSTRAINT [FK_SGD_DDCA_REF_678_PAR_SERV] FOREIGN KEY 
	(
		[PAR_SERV_SECUE]
	) REFERENCES [dbo].[PAR_SERV_SERVICIOS] (
		[PAR_SERV_SECUE]
	),
	CONSTRAINT [FK_SGD_DDCA_SGD_DCAU] FOREIGN KEY 
	(
		[SGD_DCAU_CODIGO]
	) REFERENCES [dbo].[SGD_DCAU_CAUSAL] (
		[SGD_DCAU_CODIGO]
	)
GO

ALTER TABLE [dbo].[SGD_MAT_MATRIZ] ADD 
	CONSTRAINT [FK_SGD_MAT_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_SGD_MAT_SGD_FUN] FOREIGN KEY 
	(
		[SGD_FUN_CODIGO]
	) REFERENCES [dbo].[SGD_FUN_FUNCIONES] (
		[SGD_FUN_CODIGO]
	),
	CONSTRAINT [FK_SGD_MAT_SGD_PRC] FOREIGN KEY 
	(
		[SGD_PRC_CODIGO]
	) REFERENCES [dbo].[SGD_PRC_PROCESO] (
		[SGD_PRC_CODIGO]
	),
	CONSTRAINT [FK_SGD_MAT_SGD_PRD] FOREIGN KEY 
	(
		[SGD_PRD_CODIGO]
	) REFERENCES [dbo].[SGD_PRD_PRCDMENTOS] (
		[SGD_PRD_CODIGO]
	)
GO

ALTER TABLE [dbo].[SGD_OEM_OEMPRESAS] ADD 
	CONSTRAINT [FK_SGD_OEM__REFERENCE_TIPO_DOC] FOREIGN KEY 
	(
		[TDID_CODI]
	) REFERENCES [dbo].[TIPO_DOC_IDENTIFICACION] (
		[TDID_CODI]
	),
	CONSTRAINT [FK_SGD_OEM_OEMPRESAS_MUNICIPIO] FOREIGN KEY 
	(
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	) REFERENCES [dbo].[MUNICIPIO] (
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	)
GO

ALTER TABLE [dbo].[SGD_PNUN_PROCENUM] ADD 
	CONSTRAINT [FK_SGD_PNUN_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_SGD_PNUN_SGD_PNUFE] FOREIGN KEY 
	(
		[SGD_PNUFE_CODI]
	) REFERENCES [dbo].[SGD_PNUFE_PROCNUMFE] (
		[SGD_PNUFE_CODI]
	)
GO

ALTER TABLE [dbo].[SGD_TMA_TEMAS] ADD 
	CONSTRAINT [FK_SGD_TMA_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_SGD_TMA_SGD_PRC] FOREIGN KEY 
	(
		[SGD_PRC_CODIGO]
	) REFERENCES [dbo].[SGD_PRC_PROCESO] (
		[SGD_PRC_CODIGO]
	)
GO

ALTER TABLE [dbo].[USUARIO] ADD 
	CONSTRAINT [FK_USUA_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	)
GO

ALTER TABLE [dbo].[SGD_MTD_MATRIZ_DOC] ADD 
	CONSTRAINT [FK_SGD_MTD_SGD_MTD] FOREIGN KEY 
	(
		[SGD_MAT_CODIGO]
	) REFERENCES [dbo].[SGD_MAT_MATRIZ] (
		[SGD_MAT_CODIGO]
	),
	CONSTRAINT [FK_SGD_MTD_SGD_TPR] FOREIGN KEY 
	(
		[SGD_TPR_CODIGO]
	) REFERENCES [dbo].[SGD_TPR_TPDCUMENTO] (
		[SGD_TPR_CODIGO]
	)
GO

ALTER TABLE [dbo].[RADICADO] ADD 
	CONSTRAINT [FK_RADI_ESTA] FOREIGN KEY 
	(
		[ESTA_CODI]
	) REFERENCES [dbo].[ESTADO] (
		[ESTA_CODI]
	),
	CONSTRAINT [FK_RADI_MREC] FOREIGN KEY 
	(
		[MREC_CODI]
	) REFERENCES [dbo].[MEDIO_RECEPCION] (
		[MREC_CODI]
	),
	CONSTRAINT [FK_RADI_TDID] FOREIGN KEY 
	(
		[TDID_CODI]
	) REFERENCES [dbo].[TIPO_DOC_IDENTIFICACION] (
		[TDID_CODI]
	),
	CONSTRAINT [FK_RADI_TRTE] FOREIGN KEY 
	(
		[TRTE_CODI]
	) REFERENCES [dbo].[TIPO_REMITENTE] (
		[TRTE_CODI]
	),
	CONSTRAINT [FK_RADICADO_CENTRO_POBLADO] FOREIGN KEY 
	(
		[CPOB_CODI],
		[CEN_MUNI_CODI],
		[CEN_DPTO_CODI],
		[id_pais],
		[id_cont]
	) REFERENCES [dbo].[CENTRO_POBLADO] (
		[CPOB_CODI],
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	),
	CONSTRAINT [FK_RADICADO_PAR_SERV] FOREIGN KEY 
	(
		[PAR_SERV_SECUE]
	) REFERENCES [dbo].[PAR_SERV_SERVICIOS] (
		[PAR_SERV_SECUE]
	),
	CONSTRAINT [FK_RADICADO_SGD_MTD] FOREIGN KEY 
	(
		[SGD_MTD_CODIGO]
	) REFERENCES [dbo].[SGD_MTD_MATRIZ_DOC] (
		[SGD_MTD_CODIGO]
	),
	CONSTRAINT [FK_RADICADO_SGD_NOT_NOTIFICACION] FOREIGN KEY 
	(
		[SGD_NOT_CODI]
	) REFERENCES [dbo].[SGD_NOT_NOTIFICACION] (
		[SGD_NOT_CODI]
	),
	CONSTRAINT [FK_RADICADO_SGD_TMA] FOREIGN KEY 
	(
		[SGD_TMA_CODIGO]
	) REFERENCES [dbo].[SGD_TMA_TEMAS] (
		[SGD_TMA_CODIGO]
	)
GO

ALTER TABLE [dbo].[ANEXOS] ADD 
	CONSTRAINT [ANEX_FK_ANEX_CREADOR] FOREIGN KEY 
	(
		[ANEX_CREADOR]
	) REFERENCES [dbo].[USUARIO] (
		[USUA_LOGIN]
	),
	CONSTRAINT [ANEX_FK_ANEX_RADI_NUME] FOREIGN KEY 
	(
		[ANEX_RADI_NUME]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	),
	CONSTRAINT [ANEX_FK_ANEX_TIPO] FOREIGN KEY 
	(
		[ANEX_TIPO]
	) REFERENCES [dbo].[ANEXOS_TIPO] (
		[ANEX_TIPO_CODI]
	)
GO

ALTER TABLE [dbo].[HIST_EVENTOS] ADD 
	CONSTRAINT [FK_HIST_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_RADI_HIST] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	)
GO

ALTER TABLE [dbo].[INFORMADOS] ADD 
	CONSTRAINT [FK_INFO_RADI] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	)
GO

ALTER TABLE [dbo].[PRESTAMO] ADD 
	CONSTRAINT [FK_PRESTAMO_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_PRESTAMO_DEPE_ARCH] FOREIGN KEY 
	(
		[PRES_DEPE_ARCH]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_PRESTAMO_FK_PRES_R_RADICADO] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	),
	CONSTRAINT [FK_PRESTAMO_FK_PRES_U_USUARIO] FOREIGN KEY 
	(
		[USUA_LOGIN_PRES]
	) REFERENCES [dbo].[USUARIO] (
		[USUA_LOGIN]
	),
	CONSTRAINT [FK_PRESTAMO_FK_USUA_P_USUARIO] FOREIGN KEY 
	(
		[USUA_LOGIN_ACTU]
	) REFERENCES [dbo].[USUARIO] (
		[USUA_LOGIN]
	)
GO

ALTER TABLE [dbo].[SGD_CAUX_CAUSALES] ADD 
	CONSTRAINT [FK_SGD_CAUX_RADICADO] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	),
	CONSTRAINT [FK_SGD_CAUX_SGD_DCAU] FOREIGN KEY 
	(
		[SGD_DCAU_CODIGO]
	) REFERENCES [dbo].[SGD_DCAU_CAUSAL] (
		[SGD_DCAU_CODIGO]
	),
	CONSTRAINT [FK_SGD_CAUX_SGD_DDCA] FOREIGN KEY 
	(
		[SGD_DDCA_CODIGO]
	) REFERENCES [dbo].[SGD_DDCA_DDSGRGDO] (
		[SGD_DDCA_CODIGO]
	)
GO

ALTER TABLE [dbo].[SGD_DIR_DRECCIONES] ADD 
	CONSTRAINT [FK_SGD_DIR_DRECCIONES_MUNICIPIO] FOREIGN KEY 
	(
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	) REFERENCES [dbo].[MUNICIPIO] (
		[MUNI_CODI],
		[DPTO_CODI],
		[id_pais],
		[id_cont]
	),
	CONSTRAINT [FK_SGD_DIR_RADICADO] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	),
	CONSTRAINT [FK_SGD_DIR_SGD_CIU] FOREIGN KEY 
	(
		[SGD_CIU_CODIGO]
	) REFERENCES [dbo].[SGD_CIU_CIUDADANO] (
		[SGD_CIU_CODIGO]
	),
	CONSTRAINT [FK_SGD_DIR_SGD_OEM] FOREIGN KEY 
	(
		[SGD_OEM_CODIGO]
	) REFERENCES [dbo].[SGD_OEM_OEMPRESAS] (
		[SGD_OEM_CODIGO]
	)
GO

ALTER TABLE [dbo].[SGD_EXP_EXPEDIENTE] ADD 
	CONSTRAINT [FK_SGD_EXP_RADICADO] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	)
GO

ALTER TABLE [dbo].[SGD_HMTD_HISMATDOC] ADD 
	CONSTRAINT [FK_SGD_HMTD_DEPE] FOREIGN KEY 
	(
		[DEPE_CODI]
	) REFERENCES [dbo].[DEPENDENCIA] (
		[DEPE_CODI]
	),
	CONSTRAINT [FK_SGD_HMTD_RADICADO] FOREIGN KEY 
	(
		[RADI_NUME_RADI]
	) REFERENCES [dbo].[RADICADO] (
		[RADI_NUME_RADI]
	),
	CONSTRAINT [FK_SGD_HMTD_SGD_MTD] FOREIGN KEY 
	(
		[SGD_MTD_CODIGO]
	) REFERENCES [dbo].[SGD_MTD_MATRIZ_DOC] (
		[SGD_MTD_CODIGO]
	)
GO

ALTER TABLE [dbo].[SGD_ANAR_ANEXARG] ADD 
	CONSTRAINT [FK_SGD_ANAR_ANEXOS] FOREIGN KEY 
	(
		[ANEX_CODIGO]
	) REFERENCES [dbo].[ANEXOS] (
		[ANEX_CODIGO]
	),
	CONSTRAINT [FK_SGD_ANAR_SGD_ARGD] FOREIGN KEY 
	(
		[SGD_ARGD_CODI]
	) REFERENCES [dbo].[SGD_ARGD_ARGDOC] (
		[SGD_ARGD_CODI]
	)
GO


exec sp_addextendedproperty N'MS_Description', N'Permiso de Modificar Cualquier Radicado', N'user', N'dbo', N'table', N'USUARIO', N'column', N'USUA_PERM_MODIFICA'
GO
exec sp_addextendedproperty N'MS_Description', N'Permiso de Acceso al modulo de envios', N'user', N'dbo', N'table', N'USUARIO', N'column', N'USUA_PERM_ENVIOS'


GO


CREATE TABLE SGD_PARAMETRO (
PARAM_NOMB CHARACTER VARYING(25) NOT NULL,
PARAM_CODI NUMERIC(5,0) NOT NULL,
PARAM_VALOR CHARACTER VARYING(25) NOT NULL,
CONSTRAINT SGD_PARAMETRO_PK  PRIMARY KEY  (PARAM_NOMB, PARAM_CODI)
)
GO

CREATE TABLE SGD_USM_USUMODIFICA (
    SGD_USM_MODCOD NUMERIC(5,0) NOT NULL,
    SGD_USM_MODDESCR CHARACTER VARYING(60) NOT NULL
)
GO

CREATE TABLE SGD_APLI_APLINTEGRA (
    SGD_APLI_CODI NUMERIC(4,0),
    SGD_APLI_DESCRIP CHARACTER VARYING(150),
    SGD_APLI_LK1DESC CHARACTER VARYING(150),
    SGD_APLI_LK1 CHARACTER VARYING(150),
    SGD_APLI_LK2DESC CHARACTER VARYING(150),
    SGD_APLI_LK2 CHARACTER VARYING(150),
    SGD_APLI_LK3DESC CHARACTER VARYING(150),
    SGD_APLI_LK3 CHARACTER VARYING(150),
    SGD_APLI_LK4DESC CHARACTER VARYING(150),
    SGD_APLI_LK4 CHARACTER VARYING(150),
	CONSTRAINT PK_SGD_APLI_APLINTEGRA  PRIMARY KEY  (SGD_APLI_CODI)
)
GO


CREATE TABLE SGD_PEXP_PROCEXPEDIENTES (
    SGD_PEXP_CODIGO NUMERIC NOT NULL,
    SGD_PEXP_DESCRIP CHARACTER VARYING(100),
    SGD_PEXP_TERMINOS NUMERIC DEFAULT 0,
    SGD_SRD_CODIGO NUMERIC(3,0),
    SGD_SBRD_CODIGO NUMERIC(3,0),
    SGD_PEXP_AUTOMATICO NUMERIC(1,0) DEFAULT 1,
    SGD_PEXP_TIENEFLUJO NUMERIC(1,0) DEFAULT 0,
	CONSTRAINT PK_SGD_PEXP_PROCEXPEDIENTES  PRIMARY KEY  (SGD_PEXP_CODIGO)
)
GO