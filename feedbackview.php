<html>
<head>
<title>ourcourierservice.com</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css">
body{background-image:url("login.jpg");}
table {
 border-collapse:collapse;
 width:100%;
 color: #d96459;
 font-family: monospace;
 font-size: 25px;
 text-align: left;
}
th{
 background-color: #d96459;
 color:white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
<body>
<table>
 <tr>
 <th>package id</th>
 <th>Rating by customer</th>
 </tr>
 <?php
 
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
$query="SELECT `pid`, `rating` FROM `feedback`";
$result=sqlsrv_query($query);
 #if(sqlsrv_num_rows($result)>0)
 #{
 while($row=sqlsrv_fetch_assoc($result))
 {
 $pid=$row['pid'];
 $rating=$row['rating'];
 echo"<tr><td>" . $row["pid"] ."</td><td>".$row["rating"]."</td></tr>";
 }
 echo "</table>";
 }
 #else{
 #echo "o result";
 #}
 ?>
</table>
<br><br><br>
<a href="managerafterlogin2.html" target="_parent" style="color:red;font-size:140%;">return</a>
</body>
</html>