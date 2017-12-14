<?php
$ruta_raiz = "../..";
session_start();
if (!$_SESSION['dependencia'] or ! $_SESSION['tpDepeRad'])
    include "$ruta_raiz/rec_session.php";
?>
<html>
    <head>
        <title>Documento sin t&iacute;tulo</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
    </head>
    <body>
        <br>
        <br>
        <form name='frmMnuUsuarios' action='../formAdministracion.php' method="post">
            <table width="32%" align="center" border="1" cellpadding="0" cellspacing="5" class="menuEnlaces">
                <div id="titulo" style="width: 32%; margin-left: 34%;" align="center">Administración de Usuarios y Perfiles</div>
          <!--  <tr bordercolor="#FFFFFF">
              <td colspan="2" class="titulos4"><div align="center"><strong>ADMINISTRACION DE USUARIOS Y PERFILES</strong></div></td>
            </tr>-->
                <tr bordercolor="#FFFFFF">
                    <td align="center" class="listado2" width="98%"><a href='crear.php?usModo=1' class="vinculos" target='mainFrame'>1. Creación de Usuario</a></td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td align="center" class="listado1" width="98%"><a href='cuerpoEdicion.php?usModo=2' class="vinculos" target='mainFrame'>2. Editar Usuario</a></td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td align="center" class="listado2" width="98%"><a href='cuerpoConsulta.php' class="vinculos" target='mainFrame'>3. Consultar Usuario</a></td>
                </tr>
                <tr bordercolor="#FFFFFF">
                    <td align="center" class="listado1">
                <center><input align="middle" class="botones" type="submit" name="Submit" value="Cerrar"></center>
                </td> </tr>
            </table>
        </form>
    </body>
</html>