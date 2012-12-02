<?php 
include("config.php");

$pid = $_GET['pid'];
$qNum = $_GET['qnum'];
$sql = "SELECT * FROM questions WHERE pid=$pid AND questionNumber=$qNum";
$result = mysql_query($sql);
echo mysql_error();

$numRows = mysql_num_rows($result);
$row = mysql_fetch_assoc($result);
$question = $row["question"];
$qid = $row["qid"];

$psetsTable = mysql_query("SELECT * FROM psets WHERE pid=$pid");
while ($psetsRow = mysql_fetch_assoc($psetsTable)) {
    $psetName = $psetsRow["class"]." ".$psetsRow["pset"];
            
} 		
?>
<!DOCTYPE html> 
<html>

<head>
	<title>Pset Warrior | </title> 
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

        <style>

#question{
		background: #f7f7f7;
		border-radius: 10px;
	}
	
	#editable {		
		padding: 10px;		
	}
	
	#status{
		display:none; 
		margin-bottom:15px; 
		padding:5px 10px; 
		border-radius:5px;
	}
	
	.success{
		background: #B6D96C;
	}
	
	.error{
		background: #ffc5cf; 
	}
	
	#footer{
		margin-top:15px;
		text-align: center;
	}
	
	#save{	
		display: none;
		margin: 5px 10px 10px;		
		outline: none;
		cursor: pointer;	
		text-align: center;
		text-decoration: none;
		font: 12px/100% Arial, Helvetica, sans-serif;
		font-weight:700;	
		padding: 5px 10px;	
		-webkit-border-radius: 5px; 
		-moz-border-radius: 5px;
		border-radius: 5px;	
		color: #606060;
		border: solid 1px #b7b7b7;	
		background: #fff;
		background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#ededed));
		background: -moz-linear-gradient(top,  #fff,  #ededed);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#ededed');
	}	
	
	#save:hover
	{
        background: #ededed;
		background: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#dcdcdc));
		background: -moz-linear-gradient(top,  #fff,  #dcdcdc);
		filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#dcdcdc');
	}


	#questionSpace {
		background: rgba(255,255,255,.8);
	}
            
	#people-info {
                float: left;
                margin-right: 20px;
		  height: 32px;
                width:200px;
                position: relative;
                cursor: pointer;
                padding: 3px 0;
                margin: -3px 0 3px 0;
            }
            
            #prof-pic {
                background: white;
                padding:3px;
                width:50px;
                height: 50px;
            }

	#status{
    display:none;
    margin-bottom:15px;
    padding:5px 10px;
    border-radius:5px;
}
 
#save{
    display: none;
    margin: 5px 10px 10px;
}
            
        </style>

<script>
    $(document).ready(function() {
	

		$("#save").click(function (e) {			
			var content = $('#editable').html();	
				
			$.ajax({
				url: 'updateQuestion.php',
				type: 'POST',
				data: {
                content: content, qid : <?php echo $qid ?>, qnum: <?php echo $qNum ?>, pid: <?php echo $pid ?>
				},				
				success:function (data) {
							
					if (data == '1')
					{
						$("#status")
						.addClass("success")
						.html("Data saved successfully")
						.fadeIn('fast')
						.delay(3000)
						.fadeOut('slow');	
					}
					else
					{
						$("#status")
						.addClass("error")
						.html("An error occured, the data could not be saved")
						.fadeIn('fast')
						.delay(3000)
						.fadeOut('slow');	
					}
				}
			});   
			
		});
		
		$("#editable").click(function (e) {
			$("#save").show();
			e.stopPropagation();
		});
	
		$(document).click(function() {
			$("#save").hide();  
		});
	
	});

</script>

</head>  
<body> 

<div data-role="page">
        <input type="hidden" id="this-qid" value="<?php echo $qid ?>" />
        <input type="hidden" id="this-qnum" value="<?php echo $qNum ?>" />
        <input type="hidden" id="this-fid" value="<?php echo $_COOKIE['user_id'] ?>" />
	<div data-role="header">
            <img src="images/header.png" style="width:100%">
	</div>
	<div data-role="content">
		
                <a href="index.html" data-role="button" class="ui-nolink" data-theme="e"><?php echo $psetName?></a>

		<div id=questionSpace>
                <table width=100%>
                    <tr>
                        <td align="left"><img src="q_previous.png" id="prev" onclick="javascript: <?php if($qNum > 1){?> window.location.href='question.php?pid=<?php echo $pid?>&qnum=<?php echo ($qNum - 1)?>'; <?php } ?>" ></td>
                        <td align="center">
                            <h3 style="text-align:center">Question <?php echo $qNum ?>:</h3>

