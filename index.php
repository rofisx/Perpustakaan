<?php
session_start();
require_once "admin/configs/koneksi.php";
require_once "admin/configs/fungsi.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Halaman Dasbor</title>
<link rel='stylesheet' href='admin/stylesheets/admin.css' type="text/css" />
<link rel='stylesheet' href='admin/stylesheets/metro.css' type="text/css" />
<link rel='stylesheet' href='admin/stylesheets/index.css' type="text/css" />
<link rel='stylesheet' href='admin/stylesheets/slider.css' type="text/css" />
<script type="text/javascript" src="admin/scripts/jquery.js"></script>
<script src="../Scripts/swfobject_modified.js" type="text/javascript"></script>
</head>
<body>
<div id='pagewrapper'>
<div id='nav'>
	<div class="left">
    <?php echo $web['web_nama'] ?>
  </div>
	<div class="right">
		<div class='metrosearch'>
    <form action='buku.php' method="get">
    	<img src="admin/stylesheets/images/searchb.png" />
    	<input type="text" name='ygdicari' placeholder='Pencarian...'>
    </form>
    </div>
  </div>
</div>
<div class='navmenu'>
<ul>
	<li><a href='index.php'>Home</a></li>
 	<li><a href='buku.php'>Buku </a></li>
  <li class='tanggal'>
    <?php echo hari(date("Y-m-d")).", ".tanggal(date("Y-m-d")) ?>      
  </li>
</ul>
</div>
<div class='content'>
	<div class='block-top'>
  	<div class='block-outer' style="width:600px;height:300px;float:left;margin-right:10px;">
   		<div class='block-title'></div>
        <div class= 'parent-slider'>
            <div class='isi-slider'>
                <img src="admin/files/slider/slide1.jpg" alt="Slide 1">
                <img src="admin/files/slider/slide2.jpg" alt="Slide 2">
                <img src="admin/files/slider/slide3.jpg" alt="Slide 3">
            </div>
  </div>
    </div>
   	<div  class='block-outer' style="width:410px;height:300px;float:left;">
   		<div class='block-title'>Keterlambatan Pengembalian</div>
  		<div class='block-inner' style='padding:10px;font-size:13px;background:#F5f5f5;height:300px;color:#000;'>
<?php
  $qpinjam = que("SELECT tbl_peminjaman.* FROM tbl_peminjaman,tbl_detail_peminjaman WHERE kode = kode_peminjaman AND status=1 AND tanggal_harus_kembali < '".date("Y-m-d")."' GROUP BY tbl_peminjaman.kode ORDER BY kode DESC LIMIT 0,5");
  while($pinjam  = fetch($qpinjam)){
	$qanggota = que("SELECT * FROM tbl_anggota WHERE kode='".$pinjam['kode_anggota']."';");
	$anggota	= fetch($qanggota);
	$lamapinjam		= floor((time() - strtotime($pinjam['tanggal_peminjaman']))/86400);
	$terlambat		= floor((time() - strtotime($pinjam['tanggal_harus_kembali']))/86400);
	if($terlambat > 0)
		{ 
      $denda = $terlambat * 500; 
      echo "
      <p style='background-color:#FF0000;'>
      ".$anggota['nama']." - Terlambat ".$terlambat." hari
      </p>";
    }
	else
		{ 
      $denda = 0; $terlambat = 0; 
      echo "
      <p>
      ".$anggota['nama']." - Terlambat ".$terlambat." hari
      </p>";
    }
	
	
}
?>
      </div>
    </div>
  </div>
</div>
<div class='block-outer' style="margin-top:5px;">
	<div class='block-title'>Katalog Buku</div>
  <div class='' style='height:130px;'>
  <!-- Menampilkan daftar buku -->
  <?php
    $pilihbuku = mysql_query("SELECt * FROM tbl_buku ORDER BY kode DESC");
    while($buku = mysql_fetch_array($pilihbuku))
      {
	       echo "<div class='lbuku'>
					<img src='admin/files/images/buku/".$buku['foto']."'/>
					<div class='ljudul'>".$buku['judul']."</div></div>";
      }
  ?>  
  </div>
</div>
</div>
</div>
<script type="text/javascript">
swfobject.registerObject("FlashID");
</script>
</body>
</html>