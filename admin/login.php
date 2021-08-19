<?php
session_start();
require "configs/koneksi.php";
require "configs/fungsi.php";
?>
<!DOCTYPE html>
<html>
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
 <title>Halaman Login</title>
 <link rel="shortcut icon" href="stylesheets/images/<?php echo $web['web_logo']; ?>"/>
 <link rel="stylesheet" type="text/css" href="stylesheets/metro.css">
 <script type="text/javascript" src="scripts/functions.js"></script>
 <script type="text/javascript" src="scripts/jquery.js"></script>
 <script type="text/javascript" src="scripts/main.js"></script>
 <script type="text/javascript">
$(document).ready(function(){	
	//Login Aksi
	$("#login").submit(function(event){
		
		event.preventDefault();
		
		$("#tbllogin").val("Connecting..");
		$("#login input").prop("disabled","disabled");
		
		if($("#pakecookie").prop("checked")==true)
			{	pcookie = "pake"; }
		else
			{ pcookie = "gak";	}
		
		$.post("login.proses.php",
		{
			kode : $("[name='kode']").val(),
			password : $("[name='password']").val(),
			type : "petugas",
			pakecookie : pcookie
		}
		,function (result,status) {
			if(status)
			{
				$("#tbllogin").val("Mencoba login..");
				if(result == 1)
				{
					$("#tbllogin").val("Memuat halaman..");
					$("#rightbox").fadeOut(500);
					$("#leftbox").css("position","relative");
					$("#leftbox").delay(500).animate({left:"-1500px"},"slow");
					self.location = "dasbor.html";
				}
				else
				{
					$("#login input").removeAttr("disabled");
					$("#tbllogin").val("Login");
					$(".notifmerah,.notifhijau,.notifkuning").remove();
					$("#login").before("<div class='notifmerah'>Kode akses atau password tidak cocok <span class='notifclose' onclick='hid(this)'>x</span></div>");
					$("#tbllogin").focus();
				}
			}
		});
	});
});
 </script>
 <style type='text/css'>
#pagewrapper {
	width:950px;
	margin:0 auto;
	padding:50px 0;
}

#rightbox {
	/*width:450px;*/
	/*margin : auto ;
	max-width:60%;
	min-height:500px;
	background:url(stylesheets/images/l1image.jpg) no-repeat;*/
}

#leftbox {
	margin : auto;
	/*float:right;*/
	padding: auto;
	width:300px;
	/*margin-left:50px;
	text-align:left;*/
	max-width:35%;
}
#logo{
	max-width: 60%;
	margin : 10px 0px 25px 0px;
}


 </style>
</head>
<body>
<div id='pagewrapper'>
  <div id='leftbox'>
  <img src="stylesheets/images/logoburung.png" id="logo"><br/>
  <!-- <img src="stylesheets/images/<?php echo $web['web_logo']; ?>" style="width:auto;height:50px;margin-right:20px;vertical-align:middle"/> -->
  <span class='f1'>Login Petugas</span>
  <br/>
  <br/>
  <?php
  if(isset($_GET['ref'])) 
  {
		if($_GET['ref']=='out')
    {
      echo "<div class='notifhijau'>Anda telah logout <span class='notifclose' onclick='hid(this)'>x</span></div>";
    }
    else if($_GET['ref']=='dir')
    {
      echo "<div class='notifkuning'>Anda harus login dahulu! <span class='notifclose' onclick='hid(this)'>x</span></div>";
    }
  }
  
  ?>
<form action="#" method="post" id='login'>
  <input type='text' name='kode' class='iputih' maxlength='32' placeholder='Username' style='width:280px;' required/><br/>
  <input type='password' name='password' class='iputih' maxlength='32' style='width:280px;' placeholder='Password' required/><br/>
  <label class="cbox"><input type="checkbox" name="pakecookie" id='pakecookie'/><span></span></label>
  <label for="pakecookie">Biarkan saya tetap login</label><br/>
  <br/>
  <input type="submit" name='login' class='thijau' value='Login' id='tbllogin' onclick='login();return false;'/ style="background-color:#0292DB "><br/>
</form>
  <br/>
  <br/>
  <br/>
  <div class="flogin" style='color:#999;padding-top:10px;border-top:1px solid #999;width:300px;'>
  	<?php echo $web['web_nama']; ?> | <?php echo date("Y"); ?>
  </div>
  </div>
   <div id='rightbox'></div>
</div>
</body>
</html>