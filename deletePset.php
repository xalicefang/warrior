<?php
    include('config.php');
    $pid = $_REQUEST['pid'];
    $uid = $_REQUEST['uid'];
    
    $updatePset = "UPDATE  `c_cs147_fangx`.`userpsets` SET  `workingOn` =  '0' WHERE  `userpsets`.`pid` =$pid AND `userpsets`.`fid` =$uid";
    mysql_query($updatePset);
    echo $pid.$uid;
?>
