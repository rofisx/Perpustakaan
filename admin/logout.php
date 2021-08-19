<?php
session_start();
session_destroy();
if(isset($_COOKIE['kode']))
{
	setcookie("kode",$_COOKIE['kode'],time()-7*24*3600);
}
header('location: login.html?ref=out');
?>