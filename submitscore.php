<?php

session_start();

$_SESSION['score'] = $_GET['score'];

$dbc = mysqli_connect('localhost','root','aswin','codecountytest') or die('Error in connection');


$p1 = $_SESSION['p1'];
$p2 = $_SESSION['p2'];
$score = intval($_SESSION['score']);
$tn = $_GET['teamname'];

$query = "INSERT into prog_debug values('$p1','$p2','$tn',$score)";

$result = mysqli_query($dbc,$query) or die('Error in querying');

mysqli_close($dbc);

echo ' ';

var_dump($result);

?>