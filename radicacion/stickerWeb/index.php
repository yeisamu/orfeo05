<?php
session_start();
$ruta_raiz 		= "../../";
include_once "$ruta_raiz/config.php";
$verradicado        = $verrad;
$krdOld             = $krd;
$menu_ver_tmpOld    = $menu_ver_tmp;
$menu_ver_Old       = $menu_ver;

foreach ($_GET as $key=>$valor)
${$key} = $valor;
foreach ($_POST as $key=>$valor)
${$key} = $valor;
$nomcarpeta = $_GET["nomcarpeta"];
if ($_GET["tipo_carp"])
$tipo_carp = $_GET["tipo_carp"];

$krd            = $_SESSION["krd"           ];
$dependencia    = $_SESSION["dependencia"   ];
$usua_doc       = $_SESSION["usua_doc"      ];
$codusuario     = $_SESSION["codusuario"    ];
$tip3Nombre     = $_SESSION["tip3Nombre"    ];
$tip3desc       = $_SESSION["tip3desc"      ];
$tip3img        = $_SESSION["tip3img"       ];

if (!$krd)
$krd = $krdOld;

$ruta_raiz = "../..";

include_once "$ruta_raiz/include/db/ConnectionHandler.php";

if ($verradicado)
$verrad = $verradicado;

$numrad = $verrad;

$db             = new ConnectionHandler($ruta_raiz);
$db->conn->SetFetchMode(3);

include $ruta_raiz.'/ver_datosrad.php';

// SQL para extraer nombre de la depe destino
$depe_sql = "select depe_nomb
                FROM dependencia
                WHERE depe_codi = '$radi_depe_actu'";
        //echo $isql;
        $rs_depe = $db->conn->Execute($depe_sql);
        $dependenciaDestino = $rs_depe->fields["DEPE_NOMB"];
?>
<html>
<head>
<title>Sticker web</title>
<style type="text/css">

body {
      margin-bottom:0;
                margin-left:0;
                margin-right:0;
                margin-top:0;
                padding-bottom:0;
                padding-left:0;
                padding-right:0;
                padding-top:0
    font-family: Arial, Helvetica, sans-serif;
}

.stik1{
    font-size: 9px;
}

.stik2{
    font-size: 7px;
    text-align: center;
    vertical-align:top;
}
.stik3{
    font-size: 9px;
    text-align: center;
}
font{
    line-height:100%;
}
</style>
<script type="text/javascript" src="jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/jquery-barcode.js"></script>
<script type="text/javascript">
function generateBarcode(){ 
        var value = $("#barcodeValue").val();
        var btype = 'code39';
        var renderer = 'bmp';
        
        var quietZone = false;
        if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')){
          quietZone = true;
        }
                
        var settings = {
          output:renderer,
          bgColor: "#FFFFFF",
          color: "#000000",
          barWidth: "1",
          barHeight: "15",
          moduleSize: "5",
          posX: "10",
          posY: "20",
          addQuietZone: $("#quietZoneSize").val()
        };
        if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')){
          value = {code:value, rect: true};
        }
        if (renderer == 'canvas'){
          clearCanvas();
          $("#barcodeTarget").hide();
          $("#canvasTarget").show().barcode(value, btype, settings);
        } else {
          $("#canvasTarget").hide();
          $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        }
}
          
      function showConfig1D(){
        $('.config .barcode1D').show();
        $('.config .barcode2D').hide();
      }

      function showConfig2D(){
        $('.config .barcode1D').hide();
        $('.config .barcode2D').show();
      }

      function clearCanvas(){
        var canvas = $('#canvasTarget').get(0);
        var ctx = canvas.getContext('2d');
        ctx.lineWidth = 1;
        ctx.lineCap = 'butt';
        ctx.fillStyle = '#FFFFFF';
        ctx.strokeStyle  = '#000000';
        ctx.clearRect (0, 0, canvas.width, canvas.height);
        ctx.strokeRect (0, 0, canvas.width, canvas.height);
      }
      
      $(function(){
        $('input[name=btype]').click(function(){
          if ($(this).attr('id') == 'datamatrix') showConfig2D(); else showConfig1D();
        });
        $('input[name=renderer]').click(function(){
          if ($(this).attr('id') == 'canvas') $('#miscCanvas').show(); else $('#miscCanvas').hide();
        });
        generateBarcode();
      });
</script>
</head>
<?
$noRad = $_REQUEST['nurad'];
$numeroRadSeparado = substr($noRad,0,4)."-".substr($noRad,4,$longitud_codigo_dependencia)."-".substr($noRad,(4+$longitud_codigo_dependencia),6)."-".substr($noRad,-1);
?>
<body topmargin="0" leftmargin="0" onload="generateBarcode();">
    <table width="370px" height="90px" cellpadding="0" cellspacing="0">
<!--<tr>
        <td colspan=2 align=center>
        <center><font size="2">
            <b>Skina Technologies Ltda</b>
        </font> </center>
        </td><tr>-->
      <tr>
	<td colspan=3 width=90px>
          <img src='logoEntidad.png' alt="<?= $_SESSION["entidad"] ?>" width=80px height=55px><strong style="font-size:xx-small;"></strong></td>
        <td colspan=1 align=center>
	    <font size="6" style="font-family:'Free 3 of 9'" width='100%' style="font-size:xx-large; margin-top:50px;">
                <div id="generator">
                    <input type="hidden" id="barcodeValue" value="<?php echo $_REQUEST['nurad']?>">
                    <div id="config">
                         <div class="config" style="display:none">
                              <div class="barcode2D">
                                    Quiet Zone Modules: <input type="text" id="quietZoneSize" value="1" size="3"><br />
                                    Form: <input type="checkbox" name="rectangular" id="rectangular"><label for="rectangular">Rectangular</label><br />
                              </div>
                         </div>
                    </div>
                    <div id="barcodeTarget" class="barcodeTarget"></div>
                    <canvas id="canvasTarget" width="150" height="150"></canvas>
                </div>
            </font>
	    <div  align="left" style="font-size:xx-small; font-size-adjust: -3; line-height:100%; margin-top:7px;">
		 <strong>Rad No. <?=$numeroRadSeparado ?></strong><br>
		 Usu Radicador: <?=$usuarioLoginRadicador?> - Fecha Rad <?=substr($radi_fech_radi,0,16)?> <br>
		 <?php
		 // By Skinatech Jenny Gamez - 02/05/2017
		 // Se evalua si el radicado que se genera es de salida, ya que en este tipo de radicado el stiker se genera de forma distinta
		 // respecto al destinatario y remitente 
		 if(substr($noRad,-1) == 1){
			echo "Rem/Des: ".substr($dependenciaDestino,0,23)."  <br>";
			echo "Destino: ".substr($_GET['remite'],0,50)."  <br>";
		 }else{
			echo "Destino: ".substr($dependenciaDestino,0,23)." <br>";
			echo "Rem/Des: ".substr($_GET['remite'],0,50)."  <br>";
		 }   
		 ?>
		 <strong>Asunto: <?=mb_convert_case(substr($ra_asun,0,24), MB_CASE_UPPER, 'UTF-8')?></strong></br>
		 <?= $_SESSION["entidad"] ?><br>
	    </div>
        </td>
      </tr>
    </table>
</body>
</html>
