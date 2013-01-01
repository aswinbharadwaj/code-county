<html>
<head>

<title>
	Programming and Debugging
</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-1.8.0.min.js"></script>

<script type="text/javascript">
var xmlhttp,response,regex,single;

function hideMenu()
{
	netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserWrite");
	window.menubar.visible=false;
	window.directories.visible=false;
	window.statusbar.visible=false;
}


function disableRightClick()
{
<!--

//Disable right click script III- By Renigade (renigade@mediaone.net)
//For full source code, visit http://www.dynamicdrive.com
var message="";
var okay = false;
///////////////////////////////////
function clickIE() 
{
	if (document.all) 
	{
		(message);
		return false;
	}
}
function clickNS(e) {
	if (document.layers||(document.getElementById&&!document.all)) {

	if (e.which==2||e.which==3) {(message);return false;}
	}
}

if (document.layers) 
{		
	document.captureEvents(Event.MOUSEDOWN);
	document.onmousedown=clickNS;
}
else
{
	document.onmouseup=clickNS;
	document.oncontextmenu=clickIE;
}

document.oncontextmenu=new Function("return false")
// --> 

}

function disableF5(e) 
{ 
	if (e.which == 116) e.preventDefault();
	else if(e.which == 82)
	{
		if (e.ctrlKey) 
		{ 
                e.returnValue = false; 
                e.keyCode = 0;  
                return false;
		} 
	}
}


// Named callback function from the ajax call when jsonpbtn2 clicked

var formobjout;
var res;
$(document).ready(function(){$('#login').click(function(){
			var surl =  "http://admin.paradigm2k12.com/keyValidity.php";
		var p1 = document.getElementById("pr1").value;
		var p2 = document.getElementById("pr2").value;
		var formobj = document.getElementById("loginform");
		formobjout=formobj;
			res = validate(formobj);
			if(res && single != 1)
			{
				$.ajax({
				url: surl,
				data: {part:"2",part1:p1,part2:p2,password:"KILLTHEBUGS"},
				dataType: "jsonp",
				jsonp : "callback",
				jsonpCallback: "jsonpcallback2"
				});
				
			}
			else if(res && single == 1)
			{
				$.ajax({
				url: surl,
				data: {part:"1",part1:p1,password:"KILLTHEBUGS"},
				dataType: "jsonp",
				jsonp : "callback",
				jsonpCallback: "jsonpcallback1"
				});
				
			}
		});});



// To disable f5
$(document).bind("keydown", disableF5);
	// To re-enable f5
//$(document).unbind("keydown", disableF5);
//var sid = "<?php echo session_id(); ?>";
//alert(sid);

//keyValidity.php part part1 part2 password

function validate(form)
{

		single = 0;
		regex = new RegExp("^PR[0-9]{4}");

		
		if(form.p1.value == "" && form.p2.value == "")
		{
			alert('Both the ids should not be left empty');
			return false;
		}

		if(form.p1.value != ""  && form.p2.value == "")
		{
			single = 1;
		}
		else if(form.p1.value == ""  && form.p2.value != "")
		{
			alert('Single participants enter id into partcipant 1 textbox');
			return false;
		}

		if(single != 1)
		{
		if(!regex.test(form.p1.value) && !regex.test(form.p2.value))
		{
			alert('Both PR ids are invalid');return false;
		}	
		else if(!regex.test(form.p1.value))
		{
			alert('PR id of participant 1 is invalid');return false;
		}
		else if(!regex.test(form.p2.value))
		{
			alert('PR id of participant 2 is invalid');return false;
		}
			

		if(form.p1.value == form.p2.value)
		{
			alert('Both PR ids can\'t be same!');
			return false;
		}
		}
		else
		{
		if(!regex.test(form.p1.value))
		{
			alert('PR id of participant is invalid');return false;
		}
		}
		/*
		xmlhttp = new XMLHttpRequest();
		xmlhttp.open("GET","validatePRid.php?pr1="+form.p1.value+"&pr2="+form.p2.value,false);
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.status=400 && xmlhttp.readyState==4)
				response = xmlhttp.responseText;
		}
		xmlhttp.send();

		*/
		/*
		if(response == 'true')
		{
		
		 var surl =  "http://admin.paradigm2k12.com/keyValidity.php";
		 if(single != 1)
		 {
		 	$('#login').click($.ajax({
			url: surl,
			data: {part:"2",part1:form.p1.value,part2:form.p2.value,password:"KILLTHEBUGS"},
			dataType: "jsonp",
			jsonp : "callback",
			jsonpCallback: "jsonpcallback2"
			});)
		 }
		 else
		 {
		 	$.ajax({
			url: surl,
			data: {part:"1",part1:form.p1.value,password:"KILLTHEBUGS"},
			dataType: "jsonp",
			jsonp : "callback",
			jsonpCallback: "jsonpcallback1"
			});
		 }
		 
		 return true;
		}
		else
		{
			alert(response);
			return false;
		}
		*/
		return true;
}

function jsonpcallback2(rtndata) { 

	// Get the id from the returned JSON string and use it to reference the target jQuery object.
	//alert(rtndata.allow);
	if(rtndata.allow == 'true')
		formobjout.submit();
	else if(rtndata.allow == 'false')
		alert('You have already participated ! ');
}

function jsonpcallback1(rtndata) { 

	// Get the id from the returned JSON string and use it to reference the target jQuery object.
	//alert(rtndata.allow);
	if(rtndata.allow == 'true')
		formobjout.submit();
	else if(rtndata.allow == 'false')
		alert('You have already participated ! ');	
}

</script>

<style>

</style>


</head>

<body onload="disableRightClick();">
<div id="total_area">
<!--
<div id="access_pane">
<ol class="rounded">
	<li>Home</li>
	<li>Rules</li>
</ol>

<table id="navi_table" style="visibility:hidden;">
<tr><td>1</td><td>2</td><td>3</td><td>4</td><td>5</td></tr>
<tr><td>6</td><td>7</td><td>8</td><td>9</td><td>10</td></tr>
<tr><td>11</td><td>12</td><td>13</td><td>14</td><td>15</td></tr>
<tr class="bonus"><td>16</td><td>17</td><td>18</td><td>19</td><td>20</td></tr>
</table>

<button id="logout" class="button" >Log out</button>
</div>
-->
<div id="mainpage">

<div id="logo">
<img src="images/logo.png" alt="logo"/>
</div>

<div id="topic">
	<span><h1> Code County </h1></span>
</div>

<div id="sub_topic">
	<span><h3>Welcome to Programming and Debugging</h3></span>
</div>
_
<div id="disp_area">

<form name='log' action="home.php" id='loginform' method="POST">
<div style="margin-left:35%;margin-top:5%;font-size:18px"> Participant 1: <input name="p1" id="pr1" style="height:40px;font-size:16px" type="text"/></div>
<div style="margin-left:35%;margin-top:5%;font-size:18px"> Participant 2: <input name="p2" id="pr2" style="height:40px;font-size:16px" type="text"/></div>
<input type="button" id="login" name="login" value="Log in"></input>
</form>



</div>


</div>

</div>


</body>
</html>