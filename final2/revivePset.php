<?php
	include('config.php');
	$fid = $_REQUEST['user_id'];
	$allPids = $_REQUEST['allPids'];

	foreach ($allPids as &$pid) {
		$updatePset = "UPDATE `userpsets` SET  `workingOn` =  '1' WHERE  `userpsets`.`pid` =".$pid." AND `userpsets`.`fid` =".$fid;
		mysql_query($updatePset);
	}

?>
