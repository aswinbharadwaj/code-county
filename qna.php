<html>
<head>

<title>
	Programming and Debugging
</title>

<link rel="stylesheet" type="text/css" href="style.css">
<script src="jquery-1.8.0.min.js"></script>
<script src="jquery-ui-1.8.22.custom.min.js"></script>
<script src="facebook_scrolls.js"></script>

<script type="text/javascript">
//Timer function



var intCountDown;
var timerobj;
var sec;
var min;			 
var xmlhttp,response;
//set color and the answers
var len = 20,total = 115;
var easy = 50,medium = 89,hard = 100,bon = 115;
var answers = new Array();
var nums = new Array();
var qa = new Array();
var qaa = new Array();
var oa = new Array();
var num;
var qset = "";
var qwo;
var gen=new Array();
var answered = 0;
var answerset,sess_ansset;
var score,teamname;
var bonustaken,bonus;
var p1,p2,nop="";


	//var sid = "<?php echo session_id(); ?>";
	//alert(sid);
	


for (var i = len - 1; i >= 0; i--) {
	answers[i] = 0;
}

var questions,options,correctanswers;



function hideMenu()
{
	netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserWrite");
	window.menubar.visible=false;
	window.directories.visible=false;
	window.statusbar.visible=false;
}


function disableRightClick()
{
//<!--



var message="";

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

function genRandom(seed,ll,ul,i)
{
	var flag=1;
	while(flag==1)
	{
		var ff=0;
		num = ll + Math.floor(Math.random()*(ul-ll-seed));
		for(var x=0;x<i;x++)
		{

			if(gen[x]==num)
				ff=1;
		}
		if(ff==0)
			flag=0;
	}
	gen[i]=num;
    qset += nums[num]+",";
}
/*
function genRandom(seed)
{
	num = Math.floor(Math.random()*(50-seed));
    qset += nums[num]+",";
    nums.splice(num,1);
}
*/
function populate()
{
	var did,cname;
	for (var i = 0; i < len; i++) 
	{
			did = document.getElementById("q"+(i+1));
			cname = ".mousescroll";
			$(cname,did).html(qa[i]);
			for (var j = (i*4); j < (i+1)*4; j++)
			{
				cname = ".option"+((j%4)+1);
				$(cname,did).html(oa[j]);
			} 
	}
}


function getQ()
{
	for(var i = 0; i < total; ++i)
		nums[i] = i + 1;
	for(var i = 0; i < len; ++i)
	{
		if(i < 7)
			genRandom(i,0,easy,i);
		else if(i >=7 && i < 12)
			genRandom(i-7,easy,medium,i);
		else if(i >= 12 && i < 15)
			genRandom(i-12,medium,hard,i);
		else
			genRandom(i-15,hard,bon,i);
	}	
	
	//alert(qset);
	
	xmlhttp = new XMLHttpRequest();


/******* Replace 1 by qset */


	//alert("getquestions.php?qset="+qset)
	xmlhttp.open("GET","getquestions.php?qset="+qset,false);
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.status=400 && xmlhttp.readyState==4)
		{
			qwo = xmlhttp.responseText;
		}
	}
	xmlhttp.send();
	
	qaa = qwo.split("~~~|~~~");

	var tq = new Array();
	var to = new Array();

	for (var i = 0; i < qaa.length; i++) 
	{
		tq = qaa[i].split("~~|~~");
		qa[i] = tq[0];
		to = (tq[1]).split("~|~");
		
		for(var j = (i*4);j < (i+1)*4; ++j)
			oa[j] = to[j%4];
	}

	//alert(qa.length);
	//alert(oa.length);
	
	populate();
	
}




function colorFill()
{
	for(var i = 0; i < answers.length; i++)
	{
		if(answers[i] != 0)
		{
			var did = document.getElementById("q"+(i+1));
			var cname = ".option"+answers[i];
			changecolor($(cname,did));
		}
	}
	setA();
}

function chkBonus()
{
	if(bonustaken == 1)
	{
			$("#bb").attr("disabled", "disabled");
			$(".bonus").children().show();
			$(".nonbonus").children().unbind('click');
			$(".nonbonus").children().attr('onclick','');
			$("#slide_questions").css("left","-10040px");
	}
}

