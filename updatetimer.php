
<?php
session_start();
$_SESSION['min'] = $_GET['min'];
$_SESSION['sec'] = $_GET['sec'];
$_SESSION['answers'] = $_GET['answers'];
$temp = $_SESSION['answers'];
$arr = explode(',', $temp);
$_SESSION['bonus'] = 1;
$_SESSION['bonustaken'] = $_GET['bonustaken'];
for ($i = 0; $i < 15; $i++)
{
	if($arr[$i] == 0) {$_SESSION['bonus'] = 0;break;}
}
echo ' ';
?>