<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
if(isset($_GET['nama']))
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
	if(isset($_GET['bukaberita']))
		{	$sberita = 1; } else {$sberita = 0;}
	if(isset($_GET['bukaslide']))
		{	$sslide = 1; } else {$sslide = 0;}
	if(isset($_GET['bukapengaturan']))
		{	$spengaturan = 1; } else {$spengaturan = 0;}

	$update = mysql_query("UPDATE tbl_petugas SET
	nama='".esc($_GET['nama'])."',
	keterangan='".esc($_GET['keterangan'])."',
	sbuku = ".$sbuku.",
	skategori = ".$skategori.",
	spenerbit = ".$spenerbit.",
	sanggota = ".$sanggota.",
	spetugas = ".$spetugas.",
	speminjaman = ".$speminjaman.",
	spengembalian = ".$spengembalian.",
	spengaturan = ".$spengaturan."
	WHERE kode='".esc($_GET['kode'])."'
	");
	
	if($update)
		{	
			echo "1|sukses";
			$log = $user['nama']." memperbarui data petugas ".$_GET['nama'];
			que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')"); 
		}
	else
		{	echo "0|<div class='notifmerah'>Kesalahan system, data gagal diperbarui! <span class='notifclose' onclick='hid(this)'>x</span></div>"; }
}
else
{
	$pilihpetugas = mysql_query("SELECT * FROM tbl_petugas WHERE kode='".$_GET['kode']."';");
	$petugas	    = mysql_fetch_array($pilihpetugas);
	function recentang($r)
	{
		if($r == 1)
		{
			return " checked ";
		}
	}
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#formedit").submit(function(event){
		
		event.preventDefault();
		data = $("#formedit").serialize();
		$("#perbarui").val("Memperbarui..");
		$("#formedit *").prop("disabled","disabled");
		
		$.ajax({
			url: "petugas.edit.php?"+data,
			success: function(result,status){
				response = result.split("|");
				if(response[0] != "1")
				{
					$("#perbarui").val("Perbarui");
					$("#perbarui").focus();
					$("#formedit *").removeAttr("disabled");
					$(".notifmerah,.notifhijau,.notifkuning").remove();
					$("#formedit").before(response[1]);
				}
				else
				{
					$(".scontainer").fadeOut();
					hal("petugas",false,false,"1edt");
				}
			}
		});
	});
});
</script>
<div class="scontainer">
<a href='javascript:hal("petugas")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/petugas.png' class='micon'/> Edit Data Petugas <?php echo $petugas['nama'] ?></div>
<form id='formedit' action="#" method="get">
<table class="formtable">
  <tr>
  	<td style="width:80px">Kode</td>
    <td style="width:10px">:</td>
    <td colspan='2' style="width:520px"><input type="text" name='kode' class='iputih' value='<?php echo $petugas['kode'] ?>' readonly required maxlength='10' style='width:140px'/></td>
  </tr>
  <tr>
  	<td style="width:80px">Nama</td>
    <td style="width:10px">:</td>
    <td colspan="2" style="width:520px"><input type="text" name='nama' class='iputih' required maxlength='40' value='<?php echo $petugas['nama'] ?>'/></td>
  </tr>
 	<tr>
  	<td>Keterangan</td>
    <td>:</td>
    <td colspan="2"><textarea name='keterangan' required maxlength='140' style='width:240px' class="iputih"><?php echo $petugas['keterangan'] ?></textarea></td>
  </tr>
 	<tr>
  	<td valign="top">Hak Akses</td>
    <td valign="top">:</td>
    <td>
<label class="cbox"><input type="checkbox" name="bukabuku" <?php echo recentang($petugas['sbuku']) ?> id='bukabuku'/><span></span></label>
<label for="bukabuku">Administrasi Buku</label><br/>
<label class="cbox"><input type="checkbox" name="bukakategori" <?php echo recentang($petugas['skategori']) ?> id='bukakategori'/><span></span></label>
<label for="bukakategori">Administrasi Kategori</label><br/> 
<label class="cbox"><input type="checkbox" name="bukapenerbit" <?php echo recentang($petugas['spenerbit']) ?> id='bukapenerbit'/><span></span></label>
<label for="bukapenerbit">Administrasi Penerbit</label><br/>
<label class="cbox"><input type="checkbox" name="bukaanggota" <?php echo recentang($petugas['sanggota']) ?> id='bukaanggota'/><span></span></label>
<label for="bukaanggota">Administrasi Anggota</label><br/>
<label class="cbox"><input type="checkbox" name="bukapetugas" <?php echo recentang($petugas['spetugas']) ?> id='bukapetugas'/><span></span></label>
<label for="bukapetugas">Administrasi Petugas</label><br/>  
		</td>
    <td>
<label class="cbox"><input type="checkbox" name="bukapeminjaman" <?php echo recentang($petugas['speminjaman']) ?> id='bukapeminjaman'/><span></span></label>
<label for="bukapeminjaman">Administrasi Peminjaman</label><br/>
<label class="cbox"><input type="checkbox" name="bukapengembalian" <?php echo recentang($petugas['spengembalian']) ?> id='bukapengembalian'/><span></span></label>
<label for="bukapengembalian">Administrasi Pengembalian</label><br/>
<label class="cbox"><input type="checkbox" name="bukapengaturan" <?php echo recentang($petugas['spengaturan']) ?> id='bukapengaturan'/><span></span></label>
<label for="bukapengaturan">Administrasi Pengaturan</label><br/>
    </td>
  </tr>
 	<tr>
  	<td colspan='4'>
    	<input type='submit' name='kirim' id='perbarui' value='Perbarui' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
</div>
<?php
}
?>