<? 
/**
* Administrador de la Tabla de Valoracion Documental TVD 
* Sistema de gestion Documental ORFEO.
* Permite la creacion, listado y modificacion de Dependencias y series para TVD
*/
    session_start();
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $ruta_raiz = "../..";

    //valido sesion
    if(!$dependencia)  include "$ruta_raiz/rec_session.php";

?>
<html>
<head>
<link rel="stylesheet" href="../../estilos/orfeo.css">
</head>
<body bgcolor="#FFFFFF" topmargin="0" onLoad="window_onload();">
<table width="47%" align="center" border="0" cellpadding="0" cellspacing="5" class="borde_tab">
     <tr> 
      <td height="25" class="titulos4"> 
        ADMINISTRACION  -TABLAS DE VALORACION DOCUMENTAL- 
      </td>
    </tr>
    <tr align="center"> 
      <td class="listado2" > 
        <a href='../tvd/admin_dependencias.php' class="vinculos" target='mainFrame'>Dependencias</a>
      </td>
    </tr>
    <tr align="center"> 
      <td class="listado2" > 
        <a href='../tvd/admin_series.php' class="vinculos" target='mainFrame'>Series </a>
      </td>
    </tr>
    </tr>
  </table>
</body>
</html>
