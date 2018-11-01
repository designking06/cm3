<?php
require_once('../require.php');
//ouput variables for notifications sent from var.inc

//page url so forms can send user back to specific spot
?>
<?php
if(isset($_POST['deleteTask'])){
  $taskID = $_POST['taskID'];
  $page = $_POST['page'];
  $stmt = "DELETE FROM tasks WHERE id = ?";
  $delete = $pdo->prepare($stmt);
  $delete->execute([$taskID]);
  if($delete){
    header("location: $page");
  }
}
if(isset($_POST['submitTask'])){
    $p1 = $_POST['task'];
    $p2 = $_POST['description'];
    $uid = $_SESSION['uid'];
    $compID = $_SESSION['compID'];
    $p4 = date('Y-m-d');
    $compTask = (int)1;
    $stmt = "INSERT INTO tasks (task,description,companyTask,uid,CompID,dateSet) VALUES (?,?,?,?,?,?)";
    $insert = $pdo->prepare($stmt)->execute([$p1,$p2,$compTask,$uid,$compID,$p4]);
    if($insert){
      //new task inserted
    }else{
      echo "Failed connecting to server";
    }

}
 ?>
<?php $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";?>
<html>
<!--Retrieve Head info -->
<style>
#music{
  background-image: url(https:/cagency.net/media/images/music.jpg);
  background-position: right;
  background-color:red;
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
  <?php getHeader(); ?>
  <!-- Navbar on small screens -->
  <!-- End Navbars -->
  <!-- Start Page Content -->
  <header class="" style="padding-top:40px;padding-bottom:30px;">
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
              <div class="col-sm-12 text-center"><?php getusercompanyinfo($pdo,$_SESSION['compID']);?></div>
          </div>

    </div>
  </header>
  <!-- Start Task List Container -->
    <div id="tasks" class="container w3-white w3-card w3-padding">
            <div class="" onclick="document.getElementById('taskContainer').style.display='block'">
              <h2>Task List</h2><hr class="w3-clear">
              <div class="row" style="width:100%;"><div class="col-sm-12"><h4>View, Edit and Add New Tasks to Complete</h4></div></div>
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
    <hr>
  <!-- End Task List Container-->
        <?php //echo $groupMember_Insert_Error; ?>
        <div class="container">
          <a href=""><div id="" class="w3-display-container" style="width:100%;height:280px;background-color:blue;">
            <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">PROJECT MANAGEMENT</h1>
          </div></a>
          <hr class="w3-clear">
        <a href="create.music.php?compID=<?php echo $_SESSION['compID'];?>"><div id="music" class=" w3-display-container w3-sepia w3-grayscale" style="width:100%;height:280px;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">MEDIA</h1>
        </div></a>
        <hr class="w3-clear">
        <a href="blog.php?compID=<?php echo $_SESSION['compID'];?>"><div id="blog" class="w3-display-container w3-grayscale" style="width:100%;height:280px;">
          <h1 class="w3-text-white w3-display-middle w3-xxxlarge" style="">BLOGS</h1>
        </div></a>
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
<div id="mediaMenu" class="container" >
  <div class="row"><div class="col-sm-12 text-right"><span class="w3-hover-red w3-padding" style="width:20px;">X</span></div></div>
  <div class="row w3-margin">
    <div class="col-sm-6 w3-padding btn btn-primary ">music</div>
    <div class="col-sm-6 w3-padding btn btn-primary ">blogs</div>
  </div>
</div>
<!--modals-->
</body>
<?php getCrFooter(); ?>
