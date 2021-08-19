<?php
if(isset($_GET['kode']))
{
	session_start();
	require "configs/koneksi.php";
	require "configs/fungsi.php";
	require "configs/ceklogin.php";

	$cek 		= que("SELECT * FROM tbl_kategori WHERE kode='".$_GET['kode']."';");
	if(num($cek)>0)
	{
		echo "0|<div class='notifmerah'>Kode akses <b>".$_GET['kode']."</b> telah digunakan, pilih kode akses lain <span class='notifclose'>x</span></div>";
	}
	else
	{
						
		$simpan = que("INSERT INTO tbl_kategori(kode,nama,keterangan) VALUES(
		'".esc($_GET['kode'])."',
		'".esc($_GET['nama'])."',
		'".esc($_GET['keterangan'])."'
		)");
	
		if($simpan)
			{
				echo "1|sukses"; 
				$log = $user['nama']." menambahkan kategori baru ".$_GET['nama'];
				que("INSERT INTO tbl_log_kategori(log) VALUES('".$log."')");
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
			url: "kategori.tambah.php?"+data,
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
					hal("kategori",false,false,"1add");
				}
			}
		});
	});
});
</script>
<div class="scontainer">
<a href='javascript:hal("kategori")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/kategori.png' class='micon'/> Tambah Kategori Baru</div>
<form id="formtambah" action="#" method="get">
<table class='formtable'>
  <tr>
  	<td style="width:80px">Kode</td>
    <td style="width:10px">:</td>
    <td style="width:520px"><input type="text" name='kode' class='iputih' required maxlength='2' style='width:140px'/></td>
  </tr>
  <tr>
  	<td>Nama</td>
    <td>:</td>
    <td><input type="text" name='nama' class='iputih' required maxlength='40' /></td>
  </tr>
 	<tr>
  	<td>Keterangan</td>
    <td>:</td>
    <td><textarea name='keterangan' required class='iputih' maxlength='140'  style='width:240px'/></textarea></td>
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