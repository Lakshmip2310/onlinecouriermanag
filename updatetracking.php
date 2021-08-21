<?php
 
// PHP Data Objects(PDO) Sample Code:
try {
    
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dbmsproj.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $PackageDetailID =$_POST['PACKid'];
    $lastknownLocation =$_POST['comment'];
   
    
    $query="insert into PackageTracking(PackageDetailID,LastknonwLocation) values ($PackageDetailID, '$lastknownLocation')";

    
    if (sqlsrv_query($conn,$query )) {
       echo "New record entered!";
    }
    else {
      echo "Error: " . $query . "<br>" . sqlsrv_error($conn);
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