<!DOCTYPE html> 
<html>

<head>
	<title>Pset Warrior | Undefeated Psets</title> 
	<meta charset="utf-8">
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

	

</head>  
<body>
    
	<div data-role="page" data-theme="c" id="home">
	<div data-role="header" ><img src="images/header.png" width="100%"></div>
	<div data-role="content">
	<a href="index.html" data-role="button" class="ui-nolink" data-theme="e">Choose a class</a>
			<?php
			include("config.php");
			
			$fid = $_REQUEST['user_id'];
			$userRow = mysql_fetch_assoc(mysql_query("SELECT * FROM allusers WHERE fid = '".$fid."'"));

			$userClasses = array ();
			$query = mysql_query("SELECT * FROM userClasses WHERE fid = '".$fid."'");
			while ($userClassesRow = mysql_fetch_assoc($query)) {
				$userClasses[] = $userClassesRow["cid"];
			}		
			
			
			$classesTable = mysql_query("SELECT * FROM classes");
			$classes = array ();

			echo '<fieldset data-role="controlgroup">';
			$counter=0;
			while ($classesRow = mysql_fetch_assoc($classesTable)) {
				$class = $classesRow['class'];
				$cid = $classesRow['cid'];
				$classes[] = $class;
				for ($i=0; $i<count($userClasses); $i++) {
					if ($userClasses[$i]==$cid) {
						$counter++;
						echo '<input type="radio" name="class" id="'.$cid.'"/>';
						echo '<label for="'.$cid.'">'.$class.'</label>';
						break;
					}
				}
			}
			if ($counter==0) {
				$counter++;
				?><script>
				$(function() {
					alert("You must add a class before adding a pset. Go to add class.");
					window.location.href="class";
				});
				</script><?
			}
			echo '</fieldset>';
                     ?>
	<p></p>

	<a href="index.html" data-role="button" class="ui-nolink" data-theme="e">Pset name:</a>
   	<input type="text" name="pset" id="pset" value=""/>

	<p></p>
	
	<fieldset class="ui-grid-e">
	<div class="ui-block-a"><a href="#" data-role="button" data-theme="c" onclick="window.location.href='home.php'">Cancel</a></div>
        <div class="ui-block-b"><a href="#" data-role="button" data-theme="b" id="add_pset" onclick="updatePset()">Add & Fight</a></div>
	</fieldset>
        </div>

	<div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			<li><a data-ajax ="false" href="index.php" id="homepage" data-icon="custom">Home</a></li>
                        <li><a data-ajax ="false" href="addpset.php" class="ui-btn-active ui-state-persist" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a data-ajax ="false" href="defeated.php"  id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a data-ajax ="false" href="class.php" id="classes" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->

       </div>
          
<script>
	// $("#add_pset").bind("click", function() { alert("test"); updatePset() });

	function updatePset(){
            var userID = <?php echo $_COOKIE['user_id']?>;
            var className = $('.ui-radio-on .ui-btn-text').text();
            var cid = $('input[name=class]:checked').attr('id');
            var psetName = $('#pset').val();
            if(className != 'undefined' && className != '' && psetName != '') {
			var r = confirm("Add " + $('.ui-radio-on .ui-btn-text').html() + " " + psetName + "?");
			if (r==true) {
				$.post('updatePset.php', 
				{user_id: userID, className: className, cid: cid, pset: psetName}, 
				function(data){window.location.href="index.php"});
			}
            }
            else confirm('Please choose a valid class and pset name!');                 
        }
        </script>
</body>
</html>