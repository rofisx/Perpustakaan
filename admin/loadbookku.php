<?php
session_start();
require_once "configs/koneksi.php";
require_once "configs/ceklogin.php";
require_once "configs/fungsi.php";

$perpage		= 1; 
$querytotal	= mysql_query("SELECT * FROM tbl_buku");
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


$caribuku = que("SELECT * FROM tbl_buku WHERE kode='".$_GET['cari']."' OR judul like '%".$_GET['cari']."%'".$limit);

if(num($caribuku) == 0)
{
	echo "|#<span style='color:red'>Buku tidak ditemukan</span>";
}else {
	$x=0;
	while ($buku = mysql_fetch_array($caribuku)) 
	{	
		$length = num($caribuku);	
		$qkategori = que("SELECT * FROM tbl_kategori WHERE kode='".$buku['kode_kategori']."';");
	$kategori	 = mysql_fetch_array($qkategori);
	$qpenerbit = que("SELECT * FROM tbl_penerbit WHERE kode='".$buku['kode_penerbit']."';");
	$penerbit	 = mysql_fetch_array($qpenerbit);

	if($buku['kondisi'] == 1)
		{	$kondisi = "<span style='color:green'>Baik</span>"; }
	else if($buku['kondisi'] == 2)
		{ $kondisi = "<span style='color:#F7B00B'>Rusak ringan</span>"; }
	else if($buku['kondisi'] == 3)
		{ $kondisi = "<span style='color:#F73A0B'>Rusak berat</span>"; }
	else if($buku['kondisi'] == 4)
		{ $kondisi = "<span style='color:red'>Rusak total/hilang</span>"; }
	$x++;
	echo 
	"<div class='titlepage'><img src='stylesheets/images/searchb.png' class='micon'/> Hasil Pencarian 
</div>
	<table>
			<tr>
    		<th width='0px'>#</th>
			<th width='200px' colspan='2'>Buku</th>
     		<th width='0px'>Kategori</th>
     		<th width='0px'>Pengarang</th>
     		<th width='0px'>Penerbit</th>
      		<th width='0px'>Kondisi</th>
      		<th width='0px' colspan='3' style='text-align:center'>Aksi</th>
    		</tr>
			<tr id='buku".$buku['kode']."' colspan='2'>	
				<td width='30px'>".$x."</td>
				<td ><img src='files/images/buku/".$buku['foto']."' alt='".$buku['judul']."' style='width:90px;height:120px'>
				</td>
				<td>
				<b>".$buku['kode']."</b><br/>
					".$buku['judul']."<br/>
					<span style='font-size:10px'>".$buku['tahun_terbit']." | ".$buku['jumhal']." halaman</span>
				</td>
				<td width='90px'>".$kategori['nama']."</td>
				<td width='105px'>".$buku['pengarang']."</td>
 				<td width='90px'>".$penerbit['nama']."</td>
 				<td width='100px'>".$kondisi."</td>
 				<td  class='actentry'><a href='javascript:hal(\"buku\",\"edit\",\"".$buku['kode']."\")' class='thijau' title='Edit!'><img src='stylesheets/images/edit.png' class='sicon'/></a>
 				</td>
  				<td class='actentry'><a href='javascript:del(\"buku\",\"".$buku['kode']."\",this)' onclick='return konfirm(\"menghapus buku ".$buku['judul']."\")' class='tmerah' title='Hapus!'><img src='stylesheets/images/drop.png' class='sicon'/></a>
  				</td>
  				</tr></table>";

	}

  }
?>
