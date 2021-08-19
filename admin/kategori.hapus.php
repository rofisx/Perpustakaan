<?php
if(isset($_GET['kode']))
{
	session_start();
	require_once "configs/koneksi.php";
	require_once "configs/ceklogin.php";
	require_once "configs/fungsi.php";
	$qygdihapus = que("SELECT * FROM tbl_kategori WHERE kode='".$_GET['kode']."';");
	$ygdihapus 	= fetch($qygdihapus);
	$hapus = mysql_query("DELETE FROM tbl_kategori WHERE kode='".$_GET['kode']."';");
	if($hapus)
	{
		echo "1";
		$log = $user['nama']." menghapus kategori ".$ygdihapus['nama'];
		que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')");
	}
	else
	{
		echo "0";
	}
}
?>