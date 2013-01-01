
<?php
    session_start();
	session_destroy();
	//var_dump($_SESSION['sec']);
	if(count($_SESSION) != 0)
	{
		$_SESSION=array();
		session_destroy();
	}
	//var_dump($_SESSION['sec']);
	
    session_start();
    if($_POST['p2'] == '' || is_null($_POST['p2']) )
		$_SESSION['nop'] = "1";
	else
		$_SESSION['nop'] = "2";
    $_SESSION['p1'] = $_POST['p1'];$_SESSION['p2'] = $_POST['p2'];$_SESSION['teamname'] =  str_replace('.','',uniqid('PR',true));$_SESSION['score'] = 0;$_SESSION['answers'] = "";$_SESSION['bonus']=0;$_SESSION['bonustaken']=0;$_SESSION['questions']="";$_SESSION['ans']="";$_SESSION['sec'] = 20*60;$_SESSION['min'] = 20;
?>
<html>
<head>

<title>
	Programming and Debugging
</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-1.8.0.min.js"></script>

<script type="text/javascript">

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
	// To disable f5
$(document).bind("keydown", disableF5);
	// To re-enable f5
//$(document).unbind("keydown", disableF5);
var sid = "<?php echo session_id(); ?>";
//alert(sid);

function startTimer()
{
	window.location.replace('qna.php');
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
	<li>Rules</li>
	<li style="visibility:hidden;">&nbsp;</li>
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

<p style="margin-top:1%;"><b>1.</b> This preliminary round of Programming and Debugging.</p>
<p><b>2.</b> There are <b>20</b> questions in total <b>15</b> normal <b>5</b> bonus questions.</p>
<p><b>3.</b> 15 Normal questions will carry <b>4</b> marks each if answered correctly and <b>-1</b> if answered wrong.</p>
<p><b>4.</b> 5 Bonus questions will carry <b>4</b> marks each if answered correctly and no negative marks if answered wrong.</p>
<p><b>5. You can't take the bonus questions unless you attend all the 15 normal questions !</b></p>
<p><b>6.</b> Your team score will be intimated as soon as you submit your answers.</br>&nbsp;&nbsp;&nbsp;&nbsp;You can aslo see your scores on the BIG SCREEN.</p>
<p><b>7.</b> Qualifying teams will be intimated through call and will be put up on the board.</p>
<p><b>8.</b> Organizers decision final and binding.</p>

<button class="button" onclick="startTimer()">Start Test</button>

</div>


</div>

</div>


</body>
</html>