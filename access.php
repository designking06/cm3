<?php
session_start();
require_once('inc/pdo.php');
//md5 is broken
//crypt(pwd,'random salt string')
//$hpwd = password_hash($pwd, PASSWORD_DEFAULT);
//THIS IS THE LOGIN FORM
if(isset($_POST['loginSub'])){
    $stmt = $pdo->prepare("SELECT * FROM users WHERE uname = ?");
    $stmt->execute([$_POST['uname']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['pwd'], $user['pwd']))
    {
        $_SESSION['uid'] = $user['uid'];
        $uid = $_SESSION['uid'];
        $_SESSION['pwd'] = "valid";
        $_SESSION['uname'] = $user['uname'];
        $_SESSION['name'] = $user['fname']." ".$user['lname'];
        if($user['merchant'] == 1){
          $pm = TRUE;
        }else{
          $pm = FALSE;
        }
        if($user['creator'] == 1){
          $pc = TRUE;
        }else{
          $pc = FALSE;
        }
        if($user['fname'] == "Caleb" && $user['lname'] == "Crawley" && $user['email'] == "crawleyhost@gmail.com" && $user['uname'] == "crawleyhost" && $user['uid'] == 2){
          $pa = TRUE;
        }else{
          $pa = FALSE;
        }
        $_SESSION['permissions'] = array(
          "merchant" => $pm,
          "creator" => $pc,
          "admin" => $pa
        );
        header("location:https://cagency.net/CM3/choosecomp.php");
        exit;
    } else {
        $_SESSION['badpass'] = $_SESSION['badpass'] +1;
        $alert = "Account with submitted username and password not found.<br>Please Try Again.";
        header("location:https://cagency.net/CM3/index.php?alert=".$alert);
        exit;
    }
}
// new user
if(isset($_POST['newUser'])){
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $uname  = $_POST['uname'];
  $pwd  = $_POST['pwd'];
  $cpwd = $_POST['cpwd'];
  $permissions = "r";
  if($pwd != $cpwd){
    $alertStatus = "New User Sign Up Error: Hit the Sign Up Button To View The Error";
    $alert = "Passwords did not match, please try again.";
    header('location:index.php?alert='.$alert.'&alertStatus='.$alertStatus);
    exit;
  }
  $pwd = password_hash($pwd, PASSWORD_DEFAULT);
  //insert username & password into db
  $stmt = "INSERT INTO users (fname,lname,email,uname,pwd,permissions) VALUES (?,?,?,?,?,?)";
  $insert = $pdo->prepare($stmt);
  if($insert->execute([$fname,$lname,$email,$uname,$pwd,$permissions]))
  {
    $_SESSION['uid'] = $pdo->lastInsertId();
    $uid = $_SESSION['uid'];
    $stmt = "SELECT * FROM users WHERE uid = ? LIMIT 1";
    $select = $pdo->prepare($stmt);
    if($select->execute([$uid])){
      foreach($select as $u){
        $_SESSION['pwd'] = "valid";
        $_SESSION['uname'] = $u['uname'];
        $_SESSION['name'] = $u['fname']." ".$u['lname'];
        header('location: https://cagency.net/CM3/choosecomp.php');
      }
    }
  }else{
    $alertStatus = "Successfully Signed Up! Please Log In.";
    header('location: index.php?alertStatus'.$alertStatus);
  }

}
if(isset($_POST['loginCompany'])){
  $bcode = $_POST['bcode'];
  $bpwd = $_POST['bpwd'];
}
if(isset($_POST['newCompany'])){
  $bname = $_POST['bname'];
  $email = $_POST['email'];
  $buname = $_POST['buname'];
  $bpwd = $_POST['bpwd'];
  $cbpwd = $_POST['cbpwd'];
  $btype = $_POST['btype'];
  $creator = 0;
  $merchant = 0;
  if($bpwd != $cbpwd){
    $alert = "Your Company Passwords Do Not Match, Please Try Again";
    header('location: choosecomp?alert='.$alert);
    exit;
  }
  $stmt = "INSERT INTO companies () VALUES (?,?,?,?,?,?)";
  $insert = $pdo->prepare($stmt);
  if($insert->execute([$bname,$email,$buname,$bpwd,$btype,$creator,$merchant])){
    $alert = "Successfully created your company!";
    header('location: choosecomp.php?alert='.$alert);
    exit;
  }else{
    $alert = "An error occurred creating your company";
    header('location: choosecomp.php?alert='.$alert);
    exit;
  }
}
