<?php
session_start();
require_once('../require.php');

//comp.php
?>
<html>
<?php
getHead();
?>
 <body class="w3-black">
    <div class="container w3-white" style="height:100%;">
        <div class="row w3-border-bottom">
           <div class="col-sm-12 text-center">
           <a href="admin.php"><h2>Home</h2></a>
           </div>
       </div>
<?php
//set featured video
//select * videos, put current featured video at the top, then present videos to replace underneath.
if(isset($_POST["submit"])){
    $vidID = $_POST["vidID"];
        //FIRST STEP
    $featuredChangeYes = $mysqli->query("SELECT * FROM videos WHERE featured = 'yes'");
    if($featuredChangeYes ->num_rows > 0){
        while($row = $featuredChangeYes->fetch_assoc()){
        $fvidID = $row["id"];
        $reset = $mysqli->query("UPDATE videos SET featured = 'no' WHERE id = '$fvidID'");
        }
        $featuredChangeNo = $mysqli->query("SELECT featured FROM videos WHERE id = '$vidID'");
                if($featuredChangeNo ->num_rows > 0)
                {
                    while ($row = $featuredChangeNo->fetch_assoc())
                    {
                        $set = query("UPDATE videos SET featured = 'yes' WHERE id = '$vidID'");
                        if($set == TRUE){echo "featured video updated";}else{echo "An error occurred while updating your featured video. Please reload the page and try again.";}
                    }
                }else{echo "Please reload the page and try again.";}
    }else{
        $featuredChangeNo = $mysqli->query("SELECT featured FROM videos WHERE id = '$vidID'");
        if($featuredChangeNo ->num_rows > 0){
        while($row = $featuredChangeNo -> fetch_assoc()){
        $set = $mysqli->query("UPDATE videos SET featured = 'yes' WHERE id = '$vidID'");
            if($set == TRUE){
                echo "featured video updated";
            }else{echo "An error occurred while updating your featured video.";}
        }
        }else{
              echo"<script type='text/javascript'>alert('Hmmm..This is awkward. Contact your developer.');</script>";}
    }
}
?>
<div class="row text-center" style="max-height:500px;">
<?php
        $videos = $mysqli->query("SELECT * FROM videos WHERE CompID = '5'");
    if($videos -> num_rows > 0){
    while($row = $videos->fetch_assoc()){
        $vidID = $row["id"];
        $vidName = $row["name"];
        $vidLink = $row["link"];
        $vidDate = $row["date"];
        $vidDesc = $row["description"];
    echo '<div class="col-sm-2 w3-padding" style="margin:auto;">
        <div class=""><iframe max-width="500" max-height="500" src="https://www.youtube.com/embed/'.$vidLink.'"></iframe></div>
        <form method="post" action="featured.video.php">
        <h2 class="w3-button w3-block w3-hover-red">
        <input type="hidden" name="vidID" value="'.$vidID.'">
        <input type="submit" name="submit" value="feature" style="text-align: center;width:inherit;color:black;border: 0px;background: none;background-color: none;text-decoration:none;">
        </h2>
        </form>
        </div>';
    }
    }else{
        echo 'Videos Coming Soon.';
        } ?>
        </div>
</div></body>
