<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
if(isset($_GET['nama']))
{
	$update = mysql_query("UPDATE tbl_penerbit SET
	nama='".esc($_GET['nama'])."',
	alamat='".esc($_GET['alamat'])."',
  email='".esc($_GET['email'])."',
  telepon='".esc($_GET['telepon'])."'
	WHERE kode='".esc($_GET['kode'])."'
	");
	
	if($update)
		{	
			echo "1|sukses";
			$log = $user['nama']." memperbarui penerbit ".$_GET['nama'];
			que("INSERT INTO tbl_log_petugas(log) VALUES('".$log."')"); 
		}
	else
		{	echo "0|<div class='notifmerah'>Kesalahan system, data gagal diperbarui! <span class='notifclose' onclick='hid(this)'>x</span></div>"; }
}
else
{
	$pilihpenerbit = mysql_query("SELECT * FROM tbl_penerbit WHERE kode='".$_GET['kode']."';");
	$penerbit	    = mysql_fetch_array($pilihpenerbit);
?>
<script type="text/javascript">
$(document).ready(function(){
	$("#formedit").submit(function(event){
		
		event.preventDefault();
		data = $("#formedit").serialize();
		$("#perbarui").val("Memperbarui..");
		$("#formedit *").prop("disabled","disabled");
		
		$.ajax({
			url: "penerbit.edit.php?"+data,
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
					hal("penerbit",false,false,"1edt");
				}
			}
		});
	});
});
</script>
<div class="scontainer">
<a href='javascript:hal("penerbit")' class='add'><img src='stylesheets/images/back.png' class='micon'/> Kembali</a>

<div class='titlepage'><img src='stylesheets/images/penerbit.png' class='micon'/> Edit Data Penerbit</div>
<form id="formedit" action="#" method="get">
<table style="formtable">
  <tr>
  	<td style="width:80px">Kode</td>
    <td style="width:10px">:</td>
    <td style="width:520px"><input type="text" name='kode' value='<?php echo $penerbit['kode'] ?>' class="iputih" readonly required maxlength='10' style='width:140px'/></td>
  </tr>
  <tr>
  	<td>Nama</td>
    <td>:</td>
    <td><input type="text" name='nama' required maxlength='40' class='iputih' value='<?php echo $penerbit['nama'] ?>'/></td>
  </tr>
  <tr>
  	<td>Telepon</td>
    <td>:</td>
    <td><input type="text" name='telepon' class='iputih' required maxlength='14' value='<?php echo $penerbit['telepon'] ?>' style='width:220px'/></td>
  </tr>
    <tr>
  	<td>Email</td>
    <td>:</td>
    <td><input type="email" name='email' class='iputih' required maxlength='28' value="<?php echo $penerbit['email'] ?>" style='width:220px'/></td>
  </tr>
 	<tr>
  	<td>Alamat</td>
    <td>:</td>
    <td><textarea name='alamat' required maxlength='140' style='width:240px' class="iputih"><?php echo $penerbit['alamat'] ?></textarea></td>
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