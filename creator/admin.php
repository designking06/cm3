<?php
require_once('../require.php');
$output = NULL;
if(!isset($_SESSION['loggedin'])){
        header("Location: login.php");
    }elseif(!isset($_SESSION["CompID"])){
$output = "You wont be able to make changes until you register your organization.";
}elseif(isset($_SESSION['loggedin'])){
echo "<span style='float:right;'>WELCOME " . $uname . " <a href='logout.php'>Logout</a></span>";
}
$getFname = $mysqli->query("SELECT * FROM users WHERE id = '$uid'");;
if($getFname->num_rows > 0){
while($row = $getFname->fetch_assoc()){
$fname = $row["fname"];
}
}else{
$output = "There's an issue getting info from your account.";
}
$getInfo = $mysqli->query("SELECT * FROM companies WHERE CompID = '$CompID'");;
if($getInfo->num_rows > 0){
while($row = $getInfo->fetch_assoc()){
$CompSite = $row["CompSite"];
}
}else{
$output = "Website button error";
}?>

<html>
<head>
<link rel="stylesheet" href="css/w3_v4.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
    <style>
    #grad {
  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(left top, red, yellow); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(bottom right, red, yellow); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(bottom right, red, yellow); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to bottom right, white, grey); /* Standard syntax */
}
    </style>
<body id="grad">
<div id="body" class="container-fluid" style="width: 100%;padding-bottom: 20px;">
        <header><table class="container-fluid text-center">
        <tr style="height: 110px;">
            <td class="col-sm-4"></td>
            <td class="col-sm-4  w3-center"><img src="images/<?php echo $headerLogo; ?>" class="w3-image" style="height: 90px;"/></td>
            <td class="col-sm-4"></td>
        </tr>
        </table>
        </header>
    <!--div class="row" style="text-align: center; width: 100%; padding-top: 50px; padding-left: 30px;">
        <i class="glyphicon glyphicon-user w3-jumbo w3-red w3-circle" style="height: 100px; width: 100px; padding-top: 10px;"></i>
    </div-->
    <div class="row" style="text-align: center; width: 100%; margin-top: 20px;">
        <span class="w3-text-black"><h1>Welcome, <span class="w3-text-blue">
<?php echo $fname; ?>
            </span></h1><h2> What would you like to manage?</h2></span>
    </div>
       <div class="row" style="padding-top: 40px; margin-left: 2%; margin-right: 2%;">
        <div class="col-sm-12" style="border-bottom: 2px solid white;"></div></div>
    <div class="row w3-shadow" style="margin-left: 2%; margin-right: 2%; margin-top: 40px;">
        <a href="media.php"><div class="col-sm-4 w3-blue"  style="height: 300px; text-align: center;"><h1 style="padding-top: 100px;"><?php echo $pageOneTitle ;?></h1></div></a>
        <a href="pns.php"><div class="col-sm-4 w3-black"  style="height: 300px; text-align: center;"><h1 style="padding-top: 100px;"><?php echo $pageTwoTitle ;?></h1></div></a>
        <a href="comp.php"><div class="col-sm-4 w3-red"  style="height: 300px; text-align: center;"><h1 style="padding-top: 100px;"><?php echo $pageThreeTitle ;?></h1></div></a>
    </div>
    <div class="row" style="padding-top: 40px; margin-left: 2%; margin-right: 2%;">
        <div class="col-sm-4" style="border-bottom: 2px solid blue;"></div>
    <div class="col-sm-4" style="border-bottom: 2px solid black;"></div>
    <div class="col-sm-4" style="border-bottom: 2px solid red;"></div></div>
<div class="row">


<div class="col-sm-12 text-center"><a href="http://<?php echo $CompSite;?>"><h1>VIEW WEBSITE</h1></a></div></div>
</div>
</body>
