/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 10/05/2015
* Last updated: 19/05/2015
*/

// from file xhr.js
var xhr = createRequest();

// function to get login details and send for validation
function loginvalidate(){
	
	//get credentials added by client
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	//Making asynchronous GET request to login.php and sending values as parameters
	xhr.open("GET" , "login.php?id=" + Number(new Date) + "&email=" + email + "&password=" + password , true);
	
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			//Display response message from php in div
			document.getElementById("msg").innerHTML = xhr.responseText;
			
			if(xhr.responseText == "Welcome you have successfully logged in"){
				//alert the response
				alert(xhr.responseText);
				//navigate to listing page
				window.location.href = "listing.html";
			}
		}
		
	}
	xhr.send(null);
}