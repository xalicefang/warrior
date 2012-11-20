<?php
include("config.php");

session_start();
$user_id = $_REQUEST['user_id'];
$user_name = $_REQUEST['user_name'];

$_SESSION['user_id']   = $user_id;
$_SESSION['user_name']   = $user_name;

$expire = time() + 60 * 60 * 24 * 30;
setcookie("user_id", $user_id, $expire);
setcookie("user_name", $user_name, $expire);

$sql = "SELECT * FROM allusers WHERE fid =$user_id";
$result = mysql_query($sql);
$numRows = mysql_num_rows($result);
if($numRows == 0){
    $insertNew="INSERT INTO `c_cs147_fangx`.`allusers`(`uid`,`fid`, `name`) VALUES ('', '$user_id', '$user_name')";
    mysql_query($insertNew);
    echo mysql_error();
}

?>