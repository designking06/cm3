<?php
require 'inc/merchant.required.php';
//set page
$actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(isset($_GET['compID'])){
    $compID = $_GET['compID'];
    $_SESSION['compID'] = $compID;
}
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
                  <div class="col-sm-12"><img src="../../media/images/ccaBlue.png" class="w3-image" style=""/></div>
              </div>
              <!-- Welcome user & display general company information -->
              <div class="row text-center">
                <div class="col-sm-12">
                    <?php echo $_SESSION['compname'];?>
                </div>
              </div>
        </div>
      </header>
      <div class="container w3-card w3-white w3-padding">
          <div class="row">
          </div>
      </div>
        <?php //echo $groupMember_Insert_Error; ?>
        <div class="container w3-white w3-card w3-padding">
            <div class="text-center">
              <h2 class="w3-text-blue">Thank You For Purchasing!</h2>
              <p>View Your Order Details Below</p>
            </div>
            <div class="alert alert-success text-left">
              <p>
                <?php
                    if(isset($_GET['status'])){
                    switch($_GET['status']){
                      case "success":{?>
                        <?php echo $_GET['comp'];?><br>
                        <?php echo $_GET['orderid'];?><br>
                        <?php echo $_GET['custemail'];?><br>
                        <?php echo $_GET['products'];?><br>
                        <?php echo $_GET['ordernotes'];?><br>
                        <?php echo $_GET['date'];?><br>
                        <?php
                        break;
                      }
                      case "fail":{
                        echo $_GET['alert'];
                        break;
                      }
                    }
                  }
                ?>
              </p>
            </div>
          <div class="row">
            <div class="col-sm-12"><button class="btn btn-primary" onclick="window.location.href='sales.php';">Create New Sale</button></div>
          </div>
        </div>

<?php getFooter("merchant");?>
