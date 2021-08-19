<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
require "configs/unggah.php";
if(isset($_POST['perbarui']))
{ 
	$update = mysql_query("UPDATE tbl_buku SET
	judul='".esc($_POST['judul'])."',
	pengarang='".esc($_POST['pengarang'])."',
	jumhal='".esc($_POST['jumlah'])."',
	kode_penerbit='".esc($_POST['penerbit'])."',
	kode_kategori='".esc($_POST['kategori'])."',
	tahun_terbit='".esc($_POST['tahun'])."',
	deskripsi='".esc($_POST['deskripsi'])."',
	kondisi='".esc($_POST['kondisi'])."'
	WHERE kode='".esc($_POST['kode'])."'
	");
	if($update)
	{
    if(!empty($_FILES['foto']['name']))
    {
    	$pilihbuku = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$_POST['kode']."';");
      $buku	     = mysql_fetch_array($pilihbuku);
      unlink("files/images/buku/".$buku['foto']);
      unggah_foto("foto",$_POST['kode'],"files/images/buku/");
      $update = mysql_query("UPDATE tbl_buku set foto='".basename($filebaru)."' WHERE kode='".$_POST['kode']."';");
    }
    header("Location: dasbor.html?p=buku&ref=1edt");
	}
	else
	{
		die("<script>alert('Terjadi Kesalahan dalam sistem!');history.back();</script>");
	}
}
else
{
	$pilihbuku = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$_GET['kode']."';");
	$buku	    = mysql_fetch_array($pilihbuku);
?>
<a href='javascript:hal("buku")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>
<div class='titlepage'><img src='stylesheets/images/buku.png' class='micon' /> Edit Data buku</div>
<form action="buku.edit.php" method="post" name='kirim' enctype='multipart/form-data'>
<table style='margin-left:20px;'>
  <tr>
  	<td>Kode</td>
    <td>:</td>
    <td><input type="text" name='kode' class='iputih' value='<?php echo $buku['kode'] ?>' readonly required maxlength='40' /></td>
  </tr>
  <tr>
  	<td>Judul</td>
    <td>:</td>
    <td><input type="text" name='judul' class='iputih' value='<?php echo $buku['judul'] ?>' required maxlength='40' /></td>
  </tr>
  <tr>
  	<td>Halaman</td>
    <td>:</td>
    <td><input type="text" name='jumlah' class='iputih' value='<?php echo $buku['jumhal'] ?>' required maxlength='4' style='width:40px'/> Halaman</td>
  </tr>
  <tr>
  	<td>Pengarang</td>
    <td>:</td>
    <td><input type="text" name='pengarang' class='iputih' value='<?php echo $buku['pengarang'] ?>' required maxlength='40'/></td>
  </tr>
  <tr>
  	<td>Kategori</td>
    <td>:</td>
    <td>
<select name='kategori' class="sputih">
<?php
$pilihkategori = mysql_query("SELECT * FROM tbl_kategori");
while($kategori= mysql_fetch_array($pilihkategori))
{
  if($kategori['kode']== $buku['kode_kategori'])
  {
    echo "<option value='".$kategori['kode']."' selected>".$kategori['nama']."</option>";
  }
  else
  {
    echo "<option value='".$kategori['kode']."'>".$kategori['nama']."</option>";  
  }
}
?>
</select>
    </td>
  </tr>
  <tr>
  	<td>Penerbit</td>
    <td>:</td>
    <td>
<select name='penerbit' class="sputih">
<?php
$pilihpenerbit = mysql_query("SELECT * FROM tbl_penerbit");
while($penerbit= mysql_fetch_array($pilihpenerbit))
{
  if($penerbit['kode']== $buku['kode_penerbit'])
  {
    echo "<option value='".$penerbit['kode']."' selected>".$penerbit['nama']."</option>";
  }
  else
  {
    echo "<option value='".$penerbit['kode']."'>".$penerbit['nama']."</option>";  
  }
}
?>
</select>
    </td>
  </tr>
  <tr>
  	<td>Tahun Terbit</td>
    <td>:</td>
    <td><input type="text" name='tahun' value='<?php echo $buku['tahun_terbit'] ?>' required maxlength='4' class='iputih' style='width:40px'/></td>
  </tr>
 	<tr>
  	<td>Deskripsi</td>
    <td>:</td>
    <td><textarea name='deskripsi' maxlength='250' class='iputih' style='width:240px'><?php echo $buku['deskripsi'] ?></textarea></td>
  </tr>
  <tr>
  	<td valign="top">Kondisi</td>
  	<td valign="top">:</td>
  	<td>
    	<label class="radio"><input type="radio" name="kondisi" checked id='baik' <?php if($buku['kondisi'] == 1){echo "checked";} ?> value="1"/><span></span></label>
			<label for="baik">Baik</label>
      
     	<label class="radio"><input type="radio" name="kondisi" id='rusakringan' <?php if($buku['kondisi'] == 2){echo "checked";} ?>  value="2"/><span></span></label>
			<label for="rusakringan">Rusak Ringan</label>
      
     	<label class="radio"><input type="radio" name="kondisi" id='rusakberat' <?php if($buku['kondisi'] == 3){echo "checked";} ?> value="3"/><span></span></label>
			<label for="rusakberat">Rusak Berat</label>
      
     	<label class="radio"><input type="radio" name="kondisi" id='hilang' <?php if($buku['kondisi'] == 4){echo "checked";} ?> value="4"/><span></span></label>
			<label for="hilang">Rusak total / hilang</label>
    </td>    
  </tr>
   	<tr>
    <th colspan='3'>Foto</th>
  </tr>
 	<tr>
    <td colspan='2'></td>
    <td class='prevfoto'>
      <img src='files/images/buku/<?php echo $buku['foto'] ?>'/>
    </td>
  </tr>
 	<tr>
  	<td>Upload</td>
    <td>:</td>
    <td><input type="file" name='foto'/></td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' name='perbarui' value='Perbarui' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
  </table>
</form>
<?php
}
?>