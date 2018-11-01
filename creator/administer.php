<?php
require_once('../require.php');
getHeader();
?>
<?php
//VALIDATE ADMIN
$stmt = "SELECT permissions FROM users WHERE uid = ?";
$select = $pdo->prepare($stmt);
$select->execute([$uid]);
while($row = $select->fetch()){
  $permission = $row['permissions'];
}
if($permission != "AA"){
  //create table to record breach attempts
  header("location:settings.php");
  exit;
}else{ ?>
  <?php
  // THIS IS THE REGISTRSTION form
if(isset($_POST['registerSub'])){
        $p1 = $_POST['fname'];
        $p2 = $_POST['lname'];
        $p3 = $_POST['email'];
        $p4 = $_POST['uname'];
        $p5 = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        if($p4 == NULL){
          echo 'Please enter a username';
        }
        if($p5 == NULL){
          echo ' please enter a password';
        }
        if($cpwd == NULL){
          echo 'please confrim your password';
        }
        if( $p5 != $cpwd){
          echo 'please make sure the passwords match';
        }else{
          $hashpwd = password_hash($p5, PASSWORD_DEFAULT);
          $p6 = date("y-m-d");
          $p7 = "r";
          try{
          $stmt = "INSERT INTO users (uname,pwd,fname,lname,email,reg_date,permissions) VALUES (?,?,?,?,?,?,?)";
          $insert = $pdo->prepare($stmt);
          $insert->execute([$p1,$p2,$p3,$p4,$p5,$p6,$p7]);
          if($insert){
            $alert = "Successful Insert";
          }else{
            $alert = "Hm.";
          }
        }catch(PDOException $e){
          $alert= $e->getMessage();
        }
        }
  }
if(isset($_POST['registerPendingSub'])){
        $p1 = $_POST['fname'];
        $p2 = $_POST['lname'];
        $p3 = $_POST['email'];
        $p4 = $_POST['uname'];
        $pwd = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        if($p4 == NULL){
          echo 'Please enter a username';
        }
        if($pwd == NULL){
          echo ' please enter a password';
        }
        if($cpwd == NULL){
          echo 'please confrim your password';
        }
        if( $pwd != $cpwd){
          echo 'please make sure the passwords match';
        }else{
          $p5 = password_hash($pwd, PASSWORD_DEFAULT);
          $p6 = "1";
          $p9 = date("Y-m-d");
          $p7 = "pd";
          try{
          $stmt = "INSERT INTO users (fname,lname,email,uname,pwd,merchant,permissions) VALUES (?,?,?,?,?,?,?)";
          $insert = $pdo->prepare($stmt);
          $insert->execute([$p1,$p2,$p3,$p4,$p5,$p6,$p7]);
          if($insert){
            $alert = "Successful Insert";
          }else{
            $alert = "Hm.";
          }
        }catch(PDOException $e){
          $alert= $e->getMessage();
        }
        }
  }
if(isset($_POST['validatePending'])){
        $uid = $_POST['uid'];
        $permissions = $_POST['permissions'];
      try{
        $stmt = "UPDATE users SET permissions =? WHERE uid=?";
        $update = $pdo->prepare($stmt);
        $update->execute([$_POST['permissions'],$_POST['uid']]);
        if($update){
        $alert= "Successful Update";
        }else{
        $alert= "unsuccessful update.";
        }
    }catch(PDOException $e){
      $alert = $e->getMessage();
    }
  }
if(isset($_POST['restoreBlocked'])){
        $uid = $_POST['uid'];
        $permissions = $_POST['permissions'];
          try{
        $stmt = "UPDATE users SET permissions =? WHERE uid=?";
        $update = $pdo->prepare($stmt);
        $update->execute([$_POST['permissions'],$_POST['uid']]);
        if($update){
        $alert= "Successful Update";
        }else{
        $alert= "unsuccessful update.";
        }
    }catch(PDOException $e){
      $alert = $e->getMessage();
    }
  }
if(isset($_POST['registerPendingSub_depr'])){
        $p1 = $_POST['fname'];
        $p2 = $_POST['lname'];
        $p3 = $_POST['email'];
        $p4 = $_POST['uname'];
        $p5 = $_POST['pwd'];
        $cpwd = $_POST['cpwd'];
        if($p4 == NULL){
          echo 'Please enter a username';
        }
        if($p5 == NULL){
          echo ' please enter a password';
        }
        if($cpwd == NULL){
          echo 'please confrim your password';
        }
        if( $p5 != $cpwd){
          echo 'please make sure the passwords match';
        }else{
          $p6 = password_hash($p5, PASSWORD_DEFAULT);
          $p7 = "r";
          $p8 = date("Y-m-d");
          try{
          $stmt = "INSERT INTO pendingUser (fname,lname,email,uname,pwd,hpwd,date) VALUES (?,?,?,?,?,?,?)";
          $insert = $pdo->prepare($stmt);
          $insert->execute([$p1,$p2,$p3,$p4,$p5,$p6,$p8]);
          if($insert){
            $alert = "Successful Insert";
          }else{
            $alert = "Hm.";
          }
        }catch(PDOException $e){
          $alert= $e->getMessage();
        }
        }
  }
   ?>
<div class="container" style="min-height:80%;">
  <h2>Administration Page</h2>
  <?php echo $alert;?>
    <h3>Pending Users</h3>
    <?php getPending($pdo);?>
    <h3>Blocked Users</h3>
    <?php getBlocked($pdo);?>
  </div>

  <div class="row">
    <p><button onclick="countUsers();" class="w3-btn w3-blue">Count Users</button> <span id="countUsers" class="w3-large"></span></p>
  </div>
<b>Register New</b> <button class="w3-btn" onclick="document.getElementById('manageUsers').style.display='block'">show</button><br><br>
<div id="manageUsers" style="display:none">
    <button class="w3-btn w3-red" onclick="document.getElementById('manageUsers').style.display='none'">hide</button><br><br>
<div class="row">
  <div class="container">
    <div style="max-width:70%;margin:auto;">
            <!-- Insert New User-->
           <div id="form" style="text-align: center; margin-left: 4%; margin-right: 4%; padding-top: 40px;">
                  MEMBER REGISTER
                  <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                          <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="fname" type="text" class="form-control" name="fname" placeholder="first name">
                          </div>
                          <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="lname" type="text" class="form-control" name="lname" placeholder="last name">
                          </div>
                          <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="email" type="text" class="form-control" name="email" placeholder="email">
                          </div>
                          <div class="input-group">
                                   <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input id="uid" type="text" class="form-control" name="uname" placeholder="username">
                          </div>
                          <br><p>ATTENTION: CM3 HAS NO ACCESS TO YOUR PASSWORD, IF YOU LOSE IT, YOU MUST RESET IT.<br> DONT LOSE IT.</p>
                          <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="pwd" placeholder="Password">
                          </div>
                          <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input id="password" type="password" class="form-control" name="cpwd" placeholder=" Confirm Password">
                          </div>
                        <br>
                          <div class="input-group">
                                   <input id="loginSubmit" type="submit" class="form-control" name="registerPendingSub" value="REGISTER">
                          </div>
                  </form>
            </div>
            <!-- End Insert -->
          </div>
        </div>
    </div>
</div><br>

<?php getCrFooter();?>
<?php } ?>
<?php
function getPendin(PDO $pdo){
    if($_SESSION['admin'] = 'validated'){
      try{
        $stmt = "SELECT * FROM pendingUser";
        $select= $pdo->prepare($stmt);
        $select->execute();
        $count = $select->rowCount();
        if($count>0){
          ?>
          <table class="table" style="overflow-x:scroll;">
            <tr>
              <td class="w3-text-green">accept</td>
              <td class="w3-text-red">reject</td>
              <td>First</td>
              <td>Last</td>
              <td>Email</td>
              <td>Uname</td>
              <td>Pwd</td>
              <td>Hpwd</td>
            </tr>
            <?php
            while($row = $select->fetch(PDO::FETCH_ASSOC)) {
            // code...
            $id = $row['id'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $uname = $row['uname'];
            $pwd = $row['pwd'];
            $hpwd = $row['hpwd'];
            ?>
            <tr>
              <td class="w3-border-right">
                <form action="administer.php" method="POST">
                      <input type="hidden" name="id" value="<?php echo $id;?>"><input type="hidden" name="permissions" value="r">
                      <input type="submit" class="w3-btn w3-green" name="restoreBlocked" value="restore">
                  </form><button class="button w3-green">accept</button></td>
              <td class="w3-border-right"><button class="button w3-red">reject</button></td>
              <td><?php echo $fname;?></td>
              <td class="w3-border-right"><?php echo $lname;?></td>
              <td class="w3-border-right"><?php echo $email;?></td>
              <td class="w3-border-right"><?php echo $uname;?></td>
              <td class="w3-border-right"><?php echo $pwd;?></td>
              <td class="w3-border-right"><?php echo $hpwd;?></td>
            </tr>
<?php       }
        }
        echo '</table';
      }catch(PDOException $e){
          echo $e->getMessage();
        }
    }else{
      session_destroy();
      header("location:dash.php");
    }
}
function getPending(PDO $pdo){
    if($_SESSION['admin'] = 'validated'){
      try{
        $stmt = "SELECT * FROM users WHERE permissions = ?";
        $select= $pdo->prepare($stmt);
        $select->execute(['pd']);
        $count = $select->rowCount();
        if($count>0){
          ?>
          <table class="table" style="overflow-x:scroll;">
            <tr>
              <td class="w3-text-green">accept</td>
              <td class="w3-text-red">reject</td>
              <td>First</td>
              <td>Last</td>
              <td>Email</td>
              <td>Uname</td>
            </tr>
            <?php
            while($row = $select->fetch(PDO::FETCH_ASSOC)) {
            // code...
            $uid = $row['uid'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $uname = $row['uname'];
            ?>
            <tr>
              <td class="w3-border-right">
                  <form action="administer.php" method="POST">
                      <input type="hidden" name="uid" value="<?php echo $uid;?>"><input type="hidden" name="permissions" value="r">
                      <input type="submit" class="w3-btn w3-green" name="validatePending" value="accept">
                  </form>
                </td>
              <td class="w3-border-right">
                  <form action="administer.php" method="POST">
                      <input type="hidden" name="uid" value="<?php echo $uid;?>"><input type="hidden" name="permissions" value="X">
                      <input type="submit" class="w3-btn w3-green" name="validatePending" value="Quarantine">
                  </form></td>
              <td><?php echo $fname;?></td>
              <td class="w3-border-right"><?php echo $lname;?></td>
              <td class="w3-border-right"><?php echo $email;?></td>
              <td class="w3-border-right"><?php echo $uname;?></td>
            </tr>
<?php       }
        }
        ?>
        </table>
<?php ;
      }catch(PDOException $e){
          echo $e->getMessage();
        }
    }else{
      session_destroy();
      header("location:dash.php");
    }
}
function getBlocked(PDO $pdo){
    if($_SESSION['admin'] = 'validated'){
      try{
        $stmt = "SELECT * FROM users WHERE permissions = ?";
        $select= $pdo->prepare($stmt);
        $select->execute(['bl']);
        $count = $select->rowCount();
        if($count>0){
          ?>
          <table class="table" style="overflow-x:scroll;">
            <tr>
              <td class="w3-text-green">accept</td>
              <td class="w3-text-red">reject</td>
              <td>First</td>
              <td>Last</td>
              <td>Email</td>
              <td>Uname</td>
            </tr>
            <?php
            while($row = $select->fetch(PDO::FETCH_ASSOC)) {
            // code...
            $uid = $row['uid'];
            $fname = $row['fname'];
            $lname = $row['lname'];
            $email = $row['email'];
            $uname = $row['uname'];
            ?>
            <tr>
              <td class="w3-border-right">
                  <form action="administer.php" method="POST">
                      <input type="hidden" name="uid" value="<?php echo $uid;?>"><input type="hidden" name="permissions" value="r">
                      <input type="submit" class="w3-btn w3-green" name="restoreBlocked" value="restore">
                  </form>
                </td>
              <td class="w3-border-right"><button class="button w3-red">reject</button></td>
              <td><?php echo $fname;?></td>
              <td class="w3-border-right"><?php echo $lname;?></td>
              <td class="w3-border-right"><?php echo $email;?></td>
              <td class="w3-border-right"><?php echo $uname;?></td>
            </tr>
<?php       }
        }
        echo '</table';
      }catch(PDOException $e){
          echo $e->getMessage();
        }
    }else{
      session_destroy();
      header("location:dash.php");
    }
}
 ?>
