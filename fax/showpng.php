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


/*
 * $Id: showpng.php,v 1.2 2002/01/25 04:29:18 nisapus Exp $
 *
 * Copyright (C) 2002 Supasin Sae-heng <nisapus@yahoo.com>
 *
 * This file is subject to the terms and conditions of the GNU General Public
 * License.  See the file "COPYING" for more details.
 */

header("Content-Type: image/png");

// Note: Now I cannot fix this problem
// So the size between cover and attach file is different
if ($var_file == "cover") {
    $IMAGE_WIDTH  = 612;
    $IMAGE_HEIGHT = 792;
} else {
    $IMAGE_WIDTH  = 595;
    $IMAGE_HEIGHT = 842;
}

$srcImage = $png_file;
$srcIm  = ImageCreateFromPng($srcImage);

$dstIm = ImageCreate($IMAGE_WIDTH/$scale,$IMAGE_HEIGHT/$scale);
ImageCopyResized($dstIm,$srcIm,0,0,0,0,$IMAGE_WIDTH/$scale,$IMAGE_HEIGHT/$scale,$IMAGE_WIDTH,$IMAGE_HEIGHT);

ImagePNG($dstIm);
?>
