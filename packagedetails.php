<?php
 
// PHP Data Objects(PDO) Sample Code:
try {
    session_start();
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dbmsproj.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $CustomerID =$_POST['CustomerID'];
    $Receiveraddress =$_POST['ReceiverAddress'];
    $Receivercity =$_POST['ReceiverCity'];
    $ReceiverState =$_POST['ReceiverState'];
    $ReceiverPincode =$_POST['ReceiverPincode'];
    $ReceiverMob =$_POST['ReceiverMobileNumber'];
    $Comments =$_POST['Comments'];
    $Cost =$_POST['Cost'];
    $Status = $_POST['status'];
    $ReceiverName = $_POST['ReceiverName'];
    
    $query="insert into PackageDetail(CustomrID, ReceiverAddress, ReceiverCity, ReceiverState, ReceiverPinCode, ReceiverMobile, Comments, Cost, Status,ReceiverName) values ($CustomerID, '$Receiveraddress', '$Receivercity', '$ReceiverState', $ReceiverPincode, '$ReceiverMob', '$Comments', $Cost, '$Status','$ReceiverName')";

     if (sqlsrv_query($conn,$query ))
     {
            //Get Last ID
			$queryselect="Select max(packagedetailid) as packagedetailid  from packagedetail";
  
        	$resultSelect=sqlsrv_query($conn,$queryselect);
        	$hasrowselect = sqlsrv_has_rows($resultSelect);
    		$last_id =0;
        	if ($hasrowselect == true)
        	{
		  		while($row = sqlsrv_fetch_array($resultSelect))
            	{
                	$last_id = $row['packagedetailid'];
         		}
        
				echo "<br /><br /><table align='center'>
                <tr>
                    <td>New record created successfully. New Package ID is:  . $last_id</td>
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
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
 
 
?>