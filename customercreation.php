<?php

 
// PHP Data Objects(PDO) Sample Code:
try {
		session_start();
		$conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
		$serverName = "tcp:dbmsproj.database.windows.net,1433";
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		$name=$_POST['name'];
		$address=$_POST['address'];
		$city=$_POST['city'];
		$state=$_POST['state'];
		$pincode=$_POST['pincode'];
		$mobilenumber=$_POST['mobilenumber'];
		    
		if(empty($name)){array_push($errors,"Name is required");}
		if(empty($address)){array_push($errors,"Address is required");}
		if(empty($city)){array_push($errors,"City is required");}
		if(empty($state)){array_push($errors,"State is required");}
		if(empty($pincode)){array_push($errors,"Pincode is required");}
		if(empty($mobilenumber)){array_push($errors,"Mobile Number is required");}

		$query="insert into customer(customername,customeraddress,city,state,pincode,mobile) values('$name', '$address', '$city', '$state', $pincode, '$mobilenumber')";
		//echo $query;
		if (sqlsrv_query($conn, $query)) 
		{
			//Get Last ID
			$queryselect="Select max(customerId) as customerId  from Customer";
  
        	$resultSelect=sqlsrv_query($conn,$queryselect);
        	$hasrowselect = sqlsrv_has_rows($resultSelect);
    		$last_id =0;
        	if ($hasrowselect == true)
        	{
		  		while($row = sqlsrv_fetch_array($resultSelect))
            	{
                	$last_id = $row['customerId'];
         		}
        
				echo "<br /><br /><table align='center'>
                <tr>
                    <td>New record created successfully. New Customer ID is:  . $last_id</td>
                </tr>
                </table>";
			}

			//echo $_SESSION["title"];
			if ($_SESSION["title"] == "manager")
        	{
        		echo "<br /><br /><table align='center'>
                <tr>
                    <td><a style='text-align: center;' href='managerview.html'>Go back to Manager portal</a></td>
                </tr>
                </table>";
  	        }
    	    else
        	{
  	    		echo "<br /><br /><table align='center'>
                <tr>
                    <td><a style='text-align: center;' href='employeeview.html'>Go back to Employee portal</a></td>
                </tr>
                </table>";
  	        }
		} 
		else {
		    echo "Error: " . $query . "<br>" . sqlsrv_error($conn);
		}		 
				
		sqlsrv_close($conn);

	}
catch (PDOException $e) {
    echo 'Message: ' .$e->getMessage();
    //die(print_r($e));
}
catch (Exception $ex) {
    echo 'Message: ' .$ex->getMessage();
    //die(print_r($ex));
}

 
?>