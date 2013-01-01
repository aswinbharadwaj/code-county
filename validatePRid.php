<?php

$dbc = mysqli_connect('localhost','root','aswin','codecountytest') or die('Error in connection');


$pr1 = $_GET['pr1'];
$pr2 = $_GET['pr2'];
$count = 0;
$arr = array();
$opr = array();
$res= 'false';
if($pr1 != "" && $pr2 != "" && $pr1 != NULL && $pr2 != NULL)
{

$query = "SELECT id,code_county from participants where id = '$pr1' OR id = '$pr2'";
$update = "UPDATE participants SET code_county = '1' where id = '$pr1' OR id = '$pr2'";

$result = mysqli_query($dbc,$query) or die('Error in query.');



if(mysqli_num_rows($result) == 0)
	$res = "Both the PR ids are invalid";
else if(mysqli_num_rows($result) == 1 || mysqli_num_rows($result)== 2)
{
	$i = 0;
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$opr[$i] = $row["id"];$arr[$i] = $row["code_county"];
		$i++;
	}

	if(mysqli_num_rows($result) == 1)
	{
		if($opr[0] == $pr1)$res = "The PR id of participant 2 is invalid";
		else $res = "The PR id of participant 1 is invalid";
	}
	else if(mysqli_num_rows($result) == 2)
	{
		if($arr[0] == "0" && $arr[1] == "0")
		{
			$res = "true";
			$result = mysqli_query($dbc,$update) or die('Error in update.');
		}
		else if($arr[0] == "1" && $arr[1] == "1")$res = "Both participants have already participated !";
		else if($arr[0] == "1" && $opr[0] == $pr1)$res = "Participant 1 has already participated !";
		else if($arr[1] == "1" && $opr[1] == $pr2)$res = "Participant 2 has already participated !";
		else if($arr[0] == "1" && $opr[0] == $pr2)$res = "Participant 2 has already participated !";
		else if($arr[1] == "1" && $opr[1] == $pr1)$res = "Participant 1 has already participated !";
		
	}
}
}
else if($pr2 == "" || $pr2 == NULL)
{
	$query = "SELECT id,code_county from participants where id = '$pr1'";
	$update = "UPDATE participants SET code_county = '1' where id = '$pr1'";
	$result = mysqli_query($dbc,$query) or die('Participant id is not valid.');
	$i = 0;
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		$opr[$i] = $row["id"];$arr[$i] = $row["code_county"];
		$i++;
	}
	if($arr[0] == "1")
	{
		$res = "You have already participated !";
	}
	else if($arr[0] == "0")
	{
		$res = "true";
		$result = mysqli_query($dbc,$update) or die('Error in update.');
	}
}
mysqli_close($dbc);

echo $res;
/*
$con = mysql_connect("localhost","festaliz_arvind","hondacity");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}

mysql_select_db("", $con);

echo mysqli_connect('69.195.126.101','festaliz_arvind','hondacity','festaliz_paradigmdb') or die('Error in connection');
*/

//echo mysql_connect('66.147.244.74','festaliz_arvind','hondacity') or die('Error in connection');

?>