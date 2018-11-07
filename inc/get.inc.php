<?php
if(!isset($_SESSION['compID'])){
  $compID = "";
}else{
  $compID = $_SESSION['compID'];
}
function getHead(){
  ?>
  <head>
  <link rel="icon" type="image/png" href="https://cagency.net/media/images/ccaBlue.png">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/new_w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </head>
    <?php
    }?>
    <?php
function getHeader($cd){
  global $compID;
  ?>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
    <?php if(!empty($compID)){?>
      <a class="navbar-brand" href="https://cagency.net/CM3/dash.php?compID=<?php echo $compID;?>">
        <p>CM3<br><span class="w3-hide-small w3-small">Assisted Management</span></p>
      </a> <?php }else{?>
        <p>CM3<br><span class="w3-hide-small w3-small">Assisted Management</span></p>
      <?php } ?>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <?php if(!empty($compID)){?>
          <li class="nav-item active">
            <a class="nav-link" href="https://cagency.net/CM3/dash.php?compID=<?php echo $compID;?>">Dashboard <span class="sr-only">(current)</span></a><!-- current directory dashboard-->
          </li>
         <?php }else{?>
           <li class="nav-item active">
             <a class="nav-link" href="https://cagency.net/CM3/choosecomp.php">Choose Company<span class="sr-only">(current)</span></a><!-- current directory dashboard-->
           </li>
          <?php } ?>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Navigate
          </a>
          <div class="dropdown-menu w3-padding" aria-labelledby="navbarDropdownMenuLink">
                <!-- Switch statement for menu -->
                <?php
                switch($cd){
                  case "home":{?>
                    <p onclick="javascript:window.location.href='choosecomp.php'">Change Company</p>
                    <p onclick="javascript:window.location.href='settings.php'">Settings</p>
                    <hr>
                    <p class="w3-text-blue" onclick="javascript:window.location.href='https://cagency.net/CM3/creator/dash.php'">CM3: Creator</p>
                    <p class="w3-text-green" onclick="javascript:window.location.href='https://cagency.net/CM3/merchant/dash.php'">CM3: Merchant</p>
                    <hr>
                    <p class="w3-text-red" onclick="javascript:window.location.href='https://cagency.net/CM3/inc/logout.php'">Logout</p>
                    <?php
                    break;}
                  case "merchant":{
                    ?>
                    <p onclick="javascript:window.location.href='dash.php?compID=<?php echo $compID;?>'">Dash</p>
                    <p onclick="javascript:window.location.href='products.php?compID=<?php echo $compID;?>'">Products</p>
                    <p onclick="javascript:window.location.href='sales.php'">Sales/Expenses</p>
                    <p onclick="javascript:window.location.href='https://stripe.dashboard.com'">Stats</p>
                    <hr>
                    <p class="w3-text-blue" onclick="javascript:window.location.href='https://cagency.net/CM3/creator/dash.php'">Go to CM3: Creator</p>
                    <hr>
                    <p class="w3-text-red" onclick="javascript:window.location.href='https://cagency.net/CM3/inc/logout.php'">Logout</p>
                    <?php
                    break;}
                  case "creator" :{
                    ?>
                    <p onclick="javascript:window.location.href='dash.php?compID=<?php echo $compID;?>'">Dash</p>
                    <p onclick="javascript:window.location.href='create.photo.php'">Photos</p>
                    <p onclick="javascript:window.location.href='blog.php'">Blog</p>
                    <p onclick="javascript:window.location.href='create.music.php'">Music</p>
                    <hr>
                    <p class="w3-text-green" onclick="javascript:window.location.href='https://cagency.net/CM3/merchant/dash.php'">Go to CM3: Merchant</p>
                    <hr>
                    <p class="w3-text-red" onclick="javascript:window.location.href='inc/logout.php'">Logout</p>
                    <?php
                    break;}
                } ?>
            </div>
          </li>
        </ul>
      </div></div>
  </nav>

  <?php
}
function getFooter(){
    global $compID;
  ?>
    <div class="container-fluid w3-light-grey w3-padding-32">
      <div class="container text-center">
        <div class="row">
          <div class="col-sm-12 text-center">
            <a href="https://cagency.net/CM3/dash.php?compID=<?php echo $compID;?>">
              <h4>CM3</h4>
              <p>Assisted Management</p>
            </a><hr class="w3-clear">
          </div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h3>Manage:</h3>
            <div class="row">
                <div class="col-sm-12"><a href="https://cagency.net/CM3/choosecomp.php">Change Company</a></div>
                <div class="col-sm-12"><a href="https://cagency.net/CM3/settings.php">Settings</a></div>
              </div>
          </div>
          <div class="col-sm-4">
            <h3>Go To:</h3>
            <div class="row">
                <div class="col-sm-12"><a href="https://cagency.net/CM3/dash.php?compID=<?php echo $compID;?>#tasks">Tasks</a></div>
                <div class="col-sm-12"><a href="https://cagency.net/CM3/concerns.php">Submit QCC</a></div>
              </div>
          </div>
          <div class="col-sm-4">
            <h3>Contact:</h3>
            <div class="row">
                <div class="col-sm-12"><a href="https://cagency.net/CM3/concerns.php">Submit QCC</a></div>
              </div>
          </div>
        </div>
      </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <?php
  }
//Sticky Navigation
?>
