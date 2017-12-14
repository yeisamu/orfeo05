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

    if (!$user) {
        $_SESSION["USER_ID_PERSON"]      = $res_user->fields["ID_PERSON"];
        $_SESSION["USER_NAME"]           = $res_user->fields["NAME"];
        $_SESSION["USER_CONTRACT"]       = $res_user->fields["CONTRACT"];
        $_SESSION["USER_POSITION"]       = $res_user->fields["POSITION"];
        $_SESSION["USER_BFC"]            = $res_user->fields["BFC"];
        $_SESSION["USER_ADMISSION_DATE"] = $res_user->fields["ADMISSION_DATE"];
        $_SESSION["USER_COMMISSION"]     = $res_user->fields["COMMISSION"];
        $_SESSION["USER_LOGGED_DATE"]    = date("Y/m/d h:i:s");
        $_SESSION["USER_LOGGED"]         = "AUTENTICADO";
    }
}

if (!isset($_SESSION["USER_LOGGED"])) {
    header("Location: ./ingreso.php");
    die();
}


//select CERT.id_type, CERT.file_name, CERT.type_desc, VAR.var_name, VAR.id_var from cert_types CERT INNER JOIN cert_variables VAR ON CERT.v1=VAR.id_var WHERE CERT.type_enable = 1
if ($_GET["id_cert"] != '' && $_GET["id_cert"] != null && isset($_GET["id_cert"])) {
    $id_cert    = $_GET["id_cert"];
    $query_cert = "SELECT * FROM CERT_TYPES WHERE TYPE_ENABLE= 1 AND ID_TYPE =".$id_cert;
       
    $array_cert = $db->query($query_cert);

    if (!$array_cert) {
        header("Location: ./solicitud.php");
        die();
    }

    $query_var  = "SELECT * FROM CERT_VARIABLES";
       
    $array_var  = $db->query($query_var);

    /**
    *   Realizo Ciclo para listar las certificaciones
    */
    $valor = "";
    foreach ($array_cert as $key) {
        $i = 1;
        foreach ($array_var as $var) {
            if ($key["V".$i] == 1) {
                switch ($i) {
                    case 1:
                        $variables .='<label for="name">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="name" id="name" title="Nombres y apellidos del solitante"
                        placeholder="Nombres y Apellidos"required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+"
                        class="input-block-level" readonly maxlength="" size="'.strlen($_SESSION["USER_NAME"]).'" value="'.$_SESSION["USER_NAME"].'">';
                        break;
                    case 2:
                        $variables .='<label for="idPerson">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="idPerson" id="idPerson" title="Cédula de ciudadania" placeholder="Cédula de ciudadania"
            required pattern="[0-9-.]+" class="input-block-level" readonly maxlength="" size="'.strlen($_SESSION["USER_ID_PERSON"]).'" value="'.$_SESSION["USER_ID_PERSON"].'">';
                        break;
                    case 3:
                        $variables .='<label for="contractTerm">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="contractTerm" id="contractTerm" title="Termino del contrato" placeholder="Termino del contrato"
            required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="" readonly size="'.strlen($_SESSION["USER_CONTRACT"]).'"  value="'.$_SESSION["USER_CONTRACT"].'">';
                        break;
                    case 4:
                        $variables .='<label for="position">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="position" id="position" title="Cargo" placeholder="Cargo"
            required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="" readonly value="'.$_SESSION["USER_POSITION"].'" size="'.strlen($_SESSION["USER_POSITION"]).'">';
                        break;
                    case 5:
                        $variables .='<label for="salary">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="salary" id="salary" title="Salario" placeholder="Salario"
            required pattern="[0-9-.]+"  class="input-block-level" maxlength="" readonly value="'.$_SESSION["USER_SALARY"].'" size="'.strlen($_SESSION["USER_SALARY"]).'" >';
                        break;
                    case 6:
                        $variables .='<label for="bfc">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="bfc" id="bfc" title="Caja de compensación familiar" placeholder="Caja de compensación familiar"
            required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+" class="input-block-level" maxlength="" readonly value="'.$_SESSION["USER_BFC"].'" size="'.strlen($_SESSION["USER_BFC"]).'" >';
                        break;
                    case 7:
                        $variables .='<label for="admissionDate">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="admissionDate" id="admissionDate" title="Fecha de Ingreso (AAAA-MM-DD)" placeholder="Fecha Ingreso (AAAA-MM-DD)" 
            required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" class="input-block-level" maxlength="" readonly value="'.$_SESSION["USER_ADMISSION_DATE"].'">';
                        break;
                    case 9:
                        $variables .='<label for="commissions">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="commissions" id="commissions" title="Comisiones" placeholder="Comisiones"
            required pattern="[0-9-.]+" class="input-block-level" maxlength="" readonly value="'.$_SESSION["USER_COMMISSION"].'">';
                        break;
                    case 8:
                        $variables .='<label for="requestOf">'.$var["VAR_NAME"].': </label>
                        <input type="text" name="requestOf" id="requestOf" title="A solicitud de :" placeholder="A solicitud de:"
            required pattern="[a-zA-Z- áéíóúñúüàèÁÉÍÓÚÜÑ]+"  class="input-block-level" maxlength="">';
                        break;
                    default:
                        break;
                }
               
            }
            $i++;
        }
    }


} else {
    header("Location: ./solicitud.php");
    die();
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
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,700' rel='stylesheet' type='text/css' />
        <script type="text/javascript" src="js/modernizr.custom.79639.js"></script> 
        <link rel="stylesheet" type="text/css" href="css/estilos.css">
        <script type="text/javascript" src="js/jquery-1.9.1.js"></script>
        <script type="text/javascript" src="js/funciones.js"></script>
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


<?php

if (isset($_POST['name'])) { 

// Recolecion de variables

$category = $_POST['category'];
$name = $_POST['name'];
$idPerson = $_POST['idPerson'];
$idPlace = $_POST['idPlace'];
$contractTerm = $_POST['contractTerm'];
$positon = $_POST['position'];
$salary = $_POST['salary'];
$bfc = $_POST['bfc'];
$admissionDate = $_POST['admissionDate'];
$commissions = $_POST['commissions'];
$requestOf = $_POST['requestOf'];

// Cargando WS
require_once "nusoap/nusoap.php";

//******* OJO esto esta cableado
$client = new nusoap_client("http://localhost/orfeo/certSHT/sht/certi_SHT.php?wsdl",true);

$error = $client->getError();

if ($error) {
    echo "<h2>Constructor error</h2><pre>" . $error . "</pre>";
}
 
$result = $client->call("genRadi", array("category" => $category,
                                         "name" => $name,
                                         "idPerson" => $idPerson,
                                         "idPlace" => $idPlace,
                                         "contractTerm" => $contractTerm,
                                         "position" => $position,
                                         "admissionDate" => $admissionDate,
                                         "salary" => $salary,
                                         "bfc" => $bfc,
                                         "requestOf" => $requestOf,
                                         "commissions" => $commissions));
 
if ($client->fault) {
    echo "<h2>Fault</h2><pre>";
    print_r($result);
    echo "</pre>";
}
else {
    $error = $client->getError();
    if ($error) {
        echo "<h2>Error</h2><pre>" . $error . "</pre>";
    }
    else {
        echo '<div class="button"><a href="'.$result.'" target="_blank" onclick="javascript:window.location=\'./solicitud.php\'">DESCARGAR CERTIFICADO</a>
<p class="pcss top">CLICK PARA DESCARGAR</p>
      <p class="pcss bottom">PDF / '.filesize($result).' BYTES</p>
	</div>';
    }
}

} else {

?>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" class="form" method="post">
                    <fieldset>
                    <legend>CONFIRME SUS DATOS DE LA CERTIFICACI&Oacute;N</legend>
                        <input type="hidden" name="category" id="category" value="<?php echo $id_cert;?>">
                    <?php
                        echo $variables;
                    ?>
                    <center>
                        <button title="Confirmar" class="btn btn-large btn-primary" type="submit">CONFIRMAR</button>
                        <button title="enviar" class="btn btn-large btn-primary" onclick="javascript:window.location='./solicitud.php'" type="button">CANCELAR</button>
                    </center>
                    </fieldset>
                    </form>                
<?php }?>
         </div>   
    </body>
</html>
