<?php require_once('../require.php'); ?>
<?php
$output = NULL;
getHead();
?>
<?php getHeader("creator");?>
<?php
if(isset($_POST['updateDescription'])){
    $description = $_POST['description'];
    $albumID = $_POST['albumID'];
    //ensure user updating description is same as user who created album
    try{
      $stmt = "SELECT uid FROM album WHERE id = ?";
      $select = $pdo->prepare($stmt);
      $select->execute([$albumID]);
      $count = $select->rowCount();
      if($count > 0){
        foreach($select as $row){
          $uid = $row['uid'];
          if($uid != $_SESSION['uid']){
            $output = 'You are not validated to update';
          }else{
            //Update record
            $stmt = "UPDATE album SET description = ? WHERE id = ?";
            $update = $pdo->prepare($stmt);
            $go = $update->execute([$description,$albumID]);
            if($go){
              //let user know it was successful, display button for the to return to unpublished page
      ?>
              <p> Update Successful</p>
              <form action="music.unpublished.php" method="post">
                <input type="hidden" name="id" value="<?php echo $albumID;?>">
                <input type="submit" name="submit" class="w3-button w3-black" value="Return">
              </form>
      <?php
            }else{
              //let user know it was unsuccessful, display button to return
              ?>
                      <p> Update Unuccessful</p>
                      <form action="music.unpublished.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $albumID;?>">
                        <input type="submit" name="submit" class="w3-button w3-black" value="Return">
                      </form>
              <?php
            }
          }
        }
      }else{
        //album id did not return an album
        ?>
                <p> Update Unsuccessful, no album id found</p>
                <form action="music.unpublished.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $albumID;?>">
                  <input type="submit" name="submit" class="w3-button w3-black" value="Return">
                </form>
        <?php

      }
    }catch(PDOException $e){
      echo $e->getMessage();
    }
    //end if isset
}
?>
<?php
if(isset($_POST['albumTrack'])){
  //using parameters instead of input names is faster
  $p1 = $_FILES['trackFile']['name'];
  $p2 = $_POST['title'];
  $p3 = $_POST['artist'];
  $p4 = $_POST['genre'];
  $p5 = $_POST['image'];
  $p6 = $_POST['published'];
  $albumID = $_POST['albumID'];
  $size = $_FILES['trackFile']['size'];
  $p7 = date('Y-m-d');
  $p8 = $_SESSION['uid'];
  //file destination
  $trackTarget = "../media/audio/".basename($_FILES['trackFile']['name']);
  try{
  $stmt = "INSERT INTO audio (file,size,title,artist,albumID,genre,image,published,date,uid) VALUES (?,?,?,?,?,?,?,?,?,?)";
  $insert = $pdo->prepare($stmt)->execute([$p1,$size,$p2,$p3,$albumID,$p4,$p5,$p6,$p7,$p8]);
    if($insert){
   //information successfully placed inside database
   //Insert audio file to directory
       if(move_uploaded_file($_FILES["trackFile"]["tmp_name"], $trackTarget)){
         ?>
         <p>Audio Successfully uploaded</p>
         <form action="music.unpublished.php" method="post">
           <input type="hidden" name="id" value="<?php echo $albumID;?>">
           <input type="submit" name="submit" class="w3-button w3-black" value="Return">
         </form>
         <?php
       }else{
         ?>
         <p>Audio Unuccessfully uploaded</p>
         <form action="music.unpublished.php" method="post">
           <input type="hidden" name="id" value="<?php echo $albumID;?>">
           <input type="submit" name="submit" class="w3-button w3-black" value="Return">
         </form>
         <?php
       }
    }else{
      ?>
      <p>CM3 has encountered an issue, please report this issue on our <a href="../concerns.php">concerns page</a></p>
      <form action="music.unpublished.php" method="post">
        <input type="hidden" name="id" value="<?php echo $albumID;?>">
        <input type="submit" name="submit" class="w3-button w3-black" value="Return">
      </form>
      <?php
      }
    }catch(PDOException $e){
       echo $e->getMessage();
    }
}
?>
<?php
if(isset($_POST['updateAlbumCover'])){
  //check to make sure user updating table matches listed users id
  try{
  $albumID = $_POST['albumID'];
  $stmt = "SELECT * FROM album WHERE id = ?";
  $select = $pdo->prepare($stmt);
  $select->execute([$albumID]);
  $count = $select->rowCount();
  if($count > 0){
    foreach($select as $row){
      $validateID = $row['uid'];
      if($validateID != $_SESSION['uid']){
        ?>
        <p>You are not validated to update this cover album</p>
        <?php
      }else{
        //user validated, update Album coverArtFile
        $size = $_FILES['coverArtFile']['size'];
        $cover = $_FILES['coverArtFile']['name'];
        $artDirectory = "../media/images/".basename($_FILES['coverArtFile']['name']);
        //file destination
        try{
        $stmt = "UPDATE album SET cover = ? WHERE id = ?";
        $update = $pdo->prepare($stmt);
        $update->execute([$cover,$albumID]);
       if($update){
         //Cover Upload Successful
           if(move_uploaded_file($_FILES["coverArtFile"]["tmp_name"], $artDirectory)){
             //Cover Successfully moved to directory
             ?>
           <p>Cover Updated Successfully.</p>
           <form action="music.unpublished.php" method="post">
             <input type="hidden" name="id" value="<?php echo $albumID;?>">
             <input type="submit" name="submit" class="w3-button w3-black" value="Return">
           </form>
           <?php
           }else{
             ?>
             <p>Cover Unsuccessfully Updated, please try again.</p>
             <form action="music.unpublished.php" method="post">
               <input type="hidden" name="id" value="<?php echo $albumID;?>">
               <input type="submit" name="submit" class="w3-button w3-black" value="Return">
             </form>
             <?php
           }
          }else{
            ?>
             <p>Hm, something went wrong on our end. Please report this issue.</p>
             <form action="music.unpublished.php" method="post">
               <input type="hidden" name="id" value="<?php echo $albumID;?>">
               <input type="submit" name="submit" class="w3-button w3-black" value="Return">
             </form>
             <?php
            }
            //end if/else insert
          }catch(PDOException $e){
             echo $e->getMessage();
          }
        //end validate
      }
      //end foreach
    }
  //ed if count > 0
}else{
  ?>
  <p>Album Not Found</p>
  <?php
}
}catch(PDOException $e){
  $output = $e->getMessage();
}
} ?>
<?php echo $output;?>
<?php getFooter();?>
