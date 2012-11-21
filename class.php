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
	<fieldset data-role="controlgroup">
	<a href="index.html" data-role="button" class="ui-nolink" data-theme="e">Add/ remove classes</a>
			
			<p>
				<input type="text" id="searchField" placeholder="Search for classes">
				<ul id="suggestions" data-role="listview" data-inset="true"></ul>
			</p>

			<?php
			include("config.php");

			$fid = $_REQUEST['user_id']; // change to $_COOKIE['user_id']
			$userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM allusers WHERE fid = '".$fid."'"));

			$userClasses = array ();
			$query = mysql_query("SELECT * FROM userClasses WHERE fid = '".$fid."'");
			while ($userClassesRow = mysql_fetch_assoc($query)) {
				$userClasses[] = $userClassesRow["cid"];
			}

			$classesTable = mysql_query("SELECT * FROM classes");
			$classes = array ();

			while ($classesRow = mysql_fetch_assoc($classesTable)) {
				$classes[] = $classesRow["class"];
				for ($i=0; $i<count($userClasses); $i++) {
					if ($userClasses[$i]==$classesRow["cid"]) {
						echo '<a href="deleteClass.php?cid='.$classesRow["cid"].'" data-role="button" data-icon="delete" data-iconpos="right">'.$classesRow["class"].'</a>';
						unset($classes[count($classes)-1]);
						$classes= array_values($classes);
						break;
					}
				}
				
			}
			?>
	</fieldset>
	<p></p>
	
	<p></p>

	<fieldset class="ui-grid-e">
	<div class="ui-block-a"><button type="submit" data-theme="c" onclick="window.history.back()">Back</button></div>
	<div class="ui-block-b"><button type="submit" data-theme="b" onclick="window.location.href='home.php'">Save</button></div>
	</fieldset>
	   
	
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			   <li><a href="index.php" id="homepage" data-icon="custom">Home</a></li>
                        <li><a href="addpset.php" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a href="defeated.php" id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a href="class.php" class="ui-btn-active ui-state-persist" id="classes" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->


       </div><!-- /page -->
	
	<script>

		$("#addremoveclass").bind("pageshow", function(e) {

			var availableTags = <?php echo json_encode($classes); ?>;

			$("#searchField").autocomplete({
				target: $('#suggestions'),
				source: availableTags,
				link: 'addClass.php?class=',
				minLength: 1,
				matchFromStart: false
			});
		});
	</script>

</body>
</html>