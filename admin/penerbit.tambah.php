<?php
if(isset($_GET['kode']))
{
	session_start();
	require "configs/koneksi.php";
	require "configs/fungsi.php";
	require "configs/ceklogin.php";

	$cek 		= que("SELECT * FROM tbl_penerbit WHERE kode='".$_GET['kode']."';");
	if(num($cek)>0)
	{
		echo "0|<div class='notifmerah'>Kode akses <b>".$_GET['kode']."</b> telah digunakan, pilih kode akses lain <span class='notifclose'>x</span></div>";
	}
	else
	{
						
		$simpan = que("INSERT INTO tbl_penerbit(kode,nama,alamat,telepon,email) VALUES(
		'".esc($_GET['kode'])."',
		'".esc($_GET['nama'])."',
		'".esc($_GET['alamat'])."',
		'".esc($_GET['telepon'])."',
		'".esc($_GET['email'])."'
		)");
	
		if($simpan)
			{
				echo "1|sukses"; 
				$log = $user['nama']." menambahkan penerbit baru ".$_GET['nama'];
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
		$("#simpan").val("Connecting..");
		$("#formtambah *").prop("disabled","disabled");
		
		$.ajax({
			url: "penerbit.tambah.php?"+data,
			success: function(result,status){
				$("#simpan").val("Menyimpan..");
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
					hal("penerbit",false,false,"1add");
				}
			}
		});
	});
});
</script>
<div class="scontainer">
<a href='javascript:hal("penerbit")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/penerbit.png' class='micon'/> Tambah Penerbit Baru</div>
<form id="formtambah" action="#" method="get">
<table class='formtable'>
  <tr>
  	<td style="width:80px">Kode</td>
    <td style="width:10px">:</td>
    <td style="width:320px"><input type="text" name='kode' class='iputih' required maxlength='3' style='width:140px'/></td>
  </tr>
  <tr>
  	<td>Nama</td>
    <td>:</td>
    <td><input type="text" name='nama' class='iputih' required maxlength='40' /></td>
  </tr>
    <tr>
  	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name='telepon' class='iputih' required maxlength='14' style='width:220px'/></td>
  </tr>
    <tr>
  	<td>Email</td>
    <td>:</td>
    <td><input type="email" name='email' class='iputih' required maxlength='28' style='width:220px'/></td>
  </tr>
 	<tr>
  	<td>Alamat</td>
    <td>:</td>
    <td><textarea name='alamat' required class='iputih' maxlength='140'  style='width:240px'></textarea></td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' id='simpan' value='Simpan' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
</div>
<?php
}
?>