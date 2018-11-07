<?php
session_start();
if(!isset($_SESSION['uid'])){
header('location:https://cagency.net/CM3');
}else{
  header('location:dash.php');
}?>
