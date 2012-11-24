<?php
echo "<PRE>";

include("config.php");

$fid = '622366350';
$userInfo = mysql_query("SELECT * FROM allusers WHERE fid='$fid'");
while($userRow = mysql_fetch_assoc($userInfo)){
    $uid = $userRow['uid'];
}
$classesInfo = mysql_query("SELECT * FROM userClasses WHERE uid='$uid'");
while ($classesRow = mysql_fetch_assoc($classesInfo)) {
        $cid = $classesRow['cid'];
//        echo $cid;
//        $psetTable = mysql_query("SELECT * FROM psets WHERE cid='$cid'");
//        $psetRow = mysql_fetch_assoc($psetTable);
//        echo '<div class="draggable" id="'.$psetRow["pid"].'"><a href="question.php?pid='.$psetRow['pid'].'&qnum=1" data-role="button">'.$psetRow["class"]." ".$psetRow["pset"]."</a></div>";
} 

?>
