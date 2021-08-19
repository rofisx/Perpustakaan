// JavaScript Document

function hid(oby){
	$(oby).parent().fadeOut();
}


function konfirm(r)
{
	klarifikasi = confirm("Anda yakin " + r + "?");
	if(klarifikasi == true)
		{	return true; }
	else
		{	return false; }
}