<?php
session_start();
require_once('../require.php');
$output3 = NULL;
//comp.php
?>
<?php
if(isset($_POST["Submit"])) {
    $source = $_POST["source"];
    $type = $_POST["type"];
    $name = $mysqli->real_escape_string($_POST['name']);
    $link = $mysqli->real_escape_string($_POST['link']);
    $newlink = substr($link,32);
    $uDesc = $mysqli->real_escape_string($_POST['uDesc']);
    $date = $_POST["date"];
    $query = $mysqli->query("SELECT * FROM videos WHERE name = '$name'");

    if($query->num_rows !=0) {
        $output3 = "That name already exists.";
    }else{
        //insert records
        $insert = $mysqli->query("INSERT INTO videos (name, link, description, source, type,date,UserID, CompID) VALUES ('$name', '$newlink','$uDesc','$source','$type','$date','$uid','$CompID')");

        if($insert != TRUE){

            $output3 = "There was an issue ";
            $output3 .= $mysqli->error;
        }else{
            $output3 = "<h4 class=''><span class='w3-text-green'>" . $_SESSION["user"] . "</span>, your video, <span class='w3-text-green'>" . $name . "</span> has been created.</h4>";
        }}
}else{
    $name = "Please Enter A Name For Your Video";
    $newlink = "Please paste the Youtube Link";
    $uDesc = "Enter a description for your video, if you'd like to.";
}
?>

<html>
<?php
getHead();
?>
<body class="container-fluid w3-black">
<div id="header">
</div>
<div id="CompInfo">
<div class="container w3-white" style="height:100%;">
<div class="w3-border-bottom w3-border-red row" style=""><a href="admin.php"><h3>Home</h3></a></div>
<div class="w3-padding" style="">
<form action="embed.video.php" method="post" enctype="multipart/form-data" class="w3-center" style="">
    <div class="">
        <div class="row"><h2 class="text-left">Name of Video</h2></div>
                <div class="form-group">
                <label for="Company">Enter Name</label>
                <p class=""><?php echo $name; ?></p>
                <input type="text" class="form-control" name="name" placeholder="">
                </div>
        <div class="row"><h2 class="text-left">Youtube Embed Link</h2></div>
                <div class="form-group">
                    <label for="Company">Paste Link</label>
                    <p class=""><?php echo $newlink; ?></p>
                    <input type="text" class="form-control" name="link" placeholder="">
                </div>
    </div>
            <div class="row"><h2 class="text-left">Video Description</h2></div>
                <div class="form-group">
                <label for="comment">Enter Description</label>
                <p class=""><?php echo $uDesc; ?></p>
                <textarea class="form-control" name="uDesc" rows="9" id="comment"></textarea>
                </div>
    <?php echo $output3;?>
    <input type="hidden" name="source" value="youtube">
    <input type="hidden" name="featured" value="no">
    <input type="hidden" name="type" value="php">
    <input type="hidden" name="date" value="<?php echo date("Y/m/d");?>">
    <input type="submit" name="Submit" value="Upload Video">
</form>
</div>
</div>
</div>
</body>
</html>
