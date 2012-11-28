<?php
include("config.php");

$answer = $_REQUEST['answer'];
$qid = $_REQUEST['qid'];

$sqlAll = "SELECT * FROM answers WHERE qid=$qid";
$resultAll = mysql_query($sqlAll);
if(mysql_num_rows($resultAll) == 0){
    echo "Sorry, but no one has submitted any answers for this question yet. Your answer $answer was recorded!";
    exit;
}else{
    $numRowsAll = mysql_num_rows($resultAll);
    $sql = "SELECT * FROM answers WHERE qid=$qid AND answer=$answer";
    $result = mysql_query($sql);
    $numRowsCorrect = mysql_num_rows($result);
    if(mysql_error()){
        echo "0 people who submitted an answer got the same answer as you.";
        exit;
    } 

    echo $numRowsCorrect . " / " . $numRowsAll . " people who submitted an answer got the same answer as you.";
}

?>
