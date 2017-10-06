<?php
////////////////////////////////////// initialise sql variables/////////////////////////////////
$servername = "localhost";
$username = "id3162751_saurabh";
$password = "qwerty";
$dbname = "id3162751_saurabh";

///////////////////////////////////////variables //////////////

$id=0;
$s1=0; $ls1=0; $switchno=0;
$s2=0; $ls2=0; $stateno=0;
$s3=0; $ls3=0;
$s4=0; $ls4=0;
$s5=0; $ls5=0;

$switch=0;
$state=0;
$last_id=0;
$id=0;
$update=false; //to check if get request has been made
  
?>  
<!DOCTYPE HTML>  
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

.block {
  background: #eee;
    border-radius: 15px;
  color:  #33b5e5;
  height: 100px;
  width: 100px;
  display:inline-block;
  margin: 10px;
    width: 40%;
}
    button{
        padding: 5px;
    }
    a{
        text-decoration: none;
        color:  #33b5e5;
    }
    p{
        margin: 5%;
    }
</style>
</head>
<body>
   <div class="container-fluid">
   <h2 class="website-name" style="color: #33b5e5;">IOT Mumbai</h2>
   </div>
   <nav class="navbar navbar-default" style="background-color:#eee; width: 100%;">
    <div class="collapse navbar-collapse col-sm-12" id="Target">
             <ul class="nav navbar-nav">
    			<li><a href="#" style="color: #33b5e5; font-size: 18px;">Inventory Monitoring</a></li>
    			<li><a href="#" style="color: #33b5e5; font-size: 18px;">Inventory Tracking</a></li>
    			<li style=" border-bottom: 1px solid blue;"><a href="#" style="color:#33b5e5; font-size: 18px;">Warehouse Monitoring</a></li>
    			<li><a href="#" style="color: #33b5e5; font-size: 18px;">Recommendation</a></li>
    		</ul>
    </div>
  </nav>
<form>
<div class="container container1">
   
     <div class="block">
<p>Switch 1</p>
<button> <a href="control.php?switch=1&state=1">Turn on</a></button>
<button style="margin-left: 10%;"> <a href="control.php?switch=1&state=0">Turn off</a></button>
</div>
     <div class="block">
<p>Switch 2</p>
<button> <a href="control.php?switch=2&state=1">Turn on </a></button>
<button style="margin-left: 10%;"> <a href="control.php?switch=2&state=0">Turn off</a></button>
</div>
     <div class="block">
<p>Switch 3</p>
<button><a href="control.php?switch=3&state=1">Turn on</a></button>
<button style="margin-left: 10%;"> <a href="control.php?switch=3&state=0">Turn off</a></button>
</div>
     <div class="block">
<p>Switch 4</p>
<button> <a href="control.php?switch=4&state=1">Turn on</a></button>
<button style="margin-left: 10%;"> <a href="control.php?switch=4&state=0">Turn off</a></button>
</div>
     <div class="block">
<p>Switch 5</p>
<button> <a href="control.php?switch=5&state=1">Turn on</a></button>
<button style="margin-left: 10%;"> <a href="control.php?switch=5&state=0">Turn off</a></button>
</div>
</div>
</form>
</body>
</html>
<?php
////////////////////////// getting last ID////////////////////////////////////////
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 
$sql= "SELECT MAX(id) FROM switchstate";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
$conn->close();
echo "<br>";
echo "Last entry was ";
echo $last_id;


///////////////////////////get data associated to id no///////////////////////////////////////////////////
// Create connection
// Create connection
$id=$last_id;
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT * FROM switchstate";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$last_id)
      {
        //echo "ID: " . $row["id"]. " Data Retreived: " . $row["se1"]. "," . $row["se2"]. "," . $row["se3"]. "," . $row["se4"]. "," . $row["se5"]. "<br>";
        
        $ls1=$row["sw1"];
        $ls2=$row["sw2"];
        $ls3=$row["sw3"];
        $ls4=$row["sw4"];
        $ls5=$row["sw5"];
      }
     
    }
}

else 
{
    echo "0 results";
}
$conn->close();


echo"<p>php running started</p>";
if (isset($_GET['switch'])) //$_SERVER['REQUEST_METHOD'] === 'GET' 
{
    $update=true;
    echo"<br>";
    echo"for switch ";
    echo $_GET["switch"];
    $switchno=$_GET["switch"];

    echo" entered values is ";
    echo $_GET["state"]; 
    $stateno=$_GET["state"];
}
else
{
$update=false;
}
$s1= $ls1;
$s2= $ls2;
$s3=$ls3;
$s4=$ls4;
$s5=$ls5;


if($update==true)
{
 echo "<br>";
 echo"updating switch ";
 echo $switchno;
 echo " with ";
 echo $stateno;

 switch ($switchno) {
    case 1:
        $s1=$stateno;
        break;
    case 2:
        $s2=$stateno;
        break;
    case 3:
        $s3=$stateno;
        break;
    case 4:
        $s4=$stateno;
        break;
    case 5:
        $s5=$stateno;
        break;
    }

 // Create a new connection
 $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) 
    {
    die("Connection failed: " . $conn->connect_error);
    } 

    $sql = "INSERT INTO switchstate (sw1, sw2, sw3, sw4, sw5)
                          VALUES ($s1, $s2, $s3, $s4, $s5 )";

    if ($conn->query($sql) === TRUE) 
    {
      echo "<br>";
      echo "Record updated successfully";
    } 
    else 
    {
    echo "<br>";
    echo "Error updating record: " . $conn->error;
    }

    $conn->close();
}
?>