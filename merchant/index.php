<?php
session_start();
if(!isset($_SESSION['uid'])){
  session_destroy();
  header('location:https://cagency.net/CM3');
  exit;
}else{
  header('location:dash.php');
  exit;
}?>
