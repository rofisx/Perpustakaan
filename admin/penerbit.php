<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
?>

<div class="scontainer">
<a href='javascript:hal("penerbit","tambah")' class='add'><img src='stylesheets/images/add.png' class='micon'/> Tambah Penerbit Baru</a>

<div class='titlepage'><img src='stylesheets/images/penerbit.png' class='micon'/> Daftar Penerbit</div>
<?php
if(isset($_GET['ref']))
{
 if($_GET['ref']=="1add")
	{echo "<div class='notifhijau'>Data berhasil ditambah!</div>";	}
else if($_GET['ref']=="1edt")
	{echo "<div class='notifhijau'>Data berhasil diperbarui!</div>";	}
else if($_GET['ref']=="1del")
	{echo "<div class='notifmerah'>Data berhasil dihapus!</div>";	}
else
	{echo "<div class='notifmerah'>Perintah gagal dilaksanakan!</div>";	}
}
?>
<table class="datatable">
		<tr>
    	<th width='30px'>#</th>
    	<th width='50px'>Kode</th>
     	<th width='150px'>Nama</th>
      <th width='200px'>Alamat</th>
      <th width='125px'>Telepon</th>
      <th width='125px'>Email</th>
      <th width='50px' colspan="2" style='text-align:center'>Aksi</th>
    </tr>
<?php
$x = 0;
$pilihpenerbit = mysql_query("SELECT * FROM tbl_penerbit");
while($penerbit= mysql_fetch_array($pilihpenerbit))
{
	if($x % 2 == 1)
		{$bg = "#ECF5FB";}
	else
		{$bg = "transparent";}
	$x++;
	echo "
<tr style='background:".$bg."' id='penerbit".$penerbit['kode']."'>
	<td>".$x."</td>
	<td>".$penerbit['kode']."</td>
	<td>".$penerbit['nama']."</td>
	<td>".$penerbit['alamat']."</td>
	<td>".$penerbit['telepon']."</td>
	<td>".$penerbit['email']."</td>
  <td class='actentry'><a href='javascript:hal(\"penerbit\",\"edit\",\"".$penerbit['kode']."\")' class='thijau' title='Edit!'><img src='stylesheets/images/edit.png' class='sicon'/></a></td>
  <td class='actentry'><a href='javascript:del(\"penerbit\",\"".$penerbit['kode']."\",this)' class='tmerah' title='Hapus!' onclick='return konfirm(\"menghapus penerbit ".$penerbit['nama']."\")'><img src='stylesheets/images/drop.png' class='sicon'/></a></td>
 </tr>	
	";
}
?>
	</th>
</table>
</div>
