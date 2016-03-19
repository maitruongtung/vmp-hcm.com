<?php
	//session_start();
	//if(isset($_SESSION["taikhan"]))	$user	=	$_SESSION["taikhoan"];
	//if(isset($_SESSION["giohang"]))	$gh	=	$_SESSION["giohang"];
	
	//echo '<pre>';print_r($_SESSION);
	require_once("connect/connect.php");
	
?>
<script language="javascript" type="text/javascript">
// JavaScript Document
var xmlhttp;
function GetXmlHttpObject()
{
	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		return new XMLHttpRequest();
	}
	if (window.ActiveXObject)
	{
		// code for IE6, IE5
		return new ActiveXObject("Microsoft.XMLHTTP");
	}
	return null;
}
function showResult()
{
	if (xmlhttp.readyState==4 && xmlhttp.status == 200)
	{
		document.getElementById("iDivResult").innerHTML = xmlhttp.responseText;
	}
	
	
}
function timdidong()
{
	var didong = document.getElementById('idtbdidong').value;
	xmlhttp=GetXmlHttpObject();
	if (xmlhttp==null)
	{
		alert ("Your browser does not support XML HTTP Request");
		return;
	}
	xmlhttp.onreadystatechange = showResult;
	var url = "include/xltk.php";
	var params = "didong=" + didong;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.setRequestHeader("Content-length", params.length);
	xmlhttp.setRequestHeader("Connection", "close");
	xmlhttp.send(params);
	}

</script>

<div class="timkiem" align="right">
  
  <table width="1100" border="0" height="20" >
  <tr>
    
    <td width="750" align="center">
    <div id="iDivForm">

    <form name="nmTinhtoan">
    <table><tr>
      <td> <i style="color:#FF00FF; font-size:15px;">Nhập số điện thoại  &nbsp;</i></td>
      <td><input id="idtbdidong" type="text"  onkeyup="timdidong();" />
    <input type="button" name="submit" value="Search"  width="180px"/></td></tr></table>
    
    </form>
	</div>    
   
   
   </td>
   
  </tr>
</table>

</div>
