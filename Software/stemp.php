<?php 
$tempget="";
$tempget=$_GET["temp"];
////////////////////////////////////// initialise sql variables/////////////////////////////////
$servername = "localhost";
$username = "id3162751_saurabh";
$password = "qwerty";
$dbname = "id3162751_saurabh";
///////////////////////////////////////variables/////////
$last_id=0;

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
} 

$sql= "SELECT MAX(id) FROM temp";
$result = $conn->query($sql);
$max_public_id = mysqli_fetch_row($result);
$last_id = $max_public_id[0];
/////////////////////////////////////////update if not one/////////////////////////

if($tempget!=1)
{
 	$sql = "INSERT INTO temp (temp)
 VALUES ('$tempget')";

 if ($conn->query($sql) === TRUE) 
 {
    echo "Temperature Updates successfully";
 } 
 else 
 {
    echo "Error: " . $sql . "<br>" . $conn->error;
}}
///////////////////////////////////////////////////////get values 
if ($last_id!=0)
{
 $sql = "SELECT * FROM temp";
$result = $conn->query($sql);
if ($result->num_rows > 0) 
{
    // output data of each row
    while($row = $result->fetch_assoc()) 
    {
      if($row["id"]==$last_id)
      {
        //echo "ID: " . $row["id"]. " Data Retreived: " . $row["se1"]. "," . $row["se2"]. "," . $row["se3"]. "," . $row["se4"]. "," . $row["se5"]. "<br>";
        $tempprev=$row["temp"];
        }
     
      }
}

else 
{
    echo "0 results";
}

}
echo "Current Temperature ";
echo $tempprev;

$conn->close();
?>