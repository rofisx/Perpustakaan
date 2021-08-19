function showpop()
{
	if($(".menupop").css("display") == 'none')
	{
		$(".caret").prop("src","stylesheets/images/caretup.png");
	}
	else
	{
		$(".caret").prop("src","stylesheets/images/caretdown.png");
	}
  $(".menupop").slideToggle("fast");
}


function hal(key,act,id,ref,page)
{
	if(arguments.length == 5)
		{	page = key+".php?page="+page; }
	else if(arguments.length == 4)
		{	page = key+".php?ref="+ref; }
	else if(arguments.length == 3)
		{	page = key+"."+act+".php?kode="+id; }
	else if(arguments.length == 2)
		{	page = key+"."+act+".php"; }
	else
		{	page = key+".php"; }
		
	$("#content").html("<img src='stylesheets/images/loading.png' style='width:40px;margin:200px 500px;'>");
	$.ajax({
		url: page,
		success:function(result,status){
			$("#content").html(result);
			$(".scontainer").fadeIn(250).animate({padding:'0'},{queue:false,duration:250});
		}
	});
}

function del(key,id) {
		$.ajax({
		url: key+".hapus.php?kode="+id,
		success:function(result,status){
			if(result==1)
			{
				$(".notifmerah,.notifhijau,.notifkuning").remove();
				$(".datatable").before("<div class='notifkuning'>1 "+key+" telah dihapus. <span class='notifclose' onclick='hid(this)'>x</span></div>");
				$("#"+key+id).fadeOut(2000);
			}
			else
			{
				alert(result);
			}
		}
	});	
}

function renew(key,id) {
		$.ajax({
		url: key+".renew.php?kode="+id,
		success:function(result,status){
			if(result==1)
			{
				$(".notifmerah,.notifhijau,.notifkuning").remove();
				alert("Masa aktif anggota telah diperpanjang!");
				hal("anggota",0,0,"renew");
			}
			else
			{
				alert(result);
			}
		}
	});	
}

function loaduser(ygdicari){
	$("#lblpeminjam").html("<img src='stylesheets/images/loading.png' class='sicon'/>");
	$.ajax({
		url: "loaduser.php?cari="+ygdicari,
		success:function(result,status){
			var hasil = result.split("|");
			$("#lblpeminjam").html(hasil[2]);
			$("#maxpinjam").html(hasil[1]);
			if(parseInt(hasil[0]) == 1)
			{
				$("#kotakbuku").removeProp("disabled");
			}
			else
			{
				$("#kotakbuku").prop("disabled","disabled")
			}
		}
	});	
}






function loadbuku(ygdicari){
	$("#lblbuku").html("<img src='stylesheets/images/loading.png' class='sicon'/>");
	$.ajax({
		url: "loadbuku.php?cari="+ygdicari,
		success:function(result,status){
			$("#lblbuku").html("");
			$("#booklist").hide();
			$("#booklist").css("padding-left","20px");
			$("#booklist").html(result);
			$("#booklist").fadeIn(500).animate({padding:'0'},{queue:false,duration:500});
		}
	});	
}


function loadbookku(ygdicari){
	$("#lblbuku").html("<img src='stylesheets/images/loading.png' class='sicon'/>");
	$.ajax({
		url: "loadbookku.php?cari="+ygdicari,
		success:function(result,status){
				hasil = result.split("|#");	

				if(parseInt(hasil[0]) == 0)
			{
				$("#lblbuku").html(hasil[1]);	
			}else{
				$("#lblbuku").html("");
				$("#bukukulist").hide();
				$("#bukukulist").html(hasil);
				$("#bukukulist").fadeIn(500).animate({padding:'0'},{queue:false,duration:500});
			}
		}
	});	
}



function loadpinjam(ygdicari){
	$("#lblpinjam").html("<img src='stylesheets/images/loading.png' class='sicon'/>");
	$.ajax({
		url: "loadpinjam.php?cari="+ygdicari,
		success:function(result,status){
			
			hasil = result.split("|#");
			
			if(parseInt(hasil[0]) == 0)
			{
				$("#lblpinjam").html(hasil[1]);
			}
			else
			{
				$("#lblpinjam").html("");
				$("#pinjamlist").hide();
				$("#pinjamlist").html(hasil);
				$("#pinjamlist").slideDown(500);
			}
		}
	});	
}

function loadanggota(ygdicari){
	$("#lblpinjam").html("<img src='stylesheets/images/loading.png' class='sicon'/>");
	$.ajax({
		url: "loadanggota.php?cari="+ygdicari,
		success:function(result,status){
			
			hasil = result.split("|#");
			
			if(parseInt(hasil[0]) == 0)
			{
				$("#lblpinjam").html(hasil[1]);
			}
			else
			{
				$("#lblpinjam").html("");
				$("#anggotalist").hide();
				$("#anggotalist").html(hasil);
				$("#anggotalist").slideDown(500);
			}
		}
	});	
}


var t;    

function keyDownBuku(ygdicari)
{
  if ( t )
  {
    clearTimeout( t );
    t = setTimeout( "loadbuku('"+ygdicari+"')", 250 );
  }
  else
  {
    t = setTimeout( "loadbuku('"+ygdicari+"')", 250 );
  }
}

function addtocart(x)
{
	if($("#cbuku"+x).length == 0)
	{
		if(parseInt($("#maxpinjam").html()) > 0 )
		{
			isi = "<img src='"+$("#buku"+x).prop("src")+"' id='cbuku"+x+"' title='"+x+"'>";
			$("#cartbox").append(isi);
			$("#maxpinjam").html(parseInt($("#maxpinjam").html())-1);
		}
		else
		{
			alert("Kuota peminjaman anggota ini telah habis!");
		}
	}
	else
	{
		alert("Buku sudah ada di daftar!");
	}
}

function clearpinjam()
{
	jumlah = parseInt($("#maxpinjam").html()) + $("#cartbox img").length;
	$("#maxpinjam").html(jumlah);
	$("#cartbox").html("");
}

function pinjam()
{
	if($("#cartbox img").length > 0)
	{
		user 		= $("#kotakpeminjam").val();
		jumlah 	= $("#cartbox img").length;
		data   = "";
		$("#cartbox img").each(function(){
			data = data + "|"+ $(this).attr("title");
		});
		
		$.ajax({
			url: "peminjaman.tambah.php?peminjam="+user+"&data="+data,
			success:function(result,status){
				hal("listpeminjaman",0,0,"pinjam");
			}
		});	
	}
}

function pengembalian(kode)
{	
	$.ajax({
		url: "pengembalian.proses.php?kode="+kode,
		success:function(result,status){
			hal("listpeminjaman",0,0,"kembali");
		}
	});	
}

function konfirm(r)
{
	klarifikasi = confirm("Anda yakin " + r + "?");
	if(klarifikasi == true)
		{	return true; }
	else
		{	return false; }
}