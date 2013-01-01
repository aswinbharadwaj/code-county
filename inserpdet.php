<?php
$dbc = mysqli_connect('localhost','root','aswin','codecountytest') or die('Error in connection');

$p = $_GET['p'];
$name = $_GET['name'];
$mob = $_GET['mob'];
$mail = $_GET['mail'];

$query = "INSERT into pdetails values('$p','$name','$mob','$mail')";

$result = mysqli_query($dbc,$query) or die('Error in query.');

mysqli_close($dbc);

if($result != 'Error in query.')
	echo 'inserted';
else
	echo $result;

?>