//Timer function
function init()
{
	
	<?php session_start(); ?>

	p1 = '<?php echo $_SESSION['p1']; ?>';

	//alert(p1);

	p2 = '<?php echo $_SESSION['p2']; ?>';


	nop = '<?php echo $_SESSION['nop']; ?>';

	teamname = '<?php echo $_SESSION['teamname'];?>' ;

	bonus = '<?php echo $_SESSION['bonus'];?>' ;
	//alert(bonus);
	bonustaken = '<?php echo $_SESSION['bonustaken'];?>' ;
	//alert(bonustaken);
	sess_ansset = "<?php echo $_SESSION['answers']; ?>";

	getQ();

	for(var i = 0; i < sess_ansset.length; i = i + 2 )
		answers[i/2] = parseInt(sess_ansset[i]);

	//alert(answers);
	colorFill();
	chkBonus();
	intCountDown = <?php echo $_SESSION['sec'];?> ;

	min = <?php echo $_SESSION['min'];?> ;

	timerobj = document.getElementById("timer");
}

function logout(flg)
{
	res = false;
	if(flg == 1)
		res = confirm("Do you wish to quit , your scores will not be submitted ?");
	else
		window.location.replace('index.php');
	if(res)
		window.location.replace('index.php');
}

function computenSubmitScore()
{	
	xmlhttp = new XMLHttpRequest();
	xmlhttp.open("GET","computenSubmitScore.php",false);
	xmlhttp.onreadystatechange=function()
	{
		if(xmlhttp.status=400 && xmlhttp.readyState==4)
			score = xmlhttp.responseText;
	}
	xmlhttp.send();
	alert("team name: "+teamname+"\nscore: "+score+" on 80");
	return true;
}

function submitTest(flg)
{
	var tempres = false;
	res = true;
	if(flg != 1)
		res = confirm('Do you wish to submit (can\'t be undone) ?');
	if(res)tempres = computenSubmitScore();
	else return res;
	return tempres;
}


function countDown()
{
		xmlhttp = new XMLHttpRequest();
		answerset = "";
		for(var i = 0;i < len-1;++i)
			answerset += answers[i]+",";
		answerset += answers[i];
		//alert(answerset);
		xmlhttp.open("GET","updatetimer.php?min="+min+"&sec="+intCountDown+"&answers="+answerset+"&bonustaken="+bonustaken,true);
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.status=400 && xmlhttp.readyState==4)
				response = xmlhttp.responseText;
		}
		xmlhttp.send();
		//alert(response);
		if(intCountDown < 0 || <?php echo $_SESSION['min']; ?> <= 0)
		{
			timerobj.innerHTML = 'Time up';
			submitTest(1);
			return;
		}
		sec = (intCountDown--)%60;
		if(sec < 10)
			timerobj.innerHTML = min+":0"+sec;
		else
			timerobj.innerHTML = min+":"+sec;
		
		if(sec == 0)
		{
			min--;
			if(min < 5)
			{
				timerobj.style.color = "red";
				if(min < 2)
				{
					timerobj.style.textDecoration = "blink";
				}
			}

		}
		
		//alert(response+" "+bonus+" "+bonustaken);
		setTimeout("countDown()",1000);

}


//navi_table to question access



$(document).ready(function() {
		$("#c1").click(function() {
		$("#slide_questions").css("left","0");
	});
	$("#c2").click(function() {
		$("#slide_questions").css("left","-663.80px");
	});
	$("#c3").click(function() {
		$("#slide_questions").css("left","-1332.60px");
	});
	$("#c4").click(function() {
		$("#slide_questions").css("left","-2001.40px");
	});
	$("#c5").click(function() {
		$("#slide_questions").css("left","-2673.20px");
	});
	$("#c6").click(function() {
		$("#slide_questions").css("left","-3344px");
	});
	$("#c7").click(function() {
		$("#slide_questions").css("left","-4017.80px");
	});
	$("#c8").click(function() {
		$("#slide_questions").css("left","-4685.60px");
	});
	$("#c9").click(function() {
		$("#slide_questions").css("left","-5359.40px");
	});
	$("#c10").click(function() {
		$("#slide_questions").css("left","-6033.20px");
	});
	$("#c11").click(function() {
		$("#slide_questions").css("left","-6699px");
	});
	$("#c12").click(function() {
		$("#slide_questions").css("left","-7368.80px");
	});
	$("#c13").click(function() {
		$("#slide_questions").css("left","-8045.60px");
	});
	$("#c14").click(function() {
		$("#slide_questions").css("left","-8716.40px");
	});
	$("#c15").click(function() {
		$("#slide_questions").css("left","-9387.20px");
	});
	$("#c16").click(function() {
		$("#slide_questions").css("left","-10065px");
	});
	$("#c17").click(function() {
		$("#slide_questions").css("left","-10742.80px");
	});
	$("#c18").click(function() {
		$("#slide_questions").css("left","-11410.60px");
	});
	$("#c19").click(function() {
		$("#slide_questions").css("left","-12090.40px");
	});
	$("#c20").click(function() {
		$("#slide_questions").css("left","-12747.20px");
	});

	//facebook like scroll bar
	
	$(".mousescroll").slimscroll({
                  color: '#00f',
                  size: '7px',
                  width: '475px' ,
                  height: '120px'                
              });

	//disable bonus questions at first

	$(".bonus").children().hide();

	$(".mousescroll").css('white-space','pre');
	$(".option1").css('white-space','pre');
	$(".option2").css('white-space','pre');
	$(".option3").css('white-space','pre');
	$(".option4").css('white-space','pre');
    

	$("#testsubmit").click(function() {
	var surl =  "http://admin.paradigm2k12.com/jsonScores.php";
	submitTest(0);
	//alert(nop+" "+p1+" "+p2+" "+score);
	$.ajax({
		url: surl,
		async: false,
		data: {part:nop,part1:p1,part2:p2,score:score,password:"KILLTHEBUGS"},
		dataType: "jsonp",
		jsonp : "callback",
		jsonpCallback: "jsonpcallback"
		});
	});

});


