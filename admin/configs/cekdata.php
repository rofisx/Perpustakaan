<?php
require_once "connection.php";
require_once "functions.php";
if($_GET['tipe']=="anggota")
{
	$pilih = mysql_query("SELECT * FROM tbl_anggota WHERE kode='".$_GET['nilai']."';");
	if(mysql_num_rows($pilih)==0)
	{
		echo "0|<span style='color:red'>Tidak ada anggota dengan kode tersebut!</span>";
	}
	else
	{
		$result= mysql_fetch_array($pilih);
		echo "1|<span style='color:green'>".$result['nama']."</span>";
	}
}
else if($_GET['tipe']=="buku")
{
	$pilih = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$_GET['nilai']."';");
	if(mysql_num_rows($pilih)==0)
	{
		echo "0|<span style='color:red'>Tidak ada buku dengan kode tersebut!</span>";
	}
	else
	{
		$result= mysql_fetch_array($pilih);
		echo "1|<span style='color:green'>".$result['judul']."</span>";
	}
}
else if($_GET['tipe']=="pengembalian")
{
	$pilih = mysql_query("SELECT * FROM tbl_peminjaman,tbl_detail_peminjaman WHERE kode=kode_peminjaman AND kode='".$_GET['nilai']."';");
  if(mysql_num_rows($pilih)==0)
	{
		echo "0|<span style='color:red'>No Peminjaman Tidak Ditemukan!</span>";
	}
  else
  {
  	$result= mysql_fetch_array($pilih);
    $pilihanggota = mysql_query("SELECT * FROM tbl_anggota WHERE kode='".$result['kode_anggota']."';");
    $anggota			= mysql_fetch_array($pilihanggota);
    $pilihbuku	  = mysql_query("SELECT * FROM tbl_buku WHERE kode='".$result['kode_buku']."';");
    $buku					= mysql_fetch_array($pilihbuku);
    if($result['status']==0)
    {
      echo "1|
      <table>
        <tr>
          <th colspan='3'>Anggota</th>
        </tr>
        <tr>
          <td>Kode</td>
          <td>:</td>
          <td>".$anggota['kode']."</td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>".$anggota['nama']."</td>
        </tr>
        <tr>
          <th colspan='3'>Buku</th>
        </tr>
        <tr>
          <td>Kode</td>
          <td>:</td>
          <td>".$buku['kode']."</td>
        </tr>
        <tr>
          <td>Buku</td>
          <td>:</td>
          <td>".$buku['judul']."</td>
        </tr>
         <tr>
          <th colspan='3'>Status</th>
        </tr>
        <tr>
          <td colspan='3'>Buku telah dikembalikan pada ".tanggal($result['tanggal_kembali'])."</td>
        </tr>
      </table>";
    }
    else
    {
      $lamapinjam		= floor((strtotime(date("Y-m-d")) - strtotime($result['tanggal_peminjaman']))/86400);
      $terlambat		= floor((strtotime(date("Y-m-d")) - strtotime($result['tanggal_harus_kembali']))/86400);
      if($terlambat > 0)
        { $denda = $terlambat * 500; }
      else
        { $denda = 0; $terlambat = 0; }
      echo "1|
      <table>
        <tr>
          <th colspan='3'>Peminjam</th>
        </tr>
        <tr>
          <td>Kode</td>
          <td>:</td>
          <td>".$anggota['kode']."</td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td>".$anggota['nama']."</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td>:</td>
          <td>".$anggota['alamat']."</td>
        </tr>
        <tr>
          <th colspan='3'>Buku</th>
        </tr>
        <tr>
          <td>Kode</td>
          <td>:</td>
          <td>".$buku['kode']."</td>
        </tr>
        <tr>
          <td>Buku</td>
          <td>:</td>
          <td>".$buku['judul']."</td>
        </tr>
        <tr>
          <th colspan='3'>Peminjaman</th>
        </tr>
        <tr>
          <td>No</td>
          <td>:</td>
          <td>".$peminjaman['kode']."</td>
        </tr>
        <tr>
          <td>Tanggal Peminjaman</td>
          <td>:</td>
          <td>".hari($result['tanggal_peminjaman']).", ".tanggal($result['tanggal_peminjaman'])."</td>
        </tr>
        <tr>
          <td>Tanggal Harus Kembali</td>
          <td>:</td>
          <td>".hari($result['tanggal_harus_kembali']).", ".tanggal($result['tanggal_harus_kembali'])."</td>
        </tr>
        <tr>
          <td>Tanggal Kembali</td>
          <td>:</td>
          <td>".hari(date("Y-m-d")).", ".tanggal(date("Y-m-d"))."</td>
        </tr>
        <tr>
          <td>Lama Peminjaman</td>
          <td>:</td>
          <td>".$lamapinjam." hari</td>
        </tr>
        <tr>
          <td>Terlambat</td>
          <td>:</td>
          <td>".$terlambat." hari</td>
        </tr>
        <tr>
          <td>Denda</td>
          <td>:</td>
          <td>Rp. ".$denda.",-<input type='hidden' name='denda' value='".$denda."' form='pengembalian'/></td>
        </tr>
      </table>
      <input type='submit' name='kirim' value='Kembalikan Buku' class='thijau' form='pengembalian'/> 
      ";
    }
  }	
}
?>