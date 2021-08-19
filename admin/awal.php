<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
?>

<div class='scontainer'>
<div id='cleft' style='float:left;width:400px;min-height:500px;'>
	<div class='boxc'>
  <div class='titlepage'><img src='stylesheets/images/dasbor.png' class='micon'/> Halaman Dashboard</div>
  <b>Selamat datang <?php echo strtoupper($user['nama']) ?> di halaman Petugas Perpustakaan <?php echo $web['web_nama']  ?>!</b><br/>
  
  <p>Disini sebagai petugas anda dapat melakukan berbagai aktivitas administrasi perpustakaan namum ingat, harus sesuai dengan hak akses anda.</p>
  
   <p>Silakan menghubungi Administror utama di bila anda mengalami kesulitan dalam menggunakan website ini. Terima Kasih</p>
  </div>
  <br/>
    <div class='boxc'>
  <div class='titlepage'><img src='stylesheets/images/buku.png' class='micon'/> Terlambat Mengembalikan Buku</div>
<?php
$qpinjam = que("SELECT tbl_peminjaman.* FROM tbl_peminjaman,tbl_detail_peminjaman WHERE kode = kode_peminjaman AND status=1 AND tanggal_harus_kembali < '".date("Y-m-d")."' GROUP BY tbl_peminjaman.kode  ORDER BY kode DESC");
while($pinjam  = fetch($qpinjam))
{
	$qanggota = que("SELECT * FROM tbl_anggota WHERE kode='".$pinjam['kode_anggota']."';");
	$anggota	= fetch($qanggota);
	$lamapinjam		= floor((time() - strtotime($pinjam['tanggal_peminjaman']))/86400);
	$terlambat		= floor((time() - strtotime($pinjam['tanggal_harus_kembali']))/86400);
	if($terlambat > 0)
		{ $denda = $terlambat * 500; }
	else
		{ $denda = 0; $terlambat = 0; }
	
	echo "
	<p>
		".$anggota['nama']." - Terlambat ".$terlambat." hari
	</p>
	";
}
?>
  </div>
</div>
<div id='cright' style='float:right;width:300px;min-height:500px;'>
  <div class='boxc'>
  <div class='titlepage'><img src='stylesheets/images/log.png' class='micon'/> Log Aktivitas Petugas</div>
<?php
$pilihlog = que("SELECT * FROM tbl_log_petugas ORDER BY tanggal DESC limit 0,5");
while($log = fetch($pilihlog))
{
	echo "
	<div class='log'>
		<i>".date("d F Y h:m",strtotime($log['tanggal']))."</i>
		<p>".$log['log']."</p>
	</div>
	";
}
?>
  </div>
</div>
</div>