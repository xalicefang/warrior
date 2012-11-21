<?php
include("config.php");

$user_id = $_REQUEST['user_id'];
$pset = $_REQUEST['pset'];
$cid = $_REQUEST['cid'];
$class = urldecode($_REQUEST['className']);

$insertPset="INSERT INTO `c_cs147_fangx`.`psets`(`class`,`cid`,`pset`,`pid`) VALUES ('$class', '$cid', '$pset', 'NULL')";
mysql_query($insertPset);
$pid = mysql_insert_id();
echo mysql_error();


$insertUserPset="INSERT INTO `c_cs147_fangx`.`userpsets`(`uid`,`fid`,`class`, `pid`, `workingOn`) VALUES ('', '$user_id', '$cid', '$pid', '1')";
mysql_query($insertUserPset);

echo mysql_error();
?>