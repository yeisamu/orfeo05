<?
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
// Modificado SGD 20-Septiembre-2007
/**
 * Paggina Cuerpo.php que muestra el contenido de las Carpetas
 * Creado en la SSPD en el año 2003
 * 
 * Se añadio compatibilidad con variables globales en Off
 * @autor Jairo Losada 2009-05
 * @licencia GNU/GPL V 3
 */
foreach ($_GET as $key => $valor)
    ${$key} = $valor;
foreach ($_POST as $key => $valor)
    ${$key} = $valor;

define('ADODB_ASSOC_CASE', 1);

$krd = $_SESSION["krd"];
$dependencia = $_SESSION["dependencia"];
$usua_doc = $_SESSION["usua_doc"];
$codusuario = $_SESSION["codusuario"];
$tip3Nombre = $_SESSION["tip3Nombre"];
$tip3desc = $_SESSION["tip3desc"];
$tip3img = $_SESSION["tip3img"];

$imagenes = $_SESSION["imagenes"];

$ruta_raiz = ".";
include_once "$ruta_raiz/include/db/ConnectionHandler.php";
$db = new ConnectionHandler($ruta_raiz);
//$db->conn->debug = true;
?>
<html>
    <head>
        <script language="JavaScript" type="text/JavaScript">
            function MM_findObj(n, d) { //v4.01
            var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
            d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
            if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
            for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
            if(!x && d.getElementById) x=d.getElementById(n); return x;
            }

            function MM_validateForm() { //v4.0
            var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
            for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
            if (val) { nm=val.name; if ((val=val.value)!="") {
            if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
            if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
            } else if (test!='R') { num = parseFloat(val);
            if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
            if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
            min=test.substring(8,p); max=test.substring(p+1);
            if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
            } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' es requerido.\n'; }
            } if (errors) alert('Asegurese de entrar el password Correcto, \n No puede ser Vacio:\n');
            document.MM_returnValue = (errors == '');
            }

        </script>
        <title>Formulario cambio de Contrase&ntilde;as</title>
        <!--<link rel="stylesheet" href="estilos/orfeo.css">-->
        <link href="estilos/orfeo50/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="estilos/orfeo50/cambioContrasena.css" rel="stylesheet" type="text/css"/>
    </head><?php
    $db->conn->SetFetchMode(ADODB_FETCH_ASSOC);
    $numeroa = 0;
    $numero = 0;
    $numeros = 0;
    $numerot = 0;
    $numerop = 0;
    $numeroh = 0;
    $isql = "select a.*,b.depe_nomb from usuario a,dependencia b where USUA_LOGIN ='$krd' and a.depe_codi=b.depe_codi";
    $rs = $db->query($isql);
//echo $row["usuario"].$krd;
    echo "<font size=1 face=verdana>";
    $contraxx = $rs->fields["USUA_PASW"];

    if (trim($rs->fields["USUA_LOGIN"]) == $krd) {
        $dependencia = $rs->fields["DEPE_CODI"];
        $dependencianomb = $rs->fields["DEPE_NOMB"];
        $codusuario = $rs->fields["USUA_CODI"];
        $contraxx = $rs->fields["USUA_PASW"];
        $nivel = $rs->fields["CODI_NIVEL"];
        $iusuario = " and us_usuario='$krd'";
        $perrad = $rs->fields["PERM_RADI"];
        ?>
        <body>
            <center>
            <form action='usuarionuevo.php?<?= session_name() . "=" . session_id() ?>&krd=<?= $krd ?>' method=post onSubmit="MM_validateForm('contradrd', '', 'R', 'contraver', '', 'R');return document.MM_returnValue">
            <div class="flotante">
                <h2>Cambio de contraseña Usuarios</h2>
                <h4>Por favor introduzca la nueva contraseña</h4>
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 box">
                        <input type=hidden name='usuarionew' value="<?= $krd ?>">
                        <p>Usuario</p>
                        <input type="text" name="" value="<?= $krd ?>">
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 box">
                        <p>Nueva contraseña</p>
                        <input type=password name=contradrd vale='' class=tex_area title='Ingrese nueva contraseña para el usuario <?= $krd ?>'>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 box">
                        <p>Confirmar la contraseña</p>
                        <input type=password name=contraver class=tex_area vale='' title='Ingrese nuevamente su contraseña para el usuario <?= $krd ?>'>
                    </div>
                </div>
                <input type=hidden value="<?= $depsel ?>" name=depsel>
                <button type="submit" name="button" class="but">Cambiar  contraseña</button>
                <br>
            </div>
            </center>

            <?php
            $isql = "select depe_codi,depe_nomb from DEPENDENCIA ORDER BY DEPE_NOMB";
            $rs = $db->query($isql);
            $numerot = $rs->RecordCount();
            ?>
    <!--                                            <br><input type=submit value='Cambiar contrase&ntilde;a' class=botones_largo>
                                                <br><input type=hidden value=<?= $depsel ?> name=depsel>
                                                </form>-->
                </form>
            <?
        } else {
            echo "<b>No esta Autorizado para entrar </b>";
        }
        ?>
    </body>
</html>
