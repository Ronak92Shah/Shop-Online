<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	When client place bid check and update the xml
*/
session_start();
// check id user is logged in
if((isset($_SESSION['CurrentUserId'])) == true)
	{	// get the values and store in variables
		$new_bid = trim($_GET["new_bid"]);
		$item_no = trim($_GET["item_no"]);
		// file path
		$file = '../../data/auction.xml';
		
		if(file_exists($file)){
		// load xml	
		$xml = DOMDocument::load($file);
		$value = $xml->getElementsByTagName("Item");
		//for each value Item loop through
		foreach( $value as $val) 
		{
			$itemnumber = $val->getElementsByTagName("ItemNumber"); 
			$item_number  = $itemnumber->item(0)->nodeValue;
		// check for item no
		if($item_no == $item_number){
			// get bid price
			$bidprice = $val->getElementsByTagName("StartPrice"); 
			$old_bid  = $bidprice->item(0)->nodeValue;
			
			$old_bid = (float)$old_bid;
			// compare
			if($new_bid > $old_bid){
			// Acknowledge Client
			echo "Thank you! Your bid is recorded in ShopOnline.";
				// Update xml
				$val->getElementsByTagName('StartPrice')->item(0)->nodeValue = $new_bid;
				// save xml
				$xml->save($file);
					}else{
				echo "New Bid should be Greater then old bid";
						}	
		}
		}
		}else{
			echo "Technical problem";
		}
	}else{
		echo " Please Login First";
	}
?>