function jsonpcallback(rtndata) { 

	// Get the id from the returned JSON string and use it to reference the target jQuery object.
	//alert(rtndata.part1);
	xmlhttp = new XMLHttpRequest();
	//alert(rtndata.score+" "+rtndata.name1+" "+rtndata.ph_no1+" "+rtndata.email1+"\n"+rtndata.name2+" "+rtndata.ph_no2+" "+rtndata.email2);
	if(rtndata.name1 != '' && rtndata.name1 != null)
	{
		xmlhttp.open("GET","inserpdet.php?p="+p1+"&name="+rtndata.name1+"&mob="+rtndata.ph_no1+"&mail="+rtndata.email1,false);
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.status=400 && xmlhttp.readyState==4)
			{
				res = xmlhttp.responseText;
			}
		}
		xmlhttp.send();
		//alert(res);
		if(nop == "2")
		{
			if(rtndata.name2 != '' && rtndata.name2 != null)
			{
				xmlhttp.open("GET","inserpdet.php?p="+p2+"&name="+rtndata.name2+"&mob="+rtndata.ph_no2+"&mail="+rtndata.email2,false);
				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.status=400 && xmlhttp.readyState==4)
					{
						res = xmlhttp.responseText;
					}
				}
				xmlhttp.send();
				//alert(res);
			}
			else
			{
				alert("You have not registered yet ! So score is disqualified !");
				xmlhttp.open("GET","delscore.php?p1="+p1+"&p2="+p2+"&type=2",false);
				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.status=400 && xmlhttp.readyState==4)
					{
						res = xmlhttp.responseText;
						//alert(res);
					}
				}
				xmlhttp.send();
			}
		}

	}
	else
	{
		alert("You have not registered yet ! So score is disqualified !");
		xmlhttp.open("GET","delscore.php?p1="+p1+"&type=1",false);
				xmlhttp.onreadystatechange=function()
				{
					if(xmlhttp.status=400 && xmlhttp.readyState==4)
					{
						res = xmlhttp.responseText;
						//alert(res);
					}
				}
				xmlhttp.send();		
	}
	logout(0);

}

function setA()
{
	answered = 0;
	for (var i = len - 1; i >= 0; i--) {
		if(answers[i] != 0)answered++;
	}
	document.getElementById("aq").innerHTML = answered;
}

function takeBonus()
{
	var res;
	if(bonus == 0 && answered < 15)
	{
		alert('Sorry you have to attend all 15 questions\nto take bonus questions !');
		return;
	}
	else
	{
		res = confirm('You can\'t make anymore changes to 15 questions you attempted\nand wish to take up bonus ?');
		
		if(res)
		{
			bonustaken = 1;
			$("#bb").attr("disabled", "disabled");
			$(".bonus").children().show();
			$(".nonbonus").children().unbind('click');
			$(".nonbonus").children().attr('onclick','');
			$("#slide_questions").css("left","-10040px");
		}
		return;
	}
}

