<?php
if(isset($_GET['kode']))
{
	session_start();
	require "configs/koneksi.php";
	require "configs/fungsi.php";
	require "configs/ceklogin.php";

	$cek 		= que("SELECT * FROM tbl_petugas WHERE kode='".$_GET['kode']."';");
	if(num($cek)>0)
	{
		echo "0|<div class='notifmerah'>Kode akses <b>".$_GET['kode']."</b> telah digunakan, pilih kode akses lain <span class='notifclose'>x</span></div>";
	}
	else
	{
		if(isset($_GET['bukabuku']))
			{	$sbuku = 1; } else {$sbuku = 0;}
		if(isset($_GET['bukakategori']))
			{	$skategori = 1; } else {$skategori = 0;}
		if(isset($_GET['bukapenerbit']))
			{	$spenerbit = 1; } else {$spenerbit = 0;}
		if(isset($_GET['bukaanggota']))
			{	$sanggota = 1; } else {$sanggota = 0;}
		if(isset($_GET['bukapetugas']))
			{	$spetugas = 1; } else {$spetugas = 0;}
		if(isset($_GET['bukapeminjaman']))
			{	$speminjaman = 1; } else {$speminjaman = 0;}
		if(isset($_GET['bukapengembalian']))
			{	$spengembalian = 1; } else {$spengembalian = 0;}
		if(isset($_GET['bukapengaturan']))
			{	$spengaturan = 1; } else {$spengaturan = 0;}
						
		$simpan = que("INSERT INTO tbl_petugas(kode,nama,keterangan,password,sbuku,skategori,spenerbit,sanggota,spetugas,speminjaman,spengembalian,spengaturan) VALUES(
		'".esc($_GET['kode'])."',
		'".esc($_GET['nama'])."',
		'".esc($_GET['keterangan'])."',
		'".md5($_GET['password'])."',
		".$sbuku.",".$skategori.",".$spenerbit.",".$sanggota.",".$spetugas.",".$speminjaman.",".$spengembalian.",".$spengaturan."
		)");
	
		if($simpan)
			{
				echo "1|sukses"; 
				$log = $user['nama']." menambahkan ".$_GET['nama']." sebagai petugas";
				que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')");
			}
		else
			{	echo "0|<div class='notifmerah'>Kesalahan system, data gagal disimpan! <span class='notifclose' onclick='hid(this)'>x</span></div>"; }
	}
}
else
{
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#formtambah").submit(function(event){
		
		event.preventDefault();
		data = $("#formtambah").serialize();
		$("#simpan").val("Menyimpan..");
		$("#formtambah *").prop("disabled","disabled");
		
		$.ajax({
			url: "petugas.tambah.php?"+data,
			success: function(result,status){
				
				response = result.split("|");
				if(response[0] != "1")
				{
					$("#simpan").val("Simpan");
					$("#simpan").focus();
					$("#formtambah *").removeAttr("disabled");
					$(".notifmerah,.notifhijau,.notifkuning").remove();
					$("#formtambah").before(response[1]);
				}
				else
				{
					$(".scontainer").fadeOut();
					hal("petugas",false,false,"1add");
				}
			}
		});
	});
});
</script>
<div class='scontainer'>
<a href='javascript:hal("petugas")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/petugas.png' class='micon'/> Tambah Petugas</div>
<form action="#" method="get" id='formtambah'>
<table class='formtable' style='margin-left:20px;'>
  <tr>
  	<td style="width:80px">Kode</td>
    <td style="width:10px">:</td>
    <td style="width:520px" colspan="2"><input type="text" name='kode' required maxlength='10' style='width:140px' class="iputih"/></td>
  </tr>
  <tr>
  	<td>Nama</td>
    <td>:</td>
    <td colspan="2"><input type="text" name='nama' required maxlength='40' class="iputih"/></td>
  </tr>
 	<tr>
  	<td>Keterangan</td>
    <td>:</td>
    <td colspan="2"><textarea name='keterangan' required maxlength='140'  style='width:240px' class="iputih"/></textarea></td>
  </tr>
 	<tr>
  	<td>Password</td>
    <td>:</td>
    <td colspan="2"><input type="password" name='password' class="iputih" required maxlength='12' /></td>
  </tr>
 	<tr>
  	<td valign="top">Hak Akses</td>
    <td valign="top">:</td>
    <td>
<label class="cbox"><input type="checkbox" name="bukabuku" id='bukabuku'/><span></span></label>
<label for="bukabuku">Administrasi Buku</label><br/>
<label class="cbox"><input type="checkbox" name="bukakategori" id='bukakategori'/><span></span></label>
<label for="bukakategori">Administrasi Kategori</label><br/> 
<label class="cbox"><input type="checkbox" name="bukapenerbit" id='bukapenerbit'/><span></span></label>
<label for="bukapenerbit">Administrasi Penerbit</label><br/>
<label class="cbox"><input type="checkbox" name="bukaanggota" id='bukaanggota'/><span></span></label>
<label for="bukaanggota">Administrasi Anggota</label><br/>
<label class="cbox"><input type="checkbox" name="bukapetugas" id='bukapetugas'/><span></span></label>
<label for="bukapetugas">Administrasi Petugas</label><br/>  
		</td>
    <td>
<label class="cbox"><input type="checkbox" name="bukapeminjaman" id='bukapeminjaman'/><span></span></label>
<label for="bukapeminjaman">Administrasi Peminjaman</label><br/>
<label class="cbox"><input type="checkbox" name="bukapengembalian" id='bukapengembalian'/><span></span></label>
<label for="bukapengembalian">Administrasi Pengembalian</label><br/>
<label class="cbox"><input type="checkbox" name="bukapengaturan" id='bukapengaturan'/><span></span></label>
<label for="bukapengaturan">Administrasi Pengaturan</label><br/>
    </td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' name='kirim' value='Simpan' id='simpan' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
</div>
<?php
}
?>