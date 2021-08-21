<?php
 
try {
		session_start(); 
		$conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
		$serverName = "tcp:dbmsproj.database.windows.net,1433";
		$conn = sqlsrv_connect($serverName, $connectionInfo);
		$nonmanagerdetails=$_POST['employeeid'];

		$loginEmployeeId = $_SESSION["employeeid"];
		$querypackage="Select  EmployeeID, name, convert (varchar,DOB,100) as DOB, Gender, Salary, Mobile, Address  from vnonmanager where manageremployeeid = $loginEmployeeId";       

		$resultpackage=sqlsrv_query($conn,$querypackage);
		$hasrowspackage = sqlsrv_has_rows($resultpackage);

		if ($hasrowspackage == true)
		{      
			echo"<div align='center'>
                <h1>VIT Courier Services</h1>
                <p>Employee View</p>
                </div>
                <br />
                <br />
                <br /><table border='1' align='center'><tr>
			<th>Employee ID</th>
			<th>Name</th>
			<th>DOB</th>
			<th>Gender</th>
			<th>Salary</th>
			<th>Mobile</th>
			<th>Addres</th>
			</tr>";


			while($trackingrow = sqlsrv_fetch_array($resultpackage)) 
			{
				echo"<tr>";
				echo"<td>".$trackingrow['EmployeeID'] ."</td>";
				echo"<td>".$trackingrow['Name'] ."</td>";
				echo"<td>".$trackingrow['DOB'] ."</td>";
				echo"<td>".$trackingrow['Gender'] ."</td>";
				echo"<td>".$trackingrow['Salary'] ."</td>";
				echo"<td>".$trackingrow['Mobile'] ."</td>";
				echo"<td>".$trackingrow['Address'] ."</td>";
				echo"</tr>";
			 }
			 
			echo"</table><br/><br/><br/>";
			echo"<table align='center'>
			<tr>
			<td><a style='text-align: center;' href='managerview.html'>Manager Portal</a></td>
			</tr>
			</table>";
		}
		else
		{
			echo"<table align='center'>
			<tr>
			<td><a style='text-align: center;' href='managerview.html'>No Employee detail. Back to Manager Portal</a></td>
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