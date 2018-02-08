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


/**
* Administrador de firmas digitales
* Sistema de gestion Documental ORFEO.
* Permite firmar un documento y un certificado para posteriormente firmarlo digitalmente
*/

    session_start(); 
    $ruta_raiz = ".."; 
    
    $krd = $_SESSION["krd"];
    $dependencia = $_SESSION["dependencia"];
    $usua_doc = $_SESSION["usua_doc"];
    $codusuario = $_SESSION["codusuario"];
    
    if($_REQUEST["busqRadicados"]) $busqRadicados=$_REQUEST["busqRadicados"];

echo "busq $busqRadicados";
    //valido sesion
     if(!$_SESSION['dependencia'])        include "$ruta_raiz/rec_session.php";

    require_once("$ruta_raiz/include/db/ConnectionHandler.php");
$db = new ConnectionHandler($ruta_raiz);


    $encabezado = "".session_name()."=".session_id()."&krd=$krd&depeBuscada=$depeBuscada&filtroSelect=$filtroSelect";
    $linkPagina = "$PHP_SELF?$encabezado&orderTipo=$orderTipo&orderNo=";

    // Include the main TCPDF library (search for installation path).
    require_once("$ruta_raiz/include/tcpdf/tcpdf_include.php");

    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Nicola Asuni');
    $pdf->SetTitle('TCPDF Example 052');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 052', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set certificate file
$certificate = 'file://$ruta_raiz/bodega/tmp/tcpdf.crt';

// set additional information
$info = array(
    'Name' => 'TCPDF',
    'Location' => 'Office',
    'Reason' => 'Testing TCPDF',
    'ContactInfo' => 'http://www.tcpdf.org',
    );

// set document signature
$pdf->setSignature($certificate, $certificate, 'tcpdfdemo', '', 2, $info);

// set font
$pdf->SetFont('helvetica', '', 12);

// add a page
$pdf->AddPage();
$text = 'This is a <b color="#FF0000">digitally signed document</b> using the default (example) <b>tcpdf.crt</b> certificate.<br />To validate this signature you have to load the <b color="#006600">tcpdf.fdf</b> on the Arobat Reader to add the certificate to <i>List of Trusted Identities</i>.<br /><br />For more information check the source code of this example and the source code documentation for the <i>setSignature()</i> method.<br /><br /><a href="http://www.tcpdf.org">www.tcpdf.org</a>';
$pdf->writeHTML($text, true, 0, true, 0);
// create content for signature (image and/or text)
$pdf->Image('images/tcpdf_signature.png', 180, 60, 15, 15, 'PNG');

// define active area for signature appearance
$pdf->setSignatureAppearance(180, 60, 15, 15);
//Close and output PDF document
$pdf->Output('example_052.pdf', 'D');
?>
