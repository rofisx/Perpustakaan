<?php
session_start();
require_once "configs/koneksi.php";
require_once "configs/ceklogin.php";
require_once "configs/fungsi.php";

$perpage		= 1; 
$querytotal	= mysql_query("SELECT * FROM tbl_anggota");
$pagetotal	= mysql_num_rows($querytotal);
$jumpage		= ceil($pagetotal/$perpage);

if(isset($_GET['page']))
	{
		$limit 	= "LIMIT ".($_GET['page']-1)*$perpage.",".$perpage; 
		$curpage= $_GET['page'];
	}
else
	{ 
		$limit 		= "LIMIT 0,".$perpage; 
		$curpage	= 1;
	}

$carianggota = que("SELECT * FROM tbl_anggota WHERE kode='".$_GET['cari']."' OR nama LIKE'%".$_GET['cari']."%'".$limit);

if(num($carianggota) == 0)
{
	echo "|#<span style='color:red'>Anggota tidak ditemukan</span>";
}else {
	$x=0;
	while ($anggota = mysql_fetch_array($carianggota)){
	$pilihkartu = mysql_query("SELECT * FROM tbl_kartu_pendaftaran WHERE kode_anggota='".$anggota['kode']."'");
  	$kartu      = mysql_fetch_array($pilihkartu);
	if($kartu['status']==1)
		{
		$status = "<span style='color:green'>Aktif</span>";
		}
		else
		{
		$status = "<span style='color:red'>Non Aktif</span>";
		}
		$x++;
		echo "
		<div class='titlepage'><img src='stylesheets/images/searchb.png' class='micon'/> Hasil Pencarian 
		</div>
		<table class='datatable'>	
		<tr>
     	<th width='300px' colspan='2'>Anggota</th>
      	<th width='200px'>Alamat</th>
      	<th width='160px' colspan='5' style='text-align:center'>Aksi</th>
    	</tr>
		<tr id='anggota".$anggota['kode']." colspan='2'>
			<td width='100px'><img src='files/images/anggota/".$anggota['foto']."' alt='".$anggota['nama']."' style='width:90px;height:120px'>
			</td>
			<td>[".$anggota['kode']."]<br/>
				<b>".$anggota['nama']."</b><br/>
				Telp. ".$anggota['telepon']."<br/>
			</td>
			<td>".$anggota['alamat']."</td>	
  			<td class='actentry'>
  			<a href='javascript:hal(\"peminjaman\",0,0,\"".$anggota['kode']."\");' class='tkuning' title='Pinjam Buku!'>
  			<img src='stylesheets/images/wpinjam.png' class='sicon'/></a>
  			</td>
  			<td class='actentry'>
  			<a href='anggota.cetak.php?kode=".$anggota['kode']."' class='tkuning' title='Cetak!'>
  			<img src='stylesheets/images/print.png' class='sicon'/></a>
 			</td>
			<td class='actentry'>
			<a href='javascript:hal(\"anggota\",\"edit\",\"".$anggota['kode']."\")' class='thijau' title='Edit!'>
			<img src='stylesheets/images/edit.png' class='sicon'/></a>
			</td>
			<td class='actentry'><a href='javascript:renew(\"anggota\",\"".$anggota['kode']."\")' class='thijau' title='Perpanjang!'><img src='stylesheets/images/renew.png' class='sicon'/></a>
			</td>
			<td class='actentry'>
			<a href='javascript:del(\"anggota\",\"".$anggota['kode']."\")' onclick='return konfirm(\"menghapus ".$anggota['nama']."\")' class='tmerah' title='Hapus!'>
			<img src='stylesheets/images/drop.png' class='sicon'/></a>
			</td>
  		</tr>
  		</table>";
  		}
  	}
?>
