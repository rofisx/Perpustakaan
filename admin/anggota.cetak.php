<?php
include "configs/koneksi.php";
include "configs/fungsi.php";
include "scripts/code39.php";

$pilihkartu = mysql_query("SELECT * FROM tbl_kartu_pendaftaran,tbl_anggota WHERE kode=kode_anggota AND kode_anggota='".$_GET['kode']."'");
$kartu      = mysql_fetch_array($pilihkartu);

$w1	 = 1.25;
$w2  = 0.2;
$w3	 = 3.5;
$w4	 = 3;
$h	 = 0.4;
$pdf = 	new PDF_Code39("L","cm",array(8.5,5.5));
$pdf -> SetMargins(0.5, 0.35, 0.5);
$pdf -> SetAutoPageBreak(true, 0.5);
$pdf -> AddPage();
$pdf -> Image('files/images/anggota/'.$kartu['foto'],0.75,1.5,2,2.2);
$pdf ->	SetFont('Arial','',10);
$pdf ->	SetTextColor(255, 255, 255);

$pdf -> SetFillColor(0, 191, 255);
$pdf -> Cell(7.5,0.5,"Kartu Anggota ".$web['web_nama']."'",0,0,"C",true);
$pdf -> ln();
$pdf ->	SetFont('Arial','',6);
$pdf ->	SetTextColor(255, 255, 255);
$pdf -> Cell(7.5,0.3,"Jalan. Ir. Soekarno No 7a Ponorogo",0,0,"C",true);
$pdf -> ln();
$pdf ->	SetTextColor(0, 0, 0);
$pdf ->	SetFont('Arial','',7.5);

$pdf -> ln();
$pdf -> SetX(3);
$pdf -> Cell($w1,$h,"Kode");
$pdf -> Cell($w2,$h,":");
$pdf -> Cell($w3,$h,$kartu['kode']);
$pdf -> ln();
$pdf -> SetX(3);
$pdf -> Cell($w1,$h,"Nama");
$pdf -> Cell($w2,$h,":");
$pdf -> Cell($w3,$h,$kartu['nama']);
$pdf -> ln();
$pdf -> SetX(3);
$pdf -> Cell($w1,$h,"Telp.");
$pdf -> Cell($w2,$h,":");
$pdf -> Cell($w3,$h,$kartu['telepon']);
$pdf -> ln();
$pdf -> SetX(3);
$pdf -> Cell($w1,$h,"Alamat");
$pdf -> Cell($w2,$h,":");
$pdf -> MultiCell($w3,$h,$kartu['alamat']);
$pdf -> SetX(3);
$pdf -> Cell($w1,$h,"Aktif");
$pdf -> Cell($w2,$h,":");
$pdf -> Cell($w3,$h,tanggal($kartu['tanggal_akhir']));

$pdf->Code39(0.5,4,$kartu['kode'],0.05,0.5);

$pdf ->	SetFont('Courier','',10);
$pdf -> Ln();
$pdf -> Ln();
$pdf -> Ln();
$pdf -> Output("report.pdf","I");
?>