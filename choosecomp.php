<?php
require_once('require.php');
if(isset($_SESSION['compID'])){
  unset($_SESSION['compID']);
}
?>
<div id="body" class="w3-light-grey" style="max-width:100%;padding-bottom: 20px;">
  <!-- Navbar -->
  <?php getHeader("home"); ?>
  <!-- Navbar on small screens -->
  <!-- End Navbars -->
  <!-- Start Page Content -->
      <header class="" style="padding-top:40px;padding-bottom:50px;">
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
            <?php getusercompany($pdo,$uid);?>
    </div>
    <?php getFooter("merchant");?>
</div>
