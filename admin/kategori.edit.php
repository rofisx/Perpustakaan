<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
if(isset($_GET['nama']))
{
	$update = mysql_query("UPDATE tbl_kategori SET
	nama='".esc($_GET['nama'])."',
	keterangan='".esc($_GET['keterangan'])."'
	WHERE kode='".esc($_GET['kode'])."'
	");
	
	if($update)
		{	
			echo "1|sukses";
			$log = $user['nama']." memperbarui kategori ".$_GET['nama'];
			que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')"); 
		}
	else
		{	echo "0|<div class='notifmerah'>Kesalahan system, data gagal diperbarui! <span class='notifclose' onclick='hid(this)'>x</span></div>"; }
}
else
{
	$pilihkategori = mysql_query("SELECT * FROM tbl_kategori WHERE kode='".$_GET['kode']."';");
	$kategori	    = mysql_fetch_array($pilihkategori);
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#formedit").submit(function(event){
		
		event.preventDefault();
		data = $("#formedit").serialize();
		$("#perbarui").val("Memperbarui..");
		$("#formedit *").prop("disabled","disabled");
		
		$.ajax({
			url: "kategori.edit.php?"+data,
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
					hal("kategori",false,false,"1edt");
				}
			}
		});
	});
});
</script>
<div class="scontainer">
<a href='javascript:hal("kategori")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/kategori.png' class='micon'/> Edit Data Kategori</div>
<form id="formedit" action="#" method="get">
<table style="formtable">
  <tr>
  	<td style="width:80px">Kode</td>
    <td style="width:10px">:</td>
    <td style="width:520px"><input type="text" name='kode' value='<?php echo $kategori['kode'] ?>' class="iputih" readonly required maxlength='10' style='width:140px'/></td>
  </tr>
  <tr>
  	<td style="width:80px">Nama</td>
    <td style="width:10px">:</td>
    <td style="width:520px"><input type="text" name='nama' required maxlength='40' class='iputih' value='<?php echo $kategori['nama'] ?>'/></td>
  </tr>
 	<tr>
  	<td>Keterangan</td>
    <td>:</td>
    <td><textarea name='keterangan' required maxlength='140' style='width:240px' class="iputih"><?php echo $kategori['keterangan'] ?></textarea></td>
  </tr>
 	<tr>
  	<td colspan='3'>
    	<input type='submit' id='perbarui' value='Perbarui' class='thijau'/> 
      <input type='reset' name='reset' value='Bersihkan Form' class='tkuning'/>
    </td>
  </tr>
</table>
</form>
</div>
<?php
}
?>