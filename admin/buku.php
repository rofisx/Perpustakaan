<?php
session_start();
	include "configs/koneksi.php";
	include "configs/fungsi.php";
	include "configs/ceklogin.php";
?>

<div class="scontainer">
<?php
$perpage		= 3; 
$querytotal	= mysql_query("SELECT * FROM tbl_buku");
$pagetotal	= mysql_num_rows($querytotal);
$jumpage		= ceil($pagetotal/$perpage);

if(isset($_GET['page']))
	{
		$limit 	= "LIMIT ".($_GET['page']-1)*$perpage.",".$perpage; 
		$curpage= $_GET['page'];
	}
else
	{ 
		$limit 		= "LIMIT 0,".$perpage; 
		$curpage	= 1;
	}
?>

<div class='navtable' style="padding-bottom: 10px">
	<div class='navleft'>
  		<a href='javascript:hal("buku","tambah")' class='add'><img src='stylesheets/images/add.png' class='micon'/> Tambah Buku Baru</a>
  	</div>
  	<div></div>
  	<div class="navright">
	<?php
if(isset($_GET['page']) AND $_GET['page'] > 1)
	{	echo "<a href='javascript:hal(\"buku\",0,0,0,\"".($curpage-1)."\")' class='add'><img src='stylesheets/images/back.png' class='micon'/> </a>"; }	
echo " <select name='halaman' class='sputih' style='width:50px;padding:2px;margin:5px 10px 5px 0px;' onchange='hal(\"buku\",0,0,0,this.value)'>";
for($r=1; $r <= $jumpage ; $r++)
	{	
		if($curpage == $r)
		{
			echo "<option value=".$r." selected>".$r."</a>";
		}
		else
		{
			echo "<option value=".$r.">".$r."</a>";
		}
	}
echo "</select> ";
if($jumpage>1 AND (!isset($_GET['page']) OR @$_GET['page'] < $jumpage))
	{	echo "<a href='javascript:hal(\"buku\",0,0,0,\"".($curpage+1)."\")' class='add'><img src='stylesheets/images/next.png' class='micon'/> </a>"; }	
?>
  </div>
</div>

<div class="right">
<div class='metrosearch'>
	<img src="../admin/stylesheets/images/searchb.png" />
	<input type="text" name="caribuku" id='caribook' onkeyup="loadbookku(this.value)" placeholder='Cari Kode atau Nama Buku' autofocus>
	<span id='lblbuku' style='display:inline-block;margin-left:20px'>
	</span>

</div>
</div>

<?php
	if(isset($_GET['ref']))
	{
 		if($_GET['ref']=="1add")
		{echo "<div class='notifhijau'>Data berhasil ditambah!</div>";	}
		else if($_GET['ref']=="1edt")
		{echo "<div class='notifhijau'>Data berhasil diperbarui!</div>";	}
		else if($_GET['ref']=="1del")
		{echo "<div class='notifmerah'>Data berhasil dihapus!</div>";	}
		else
		{echo "<div class='notifmerah'>Perintah gagal dilaksanakan!</div>";	}
}
?>

<span id="bukukulist" ></span>
<div class='titlepage'><img src='stylesheets/images/buku.png' class='micon'/> Daftar Buku
</div>
<table>
	<tr>
    	<th width='30px'>#</th>
		<th width='300px' colspan="2">Buku</th>
     	<th width='100px'>Kategori</th>
     	<th width='100px'>Pengarang</th>
     	<th width='90px'>Penerbit</th>
      	<th width='120px'>Kondisi</th>
      	<th width='50px' colspan="3" style='text-align:center'>Aksi</th>
    </tr>
    <tr>
    <?php
	$x = 0;
	$pilihbuku = mysql_query("SELECT * FROM tbl_buku ORDER BY judul DESC ".$limit);
	while($buku= mysql_fetch_array($pilihbuku))
	{
		$qkategori = que("SELECT * FROM tbl_kategori WHERE kode='".$buku['kode_kategori']."';");
		$kategori	 = fetch($qkategori);
		$qpenerbit = que("SELECT * FROM tbl_penerbit WHERE kode='".$buku['kode_penerbit']."';");
		$penerbit	 = fetch($qpenerbit);
		$x++;
		if($buku['kondisi'] == 1)
			{	$kondisi = "<span style='color:green'>Baik</span>"; }
		else if($buku['kondisi'] == 2)
			{ $kondisi = "<span style='color:#F7B00B'>Rusak ringan</span>"; }
		else if($buku['kondisi'] == 3)
			{ $kondisi = "<span style='color:#F73A0B'>Rusak berat</span>"; }
		else if($buku['kondisi'] == 4)
			{ $kondisi = "<span style='color:red'>Rusak total/hilang</span>"; }
		echo "
		<tr id='buku".$buku['kode']."'>
			<td>".$x."</td>
			<td width='90px'><img src='files/images/buku/".$buku['foto']."' alt='".$buku['judul']."' style='width:90px;height:120px'>
			</td>
			<td>
			<b>".$buku['kode']."</b><br/>
			".$buku['judul']."<br/>
			<span style='font-size:10px'>".$buku['tahun_terbit']." | ".$buku['jumhal']." halaman</span>
			</td>
			<td>".$kategori['nama']."</td>
			<td>".$buku['pengarang']."</td>
 			<td>".$penerbit['nama']."</td>
 			<td>".$kondisi."</td>
  			<td class='actentry'><a href='javascript:hal(\"buku\",\"edit\",\"".$buku['kode']."\")' class='thijau' title='Edit!'><img src='stylesheets/images/edit.png' class='sicon'/></a></td>
  			<td class='actentry'><a href='javascript:del(\"buku\",\"".$buku['kode']."\",this)' onclick='return konfirm(\"menghapus buku ".$buku['judul']."\")' class='tmerah' title='Hapus!'><img src='stylesheets/images/drop.png' class='sicon'/></a></td>
			</tr>";
}
?>
    </tr>
</table>
</div>