<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
?>

<div class="scontainer">
<a class='add' onclick='hal("petugas","tambah")'><img src='stylesheets/images/add.png' class='micon'/> Tambah Petugas</a>
<div class='titlepage'><img src='stylesheets/images/petugas.png' class='micon'/> Petugas</div>
<?php
if(isset($_GET['ref']))
{
 if($_GET['ref']=="1add")
	{echo "<div class='notifhijau'>Data Petugas berhasil ditambah! <span class='notifclose' onclick='hid(this)'>x</span></div>";	}
else if($_GET['ref']=="1edt")
	{echo "<div class='notifhijau'>Data Petugas berhasil diperbarui! <span class='notifclose' onclick='hid(this)'>x</span></div>";	}
else if($_GET['ref']=="1del")
	{echo "<div class='notifkuning'>Data Petugas berhasil dihapus! <span class='notifclose' onclick='hid(this)'>x</span></div>";	}
else
	{echo "<div class='notifmerah'>Petugas gagal dilaksanakan! <span class='notifclose' onclick='hid(this)'>x</span></div>";	}
}
?>
<table class='datatable'>
		<tr>
    	<th>#</th>
     	<th width='150px'>Nama</th>
      <th width='150px'>Keterangan</th>
      <th><img src='stylesheets/images/buku.png' class="sicon" title='Administrasi Buku'/></th>
      <th><img src='stylesheets/images/kategori.png' class="sicon" title='Administrasi Kategori'/></th>
      <th><img src='stylesheets/images/penerbit.png' class="sicon" title='Administrasi Penerbit'/></th>
      <th><img src='stylesheets/images/anggota.png' class="sicon" title='Administrasi Anggota'/></th>
      <th><img src='stylesheets/images/petugas.png' class="sicon" title='Administrasi Petugas'/></th>
      <th><img src='stylesheets/images/pinjam.png' class="sicon" title='Administrasi Peminjaman'/></th>
      <th><img src='stylesheets/images/kembali.png' class="sicon" title='Administrasi Kembali'/></th>
      <th><img src='stylesheets/images/pengaturan.png' class="sicon" title='Pengaturan Website'/></th>
      <th width='50px' colspan="2" style='text-align:center'>Aksi</th>
    </tr>
<?php
function centang($x)
{
	if($x == 1)
		{	return "&radic;";}
	else
		{ return "-";}
}
$x = 0;
$qpe = que("SELECT * FROM tbl_petugas WHERE status <> 'a';");
while($petugas= mysql_fetch_array($qpe))
{
	if($x % 2 == 1)
		{$bg = "#ECF5FB";}
	else
		{$bg = "transparent";}
	$x++;
	echo "
<tr style='background:".$bg."' id='petugas".$petugas['kode']."'>
	<td>".$x."</td>
	<td>".$petugas['nama']."</td>
	<td>".$petugas['keterangan']."</td>
	<td align='center'>".centang($petugas['sbuku'])."</td>
	<td align='center'>".centang($petugas['skategori'])."</td>
	<td align='center'>".centang($petugas['spenerbit'])."</td>
	<td align='center'>".centang($petugas['sanggota'])."</td>
	<td align='center'>".centang($petugas['spetugas'])."</td>
	<td align='center'>".centang($petugas['speminjaman'])."</td>
	<td align='center'>".centang($petugas['spengembalian'])."</td>
	<td align='center'>".centang($petugas['spengaturan'])."</td>
  <td class='actentry'><a href='javascript:hal(\"petugas\",\"edit\",\"".$petugas['kode']."\")' class='thijau' title='Edit!'><img src='stylesheets/images/edit.png' class='sicon'/></a></td>
	<td class='actentry'><a href='javascript:del(\"petugas\",\"".$petugas['kode']."\",this)' class='tmerah' title='Hapus!' onclick='return konfirm(\"menghapus petugas ".$petugas['nama']."\")'><img src='stylesheets/images/drop.png' class='sicon'/></a></td>
</tr>	
	";
}
?>
	</th>
</table>
</div>