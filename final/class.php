<!DOCTYPE html> 
<html>

<head>
	<title>Pset Warrior | Undefeated Psets</title> 
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="startup.png">
	<link href='http://fonts.googleapis.com/css?family=Patrick+Hand' rel='stylesheet' type='text/css'>
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>
	<script src="jqm.autoComplete-1.4.3-min.js"></script>
	

</head>  
<body>

	<div data-role="page" id="addremoveclass">
	<div data-role="header" class="ui-header">
		<img src="images/header.png" width="100%">
	</div><!-- /header -->

	<div data-role="content">
			
			<?php
include("config.php");

$fid = $_REQUEST['user_id'];

$class=($_GET['class']);
$classRow = mysql_fetch_assoc(mysql_query("SELECT * FROM classes WHERE class = '".$class."'"));
$cid = $classRow["cid"];

// if URL has class info
if ($cid!=""){
	$insertUserPset="INSERT INTO userClasses (`fid`,`cid`) VALUES ($fid,$cid)";
	mysql_query($insertUserPset);
	$biggestPid =0;
	$query= mysql_query("SELECT * FROM psets WHERE cid = '".$cid."'");
	while($psetRow=mysql_fetch_assoc($query)){
		$pid = $psetRow["pid"];
		if ($pid > $biggestPid) $biggestPid = $pid;
		if (mysql_num_rows(mysql_query("SELECT * FROM userpsets WHERE pid = '".$pid."' AND fid = '".$fid."'"))==0) {
			$insertUserPset="INSERT INTO `userpsets`(`uid`,`fid`,`class`, `pid`, `workingOn`) VALUES ('', '$fid', '$cid', '$pid', '0')";
			mysql_query($insertUserPset);
		}
	}
	mysql_query("UPDATE  `userpsets` SET  `workingOn` ='1' WHERE  `userpsets`.`pid` =$biggestPid AND `userpsets`.`fid` =$fid");
	echo '<script>window.location="class"</script>';
}

			$userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM allusers WHERE fid = '".$fid."'"));

			$userClasses = array ();
			$query = mysql_query("SELECT * FROM userClasses WHERE fid = '".$fid."'");
			
			echo '<fieldset data-role="controlgroup">';
			echo '<a href="" data-role="button" class="ui-nolink" data-theme="e">Classes</a>';

			while ($userClassesRow = mysql_fetch_assoc($query)) {
				$userClasses[] = $userClassesRow["cid"];
				$classRow = mysql_fetch_assoc(mysql_query("SELECT * FROM classes WHERE cid = '".$userClassesRow["cid"]."'"));
				$className = $classRow["class"];
				echo '<a href="" onClick="deleteClass('.$userClassesRow["cid"].')" id="'.$userClassesRow["cid"].'" name="'.$className.'" data-role="button" data-icon="delete" data-iconpos="right">'.$className.'</a>';
			}

			$classesTable = mysql_query("SELECT * FROM classes");
			$classes = array ();

			while ($classesRow = mysql_fetch_assoc($classesTable)) {
				$classes[] = $classesRow["class"];
				for ($i=0; $i<count($userClasses); $i++) {
					if ($userClasses[$i]==$classesRow["cid"]) {
						unset($classes[count($classes)-1]);
						$classes= array_values($classes);
						break;
					}
				}
				
			}

			?>
	</fieldset>
			<p>
				<input type="text" id="searchField" placeholder="Search for classes to add">
				<ul id="suggestions" data-role="listview" data-inset="true"></ul>
			</p>
	
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			<li><a data-ajax ="false" href="index.php" id="homepage" data-icon="custom">Home</a></li>
                        <li><a data-ajax ="false" href="addpset.php?reload=yes" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a data-ajax ="false" href="defeated.php"  id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a data-ajax ="false" href="class.php" id="classes" class="ui-btn-active ui-state-persist" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->


       </div><!-- /page -->
	
	<script>

	function deleteClass(cid){
		var fid = <?php echo $_COOKIE['user_id']?>;
		var className = $('#'+cid).attr('name');
		if(cid != '') {
			var r = confirm("Delete " + className + "?");
			if (r==true) {
				$.post('deleteClass.php', 
				{fid: fid, cid: cid}, 
				function(data){window.location.reload();
				});
			}
            }
            else confirm('Please choose a valid class and pset name!');                 
        }

		$("#addremoveclass").bind("pageshow", function(e) {

			var availableTags = <?php echo json_encode($classes); ?>;

			$("#searchField").autocomplete({
				target: $('#suggestions'),
				source: availableTags,
				link: 'class.php?class=',
				minLength: 1,
				matchFromStart: false
			});

			

		});
	</script>

</body>
</html>