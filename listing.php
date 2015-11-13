<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	Here auction xml file is created or appended data to file
*/
session_start();
	//check user has logged in
	if((isset($_SESSION['CurrentUserId'])) == true)
	{
	$xml = new DOMDocument('1.0');
	//header('Content-Type: text/xml');
	$xml->preserveWhiteSpace = false;
	//$xml->formatOutput = true;
	//	file path
	$file = '../../data/auction.xml';
	// to avoid the notice in php
	error_reporting(E_ALL ^ E_NOTICE);
	// get all the data and store it in variable
	$category = trim($_GET["category"]);
	$name = trim($_GET["name"]);
	$description = trim($_GET["describe"]);
	$start_price = trim($_GET["start_price"]);
	$reserve_price = trim($_GET["reserve_price"]);
	$buy_price = trim($_GET["buy_price"]);
	$decimal_price = trim($_GET["decimal_price"]);
	$decimal_reserve = trim($_GET["decimal_reserve"]);
	$decimal_buy = trim($_GET["decimal_buy"]);
	$day = trim($_GET["day"]);
	$hour = trim($_GET["hour"]);
	$min = trim($_GET["min"]);
	
	//append all prices
	$start = $start_price.".".$decimal_price;
	$reserve = $reserve_price.".".$decimal_reserve;
	$buy = $buy_price.".".$decimal_buy;
	
	//get customer id
	$customer_id = $_SESSION['CurrentUserId'];
	// default time zone to enter current date and time
	date_default_timezone_set('Australia/Melbourne');
	$current_date = date('Y/m/d');
	$current_time = date('H:i:s');
	//generate random item no	
	$item_no = rand();
		
	if(file_exists($file)){
		// load xml file
			$xml->load($file);
			$root = $xml->documentElement;
			$xml->appendChild($root);

		//create nodes and append child
		
		$no = $xml->createElement("ItemNumber");
		$notext = $xml->createTextNode($item_no);
		$no->appendChild($notext);
		
		$item_name = $xml->createElement("ItemName");
		$nametext = $xml->createTextNode($name);
		$item_name->appendChild($nametext);
		
		$cat = $xml->createElement("Category");
		$cattext = $xml->createTextNode($category);
		$cat->appendChild($cattext);
		
		$des = $xml->createElement("Description");
		$destext = $xml->createTextNode($description);
		$des->appendChild($destext);
		
		$stapr = $xml->createElement("StartPrice");
		$staprtext = $xml->createTextNode($start);
		$stapr->appendChild($staprtext);
		
		$respr = $xml->createElement("ReservePrice");
		$resprtext = $xml->createTextNode($reserve);
		$respr->appendChild($resprtext);
		
		$buypr = $xml->createElement("BuyItNowPrice");
		$buyprtext = $xml->createTextNode($buy);
		$buypr->appendChild($buyprtext);
		
		$days = $xml->createElement("Day");
		$daystext = $xml->createTextNode($day);
		$days->appendChild($daystext);
		
		$hours = $xml->createElement("Hour");
		$hourstext = $xml->createTextNode($hour);
		$hours->appendChild($hourstext);
		
		$mins = $xml->createElement("Minute");
		$minstext = $xml->createTextNode($min);
		$mins->appendChild($minstext);
		
		$cust = $xml->createElement("CustomerId");
		$custtext = $xml->createTextNode($customer_id);
		$cust->appendChild($custtext);
		
		$currdate = $xml->createElement("StartDate");
		$currdatetext = $xml->createTextNode($current_date);
		$currdate->appendChild($currdatetext);
		
		$currtime = $xml->createElement("StartTime");
		$currtimetext = $xml->createTextNode($current_time);
		$currtime->appendChild($currtimetext);
		
		$status = $xml->createElement("Status");
		$state = $xml->createTextNode("in_progress");
		$status->appendChild($state);
					
		$item = $xml->createElement("Item");
		// append all the child
		$item->appendChild($no);
		$item->appendChild($item_name);
		$item->appendChild($cat);
		$item->appendChild($des);
		$item->appendChild($stapr);
		$item->appendChild($respr);
		$item->appendChild($buypr);
		$item->appendChild($days);
		$item->appendChild($hours);
		$item->appendChild($mins);
		$item->appendChild($cust);
		$item->appendChild($currdate);
		$item->appendChild($currtime);
		$item->appendChild($status);
		$root->appendChild($item);
		
		$xml->formatOutput = true;
		// save the xml 
		$xml->saveXML() ;
		$xml->save($file) or die("Error");
		//acknowledge the client
		echo "Thank You! Your item has been listed in ShopOnline. The item number is $item_no, and the bidding starts now: $current_time on $current_date .";
		
		}else{
		
		// create root element
		$root = $xml->createElement("Listing");
		$xml->appendChild($root);

		//create nodes and append child		
		$no = $xml->createElement("ItemNumber");
		$notext = $xml->createTextNode($item_no);
		$no->appendChild($notext);
	
		$item_name = $xml->createElement("ItemName");
		$nametext = $xml->createTextNode($name);
		$item_name->appendChild($nametext);
		
		$cat = $xml->createElement("Category");
		$cattext = $xml->createTextNode($category);
		$cat->appendChild($cattext);
		
		$des = $xml->createElement("Description");
		$destext = $xml->createTextNode($description);
		$des->appendChild($destext);
		
		$stapr = $xml->createElement("StartPrice");
		$staprtext = $xml->createTextNode($start);
		$stapr->appendChild($staprtext);
		
		$respr = $xml->createElement("ReservePrice");
		$resprtext = $xml->createTextNode($reserve);
		$respr->appendChild($resprtext);
		
		$buypr = $xml->createElement("BuyItNowPrice");
		$buyprtext = $xml->createTextNode($buy);
		$buypr->appendChild($buyprtext);
		
		$days = $xml->createElement("Day");
		$daystext = $xml->createTextNode($day);
		$days->appendChild($daystext);
		
		$hours = $xml->createElement("Hour");
		$hourstext = $xml->createTextNode($hour);
		$hours->appendChild($hourstext);
		
		$mins = $xml->createElement("Minute");
		$minstext = $xml->createTextNode($min);
		$mins->appendChild($minstext);
		
		$cust = $xml->createElement("CustomerId");
		$custtext = $xml->createTextNode($customer_id);
		$cust->appendChild($custtext);
		
		$currdate = $xml->createElement("StartDate");
		$currdatetext = $xml->createTextNode($current_date);
		$currdate->appendChild($currdatetext);
		
		$currtime = $xml->createElement("StartTime");
		$currtimetext = $xml->createTextNode($current_time);
		$currtime->appendChild($currtimetext);
		
		$status = $xml->createElement("Status");
		$state = $xml->createTextNode("in_progress");
		$status->appendChild($state);
				
		$item = $xml->createElement("Item");
		//append everything
		$item->appendChild($no);
		$item->appendChild($item_name);
		$item->appendChild($cat);
		$item->appendChild($des);
		$item->appendChild($stapr);
		$item->appendChild($respr);
		$item->appendChild($buypr);
		$item->appendChild($days);
		$item->appendChild($hours);
		$item->appendChild($mins);
		$item->appendChild($cust);
		$item->appendChild($currdate);
		$item->appendChild($currtime);
		$item->appendChild($status);
		$root->appendChild($item);
		
		$xml->formatOutput = true;
		// Save xml
		$xml->saveXML() ;
		$xml->save($file) or die("Error");
		// acknowledge the Client
		echo "Thank You! Your item has been listed in ShopOnline. The item number is $item_no, and the bidding starts now: $current_time on $current_date .";
}
	}else{
		
		echo "Sorry you will have to login first";
	}
	
	?>