<div id="status"></div>
		
		<div id="question">
		
		<div id="editable" contentEditable="true">
			<?php echo $question ?>	
		</div>	
		
		<button id="save">Save</button>
		</div>
		</td>
                        <td align="right"><img src="q_next.png" id="next" onclick="javascript: window.location.href='question.php?pid=<?php echo $pid?>&qnum=<?php echo ($qNum + 1)?>';"></td>
                    </tr>
                </table>
		</div>
		
                <div id="switch-view">
                    <fieldset class="ui-grid-e">
                        <div id="options">
                            <div><a href="#" data-role="button" data-theme="c" id="check" onclick=" $('#answer-view').show(); $('#options').hide();">Check Answer</a></div>
                            <div><a href="#" data-role="button" data-theme="c" id="find" onclick=" $('#people-view').show(); $('#options').hide();">Find People</a></div>
                        </div>
                        <div id="answer-view" style="display:none">
                            <a data-role="button" class="ui-nolink" data-theme="a">Answer</a>
                            <input type="text" name="answer" id="answer">
                            <div class="ui-block-b"><a href="#" data-role="button" data-theme="c" id="check-answer" onclick="javascript: checkAnswer();">Check</a></div>
                            <div class="ui-block-a"><a href="#" data-role="button" data-theme="c" id="cancel-answer" onclick=" $('#options').show(); $('#answer-view').hide();">Back</a></div>
                            <p id="results" style="display:none"></p>
                        </div>
                        <div id="people-view" style="display:none">
                            <a data-role="button" class="ui-nolink" data-theme="a">Study Partners</a>
                                <ul id="people-table">
                                            <?php
                                            // for current user, pull psets associated with user into array. for each pid in array, pull rows from psets
                                            $sql = "SELECT * FROM userpsets WHERE pid=$pid";
                                            $peopleTable = mysql_query($sql);
                                            $numPeopleRows = mysql_num_rows($peopleTable);
                                            if($numPeopleRows == 1) { 
                                                echo "<p id=\"no-people\">Sorry, there are no other people working on this pset now. Check back a little later!</p>";
                                            }else {
                                                while ($peopleRow = mysql_fetch_array($peopleTable)){ 
                                                    if($peopleRow['fid'] != $_COOKIE['user_id']) {
                                                    ?> 
                                                    <div id="people-info">
                                                        <img id="prof-pic" src="https://graph.facebook.com/<?php echo $peopleRow['fid']?>/picture"></img>
                                                        <?php 
                                                                $uid = $peopleRow['uid'];
                                                                $sql2 = "SELECT * FROM allusers WHERE uid=$uid";
                                                                $personInfo = mysql_query($sql2);
                                                                $personRow = mysql_fetch_assoc($personInfo);
                                                                $name = $personRow['name'];
                                                        ?>
                                                        <a href="http://www.facebook.com/<?php echo $peopleRow['fid']?>"><?php echo $name ?></a>
                                                    </div>
                                                <?php 
                                                    }else{
                                                        $uid = $peopleRow['uid'];
                                                    }
                                                } 
                                            }
                                            ?>
                                </ul>
                                <div class="ui-block-a"><a href="#" data-role="button" data-theme="c" id="cancel-answer" onclick=" $('#options').show(); $('#people-view').hide();">Back</a></div>
                        </div>
                    </fieldset>
	</div>

      <div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			<li><a data-ajax ="false" href="index.php" id="homepage" data-icon="custom">Home</a></li>
                        <li><a data-ajax ="false" href="addpset.php" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a data-ajax ="false" href="defeated.php" id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a data-ajax ="false" href="class.php" id="classes" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->
    </div> 
<script>
    $(document).ready(function(){
        <?php if($numRows == 0){?>
            $('#question-input').val('Be the first to create this question here').show();
            $('#question').hide();
            $('#save').show();
            $('#switch-view').hide();
        <?php } else {?>
            $('#question-input').hide();
            $('#question').show();
            $('#save').hide();
            $('#switch-view').show();
        <?php }?>
    });
    
    function checkAnswer(){
        if($('#answer').val().length > 0){
            $.post("checkAnswer.php",
                {answer : $('#answer').val(), qid : $('#this-qid').val()
                }, function(data)
                {
                    $('#results').html(data);
                });
            if($('#results').is(':visible')) {
                $('#results').hide();
                $('#results').fadeIn(1000);
                setTimeout("$('#results').fadeOut(2000);", 3000);
            }
            else {
                $('#results').fadeIn(1000);
                setTimeout("$('#results').fadeOut(2000);", 3000);
            } 
            $.post("updateAnswer.php",
                {answer : $('#answer').val(), qid : $('#this-qid').val(), pid: <?php echo $pid ?>, uid: <?php echo $uid ?>, fid: $('#this-fid').val() 
                }, function(data){});
        }else{
            $('#results').html('Please enter a valid answer!');
                            $('#results').fadeIn(1000);
                setTimeout("$('#results').fadeOut(2000);", 3000);
        }
    }
    
    
    function saveQuestion(){
            $.post("updateQuestion.php",
            {question : $('#question-input').val(), qnum: $('#this-qnum').val(), pid: <?php echo $pid ?>
            }, function(data)
            {
                alert("You have added a new question!");
                window.location.reload();;
            });
    }
</script>
</body>
</html>