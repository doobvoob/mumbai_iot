<html>
<head>
<title>Tab Example</title>
	<meta charset="utf-8">
	<meta lang="en">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body{
      background: white;
        color:  #33b5e5;
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
    form{
        margin-left:50px;
    }

    button{
        padding: 5px;
    }
    a{
        text-decoration: none;
        color:  #33b5e5;
    }
</style>
</head>
<body>
   <div class="container-fluid">
   <h2 class="website-name" style="color: #33b5e5;"><a href = "index.html">IOT Mumbai</a></h2>
   </div>
   <nav class="navbar navbar-default" style="background-color:#eee; width: 100%;">
    <div class="collapse navbar-collapse col-sm-12" id="Target">
             <ul class="nav navbar-nav">
    			<li><a href="control_panel.html" style="color: #33b5e5; font-size: 18px;">Control Panel</a></li>
    			<li><a href="inventory_manager.php" style="color: #33b5e5; font-size: 18px;">Inventory Manager</a></li>
    			<li style=" border-bottom: 1px solid blue;"><a href="asset_tracking.php" style="color:#33b5e5; font-size: 18px;">Asset Tracking</a></li>
    		</ul>
    </div>
  </nav>

<body>

<meta charset="ISO-8859-1">
<title>View Inventory</title>
<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>">
<br>
<p>
Enter Product :
<input type = "text" name = "prod"><br/><br>
Enter Quantity :
<input type = "number" name = "qt"><br/>
<?php
///////Creds//////
$servername = "localhost";
$username = "id3162751_saurabh";
$password = "qwerty";
$dbname = "id3162751_saurabh";
/////////Variables///////////////////
$prod="";
$qt=0;

$last_id=0;
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
//echo "Last entry was <br>";
//echo $last_id;

/////////////////////////////////Radio Head////////////////////////////////////

echo "<br>";
echo "Select Warehouse:";
echo "<br>";
echo "<br>";
while($last_id>0)
{
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
 if ($conn->connect_error) 
 {
    die("Connection failed: " . $conn->connect_error);
 } 

 $sql = "SELECT * FROM warehouse_entry";
 $result = $conn->query($sql);
 if ($result->num_rows > 0) 
 {
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$last_id)
      {
        //echo "ID: " . $row["id"]. " Data Retreived: " . $row["se1"]. "," . $row["se2"]. "," . $row["se3"]. "," . $row["se4"]. "," . $row["se5"]. "<br>";
        
        $lsp=$row["wrh"];
        echo "<input type=\"radio\" name=\"wrh\" value=\"";
        echo $lsp;
        echo"\">";
        echo $lsp;
        echo "<br>";
        echo "<br>";
        }
    }
 }
	else 
	{
    	echo "0 results";
	}

	$last_id--;
  $conn->close();
}
?>



<br> <input type = "submit" value = "Submit">
</p>
</form>
</body>
</html>
<?php
$prod=$_POST["prod"];
$qt=$_POST["qt"];
$fname=$_POST["wrh"];
echo "The entry is ";
echo $qt;
echo " ";
echo $prod;
echo "  (s) for ";
echo $fname; 
echo "<br>";
///////////////////////////////////update///////////

//echo "<br>Entering ".$qt." ".$prod." (s)";
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$str1="INSERT INTO ";
$str2=" (Product_name, Qt) VALUES ( ";
$sql="";
$str3=" );";
$sql=$str1.$fname.$str2."'".$prod."'"." , ".$qt.$str3;
echo $sql;

if ($conn->query($sql) === TRUE) {
    echo "<br> <br>New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>