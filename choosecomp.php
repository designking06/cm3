<?php
require_once('require.php');
?>
<?php getHeader("home"); ?>
<div id="body" class="" style="max-width:100%;padding-bottom:20px;min-height:80%;">
  <!-- Navbar -->
  <!-- Navbar on small screens -->
  <!-- End Navbars -->
  <!-- Start Page Content -->
      <header class="" style="padding-top:40px;;">
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
      <div class="w3-padding-64">
        <?php getusercompany($pdo,$uid,$_SESSION['permissions']['admin']);?>
      </div>
      <div class="row">
        <div class="col-sm-12 text-center">
          <a href="explorecm3.php"><h1>Explore CCA CM3</h1></a>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <?php if(isset($_GET['alert'])){?>
            <div class="alert alert-warning"><?php echo $_GET['alert'];?></div>
         <?php }?>
        </div>
      </div>
      <!-- modals -->
      <div id="panel" class="container" style="display:none;">
        <div class="w3-light-grey w3-padding-16">
          <div class-"container">
            <div class="row">
              <div class="col-sm-12 text-right">
               <span id="hidePanel" class="w3-hover-red w3-padding w3-btn" onclick="document.getElementById('panel').style.display='none'">Cancel</div>
              </div>
              <div class="row"><div class="col-sm-12 text-center">
                <h2>Register Your Business</h2>
                <p class="w3-small">Please Sign Up Below</p><hr class="w3-clear">
              </div></div>
              <div class="col-sm-12 text-center">
               <form method="post" action="access.php">
                 <div class="row"><div class="col-sm-12">
                   <legend class="w3-text-green">Business Information</legend>
                 </div></div>
                 <div class="row">
                   <div class="col-sm-12">
                     <label class="w3-text-blue">Business Name</label>
                     <input type="text" name="bname" placeholder="Business Name" class="form-control" required>
                   </div>
                   <div class="col-sm-12 w3-padding">
                     <label class="w3-text-blue">Business Email</label>
                     <input type="email" name="email" placeholder="Business Email" class="form-control" required>
                   </div>
                   <div class="col-sm-12 w3-padding" class="form-control">
                     <label class="w3-text-blue">Business Type:</label>
                     <select name="bindustry" class="form-control">
                       <option value="clothing">Clothing</option>
                       <option value="Jewelry">Education</option>
                       <option value="Entertainment/Media">Entertainment/Media</option>
                       <option value="Jewelry">Jewelry</option>
                       <option value="Manufacturing">Manufacturing</option>
                       <option value="Pharmaceuticals">Pharmaceuticals</option>
                       <option value="Jewelry">Transportation</option>
                     </select>
                   </div>
                 </div>
                 <div class="row">
                   <div class="col-sm-12">
                   <legend class="w3-text-green">Login Info</legend>
                   <p class="w3-small">This information will be used when your employees/partners need to join your business suite under a different login</p>
                    </div>
                  </div>
                 <div class="row">
                   <div class="col-sm-6">
                     <label class="w3-text-blue">Business Code</label>
                     <p class="w3-small">Example: CM3Login</p>
                     <input type="text" name="buname" placeholder="Desired Login Code" class="form-control" required>
                   </div>
                   <div class="col-sm-6">
                     <label class="w3-text-blue">Business Password</label>
                     <p class="w3-small">
                       <strong>Strong Passwords</strong> are <strong>long</strong> and include <strong>special characters</strong><br>
                       Example: cm3@cca!321
                     </p>
                     <input type="text" name="bpwd" placeholder="Desired Login Password" class="form-control" required>
                     <label class="w3-text-blue">Confirm Password</label>
                     <input type="text" name="cbpwd" placeholder="Confirmed Login Password" class="form-control" required>
                   </div>
                   <div class="col-sm-12 w3-padding">
                     <label>Finished?</label>
                     <input type="submit" name="newCompany" value="Register" class="form-control w3-green">
                   </div>
                 </div>
               </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- -->
</div>

<?php getFooter();?>
