<?
/**
 * Este programa despliega el men� principal de correspondencia masiva
 * @author      Sixto Angel Pinz�n
 * @version     1.0
 */
error_reporting(7);
session_start();
$ruta_raiz = "../../";

require_once("$ruta_raiz/include/db/ConnectionHandler.php");
//Si no llega la dependencia recupera la sesi�n
if (!isset($_SESSION['dependencia'])) {
    include "$ruta_raiz/rec_session.php";
}
if (!$db)
    $db = new ConnectionHandler($ruta_raiz);
$phpsession = session_name() . "=" . session_id();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script language="JavaScript">
            <!--
        

            fun            ction Start(URL, WIDTH, HEIGHT)
            {
                windowprops = "top=0,left=0,location=no,status=no, menubar=no,scrollbars=yes, resizable=yes,width=";
                windowprops += WIDTH + ",height=" + HEIGHT;

                preview = window.open(URL, "preview", windowprops);
            }

//-->
</script>
</head>
<body top margin="0" onLoad="window_onload();">
<br>
 <center>
        <div id="titulo" style="width: 40%;" align="center">Radicaci&oacute;n masiva de documentos</div>
        <table width="40%" align="center" border="1" cellpadding="0" cellspacing="5" class="borde_tab">
                <tr align="center">
                    <td class="listado1" >
                        <a href='upload2.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
                            Generar Radicaci&oacute;n Masiva
                        </a>
                    </td>
                </tr>
                <!--<tr align="center">
                        <td class="listado2" >
                                <a href='upload3.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
                                Generar Radicaci&oacute;n Masiva Suscriptores
                                </a>
                        </td>
                </tr>-->
                <tr align="center">
                    <td class="listado2" >
                        <a href="../cuerpo_masiva_recuperar_listado.php?<?= $phpsession ?>&krd=<?= $krd ?>" class="vinculos">
                            Recuperar Listado
                        </a>
                    </td>
                </tr>
                <tr align="center">
                    <td class="listado1" >
                        <a href='consulta_depmuni.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' class="vinculos" target='mainFrame'>
                            Consultar Divisi&oacute;n Pol&iacute;tica Administrativa de Colombia (DIVIPOLA)</a>
                    </td>
                </tr>
                <tr align="center">
                    <td class="listado2" >
                        <a href='consultaESP.php?<?= $phpsession ?>&krd=<?= $krd ?>&<? echo "fechah=$fechah"; ?>' target='mainFrame' class="vinculos">
                            Consulta y Selecci&oacute;n destinatarios masiva
                        </a>
                    </td>
                </tr>
            </table>
</center>
            <?
            //Modificado skina - inhabilitado tabla de administracion de secuencias
//	include( "administradorSecuencias.php" );
            ?>
        </body>
</html>
