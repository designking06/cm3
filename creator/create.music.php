<?php
require_once('../require.php');
//output for submitted forms
$output = NULL;
//Retrieve HTML Header info from get.inc.php
getHead();
?>
<?php
//user submitted a music single
if(isset($_POST['single'])){
  //using parameters instead of input names is faster
  $p1 = $_FILES['trackFile']['name'];
  $size = $_FILES['trackFile']['size'];
  $directory = "../media/audio/";
  $image = $_FILES['trackArtFile']['name'];
  $p2 = $_POST['title'];
  $p3 = $_POST['artist'];
  $p4 = $_POST['genre'];
  $p5 = $_POST['publish'];
  $p6 = date('Y-m-d');
  $p7 = $_SESSION['uid'];
  //file destination
  $trackTarget = "../media/audio/".basename($_FILES['trackFile']['name']);
  $artDirectory = "../media/images/".basename($_FILES['trackArtFile']['name']);
  try{
  $stmt = "INSERT INTO audio (file,size,directory,image,title,artist,genre,published,date,uid) VALUES (?,?,?,?,?,?,?,?,?,?)";
  $insert = $pdo->prepare($stmt)->execute([$p1,$size,$directory,$image,$p2,$p3,$p4,$p5,$p6,$p7]);
 if($insert){
   //PDO Insert statement was correct
   if(move_uploaded_file($_FILES["trackFile"]["tmp_name"], $trackTarget)){
     $output= 'Audio Successful:';
   }else{
     $output= "Audio unsuccessful.";
   }
     if(move_uploaded_file($_FILES["trackArtFile"]["tmp_name"], $artDirectory)){
       //Upload Successful
     $output.= 'Image Successful.';
     }else{
       $output.= "Image unsuccessful.";
     }
    }else{
       $output = 'Hm, something went wrong.';
      }
    }catch(PDOException $e){
       echo $e->getMessage();
    }
}

if(isset($_POST['album'])){
  $p1 = $_POST['title'];
  $p2 = $_POST['artist'];
  $p3 = $_POST['genre'];
  $p4 = $_POST['description'];
  $p5 = $_SESSION['uid'];
  if(empty($p1) OR empty($p2) OR empty($p3)){
    $output = "The album title, genre and artist fields cannot be empty when you submit.";
  //end if
  }else{
    try{
      $stmt = "INSERT INTO album (title,artist,genre,description,uid) VALUES(?,?,?,?,?)";
      $insert = $pdo->prepare($stmt);
      $insert->execute([$p1,$p2,$p3,$p4,$p5]);
      if($insert){
        $output = "Album successfully created";
      }
      //end try
    }catch(PDOException $e){
      $output = $e->getmessage();
      //end catch
    }
    //end else
  }
//end isset
}
?>
<div class="container-fluid">
<?php getHeader();?>
<!-- CONTENT -->
      <div id="header" class="row">
        <div class="col-sm-12 text-left">
          <i class="fa fa-music" style="font-size:48px;color:#c2a23a;"></i>
          <span class="w3-wide" style="font-size:48px;"> Music</span>
        </div>
      </div>
      <!-- Grab audio files from db -->
      <div class="row">
        <div class="col-sm-12"><h3 class="w3-text-red">Albums</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <div class="w3-margin"><h4>Unpublished</h4>
          <?php displayUnpublishedAlbums($pdo); ?>
          </div>
          <div class="w3-margin"><h4>Published</h4>
          <?php displayPublishedAlbums($pdo); ?>
          </div>
        </div>
      </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12"><h3 class="w3-text-red">Tracks</h3></div>
      </div>
      <div class="row">
        <div class="col-sm-12">
            <div class=""><?php displayUnpublishedAudio($pdo); ?></div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
            <div class="text-center"><h3>Ready to release some new music?<br><?php echo $output;?></h3></div>
          </div>
          <div class="col-sm-12">
            <!-- Button For Single Submission-->
            <div class="text-center w3-text-black"><button id="sSingle" class="w3-btn w3-padding w3-margin">Let's Drop A Single</button></div>
            <!-- Button For Album Submission-->
            <div class="text-center w3-text-black"><button id="sAlbum" class="w3-btn w3-padding w3-margin">Let's Drop An Album</button></div>
              <!-- Row For Displaying hidden forms-->
        </div>
      </div>
      <div class="row">
          <div id="single" class="col-sm-6 " style="display:none;">
            <h3 class="text-center">Let's drop a single</h3><hr class="w3-clear">
            <div class="row">
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST" enctype="multipart/form-data">
              <b>Track File</b><br>
              <input class="form-control" type="file" name="trackFile"><br>
              <b>Track Title</b><br>
              <input class="form-control" type="text" name="title"><br>
              <b>Track Artist</b><br>
              <input class="form-control" type="text" name="artist" value="<?php echo $_SESSION['name'];?>"><br>
              <b>Cover Art</b><br>
              <input class="form-control" type="file" name="trackArtFile"><br>
              <b>Genre</b><br>
              <input class="" type="radio" name="genre" value="Rap/Hip-Hop">Rap/Hip-Hop<br>
              <input class="" type="radio" name="genre" value="R&B/Soul">R&B/Soul<br>
              <input class="" type="radio" name="genre" value="Gospel">Gospel<br>
              <input class="" type="radio" name="genre" value="Rock">Rock<br>
              <br>
              <b>Publish?</b><br>
              <input class="" type="radio" name="publish" value='1'>Publish<br>
              <input class="" type="radio" name="publish" value='0'>Hold<br>
              <br>
              <input id="submit" type="submit" name="single" class="w3-btn" value="Upload">
            </form>
            </div>
          </div>
          <div id="album" class="col-sm-6" style="display:none;">
            <h3 class="text-center">Let's drop an album</h3>
            <hr class="w3-clear">
              <div class="row">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <b>Album Title</b><br>
                <input class="form-control" type="text" name="title"><br>
                <b>Track Artist</b><br>
                <input class="form-control" type="text" name="artist" value="<?php echo $_SESSION['name'];?>"><br>
                <b>Genre</b><br>
                <input class="" type="radio" name="genre" value="Rap/Hip-Hop">Rap/Hip-Hop<br>
                <input class="" type="radio" name="genre" value="R&B/Soul">R&B/Soul<br>
                <input class="" type="radio" name="genre" value="Gospel">Gospel<br>
                <input class="" type="radio" name="genre" value="Rock">Rock<br>
                <br>
                <b>Description</b><br>
                <textarea class="form-control" name="description" placeholder="Optional for now, but will be needed when published."></textarea>
                <input id="submit" type="submit" name="album" value="Create" class="w3-btn">
              </form>
              </div>
          </div>
        </div>
      </div>
    </div>
  <?php getCrFooter();?>
  <script>
    $(document).ready(function(){
        $("#sAlbum").click(function(){
            $("#album").toggle();
        });
        $("#sSingle").click(function(){
            $("#single").toggle();
        });
    });
  </script>
  <?php
