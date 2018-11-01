<?php
session_start();
require_once('../require.php');
$output3 = NULL;
//comp.php
?>
<?php
if(isset($_POST["submit"])) {

    $CompName = $mysqli->real_escape_string($_POST['CompName']);
    $CompEmail = $mysqli->real_escape_string($_POST['CompEmail']);
    $CompNum = $mysqli->real_escape_string($_POST['CompNum']);
    $UserID = $_POST['UserID'];

    //UNSIGNED DECIMAL (10,2)
    $query = $mysqli->query("SELECT * FROM companies WHERE CompName = '$CompName'");

    if($query->num_rows !=0) {
        $output3 = "Business already registered.";
    }elseif(empty($CompName)){
        $output3 = "Please fill in a name for your business.";
    }elseif(empty($CompEmail)){
        $output3 = "Please choose an email for your business.";
    }elseif(empty($CompNum)){
        $output3 = "Please specify a phone number for your business.";
    }elseif(empty($UserID)){
        $output3 = "Your username session isnt registered.";
    }else{
        //insert records
        $target = "images/".basename($_FILES['logo']['name']);
		$image = $_FILES['logo']['name'];
        $insert = $mysqli->query("INSERT INTO companies (CompName, CompEmail, CompNum, CompLogo, UserID) VALUES ('$CompName', '$CompEmail','$CompNum','$image','$UserID')");

        if($insert != TRUE){

            $output3 = "There was an issue ";
            $output3 .= $mysqli->error;
        }elseif (move_uploaded_file($_FILES['logo']['tmp_name'], $target)) {
            $output3 = "<h4 class='w3-text-white'> Thanks, <span class='w3-text-green'>" . $_SESSION["user"] . "</span>, your product line, <span class='w3-text-green'>" . $CompName . "</span> is now registered.</h4>";
            sleep(2);
            header("Location: admin.php");
        }else{
			$output3 = "Failed to upload";
		}}
            //$output3 = "<h4 class='w3-text-white'> Thanks, <span class='w3-text-green'>" . $_SESSION["user"] . "</span>, your product line, <span class='w3-text-green'>" . $plName . "</span> is now registered.</h4>";
            //sleep(2);
            //header("Location: cca.pregp2.php");
		//}else{
		//	$msg = "Failed to upload image";
		//}
}
?>

<html>
<?php
getHead();
if(!isset($CompID)){
    echo '
<body class="container-fluid w3-black">
<div id="header">
</div>
<div id="CompInfo">
<div class="container w3-white" style="height:100%;">
<div class="w3-border-bottom w3-border-red row" style=""><a href="admin.php"><h3>Home</h3></a></div>
<div class="w3-padding" style="">
<form action="comp.php" method="post" enctype="multipart/form-data">
Name of Business
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="CompName" type="text" class="form-control" name="CompName" placeholder="Company Name">
    </div><br>
    <p> Logo: </p>
<input class="form-control" type="file" name="logo"><br>
Business Email
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="CompEmail" type="email" class="form-control" name="CompEmail" placeholder="Company Name">
    </div><br>
Business Phone
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="CompNum" type="tel" class="form-control" name="CompNum" placeholder="Company Name">
    </div><br>
<input type="hidden" name="UserID" value="<?php echo $uid ?>">
<input type="submit" name="submit" value="submit">
</form>
'.$output3 .'
</div></div></div></body>';
}
else{
$query = $mysqli->query("SELECT * FROM companies WHERE CompID = '$CompID'");
if($query->num_rows > 0) {
    while($row = $query->fetch_assoc()){
   $CompName = $row["CompName"];
   $CompNum = $row["CompNum"];
   $CompLogo = $row["CompLogo"];
   $CompEmail = $row["CompEmail"];
    $CompDesc = $row["CompDesc"];}}
?>
<body class="container-fluid w3-black">
<div id="header">
</div>
<div id="CompInfo">
<div class="container w3-white" style="height:100%;">
<div class="w3-border-bottom w3-border-red row" style=""><a href="admin.php"><h3>Home</h3></a></div>
<div class="w3-padding" style="">
<form action="inc/inc.update.php" method="post" enctype="multipart/form-data" class="w3-center" style="">
    <div class="">
            <div class="row">
                <img class="w3-center w3-image w3-circle" src="images/<?php echo $CompLogo; ?>" style="max-width:50%;">
            </div>
            <div class="row w3-border-bottom"><h2 class="text-left">Change Logo</h2>
                    <div style="width:100%;">
                        <input type="file" name="image" style="margin:auto;">
                    </div>
                    <input type="submit" name="cLogSub">
            </div>
        <div class="row"><h2 class="text-left">Company:</h2><p class="text-left"><?php echo $CompName; ?></p></div>

        <div class="row"><h2 class="text-left">Company Number:</h2><p class="text-left"><?php echo $CompNum; ?></p></div>
                <div class="form-group">
        <label for="Company">Change Number:</label>
        <input type="tel" class="form-control" name="CompNum" placeholder="<?php echo $CompNum;?>" id="Company">
        <input type="submit" name="cNumSub">
                </div>
        <div class="row"><h2 class="text-left">Company Email:</h2><p class="text-left"><?php echo $CompEmail; ?></p></div>
                <div class="form-group">
        <label for="Company">Change Email:</label>
        <input type="text" class="form-control" name="CompEmail" placeholder="<?php echo $CompEmail; ?>" id="Company">
        <input type="submit" name="cEmSub">
                </div>
    </div>
            <div class="row"><h2 class="text-left">Company Description:</h2></div>
                <div class="form-group">
          <label for="comment">Company Description:</label>
            <p class="text-left"><?php echo $CompDesc;?></p>
          <textarea class="form-control" name="CompDesc" rows="5" id="comment"></textarea>
                <input type="submit" name="cDescSub">
                </div>
    <?php echo $output3;?>
</form>
</div>
</div>
</div>
</body>
</html>
<?php } ?>
