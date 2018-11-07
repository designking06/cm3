<?php
session_start();
require_once('pdo.php');
if(isset($_SESSION['uid'])){
  $uid = $_SESSION['uid'];
}else{
  session_destroy();
  $alert = "You must be a member and log in to enjoy Crawley Creative Agency's Creative Management Suite, CM3.";
  header("location:cagency.net/CM3/index.php?alert=".$alert);
  exit;
}
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
        $_SESSION['admin'] = FALSE;
      }else{
        $_SESSION['admin'] = TRUE;
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
        $alert = "Username/Password combination not found or not valid CM3 credentials.";
        header("location:cagency.net/CM3/index.php?alert=".$alert);
        exit;
    }
}else{
  session_destroy();
  $alert = "You must be a member and log in to enjoy Crawley Creative Agency's Creative Management Suite, CM3.";
  header("location:cagency.net/CM3/index.php?alert=".$alert);
  exit;
}
