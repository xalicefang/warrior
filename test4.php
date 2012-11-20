<?php

      $psets = $_REQUEST['data'];
       
   
	if(sizeof($psets) == 0)
	{
		//User hasn't made any selection, display error message
		echo "You must select an item";
	}
	else
	{	
		foreach($psets as $pid)
		{
			echo $pid;
		}
	}
?>