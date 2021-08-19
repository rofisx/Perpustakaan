<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
$quser = que("SELECT * FROM tbl_petugas WHERE kode='".$_POST['kode']."'");
if(num($quser) == 1)
{
	$user	 = fetch($quser);
	if(md5($_POST['password']) == $user['password'])
	{
		if($_POST['pakecookie']=="pake")
		{
			setcookie("kode",$user['kode'],time()+7*24*3600);
		}
		else
		{
			$_SESSION['kode'] = $user['kode'];
		}
		echo "1";
	}
	else
	{
		echo "0";
	}
}
else
{
	echo "0";
}
sleep(1);
?>