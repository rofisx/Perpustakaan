<?php
session_start();
require_once "configs/koneksi.php";
require_once "configs/ceklogin.php";
require_once "configs/fungsi.php";

$qpinjam = que("SELECT tb_pin.kode,tb_pin.kode_petugas,tb_pin.kode_anggota,tb_pin.tanggal_peminjaman,tb_pin.tanggal_harus_kembali FROM tbl_peminjaman tb_pin JOIN tbl_anggota tb_ang ON tb_pin.kode_anggota = tb_ang.kode WHERE tb_ang.nama like '%".$_GET['cari']."%' OR tb_pin.kode='".esc($_GET['cari'])."'");
if(num($qpinjam) == 0)
{
	echo "0|#<span style='color:red'>Kode peminjaman tidak diketemukan</span>";
}
else
{
	$pinjam 	= fetch($qpinjam);
	$qanggota = que("SELECT * FROM tbl_anggota WHERE kode='".$pinjam['kode_anggota']."';");
	$anggota	= fetch($qanggota);
	echo "1|#
	<table>
  <tr>
    <th colspan='3'>Anggota Peminjam</th>
  </tr>
  <tr>
    <td width='100px'>Kode </td>
    <td width='50px'>:</td>
    <td width='650px'>".$anggota['kode']."</td>
  </tr>
  <tr>
    <td>Nama</td>
    <td>:</td>
    <td>".$anggota['nama']."</td>
  </tr>
	<tr>
		<td>Alamat</td>
		<td>:</td>
		<td>".$anggota['alamat']."</td>
	</tr>
	<tr>
		<td colspan='3' style='padding:20px'></td>
	</tr>
	<tr>
		<td colspan='3'>
		<table>
			<tr>
				<th style='width:300px'>Buku</th>
				<th style='width:90px'>Terlambat</th>
				<th style='width:120px'>Denda</th>
			</tr>";
$totaldenda = 0;
$qdet = mysql_query("SELECT tb_det_pin.kode_peminjaman, tb_det_pin.kode_buku, tb_det_pin.tanggal_kembali, tb_det_pin.denda, tb_det_pin.status FROM tbl_detail_peminjaman tb_det_pin 
JOIN tbl_peminjaman tb_pin ON tb_det_pin.kode_peminjaman = tb_pin.kode
JOIN tbl_anggota tb_ang ON tb_pin.kode_anggota = tb_ang.kode 
WHERE tb_ang.nama ='".$_GET['cari']."' OR tb_det_pin.kode_peminjaman='".esc($_GET['cari'])."';");
while($det = mysql_fetch_array($qdet))
{
	
	$pilihbuku = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$det['kode_buku']."';");
	$buku			 = mysql_fetch_array($pilihbuku);

	$lamapinjam		= floor((time() - strtotime($pinjam['tanggal_peminjaman']))/86400);
	$terlambat		= floor((time() - strtotime($pinjam['tanggal_harus_kembali']))/86400);
	
	if($terlambat > 0)
		{ $denda = $terlambat * $web['web_denda']; }
	else
		{ $denda = 0; $terlambat = 0; }
	
	echo "
			<tr>
				<td>[<b>".$buku['kode']."</b>] ".$buku['judul']."</td>
				<td>".$terlambat." hari</td>
				<td>Rp. ".number_format($denda)."</td>
			</tr>
	";
	$totaldenda = $totaldenda + $denda;
}
echo "
		<tr>
			<td colspan='2'></td>
			<td><b>Rp. ".number_format($totaldenda)."</b></td>
		</tr>
		</table>
		</td>
	</tr>
	</table>
	
	<a href='javascript:pengembalian(".$pinjam['kode'].")' class='thijau' style='margin:20px 0'>Buku telah dikembalikan</a>
	";
}
?>