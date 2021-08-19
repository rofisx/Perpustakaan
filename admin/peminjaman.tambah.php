<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
$tanggalkembali = strtotime("+".$web['web_lamapinjam']." days",time());
$pinjam = mysql_query("INSERT INTO tbl_peminjaman(kode_anggota,kode_petugas,tanggal_peminjaman,tanggal_harus_kembali) VALUES(
	'".$_GET['peminjam']."',
	'".$user['kode']."',
	CURRENT_TIMESTAMP(),
	'".date("Y-m-d h:m:s",$tanggalkembali)."'
	);");
$idbaru = mysql_insert_id();
if($pinjam)
{
	$kodebuku = explode("|",$_GET['data']);
	for($i=1;$i<count($kodebuku);$i++)
	{
		mysql_query("INSERT INTO tbl_detail_peminjaman(kode_peminjaman,kode_buku,status) VALUES('".$idbaru."','".$kodebuku[$i]."',1)");
	}
}
?>