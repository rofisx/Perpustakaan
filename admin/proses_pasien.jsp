<%@ include file ="connect.jsp" %>
<%
String formpasien = request.getParameter("pasien"):
if(formpasien != null)
{
	String nama  = request.getParameter("txtnama");
	String gender  = request.getParameter("gender");
	String agama  = request.getParameter("txtagama");
	
	String tgl  = request.getParameter("txttg");
	String alamat  = request.getParameter("txtalamat");
	String usia  = request.getParameter("txtusia");
	String pengantar  = request.getParameter("txtpengantar ");
	String tlp  = request.getParameter("txttlp");
	String kk  = request.getParameter("txtkk");
	String hub  = request.getParameter("txthub");
	
	String kueri = "INSERT INTO tb_pasien (nm_pasien,j_kel,agama,alamat,tgl_lhr,usia,no_tlp,pengantar,nm_kk,hub_kel)VALUES ('',"+nama+"','"+gender+"','"+agama+"','"+alamat+"','"+tgl+"','"+usia+"','"+tlp+"','"+pengantar+"','"+kk+"','"+hub+"')";
	
	
	st = con.createStatement(); 
	int isiTabel = st.executeUpdate(kueri);
	if(isiTabel == 1){
		out.println("<script>alert('data tersimpan'); location.href='dasbord.jsp?p=pasien&ref=1add'</script>");} else { }
}
%>