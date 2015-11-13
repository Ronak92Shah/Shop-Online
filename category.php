<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	Here when Clients buys the item, we update the xml
*/
$xml = new DOMDocument('1.0');
// xml file path 
$file = '../../data/auction.xml';

		if(file_exists($file)){
		// load file
		$xml->load($file);
		$value = $xml->getElementsByTagName("Item");
		// for each item value get category
		$str = "";
		$catarray = array();
		foreach($value as $val)
		{
			$category = $val->getElementsByTagName("Category");
			$cat =$category->item(0)->nodeValue;
			
			if(!(in_array($cat, $catarray))	)	{
				
				$catarray[] = $cat;
				
			}
		}
		
		
		// echo it to the js
			echo json_encode($catarray);
		}
?>