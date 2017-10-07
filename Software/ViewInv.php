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
    
    a{
    color: #33b5e5;
    text-decoration: none !important;
    }
button{
    margin:1%;
    margin-left:225px;
    padding:1%;
    border-radius: 5px;
    background: white;
}
table {
     color:  #33b5e5;
    border-collapse: collapse;
    width: 50%;
    margin:1%;
    margin-bottom:3%;
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
    			<li style=" border-bottom: 1px solid blue;"><a href="control_panel.html" style="color: #33b5e5; font-size: 18px;">Control Panel</a></li>
    			<li><a href="inventory_manager.php" style="color: #33b5e5; font-size: 18px;">Inventory Manager</a></li>
    			<li><a href="asset_tracking.php" style="color:#33b5e5; font-size: 18px;">Asset Tracking</a></li>
    		</ul>
    </div>
  </nav>
<p style="color: #33b5e5; margin-top:1%; margin-left:1%; font-size:18px;">
Inventory Selected : <?php echo $_GET["fname"]; ?><br></p>
<?php

$wrh="";
$wrh=$_GET["fname"];
///////Creds//////
$servername = "localhost";
$username = "id3162751_saurabh";
$password = "qwerty";
$dbname = "id3162751_saurabh";
/////////////getting all elements////////

$con=mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$str1="SELECT * FROM ";
$str2=$str1.$wrh;
//echo $str2;      // This is the query 
$result = mysqli_query($con, $str1.$wrh);
if (!$result) {
    printf("Error: %s\n", mysqli_error($con));
    exit();
}


echo "<table><tr><th>Product</th><th>Quantity</th></tr>";

while($row = mysqli_fetch_array($result))
{
	echo "<tr>";
	//echo "<td>" . $row['Product_name'] . "</td>";
	
    echo "<td><a href=\"recom.php?product=".$row['Product_name']."\">".$row['Product_name']." </a></td>";
	echo "<td>" . $row['Qt'] . "</td>"; // Change link
	// <a href="https://www.youtube.com"> abc </a>
	echo "</tr>";
}

echo "</table>";
mysqli_close($con);
echo "<br>";
?>
<button type=button><a href="AddInv.php">Add Products</a></button>
</body>
</html>


