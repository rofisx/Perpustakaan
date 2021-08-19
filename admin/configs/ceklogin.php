<?php
if(isset($_SESSION['kode']) OR isset($_COOKIE['kode']))
{
	if(isset($_SESSION['kode']))
  	{	$kode = $_SESSION['kode']; }
	else
		{ $kode = $_COOKIE['kode']; }
		
  $cekuser = mysql_query("SELECT * FROM tbl_petugas WHERE kode='".$kode."';");
  if(mysql_num_rows($cekuser) != 1)
  {
    header("Location: login.html?ref=dir");
  }
	else
	{
		$user = mysql_fetch_array($cekuser);
	}
}
else
{
  header("Location: login.html?ref=dir");
}
?>