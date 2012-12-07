<?php
include("config.php");

$answer = $_REQUEST['answer'];
$qid = $_REQUEST['qid'];

$sqlAll = "SELECT * FROM  `answers` WHERE  `qid` =$qid";
$resultAll = mysql_query($sqlAll);
$numRowsAll = mysql_num_rows($resultAll);
if($numRowsAll > 1){
    $numRowsAll--;
    $sql = "SELECT * FROM answers WHERE qid=$qid AND answer=$answer";
    $result = mysql_query($sql);
    $numRowsCorrect = mysql_num_rows($result) - 1;
    echo $numRowsCorrect. " / " . $numRowsAll . " people who submitted an answer got the same answer as you.";    
} else{
    echo "Sorry, but no one has submitted any answers for this question yet. Your answer $answer was recorded!";
    exit;
}

?>