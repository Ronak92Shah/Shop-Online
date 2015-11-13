<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	Here when Staff maintain the page
*/
session_start();

// check if staff has logged in
if((isset($_SESSION['CurrentUserId'])) == true)
	{	
		$process_generate = trim($_GET["process_generate"]);
		
		if($process_generate == "process"){
		// file path
		$file = '../../data/auction.xml';
		
		if(file_exists($file)){
		//load xml	
		$xml = DOMDocument::load($file);
		$value = $xml->getElementsByTagName("Item");
		// for each value of Item
		foreach( $value as $val) 
		{	// Store the required value in variable
			$currentprice = $val->getElementsByTagName("StartPrice"); 
			$current_price  = $currentprice->item(0)->nodeValue;
		
			$reserveprice = $val->getElementsByTagName("ReservePrice"); 
			$reserve_price  = $reserveprice->item(0)->nodeValue;
						
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
			
			// check the status
			if($status == "in_progress")
			{
				// convert in seconds
				$duration_start = ($day * 24 * 60 * 60) + ($hour * 60 * 60) + ($minute * 60 );
				// append time
				$dt = $start_date. ' ' .$start_time;
			
				$datetime = strtotime($dt);
				$time = time() - $datetime; // to get the time since that moment

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
						// get time in seconds
						foreach ($tokens as $unit => $text) {
							if ($time < $unit) continue;
							$numberOfUnits = floor($time / $unit);
							$duration_curr =  $numberOfUnits;
						}
					// get differencebetween the times
					$duration = $duration_start - $duration_curr;
							//check the time expired or not
							if($duration <= 0){
								
								$current_price = $current_price;
								$reserve_price = $reserve_price;
								//echo "$current_price \n";
								
								// compare price if its sold or not
								if($current_price >= $reserve_price){
								// update the xml
							
								$val->getElementsByTagName('Status')->item(0)->nodeValue = "sold";
								$xml->save($file);
								
							}else{
								// update the xml
								$val->getElementsByTagName('Status')->item(0)->nodeValue = "failed";
								$xml->save($file);
								}
								}		
					}
					
				}		// Acknowledge Staff
						echo "Process is successfully completed";
		}else{
			echo "Technical problem";	
		}	
	}
			if($process_generate == "generate"){
				
						// file path
				$file = '../../data/auction.xml';
				
				if(file_exists($file)){
				//load xml	
				$xml = DOMDocument::load($file);
				$value = $xml->getElementsByTagName("Item");
				
				$displayString ="";
				
				$displayString .= "<table border='1'>";
				$displayString .= "<tr>";
				$displayString .= "<td>";
				$displayString .= "ItemNumber";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "ItemName";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "CustomerId";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "StartPrice";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "ReservePrice";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "BuyItNowPrice";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "Days_Hours_Minutes";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "StartDate";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "StartTime";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "Status";
				$displayString .= "</td>";
				$displayString .= "</tr>";
				
				$soldrevenue = 0;
				$failedrevenue = 0;
				$soldnumber = 0;
				$failednumber = 0;
				
				foreach( $value as $val) 
		{	
			//Get all the elements to be displayed and append it to displayString  
			$itemnumber = $val->getElementsByTagName("ItemNumber"); 
			$item_no  = $itemnumber->item(0)->nodeValue;
				
			$itemname = $val->getElementsByTagName("ItemName"); 
			$item_name  = $itemname->item(0)->nodeValue;
						
			$category = $val->getElementsByTagName("Category"); 
			$cat  = $category->item(0)->nodeValue;
				
			$customerid = $val->getElementsByTagName("CustomerId"); 
			$cust  = $customerid->item(0)->nodeValue;
				
			$buyitnowprice = $val->getElementsByTagName("BuyItNowPrice"); 
			$buy_it_now_price  = $buyitnowprice->item(0)->nodeValue;
				
			$currentprice = $val->getElementsByTagName("StartPrice"); 
			$current_price  = $currentprice->item(0)->nodeValue;;
				
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
			
			$reserveprice = $val->getElementsByTagName("ReservePrice"); 
			$reserve_price  = $reserveprice->item(0)->nodeValue;

				if($status == "sold"){
					
				$displayString .= "<tr>";
				$displayString .= "<td>";
				$displayString .= "$item_no";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$item_name";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$cust";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$current_price";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$reserve_price";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$buy_it_now_price";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$day days, $hour hours and $minute minutes";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$start_date";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$start_time";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$status";
				$displayString .= "</td>";
				$displayString .= "</tr>";		
				
				$soldrevenue += ($current_price *0.03);
				$soldnumber += 1;
				
				}
				
				if($status == "failed"){
					
				$displayString .= "<tr>";
				$displayString .= "<td>";
				$displayString .= "$item_no";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$item_name";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$cust";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$current_price";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$reserve_price";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$buy_it_now_price";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$day days, $hour hours and $minute minutes";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$start_date";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$start_time";
				$displayString .= "</td>";
				$displayString .= "<td>";
				$displayString .= "$status";
				$displayString .= "</td>";
				$displayString .= "</tr>";	
				
				$failedrevenue += ($reserve_price * 0.01);
				$failednumber += 1;
				}
				
				
			}
			$displayString .= "</table>";
			$totalrevenue = $soldrevenue + $failedrevenue;
			$displayString .= "Total Number of sold item: $soldnumber \n";
			$displayString .= "Total Number of failed item: $failednumber \n";
			$displayString .= "Total revenue generated: $totalrevenue";
			
			echo"$displayString";
			
	}
			}
	}
	else{
		echo " Please Login First";
	}
?>