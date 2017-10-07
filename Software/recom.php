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
    .qwe{
        margin:1%;
        font-size:15px;
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
    <div class="qwe">
<?php
$i=0;
 echo "Product Selected: ";
 $product=$_GET["product"];
 echo $product; 
 echo "<br>";
 echo "<br>";
 echo "Online Recommendations: ";
 $str="https://dir.indiamart.com/search.mp?ss=";
 $str1=$str.$product;
 $html = file_get_contents($str1);
 $string="/\w+(:\/\/www.indiamart.com\/proddetail)\/[a-zA-Z0-9_%+-]*.html/";
 preg_match_all($string, $html, $matches);
//preg_match("/\w+(:\/\/www.amazon.in).*[0-9A-Za-z=]/", $input, $matches );
$c = count($matches[0]);
$f=0;
$f = (($c+1)/2);
settype($f, "integer");
echo $f;
echo "<br>";
echo "<br>";
for($i=1;$i<$c+1;$i++)
{
  //$j=$i+1;
  echo "Option ";
  echo "<button><a href=\"".$matches[0][$i]."> View"."</a></button>";
  echo "<br>";
  echo "<br>";
}
?>
 </div>
</body>
</html>