<?php
require_once('require.php');
?>
<?php
if(isset($_POST['brandUpdate'])){
  $_SESSION['formalert'] = NULL;
  try{
    $stmt = $pdo->prepare('SELECT * FROM userbrand WHERE uid = ?');
    $stmt->execute([$uid]);
    $count = $stmt->rowCount();
    if($count > 0){
      $bio = $_POST['bio'];
      $stageName = $_POST['stageName'];
      $youtube = $_POST['youtube'];
      $soundcloud = $_POST['soundcloud'];
      $instagram = $_POST['instagram'];
      $snap = $_POST['snapchat'];
      $twitter = $_POST['twitter'];
      $uid = $_POST['uid'];
      //user has info inside table, update info
      $sql = "UPDATE userbrand SET stageName = ?, bio = ?,youtube = ?,soundcloud=?,instagram=?,snapchat=?,twitter=? WHERE uid = ?";
      $update = $pdo->prepare($sql)->execute([$stageName,$bio,$youtube, $soundcloud,$instagram,$snap,$twitter,(int)$uid]);
    if($update){
      $alert = 'successful updated entry';
    }else{
      echo 'something went wrong'. $e->getMessage();
    }}elseif($count == 0){
      $bio = $_POST['bio'];
      $stageName = $_POST['stageName'];
      $youtube = $_POST['youtube'];
      $soundcloud = $_POST['soundcloud'];
      $instagram = $_POST['instagram'];
      $snap = $_POST['snapchat'];
      $twitter = $_POST['twitter'];
      $uid = $_POST['uid'];
      //user has no info inside table, insert new info
      $sql = "INSERT INTO userbrand (stageName, bio,youtube,soundcloud,instagram,snapchat,twitter,uid) VALUES (?,?,?,?,?,?,?,?)";
      $insert = $pdo->prepare($sql)->execute([$stageName,$bio,$youtube,$soundcloud,$instagram,$snap,$twitter,(int)$uid]);
      if($insert){
      $alert = 'successful new entry';
      exit;
    }else{
      $alert = 'new entry didnt work';
    }
    }
  }catch(PDOException $e)
      {
      echo $e->getMessage();
      }
}
if(isset($_POST['contactUpdate'])){
  $_SESSION['formalert'] = NULL;
  try{
    $stmt = $pdo->prepare('SELECT * FROM users WHERE uid = ?');
    $stmt->execute([$uid]);
    $count = $stmt->rowCount();
    if($count > 0){
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $address = $_POST['address'];
      //user has info inside table, update info
      $sql = "UPDATE users SET email = ?, phone = ?,address = ? WHERE uid = ?";
      $update = $pdo->prepare($sql)->execute([$email,$phone,$address,(int)$uid]);
    if($update){
      $alert = 'successful updated entry';
    }else{
      $alert = 'nope didnt do it'. $e->getMessage();
    }}elseif($count == 0){
      session_destroy();
      header("location:login.php");
    }
  }catch(PDOException $e)
      {
      echo $e->getMessage();
      }
}
if(isset($_POST['generalUpdate'])){
  $_SESSION['formalert'] = NULL;
  try{
    $stmt = $pdo->prepare('SELECT * FROM users WHERE uid = ?');
    $stmt->execute([$uid]);
    $count = $stmt->rowCount();
    if($count > 0){
      $gender = $_POST['gender'];
      $city = $_POST['city'];
      //user has info inside table, update info
      $sql = "UPDATE users SET gender = ?, city = ? WHERE uid = ?";
      $update = $pdo->prepare($sql)->execute([$gender,$city,(int)$uid]);
    if($update){
      $alert = 'successful updated entry';
    }else{
      $alert = 'nope didnt do it'. $e->getMessage();
    }}elseif($count == 0){
      session_destroy();
      header("location:login.php");
    }
  }catch(PDOException $e)
      {
      echo $e->getMessage();
      }
}
if(isset($_POST['companyUpdate'])){
  $_SESSION['formalert'] = NULL;
  try{
    $stmt = $pdo->prepare('SELECT * FROM companies WHERE uid = ?');
    $stmt->execute([$uid]);
    $count = $stmt->rowCount();
    if($count > 0){
      $id = $_POST['id'];
      $address = $_POST['address'];
      $email = $_POST['email'];
      $tel = $_POST['tel'];
      $description = $_POST['description'];
      $website = $_POST['website'];
      $industry = $_POST['industry'];
      //user has info inside table, update info
      $sql = "UPDATE companies SET CompAddress = ?, CompEmail = ?,CompNum = ?,CompDesc=?,CompSite=?,CompInd=? WHERE uid = ?";
      $update = $pdo->prepare($sql)->execute([$address,$email,$tel, $description,$website,$industry,(int)$uid]);
    if($update){
      $alert = 'successful updated entry';
    }else{
      echo 'something went wrong'. $e->getMessage();
    }}elseif($count == 0){
      $id = $_POST['id'];
      $name = $_POST['name'];
      $address = $_POST['address'];
      $email = $_POST['email'];
      $tel = $_POST['tel'];
      $description = $_POST['description'];
      $website = $_POST['website'];
      $industry = $_POST['industry'];
      //user has no info inside table, insert new info
      $sql = "INSERT INTO companies (CompName,CompAddress, CompEmail,CompNum,CompDesc,CompSite,CompInd,uid) VALUES (?,?,?,?,?,?,?,?)";
      $insert = $pdo->prepare($sql)->execute([$name,$address,$email,$tel,$description,$website,$industry,(int)$uid]);
      if($insert){
      $alert = 'successful new entry';
      exit;
    }else{
      $alert = 'new entry didnt work';
    }
    }
  }catch(PDOException $e)
      {
      echo $e->getMessage();
      }
}
 ?>
