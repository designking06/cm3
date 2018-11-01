<?php
require_once('../require.php');
getHeader();
?>
<?php
if(isset($_POST['updateBlog'])){
  $p1 = $_POST['blogContent'];
  $p2 = $_POST['id'];
  $p3 = $_POST['uid'];
  try{
  $stmt = "UPDATE blog SET blogContent = ? WHERE id = ? AND uid = ?";
  $update = $pdo->prepare($stmt)->execute([$p1,$p2,$p3]);
  if($update){
    $alert = "Successful Update";
  }else{
    $alert = "Something went wrong.";
  }}
  catch(PDOException $e){
    echo $e->getMessage();
  }

}
if(isset($_POST['deleteBlog'])){
  $p1 = $_POST['id'];
  $p2 = $_POST['uid'];
  try{
  $stmt = "DELETE FROM blog WHERE id = ? AND uid = ?";
  $update = $pdo->prepare($stmt)->execute([$p1,$p2]);
  if($update){
    $alert = "Successful Update";
  }else{
    $alert = "Something went wrong.";
  }}
  catch(PDOException $e){
    echo $e->getMessage();
  }

} ?>
<body class="container-fluid w3-light-grey">

<div class="container" style="height:100%;">
    <div class="row"><h1>Your Blogs</h1><h4 class="w3-text-red"><?php echo $alert;?></h4></div>
<div class="w3-padding" style="">
  <div class="row"><a href="create.blog.php"><h3>Add New Blog</h3></a></div>
  <hr class="w3-clear">
  <div class="row">
      <div class="row w3-margin"><h3>Recent Blogs</h3></div>
      <div class="row">
<?php
$uid = $_SESSION['uid'];
$stmt = "SELECT * FROM blog WHERE uid = ?";
$select = $pdo->prepare($stmt);
$select->execute([$uid]);
$count = $select->rowCount();
  while($row = $select->fetch(PDO::FETCH_ASSOC)){
    ?>
    <div class="col-sm-3 text-center w3-white w3-padding w3-margin">
      <img class="w3-image w3-padding" src="../media/images/<?php echo $row['blogImage'];?>"/>
      <p class="w3-text-blue"><b><?php echo $row['blogTitle'];?></b></p>
      <hr class="w3-clear">
      <p class="w3-text-green"><?php echo $row['date'];?></p>
      <p class="w3-text-blue w3-small" onclick="document.getElementById('blogNum<?php echo $row['id'];?>').style.display='block'">READ</p>
      <p class="w3-text-red w3-orange w3-small" onclick="document.getElementById('blogNum<?php echo $row['id'];?>Delete').style.display='block'">DELETE</p>

    </div>
    <div id="blogNum<?php echo $row['id'];?>" class="w3-modal w3-opaque" style="display:none;">
      <div class="modal-content w3-white w3-padding" style="max-width:80%;margin:auto;min-height:90%;">
        <div class="row w3-red text-center"><p class="w3-padding " onclick="document.getElementById('blogNum<?php echo $row['id'];?>').style.display='none'">CLOSE</p></div>
        <h4 class="w3-text-blue"><b><?php echo $row['blogTitle'];?></b></h4>
        <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          <textarea name="blogContent" class="form-control" style="min-height:70%;"><?php echo $row['blogContent'];?></textarea>
          <input type="hidden" name="id" value="<?php echo $row['id'];?>">
          <input type="hidden" name="uid" value="<?php echo $_SESSION['uid'];?>">
          <input type="submit" class="form-control" name="updateBlog" value="update">
        </form>
      </div>
    </div>
    <div id="blogNum<?php echo $row['id'];?>Delete" class="w3-modal w3-opaque" style="display:none;">
      <div class="modal-content w3-white w3-padding" style="max-width:80%;margin:auto;max-height:90%;">
        <div class="row w3-red text-center"><p class="w3-padding " onclick="document.getElementById('blogNum<?php echo $row['id'];?>Delete').style.display='none'">CLOSE</p></div>
        <div class="row text-center">
          <h4 class="">Would you like to Delete This Blog:</h4>
          <h4 class="w3-text-orange"><b><?php echo $row['blogTitle'];?></b></h4>
        </div>
        <form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
          <input type="hidden" name="id" value="<?php echo $row['id'];?>">
          <input type="hidden" name="uid" value="<?php echo $_SESSION['uid'];?>">
          <input type="submit" class="form-control" name="deleteBlog" value="Delete">
        </form>
      </div>
    </div>
    <?php
}

 ?>
</div>
  </div>
</div>
</div>
<?php getFooter("creator");?>
