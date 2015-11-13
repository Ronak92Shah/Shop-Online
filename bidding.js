/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 16/05/2015
* Last updated: 19/05/2015
*/

// from file xhr.js
var xhr = createRequest();
setInterval('bidding()',1000);

//Function used to display items
function bidding(){
	//Making asynchronous GET request to bidding.php and sending values as parameters 
	xhr.open("GET","bidding.php?id="  + Number(new Date),true);
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 		
			//Display response message from php in div
				document.getElementById("display").innerHTML = xhr.responseText;
			}
		}
		xhr.send(null);
}

//Function used to get New Bid from Client
function placebid( item_no ){
		//Ask client to enter new_bid
		var new_bid = prompt("Please enter new bid");
		if (new_bid != null){
		//Making asynchronous GET request to placebid.php and sending values as parameters 
		xhr.open("GET","placebid.php?id="  + Number(new Date) + "&item_no=" + item_no + "&new_bid=" + new_bid,true);
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 		
				//alert php response
				alert(xhr.responseText);
			}
		}
		}else{	
			alert("Bid not Acceptable! It should be greater then current bid price");
		}
		xhr.send(null);
}

//Function is called client buys the item
function buyitnow( item_no ){
		//Making asynchronous GET request to butitnow.php and sending values as parameters 
		xhr.open("GET","buyitnow.php?id="  + Number(new Date) + "&item_no=" + item_no,true);
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{ 	//alert php response
				alert(xhr.responseText);
			}
		}
		xhr.send(null);
}
//bidding is called on-load
window.onload = bidding;