<?php
include("config.php");
	$qid = $_POST['qid'];
	$qnum = $_POST['qnum'];
	$pid = $_POST['pid'];
	$content = $_POST['content']; //get posted data
	$content = mysql_real_escape_string($content);	//escape string	
	
	$sql = "UPDATE questions SET question = '$content' WHERE qid = $qid AND pid=$pid AND questionNumber=$qnum";
	
	if (mysql_query($sql))
	{
		echo 1;
	}
?>
