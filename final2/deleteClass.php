<?php
    include('config.php');
    $cid = $_REQUEST['cid'];
    $fid = $_REQUEST['fid'];

$deleteClass="DELETE FROM userClasses WHERE fid='".$fid."' and cid='".$cid."'";
mysql_query($deleteClass);

?>