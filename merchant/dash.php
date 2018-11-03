<?php
require_once('inc/merchant.required.php');
//set page
?>
<!--Retrieve Head info -->
<div id="body" class="w3-light-grey" style="max-width:100%;padding-bottom: 20px;">
  <!-- Navbar -->
  <?php getHeader("merchant"); ?>
  <!-- Navbar on small screens -->
  <!-- End Navbars -->
  <!-- Start Page Content -->
      <header class="" style="padding-top:40px;padding-bottom:50px;">
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
              </div>
        </div>
      </header>
        <?php //echo $groupMember_Insert_Error; ?>
    <div id="choosePath" class="container w3-white w3-card w3-padding">
        <div class="row text-center">
            <div class="col-sm-12"><h2> What would you like to manage?</h2></div>
        </div>
        <!-- Row for general options for company: clients, media, settings, products-->
        <div class="row">
          <div class="col-sm-4 text-center"><a href="products.php?compID=<?php echo $_SESSION['compID'];?>"><h3 class="w3-text-yellow">Products</h3></a><p class="w3-small">Add, Edit & View: Products & Product Lines</p><a href="sales.php?compID=<?php echo $_SESSION['compID'];?>"><h3 class="w3-text-green">Sales</h3></a></div>
          <div class="col-sm-4 text-center"><a href="settings.php"><h3 class="w3-text-red">Settings</h3></a><p class="w3-small">Billing & Receiving Info</p></div>
          <div class="col-sm-4 text-center"><a href="https://dashboard.stripe.com/dashboard" target="_blank"><h3 class="w3-text-blue">Statistics</h3></a><p class="w3-small">Revenues and Expenses</p></div>
        </div>
    </div>
    <hr>
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
                       <div class="text-center" style="width:70%;margin:auto;">
                         <a href="https://cagency.net/CM3/dash.php#tasks"><h2>Add New Task</h2></a></div>
                     </div>
                <!-- This is where the PHP Functionality will go to retrieve information from the Tasks table and display them. -->
                <!-- End ADD NEW Task List -->
                </div>
            </div>
      </div>
      <hr>
    <!-- End Task List Container-->
  <div class="container w3-card w3-white w3-padding">
    <a href="concerns.php"><div class="col-sm-12 text-center"><h2>Questions, Comments, Concerns?</h2></div></a>
  </div>
  <div class="row">
    <div class="col-sm-12 text-center"><a href="../index.php"><h1>VIEW WEBSITE</h1></a></div>
  </div>
    </div>
<?php getFooter("merchant"); ?>