<?php getHeader();?>
<h2>SETTINGS</h2>
<p><?php echo $alert; ?>
<h3><b>My Brand </b><button class="w3-btn w3-small" onclick="document.getElementById('brandSettings').style.display='block'">show</button></h3>
<p class="w3-small">stage name, bio, social media pages, logo</p>
<div id="brandSettings" style="display:none">
    <button class="w3-btn w3-red w3-small" onclick="document.getElementById('brandSettings').style.display='none'">hide</button><br><br>
      <div id="logo" class="input-group">
        Logo:<br>
        <input type="file" name="logo" class="form-control" value="<?php //echo $logo;?>"><br>
      </div>
<form id="brandForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
<?php  brandForm($pdo,$uid); ?>
</form>
</div>
<h3><b>General Info</b> <button class="w3-btn w3-small" onclick="document.getElementById('generalSettings').style.display='block'">show</button></h3>
<p class="w3-small">username, name, gender, city of origin</p>
<div id="generalSettings" class="container" style="display:none;">
  <button class="w3-btn w3-red w3-small" onclick="document.getElementById('generalSettings').style.display='none'">hide</button><br><br>
  <form method="POST" action="<?php $_SERVER['PHP_SELF'];?>">
  <?php generalForm($pdo,$uid);?>
  </form>
</div>
<h3><b>Contact Info </b><button class="w3-btn w3-small" onclick="document.getElementById('contactSettings').style.display='block'">show</button></h3>
<p class="w3-small">email, phone number, address</p>
<div id="contactSettings" style="display:none">
    <button class="w3-btn w3-red w3-small" onclick="document.getElementById('contactSettings').style.display='none'">hide</button><br><br>
    <form id="contactForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
    <?php contactForm($pdo,$uid); ?>
    </form>
</div>
<h3><b>Company Info </b><button class="w3-btn w3-small" onclick="document.getElementById('companySettings').style.display='block'">show</button></h3>
<p class="w3-small">name, address, email, phone number</p>
<div id="companySettings" style="display:none">
    <button class="w3-btn w3-red w3-small" onclick="document.getElementById('companySettings').style.display='none'">hide</button><br><br>
    <form id="companyForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="w3-form" style="max-width:300px;">
    <?php companyForm($pdo,$uid); ?>
    </form>
</div>
</div>
<?php getCrFooter();?>
