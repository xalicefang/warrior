<?php
    include('config.php');
    $pid = $_REQUEST['pid'];
    $fid = $_REQUEST['fid'];
    
    $updatePset = "UPDATE  `userpsets` SET  `workingOn` =  '0' WHERE  `userpsets`.`pid` =$pid AND `userpsets`.`fid` =$fid";
    mysql_query($updatePset);
?>