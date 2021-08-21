<?php
 
try {
 
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dbmsproj.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $packageid=$_POST['packageid'];

    $querypackage= "select FeedBackId,PackagedeatilId,Rating,Comments from FeedBack where PackagedeatilId = $packageid" ;
    
    $resultpackage =sqlsrv_query($conn,$querypackage);
    $hasrowspackage = sqlsrv_has_rows($resultpackage);

        
    if ($hasrowspackage == true)
    {
    	echo "<div align='center'>
                <h1>VIT Service</h1>
                <p>Package Feedback</p>
                </div>
                <br />
                <br />
                <br />
                <table border='1' align='center'><tr>
                <th>PackagedeatilId</th> 
                <th>Rating</th>
                <th>Comments</th>
                </tr>";
        
	    while($trackingrow = sqlsrv_fetch_array($resultpackage)) 
	    {
	    echo"<tr>";
	    echo"<td>".$trackingrow['PackagedeatilId'] ."</td>";
	    echo"<td>".$trackingrow['Rating'] ."</td>";
	    echo"<td>".$trackingrow['Comments'] ."</td>";
	    echo"</tr>";
	    }
	    echo"</table><br/><br/><br/>";
    	echo"<table align='center'>
                <tr>
                <td><a style='text-align: center;' href='feedbackinformation.html'>Try another Feedback</a></td>
                </tr>
                </table>";
    }
    else
    {
    	echo"<table align='center'>
                <tr>
                <td><a style='text-align: center;' href='feedbackinformation.html'>No Feedback details. Try another</a></td>
                </tr>
                </table>";
    }

    sqlsrv_close($conn);

 
}
catch (PDOException $e) {
    die(print_r($e));
}
catch (Exception $ex) {
    echo 'Message: ' .$ex->getMessage();
    die(print_r($ex));
}
 
?>