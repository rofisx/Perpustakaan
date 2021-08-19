<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
require "configs/unggah.php";
if(isset($_POST['kirim']))
{
	$update = mysql_query("UPDATE tbl_anggota SET
	nama='".$_POST['nama']."',
	telepon='".$_POST['telepon']."',
	alamat='".$_POST['alamat']."',
	tanggal_lahir='".$_POST['lahir']."'
	WHERE kode='".$_POST['kode']."'
	");
	if($update)
	{
		$log = $user['nama']." memperbarui data anggota ".$_POST['nama'];
		que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')"); 
    if(!empty($_FILES['foto']['name']))
    {
     	$pilihanggota = mysql_query("SELECT * FROM tbl_anggota WHERE kode='".$_POST['kode']."';");
      $anggota	     = mysql_fetch_array($pilihanggota);
      unlink("files/images/anggota/".$anggota['foto']);
      unggah_foto("foto",$_POST['kode'],"files/images/anggota/");
      $update = mysql_query("UPDATE tbl_anggota set foto='".basename($filebaru)."' WHERE kode='".$_POST['kode']."';");
    }
		header("Location: dasbor.html?p=anggota&ref=1edt".$a);
	}
	else
	{
		die("<script>alert('Terjadi Kesalahan dalam sistem!');history.back();</script>");
	}
}
else
{
	$pilihanggota = mysql_query("SELECT * FROM tbl_anggota WHERE kode='".$_GET['kode']."';");
	$anggota	    = mysql_fetch_array($pilihanggota);
?>
<div class="scontainer">
<a href='javascript:hal("anggota")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/anggota.png' class='micon'/> Edit Data Anggota</div>
<form action="anggota.edit.php" method="post" name='kirim' enctype='multipart/form-data'>
<input type="hidden" name='kode' value='<?php echo $anggota['kode'] ?>'/>
<table style='margin-left:20px;'>
	<tr>
    <th colspan='3'>Data Pribadi</th>
  </tr>
  <tr>
  	<td style="width:80px">Nama</td>
    <td style="width:10px">:</td>
    <td style="width:520px"><input type="text" name='nama' class="iputih" required maxlength='40' value='<?php echo $anggota['nama'] ?>'/></td>
  </tr>
 	<tr>
  	<td>Tanggal Lahir</td>
    <td>:</td>
    <td><input type="text" placeholder='cont: 1994-07-21' class="iputih" name='lahir' required maxlength='10' style='width:100px;' value='<?php echo $anggota['tanggal_lahir'] ?>'/></textarea></td>
  </tr>
	<tr>
  	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name='telepon' required class="iputih" maxlength='14' style='width:300px;' value='<?php echo $anggota['telepon'] ?>'/></td>
  </tr>
 	<tr>
  	<td>Alamat</td>
    <td>:</td>
    <td><textarea name='alamat' required maxlength='140'  style='width:240px' class="iputih"><?php echo $anggota['alamat'] ?></textarea></td>
  </tr>
 	<tr>
    <th colspan='3'>Foto</th>
  </tr>
 	<tr>
    <td colspan='2'></td>
    <td class='prevfoto'>
      <img src='files/images/anggota/<?php echo $anggota['foto'] ?>'/>
    </td>
  </tr>
 	<tr>
  	<td>Upload</td>
    <td>:</td>
    <td><input type="file" name='foto'/></td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' name='kirim' value='Perbarui' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
</div>
<?php
}
?>