<?php
session_start();

$ruta_raiz ="..";
require_once("$ruta_raiz/include/db/ConnectionHandler.php");
if (!$db) {
    $db = new ConnectionHandler("$ruta_raiz");
}

if (isset($_POST["idPerson"]) && $_POST["idPerson"] != "" && $_POST["idPerson"] != null) {

    $id        = $_POST["idPerson"];

    // Limpiando id, quitando espacios y puntos
    $id         =trim(str_replace(".", "", $id));
    
    $query_user = "SELECT * FROM CERT_DATA WHERE ID_PERSON =" .$id;
    
    $res_user   =$db->query($query_user);

    if (!$res_user->EOF) {
        $_SESSION["USER_ID_PERSON"]      = $res_user->fields["ID_PERSON"];
        $_SESSION["USER_NAME"]           = $res_user->fields["NAME"];
        $_SESSION["USER_CONTRACT"]       = $res_user->fields["CONTRACT"];
        $_SESSION["USER_POSITION"]       = $res_user->fields["POSITION"];
        $_SESSION["USER_BFC"]            = $res_user->fields["BFC"];
        $_SESSION["USER_ADMISSION_DATE"] = $res_user->fields["ADMISSION_DATE"];
        $_SESSION["USER_COMMISSION"]     = $res_user->fields["COMMISSION"];
        $_SESSION["USER_LOGGED_DATE"]    = date("Y/m/d h:i:s");
        $_SESSION["USER_LOGGED"]         = "AUTENTICADO";
        $_SESSION["USER_SALARY"]         = $res_user->fields["SALARY"];
    } else {
       header("Location: ./ingreso.php?error=1");
       die();
    }


//select CERT.id_type, CERT.file_name, CERT.type_desc, VAR.var_name, VAR.id_var from cert_types CERT INNER JOIN cert_variables VAR ON CERT.v1=VAR.id_var WHERE CERT.type_enable = 1
    
$query_cert = "SELECT * FROM CERT_TYPES WHERE TYPE_ENABLE= 1";
   
$array_cert = $db->query($query_cert);

$query_var  = "SELECT * FROM CERT_VARIABLES";
   
$array_var  = $db->query($query_var);

/**
*   Realizo Ciclo para listar las certificaciones
*/
$valor = "";
foreach ($array_cert as $key) {
    $i = 1;
    $variables = "<p class='variables'>";

   
    }

}

if (!isset($_SESSION["USER_LOGGED"])) {
    header("Location: ./ingreso.php");
    die();
}


//select CERT.id_type, CERT.file_name, CERT.type_desc, VAR.var_name, VAR.id_var from cert_types CERT INNER JOIN cert_variables VAR ON CERT.v1=VAR.id_var WHERE CERT.type_enable = 1
    
$query_cert = "SELECT * FROM CERT_TYPES WHERE TYPE_ENABLE= 1";
   
$array_cert = $db->query($query_cert);

$query_var  = "SELECT * FROM CERT_VARIABLES";
   
$array_var  = $db->query($query_var);

