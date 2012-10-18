<%@ Page Language="C#" Debug="true" %>
<html>
<head>
<title>Hello World!</title>
</head>
<body>
<form action="dummy.aspx" runat=server >
<asp:TextBox id="sentence" maxlength=100 width=200px  Text="hmmm" runat=server />
<br>
<input runat="server" type=submit value="Submit" ID="submit" NAME="submit"><br>
   <% if (Request.Form["submit"] != null) 
   {
   	%>
   	What the hell.... It came in...
   	<%
      for (int i=0; i <6; i++) { %>
      <font size="<%=i%>"> <%=Request.Form["sentence"]%></font> <br>
      <% }
   }
   else
   {%>
   Hell Only... Says Else!
   <%
   }
   
   %>
</form>

   <% for (int i=0; i <6; i++) 
   { %>
      <font size="<%=i%>"> I don't want the world, I just want your half </font> <br>
   <% }
   Response.Write("<p><cite>They Might Be Giants - Ana Ng</cite>");
%>
</body>
</html>