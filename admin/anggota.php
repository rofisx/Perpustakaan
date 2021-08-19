<?php
session_start();
include "configs/koneksi.php";
include "configs/fungsi.php";
include "configs/ceklogin.php";
?>
<div class="scontainer">
<?php
$perpage		= 3; 
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
?>
<div class='navtable' style="padding-bottom: 10px">
	<div class='navleft'>
		<a href='javascript:hal("anggota","tambah")' class='add'><img src='stylesheets/images/add.png' class='micon'/> Tambah Anggota Baru</a>
  	</div>
  	<div class="navright">
  <!-- Setting Halaman -->
	<?php
		if(isset($_GET['page']) AND $_GET['page'] > 1)
		{	echo "<a href='javascript:hal(\"anggota\",0,0,0,\"".($curpage-1)."\")' class='add'><img src='stylesheets/images/back.png' class='micon'/> </a>"; }	
		echo " <select name='halaman' class='sputih' style='width:50px;padding:2px;margin:5px 10px 5px 0px;' onchange='hal(\"anggota\",0,0,0,this.value)'>";
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
			{	echo "<a href='javascript:hal(\"anggota\",0,0,0,\"".($curpage+1)."\")' class='add'><img src='stylesheets/images/next.png' class='micon'/> </a>"; }	
	?>
  	</div>
  <!-- End -->
</div>
<div class="right">
<div class='metrosearch'>
		<img src="../admin/stylesheets/images/searchb.png" />
		<input type="text" onkeyup="loadanggota(this.value)"
		placeholder='Pencarian...' autofocus>
	<span id='lblpinjam' style='display:inline-block;margin-left:20px'>
	</span>
</div>
</div>
<?php
	if(isset($_GET['ref']))
	{
 		if($_GET['ref']=="1add")
		{
			echo "<div class='notifhijau'>Data berhasil ditambah!</div>";	}
	else if($_GET['ref']=="1edt")
		{
			echo "<div class='notifhijau'>Data berhasil diperbarui!</div>";	}
	else if($_GET['ref']=="renew")
		{
			echo "<div class='notifhijau'>Masa aktif anggota berhasil diperbarui!</div>";	}
	else if($_GET['ref']=="1del")
		{
			echo "<div class='notifmerah'>Data berhasil dihapus!</div>";	}
	else
		{
			echo "<div class='notifmerah'>Perintah gagal dilaksanakan!</div>";	}
	}
?>
<span id="anggotalist"></span>

<div class='titlepage'><img src='stylesheets/images/anggota.png' class='micon'/> Daftar Anggota
</div>
<table class="datatable">
	<tr>
    	<th width='300px' colspan="2">Anggota</th>
      	<th width='200px'>Alamat</th>
      	<th width='160px' colspan="5" style='text-align:center'>Aksi</th>
    </tr>
    	<?php
$pilihanggota = mysql_query("SELECT * FROM tbl_anggota ".$limit);
while($anggota= mysql_fetch_array($pilihanggota))
{
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
	echo "
<tr id='anggota".$anggota['kode']."'>
	<td width='100px'><img src='files/images/anggota/".$anggota['foto']."' alt='".$anggota['nama']."' style='width:90px;height:120px'></td>
	<td>
		[".$anggota['kode']."]<br/>
		<b>".$anggota['nama']."</b><br/>
		Telp. ".$anggota['telepon']."<br/>
		<span style='font-size:11px'>".$status." | exp ".$kartu['tanggal_akhir']."</span>
	</td>
	<td>".$anggota['alamat']."</td>
  <td class='actentry'><a href='javascript:hal(\"peminjaman\",0,0,\"".$anggota['kode']."\");' class='tkuning' title='Pinjam Buku!'><img src='stylesheets/images/wpinjam.png' class='sicon'/></a></td>
 	<td class='actentry'><a href='anggota.cetak.php?kode=".$anggota['kode']."' class='tkuning' title='Cetak!'><img src='stylesheets/images/print.png' class='sicon'/></a></td>
	<td class='actentry'><a href='javascript:hal(\"anggota\",\"edit\",\"".$anggota['kode']."\")' class='thijau' title='Edit!'><img src='stylesheets/images/edit.png' class='sicon'/></a></td>
	<td class='actentry'><a href='javascript:renew(\"anggota\",\"".$anggota['kode']."\")' class='thijau' title='Perpanjang!'><img src='stylesheets/images/renew.png' class='sicon'/></a></td>
	<td class='actentry'><a href='javascript:del(\"anggota\",\"".$anggota['kode']."\")' onclick='return konfirm(\"menghapus ".$anggota['nama']."\")' class='tmerah' title='Hapus!'><img src='stylesheets/images/drop.png' class='sicon'/></a></td>
</tr>	
	";
}
?>
</table>
</div>