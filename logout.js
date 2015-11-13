/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 15/05/2015
* Last updated: 19/05/2015
*/

// from file xhr.js
var xhr = createRequest(); // from file xhr.js		
//function end session
function logout(){
	//Making asynchronous GET request to logout.php and sending values as parameters
	xhr.open("GET","logout.php?id=" + Number(new Date), true);
		
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{
					window.location.href = "login.html";
			//Display response message from php in div					
					alert(xhr.responseText);
			}
		}
		xhr.send(null);
}