<?php
//user submitted a music single
if(isset($_POST['single'])){
  //using parameters instead of input names is faster
  $p1 = $_FILES['trackFile']['name'];
  $size = $_FILES['trackFile']['size'];
  $directory = "../media/audio/";
  $art = $_FILES['trackArtFile']['name'];
  $artDirectory = "../media/images/".basename($art);
  $p2 = $_POST['trackTitle'];
  $p3 = $_POST['artist'];
  $p4 = $_POST['genre'];
  $p5 = $_POST['published'];
  $p6 = date('Y-m-d');
  $p7 = $_SESSION['uid'];
  //file destination
  $trackTarget = $directory .basename($p1);
  try{
  $stmt = "INSERT INTO music (file,size,directory,art,title,artist,genre,published,date,uid) VALUES (?,?,?,?,?,?,?,?,?,?)";
  $insert = $pdo->prepare($stmt)->execute([$p1,$size,$directory,$art,$p2,$p3,$p4,$p5,$p6,$p7]);
 if($insert){
   //PDO Insert statement was correct
   if(move_uploaded_file($_FILES["trackFile"]["tmp_name"], $directory)){
     if(move_uploaded_file($_FILES["trackArtFile"]["tmp_name"], $artDirectory)){
       //Upload Successful
     $output= 'Awesome Submission!';
     }else{
       $output= "Image was not moved to specified location.";
     }}else{
       $output= "Audio File nor Image was moved to specified location, try updating your single.";
     }
    }else{
       $output = 'Hm, something went wrong.';
      }
    }catch(PDOException $e){
       echo $e->getMessage();
    }
}
