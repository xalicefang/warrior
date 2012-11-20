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
//$validated = $row["validated"];
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
        <link rel="stylesheet" href="jquery.mobile-1.2.0.css" />
	<link rel="stylesheet" href="style.css" />
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="startup.png">
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

        <style>
            #navigation-bar #navigation-list{
                top:44px;
                right:-40px;
            }

            li {
                height: 32px;
                width:200px;
                position: relative;
                cursor: pointer;
                padding: 3px 0;
                margin: -3px 0 3px 0;
            }
            
            #menu {
                width: 30px;
                height: 30px;
                float:left;
            }
            
            #people-info {
                float: left;
                margin-right: 20px;
            }
            
            #prof-pic {
                background: white;
                padding:3px;
                width:50px;
                height: 50px;
            }
        </style>
</head>  
<body> 

<div data-role="page">
    
	<div data-role="header">
            <img src="images/header.png" style="width:100%">
	</div>
	<div data-role="content">
                <p style="display:none" id="user-message"></p>
                <h2><?php echo $psetName?></h2>
                <h3>Question <?php echo $qNum ?>: <?php echo $question ?></h3>
                <input style="display: none" type="text" name="question" id="question-input">
                <a style="display:none" href="" onclick="saveQuestion();" id="save">Save</a>
                <label for="answer">Answer:</label>
                <input type="text" name="answer" id="answer">
                <input type="button" onclick="checkAnswer();" value="Check">
                <a data-role="button" data-theme="a" onclick="javascript: <?php if($qNum > 1){?> window.location.href='question.php?pid=<?php echo $pid?>&qnum=<?php echo ($qNum - 1)?>'; <?php } ?>" id="prev" >Previous</a>
                <a data-role="button" data-theme="a" onclick="javascript: window.location.href='question.php?pid=<?php echo $pid?>&qnum=<?php echo ($qNum + 1)?>';" id="next" >Next</a>
                <p id="results" style="display:none"><span id="percentage"></span> people who submitted an answer got the same answer as you.</p>
                <input type="button" id="find-people" onclick="javascript:findPeople()" value="Find a Study Partner">
                <div style="display:none" id="people-table">
                <?php
                // for current user, pull psets associated with user into array. for each pid in array, pull rows from psets
                $sql = "SELECT * FROM userpsets WHERE pid=$pid";
                $peopleTable = mysql_query($sql);
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
                    }
                } 
                ?>
                </div>
                <input type="hidden" id="this-qid" value="<?php echo $qid ?>" />
                <input type="hidden" id="this-qnum" value="<?php echo $qNum ?>" />
	</div>
    	<div data-role="footer" data-theme="a" data-id="samebar" class="nav-pset" data-position="fixed" data-tap-toggle="false">
        <div data-role="navbar" class="nav-pset" data-grid="c">
                <ul>
			<li><a data-ajax ="false" href="home.php" id="homepage" data-icon="custom">Home</a></li>
                        <li><a data-ajax ="false" href="addpset.php?reload=yes" id="addpset" data-icon="custom">Add pset</a></li>
                        <li><a data-ajax ="false" href="defeated.php"  id="defeated" data-icon="custom">Defeated psets</a></li>
                        <li><a data-ajax ="false" href="class.php" id="classes" data-icon="custom">Classes</a></li>
                </ul>

		</div><!-- /navbar -->
	</div><!-- /footer -->
</div>
<script>
    $(document).ready(function(){
        <?php if($numRows == 0){?>
            $('#user-message').html('This question doesn\'t exist yet, but you can be the first to create it!').show();
            $('#question-input').show();
            $('#save').show();
        <?php } else {?>
            $('#user-message').html('').hide();
            $('#question-input').hide();
            $('#save').hide();
        <?php }?>
    });
    
    function checkAnswer(){
        if($('#answer').val().length > 0){
            $.post("checkAnswer.php",
                {answer : $('#answer').val(), qid : $('#this-qid').val()
                }, function(data)
                {
                    $('#percentage').html(data);
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
        }
    }
    
    function findPeople(){
        if($('#people-table').is(':visible')) {
            $('#people-table').hide();
        }
        else {
            $('#people-table').fadeIn(1000);
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