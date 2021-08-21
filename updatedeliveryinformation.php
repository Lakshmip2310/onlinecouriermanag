<?php
 
// PHP Data Objects(PDO) Sample Code:
try {
    
    session_start();
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dbmsproj.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $EmployeeID =$_POST['EmployeeID'];
    $DeliveredTO =$_POST['DeliverTo'];
    $PackageID=$_POST['packageid'];
   
    
    $query="update PackageDetail set DeliveredByEmployeeId = $EmployeeID , DeliveredTo='$DeliveredTO', Status = 'Delivered', DeliveredDate = GETDATE() where PackageDetailId=$PackageID";
    //echo $query;
    if (sqlsrv_query($conn,$query )) {
      	echo "<br /><br /><table align='center'>
                <tr>
                    <td>Successfully updated delivery details</td>
                </tr>
                </table>";
    }
    else {
      echo "Error: " . $query . "<br>" . sqlsrv_error($conn);
    }
    sqlsrv_close($conn);

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
   
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
catch (Exception $ex) {
    echo 'Message: ' .$ex->getMessage();
    die(print_r($ex));
}
 
 
?>