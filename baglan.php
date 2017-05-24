<?php
$baglanti=@mysql_connect("localhost","root","root");
if(!$baglanti)
{
	echo"<b>Database ile ba?lant? kurulamad? l?tfen daha sonra tekrar deneyin.";
	exit();
}
mysql_select_db('dbalisveris');
mysql_query("SET NAMES UTF8");
?> 