//set color and the answers
 function changecolor(elem)
 {
 
 	 var el = $(elem).attr("class");
 	 var par = $(elem).parent().attr("id");
 	 var navid;
 	 var index;
 	 if(par.length == 3)
 	 {
 	 	index = parseInt(par[1])*10 + parseInt(par[2]) -1;
 	 	navid = document.getElementById("c"+par[1]+par[2]);
 	 }
 	 else
 	 {
 	 	index = parseInt(par[1]) - 1;
 	 	navid = document.getElementById("c"+par[1]);
 	 }
 	 //alert($(navid).attr("id"));
     if($(elem).css('background-color') == 'rgb(46, 122, 197)')
     {
      answers[index] = 0;
      //alert(answers[index]);
      if(el == "option1" || el == "option2")
      	$(elem).css('background-color', '#ffffff');
      else if	(el == "option3" || el == "option4")
      	$(elem).css('background-color', '#CC4F27');
      if(index <= 14)
      {
      		navid.style.backgroundColor = '#148BCD';
      		$(navid).hover( function(){ $(navid).css('background-color','#699CC3')} , function(){ $(navid).css('background-color','148BCD')});
      }
      else
      {
      		navid.style.backgroundColor = '#6B2873';
      		$(navid).hover( function(){ $(navid).css('background-color','#BA99BE')} , function(){ $(navid).css('background-color','6B2873')});		
      }
     }
    else
     {
       $(elem).parent().find('.option1').css('background-color', '#ffffff');
       $(elem).parent().find('.option2').css('background-color', '#ffffff');
       $(elem).parent().find('.option3').css('background-color', '#CC4F27');
       $(elem).parent().find('.option4').css('background-color', '#CC4F27');
       $(elem).css('background-color', '#2E7AC5');
       answers[index] = parseInt(el[6]);
       navid.style.backgroundColor = '#36E855';
       $(navid).hover( function(){ $(navid).css('background-color','#A0DFAB')}, function(){ $(navid).css('background-color','#36E855')});
       //alert(answers[index]);
     }
     setA();
 }

function setQ(e)
{
	var id = $(e).attr("id");
	var cq = document.getElementById("cq");
	if(id.length == 3)
		cq.innerHTML = parseInt(id[1])*10 + parseInt(id[2]);
	else
		cq.innerHTML = "0" + id[1];
}
  

</script>

<style>

</style>


</head>

<body onload="init();countDown();disableRightClick();">
<div id="total_area">

<div id="access_pane">
<ol class="rounded">
	<li onclick="location.href = 'rules.php'">Rules</li>
	<li style="visibility:hidden;">&nbsp;</li>
</ol>

<table id="navi_table">
<tr class="nonbonus"><td id="c1" onclick="setQ(this)">1</td><td id="c2" onclick="setQ(this)">2</td><td id="c3" onclick="setQ(this)">3</td><td id="c4" onclick="setQ(this)">4</td><td id="c5" onclick="setQ(this)">5</td></tr>
<tr class="nonbonus"><td id="c6" onclick="setQ(this)">6</td><td id="c7" onclick="setQ(this)">7</td><td id="c8" onclick="setQ(this)">8</td><td id="c9" onclick="setQ(this)">9</td><td id="c10" onclick="setQ(this)">10</td></tr>
<tr class="nonbonus"><td id="c11" onclick="setQ(this)">11</td><td id="c12" onclick="setQ(this)">12</td><td id="c13" onclick="setQ(this)">13</td><td id="c14" onclick="setQ(this)">14</td><td id="c15" onclick="setQ(this)">15</td></tr>
<tr class="bonus"><td id="c16" onclick="setQ(this)">16</td><td id="c17" onclick="setQ(this)">17</td><td id="c18" onclick="setQ(this)">18</td><td id="c19" onclick="setQ(this)">19</td><td id="c20" onclick="setQ(this)">20</td></tr>
</table>

<div id="tabcont" >
<table id="tab1">
<tr><td style="width:150px"><button id="testsubmit" class="button">Submit Test</button></td>
<td style="width:250px"><button id="bb" class="button" onclick="takeBonus()">Take Bonus</button></td></tr>
</table>
</div>

<div id="status">
<table>
<tr><td>The current question</td><td><div id="cqc"><div id="cq" style="margin-top:8px;">01</div></div></td></tr>
<tr><td>Number of questions answered</td><td><div id="aqc"><div id="aq" style="margin-top:8px;">00</div></div></td></tr>
</table>
</div>

<button id="logout" class="button" onclick="logout(1);">Log out</button>

</div>

<div id="load_area">

<div id="logo">
<img src="images/logo.png" alt="logo"/>
</div>

<div id="topic">
	<span><h1> Code County </h1></span>
</div>

<div id="sub_topic">
	<span><h3 id="timer">Timer will come here</h3></span>
</div>

<div id="disp_area">
	<div id="slide_questions">
		<div id="q1">
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
	 	</div>
		<div id="q2"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q3"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q4"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q5"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q6"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q7"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q8"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q9"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q10"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q11"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q12"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q13"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q14"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q15"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q16"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q17"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q18"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q19"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
		<div id="q20"> 
			<div class="mousescroll">This is is the first question of the programming and debugging event.The question goes like this:</br>
				What does it take to build a nice application which is capable of bringing yo you the best quizzing
				experience ?</div>
			<div class="option1" onclick="changecolor(this)">option 1</div>
			<div class="option2" onclick="changecolor(this)">otpion 2</div>
			<div class="option3" onclick="changecolor(this)">option 3</div>
			<div class="option4" onclick="changecolor(this)">option 4</div>
		</div>
	</div>
</div>
</div>


</div>

</div>


</body>
</html>