<?php
/*	Name-Ronak Shah 
	Student ID- 4949773
	Assignment - 2
	Here client register to ShopOnline and either XML file is created and data is stored or data is appended to file.
*/
session_start();
//Check if user is already logged in. If yes then first empty the session variable. 
if((isset($_SESSION['CurrentUserId']))== true ||(isset($_SESSION['CurrentFname'])) == true || (isset($_SESSION['CurrentEmail'])) == true){
	
		$_SESSION['CurrentUserId'] = "";
		$_SESSION['CurrentFname'] = "";
		//$_SESSION['CurrentSname'] = "";
		$_SESSION['CurrentEmail'] = "";
		//$_SESSION['CurrentPassword'] = "";
}
	$xml = new DOMDocument('1.0');
	header('Content-Type: text/xml');
	$xml->preserveWhiteSpace = false;
	//$xml->formatOutput = true;
	$display = "";
	//file path
	$file = '../../data/customer.xml';
	// get user data and store in variable
	$fname = trim($_GET["fname"]);
	$sname = trim($_GET["sname"]);
	$email = trim($_GET["email"]);
	// create random password and customer id
	$pass = rand();
	$customer_id = rand();
	
	if(file_exists($file)){
		// load xml
		$xml->load($file);
		$exist = false;
		$value = $xml->getElementsByTagName("Person");
		// check for each Person
		foreach( $value as $val) 
		{	// get email  
			$email_addr = $val->getElementsByTagName("EmailId"); 
			$cust_id  = $email_addr->item(0)->nodeValue;
			if(strcmp($email,$cust_id) == 0)//compare the email if it exist or not 
			{
				$exist=true;
			}
		}
		if ($exist == true){
			//
			echo "UYou are already member of ShopOnline";
		}
		else{
			//open root
			$root = $xml->documentElement;
			$xml->appendChild($root);
		
		//create nodes and append data
		
		$id = $xml->createElement("CustomerId");
		$idtext = $xml->createTextNode($customer_id);
		$id->appendChild($idtext);
		
		$f_name = $xml->createElement("FirstName");
		$fnametext = $xml->createTextNode($fname);
		$f_name->appendChild($fnametext);
		
		$s_name = $xml->createElement("Surname");
		$snametext = $xml->createTextNode($sname);
		$s_name->appendChild($snametext);
		
		$email_id = $xml->createElement("EmailId");
		$emailtext = $xml->createTextNode($email);
		$email_id->appendChild($emailtext);
		
		$pwd = $xml->createElement("Password");
		$passtext = $xml->createTextNode($pass);
		$pwd->appendChild($passtext);
						
		$Person = $xml->createElement("Person");
		// append all data to Person
		$Person->appendChild($id);
		$Person->appendChild($f_name);
		$Person->appendChild($s_name);
		$Person->appendChild($email_id);
		$Person->appendChild($pwd);
		$root->appendChild($Person);
		
		$xml->formatOutput = true;
		// save xml
		$xml->saveXML() ;
		$xml->save($file) or die("Error");
		
		// Set session variable 
		
		$_SESSION['CurrentUserId'] = $customer_id;
		$_SESSION['CurrentFname'] = $fname;
		//$_SESSION['CurrentSname'] = $sname;
		$_SESSION['CurrentEmail'] = $email;
		//$_SESSION['CurrentPassword'] = $pass;
				
				// Acknowledge Client
				echo "You have been successfully registered with ShopOnline";
				//send email to the new user regarding they are already an member
				$to = $email;
				$subject = "Welcome to ShopOnline!";
				$message = "Dear $fname , welcome to use ShopOnline! Your customer id is $customer_id and the password is $pass ." ;
				$headers = "From registration@shoponline.com.au";
				//send mail
				mail($to, $subject, $message, $headers, "-r 4949773@student.swin.edu.au");		
}		
	}
	else{		
		// create root element
		$root = $xml->createElement("Customer");
		$xml->appendChild($root);
		
		//create nodes and append data
		
		$id = $xml->createElement("CustomerId");
		$idtext = $xml->createTextNode($customer_id);
		$id->appendChild($idtext);
		
		$f_name = $xml->createElement("FirstName");
		$fnametext = $xml->createTextNode($fname);
		$f_name->appendChild($fnametext);
		
		$s_name = $xml->createElement("Surname");
		$snametext = $xml->createTextNode($sname);
		$s_name->appendChild($snametext);
		
		$email_id = $xml->createElement("EmailId");
		$emailtext = $xml->createTextNode($email);
		$email_id->appendChild($emailtext);
		
		$pwd = $xml->createElement("Password");
		$passtext = $xml->createTextNode($pass);
		$pwd->appendChild($passtext);
				
				
		$Person = $xml->createElement("Person");
		// append all data to Person
		$Person->appendChild($id);
		$Person->appendChild($f_name);
		$Person->appendChild($s_name);
		$Person->appendChild($email_id);
		$Person->appendChild($pwd);
		$root->appendChild($Person);
		
		$xml->formatOutput = true;
		// save xml
		$xml->saveXML() ;
		$xml->save($file) or die("Error");
		//set session variable
		$_SESSION['CurrentUserId'] = $customer_id;
		$_SESSION['CurrentFname'] = $fname;
		//$_SESSION['CurrentSname'] = $sname;
		$_SESSION['CurrentEmail'] = $email;
		//$_SESSION['CurrentPassword'] = $pass;
				
				//Acknowledge Client
				echo "You have been successfully registered with ShopOnline";
				// Send mail to the client
				$to = $email;
				$subject = "Welcome to ShopOnline!";
				$message = "Dear $fname , welcome to use ShopOnline! Your customer id is $customer_id and the password is $pass ." ;
				$headers = "From registration@shoponline.com.au";
				// send mail
				mail($to, $subject, $message, $headers, "-r 4949773@student.swin.edu.au");
}		
?>