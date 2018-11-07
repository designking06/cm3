<?php
session_start();
include_once('../inc/get.inc.php');
if(!isset($_SESSION['badpass'])){
  $_SESSION['badpass'] = (int)0;
  $submit = '';
}else{
  $submit = '';
  if($_SESSION['badpass'] >= (int)5){
    $submit = 'disabled';
  }
}
?>
<html>
<?php include_once('inc/effects.js');?>
<?php getHead(); ?>
<?php
?>
<header class="container">
  <div class="text-center" style="width:100%;margin-top:20px;height:90px;">
      <div style="w3-padding"><img id="#ccaLogo" src="https://cagency.net/media/images/ccaBlue.png" class="w3-image" style="height:90px;"/></div>
  </div>
  <div class="row w3-text-white" style="text-align: center; padding-top: 30px;">
    <div class="col-sm-12"><h3 class="w3-text-green text-center">CM3</h3></div>
    <div class="col-sm-12"><h2 class="w3-jumbo w3-text-blue">Welcome</h2></div>
    <div class="col-sm-12"><h3 class="w3-text-grey">Please sign in.</h3></div>
  </div>
  </div>
</header>
 <div id="body" class="container-fluid" style="width: 100%;padding-bottom: 20px;">
<!-- END HEADER -->
     <div class="row">
         <div class="container">
           <div style="max-width:80%; margin:auto;">
             <div class="w3-white w3-border w3-border-blue w3-opacity" style="min-height:175px;">
                 <h3 class="w3-padding text-left">
                     The revolutionary management app, created to help anyone faced with making decisions.<br>Take advantage of our statistics capabilities, storage space, customer service, client management and more.
                     CM3 Creator: art, blogs, music, tasks, polls. Manage, share, edit, gather statistics from your website
                 </h3>
             </div>
           </div>
           </div>
     </div>
     <div class="row">
       <div class="col-sm-12">
         <?php if(isset($_GET['alertStatus'])){?>
           <div class="alert alert-warning"><?php echo $_GET['alertStatus'];?></div>
        <?php }?>
       </div>
     </div>
<!-- LOGIN -->
         <div class="row">
           <div class="container">
             <div style="max-width:70%;margin:auto;">
<!-- LOGIN HERE -->
                     <div id="memberForm" style="text-align: center; margin-left: 4%; margin-right: 4%; padding-top: 40px;">
                       <?php
                       session_start();
                       if(!isset($_SESSION['uid'])){ ?>
                         MEMBER LOGIN
                             <form method="POST" action="access.php">
                                     <div class="input-group">
                                              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                               <input id="uid" type="text" class="form-control" name="uname">
                                     </div>
                                     <br><p>ATTENTION: CM3 HAS NO ACCESS TO YOUR PASSWORD, IF YOU LOSE IT, YOU MUST RESET IT.<br> DONT LOSE IT.</p>
                                     <div class="input-group">
                                               <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                               <input id="password" type="password" class="form-control" name="pwd" placeholder="Password">
                                     </div>
                                     <br>
                                     <p> You have entered incorrect info <span class="w3-text-red"><?php echo $_SESSION['badpass']; ?></span> out of 5 times</p>
                                     <div class="input-group">
                                              <input id="loginSubmit" type="submit" class="form-control w3-green" name="loginSub" value="Log In" <?php echo $submit;?>>
                                     </div>
                             </form>
                              <div class="row w3-padding"><div class="col-sm-12"><button id="controller" class="btn btn-primary">Sign Up</button></div></div>
                        <?php }else{ ?>
                         <div class="row">
                           <div class="col-sm-12"><h1>You Are Already Logged In.</h1></div>
                           <div class="col-sm-6"><button onclick="window.location.href='choosecomp.php'" class="w3-btn w3-green w3-hover-blue">Enter</button></div>
                           <div class="col-sm-6"><button onclick="window.location.href='inc/logout.php'" class="w3-btn w3-red w3-hover-orange">Logout</button></div>
                         </div>
                          <?php }?>
                     </div>
                   </div>
                 </div>
             </div>
             <!-- modals -->
             <div id="panel" class="container" style="display:none;">
               <div class="w3-light-grey w3-padding-16">
                 <div class-"container">
                   <div class="row">
                     <div class="col-sm-12">
                       <?php if(isset($_GET['alert'])){?>
                         <div class="alert alert-warning"><?php echo $_GET['alert'];?></div>
                      <?php }?>
                     </div>
                   </div>
                   <div class="row">
                     <div class="col-sm-12 text-right">
                      <span id="hidePanel" class="w3-hover-red w3-padding w3-btn" onclick="document.getElementById('panel').style.display='none'">Cancel</div>
                     </div>
                     <div class="row"><div class="col-sm-12 text-center">
                       <h2>Welcome!</h2><p class="w3-small">Please Sign Up Below</p><hr class="w3-clear"></div></div>
                     <div class="col-sm-12 text-center">
                      <form method="post" action="access.php">
                        <div class="row"><div class="col-sm-12"><legend class="w3-text-green">Your Information</legend></div></div>
                        <div class="row">
                          <div class="col-sm-6">
                            <label class="w3-text-blue">First Name</label>
                            <input type="text" name="fname" placeholder="First Name" class="form-control" required>
                          </div>
                          <div class="col-sm-6">
                            <label class="w3-text-blue">Last Name</label>
                            <input type="text" name="lname" placeholder="Last Name" class="form-control" required>
                          </div>
                          <div class="col-sm-12 w3-padding">
                            <label class="w3-text-blue">Email</label>
                            <input type="email" name="email" placeholder="Email" class="form-control" required>
                          </div>
                        </div>
                        <div class="row"><div class="col-sm-12"><legend class="w3-text-green">Login Info</legend></div></div>
                        <div class="row">
                          <div class="col-sm-6">
                            <label class="w3-text-blue">Username</label>
                            <input type="text" name="uname" placeholder="Desired Username" class="form-control" required>
                          </div>
                          <div class="col-sm-6">
                            <label class="w3-text-blue">Password</label>
                            <p class="w3-small"><strong>Strong Passwords</strong> are <strong>long</strong> and include <strong>special characters</strong></p>
                            <input type="text" name="pwd" placeholder="Desired Password" class="form-control" required>
                            <label class="w3-text-blue">Confirm Password</label>
                            <input type="text" name="cpwd" placeholder="Confirmed Password" class="form-control" required>
                          </div>
                          <div class="col-sm-12 w3-padding">
                            <label>Finished?</label>
                            <input type="submit" name="newUser" value="Sign Up" class="form-control w3-green">
                          </div>
                        </div>
                      </form>
                     </div>
                   </div>
                 </div>
               </div>
             </div>

             <!-- -->
</html>
