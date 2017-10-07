
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Inventory Manager</title>
	<meta charset="utf-8">
	<meta lang="en">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body{
      background: white;
    }
    a{
    color: #33b5e5;
    text-decoration: none !important;
    }
    a:hover{
    color: black !important;  
    }
   .abc {
       margin: 15px;
       margin-left: 275px;
       margin-top: 175px;
       padding: 15px;
       border: 1px solid #33b5e5;
       width: 225px;
       font-size: 24px;
       float: left;
       align-content: center;
    }
    .website-name{
    margin-top: 2%;
    }
    .error {
        color: #FF0000;
    }
    
.container1 {
  width: 50%;
  background: white;
  margin: 10px auto;
  position: relative;
  text-align:center;
  font-size: 16px;
    }
table {
     color:  #33b5e5;
    border-collapse: collapse;
    width: 50%;
}
th, td {
     color:  #33b5e5;
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}
tr:hover{background-color:#f5f5f5}
</style>
</head>
<body>
   <div class="container-fluid">
   <h2 class="website-name" style="color: #33b5e5;"><a href="index.html">IOT Mumbai</a></h2>
   </div>
   <nav class="navbar navbar-default" style="background-color:#eee; width: 100%;">
    <div class="collapse navbar-collapse col-sm-12" id="Target">
             <ul class="nav navbar-nav">
    			<li><a href="control_panel.html" style="color: #33b5e5; font-size: 18px;">Control Panel</a></li>
    			<li style=" border-bottom: 1px solid blue;"><a href="inventory_manager.php" style="color: #33b5e5; font-size: 18px;">Inventory Manager</a></li>
    			<li><a href="asset_tracking.php" style="color:#33b5e5; font-size: 18px;">Asset Tracking</a></li>
    		</ul>
    </div>
  </nav>
<br><br>
<div style=" margin-left:1%; margin-top:-2%;">
<div style="color:#33b5e5; margin-bottom:-2%; font-size:20px;">Add new warehouse:</div>
<br><br>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<input type = "text" name = "newWa" style="width:170px; border-radius:5px; height:35px;" placeholder="Warehouse-Name">
<button type = "submit" value = "Submit" style="border:0px; width:75px; height:35px; margin-left:1%; border-radius:5px;"><b>ADD</b></button>
</form>
</div>
</body>
</html>
<?php
$bool = false;

$fname =""; 
$fname = $_POST["newWa"];
if($fname!="")
{
$bool = true;
}
/// Add Warehouse 

////////////////////////////////////// initialise sql variables/////////////////////////////////
$servername = "localhost";
$username = "id3162751_saurabh";
$password = "qwerty";
$dbname = "id3162751_saurabh";

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
//$conn->close();
echo "<br>";
echo "Total Warehouses: ";
echo $last_id;
echo "<br>";

$last_id++;
if($bool==true)
{
echo "<br>Entered Warehouse:".$fname;
//$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO warehouse_entry (wrh) VALUES ('$fname');";


if ($conn->query($sql) === TRUE) {
   // echo "<br> <br>New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
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
// echo "Connection Made";
// sql to create teble
	 $str1="CREATE TABLE ";
     $str2=$fname;
     $str3="( ID int NOT NULL AUTO_INCREMENT, Product_name varchar(255) NOT NULL, Qt int, PRIMARY KEY (ID));";
     $sql=$str1.$str2.$str3;
     echo "<br>";
     //echo $sql;

if ($conn->query($sql) === TRUE) {
   // echo "Table created successfully";
} else {
    //echo "Error creating table: " . $conn->error;
}

//$conn->close();

///Display All the values you have added

//$con=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($conn,"SELECT * FROM warehouse_entry");
echo "<br>";
echo "<table><tr><th>Serial Number</th><th>Warehouses</th></tr>";
//echo " <table><tr><th>Serial Number</th><th>Product Name</th></tr>";

while($row = mysqli_fetch_array($result))
{   
	echo "<tr>";
	echo "<td>" . $row['id'] . "</td>";
	echo "<td><a href=\"ViewInv.php?fname=".$row['wrh']."\">" . $row['wrh'] . "</a></td>";
	// <a href="https://www.youtube.com"> abc </a>
	echo "</tr>";
}

echo "</table>";
mysqli_close($conn);
?>
