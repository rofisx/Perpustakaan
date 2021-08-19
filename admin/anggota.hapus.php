<?php
if(isset($_GET['kode']))
{
	session_start();
	require_once "configs/koneksi.php";
	require_once "configs/ceklogin.php";
	require_once "configs/fungsi.php";
	
	$qygdihapus1 = que("SELECT * FROM tbl_anggota WHERE kode='".$_GET['kode']."';");
	$ygdihapus1  = fetch($qygdihapus1);
	
	$qygdihapus2 = que("SELECT * FROM tbl_kartu_pendaftaran WHERE kode_anggota='".$_GET['kode']."';");
	$ygdihapus2  = fetch($qygdihapus2);
	
	$hapus1 = mysql_query("DELETE FROM tbl_kartu_pendaftaran WHERE kode_anggota='".$_GET['kode']."';");
	$hapus2 = mysql_query("DELETE FROM tbl_anggota WHERE kode='".$_GET['kode']."';");
	
	if($hapus1 AND $hapus2)
	{
		echo "1";
		unlink("files/images/anggota/".$ygdihapus1['foto']);
		$log = $user['nama']." menghapus anggota ".$ygdihapus1['nama'];
		que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')");
	}
	else
	{
		echo "0";
	}
}
?>