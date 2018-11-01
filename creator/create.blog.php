<?php
require_once('../require.php');
$output = "No current feedback";
getHead();
?>
<?php
if(isset($_POST['submit'])){
       $p1 = $_POST['blogTitle'];
       $p2 = $_POST['blogContent'];
       $p3 = $_POST["date"];
       $dir = "../media/images/";
       $p4 = $_FILES['file']['name'];
       $p5 = $_SESSION['uid'];
       $target = $dir .basename($p4);
       try{
       $stmt = "INSERT INTO blog (blogTitle, blogContent, date, blogImage, uid) VALUES (?,?,?,?,?)";
       $insert = $pdo->prepare($stmt)->execute([$p1,$p2,$p3,$p4,$p5]);
       if($insert){
         if(move_uploaded_file($_FILES["file"]["tmp_name"], $target)){
         $output = 'Awesome Submission!';
       }else{
         $output= "Image was not moved to specified location.";
       }}else{
         $output = 'Hm, something went wrong.';
       }
     }catch(PDOException $e){
        echo $e->getMessage();
     }
}
// if(isset($_POST["Submit"])) {
//     $BlogTitle = $_POST['BlogTitle'];
//     $BlogContent = $_POST['BlogContent'];
//     $target = "images/".basename($_FILES['image']['name']);
//     $BlogImage = $_FILES['image']['name'];
//     $BlogDate = $_POST["date"];
//
//   if(isset($_SESSION['uid']) && !empty($BlogTitle) && !empty($blogContent)) {
//         //insert records
//         $stmt = "INSERT INTO blogs (BlogTitle, BlogContent, BlogImage, BlogDate, uid) VALUES ('$BlogTitle','$BlogContent','$BlogImage','$BlogDate','$uid')";
//         if($insert != TRUE){
//             $output = "There was an issue inserting records:";
//             $output .= $mysqli->error;
//         }elseif(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
//             $output = "<h4 class=''><span class='w3-text-green'>" . $_SESSION["user"] . "</span>, your blog, <span class='w3-text-green'>" . $BlogTitle . "</span> has been created.</h4>";
//         }else{
// 	    $output = "Failed to upload photo";
//             $output .= print_r($_FILES);
//         }}else{
//           $output = "Hmmm.";
//         }
// }
?>

<html>
<body class="container-fluid w3-light-grey">

<?php getHeader();?>
<div id="CompInfo">
<div class="container w3-white" style="min-height:100%;">
<div class="w3-padding" style="">
  <div class="row text-center">
    <h2>New Blog</h2><h3>Create Your Latest Here</h3><p class="text-left">Upload Feedback:<span class="w3-text-red"><?php echo $output;?></span></p>
  </div>
  <form action="create.blog.php" method="post" enctype="multipart/form-data" class="w3-center" style="">
      <div class="row">
        <h2 class="text-left">Header Image</h2>
        <div class="form-group" style="width:100%;">
          <label for="file" class="w3-blue w3-padding" style="cursor:pointer;">Choose An Image<br>Click Here</label>
          <input id="file" name="file" type="file" style="">
        </div>
      </div>
      <div class="row">
        <h2 class="text-left">Title</h2>
      </div>
      <div class="form-group">
        <label for="Company"></label>
        <input name="blogTitle" type="text" class="form-control" placeholder="Title This Blog" style="font-size:26px;border:none;">
      </div>
      <div class="row">
        <h2 class="text-left">Content</h2>
      </div>
      <div class="form-group">
          <label for="blogContent">Start Typing</label>
          <textarea name="blogContent" class="form-control" rows="9" id="blogContent" placeholder="Start Typing" style="font-size:26px;border:none;"></textarea><br><br>
          <input name="date" type="text" value="<?php echo date("Y/m/d"); ?>">
          <input name="submit" type="submit" value="Create Blog">
      </div>
  </form>
</div>
</div>
</div>
</body>
<?php getFooter("creator");?>
</html>
