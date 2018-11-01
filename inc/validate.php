<?php
require_once('pdo.php');
$uid = $_SESSION['uid'];
if(!empty($uid)){
    $stmt = $pdo->prepare("SELECT * FROM users WHERE uid = ?");
    $stmt->execute([$uid]);
    $count = $stmt->rowCount();
    $user = $stmt->fetchAll();
    if($count >0){
    foreach($user as $row)
    {
      //valid
      $permission = $row['permissions'];
      if($permission != 'AA'){
        $_SESSION['admin'] = (bool)0;
      }else{
        $_SESSION['admin'] = (bool)1;
      }
      $permission = $row['creator'];
      if($permission != 1){
        //send user to sign up page
      }else{
        $_SESSION['creator'] = (bool)1;
      }
    }
  } else {
        session_destroy();
        $_SESSION['badpass'] = $_SESSION['badpass'] +1;
        header("location:index.php");
        exit;
    }
}else{
  session_destroy();
  header("location:index.php");
  exit;
}
