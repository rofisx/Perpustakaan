<?php
if(isset($_GET['kode']))
{
	session_start();
	require_once "configs/koneksi.php";
	require_once "configs/ceklogin.php";
	require_once "configs/fungsi.php";
	
	$qygdihapus1 = que("SELECT * FROM tbl_peminjaman WHERE kode='".$_GET['kode']."';");
	$ygdihapus1  = fetch($qygdihapus1);
	
	$hapus1 = mysql_query("DELETE FROM tbl_detail_peminjaman WHERE kode_peminjaman='".$_GET['kode']."';");
	$hapus2 = mysql_query("DELETE FROM tbl_peminjaman WHERE kode='".$_GET['kode']."';");
	
	if($hapus1 AND $hapus2)
	{
		echo "1";
		$log = $user['nama']." membatalkan peminjaman bernomor ".$ygdihapus1['kode'];
		que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')");
	}
	else
	{
		echo "0";
	}
}
?>