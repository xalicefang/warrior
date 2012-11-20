<?php
include("config.php");

$answer = $_REQUEST['answer'];
$qid = $_REQUEST['qid'];

$sqlAll = "SELECT * FROM answers WHERE qid=$qid";
$resultAll = mysql_query($sqlAll);
$numRowsAll = mysql_num_rows($resultAll);

$sql = "SELECT * FROM answers WHERE qid=$qid AND answer=$answer";
$result = mysql_query($sql);
if( mysql_error()){
    echo "0";
    exit;
}

$numRowsCorrect = mysql_num_rows($result);

echo $numRowsCorrect . " / " . $numRowsAll;

?>
