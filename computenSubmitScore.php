<?php
session_start();
$sess_ansset = $_SESSION['answers'];
$sess_ans = $_SESSION['ans'];
$answers = array();
$correctanswers = array();
$score = 0;
for($i = 0; $i < strlen($sess_ans); $i = $i + 2 )
{
		$answers[$i/2] = intval($sess_ansset[$i]);
		$correctanswers[$i/2] = intval($sess_ans[$i]);
}
$len = sizeof($answers);
for ($i = 0; $i < $len - 5; $i++)
		if($answers[$i] != 0)
		{
			if($answers[$i] == $correctanswers[$i])
				$score += 4;
			else
				$score -= 1;
		}
for ($i = $len - 5; $i < $len; $i++)
	if($answers[$i] != 0)
		if($answers[$i] == $correctanswers[$i])
				$score += 4;
$_SESSION['score'] = $score;

$dbc = mysqli_connect('localhost','root','aswin','codecountytest') or die('Error in connection');

$p1 = $_SESSION['p1'];
$p2 = $_SESSION['p2'];
$tn = $_SESSION['teamname'];

$query = "INSERT into prog_debug values('$p1','$p2','$tn',$score)";

$result = mysqli_query($dbc,$query) or die('Error in querying');

mysqli_close($dbc);

echo $score;

?>