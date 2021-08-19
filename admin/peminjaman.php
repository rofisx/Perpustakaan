<?php
session_start();
require_once "configs/koneksi.php";
require_once "configs/ceklogin.php";
require_once "configs/fungsi.php";
?>
<div class="scontainer">
<div id='pinjambuku' style='width:850px;'>
  <div class='titlepage'><img src='stylesheets/images/pinjam.png' class='micon'/> Peminjaman</div>
  <div id='rakbuku'>
  <table>
    <tr>
      <td><input type='text' class="sputih" name='cariorang' id='kotakpeminjam' onkeyup="loaduser(this.value)" style="width:250px" placeholder="Masukkan kode anggota"/></td>
      <td><span id='lblpeminjam' style='display:inline-block;margin-left:10px'> </span></td>
    </tr>
    <tr>
      <td>
        <input type='text' class='sputih' name='caribuku' id='kotakbuku' disabled="disabled" onkeyup="keyDownBuku(this.value)" style="width:250px" placeholder='Masukkan kode buku atau judul...'/>
      </td>
      <td>
        <span id='lblbuku' style='display:inline-block;margin-left:10px'> 
        </span>
      </td>
    </tr>
  </table>
    <div id='booklist'>
      
    </div>
  </div>
  <div id='keranjang'>
  <div class='titlepage'><img src='stylesheets/images/buku.png' class='micon'/> Buku akan dipinjam</div>
  	<div>Kuota Peminjaman  : <span id='maxpinjam'><?php echo $web['web_kuotapinjam'] ?> buku</span></div>
  	<div id='cartbox' ondrop="drop(event)" ondragover="allowDrop(event)">
    
    </div>
    <a href='javascript:clearpinjam()' class='tkuning'>Kosongkan</a>
    <a href='javascript:pinjam()' class='thijau'>Pinjam</a>
  </div>
</div>
</div>
<?php
if(isset($_GET['ref']))
{
?>
<script>
$("#kotakpeminjam").val("<?php echo $_GET['ref'] ?>");
loaduser("<?php echo $_GET['ref'] ?>");
</script>
<?php
}
?>