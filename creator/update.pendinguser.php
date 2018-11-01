<?php
require('../require.php');
try{
    $uid = $_POST['uid'];
    $permissions = $_POST['permissions'];
    $stmt = "UPDATE users SET permissions = ? WHERE uid= ?";
    $update = $pdo->prepare($stmt);
    $update->execute([$_POST['permissions'],$_POST['uid']]);
    if($update){
    $alert= "<div class='alert alert-success'>Successful Update</div>";
        header("location:administer.php");
    }else{
    $alert= "<div class='alert alert-danger'>Unsuccessful update.</div>";
        header("location:administer.php");
    }
}catch(PDOException $e){
  $alert = $e->getMessage();
  die();
}
?>
