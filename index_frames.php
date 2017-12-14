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


error_reporting(0);
session_start();
$ruta_raiz = ".";
$imagenes = $_SESSION["imagenes"];
include ('config.php');
?>
<html>
    <head>
        <title>.:: Sistema de Gesti&oacute;n Documental ::.</title>
        <!--<link rel="shortcut icon" href="imagenes/arpa.gif">-->
        <!--By skinatech-->
        <link rel="shortcut icon" href="<?= $imagenes ?>/orfeolibre.ico">
        <link href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>bootstrap.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="<?= $ruta_raiz . $ESTILOS_PATH2 ?>header.css">
        <script src="estilos/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="estilos/js/bootstrap.min.js" type="text/javascript"></script>        
        <script>
            function cerrar_ventana() {
                window.close();
            }
<?php if ($_SESSION["usua_perm_lectpant"] == 1) { ?>
                /*function FrameChg() { 
                 var rta = confirm("!! Se ha actualizado el area de trabajo ¡¡.\n\n ¿ Quiere situarse en ella ?.");
                 if (rta){
                 document.all.mainFrame.focus();
                 document.all.leftFrame.blur();
                 document.all.topFrame.blur();
                 document.getElementById('mainFrame').click();
                 } 
                 }*/
<?php } ?>
        </script> 

        <script language="JavaScript" type="text/JavaScript"> 
            var contentMainFrame;
            function cerrar_session() {
                if (confirm('Est\xe1 seguro de Cerrar Sesion ?')){
                    fecha = <?= date("Ymdhms")?>;
                    <?$fechah = date("Ymdhms")?>
                    nombreventana="ventanaBorrar"+fecha;
                    url="login.php?adios=chao";
                    document.form_cerrar.submit();
                }
            }

            function cambContrasena() {
                url = 'contraxx.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah" ?>';
                document.form_cerrar.action=url;
                document.form_cerrar.submit();
            }
            
            function frameLoad() {
                //Cargo el conenido del frame principal cada que este cambia
                contentMainFrame = document.getElementById('mainFrame').contentWindow;
                
                atributesMainFrame = document.getElementById('mainFrame').contentDocument;
                
                var chkRows = atributesMainFrame.getElementsByClassName('chkrow');
                var check=document.getElementById("mainFrame").contentWindow;
                var menu = document.getElementById('bottomMenu');
                
                if(check.visible===true){
                menu.style.visibility  = 'visible';
                
                if(check.archivarPerm===true){
                    document.getElementById('archivarPerm').style.visibility= 'visible';
                    }
                    
                 if(check.NRRPerm===true){
                    document.getElementById('NRR').style.visibility= 'visible';
                    }
                    
                     if(check.VOBOPerm===true){
                    document.getElementById('VOBO').style.visibility= 'visible';
                    }
                }else{
                menu.style.visibility  = 'hidden';
                }

                  for (var i = 0; i < chkRows.length; i++) {
                     chkRows[i].addEventListener("click", function(){
                           var oneCheck = 0;
                          for (var i = 0; i < chkRows.length; i++) {
                            if(chkRows[i].checked){
                                oneCheck = oneCheck+1;
                                menu.classList.add("upBot");
                                break;
                            }
                          }
                         if(oneCheck==0){
                         menu.classList.remove("upBot"); 
                         }
                      });
                    }
             }
             
             function topMenuLoad(){
                var leftMenu = document.getElementById("leftFrame").contentDocument;
                
                var tag = leftMenu.getElementsByClassName("menu1");
                var tag2 = leftMenu.getElementsByClassName("menu2");
                var tag3 = leftMenu.getElementsByClassName("menu3");
                var ul = document.getElementById("submenu");
                var ul2 = document.getElementById("submenu2");
                var ul3 = document.getElementById("submenu3");
                
                var subli = document.createElement("li");
                ul3.appendChild(subli);

                var aCarp = document.createElement("a");
                aCarp=leftMenu.getElementById("submenu3item");
                subli.appendChild(aCarp);
                               
                var ulCarp = document.createElement("ul");
                ulCarp.className="red";
                ulCarp.id="submenusub";
                subli.appendChild(ulCarp);
                              
                var liCarpUl2 = document.createElement("li");
                var aCarpUl2 = document.createElement("a");         
                aCarpUl2=leftMenu.getElementById("itemNuevaCarp");
                liCarpUl2.appendChild(aCarpUl2);
                ulCarp.appendChild(liCarpUl2);
                
                var itemsSubmenu3 = leftMenu.getElementsByClassName('itemsSubmenu3');

                for (key in itemsSubmenu3){
                    if(itemsSubmenu3.length!=0){
                        var lii = document.createElement("li");
                        lii.appendChild(itemsSubmenu3[0]);
                        ulCarp.appendChild(lii);
                    }
                }
                //Elementos de menu
                for (key in tag){
                    if(tag.length!=0){
                        var li = document.createElement("li");
                        li.appendChild(tag[0]);
                        ul.appendChild(li);
                    }
                }
                //Elementos de radicacion
                   for (key in tag2){
                    if(tag2.length!=0){
                        var li2 = document.createElement("li");
                        li2.appendChild(tag2[0]);
                        ul2.appendChild(li2);

                    }
                } 
                //Elementos de carpetas
                   for (key in tag3){
                    if(tag3.length!=0){
                        var li3 = document.createElement("li");
                        li3.appendChild(tag3[0]);
                        ul3.appendChild(li3);
                    }
                }       
            }
        </script>

    </head>
    <body  style="overflow: hidden;">
        <header>
            <div class="row">
                <div class="col-md-3">
                    <div id="imgtop">
                        <img src="estilos/orfeo50/imagenes50/menu.png" alt="">
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="http://www.skinatech.com"><img src="estilos/orfeo50/imagenes50/sgd.png" class="orf2" alt="Skina technologies"></a>
                </div>
                <div class="col-md-2">
                    <img src="estilos/orfeo50/imagenes50/logo.png" <?php echo ($_SESSION["logoSuperiorOrfeo"]==true)?"":"style=\"visibility:hidden;\"";?> class="orf" alt="">
                </div>
                <div class="col-md-5 ">
                    <nav id="menu">
                        <form name=form_cerrar action=cerrar_session.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah" ?> target=_parent method=post>
                            <ul>
                                <li><a href="#" onclick="document.getElementById('mainFrame').contentWindow.showSearchTable();"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a><p>Buscar</p></li>
                                <li><a href="../quixplorer/" target="Ayuda_Orfeo"><span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span></a><p>Ayuda</p></li>
                                <li><a href="mod_datos.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah&krd=$krd&info=false" ?>" target="mainFrame"><span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></a><p>Info</p></li>
                                <li><a href="menu/creditos.php?<?= session_name() . "=" . session_id() . "&fechah=$fechah&krd=$krd&info=false" ?>" target="mainFrame"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span></a><p>Créditos</p></li>
                                <?php
                                if ($autentica_por_LDAP == 0) {
                                    ?>
                                    <li><a href="javascript:cambContrasena()"><span class="glyphicon glyphicon-option-horizontal" aria-hidden="true"></span></a><p>Contraseña</p></li>
                                    <?php
                                }
                                ?>
                                <li><a href="./estadisticas/vistaFormConsulta.php?<?= session_name() . "=" . trim(session_id()) . "&fechah=$fechah" ?>" target="mainFrame"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span></a><p>Estadísticas</p></li>
                                <li><a href="#" onClick="cerrar_session();" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a><p>Cerrar</p></li>     
                            </ul>
                        </form>
                    </nav>
                </div>
            </div>

            <div id="header">
                <nav> 
                    <ul class="nav">
                        <li class="border-b"><a><span class="glyphicon glyphicon-list"></span>
                                <ul class="red" id="submenu">
                                    <li class="botline"><a href="#"><strong>Menú</strong></a></li>
                                </ul>
                            </a>
                        </li>

                        <li><a href=""><span class="glyphicon glyphicon-folder-close"></span>
                                <ul class="red" id="submenu2">
                                    <li class="botline"><a href="#"><strong>Radicación</strong></a></li>
                                </ul>
                            </a>
                        </li>

                        <li class="radius-le"><a href="#">
                                <span class="glyphicon glyphicon-folder-open"></span>
                                <ul class="red" id="submenu3">
                                    <li class="botline"><a href="#"><strong>Carpetas</strong></a></li>
                                </ul>
                            </a>
                        </li>
                    <!--<li class="border-b"><a href="">Listado por: Leido</a></li>
                        <li class="radius-le"><a href="">No leídos</a></li>-->
                        <li class="border-b"><a href="#"><span class="glyphicon glyphicon-user"></span> <?= $_SESSION['usua_nomb'] ?></a></li>
                        <li class="">
                            <a href="#"><?= $_SESSION['depe_nomb'] ?> <span class="glyphicon glyphicon-home"></span></a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header> 

        <!--<iframe id='mainFrame' name="mainFrame" src='cuerpo.php?<?= session_name() . "=" . session_id() ?>&swLog=<?= $swLog ?>&fechah=<?= $fechah ?>&tipo_alerta=1&nomcarpeta=Entrada' frameborder="0"  style="overflow: auto;  width: 100%; height: 72%; position: absolute; margin-top: 167px;"  height="100%" width="50%"  onload="frameLoad(this)"></iframe>-->
        <iframe id='leftFrame' name="leftFrame" src='correspondencia.php?<?= session_name() . "=" . session_id() ?>&fechah=<?= $fechah ?>' style="visibility: hidden;" onload="topMenuLoad(this)" ></iframe>
        <iframe class="iframeclass" id='mainFrame' name="mainFrame" src='cuerpo.php?<?= session_name() . "=" . session_id() ?>&swLog=<?= $swLog ?>&fechah=<?= $fechah ?>&tipo_alerta=1&nomcarpeta=Entrada' frameborder="0" onload="frameLoad(this)"></iframe>

        
        
        <!--<frameset rows="75,864*" frameborder="NO" border="0" framespacing="0" cols="*">
        <frame name="topFrame" id="topFrame" scrolling="NO" noresize src='f_top.php?<?= session_name() . "=" . session_id() ?>&fechah=<?= $fechah ?>' title="Encabezado y Menu de opciones, Este marco contiene la listas de opciones basicas del aplicativo, ayudas e información del mismo" >
        <frameset cols="175,947*" border="0" framespacing="0" rows="*">
        <frame name="leftFrame" id='leftFrame' scrolling='AUTO' src='correspondencia.php?<?= session_name() . "=" . session_id() ?>&fechah=<?= $fechah ?>' marginwidth='0' marginheight='0' scrolling='AUTO' title="Menu de funcionalidades,Este marco contiene vinculos a las funciones del aplicativo, menu de radicaci&oacute;n  y administraci&oacute;n de bandejas y/o carpetas">
        <frame name='mainFrame' id='mainFrame' onLoad=""  src='cuerpo.php?<?= session_name() . "=" . session_id() ?>&swLog=<?= $swLog ?>&fechah=<?= $fechah ?>&tipo_alerta=1&nomcarpeta=Entrada' scrolling='AUTO' title="Area de trabajo, En esta area se cargan y visualizan los diferentes menus y funcionalidades seleccionadas desde el menu de funcionalidades">
        <frame src="UntitledFrame-3">
        </frameset>
        </frameset>-->

        <div id="bottomMenu" class="bot" style="visibility: hidden;">
            <nav>
                <ul>
                    <li><a href="#" onclick="contentMainFrame.changedepesel(10);contentMainFrame.seleccionBarra = 10;"><span data-toggle="tooltip" data-placement="top" title="Mover A" class="glyphicon glyphicon-play"></span></a></li>
                    <li><a href="#" onclick="contentMainFrame.changedepesel(9);contentMainFrame.seleccionBarra = 9;"><span data-toggle="tooltip" data-placement="top" title="Reasignar" class="glyphicon glyphicon-log-in"></span></a></li>
                    <li><a href="#" onclick="contentMainFrame.changedepesel(8);contentMainFrame.seleccionBarra = 8;"><span data-toggle="tooltip" data-placement="top" title="Informar" class="glyphicon glyphicon-exclamation-sign"></span></a></li>
                    <li><a href="#" onclick="contentMainFrame.changedepesel(12);contentMainFrame.seleccionBarra = 12;"><span data-toggle="tooltip" data-placement="top" title="Devolver" class="glyphicon glyphicon-new-window"></span></a></li>
                    <li><a href="#" id="VOBO" style="visibility: hidden"><span  data-toggle="tooltip" data-placement="top" title="Visto Bueno" onclick="contentMainFrame.vistoBueno();contentMainFrame.seleccionBarra = 14;" class="glyphicon glyphicon-ok-sign "></span></a></li>
                    <li><a href="#" onclick="contentMainFrame.changedepesel(61);contentMainFrame.seleccionBarra = 61;"><span data-toggle="tooltip" data-placement="top" title="TRD" class=""><img src="estilos/orfeo50/imagenes50/TRD_1.png" alt="TRD" style="width: 29px;height: 29px;margin-top: -3px;" /></span></a></li>
                    <li><a href="#" onclick="contentMainFrame.changedepesel(62);contentMainFrame.seleccionBarra = 62;"><span data-toggle="tooltip" data-placement="top" title="Incluir en expediente" class="glyphicon glyphicon-log-out"></span></a></li>
                    <li><a href="#" id="archivarPerm" style="visibility: hidden" onclick="contentMainFrame.changedepesel(13);contentMainFrame.seleccionBarra = 13;"><span data-toggle="tooltip" data-placement="top" title="Archivar" class="glyphicon glyphicon-folder-open"></span></a></li>
                    <li style="display: none;"><a href="#" id="NRR" style="visibility: hidden"><span data-toggle="tooltip" data-placement="top" title="NRR" onclick="contentMainFrame.changedepesel(16);contentMainFrame.seleccionBarra = 16;">N</span></a></li>
<!--                    <li><a href="#"><span title="?" class="glyphicon glyphicon-file"></span></a></li>
                    <li><a href="#"><span title="?" class="glyphicon glyphicon-stats"></span></a></li>-->
                    <li><a href="#" onclick="contentMainFrame.showCalendarTable();"><span data-toggle="tooltip" data-placement="top" title="Calendario" class="glyphicon glyphicon-calendar"></span></a></li>
                </ul>
            </nav>
        </div>

        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>

    </body>
</html>
