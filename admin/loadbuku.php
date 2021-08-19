<?php
	include "configs/koneksi.php";
	include "configs/fungsi.php";
	$pilih = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$_GET['cari']."' OR judul like '%".$_GET['cari']."%' LIMIT 0,10;");
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
						<a href='javascript:addtocart(\"".$buku['kode']."\");' class='thijau addb'>+</a>
						<img src='files/images/buku/".$buku['foto']."' alt='".$buku['judul']."' id='buku".$buku['kode']."' title='".$buku['kode']."' class='bookimg'>
						<b>".$buku['judul']."</b><br/>
						<i style='text-align:left'>".$status."</i>
					</div>					
				";
			}
			else
			{
				echo "
					<div class='bookitem'>
						<img src='files/images/buku/".$buku['foto']."' alt='".$buku['judul']."' id='buku".$buku['kode']."' class='bookimg'>
						<b>".$buku['judul']."</b><br/>
						<i style='text-align:left'>".$status."</i>
					</div>					
				";
			}
    }
	}
?>