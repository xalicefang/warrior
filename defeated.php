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
	<div data-role="header" >
		<img src="images/header.png" width="100%">
	</div><!-- /header -->

	<div data-role="content">
			 
		<?php
			include("config.php");
			if ($_GET['referrer']=="sign"){
				$name = $_POST["name"];
				$password = $_POST["password"];
				$email = $_POST["email"];
				$insertNew="INSERT INTO `c_cs147_fangx`.`all users`(`uid`,`name`, `password`, `email`) VALUES (NULL,'$name', '$password', '$email')";
				mysql_query($insertNew);
				$uid = mysql_insert_id();
				setcookie('uid', '$uid');
				echo "<p>Welcome to Pset Warrior!</p>";
			} else {
                                if(isset($_COOKIE['user_id']))
                                    $fid = $_COOKIE['user_id'];
				// for current user, pull psets associated with user into array. for each pid in array, pull rows from psets
				$psetsTable = mysql_query("SELECT * FROM userpsets WHERE fid=$fid AND workingOn=0");
				
				echo '<div  data-role="fieldcontain">';
				echo '<fieldset data-role="controlgroup">';
				echo '<a href="index.html" data-role="button" class="ui-nolink" data-theme="e"><b>Defeated Psets</b></a>';
				$counter=0;
				while ($psetsRow = mysql_fetch_assoc($psetsTable)) {
                                        $pid = $psetsRow['pid'];
                                        $psets = mysql_query("SELECT * FROM psets WHERE pid=$pid");
                                        while ($row = mysql_fetch_array($psets)) {
                                            $class = $row['class'];
                                            $pset = $row['pset'];
                                        }
                                        
					$counter++;
					echo '<label id="'.$pid.'"><input type="checkbox" name="checkbox-'.$counter.'" />'.$class.$pset.' '.$psetsRow["pset"].'</label>'; 
				} 
			echo '</fieldset>';
			echo '</div>';
			}
			?>
	<p></p>
	<fieldset class="ui-grid-e">
	<div class="ui-block-b"><a data-ajax="false" data-role="button" data-theme="c" data-ajax="true" href="" onclick="revivePset()">Revive</a></div>	   
	</fieldset>
	</div><!-- /content -->
	
	<div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			<li><a data-ajax ="false" href="home.php" id="homepage" data-icon="custom">Home</a></li>
                        <li><a data-ajax ="false" href="addpset.php?reload=yes" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a data-ajax ="false" href="defeated.php" class="ui-btn-active ui-state-persist" id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a data-ajax ="false" href="class.php" id="classes" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->


       </div><!-- /page -->
       <script>
           function revivePset(){
                var pid = $('.ui-checkbox-on').attr('id');
                $.post("revivePset.php",
                {pid: pid, uid: <?php echo $_COOKIE['user_id'] ?>
                }, function(data)
                {
                    window.location.reload();
                });
           }
       </script>
</body>

</html>