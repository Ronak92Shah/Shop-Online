/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 16/05/2015
* Last updated: 19/05/2015
*/

// from file xhr.js
var xhr = createRequest(); // from file xhr.js

//function process the xml data
function process(){
	//Making asynchronous GET request to listing.php and sending values as parameters
	var process_generate = "process"
	xhr.open("GET","maintenance.php?id="  + Number(new Date) + "&process_generate=" + process_generate ,true);
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 		
				//display result to the staff
				document.getElementById("display1").innerHTML = xhr.responseText;
			}
		}
		xhr.send(null);
}
// function to generate report
function generateReport(){
		var process_generate = "generate";
		//Making asynchronous GET request to listing.php and sending values as parameters
	xhr.open("GET","maintenance.php?id="  + Number(new Date) + "&process_generate=" + process_generate,true);
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 		
				//display result to the staff
				document.getElementById("display2").innerHTML = xhr.responseText;
			}
		}
		xhr.send(null);
}