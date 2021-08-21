<?php
    // Starting session
    session_start();
 
// PHP Data Objects(PDO) Sample Code:
try {
    $uname="";
    $password="";
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
    $serverName = "tcp:dbmsproj.database.windows.net,1433";
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    $uname=$_POST['uname'];
    $password=$_POST['password'];
    
    if(empty($uname)){array_push($errors,"id is required");}
    if(empty($password)){array_push($errors,"Password is required");}
    $query="select 1 from elogin where employeeid='$uname' and password='$password'";

    $query_run=sqlsrv_query($conn,$query );
    $rows = sqlsrv_has_rows( $query_run );

    
    if ($rows == false)
    {
      $_SESSION["employeeid"] = "";
      $_SESSION["title"] = "";
      echo " Please enter a valid username or password";
      echo"<a href='employeelogin.html'>Please click here to login again</a>";
     }
    else
    {
        //Check if user is manager
        $managerquery="Select 1 from vManager where EmployeeId ='$uname' ";
        $_SESSION["employeeid"] = $uname;
        $managerquery_run=sqlsrv_query($conn,$managerquery);
        $managerrows = sqlsrv_has_rows( $managerquery_run);
        if ($managerrows == true)
        {
            $_SESSION["title"] = "manager";
            header('Location:managerview.html');
            die();
        }
        else
        {
            $_SESSION["title"] = "employee";
            header('Location:employeeview.html');
            die();
        }
    }    
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
 

?>