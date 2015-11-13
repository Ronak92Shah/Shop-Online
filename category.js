/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 14/05/2015
* Last updated: 19/05/2015
*/
	// from xhr.js
	var xhr = createRequest();
	
	//function called to get all category from xml on fly
	function init(){
	//Making asynchronous GET request to category.php and sending values as parameters 
	xhr.open("GET","category.php?id="  + Number(new Date),true);
			xhr.onreadystatechange = function()
			{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 
			// getting response from php
			var category = JSON.parse(xhr.responseText);
			var cat = document.getElementById("category");
			for(i=0; i<category.length; i++){
				
			var option = document.createElement("option");
			option.text = category[i];
			cat.appendChild(option);
			}
		
			}
											}
			xhr.send(null);			
}
//onload add category
window.onload = init;