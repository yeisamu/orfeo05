<?php

$host='192.168.0.140:ESP_ESPI';
$username='UORFEO';
$password='U2014orfeo';
$encode='UTF8';

$dbh = ibase_connect($host, $username, $password, $encode) or die ("error de conexion");

$sql="SELECT * FROM VW_USRORFEO";

$cursor = ibase_query($sql);
$row_array = ibase_fetch_assoc($cursor);
  
print_r($row_array);

ibase_free_result($cursor);
ibase_close($dbh);

?>
