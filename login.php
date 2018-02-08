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


/** FORMULARIO DE LOGIN A ORFEO
 * Aqui se inicia session 
 * @PHPSESID		String	Guarda la session del usuario
 * @db 					Objeto  Objeto que guarda la conexion Abierta.
 * @iTpRad				int		Numero de tipos de Radicacion
 * @$tpNumRad	array 	Arreglo que almacena los numeros de tipos de radicacion Existentes
 * @$tpDescRad	array 	Arreglo que almacena la descripcion de tipos de radicacion Existentes
 * @$tpImgRad	array 	Arreglo que almacena los iconos de tipos de radicacion Existentes
 * @query				String	Consulta SQL a ejecutar
 * @rs					Objeto	Almacena Cursor con Consulta realizada.
 * @numRegs		int		Numero de registros de una consulta
 */

if (isset($_POST["krd"]))
    $krd = $_POST["krd"];

if (isset($_POST["drd"]))
    $drd = $_POST["drd"];
if (isset($_POST["autenticaPorLDAP"]))
    $autenticaPorLDAP = $_POST["autenticaPorLDAP"];
$fechah = date("dmy") . "_" . time("hms");
$ruta_raiz = ".";
$usua_nuevo = 3;
error_reporting('E_ALL');
include_once("config.php");
$serv = str_replace(".", ".", $_SERVER['REMOTE_ADDR']);

if ($krd) {
    include "$ruta_raiz/session_orfeo.php";
    require_once("$ruta_raiz/class_control/Mensaje.php");
    //$db->conn->debug = true;

    if ($usua_nuevo == 0) {
        include($ruta_raiz . "/contraxx.php");
        $ValidacionKrd = "NOOOO";
        if ($j = 1)
            die("<center> -- </center>");
    }
}
$krd = strtoupper($krd);
$datosEnvio = "$fechah&" . session_name() . "=" . trim(session_id()) . "&krd=$krd&swLog=1";
?>
<head>
    <title>.:: ORFEO, M&oacute;dulo de validaci&oacute;n::.</title>
    <!--    <link href="estilos/orfeo.css" rel="stylesheet" type="text/css">-->

    <link rel="stylesheet" href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>login.css">
    <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>

    <!--<link rel="shortcut icon" href="imagenes/arpa.gif">-->
    <!--By skinatech-->
    <link rel="shortcut icon" href="<?= $imagenes ?>/orfeolibre.ico">
    <script language="JavaScript" type="text/JavaScript">
        <!--
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
        } if (errors) alert('Asegurese de entrar usuario y password correctos:\n'+errors);
        document.MM_returnValue = (errors == '');
        }
        // Script Source: CodeLifter.com
        // Copyright 2003
        // Do not remove this header
        //-->
    </script>
    <script>
        isIE = document.all;
        isNN = !document.all && document.getElementById;
        isN4 = document.layers;
        isHot = false;
        var tempX = 0;
        var tempY = 0;
        //alert(isN4);
        function ddInit(e) {

            hotDog = isIE ? event.srcElement : e.target;
            topDog = isIE ? "BODY" : "HTML";

            //capa = 

            while (hotDog.id.indexOf("Mensaje") == -1 && hotDog.tagName != topDog) {
                hotDog = isIE ? hotDog.parentElement : hotDog.parentNode;
            }
            size = hotDog.id.length;
            capa = (hotDog.id.substring(size - 1, size)); //returns "exce"
            whichDog = isIE ? document.all.theLayer : document.getElementById("capa" + capa);
            if (hotDog.id.indexOf("Mensaje") != -1) {

                offsetx = isIE ? event.clientX : e.clientX;
                offsety = isIE ? event.clientY : e.clientY;
                nowX = parseInt(whichDog.style.left);
                nowY = parseInt(whichDog.style.top);
                ddEnabled = true;
                document.onmousemove = dd;
            }
        }

        function dd(e) {

            if (!ddEnabled)
                return;
            whichDog.style.left = isIE ? nowX + event.clientX - offsetx : nowX + e.clientX - offsetx;
            whichDog.style.top = isIE ? nowY + event.clientY - offsety : nowY + e.clientY - offsety;
            return false;
        }

        function ddN4(layer) {

            isHot = true;
            // if (!isN4) return;
            if (document.layers)
                isN4 = document.layers
            else if (document.all)
                isN4 = document.all[layer];
            else if (document.getElementById)
                isN4 = document.getElementById(layer);

            N4 = document.getElementById(layer);

            //alert (document.all);		
            if (document.all)
                alert("hay documento ");
            // N4 = isN4;
            // alert (document.layers);
            //alert ("va...");
            // alert (N4); 
            window.captureEvents(Event.MOUSEDOWN | Event.MOUSEUP);
            N4.onmousedown = function (e) {
                tempX = e.pageX;
                tempY = e.pageY;


            }

            isN4.onmousemove = function (e) {

                if (isHot) {
                    if (document.layers) {
                        document.layers[layer].left = e.pageX - tempX;
                    } else if (document.all) {
                        document.all[layer].style.left = e.pageX - tempX;
                    } else if (document.getElementById) {
                        document.getElementById(layer).style.left = e.pageX - tempX;
                    }
                    // Set ver 
                    if (document.layers) {
                        document.layers[layer].top = e.pageY - tempY;
                    } else if (document.all) {
                        document.all[layer].style.top = e.pageY - tempY;
                    } else if (document.getElementById) {
                        document.getElementById(layer).style.top = e.pageY - tempY
                    }

                    // N4.moveBy( e.pageX-tempX,e.pageY-tempY);
                    return false;
                }
            }
            N4.onmouseup = function () {
                // N4.releaseEvents(Event.MOUSEMOVE);
            }
        }

        function hideMe(layer) {

            if (document.layers)
                document.layers[layer].visibility = 'hide';
            else if (document.all)
                document.all[layer].style.visibility = 'hidden';
            else if (document.getElementById)
                document.getElementById(layer).style.visibility = 'hidden';
        }

        function showMe(layer) {
            if (document.layers)
                document.layers[layer].visibility = 'show';
            else if (document.all)
                document.all[layer].style.visibility = 'visible';
            else if (document.getElementById)
                document.getElementById(layer).style.visibility = 'visible';
        }

        document.onmousedown = ddInit;
        document.onmouseup = Function("ddEnabled=false");

    </script>
    <script>
        function loginTrue()
        {
            document.formulario.submit();
        }
        function loginCorreLibre()
        {
            document.CorreLibre.submit();
        }

    </script>
