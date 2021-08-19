<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
?>

<div class="scontainer">
<a href='javascript:hal("kategori","tambah")' class='add'><img src='stylesheets/images/add.png' class='micon'/> Tambah Kategori Baru</a>

<div class='titlepage'><img src='stylesheets/images/kategori.png' class='micon'/> Daftar Kategori</div>
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
     	<th width='100px'>Nama</th>
      <th width='300px'>Keterangan</th>
      <th width='50px' colspan="2" style='text-align:center'>Aksi</th>
    </tr>
<?php
$x = 0;
$pilihkategori = mysql_query("SELECT * FROM tbl_kategori");
while($kategori= mysql_fetch_array($pilihkategori))
{
	if($x % 2 == 1)
		{$bg = "#ECF5FB";}
	else
		{$bg = "transparent";}
	$x++;
	echo "
<tr style='background:".$bg."' id='kategori".$kategori['kode']."'>
	<td>".$x."</td>
	<td>".$kategori['kode']."</td>
	<td>".$kategori['nama']."</td>
	<td>".$kategori['keterangan']."</td>
  <td class='actentry'><a href='javascript:hal(\"kategori\",\"edit\",\"".$kategori['kode']."\")' class='thijau' title='Edit!'><img src='stylesheets/images/edit.png' class='sicon'/></a></td>
  <td class='actentry'><a href='javascript:del(\"kategori\",\"".$kategori['kode']."\",this)' class='tmerah' title='Hapus!' onclick='return konfirm(\"menghapus kategori ".$kategori['nama']."\")'><img src='stylesheets/images/drop.png' class='sicon'/></a></td>
 </tr>	
	";
}
?>
	</th>
</table>
</div>
