<?php
session_start();
if($_SESSION['questions'] == "")
{
	$dbc = mysqli_connect('localhost','root','aswin','codecountytest') or die('Error in connection.');

	$qset = $_GET['qset'];
	$qsetarray = explode(',',$qset);
	$len = count($qsetarray);
	
	for($i = 0; $i < $len; $i++)
	{
		$qid = 'q'.($qsetarray[$i]);
		$query = "SELECT * from questions where qid = '$qid'";
		$result = mysqli_query($dbc,$query) or die('Error in query.');
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
		{

			$question = htmlspecialchars($row["question"]);
			$op1 = htmlspecialchars($row["op1"]);
			$op2 = htmlspecialchars($row["op2"]);
			$op3 = htmlspecialchars($row["op3"]);
			$op4 = htmlspecialchars($row["op4"]);
			$ans = $row["ans"];
			$_SESSION['questions'] .= $question.'~~|~~'.$op1.'~|~'.$op2.'~|~'.$op3.'~|~'.$op4.'~~~|~~~';
			$_SESSION['ans'] .= $ans.',';
		}
		mysqli_free_result($result);

	}
	$_SESSION['questions'] = substr_replace($_SESSION['questions'], '', -7);
	$_SESSION['ans'] = substr_replace($_SESSION['ans'], '', -1);
	mysqli_close($dbc);

//echo ($dbc.' '.$result);

}
echo $_SESSION['questions'];
?>