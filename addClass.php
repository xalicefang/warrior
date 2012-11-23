<?php
include("config.php");

$user_id = $_REQUEST['user_id'];

$userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM allusers WHERE fid = '".$user_id."'"));
$uid = $userRow["uid"];

$class=($_GET['class']);
$classRow = mysql_fetch_assoc(mysql_query("SELECT * FROM classes WHERE class = '".$class."'"));
$cid = $classRow["cid"];

$insertUserPset="INSERT INTO userClasses (`fid`,`cid`) VALUES ($user_id,$cid)";
mysql_query($insertUserPset);

echo mysql_error();

header("Location:class");

?>