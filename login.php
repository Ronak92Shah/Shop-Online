<?php	
		session_start();
		if((isset($_SESSION['CurrentUserId']))== true ||(isset($_SESSION['CurrentFname'])) == true || (isset($_SESSION['CurrentEmail'])) == true){
	
		$_SESSION['CurrentUserId'] = "";
		$_SESSION['CurrentFname'] = "";
		//$_SESSION['CurrentSname'] = "";
		$_SESSION['CurrentEmail'] = "";
		//$_SESSION['CurrentPassword'] = "";
}
		$xml = new DOMDocument('1.0');
		$file = '../../data/customer.xml';
		$email = trim($_GET["email"]);
		$password = trim($_GET["password"]);
		
		if(file_exists($file))
		{
			$xml->load($file);
			$exist = false;
			
			$value = $xml->getElementsByTagName("Person");
			
			foreach($value as $val)
			{
				$email_addr = $val->getElementsByTagName("EmailId"); 
				$cust_id  = $email_addr->item(0)->nodeValue;
				if(strcmp($email,$cust_id) == 0)
				{
					$pass = $val->getElementsByTagName("Password");
					$cust_pass = $pass->item(0)->nodeValue;
					if(strcmp($password,$cust_pass) == 0)
					{
						$exist = true;
						
						$_SESSION['CurrentEmail'] = $email;
						
						$customer_id = $val->getElementsByTagName("CustomerId");
						$id_value = $customer_id->item(0)->nodeValue;
						$_SESSION['CurrentUserId'] = $id_value;
						
						//$_SESSION['Password'] = $password;
						
						$first_name = $val->getElementsByTagName("FirstName");
						$fname_value = $first_name->item(0)->nodeValue;
						$_SESSION['CurrentFname'] = $fname_value;
						
					/*	$surname = $val->getElementsByTagName("Surname");
						$sname_value = $surname->item(0)->nodeValue;
						$_SESSION['CurrentSname'] = $sname_value; */
					}
					
				}
						
			}
			
				if($exist)
				{
					echo "Welcome you have successfully logged in";
				}
				else
				{
					echo "Please Check the Credentials";
				}
			
		}				
		else
		{
			echo "You haven't registered with Shop Online";
		}
?>