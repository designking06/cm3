<?php
session_start();
try{
  $pdo = new PDO('mysql:host=$host;dbname=$db','$uid','$pwd');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo $e->getMessage();
  die();
}
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
        header("location:https://cagency.net/CM3/choosecomp.php");
        exit;
    } else {
        $_SESSION['badpass'] = $_SESSION['badpass'] +1;
        header("location:https://cagency.net/CM3/index.php");
        exit;
    }
}
