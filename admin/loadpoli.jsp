<%@ include file ="connect.jsp" %>
<%
	String cari = request.getParameter("cari");
	if(cari != null)
	{
	String cek = "SELECT *, count(tb_poliklinik.kd_poli) as jum FROM tb_dokter, tb_poliklinik WHERE tb_dokter.kd_poli = tb_poliklinik.kd_poli AND tb_poliklinik.kd_poli ='"+cari+"'";
		st = con.createStatement();
		rs = st.executeQuery(cek);
        while(rs.next()){
				String nm_poli = rs.getString("nm_poli");
				String nm_dokter = rs.getString("nm_dokter");
				String foto = rs.getString("foto");
				String lantai = rs.getString("lantai");
				String jum = rs.getString("jum");
				if(jum.equals("1"))
				{
					out.println("<div class='detailpoli'><img src='files/dokter/"+foto+"'/></div>");
				}
				else{
					out.println("<span style='color:red'>Poliklinik tidak ditemukan !</span>");
				}
				
		}
        	
	}
	
%>
<!--out.println("<span style='color:green'>"+nm_pasien+"</span>");