<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
require "configs/unggah.php";
if(isset($_POST['update']))
{
	if(!empty($_FILES['foto']['name']))
	{
		unggah_foto("foto","logo","stylesheets/images/");
		$update = mysql_query("UPDATE tbl_pengaturan SET web_logo='".basename($filebaru)."' WHERE id=1;");
	}
		
	mysql_query("UPDATE tbl_pengaturan SET
	web_nama = '".$_POST['nama']."',
	web_color = '".$_POST['warna']."',
	web_lamapinjam = ".$_POST['lama'].",
	web_kuotapinjam = ".$_POST['kuota'].",
	web_masaaktif = ".$_POST['masa'].",
	web_denda = ".$_POST['denda']."
	WHERE id=1;
	");
	
	echo "
	<script>
		alert('Pengaturan disimpan!');
		window.location = 'dasbor.html';
	</script>
	";
}
else if(isset($_POST['ganti']))
{
	mysql_query("UPDATE tbl_petugas SET password = '".md5($_POST['pbaru'])."' WHERE kode = '".$user['kode']."';");
	echo "
	<script>
		alert('Password disimpan!');
		window.location = 'dasbor.html';
	</script>
	";
}
else
{
?>
<div class="scontainer">
<div class='titlepage'><img src='stylesheets/images/pengaturan.png' class='micon'/> Pengaturan Website</div>
<form action="pengaturan.php" method="post" id='formtambah' enctype="multipart/form-data">
<table class='formtable' style='margin-left:20px;'>
  <tr>
  	<td>Nama</td>
    <td>:</td>
    <td colspan="2"><input type="text" name='nama' required  value="<?php echo $web['web_nama'] ?>" maxlength='40' class="iputih"/></td>
  </tr>
    <tr>
  	<td>Warna</td>
    <td>:</td>
    <td colspan="2"><input type="text" name='warna' value="<?php echo $web['web_color'] ?>" required maxlength='12' style='width:100px' class="iputih"/></td>
  </tr>
   <tr>
  	<td>Lama Peminjaman Buku</td>
    <td>:</td>
    <td colspan="2"><input type="text" name='lama' required maxlength='2' value="<?php echo $web['web_lamapinjam'] ?>" pattern="\d*" style='width:100px' class="iputih"/> hari</td>
  </tr>
  <tr>
  	<td>Kuota Peminjaman Buku</td>
    <td>:</td>
    <td colspan="2"><input type="text" name='kuota' required maxlength='2' value="<?php echo $web['web_kuotapinjam'] ?>" pattern="\d*" style='width:100px' class="iputih"/> buku</td>
  </tr>
     <tr>
  	<td>Masa Aktif Kartu</td>
    <td>:</td>
    <td colspan="2"><input type="text" name='masa' required maxlength='3' value="<?php echo $web['web_masaaktif'] ?>" pattern="\d*" style='width:100px' class="iputih"/> hari</td>
  </tr>
     <tr>
  	<td>Denda per hari</td>
    <td>:</td>
    <td colspan="2">Rp. <input type="text" name='denda' required maxlength='5' value="<?php echo $web['web_denda'] ?>" pattern="\d*" style='width:100px' class="iputih"/></td>
  </tr>
   <tr>
  	<td>Logo</td>
    <td>:</td>
    <td colspan="2"><input type='file' name='foto'/></td>
  </tr>
   <tr>
  	<td colspan="4"><input type="submit" name="update" value="Perbarui" class="thijau" /></td>
  </tr>
</table>
</form>

<div class='titlepage'><img src='stylesheets/images/pengaturan.png' class='micon'/> Ganti Password</div>
<form action="pengaturan.php" method="post" id='formpass'>
<table class='formtable' style='margin-left:20px;'>
  <tr>
  	<td>Password Lama</td>
    <td>:</td>
    <td colspan="2"><input type="password" name='plama' required  maxlength='40' class="iputih"/></td>
  </tr>
  <tr>
  	<td>Password Baru</td>
    <td>:</td>
    <td colspan="2"><input type="password" name='pbaru' required maxlength='40' class="iputih"/></td>
  </tr>
   <tr>
  	<td colspan="4"><input type="submit" name="ganti" value="Perbarui" class="thijau" /></td>
  </tr>
</table>
</form>
</div>
<?php
}
?>