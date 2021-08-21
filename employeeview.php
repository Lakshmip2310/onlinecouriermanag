<html>
<head>
<title>ourcourierservice.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
body{background-image:url("login.jpg");}
</style>
</head>
</html>
<?php
if(isset($_POST['search']))
{
 $eid=$_POST['eid'];
 
 try {
    $conn = new PDO("sqlsrv:server = tcp:dbmsproj.database.windows.net,1433; Database = smproj", "system", "VIT1234$");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
 
// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "system", "pwd" => "VIT1234$", "Database" => "smproj", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:dbmsproj.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
 
$query="SELECT `rname`, `raddress`, `pid`, `rmobile`, `eid` FROM `receiver` where eid =$eid ";
 
 if(sqlsrv_num_rows($result)>0)
 {
 while($row=sqlsrv_fetch_array($result))
 {
 
 $rname=$row['rname'];
 $raddress=$row['raddress'];
 $pid=$row['pid'];
 $rmobile=$row['rmobile'];
 $eid=$row['eid'];
 }
 }
 else{
 
 $rname=$row['rname'];
 $raddress=$row['raddress'];
 $pid=$row['pid'];
 $rmobile=$row['rmobile'];
 $eid=$row['eid'];
 
 }
 
 sqlsrv_free_result($result);
 
}
else
{
 $rname="";
 $raddress="";
 $pid="";
 $rmobile="";
 $eid="";
 
}
?>
<html>
<head>
<title> your duty</title>
</head>
<form action="employeeview.php" method="post">
<h1 align="center"> HURRY UP </h1><br>
 eid:<input type="text" name="eid" value="<?php echo $eid;?>"><br><br>
 rname:<input type="text" name="rname" value="<?php echo $rname;?>"><br><br>
 raddress:<input type="text" name="raddress" rows="5" value="<?php echo
$raddress;?>"><br><br>
 pid:<input type="text" name="pid" value="<?php echo $pid;?>"><br><br>
 rmobile:<input type="text" name="rmobile" value="<?php echo $rmobile;?>"><br><br>
 <input type="submit" name="search" value="track" >
</form>
<a href="employeeafterlogin2.html" target="_parent" style="color:red;font-size:140%;">return</a>
</body>
</html>