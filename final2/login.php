<?php
	// if logged in, redirect to home
	if(isset($_COOKIE['user_id'])) {
		header( 'Location: index' ) ;
	}
?>

<html>
<head>
    <script src="//cdn.optimizely.com/js/139725978.js"></script>
    <title>PSet Warriors</title>
    <meta name="viewport" content="initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no"/>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 

    <link rel="stylesheet" href="jquery.mobile-1.2.0.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="apple-touch-icon" href="appicon.png" />

    <script src="jquery-1.8.2.min.js"></script>
    <script src="jquery.mobile-1.2.0.js"></script>
    <style>
    body.connected #login { display: none; }
    body.connected #logout { display: block; }
    body.connected #enter { display: block; }
    body.not_connected #login { display: block; }
    body.not_connected #logout { display: none; }
    body.not_connected #enter { display: none; }

.ui-mobile [data-role=content], .ui-mobile [data-role=dialog], .ui-page {
background-image: url(images/pencilfirstpage.png), url(images/firstbackground.png);
background-size:100%, 100% 100%;
background-repeat: no-repeat;
background-position: bottom right;
}

.index-button {
width:60%;
margin: 15;
}

    </style>

<img src="images/namefirstpage.png" width="100%" style="margin-bottom:10%">

</head>
<body>
    <div id="fb-root"></div>
	<p></p>
    <div class="index-button">
        <p><a href="" data-role="button" data-theme="e" onClick="loginUser();">Login</a></p>

	<p><a href="about.php" data-role="button" data-theme="e">About</a></p>

</div>
    <!-- 
	<div id="logout">
        <p><button  onClick="FB.logout(); $.post('updateUserInfo.php', {user_id: '', user_name: ''}, function(data){window.location.reload()});">Logout</button></p>
    </div>
    <div id="enter">
	<p><button onClick="window.location.href='home.php';">Enter PSet Warriors</button></p>
    </div> 
	-->


    <div id="user-info"></div>
    <script>
    function loginUser() {    
        FB.login(function(response) { }, {scope:'email'});    
    }

    window.fbAsyncInit = function() {

        FB.init({
        appId      : '378954368857140', // App ID
        channelUrl : '//WWW.YOUR_DOMAIN.COM/channel.html', // Channel File
        status     : true, // check login status
        cookie     : true, // enable cookies to allow the server to access the session
        xfbml      : true  // parse XFBML
        });

        FB.Event.subscribe('auth.statusChange', handleStatusChange);
    };

    function handleStatusChange(response) {
        document.body.className = response.authResponse ? 'connected' : 'not_connected';

        if (response.authResponse) {
            console.log(response);
            updateUserInfo(response);
        }
    };

    // Load the SDK Asynchronously
    (function(d){
        var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        ref.parentNode.insertBefore(js, ref);
    }(document));

    function updateUserInfo(response) {
        FB.api('/me', function(response) {   
            $.post('updateUserInfo.php', {user_id: response.id, user_name: response.name}, function(data){window.location.href="index.php"});
            
            //document.getElementById('user-info').innerHTML = '<img src="https://graph.facebook.com/' + response.id + '/picture">' + response.name;
        });
    }
    </script>
</body>
</html>