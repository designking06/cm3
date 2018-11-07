<?php
require_once('require.php');
if(!isset($_GET['compID'])){
  header('location:choosecomp.php');
}else{
  $_SESSION['compID'] = $_GET['compID'];
}
//ouput variables for notifications sent from var.inc
//page url so forms can send user back to specific spot
?>
<?php
if(isset($_POST['deleteTask'])){
  $taskID = $_POST['taskID'];
  $page = $_POST['page'];
  if(deletetask($pdo,$taskID,$page)){
    $alertTask = "Task deleted.";
  }else{
    $alertTask = "There was an issue deleting your task.";
  }
}
if(isset($_POST['submitTask'])){
    $tn = $_POST['task'];
    $td = $_POST['description'];
    $ds = date('Y-m-d');
    $dd = $_POST['dueDate'];
    $ict = (int)0;
    if(newtask($pdo,$uid,$tn,$td,$ict,$_SESSION['compID'],$dd,$ds)){
      $alertTask = "New Task Added.";
    }
}
 ?>
<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<html>
<!--Retrieve Head info -->
<style>
  #music{
    background-image: url(https://cagency.net/media/images/music.jpg);
    background-position: right;
  }
  #blog{
    background-image: url(https://cagency.net/media/images/blog.jpg);
    background-position: left;
  }
</style>
<!-- end head tags -->
<body onload="" class="">
<div id="" class="w3-light-grey" style="max-width:100%;padding-bottom: 20px;">
    <?php getHeader("home"); ?>
  <!-- Start Page Content -->
  <header class="w3-margin" style="padding-top:;padding-bottom:;">
    <div class="container w3-white w3-card w3-padding">
          <div class="row text-center">
              <div class="col-sm-12"><img src="../media/images/ccaBlue.png" class="w3-image" style=""/></div>
          </div>
          <!-- Welcome user & display general company information -->
          <div class="row text-center">
            <div class="col-sm-12">
                <span class="w3-text-black">
              <h1>Welcome,
                <span class="w3-text-blue"><?php echo $_SESSION['name'];?></span>
              </h1>
              <p>Username: <?php echo $_SESSION['uname'];?></p>
                </span>
              </div>
          </div>
    </div>
  </header>
  <!-- Start Task List Container -->
    <div id="tasks" class="w3-margin">
      <div class="container w3-white w3-card w3-padding">
            <div class="" onclick="document.getElementById('taskContainer').style.display='block'">
              <h2>Task List</h2><hr class="w3-clear">
              <div class="row" style="width:100%;"><div class="col-sm-12"><h4>View, Edit and Add New Tasks to Complete</h4></div></div>
              <div class="row" style="width:100%;">
                <div class="col-sm-12">
                  <p><?php if(isset($alertTask)){echo $alertTask;}?></p>
                </div>
              </div>
            </div>
            <div id="taskContainer" style="display:none;">
              <div class="col-sm-12 text-right"><button class="btn-primary" onclick="document.getElementById('taskContainer').style.display='none';">Hide Tasks</button></div>
              <div id="viewDo" class="" style="padding:10 20 25 20;margin-bottom:20px;margin-top:20px;">
                  <!-- This is where the PHP Functionality will go to retrieve information from the Tasks table and display them. -->
                  <!-- this function is under inc/select.php -->
                    <?php selectTask($pdo,$uid);?>
                  <!-- End Task List -->
              </div>
              <div id="addNew" class="" style="padding:0 20 15 20;"><hr class="w3-clear">
                   <div class="row" style="width:100%;">
                     <div class="text-center" style="width:70%;margin:auto;"><h2>Add New Task</h2></div>
                   </div>
              <!-- This is where the PHP Functionality will go to retrieve information from the Tasks table and display them. -->
                  <div class="row">
                      <div class="text-center" style="max-width:60%;margin:auto;">
                          <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
                            Name of Task:<br>
                            <input type="text" name="task" class="form-control">
                            <br><br>
                            Description:<br>
                            <textarea name="description" class="form-control" placeholder="Optional Description for your task"></textarea>
                            <br>
                            Due Date:<br>
                            <input type="date" class="form-control" name="dueDate">
                            <input type="hidden" name="page" value="<?php echo $actual_link;?>">
                            <input type="hidden" name="userID" value="<?php echo $uid; ?>">
                            <input class="w3-btn w3-green" type="submit" name="submitTask" value="Submit Task">
                          </form>
                      </div>
                  </div>
              <!-- End ADD NEW Task List -->
              </div>
          </div>
        </div>
    </div>
  <!-- End Task List Container-->
  <div class="container w3-padding">
    <?php if(!isset($_SESSION['compID'])){ ?>
            <a href="explorecm3.php">
            <?php }else{ ?>
            <a href="merchant/dash.php">
            <?php  } ?>
            <div id="" class="w3-display-container w3-green" style="width:100%;height:280px;">
            <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">MERCHANT</h1>
            </div>
      </a>
        <hr class="w3-clear">
    <?php if(!isset($_SESSION['compID'])){ ?>
            <a href="explorecm3.php">
            <?php }else{ ?>
            <a href="creator/dash.php">
            <?php  } ?>
        <div id="music" class=" w3-display-container w3-sepia w3-grayscale" style="width:100%;height:280px;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">CREATOR</h1>
        </div>
      </a>
      <hr class="w3-clear">
      <a href=""><div id="blog" class="w3-display-container w3-grayscale" style="width:100%;height:280px;">
        <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">WEB</h1>
      </div></a>
  </div>
    <!-- End General Management -->
  <br>
  <div class="container w3-card w3-white w3-padding w3-margin-bottom">
    <a href="concerns.php"><div class="col-sm-12 text-center"><h2>Questions, Comments, Concerns?</h2></div></a>
  </div>
  <div class="row">
    <div class="col-sm-12 text-center">
      <?php getCompWebsite($pdo,$_SESSION['compID']);?>
    </div>
  </div>
</div>
</div>
<!--modals-->
<!--modals-->
</body>
<?php getFooter("creator"); ?>
<?php
//if user does not have company registered, replace page links with explore?view= merchant/creator
//<a href="explorecm3.php?view=merchant"><a href="explorecm3.php?view=creator"><a href="explorecm3.php?view=web">
?>
