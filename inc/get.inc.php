<?php
if(!isset($_SESSION['compID'])){
  $compID = "";
}else{
  $compID = $_SESSION['compID'];
}
function getHead(){
  ?>
  <head>
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
    <a class="navbar-brand" href="#"><p>CM3<br><span class="w3-hide-small w3-small">Assisted Management</span></p></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="https://cagency.net/dash.php?compID=<?php echo $compID;?>">Dashboard <span class="sr-only">(current)</span></a><!-- current directory dashboard-->
        </li>
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
                    <p class="w3-text-red" onclick="javascript:window.location.href='inc/logout.php'">Logout</p>
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
                    <p class="w3-text-red" onclick="javascript:window.location.href='inc/logout.php'">Logout</p>
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
          </div>
        </li>
      </ul>
  </nav>

  <?php
}
function getHeader2(){
  ?>
  <div class="container-fluid">
  <div id="header">
      <div class="w3-black">
        <div class="text-center">
            <?php
          if(isset($compID))
            { ?>
            <a class="" href="dash.php?compID=<?php echo $compID;?>">
                <?php }else{ ?>
            <a href="dash.php">
          <?php } ?>
          <h2>
            <span class="">C</span>
            <span class="">M</span>
            <span class="">3</span>
          </h2>
          <p class="w3-small w3-text-green">Assisted Management</p>
        </a>
      </div>
        <ul class="nav justify-content-center w3-black w3-padding">
          <li class="nav-item">
            <a class="nav-link active" onclick="document.getElementById('userMenu').style.display='block'">
                <h6 class="w3-text-blue">Account<span class="w3-hide-small"> :<span class="w3-text-green"><?php echo $_SESSION['uname'];?></span></span></h6>
              </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" onclick="document.getElementById('siteMenu').style.display='block'"><h6 class="w3-text-blue">Menu</h6></a>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#"><h6>Messages</h6></a>
          </li>
        </ul>
      </div>
  </div>
  <div class="" style="min-height:80%;">
<?php }
function getFooter(){
  ?>
    <footer class="w3-padding">
      <div class="container text-center">
        <div class="row">
          <div class="col-sm-12 text-center"><h4>CM3</h4><p>Assisted Management</p><hr class="w3-clear"></div>
        </div>
        <div class="row">
          <div class="col-sm-4">
            <h3>Manage:</h3>
            <div class="row">
                <div class="col-sm-12"><a href="choosecomp.php">Change Company</a></div>
                <div class="col-sm-12"><a href="settings.php">Settings</a></div>
              </div>
          </div>
          <div class="col-sm-4">
            <h3>Go To:</h3>
            <div class="row">
                <div class="col-sm-12"><a href="admin.php#tasks">Tasks</a></div>
                <div class="col-sm-12"><a href="concerns.php">Submit QCC</a></div>
              </div>
          </div>
          <div class="col-sm-4">
            <h3>Contact:</h3>
            <div class="row">
                <div class="col-sm-12"><a href="concerns.php">Submit QCC</a></div>
              </div>
          </div>
        </div>
      </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <?php
  }
//Sticky Navigation
function getFooter2(){
  ?>
  <div class="nav">
      <div id="userMenu" class="w3-modal container w3-black" style="display:none;">
        <div class="w3-modal-content w3-black w3-padding">
          <div class="row">
            <div class="col-sm-6" onclick="document.getElementById('userMenu').style.display='none'" class="row"> X </div>
            <div class="w3-btn col-sm-6" onclick="javascript:window.location.href='../inc/logout.php'" class="row text-right"> Logout </div>
          </div>
          <div class="row w3-text-white">
              <div class="col-sm-12"><h1 onclick="javascript:window.location.href='settings.php'">Settings</h1></div>
              <div class="col-sm-12"><div onclick="javascript:window.location.href='../choosecomp.php'"><h1>Change Company</h1></div></div>
              <div class="col-sm-12"><h1 onclick="javascript:window.location.href='concerns.php'">Report a Concern</h1></div>
              <?php
              if(isset($_SESSION['admin'])){
              if($_SESSION['admin'] == true){
              ?><h1 onclick="javascript:window.location.href='administer.php'">Admin</h1>
              <?php
              }
              }?>
          </div>
            <div id="changePwd" class="container w3-red" style="display:none">
                <button class="w3-btn w3-yellow" onclick="document.getElementById('changePwd').style.display='none'">X</button>
              </div>
        </div>
      </div>
      <div id="siteMenu" class="w3-modal container w3-black" style="display:none;">
      <?php
        switch($cd){
          case "merchant":{
            ?>
            <div class="w3-modal-content w3-black w3-padding">
              <div onclick="document.getElementById('siteMenu').style.display='none'" class="row"> X </div>
              <div class="row w3-text-white">
                  <div class="col-sm-12"><h1 onclick="javascript:window.location.href='dash.php?compID=<?php echo $compID;?>'">Dash</h1></div>
                  <div class="col-sm-12"><h1 onclick="javascript:window.location.href='products.php?compID=<?php echo $compID;?>'">Products</h1></div>
                  <div class="col-sm-12"><h1 onclick="javascript:window.location.href=''">Statistics</h1></div>
                  <div class="col-sm-12"><h1 onclick="javascript:window.location.href=''">CM3: Creator Suite</h1></div>
              </div>
              <div id="changePwd" class="container w3-red" style="display:none">
                <button class="w3-btn w3-yellow" onclick="document.getElementById('changePwd').style.display='none'">X</button>
              </div>
            </div>
            <?php
            break;
          }
          case "creator":{
            ?>
              <div class="w3-modal-content w3-black w3-padding">
                <div onclick="document.getElementById('siteMenu').style.display='none'" class="row"> X </div>
                <div class="row w3-text-white">
                    <div class="col-sm-12"><h1 onclick="javascript:window.location.href='dash.php'">Dash</h1></div>
                    <div class="col-sm-12"><h1 onclick="javascript:window.location.href='create.photo.php'">Photos</h1></div>
                    <div class="col-sm-12"><h1 onclick="javascript:window.location.href='blog.php'">Blog</h1></div>
                    <div class="col-sm-12"><h1 onclick="javascript:window.location.href='create.music.php'">Music</h1></div>
                </div>
                <div id="changePwd" class="container w3-red" style="display:none">
                  <button class="w3-btn w3-yellow" onclick="document.getElementById('changePwd').style.display='none'">X</button>
                </div>
              </div>
            <?php
            break;
          }
        }
      ?>
    </div>
    </div>
    <footer class="w3-black">
      <div class="container text-center">
        <div class="row">
          <div class="col-sm-4">
            <h3>Manage:</h3>
              <ul style="list-style:none">
                <a href="choosecomp.php"><li>Change Company</li></a>
                <a href="settings.php"><li>Settings</li></a>
              </ul>
          </div>
          <div class="col-sm-4">
            <h3>Go To:</h3>
              <ul style="list-style:none">
                <a href="admin.php#tasks"><li>Tasks</li></a>
                <a href="concerns.php"><li>Submit QCC</li></a>
              </ul>
          </div>
          <div class="col-sm-4">
            <h3>Contact:</h3>
              <ul style="list-style:none">
                <a href="concerns.php"><li>Submit QC</li></a>
              </ul>
          </div>
        </div>
      </div>
  </footer>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <?php
  }
?>
