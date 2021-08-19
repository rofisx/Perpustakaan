<?php
session_start();
include "configs/koneksi.php";
include "configs/fungsi.php";
include "configs/ceklogin.php";
?>
<div class="scontainer">
<?php
$perpage		= 10; 
$querytotal	= mysql_query("SELECT * FROM tbl_peminjaman");
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
?>
<div class='navtable' style="padding:10px;">
	<div class='navleft' style="width:600px;">
    <a href='report.php?p=all' style="margin:5px" class='thijau'><img src='stylesheets/images/print.png' class='sicon' style="margin:2.5px"/> Semua</a>
    <a href='report.php?p=today' style="margin:5px" class='thijau'><img src='stylesheets/images/print.png' class='sicon' style="margin:2.5px"/> Hari ini</a>  
    <a href='report.php?p=monthly' style="margin:5px" class='thijau'><img src='stylesheets/images/print.png' class='sicon' style="margin:2.5px"/> Bulan ini</a>  
    <a href='report.php?p=notyet' style="margin:5px" class='thijau'><img src='stylesheets/images/print.png' class='sicon' style="margin:2.5px"/> Belum Kembali</a>  
  </div>
  <div class="navright" style='width:100px;'>
<?php
if(isset($_GET['page']) AND $_GET['page'] > 1)
	{	echo "<a href='javascript:hal(\"listpeminjaman\",0,0,0,\"".($curpage-1)."\")' class='add'><img src='stylesheets/images/back.png' class='micon'/> </a>"; }	
echo " <select name='halaman' class='sputih' style='width:50px;padding:2px;margin:5px 10px 5px 0px;' onchange='hal(\"listpeminjaman\",0,0,0,this.value)'>";
for($r=1; $r <= $jumpage ; $r++)
	{	
		if($curpage == $r)
		{
			echo "<option value=".$r." selected>".$r."</a>";
		}
		else
		{
			echo "<option value=".$r.">".$r."</a>";
		}
	}
echo "</select> ";
if($jumpage>1 AND (!isset($_GET['page']) OR @$_GET['page'] < $jumpage))
	{	echo "<a href='javascript:hal(\"listpeminjaman\",0,0,0,\"".($curpage+1)."\")' class='add'><img src='stylesheets/images/next.png' class='micon'/> </a>"; }	
?>
  </div>
</div>
<div class='titlepage'><img src='stylesheets/images/pinjam.png' class='micon'/> Daftar Peminjaman</div>
<?php
if(isset($_GET['ref']))
{
 if($_GET['ref']=="pinjam")
	{echo "<div class='notifhijau'>Buku telah dipinjam!</div>";	}
else if($_GET['ref']=="kembali")
	{echo "<div class='notifhijau'>Buku berhasil dikembalikan!</div>";	}
}
?>
<table>
	<tr>
  	<th width='40px;'>Kode</th>
    <th width='125px;'>Anggota</th>
    <th width='220px'>Buku</th>
    <th width='200px;'>Keterangan</th>
    <th width='80px;'>Status</th>
    <th>Aksi</th>
  </tr>
<?php
$r = 0;
$qpinjaman = que("SELECT * FROM tbl_peminjaman ORDER BY kode DESC ".$limit);
while($pinjaman = fetch($qpinjaman))
{
	$r++;
	if($r % 2 == 1)
		{$bg = "transparent";}
	else
		{$bg = "#ECF5FB";}
	
	
	$qanggota = que("SELECT * FROM tbl_anggota WHERE kode='".$pinjaman['kode_anggota']."';");
	$anggota	= fetch($qanggota);
	echo 
	"
	<tr style='background:".$bg."' id='peminjaman".$pinjaman['kode']."'>
		<td>".$pinjaman['kode']."</td>
		<td>
			[<b>".$anggota['kode']."</b>]<br/>
			".$anggota['nama']."
		</td>
		<td>
	";
$totaldenda = 0;
$x 					= 0;
$qdet = mysql_query("SELECT * FROM tbl_detail_peminjaman WHERE kode_peminjaman='".esc($pinjaman['kode'])."';");
while($det = mysql_fetch_array($qdet))
{
	$x++;
	$pilihbuku = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$det['kode_buku']."';");
	$buku			 = mysql_fetch_array($pilihbuku);
	
	echo "[<b>".$buku['kode']."</b>] <br/>".$buku['judul']."<br/>";
	
	$lamapinjam		= floor((time() - strtotime($pinjaman['tanggal_peminjaman']))/86400);
	$terlambat		= floor((time() - strtotime($pinjaman['tanggal_harus_kembali']))/86400);
	if($terlambat > 0)
		{ $denda = $terlambat * $web['web_denda']; }
	else
		{ $denda = 0; $terlambat = 0; }
		

	if($det['status'] == "1" AND strtotime(date("Y-m-d")) > strtotime($pinjaman['tanggal_harus_kembali']))
	{
		$status = "<span style='color:red'>Terlambat Kembali</span>";
		$astatus="<a href='javascript:hal(\"pengembalian\",0,0,\"".$pinjaman['kode']."\")' class='thijau' title='Pengembalian'><img src='stylesheets/images/wkembali.png' class='sicon'/></a>";
		$tkembali = "-";		
	}
	else if($det['status'] == "1")
	{
		$status = "<span style='color:orange'>Masih Dipinjam</span>";
		$astatus="<a href='javascript:hal(\"pengembalian\",0,0,\"".$pinjaman['kode']."\")' class='thijau' title='Pengembalian'><img src='stylesheets/images/wkembali.png' class='sicon'/></a>";
		$tkembali = "-";
	}
	else
	{
		$status = "<span style='color:green'>Sudah Kembali</span>";
		$astatus= "";
		$tkembali = date("d M Y",strtotime($det['tanggal_kembali']));
	}
}

	echo "		
		</td>
		<td>
			<table>
				<tr>
					<td>Tanggal pinjam</td><td>:</td><td>".date("d M Y",strtotime($pinjaman['tanggal_peminjaman']))."</td>
				</tr>
				<tr>
					<td>Tanggal kembali</td><td>:</td><td>".$tkembali."</td>
				</tr>
				<tr>	
					<td>Terlambat</td><td>:</td><td>".$terlambat." hari</td>
				</tr>
				<tr>
					<td>Denda</td><td>:</td><td>Rp. ".number_format($x * $denda)."</td>
				</tr>
			</table>
		</td>
		<td>".$status."</td>
		<td class='actentry' align='right'>".$astatus." <a href='javascript:del(\"peminjaman\",\"".$pinjaman['kode']."\")' class='tmerah' onclick='konfirm(\"membatalkan peminjaman ini\")'><img src='stylesheets/images/drop.png' class='sicon'/></a></td>
	</tr>
	";
}
?>
</table>
</div>