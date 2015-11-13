/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 14/05/2015
* Last updated: 19/05/2015
*/
	// from xhr.js
	var xhr = createRequest();
	


function addDay(){
			var day_hour_min = "day";
			//Making asynchronous GET request to day_hour_min.php and sending values as parameters z
		xhr.open("GET","day_hour_min.php?id=" + Number(new Date) + "&day_hour_min=" + day_hour_min, true);
		
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{
			//store response message from php
			var day =  xhr.responseText;
			//split Day
			var daysplit = day.split(",");
			var x = document.getElementById("days");
			//loop through all day
			for ( var i=0; i < daysplit.length;i++ ){
			var option = document.createElement("option");
			option.text = daysplit[i];
			//add all split
			x.add(option,x[0]);
			//document.getElementById("days").value = daysplit[i];
			}
			}
		}
		xhr.send(null);	
		
	}

	//onload add category
window.onload = addDay;