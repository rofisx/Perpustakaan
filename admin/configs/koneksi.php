<?php
date_default_timezone_set("Asia/Jakarta");
$connect 	= mysql_connect("localhost","root","");
$pilihdb 	= mysql_select_db("db_perpustakaan", $connect);
if(!$pilihdb)
{
	die("Koneksi Gagal!");
}
else
{
	$qweb	= mysql_query("SELECT * FROM tbl_pengaturan");
	$web	= mysql_fetch_array($qweb);
}
?>