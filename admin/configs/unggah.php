<?php
function unggah_foto($varimg,$idimg,$folder)
{
	global $filebaru;
	global $filetipe;
	global $filestatus;
	$list = array("image/gif","image/jpeg","image/pjpeg","image/png");
	if (in_array($_FILES[$varimg]['type'],$list)) 
	{
		$filetipe = $_FILES[$varimg]['type'];
  		if ($_FILES[$varimg]['error'] > 0)
  		{
        die("
          <script type='text/javascript'>
          alert('File yang anda unggah telah rusak! Silakan coba kembali di menu edit!');
          </script>
          ");
        $filestatus = false;
  		}
  		else
  		{
        $filebaru	= $folder.$idimg."-".basename($_FILES[$varimg]['name']);
        $pindah   = move_uploaded_file($_FILES[$varimg]['tmp_name'],$filebaru);
        $filestatus = true;
      }
	}
	else
	{
		die("
			<script type='text/javascript'>
        alert('Foto yang anda unggah tidak dikenal system! Silakan unggah gambar lain pada menu edit!');
			</script>
			");
			$filestatus = false;
	}
}
?>