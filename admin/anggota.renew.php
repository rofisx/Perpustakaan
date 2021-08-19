<?php
if(isset($_GET['kode']))
{
	session_start();
	require_once "configs/koneksi.php";
	require_once "configs/ceklogin.php";
	require_once "configs/fungsi.php";
	
	$qygdipilih1 = que("SELECT * FROM tbl_anggota WHERE kode='".$_GET['kode']."';");
	$ygdipilih1  = fetch($qygdipilih1);
	
	$qygdipilih2 = que("SELECT * FROM tbl_kartu_pendaftaran WHERE kode_anggota='".$_GET['kode']."';");
	$ygdipilih2  = fetch($qygdipilih2);
  
  $expdate = date("Y-m-d",strtotime("+".$web['web_masaaktif']." days",strtotime(date("Y-m-d H:i:s"))));
	$renew = mysql_query("UPDATE tbl_kartu_pendaftaran SET tanggal_akhir = '".$expdate."',status=1 WHERE kode_anggota='".$_GET['kode']."';");
	
	if($renew)
	{
		echo "1";
		$log = $user['nama']." memperpanjang masa aktif anggota ".$ygdipilih1['nama'];
		que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')");
	}
	else
	{
		echo "0";
	}
}
?>