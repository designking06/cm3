<?php
session_start();
require 'db.inc.php';
require 'var.inc.php';
//Update Logo
if(isset($_POST['cLogSub'])){
    //insert records
        $target = "../images/".basename($_FILES['image']['name']);
		$CompLogo = $_FILES['image']['name'];
        $update = $mysqli->query("UPDATE companies SET CompLogo = '$CompLogo' WHERE UserID = '$uid'");
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            header("Location: ../admin/comp.php");
        }elseif(move_uploaded_file($_FILES['image']['tmp_name'], $target !=TRUE)){
			$output3 = "Failed to upload";
}}
//Update Company Number
if(isset($_POST['cNumSub'])){
$CompNum = $_POST['CompNum'];
filter_var($CompNum, FILTER_SANITIZE_STRING);
if(empty($CompNum)){
    echo "Input box empty, <a href='../admin/comp.php'>Return</a>";
}else{
$sql = "UPDATE companies SET CompNum = '$CompNum' WHERE UserID = '$uid'";
if ($mysqli->query($sql) === TRUE) {
   header("Location: ../admin/comp.php");
} else {
    echo "Error updating record: " . $mysqli->error;
}}
 
$mysqli->close();
}
//Update Company Email
if(isset($_POST['cEmSub'])){
$CompEmail = $_POST['CompEmail'];
// Remove all illegal characters from email
$CompEmail = filter_var($CompEmail, FILTER_SANITIZE_EMAIL);
// Validate e-mail
if(empty($CompEmail)){
    echo "Input box empty, <a href='../admin/comp.php'>Return</a>";
}else{
if (!filter_var($CompEmail, FILTER_VALIDATE_EMAIL) === false) {
    $sql = "UPDATE companies SET CompEmail = '$CompEmail' WHERE UserID = '$uid'";
    if ($mysqli->query($sql) === TRUE) {
   header("Location: ../admin/comp.php");}else {
    echo "Error updating record: " . $mysqli->error;}
} else {
    echo("$CompEmail is not a valid email address");
}

$mysqli->close();
}}

if(isset($_POST['cDescSub'])){
$CompDesc = addslashes($_POST['CompDesc']);
filter_var($CompDesc, FILTER_SANITIZE_STRING);
if(empty($CompDesc)){
    echo "Input box empty, <a href='../admin/comp.php'>Return</a>";
}else{
$sql = "UPDATE companies SET CompDesc = '$CompDesc' WHERE UserID = '$uid'";
if ($mysqli->query($sql) === TRUE) {
   header("Location: ../admin/comp.php");
} else {
    echo "Error updating record: " . $mysqli->error;
}
$mysqli->close();
}}