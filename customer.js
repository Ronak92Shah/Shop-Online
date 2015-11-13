var xhr = createRequest(); // from file xhr.js

function registervalidate()
{
	var fname = document.getElementById("fname").value;
	var sname = document.getElementById("sname").value;
	var email = document.getElementById("email").value;
	var error = "";
	var result = true; 
	var emailcheck = /^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;
	
	if(/^[A-Za-z ]+$/.test(fname) == false){
		error += "Enter Valid First Name";
		result = false;
	}
			if(/^[A-Za-z ]+$/.test(sname) == false){
				error += "Enter Valid Surname \n";
				result = false;
			}
					if (emailcheck.test(email)== false){
						error += "Email Id is invalid \n";
						result = false;
					}
	if(result == false)
	{
		alert(error);
			
	}else
	{
		xhr.open("GET","register.php?id=" + Number(new Date) + "&fname=" + fname + "&sname=" + sname + "&email=" + email, true);
		
		xhr.onreadystatechange = function(){
			
	if (xhr.readyState==4 && xhr.status==200)
			{	
				document.getElementById("message").innerHTML = responseText;				
				if(xhr.responseText == "You have been successfully registered with ShopOnline")
				{
				window.location.href = "listing.html";	
				}
			}	
		}	
		xhr.send(null);
	}	
}

/*
function loginvalidate(){
	
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	
	xhr.open("GET" , "login.php?id=" + Number(new Date) + "&email=" + email + "&password=" + password , true);
	
	xhr.onreadystatechange = function()
	{
		if(xhr.readyState == 4 && xhr.status == 200)
		{
			alert(xhr.responseText);
			
			if(xhr.responseText == "Welcome"){
				
				window.location.href = "listing.html";
			}
		}
		
	}
	xhr.send(null);
}

*/