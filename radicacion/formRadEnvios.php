<?php
/**
 * En este frame se van cargado cada una de las funcionalidades del sistema
 *
 * Descripcion Larga
 *
 * @category
 * @package      SGD Orfeo
 * @subpackage   Main
 * @author       Community
 * @author       Skina Technologies SAS (http://www.skinatech.com)
 * @license      GNU/GPL <http://www.gnu.org/licenses/gpl-2.0.html>
 * @link         http://www.orfeolibre.org
 * @version      SVN: $Id$
 * @since
 */

        /*---------------------------------------------------------+
        |                     INCLUDES                             |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                    DEFINICIONES                          |
        +---------------------------------------------------------*/


        /*---------------------------------------------------------+
        |                       MAIN                               |
        +---------------------------------------------------------*/


session_start();
/**
 * Modificacion Variables Globales Infometika 2009
 */
$imagenes = $_SESSION["imagenes"];
$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$ruta_raiz = "..";
if (!isset($datos_enviar))
    $datos_enviar = "";
//if(!$_SESSION['dependencia'])	include "$ruta_raiz/rec_session.php";
?>
<!--<link href="../estilos/orfeo.css" rel="stylesheet" type="text/css">-->
<link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
<link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>/bootstrap.css" rel="stylesheet" type="text/css"/>
<style>
    table, #titulo{
        margin-left:auto; 
        margin-right:auto
    }
    #titulo{
        font-size: 20px;
    }
</style>
<br>
<table width="80%" border="2" cellspacing="5" cellpadding="0" class="borde_tab" >
<!--	<tr class='titulos2'>
                        <td colspan="5">
                                        <img src='../<?= $imagenes ?>/correo.gif' alt="Incono con imagen alusiva a correo"> Envio de Correspondencia &nbsp;
                        </td>
        </tr>-->

    <div id="titulo" style="width: 80%;"><div id="tituloTexto"><img src='../<?= $imagenes ?>/correo.gif' alt="Incono con imagen alusiva a correo"> Dependencias Restringidas</div></div>

    <tr align="center" class='listado2'>
        <td class='listado2' > 
            <a aria-label="vínculo a página de envío normal de radicados" href='../envios/cuerpoEnvioNormal.php?<?= $datos_enviar ?>&estado_sal=3&estado_sal_max=3&krd=<?= $krd ?>&nomcarpeta=Radicados Para Envio' class='vinculos'>Normal
            </a>
        </td>
<!--			<td class='listado2' > 
        <a aria-label="vínculo a página de envío de radicados a sedes" href='../envios/cuerpoEnvioFactura.php?<?= $datos_enviar ?>&estado_sal=3&estado_sal_max=3&krd=<?= $krd ?>&nomcarpeta=Radicados Para Envio' class='vinculos'>Sedes
        </a></td>-->
        <td class='listado2' ><a aria-label="vínculo a página de edición de registros de envío" href='../envios/cuerpoModifEnvio.php?<?= $datos_enviar ?>&estado_sal=4&estado_sal_max=4&devolucion=3&krd=<?= $krd ?>' class='vinculos'>Modificación Registro de Envío
            </a></td>
        <td class='listado2' ><a aria-label="vínculo a página de envíos de forma masiva" href='../radsalida/cuerpo_masiva.php?<?= $datos_enviar ?>&krd=<?= $krd ?>&estado_sal=3&estado_sal_max=3' class='vinculos'>Masiva
            </a></td>
        <td class='listado2'><b><a aria-label="vínculo a página para generar formatos y guías de correo" href='../radsalida/generar_envio.php?<?= $datos_enviar ?>&krd=<?= $krd ?>' class='vinculos'>Generación de Planillas
                    y Guías 
                </a></td>
    </tr>
</table>
<br>
<table width="80%" border="2" cellspacing="5" cellpadding="0" class="borde_tab">
    <!--  <tr class='titulos2'>
         <td colspan="4">
        <img src='../<?= $imagenes ?>/devoluciones.gif' alt="Ícono con imagen alusiva a delvolución de correo"> Devoluciones
          </td>
      </tr>-->
    <div id="titulo" style="width: 80%;"><div id="tituloTexto"><img src='../<?= $imagenes ?>/devoluciones.gif' alt="Ícono con imagen alusiva a delvolución de correo"> Devoluciones</div></div>
    <tr>
        <td class='listado2' height="25">
            <a aria-label="Devoluciones por superar el tiempo de espera" href='../devolucion/dev_corresp.php?<?= $datos_enviar ?>&estado_sal=4&estado_sal_max=4&krd=<?= $krd ?>' class='vinculos'>
                Por exceder  tiempo de espera
            </a>
        </td>
        <td class='listado2' height="25">
            <a aria-label="devoluciones por otros motivos" href='../devolucion/cuerpoDevOtras.php?<?= $datos_enviar ?>&estado_sal=4&estado_sal_max=4&devolucion=1&krd=<?= $krd ?>' class='vinculos'>
                Otras Devoluciones
            </a>
        </td>
        <td class='listado2' height="25"><a href='../radsalida/dev_corresp2.php?<?= $datos_enviar ?>&estado_sal=4&estado_sal_max=4'>
            </a>
        </td>
    </tr>
</table>
<br>
<table width="80%" border="2" cellspacing="5" cellpadding="0" class="borde_tab">
<!--  <tr class='titulos2'>
 <td colspan="4">
<img src='../iconos/anulacionRad.gif' alt="ícono alusivo a anulaciones"> Anulaciones
  </td>
</tr>-->
    <div id="titulo" style="width: 80%;"><div id="tituloTexto"><img src='../iconos/anulacionRad.gif' alt="ícono alusivo a anulaciones"> Anulaciones</div></div>
    <tr>
        <td class='listado2' height="25">
            <a aria-label="Vínculo a página para anular radicados" href='../anulacion/anularRadicados.php?<?= $datos_enviar ?>&estado_sal=4&tpAnulacion=2&krd=<?= $krd ?>' class="vinculos">
                Anular Radicados
            </a>
        </td>
</table>
<br>
<table width="80%" border="2" cellspacing="5" cellpadding="0" class="borde_tab">
<!--    <tr class='titulos2'>
        <td colspan="4">
            <img src='../<?= $imagenes ?>/estadisticas_icono.gif' alt="ícono con gráfico de barras alusivo a estadísticas"> Reportes </td>
    </tr>-->
    <div id="titulo" style="width: 80%;"><div id="tituloTexto"><img src='../<?= $imagenes ?>/estadisticas_icono.gif' alt="ícono con gráfico de barras alusivo a estadísticas"> Reportes</div></div>
    <tr>
        <td class='listado2' height="25"><a aria-label="Estadísticas de envío de correos" href='../reportes/generar_estadisticas_envio.php?<?= $datos_enviar ?>&estado_sal=4&estado_sal_max=4&krd=<?= $krd ?>' class='vinculos'>
                Envío de Correo
            </a>
        </td>
        <td class='listado2' height="25">
            <a aria-label="estadísticas de devoluciones" href='../reportes/generar_estadisticas.php?<?= $datos_enviar ?>&estado_sal=4&estado_sal_max=4&krd=<?= $krd ?>' class='vinculos'>
                Devoluciones
            </a></td>
        <td class='listado2' height="25">
            <a aria-label="estadísticas de anulaciones" href='../anulacion/cuerpo_RepAnula.php?<?= $datos_enviar ?>&estado_sal=4&tpAnulacion=2&krd=<?= $krd ?>' class='vinculos'>
                Anulaciones
            </a></td>
    </tr>
</table>
