<?php
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
function getHeader(){
  ?>
  <div class="container-fluid">
  <div id="header">
      <div class="w3-black"><div class="text-center">
          <?php
        if(isset($_SESSION['compID']))
          { ?>
          <a class="" href="dash.php?compID=<?php echo $_SESSION['compID'];?>">
              <?php }else{ ?>
          <a href="dash.php">
        <?php } ?>
        <h2>
          <span class="">C</span>
          <span class="">M</span>
          <span class="">3</span>
        </h2>
      </a></div>
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
//Sticky Navigation
function getMtFooter() {
  ?>
  </div>
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
    <div class="w3-modal-content w3-black w3-padding">
      <div onclick="document.getElementById('siteMenu').style.display='none'" class="row"> X </div>
      <div class="row w3-text-white">
          <div class="col-sm-12"><h1 onclick="javascript:window.location.href='dash.php?compID=<?php echo $_SESSION['compID'];?>'">Dash</h1></div>
          <div class="col-sm-12"><h1 onclick="javascript:window.location.href='products.php?compID=<?php echo $_SESSION['compID'];?>'">Products</h1></div>
          <div class="col-sm-12"><h1 onclick="javascript:window.location.href=''">Statistics</h1></div>
          <div class="col-sm-12"><h1 onclick="javascript:window.location.href=''">CM3: Creator Suite</h1></div>
      </div>
      <div id="changePwd" class="container w3-red" style="display:none">
        <button class="w3-btn w3-yellow" onclick="document.getElementById('changePwd').style.display='none'">X</button>
      </div>
    </div>
  </div>
  </div>
  <footer class="w3-black">
    <div class="container text-center">
      <div class="row">
        <div class="col-sm-4">
          <h3>Manage:</h3>
            <ul style="list-style:none">
              <a href="choosecomp.php"><li>Change Company</li></a>
              <a href="settings.php?compID=<?php echo $_SESSION['compID'];?>"><li>Settings</li></a>
            </ul>
        </div>
        <div class="col-sm-4">
          <h3>Go To:</h3>
            <ul style="list-style:none">
              <a href="dash.php?compID=<?php echo $_SESSION['compID'];?>"><li>Tasks</li></a>
              <a href="concerns.php"><li>Submit QCC</li></a>
            </ul>
        </div>
        <div class="col-sm-4">
          <h3>Contact:</h3>
            <ul style="list-style:none">
              <a href="concerns.php"><li>Submit QCC</li></a>
            </ul>
        </div>
      </div>
    </div>
  </footer>
  <?php
}

function getFooter($cd){
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
                  <div class="col-sm-12"><h1 onclick="javascript:window.location.href='dash.php?compID=<?php echo $_SESSION['compID'];?>'">Dash</h1></div>
                  <div class="col-sm-12"><h1 onclick="javascript:window.location.href='products.php?compID=<?php echo $_SESSION['compID'];?>'">Products</h1></div>
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
<?php
}
?>
<?php
function getCrFooter() {
  ?>
  </div>
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
  <?php
}
?>
