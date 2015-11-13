/**
* Author: Ronak Shah
* Purpose: Java Script for Assignment-2
* Created: 13/05/2015
* Last updated: 19/05/2015
*/

// from xhr.js
var xhr = createRequest();
// function called when client clicks other in listing.html		
function addCategory(element){
		// get the option selected by client
		var option_value = element.value;
		//check whether option is other
		if(option_value == "other" )
		{	
		//prompt to get user response
		var category = prompt("Please enter the category");
		if (category != null) 
		{	
			var cat = document.getElementById("category");
			//add new option tag
			var option = document.createElement("option");
			option.text = category;
			//add new category
			cat.add(option,cat[0]);
			document.getElementById("category").value = category;
		}
		else
		{
			document.getElementById("listingMsg").innerHTML = "Category not added";
		}
		}
}
//function used to validate client response and send data to php
function listingValidate(){
	//get all data by id from html
	var name = document.getElementById("name").value;	
	var category = document.getElementById("category").value;	
	var describe = document.getElementById("describe").value;

	var start_price = document.getElementById("start_price").value;
	var decimal_price = document.getElementById("decimal_price").value;
	var reserve_price = document.getElementById("reserve_price").value;
	var decimal_reserve = document.getElementById("decimal_reserve").value;
	var buy_price = document.getElementById("buy_price").value;
	var decimal_buy = document.getElementById("decimal_buy").value;

	var day = document.getElementById("days").value;
	var hour = d ==ocument.getElementById("hours").value;
	var min = document.getElementById("mins").value;
	
	//con-cat all prices
	var start = start_price.concat(".",decimal_price);
	var reserve = reserve_price.concat(".",decimal_reserve);
	var buy = buy_price.concat(".",decimal_buy);
	
	var letter = /^[A-Za-z]+$/;
	var number = /^[0-9]+$/;
	var result = true;
	var error = "";
		
		if(!(name.match(letter))){
			error =error.concat("Item name should have alphabets!\n");
			result = false;
		}
		
		if(describe == ""){
			error =error.concat("Description is necessary!\n");
			result = false;
		}
		
		//check start price is numeric
		if((!(start_price.match(number))) && (!(decimal_price.match(number)))){
			error =error.concat("Start Price should be Numeric !\n");
			result = false;
		}
		//check reserve price is numeric
		if((!(reserve_price.match(number))) && (!(decimal_reserve.match(number)))){
			error =error.concat("Reserve Price should be Numeric!\n");
			result = false;
		}
		//check buy price is numeric
		if((!(buy_price.match(number))) && (!(decimal_buy.match(number)))){
			error =error.concat("Buy it now Price should be Numeric!\n");
			result = false;
		}
		//check start price is less then reserve price	
		if(start_price >= reserve_price){
			error =error.concat("Start price should be less than reserve price!\n");
			result = false;
		}
		//check reserve price is less then buy price
		if(reserve_price >= buy_price){
			error =error.concat("Reserve price should be less then Buy It Now price!\n");
			result = false;
		}
		//check day entered is numeric
		if(!(day.match(number))){
			error =error.concat("Day should be Numeric!\n");
			result = false;
		}
		//check hour entered is numeric
		if(!(hour.match(number))){
			error =error.concat("Hour should be Numeric!\n");
			result = false;
		}
		//check minute entered is numeric
		if(!(min.match(number))){
			error =error.concat("Min should be Numeric!\n");
			result = false;
		}
		
		
			//if any error report to client and don't proceed 
			if (result == false){
				document.getElementById("listingMsg").innerHTML = error;
			}else{
			
			//Making asynchronous GET request to listing.php and sending values as parameters 
		xhr.open("GET","listing.php?id=" + Number(new Date) + "&name=" + name + "&category=" + category + "&describe=" + describe + "&start_price=" + start_price + "&decimal_price="+ decimal_price + "&decimal_reserve=" + decimal_reserve + "&decimal_buy" + decimal_buy +"&reserve_price=" + reserve_price + "&buy_price="+ buy_price + "&day=" + day + "&hour=" + hour + "&min=" + min, true);
		
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{
			//Display response message from php in div
				document.getElementById("listingMsg").innerHTML = xhr.responseText;
			}
		}
		xhr.send(null);	}
	}

	//function to add day
function addDay(e){
	e.onclick = "";
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

//function to add hour
function addHour(e){
	e.onclick = "";
			var day_hour_min = "hour";
			//Making asynchronous GET request to day_hour_min.php and sending values as parameters 
		xhr.open("GET","day_hour_min.php?id=" + Number(new Date)  + "&day_hour_min=" + day_hour_min, true);
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{
			//store response message from php
			var hour =  xhr.responseText;
			//split hours 
			var hoursplit = hour.split(",");
			var x = document.getElementById("hours");
			//loop through all the element
			for ( var i=0; i < hoursplit.length;i++ ){
			var option = document.createElement("option");
			option.text = hoursplit[i];
			//add hour
			x.add(option,x[0]);
			//document.getElementById("hours").value = hoursplit[i];
			}
			}
		}
		xhr.send(null);	
}

//function to add minute
function addMin(e){
	e.onclick = "";
			var x = document.getElementById("mins");
			x.remove(x.selectedIndex);
	
	
		var day_hour_min = "minute";
		//Making asynchronous GET request to day_hour_min.php and sending values as parameters 
		xhr.open("GET","day_hour_min.php?id=" + Number(new Date)  + "&day_hour_min=" + day_hour_min, true);
		
			xhr.onreadystatechange = function()
		{	
			if (xhr.readyState == 4 && xhr.status == 200)
			{
			//store response message from php
			var min =  xhr.responseText;
			//split minute
			var minsplit = min.split(",");
			var x = document.getElementById("mins");
			//loop through all the minute
			for ( var i=0; i < minsplit.length;i++ ){
			var option = document.createElement("option");
			option.text = minsplit[i];
			//add minute
			x.add(option,x[0]);
			//document.getElementById("mins").value = minsplit[i];
			}
			}
		}
		xhr.send(null);	
}

	
	
	