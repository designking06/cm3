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
<?php getHead(); ?>
<?php
?>
<header class="container">
  <div class="text-center" style="width:100%;margin-top:20px;height:90px;">
      <div style="w3-padding"><img id="#ccaLogo" src="../media/images/ccawg.svg" class="w3-image" style="height:90px;"/></div>
  </div>
  <div class="row w3-text-white" style="text-align: center; padding-top: 30px;">
    <div class="col-sm-12"><h3 class="w3-text-green text-center">CM3 Creator</h3></div>
    <div class="col-sm-12"><h2 class="w3-jumbo w3-text-blue">Welcome</h2></div>
    <div class="col-sm-12"><h3 class="w3-text-grey">Please sign in.</h3></div>
  </div>
      <div class="row w3-margin">
        <div class="col-sm-6 text-center"><a href="#memberForm"><div class="w3-border w3-border-blue w3-padding">CREATOR LOGIN</div></a></div>
        <div class="col-sm-6 text-center"><a href="../merchant/"><div class="w3-green w3-padding">MERCHANT LOGIN</div></a></div>
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
<!-- LOGIN -->
         <div class="row">
           <div class="container">
             <div style="max-width:70%;margin:auto;">
<!-- LOGIN HERE -->
                     <div id="memberForm" style="text-align: center; margin-left: 4%; margin-right: 4%; padding-top: 40px;">
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
                                            <input id="loginSubmit" type="submit" class="form-control" name="loginSub" value="Log In" <?php echo $submit;?>>
                                   </div>
                           </form>
                     </div>
                   </div>
                 </div>
             </div>
</html>
