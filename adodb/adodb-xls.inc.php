<?php
	session_start();
        $nomfile="orfeoReport-".date("Y-m-d").".xls";
                header("Expires: 0");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header("Content-type: application/vnd.ms-excel;charset:UTF-8");
        header("Content-Disposition: attachment; filename=\"$nomfile\"");
        print "\n"; // Add a line, unless excel error..
        include("adodb-basedoc.inc.php");
?>
