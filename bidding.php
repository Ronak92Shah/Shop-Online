<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	Here data from xml is processed and send to be displayed on html page.
*/
session_start();
//check if user has logged in
if((isset($_SESSION['CurrentUserId'])) == true)
	{	//xml file path
		$file = '../../data/auction.xml';
		
		if(file_exists($file)){
			//load file
		$xml = DOMDocument::load($file);
			
		$value = $xml->getElementsByTagName("Item");
		//create variable to store all the data
		$displayString = "";
		//check for each and every item
		foreach( $value as $val) 
		{	//create form
			$displayString .= "<form>";
			$displayString .= "<fieldset>";
			
			//Get all the elements to be displayed and append it to displayString  
			$itemnumber = $val->getElementsByTagName("ItemNumber"); 
			$item_no  = $itemnumber->item(0)->nodeValue;
				$displayString .= "<p>Item No: ".$item_no. "</p>" ;
			
			$itemname = $val->getElementsByTagName("ItemName"); 
			$item_name  = $itemname->item(0)->nodeValue;
				$displayString .= "Item Name: ".$item_name. "\n" ;
						
			$category = $val->getElementsByTagName("Category"); 
			$cat  = $category->item(0)->nodeValue;
				$displayString .= "<p>Category: ".$cat. "</p>" ;
			
			$description = $val->getElementsByTagName("Description"); 
			$desc  = $description->item(0)->nodeValue;
				$displayString .= "<p>Description: ".$desc. "</p>" ;
			
			$buyitnowprice = $val->getElementsByTagName("BuyItNowPrice"); 
			$buy_it_now_price  = $buyitnowprice->item(0)->nodeValue;
				$displayString .= "<p>Buy It Now Price: ".$buy_it_now_price. "</p>" ;
			
			$currentprice = $val->getElementsByTagName("StartPrice"); 
			$current_price  = $currentprice->item(0)->nodeValue;;
				$displayString .= "<p>Bid Price: ".$current_price. "</p>" ;
				
			$startdate = $val->getElementsByTagName("StartDate"); 
			$start_date  = $startdate->item(0)->nodeValue;				
				
			$starttime = $val->getElementsByTagName("StartTime"); 
			$start_time  = $starttime->item(0)->nodeValue;				
						
			$days = $val->getElementsByTagName("Day"); 
			$day  = $days->item(0)->nodeValue;
		
			$hours = $val->getElementsByTagName("Hour"); 
			$hour  = $hours->item(0)->nodeValue;				
				
			$minutes = $val->getElementsByTagName("Minute"); 
			$minute  = $minutes->item(0)->nodeValue;				
			
			$stat = $val->getElementsByTagName("Status"); 
			$status  = $stat->item(0)->nodeValue;
			
			// Add day hour and minutes by converting it into seconds
			$duration_start = ($day * 24 * 60 * 60) + ($hour * 60 * 60) + ($minute * 60 );
				//Append date and time
				$dt = $start_date. ' ' .$start_time;
			
				$datetime = strtotime($dt);
				$time = time() - $datetime; // to get the time since that moment
						//define an array
						$tokens = array (
							31536000 => 'year',
							2592000 => 'month',
							604800 => 'week',
							86400 => 'day',
							3600 => 'hour',
							60 => 'minute',
							1 => 'second'
						);
						
						$duration_curr = "";
						//get current time in seconds
						foreach ($tokens as $unit => $text) {
							if ($time < $unit) continue;
							$numberOfUnits = floor($time / $unit);
							$duration_curr =  $numberOfUnits;
						}
						
						//get difference in time
						$duration = $duration_start - $duration_curr;
						
						//condition to check s item already sold
						if ($status == "sold")
						{
							$displayString .= "<p>Item is Sold</p>";
							
						}else{
						// condition check if item date is already expired
						if($duration <= 0)
						{
						$displayString .= "<p>Sale Period Expired</p>";
						} 
						else{	//Call function and append to string
							$string = secondsToTime($duration);
							$displayString .= "<p>$string remaining.</p>";
				//display buttons
				$displayString .= "<input type = 'button' value = 'Place Bid' id = 'bid' onClick = 'placebid( $item_no )' />" ; //call function on-click
				
				$displayString .= "<input type = 'button' value = 'Buy It Now' id = 'buy' onClick = 'buyitnow( $item_no )' />" ; //call function on-click
					}
						}
				$displayString .= "</fieldset>";
				$displayString .= "</form>";
				$displayString .= "<br\> <br\>";
					}
				//echo the string
				echo "$displayString";
		
				}else{
			
				echo "No items to display!";		
		}
	}else
	{
		echo "Please Login !";
	}
	//function converts seconds into day hour minute and seconds formate
	function secondsToTime($seconds) {
    $dtF = new DateTime("@0");
    $dtT = new DateTime("@$seconds");
    return $dtF->diff($dtT)->format('%a days, %h hours, %i minutes and %s seconds'); //formats to be converted
}
?>