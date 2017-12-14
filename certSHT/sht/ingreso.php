<?php
session_start();

if (isset($_SESSION["USER_LOGGED"]) || $_SESSION["USER_LOGGED"] == "AUTENTICADO") {
    header("Location : ./solicitud.php");
}

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
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
        <!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->
    </head>
    <body>
        <div class="container">     
            <!-- Codrops top bar -->
            <!--/ Codrops top bar -->
            
            <header>
                <div class="logo">
                    <img align="center" src="./images/logo_sht.png" height="10%" >
                    <h1><strong>SOLICITUD DE CERTIFICACI&Oacute;N</strong></h1>
                </div>
            
                <nav class="codrops-demos">
                </nav>
                
                <div class="support-note"><!-- let's check browser support with modernizr -->
                    <!--span class="no-cssanimations">CSS animations are not supported in your browser</span-->
                    <span class="no-csstransforms">!! Su Navegador No Soporta Las Animaciones De Esta P&aacute;gina ¡¡.</span>
                    <!--span class="no-csstransforms3d">CSS 3D transforms are not supported in your browser</span-->
                    <span class="no-csstransitions">!! Su Navegador No Soporta Las Transiciones De Esta P&aacute;gina ¡¡.</span>
                    <span class="note-ie">!! Lo Sentimos, Use un Navegador Reciente ¡¡.</span>
                </div>
                
            </header>
            
            <section class="main">

                <form action="./solicitud.php" class="form" method="post">
                        <br>
                        <input type="text" name="idPerson" id="idPerson" title="Cédula de ciudadania" placeholder="Cédula de ciudadania"
                        required pattern="[0-9-.]+" class="input-block-level" maxlength="">
                        <div align="center">
                            <button title="limpiar" class="btn btn-large btn-primary" type="reset">LIMPIAR</button>
                            <button title="Ingresar" class="btn btn-large btn-primary" type="submit">INGRESAR</button>
                        </div>
            
            </section>
	 	<?php if ($_GET["error"] != '' && $_GET["error"] != null &&
			   $_GET["error"] == 1) {
			echo "<center><span style='color:red;'>NO SE PUEDE ENCONTRAR LA INFORMACI&Oacute;N DE LA CEDULA DIGITADA</span></center>";

		      }           
		?> 
        </div>
    </body>
</html>



