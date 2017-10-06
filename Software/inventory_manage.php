
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory</title>
</head>
<body>

<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<br>
<p>
Enter new Warehouse :
<input type = "text" name = "newWa"><br/>
<br><br><br> <input type = "submit" value = "Submit">
</p>
</form>
</body>
</html>
<?php
$bool = true;
$fname =""; 
$fname = $_POST["newWa"]; 
echo "Hey, ".$fname;
if($fname=="")
{
	$bool=false;
	echo "Entery something dude";
}


/// Add Warehouse 

////////////////////////////////////// initialise sql variables/////////////////////////////////
$servername = "localhost";
$username = "admin";
$password = "Jayant*1";
$dbname = "Codechef";

////////////////////////// getting last ID////////////////////////////////////////
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
$sql= "SELECT MAX(id) FROM warehouse_entry";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
$conn->close();
echo "<br>";
echo "Last entry was <br>";
echo $last_id;

$last_id++;
if($bool==true)
{,
echo "<br>Entering ".$fname;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO warehouse_entry (wrh) VALUES ('$fname');";

if ($conn->query($sql) === TRUE) {
    echo "<br> <br>New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// $conn->close();
// }
//// Create new table 
// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
} 
echo "Connection Made";
// sql to create teble
	 $str1="CREATE TABLE ";
     $str2=$fname;
     $str3="( ID int NOT NULL AUTO_INCREMENT, Product_name varchar(255) NOT NULL, Qt int, PRIMARY KEY (ID));";
     $sql=$str1.$str2.$str3;
     echo "<br>";
     echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();

///Display All the values you have added

$con=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM warehouse_entry");

echo "<table border='1'><tr><th>Serial Number</th><th>Warehouses</th></tr>";

while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td><a href=\"https://www.youtube.com\">" . $row['wrh'] . "</a></td>";
	// <a href="https://www.youtube.com"> abc </a>
	echo "</tr>";
}

echo "</table>";
mysqli_close($con);

?>
