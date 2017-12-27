<?
/* * ********************************************************************************** */
/* ORFEO :Sistema de Gestion Documental		http://www.orfeogpl.org	             */
/* 	Idea Original de la SUPERINTENDENCIA DE SERVICIOS PUBLICOS DOMICILIARIOS     */
/* 			      COLOMBIA TEL. (57) (1) 6913005  yoapoyo@orfeogpl.org   */
/* ===========================                                                       */
/*                                                                                   */
/* Este programa es software libre. usted puede redistribuirlo y/o modificarlo       */
/* bajo los terminos de la licencia GNU General Public publicada por                 */
/* la "Free Software Foundation"; Licencia version 2. 			             */
/*                                                                                   */
/* Copyright (c) 2005 por :	  	  	                                     */
/* SSPS "Superintendencia de Servicios Publicos Domiciliarios"                       */
/*   Jairo Hernan Losada  jlosada@gmail.com                Desarrollador             */
/*   Sixto Angel Pinzón López --- angel.pinzon@gmail.com   Desarrollador             */
/* C.R.A.  "COMISION DE REGULACION DE AGUAS Y SANEAMIENTO AMBIENTAL"                 */
/*   Liliana Gomez        lgomezv@gmail.com                Desarrolladora            */
/*   Lucia Ojeda          lojedaster@gmail.com             Desarrolladora            */
/* D.N.P. "Departamento Nacional de Planeación"                                      */
/*   Hollman Ladino       hladino@gmail.com                Desarrollador             */
/*                                                                                   */
/* Colocar desde esta lInea las Modificaciones Realizadas Luego de la Version 3.5    */
/*  Nombre Desarrollador   Correo     Fecha   Modificacion                           */
/* * ********************************************************************************** */
?>
<?
session_start();
$ruta_raiz = "../..";
if (!$dependencia)
    include "../../rec_session.php";
?>

<html>
    <head>
        <link href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH2'] ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    </head>
    <body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">

        <?
        $ruta_raiz = "../..";
        include_once "$ruta_raiz/include/db/ConnectionHandler.php";
        $db = new ConnectionHandler("$ruta_raiz");
        $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);

//$db->conn->debug=true;

        $nomcarpeta = "Consulta Historico";

        if ($orden_cambio == 1) {
            if (!$orderTipo) {
                $orderTipo = "desc";
            } else {
                $orderTipo = "";
            }
        }

        $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&pagina_sig=$pagina_sig&usuLogin=$usuLogin&nombre=$nombre&dependencia=$dependencia&dep_sel=$dep_sel&selecdoc=$selecdoc&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
        $linkPagina = "$PHP_SELF?$encabezado&usuLogin=$usuLogin&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=$orderNo";
        /* $carpeta = "nada";
          $swBusqDep = "si";
          $pagina_actual = "../usuario/cuerpoUsuarioConsulta.php";
          // include "../paEncabeza.php";
          $varBuscada = "usua_login";
          include "../paBuscar.php";
          $pagina_sig = "../usuario/consultaDatosGrales.php";
          $accion_sal = "Consultar";
          include "../paOpciones.php";
         */
        error_reporting(0);
        ?>
        <br>
    <center>
        <div id="titulo" style="width: 99%;" align="center"> Administración de usuarios y perfiles consulta de Usuario
        </div>
    </center>
    <table align="center" border=1 width=99% class='borde_tab'>
        <tr class="listado1">
            <td align="left"  width="20%">
                <b>Datos Historicos</b>
            </td>
            <td align="left" width="40%">
                <b>Usuario:</b> <?= $usuLogin ?>
            </td>
            <td align="left" width="40%">
                <b>Nombre:</b> <?= $nombre ?>
            </td>
        </tr>
    </table>
    <?
    ?>
    <form name=formHistorico action='consultaHistorico.php?<?= $encabezado ?>' method=post>
        <?
        if ($orderNo == 98 or $orderNo == 99) {
            $order = 1;
            if ($orderNo == 98)
                $orderTipo = "desc";

            if ($orderNo == 99)
                $orderTipo = "";
        }
        else {
            if (!$orderNo) {
                $orderNo = 0;
            }
            $order = $orderNo + 1;
        }
//	$sqlChar = $db->conn->SQLDate("d-m-Y H:i A","SGD_RENV_FECH");
        include "$ruta_raiz/include/query/administracion/queryConsultaHistorico.php";

//	$db->conn->debug = true;
//      problemas con la organizacion de las tablas es probable que sea por la forma en la que se envia la consulta
        $rs = $db->conn->Execute($isql);

        $nregis = $rs->fields["ADMINISTRADOR"];

        if (!$nregis) {
            echo "<hr><center><b>NO se encontro nada con el criterio de busqueda</center></b></hr>";
        } else {
            $pager = new ADODB_Pager($db, $isql, 'adodb', true, $orderNo, $orderTipo);
            $pager->toRefLinks = $linkPagina;
            $pager->toRefVars = $encabezado;
            $pager->Render($rows_per_page = 15, $linkPagina, $checkbox = chkEnviar);
        }
        $encabezado = "" . session_name() . "=" . session_id() . "&krd=$krd&pagina_sig=$pagina_sig&usuLogin=$usuLogin&dependencia=$dependencia&dep_sel=$dep_sel&selecdoc=$selecdoc&nomcarpeta=$nomcarpeta&orderTipo=$orderTipo&orderNo=";
        ?>

    </form>
</body>

</html>

