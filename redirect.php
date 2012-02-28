<?php
include("db.php");
mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);

$uri = $_SERVER['REQUEST_URI'];
$uri = substr($uri, 1);
$uri = mysql_real_escape_string($uri);

$res = mysql_query("select destination from short_url where slug='".$uri."'");
if(mysql_num_rows($res) != 1)
{
	echo "No such slug";
	exit;
}
list($destination) = mysql_fetch_row($res);

header("Location:".$destination);
?>
