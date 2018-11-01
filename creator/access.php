<?php
session_start();
include_once('../../inc/pdo.php');
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
        $uid = $user['uid'];
        $_SESSION['uname'] = $user['uname'];
        $_SESSION['name'] = $user['fname']." ".$user['lname'];
        header("location:choosecomp.php");
    } else {
        $_SESSION['badpass'] = $_SESSION['badpass'] +1;
        header("location:index.php");
    }
}
