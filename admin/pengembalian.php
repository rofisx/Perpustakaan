<?php
session_start();
require_once "configs/koneksi.php";
require_once "configs/ceklogin.php";
require_once "configs/fungsi.php";
?>
<div class="scontainer">
<div class='titlepage'><img src='stylesheets/images/kembali.png' class='micon'/> Pengembalian</div>
<table>
	<tr>
		<td>
			<input type='text' class="sputih" id='kotakkembali' onkeyup="loadpinjam(this.value)" style="width:250px" placeholder="Masukkan kode peminjaman.."/>
		</td>
		<td width="300px">
			<span id='lblpinjam' style='display:inline-block;margin-left:20px'>
			</span>
		</td>
  </tr>
</table>
<br/>

<div id='pinjamlist'>

</div>
</div>
