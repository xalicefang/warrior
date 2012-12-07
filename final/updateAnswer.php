<?php
include("config.php");

$answer = $_REQUEST['answer'];
$qid = $_REQUEST['qid'];
$fid = $_REQUEST['fid'];
$pid = $_REQUEST['pid'];

$checkedBefore = mysql_query("SELECT * FROM answers WHERE qid=$qid AND fid=$fid");
if (mysql_num_rows($checkedBefore) == 0) {
	$insertAnswer = "INSERT INTO `answers`(`fid`, `qid`, `pid`, `answer`) VALUES ('$fid', '$qid', '$pid', '$answer')";
	mysql_query($insertAnswer);
} else {
	$sql = "UPDATE answers SET answer = '$answer' WHERE qid = $qid AND fid=$fid";
	mysql_query($sql);
}
?>