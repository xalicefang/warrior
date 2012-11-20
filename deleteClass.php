<?php
include("config.php");

$user_id = $_REQUEST['user_id'];

$userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM allusers WHERE fid = '".$user_id."'"));
$uid = $userRow["uid"];

$cid=($_GET['cid']);

$deleteClass="DELETE FROM userClasses WHERE uid='".$uid."' and cid='".$cid."'";
mysql_query($deleteClass);

echo mysql_error();

header("Location:class");

?>