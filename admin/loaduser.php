<?php
	session_start();
	require_once "configs/koneksi.php";
	require_once "configs/ceklogin.php";
	require_once "configs/fungsi.php";
	$qanggota = mysql_query("SELECT * FROM tbl_anggota WHERE kode='".esc($_GET['cari'])."';");
	$qkartu = mysql_query("SELECT * FROM tbl_kartu_pendaftaran WHERE kode_anggota='".esc($_GET['cari'])."'");
	if(mysql_num_rows($qanggota)==0)
	{
		echo "0|0|<span style='color:red'>Tidak ada anggota dengan kode tersebut!</span>";
	}
	else
	{
		$anggota	= mysql_fetch_array($qanggota);
		$kartu		= mysql_fetch_array($qkartu);
		if($kartu['status'] == 0 OR strtotime($kartu['tanggal_akhir']) < time() )
		{
			echo "0|0|<span style='color:red'>Keanggotaan <b>".$anggota['nama']."</b> sedang tidak aktif/kadaluarsa</span>";
		}
		else
		{
			//Cek Kuota Peminjaman
			$qkuota		= mysql_query("SELECT tbl_peminjaman.*,tbl_detail_peminjaman.status as status FROM tbl_anggota,tbl_peminjaman,tbl_detail_peminjaman WHERE tbl_anggota.kode = kode_anggota AND tbl_peminjaman.kode = tbl_detail_peminjaman.kode_peminjaman AND kode_anggota='".esc($_GET['cari'])."' AND tbl_detail_peminjaman.status=1 ORDER BY tanggal_peminjaman DESC LIMIT 0,1");
			if(mysql_num_rows($qkuota) == 0)
			{
				$kuota = $web['web_kuotapinjam'];
			}
			else
			{
				$peminjaman= mysql_fetch_array($qkuota);
				$qdetkuota = mysql_query("SELECT * FROM tbl_anggota,tbl_peminjaman,tbl_detail_peminjaman WHERE kode_peminjaman=tbl_peminjaman.kode AND kode_anggota = tbl_anggota.kode AND kode_anggota = '".esc($_GET['cari'])."' AND tbl_detail_peminjaman.status = 1");		
				$kuota = $web['web_kuotapinjam'] - mysql_num_rows($qdetkuota);
			}	
			echo "1|".$kuota."|<span style='color:green'>".$anggota['nama']."</span>";
		}
	}
?>