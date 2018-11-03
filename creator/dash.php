<?php
require_once('../require.php');
//ouput variables for notifications sent from var.inc

//page url so forms can send user back to specific spot
?>
<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<html>
<!--Retrieve Head info -->
<style>
#music{
  background-image: url(https:/cagency.net/media/images/music.jpg);
  background-position: right;
  background-color:blue;
}
#blog{
  background-image: url(https://cagency.net/media/images/blog.jpg);
  background-position: left;
  background-color:blue;
}
</style>
<!-- end head tags -->
<body onload="" class="">
<div id="body" class="w3-light-grey" style="max-width:100%;padding-bottom: 20px;">
  <!-- Navbar -->
  <?php getHeader("creator"); ?>
  <!-- Navbar on small screens -->
  <!-- End Navbars -->
  <!-- Start Page Content -->
  <header class="" style="padding-top:40px;padding-bottom:30px;">
    <div class="container w3-white w3-card w3-padding">
          <div class="row text-center">
              <div class="col-sm-12"><img src="https://cagency.net/media/images/ccaBlue.png" class="w3-image" style=""/></div>
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
              <div class="col-sm-12 text-center"><?php getusercompanyinfo($pdo,$_SESSION['compID']);?></div>
          </div>

    </div>
  </header>
  <!-- Start Task List Container -->
    <div id="tasks" class="container w3-white w3-card w3-padding">
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
                    <?php selectTask($pdo,$_SESSION['compID']);?>
                  <!-- End Task List -->
              </div>
              <div id="addNew" class="" style="padding:0 20 15 20;"><hr class="w3-clear">
                   <div class="row" style="width:100%;">
                     <div class="text-center" style="width:70%;margin:auto;"><a href="https://cagency.net/CM3/dash.php#tasks"><h2>Add New Task</h2></a></div>
                   </div>
              <!-- This is where the PHP Functionality will go to retrieve information from the Tasks table and display them. -->
              <!-- End ADD NEW Task List -->
              </div>
          </div>
    </div>
    <hr>
  <!-- End Task List Container-->
        <?php //echo $groupMember_Insert_Error; ?>
        <div class="container">
          <a href=""><div id="" class="w3-display-container" style="width:100%;height:280px;background-color:blue;">
            <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">PROJECT MANAGEMENT</h1>
          </div></a>
          <hr class="w3-clear">
        <a href="create.music.php"><div id="music" class=" w3-display-container w3-grayscale" style="width:100%;height:280px;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">MUSIC</h1>
        </div></a>
        <hr class="w3-clear">
        <a href="blog.php"><div id="blog" class="w3-display-container w3-grayscale" style="width:100%;height:280px;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">BLOGS</h1>
        </div></a>
        <hr class="w3-clear">
        <a href="media.php?"><div id="blog" class="w3-display-container w3-grayscale" style="width:100%;height:280px;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">VIDEOS</h1>
        </div></a>
        <hr class="w3-clear">
        <a href="../settings.php?compID=<?php echo $_SESSION['compID'];?>"><div id="" class="w3-display-container" style="width:100%;height:280px;background-color:red;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">SETTINGS</h1>
        </div></a>
        <hr>
      </div>
  <br>
  <!-- Groups -->
  <div id="groups" class="container w3-white w3-card w3-padding">
    <div class="row text-left w3-padding"><h2>My Groups</h2><hr class="w3-clear"></div>
    <div class="row text-center">
    <p>You have started 0 Groups<button>Start Group</button></p>
    <p>You are part of 0 Groups<button>Search Openings</button></p>
    <br>
    <a href="groups.php"><div class="w3-btn w3-blue">Go To Groups Page</div></a>
    <br>
    </div>
  </div>
  <!-- End Groups -->
    <!-- End General Management -->
  <br>
  <div class="container w3-card w3-white w3-padding w3-margin-bottom">
    <a href="concerns.php"><div class="col-sm-12 text-center"><h2>Questions, Comments, Concerns?</h2></div></a>
  </div>
  <div class="row">
    <div class="col-sm-12 text-center"><a href="../index.php"><h1>VIEW WEBSITE</h1></a></div>
  </div>
</div>
</div>
<!--modals-->
<!--modals-->
</body>
<?php getFooter("creator"); ?>
