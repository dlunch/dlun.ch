<?php
include("db.php");
mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);

$res = mysql_query("select count(*) from short_url");
list($count) = mysql_fetch_row($res);

echo "Number of rows : ".$count;
?>

