<?php

include("config.php");

$answer = $_REQUEST['answer'];
$qid = $_REQUEST['qid'];
$uid = $_REQUEST['uid'];
$fid = $_REQUEST['fid'];
$pid = $_REQUEST['pid'];


$insertAnswer = "INSERT INTO `answers`(`uid`, `fid`, `qid`, `pid`, `answer`, `checked`) VALUES ('$uid', '$fid', '$qid', '$pid', $answer ,'0')";
mysql_query($insertAnswer);
echo $answer;
?>
