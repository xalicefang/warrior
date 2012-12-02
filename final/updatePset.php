<?php
include("config.php");

$user_id = $_REQUEST['user_id'];
$pset = $_REQUEST['pset'];
$cid = $_REQUEST['cid'];
$class = urldecode($_REQUEST['className']);

$insertPset="INSERT INTO `psets`(`class`,`cid`,`pset`,`pid`) VALUES ('$class', '$cid', '$pset', '')";
mysql_query($insertPset);
$pid = mysql_insert_id();

$insertUserPset="INSERT INTO `userpsets`(`uid`,`fid`,`class`, `pid`, `workingOn`) VALUES ('', '$user_id', '$cid', '$pid', '1')";
mysql_query($insertUserPset);

$allUsersInClass = mysql_query("SELECT * FROM userClasses WHERE cid='$cid'");
while ($user = mysql_fetch_assoc($allUsersInClass)) {
	$fid = $user[fid];
	if ($fid!=$user_id) {
		$insertUserPset="INSERT INTO `userpsets`(`uid`,`fid`,`class`, `pid`, `workingOn`) VALUES ('', '$fid', '$cid', '$pid', '2')";
		mysql_query($insertUserPset);
	}
}


?>