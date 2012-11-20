<!DOCTYPE html> 
<html>

<head>
	<title>Pset Warrior | Undefeated Psets</title> 

</head> 



  <body> 
  



<form>
<input type = "checkbox" name = "psets[]" id = "orange">ORANGE
<input type = "checkbox" name = "psets[]" id = "apple">APPLE
<input type = "checkbox" name = "psets[]" id = "banana">BANANA
<input type = "checkbox" name = "psets[]" id = "pear">PEAR
<input type = "checkbox" name = "psets[]" id = "gauva">GUAVA
<input type = "submit" type="button" value="confirm" onclick="submit_form();" />
</form>
	
<script>
         function submit_form(){
               var data = { 'psets[]' : []};
$(":checked").each(function() {
  data['psets[]'].push($(this).val());
});
$.post("test4.php", data);
   {
			document.write("lalala");
                    window.location.reload();
                });
                          }

  </body> 
</html> 
