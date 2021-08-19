<?php
include "configs/koneksi.php";
include "configs/fungsi.php";
include "scripts/FPDF/fpdf.php";

if(@$_GET['p'] == "all")
{
	$qpinjam = que("SELECT * FROM tbl_peminjaman ORDER BY kode DESC");	
}
else if(@$_GET['p'] == "notyet")
{
	$qpinjam = que("SELECT tbl_peminjaman.* FROM tbl_peminjaman,tbl_detail_peminjaman WHERE kode = kode_peminjaman AND status=1 AND tanggal_harus_kembali < '".date("Y-m-d")."'  ORDER BY kode DESC");	
}
else if(@$_GET['p'] == "today")
{
	$qpinjam = que("SELECT tbl_peminjaman.* FROM tbl_peminjaman,tbl_detail_peminjaman WHERE kode = kode_peminjaman AND status=1 AND tanggal_peminjaman = '".date("Y-m-d")."' ORDER BY kode DESC");	
}
else if(@$_GET['p'] == "monthly")
{
	$qpinjam = que("SELECT tbl_peminjaman.* FROM tbl_peminjaman,tbl_detail_peminjaman WHERE kode = kode_peminjaman AND status=1 AND tanggal_peminjaman <= '".date("Y-m-d")."' AND tanggal_peminjaman > '".date("Y-m-d",strtotime("-30days",strtotime(date("Y-m-d h:m:s"))))."' ORDER BY kode DESC");	
}

$w1	 = 1;
$w2  = 4;
$w3	 = 5;
$w4	 = 3;
$h	 = 0.6;

$pdf = 	new FPDF("P","cm","A4");
$pdf -> SetAutoPageBreak(true, 0.5);
$pdf -> AddPage();

$pdf ->	SetFont('Arial','',16);
$pdf -> Cell(20,0.8,"Laporan Peminjaman Buku");
$pdf -> ln();
$pdf ->	SetFont('Arial','b',18);
$pdf -> Cell(20,0.8, "Perpustakaan ".$web['web_nama']);

$pdf -> ln();
$pdf -> ln();

/*
$pdf ->	SetFont('Arial','b',10);
$pdf -> Cell($w1,$h,"Kode");
$pdf -> Cell($w2,$h,"Anggota");
$pdf -> Cell($w3,$h,"Buku");
$pdf -> Cell($w3,$h,"Keterangan");
$pdf -> Cell($w4,$h,"Status");
$pdf -> ln();
*/

$pdf ->	SetFont('Arial','',10);
while($pinjam = mysql_fetch_array($qpinjam))
{
	$qanggota = que("SELECT * FROM tbl_anggota WHERE kode='".$pinjam['kode_anggota']."';");
	$anggota	= fetch($qanggota);
	$pdf ->	SetFont('Arial','',10);
	$pdf -> Cell(10,$h,"#".$pinjam['kode']);
	$pdf -> ln();
	
	$pdf -> Cell(2,$h,"[".$pinjam['kode_anggota']."]");
	$pdf -> Cell(10,$h,$anggota['nama']);
	$pdf -> ln();
	$pdf ->	SetFont('Arial','B',10);
	$pdf -> Cell(10,$h,"Buku yang dipinjam :");
	$pdf -> ln();
	$pdf ->	SetFont('Arial','',10);
	$totaldenda = 0;
	$x 					= 0;
	$qdet = mysql_query("SELECT * FROM tbl_detail_peminjaman WHERE kode_peminjaman='".esc($pinjam['kode'])."';");
	while($det = mysql_fetch_array($qdet))
	{
		$x++;
		$pilihbuku = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$det['kode_buku']."';");
		$buku			 = mysql_fetch_array($pilihbuku);		
		
		$lamapinjam		= floor((time() - strtotime($pinjam['tanggal_peminjaman']))/86400);
		$terlambat		= floor((time() - strtotime($pinjam['tanggal_harus_kembali']))/86400);
		if($terlambat > 0)
			{ $denda = $terlambat * 500; }
		else
			{ $denda = 0; $terlambat = 0; }
			
	
		if($det['status'] == "1" AND strtotime(date("Y-m-d")) > strtotime($pinjam['tanggal_harus_kembali']))
		{
			$status = "Terlambat Kembali";
			$tkembali = "-";		
		}
		else if($det['status'] == "1")
		{
			$status = "Masih Dipinjam";
			$tkembali = "-";
		}
		else
		{
			$status = "Sudah Kembali";
			$astatus= "";
			$tkembali = date("d M Y",strtotime($det['tanggal_kembali']));
		}
		$pdf -> Cell(1,$h,$x);
		$pdf -> Cell(3,$h,"[".$buku['kode']."]");
		$pdf -> Cell(10,$h,$buku['judul']);
		$pdf -> ln();
	}
	$pdf ->	SetFont('Arial','B',10);
	$pdf -> Cell(10,$h,"Keterangan :");
	$pdf -> ln();
	$pdf ->	SetFont('Arial','',10);
	
	$pdf -> Cell(3,$h,"Tanggal Pinjam");
	$pdf -> Cell(1,$h,":");
	$pdf -> Cell(10,$h,date("d M Y",strtotime($pinjam['tanggal_peminjaman'])));
	$pdf -> ln();
	$pdf -> Cell(3,$h,"Tanggal Kembali");
	$pdf -> Cell(1,$h,":");
	$pdf -> Cell(10,$h,$tkembali);
	$pdf -> ln();
	$pdf -> Cell(3,$h,"Terlambat");
	$pdf -> Cell(1,$h,":");
	$pdf -> Cell(10,$h,$terlambat." hari");
	$pdf -> ln();
	$pdf -> Cell(3,$h,"Denda");
	$pdf -> Cell(1,$h,":");
	$pdf -> Cell(10,$h,"Rp.".number_format($denda));
	$pdf -> ln();
	$pdf -> Cell(3,$h,"Status");
	$pdf -> Cell(1,$h,":");
	$pdf -> Cell(10,$h,$status);
	$pdf -> ln();
	$pdf -> ln();
}

$pdf -> Output("reportAll.pdf","I");
?>