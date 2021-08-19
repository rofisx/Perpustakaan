<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
require "configs/unggah.php";
if(isset($_POST['kirim']))
{
  $cek = mysql_query("SELECT MAX(kode) as kode FROM tbl_buku WHERE kode LIKE '".$_POST['kategori']."%".$_POST['penerbit']."' ORDER BY kode DESC LIMIT 0,1");
  if(mysql_num_rows($cek)==0)
  {
    $genkode= strtoupper($_POST['kategori'].str_pad(1, 4, '0', STR_PAD_LEFT).$_POST['penerbit']);
  }
  else
  {
    $rcek   = mysql_fetch_array($cek);
    $wleadz = ltrim(substr($rcek['kode'],3,4),0);
    $newkode= $wleadz + 1;
    $genkode= strtoupper($_POST['kategori'].str_pad($newkode, 4, '0', STR_PAD_LEFT).$_POST['penerbit']);
  }
	$simpan = mysql_query("INSERT INTO tbl_Buku(kode,judul,jumhal,pengarang,kode_kategori,kode_penerbit,tahun_terbit,deskripsi,kondisi) VALUES(
	'".$genkode."',
  '".esc($_POST['judul'])."',
  ".esc($_POST['jumlah']).",
  '".esc($_POST['pengarang'])."',
  '".esc($_POST['kategori'])."',
  '".esc($_POST['penerbit'])."',
	'".esc($_POST['tahun'])."',
	'".esc($_POST['deskripsi'])."',
	'".esc($_POST['kondisi'])."'
	)");

  if($simpan)
	{
    unggah_foto("foto",$genkode,"files/images/buku/");
    $update = mysql_query("UPDATE tbl_buku set foto='".basename($filebaru)."' WHERE kode='".$genkode."';");
		header("Location: dasbor.html?p=buku&ref=1add");
	}
	else
	{
		die("<script>alert('Terjadi Kesalahan dalam sistem!');</script>");
	}
}
else
{
?>
<a href='javascript:hal("buku")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/buku.png' class='micon'/> Tambah Buku Baru</div>
<form action="buku.tambah.php" method="post" name='kirim' enctype='multipart/form-data'>
<table style='margin-left:20px;'>
  <tr>
  	<td>Judul</td>
    <td>:</td>
    <td><input class="iputih" type="text" name='judul' required maxlength='40' /></td>
  </tr>
  <tr>
  	<td>Halaman</td>
    <td>:</td>
    <td><input class="iputih" type="text" name='jumlah' pattern='\d*' required maxlength='4' style='width:40px'/> Halaman</td>
  </tr>
  <tr>
  	<td>Pengarang</td>
    <td>:</td>
    <td><input class="iputih" type="text" name='pengarang' required maxlength='40'/></td>
  </tr>
  <tr>
  	<td>Kategori</td>
    <td>:</td>
    <td>
<select name='kategori' class="sputih" style="width:200px;">
<?php
$pilihkategori = que("SELECT * FROM tbl_kategori");
while($kategori= mysql_fetch_array($pilihkategori))
{
	echo "<option value='".$kategori['kode']."'>".$kategori['nama']."</option>
  ";
}
?>
</select>
    </td>
  </tr>
  <tr>
  	<td>Penerbit</td>
    <td>:</td>
    <td>
<select name='penerbit' class="sputih" style="width:200px;">
<?php
$pilihpenerbit = mysql_query("SELECT * FROM tbl_penerbit");
while($penerbit= mysql_fetch_array($pilihpenerbit))
{
	echo "<option value='".$penerbit['kode']."'>".$penerbit['nama']."</option>
  ";
}
?>
</select>
    </td>
  </tr>
  <tr>
  	<td>Tahun Terbit</td>
    <td>:</td>
    <td><input type="text" name='tahun' pattern='\d*' required maxlength='4'  class="iputih" style='width:40px'/></td>
  </tr>
 	<tr>
  	<td>Deskripsi</td>
    <td>:</td>
    <td><textarea class="iputih" name='deskripsi' maxlength='250'  style='width:240px'/></textarea></td>
  </tr>
  <tr>
  	<td valign="top">Kondisi</td>
  	<td valign="top">:</td>
  	<td>
    	<label class="radio"><input type="radio" name="kondisi" checked id='baik' value="1"/><span></span></label>
			<label for="baik">Baik</label>
      
     	<label class="radio"><input type="radio" name="kondisi" id='rusakringan' value="2"/><span></span></label>
			<label for="rusakringan">Rusak Ringan</label>
      
     	<label class="radio"><input type="radio" name="kondisi" id='rusakberat' value="3"/><span></span></label>
			<label for="rusakberat">Rusak Berat</label>
      
     	<label class="radio"><input type="radio" name="kondisi" id='hilang' value="4"/><span></span></label>
			<label for="hilang">Rusak total / hilang</label>
    </td>    
  </tr>
 	<tr>
    <th colspan='3'>Foto</th>
  </tr>
 	<tr>
  	<td>Upload</td>
    <td>:</td>
    <td><input type="file" name='foto' required/></td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' name='kirim' value='Simpan' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
<?php
}
?>