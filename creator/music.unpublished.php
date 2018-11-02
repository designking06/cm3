<?php require_once('../require.php');?>
<?php $output = NULL;?>
<?php getHead();?>
<?php getHeader("creator");?>
<!-- Start Content -->
        <div class="row w3-border-bottom">
          <h1 class="w3-text-blue">Your Unpublished Album</h1>
          <p><?php echo $output;?></p>
        </div>
<?php
//User needs to be able to add/remove info from UNPUBLISHED Albums
//User needs to be able to manage information on PUBLISHED Albums
//select album information from album table
//Allow user to edit album cover & description
//select all songs associated with album and list them
// allow user to edit song order
if(isset($_POST['submit'])){
  //checks if requested to edit
    //this is this id for albumID from create.music page
    $id = $_POST['id'];
    try{
      //search album in table
      $stmt = "SELECT * FROM album WHERE id = ? AND published = ?";
      $select = $pdo->prepare($stmt);
      $select->execute([$id,'unpublished']);
      $count = $select->rowCount();
    if($count > 0){
      foreach($select as $row){
        $albumID = $row['id'];
        $status = $row['published'];
        if($status != 1){
          $published = 'unpublished';
        }else{
          $published = 'published';
        }
        $albumTitle = $row['title'];
        $description = $row['description'];
        $cover = $row['cover'];
        $genre = $row['genre'];
        ?>
        <!-- List Cover Art of the Album -->
        <div class="row w3-border-bottom w3-padding">
          <div class="col-sm-3">
            <?php
            if($cover != NULL){
              //album cover has been added, display cover then a form to change it
              ?>
            <img class="w3-image" src="../media/images/<?php echo $cover;?>" style="max-height:200px;">
              <h4>Change album cover</h4>
              <form action="music.unpublished.update.php" method="post" enctype="multipart/form-data">
                <input type="file" name="coverArtFile" class="form-control">
                <input type="hidden" name="albumID" value="<?php echo $albumID;?>">
                <input type="submit" name="updateAlbumCover" value="Update Cover">
              </form>
            <?php
          //end if album cover
          }else{
            //no album cover has been added, display a form
            ?>
            <div class="w3-padding">
              <h3 class="w3-text-red">Add an album cover</h3>
              <form action="music.unpublished.update.php" method="post" enctype="multipart/form-data">
                <input type="file" name="coverArtFile" class="form-control">
                <input type="hidden" name="albumID" value="<?php echo $albumID;?>">
                <input type="submit" name="updateAlbumCover" value="Update Cover">
              </form>
            </div>
        <?php
        //end ifelse for album cover
          }
        ?>
        <!-- List Album Name, Genre, Status, Description of the Album -->
          </div>
          <div class="col-sm-9 w3-padding">
            <b><h1 class="w3-cell" style="color:#c2a23a"><?php echo $albumTitle;?></h1></b><hr class="w3-clear">
            <p><span style="color:#c2a23a">Genre:</span> <?php echo $genre;?><br><span style="color:#c2a23a">Status:</span> <?php echo $published;?></p>
          </div>
      </div>
      <div class="row">
        <h3 class="w3-text-blue">Album Description</h3>
        <div class="row w3-margin">
          <form action="music.unpublished.update.php" method="post">
          <textarea class="form-control" name="description"><?php echo $description;?></textarea>
          <input type="hidden" name="albumID" value="<?php echo $albumID;?>">
          <input type="submit" name="updateDescription" value="Update">
        </form>
      </div>
      </div>
      <!-- List Related Tracks -->
      <div class="row">
      <h3 class="w3-text-blue">Album Tracks</h3>
        <?php
        //get tracks that are a part of this album
        $stmt = "SELECT * FROM audio WHERE albumID = ?";
        $select = $pdo->prepare($stmt);
        $select->execute([$albumID]);
        $count = $select->rowCount();
        if($count > 0){
          //there are tracks associated with this album
          //start an ordered list
          ?>
          <ol>
          <?php
          foreach($select as $row){
            $trackID = $row['id'];
            $trackTitle = $row['title'];
            $trackFile = $row['file'];
        ?>
        <!-- List track information, with button to delete from list -->
        <li><h3 style="color:#c2a23a">
            <span id="<?php echo $trackID;?>" onclick="document.getElementById('Play<?php echo $trackID;?>').style.display='block'" class="w3-btn w3-black w3-small">Play</span>
            <?php echo $trackTitle;?></h3>
        </li>
        <div id="Play<?php echo $trackID;?>" class="w3-modal w3-black" style="display:none;">
          <div class="w3-modal-content w3-container text-center w3-text-black" style="height:90%;">
            <h1 class=""><?php echo $trackTitle;?></h1>
            <audio controls>
              <source src="../media/audio/<?php echo $trackFile;?>" type="audio/mpeg">
            </audio>
          </div>
        </div>
        <?php
        //end foreach array
        }
        //end ordered list
        ?>
        <ol>
        <?php
        //end if count > 0
        }else{
        //album id did not return any associated tracks
        ?>
        <p class="w3-text-red">This Album Has No Current Tracks, add them below.</p>
        <?php
        //end else for if count >0
        }
        ?>
        <!-- User needs to add new tracks,
        display a form to allow uploading,
        then display tracks that arent associated with an album but are already uploaded
        in a form with a checkbox for them to be added to this album-->
      <!-- Upload New Track -->
      <div class="row w3-margin">
        <h4 class="w3-text-blue">Upload New Tracks To Album</h4>
        <div style="max-width:70%;">
        <form action="music.unpublished.update.php" method="POST" enctype="multipart/form-data">
          <b>Track File</b><br>
          <input class="form-control" type="file" name="trackFile"><br>
          <b>Track Title</b><br>
          <input class="form-control" type="text" name="title"><br>
          <b>Track Artist</b><br>
          <input class="form-control" type="text" name="artist" value="<?php echo $_SESSION['name'];?>"><br>
          <input type="hidden" name="albumID" value="<?php echo $albumID;?>">
          <input type="hidden" name="genre" value="<?php echo $genre;?>">
          <input type="hidden" name="image" value="<?php echo $cover;?>">
          <input type="hidden" name="published" value="<?php echo $status;?>">
          <input id="submit" type="submit" name="albumTrack" class="w3-btn" value="Upload">
        </form>
      </div>
      </div>
      <!-- Display Uploaded, nonassociated tracks -->
      <div class="row w3-margin">
        <h4 class="w3-text-blue">Add these tracks to your album</h4>
          <?php displayAudio($pdo);?>
    </div>
    <button class="w3-btn" style="background-color:#c2a23a">Publish</button>
    <!-- close row-->
    </div>
    <!-- Edit Release Date -->
<?php
    }
    }else{
    //album id did not return an Album
    header("location:create.music.php");
    }
    }catch(PDOException $e){
      echo $e->getMessage();
    }

    //Below should be an area for user to add new tracks
    //display a form with hidden form values of album id & album artwork to be stored with the track information
}else{
  header("location:create.music.php");
}
?>
</div>
<?php getFooter();?>
<?php
function displayAudio(PDO $pdo){
    global $uid;
    $stmt = "SELECT * FROM audio WHERE uid = ? AND albumID = NULL";
    $select = $pdo->prepare($stmt);
    $select->execute([$uid]);
    $count = $select->rowCount();
    ?>
    <div class="row w3-padding">
      <?php if($count>0){
        foreach($select as $row){
          $audio = $row['file'];
          $directory = $row['directory'];
          $image = $row['image'];
          $title = $row['title'];
          $artist = $row['artist'];
          ?>
        <div class="col-sm-9 w3-padding">
            <div class="col-sm-2">
              <img class="w3-image w3-opacity w3-round" src="../media/images/<?php echo $image;?>" style="height:50px;">
            </div>
            <div class="col-sm-3">
              <h4 class="w3-text-black">
                <?php echo $artist;?>
              </h4>
            </div>
            <div class="col-sm-1">
              <h4 class="w3-text-black">
                x
              </h4>
            </div>
            <div class="col-sm-3">
              <h4 class="w3-text-black">
                "<?php echo $title;?>"
              </h4>
            </div>
            <div class="col-sm-1">
              <h4 class="w3-text-black">
              </h4>
            </div>
      </div>
    </div>
          <?php
        }
      }else{
        ?>
        <p>Every track you have uploaded is already being used on a project. Set a goal on your <a href="dash.php#tasks">task list</a></p>
        <?php
      }
    }
 ?>
