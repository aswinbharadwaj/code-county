<?php

$dbc = mysqli_connect('localhost','root','aswin','codecountytest') or die('Error in connection');

$p1 = $_GET['p1'];
$p2 = $_GET['p2'];
$type = $_GET['type'];

if($type == '1')
	$query = "DELETE from prog_debug where p1 = '$p1'";
else if($type == '2')
	$query = "DELETE from prog_debug where p1 = '$p1' && p2 = '$p2'";
$result = mysqli_query($dbc,$query) or die('Error in query.');

mysqli_close($dbc);

if($result != 'Error in query.')
	echo 'deleted';
else
	echo $result;
?>