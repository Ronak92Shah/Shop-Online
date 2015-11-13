<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	Here when Clients buys the item, we update the xml
*/
session_start();
//check if user has logged in
if((isset($_SESSION['CurrentUserId'])) == true)
	{	//get data
		$item_no = trim($_GET["item_no"]);
		//xml file path
		$file = '../../data/auction.xml';
		
		if(file_exists($file)){
		//load xml	
		$xml = DOMDocument::load($file);
		$value = $xml->getElementsByTagName("Item");
		// for each Item 
		foreach( $value as $val) 
		{	
			$itemnumber = $val->getElementsByTagName("ItemNumber"); 
			$item_number  = $itemnumber->item(0)->nodeValue;
		//compare item no
		if($item_no == $item_number){
			//get equivalent buty it now price	
			$buyitnowprice = $val->getElementsByTagName("BuyItNowPrice"); 
			$buy_it_now_price  = $buyitnowprice->item(0)->nodeValue;
			
				echo "Thank you for purchasing this item.";
				// update the xml
				$val->getElementsByTagName('StartPrice')->item(0)->nodeValue = $buy_it_now_price;
				$val->getElementsByTagName('Status')->item(0)->nodeValue = "sold";
				// save xml
				$xml->save($file);
					}	
		}		
		}else{	
			echo "Technical problem";
		}
	}else{
		echo " Please Login First";
	}
?>