<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	To load select category of day, hour, minute
*/
		$day_hour_min = trim($_GET["day_hour_min"]);
		//check if variable equals to day
		if($day_hour_min == 'day'){
			$x = 100;
			for($i=99; $i>=0; $i--){
				$x .= ",";
				$x .= $i;
			}	
		}
		//check if variable equals to hour
			if($day_hour_min == 'hour'){
			$x = 23;
			for($i=22; $i>=0; $i--){
				$x .= ",";
				$x .= $i;
			}	
		}
		//check if variable equals to minute
			if($day_hour_min == 'minute'){
			$x = 59;
			for($i=58; $i>=0; $i--){
				$x .= ",";
				$x .= $i;
			}	
		}
		//echo to js
		echo "$x";
?>