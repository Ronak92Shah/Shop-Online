 /**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 08/05/2015
* Last updated: 19/05/2015
*/
 
 // from file xhr.js
 var xhr = createRequest();

 //function to check values entered by client and to add in xml
function registervalidate()
{
	// get data entered by user and process
	var fname = document.getElementById("fname").value;
	var sname = document.getElementById("sname").value;
	var email = document.getElementById("email").value;
	var error = "";
	var result = true;
	// valid email format	
	var emailcheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;
	
	//check first name has only alphabets
	if(/^[A-Za-z ]+$/.test(fname) == false){
		error =error.concat("Enter Valid First Name");
		result = false;
	}
			//check surname has only alphabets
			if(/^[A-Za-z ]+$/.test(sname) == false){
				error =error.concat("Enter Valid Surname\n");
				result = false;
			}		
					//check email against the format
					if (emailcheck.test(email)== false){
						error =error.concat("Email Id is invalid \n");
						result = false;
					}
				//If problem with the data alert the Client	
				if(result == false)
				{
					document.getElementById("message").innerHTML = error;
								document.getElementById("message").innerHTML = "hi";
								sleep(1000);
			document.getElementById("message").innerHTML = "bye";
						
				}else
					
				{
		//Making asynchronous GET request to register.php and sending values as parameters
		xhr.open("GET","register.php?id=" + Number(new Date) + "&fname=" + fname + "&sname=" + sname + "&email=" + email, true);
		
		xhr.onreadystatechange = function(){

				if (xhr.readyState == 4 && xhr.status == 200)
				{	
					//display php response in div
					document.getElementById("message").innerHTML = xhr.responseText;
					
				if(xhr.responseText == "You have been successfully registered with ShopOnline")
				{
					//alert to client
					alert(xhr.responseText);
				//navigate to listing page
				window.location.href = "listing.html";	
				}
			}
		}
		xhr.send(null);
	}	
}
