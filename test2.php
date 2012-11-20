<?php
	if(sizeof($_POST['psets']) == 0)
	{
		//User hasn't made any selection, display error message
		echo "You must select an item";
	}
	else
	{	
		foreach($_POST['psets'] as $pid)
		{
			echo $pid;
		}
	}
?>