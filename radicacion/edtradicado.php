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
 * Modificacion Variables Globales Infometrika 2009-05
 * Licencia GNU/GPL 
 */
foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;


$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tpNumRad = $_SESSION["tpNumRad"];
$tpPerRad = $_SESSION["tpPerRad"];
$tpDescRad = $_SESSION["tpDescRad"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3img = $_SESSION["tip3img"];
$tpDepeRad = $_SESSION["tpDepeRad"];
$ruta_raiz = "..";
?>
<html>
    <head>
        <title>Buscar Radicado</title>
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $_SESSION['ESTILOS_PATH_ORFEO'] ?>">
        <script >
            function solonumeros()
            {
                jh = document.getElementById('nurad').value;
                if (jh)
                {

                    /*var1 =  parseInt(jh);
                     if(var1 != jh)
                     {
                     alert("Atencion: El numero de Radicado debe ser de solo Numeros.");
                     return false;
                     }else{*/
                    numCaracteres = document.getElementById('nurad').value.length;
                    if (numCaracteres >= 6)
                    {
                        document.FrmBuscar.submit();
                    } else
                    {
                        alert("Atendcion: El numero de Caracteres del radicado es de 14. (Digito :" + numCaracteres + ")");
                    }

                    //}
                } else {
                    //document.FrmBuscar.submit();
                    alert("Atención: El campo de consulta no debe estar vacio");
                }
            }
        </script>

    </head>

    <body onLoad='document.getElementById("nurad").focus();'>
<!--        <table border=0 width=100% class="borde_tab" cellspacing="5">
            <tr align="center" class="titulos5">
                <td height="15" class="titulos5">MODIFICACION DE RADICADOS </td>
            </tr>
        </Table>-->
        <br>
    <center>
        <form action='NEW.php?<?= session_name() . "=" . session_id() . "&krd=$krd" ?>&Submit3=ModificarDocumentos'  name="FrmBuscar" class=celdaGris method="POST">
            <table width="80%" class='borde_tab' border="2" cellspacing='5'>
                <tr>
                <div id="titulo" style="width: 80%;" align="center">Modificación de Radicados</div>
                </tr>
                <tr class='titulos2'> 
                    <td width="25%" height="49">Número de Radicado</td>
                    <td width="55%" class=listado2>
                        <input type='text' style="width: 35%;" name=nurad class=tex_area id=nurad>
                        <input type=hidden name=modificarRad Value="ModificarR" id=modificarRad> 
                        <input type=hidden name=Buscar Value="Buscar Radicado"> 
                        <input type=button align="right" name=Buscar1 Value="Buscar Radicado" class=botones_largo onclick="solonumeros();"> 
                    </td>
                </tr>
            </table>
        </form>
    </center>
</body>
</html>