</head>
<!--<style type="text/css">

    body {
        margin-left: 1px;
        margin-top: 1px;
        margin-right: 1px;
        margin-bottom: 1px;
        color: #387c44;
        background-color: #FFFFFF;
    }
    
</style>-->
<body align=center onLoad='document.getElementById("krd").focus();'>	
    <form name=formulario action='./index_frames.php?fechah=<?= $datosEnvio ?>'  method=post >
        <input type="hidden" name="orno" value="1">
        <?
        if($ValidacionKrd=="Si")	
        {  
        ?>
        <script>
            loginTrue();
        </script>
        <?
        }
        ?>
        <input type="hidden" name="ornot" value="1">
    </form>

    <div class="pop">

        <section id="top">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 blanco"> 
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 rojo">
                    <img id="logoEntidad"  src="logoEntidad.png">
                </div>
            </div>
            <div class="row">
                <div class=" col-md-6 rojo">
                    <img  src="<?= $ruta_raiz . $imagenes2 ?>sgd.png" alt="">
                </div>
                <div class=" col-md-6 blanco">
                </div>
            </div>
        </section>

        <section id="bot">
            <div class="cuerpo">
                <form action="login.php?fechah=<?= $fechah ?>" method="post" onSubmit="MM_validateForm('krd', '', 'R', 'drd', '', 'R');
                        return document.MM_returnValue" name="form33" >

                    <div class="row col-md-pull-2">
                        <div class="col-xs-5 col-sm-5 col-md-5 ">
                            <p class="boton">Usuario</p>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5">
                            <input type="text" id='krd' name="krd" size="13" class="tex_area"title="Digite su usuario para ingresar" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-5 col-sm-5 col-md-5">
                            <p class="boton">Contrase&ntilde;a</p>
                        </div>
                        <div class="col-xs-5 col-sm-5 col-md-5">
                            <input type=password id="drd" name="drd" size="13" class="tex_area" title="Digite la contraseña del usuario">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-8 col-sm-8 col-md-8" style="text-align:center;">

                            <input type=hidden name=tipo_carp value=0>
                            <input type=hidden name=carpeta value=0>
                            <input type=hidden name=order value='radi_nume_radi'>
                            <br>
                            <input id="btn_frmlog_sub" name="Submit" type="submit" class="botones" value="Ingresar">
                        </div>
                    </div>
                    <!--                    <div id="textoCliente">
                                            <div class="col-xs-9 col-sm-9 col-md-9">
                                                <font  face="Arial Narrow" style="font-weight: bold;color:white;" size="2"><?= $entidad_largo ?></font>
                                            </div>
                                        </div> -->
                </form>
            </div>
        </section>
    </div>
    <!--<iframe  src="http://www.correlibre.org/es/OrfeoGPL/datosOrfeoGPL.php?drv=<?= $driver ?>&entidad=<?= $entidad ?>&entidad_largo=<?= $entidad_largo ?>&entidad_tel=<?= $entidad_tel ?>&entidad_dir=<?= $entidad_dir ?>&pais=<?= $pais ?>&otrosDatos=<?= $administrador . ">*<" . $serv ?>" name="CorreLibreColombia" width="50%" height="1" frameborder="0" scrolling="no"></iframe>-->
</body>
</html>
