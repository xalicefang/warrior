<?php
include("config.php");

$user_id = $_REQUEST['user_id'];

$class=($_GET['class']);
$classRow = mysql_fetch_assoc(mysql_query("SELECT * FROM classes WHERE class = '".$class."'"));
$cid = $classRow["cid"];

$insertUserPset="INSERT INTO userClasses (`fid`,`cid`) VALUES ($user_id,$cid)";
mysql_query($insertUserPset);

// for testing. if add physics
if ($cid==1) {
	$counter=0;
	$userpset= mysql_query("SELECT * FROM userpsets WHERE fid = '".$user_id."'");
	while ($userpsetRow = mysql_fetch_assoc($userpset)) {
		if ($userpsetRow["pid"]=43) {
			$counter++;
		}
	}
	if ($counter==0) {
		$insertUserPset="INSERT INTO `userpsets`(`uid`,`fid`,`class`, `pid`, `workingOn`) VALUES ('', '$user_id', '1', '43', '1')";
		mysql_query($insertUserPset);
	}
}

echo mysql_error();

header("Location:class");

?>