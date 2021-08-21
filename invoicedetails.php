<?php
 
try {
    #$uname="";
    #$password="";
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dbmsproj.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $invoiceid=$_POST['invoiceid'];
    $invoicedate=$_POST['invoicedate'];
    $totalcost = $_POST['totalcost'];
    #session_start();
    #if(empty($uname)){array_push($errors,"id is required");}
    #if(empty($password)){array_push($errors,"Password is required");}
    $query="insert into invoice (invoiceid, invoicedate, totalcost) values ($invoiceid, $invoicedate, $totalcost);
    $query_run=FALSE;
    $query_run=sqlsrv_query($conn,$query);
    echo $query;
    echo $query_run;
}
catch (PDOException $e) {
    die(print_r($e));
}
 
?>