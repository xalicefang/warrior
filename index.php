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
   	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />

    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="http://code.jquery.com/ui/1.8.21/jquery-ui.min.js"></script>
    <script src="jquery.ui.touch-punch.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

	<?php include("config.php")?>

    <style>	

@media screen and (orientation: landscape) {
        html, body {
          width: 100%;
        }

        .content h1.landscape { display: block }
        .content h1.portrait { display: none }
      }
      @media screen and (orientation: portrait) {
        html, body {
          width: 100%;
        }

        .content .landscape { display: none }
        .content .portrait { display: block }
      }

	.fixed-above-footer {
font-family:Patrick Hand; 
text-align:center; 
bottom: 90px;
float: center; 
}

#popupPanel-popup {
	    right: 0 !important;
	    left: auto !important;
		}
		#popupPanel {
		    border: 1px solid #000;
		    border-right: none;
		    background: rgba(0,0,0,.5);
		    margin: -1px 0;
		}
		#helper {
			position:absolute;
			color:#fff;
			top:70px;
			left:20px;
		}
		#popupPanel .ui-btn {
		    margin: 2em 15px;
		}

    </style>

</head> 



  <body> 
  
	<div data-role="page" data-theme="c">
	<div data-role="header" >
		<img src="images/header.png" width="100%">
	</div><!-- /header -->

      <div class='content' data-role='content'> 

       <script>
	
	$(function() {
		$( ".draggable" ).draggable({ revert: "invalid" });
		$( "#droppable" ).droppable({
		activeClass: "ui-state-hover",
		hoverClass: "ui-state-active",
		drop: function( event, ui ) {
		var pid = ui.draggable.attr('id');
                deletePset(pid);
		//document.write(pid);
		document.location.reload(true);
		
		$( this )
			.addClass( "ui-state-highlight" )
			.find( "p" )
		}
		});
	});
        </script>
	<div data-role="controlgroup">
	<a href="" data-role="button" class="ui-nolink" data-theme="e"><b>Undefeated Psets</b></a>
		<?php
		$fid=$_COOKIE['user_id'];
		// if user logged in
		if(isset($fid)) {
			// get classes for user
			$classesInfo = mysql_query("SELECT * FROM userClasses WHERE fid='$fid'");
			// if no classes, show help
			if (mysql_num_rows($classesInfo)==0) getStartedHelp();
			$counter=0;
			while ($classesRow = mysql_fetch_assoc($classesInfo)) {
				$cid = $classesRow['cid'];
				// get pets for classes user is in
				$psetTable = mysql_query("SELECT * FROM psets WHERE cid='$cid'");
				while ($psetRow = mysql_fetch_assoc($psetTable)) {
					$pid = $psetRow['pid'];
					// check if pset is active, if active, button
					$userPsetTable = mysql_query("SELECT * FROM userpsets WHERE fid='$fid' AND pid='$pid'");
					$userPsetRow = mysql_fetch_assoc($userPsetTable);
					$workingOn = $userPsetRow['workingOn'];
					if($workingOn == 1) {
						$counter++;
						echo '<div class="draggable" id="'.$psetRow["pid"].'"><a data-ajax="false" href="question.php?pid='.$psetRow['pid'].'&qnum=1" data-role="button">'.$psetRow["class"]." ".$psetRow["pset"]."</a></div>";
					}
				}
			}
			// if no active psets
			if ($counter==0) {
				echo "<p>You currently have no psets! Add a new pset or just relax :)</p>";
			} 
		} // end if isset
		?>
 <p></p>
        <a href="" data-role="button" data-theme="b" data-position="fixed" data-role="navbar" id="droppable" class="fixed-above-footer">drag finished pset here to defeat</a>

</div>

 <div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			<li><a data-ajax ="false" href="index.php" id="homepage" class="ui-btn-active ui-state-persist" data-icon="custom">Home</a></li>
                        <li><a data-ajax ="false" href="addpset.php?reload=yes" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a data-ajax ="false" href="defeated.php" id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a data-ajax ="false" href="class.php" id="classes" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->
    </div> 

<?
function getStartedHelp() {
	echo '<a href="" data-role="button">your pset here</a>';
	echo '<a href="" data-role="button">and here</a>';
	echo '<a href="" data-role="button">and here! :)</a>';
	?>
	<script>
	$(document).unbind('pageshow');
	$(document).bind('pageshow', function(event){ 
		$("#popupPanel").popup({history:false});
		$( "#popupPanel" ).on({
		popupbeforeposition: function() {
			var h = $( window ).height();
			var w = $( window ).width();
			$( "#popupPanel" ).css( "height", h );
			$( "#popupPanel" ).css( "width", w );
		}
	});
	$("#popupPanel").popup("open");
	});
	</script> 					
	</div>
	<div data-role="popup" id="popupPanel" data-corners="false" data-theme="none" data-shadow="false" data-tolerance="0,0">
	
	<img src="images/arrow.png" style="transform: rotate(60deg);-webkit-transform: scaleX(2);position:absolute;top:20px;right:0;" />

	<p>Click here to see more options</p>

	<a href="#" data-rel="back">Close</a>

	</div>
	
<? 
} 
?>

    <script>
      function deletePset(pid){
            $.post("deletePset.php",
            {pid: pid, fid: <?php echo $_COOKIE['user_id'] ?>
            }, function(data)
            {
                alert(data);
            });
      }
        

      (function() {
        var fixgeometry = function() {
          /* Some orientation changes leave the scroll position at something
           * that isn't 0,0. This is annoying for user experience. */
          scroll(0, 0);

          /* Calculate the geometry that our content area should take */
          var header = $(".header:visible");
          var footer = $(".footer:visible");
          var content = $(".content:visible");
          var viewport_height = $(window).height();
          
          var content_height = viewport_height - header.outerHeight() - footer.outerHeight();
          
          /* Trim margin/border/padding height */
          content_height -= (content.outerHeight() - content.height());
          content.height(content_height);
        }; /* fixgeometry */

        $(document).ready(function() {
          $(window).bind("orientationchange resize pageshow", fixgeometry);
        });
      })();
      </script> 
  </body> 
</html> 