/**
*   Realizo Ciclo para listar las certificaciones
*/
$valor = "";
$script = "<script type='text/javascript'>";
foreach ($array_cert as $key) {
    $i = 1;
    $variables = "<p class='variables'>";
    foreach ($array_var as $var) {
        if ($key["V".$i] == 1) {
            $variables .= " 
                ".$var["VAR_NAME"]."
            <br>";
        }
        $i++;
    }
    $variables .= "</p>";
    $script .='
	var $img'.$key["ID_TYPE"].' = $(\'#img'.$key["ID_TYPE"].'\');
	var $hover'.$key["ID_TYPE"].' = $(\'#hover'.$key["ID_TYPE"].'\');
	$img'.$key["ID_TYPE"].'.hide();
	$(\'#hover'.$key["ID_TYPE"].'\').mousemove(function(e) {
	    $img'.$key["ID_TYPE"].'.stop(1, 1).fadeIn();
	    $(\'#img'.$key["ID_TYPE"].'\').offset({
	        top: e.pageY - ($hover'.$key["ID_TYPE"].'.outerHeight()),
	        left: e.pageX - ($hover'.$key["ID_TYPE"].'.outerWidth()/1.5)
	    });
	}).mouseleave(function() {
	    $img'.$key["ID_TYPE"].'.fadeOut();
	});'; 
    $valor .= " <li id='hover".$key["ID_TYPE"]."'>
		     <div class='ch-item'>	
                      <span class='title'>".$key['TYPE_DESC']."</span>
                        <div id='cont-item' class='ch-item ch-img-3'>
                            <div class='ch-info'>
                                <h3>".$key['TYPE_DESC']."</h3>
                               <p><a href='./datos.php?id_cert=".$key["ID_TYPE"]."'>SOLICITAR</a></p>
                                ".$variables."
                            </div>
                        </div>
	<div id='img".$key["ID_TYPE"]."'>
	<img class='imgcert' src='../../quixplorer/orfeo/Plantillas/Certificaciones/".$key['TYPE_THUMBNAIL']."'/>
	</div>
                      </div>
                    </li>";
/*	$popups .= "
		<div class='light' id='light".$key["ID_TYPE"]."'><img src='../imagenes/index_web_login.jpg'/></div>
		<div class='fade' id='fade".$key["ID_TYPE"]."' onClick='lightbox_close(".$key["ID_TYPE"].");'></div> ";*/
}

$script .= "</script>";

?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Formulario de solicitud</title>
        <meta name="description" content="Formulario de solicitud Certificacion" />
        <link rel="shortcut icon" href="../favicon.ico"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/common.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
        <script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
        <script type="text/javascript">
	    $( document ).ready(function() {
      		$('.content').offscreen({
		        smartResize: true,
		        rightClass: 'right-edge',
		        leftClass: 'left-edge'
		      });
    				});
	</script>
        <!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">     
            <!-- Codrops top bar -->
            <div class="codrops-top">
                <span class="right">
                    <strong>NOMBRE :</strong><?php echo $_SESSION["USER_NAME"];?><br>
                    <strong>CEDULA :</strong><?php echo $_SESSION["USER_ID_PERSON"];?><br>
                    <strong>FECHA INGRESO :</strong><?php echo $_SESSION["USER_LOGGED_DATE"];?>
                </span>
            </div>
            <!--/ Codrops top bar -->
            
            <header>
                <div class="logo">
                    <img align="center" src="./images/logo_sht.png" height="10%" >
                    <h1><strong>SOLICITUD DE CERTIFICACI&Oacute;N</strong></h1>
                </div>
            
                <nav class="codrops-demos">
                    <button title="limpiar" class="btn btn-large btn-primary" onclick="javascript:window.location='./solicitud.php'" type="button">SOLICITAR</button>
                    <button title="limpiar" class="btn btn-large btn-primary" onclick="javascript:window.location='./logout.php'" type="reset">SALIR</button>
                </nav>
                
                <div class="support-note"><!-- let's check browser support with modernizr -->
                    <!--span class="no-cssanimations">CSS animations are not supported in your browser</span-->
                    <span class="no-csstransforms">!! Su Navegador No Soporta Las Animaciones De Esta P&aacute;gina ¡¡.</span>
                    <!--span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span-->
                    <span class="no-csstransitions">!! Su Navegador No Soporta Las Transiciones De Esta P&aacute;gina ¡¡.</span>
                    <span class="note-ie">!! Lo Sentimos, Use un Navegador Reciente ¡¡.</span>
                </div>
                
            </header>
            <br>
            <section class="main">
            
                <ul class="ch-grid">
                    <?php
                        echo $valor;
                    ?>
                </ul>
                
            </section>
            
        </div>
	<?php
		echo $script;
	?>
    </body>
</html>
