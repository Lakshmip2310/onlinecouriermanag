<?php
 
// PHP Data Objects(PDO) Sample Code:
try {

$conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:dbmsproj.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
$PackageDetailID=$_POST['PACKid'];
$Rating=$_POST['rate'];
$Comments=$_POST['comment'];

$query="insert into Feedback(packagedeatilID,rating,comments) values($PackageDetailID, $Rating, '$Comments')";

//$query_run=sqlsrv_query($conn,$query );

if (sqlsrv_query($conn,$query)) {
  echo"Thanks for your valuable feedback!!";
}
else {
  echo "Error: " . $query . "<br>" . sqlsrv_error($conn);
}


}

catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
 
 
?>
