<?php
	include('config.php');
	$allPids = $_REQUEST['allPids'];
	$fid = $_REQUEST['fid'];
    
	foreach ($allPids as &$pid) {
		$updatePset = "UPDATE  `userpsets` SET  `workingOn` =  '0' WHERE  `userpsets`.`pid` =$pid AND `userpsets`.`fid` =$fid";
		mysql_query($updatePset);
	}
?>
