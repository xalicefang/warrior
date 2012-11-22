<!DOCTYPE html> 
<html>

<head>
	<title>Pset Warrior | Undefeated Psets</title> 

</head> 



  <body> 
  


<script>
$("input[type=checkbox]").click(function () {
   $.post('my_ajax_receiver.php', 'val=' + $(this).val(), function (response) {
      alert(response);
   });
});
<script>
  </body> 
</html> 
