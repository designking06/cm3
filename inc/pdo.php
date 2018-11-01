<?php
//connect to db with PDO
//print_r(PDO::getAvailableDrivers());
try{
  $pdo = new PDO('mysql:host=127.0.0.1;dbname=ccacms','root','');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(PDOException $e){
  echo $e->getMessage();
  die();
}
function protect($data) {
  $data = trim($data);
  $data = addslashes($data);
  $data = strip_tags($data);
  $data = htmlspecialchars($data,ENT_QUOTES);
  return $data;
}

