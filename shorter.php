<?php
if(!isset($_GET["destination"]) || $_GET["destination"] == "")
{
	header("Location:/");
	exit;
}
include("db.php");
mysql_connect($dbhost, $dbuser, $dbpass);
mysql_select_db($dbname);

$dest = mysql_real_escape_string($_GET["destination"]);
if(substr($dest, 0, 4) != "http")
{
	echo "Http only";
	exit;
}
if(substr($dest, 0, 14) == "http://dlun.ch")
{
	echo "No self reference";
	exit;
}	

$res = mysql_query("select slug from short_url where destination='".$dest."'");
if(mysql_num_rows($res) == 0)
{
	$data = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz01234567890";
	$len = 3;
	$string = "";
	while(true)
	{
		$string = "";
		for($i = 0; $i < $len; $i ++)
			$string .= $data[rand(0, strlen($data) - 1)];

		$res = mysql_query("select count(*) from short_url where slug='".$string."'");
		list($count) = mysql_fetch_row($res);
		if($count == 0)
			break;

		$len ++;
	}

	mysql_query("insert into short_url(slug, destination, ip) values('".$string."', '".$dest."', '".$_SERVER['REMOTE_ADDR']."')");
}
else
	list($string) = mysql_fetch_row($res);
?>
