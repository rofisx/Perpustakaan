<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
require "configs/ceklogin.php";
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Halaman Dasbor</title>
<link rel="shortcut icon" href="stylesheets/images/<?php echo $web['web_logo']; ?>" />
<link rel='stylesheet' href='stylesheets/metro.css' type="text/css" />
<link rel='stylesheet' href='stylesheets/admin.css' type="text/css" />
<link rel='stylesheet' href='stylesheets/index.css' type="text/css" />
<script type="text/javascript" src="scripts/jquery.js"></script>
<script type="text/javascript" src="scripts/main.js"></script>
<script type="text/javascript" src="scripts/services.js"></script>
<style type="text/css">
#nav {
	background:<?php echo $web['web_color'] ?>;
}

#side ul li:first-child,.menupop ul li a:hover,#side ul li a:hover,table tr th {
	color:<?php echo $web['web_color'] ?>;
}

.menupop {
	border-left:2px solid <?php echo $web['web_color'] ?>;
	border-bottom:2px solid <?php echo $web['web_color'] ?>;
}
</style>
</head>
<body>
<div id='pagewrapper'>
<div id='nav'>
	<div class="left">
    <?php echo $web['web_nama'] ?> Information System
  	</div>
	<div class="right">
		<div class='akunthumb' onclick='showpop()'>
    	<img src='stylesheets/images/user.png'/><?php echo $user['nama'] ?><img class='caret' src='stylesheets/images/caretdown.png'/>
    </div>
<div class='menupop'>
<ul>
	<?php if($user['spengaturan']==1) 
	{
		?>
    <li>
    	<img src='stylesheets/images/pengaturan.png' /> <a href='javascript:hal("pengaturan");'> Pengaturan</a>
    </li>
<?php
	}
?>
    <li>
    	<img src='stylesheets/images/exit.png' /> <a href='logout.php'>Keluar</a>
    </li>
</ul>
</div>
</div>
</div>
<div id='main'>
<div id='side'>
	<div style='text-align:center'>
   	<img src='stylesheets/images/<?php echo $web['web_logo'] ?>' style='width:100px;height:100px;margin:20px 0;text-align:center;'/>
  	</div>
<ul>
	<li></li>
    <li>
    	<img src='stylesheets/images/dasbor.png' /> <a onclick='hal("awal")'>Dashboard</a>
    </li>
</ul>

<?php
	if($user['speminjaman']==1 OR $user['spengembalian']== 1) 
	{	 
	echo "
	<ul>
		<li><a href='javascript:hal(\"listpeminjaman\")'>Arus Buku</a>
		</li>";
		
		if($user['speminjaman']==1)
			{ echo "<li><img src='stylesheets/images/pinjam.png' /> <a onclick='hal(\"peminjaman\")'>Peminjaman</a></li>"; }
	
		if($user['speminjaman']==1)
			{ echo "<li><img src='stylesheets/images/kembali.png' /> <a onclick='hal(\"pengembalian\")'>Pengembalian</a></li>"; }
		if($user['speminjaman']==1)
			{ echo "<li><img src='stylesheets/images/purchase_order.png' /> <a onclick='hal(\"listpeminjaman\")'>List Peminjam</a></li>"; }
	echo "</ul>";
	}
	
if($user['sanggota']==1 OR $user['spetugas']== 1) 
	{
		echo "
		<ul>
		<li>Pengguna</li>";
			
			if($user['sanggota'])
				{ echo "<li>
						<img src='stylesheets/images/anggota.png' /> <a onclick='hal(\"anggota\")'>Daftar Anggota</a>
						</li>"; }
			
			if($user['spetugas'])
				{ echo "<li>
						<img src='stylesheets/images/petugas.png' /> <a onclick='hal(\"petugas\")'>Daftar Petugas</a>
						</li>"; }
	
				echo "</ul>";
	}

if($user['sbuku']==1 OR $user['skategori']== 1 OR $user['spenerbit']== 1) 
	{
	echo "
	<ul>
		<li>Data Buku</li>";
		
		if($user['sbuku'])
			{ echo "<li>
					<img src='stylesheets/images/buku.png' /> <a onclick='hal(\"buku\")'>Data Buku</a>
					</li>"; }

		if($user['skategori'])
			{ echo "<li>
					<img src='stylesheets/images/kategori.png' /> <a onclick='hal(\"kategori\")'>Data Kategori</a>
					</li>"; }
 	  
		if($user['spenerbit'])
			{ echo "<li>
					<img src='stylesheets/images/penerbit.png' /> <a onclick='hal(\"penerbit\")'>Data Penerbit</a>
					</li>"; }
	
			echo "
	</ul>";
	}
?>
</div>
<div id='content'>
	<script>
	hal("awal");
	</script>
</div>
</div>
</div>
</body>
</html>
<?php
if(isset($_GET['p']))
{
	if(isset($_GET['ref']))
	{
		echo "<script>hal('".$_GET['p']."',false,false,'".$_GET['ref']."');</script>";		
	}
	else
	{
		echo "<script>hal('".$_GET['p']."');</script>";
	}
}
?>