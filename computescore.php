<?php

$sess_ansset = $_SESSION['answers'];
$sess_ans = $_SESSION['ans'];
$answers = array();
$correctanswers = array();
$len = sizeof($answers);
$score = 0;

for($i = 0; $i < strlen($sess_ansset); $i = $i + 2 )
{
		$answers[$i/2] = intval($sess_ansset[$i]);
		$correctanswers[$i/2] = intval($sess_ans[$i]);
}
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

echo '$score';

?>