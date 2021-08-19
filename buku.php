<?php
	include "admin/configs/koneksi.php";
	include "admin/configs/fungsi.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Halaman Dasbor</title>
<link rel='stylesheet' href='admin/stylesheets/admin.css' type="text/css" />
<link rel='stylesheet' href='admin/stylesheets/metro.css' type="text/css" />
<link rel='stylesheet' href='admin/stylesheets/index.css' type="text/css" />
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
	<li><a href='index.php'>home</a></li>
 	<li><a href='buku.php'>buku </a></li>
  <li class='tanggal'><?php echo hari(date("Y-m-d")).", ".tanggal(date("Y-m-d")) ?></li>
</ul>
</div>
<div class='content'>
<?php
	if(!isset($_GET['ygdicari']))
	{
		$pilih = mysql_query("SELECT * FROM tbl_buku LIMIT 0,10;");
	}
	else
	{
		$pilih = mysql_query("SELECT * FROM tbl_buku WHERE judul like '%".$_GET['ygdicari']."%' LIMIT 0,10;");
	}
	if(mysql_num_rows($pilih)==0)
	{
		echo "<span style='color:red'>Buku tidak diketemukan!</span>";
	}
	else
	{
		while($buku= mysql_fetch_array($pilih))
    {
			$cekdetail1 = que("SELECT * FROM tbl_detail_peminjaman WHERE kode_buku='".$buku['kode']."';");
			if(num($cekdetail1)>0)
			{
				$cekdetail2 = que("SELECT * FROM tbl_detail_peminjaman WHERE kode_buku='".$buku['kode']."' AND status = 1");
				if(num($cekdetail2)>0)
				{
					$status = "<span style='color:red'>Buku telah dipinjam</span>";
					$astatus= false;
				}
				else
				{
					$status = "<span style='color:green'>Buku tersedia</span>";
					$astatus= true;
				}
			}
			else
			{
				$status = "<span style='color:green'>Buku tersedia</span>";
				$astatus= true;
			}
			
			if($buku['kondisi']>2)
			{
					$status = "<span style='color:red'>Buku masih rusak</span>";
					$astatus= false;
			}
			
			if($astatus)
			{
				echo "
					<div class='bookitem'>
						<img src='admin/files/images/buku/".$buku['foto']."' alt='".$buku['judul']."' id='buku".$buku['kode']."' title='".$buku['kode']."' class='bookimg'>
						<b>".$buku['judul']."</b><br/>
						<i style='text-align:left'>".$status."</i>
					</div>					
				";
			}
			else
			{
				echo "
					<div class='bookitem'>
						<img src='admin/files/images/buku/".$buku['foto']."' alt='".$buku['judul']."' id='buku".$buku['kode']."' class='bookimg'>
						<b>".$buku['judul']."</b><br/>
						<i style='text-align:left'>".$status."</i>
					</div>					
				";
			}
    }
	}
?>
</div>
</div>
</body>
</html>