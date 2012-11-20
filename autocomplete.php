
<!DOCTYPE html>
<html>
<head>
	<title>jQM Autocomplete</title>
	<meta content="initial-scale=1, maximum-scale=1, user-scalable=0" name="viewport" />
	<meta name="viewport" content="width=device-width" />
	<meta name="apple-mobile-web-app-capable" content="yes" />

	<link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
	<link rel="stylesheet" href="styles.css" />

	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
	<script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
	<script src="jqm.autoComplete-1.4.3-min.js"></script>
	<script src="code.js"></script>
</head>

<body>

	<div data-role="page" id="mainPage">

		<div data-role="header">
			<h1>jQM Autocomplete</h1>
			<select id="examples" data-mini="true" data-native-menu="false">
				<option value="index.html">Remote Array</option>
				<option value="complex.html">Remote Object</option>
				<option value="array.html" selected="true">Local Array</option>
				<option value="local_complex.html">Local Object</option>
				<option value="callback.html">Callback</option>
				<option value="callback-plus.html">Callback Plus</option>
				<option value="search.html">Using Search Input</option>
			</select>
		</div>

		<div data-role="content">

			<h3>Local Simple Data</h3>

			<p>
				In this example autoComplete uses a local array comprised of strings. This also shows an example of the matchFromStart property set to false.
			</p>

			<pre>
[
    "autoComplete",
    "ColdFusion",
    "jQuery Mobile"
];
			</pre>

			<p>
				<input type="text" id="searchField" placeholder="Categories">
				<ul id="suggestions" data-role="listview" data-inset="true"></ul>
			</p>

			<p>
				<a href="https://github.com/commadelimited/autoComplete.js" data-role="button">Download the code</a>
			</p>

		</div>

	</div>

	<script>

		$("#mainPage").bind("pageshow", function(e) {

			var availableTags = ['24', 'about me', 'Adobe', 'AIR', 'AJAX', 'Android', 'Apple', 'Aptana', 'autoComplete', 'Bflex-BFusion', 'Blackberry Playbook', 'Blog Housekeeping', 'c25k', 'CFConversations', 'CFinNC', 'cfObjective', 'CFUnited', 'Clients', 'ColdFusion', 'ColdFusion Builder', 'Cooking and Recipes', 'CSS', 'D2WC', 'dribbbleCFC', 'Eclipse', 'Ember.js', 'Emile', 'ExtendScript', 'Family', 'Fireworks', 'Flash', 'Flex', 'foursquareCFC', 'From a former designer', 'Giveaways', 'Goba', 'Hardware', 'Illustrator', 'instagramCFC', 'iPhone', 'JavaScript', 'job openings', 'jobs', 'jQuery', 'jQuery Mobile', 'jQuery Mobile Boilerplate', 'kloutCFC', 'Lost', 'MAX', 'mobile', 'Movies and Reviews', 'ncfug', 'openExchangeRateCFC', 'Palm Pre', 'pastebinCFC', 'PhoneGap', 'Photoshop', 'picasaCFC', 'podcast', 'presentations', 'projects', 'reading', 'regular expressions', 'RIAUnleashed', 'Shrinkadoo', 'shrinkURL', 'SQL', 'swipeButton', 'technology', 'textCounter', 'the internet', 'ThemeRoller', 'tumblrCFC', 'Undelivrnator', 'video', 'Wallpapers', 'web development', 'Whiskerino', 'XCode and Interface Builder', 'XUIJS'];

			$("#searchField").autocomplete({
				target: $('#suggestions'),
				source: availableTags,
				link: 'target.html?term=',
				minLength: 1,
				matchFromStart: false
			});
		});
	</script>

</body>
</html>

