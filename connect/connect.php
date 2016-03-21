<?php
include "config.php";
$conn = mysql_connect($host, $user_db, $pass_db) or die("Error mysql");
$connSqli = mysqli_connect($host, $user_db, $pass_db);
@mysql_select_db($database) or die("Error DB");
mysql_query("SET NAMES 'utf8' ");


?>