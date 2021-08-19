<?php
session_start();
require_once "configs/koneksi.php";
require_once "configs/ceklogin.php";
require_once "configs/fungsi.php";

$qpinjam = que("SELECT * FROM tbl_peminjaman WHERE kode='".esc($_GET['kode'])."';");
$pinjam 	= fetch($qpinjam);
$totaldenda = 0;
$qdet = mysql_query("SELECT * FROM tbl_detail_peminjaman WHERE kode_peminjaman='".esc($_GET['kode'])."';");
while($det = mysql_fetch_array($qdet))
{	
	$lamapinjam		= floor((time() - strtotime($pinjam['tanggal_peminjaman']))/86400);
	$terlambat		= floor((time() - strtotime($pinjam['tanggal_harus_kembali']))/86400);
	
	if($terlambat > 0)
		{ $denda = $terlambat * 500; }
	else
		{ $denda = 0; $terlambat = 0; }
	
	$update = mysql_query("UPDATE tbl_detail_peminjaman SET tanggal_kembali=CURRENT_TIMESTAMP(),denda=".$denda.",status=0 WHERE kode_peminjaman=".esc($_GET['kode']).";");
}
?>