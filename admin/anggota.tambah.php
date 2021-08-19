<?php
if(isset($_POST['kirim']))
{
	session_start();
	require "configs/koneksi.php";
	require "configs/fungsi.php";
	require "configs/ceklogin.php";
	require "configs/unggah.php";
	
  $initial  = substr(purify($_POST['nama']),0,1);
  $diyear   = substr(purify($_POST['lahir']),2,2);
  $cek      = mysql_query("SELECT MAX(kode) as kode FROM tbl_anggota WHERE kode LIKE '".$diyear.$initial."%' ORDER BY kode DESC LIMIT 0,1");
 if(mysql_num_rows($cek)==0)
  {
    $genkode= strtoupper($diyear.$initial.str_pad(1, 5, '0', STR_PAD_LEFT));
  }
  else
  {
    $rcek   = mysql_fetch_array($cek);
    $wleadz = ltrim(substr($rcek['kode'],3,5),0);
    $newkode= $wleadz + 1;
    $genkode= strtoupper($diyear.$initial.str_pad($newkode, 5, '0', STR_PAD_LEFT));
  }
	$simpan1 = mysql_query("INSERT INTO tbl_anggota(kode,nama,alamat,telepon,tanggal_lahir) VALUES(
	'".$genkode."',
  '".$_POST['nama']."',
	'".$_POST['alamat']."',
	'".$_POST['telepon']."',
  '".$_POST['lahir']."'
	)");
  
  $cekuser = mysql_query("SELECT * FROM tbl_petugas WHERE kode='".$_SESSION['kode']."';");  
  $user = mysql_fetch_array($cekuser);
	
  $expdate = date("Y-m-d",strtotime("+".$web['web_masaaktif']." days",strtotime($_POST['tanggal']." 00:00:00")));
	$simpan2 = mysql_query("INSERT INTO tbl_kartu_pendaftaran(kode_petugas,kode_anggota,tanggal_pembuatan,tanggal_akhir,status) VALUES(
	'".$user['kode']."',
	'".$genkode."',
	'".$_POST['aktif']."',
  '".$expdate."',
  1
	)");
  
  if($simpan1 AND $simpan2)
	{
    unggah_foto("foto",$genkode,"files/images/anggota/");
    $update = mysql_query("UPDATE tbl_anggota set foto='".basename($filebaru)."' WHERE kode='".$genkode."';");
		$log = $user['nama']." menambahkah ".$_POST['nama']." sebagai anggota";
		que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')"); 
		header("Location: dasbor.html?p=anggota&ref=1add");
	}
	else
	{
		die("<script>alert('Terjadi Kesalahan dalam sistem!".mysql_error()."');</script>");
	}
}
else
{
?>
<div class="scontainer">
<a href='javascript:hal("anggota")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/anggota.png' class='micon'/> Tambah Anggota Baru</div>
<form action="anggota.tambah.php" method="post" name='kirim' enctype='multipart/form-data'>
<table style='margin-left:20px;'>
	<tr>
    <th colspan='3'>Data Pribadi</th>
  </tr>
  <tr>
  	<td style="width:80px">Nama</td>
    <td style="width:10px">:</td>
    <td style="width:520px"><input type="text" name='nama' class='iputih' required maxlength='40' /></td>
  </tr>
 	<tr>
  	<td>Tanggal Lahir</td>
    <td>:</td>
    <td><input type="text" placeholder='cont: 1994-07-21' class='iputih' name='lahir' required maxlength='10' style='width:100px;'/></textarea></td>
  </tr>
	<tr>
  	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name='telepon' class='iputih' required maxlength='14' style='width:300px;'/></td>
  </tr>
 	<tr>
  	<td>Alamat</td>
    <td>:</td>
    <td><textarea name='alamat' required maxlength='140' class='iputih' style='width:240px'/></textarea></td>
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
    <th colspan='3'>Keanggotaan</th>
  </tr>
 	<tr>
  	<td>Aktif Mulai</td>
    <td>:</td>
    <td><input type="text" value='<?php echo date("Y-m-d"); ?>' name='aktif' class='iputih' required maxlength='14' style='width:100px;'/></textarea></td>
  </tr>
 	<tr>
    <td colspan='2'></td>
  	<td><span class='catatan'>Masa aktif anggota adalah 360 hari sejak tanggal aktif, setelahnya keanggotaan harus diperpanjang.</span></td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' name='kirim' value='Simpan' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
</div>
<?php
}
?>