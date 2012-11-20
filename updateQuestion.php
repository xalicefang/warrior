<?php
include("config.php");

$question = $_REQUEST['question'];
$qNum = $_REQUEST['qnum'];
$pid = $_REQUEST['pid'];


$insertQuestion = "INSERT INTO `c_cs147_fangx`.`questions`(`qid`,`questionNumber`, `pid`, `question`, `validated`) VALUES ('', '$qNum', '$pid', '$question', '0')";
mysql_query($insertQuestion);
echo $question;
?>