function displayUnpublishedAudio(PDO $pdo){
    global $uid;
    //get unpublished unlisted audio
    $stmt = "SELECT * FROM audio WHERE uid = ? AND published = ? AND albumID = NULL";
    $select = $pdo->prepare($stmt);
    $select->execute([$uid,0]);
    $count = $select->rowCount();
    ?>
    <div class="w3-padding">
            <div class=""><h4>Unlisted Tracks</h4></div>
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
                          <?php
                          }
          }else{
                  ?>
                  <p>Your You have no unlisted, unpublished tracks. Set a goal on your <a href="dash.php#tasks">task list</a></p>
                  <?php
                }
      ?>
    </div>
    <?php
    //get listed unpublished
    $stmt = "SELECT * FROM audio WHERE uid = ? AND published = ? AND albumID IS NOT NULL";
    $select = $pdo->prepare($stmt);
    $select->execute([$uid,0]);
    $count = $select->rowCount();
    ?>
    <div class="w3-padding">
      <div class=""><h4>Tracks Listed With Albumss</h4></div>
      <?php
      if($count>0){
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
                    <div class="col-sm-4">
                      <h4 class="w3-text-black">
                        "<?php echo $title;?>"
                      </h4>
                    </div>
              </div>
          <?php }}else{ ?>
                  <p>Your You have no listed, unpublished tracks. Set a goal on your <a href="dash.php#tasks">task list</a></p>
          <?php }?>
    </div>
    <?php
    //end function
    }
function displayPublishedAlbums(PDO $pdo){
      global $uid;
      $p2 = 1;
      $stmt = "SELECT * FROM album WHERE uid = ? AND published = ?";
      $select = $pdo->prepare($stmt);
      $select->execute([$uid,$p2]);
      $count = $select->rowCount();
      ?>
      <div class="w3-padding">
        <?php if($count>0){
          ?>
          <?php
          foreach($select as $row){
            $id = $row['id'];
            $description = $row['description'];
            $cover = $row['cover'];
            $title = $row['title'];
            $artist = $row['artist'];
            $status = $row['published'];
            ?>
          <div class="">
            <div class="col-sm-12">
              <form action="music.published.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" class="w3-button w3-black form-control" value="Manage">
              </form>
                <span class="" style="font-size:18px;padding-left:20px;">"<?php echo $title;?>"</span>
              </div>
        </div>
      </div>
            <?php
          }
          ?>
          <?php
        }else{
          ?>
          <div class="w3-padding">
            <p>You have no published albums. What's holding you back? Set a goal on your <a href="dash.php#tasks">task list</a></p>
          </div>
          <?php
        }
      }
function displayUnpublishedAlbums(PDO $pdo){
        global $uid;
        $p2 = 0;
        $stmt = "SELECT * FROM album WHERE uid = ? AND published = ?";
        $select = $pdo->prepare($stmt);
        $select->execute([$uid,$p2]);
        $count = $select->rowCount();
        ?>
        <div class="row w3-padding">
          <?php if($count>0){
            ?>
            <?php
            foreach($select as $row){
              $id = $row['id'];
              $description = $row['description'];
              $cover = $row['cover'];
              $title = $row['title'];
              $artist = $row['artist'];
              $status = $row['published'];
              ?>
              <div class="col-sm-12">
                <form action="music.unpublished.php" method="post">
                  <input type="hidden" name="id" value="<?php echo $id;?>">
                  <input type="submit" name="submit" class="w3-button w3-black" value="Manage">
                  <span class="" style="font-size:18px;padding-left:20px;">"<?php echo $title;?>"</span>
                </form>
                </div>
        </div>
              <?php
            }
            ?>
            <?php
          }else{
            ?>
            <div class="row w3-padding">
            <p>You have no unpublished albums. What's holding you back? Set a goal on your <a href="dash.php#tasks">task list</a></p>
          </div>
            <?php
          }
        }
?>

<style>
    #sSingle{
      background-color:#c2a23a;
    }
    #sAlbum{
      background-color:#c2a23a;
    }
    #submit{
      background-color:#c2a23a;
    }
    h2{
      color:#a99554;
    }
</style>
