<?php

try {

        $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
        $serverName = "tcp:dbmsproj.database.windows.net,1433";
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        $packageid=$_POST['trackid'];
       
        $querypackage="Select top 1 PackagedetailId , convert (varchar,ReceivedDate,100) as ReceivedDate, DeliveredTo, convert (varchar,DeliveredDate,100) as DeliveredDate, DeliveredByEmployeeId, Status, Name   from PackageDetail
        left join Employee on Employee.EmployeeID = PackageDetail.DeliveredByEmployeeId 
        where PackageDetail.PackagedetailId = $packageid";

        $querytracking="Select PackagedetailId, LastKnonwLocation, convert (varchar,LastUpdatedDateTime, 100) as updatedDate from packagetracking where PackagedetailId = $packageid";
  
        $resultpackage=sqlsrv_query($conn,$querypackage);
        $hasrowspackage = sqlsrv_has_rows($resultpackage);
    
        if ($hasrowspackage == true)
        {
           //Header
           echo "<div align='center'>
                <h1>VIT Service</h1>
                <p>Package Tracking</p>
                </div>
                <br />
                <br />
                <br />
                <table align='center' cellpadding=3>
                    <tr>
                        <th>Package#</th>
                        <th>Received Date</th>
                        <th>Status</th>
                        <th>Delivered To</th>
                        <th>Delivered Time</th>
                        <th>Delivered By</th>
                    </tr>
                    <tr>";

            while($row = sqlsrv_fetch_array($resultpackage))
            {
                echo "<td>" . $row['PackagedetailId'] . "</td>";
                echo "<td>" . $row['ReceivedDate'] . "</td>";
                echo "<td>" . $row['Status'] . "</td>";
                echo "<td>" . $row['DeliveredTo'] . "</td>";
                echo "<td>" . $row['DeliveredDate'] . "</td>";
                echo "<td>" . $row['Name'] . "</td>";
                echo "</tr>";
            }
            echo "</table><br /><br /><br />";

            //tracking
            $resulttracking=sqlsrv_query($conn,$querytracking);
            $hasrowstracking = sqlsrv_has_rows($resulttracking);

           if ($hasrowstracking == true)
            {
                echo "<table border='1' align='center'><tr>
                <th>Last Known Location</th>
                <th>Updated Date Time</th>
                </tr>";
                
     

                while($trackingrow = sqlsrv_fetch_array($resulttracking)) 
                {
                    echo "<tr>";
                    echo "<td>" . $trackingrow['LastKnonwLocation'] . "</td>";
                    echo "<td>" . $trackingrow['updatedDate'] . "</td>";
                    echo "</tr>";
                }
                echo "</table><br/><br/><br/>";
                echo "<table align='center'>
                <tr>
                    <td><a style='text-align: center;' href='track.html'>Track Another Package</a></td>
                </tr>
                </table>";
            }
            else
            {
                echo "<table align='center'>
                <tr>
                <td><a style='text-align: center;' href='track.html'>No tracking detail. Track Another Package</a></td>
                </tr>
                </table>";
            }
    
    }
    else
    {
        echo "No Result Found. Please try with valid Tracking/Package number. <a style='text-align: left;' href='track.html'>Track Another Package</a>";

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