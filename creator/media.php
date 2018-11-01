<?php
session_start();
require_once('../require.php');
$output3 = NULL;
//comp.php
?>
<html>
<?php
getHead();
?>
    <body class="w3-black">
    <div class="container text-center w3-padding w3-white" style="height:100%;">
        <div class="row w3-border-bottom">
        <a href="admin.php"><h2>Home</h2></a>
        </div>
        <div class="row w3-padding">

            <a href="create.blog.php">
                <div class="col-sm-4">
                    <div class="" style="max-width:100px;max-height:100px;margin:auto;">
                    <img src="images/pencil.png" class="w3-image"></div>
                    <h3>Create Blog</h3>
                </div>
            </a>

            <a href="embed.video.php">
                <div class="col-sm-4">
                <div class="" style="max-width:100px;max-height:100px;margin:auto;">
                    <img src="images/utube.png" class="w3-image"></div>
                    <h3>Embed Youtube Video</h3>
                </div>
            </a>
                <div class="col-sm-4">
                <div class="" style="max-width:100px;max-height:100px;margin:auto;">
                    <img src="images/insta.png" class="w3-image"></div>
                    <h3>Embed Insta Video</h3>
                </div>
        </div>
        <div class="row w3-padding">

            <a href="featured.video.php">
                <div class="col-sm-4">
                    <div class="" style="max-width:100px;max-height:100px;margin:auto;">
                    <img src="images/pencil.png" class="w3-image"></div>
                    <h3>Set Featured Video</h3>
                </div>
            </a>
    </div>
    </body>
